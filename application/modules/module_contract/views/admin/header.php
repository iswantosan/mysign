<!DOCTYPE html>
<html>
	<head>
		<?php
			unset($datato);
			$datato['table'] = 'patlog__config.sys__project';
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$count_uri = count($this->uri->segment_array());
				for($i=1;$i<=$count_uri;$i++){
					$segment = $this->uri->segment($i);
				}
		?>
		<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
	    <title><?php echo $R1->project_name; ?> &bull; <?php echo strtoupper(str_replace('_',' ',$this->uri->segment(3))); ?></title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="<?php echo $R1->project_description; ?>">
	    <meta name="author" content="kate_freeze@yahoo.com">
		<meta name="version" content="<?php echo $R1->project_version; ?>">

		<!-- Favicon -->
		<link rel="shortcut icon" type="image/icon" href="<?php echo base_url('assets/public/'.$R1->project_favicon.'?date='.date('YmdHis')); ?>"/>
		<?php
			}
		?>
		<!-- CSS -->
		<link href="<?php echo base_url('assets/template/inspinia/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url('assets/template/inspinia/css/animate.css'); ?>" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url('assets/template/inspinia/css/plugins/ladda/ladda-themeless.min.css'); ?>" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url('assets/template/inspinia/font-awesome/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url('assets/template/inspinia/css/plugins/dataTables/datatables.min.css'); ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/template/inspinia/css/plugins/dataTables/datatables.checkboxes.css'); ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/template/inspinia/css/plugins/datapicker/datepicker3.css'); ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/template/inspinia/css/plugins/clockpicker/clockpicker.css'); ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/template/inspinia/css/plugins/select2/select2.min.css'); ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/template/inspinia/css/plugins/select2/select2-bootstrap.min.css'); ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/template/inspinia/css/style.css?date='.date('YmdHis')); ?>" rel="stylesheet" type="text/css">
		<!-- JS -->
		<script src="<?php echo base_url('assets/template/inspinia/js/jquery-2.1.1.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/inspinia/js/bootstrap.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/inspinia/js/plugins/ladda/spin.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/inspinia/js/plugins/ladda/ladda.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/inspinia/js/plugins/ladda/ladda.jquery.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/inspinia/js/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/inspinia/js/inspinia.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/inspinia/js/plugins/pace/pace.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/inspinia/js/plugins/flot/jquery.flot.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/inspinia/js/plugins/flot/jquery.flot.tooltip.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/inspinia/js/plugins/flot/jquery.flot.resize.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/inspinia/js/plugins/dataTables/datatables.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/inspinia/js/plugins/dataTables/datatables.checkboxes.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/inspinia/js/plugins/chartJs/Chart.bundle.js'); ?>"></script>		
		<script src="<?php echo base_url('assets/template/inspinia/js/plugins/chartJs/utils.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/inspinia/js/plugins/peity/jquery.peity.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/inspinia/js/plugins/datapicker/bootstrap-datepicker.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/inspinia/locales/bootstrap-datepicker.id.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/inspinia/js/plugins/clockpicker/clockpicker.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/inspinia/js/plugins/select2/select2.full.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/inspinia/js/plugins/fullcalendar/moment.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/inspinia/js/demo/peity-demo.js'); ?>"></script>
	</head>
	<body>
		<div id="wrapper">
			<nav class="navbar-default navbar-static-side" role="navigation">
				<div class="sidebar-collapse">
					<ul class="nav metismenu" id="side-menu">
						<li class="nav-header">
							<div class="dropdown profile-element">
								<img alt="image" class="img-circle" src="<?php echo base_url('assets/mod__contract/public/user.png'); ?>" height="42">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">
									<?php
										if(!$this->session->userdata('role')){
									?>
									<span class="clear">
										<span class="block m-t-xs">
											<strong class="font-bold">Admin</strong>
										</span>
										<span class="text-xs block">
											Administrator
										</span>
									</span>
									<?php
										}else{
									?>
									<span class="clear">
										<span class="block m-t-xs">
											<strong class="font-bold">Viewer</strong>
										</span>
										<span class="text-xs block">
											Viewer
										</span>
									</span>
									<?php
										}
									?>
								</a>
							</div>
							<div class="logo-element">
								ERP
							</div>
						</li>
						<li class="special_link">
							<a href="<?php echo site_url('module_contract/admin_functions/logout/'); ?>">
								<i class="fa fa-th"></i> <span class="nav-label">Metro Menu</span>
							</a>
						</li>
                        <li class="<?php if(strpos($this->uri->segment(3), 'beranda') !== false){ echo 'active'; } ?>">
                            <a href="<?php echo site_url('module_contract/admin/beranda/'); ?>">
                                <i class="fa fa-home"></i> <span class="nav-label">Beranda</span>
                            </a>
                        </li>
						<li class="<?php if(strpos($this->uri->segment(3), 'dashboard') !== false){ echo 'active'; } ?>">
                            <a href="<?php echo site_url('module_contract/admin/dashboard/'); ?>">
                                <i class="fa fa-desktop"></i> <span class="nav-label">Dashboard</span>
                            </a>
                        </li>
						<?php
							if(!$this->session->userdata('role')){
						?>
						<li class="<?php if(strpos($this->uri->segment(3), 'formulir') !== false){ echo 'active'; } ?>">
                            <a href="<?php echo site_url('module_contract/admin/formulir/'); ?>">
                                <i class="fab fa-wpforms"></i> <span class="nav-label">Formulir Kontrak</span>
                            </a>
                        </li>
						<?php
							unset($datato);
							$datato['table'] = 'patlog__contract.entity__contract';
							$datato['where'] = array(
								'patlog__contract.entity__contract.contract_status_delete' => 'no',
								'patlog__contract.entity__contract.contract_status_done' => 'no'
							);
							$Q1 = $this->view->view_data($datato);
							if($Q1->num_rows() > 0){
								$count_process = '<span class="label label-info pull-right">'.$Q1->num_rows().'</span>';
							}else{
								$count_process = '';
							}
						?>
						<li class="<?php if(strpos($this->uri->segment(3), 'proses_kontrak_utama') !== false){ echo 'active'; } ?>">
                            <a href="<?php echo site_url('module_contract/admin/proses_kontrak_utama/'); ?>">
                                <i class="fas fa-exchange-alt"></i> <span class="nav-label">Proses</span> <?php echo $count_process; ?>
                            </a>
                        </li>
						<?php
							}
						?>
						<li class="<?php if($this->uri->segment(3) === 'monitoring'){ echo 'active'; } ?>">
                            <a href="<?php echo site_url('module_contract/admin/monitoring/'); ?>">
                                <i class="fas fa-ellipsis-h"></i> <span class="nav-label">Monitoring</span>
                            </a>
                        </li>
						<li class="<?php if($this->uri->segment(3) === 'monitoring_kontrak'){ echo 'active'; } ?>">
                            <a href="<?php echo site_url('module_contract/admin/monitoring_kontrak/'); ?>">
                                <i class="fas fa-chart-line"></i> <span class="nav-label">Monitoring Kontrak</span>
                            </a>
                        </li>
						<li class="<?php if(strpos($this->uri->segment(3), 'arsip_kontrak_utama') !== false){ echo 'active'; } ?>">
                            <a href="<?php echo site_url('module_contract/admin/arsip_kontrak_utama/'); ?>">
                                <i class="fas fa-archive"></i> <span class="nav-label">Arsip</span>
                            </a>
                        </li>
						<li class="<?php if(strpos($this->uri->segment(3), 'laporan') !== false){ echo 'active'; } ?>">
                            <a href="<?php echo site_url('module_contract/admin/laporan/'); ?>">
                                <i class="fas fa-clipboard-list"></i> <span class="nav-label">Laporan</span>
                            </a>
                        </li>
						<?php
							if(!$this->session->userdata('role')){
						?>
						<li class="<?php if(strpos($this->uri->segment(3), 'impor') !== false){ echo 'active'; } ?>">
                            <a href="<?php echo site_url('module_contract/admin/impor/'); ?>">
                                <i class="fas fa-file-import"></i> <span class="nav-label">Impor</span>
                            </a>
                        </li>
						<li class="<?php if(strpos($this->uri->segment(3), 'data_') !== false){ echo 'active'; } ?>">
                             <a href="#">
								<i class="fas fa-database"></i> <span class="nav-label">Master Data</span> <span class="fa arrow"></span>
                             </a>
                             <ul class="nav nav-second-level">
								<li class="<?php if(strpos($this->uri->segment(3), 'data_proses') !== false){ echo 'active'; } ?>"><a href="<?php echo site_url('module_contract/admin/data_proses/'); ?>">Data Proses</a></li>
                                <li class="<?php if(strpos($this->uri->segment(3), 'data_permintaan') !== false){ echo 'active'; } ?>"><a href="<?php echo site_url('module_contract/admin/data_permintaan/'); ?>">Data Permintaan</a></li>
                                <li class="<?php if(strpos($this->uri->segment(3), 'data_detail_permintaan') !== false){ echo 'active'; } ?>"><a href="<?php echo site_url('module_contract/admin/data_detail_permintaan/'); ?>">Data Detail Permintaan</a></li>
                                <li class="<?php if(strpos($this->uri->segment(3), 'data_pihak_ketiga') !== false){ echo 'active'; } ?>"><a href="<?php echo site_url('module_contract/admin/data_pihak_ketiga/'); ?>">Data Pihak Ketiga</a></li>
                                <li class="<?php if(strpos($this->uri->segment(3), 'data_dokumen') !== false){ echo 'active'; } ?>"><a href="<?php echo site_url('module_contract/admin/data_dokumen/'); ?>">Data Dokumen</a></li>
                                <li class="<?php if(strpos($this->uri->segment(3), 'data_template') !== false){ echo 'active'; } ?>"><a href="<?php echo site_url('module_contract/admin/data_template/'); ?>">Data Template</a></li>
                                <li class="<?php if(strpos($this->uri->segment(3), 'data_user_reviewer') !== false){ echo 'active'; } ?>"><a href="<?php echo site_url('module_contract/admin/data_user_reviewer/'); ?>">Data User Reviewer</a></li>
                                <li class="<?php if(strpos($this->uri->segment(3), 'data_pengingat') !== false){ echo 'active'; } ?>"><a href="<?php echo site_url('module_contract/admin/data_pengingat/'); ?>">Data Pengingat</a></li>
                                <li class="<?php if(strpos($this->uri->segment(3), 'data_konfigurasi') !== false){ echo 'active'; } ?>"><a href="<?php echo site_url('module_contract/admin/data_konfigurasi/'); ?>">Data Konfigurasi</a></li>
                            </ul>
                        </li>
						<li class="<?php if(strpos($this->uri->segment(3), 'fungsi_') !== false){ echo 'active'; } ?>">
                             <a href="#">
								<i class="fas fa-code"></i> <span class="nav-label">Fungsi</span> <span class="fa arrow"></span>
                             </a>
                             <ul class="nav nav-second-level">
								<li class="<?php if(strpos($this->uri->segment(3), 'fungsi_dokumen_temporary') !== false){ echo 'active'; } ?>"><a href="<?php echo site_url('module_contract/admin/fungsi_dokumen_temporary/'); ?>">Fungsi Dokumen Temporary</a></li>
								<li class="<?php if(strpos($this->uri->segment(3), 'fungsi_inject') !== false){ echo 'active'; } ?>"><a href="<?php echo site_url('module_contract/admin/fungsi_inject/'); ?>">Fungsi Inject</a></li>
								<li class="<?php if(strpos($this->uri->segment(3), 'fungsi_ke_loket') !== false){ echo 'active'; } ?>"><a href="<?php echo site_url('module_contract/admin/fungsi_ke_loket/'); ?>">Fungsi Ke Loket</a></li>
								<li class="<?php if(strpos($this->uri->segment(3), 'fungsi_rollback') !== false){ echo 'active'; } ?>"><a href="<?php echo site_url('module_contract/admin/fungsi_rollback/'); ?>">Fungsi Rollback</a></li>
								<li class="<?php if(strpos($this->uri->segment(3), 'fungsi_arsip') !== false){ echo 'active'; } ?>"><a href="<?php echo site_url('module_contract/admin/fungsi_arsip/'); ?>">Fungsi Arsipkan</a></li>
                            </ul>
                        </li>
						<?php
							}
						?>
					</ul>
				</div>
			</nav>
			<div id="page-wrapper" class="gray-bg">
				<div class="row border-bottom">
					<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
						<div class="navbar-header">
							<a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="#"><i class="fa fa-bars"></i></a>
						</div>
						<ul class="nav navbar-top-links navbar-right">
                            <li class="p-t-md">
                                <span class="m-r-sm"><i><?php echo strtoupper(str_replace('_', ' ', $this->uri->segment(1))); ?></i></span>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                    <i class="fa fa-bell"></i> 
                                </a>
                            </li>
                        </ul>
					</nav>			
				</div>
				<div class="wrapper wrapper-content">
					<?php
						unset($datato);
						$datato['table'] = 'patlog__contract.entity__cog';
						$Q1 = $this->view->view_data($datato);
						if($Q1->num_rows()){
							$R1 = $Q1->row();
							$date = date('Y-m-d', strtotime($R1->cog_update));
					?>
					<marquee style="color:#515151; font-size:14px; padding:5px;" scrollamount="6" loop="infinite">
						<span class="text-navy font-bold">**Update terbaru</span> : <?php echo $R1->cog_running_text; ?> <i class="small"><span class="text-danger">*</span>diupdate pada <?php echo date_indo($date); ?></i>.
					</marquee>
					<?php
						}
					?>