<?php
	ini_set('memory_limit', '-1');
	ini_set('max_execution_time', 0);
	set_time_limit(0);
?>
<style type="text/css">
	.mk-stat { padding: 18px; border-radius:4px; color:#fff; margin-bottom:16px; }
	.mk-stat h1 { margin:6px 0 0; font-size:32px; font-weight:700; }
	.mk-stat small { display:block; margin-top:6px; opacity:.85; }
	.mk-stat.st-active   { background:#1ab394; }
	.mk-stat.st-ongoing  { background:#1c84c6; }
	.mk-stat.st-warn     { background:#f8ac59; }
	.mk-stat.st-danger   { background:#ed5565; }
	.mk-chip {
		display:inline-block; padding:5px 12px; margin:0 6px 6px 0;
		border:1px solid #ddd; border-radius:20px; background:#fff;
		cursor:pointer; font-size:12px; user-select:none;
	}
	.mk-chip:hover { background:#f4f4f4; }
	.mk-chip.active { background:#1ab394; color:#fff; border-color:#1ab394; }
	.mk-chip .count { background:rgba(0,0,0,.1); border-radius:10px; padding:1px 8px; margin-left:6px; }
	.mk-chip.active .count { background:rgba(255,255,255,.3); }
	.mk-breakdown-card { padding:14px; border:1px solid #e7eaec; border-radius:4px; margin-bottom:12px; background:#fafafa; }
	.mk-breakdown-card h4 { margin:0 0 8px; font-size:14px; font-weight:600; color:#333; }
	.mk-breakdown-card .row-line { display:flex; justify-content:space-between; padding:4px 0; border-bottom:1px dashed #ddd; font-size:13px; }
	.mk-breakdown-card .row-line:last-child { border-bottom:0; }
	.mk-breakdown-card .val { font-weight:600; }
	.mk-badge-active   { background:#1ab394; color:#fff; padding:2px 8px; border-radius:3px; font-size:11px; }
	.mk-badge-inactive { background:#c2c2c2; color:#fff; padding:2px 8px; border-radius:3px; font-size:11px; }
	.mk-badge-expired  { background:#ed5565; color:#fff; padding:2px 8px; border-radius:3px; font-size:11px; }
	.mk-type-badge     { display:inline-block; padding:2px 8px; border-radius:3px; font-size:11px; color:#fff; }
	.mk-type-utama     { background:#1ab394; }
	.mk-type-adendum   { background:#1c84c6; }
	.mk-type-pphk      { background:#23c6c8; }
	.mk-type-spk       { background:#f8ac59; }
	.mk-type-draft     { background:#c2c2c2; }
	#listing-table td, #listing-table th { vertical-align:middle; font-size:13px; }
</style>

<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-md-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h4>MONITORING KONTRAK</h4>
					<div class="ibox-tools">
						<a href="<?php echo site_url('module_request_employee/sirkulir/dashboard'); ?>" class="btn btn-info btn-xs">
							<i class="fa fa-external-link-alt"></i> Buka Dashboard Sirkulir
						</a>
					</div>
				</div>
				<div class="ibox-content">

					<!-- ==================== STATS ROW ==================== -->
					<div class="row">
						<div class="col-md-3">
							<div class="mk-stat st-active">
								<div><i class="fa fa-file-signature"></i> Total Kontrak Released</div>
								<h1 id="stat-released">-</h1>
								<small>Kontrak dgn <code>contract_status_done</code>=yes atau punya <code>contract_no_fix</code></small>
							</div>
						</div>
						<div class="col-md-3">
							<a href="<?php echo site_url('module_request_employee/sirkulir/dashboard'); ?>" style="text-decoration:none;">
								<div class="mk-stat st-ongoing">
									<div><i class="fa fa-hourglass-half"></i> Total Request Ongoing</div>
									<h1 id="stat-ongoing">-</h1>
									<small>Request kontrak yang masih berjalan (dashboard sirkulir)</small>
								</div>
							</a>
						</div>
						<div class="col-md-3">
							<div class="mk-stat st-warn">
								<div><i class="fa fa-exclamation-triangle"></i> Berakhir &lt; 2 Bulan</div>
								<h1 id="stat-under-2m">-</h1>
								<small>Kontrak aktif yang akan berakhir dalam 60 hari</small>
							</div>
						</div>
						<div class="col-md-3">
							<div class="mk-stat st-danger">
								<div><i class="fa fa-ban"></i> Kadaluarsa (belum ditutup)</div>
								<h1 id="stat-expired">-</h1>
								<small><code>contract_active_end_date</code> &lt; hari ini &amp; belum done</small>
							</div>
						</div>
					</div>

					<!-- ==================== BREAKDOWN PER TIPE ==================== -->
					<div class="row">
						<div class="col-md-12">
							<h4>Breakdown per Tipe Kontrak <small class="text-muted">(aktif / tidak aktif — sumber: pola <code>contract_no_fix</code>)</small></h4>
						</div>
						<div class="col-md-3"><div class="mk-breakdown-card"><h4><span class="mk-type-badge mk-type-utama">Kontrak Utama</span></h4><div id="bd-utama">-</div></div></div>
						<div class="col-md-3"><div class="mk-breakdown-card"><h4><span class="mk-type-badge mk-type-adendum">Adendum</span></h4><div id="bd-adendum">-</div></div></div>
						<div class="col-md-3"><div class="mk-breakdown-card"><h4><span class="mk-type-badge mk-type-pphk">PPHK</span></h4><div id="bd-pphk">-</div></div></div>
						<div class="col-md-3"><div class="mk-breakdown-card"><h4><span class="mk-type-badge mk-type-spk">SPK</span></h4><div id="bd-spk">-</div></div></div>
					</div>

					<!-- ==================== LISTING ==================== -->
					<div class="row">
						<div class="col-md-12">
							<h4>Listing Kontrak <small class="text-muted">— filter berdasarkan sisa masa berlaku</small></h4>
							<div id="mk-chips">
								<span class="mk-chip active" data-filter="all">Semua <span class="count" id="cnt-all">-</span></span>
								<span class="mk-chip" data-filter="under_2m">&lt; 2 bulan <span class="count" id="cnt-under_2m">-</span></span>
								<span class="mk-chip" data-filter="2_to_6m">2 - 6 bulan <span class="count" id="cnt-2_to_6m">-</span></span>
								<span class="mk-chip" data-filter="over_6m">&gt; 6 bulan <span class="count" id="cnt-over_6m">-</span></span>
								<span class="mk-chip" data-filter="expired">Kadaluarsa <span class="count" id="cnt-expired">-</span></span>
								<span class="mk-chip" data-filter="no_end_date">Tanpa Tanggal <span class="count" id="cnt-no_end_date">-</span></span>
								<button type="button" class="btn btn-primary btn-sm pull-right" id="btn-export-xls">
									<i class="fa fa-file-excel"></i> Export XLS
								</button>
							</div>
							<div class="table-responsive" style="margin-top:12px;">
								<table id="listing-table" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th style="width:60px;">No</th>
											<th>Nomor Kontrak</th>
											<th>Nomor Fix</th>
											<th>Judul / Request</th>
											<th>Pihak Ketiga</th>
											<th>Tipe</th>
											<th>PIC</th>
											<th>Nilai</th>
											<th>Mulai</th>
											<th>Berakhir</th>
											<th>Sisa Hari</th>
											<th>Status</th>
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
</div>

<script>
(function(){
	var API_OVERVIEW = '<?php echo site_url("module_contract/admin_functions/api_kontrak_overview"); ?>';
	var API_LIST     = '<?php echo site_url("module_contract/admin_functions/api_kontrak_list"); ?>';
	var URL_XLS      = '<?php echo site_url("module_contract/admin_functions/kontrak_export_xls"); ?>';
	var currentFilter = 'all';

	function fmtNum(n){ return (n==null||isNaN(n))?'-':Number(n).toLocaleString('id-ID'); }
	function fmtCur(cur, val){
		if(val==null||val==='') return '-';
		var s = Number(val); if(isNaN(s)) return val;
		return (cur||'') + ' ' + s.toLocaleString('id-ID');
	}
	function typeBadge(t){
		var cls = { 'Kontrak Utama':'mk-type-utama','Adendum':'mk-type-adendum','PPHK':'mk-type-pphk','SPK':'mk-type-spk' }[t] || 'mk-type-draft';
		return '<span class="mk-type-badge '+cls+'">'+(t||'Draft')+'</span>';
	}
	function statusBadge(row){
		if(row.status_flag === 'active')   return '<span class="mk-badge-active">Aktif</span>';
		if(row.status_flag === 'expired')  return '<span class="mk-badge-expired">Kadaluarsa</span>';
		if(row.status_flag === 'inactive') return '<span class="mk-badge-inactive">Tidak Aktif</span>';
		return '<span class="mk-badge-inactive">-</span>';
	}
	function daysCell(d){
		if(d==null || d==='') return '-';
		var n = Number(d);
		if(n < 0)   return '<span class="text-danger">'+n+' hari</span>';
		if(n < 60)  return '<span class="text-warning"><b>'+n+' hari</b></span>';
		return n + ' hari';
	}

	function renderOverview(res){
		$('#stat-released').text(fmtNum(res.total_released));
		$('#stat-ongoing').text(fmtNum(res.total_ongoing));
		$('#stat-under-2m').text(fmtNum(res.buckets.under_2m));
		$('#stat-expired').text(fmtNum(res.buckets.expired));

		$('#cnt-all').text(fmtNum(res.total_all));
		$('#cnt-under_2m').text(fmtNum(res.buckets.under_2m));
		$('#cnt-2_to_6m').text(fmtNum(res.buckets['2_to_6m']));
		$('#cnt-over_6m').text(fmtNum(res.buckets.over_6m));
		$('#cnt-expired').text(fmtNum(res.buckets.expired));
		$('#cnt-no_end_date').text(fmtNum(res.buckets.no_end_date));

		function bdHtml(b){
			return '<div class="row-line"><span>Aktif</span><span class="val">'+fmtNum(b.active)+'</span></div>'
				+ '<div class="row-line"><span>Tidak Aktif</span><span class="val">'+fmtNum(b.inactive)+'</span></div>'
				+ '<div class="row-line"><span>Total</span><span class="val">'+fmtNum(b.total)+'</span></div>';
		}
		$('#bd-utama').html(bdHtml(res.by_type['Kontrak Utama']||{active:0,inactive:0,total:0}));
		$('#bd-adendum').html(bdHtml(res.by_type['Adendum']||{active:0,inactive:0,total:0}));
		$('#bd-pphk').html(bdHtml(res.by_type['PPHK']||{active:0,inactive:0,total:0}));
		$('#bd-spk').html(bdHtml(res.by_type['SPK']||{active:0,inactive:0,total:0}));
	}

	function loadList(filter){
		$('#listing-table tbody').html('<tr><td colspan="12" class="text-center"><i class="fa fa-spinner fa-spin"></i> Memuat...</td></tr>');
		$.get(API_LIST, { filter: filter, limit: 500 }, function(res){
			if(!res || !res.ok){
				$('#listing-table tbody').html('<tr><td colspan="12" class="text-danger">Gagal memuat data.</td></tr>');
				return;
			}
			if(!res.items.length){
				$('#listing-table tbody').html('<tr><td colspan="12" class="text-center text-muted">Tidak ada data.</td></tr>');
				return;
			}
			var html = '';
			for(var i=0;i<res.items.length;i++){
				var r = res.items[i];
				html += '<tr>'
					+ '<td>'+(i+1)+'</td>'
					+ '<td>'+(r.contract_no||'-')+'</td>'
					+ '<td>'+(r.contract_no_fix||'<em class="text-muted">draft</em>')+'</td>'
					+ '<td>'+((r.request_name||'')+' / '+(r.project_name||''))+'</td>'
					+ '<td>'+(r.third_party_name||'-')+'</td>'
					+ '<td>'+typeBadge(r.kontrak_type)+'</td>'
					+ '<td>'+(r.pic_name||'-')+'<br/><small class="text-muted">'+(r.pic_position||'')+'</small></td>'
					+ '<td>'+fmtCur(r.currency, r.value)+'</td>'
					+ '<td>'+(r.date_start||'-')+'</td>'
					+ '<td>'+(r.date_end||'-')+'</td>'
					+ '<td>'+daysCell(r.days_remaining)+'</td>'
					+ '<td>'+statusBadge(r)+'</td>'
					+ '</tr>';
			}
			$('#listing-table tbody').html(html);
		}, 'json').fail(function(){
			$('#listing-table tbody').html('<tr><td colspan="12" class="text-danger">Gagal memuat data (network).</td></tr>');
		});
	}

	$(function(){
		$.get(API_OVERVIEW, {}, function(res){
			if(res && res.ok) renderOverview(res);
		}, 'json');

		loadList(currentFilter);

		$('#mk-chips').on('click', '.mk-chip', function(){
			$('#mk-chips .mk-chip').removeClass('active');
			$(this).addClass('active');
			currentFilter = $(this).data('filter');
			loadList(currentFilter);
		});

		$('#btn-export-xls').on('click', function(){
			window.location = URL_XLS + '?filter=' + encodeURIComponent(currentFilter);
		});
	});
})();
</script>
