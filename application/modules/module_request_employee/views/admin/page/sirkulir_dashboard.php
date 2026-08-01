<?php
// $current_employee_id, $demo_users passed from Sirkulir::dashboard
$api = site_url('module_request_employee/sirkulir');
?>
<style>
  #sirk-root { padding:24px; background:#f3f3f4; min-height:100vh; }
  #sirk-root h2 { margin:0 0 4px; color:#333; }
  #sirk-root .sirk-toolbar { background:#fff; border:1px solid #e7eaec; padding:16px 20px; margin-bottom:16px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; }
  #sirk-root .sirk-toolbar label { margin:0 8px 0 0; font-weight:600; color:#555; }
  #sirk-root select#as_employee { display:inline-block; width:320px; height:34px; padding:6px 10px; border:1px solid #ccc; background:#fff; color:#333; font-size:14px; }
  #sirk-root select#as_employee option { color:#333; background:#fff; }
  #sirk-root .sirk-body { background:#fff; border:1px solid #e7eaec; padding:20px; }
  #sirk-root .nav-tabs > li > a { color:#555; }
  #sirk-root .nav-tabs > li.active > a { color:#1ab394; font-weight:600; }
  #sirk-root .badge { margin-left:4px; }

  /* Stats cards — fixed sizing, no truncation */
  #sirk-root .sirk-stats-row { display:flex; flex-wrap:wrap; gap:12px; margin:0 -6px 12px; }
  #sirk-root .sirk-stat { flex:1 1 180px; min-width:160px; padding:16px 18px; border-radius:4px; color:#fff; box-shadow:0 1px 2px rgba(0,0,0,.08); display:flex; align-items:center; justify-content:space-between; }
  #sirk-root .sirk-stat .lbl { font-size:12px; font-weight:600; letter-spacing:.5px; text-transform:uppercase; opacity:.95; }
  #sirk-root .sirk-stat .num { font-size:32px; font-weight:700; line-height:1; }
  #sirk-root .sirk-stat .ico { font-size:26px; opacity:.35; }
  #sirk-root .sirk-stat.st-APPROVED    { background:#1ab394; }
  #sirk-root .sirk-stat.st-IN_PROGRESS { background:#1c84c6; }
  #sirk-root .sirk-stat.st-PENDING     { background:#23c6c8; }
  #sirk-root .sirk-stat.st-RETURNED    { background:#f8ac59; }
  #sirk-root .sirk-stat.st-REJECTED    { background:#ed5565; }

  /* Chart cards */
  #sirk-root .sirk-charts-row { margin-bottom:16px; }
  #sirk-root .sirk-chart-card { background:#fff; border:1px solid #e7eaec; border-radius:4px; padding:16px; margin-bottom:16px; }
  #sirk-root .sirk-chart-card h4 { margin:0 0 12px; font-size:15px; font-weight:600; color:#333; border-bottom:1px solid #f1f1f1; padding-bottom:8px; }
  #sirk-root .sirk-canvas-wrap { position:relative; width:100%; }
  #sirk-root .sirk-canvas-wrap.h-260 { height:260px; }
  #sirk-root .sirk-canvas-wrap.h-140 { height:140px; }
  #sirk-root .sirk-canvas-wrap canvas { max-width:100%; }

  /* Progress bar fix (was invisible) */
  #sirk-root .progress { background:#f5f5f5; border-radius:3px; height:16px; }
  #sirk-root .progress-bar { background:#1ab394; color:#fff; font-size:11px; line-height:16px; text-align:center; transition:width .3s; }
  #sirk-root .progress-bar.p-warning { background:#f8ac59; }
  #sirk-root .progress-bar.p-danger { background:#ed5565; }

  /* Timeline */
  #sirk-root .sirk-timeline { list-style:none; padding:0; margin:0; max-height:280px; overflow-y:auto; }
  #sirk-root .sirk-timeline li { padding:8px 0; border-bottom:1px dashed #eee; font-size:13px; }
  #sirk-root .sirk-timeline li:last-child { border-bottom:0; }
  #sirk-root .sirk-timeline .act { font-weight:600; padding:1px 6px; border-radius:3px; font-size:11px; color:#fff; }
  #sirk-root .sirk-timeline .act-submit   { background:#676a6c; }
  #sirk-root .sirk-timeline .act-approve  { background:#1ab394; }
  #sirk-root .sirk-timeline .act-reject   { background:#ed5565; }
  #sirk-root .sirk-timeline .act-return   { background:#f8ac59; }
  #sirk-root .sirk-timeline .act-resubmit { background:#1c84c6; }
