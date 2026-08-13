<?php
	ini_set('memory_limit', '-1');
	ini_set('max_execution_time', 0);
	set_time_limit(0);
?>
<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-md-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h4>AKSES MONITORING KONTRAK</h4>
					<div class="ibox-tools">
						<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-add-mka" style="color:#fff;">
							<i class="fa fa-plus"></i> Tambah Akses
						</button>
					</div>
				</div>
				<div class="ibox-content">
					<p class="text-muted">Whitelist user yang boleh melihat <b>Monitoring Kontrak</b> dashboard di sisi employee. Admin selalu punya akses. User non-admin tidak akan melihat menu <em>Monitoring Kontrak</em> di sidebar jika belum ditambahkan di sini.</p>
					<div class="table-responsive">
						<table id="mka-table" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th style="width:60px;">No</th>
									<th>Kode</th>
									<th>Nama</th>
									<th>Jabatan</th>
									<th>Divisi</th>
									<th>Diberikan Oleh</th>
									<th>Tanggal</th>
									<th>Catatan</th>
									<th style="width:80px;">Aksi</th>
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

<div class="modal fade" id="modal-add-mka" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="form-add-mka" method="post" action="<?php echo site_url('module_contract/admin_functions/mka_grant'); ?>">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Tambah Akses Monitoring Kontrak</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Cari Employee <span class="text-danger">*</span></label>
						<input type="text" id="mka-search" class="form-control" placeholder="Ketik nama / kode pegawai (min 2 huruf)" autocomplete="off" />
						<input type="hidden" name="employee_in_id" id="mka-selected-id" />
						<div id="mka-results" style="max-height:200px; overflow-y:auto; border:1px solid #eee; margin-top:6px; display:none;"></div>
						<div id="mka-selected-summary" style="margin-top:8px; padding:8px; background:#f7f7f7; border-radius:3px; display:none;"></div>
					</div>
					<div class="form-group">
						<label>Catatan (opsional)</label>
						<textarea name="mka_note" class="form-control" rows="2" placeholder="Alasan pemberian akses"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<button type="submit" id="btn-submit-mka" class="btn btn-primary" disabled>Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
(function(){
	var URL_LIST   = '<?php echo site_url("module_contract/admin_functions/mka_list"); ?>';
	var URL_SEARCH = '<?php echo site_url("module_contract/admin_functions/mka_search_employee"); ?>';
	var URL_REVOKE = '<?php echo site_url("module_contract/admin_functions/mka_revoke"); ?>';

	function loadList(){
		$('#mka-table tbody').html('<tr><td colspan="9" class="text-center"><i class="fa fa-spinner fa-spin"></i> Memuat...</td></tr>');
		$.get(URL_LIST, function(res){
			if(!res.ok){ $('#mka-table tbody').html('<tr><td colspan="9" class="text-danger">Gagal.</td></tr>'); return; }
			if(!res.items.length){ $('#mka-table tbody').html('<tr><td colspan="9" class="text-center text-muted">Belum ada user yang diberikan akses.</td></tr>'); return; }
			var html='';
			for(var i=0;i<res.items.length;i++){
				var r=res.items[i];
				html+='<tr>'
					+'<td>'+(i+1)+'</td>'
					+'<td>'+(r.employee_in_code||'-')+'</td>'
					+'<td>'+(r.employee_in_name||'-')+'</td>'
					+'<td>'+(r.employee_in_position||'-')+'</td>'
					+'<td>'+(r.employee_in_division||'-')+'</td>'
					+'<td>'+(r.granted_by_name||'-')+'</td>'
					+'<td><small>'+(r.mka_insert||'-')+'</small></td>'
					+'<td><small>'+(r.mka_note||'')+'</small></td>'
					+'<td><button class="btn btn-danger btn-xs mka-revoke" data-id="'+r.mka_id+'" data-name="'+(r.employee_in_name||'')+'"><i class="fa fa-trash"></i></button></td>'
					+'</tr>';
			}
			$('#mka-table tbody').html(html);
		}, 'json');
	}

	// Debounced employee search
	var searchTimer=null;
	$('#mka-search').on('input', function(){
		clearTimeout(searchTimer);
		var q = $(this).val().trim();
		$('#mka-selected-id').val(''); $('#mka-selected-summary').hide(); $('#btn-submit-mka').prop('disabled', true);
		if(q.length < 2){ $('#mka-results').hide().html(''); return; }
		searchTimer = setTimeout(function(){
			$.get(URL_SEARCH, {q: q}, function(res){
				if(!res.ok || !res.items.length){ $('#mka-results').show().html('<div class="text-muted" style="padding:8px;">Tidak ditemukan</div>'); return; }
				var html='';
				for(var i=0;i<res.items.length;i++){
					var r=res.items[i];
					html+='<div class="mka-result" data-id="'+r.employee_in_id+'" data-code="'+(r.employee_in_code||'')+'" data-name="'+(r.employee_in_name||'').replace(/"/g,'&quot;')+'" data-pos="'+(r.position_name||'').replace(/"/g,'&quot;')+'" data-div="'+(r.division_name||'').replace(/"/g,'&quot;')+'" style="padding:6px 10px; cursor:pointer; border-bottom:1px solid #eee;">'
						+'<b>'+(r.employee_in_name||'-')+'</b> <small class="text-muted">('+(r.employee_in_code||'-')+')</small><br/>'
						+'<small class="text-muted">'+(r.position_name||'-')+' &middot; '+(r.division_name||'-')+'</small>'
						+'</div>';
				}
				$('#mka-results').show().html(html);
			}, 'json');
		}, 300);
	});
	$('#mka-results').on('click', '.mka-result', function(){
		var $el=$(this);
		$('#mka-selected-id').val($el.data('id'));
		$('#mka-selected-summary').show().html('<b>'+$el.data('name')+'</b> <small>('+$el.data('code')+')</small><br/><small>'+$el.data('pos')+' &middot; '+$el.data('div')+'</small>');
		$('#mka-search').val($el.data('name'));
		$('#mka-results').hide();
		$('#btn-submit-mka').prop('disabled', false);
	});

	$('#form-add-mka').on('submit', function(e){
		e.preventDefault();
		var $btn = $('#btn-submit-mka').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
		$.post($(this).attr('action'), $(this).serialize(), function(res){
			if(!res.ok){ alert('Gagal: '+(res.error||'unknown')); $btn.prop('disabled', false).html('Simpan'); return; }
			$('#modal-add-mka').modal('hide');
			$('#form-add-mka')[0].reset(); $('#mka-selected-id').val(''); $('#mka-selected-summary').hide();
			$btn.html('Simpan');
			loadList();
		}, 'json').fail(function(){ alert('Network error'); $btn.prop('disabled', false).html('Simpan'); });
	});

	$('#mka-table').on('click', '.mka-revoke', function(){
		var id=$(this).data('id'), name=$(this).data('name');
		if(!confirm('Cabut akses monitoring_kontrak untuk '+name+'?')) return;
		$.post(URL_REVOKE, {mka_id: id}, function(res){
			if(!res.ok){ alert('Gagal: '+(res.error||'unknown')); return; }
			loadList();
		}, 'json');
	});

	$(function(){ loadList(); });
})();
</script>
