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
									<span class="clear">
										<span class="block m-t-xs">
											<?php
												unset($datato);
												$datato['table'] = 'patlog__hrms.entity__employee_in';
												$datato['where'] = array(
													'patlog__hrms.entity__employee_in.employee_in_id' => base64_decode($this->session->userdata('employee_id'))
												);
												$Q1 = $this->view->view_data($datato);
												if($Q1->num_rows()){
													$R1 = $Q1->row();
													$division = $R1->division_id;
													$functions_id = $R1->functions_id;
											?>
											<strong class="font-bold"><?php echo $R1->employee_in_name; ?></strong>
											<?php
												}
											?>
										</span>
										<span class="text-xs block">
											Pekerja
										</span>
									</span>
								</a>
							</div>
							<div class="logo-element">
								ERP
							</div>
						</li>
						<?php
							unset($datato);
							$datato['table'] = 'patlog__hrms.entity__employee_in';	
							$datato['where'] = array(
								'patlog__hrms.entity__employee_in.employee_in_id' => base64_decode($this->session->userdata('employee_id'))
							);
							$Q1 = $this->view->view_data($datato);
							if($Q1->num_rows()){
								$R1 = $Q1->row();
								$employee_in_id = $R1->employee_in_id;
								$division_id = $R1->division_id;
								$functions_id = $R1->functions_id;
							}else{
								$employee_in_id = null;
								$division_id = null;
								$functions_id = null;
							}
						
							unset($datato);
							$datato['table'] = 'patlog__contract.entity__cog';
							$Q1 = $this->view->view_data($datato);
							if($Q1->num_rows()){
								$R1 = $Q1->row();
								$cog_division_id = $R1->cog_division_id;
								$cog_functions_id = $R1->cog_functions_id;
							}else{
								$cog_division_id = null;
								$cog_functions_id = null;
							}
						?>
						<li class="special_link">
							<a href="<?php echo site_url('module_contract/employee_functions/logout/'); ?>">
								<i class="fa fa-th"></i> <span class="nav-label">Metro Menu</span>
							</a>
						</li>
                        <li class="<?php if(strpos($this->uri->segment(3), 'beranda') !== false){ echo 'active'; } ?>">
                            <a href="<?php echo site_url('module_contract/employee/beranda/'); ?>">
                                <i class="fa fa-home"></i> <span class="nav-label">Beranda</span>
                            </a>
                        </li>
						<li class="<?php if(strpos($this->uri->segment(3), 'dashboard') !== false){ echo 'active'; } ?>">
                            <a href="<?php echo site_url('module_contract/employee/dashboard/'); ?>">
                                <i class="fa fa-desktop"></i> <span class="nav-label">Dashboard</span>
                            </a>
                        </li>
						<li class="<?php if(strpos($this->uri->segment(3), 'formulir') !== false){ echo 'active'; } ?>">
                            <a href="<?php echo site_url('module_contract/employee/formulir/'); ?>">
                                <i class="fab fa-wpforms"></i> <span class="nav-label">Formulir Kontrak</span>
                            </a>
                        </li>
						<?php
							$count_process = '';
							unset($datato);
							$datato['table'] = 'patlog__contract.entity__contract';
							$where = '
								patlog__contract.entity__contract.contract_status_delete = "no" AND 
								patlog__contract.entity__contract.contract_status_done = "no" AND 
								(patlog__contract.entity__contract.contract_creator_employee_in_id = '.$employee_in_id.' OR 
								patlog__contract.entity__contract.contract_approval_current_id = '.$employee_in_id.')
							';
							$datato['where'] = $where;
							$Q1 = $this->view->view_data($datato);
							if($Q1->num_rows()){
								$count_process = '<span class="label label-info pull-right">'.$Q1->num_rows().'</span>';
							}
							
							if($functions_id == $cog_functions_id){
								unset($datato);
								$datato['table'] = 'patlog__contract.entity__contract';
								$datato['where'] = array(
									'patlog__contract.entity__contract.contract_status_delete' => 'no',
									'patlog__contract.entity__contract.contract_status_done' => 'no',
									'patlog__contract.entity__contract.contract_approval_current_category' => 'Loket'
								);
								$Q1 = $this->view->view_data($datato);
								if($Q1->num_rows()){
									$count_process = '<span class="label label-info pull-right">'.$Q1->num_rows().'</span>';
								}
							}
						?>
						<li class="<?php if(strpos($this->uri->segment(3), 'proses_kontrak_utama') !== false){ echo 'active'; } ?>">
                            <a href="<?php echo site_url('module_contract/employee/proses_kontrak_utama/'); ?>">
                                <i class="fas fa-exchange-alt"></i> <span class="nav-label">Proses</span> <?php echo $count_process; ?>
                            </a>
                        </li>
						<li class="<?php if($this->uri->segment(3) === 'monitoring'){ echo 'active'; } ?>">
                            <a href="<?php echo site_url('module_contract/employee/monitoring/'); ?>">
                                <i class="fas fa-ellipsis-h"></i> <span class="nav-label">Monitoring</span>
                            </a>
                        </li>
						<?php
							// "Monitoring Kontrak" menu — only visible if this user is whitelisted.
							$__mka_employee_id_b64 = $this->session->userdata('employee_id');
							$__mka_employee_in_id  = $__mka_employee_id_b64 ? (int) base64_decode($__mka_employee_id_b64) : 0;
							$__mka_show = false;
							if ($__mka_employee_in_id > 0) {
								unset($datato);
								$datato['table'] = 'patlog__contract.entity__monitoring_kontrak_access';
								$datato['where'] = array(
									'patlog__contract.entity__monitoring_kontrak_access.employee_in_id' => $__mka_employee_in_id
								);
								$__mka_q = $this->view->view_data($datato);
								$__mka_show = ($__mka_q && $__mka_q->num_rows() > 0);
							}
							if ($__mka_show):
						?>
						<li class="<?php if($this->uri->segment(3) === 'monitoring_kontrak'){ echo 'active'; } ?>">
                            <a href="<?php echo site_url('module_contract/employee/monitoring_kontrak/'); ?>">
                                <i class="fas fa-chart-line"></i> <span class="nav-label">Monitoring Kontrak</span>
                            </a>
                        </li>
						<?php endif; ?>
						<li class="<?php if(strpos($this->uri->segment(3), 'arsip_kontrak_utama') !== false){ echo 'active'; } ?>">
                            <a href="<?php echo site_url('module_contract/employee/arsip_kontrak_utama/'); ?>">
                                <i class="fas fa-archive"></i> <span class="nav-label">Arsip</span>
                            </a>
                        </li>
						<li class="<?php if(strpos($this->uri->segment(3), 'laporan') !== false){ echo 'active'; } ?>">
                            <a href="<?php echo site_url('module_contract/employee/laporan/'); ?>">
                                <i class="fas fa-clipboard-list"></i> <span class="nav-label">Laporan</span>
                            </a>
                        </li>
						<?php
							if($cog_division_id == $division_id){
						?>
						<li class="<?php if(strpos($this->uri->segment(3), 'impor') !== false){ echo 'active'; } ?>">
                            <a href="<?php echo site_url('module_contract/employee/impor/'); ?>">
                                <i class="fas fa-file-import"></i> <span class="nav-label">Impor</span>
                            </a>
                        </li>
						<li class="<?php if(strpos($this->uri->segment(3), 'data_') !== false){ echo 'active'; } ?>">
                             <a href="#">
								<i class="fas fa-database"></i> <span class="nav-label">Master Data</span> <span class="fa arrow"></span>
                             </a>
                             <ul class="nav nav-second-level">
								<li class="<?php if(strpos($this->uri->segment(3), 'data_proses') !== false){ echo 'active'; } ?>"><a href="<?php echo site_url('module_contract/employee/data_proses/'); ?>">Data Proses</a></li>
                                <li class="<?php if(strpos($this->uri->segment(3), 'data_permintaan') !== false){ echo 'active'; } ?>"><a href="<?php echo site_url('module_contract/employee/data_permintaan/'); ?>">Data Permintaan</a></li>
                                <li class="<?php if(strpos($this->uri->segment(3), 'data_detail_permintaan') !== false){ echo 'active'; } ?>"><a href="<?php echo site_url('module_contract/employee/data_detail_permintaan/'); ?>">Data Detail Permintaan</a></li>
                                <li class="<?php if(strpos($this->uri->segment(3), 'data_pihak_ketiga') !== false){ echo 'active'; } ?>"><a href="<?php echo site_url('module_contract/employee/data_pihak_ketiga/'); ?>">Data Pihak Ketiga</a></li>
                                <li class="<?php if(strpos($this->uri->segment(3), 'data_dokumen') !== false){ echo 'active'; } ?>"><a href="<?php echo site_url('module_contract/employee/data_dokumen/'); ?>">Data Dokumen</a></li>
                                <li class="<?php if(strpos($this->uri->segment(3), 'data_template') !== false){ echo 'active'; } ?>"><a href="<?php echo site_url('module_contract/employee/data_template/'); ?>">Data Template</a></li>
                                <li class="<?php if(strpos($this->uri->segment(3), 'data_user_reviewer') !== false){ echo 'active'; } ?>"><a href="<?php echo site_url('module_contract/employee/data_user_reviewer/'); ?>">Data User Reviewer</a></li>
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