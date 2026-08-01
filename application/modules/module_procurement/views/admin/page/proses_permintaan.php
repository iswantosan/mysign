				<?php
					$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->get('request_id'));
					$request_id = $this->encrypt->decode($decrypt_id);

					unset($datato);
					$datato['table'] = 'patlog__procurement.entity__request';
					$datato['where'] = array(
						'patlog__procurement.entity__request.request_id' => $request_id
					);
					$Q1 = $this->view->view_data($datato);
					if($Q1->num_rows()){
						$R1 = $Q1->row();
						$request_id = $R1->request_id;
						$request_code = $R1->request_code;
						$request_category_name = $R1->request_category_name;
						$request_type_name = $R1->request_type_name;
						$request_pic_contract_id = $R1->request_pic_contract_id;
						$request_pic_contract_name = $R1->request_pic_contract_name;
						$request_pic_contract_approval_id = $R1->request_pic_contract_approval_id;
						$request_pic_contract_approval_name = $R1->request_pic_contract_approval_name;
						$request_pic_contract_request_id = $R1->request_pic_contract_request_id;
						$request_pic_contract_request_name = $R1->request_pic_contract_request_name;
						$request_pic_contract_request_description_id = $R1->request_pic_contract_request_description_id;
						$request_pic_contract_request_description_name = $R1->request_pic_contract_request_description_name;
						$employee_in_id = $R1->employee_in_id;
						$request_employee_in_name = $R1->request_employee_in_name;
						$division_id = $R1->division_id;
						$request_division_name = $R1->request_division_name;
						$functions_id = $R1->functions_id;
						$request_functions_name = $R1->request_functions_name;
						$cost_category_id = $R1->cost_category_id;
						$vendor_id = $R1->vendor_id;
						$request_cost_category_name = $R1->request_cost_category_name;
						$request_source_id = $R1->request_source_id;
						$request_source_code = $R1->request_source_code;
						$request_source_code_description = $R1->request_source_code_description;
						$request_used_date = $R1->request_used_date;
						$request_currency = $R1->request_currency;
						$request_grandtotal_estimate = $R1->request_grandtotal_estimate;
						$request_note = $R1->request_note;
						$request_approval_employee_in_id = $R1->request_approval_employee_in_id;
						$request_approval_employee_in_name = $R1->request_approval_employee_in_name;
						$request_approval_level = $R1->request_approval_level;
						$request_process_employee_in_id = $R1->request_process_employee_in_id;
						$request_process_employee_in_name = $R1->request_process_employee_in_name;
						$request_process_document = $R1->request_process_document;
						$request_status = $R1->request_status;
						$request_status_information = $R1->request_status_information;
						$request_status_legal = $R1->request_status_legal;
						$request_proc_employee_in_id = $R1->request_proc_employee_in_id;
						$request_proc_employee_in_name = $R1->request_proc_employee_in_name;
						$request_is_finish = $R1->request_is_finish;
						$request_is_finish_date = $R1->request_is_finish_date;
						$request_is_delete = $R1->request_is_delete;
						$request_created_by = $R1->request_created_by;
						$request_created_date = $R1->request_created_date;
						$request_modified_by = $R1->request_modified_by;
						$request_modified_date = $R1->request_modified_date;
						$request_vendor_name = $R1->request_vendor_name;
					}else{
						$request_id = '';
						$request_code = '';
						$request_category_name = '';
						$request_type_name = '';
						$request_pic_contract_id = '';
						$request_pic_contract_name = '';
						$request_pic_contract_approval_id = '';
						$request_pic_contract_approval_name = '';
						$request_pic_contract_request_id = '';
						$request_pic_contract_request_name = '';
						$request_pic_contract_request_description_id = '';
						$request_pic_contract_request_description_name = '';
						$employee_in_id = '';
						$request_employee_in_name = '';
						$division_id = '';
						$request_division_name = '';
						$functions_id = '';
						$request_functions_name = '';
						$cost_category_id = '';
						$vendor_id = '';
						$request_cost_category_name = '';
						$request_source_id = '';
						$request_source_code = '';
						$request_source_code_description = '';
						$request_used_date = '';
						$request_currency = '';
						$request_grandtotal_estimate = '';
						$request_note = '';
						$request_approval_employee_in_id = '';
						$request_approval_employee_in_name = '';
						$request_approval_level = '';
						$request_process_employee_in_id = '';
						$request_process_employee_in_name = '';
						$request_process_document = '';
						$request_status = '';
						$request_status_information = '';
						$request_status_legal = '';
						$request_proc_employee_in_id = '';
						$request_proc_employee_in_name = '';
						$request_is_finish = '';
						$request_is_finish_date = '';
						$request_is_delete = '';
						$request_created_by = '';
						$request_created_date = '';
						$request_modified_by = '';
						$request_modified_date = '';
						$request_vendor_name = '';
					}
				?>
				<?php
					if($this->input->get('view') == 'manipulation'){
				?>
				<div class="row">
					<div class="col-md-12">
						<div class="ibox float-e-margins">
							<div class="ibox-title">
								<h4><?php echo strtoupper(str_replace('_',' ',$this->uri->segment(3))); ?></h4>
							</div>
							<div class="ibox-content">
								<form method="post" class="form-horizontal" action="<?php echo site_url('module_procurement/admin_functions/request/'.$this->input->get('action').'/'.$this->input->get('request_id').'/'); ?>" enctype="multipart/form-data">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" required="">
									<h4>Data Pemohon</h4>
									<div class="form-group">
										<label class="col-md-3 control-label">Nama Pemohon <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<select class="form-control select2" name="employee_in_id" id="employee_in_id" required >
												<option selected value="">--Pilih--</option>
												<?php
													unset($datato);
													$datato['table'] = 'patlog__hrms.entity__employee_in';	
													$datato['where_in'] = array(
														'patlog__hrms.entity__employee_in.employee_in_position',
														'patlog__hrms.entity__employee_in.employee_in_status',
													);
													$datato['where_in_data'] = array(
														array('Staf','Supervisor'),
														array('Aktif')
													);
													$Q1 = $this->view->view_data($datato);
													foreach($Q1->result() as $R1){
														if($R1->employee_in_id == $employee_in_id){
															$selected = 'selected';
														}else{
															$selected = '';
														}
												?>
												<option value="<?php echo urlencode($R1->employee_in_id); ?>" <?php echo $selected; ?>><?php echo $R1->employee_in_code; ?> | <?php echo $R1->employee_in_name; ?></option>
												<?php
													}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Divisi <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" id="division_name" placeholder="Divisi" value="<?php echo $request_division_name; ?>" required onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Fungsi <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" id="functions_name" placeholder="Fungsi" value="<?php echo $request_functions_name; ?>" required onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">PIC Modul Kontrak <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<select class="form-control select2" name="request_pic_contract_id" id="request_pic_contract_id" required >
												<option selected value="">--Pilih--</option>
												<?php
													unset($datato);
													$datato['table'] = 'patlog__hrms.entity__employee_in';	
													$datato['where_in'] = array(
														'patlog__hrms.entity__employee_in.division_id',
														'patlog__hrms.entity__employee_in.employee_in_position',
														'patlog__hrms.entity__employee_in.employee_in_status',
													);
													$datato['where_in_data'] = array(
														array($division_id),
														array('Staf','Supervisor'),
														array('Aktif')
													);
													$Q1 = $this->view->view_data($datato);
													foreach($Q1->result() as $R1){
														if($request_pic_contract_id == $R1->employee_in_id){
															$selected = 'selected';
														}else{
															$selected = '';
														}
												?>
												<option value="<?php echo urlencode($R1->employee_in_id); ?>" <?php echo $selected; ?>><?php echo $R1->employee_in_code; ?> | <?php echo $R1->employee_in_name; ?></option>
												<?php
													}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Approval Modul Kontrak <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<select class="form-control select2" name="request_pic_contract_approval_id" id="request_pic_contract_approval_id" required >
												<option selected value="">--Pilih--</option>
												<?php
													unset($datato);
													$datato['table'] = 'patlog__config.entity__approval';
													$datato['where'] = array(
														'patlog__config.entity__approval.division_id' => $division_id,
														'patlog__config.entity__approval.approval_type_id' => 3
													);
													$datato['order'] = array(
														'patlog__config.entity__approval.approval_name'
													);
													$datato['order_type'] = array(
														'asc'
													);
													$Q1 = $this->view->view_data($datato);
													foreach($Q1->result() as $R1){
														if($request_pic_contract_approval_id == $R1->approval_id){
															$selected = 'selected';
														}else{
															$selected = '';
														}
												?>
												<option value="<?php echo urlencode($R1->approval_id); ?>" <?php echo $selected; ?>><?php echo $R1->approval_name; ?></option>
												<?php
													}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Jenis Permintaan Kontrak <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<select class="form-control select2" name="request_pic_contract_request_id" id="request_pic_contract_request_id" style="width:100%;" required>
												<option selected disabled value="">--Pilih--</option>
												<?php
													unset($datato);
													$datato['table'] = 'patlog__contract.entity__request';
													$datato['order'] = array(
														'patlog__contract.entity__request.request_name'
													);
													$datato['order_type'] = array(
														'asc'
													);
													$Q1 = $this->view->view_data($datato);
													foreach($Q1->result() as $R1){
														if($request_pic_contract_request_id == $R1->request_id){
															$selected = 'selected';
														}else{
															$selected = '';
														}
												?>
												<option value="<?php echo urlencode($R1->request_id); ?>" <?php echo $selected; ?>><?php echo $R1->request_name; ?></option>
												<?php
													}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Deskripsi Permintaan Kontrak <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<select class="form-control select2" name="request_pic_contract_request_description_id" id="request_pic_contract_request_description_id" style="width:100%;" required>
												<option selected disabled value="">--Pilih--</option>
												<?php
													unset($datato);
													$datato['table'] = 'patlog__contract.entity__request_description';
													$datato['where'] = array(
														'patlog__contract.entity__request_description.request_id' => $request_pic_contract_request_id
													);
													$datato['order'] = array(
														'patlog__contract.entity__request_description.request_description_name'
													);
													$datato['order_type'] = array(
														'asc'
													);
													$Q1 = $this->view->view_data($datato);
													foreach($Q1->result() as $R1){
														if($request_pic_contract_request_description_id == $R1->request_description_id){
															$selected = 'selected';
														}else{
															$selected = '';
														}
												?>
												<option value="<?php echo urlencode($R1->request_description_id); ?>" <?php echo $selected; ?>><?php echo $R1->request_description_name; ?></option>
												<?php
													}
												?>
											</select>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<h4>Data Permintaan</h4>
									<div class="form-group">
										<label class="col-md-3 control-label">Metode <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<select class="form-control select2" name="request_category_name" style="width:100%;" required >
												<option selected value="">-Pilih--</option>
												<?php
													unset($datato);
													$datato['table'] = 'patlog__procurement.data__category';
													$Q1 = $this->view->view_data($datato);
													foreach($Q1->result() as $R1){
												?>
												<option value="<?php echo urlencode($R1->category_name); ?>" <?php if($request_category_name == $R1->category_name){ echo 'selected'; } ?>><?php echo $R1->category_name; ?></option>
												<?php
													}
												?>											
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Jenis Permintaan <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<select class="form-control select2" name="request_type_name" style="width:100%;" required >
												<option selected value="">-Pilih--</option>
												<?php
													unset($datato);
													$datato['table'] = 'patlog__procurement.data__item_category';
													$Q1 = $this->view->view_data($datato);
													foreach($Q1->result() as $R1){
												?>
												<option value="<?php echo urlencode($R1->item_category_name); ?>" <?php if($request_type_name == $R1->item_category_name){ echo 'selected'; } ?>><?php echo $R1->item_category_name; ?></option>
												<?php
													}
												?>		
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Tipe Kode <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<select class="form-control select2" name="cost_category_id" id="cost_category_id" style="width:100%;" required >
												<option selected value="">--Pilih--</option>
												<?php
													unset($datato);
													$datato['table'] = 'patlog__procurement.data__cost_category';
													$Q1 = $this->view->view_data($datato);
													foreach($Q1->result() as $R1){
														if($R1->cost_category_id == $cost_category_id){
															$selected = 'selected';
														}else{
															$selected = '';
														}
												?>
												<option value="<?php echo urlencode($R1->cost_category_id); ?>" <?php echo $selected; ?>><?php echo $R1->cost_category_name; ?></option>
												<?php
													}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Kode Proyek/Cost Center <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<select class="form-control select2" name="type_code_id" id="type_code_id" style="width:100%;" required >
												<option selected value="">--Pilih--</option>	
												<?php
													if($cost_category_id == 1){
														unset($datato);
														$datato['table'] = 'patlog__project.entity__cost_center';
														$datato['order'] = array(
															'patlog__project.entity__cost_center.cost_center_name'
														);
														$datato['order_type'] = array(
															'asc'
														);
														$Q1 = $this->view->view_data($datato);
														foreach($Q1->result() as $R1){
															if($R1->cost_center_id == $request_source_id){
																$selected = 'selected';
															}else{
																$selected = '';
															}
												?>
												<option value="<?php echo urlencode($R1->cost_center_id); ?>" <?php echo $selected; ?>><?php echo $R1->cost_center_name; ?> | <?php echo $R1->cost_center_description; ?></option>
												<?php
														}
													}elseif($cost_category_id == 2){
														unset($datato);
														$datato['table'] = 'patlog__project.entity__project_code';
														$datato['order'] = array(
															'patlog__project.entity__project_code.project_code_name'
														);
														$datato['order_type'] = array(
															'asc'
														);
														$Q1 = $this->view->view_data($datato);
														foreach($Q1->result() as $R1){
															if($R1->project_code_id == $request_source_id){
																$selected = 'selected';
															}else{
																$selected = '';
															}
												?>
												<option value="<?php echo urlencode($R1->project_code_id); ?>" <?php echo $selected; ?>><?php echo $R1->project_code_name; ?> | <?php echo $R1->project_code_description; ?></option>
												<?php
														}
													}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Due Date <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control date" name="request_used_date" placeholder="Due Date" value="<?php echo $request_used_date; ?>" onfocus="blur();" required />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Mata Uang <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<select class="form-control select2" name="request_currency" style="width:100%;" required >
												<option selected disabled value="">--Pilih--</option>
												<?php
													unset($datato);
													$datato['table'] = 'patlog__value.entity__country';
													$datato['where'] = array(
														'patlog__value.entity__country.country_name' => 'Indonesia'
													);
													$datato['or_where'] = array(
														'patlog__value.entity__country.country_name' => 'American Samoa'
													);
													$datato['order'] = array(
														'patlog__value.entity__country.country_currency_code'
													);
													$datato['order_type'] = array(
														'asc'
													);
													$Q1 = $this->view->view_data($datato);
													foreach($Q1->result() as $R1){
														if($R1->country_currency_code == $request_currency){
															$selected = 'selected';
														}else{
															$selected = '';
														}
												?>
												<option value="<?php echo urlencode($R1->country_currency_code); ?>" <?php echo $selected; ?>><?php echo $R1->country_currency_code; ?></option>
												<?php
													}
												?>
											</select>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<h4>Item Permintaan</h4>
									<div class="form-group" id="form-request">
										<div class="col-md-12">
											<div class="row-fluid clearfix hidden-xs">
												<div class="col-md-4 p-xxs">
													<label>Nama Barang/Jasa</label>
												</div>
												<div class="col-md-3 p-xxs">
													<label>Jumlah/Unit/Harga</label>
												</div>
												<div class="col-md-3 p-xxs">
													<label>Spesifikasi/Dokumen</label>
												</div>
											</div>
											<?php
												$i = 0;
												unset($datato);
												$datato['table'] = 'patlog__procurement.entity__request_det';
												$datato['where'] = array(
													'patlog__procurement.entity__request_det.request_id' => $request_id
												);
												$Q1 = $this->view->view_data($datato);
												foreach($Q1->result() as $R1){
											?>
											<div class="row-fluid clearfix">
												<div class="col-md-4 p-xxs">
													<textarea class="form-control" name="request_det_item[]" placeholder="Nama Barang/Jasa" rows="3" maxlength="250" oninvalid="Ladda.stopAll()"><?php echo $R1->request_det_item; ?></textarea>
												</div>
												<div class="col-md-3 p-xxs">
													<div class="row">
														<div class="col-md-6 m-b-xs">
															<input type="number" class="form-control" name="request_det_qty[]" placeholder="Jumlah Barang/Jasa" value="<?php echo $R1->request_det_qty; ?>" oninvalid="Ladda.stopAll()" required />
														</div>
														<div class="col-md-6 m-b-xs">
															<select class="form-control select2" name="request_det_unit[]" onchange="onItem(this);" oninvalid="Ladda.stopAll()" style="width:100%;" required >
																<option selected disabled value="">--Unit--</option>
																<?php
																	unset($datato);
																	$datato['table'] = 'patlog__procurement.data__unit';
																	$Q2 = $this->view->view_data($datato);
																	foreach($Q2->result() as $R2){
																		if($R2->unit_id == $R1->unit_id){
																			$selected = 'selected';
																		}else{
																			$selected = '';
																		}
																?>
																<option value="<?php echo urlencode($R2->unit_id); ?>" <?php echo $selected; ?>><?php echo $R2->unit_name; ?></option>
																<?php
																	}
																?>
															</select>
														</div>
														<div class="col-md-12 m-b-xs">
															<input type="number" class="form-control" name="request_det_estimate_price[]" placeholder="Harga Satuan" value="<?php echo $R1->request_det_estimate_price; ?>" oninvalid="Ladda.stopAll()" required />
														</div>
														<div class="col-md-12 m-b-xs">
															<input type="text" class="form-control" name="request_det_subtotal[]" placeholder="Total Harga" value="<?php echo ($R1->request_det_qty * $R1->request_det_estimate_price); ?>" onfocus="blur();" />
														</div>
													</div>
												</div>
												<div class="col-md-4 p-xxs">
													<div class="row">
														<div class="col-md-12 m-b-xs">
															<textarea class="form-control" name="request_det_note[]" placeholder="Spesifikasi" rows="3" maxlength="250" oninvalid="Ladda.stopAll()"><?php echo $R1->request_det_note; ?></textarea>
														</div>
														<div class="col-md-12 m-b-xs">
															<input type="file" class="form-control" name="request_det_attachment[]" accept=".pdf" />	
														</div>
													</div>
												</div>
												<div class="col-md-1 p-xxs">
													<a class="btn btn-default btn-md" href="<?php echo base_url('assets/mod__procurement/attach/request/'.$R1->request_det_attachment.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i>
													</a>
													<?php
														if($i != 0){
													?>
													<a class="btn btn-danger btn-md delete" data-name="det" data-toggle="modal" data-target="#confirm" id="delete_det_<?php echo $R1->request_det_id; ?>">
														<i class="fa fa-trash"></i>
													</a>
													<?php
														}
													?>
													<input type="hidden" name="request_det_id[]" value="<?php echo $R1->request_det_id; ?>" required />
												</div>
											</div>
											<?php
													$i++;
												}
											?>
											<div class="input_fields_wrap"></div>
											<div class="row-fluid clearfix">
												<div class="col-md-4 p-xxs">
													<textarea class="form-control" placeholder="Nama Barang/Jasa" rows="3" disabled></textarea>
												</div>
												<div class="col-md-3 p-xxs">
													<div class="row">
														<div class="col-md-6 m-b-xs">
															<input type="text" class="form-control" placeholder="Jumlah" disabled />
														</div>
														<div class="col-md-6 m-b-xs">
															<select class="form-control select2" style="width:100%;" disabled >
																<option selected disabled value="">--Unit--</option>
																
															</select>
														</div>
														<div class="col-md-12 m-b-xs">
															<input type="text" class="form-control" placeholder="Harga" disabled />
														</div>
														<div class="col-md-12 m-b-xs">
															<input type="text" class="form-control" placeholder="Total Harga" disabled />
														</div>
													</div>
												</div>
												<div class="col-md-4 p-xxs">
													<div class="row">
														<div class="col-md-12 m-b-xs">
															<textarea class="form-control" placeholder="Spesifikasi" rows="3" disabled></textarea>
														</div>
														<div class="col-md-12 m-b-xs">
															<input type="file" class="form-control" disabled />
														</div>
													</div>
												</div>
												<div class="col-md-1 p-xxs">
													<a class="btn btn-default btn-md disabled">
														<i class="fa fa-eye"></i>
													</a>
													<button type="button" class="btn btn-md btn-primary btn-file add_field_button">
														<i class="fa fa-plus"></i>
													</button>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">Grand Total (Estimasi Harga)</label>
										<div class="col-md-7">
											<input type="text" class="form-control text-right" id="request_total" placeholder="0" value="<?php echo $request_grandtotal_estimate; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<h4>Dokumen Pendukung</h4>
									<?php
										$i = 0;
										unset($datato);
										$datato['table'] = 'patlog__procurement.entity__request_document';
										$datato['where'] = array(
											'patlog__procurement.entity__request_document.request_id' => $request_id
										);
										$datato['order'] = array(
											'patlog__procurement.entity__request_document.request_document_order'
										);
										$datato['order_type'] = array(
											'asc'
										);
										$Q1 = $this->view->view_data($datato);
										foreach($Q1->result() as $R1){
											if($R1->request_document_mandatory == 'yes'){
												if($R1->request_document_file != 'no.pdf'){
													$required = '';
												}else{
													$required = 'required';
												}
												$detail = '<span class="text-danger small">(wajib)</span>';
											}else{
												$required = '';
												$detail = '<span class="text-warning small">(opsional)</span>';
											}
									?>
									<div class="form-group">
										<label class="col-md-3 control-label"><?php echo $R1->request_document_name; ?> <?php echo $detail; ?></label>
										<div class="col-md-7">
											<input type="file" class="form-control" name="request_document_file[<?php echo $i; ?>]" accept="<?php echo $R1->request_document_mimes; ?>" <?php echo $required; ?>/>
											<input type="hidden" name="request_document_id[<?php echo $i; ?>]" value="<?php echo $R1->request_document_id; ?>" />
										</div>
										<div class="col-md-2">
											<?php
												if($R1->request_document_file != 'no.pdf'){
											?>
											<a class="btn btn-default btn-md" href="<?php echo base_url('assets/mod__procurement/attach/request-document-file/'.$R1->request_document_file.'?time='.date('YmdHis')); ?>" target="_blank">
												<i class="fa fa-eye"></i>
											</a>
											<?php
												}
											?>
										</div>
									</div>
									<?php
											$i++;
										}
									?>
									<div class="hr-line-dashed"></div>
									<div class="form-group" id="form-attachment">
										<label class="col-md-3 control-label">Dokumen Tambahan</label>
										<div class="col-md-9">
											<div class="row-fluid clearfix hidden-xs">
												<div class="col-md-5 p-xxs">
													<label>Nama Dokumen</label>
												</div>
												<div class="col-md-5 p-xxs">
													<label>Upload Dokumen</label>
												</div>
												<div class="col-md-2 p-xxs">
												
												</div>
											</div>
											<div class="input_fields_wrap2">
												<?php
													$i = 0;
													unset($datato);
													$datato['table'] = 'patlog__procurement.entity__request_attachment';
													$datato['where'] = array(
														'patlog__procurement.entity__request_attachment.request_id' => $request_id
													);
													$Q1 = $this->view->view_data($datato);
													foreach($Q1->result() as $R1){
 												?>
												<div class="row-fluid clearfix">
													<div class="col-md-5 p-xxs">
														<input type="text" name="request_attachment_name[]" oninvalid="Ladda.stopAll()" class="form-control" placeholder="Nama Dokumen" value="<?php echo $R1->request_attachment_name; ?>" />
													</div>
													<div class="col-md-5 p-xxs">
														<input type="file" name="request_attachment_file[]" oninvalid="Ladda.stopAll()" class="form-control" />
													</div>
													<div class="col-md-2 p-xxs">
														<a class="btn btn-default btn-md" href="<?php echo base_url('assets/mod__procurement/attach/request-attachment-file/'.$R1->request_attachment_file.'?time='.date('YmdHis')); ?>" target="_blank">
															<i class="fa fa-eye"></i>
														</a>
														<?php
															// if($i != 0){
														?>
														<a class="btn btn-danger btn-md delete" data-name="attachment" data-toggle="modal" data-target="#confirm" id="delete_attachment_<?php echo $R1->request_attachment_id; ?>">
															<i class="fa fa-trash"></i>
														</a>
														<?php
															// }
														?>
														<input type="hidden" name="request_attachment_id[]" value="<?php echo $R1->request_attachment_id; ?>" required />
													</div>
												</div>
												<?php
														$i++;
													}
												?>
											</div>
											<div class="row-fluid clearfix">
												<div class="col-md-5 p-xxs">
													<input type="text" class="form-control" placeholder="Nama Dokumen" disabled />
												</div>
												<div class="col-md-5 p-xxs">
													<input type="file" class="form-control" placeholder="File" disabled />
												</div>
												<div class="col-md-2 p-xxs">
													<a class="btn btn-default btn-md disabled">
														<i class="fa fa-eye"></i>
													</a>
													<button type="button" class="btn btn-md btn-primary btn-file add_field_button2">
														<i class="fa fa-plus"></i>
													</button>
												</div>
											</div>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-3 control-label">Catatan/Deskripsi Pekerjaan <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<textarea class="form-control" name="request_note" placeholder="Catatan/Deskripsi Pekerjaan" rows="3" maxlength="1000" required><?php echo $request_note; ?></textarea>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<h4>Informasi Approval</h4>
									<div id="vertical-timeline" class="vertical-container dark-timeline approver_level">										
										<div class="vertical-timeline-block">
											<div class="vertical-timeline-icon default-bg">
												<i class="fa fa-ellipsis-h"></i>
											</div>
											<div class="vertical-timeline-content">
												<p class="text-default">Data tidak ditemukan.</p>
												<span class="vertical-date small text-default ">-</span>
											</div>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<div class="col-md-4 col-md-offset-3">
											<button class="btn btn-primary" type="submit">Simpan</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
				<script type="text/javascript">
					
					$(".select2").select2({
						theme: "bootstrap"
					});
					
					$('.date').datepicker({
						format: "yyyy-mm-dd",
						startView: 2,
						maxViewMode: 2,
						todayBtn: "linked",
						language: "id",
						keyboardNavigation: false,
						forceParse: false,
						autoclose: true,
						todayHighlight: true
					});
					
					$(document).ready(function () {
						$.ajax({
							type: 'POST',
							data: {
								'employee_in_id' : $("#employee_in_id").val(),
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							url: "<?php echo site_url(); ?>module_procurement/admin_functions/get_input_employee/",
							success: function(result){
								var data = JSON.parse(result);
								$("#division_name").val(data['division_name']);
								$("#functions_name").val(data['functions_name']);
								$(".approver_level").html(data['approver_level']);
							}
						});
					});
					
					$("#employee_in_id").change(function(){
						$.ajax({
							type: 'POST',
							data: {
								'employee_in_id' : $("#employee_in_id").val(),
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							url: "<?php echo site_url(); ?>module_procurement/admin_functions/get_input_employee/",
							success: function(result){
								var data = JSON.parse(result);
								$("#division_name").val(data['division_name']);
								$("#functions_name").val(data['functions_name']);
								$(".approver_level").html(data['approver_level']);
								$("#request_pic_contract_id").val('').trigger('change');
								$("#request_pic_contract_id").html(data['request_pic_contract_id']);
								$("#request_pic_contract_approval_id").val('').trigger('change');
							}
						});
					});
					
					$("#request_pic_contract_id").change(function(){
						$.ajax({
							type: 'POST',
							data: {
								'request_pic_contract_id' : $("#request_pic_contract_id").val(),
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							url: "<?php echo site_url(); ?>module_procurement/admin_functions/get_dropdown_approval_contract/",
							success: function(result){
								var data = JSON.parse(result);
								$("#request_pic_contract_approval_id").val('').trigger('change');
								$("#request_pic_contract_approval_id").html(data['request_pic_contract_approval_id']);
							}
						});
					});
					
					$("#request_pic_contract_request_id").change(function(){
						$.ajax({
							type: 'POST',
							data: {
								contract_request_id: $("#request_pic_contract_request_id").val(),
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							url: "<?php echo site_url(); ?>module_procurement/admin_functions/get_dropdown_request_description/",
							success: function(result){
								var data = JSON.parse(result);
								$('#request_pic_contract_request_description_id').val('').trigger('change');
								$("#request_pic_contract_request_description_id").html(data['contract_request_description_id']);
							}
						});
					});
					
					$("#cost_category_id").change(function(){
						$.ajax({
							type: 'POST',
							data: {
								'cost_category_id' : $("#cost_category_id").val(),
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							url: "<?php echo site_url(); ?>module_procurement/admin_functions/get_dropdown_type_code/",
							success: function(result){
								var data = JSON.parse(result);
								$("#type_code_id").val('').trigger('change');
								$("#type_code_id").html(data['type_code_id']);
							}
						});
					});
					
					$("#form-request").change(function(){
						var request_total = 0;
						var request_det_qty = document.getElementsByName("request_det_qty[]");
						var request_det_estimate_price = document.getElementsByName("request_det_estimate_price[]");
						var request_det_subtotal = document.getElementsByName("request_det_subtotal[]");
						for(var i=0;i<request_det_qty.length;i++){
							request_subotal = parseInt(request_det_qty[i].value) * parseInt(request_det_estimate_price[i].value);
							if(isNaN(request_subotal) == true){
								request_subotal = 'Total Harga';
							}
							request_det_subtotal[i].value = request_subotal;
							request_total = parseInt(request_total) + (parseInt(request_det_qty[i].value) * parseInt(request_det_estimate_price[i].value));
						}
						if(isNaN(request_total) == true){
							request_total = 'Grand Total';
						}
						$("#request_total").val(request_total);
					});

					var wrapper = $(".input_fields_wrap");
					var add_button = $(".add_field_button");
					$(add_button).click(function(e){
						e.preventDefault();
						$(wrapper).append('<div class="col-md-12"><div class="row clearfix" style="margin-bottom:10px;">'
						+	'<div class="col-md-4 p-xxs">'
							+	'<textarea class="form-control" name="request_det_item[]" placeholder="Nama Barang/Jasa" rows="3" maxlength="1000" oninvalid="Ladda.stopAll()"></textarea>'
						+	'</div>'
						+	'<div class="col-md-3 p-xxs">'
							+	'<div class="row">'
								+	'<div class="col-md-6 m-b-xs">'
									+	'<input type="number" class="form-control" name="request_det_qty[]" placeholder="Jumlah Barang/Jasa" oninvalid="Ladda.stopAll()" required />'
								+	'</div>'
								+	'<div class="col-md-6 m-b-xs">'
									+	'<select class="form-control select2" name="request_det_unit[]" onchange="onItem(this);" oninvalid="Ladda.stopAll()" style="width:100%;" required >'
										+	'<option selected disabled value="">--Unit--</option>'
											<?php
												unset($datato);
												$datato['table'] = 'patlog__procurement.data__unit';
												$Q1 = $this->view->view_data($datato);
												foreach($Q1->result() as $R1){
											?>
										+	'<option value="<?php echo urlencode($R1->unit_id); ?>"><?php echo $R1->unit_name; ?></option>'
											<?php
												}
											?>
										+	'</select>'
								+	'</div>'
								+	'<div class="col-md-12 m-b-xs">'
									+	'<input type="number" class="form-control" name="request_det_estimate_price[]" placeholder="Harga Satuan" oninvalid="Ladda.stopAll()" required />'
								+	'</div>'
								+	'<div class="col-md-12 m-b-xs">'
									+	'<input type="text" class="form-control" name="request_det_subtotal[]" placeholder="Total Harga" onfocus="blur();" />'
								+	'</div>'
							+	'</div>'
						+	'</div>'
						+	'<div class="col-md-4 p-xxs">'
							+	'<div class="row">'
								+	'<div class="col-md-12 m-b-xs">'
									+	'<textarea class="form-control" name="request_det_note[]" placeholder="Spesifikasi" rows="3" maxlength="1000" oninvalid="Ladda.stopAll()"></textarea>'
								+	'</div>'
								+	'<div class="col-md-12 m-b-xs">'
									+	'<input type="file" class="form-control" name="request_det_attachment[]" accept=".pdf" />'
								+	'</div>'
							+	'</div>'
						+	'</div>'
						+	'<div class="col-md-1 p-xxs">'
							+	'<button type="button" class="btn btn-danger btn-md remove_field">'
								+	'<i class="fa fa-minus"></i>'
							+	'</button>'
						+	'</div></div></div>'
						+	'<script type="text/javascript">'
							+	'$(".select2").select2({'
								+ 	'theme: "bootstrap"'
							+	'});');
					});
					
					$(wrapper).on("click",".remove_field", function(e){
						e.preventDefault();
						$(this).parent('div').parent('div').remove();

						var request_total = 0;
						var request_det_qty = document.getElementsByName("request_det_qty[]");
						var request_det_estimate_price = document.getElementsByName("request_det_estimate_price[]");
						var request_det_subtotal = document.getElementsByName("request_det_subtotal[]");
						for(var i=0;i<request_det_qty.length;i++){
							request_subotal = parseInt(request_det_qty[i].value) * parseInt(request_det_estimate_price[i].value);
							if(isNaN(request_subotal) == true){
								request_subotal = 'Total Harga';
							}
							request_det_subtotal[i].value = request_subotal;
							request_total = parseInt(request_total) + (parseInt(request_det_qty[i].value) * parseInt(request_det_estimate_price[i].value));
						}
						if(isNaN(request_total) == true){
							request_total = 'Grand Total';
						}
						$("#request_total").val(request_total);
					});

					function onItem(obj){
						$.ajax({
							type: 'POST',
							data: {
								'request_det_item' : obj.value,
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							url: "<?php echo site_url(); ?>module_procurement/admin_functions/get_input_item/",
							success: function(result){
								var data = JSON.parse(result);
								// obj.parentElement.nextElementSibling.children[0].childNodes[3].firstElementChild.value = data['item_unit'];
								// obj.parentElement.nextElementSibling.children[0].childNodes[5].firstElementChild.value = data['item_price'];
								
								var request_total = 0;
								var request_det_qty = document.getElementsByName("request_det_qty[]");
								var request_det_estimate_price = document.getElementsByName("request_det_estimate_price[]");
								var request_det_subtotal = document.getElementsByName("request_det_subtotal[]");
								for(var i=0;i<request_det_qty.length;i++){
									request_subotal = parseInt(request_det_qty[i].value) * parseInt(request_det_estimate_price[i].value);
									if(isNaN(request_subotal) == true){
										request_subotal = 'Total Harga';
									}
									request_det_subtotal[i].value = request_subotal;
									request_total = parseInt(request_total) + (parseInt(request_det_qty[i].value) * parseInt(request_det_estimate_price[i].value));
								}
								if(isNaN(request_total) == true){
									request_total = 'Grand Total';
								}
								$("#request_total").val(request_total);
							}
						});
					}
					
					function onItem2(obj){
						$.ajax({
							type: 'POST',
							data: {
								'request_det_item' : obj.value,
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							url: "<?php echo site_url(); ?>module_procurement/admin_functions/get_input_item/",
							success: function(result){
								var data = JSON.parse(result);
								// obj.parentElement.nextElementSibling.children[0].childNodes[1].firstElementChild.value = data['item_unit'];
								// obj.parentElement.nextElementSibling.children[0].childNodes[2].firstElementChild.value = data['item_price'];
								
								var request_total = 0;
								var request_det_qty = document.getElementsByName("request_det_qty[]");
								var request_det_estimate_price = document.getElementsByName("request_det_estimate_price[]");
								var request_det_subtotal = document.getElementsByName("request_det_subtotal[]");
								for(var i=0;i<request_det_qty.length;i++){
									request_subotal = parseInt(request_det_qty[i].value) * parseInt(request_det_estimate_price[i].value);
									if(isNaN(request_subotal) == true){
										request_subotal = 'Total Harga';
									}
									request_det_subtotal[i].value = request_subotal;
									request_total = parseInt(request_total) + (parseInt(request_det_qty[i].value) * parseInt(request_det_estimate_price[i].value));
								}
								if(isNaN(request_total) == true){
									request_total = 'Grand Total';
								}
								$("#request_total").val(request_total);
							}
						});
					}
					
					var wrapper2 = $(".input_fields_wrap2");
					var add_button2 = $(".add_field_button2");
					$(add_button2).click(function(e){
						e.preventDefault();
						$(wrapper2).append('<div class="col-md-12"><div class="row clearfix" style="margin-bottom:10px;">'
						+	'<div class="col-md-5 p-xxs">'
							+	'<input type="text" class="form-control" name="request_attachment_name[]" oninvalid="Ladda.stopAll()" placeholder="Nama Dokumen" required />'
						+	'</div>'
						+	'<div class="col-md-5 p-xxs">'
							+	'<input type="file" class="form-control" name="request_attachment_file[]" oninvalid="Ladda.stopAll()" required />'
						+	'</div>'
						+	'<div class="col-md-2 p-xxs">'
							+	'<button type="button" class="btn btn-danger btn-md remove_field2">'
								+	'<i class="fa fa-minus"></i>'
							+	'</button>'
						+	'</div></div></div>'
						+	'<script type="text/javascript">'
							+	'$(".select2").select2({'
								+ 	'theme: "bootstrap"'
							+	'});');
					});
					
					$(wrapper2).on("click",".remove_field2", function(e){
						e.preventDefault();
						$(this).parent('div').parent('div').remove();
					});
					
					$(document).on('click','.delete',function(e){
						e.preventDefault();
						$('#confirm_str').html('Apakah anda yakin ingin menghapus data ini?');
						$('#delete').show();
						$('#delete_all').hide();
						var name = $(this).data("name");
						$('#from').val(name);
						if(name == 'det'){
							var id=this.id.substr(11);
							$('#id').val(id);
						}else if(name == 'attachment'){
							var id=this.id.substr(18);
							$('#id').val(id);
						}
					});
					
					$(document).on('click','#delete',function(e){
						e.preventDefault();
						if($('#from').val() == 'det'){
							$("#delete_det_"+$('#id').val()).parent().parent().remove();
							
							$.ajax({
								type: 'POST',
								data: {
									request_det_id : $('#id').val(),
									"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
								},
								url: "<?php echo site_url(); ?>module_procurement/admin_functions/request_det/delete/",
								success: function(result){
									$('#confirm').modal('hide');
									$('#modal_detail').modal('show');
									$('.isi').html(''
										+ 	'<div class="modal-header">'
											+	'<button class="close" data-dismiss="modal">'
												+	'&times;'
											+	'</button>'
											+	'<h4 class="modal-title">Notifikasi</h4>'
										+	'</div>'
										+	'<div class="modal-body alert-success">'
											+	'Data berhasil dihapus'
										+	'</div>'
										+	'<div class="modal-footer">'
											+	'<button class="btn btn-default" data-dismiss="modal"> Tutup</button>'
										+	'</div>'
									+	'');
								}
							});
						}else if($('#from').val() == 'attachment'){
							$("#delete_attachment_"+$('#id').val()).parent().parent().remove();
							
							$.ajax({
								type: 'POST',
								data: {
									request_attachment_id : $('#id').val(),
									"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
								},
								url: "<?php echo site_url(); ?>module_procurement/admin_functions/request_attachment/delete/",
								success: function(result){
									$('#confirm').modal('hide');
									$('#modal_detail').modal('show');
									$('.isi').html(''
										+ 	'<div class="modal-header">'
											+	'<button class="close" data-dismiss="modal">'
												+	'&times;'
											+	'</button>'
											+	'<h4 class="modal-title">Notifikasi</h4>'
										+	'</div>'
										+	'<div class="modal-body alert-success">'
											+	'Data berhasil dihapus'
										+	'</div>'
										+	'<div class="modal-footer">'
											+	'<button class="btn btn-default" data-dismiss="modal"> Tutup</button>'
										+	'</div>'
									+	'');
								}
							});
						}
					});
					
				</script>
				<?php
					}elseif($this->input->get('view') == 'preview'){
				?>
				<div class="row">
					<div class="col-md-12">
						<div class="ibox float-e-margins">
							<div class="ibox-title">
								<h4><?php echo strtoupper(str_replace('_',' ',$this->uri->segment(3))); ?></h4>
							</div>
							<div class="ibox-content">
								<div class="form-horizontal">
									<div class="form-group">
										<label class="col-md-3 control-label">Kode Permintaan</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Kode Permintaan" value="<?php echo $request_code; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<h4>Data Pemohon</h4>
									<div class="form-group">
										<label class="col-md-3 control-label">Nama Pemohon</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Nama Pemohon" value="<?php echo $request_employee_in_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Divisi</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Divisi" value="<?php echo $request_division_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Fungsi</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Fungsi" value="<?php echo $request_functions_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">PIC Modul Kontrak</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="PIC Modul Kontrak" value="<?php echo $request_pic_contract_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Approval Modul Kontrak</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Approval Modul Kontrak" value="<?php echo $request_pic_contract_approval_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Jenis Permintaan Kontrak</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Jenis Permintaan Kontrak" value="<?php echo $request_pic_contract_request_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Deskripsi Permintaan Kontrak</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Deskripsi Permintaan Kontrak" value="<?php echo $request_pic_contract_request_description_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<h4>Data Permintaan</h4>
									<div class="form-group">
										<label class="col-md-3 control-label">Metode</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Metode" value="<?php echo $request_category_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Jenis Permintaan</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Jenis Permintaan" value="<?php echo $request_type_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Tipe Kode</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Tipe Kode" value="<?php echo $request_cost_category_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Kode Proyek/Cost Center</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Kode Proyek/Cost Center" value="<?php echo $request_source_code; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Deskripsi Kode Proyek/Cost Center</label>
										<div class="col-md-9">
											<textarea class="form-control" placeholder="Deskripsi Kode Proyek/Cost Center" rows="3" maxlength="1000" onfocus="blur();" ><?php echo $request_source_code_description; ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Due Date</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Due Date" value="<?php echo $request_used_date; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Mata Uang</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Mata Uang" value="<?php echo $request_currency; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-3 control-label">Item Permintaan</label>
										<div class="col-md-9">
											<div class="table-responsive">
												<table class="display table-condensed nowrap" border="0">
													<thead>
														<tr>
															<th valign="top" align="center">No.</th>
															<th valign="top" align="center">Nama Barang/Jasa</th>
															<th valign="top" align="center">Jumlah</th>
															<th valign="top" align="center">Unit</th>
															<th valign="top" align="center">Estimasi Harga (IDR)</th>
															<th valign="top" align="center">Total (IDR)</th>
															<th valign="top" align="center">Spesifikasi</th>
															<th valign="top" align="center">Dokumen</th>
														</tr>
													</thead>
													<tbody>
														<?php
															$i = 0;
															unset($datato);														
															$datato['table'] = 'patlog__procurement.entity__request_det';																	
															$datato['where'] = array(
																'patlog__procurement.entity__request_det.request_id' => $request_id
															);
															$Q1 = $this->view->view_data($datato);
															if($Q1->num_rows()){
																foreach($Q1->result() as $R1){
														?>
														<tr>
															<td valign="top" align="left"><?php echo ($i+1).'.'; ?></td>
															<td valign="top" align="left"><?php echo $R1->request_det_item; ?></td>
															<td valign="top" align="center"><?php echo $R1->request_det_qty; ?></td>
															<td valign="top" align="left"><?php echo $R1->request_det_unit; ?></td>
															<td valign="top" align="right"><?php echo number_format($R1->request_det_estimate_price,0,',','.'); ?></td>
															<td valign="top" align="right"><?php echo number_format(($R1->request_det_qty * $R1->request_det_estimate_price),0,',','.'); ?></td>
															<td valign="top" align="left"><?php echo $R1->request_det_note; ?></td>
															<td valign="top">
																<div class="text-center">
																	<a href="<?php echo base_url('assets/mod__procurement/attach/request_document/'.$R1->request_det_attachment.'?time='.date('YmdHis')); ?>" class="btn btn-xs btn-default" target="_blank">
																		<i class="fa fa-eye"></i>
																	</a>
																</div>
															</td>
														</tr>
														<?php
																	$i++;
																}
															}else{
														?>
														<tr>
															<td colspan="9">
																<center>
																	Data tidak ditemukan.
																</center>
															</td>
														</tr>
														<?php
															}
														?>
													</body>
												</table>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Grand Total (Estimasi Harga)</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Grand Total (Estimasi Harga)" value="<?php echo number_format($request_grandtotal_estimate,0,',','.'); ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<?php
										unset($datato);
										$datato['table'] = 'patlog__procurement.entity__request_document';
										$datato['where'] = array(
											'patlog__procurement.entity__request_document.request_id' => $request_id,
											'patlog__procurement.entity__request_document.request_document_file != ' => 'no.pdf',
										);
										$Q1 = $this->view->view_data($datato);
										if($Q1->num_rows()){
											foreach($Q1->result() as $R1){
									?>
									<div class="form-group">
										<label class="col-md-3 control-label"><?php echo $R1->request_document_name; ?> <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/request-document-file/'.$R1->request_document_file.'?time='.date('YmdHis')); ?>" target="_blank">
												<i class="fa fa-eye"></i> Lihat
											</a>
											<button type="button" class="btn btn-sm btn-info btn-doc-history" data-request-document-id="<?php echo $R1->request_document_id; ?>" data-request-id="<?php echo $request_id; ?>" data-kind="document" data-doc-name="<?php echo htmlspecialchars($R1->request_document_name, ENT_QUOTES); ?>" title="Lihat riwayat dokumen">
												<i class="fa fa-history"></i> Riwayat
											</button>
										</div>
									</div>
									<?php
											}
										}else{
									?>
									<div class="hr-line-dashed"></div>
									<?php
										}
									?>
									<div class="hr-line-dashed"></div>
									<?php
										unset($datato);
										$datato['table'] = 'patlog__procurement.entity__request_attachment';
										$datato['where'] = array(
											'patlog__procurement.entity__request_attachment.request_id' => $request_id,
											'patlog__procurement.entity__request_attachment.request_attachment_file != ' => 'no.pdf',
										);
										$Q1 = $this->view->view_data($datato);
										if($Q1->num_rows()){
											foreach($Q1->result() as $R1){
									?>
									<div class="form-group">
										<label class="col-md-3 control-label"><?php echo $R1->request_attachment_name; ?> <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/request-attachment-file/'.$R1->request_attachment_file.'?time='.date('YmdHis')); ?>" target="_blank">
												<i class="fa fa-eye"></i> Lihat
											</a>
										</div>
									</div>
									<?php
											}
									?>
									<div class="hr-line-dashed"></div>
									<?php
										}
									?>
									<?php
										if($request_process_document != 'no.pdf'){
									?>
									<div class="form-group">
										<label class="col-md-3 control-label">Dokumen Pendukung Loket <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/request-process-document/'.$request_process_document.'?time='.date('YmdHis')); ?>" target="_blank">
												<i class="fa fa-eye"></i> Lihat
											</a>
											<button type="button" class="btn btn-sm btn-info btn-doc-history" data-request-document-id="" data-request-id="<?php echo $request_id; ?>" data-kind="loket_process" data-doc-name="Dokumen Pendukung Loket" title="Lihat riwayat dokumen">
												<i class="fa fa-history"></i> Riwayat
											</button>
										</div>
									</div>
									<?php
										}
									?>
									<div class="form-group">
										<label class="col-md-3 control-label">Catatan/Deskripsi Pekerjaan</label>
										<div class="col-md-9">
											<textarea class="form-control" placeholder="Catatan/Deskripsi Pekerjaan" rows="3" maxlength="1000" onfocus="blur();" ><?php echo $request_note; ?></textarea>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<h4>Proses Pengadaan</h4>
									<div class="form-group">
										<div class="col-md-12">
											<p class="text-info"><b>Catatan : Status Pengadaan yang dikerjakan oleh PIC Procurement</b></p>
										</div>
									</div>
									<?php
										unset($datato);
										$datato['table'] = 'patlog__procurement.entity__request_legal';
										$datato['where'] = array(
											'patlog__procurement.entity__request_legal.request_id' => $request_id
										);
										$Q1 = $this->view->view_data($datato);
										foreach($Q1->result() as $R1){
									?>
									<p class="text-left"><h4>Vendor : <?php echo $R1->vendor_name; ?></h4></p>
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>Nama Proses</th>
													<th>Tanggal</th>
													<th>Jam</th>
													<th>Keterangan</th>
													<th>Dokumen</th>
												</tr>
											</thead>
											<tbody>
												<?php
													unset($datato);
													$datato['table'] = 'patlog__procurement.entity__request_process';
													$datato['where'] = array(
														'patlog__procurement.entity__request_process.request_id' => $request_id,
														'patlog__procurement.entity__request_process.vendor_id' => $R1->vendor_id
													);
													$Q2 = $this->view->view_data($datato);
													if($Q2->num_rows()){
														foreach($Q2->result() as $R2){
															$encrypt_id = $this->encrypt->encode($R2->request_process_id);
															$request_process_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
															
															unset($datato);
															$datato['table'] = 'patlog__procurement.data__process_proc';
															$datato['where'] = array(
																'patlog__procurement.data__process_proc.process_proc_id' => $R2->process_proc_id,
																'patlog__procurement.data__process_proc.process_proc_flag' => 'yes'
															);
															$Q3 = $this->view->view_data($datato);
															if($Q3->num_rows()){
																$R3 = $Q3->row();
																$request_process_proc_name = '<div class="badge badge-primary">'.$R2->request_process_proc_name.'</div>';
															}else{
																$request_process_proc_name = $R2->request_process_proc_name;
															}
												?>
												<tr>
													<td><?php echo $request_process_proc_name; ?></td>
													<td><?php echo $R2->request_process_proc_date; ?></td>
													<td><?php echo $R2->request_process_proc_time; ?></td>
													<td><?php echo $R2->request_process_note; ?></td>
													<td>
														<?php
															unset($datato);
															$datato['table'] = 'patlog__procurement.entity__request_process_attach';
															$datato['where'] = array(
																'patlog__procurement.entity__request_process_attach.request_process_id' => $R2->request_process_id
															);
															$Q3 = $this->view->view_data($datato);
															if($Q3->num_rows()){
																foreach($Q3->result() as $R3){
														?>
														<a href="<?php echo base_url('assets/mod__procurement/attach/request_process_attach/'.$R3->request_process_attach_file.'?time='.date('YmdHis')); ?>" class="btn btn-xs btn-default" target="_blank">
															<i class="fa fa-eye"></i>
														</a> - <?php echo $R3->request_process_attach_description; ?>
														<br/>
														<?php
																}
															}else{
														?>
														Tidak ada dokumen.
														<?php
															}
														?>
													</td>
												</tr>
												<?php
														}
													}else{
												?>
												<tr>
													<td colspan="5">
														<center>
															Data tidak ditemukan.
														</center>
													</td>
												</tr>
												<?php
													}
												?>
											</tbody>
										</table>
									</div>
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>Penandatangan</th>
													<th>Jabatan</th>
													<th>Tanggal Mulai</th>
													<th>Tanggal Selesai</th>
													<th>Nilai Estimasi</th>
												</tr>
											</thead>
											<tbody>
												<?php
													unset($datato);
													$datato['table'] = 'patlog__procurement.entity__request_legal';
													$datato['where'] = array(
														'patlog__procurement.entity__request_legal.request_id' => $request_id
													);
													$Q2 = $this->view->view_data($datato);
													if($Q2->num_rows()){
														$R2 = $Q2->row();
												?>
												<tr>
													<td><?php echo $R2->request_legal_user_name; ?></td>
													<td><?php echo $R2->request_legal_user_position; ?></td>
													<td><?php echo $R2->request_legal_date_start; ?></td>
													<td><?php echo $R2->request_legal_date_end; ?></td>
													<td><?php echo $request_currency; ?>. <?php echo number_format($R2->request_legal_total_estimate,0,',','.'); ?></td>
												</tr>
												<?php
													}else{
												?>
												<tr>
													<td colspan="5">
														<center>
															Data tidak ditemukan.
														</center>
													</td>
												</tr>
												<?php
													}
												?>
											</tbody>
										</table>
									</div>
									<div class="hr-line-dashed"></div>
									<?php
										}
									?>
									<div class="hr-line-dashed"></div>
									<div class="row">
										<div class="col-md-6">
											<h3 class="m-t-none m-b">Log Aktivitas</h3>																					
											<div id="vertical-timeline" class="vertical-container dark-timeline">												
												<?php
													unset($datato);
													$datato['table'] = 'patlog__procurement.entity__request_log';
													$datato['where'] = array(
														'patlog__procurement.entity__request_log.request_id' => $request_id
													);
													$Q1 = $this->view->view_data($datato);
													foreach($Q1->result() as $R1){
														$request_log_created_date = $R1->request_log_created_date;
														$request_log_message = $R1->request_log_message;
														$request_log_name = $R1->request_log_name;
														$request_log_status = $R1->request_log_status; 
														$request_log_level = $R1->request_log_level; 
														$request_log_file = $R1->request_log_file; 
														
														if($request_log_status == 'Dibuat'){
															$color = 'text-default';
															$icon = 'far fa-file';
														}elseif($request_log_status == 'Diedit'){
															$color = 'yellow-bg';
															$icon = 'far fa-edit';
														}elseif($request_log_status == 'Disetujui'){
															$color = 'navy-bg';
															$icon = 'far fa-check-circle';
														}elseif($request_log_status == 'Ditolak'){
															$color = 'red-bg';
															$icon = 'fas fa-times-circle';
														}elseif($request_log_status == 'Dimapping oleh'){
															$color = 'yellow-bg';
															$icon = 'fas fa-share-alt';
														}elseif($request_log_status == 'Finish'){
															$color = 'blue-bg';
															$icon = 'fas fa-flag-checkered';
														}
												?>
												<div class="vertical-timeline-block">
													<div class="vertical-timeline-icon <?php echo $color; ?>">
														<i class="<?php echo $icon; ?>"></i>
													</div>
													<div class="vertical-timeline-content">
														<div class="clearfix">
															<div class="pull-left">
																<span class="vertical-date small text-muted"><?php echo $request_log_created_date; ?></span><br>
																<p><?php echo $request_log_status; ?> <b><?php echo $request_log_name; ?></b></p>
																<p><?php echo $request_log_message; ?></p>
															</div>
															<div class="pull-right">
																<?php
																	if($request_log_file != null){
																?>
																<a class="btn btn-sm" href="<?php echo base_url('assets/mod__procurement/attach/request-log-file/'.$request_log_file.'?time='.date('YmdHis')); ?>" target="_blank">
																	<i class="fa fa-file fa-2x text-danger"></i> 
																</a>
																<?php
																	}
																?>
															</div>
														</div>
													</div>
												</div>
												<?php
													}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<script type="text/javascript">
				
					table = $('#table').DataTable({
						"responsive": true,
						"searching": false,
						"paging": false,
						"info": false,
						"ordering": false,
						"language": {
							"url": "<?php echo base_url('assets/template/inspinia/js/plugins/dataTables/Indonesian.json'); ?>"
						}
					});
					
				</script>
				<?php
					}elseif($this->input->get('view') == 'approval'){
				?>
				<div class="row">
					<div class="col-md-12">
						<div class="ibox float-e-margins">
							<div class="ibox-title">
								<h4><?php echo strtoupper(str_replace('_',' ',$this->uri->segment(3))); ?></h4>
							</div>
							<div class="ibox-content">
								<div class="form-horizontal">
									<div class="form-group">
										<label class="col-md-3 control-label">Kode Permintaan</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Kode Permintaan" value="<?php echo $request_code; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<h4>Data Pemohon</h4>
									<div class="form-group">
										<label class="col-md-3 control-label">Nama Pemohon</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Nama Pemohon" value="<?php echo $request_employee_in_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Divisi</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Divisi" value="<?php echo $request_division_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Fungsi</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Fungsi" value="<?php echo $request_functions_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">PIC Modul Kontrak</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="PIC Modul Kontrak" value="<?php echo $request_pic_contract_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Approval Modul Kontrak</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Approval Modul Kontrak" value="<?php echo $request_pic_contract_approval_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Jenis Permintaan Kontrak</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Jenis Permintaan Kontrak" value="<?php echo $request_pic_contract_request_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Deskripsi Permintaan Kontrak</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Deskripsi Permintaan Kontrak" value="<?php echo $request_pic_contract_request_description_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<h4>Data Permintaan</h4>
									<div class="form-group">
										<label class="col-md-3 control-label">Metode</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Metode" value="<?php echo $request_category_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Jenis Permintaan</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Jenis Permintaan" value="<?php echo $request_type_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Tipe Kode</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Tipe Kode" value="<?php echo $request_cost_category_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Kode Proyek/Cost Center</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Kode Proyek/Cost Center" value="<?php echo $request_source_code; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Deskripsi Kode Proyek/Cost Center</label>
										<div class="col-md-9">
											<textarea class="form-control" placeholder="Deskripsi Kode Proyek/Cost Center" rows="3" maxlength="1000" onfocus="blur();" ><?php echo $request_source_code_description; ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Due Date</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Due Date" value="<?php echo $request_used_date; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Mata Uang</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Mata Uang" value="<?php echo $request_currency; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-3 control-label">Item Permintaan</label>
										<div class="col-md-9">
											<div class="table-responsive">
												<table class="display table-condensed nowrap" border="0">
													<thead>
														<tr>
															<th valign="top" align="center">No.</th>
															<th valign="top" align="center">Nama Barang/Jasa</th>
															<th valign="top" align="center">Jumlah</th>
															<th valign="top" align="center">Unit</th>
															<th valign="top" align="center">Estimasi Harga (IDR)</th>
															<th valign="top" align="center">Total (IDR)</th>
															<th valign="top" align="center">Spesifikasi</th>
															<th valign="top" align="center">Dokumen</th>
														</tr>
													</thead>
													<tbody>
														<?php
															$i = 0;
															unset($datato);														
															$datato['table'] = 'patlog__procurement.entity__request_det';																	
															$datato['where'] = array(
																'patlog__procurement.entity__request_det.request_id' => $request_id
															);
															$Q1 = $this->view->view_data($datato);
															if($Q1->num_rows()){
																foreach($Q1->result() as $R1){
														?>
														<tr>
															<td valign="top" align="left"><?php echo ($i+1).'.'; ?></td>
															<td valign="top" align="left"><?php echo $R1->request_det_item; ?></td>
															<td valign="top" align="center"><?php echo $R1->request_det_qty; ?></td>
															<td valign="top" align="left"><?php echo $R1->request_det_unit; ?></td>
															<td valign="top" align="right"><?php echo number_format($R1->request_det_estimate_price,0,',','.'); ?></td>
															<td valign="top" align="right"><?php echo number_format(($R1->request_det_qty * $R1->request_det_estimate_price),0,',','.'); ?></td>
															<td valign="top" align="left"><?php echo $R1->request_det_note; ?></td>
															<td valign="top">
																<div class="text-center">
																	<a href="<?php echo base_url('assets/mod__procurement/attach/request_document/'.$R1->request_det_attachment.'?time='.date('YmdHis')); ?>" class="btn btn-xs btn-default" target="_blank">
																		<i class="fa fa-eye"></i>
																	</a>
																</div>
															</td>
														</tr>
														<?php
																	$i++;
																}
															}else{
														?>
														<tr>
															<td colspan="9">
																<center>
																	Data tidak ditemukan.
																</center>
															</td>
														</tr>
														<?php
															}
														?>
													</body>
												</table>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Grand Total (Estimasi Harga)</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Grand Total (Estimasi Harga)" value="<?php echo number_format($request_grandtotal_estimate,0,',','.'); ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<?php
										unset($datato);
										$datato['table'] = 'patlog__procurement.entity__request_document';
										$datato['where'] = array(
											'patlog__procurement.entity__request_document.request_id' => $request_id,
											'patlog__procurement.entity__request_document.request_document_file != ' => 'no.pdf',
										);
										$Q1 = $this->view->view_data($datato);
										if($Q1->num_rows()){
											foreach($Q1->result() as $R1){
									?>
									<div class="form-group">
										<label class="col-md-3 control-label"><?php echo $R1->request_document_name; ?> <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/request-document-file/'.$R1->request_document_file.'?time='.date('YmdHis')); ?>" target="_blank">
												<i class="fa fa-eye"></i> Lihat
											</a>
											<button type="button" class="btn btn-sm btn-info btn-doc-history" data-request-document-id="<?php echo $R1->request_document_id; ?>" data-request-id="<?php echo $request_id; ?>" data-kind="document" data-doc-name="<?php echo htmlspecialchars($R1->request_document_name, ENT_QUOTES); ?>" title="Lihat riwayat dokumen">
												<i class="fa fa-history"></i> Riwayat
											</button>
										</div>
									</div>
									<?php
											}
										}else{
									?>
									<div class="hr-line-dashed"></div>
									<?php
										}
									?>
									<div class="hr-line-dashed"></div>
									<?php
										unset($datato);
										$datato['table'] = 'patlog__procurement.entity__request_attachment';
										$datato['where'] = array(
											'patlog__procurement.entity__request_attachment.request_id' => $request_id,
											'patlog__procurement.entity__request_attachment.request_attachment_file != ' => 'no.pdf',
										);
										$Q1 = $this->view->view_data($datato);
										if($Q1->num_rows()){
											foreach($Q1->result() as $R1){
									?>
									<div class="form-group">
										<label class="col-md-3 control-label"><?php echo $R1->request_attachment_name; ?> <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/request-attachment-file/'.$R1->request_attachment_file.'?time='.date('YmdHis')); ?>" target="_blank">
												<i class="fa fa-eye"></i> Lihat
											</a>
										</div>
									</div>
									<?php
											}
									?>
									<div class="hr-line-dashed"></div>
									<?php
										}
									?>
									<?php
										if($request_process_document != 'no.pdf'){
									?>
									<div class="form-group">
										<label class="col-md-3 control-label">Dokumen Pendukung Loket <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/request-process-document/'.$request_process_document.'?time='.date('YmdHis')); ?>" target="_blank">
												<i class="fa fa-eye"></i> Lihat
											</a>
											<button type="button" class="btn btn-sm btn-info btn-doc-history" data-request-document-id="" data-request-id="<?php echo $request_id; ?>" data-kind="loket_process" data-doc-name="Dokumen Pendukung Loket" title="Lihat riwayat dokumen">
												<i class="fa fa-history"></i> Riwayat
											</button>
										</div>
									</div>
									<?php
										}
									?>
									<div class="form-group">
										<label class="col-md-3 control-label">Catatan/Deskripsi Pekerjaan</label>
										<div class="col-md-9">
											<textarea class="form-control" placeholder="Catatan/Deskripsi Pekerjaan" rows="3" maxlength="1000" onfocus="blur();" ><?php echo $request_note; ?></textarea>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<h4>Proses Pengadaan</h4>
									<div class="form-group">
										<div class="col-md-12">
											<p class="text-info"><b>Catatan : Status Pengadaan yang dikerjakan oleh PIC Procurement</b></p>
										</div>
									</div>
									<?php
										unset($datato);
										$datato['table'] = 'patlog__procurement.entity__request_legal';
										$datato['where'] = array(
											'patlog__procurement.entity__request_legal.request_id' => $request_id
										);
										$Q1 = $this->view->view_data($datato);
										foreach($Q1->result() as $R1){
									?>
									<p class="text-left"><h4>Vendor : <?php echo $R1->vendor_name; ?></h4></p>
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>Nama Proses</th>
													<th>Tanggal</th>
													<th>Jam</th>
													<th>Keterangan</th>
													<th>Dokumen</th>
												</tr>
											</thead>
											<tbody>
												<?php
													unset($datato);
													$datato['table'] = 'patlog__procurement.entity__request_process';
													$datato['where'] = array(
														'patlog__procurement.entity__request_process.request_id' => $request_id,
														'patlog__procurement.entity__request_process.vendor_id' => $R1->vendor_id
													);
													$Q2 = $this->view->view_data($datato);
													if($Q2->num_rows()){
														foreach($Q2->result() as $R2){
															$encrypt_id = $this->encrypt->encode($R2->request_process_id);
															$request_process_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
															
															unset($datato);
															$datato['table'] = 'patlog__procurement.data__process_proc';
															$datato['where'] = array(
																'patlog__procurement.data__process_proc.process_proc_id' => $R2->process_proc_id,
																'patlog__procurement.data__process_proc.process_proc_flag' => 'yes'
															);
															$Q3 = $this->view->view_data($datato);
															if($Q3->num_rows()){
																$R3 = $Q3->row();
																$request_process_proc_name = '<div class="badge badge-primary">'.$R2->request_process_proc_name.'</div>';
															}else{
																$request_process_proc_name = $R2->request_process_proc_name;
															}
												?>
												<tr>
													<td><?php echo $request_process_proc_name; ?></td>
													<td><?php echo $R2->request_process_proc_date; ?></td>
													<td><?php echo $R2->request_process_proc_time; ?></td>
													<td><?php echo $R2->request_process_note; ?></td>
													<td>
														<?php
															unset($datato);
															$datato['table'] = 'patlog__procurement.entity__request_process_attach';
															$datato['where'] = array(
																'patlog__procurement.entity__request_process_attach.request_process_id' => $R2->request_process_id
															);
															$Q3 = $this->view->view_data($datato);
															if($Q3->num_rows()){
																foreach($Q3->result() as $R3){
														?>
														<a href="<?php echo base_url('assets/mod__procurement/attach/request_process_attach/'.$R3->request_process_attach_file.'?time='.date('YmdHis')); ?>" class="btn btn-xs btn-default" target="_blank">
															<i class="fa fa-eye"></i>
														</a> - <?php echo $R3->request_process_attach_description; ?>
														<br/>
														<?php
																}
															}else{
														?>
														Tidak ada dokumen.
														<?php
															}
														?>
													</td>
												</tr>
												<?php
														}
													}else{
												?>
												<tr>
													<td colspan="5">
														<center>
															Data tidak ditemukan.
														</center>
													</td>
												</tr>
												<?php
													}
												?>
											</tbody>
										</table>
									</div>
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>Penandatangan</th>
													<th>Jabatan</th>
													<th>Tanggal Mulai</th>
													<th>Tanggal Selesai</th>
													<th>Nilai Estimasi</th>
												</tr>
											</thead>
											<tbody>
												<?php
													unset($datato);
													$datato['table'] = 'patlog__procurement.entity__request_legal';
													$datato['where'] = array(
														'patlog__procurement.entity__request_legal.request_id' => $request_id
													);
													$Q2 = $this->view->view_data($datato);
													if($Q2->num_rows()){
														$R2 = $Q2->row();
												?>
												<tr>
													<td><?php echo $R2->request_legal_user_name; ?></td>
													<td><?php echo $R2->request_legal_user_position; ?></td>
													<td><?php echo $R2->request_legal_date_start; ?></td>
													<td><?php echo $R2->request_legal_date_end; ?></td>
													<td><?php echo $request_currency; ?>. <?php echo number_format($R2->request_legal_total_estimate,0,',','.'); ?></td>
												</tr>
												<?php
													}else{
												?>
												<tr>
													<td colspan="5">
														<center>
															Data tidak ditemukan.
														</center>
													</td>
												</tr>
												<?php
													}
												?>
											</tbody>
										</table>
									</div>
									<div class="hr-line-dashed"></div>
									<?php
										}
									?>
									<div class="hr-line-dashed"></div>
									<div class="row">
										<div class="col-md-6">
											<h3 class="m-t-none m-b">Log Aktivitas</h3>																					
											<div id="vertical-timeline" class="vertical-container dark-timeline">												
												<?php
													unset($datato);
													$datato['table'] = 'patlog__procurement.entity__request_log';
													$datato['where'] = array(
														'patlog__procurement.entity__request_log.request_id' => $request_id
													);
													$Q1 = $this->view->view_data($datato);
													foreach($Q1->result() as $R1){
														$request_log_created_date = $R1->request_log_created_date;
														$request_log_message = $R1->request_log_message;
														$request_log_name = $R1->request_log_name;
														$request_log_status = $R1->request_log_status; 
														$request_log_level = $R1->request_log_level; 
														$request_log_file = $R1->request_log_file; 
														
														if($request_log_status == 'Dibuat'){
															$color = 'text-default';
															$icon = 'far fa-file';
														}elseif($request_log_status == 'Diedit'){
															$color = 'yellow-bg';
															$icon = 'far fa-edit';
														}elseif($request_log_status == 'Disetujui'){
															$color = 'navy-bg';
															$icon = 'far fa-check-circle';
														}elseif($request_log_status == 'Ditolak'){
															$color = 'red-bg';
															$icon = 'fas fa-times-circle';
														}elseif($request_log_status == 'Dimapping oleh'){
															$color = 'yellow-bg';
															$icon = 'fas fa-share-alt';
														}elseif($request_log_status == 'Finish'){
															$color = 'blue-bg';
															$icon = 'fas fa-flag-checkered';
														}
												?>
												<div class="vertical-timeline-block">
													<div class="vertical-timeline-icon <?php echo $color; ?>">
														<i class="<?php echo $icon; ?>"></i>
													</div>
													<div class="vertical-timeline-content">
														<div class="clearfix">
															<div class="pull-left">
																<span class="vertical-date small text-muted"><?php echo $request_log_created_date; ?></span><br>
																<p><?php echo $request_log_status; ?> <b><?php echo $request_log_name; ?></b></p>
																<p><?php echo $request_log_message; ?></p>
															</div>
															<div class="pull-right">
																<?php
																	if($request_log_file != null){
																?>
																<a class="btn btn-sm" href="<?php echo base_url('assets/mod__procurement/attach/request-log-file/'.$request_log_file.'?time='.date('YmdHis')); ?>" target="_blank">
																	<i class="fa fa-file fa-2x text-danger"></i> 
																</a>
																<?php
																	}
																?>
															</div>
														</div>
													</div>
												</div>
												<?php
													}
												?>
											</div>
										</div>
										<div class="col-md-6">
											<form method="post" class="form-horizontal" action="<?php echo site_url('module_procurement/admin_functions/request_approval/'.$this->input->get('request_id').'/'); ?>" enctype="multipart/form-data">
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" required />
												<?php
													if($request_approval_employee_in_id == null and $request_approval_employee_in_name == 'Loket'){
												?>
												<div class="form-group">
													<label class="col-md-3 control-label">Aktor <span class="text-danger">*</span></label>
													<div class="col-md-9">
														<select class="form-control select2" name="request_approval_employee_in_id" required >
															<option selected disabled value="">--Pilih--</option>
															<?php
																unset($datato);
																$datato['table'] = 'patlog__procurement.entity__cog';
																$Q1 = $this->view->view_data($datato);
																if($Q1->num_rows()){
																	$R1 = $Q1->row();
																	$cog_functions_id = $R1->cog_functions_id;
																}else{
																	$cog_functions_id = null;
																}
															
																unset($datato);
																$datato['table'] = 'patlog__hrms.entity__employee_in';
																$datato['where'] = array(
																	'patlog__hrms.entity__employee_in.functions_id' => $cog_functions_id,
																	'patlog__hrms.entity__employee_in.employee_in_status' => 'Aktif'
																);
																$Q1 = $this->view->view_data($datato);
																foreach($Q1->result() as $R1){ 
															?>			
															<option value="<?php echo urlencode($R1->employee_in_id); ?>"><?php echo $R1->employee_in_name ?></option>
															<?php
																}
															?>
														</select>
													</div>
												</div>
												<?php
													}else{
												?>
												<div class="form-group">
													<label class="col-md-3 control-label">Disetujui Oleh <span class="text-danger">*</span></label>
													<div class="col-md-9">
														<input type="text" class="form-control" placeholder="Disetujui Oleh" value="<?php echo $request_approval_employee_in_name; ?>" onfocus="blur();" />											
													</div>
												</div>
												<?php
													}
												?>
												<?php
													if($request_status_information == 'Menunggu disetujui Loket'){
												?>
												<div class="form-group">
													<label class="col-md-3 control-label">Dokumen Pendukung (PDF) <span class="text-danger">*</span></label>
													<div class="col-md-9">
														<input type="file" class="form-control" name="request_process_document" accept="application/pdf" required />											
													</div>
												</div>
												<?php
													}
												?>
												<div class="form-group">
													<label class="col-md-3 control-label">Status <span class="text-danger">*</span></label>
													<div class="col-md-9">
														<select class="form-control select2" name="request_log_status" style="width:100%;" required>
															<option selected disabled value="">--Pilih--</option>
															<option value="<?php echo urlencode('Disetujui'); ?>">Approve</option>
															<option value="<?php echo urlencode('Ditolak'); ?>">Reject</option>
														</select>
													</div>
												</div>	
												<div class="form-group">
													<label class="col-md-3 control-label">Keterangan <span class="text-danger"></span></label>
													<div class="col-md-9">
														<textarea class="form-control" name="request_log_message" placeholder="Keterangan" rows="3" maxlength="1000"></textarea>
														<span class="help-block m-b-none"><span class="text-warning">*</span> maksimal 1000 karakter.</span>
													</div>
												</div>
												<div class="hr-line-dashed"></div>
												<div class="form-group">
													<div class="col-md-9 col-md-offset-3">
														<button class="btn btn-primary" type="submit">Simpan</button>
														<button class="btn btn-white" type="button" onclick="window.location.href='<?php echo site_url('module_procurement/admin/proses_permintaan/'); ?>'">Kembali</button>
													</div>
												</div>							
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<script type="text/javascript">
				
					$(".select2").select2({
						theme: "bootstrap"
					});
					
					table = $('#table').DataTable({
						"responsive": true,
						"searching": false,
						"paging": false,
						"info": false,
						"ordering": false,
						"language": {
							"url": "<?php echo base_url('assets/template/inspinia/js/plugins/dataTables/Indonesian.json'); ?>"
						}
					});
					
				</script>
				<?php
					}elseif($this->input->get('view') == 'mapping'){
				?>
				<div class="row">
					<div class="col-md-12">
						<div class="ibox float-e-margins">
							<div class="ibox-title">
								<h4><?php echo strtoupper(str_replace('_',' ',$this->uri->segment(3))); ?></h4>
							</div>
							<div class="ibox-content">
								<div class="form-horizontal">
									<div class="form-group">
										<label class="col-md-3 control-label">Kode Permintaan</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Kode Permintaan" value="<?php echo $request_code; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<h4>Data Pemohon</h4>
									<div class="form-group">
										<label class="col-md-3 control-label">Nama Pemohon</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Nama Pemohon" value="<?php echo $request_employee_in_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Divisi</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Divisi" value="<?php echo $request_division_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Fungsi</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Fungsi" value="<?php echo $request_functions_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">PIC Modul Kontrak</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="PIC Modul Kontrak" value="<?php echo $request_pic_contract_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Approval Modul Kontrak</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Approval Modul Kontrak" value="<?php echo $request_pic_contract_approval_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Jenis Permintaan Kontrak</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Jenis Permintaan Kontrak" value="<?php echo $request_pic_contract_request_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Deskripsi Permintaan Kontrak</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Deskripsi Permintaan Kontrak" value="<?php echo $request_pic_contract_request_description_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<h4>Data Permintaan</h4>
									<div class="form-group">
										<label class="col-md-3 control-label">Metode</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Metode" value="<?php echo $request_category_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Jenis Permintaan</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Jenis Permintaan" value="<?php echo $request_type_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Tipe Kode</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Tipe Kode" value="<?php echo $request_cost_category_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Kode Proyek/Cost Center</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Kode Proyek/Cost Center" value="<?php echo $request_source_code; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Deskripsi Kode Proyek/Cost Center</label>
										<div class="col-md-9">
											<textarea class="form-control" placeholder="Deskripsi Kode Proyek/Cost Center" rows="3" maxlength="1000" onfocus="blur();" ><?php echo $request_source_code_description; ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Due Date</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Due Date" value="<?php echo $request_used_date; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Mata Uang</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Mata Uang" value="<?php echo $request_currency; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-3 control-label">Item Permintaan</label>
										<div class="col-md-9">
											<div class="table-responsive">
												<table class="display table-condensed nowrap" border="0">
													<thead>
														<tr>
															<th valign="top" align="center">No.</th>
															<th valign="top" align="center">Nama Barang/Jasa</th>
															<th valign="top" align="center">Jumlah</th>
															<th valign="top" align="center">Unit</th>
															<th valign="top" align="center">Estimasi Harga (IDR)</th>
															<th valign="top" align="center">Total (IDR)</th>
															<th valign="top" align="center">Spesifikasi</th>
															<th valign="top" align="center">Dokumen</th>
														</tr>
													</thead>
													<tbody>
														<?php
															$i = 0;
															unset($datato);														
															$datato['table'] = 'patlog__procurement.entity__request_det';																	
															$datato['where'] = array(
																'patlog__procurement.entity__request_det.request_id' => $request_id
															);
															$Q1 = $this->view->view_data($datato);
															if($Q1->num_rows()){
																foreach($Q1->result() as $R1){
														?>
														<tr>
															<td valign="top" align="left"><?php echo ($i+1).'.'; ?></td>
															<td valign="top" align="left"><?php echo $R1->request_det_item; ?></td>
															<td valign="top" align="center"><?php echo $R1->request_det_qty; ?></td>
															<td valign="top" align="left"><?php echo $R1->request_det_unit; ?></td>
															<td valign="top" align="right"><?php echo number_format($R1->request_det_estimate_price,0,',','.'); ?></td>
															<td valign="top" align="right"><?php echo number_format(($R1->request_det_qty * $R1->request_det_estimate_price),0,',','.'); ?></td>
															<td valign="top" align="left"><?php echo $R1->request_det_note; ?></td>
															<td valign="top">
																<div class="text-center">
																	<a href="<?php echo base_url('assets/mod__procurement/attach/request_document/'.$R1->request_det_attachment.'?time='.date('YmdHis')); ?>" class="btn btn-xs btn-default" target="_blank">
																		<i class="fa fa-eye"></i>
																	</a>
																</div>
															</td>
														</tr>
														<?php
																	$i++;
																}
															}else{
														?>
														<tr>
															<td colspan="9">
																<center>
																	Data tidak ditemukan.
																</center>
															</td>
														</tr>
														<?php
															}
														?>
													</body>
												</table>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Grand Total (Estimasi Harga)</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Grand Total (Estimasi Harga)" value="<?php echo number_format($request_grandtotal_estimate,0,',','.'); ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<?php
										unset($datato);
										$datato['table'] = 'patlog__procurement.entity__request_document';
										$datato['where'] = array(
											'patlog__procurement.entity__request_document.request_id' => $request_id,
											'patlog__procurement.entity__request_document.request_document_file != ' => 'no.pdf',
										);
										$Q1 = $this->view->view_data($datato);
										if($Q1->num_rows()){
											foreach($Q1->result() as $R1){
									?>
									<div class="form-group">
										<label class="col-md-3 control-label"><?php echo $R1->request_document_name; ?> <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/request-document-file/'.$R1->request_document_file.'?time='.date('YmdHis')); ?>" target="_blank">
												<i class="fa fa-eye"></i> Lihat
											</a>
											<button type="button" class="btn btn-sm btn-info btn-doc-history" data-request-document-id="<?php echo $R1->request_document_id; ?>" data-request-id="<?php echo $request_id; ?>" data-kind="document" data-doc-name="<?php echo htmlspecialchars($R1->request_document_name, ENT_QUOTES); ?>" title="Lihat riwayat dokumen">
												<i class="fa fa-history"></i> Riwayat
											</button>
										</div>
									</div>
									<?php
											}
										}else{
									?>
									<div class="hr-line-dashed"></div>
									<?php
										}
									?>
									<div class="hr-line-dashed"></div>
									<?php
										unset($datato);
										$datato['table'] = 'patlog__procurement.entity__request_attachment';
										$datato['where'] = array(
											'patlog__procurement.entity__request_attachment.request_id' => $request_id,
											'patlog__procurement.entity__request_attachment.request_attachment_file != ' => 'no.pdf',
										);
										$Q1 = $this->view->view_data($datato);
										if($Q1->num_rows()){
											foreach($Q1->result() as $R1){
									?>
									<div class="form-group">
										<label class="col-md-3 control-label"><?php echo $R1->request_attachment_name; ?> <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/request-attachment-file/'.$R1->request_attachment_file.'?time='.date('YmdHis')); ?>" target="_blank">
												<i class="fa fa-eye"></i> Lihat
											</a>
										</div>
									</div>
									<?php
											}
									?>
									<div class="hr-line-dashed"></div>
									<?php
										}
									?>
									<div class="form-group">
										<label class="col-md-3 control-label">Catatan/Deskripsi Pekerjaan</label>
										<div class="col-md-9">
											<textarea class="form-control" placeholder="Catatan/Deskripsi Pekerjaan" rows="3" maxlength="1000" onfocus="blur();" ><?php echo $request_note; ?></textarea>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<h4>Proses Pengadaan</h4>
									<div class="form-group">
										<div class="col-md-12">
											<p class="text-info"><b>Catatan : Status Pengadaan yang dikerjakan oleh PIC Procurement</b></p>
										</div>
									</div>
									<?php
										unset($datato);
										$datato['table'] = 'patlog__procurement.entity__request_legal';
										$datato['where'] = array(
											'patlog__procurement.entity__request_legal.request_id' => $request_id
										);
										$Q1 = $this->view->view_data($datato);
										foreach($Q1->result() as $R1){
									?>
									<p class="text-left"><h4>Vendor : <?php echo $R1->vendor_name; ?></h4></p>
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>Nama Proses</th>
													<th>Tanggal</th>
													<th>Jam</th>
													<th>Keterangan</th>
													<th>Dokumen</th>
												</tr>
											</thead>
											<tbody>
												<?php
													unset($datato);
													$datato['table'] = 'patlog__procurement.entity__request_process';
													$datato['where'] = array(
														'patlog__procurement.entity__request_process.request_id' => $request_id,
														'patlog__procurement.entity__request_process.vendor_id' => $R1->vendor_id
													);
													$Q2 = $this->view->view_data($datato);
													if($Q2->num_rows()){
														foreach($Q2->result() as $R2){
															$encrypt_id = $this->encrypt->encode($R2->request_process_id);
															$request_process_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
															
															unset($datato);
															$datato['table'] = 'patlog__procurement.data__process_proc';
															$datato['where'] = array(
																'patlog__procurement.data__process_proc.process_proc_id' => $R2->process_proc_id,
																'patlog__procurement.data__process_proc.process_proc_flag' => 'yes'
															);
															$Q3 = $this->view->view_data($datato);
															if($Q3->num_rows()){
																$R3 = $Q3->row();
																$request_process_proc_name = '<div class="badge badge-primary">'.$R2->request_process_proc_name.'</div>';
															}else{
																$request_process_proc_name = $R2->request_process_proc_name;
															}
												?>
												<tr>
													<td><?php echo $request_process_proc_name; ?></td>
													<td><?php echo $R2->request_process_proc_date; ?></td>
													<td><?php echo $R2->request_process_proc_time; ?></td>
													<td><?php echo $R2->request_process_note; ?></td>
													<td>
														<?php
															unset($datato);
															$datato['table'] = 'patlog__procurement.entity__request_process_attach';
															$datato['where'] = array(
																'patlog__procurement.entity__request_process_attach.request_process_id' => $R2->request_process_id
															);
															$Q3 = $this->view->view_data($datato);
															if($Q3->num_rows()){
																foreach($Q3->result() as $R3){
														?>
														<a href="<?php echo base_url('assets/mod__procurement/attach/request_process_attach/'.$R3->request_process_attach_file.'?time='.date('YmdHis')); ?>" class="btn btn-xs btn-default" target="_blank">
															<i class="fa fa-eye"></i>
														</a> - <?php echo $R3->request_process_attach_description; ?>
														<br/>
														<?php
																}
															}else{
														?>
														Tidak ada dokumen.
														<?php
															}
														?>
													</td>
												</tr>
												<?php
														}
													}else{
												?>
												<tr>
													<td colspan="5">
														<center>
															Data tidak ditemukan.
														</center>
													</td>
												</tr>
												<?php
													}
												?>
											</tbody>
										</table>
									</div>
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>Penandatangan</th>
													<th>Jabatan</th>
													<th>Tanggal Mulai</th>
													<th>Tanggal Selesai</th>
													<th>Nilai Estimasi</th>
												</tr>
											</thead>
											<tbody>
												<?php
													unset($datato);
													$datato['table'] = 'patlog__procurement.entity__request_legal';
													$datato['where'] = array(
														'patlog__procurement.entity__request_legal.request_id' => $request_id
													);
													$Q2 = $this->view->view_data($datato);
													if($Q2->num_rows()){
														$R2 = $Q2->row();
												?>
												<tr>
													<td><?php echo $R2->request_legal_user_name; ?></td>
													<td><?php echo $R2->request_legal_user_position; ?></td>
													<td><?php echo $R2->request_legal_date_start; ?></td>
													<td><?php echo $R2->request_legal_date_end; ?></td>
													<td><?php echo $request_currency; ?>. <?php echo number_format($R2->request_legal_total_estimate,0,',','.'); ?></td>
												</tr>
												<?php
													}else{
												?>
												<tr>
													<td colspan="5">
														<center>
															Data tidak ditemukan.
														</center>
													</td>
												</tr>
												<?php
													}
												?>
											</tbody>
										</table>
									</div>
									<div class="hr-line-dashed"></div>
									<?php
										}
									?>
									<div class="hr-line-dashed"></div>
									<div class="row">
										<div class="col-md-6">
											<h3 class="m-t-none m-b">Log Aktivitas</h3>																					
											<div id="vertical-timeline" class="vertical-container dark-timeline">												
												<?php
													unset($datato);
													$datato['table'] = 'patlog__procurement.entity__request_log';
													$datato['where'] = array(
														'patlog__procurement.entity__request_log.request_id' => $request_id
													);
													$Q1 = $this->view->view_data($datato);
													foreach($Q1->result() as $R1){
														$request_log_created_date = $R1->request_log_created_date;
														$request_log_message = $R1->request_log_message;
														$request_log_name = $R1->request_log_name;
														$request_log_status = $R1->request_log_status; 
														$request_log_level = $R1->request_log_level; 
														$request_log_file = $R1->request_log_file; 
														
														if($request_log_status == 'Dibuat'){
															$color = 'text-default';
															$icon = 'far fa-file';
														}elseif($request_log_status == 'Diedit'){
															$color = 'yellow-bg';
															$icon = 'far fa-edit';
														}elseif($request_log_status == 'Disetujui'){
															$color = 'navy-bg';
															$icon = 'far fa-check-circle';
														}elseif($request_log_status == 'Ditolak'){
															$color = 'red-bg';
															$icon = 'fas fa-times-circle';
														}elseif($request_log_status == 'Dimapping oleh'){
															$color = 'yellow-bg';
															$icon = 'fas fa-share-alt';
														}elseif($request_log_status == 'Finish'){
															$color = 'blue-bg';
															$icon = 'fas fa-flag-checkered';
														}
												?>
												<div class="vertical-timeline-block">
													<div class="vertical-timeline-icon <?php echo $color; ?>">
														<i class="<?php echo $icon; ?>"></i>
													</div>
													<div class="vertical-timeline-content">
														<div class="pull-left">
															<span class="vertical-date small text-muted"><?php echo $request_log_created_date; ?></span><br>
															<p><?php echo $request_log_status; ?> <b><?php echo $request_log_name; ?></b></p>
															<p><?php echo $request_log_message; ?></p>
														</div>
														<div class="pull-right">
															<?php
																if($request_log_file != null){
															?>
															<a class="btn btn-sm" href="<?php echo base_url('assets/mod__procurement/attach/request-log-file/'.$request_log_file.'?time='.date('YmdHis')); ?>" target="_blank">
																<i class="fa fa-file fa-2x text-danger"></i> 
															</a>
															<?php
																}
															?>
														</div>
													</div>
												</div>
												<?php
													}
												?>
											</div>
										</div>
										<div class="col-md-6">
											<form method="post" class="form-horizontal" action="<?php echo site_url('module_procurement/admin_functions/request_mapping/'.$this->input->get('request_id').'/'); ?>" enctype="multipart/form-data">
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" required />
												<div class="form-group">
													<div class="col-md-12">
														<p><b>Catatan : Untuk Pengadaan diatas silahkan di mapping ke fungsi Procurement di bawah ini.</b></p>
													</div>
												</div>
												<table class="table table-striped table-bordered table-hover" id="table-pic">
													<thead>
														<tr>
															<th>No</th>												
															<th>Nama PIC</th>												
															<th>Jumlah Permintaan Berjalan</th>			
															<th>Jumlah Permintaan Selesai</th>												
														</tr>
													</thead>
													<tbody>
														<?php
															unset($datato);
															$datato['table'] = 'patlog__procurement.entity__cog';
															$Q1 = $this->view->view_data($datato);
															if($Q1->num_rows()){
																$R1 = $Q1->row();
																$cog_division_id = $R1->cog_division_id;
																$cog_functions_id = $R1->cog_functions_id;
															}else{
																$cog_division_id = null;
																$cog_functions_id = null;
															}
														
															$no = 1;
															unset($datato);														
															$datato['table'] = 'patlog__hrms.entity__employee_in';				
															$datato['where'] = array(
																'patlog__hrms.entity__employee_in.division_id' => $cog_division_id,
																// 'patlog__hrms.entity__employee_in.functions_id' => $cog_functions_id,
																'patlog__hrms.entity__employee_in.employee_in_status' => 'Aktif'
															);
															$Q1 = $this->view->view_data($datato);
															foreach($Q1->result() as $R1){
																unset($datato);			
																$datato['table'] = 'patlog__procurement.entity__request';
																$datato['where'] = array(
																	'patlog__procurement.entity__request.request_proc_employee_in_id' => $R1->employee_in_id,
																	'patlog__procurement.entity__request.request_is_finish' => 0, 
																	'patlog__procurement.entity__request.request_is_delete' => 0 
																);
																$Q2 = $this->view->view_data($datato);
																$total_process = $Q2->num_rows();
																
																unset($datato);			
																$datato['table'] = 'patlog__procurement.entity__request';
																$datato['where'] = array(
																	'patlog__procurement.entity__request.request_proc_employee_in_id' => $R1->employee_in_id,
																	'patlog__procurement.entity__request.request_is_finish' => 1
																);
																$Q2 = $this->view->view_data($datato);
																$total_finish = $Q2->num_rows();
														?>		
														<tr>
															<td><?php echo $no++; ?></td>
															<td><?php echo $R1->employee_in_name; ?></td>
															<td><?php echo $total_process; ?></td>
															<td><?php echo $total_finish; ?></td>
														</tr>
														<?php
															} 
														?>
													</tbody>
												</table>
												<div class="form-group">
													<label class="col-md-3 control-label">Didisposisikan oleh <span class="text-danger">*</span></label>
													<div class="col-md-9">
														<input type="text" class="form-control" placeholder="Didisposisikan oleh" value="<?php echo $request_process_employee_in_name; ?>" onfocus="blur();" />											
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Nama PIC <span class="text-danger">*</span></label>
													<div class="col-md-9">
														<select class="form-control select2" name="request_proc_employee_in_id" style="width:100%;" required>
															<option selected disabled value="">--Pilih--</option>
															<?php
																unset($datato);														
																$datato['table'] = 'patlog__hrms.entity__employee_in';				
																$datato['where'] = array(
																	'patlog__hrms.entity__employee_in.division_id' => $cog_division_id,
																	// 'patlog__hrms.entity__employee_in.functions_id' => $cog_functions_id,
																	'patlog__hrms.entity__employee_in.employee_in_status' => 'Aktif'
																);
																$Q1 = $this->view->view_data($datato);
																foreach($Q1->result() as $R1){
															?>
															<option value="<?php echo urlencode($R1->employee_in_id); ?>"><?php echo $R1->employee_in_name; ?></option>
															<?php
																}
															?>
														</select>
													</div>
												</div>
												<div class="hr-line-dashed"></div>
												<div class="form-group">
													<div class="col-md-9 col-md-offset-3">
														<button class="btn btn-primary" type="submit">Simpan</button>
														<button class="btn btn-white" type="button" onclick="window.location.href='<?php echo site_url('module_procurement/admin/proses_permintaan/'); ?>'">Kembali</button>
													</div>
												</div>								
											</form>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<script type="text/javascript">
				
					$(".select2").select2({
						theme: "bootstrap"
					});
					
					table = $('#table').DataTable({
						"responsive": true,
						"searching": false,
						"paging": false,
						"info": false,
						"ordering": false,
						"language": {
							"url": "<?php echo base_url('assets/template/inspinia/js/plugins/dataTables/Indonesian.json'); ?>"
						}
					});
					
					table = $('#table-pic').DataTable({
						"responsive": true,
						"searching": false,
						"paging": false,
						"info": false,
						"ordering": false,
						"language": {
							"url": "<?php echo base_url('assets/template/inspinia/js/plugins/dataTables/Indonesian.json'); ?>"
						}
					});
					
				</script>
				<?php
					}elseif($this->input->get('view') == 'process'){
				?>
				<div class="row">
					<div class="col-md-12">
						<div class="ibox float-e-margins">
							<div class="ibox-title">
								<h4><?php echo strtoupper(str_replace('_',' ',$this->uri->segment(3))); ?></h4>
							</div>
							<div class="ibox-content">
								<div class="form-horizontal">
									<div class="form-group">
										<label class="col-md-3 control-label">Kode Permintaan</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Kode Permintaan" value="<?php echo $request_code; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<h4>Data Pemohon</h4>
									<div class="form-group">
										<label class="col-md-3 control-label">Nama Pemohon</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Nama Pemohon" value="<?php echo $request_employee_in_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Divisi</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Divisi" value="<?php echo $request_division_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Fungsi</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Fungsi" value="<?php echo $request_functions_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">PIC Modul Kontrak</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="PIC Modul Kontrak" value="<?php echo $request_pic_contract_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Approval Modul Kontrak</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Approval Modul Kontrak" value="<?php echo $request_pic_contract_approval_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Jenis Permintaan Kontrak</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Jenis Permintaan Kontrak" value="<?php echo $request_pic_contract_request_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Deskripsi Permintaan Kontrak</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Deskripsi Permintaan Kontrak" value="<?php echo $request_pic_contract_request_description_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<h4>Data Permintaan</h4>
									<div class="form-group">
										<label class="col-md-3 control-label">Metode</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Metode" value="<?php echo $request_category_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Jenis Permintaan</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Jenis Permintaan" value="<?php echo $request_type_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Tipe Kode</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Tipe Kode" value="<?php echo $request_cost_category_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Kode Proyek/Cost Center</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Kode Proyek/Cost Center" value="<?php echo $request_source_code; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Deskripsi Kode Proyek/Cost Center</label>
										<div class="col-md-9">
											<textarea class="form-control" placeholder="Deskripsi Kode Proyek/Cost Center" rows="3" maxlength="1000" onfocus="blur();" ><?php echo $request_source_code_description; ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Due Date</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Due Date" value="<?php echo $request_used_date; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Mata Uang</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Mata Uang" value="<?php echo $request_currency; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-3 control-label">Item Permintaan</label>
										<div class="col-md-9">
											<div class="table-responsive">
												<table class="display table-condensed nowrap" border="0">
													<thead>
														<tr>
															<th valign="top" align="center">No.</th>
															<th valign="top" align="center">Nama Barang/Jasa</th>
															<th valign="top" align="center">Jumlah</th>
															<th valign="top" align="center">Unit</th>
															<th valign="top" align="center">Estimasi Harga (IDR)</th>
															<th valign="top" align="center">Total (IDR)</th>
															<th valign="top" align="center">Spesifikasi</th>
															<th valign="top" align="center">Dokumen</th>
														</tr>
													</thead>
													<tbody>
														<?php
															$i = 0;
															unset($datato);														
															$datato['table'] = 'patlog__procurement.entity__request_det';																	
															$datato['where'] = array(
																'patlog__procurement.entity__request_det.request_id' => $request_id
															);
															$Q1 = $this->view->view_data($datato);
															if($Q1->num_rows()){
																foreach($Q1->result() as $R1){
														?>
														<tr>
															<td valign="top" align="left"><?php echo ($i+1).'.'; ?></td>
															<td valign="top" align="left"><?php echo $R1->request_det_item; ?></td>
															<td valign="top" align="center"><?php echo $R1->request_det_qty; ?></td>
															<td valign="top" align="left"><?php echo $R1->request_det_unit; ?></td>
															<td valign="top" align="right"><?php echo number_format($R1->request_det_estimate_price,0,',','.'); ?></td>
															<td valign="top" align="right"><?php echo number_format(($R1->request_det_qty * $R1->request_det_estimate_price),0,',','.'); ?></td>
															<td valign="top" align="left"><?php echo $R1->request_det_note; ?></td>
															<td valign="top">
																<div class="text-center">
																	<a href="<?php echo base_url('assets/mod__procurement/attach/request_document/'.$R1->request_det_attachment.'?time='.date('YmdHis')); ?>" class="btn btn-xs btn-default" target="_blank">
																		<i class="fa fa-eye"></i>
																	</a>
																</div>
															</td>
														</tr>
														<?php
																	$i++;
																}
															}else{
														?>
														<tr>
															<td colspan="9">
																<center>
																	Data tidak ditemukan.
																</center>
															</td>
														</tr>
														<?php
															}
														?>
													</body>
												</table>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Grand Total (Estimasi Harga)</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Grand Total (Estimasi Harga)" value="<?php echo number_format($request_grandtotal_estimate,0,',','.'); ?>" onfocus="blur();" />
										</div>
									</div>
									<?php
										unset($datato);
										$datato['table'] = 'patlog__procurement.entity__request_document';
										$datato['where'] = array(
											'patlog__procurement.entity__request_document.request_id' => $request_id,
											'patlog__procurement.entity__request_document.request_document_file != ' => 'no.pdf',
										);
										$Q1 = $this->view->view_data($datato);
										foreach($Q1->result() as $R1){
									?>
									<div class="form-group">
										<label class="col-md-3 control-label"><?php echo $R1->request_document_name; ?> <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/request-document-file/'.$R1->request_document_file.'?time='.date('YmdHis')); ?>" target="_blank">
												<i class="fa fa-eye"></i> Lihat
											</a>
											<button type="button" class="btn btn-sm btn-info btn-doc-history" data-request-document-id="<?php echo $R1->request_document_id; ?>" data-request-id="<?php echo $request_id; ?>" data-kind="document" data-doc-name="<?php echo htmlspecialchars($R1->request_document_name, ENT_QUOTES); ?>" title="Lihat riwayat dokumen">
												<i class="fa fa-history"></i> Riwayat
											</button>
										</div>
									</div>
									<?php
										}
									?>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-3 control-label">Catatan/Deskripsi Pekerjaan</label>
										<div class="col-md-9">
											<textarea class="form-control" placeholder="Catatan/Deskripsi Pekerjaan" rows="3" maxlength="1000" onfocus="blur();" ><?php echo $request_note; ?></textarea>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<h4>Proses Pengadaan</h4>
									<div class="form-group">
										<div class="col-md-8">
											<p class="text-info"><b>Catatan : Status Pengadaan yang dikerjakan oleh PIC Procurement</b></p>
										</div>
										<div class="col-md-4">
											<button type="button" class="btn btn-primary btn-sm pull-right add_vendor" data-toggle="modal" data-target="#modal_process">
												<i class="fa fa-plus"></i> Tambah Vendor
											</button>
										</div>
									</div>
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover" id="table">
											<thead>
												<tr>
													<th>Nama Vendor</th>
													<th>Tanggal Mulai</th>
													<th>Tanggal Selesai</th>
													<th>Estimasi Nilai</th>
													<th>Proses Terakhir</th>
													<th>Waktu Proses</th>
													<th>Aksi</th>										
												</tr>
											</thead>
											<tbody>
												<?php
													unset($datato);
													$datato['table'] = 'patlog__procurement.entity__request_legal';
													$datato['where'] = array(
														'patlog__procurement.entity__request_legal.request_id' => $request_id
													);
													$Q1 = $this->view->view_data($datato);
													if($Q1->num_rows()){
														foreach($Q1->result() as $R1){
															$encrypt_id = $this->encrypt->encode($R1->request_legal_id);
															$request_legal_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
															
															unset($datato);
															$datato['table'] = 'patlog__procurement.entity__request_process';
															$datato['where'] = array(
																'patlog__procurement.entity__request_process.request_id' => $R1->request_id,
																'patlog__procurement.entity__request_process.vendor_id' => $R1->vendor_id
															);
															$datato['order'] = array(
																'patlog__procurement.entity__request_process.request_process_created_date'
															);
															$datato['order_type'] = array(
																'desc'
															);
															$Q2 = $this->view->view_data($datato);
															if($Q2->num_rows()){
																$R2 = $Q2->row();
																$process_proc_id = $R2->process_proc_id;
																$request_process_proc_name = $R2->request_process_proc_name;
																$request_process_created_date = $R2->request_process_created_date;
															}else{
																$process_proc_id = null;
																$request_process_proc_name = null;
																$request_process_created_date = null;
															}
															
															unset($datato);
															$datato['table'] = 'patlog__procurement.data__process_proc';
															$datato['where'] = array(
																'patlog__procurement.data__process_proc.process_proc_id' => $process_proc_id,
																'patlog__procurement.data__process_proc.process_proc_flag' => 'yes'
															);
															$Q2 = $this->view->view_data($datato);
															if($Q2->num_rows()){
																$R2 = $Q2->row();
																$request_process_proc_name = '<div class="badge badge-primary">'.$request_process_proc_name.'</div>';
															}
															
															$process_proc_id_win = null;
															unset($datato);
															$datato['table'] = 'patlog__procurement.data__process_proc';
															$datato['where'] = array(
																'patlog__procurement.data__process_proc.process_proc_flag' => 'yes'
															);
															$Q2 = $this->view->view_data($datato);
															if($Q2->num_rows()){
																$R2 = $Q2->row();
																$process_proc_id_win = $R2->process_proc_id;
															}
															
															$winner = null;
															unset($datato);
															$datato['table'] = 'patlog__procurement.entity__request_process';
															$datato['where'] = array(
																'patlog__procurement.entity__request_process.request_id' => $R1->request_id,
																'patlog__procurement.entity__request_process.vendor_id' => $R1->vendor_id,
																'patlog__procurement.entity__request_process.process_proc_id' => $process_proc_id_win
															);
															$Q2 = $this->view->view_data($datato);
															if($Q2->num_rows()){
																$R2 = $Q2->row();
																$winner = '<br/><div class="badge badge-primary">Pemenang</div>';
															}
												?>
												<tr>
													<td><?php echo $R1->vendor_name.$winner; ?></td>
													<td><?php echo $R1->request_legal_date_start; ?></td>
													<td><?php echo $R1->request_legal_date_end; ?></td>
													<td><?php echo $request_currency.'. '.number_format($R1->request_legal_total_estimate,0,',','.'); ?></td>
													<td><?php echo $request_process_proc_name; ?></td>
													<td><?php echo $request_process_created_date; ?></td>
													<td>
														<a class="btn btn-sm btn-warning process_vendor" data-toggle="modal" data-target="#modal_process_attach" id="process_<?php echo $R1->request_legal_id; ?>" data-name="<?php echo $R1->vendor_name; ?>">
															<i class="fa fa-upload"></i>
														</a>
														<a class="btn btn-sm btn-info edit_vendor" data-toggle="modal" data-target="#modal_process" id="edit_<?php echo $R1->request_legal_id; ?>">
															<i class="fa fa-edit"></i>
														</a>
														<a class="btn btn-sm btn-danger delete_vendor" data-toggle="modal" data-target="#confirm" id="delete_<?php echo $request_legal_id; ?>" title="Hapus">
															<i class="fa fa-trash"></i>
														</a>
													</td>
												</tr>
												<?php
														}
													}
												?>
											</tbody>
										</table>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="row">
										<div class="col-md-6">
											<h3 class="m-t-none m-b">Log Aktivitas</h3>																					
											<div id="vertical-timeline" class="vertical-container dark-timeline">												
												<?php
													unset($datato);
													$datato['table'] = 'patlog__procurement.entity__request_log';
													$datato['where'] = array(
														'patlog__procurement.entity__request_log.request_id' => $request_id
													);
													$Q1 = $this->view->view_data($datato);
													foreach($Q1->result() as $R1){
														$request_log_created_date = $R1->request_log_created_date;
														$request_log_message = $R1->request_log_message;
														$request_log_name = $R1->request_log_name;
														$request_log_status = $R1->request_log_status; 
														$request_log_level = $R1->request_log_level; 
														$request_log_file = $R1->request_log_file; 
														
														if($request_log_status == 'Dibuat'){
															$color = 'text-default';
															$icon = 'far fa-file';
														}elseif($request_log_status == 'Diedit'){
															$color = 'yellow-bg';
															$icon = 'far fa-edit';
														}elseif($request_log_status == 'Disetujui'){
															$color = 'navy-bg';
															$icon = 'far fa-check-circle';
														}elseif($request_log_status == 'Ditolak'){
															$color = 'red-bg';
															$icon = 'fas fa-times-circle';
														}elseif($request_log_status == 'Dimapping oleh'){
															$color = 'yellow-bg';
															$icon = 'fas fa-share-alt';
														}elseif($request_log_status == 'Finish'){
															$color = 'blue-bg';
															$icon = 'fas fa-flag-checkered';
														}
												?>
												<div class="vertical-timeline-block">
													<div class="vertical-timeline-icon <?php echo $color; ?>">
														<i class="<?php echo $icon; ?>"></i>
													</div>
													<div class="vertical-timeline-content">
														<div class="pull-left">
															<span class="vertical-date small text-muted"><?php echo $request_log_created_date; ?></span><br>
															<p><?php echo $request_log_status; ?> <b><?php echo $request_log_name; ?></b></p>
															<p><?php echo $request_log_message; ?></p>
														</div>
														<div class="pull-right">
															<?php
																if($request_log_file != null){
															?>
															<a class="btn btn-sm" href="<?php echo base_url('assets/mod__procurement/attach/request-log-file/'.$request_log_file.'?time='.date('YmdHis')); ?>" target="_blank">
																<i class="fa fa-file fa-2x text-danger"></i> 
															</a>
															<?php
																}
															?>
														</div>
													</div>
												</div>
												<?php
													}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<style type="text/css">
				
					.select2-container {
						z-index: 99999;
					}
					
					.popover {
						z-index: 99999;
					}
					
				</style>
				
				<!-- Modal Proses -->
				<div class="modal fade" id="modal_process">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button class="close" data-dismiss="modal">
									&times;
								</button>
								<h4 class="modal-title">Proses Vendor</h4>
							</div>
							<div class="modal-body">
								<form method="post" id="form-vendor" class="form-horizontal" action="#" enctype="multipart/form-data">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" required="">
									<div class="form-group">
										<label class="col-md-3 control-label">Data Vendor <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<select class="form-control select2" name="vendor_id" id="vendor_id" style="width:100%;" required>
												<option selected disabled value="">--Pilih--</option>
												
											</select>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-3 control-label">Tanggal Mulai <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control date" name="request_legal_date_start" id="request_legal_date_start" placeholder="Tanggal Mulai" required onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Tanggal Selesai <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control date" name="request_legal_date_end" id="request_legal_date_end" placeholder="Tanggal Selesai" required onfocus="blur();" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<div class="col-md-9 col-md-offset-3">
											<button class="btn btn-primary ladda-button" type="submit" data-style="zoom-in" id="submit-btn">Simpan</button>
											<button class="btn btn-white" type="button" data-dismiss="modal">Batal</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
				<!-- Modal Proses Dokumen -->
				<div class="modal fade" id="modal_process_attach">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button class="close" data-dismiss="modal">
									&times;
								</button>
								<h4 class="modal-title">Proses Dokumen</h4>
							</div>
							<div class="modal-body">
								<form method="post" class="form-horizontal" action="<?php echo site_url('module_procurement/admin_functions/request_process_attach/add/'.$this->input->get('request_id')); ?>" enctype="multipart/form-data">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" required="">
									<input type="hidden" name="request_legal_id" id="request_legal_id" />
									<p class="text-center"><b>Data Dokumen</b></p>
									<p class="text-left"><h4 id="data_vendor_name">Nama Vendor : </h4></p>
									<table class="table table-hover table-bordered" id="table-document" style="width:100%;">
										<thead>
											<tr>
												<th>Nama Proses</th>
												<th>Tanggal</th>
												<th>Jam</th>
												<th>Dokumen</th>
												<th>Keterangan</th>
												<th>Aksi</th>														
											</tr>
										</thead>
										<tbody>
											
										</tbody>
									</table>
									<table class="table table-hover table-bordered" id="table-official" style="width:100%;">
										<thead>
											<tr>
												<th>Penandatangan</th>
												<th>Jabatan</th>
												<th>Nilai Estimasi</th>														
											</tr>
										</thead>
										<tbody>
											
										</tbody>
									</table>
									<div class="hr-line-dashed"></div>
									<p class="text-center"><b>Upload Dokumen</b></p>
									<div class="form-group">
										<label class="col-md-3 control-label">Nama Proses <span class="text-danger">*</span></label>																						
										<div class="col-md-9">
											<select class="form-control select2" name="process_proc_id" id="process_proc_id" style="width:100%;" required>
												<option selected disabled value="">--Pilih--</option>
												<?php
													unset($datato);
													$datato['table'] = 'patlog__procurement.data__process_proc';
													$Q1 = $this->view->view_data($datato);
													foreach($Q1->result() as $R1){
												?>
												<option value="<?php echo urlencode($R1->process_proc_id); ?>"><?php echo $R1->process_proc_name; ?></option>
												<?php
													}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Tanggal <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control date" name="request_process_proc_date" placeholder="Tanggal" required onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Jam <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control clockpicker" name="request_process_proc_time" placeholder="Jam" required onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Dokumen <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="file" class="form-control" name="request_process_attach_file" accept=".pdf" required />
										</div>
									</div>
									<div id="for-winner">
										<div class="hr-line-dashed"></div>
										<div class="form-group">
											<label class="col-md-3 control-label">Penandatangan <span class="text-danger">*</span></label>
											<div class="col-md-9">
												<input type="text" class="form-control" name="request_legal_user_name" id="request_legal_user_name" placeholder="Penandatangan" required />
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Jabatan <span class="text-danger">*</span></label>
											<div class="col-md-9">
												<input type="text" class="form-control" name="request_legal_user_position" id="request_legal_user_position" placeholder="Jabatan" required />
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Esitimasi Nilai <span class="text-danger">*</span></label>
											<div class="col-md-9">
												<input type="number" class="form-control" name="request_legal_total_estimate" id="request_legal_total_estimate" placeholder="Esitimasi Nilai" required />
											</div>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-3 control-label">Keterangan <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<textarea class="form-control" name="request_process_attach_description" placeholder="Keterangan" rows="3" maxlength="1000" required></textarea>
											<span class="help-block m-b-none"><span class="text-warning">*</span> maksimal 1000 karakter.</span>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<div class="col-md-9 col-md-offset-3">
											<button class="btn btn-primary ladda-button" type="submit" data-style="zoom-in" id="submit-btn">Simpan</button>
											<button class="btn btn-white" type="button" data-dismiss="modal">Batal</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
				<script type="text/javascript">
				
					$(".select2").select2({
						theme: "bootstrap"
					});
					
					$('.date').datepicker({
						format: "yyyy-mm-dd",
						startView: 2,
						maxViewMode: 2,
						todayBtn: "linked",
						language: "id",
						keyboardNavigation: false,
						forceParse: false,
						autoclose: true,
						todayHighlight: true
					});
					
					$('.clockpicker').clockpicker({
						autoclose: true
					});
					
					table = $('#table').DataTable({
						"responsive": true,
						"searching": false,
						"paging": false,
						"info": false,
						"ordering": false,
						"language": {
							"url": "<?php echo base_url('assets/template/inspinia/js/plugins/dataTables/Indonesian.json'); ?>"
						}
					});
					
					$(document).on('click','.add_vendor',function(e){
						e.preventDefault();
						$.ajax({
							type: 'POST',
							data: {
								'request_id' : '<?php echo $this->input->get('request_id'); ?>',
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							url: "<?php echo site_url(); ?>module_procurement/admin_functions/get_input_request_legal/",
							success: function(result){
								var data = JSON.parse(result);
								$("#vendor_id").val('').trigger('change');
								$("#vendor_id").html(data['vendor']);
								$("#request_legal_date_start").val('');
								$("#request_legal_date_end").val('');
								
								const form_vendor = document.getElementById('form-vendor');
								form_vendor.action = '<?php echo site_url('module_procurement/admin_functions/request_vendor/add/'.$this->input->get('request_id').'/'); ?>';
							}
						});
					});
					
					$(document).on('click','.edit_vendor',function(e){
						e.preventDefault();
						var id=this.id.substr(5);
						$.ajax({
							type: 'POST',
							data: {
								'request_id' : '<?php echo $this->input->get('request_id'); ?>',
								'request_legal_id' : id,
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							url: "<?php echo site_url(); ?>module_procurement/admin_functions/get_input_request_legal/",
							success: function(result){
								var data = JSON.parse(result);
								$("#vendor_id").val(data['vendor_id']).trigger('change');
								$("#vendor_id").html(data['vendor']);
								$("#request_legal_date_start").val(data['request_legal_date_start']);
								$("#request_legal_date_end").val(data['request_legal_date_end']);
								
								const form_vendor = document.getElementById('form-vendor');
								form_vendor.action = '<?php echo site_url('module_procurement/admin_functions/request_vendor/edit/'); ?>' + id;
							}
						});
					});
					
					$(document).on('click','.process_vendor',function(e){
						e.preventDefault();
						var id=this.id.substr(8);
						const data_vendor_name = 'Nama Vendor : ' + this.getAttribute('data-name');
						document.getElementById("data_vendor_name").innerHTML = data_vendor_name;
						
						$('#request_legal_id').val(id);
						$('#table-document').DataTable().clear();
						$('#table-document').DataTable().destroy();
						table = $('#table-document').DataTable({
							"processing": true, 
							"responsive": true,
							"serverSide": true,
							"searching": false,
							"paging": false,
							"info": false,
							"ordering": false,
							"order": [],
							"ajax": {
								"url": "<?php echo site_url('module_procurement/admin_functions/get_table_request_process_attach/')?>",
								"data": {
									"request_legal_id" : id,
									"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
								},
								"type": "POST"
							},
							"columnDefs": [
								{ 
									"targets": [ 3, 5 ],
									"orderable": false
								},
							],
							"language": {
								"url": "<?php echo base_url('assets/template/inspinia/js/plugins/dataTables/Indonesian.json'); ?>"
							}
						});
						
						$('#table-official').DataTable().clear();
						$('#table-official').DataTable().destroy();
						table = $('#table-official').DataTable({
							"processing": true, 
							"responsive": true,
							"serverSide": true,
							"searching": false,
							"paging": false,
							"info": false,
							"ordering": false,
							"order": [],
							"ajax": {
								"url": "<?php echo site_url('module_procurement/admin_functions/get_table_official/')?>",
								"data": {
									"request_legal_id" : id,
									"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
								},
								"type": "POST"
							},
							"columnDefs": [
								{ 
									"targets": [ 0 ],
									"orderable": false
								},
							],
							"language": {
								"url": "<?php echo base_url('assets/template/inspinia/js/plugins/dataTables/Indonesian.json'); ?>"
							}
						});
					});
					
					$("#process_proc_id").change(function(){
						$.ajax({
							type: 'POST',
							data: {
								process_proc_id: $("#process_proc_id").val(),
								request_legal_id: $("#request_legal_id").val(),
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							url: "<?php echo site_url(); ?>module_procurement/admin_functions/get_input_official/",
							success: function(result){
								var data = JSON.parse(result);
								if(data['status'] == 'true'){
									$("#for-winner").show();
									$("#request_legal_user_name").val(data['request_legal_user_name']);
									$("#request_legal_user_name").prop('disabled', false);
									$("#request_legal_user_name").prop('required', true);
									$("#request_legal_user_position").val(data['request_legal_user_position']);
									$("#request_legal_user_position").prop('disabled', false);
									$("#request_legal_user_position").prop('required', true);
									$("#request_legal_total_estimate").val(data['request_legal_total_estimate']);
									$("#request_legal_total_estimate").prop('disabled', false);
									$("#request_legal_total_estimate").prop('required', true);
								}else{
									$("#for-winner").hide();
									$("#request_legal_user_name").val('');
									$("#request_legal_user_name").prop('disabled', true);
									$("#request_legal_user_name").prop('required', false);
									$("#request_legal_user_position").val('');
									$("#request_legal_user_position").prop('disabled', true);
									$("#request_legal_user_position").prop('required', false);
									$("#request_legal_total_estimate").val('');
									$("#request_legal_total_estimate").prop('disabled', true);
									$("#request_legal_total_estimate").prop('required', false);
								}
								
							}
						});
					});
					
					$(document).ready(function () {
						$("#for-winner").hide();
						$("#request_legal_user_name").val('');
						$("#request_legal_user_name").prop('disabled', true);
						$("#request_legal_user_name").prop('required', false);
						$("#request_legal_user_position").val('');
						$("#request_legal_user_position").prop('disabled', true);
						$("#request_legal_user_position").prop('required', false);
						$("#request_legal_total_estimate").val('');
						$("#request_legal_total_estimate").prop('disabled', true);
						$("#request_legal_total_estimate").prop('required', false);
						
						$(document).on('click','.delete_vendor',function(e){
							e.preventDefault();
							$('#confirm_str').html('Apakah anda yakin ingin menghapus data ini?');
							$('#delete').show();
							$('#delete_all').hide();
							var id=this.id.substr(7);
							$('#id').val(id);
							$('#from').val('vendor');
						});
						
						$(document).on('click','.delete_attach',function(e){
							e.preventDefault();
							$('#confirm_str').html('Apakah anda yakin ingin menghapus data ini?');
							$('#delete').show();
							$('#delete_all').hide();
							var id=this.id.substr(14);
							$('#id').val(id);
							$('#from').val('attach');
						});
						
						$('#delete').click(function() {
							if($('#from').val() == 'vendor'){
								window.location = '<?php echo site_url(); ?>module_procurement/admin_functions/request_vendor/delete/' + $('#id').val();
							}else if($('#from').val() == 'attach'){
								window.location = '<?php echo site_url(); ?>module_procurement/admin_functions/request_process_attach/delete/' + $('#id').val();
							}
						});
					});
					
				</script>
				<?php
					}else{
				?>
				<div class="row">
					<div class="col-md-12">
						<div class="ibox float-e-margins">
							<div class="ibox-title clearfix">
								<div class="pull-left">
									<h4><?php echo strtoupper(str_replace('_',' ',$this->uri->segment(3))); ?></h4>
								</div>
								<div class="pull-right">
									
								</div>
							</div>
							<div class="ibox-content">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="table">
										<thead>
											<tr>
												<th>Kode Permintaan</th>
												<th>Jenis Permintaan</th>
												<th>Tanggal</th>
												<th>Pemohon</th>
												<th>Kode Proyek/Cost Center</th>
												<th>Total Estimasi</th>
												<th>PIC Procurement</th>
												<th>Status</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<script type="text/javascript">
				
					table = $('#table').DataTable({
						"processing": true, 
						"responsive": true, 
						"serverSide": true,
						"order": [],
						"ajax": {
							"url": "<?php echo site_url('module_procurement/admin_functions/get_table_request_process/')?>",
							"data": {
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							"type": "POST"
						},
						"columnDefs": [
							{ 
								"targets": [ 8 ],
								"orderable": false
							},
						],
						"language": {
							"url": "<?php echo base_url('assets/template/inspinia/js/plugins/dataTables/Indonesian.json'); ?>"
						}
					});
					
					$(document).ready(function () {
						$(document).on('click','.undo',function(e){
							e.preventDefault();
							$('#confirm_str').html('Apakah anda yakin ingin mengembalikan data ini?');
							$('#delete').show();
							$('#delete_all').hide();
							var id=this.id.substr(5);
							$('#id').val(id);
							$('#from').val('undo');
						});
						
						$(document).on('click','.delete',function(e){
							e.preventDefault();
							$('#confirm_str').html('Apakah anda yakin ingin menghapus data ini?');
							$('#delete').show();
							$('#delete_all').hide();
							var id=this.id.substr(7);
							$('#id').val(id);
							$('#from').val('delete');
						});
						
						$(document).on('click','.cancel',function(e){
							e.preventDefault();
							$.ajax({
								type: 'POST',
								data: {
									"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>',
									request_id: this.id.substr(7)
								},
								url: "<?php echo site_url(); ?>module_procurement/admin_functions/get_modal_cancel/",
								success: function(result){
									var data = JSON.parse(result);
									$(".isi").html(data['isi']);
								}
							});
						});
						
						$(document).on('click','.finish',function(e){
							e.preventDefault();
							$.ajax({
								type: 'POST',
								data: {
									"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>',
									request_id: this.id.substr(7)
								},
								url: "<?php echo site_url(); ?>module_procurement/admin_functions/get_modal_finish/",
								success: function(result){
									var data = JSON.parse(result);
									$('.isi').html(data['isi']);
								}
							});
						});
						
						$('#delete').click(function() {
							if($('#from').val() == 'undo'){
								window.location = '<?php echo site_url(); ?>module_procurement/admin_functions/request_undo/' + $('#id').val();
							}else if($('#from').val() == 'delete'){
								window.location = '<?php echo site_url(); ?>module_procurement/admin_functions/request/delete/' + $('#id').val();
							}
						});

						$(document).on('click', '.btn-doc-history', function(){
							var $btn = $(this);
							var docName = $btn.data('doc-name') || 'Dokumen';
							$('#doc_history_title').text('Riwayat: ' + docName);
							$('#doc_history_body').html('<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Memuat...</div>');
							$('#modal_doc_history').modal('show');
							$.ajax({
								type: 'GET',
								url: '<?php echo site_url(); ?>module_procurement/admin_functions/get_document_history',
								data: {
									request_document_id: $btn.data('request-document-id'),
									request_id: $btn.data('request-id'),
									kind: $btn.data('kind')
								},
								success: function(result){
									var res = (typeof result === 'string') ? JSON.parse(result) : result;
									if(!res.data || res.data.length === 0){
										$('#doc_history_body').html('<div class="alert alert-info" style="margin:0;">Belum ada riwayat perubahan untuk dokumen ini.</div>');
										return;
									}
									var html = '<div class="table-responsive"><table class="table table-bordered table-striped"><thead><tr><th>Waktu</th><th>Aksi</th><th>Oleh</th><th>Peran</th><th>Catatan</th><th>File</th></tr></thead><tbody>';
									for(var i=0;i<res.data.length;i++){
										var r = res.data[i];
										html += '<tr>'
											+ '<td>'+(r.created_date||'-')+'</td>'
											+ '<td>'+(r.action||'-')+'</td>'
											+ '<td>'+(r.by_name||'-')+'</td>'
											+ '<td>'+(r.by_role||'-')+'</td>'
											+ '<td>'+(r.note?r.note:'-')+'</td>'
											+ '<td><a class="btn btn-xs btn-default" href="'+r.file_url+'" target="_blank"><i class="fa fa-download"></i> Unduh</a></td>'
											+ '</tr>';
									}
									html += '</tbody></table></div>';
									$('#doc_history_body').html(html);
								},
								error: function(){
									$('#doc_history_body').html('<div class="alert alert-danger" style="margin:0;">Gagal memuat riwayat.</div>');
								}
							});
						});
					});
					
				</script>
				<div class="modal fade" id="modal_doc_history" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title" id="doc_history_title">Riwayat Dokumen</h4>
							</div>
							<div class="modal-body" id="doc_history_body"></div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>
						</div>
					</div>
				</div>
				<?php
					}
				?>