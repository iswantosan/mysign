<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Sirkulir controller — parallel approval flow for request_employee.
 *
 *   Old (serial):  step 1 → step 2 → step 3 (reject = back to step 1, restart)
 *   New (sirkulir): all approvers get the request at once; on reject, rejecter
 *                   picks who to return to (requester OR any approver who
 *                   already approved). Approver's already-approved rows stay
 *                   approved. When the return target resubmits, only the
 *                   rejecter is reactivated.
 *
 * Backwards-compat: a request is "sirkulir" iff at least one row exists in
 * entity__request_employee_sirkulasi for its id. Legacy serial flow untouched.
 *
 * Endpoints (URL: /module_request_employee/sirkulir/{method}):
 *   dashboard                         — single-page tabbed dashboard (all 3 roles)
 *   api_list                          — JSON: all sirkulir requests + progress
 *   api_detail/{req_id}               — JSON: full sirkulasi rows + log timeline
 *   api_return_targets/{sirkulasi_id} — JSON: who this rejecter may return to
 *   api_approve/{sirkulasi_id}        — POST: approve
 *   api_reject/{sirkulasi_id}         — POST: reject + return (needs target_type, target_id)
 *   api_resubmit/{sirkulasi_id}       — POST: return target resubmits after revision
 *
 * Demo auth: `?as_employee=<employee_in_id>` overrides session for testing.
 */