</style>
<div id="sirk-root">
  <div class="sirk-toolbar">
    <div>
      <h2>Sirkulir Dashboard — Request Employee</h2>
      <small class="text-muted"><a href="<?php echo site_url('module_request_employee/admin/beranda'); ?>">Beranda</a> · Sirkulir</small>
    </div>
    <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
      <div>
        <label style="margin:0 4px 0 0;">Tgl Mulai Pekerjaan:</label>
        <input type="date" id="filter_date_from" style="height:34px;padding:4px 8px;border:1px solid #ccc;" />
        <span>s/d</span>
        <input type="date" id="filter_date_to" style="height:34px;padding:4px 8px;border:1px solid #ccc;" />
        <button type="button" id="btn_apply_filter" class="btn btn-sm btn-primary" style="height:34px;">Terapkan</button>
        <button type="button" id="btn_clear_filter" class="btn btn-sm btn-default" style="height:34px;">Reset</button>
      </div>
      <div>
        <label style="margin:0 4px 0 0;">Demo — act as:</label>
        <select id="as_employee">
          <option value="">-- pilih user --</option>
          <?php foreach ($demo_users as $u): ?>
            <option value="<?php echo (int)$u->id; ?>" <?php echo ($current_employee_id == $u->id) ? 'selected' : ''; ?>>
              <?php echo htmlspecialchars($u->name.' — '.$u->position); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
  </div>

  <div class="sirk-body">
    <ul class="nav nav-tabs" role="tablist">
      <li class="active"><a href="#tab-admin" data-toggle="tab"><i class="fa fa-tachometer"></i> Admin — Semua Request <span id="badge-admin" class="badge"></span></a></li>
      <li><a href="#tab-approver" data-toggle="tab"><i class="fa fa-inbox"></i> Approver Inbox <span id="badge-approver" class="badge badge-primary"></span></a></li>
      <li><a href="#tab-requester" data-toggle="tab"><i class="fa fa-file-text-o"></i> Requester — Request Saya <span id="badge-requester" class="badge"></span></a></li>
    </ul>

    <div class="tab-content" style="padding-top:20px">

      <!-- ================= ADMIN TAB (default) ================= -->
      <div id="tab-admin" class="tab-pane active">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;flex-wrap:wrap;gap:8px">
          <h3 style="margin:0">Overview semua request sirkulir <small>(admin view — visible tanpa pilih user)</small></h3>
          <button type="button" class="btn btn-warning btn-sm" id="btn-reset-demo" title="Balikin 5 request (15–19) ke state seed awal">
            <i class="fa fa-undo"></i> Reset Demo Data
          </button>
        </div>
        <div id="admin-stats" class="row sirk-stats-row"></div>
        <div class="row sirk-charts-row" style="margin-top:20px">
          <div class="col-md-5"><div class="sirk-chart-card"><h4>Distribusi Status</h4><div class="sirk-canvas-wrap h-260"><canvas id="chart-donut"></canvas></div></div></div>
          <div class="col-md-7"><div class="sirk-chart-card"><h4>Beban Approver <small class="text-muted">(pending / approved / returned per orang)</small></h4><div class="sirk-canvas-wrap h-260"><canvas id="chart-bar-approver"></canvas></div></div></div>
        </div>
        <div class="row sirk-charts-row">
          <div class="col-md-12"><div class="sirk-chart-card"><h4>Trend Submisi <small class="text-muted">(request per tanggal submit)</small></h4><div class="sirk-canvas-wrap h-140"><canvas id="chart-line-trend"></canvas></div></div></div>
        </div>
        <div class="row sirk-charts-row">
          <div class="col-md-6"><div class="sirk-chart-card"><h4>Top Requesters</h4><div id="table-top-requesters"></div></div></div>
          <div class="col-md-6"><div class="sirk-chart-card"><h4>Recent Activity</h4><div id="timeline-recent"></div></div></div>
        </div>
        <div style="margin-top:24px">
          <h4>Semua Request</h4>
          <div id="admin-list"></div>
        </div>
      </div>

      <!-- ================= APPROVER TAB ================= -->
      <div id="tab-approver" class="tab-pane">
        <h3>Approval yg butuh saya <small>(hanya baris <code>pending</code> yg approver-nya saya)</small></h3>
        <div id="approver-list"><i>Pilih user dulu di atas…</i></div>
      </div>

      <!-- ================= REQUESTER TAB ================= -->
      <div id="tab-requester" class="tab-pane">
        <h3>Request yg saya ajukan <small>(sebagai requester)</small></h3>
        <div id="requester-list"><i>Pilih user dulu di atas…</i></div>
      </div>

    </div><!-- /tab-content -->
  </div><!-- /sirk-body -->
