<?php
	ini_set('memory_limit', '-1');
	ini_set('max_execution_time', 0);
	set_time_limit(0);
?>
<style type="text/css">
	.sk-stats-row { display:grid; grid-template-columns: repeat(5, 1fr); gap:12px; margin-bottom:16px; }
	@media (max-width: 991px) { .sk-stats-row { grid-template-columns: repeat(2, 1fr); } }
	.sk-stat { padding:18px; border-radius:4px; color:#fff; display:flex; flex-direction:column; width:100%; }
	.sk-stat h1 { margin:6px 0 0; font-size:32px; font-weight:700; }
	.sk-stat small { display:block; margin-top:auto; padding-top:6px; opacity:.85; }
	.sk-stat.st-inprogress { background:#1c84c6; }
	.sk-stat.st-pending    { background:#f8ac59; }
	.sk-stat.st-rejected   { background:#ed5565; }
	.sk-stat.st-done       { background:#1ab394; }
	.sk-stat.st-back       { background:#676a6c; }

	.sk-card { background:#fff; border:1px solid #e7eaec; border-radius:4px; padding:16px; margin-bottom:16px; }
	.sk-card h4 { margin:0 0 12px; font-size:15px; font-weight:600; color:#333; border-bottom:1px solid #f1f1f1; padding-bottom:8px; }
	.sk-timeline { max-height:340px; overflow-y:auto; list-style:none; padding:0; margin:0; }
	.sk-timeline li { padding:8px 0; border-bottom:1px dashed #eee; font-size:13px; }
	.sk-timeline li:last-child { border-bottom:0; }
	.sk-timeline .act { padding:1px 6px; border-radius:3px; font-size:11px; color:#fff; }
	.sk-timeline .act-Approved   { background:#1ab394; }
	.sk-timeline .act-Rejected   { background:#ed5565; }
	.sk-timeline .act-Edited     { background:#f8ac59; }
	.sk-timeline .act-Done       { background:#1c84c6; }
	.sk-timeline .act-Created    { background:#676a6c; }
	.sk-timeline .act-Processing { background:#23c6c8; }
	.sk-timeline .act-Back       { background:#c25050; }

	#sk-list-table td, #sk-list-table th { vertical-align:middle; font-size:13px; }
</style>

<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-md-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h4>SIRKULIR KONTRAK <small class="text-muted">— proses approval kontrak (source: <code>entity__contract_approval</code> + <code>entity__contract_log</code>)</small></h4>
					<div class="ibox-tools">
						<a href="<?php echo site_url('module_contract/admin/monitoring_kontrak/'); ?>" class="btn btn-default btn-xs">
							<i class="fa fa-arrow-left"></i> Monitoring Kontrak
						</a>
					</div>
				</div>
				<div class="ibox-content">

					<!-- Toolbar filter tanggal -->
					<div style="margin-bottom:14px;">
						<label style="margin-right:4px;">Tgl dibuat kontrak:</label>
						<input type="date" id="sk-from" style="height:32px;padding:4px 8px;border:1px solid #ccc;" />
						<span>s/d</span>
						<input type="date" id="sk-to"   style="height:32px;padding:4px 8px;border:1px solid #ccc;" />
						<button type="button" id="sk-apply" class="btn btn-primary btn-sm">Terapkan</button>
						<button type="button" id="sk-clear" class="btn btn-default btn-sm">Reset</button>
					</div>

					<!-- Stats -->
					<div class="sk-stats-row">
						<div><div class="sk-stat st-inprogress"><div><i class="fa fa-cog fa-spin"></i> In Progress</div><h1 id="sk-inprogress">-</h1><small>Kontrak belum Done</small></div></div>
						<div><div class="sk-stat st-pending"><div><i class="fa fa-hourglass-half"></i> Menunggu Approval</div><h1 id="sk-pending">-</h1><small>Slot approver yang belum bertindak</small></div></div>
						<div><div class="sk-stat st-rejected"><div><i class="fa fa-times-circle"></i> Rejected</div><h1 id="sk-rejected">-</h1><small>Total event reject (log)</small></div></div>
						<div><div class="sk-stat st-back"><div><i class="fa fa-undo"></i> Back / Revisi</div><h1 id="sk-back">-</h1><small>Kontrak dikembalikan ke drafter</small></div></div>
						<div><div class="sk-stat st-done"><div><i class="fa fa-check-double"></i> Selesai</div><h1 id="sk-done">-</h1><small>Kontrak status Done</small></div></div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="sk-card">
								<h4>Top Approver (aktivitas terbanyak)</h4>
								<div id="sk-top-approver"><i class="text-muted">Memuat…</i></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="sk-card">
								<h4>Recent Activity</h4>
								<ul id="sk-recent" class="sk-timeline"><li><i class="text-muted">Memuat…</i></li></ul>
							</div>
						</div>
					</div>

					<!-- List kontrak in-progress -->
					<div class="sk-card">
						<h4>Kontrak Sedang Berjalan <small class="text-muted">(belum Done / Delete). Klik <i class="fa fa-eye"></i> untuk timeline approval.</small></h4>
						<div class="table-responsive">
							<table id="sk-list-table" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th style="width:60px;">No</th>
										<th>Nomor Kontrak</th>
										<th>Nomor Fix</th>
										<th>Pihak Ketiga</th>
										<th>PIC / Drafter</th>
										<th>Step Terakhir</th>
										<th>Approver Aktif</th>
										<th>Aktivitas Terakhir</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<!-- Detail modal -->
<div class="modal fade" id="sk-detail-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="sk-detail-title">Detail Sirkulir Kontrak</h4>
			</div>
			<div class="modal-body" id="sk-detail-body"></div>
			<div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button></div>
		</div>
	</div>
</div>

<script>
(function(){
	var API_OVER   = '<?php echo site_url("module_contract/admin_functions/api_sk_overview"); ?>';
	var API_LIST   = '<?php echo site_url("module_contract/admin_functions/api_sk_list"); ?>';
	var API_DETAIL = '<?php echo site_url("module_contract/admin_functions/api_sk_detail"); ?>';
	var DATE_FROM = '', DATE_TO = '';

	function fmtNum(n){ return (n==null||isNaN(n))?'-':Number(n).toLocaleString('id-ID'); }
	function esc(s){ return (s==null?'':String(s)).replace(/[&<>]/g, function(c){ return {'&':'&amp;','<':'&lt;','>':'&gt;'}[c]; }); }
	function actBadge(a){
		var cls = 'act-' + (a||'').replace(/[^A-Za-z]/g,'') || 'act-Created';
		return '<span class="act ' + cls + '">' + esc(a||'-') + '</span>';
	}

	function dateQ(){ var q=[]; if(DATE_FROM) q.push('date_from='+DATE_FROM); if(DATE_TO) q.push('date_to='+DATE_TO); return q.length ? ('?'+q.join('&')) : ''; }

	function loadOverview(){
		$.get(API_OVER + dateQ(), function(res){
			if(!res||!res.ok){ return; }
			$('#sk-inprogress').text(fmtNum(res.in_progress));
			$('#sk-pending').text(fmtNum(res.pending_slots));
			$('#sk-rejected').text(fmtNum(res.rejected_events));
			$('#sk-back').text(fmtNum(res.back_events));
			$('#sk-done').text(fmtNum(res.done));

			var t = '';
			if(!res.top_approver||!res.top_approver.length){ t='<i class="text-muted">Tidak ada data</i>'; }
			else {
				t = '<table class="table table-condensed"><thead><tr><th>Approver</th><th class="text-right">Approved</th><th class="text-right">Rejected</th></tr></thead><tbody>';
				res.top_approver.forEach(function(r){
					t += '<tr><td>'+esc(r.name)+'<br><small class="text-muted">'+esc(r.position||'')+'</small></td>'
					   + '<td class="text-right">'+fmtNum(r.approved)+'</td>'
					   + '<td class="text-right">'+fmtNum(r.rejected)+'</td></tr>';
				});
				t += '</tbody></table>';
			}
			$('#sk-top-approver').html(t);

			var lt = '';
			if(!res.recent||!res.recent.length){ lt='<li><i class="text-muted">Tidak ada aktivitas</i></li>'; }
			else res.recent.forEach(function(r){
				lt += '<li>' + actBadge(r.status) + ' <small><b>'+esc(r.at)+'</b> — '+esc(r.actor)+' pada kontrak <code>'+esc(r.contract_no)+'</code>'
				    + (r.message ? ' — '+esc(r.message) : '') + '</small></li>';
			});
			$('#sk-recent').html(lt);
		}, 'json');
	}

	function loadList(){
		if ($.fn.DataTable && $.fn.DataTable.isDataTable('#sk-list-table')) $('#sk-list-table').DataTable().destroy();
		$('#sk-list-table tbody').html('<tr><td colspan="9" class="text-center"><i class="fa fa-spinner fa-spin"></i> Memuat…</td></tr>');
		$.get(API_LIST + dateQ(), function(res){
			if(!res||!res.ok){ $('#sk-list-table tbody').html('<tr><td colspan="9" class="text-danger">Gagal.</td></tr>'); return; }
			if(!res.items.length){ $('#sk-list-table tbody').html('<tr><td colspan="9" class="text-center text-muted">Tidak ada kontrak berjalan.</td></tr>'); return; }
			var html = '';
			for(var i=0;i<res.items.length;i++){
				var r = res.items[i];
				html += '<tr>'
					+ '<td>'+(i+1)+'</td>'
					+ '<td>'+esc(r.contract_no)+'</td>'
					+ '<td>'+esc(r.contract_no_fix||'-')+'</td>'
					+ '<td>'+esc(r.third_party||'-')+'</td>'
					+ '<td>'+esc(r.drafter_name||'-')+'</td>'
					+ '<td>'+esc(r.last_step||'-')+'</td>'
					+ '<td>'+esc(r.next_approver||'-')+'</td>'
					+ '<td><small>'+esc(r.last_activity||'-')+'</small></td>'
					+ '<td><button class="btn btn-xs btn-info sk-detail-btn" data-id="'+r.contract_id+'" data-no="'+esc(r.contract_no)+'"><i class="fa fa-eye"></i></button></td>'
					+ '</tr>';
			}
			$('#sk-list-table tbody').html(html);
			if ($.fn.DataTable) {
				$('#sk-list-table').DataTable({
					pageLength: 25,
					lengthMenu: [[10,25,50,100,-1],[10,25,50,100,'Semua']],
					order: [],
					language: {
						search: 'Cari:', lengthMenu: 'Tampilkan _MENU_ baris',
						info: 'Menampilkan _START_ - _END_ dari _TOTAL_',
						infoEmpty: '0 baris', infoFiltered: '(dari _MAX_ total)',
						paginate: { first:'Awal', last:'Akhir', next:'Berikut', previous:'Sebelum' },
						zeroRecords: 'Tidak ada data yang cocok'
					}
				});
			}
		}, 'json');
	}

	$('#sk-list-table').on('click', '.sk-detail-btn', function(){
		var id = $(this).data('id'), no = $(this).data('no');
		$('#sk-detail-title').text('Kontrak '+no);
		$('#sk-detail-body').html('<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Memuat…</div>');
		$('#sk-detail-modal').modal('show');
		$.get(API_DETAIL + '?contract_id=' + id, function(res){
			if(!res||!res.ok){ $('#sk-detail-body').html('<div class="alert alert-danger">Gagal memuat.</div>'); return; }
			var c = res.contract, appr = res.approvals, log = res.log;
			var t = '<h5>Info Kontrak</h5>'
				+ '<table class="table table-condensed">'
				+ '<tr><th style="width:180px;">Nomor Kontrak</th><td>'+esc(c.contract_no)+' <small class="text-muted">'+esc(c.contract_no_fix||'')+'</small></td></tr>'
				+ '<tr><th>Pihak Ketiga</th><td>'+esc(c.third_party||'-')+'</td></tr>'
				+ '<tr><th>PIC / Drafter</th><td>'+esc(c.drafter||'-')+'</td></tr>'
				+ '<tr><th>Nama Proyek</th><td>'+esc(c.project_name||'-')+'</td></tr>'
				+ '<tr><th>Periode</th><td>'+esc(c.date_start||'-')+' s/d '+esc(c.date_end||'-')+'</td></tr>'
				+ '</table>';

			t += '<h5>Rantai Approval ('+appr.length+' approver)</h5>';
			t += '<table class="table table-bordered table-condensed"><thead><tr><th>Level</th><th>Approver</th><th>Status</th><th>Tanggal</th></tr></thead><tbody>';
			appr.forEach(function(a){
				var st = a.contract_approval_status || 'pending';
				var lbl = (st === 'Approve') ? '<span class="label label-primary">Approved</span>'
				         : (st === 'pending') ? '<span class="label label-warning">Pending</span>'
				         : '<span class="label label-default">'+esc(st)+'</span>';
				t += '<tr><td>'+esc(a.contract_approval_level||'-')+'</td>'
				   + '<td>'+esc(a.contract_approval_employee_name||'-')+'<br><small class="text-muted">'+esc(a.contract_approval_employee_position||'')+'</small></td>'
				   + '<td>'+lbl+'</td>'
				   + '<td><small>'+esc(a.contract_approval_date||'-')+'</small></td></tr>';
			});
			t += '</tbody></table>';

			t += '<h5>Timeline ('+log.length+' event)</h5><ul class="sk-timeline">';
			log.forEach(function(l){
				t += '<li>' + actBadge(l.contract_log_status) + ' <small><b>'+esc(l.contract_log_insert)+'</b> — '+esc(l.contract_log_employee_name||'-')+' '+esc(l.contract_process_name||'')+ (l.contract_log_message ? ' — '+esc(l.contract_log_message) : '') +'</small></li>';
			});
			t += '</ul>';

			$('#sk-detail-body').html(t);
		}, 'json');
	});

	// Filter init from URL
	(function(){
		var u = new URL(window.location.href);
		DATE_FROM = u.searchParams.get('date_from') || '';
		DATE_TO   = u.searchParams.get('date_to')   || '';
		if(DATE_FROM) $('#sk-from').val(DATE_FROM);
		if(DATE_TO)   $('#sk-to').val(DATE_TO);
	})();
	$('#sk-apply').on('click', function(){
		DATE_FROM = $('#sk-from').val() || '';
		DATE_TO   = $('#sk-to').val() || '';
		var u = new URL(window.location.href);
		if(DATE_FROM) u.searchParams.set('date_from', DATE_FROM); else u.searchParams.delete('date_from');
		if(DATE_TO)   u.searchParams.set('date_to',   DATE_TO);   else u.searchParams.delete('date_to');
		history.replaceState(null, '', u.toString());
		loadOverview(); loadList();
	});
	$('#sk-clear').on('click', function(){
		DATE_FROM=''; DATE_TO=''; $('#sk-from').val(''); $('#sk-to').val('');
		var u = new URL(window.location.href); u.searchParams.delete('date_from'); u.searchParams.delete('date_to');
		history.replaceState(null, '', u.toString());
		loadOverview(); loadList();
	});

	$(function(){ loadOverview(); loadList(); });
})();
</script>