class Sirkulir extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    // ============================================================
    // VIEW ENTRY POINT
    // ============================================================

    public function dashboard() {
        $this->load->view('admin/header');
        $this->load->view('admin/page/sirkulir_dashboard', array(
            'current_employee_id' => $this->current_employee_id(),
            'demo_users'          => $this->list_demo_users(),
        ));
        $this->load->view('admin/footer');
    }

    // ============================================================
    // API: JSON endpoints
    // ============================================================

    public function api_list() {
        // L2 filter: date range on request_employee_date_start (tanggal mulai pekerjaan).
        // Empty = no filter (backward-compat).
        $date_from = $this->input->get('date_from');
        $date_to   = $this->input->get('date_to');
        $where     = '';
        $params    = array();
        if ($date_from && preg_match('/^\d{4}-\d{2}-\d{2}$/', $date_from)) {
            $where .= ' AND r.request_employee_date_start >= ?';
            $params[] = $date_from;
        }
        if ($date_to && preg_match('/^\d{4}-\d{2}-\d{2}$/', $date_to)) {
            $where .= ' AND r.request_employee_date_start <= ?';
            $params[] = $date_to;
        }

        $rows = $this->db->query("
            SELECT
                r.request_employee_id                          AS req_id,
                r.request_employee_no                          AS req_no,
                r.request_employee_date                        AS req_date,
                r.request_employee_date_start                  AS date_start,
                r.request_employee_date_end                    AS date_end,
                r.request_employee_creator_employee_in_id      AS creator_id,
                r.request_employee_creator_employee_in_name    AS creator_name,
                r.request_employee_creator_position            AS creator_position,
                r.request_employee_project_code_name           AS project_name,
                COUNT(s.sirkulasi_id)                          AS total,
                SUM(s.status='approved')                       AS approved,
                SUM(s.status='pending')                        AS pending,
                SUM(s.status='rejected')                       AS rejected,
                SUM(s.status='waiting_resubmit')               AS waiting_resubmit,
                MAX(s.actioned_at)                             AS last_action,
                MIN(s.assigned_at)                             AS submitted_at
            FROM patlog__request_employee.entity__request_employee r
            INNER JOIN patlog__request_employee.entity__request_employee_sirkulasi s
                    ON s.request_employee_id = r.request_employee_id
            WHERE 1=1 {$where}
            GROUP BY r.request_employee_id
            ORDER BY r.request_employee_id DESC
        ", $params)->result();

        foreach ($rows as $r) {
            $r->overall_status = $this->derive_overall_status($r);
        }

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode(array(
            'ok'         => true,
            'items'      => $rows,
            'date_from'  => $date_from,
            'date_to'    => $date_to,
        )));
    }

    public function api_detail($request_id) {
        $request_id = (int)$request_id;

        $req = $this->db->query("
            SELECT request_employee_id AS req_id,
                   request_employee_no AS req_no,
                   request_employee_date AS req_date,
                   request_employee_date_start AS date_start,
                   request_employee_date_end   AS date_end,
                   request_employee_creator_employee_in_id   AS creator_id,
                   request_employee_creator_employee_in_name AS creator_name,
                   request_employee_creator_position         AS creator_position,
                   request_employee_project_code_id          AS project_code_id,
                   request_employee_project_code_name        AS project_name,
                   request_employee_request_name             AS request_name,
                   request_employee_request_description_name AS request_desc,
                   request_employee_third_party_name         AS third_party_name
              FROM patlog__request_employee.entity__request_employee
             WHERE request_employee_id = ?", array($request_id))->row();

        // L2 addition: per-row duration in seconds
        //   pending -> now - assigned_at
        //   others  -> actioned_at - assigned_at
        $sirkulasi = $this->db->query("
            SELECT sirkulasi_id, process_order, process_name,
                   approver_employee_in_id, approver_code, approver_name, approver_position,
                   status, returned_to_sirkulasi_id, return_target_type,
                   revision_no, assigned_at, actioned_at, note,
                   TIMESTAMPDIFF(SECOND, assigned_at, COALESCE(actioned_at, NOW())) AS duration_seconds
              FROM patlog__request_employee.entity__request_employee_sirkulasi
             WHERE request_employee_id = ?
             ORDER BY process_order, sirkulasi_id", array($request_id))->result();

        $log = $this->db->query("
            SELECT log_id, sirkulasi_id, actor_employee_in_id, actor_name,
                   action, target_sirkulasi_id, note, created_at
              FROM patlog__request_employee.entity__request_employee_sirkulasi_log
             WHERE request_employee_id = ?
             ORDER BY created_at, log_id", array($request_id))->result();

        // L2 addition: nama kontrak — best-effort lookup.
        // If a matching contract in patlog__contract_employee exists for the same
        // project_code_id, prefer its contract_no_fix / contract_no.
        // Fallback: request description + project name (still descriptive).
        $contract_name = null;
        $contract_no   = null;
        if ($req) {
            if (!empty($req->project_code_id)) {
                $c = $this->db->query("
                    SELECT contract_no, contract_no_fix
                      FROM patlog__contract_employee.entity__contract
                     WHERE contract_project_code_id = ?
                     ORDER BY contract_id DESC
                     LIMIT 1", array($req->project_code_id))->row();
                if ($c) {
                    $contract_no   = $c->contract_no;
                    $contract_name = $c->contract_no_fix ? $c->contract_no_fix : $c->contract_no;
                }
            }
            if (!$contract_name) {
                $bits = array();
                if (!empty($req->request_name)) $bits[] = $req->request_name;
                if (!empty($req->request_desc)) $bits[] = $req->request_desc;
                if (!empty($req->project_name)) $bits[] = $req->project_name;
                $contract_name = $bits ? implode(' — ', $bits) : ('Request #'.$req->req_no);
            }
        }

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode(array(
            'ok'            => true,
            'request'       => $req,
            'sirkulasi'     => $sirkulasi,
            'log'           => $log,
            'contract_name' => $contract_name,
            'contract_no'   => $contract_no,
        )));
    }

    /**
     * List valid return targets for a rejecting approver:
     *   - the original requester
     *   - any other approver in the same request who already approved
     * Never the rejecter themselves, never a still-pending approver.
     */
    public function api_return_targets($rejecter_sirkulasi_id) {
        $sid = (int)$rejecter_sirkulasi_id;

        $row = $this->db->query("
            SELECT s.request_employee_id, s.approver_employee_in_id, r.request_employee_creator_employee_in_id, r.request_employee_creator_employee_in_name
              FROM patlog__request_employee.entity__request_employee_sirkulasi s
              JOIN patlog__request_employee.entity__request_employee r ON r.request_employee_id = s.request_employee_id
             WHERE s.sirkulasi_id = ?", array($sid))->row();
        if (!$row) { $this->_json_err('Sirkulasi row not found'); return; }

        $targets = array();
        // Option 1: return to submitter
        $targets[] = array(
            'target_type'          => 'requester',
            'target_sirkulasi_id'  => null,
            'target_employee_in_id'=> $row->request_employee_creator_employee_in_id,
            'target_name'          => $row->request_employee_creator_employee_in_name.' (Requester)',
        );
        // Option 2: any peer approver who has already approved
        $peers = $this->db->query("
            SELECT sirkulasi_id, approver_employee_in_id, approver_name, approver_position
              FROM patlog__request_employee.entity__request_employee_sirkulasi
             WHERE request_employee_id = ?
               AND status = 'approved'
               AND sirkulasi_id != ?
             ORDER BY process_order", array($row->request_employee_id, $sid))->result();
        foreach ($peers as $p) {
            $targets[] = array(
                'target_type'          => 'approver',
                'target_sirkulasi_id'  => (int)$p->sirkulasi_id,
                'target_employee_in_id'=> $p->approver_employee_in_id,
                'target_name'          => $p->approver_name.' ('.$p->approver_position.')',
            );
        }

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode(array('ok' => true, 'targets' => $targets)));
    }

    public function api_approve($sirkulasi_id) {
        $sid   = (int)$sirkulasi_id;
        $actor = $this->current_employee_id();
        $note  = trim((string)$this->input->post('note'));

        $row = $this->_load_sirkulasi($sid);
        if (!$row) { $this->_json_err('Sirkulasi not found'); return; }
        if ((int)$row->approver_employee_in_id !== (int)$actor) {
            $this->_json_err('Anda bukan approver untuk baris ini'); return;
        }
        if (!in_array($row->status, array('pending'), true)) {
            $this->_json_err('Baris ini sudah tidak pending (status='.$row->status.')'); return;
        }

        $this->db->trans_start();
        $this->db->query("
            UPDATE patlog__request_employee.entity__request_employee_sirkulasi
               SET status='approved', actioned_at=NOW(), note=?
             WHERE sirkulasi_id=?", array($note, $sid));
        $this->_log($sid, $row->request_employee_id, $actor, 'approve', null, $note);

        // If this row was the return target of any waiting_resubmit rejecter,
        // reactivate those rejecters — they get their turn again with revision_no++.
        // This is the "auto-resubmit on re-approve" flow so the actor doesn't need
        // to click a second button.
        $rejecters = $this->db->query("
            SELECT sirkulasi_id, approver_name
              FROM patlog__request_employee.entity__request_employee_sirkulasi
             WHERE request_employee_id=?
               AND status='waiting_resubmit'
               AND returned_to_sirkulasi_id=?", array($row->request_employee_id, $sid))->result();
        foreach ($rejecters as $rj) {
            $this->db->query("
                UPDATE patlog__request_employee.entity__request_employee_sirkulasi
                   SET status='pending',
                       revision_no=revision_no+1,
                       returned_to_sirkulasi_id=NULL,
                       return_target_type=NULL,
                       actioned_at=NULL,
                       note=CONCAT('Auto-resubmit setelah ', ?, ' re-approve')
                 WHERE sirkulasi_id=?",
                array($row->approver_name, $rj->sirkulasi_id));
            $this->_log($rj->sirkulasi_id, $row->request_employee_id, $actor, 'resubmit', $sid,
                        'Auto-resubmit setelah '.$row->approver_name.' re-approve');
        }

        $this->db->trans_complete();

        $this->_json_ok(array('sirkulasi_id' => $sid, 'reactivated_rejecters' => count($rejecters)));
    }

    public function api_reject($sirkulasi_id) {
        $sid            = (int)$sirkulasi_id;
        $actor          = $this->current_employee_id();
        $note           = trim((string)$this->input->post('note'));
        $target_type    = $this->input->post('target_type');   // 'requester' | 'approver'
        $target_sirk_id = $this->input->post('target_sirkulasi_id'); // NULL if requester

        $row = $this->_load_sirkulasi($sid);
        if (!$row) { $this->_json_err('Sirkulasi not found'); return; }
        if ((int)$row->approver_employee_in_id !== (int)$actor) {
            $this->_json_err('Anda bukan approver untuk baris ini'); return;
        }
        if ($row->status !== 'pending') {
            $this->_json_err('Baris ini tidak pending'); return;
        }
        if (!in_array($target_type, array('requester','approver'), true)) {
            $this->_json_err('target_type wajib requester atau approver'); return;
        }
        if ($target_type === 'approver' && !$target_sirk_id) {
            $this->_json_err('target_sirkulasi_id wajib jika return ke approver'); return;
        }

        $this->db->trans_start();

        // Rejecter → waiting_resubmit, remember who they returned to
        $this->db->query("
            UPDATE patlog__request_employee.entity__request_employee_sirkulasi
               SET status='waiting_resubmit',
                   returned_to_sirkulasi_id=?,
                   return_target_type=?,
                   actioned_at=NOW(),
                   note=?
             WHERE sirkulasi_id=?",
            array(
                $target_type === 'approver' ? (int)$target_sirk_id : null,
                $target_type,
                $note,
                $sid,
            ));

        // If return target is a peer approver: reset THEIR row to pending
        // (revision_no++). Their prior approval no longer counts until they
        // re-approve. Other approved peers are untouched.
        if ($target_type === 'approver') {
            $this->db->query("
                UPDATE patlog__request_employee.entity__request_employee_sirkulasi
                   SET status='pending',
                       revision_no = revision_no + 1,
                       actioned_at=NULL,
                       note=CONCAT('Dikembalikan dari ', ?, ': ', COALESCE(?, ''))
                 WHERE sirkulasi_id=?",
                array($row->approver_name, $note, (int)$target_sirk_id));
        }
        // If return target is requester: nothing to insert (requester acts on the request itself).

        $this->_log($sid, $row->request_employee_id, $actor, 'reject',
                    $target_type === 'approver' ? (int)$target_sirk_id : null, $note);
        $this->_log($sid, $row->request_employee_id, $actor, 'return',
                    $target_type === 'approver' ? (int)$target_sirk_id : null,
                    $target_type === 'requester'
                        ? 'Return to requester'
                        : 'Return to approver sirkulasi_id='.(int)$target_sirk_id);

        $this->db->trans_complete();
        $this->_json_ok(array('sirkulasi_id' => $sid));
    }

    /**
     * Called by whoever received the return (requester OR peer approver).
     * They resubmit → all rows currently waiting_resubmit that pointed to them
     * flip back to `pending`. Rejecter revision_no++ so they see it's a fresh
     * cycle. Other approved rows stay approved (they are NOT re-asked).
     */
    public function api_resubmit($request_id) {
        $req_id = (int)$request_id;
        $actor  = $this->current_employee_id();
        $note   = trim((string)$this->input->post('note'));

        // Identify what rows should be reactivated:
        //   - waiting_resubmit rows whose returned_to is either the actor (as approver's sirkulasi row)
        //     or where return_target_type='requester' AND actor is the request creator
        $req = $this->db->query("
            SELECT request_employee_creator_employee_in_id AS creator_id
              FROM patlog__request_employee.entity__request_employee
             WHERE request_employee_id=?", array($req_id))->row();
        if (!$req) { $this->_json_err('Request not found'); return; }

        $is_requester = ((int)$req->creator_id === (int)$actor);

        $where_actor = $is_requester
            ? " (s.return_target_type='requester') "
            : " (s.return_target_type='approver' AND s.returned_to_sirkulasi_id IN (
                    SELECT sirkulasi_id FROM (
                        SELECT sirkulasi_id
                          FROM patlog__request_employee.entity__request_employee_sirkulasi
                         WHERE request_employee_id=? AND approver_employee_in_id=?) x
                )) ";

        $params = array($req_id);
        if (!$is_requester) { $params[] = $req_id; $params[] = $actor; }

        $rejecters = $this->db->query("
            SELECT s.sirkulasi_id, s.approver_name
              FROM patlog__request_employee.entity__request_employee_sirkulasi s
             WHERE s.request_employee_id=?
               AND s.status='waiting_resubmit'
               AND $where_actor", $params)->result();
        if (!$rejecters) {
            $this->_json_err('Tidak ada baris yang dikembalikan ke Anda untuk request ini');
            return;
        }

        // L2: attachment doc-history support.
        // Expected optional POST payload:
        //   request_employee_attachment_id[i] -> id of the attachment to replace
        //   $_FILES['resubmit_attachment']['name'][i] etc. -> the new file
        // For each provided attachment, archive the old file to
        // /assets/mod__request_employee/attach/attachment/history/ and log a
        // row in entity__request_employee_attachment_history.
        $arr_att_id = $this->input->post('request_employee_attachment_id');
        $archived   = 0;
        if (is_array($arr_att_id) && isset($_FILES['resubmit_attachment'])) {
            $files = $_FILES['resubmit_attachment'];
            $role  = $is_requester ? 'requester' : 'approver';
            $actor_name = $this->_actor_name($actor);
            $src_dir = './assets/mod__request_employee/attach/attachment/';
            $hist_dir = $src_dir . 'history/';
            if (!is_dir($hist_dir)) { @mkdir($hist_dir, 0777, true); }

            for ($i = 0; $i < count($arr_att_id); $i++) {
                $att_id = (int)$arr_att_id[$i];
                if (!$att_id) continue;
                if (!isset($files['name'][$i]) || $files['error'][$i] != 0) continue;

                $existing = $this->db->query("
                    SELECT request_employee_attachment_file, request_employee_attachment_name
                      FROM patlog__request_employee.entity__request_employee_attachment
                     WHERE request_employee_attachment_id = ?
                       AND request_employee_id = ?
                     LIMIT 1", array($att_id, $req_id))->row();
                if (!$existing) continue;

                $current_file = $existing->request_employee_attachment_file;
                if ($current_file && $current_file !== '' && $current_file !== 'no.pdf'
                    && file_exists($src_dir . $current_file)) {
                    $ext = pathinfo($current_file, PATHINFO_EXTENSION);
                    $hist_name = 'history-'.md5($att_id).'-'.date('YmdHis').'-'
                                 .substr(md5((string)mt_rand()), 0, 6).'.'.$ext;
                    @copy($src_dir . $current_file, $hist_dir . $hist_name);

                    // Use the highest existing revision_no on any rejecter row (they're all about to be bumped)
                    $rev = 0;
                    foreach ($rejecters as $rj) {
                        $prev = $this->db->query("
                            SELECT revision_no FROM patlog__request_employee.entity__request_employee_sirkulasi
                             WHERE sirkulasi_id=?", array($rj->sirkulasi_id))->row();
                        if ($prev && (int)$prev->revision_no > $rev) $rev = (int)$prev->revision_no;
                    }
                    $rev = $rev + 1;

                    $this->db->query("
                        INSERT INTO patlog__request_employee.entity__request_employee_attachment_history
                            (request_employee_attachment_id, request_employee_id, sirkulasi_id,
                             attachment_history_file, attachment_history_action,
                             attachment_history_by_id, attachment_history_by_name, attachment_history_by_role,
                             attachment_history_note, attachment_history_revision_no, attachment_history_created_date)
                        VALUES (?,?,?,?, 'resubmit', ?,?,?, ?, ?, NOW())",
                        array($att_id, $req_id,
                              isset($rejecters[0]) ? (int)$rejecters[0]->sirkulasi_id : null,
                              $hist_name,
                              $actor, $actor_name, $role,
                              $note ? $note : null, $rev));
                    $archived++;
                }

                $new_ext  = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
                $new_name = 'attach-'.md5($att_id).'-r'.time().'.'.$new_ext;
                if (@move_uploaded_file($files['tmp_name'][$i], $src_dir . $new_name)) {
                    $this->db->query("
                        UPDATE patlog__request_employee.entity__request_employee_attachment
                           SET request_employee_attachment_file = ?
                         WHERE request_employee_attachment_id = ?",
                        array($new_name, $att_id));
                }
            }
        }

        $this->db->trans_start();
        foreach ($rejecters as $rj) {
            $this->db->query("
                UPDATE patlog__request_employee.entity__request_employee_sirkulasi
                   SET status='pending',
                       revision_no=revision_no+1,
                       returned_to_sirkulasi_id=NULL,
                       return_target_type=NULL,
                       actioned_at=NULL,
                       note=CONCAT('Resubmit oleh ', ?, ': ', COALESCE(?, ''))
                 WHERE sirkulasi_id=?",
                array($this->_actor_name($actor), $note, $rj->sirkulasi_id));
            $this->_log($rj->sirkulasi_id, $req_id, $actor, 'resubmit', null,
                        'Resubmit untuk rejecter '.$rj->approver_name.($note ? ': '.$note : ''));
        }
        $this->db->trans_complete();
        $this->_json_ok(array('reactivated' => count($rejecters), 'attachments_archived' => $archived));
    }

    /**
     * Return the attachment revision history for a given attachment id.
     * Used by monitoring UI to show which files were replaced during resubmit.
     */
    public function api_attachment_history($attachment_id) {
        $att_id = (int)$attachment_id;
        $rows = $this->db->query("
            SELECT h.attachment_history_id AS id,
                   h.attachment_history_file AS file,
                   h.attachment_history_action AS action,
                   h.attachment_history_by_name AS by_name,
                   h.attachment_history_by_role AS by_role,
                   h.attachment_history_note AS note,
                   h.attachment_history_revision_no AS revision_no,
                   h.attachment_history_created_date AS created_at
              FROM patlog__request_employee.entity__request_employee_attachment_history h
             WHERE h.request_employee_attachment_id = ?
             ORDER BY h.attachment_history_id DESC", array($att_id))->result();

        $base = base_url('assets/mod__request_employee/attach/attachment/history/');
        foreach ($rows as $r) {
            $r->file_url = $base . $r->file;
        }
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode(array('ok'=>true, 'items'=>$rows)));
    }

    /**
     * Reset the 5 demo requests (15..19) back to their seeded scenarios.
     * Only touches sirkulasi + sirkulasi_log rows for those IDs — never the
     * legacy request rows themselves. Idempotent.
     */
    public function api_reset_demo() {
        $this->db->trans_start();

        $this->db->query("DELETE FROM patlog__request_employee.entity__request_employee_sirkulasi     WHERE request_employee_id BETWEEN 15 AND 19");
        $this->db->query("DELETE FROM patlog__request_employee.entity__request_employee_sirkulasi_log WHERE request_employee_id BETWEEN 15 AND 19");

        // ---- REQ 19: fresh, all pending ----
        $this->db->query("INSERT INTO patlog__request_employee.entity__request_employee_sirkulasi
            (request_employee_id, process_order, process_name, approver_employee_in_id, approver_code, approver_name, approver_position, status, assigned_at) VALUES
            (19, 2, 'Approval Supervisor',    3,   '39042529', 'Siti Rizya Permatasari', 'Supervisor',     'pending', NOW() - INTERVAL 2 HOUR),
            (19, 3, 'Approval Manager',       77,  '39020429', 'Gultom Istanto',         'Manajer',        'pending', NOW() - INTERVAL 2 HOUR),
            (19, 7, 'Approval Manager HR',    98,  '050020',   'Budi Utomo',             'Manajer',        'pending', NOW() - INTERVAL 2 HOUR),
            (19, 8, 'Approval VP ADM&KEU',    244, '39020051', 'Ika Yuliana',            'Vice President', 'pending', NOW() - INTERVAL 2 HOUR),
            (19, 9, 'Approval Direksi Teknis',293, '88022377', 'Rizky Mahesa Dwiyana',   'Direktur',       'pending', NOW() - INTERVAL 2 HOUR)");
        $this->db->query("INSERT INTO patlog__request_employee.entity__request_employee_sirkulasi_log
            (sirkulasi_id, request_employee_id, actor_employee_in_id, actor_name, action, note, created_at) VALUES
            (NULL, 19, 465, 'Michael Cham', 'submit', 'Sirkulir submitted to 5 approvers', NOW() - INTERVAL 2 HOUR)");

        // ---- REQ 18: mid-flow, Sup + Mgr approved, rest pending ----
        $this->db->query("INSERT INTO patlog__request_employee.entity__request_employee_sirkulasi
            (request_employee_id, process_order, process_name, approver_employee_in_id, approver_code, approver_name, approver_position, status, assigned_at, actioned_at, note) VALUES
            (18, 2, 'Approval Supervisor',    3,   '39042529', 'Siti Rizya Permatasari', 'Supervisor',     'approved', NOW() - INTERVAL 1 DAY,  NOW() - INTERVAL 20 HOUR, 'OK, sesuai kebutuhan'),
            (18, 3, 'Approval Manager',       77,  '39020429', 'Gultom Istanto',         'Manajer',        'approved', NOW() - INTERVAL 1 DAY,  NOW() - INTERVAL 12 HOUR, 'Setuju'),
            (18, 7, 'Approval Manager HR',    98,  '050020',   'Budi Utomo',             'Manajer',        'pending',  NOW() - INTERVAL 1 DAY,  NULL, NULL),
            (18, 8, 'Approval VP ADM&KEU',    244, '39020051', 'Ika Yuliana',            'Vice President', 'pending',  NOW() - INTERVAL 1 DAY,  NULL, NULL),
            (18, 9, 'Approval Direksi Teknis',293, '88022377', 'Rizky Mahesa Dwiyana',   'Direktur',       'pending',  NOW() - INTERVAL 1 DAY,  NULL, NULL)");
        $this->db->query("INSERT INTO patlog__request_employee.entity__request_employee_sirkulasi_log
            (sirkulasi_id, request_employee_id, actor_employee_in_id, actor_name, action, note, created_at) VALUES
            (NULL, 18, 465, 'Michael Cham',            'submit',  'Sirkulir submitted', NOW() - INTERVAL 1 DAY),
            (NULL, 18, 3,   'Siti Rizya Permatasari',  'approve', 'OK, sesuai kebutuhan', NOW() - INTERVAL 20 HOUR),
            (NULL, 18, 77,  'Gultom Istanto',          'approve', 'Setuju', NOW() - INTERVAL 12 HOUR)");

        // ---- REQ 17: Manager rejected → return to REQUESTER ----
        $this->db->query("INSERT INTO patlog__request_employee.entity__request_employee_sirkulasi
            (request_employee_id, process_order, process_name, approver_employee_in_id, approver_code, approver_name, approver_position, status, returned_to_sirkulasi_id, return_target_type, revision_no, assigned_at, actioned_at, note) VALUES
            (17, 2, 'Approval Supervisor',    3,   '39042529', 'Siti Rizya Permatasari', 'Supervisor',     'approved',         NULL, NULL,        0, NOW() - INTERVAL 2 DAY,  NOW() - INTERVAL 40 HOUR, 'OK'),
            (17, 3, 'Approval Manager',       77,  '39020429', 'Gultom Istanto',         'Manajer',        'waiting_resubmit', NULL, 'requester', 0, NOW() - INTERVAL 2 DAY,  NOW() - INTERVAL 30 HOUR, 'Lampiran kurang lengkap, mohon dilengkapi ke pengaju'),
            (17, 7, 'Approval Manager HR',    98,  '050020',   'Budi Utomo',             'Manajer',        'pending',          NULL, NULL,        0, NOW() - INTERVAL 2 DAY,  NULL, NULL),
            (17, 8, 'Approval VP ADM&KEU',    244, '39020051', 'Ika Yuliana',            'Vice President', 'pending',          NULL, NULL,        0, NOW() - INTERVAL 2 DAY,  NULL, NULL),
            (17, 9, 'Approval Direksi Teknis',293, '88022377', 'Rizky Mahesa Dwiyana',   'Direktur',       'pending',          NULL, NULL,        0, NOW() - INTERVAL 2 DAY,  NULL, NULL)");
        $this->db->query("INSERT INTO patlog__request_employee.entity__request_employee_sirkulasi_log
            (sirkulasi_id, request_employee_id, actor_employee_in_id, actor_name, action, note, created_at) VALUES
            (NULL, 17, 465, 'Michael Cham',            'submit',  'Sirkulir submitted', NOW() - INTERVAL 2 DAY),
            (NULL, 17, 3,   'Siti Rizya Permatasari',  'approve', 'OK', NOW() - INTERVAL 40 HOUR),
            (NULL, 17, 77,  'Gultom Istanto',          'reject',  'Lampiran kurang lengkap, mohon dilengkapi ke pengaju', NOW() - INTERVAL 30 HOUR),
            (NULL, 17, 77,  'Gultom Istanto',          'return',  'Return to requester Michael Cham', NOW() - INTERVAL 30 HOUR)");

        // ---- REQ 16: Direktur rejected → return to Manager (approver, not requester) ----
        // Insert Manager first so we can capture its ID for the return pointer.
        $this->db->query("INSERT INTO patlog__request_employee.entity__request_employee_sirkulasi
            (request_employee_id, process_order, process_name, approver_employee_in_id, approver_code, approver_name, approver_position, status, revision_no, assigned_at, actioned_at, note) VALUES
            (16, 3, 'Approval Manager', 77, '39020429', 'Gultom Istanto', 'Manajer', 'pending', 1, NOW() - INTERVAL 3 DAY, NULL, 'Dikembalikan dari Direktur — mohon review revisi upah')");
        $req16_manager_id = (int)$this->db->insert_id();

        $this->db->query("INSERT INTO patlog__request_employee.entity__request_employee_sirkulasi
            (request_employee_id, process_order, process_name, approver_employee_in_id, approver_code, approver_name, approver_position, status, revision_no, assigned_at, actioned_at, note) VALUES
            (16, 2, 'Approval Supervisor',    3,   '39042529', 'Siti Rizya Permatasari', 'Supervisor',     'approved', 0, NOW() - INTERVAL 3 DAY, NOW() - INTERVAL 70 HOUR, 'OK'),
            (16, 7, 'Approval Manager HR',    98,  '050020',   'Budi Utomo',             'Manajer',        'approved', 0, NOW() - INTERVAL 3 DAY, NOW() - INTERVAL 50 HOUR, 'Cek benefit'),
            (16, 8, 'Approval VP ADM&KEU',    244, '39020051', 'Ika Yuliana',            'Vice President', 'approved', 0, NOW() - INTERVAL 3 DAY, NOW() - INTERVAL 30 HOUR, 'Setuju')");

        $this->db->query("INSERT INTO patlog__request_employee.entity__request_employee_sirkulasi
            (request_employee_id, process_order, process_name, approver_employee_in_id, approver_code, approver_name, approver_position, status, returned_to_sirkulasi_id, return_target_type, revision_no, assigned_at, actioned_at, note) VALUES
            (16, 9, 'Approval Direksi Teknis', 293, '88022377', 'Rizky Mahesa Dwiyana', 'Direktur', 'waiting_resubmit', ?, 'approver', 0, NOW() - INTERVAL 3 DAY, NOW() - INTERVAL 10 HOUR, 'Angka upah tidak match dengan standard baru, tolong Manager review lagi')",
            array($req16_manager_id));

        $this->db->query("INSERT INTO patlog__request_employee.entity__request_employee_sirkulasi_log
            (sirkulasi_id, request_employee_id, actor_employee_in_id, actor_name, action, target_sirkulasi_id, note, created_at) VALUES
            (NULL, 16, 250, 'Abdul Rozak Machbub Ali', 'submit',  NULL, 'Sirkulir submitted', NOW() - INTERVAL 3 DAY),
            (NULL, 16, 3,   'Siti Rizya Permatasari',  'approve', NULL, 'OK', NOW() - INTERVAL 70 HOUR),
            (NULL, 16, 77,  'Gultom Istanto',          'approve', NULL, 'Awal approve', NOW() - INTERVAL 60 HOUR),
            (NULL, 16, 98,  'Budi Utomo',              'approve', NULL, 'Cek benefit', NOW() - INTERVAL 50 HOUR),
            (NULL, 16, 244, 'Ika Yuliana',             'approve', NULL, 'Setuju', NOW() - INTERVAL 30 HOUR),
            (NULL, 16, 293, 'Rizky Mahesa Dwiyana',    'reject',  NULL, 'Angka upah tidak match', NOW() - INTERVAL 10 HOUR),
            (NULL, 16, 293, 'Rizky Mahesa Dwiyana',    'return',  ?,    'Return ke Gultom Istanto (Manager) untuk review ulang', NOW() - INTERVAL 10 HOUR)",
            array($req16_manager_id));

        // ---- REQ 15: fully approved ----
        $this->db->query("INSERT INTO patlog__request_employee.entity__request_employee_sirkulasi
            (request_employee_id, process_order, process_name, approver_employee_in_id, approver_code, approver_name, approver_position, status, assigned_at, actioned_at, note) VALUES
            (15, 2, 'Approval Supervisor',    3,   '39042529', 'Siti Rizya Permatasari', 'Supervisor',     'approved', NOW() - INTERVAL 5 DAY, NOW() - INTERVAL 4 DAY, 'OK'),
            (15, 3, 'Approval Manager',       77,  '39020429', 'Gultom Istanto',         'Manajer',        'approved', NOW() - INTERVAL 5 DAY, NOW() - INTERVAL 4 DAY, 'OK'),
            (15, 7, 'Approval Manager HR',    98,  '050020',   'Budi Utomo',             'Manajer',        'approved', NOW() - INTERVAL 5 DAY, NOW() - INTERVAL 3 DAY, 'OK'),
            (15, 8, 'Approval VP ADM&KEU',    244, '39020051', 'Ika Yuliana',            'Vice President', 'approved', NOW() - INTERVAL 5 DAY, NOW() - INTERVAL 2 DAY, 'OK'),
            (15, 9, 'Approval Direksi Teknis',293, '88022377', 'Rizky Mahesa Dwiyana',   'Direktur',       'approved', NOW() - INTERVAL 5 DAY, NOW() - INTERVAL 1 DAY, 'Approved')");
        $this->db->query("INSERT INTO patlog__request_employee.entity__request_employee_sirkulasi_log
            (sirkulasi_id, request_employee_id, actor_employee_in_id, actor_name, action, note, created_at) VALUES
            (NULL, 15, 749, 'Abdul Hasis',             'submit',  'Sirkulir submitted', NOW() - INTERVAL 5 DAY),
            (NULL, 15, 3,   'Siti Rizya Permatasari',  'approve', 'OK', NOW() - INTERVAL 4 DAY),
            (NULL, 15, 77,  'Gultom Istanto',          'approve', 'OK', NOW() - INTERVAL 4 DAY),
            (NULL, 15, 98,  'Budi Utomo',              'approve', 'OK', NOW() - INTERVAL 3 DAY),
            (NULL, 15, 244, 'Ika Yuliana',             'approve', 'OK', NOW() - INTERVAL 2 DAY),
            (NULL, 15, 293, 'Rizky Mahesa Dwiyana',    'approve', 'Approved', NOW() - INTERVAL 1 DAY)");

        $this->db->trans_complete();
        $this->_json_ok(array('message' => '5 request (15–19) reset ke state seed'));
    }

    // ============================================================
    // Helpers (private)
    // ============================================================

    private function _load_sirkulasi($sid) {
        return $this->db->query("
            SELECT sirkulasi_id, request_employee_id, approver_employee_in_id, approver_name, status
              FROM patlog__request_employee.entity__request_employee_sirkulasi
             WHERE sirkulasi_id=?", array((int)$sid))->row();
    }

    private function _log($sirkulasi_id, $request_id, $actor_id, $action, $target_sirk_id = null, $note = null) {
        $actor_name = $this->_actor_name($actor_id);
        $this->db->query("
            INSERT INTO patlog__request_employee.entity__request_employee_sirkulasi_log
              (sirkulasi_id, request_employee_id, actor_employee_in_id, actor_name, action, target_sirkulasi_id, note, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())",
            array($sirkulasi_id ?: null, (int)$request_id, $actor_id ?: null, $actor_name, $action, $target_sirk_id, $note));
    }

    private function _actor_name($employee_in_id) {
        if (!$employee_in_id) return null;
        $row = $this->db->query("
            SELECT employee_in_name FROM patlog__hrms.entity__employee_in
             WHERE employee_in_id=?", array((int)$employee_in_id))->row();
        return $row ? $row->employee_in_name : null;
    }

    private function current_employee_id() {
        $qp = $this->input->get('as_employee');
        if ($qp) return (int)$qp;
        $sess = $this->session->userdata('employee_in_id');
        return $sess ? (int)base64_decode($sess) : null;
    }

    /** For the demo dashboard's "act as" dropdown. */
    private function list_demo_users() {
        // Real users involved in the seeded requests + approvers pool.
        return $this->db->query("
            SELECT employee_in_id AS id, employee_in_code AS code, employee_in_name AS name, employee_in_position AS position
              FROM patlog__hrms.entity__employee_in
             WHERE employee_in_id IN (3, 77, 98, 244, 293, 250, 465, 749)
             ORDER BY FIELD(employee_in_position,'Direktur','Vice President','Manajer','Supervisor','Staf'), employee_in_name")
            ->result();
    }

    private function derive_overall_status($row) {
        if ((int)$row->waiting_resubmit > 0) return 'RETURNED';
        if ((int)$row->rejected > 0)         return 'REJECTED';
        if ((int)$row->approved === (int)$row->total) return 'APPROVED';
        if ((int)$row->approved > 0)         return 'IN_PROGRESS';
        return 'PENDING';
    }

    private function _json_ok($extra = array()) {
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode(array_merge(array('ok' => true), $extra)));
    }

    private function _json_err($msg) {
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode(array('ok' => false, 'error' => $msg)));
    }
}