</div><!-- /sirk-root -->

<!-- ================= DETAIL / TIMELINE MODAL ================= -->
<div class="modal fade" id="detail-modal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="detail-title">Detail Sirkulasi</h4>
      </div>
      <div class="modal-body" id="detail-body"></div>
      <div class="modal-footer"><button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button></div>
    </div>
  </div>
</div>

<!-- ================= REJECT MODAL ================= -->
<div class="modal fade" id="reject-modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reject &amp; Return</h4>
      </div>
      <div class="modal-body">
        <p>Anda mereject baris sirkulasi <b><span id="reject-sirk-label"></span></b>. Pilih siapa yg menerima kembali:</p>
        <div class="form-group">
          <label>Return ke:</label>
          <select id="reject-target" class="form-control"></select>
        </div>
        <div class="form-group">
          <label>Catatan:</label>
          <textarea id="reject-note" class="form-control" rows="3" placeholder="Alasan reject / instruksi untuk penerima"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger" id="reject-submit"><i class="fa fa-undo"></i> Reject &amp; Return</button>
      </div>
    </div>
  </div>
</div>

<script>
(function() {
  var API      = '<?php echo $api; ?>';
  var CURRENT  = <?php echo $current_employee_id ? (int)$current_employee_id : 'null'; ?>;
  var ALL_ITEMS = [];  // last api_list payload
  var CURRENT_REJECT = { sirkulasi_id: null, request_id: null };
  var DATE_FROM = '';
  var DATE_TO   = '';

  function asParam(extra) {
    var qs = [];
    if (CURRENT)         qs.push('as_employee=' + CURRENT);
    if (extra !== false) {
      if (DATE_FROM)     qs.push('date_from=' + encodeURIComponent(DATE_FROM));
      if (DATE_TO)       qs.push('date_to='   + encodeURIComponent(DATE_TO));
    }
    return qs.length ? ('?' + qs.join('&')) : '';
  }
  // Detail/action endpoints should not carry the date filter (they're per-request);
  // pass extra=false to strip.
  function url(path, opts) { return API + '/' + path + asParam(opts && opts.noFilter ? false : true); }

  // --- Rendering helpers ---------------------------------------------------
  function statusBadge(s) {
    var map = {
      APPROVED:    'label-primary',
      IN_PROGRESS: 'label-info',
      PENDING:     'label-default',
      RETURNED:    'label-warning',
      REJECTED:    'label-danger'
    };
    return '<span class="label ' + (map[s] || 'label-default') + '">' + s + '</span>';
  }
  function rowStatusBadge(s) {
    var map = {
      approved:         '<span class="label label-primary">Approved</span>',
      pending:          '<span class="label label-default">Pending</span>',
      rejected:         '<span class="label label-danger">Rejected</span>',
      waiting_resubmit: '<span class="label label-warning">Waiting Resubmit</span>'
    };
    return map[s] || s;
  }
  function progressBar(item) {
    var pct = item.total > 0 ? Math.round((100 * item.approved) / item.total) : 0;
    var bar = '<div class="progress" style="margin-bottom:0"><div class="progress-bar" style="width:' + pct + '%">' + pct + '%</div></div>';
    return bar + '<small>' + item.approved + '/' + item.total + ' approved · ' + item.pending + ' pending · ' + item.waiting_resubmit + ' returned</small>';
  }

  // --- LOAD LIST -----------------------------------------------------------
  function loadAll() {
    console.log('[sirk] loadAll → ' + url('api_list'));
    $('#admin-list').html('<i class="text-muted">Loading…</i>');
    $.getJSON(url('api_list'))
      .done(function(res) {
        console.log('[sirk] api_list response:', res);
        if (!res || !res.ok) {
          $('#admin-list').html('<div class="alert alert-danger">Load gagal: ' + (res && res.error || 'response tidak valid') + '</div>');
          return;
        }
        ALL_ITEMS = res.items;
        try { renderAdmin(res.items); } catch (e) { console.error(e); $('#admin-list').html('<div class="alert alert-danger">renderAdmin error: ' + e.message + '</div>'); }
        try { renderApprover(res.items); } catch (e) { console.error(e); $('#approver-list').html('<div class="alert alert-danger">renderApprover error: ' + e.message + '</div>'); }
        try { renderRequester(res.items); } catch (e) { console.error(e); $('#requester-list').html('<div class="alert alert-danger">renderRequester error: ' + e.message + '</div>'); }
      })
      .fail(function(xhr, status, err) {
        console.error('[sirk] api_list FAILED', xhr.status, status, err, xhr.responseText.substring(0, 500));
        $('#admin-list').html('<div class="alert alert-danger"><b>API call gagal</b> (HTTP ' + xhr.status + ' ' + status + ')<br>' +
          'URL: <code>' + url('api_list') + '</code><br>' +
          'Response awal: <pre>' + (xhr.responseText || '').substring(0, 500).replace(/</g, '&lt;') + '</pre></div>');
      });
  }

  // --- ADMIN VIEW ----------------------------------------------------------
  var CHARTS = {};  // hold Chart.js instances so we can destroy+recreate on re-render

  function renderAdmin(items) {
    // -------- Stats cards --------
    var stats = { APPROVED:0, IN_PROGRESS:0, PENDING:0, RETURNED:0, REJECTED:0 };
    items.forEach(function(it) { stats[it.overall_status] = (stats[it.overall_status]||0) + 1; });
    var icons = { APPROVED:'check-circle', IN_PROGRESS:'refresh', PENDING:'clock-o', RETURNED:'reply', REJECTED:'times-circle' };
    var labels = { APPROVED:'Approved', IN_PROGRESS:'In Progress', PENDING:'Pending', RETURNED:'Returned', REJECTED:'Rejected' };
    var html = '';
    ['APPROVED','IN_PROGRESS','PENDING','RETURNED','REJECTED'].forEach(function(k) {
      html += '<div class="sirk-stat st-' + k + '">'
            +   '<div><div class="lbl">' + labels[k] + '</div><div class="num">' + (stats[k]||0) + '</div></div>'
            +   '<div class="ico"><i class="fa fa-' + icons[k] + '"></i></div>'
            + '</div>';
    });
    $('#admin-stats').html(html);
    $('#badge-admin').text(items.length);

    // -------- Chart 1: Donut - status distribution --------
    if (CHARTS.donut) CHARTS.donut.destroy();
    CHARTS.donut = new Chart(document.getElementById('chart-donut').getContext('2d'), {
      type: 'doughnut',
      data: {
        labels: ['Approved','In Progress','Pending','Returned','Rejected'],
        datasets: [{
          data: [stats.APPROVED, stats.IN_PROGRESS, stats.PENDING, stats.RETURNED, stats.REJECTED],
          backgroundColor: ['#1ab394','#1c84c6','#23c6c8','#f8ac59','#ed5565'],
          borderWidth: 2, borderColor: '#fff'
        }]
      },
      options: { legend: { position: 'right' }, responsive: true, maintainAspectRatio: false, cutoutPercentage: 60 }
    });

    // -------- Chart 2: Bar - approver load (need per-approver counts) --------
    // Aggregate pending & waiting_resubmit from item counts. For a true per-approver
    // breakdown we'd need api_detail per request; fetch here.
    var approverBusy = {};  // name → { pending, done }
    var detailPromises = items.map(function(it) {
      return $.getJSON(url('api_detail/' + it.req_id)).then(function(det) {
        det.sirkulasi.forEach(function(s) {
          var n = s.approver_name || '?';
          approverBusy[n] = approverBusy[n] || { pending:0, done:0, returned:0 };
          if (s.status === 'pending')                                  approverBusy[n].pending++;
          else if (s.status === 'approved')                            approverBusy[n].done++;
          else if (s.status === 'waiting_resubmit')                    approverBusy[n].returned++;
        });
      });
    });
    $.when.apply($, detailPromises).then(function() {
      var names = Object.keys(approverBusy);
      var pendingD  = names.map(function(n) { return approverBusy[n].pending; });
      var doneD     = names.map(function(n) { return approverBusy[n].done; });
      var returnedD = names.map(function(n) { return approverBusy[n].returned; });

      if (CHARTS.bar) CHARTS.bar.destroy();
      CHARTS.bar = new Chart(document.getElementById('chart-bar-approver').getContext('2d'), {
        type: 'horizontalBar',
        data: {
          labels: names,
          datasets: [
            { label: 'Pending',  data: pendingD,  backgroundColor: '#23c6c8' },
            { label: 'Approved', data: doneD,     backgroundColor: '#1ab394' },
            { label: 'Returned', data: returnedD, backgroundColor: '#f8ac59' }
          ]
        },
        options: {
          responsive: true, maintainAspectRatio: false,
          scales: { xAxes: [{ stacked: true, ticks: { beginAtZero: true, precision: 0 } }],
                    yAxes: [{ stacked: true }] },
          legend: { position: 'bottom' }
        }
      });

      // -------- Top requesters --------
      var byRequester = {};
      items.forEach(function(it) {
        var k = it.creator_name;
        byRequester[k] = (byRequester[k] || 0) + 1;
      });
      var trHtml = '<table class="table table-condensed"><thead><tr><th>Requester</th><th class="text-right"># Requests</th></tr></thead><tbody>';
      Object.keys(byRequester).sort(function(a,b) { return byRequester[b] - byRequester[a]; })
        .forEach(function(name) {
          trHtml += '<tr><td>' + name + '</td><td class="text-right"><b>' + byRequester[name] + '</b></td></tr>';
        });
      trHtml += '</tbody></table>';
      $('#table-top-requesters').html(trHtml);

      // -------- Recent activity timeline --------
      // Aggregate all logs across requests, sort desc by created_at, take 10
      var logPromises = items.map(function(it) {
        return $.getJSON(url('api_detail/' + it.req_id)).then(function(d) {
          return d.log.map(function(l) { l._req_no = it.req_no; return l; });
        });
      });
      $.when.apply($, logPromises).then(function() {
        var all = [];
        for (var i = 0; i < arguments.length; i++) all = all.concat(arguments[i]);
        all.sort(function(a,b) { return (b.created_at || '').localeCompare(a.created_at || ''); });
        var tl = '<ul class="sirk-timeline">';
        all.slice(0, 10).forEach(function(l) {
          tl += '<li>'
              +   '<span class="act act-' + l.action + '">' + l.action + '</span> '
              +   '<b>' + (l.actor_name || '?') + '</b> · <small class="text-muted">' + l.created_at + '</small>'
              +   '<br><small>' + (l._req_no || '') + (l.note ? ' — ' + l.note.replace(/</g,'&lt;').substring(0,80) : '') + '</small>'
              + '</li>';
        });
        tl += '</ul>';
        $('#timeline-recent').html(tl);
      });
    });

    // -------- Chart 3: Line - submissions per date --------
    var byDate = {};
    items.forEach(function(it) {
      var d = (it.submitted_at || '').substring(0, 10);
      if (!d) return;
      byDate[d] = (byDate[d] || 0) + 1;
    });
    var dates = Object.keys(byDate).sort();
    if (CHARTS.line) CHARTS.line.destroy();
    CHARTS.line = new Chart(document.getElementById('chart-line-trend').getContext('2d'), {
      type: 'bar',
      data: {
        labels: dates,
        datasets: [{
          label: 'Submisi',
          data: dates.map(function(d) { return byDate[d]; }),
          backgroundColor: 'rgba(28,132,198,0.75)',
          borderColor: '#1c84c6', borderWidth: 1
        }]
      },
      options: {
        responsive: true, maintainAspectRatio: false,
        legend: { display: false },
        scales: { yAxes: [{ ticks: { beginAtZero: true, precision: 0 } }] }
      }
    });

    // -------- Big table of all requests --------
    var t = '<table class="table table-striped table-hover"><thead><tr>'
          + '<th>Req No</th><th>Tanggal</th><th>Requester</th><th>Status</th><th style="min-width:220px">Progress</th><th>Actioned</th><th></th>'
          + '</tr></thead><tbody>';
    items.forEach(function(it) {
      t += '<tr>'
        + '<td>' + (it.req_no || '#'+it.req_id) + '</td>'
        + '<td>' + (it.req_date || '') + '</td>'
        + '<td>' + it.creator_name + '<br><small class="text-muted">' + it.creator_position + '</small></td>'
        + '<td>' + statusBadge(it.overall_status) + '</td>'
        + '<td>' + progressBar(it) + '</td>'
        + '<td><small>' + (it.last_action || '-') + '</small></td>'
        + '<td><button class="btn btn-xs btn-info" onclick="window.__sirkDetail(' + it.req_id + ')"><i class="fa fa-eye"></i> Detail</button></td>'
        + '</tr>';
    });
    t += '</tbody></table>';
    $('#admin-list').html(t);
  }

  // --- APPROVER VIEW -------------------------------------------------------
  function renderApprover(items) {
    if (!CURRENT) { $('#approver-list').html('<i>Pilih user dulu di atas…</i>'); $('#badge-approver').text(''); return; }
    // Fetch details for every request so we can see per-approver rows for the current user
    var pending = 0, allRows = [];
    var promises = items.map(function(it) {
      return $.getJSON(url('api_detail/' + it.req_id)).then(function(det) {
        det.sirkulasi.forEach(function(s) {
          if (parseInt(s.approver_employee_in_id) === CURRENT && s.status === 'pending') {
            pending++;
            allRows.push({ item: it, s: s });
          }
        });
      });
    });
    if (promises.length === 0) { $('#approver-list').html('<i>Tidak ada request.</i>'); $('#badge-approver').text('0'); return; }
    $.when.apply($, promises).then(function() {
      $('#badge-approver').text(pending);
      if (!allRows.length) { $('#approver-list').html('<p class="text-muted">Tidak ada approval pending untuk Anda. 🎉</p>'); return; }
      var t = '<table class="table table-striped"><thead><tr>'
            + '<th>Req No</th><th>Requester</th><th>Step</th><th>Note</th><th>Since</th><th></th>'
            + '</tr></thead><tbody>';
      allRows.forEach(function(row) {
        var it = row.item, s = row.s;
        t += '<tr>'
          + '<td>' + (it.req_no || '#'+it.req_id) + '</td>'
          + '<td>' + it.creator_name + '<br><small>' + it.creator_position + '</small></td>'
          + '<td>' + s.process_name + '<br><small class="text-muted">order ' + s.process_order + (s.revision_no > 0 ? ' · rev ' + s.revision_no : '') + '</small></td>'
          + '<td><small>' + (s.note ? s.note.replace(/</g,'&lt;') : '') + '</small></td>'
          + '<td><small>' + s.assigned_at + '</small></td>'
          + '<td>'
          +   '<button class="btn btn-xs btn-primary" onclick="window.__sirkApprove(' + s.sirkulasi_id + ',' + it.req_id + ')"><i class="fa fa-check"></i> Approve</button> '
          +   '<button class="btn btn-xs btn-warning" onclick="window.__sirkOpenReject(' + s.sirkulasi_id + ',' + it.req_id + ',\'' + s.process_name + '\')"><i class="fa fa-undo"></i> Reject &amp; Return</button> '
          +   '<button class="btn btn-xs btn-white" onclick="window.__sirkDetail(' + it.req_id + ')"><i class="fa fa-eye"></i></button>'
          + '</td>'
          + '</tr>';
      });
      t += '</tbody></table>';
      $('#approver-list').html(t);
    });
  }

  // --- REQUESTER VIEW ------------------------------------------------------
  function renderRequester(items) {
    if (!CURRENT) { $('#requester-list').html('<i>Pilih user dulu di atas…</i>'); $('#badge-requester').text(''); return; }
    var mine = items.filter(function(it) { return parseInt(it.creator_id) === CURRENT; });
    $('#badge-requester').text(mine.length);
    if (!mine.length) { $('#requester-list').html('<p class="text-muted">Anda tidak punya request sirkulir.</p>'); return; }

    // Fetch details to know if any row is returned-to-me (as requester) — needs resubmit
    var promises = mine.map(function(it) {
      return $.getJSON(url('api_detail/' + it.req_id)).then(function(det) {
        it._returned_to_me = det.sirkulasi.some(function(s) {
          return s.status === 'waiting_resubmit' && s.return_target_type === 'requester';
        });
      });
    });
    $.when.apply($, promises).then(function() {
      var t = '<table class="table table-striped"><thead><tr>'
            + '<th>Req No</th><th>Tanggal</th><th>Status</th><th style="min-width:220px">Progress</th><th>Action</th>'
            + '</tr></thead><tbody>';
      mine.forEach(function(it) {
        t += '<tr class="' + (it._returned_to_me ? 'warning' : '') + '">'
          + '<td>' + (it.req_no || '#'+it.req_id) + '</td>'
          + '<td>' + (it.req_date || '') + '</td>'
          + '<td>' + statusBadge(it.overall_status) + (it._returned_to_me ? ' <span class="label label-warning">Dikembalikan ke Anda</span>' : '') + '</td>'
          + '<td>' + progressBar(it) + '</td>'
          + '<td>'
          +   '<button class="btn btn-xs btn-white" onclick="window.__sirkDetail(' + it.req_id + ')"><i class="fa fa-eye"></i> Detail</button> '
          +   (it._returned_to_me ? '<button class="btn btn-xs btn-success" onclick="window.__sirkResubmit(' + it.req_id + ')"><i class="fa fa-paper-plane"></i> Resubmit</button>' : '')
          + '</td>'
          + '</tr>';
      });
      t += '</tbody></table>';
      $('#requester-list').html(t);
    });
  }

  // --- DETAIL MODAL --------------------------------------------------------
  function fmtDuration(sec) {
    if (sec == null || isNaN(sec)) return '-';
    sec = Math.max(0, Math.floor(Number(sec)));
    var d = Math.floor(sec/86400);
    var h = Math.floor((sec%86400)/3600);
    var m = Math.floor((sec%3600)/60);
    var out = [];
    if (d) out.push(d + 'h');
    if (h) out.push(h + 'j');
    if (m || (!d && !h)) out.push(m + 'm');
    return out.join(' ');
  }
  window.__sirkDetail = function(req_id) {
    $.getJSON(url('api_detail/' + req_id), function(res) {
      if (!res.ok) { alert('Load gagal'); return; }
      var r = res.request;
      var kontrakLine = res.contract_name
        ? '<p><b>Nama Kontrak:</b> <span class="label label-primary">' + res.contract_name.replace(/</g,'&lt;') + '</span>'
          + (res.contract_no ? ' <small class="text-muted">(' + res.contract_no + ')</small>' : '') + '</p>'
        : '';
      var periodLine = (r.date_start || r.date_end)
        ? '<p><b>Periode Pekerjaan:</b> ' + (r.date_start || '-') + ' s/d ' + (r.date_end || '-') + '</p>'
        : '';
      var t = '<h4>' + (r.req_no || '#'+r.req_id) + ' — ' + (r.project_name || '') + '</h4>'
            + kontrakLine
            + periodLine
            + '<p><b>Requester:</b> ' + r.creator_name + ' (' + r.creator_position + ')</p>';

      t += '<h5>Sirkulasi rows (' + res.sirkulasi.length + ')</h5>';
      t += '<table class="table table-condensed table-bordered"><thead><tr>'
         + '<th>Order</th><th>Step</th><th>Approver</th><th>Status</th><th>Rev</th><th>Durasi</th><th>Note</th><th>Actioned</th>'
         + '</tr></thead><tbody>';
      res.sirkulasi.forEach(function(s) {
        var durCls = (s.status === 'pending') ? 'text-warning' : 'text-muted';
        var durNote = (s.status === 'pending') ? ' <small>(berjalan)</small>' : '';
        t += '<tr>'
          + '<td>' + s.process_order + '</td>'
          + '<td>' + s.process_name + '</td>'
          + '<td>' + s.approver_name + '<br><small>' + s.approver_position + '</small></td>'
          + '<td>' + rowStatusBadge(s.status)
          +   (s.return_target_type === 'requester' ? '<br><small>→ requester</small>' : '')
          +   (s.return_target_type === 'approver'  ? '<br><small>→ sirk#' + s.returned_to_sirkulasi_id + '</small>' : '')
          + '</td>'
          + '<td>' + s.revision_no + '</td>'
          + '<td class="' + durCls + '"><b>' + fmtDuration(s.duration_seconds) + '</b>' + durNote + '</td>'
          + '<td><small>' + (s.note ? s.note.replace(/</g,'&lt;') : '') + '</small></td>'
          + '<td><small>' + (s.actioned_at || '-') + '</small></td>'
          + '</tr>';
      });
      t += '</tbody></table>';

      t += '<h5>Timeline</h5><ul>';
      res.log.forEach(function(l) {
        var ic = { submit:'file-o', approve:'check text-navy', reject:'times text-danger', return:'undo text-warning', resubmit:'paper-plane text-primary' };
        t += '<li><i class="fa fa-' + (ic[l.action] || 'circle') + '"></i> '
          + '<small><b>' + l.created_at + '</b> — ' + (l.actor_name || '?') + ' <code>' + l.action + '</code>'
          + (l.target_sirkulasi_id ? ' → sirk#' + l.target_sirkulasi_id : '')
          + (l.note ? ' — ' + l.note.replace(/</g,'&lt;') : '')
          + '</small></li>';
      });
      t += '</ul>';

      $('#detail-title').text('Detail — ' + (r.req_no || '#'+r.req_id));
      $('#detail-body').html(t);
      $('#detail-modal').modal('show');
    });
  };

  // --- ACTIONS -------------------------------------------------------------
  window.__sirkApprove = function(sirkulasi_id, req_id) {
    var note = prompt('Catatan approve (opsional):', '');
    if (note === null) return;
    $.post(url('api_approve/' + sirkulasi_id), { note: note }, function(res) {
      if (!res.ok) { alert('Gagal: ' + res.error); return; }
      loadAll();
    }, 'json');
  };

  window.__sirkOpenReject = function(sirkulasi_id, req_id, step_name) {
    CURRENT_REJECT = { sirkulasi_id: sirkulasi_id, request_id: req_id };
    $('#reject-sirk-label').text('#' + sirkulasi_id + ' — ' + step_name);
    $('#reject-note').val('');
    $.getJSON(url('api_return_targets/' + sirkulasi_id), function(res) {
      if (!res.ok) { alert('Gagal load target: ' + res.error); return; }
      var opts = '';
      res.targets.forEach(function(t) {
        var val = t.target_type + '|' + (t.target_sirkulasi_id || '');
        opts += '<option value="' + val + '">' + t.target_name + '</option>';
      });
      $('#reject-target').html(opts);
      $('#reject-modal').modal('show');
    });
  };

  $('#reject-submit').on('click', function() {
    var v = $('#reject-target').val().split('|');
    var target_type = v[0], target_sirkulasi_id = v[1];
    var note = $('#reject-note').val();
    $.post(url('api_reject/' + CURRENT_REJECT.sirkulasi_id), {
      target_type: target_type,
      target_sirkulasi_id: target_sirkulasi_id,
      note: note
    }, function(res) {
      if (!res.ok) { alert('Gagal: ' + res.error); return; }
      $('#reject-modal').modal('hide');
      loadAll();
    }, 'json');
  });

  window.__sirkResubmit = function(req_id) {
    var note = prompt('Catatan resubmit (opsional):', 'Revisi selesai');
    if (note === null) return;
    $.post(url('api_resubmit/' + req_id), { note: note }, function(res) {
      if (!res.ok) { alert('Gagal: ' + res.error); return; }
      alert('OK, ' + res.reactivated + ' baris rejecter direset ke pending.');
      loadAll();
    }, 'json');
  };

  // --- USER SWITCHER -------------------------------------------------------
  $('#as_employee').on('change', function() {
    var v = $(this).val();
    var u = new URL(window.location.href);
    if (v) u.searchParams.set('as_employee', v); else u.searchParams.delete('as_employee');
    window.location.href = u.toString();
  });

  // --- DATE RANGE FILTER (L2) ---------------------------------------------
  // Persist across reloads via URL params so the filter survives user-switch too.
  (function initFilter() {
    var u = new URL(window.location.href);
    DATE_FROM = u.searchParams.get('date_from') || '';
    DATE_TO   = u.searchParams.get('date_to')   || '';
    if (DATE_FROM) $('#filter_date_from').val(DATE_FROM);
    if (DATE_TO)   $('#filter_date_to').val(DATE_TO);
  })();
  $('#btn_apply_filter').on('click', function() {
    DATE_FROM = $('#filter_date_from').val() || '';
    DATE_TO   = $('#filter_date_to').val()   || '';
    var u = new URL(window.location.href);
    if (DATE_FROM) u.searchParams.set('date_from', DATE_FROM); else u.searchParams.delete('date_from');
    if (DATE_TO)   u.searchParams.set('date_to',   DATE_TO);   else u.searchParams.delete('date_to');
    history.replaceState(null, '', u.toString());
    loadAll();
  });
  $('#btn_clear_filter').on('click', function() {
    DATE_FROM = ''; DATE_TO = '';
    $('#filter_date_from').val(''); $('#filter_date_to').val('');
    var u = new URL(window.location.href);
    u.searchParams.delete('date_from'); u.searchParams.delete('date_to');
    history.replaceState(null, '', u.toString());
    loadAll();
  });

  // --- RESET DEMO ----------------------------------------------------------
  $('#btn-reset-demo').on('click', function() {
    if (!confirm('Reset 5 request demo (15–19) ke state seed awal?\n\nSemua approve/reject/return yg lo lakuin selama demo bakal ke-overwrite.')) return;
    var $b = $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Resetting…');
    $.post(url('api_reset_demo'), {}, function(res) {
      if (!res.ok) { alert('Reset gagal: ' + (res.error || 'unknown')); $b.prop('disabled', false).html('<i class="fa fa-undo"></i> Reset Demo Data'); return; }
      $b.html('<i class="fa fa-check"></i> Reset OK, reload…');
      setTimeout(function() { window.location.reload(); }, 400);
    }, 'json').fail(function(xhr) {
      alert('Reset error (HTTP ' + xhr.status + '): ' + (xhr.responseText || '').substring(0, 200));
      $b.prop('disabled', false).html('<i class="fa fa-undo"></i> Reset Demo Data');
    });
  });

  // --- INIT ----------------------------------------------------------------
  loadAll();
})();
</script>
