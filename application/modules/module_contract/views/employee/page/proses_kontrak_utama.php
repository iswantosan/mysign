				<?php
					$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->get('contract_id'));
					$contract_id = $this->encrypt->decode($decrypt_id);

					unset($datato);
					$datato['table'] = 'patlog__contract.entity__contract';
					$datato['where'] = array(
						'patlog__contract.entity__contract.contract_id' => $contract_id
					);
					$Q1 = $this->view->view_data($datato);
					if($Q1->num_rows()){
						$R1 = $Q1->row();
						$contract_id = $R1->contract_id;
						$contract_no = $R1->contract_no;
						$contract_date = $R1->contract_date;
						$contract_date_loket = $R1->contract_date_loket;
						$contract_creator_employee_in_id = $R1->contract_creator_employee_in_id;
						$contract_creator_employee_in_code = $R1->contract_creator_employee_in_code;
						$contract_creator_employee_in_name = $R1->contract_creator_employee_in_name;
						$contract_creator_employee_in_position = $R1->contract_creator_employee_in_position;
						$contract_creator_division_id = $R1->contract_creator_division_id;
						$contract_creator_division_name = $R1->contract_creator_division_name;
						$contract_category_id = $R1->contract_category_id;
						$contract_category_to = $R1->contract_category_to;
						$contract_request_id = $R1->contract_request_id;
						$contract_request_name = $R1->contract_request_name;
						$contract_request_description_id = $R1->contract_request_description_id;
						$contract_request_description_name = $R1->contract_request_description_name;
						$contract_project_code_category = $R1->contract_project_code_category;
						$contract_project_code_id = $R1->contract_project_code_id;
						$contract_project_code_name = $R1->contract_project_code_name;
						$contract_project_code_description = $R1->contract_project_code_description;
						$contract_date_start = $R1->contract_date_start;
						$contract_date_end = $R1->contract_date_end;
						$contract_period = $R1->contract_period;
						$contract_project_currency = $R1->contract_project_currency;
						$contract_project_cost = $R1->contract_project_cost;
						$contract_project_calculate = $R1->contract_project_calculate;
						$contract_project_note = $R1->contract_project_note;
						$contract_third_party_id = $R1->contract_third_party_id;
						$contract_third_party_name = $R1->contract_third_party_name;
						$contract_company_name = $R1->contract_company_name;
						$contract_user_name = $R1->contract_user_name;
						$contract_user_position = $R1->contract_user_position;
						$contract_active_start_date = $R1->contract_active_start_date;
						$contract_active_end_date = $R1->contract_active_end_date;
						$contract_ttd_place = $R1->contract_ttd_place;
						$contract_ttd_date = $R1->contract_ttd_date;
						$contract_no_fix = $R1->contract_no_fix;
						$contract_document_in = $R1->contract_document_in;
						$contract_summary_file_name = $R1->contract_summary_file_name;
						$contract_summary_file_ttd = $R1->contract_summary_file_ttd;
						$contract_summary_file_final = $R1->contract_summary_file_final;
						$contract_ttd_sign_type = $R1->contract_ttd_sign_type;
						$contract_ttd_sign_trigger = $R1->contract_ttd_sign_trigger;
						$contract_ttd_sign_token = $R1->contract_ttd_sign_token;
						$contract_ttd_sign_url = $R1->contract_ttd_sign_url;
						$contract_ttd_sign_link = $R1->contract_ttd_sign_link;
						$contract_ttd_sign_download = $R1->contract_ttd_sign_download;
						$contract_ttd_sign_date_sign = $R1->contract_ttd_sign_date_sign;
						$contract_ttd_sign_date_expired = $R1->contract_ttd_sign_date_expired;
						$contract_ttd_sign_status = $R1->contract_ttd_sign_status;
						$contract_ttd_sign_callback = $R1->contract_ttd_sign_callback;
						$contract_approval_select_id = $R1->contract_approval_select_id;
						$contract_approval_select_name = $R1->contract_approval_select_name;
						$contract_approval_current_id = $R1->contract_approval_current_id;
						$contract_approval_current_name = $R1->contract_approval_current_name;
						$contract_approval_current_category = $R1->contract_approval_current_category;
						$contract_approval_current_sign = $R1->contract_approval_current_sign;
						$contract_data_id = $R1->contract_data_id;
						$contract_data_code = $R1->contract_data_code;
						$contract_data_from = $R1->contract_data_from;
						$contract_approver_level = $R1->contract_approver_level;
						$contract_approver_message = $R1->contract_approver_message;
						$contract_status_drafter = $R1->contract_status_drafter;
						$contract_status_done = $R1->contract_status_done;
						$contract_status_delete = $R1->contract_status_delete;
						$contract_insert = $R1->contract_insert;
						$contract_update = $R1->contract_update;
					}else{
						$contract_id = '';
						$contract_no = '';
						$contract_date = '';
						$contract_date_loket = '';
						$contract_creator_employee_in_id = '';
						$contract_creator_employee_in_code = '';
						$contract_creator_employee_in_name = '';
						$contract_creator_employee_in_position = '';
						$contract_creator_division_id = '';
						$contract_creator_division_name = '';
						$contract_category_id = '';
						$contract_category_to = '';
						$contract_request_id = '';
						$contract_request_name = '';
						$contract_request_description_id = '';
						$contract_request_description_name = '';
						$contract_project_code_category = '';
						$contract_project_code_id = '';
						$contract_project_code_name = '';
						$contract_project_code_description = '';
						$contract_date_start = '';
						$contract_date_end = '';
						$contract_period = '';
						$contract_project_currency = '';
						$contract_project_cost = '';
						$contract_project_calculate = '';
						$contract_project_note = '';
						$contract_third_party_id = '';
						$contract_third_party_name = '';
						$contract_company_name = '';
						$contract_user_name = '';
						$contract_user_position = '';
						$contract_active_start_date = '';
						$contract_active_end_date = '';
						$contract_ttd_place = '';
						$contract_ttd_date = '';
						$contract_no_fix = '';
						$contract_document_in = '';
						$contract_summary_file_name = '';
						$contract_summary_file_ttd = '';
						$contract_summary_file_final = '';
						$contract_ttd_sign_type = '';
						$contract_ttd_sign_trigger = '';
						$contract_ttd_sign_token = '';
						$contract_ttd_sign_url = '';
						$contract_ttd_sign_link = '';
						$contract_ttd_sign_download = '';
						$contract_ttd_sign_date_sign = '';
						$contract_ttd_sign_date_expired = '';
						$contract_ttd_sign_status = '';
						$contract_ttd_sign_callback = '';
						$contract_approval_select_id = '';
						$contract_approval_select_name = '';
						$contract_approval_current_id = '';
						$contract_approval_current_name = '';
						$contract_approval_current_category = '';
						$contract_approval_current_sign = '';
						$contract_data_id = '';
						$contract_data_code = '';
						$contract_data_from = '';
						$contract_approver_level = '';
						$contract_approver_message = '';
						$contract_status_drafter = '';
						$contract_status_done = '';
						$contract_status_delete = '';
						$contract_insert = '';
						$contract_update = '';
					}
				?>
				<?php
					if($this->input->get('view') == 'manipulation'){
						if($contract_data_id != null){
							$blur = 'onfocus="blur();"';
							$disabled = 'disabled';
						}else{
							$blur = '';
							$disabled = '';
						}
				?>
				<div class="row">
					<div class="col-md-12">
						<div class="ibox float-e-margins">
							<div class="ibox-title clearfix">
								<div class="pull-left">
									<h4><?php echo strtoupper(str_replace('_',' ',$this->uri->segment(3))); ?></h4>
								</div>
								<div class="pull-right">
									<h4>Kode : <?php echo $contract_no; ?></h4>
								</div>
							</div>
							<div class="ibox-content">
								<form method="post" class="form-horizontal" action="<?php echo site_url('module_contract/employee_functions/contract/'.$this->input->get('action').'/'.$this->input->get('contract_id')); ?>" enctype="multipart/form-data">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" required />
									<div class="form-group">
										<label class="col-md-3 control-label">Pemohon <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Pemohon" value="<?php echo $contract_creator_employee_in_name; ?>" onfocus="blur();" required />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Approval <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<select class="form-control select2" name="contract_approval_select_id" id="contract_approval_select_id" style="width:100%;" required>
												<option selected disabled value="">--Pilih--</option>
												<?php
													unset($datato);
													$datato['table'] = 'patlog__config.entity__approval';
													$datato['where'] = array(
														'patlog__config.entity__approval.division_id' => $contract_creator_division_id,
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
														if($contract_approval_select_id == $R1->approval_id){
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
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-3 control-label">Ditujukan Kepada <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<select class="form-control select2" name="contract_category_id" style="width:100%;" required>
												<option selected disabled value="">--Pilih--</option>
												<?php
													unset($datato);
													$datato['table'] = 'patlog__contract.entity__category';
													$datato['order'] = array(
														'patlog__contract.entity__category.category_name'
													);
													$datato['order_type'] = array(
														'asc'
													);
													$Q1 = $this->view->view_data($datato);
													foreach($Q1->result() as $R1){
														if($contract_category_id == $R1->category_id){
															$selected = 'selected';
														}else{
															$selected = '';
														}
												?>
												<option value="<?php echo urlencode($R1->category_id); ?>" <?php echo $selected; ?>><?php echo $R1->category_to; ?></option>
												<?php
													}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Jenis Permintaan <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<select class="form-control select2" name="contract_request_id" id="contract_request_id" style="width:100%;" required>
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
														if($contract_request_id == $R1->request_id){
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
										<label class="col-md-3 control-label">Deskripsi Permintaan <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<select class="form-control select2" name="contract_request_description_id" id="contract_request_description_id" style="width:100%;" required>
												<option selected disabled value="">--Pilih--</option>
												<?php
													unset($datato);
													$datato['table'] = 'patlog__contract.entity__request_description';
													$datato['where'] = array(
														'patlog__contract.entity__request_description.request_id' => $contract_request_id
													);
													$datato['order'] = array(
														'patlog__contract.entity__request_description.request_description_name'
													);
													$datato['order_type'] = array(
														'asc'
													);
													$Q1 = $this->view->view_data($datato);
													foreach($Q1->result() as $R1){
														if($contract_request_description_id == $R1->request_description_id){
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
									<div class="form-group">
										<label class="col-md-3 control-label">Jenis Kode <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<?php
												if($contract_data_id != null){
											?>
											<input type="text" class="form-control" placeholder="Jenis Kode" name="contract_project_code_category" value="<?php echo $contract_project_code_category; ?>" required <?php echo $blur; ?> />
											<?php
												}else{
											?>
											<select class="form-control select2" name="contract_project_code_category" id="contract_project_code_category" style="width:100%;" required>
												<option selected disabled value="">--Pilih--</option>
												<option value="<?php echo urlencode('Internal'); ?>" <?php if($contract_project_code_category == 'Internal'){ echo 'selected'; } ?>>Internal</option>
												<option value="<?php echo urlencode('External'); ?>" <?php if($contract_project_code_category == 'External'){ echo 'selected'; } ?>>Eksternal</option>
											</select>
											<?php
												}
											?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Kode <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<?php
												if($contract_data_id != null){
											?>
											<input type="text" class="form-control" placeholder="Kode" value="<?php echo $contract_project_code_name; ?>" required <?php echo $blur; ?> />
											<input type="hidden" class="form-control" name="contract_project_code_id" value="<?php echo $contract_project_code_id; ?>" required />
											<?php
												}else{
											?>
											<select class="form-control select2" name="contract_project_code_id" id="contract_project_code_id" style="width:100%;" required>
												<option selected disabled value="">--Pilih--</option>
												<?php
													if($contract_project_code_category == 'External'){
														unset($datato);
														$datato['table'] = 'patlog__project.entity__project_code';
														$datato['where'] = array(
															'patlog__project.entity__project_code.project_code_status' => 'yes'
														);
														$datato['order'] = array(
															'patlog__project.entity__project_code.project_code_name'
														);
														$datato['order_type'] = array(
															'asc'
														);
														$Q1 = $this->view->view_data($datato);
														foreach($Q1->result() as $R1){
															if($contract_project_code_id == $R1->project_code_id){
																$selected = 'selected';
															}else{
																$selected = '';
															}
												?>
												<option value="<?php echo urlencode($R1->project_code_id); ?>" <?php echo $selected; ?>><?php echo $R1->project_code_name; ?></option>
												<?php
														}
													}elseif($contract_project_code_category == 'Internal'){
														unset($datato);
														$datato['table'] = 'patlog__project.entity__cost_center';
														$datato['where'] = array(
															'patlog__project.entity__cost_center.cost_center_status' => 'yes'
														);
														$datato['order'] = array(
															'patlog__project.entity__cost_center.cost_center_name'
														);
														$datato['order_type'] = array(
															'asc'
														);
														$Q1 = $this->view->view_data($datato);
														foreach($Q1->result() as $R1){
															if($contract_project_code_id == $R1->cost_center_id){
																$selected = 'selected';
															}else{
																$selected = '';
															}
												?>
												<option value="<?php echo urlencode($R1->cost_center_id); ?>" <?php echo $selected; ?>><?php echo $R1->cost_center_name; ?></option>
												<?php
														}
													}
												?>
											</select>
											<?php
												}
											?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Nama Proyek <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<textarea class="form-control" name="contract_project_code_description" id="contract_project_code_description" placeholder="Nama Proyek" rows="3" required onfocus="blur();"><?php echo $contract_project_code_description; ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Tanggal Mulai</label>
										<div class="col-md-9">
											<input type="text" class="form-control date" name="contract_date_start" id="contract_date_start" placeholder="Tanggal Mulai" value="<?php echo $contract_date_start; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Tanggal Selesai</label>
										<div class="col-md-9">
											<input type="text" class="form-control date" name="contract_date_end" id="contract_date_end" placeholder="Tanggal Selesai" value="<?php echo $contract_date_end; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Periode (Hari)</label>
										<div class="col-md-9">
											<input type="text" class="form-control" id="contract_period" placeholder="Periode (Hari)" value="<?php echo $contract_period; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Mata Uang <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<?php
												if($contract_data_id != null){
											?>
											<input type="text" class="form-control" placeholder="Mata Uang" name="contract_project_currency" value="<?php echo $contract_project_currency; ?>" required <?php echo $blur; ?> />
											<?php
												}else{
											?>
											<select class="form-control select2" name="contract_project_currency" id="contract_project_currency" style="width:100%;" required >
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
														if($R1->country_currency_code == $contract_project_currency){
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
											<?php
												}
											?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Estimasi Total Nilai Pekerjaan <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="number" class="form-control" name="contract_project_cost" id="contract_project_cost" placeholder="Estimasi Total Nilai Pekerjaan" min="1" step="0.001" value="<?php echo $contract_project_cost; ?>" required <?php echo $blur; ?> />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Terbilang <span class="text-warning">*</span></label>
										<div class="col-md-9">
											<textarea class="form-control" id="contract_project_calculate" placeholder="Terbilang" rows="3" maxlength="1000" required onfocus="blur();"><?php echo $contract_project_calculate; ?></textarea>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-3 control-label">Catatan</label>
										<div class="col-md-9">
											<textarea class="form-control" name="contract_project_note" placeholder="Catatan" rows="3"><?php echo $contract_project_note; ?></textarea>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-3 control-label">Kebutuhan Untuk <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<?php
												if($contract_data_id != null){
											?>
											<input type="text" class="form-control" placeholder="Kebutuhan Untuk" value="<?php echo $contract_third_party_name; ?>" required <?php echo $blur; ?> />
											<input type="hidden" class="form-control" name="contract_third_party_id" value="<?php echo $contract_third_party_id; ?>" required />
											<?php
												}else{
											?>
											<select class="form-control select2" name="contract_third_party_id" id="contract_third_party_id" style="width:100%;" required>
												<option selected disabled value="">--Pilih--</option>
												<?php
													unset($datato);
													$datato['table'] = 'patlog__contract.entity__third_party';
													$datato['order'] = array(
														'patlog__contract.entity__third_party.third_party_name'
													);
													$datato['order_type'] = array(
														'asc'
													);
													$Q1 = $this->view->view_data($datato);
													foreach($Q1->result() as $R1){
														if($contract_third_party_id == $R1->third_party_id){
															$selected = 'selected';
														}else{
															$selected = '';
														}
												?>
												<option value="<?php echo urlencode($R1->third_party_id); ?>" <?php echo $selected; ?>><?php echo $R1->third_party_name; ?></option>
												<?php
													}
												?>
											</select>
											<?php
												}
											?>
										</div>
									</div>
									<?php
										if($contract_data_id != null){
									?>
									<div class="form-group">
										<label class="col-md-3 control-label">Nomor PR (Pengadaan) <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Nomor PR (Pengadaan)" value="<?php echo $contract_data_code; ?>" required <?php echo $blur; ?> />
										</div>
									</div>
									<?php
										}
									?>
									<div class="form-group">
										<label class="col-md-3 control-label">Nama Perusahaan <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" name="contract_company_name" placeholder="Nama Perusahaan" value="<?php echo $contract_company_name; ?>" required <?php echo $blur; ?> />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Penandatangan <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" name="contract_user_name" placeholder="Penandatangan" value="<?php echo $contract_user_name; ?>" required <?php echo $blur; ?> />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Jabatan <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" name="contract_user_position" placeholder="Jabatan" value="<?php echo $contract_user_position; ?>" required <?php echo $blur; ?> />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div id="form-document">
										<?php
											$i = 0;
											unset($datato);
											$datato['table'] = 'patlog__contract.entity__contract_document';
											$datato['where'] = array(
												'patlog__contract.entity__contract_document.contract_id' => $contract_id
											);
											$datato['order'] = array(
												'patlog__contract.entity__contract_document.contract_document_order'
											);
											$datato['order_type'] = array(
												'asc'
											);
											$Q1 = $this->view->view_data($datato);
											foreach($Q1->result() as $R1){
												if($R1->contract_document_mandatory == 'yes'){
													if($R1->contract_document_file != 'no.pdf'){
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
											<label class="col-md-3 control-label"><?php echo $R1->contract_document_name; ?> <?php echo $detail; ?></label>
											<div class="col-md-7">
												<input type="file" class="form-control" name="contract_document_file[<?php echo $i; ?>]" <?php echo $required; ?>/>
												<input type="hidden" name="contract_document_id[<?php echo $i; ?>]" value="<?php echo $R1->contract_document_id; ?>" />
											</div>
											<div class="col-md-2">
												<?php
													if($R1->contract_document_file != 'no.pdf'){
												?>
												<a class="btn btn-default btn-md" href="<?php echo base_url('assets/mod__contract/attach/contract-document-file/'.$R1->contract_document_file.'?time='.date('YmdHis')); ?>" target="_blank">
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
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group" id="form-document-contract">
										<label class="col-md-3 control-label">Dokumen Tambahan <span class="text-danger">*</span></label>
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
											<div class="input_fields_wrap">
												<?php
													$i = 0;
													unset($datato);
													$datato['table'] = 'patlog__contract.entity__contract_attachment';
													$datato['where'] = array(
														'patlog__contract.entity__contract_attachment.contract_id' => $contract_id
													);
													$Q1 = $this->view->view_data($datato);
													foreach($Q1->result() as $R1){
 												?>
												<div class="row-fluid clearfix">
													<div class="col-md-5 p-xxs">
														<input type="text" name="contract_attachment_name[]" oninvalid="Ladda.stopAll()" class="form-control" placeholder="Nama Dokumen" value="<?php echo $R1->contract_attachment_name; ?>" <?php echo $blur; ?> />
													</div>
													<div class="col-md-5 p-xxs">
														<input type="file" name="contract_attachment_file[]" oninvalid="Ladda.stopAll()" class="form-control" <?php echo $disabled; ?> />
													</div>
													<div class="col-md-2 p-xxs">
														<a class="btn btn-default btn-md" href="<?php echo base_url('assets/mod__contract/attach/contract-attachment-file/'.$R1->contract_attachment_file.'?time='.date('YmdHis')); ?>" target="_blank">
															<i class="fa fa-eye"></i>
														</a>
														<?php
															if($contract_data_id == null){
														?>
														<?php
															if($i != 0){
														?>
														<a class="btn btn-danger btn-md delete" data-toggle="modal" data-target="#confirm" id="delete_<?php echo $R1->contract_attachment_id; ?>">
															<i class="fa fa-trash"></i>
														</a>
														<?php
															}
														?>
														<?php
															}
														?>
														<input type="hidden" name="contract_attachment_id[]" value="<?php echo $R1->contract_attachment_id; ?>" required />
													</div>
												</div>
												<?php
														$i++;
													}
												?>
											</div>
											<?php
												if($contract_data_id == null){
											?>
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
													<button type="button" class="btn btn-md btn-primary btn-file add_field_button">
														<i class="fa fa-plus"></i>
													</button>
												</div>
											</div>
											<?php
												}
											?>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<div class="col-md-9 col-md-offset-3">
											<button class="btn btn-primary" type="submit">Simpan</button>
											<button class="btn btn-white" type="button" onclick="window.location.href='<?php echo site_url('module_contract/employee/proses_kontrak_utama/'); ?>'">Kembali</button>
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
					
					$("#contract_request_id").change(function(){
						$.ajax({
							type: 'POST',
							data: {
								contract_request_id: $("#contract_request_id").val(),
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							url: "<?php echo site_url(); ?>module_contract/employee_functions/get_dropdown_request_description/",
							success: function(result){
								var data = JSON.parse(result);
								$('#contract_request_description_id').val('').trigger('change');
								$("#contract_request_description_id").html(data['contract_request_description_id']);
							}
						});
					});
					
					$("#contract_request_description_id").change(function(){
						$.ajax({
							type: 'POST',
							data: {
								contract_request_description_id: $("#contract_request_description_id").val(),
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							url: "<?php echo site_url(); ?>module_contract/employee_functions/get_input_document/",
							success: function(result){
								var data = JSON.parse(result);
								$("#form-document").html(data['form-document']);
							}
						});
					});
					
					$("#contract_project_code_category").change(function(){
						$.ajax({
							type: 'POST',
							data: {
								contract_project_code_category: $("#contract_project_code_category").val(),
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							url: "<?php echo site_url(); ?>module_contract/employee_functions/get_dropdown_project_code/",
							success: function(result){
								var data = JSON.parse(result);
								$('#contract_project_code_id').val('').trigger('change');
								$("#contract_project_code_id").html(data['contract_project_code_id']);
								$("#contract_project_code_description").val('');
							}
						});
					});
					
					$("#contract_project_code_id").change(function(){
						$.ajax({
							type: 'POST',
							data: {
								contract_project_code_category: $("#contract_project_code_category").val(),
								contract_project_code_id: $("#contract_project_code_id").val(),
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							url: "<?php echo site_url(); ?>module_contract/employee_functions/get_form_project_code_detail/",
							success: function(result){
								var data = JSON.parse(result);
								$("#contract_project_code_description").val(data['contract_project_code_description']);
							}
						});
					});
					
					$("#contract_date_start").change(function(){
						$.ajax({
							type: 'POST',
							data: {
								contract_date_start: $("#contract_date_start").val(),
								contract_date_end: $("#contract_date_end").val(),
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							url: "<?php echo site_url(); ?>module_contract/employee_functions/get_form_project_code_period/",
							success: function(result){
								var data = JSON.parse(result);
								$("#contract_period").val(data['contract_period']);
							}
						});
					});
					
					$("#contract_date_end").change(function(){
						$.ajax({
							type: 'POST',
							data: {
								contract_date_start: $("#contract_date_start").val(),
								contract_date_end: $("#contract_date_end").val(),
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							url: "<?php echo site_url(); ?>module_contract/employee_functions/get_form_project_code_period/",
							success: function(result){
								var data = JSON.parse(result);
								$("#contract_period").val(data['contract_period']);
							}
						});
					});
					
					$("#contract_project_currency").change(function(){
						$.ajax({
							type: 'POST',
							data: {
								contract_project_currency: $("#contract_project_currency").val(),
								contract_project_cost: $("#contract_project_cost").val(),
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							url: "<?php echo site_url(); ?>module_contract/employee_functions/get_form_project_calculate/",
							success: function(result){
								var data = JSON.parse(result);
								$("#contract_project_calculate").val(data['contract_project_calculate']);
							}
						});
					});
					
					$("#contract_project_cost").change(function(){
						$.ajax({
							type: 'POST',
							data: {
								contract_project_currency: $("#contract_project_currency").val(),
								contract_project_cost: $("#contract_project_cost").val(),
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							url: "<?php echo site_url(); ?>module_contract/employee_functions/get_form_project_calculate/",
							success: function(result){
								var data = JSON.parse(result);
								$("#contract_project_calculate").val(data['contract_project_calculate']);
							}
						});
					});
					
					var wrapper = $(".input_fields_wrap");
					var add_button = $(".add_field_button");
					$(add_button).click(function(e){
						e.preventDefault();
						$(wrapper).append('<div class="col-md-12"><div class="row clearfix" style="margin-bottom:10px;">'
						+	'<div class="col-md-5 p-xxs">'
							+	'<input type="text" class="form-control" name="contract_attachment_name[]" oninvalid="Ladda.stopAll()" placeholder="Nama Dokumen" required />'
						+	'</div>'
						+	'<div class="col-md-5 p-xxs">'
							+	'<input type="file" class="form-control" name="contract_attachment_file[]" oninvalid="Ladda.stopAll()" required />'
						+	'</div>'
						+	'<div class="col-md-2 p-xxs">'
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
					});
					
					$(document).on('click','.delete',function(e){
						e.preventDefault();
						$('#confirm_str').html('Apakah anda yakin ingin menghapus data ini?');
						$('#delete').show();
						$('#delete_all').hide();
						var id=this.id.substr(7);
						$('#id').val(id);
					});
					
					$(document).on('click','#delete',function(e){
						e.preventDefault();
						$("#delete_"+$('#id').val()).parent().parent().remove();
						
						$.ajax({
							type: 'POST',
							data: {
								contract_attachment_id : $('#id').val(),
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							url: "<?php echo site_url(); ?>module_contract/employee_functions/contract_attachment/delete/",
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
					});
				
				</script>
				<?php
					}elseif($this->input->get('view') == 'preview'){
				?>
				<div class="row">
					<div class="col-md-12">
						<div class="ibox float-e-margins">
							<div class="ibox-title clearfix">
								<div class="pull-left">
									<h4><?php echo strtoupper(str_replace('_',' ',$this->uri->segment(3))); ?></h4>
								</div>
								<div class="pull-right">
									<h4>Kode : <?php echo $contract_no; ?></h4>
								</div>
							</div>
							<div class="ibox-content">
								<div class="row-fluid form-horizontal">
									<div class="form-group">
										<label class="col-md-3 control-label">Pemohon <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Pemohon" value="<?php echo $contract_creator_employee_in_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Approval <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Approval" value="<?php echo $contract_approval_select_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-3 control-label">Ditujukan Kepada <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Ditujukan Kepada" value="<?php echo $contract_category_to; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Jenis Permintaan <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Jenis Permintaan" value="<?php echo $contract_request_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Deskripsi Permintaan <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Deskripsi Permintaan" value="<?php echo $contract_request_description_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-3 control-label">Jenis Kode <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Jenis Kode" value="<?php echo $contract_project_code_category; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Kode <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Kode" value="<?php echo $contract_project_code_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-3 control-label">Nama Proyek <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<textarea class="form-control" placeholder="Nama Proyek" rows="3" onfocus="blur();"><?php echo $contract_project_code_description; ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Tanggal Mulai <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Tanggal Mulai" value="<?php echo $contract_date_start; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Tanggal Selesai <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Tanggal Selesai" value="<?php echo $contract_date_end; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Periode (Hari) <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Periode (Hari)" value="<?php echo $contract_period; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Mata Uang <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Mata Uang" value="<?php echo $contract_project_currency; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Estimasi Total Nilai Pekerjaan <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Estimasi Total Nilai Pekerjaan" value="<?php echo $contract_project_cost; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Terbilang <span class="text-warning">*</span></label>
										<div class="col-md-9">
											<textarea class="form-control" placeholder="Terbilang" rows="3" maxlength="1000" onfocus="blur();"><?php echo $contract_project_calculate; ?></textarea>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-3 control-label">Catatan</label>
										<div class="col-md-9">
											<textarea class="form-control" placeholder="Catatan" rows="3" onfocus="blur();"><?php echo $contract_project_note; ?></textarea>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-3 control-label">Kebutuhan Untuk <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Kebutuhan Untuk" value="<?php echo $contract_third_party_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group" id="input_contract_employee_company">
										<label class="col-md-3 control-label">Nama Perusahaan <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Nama Perusahaan" value="<?php echo $contract_company_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group" id="input_contract_user_name">
										<label class="col-md-3 control-label">Penandatangan <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Penandatangan" value="<?php echo $contract_user_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group" id="input_contract_user_position">
										<label class="col-md-3 control-label">Jabatan <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Jabatan" value="<?php echo $contract_user_position; ?>" onfocus="blur();" />
										</div>
									</div>
									<?php
										if($contract_no_fix != null){
									?>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-3 control-label">Nomor Kontrak <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Nomor Kontrak" value="<?php echo $contract_no_fix; ?>" onfocus="blur();" />
										</div>
									</div>
									<?php
										}
									?>
									<?php
										if($contract_data_id != null){
									?>
									<?php
										unset($datato);
										$datato['table'] = 'patlog__procurement.entity__request_legal';
										$datato['where'] = array(
											'patlog__procurement.entity__request_legal.request_id' => $contract_data_id,
											'patlog__procurement.entity__request_legal.vendor_name' => $contract_company_name
										);
										$Q1 = $this->view->view_data($datato);
										if($Q1->num_rows()){
											$R1 = $Q1->row();
											$vendor_id = $R1->vendor_id;
										}else{
											$vendor_id = null;
										}
									
										unset($datato);
										$datato['table'] = 'patlog__procurement.entity__vendor';
										$datato['where'] = array(
											'patlog__procurement.entity__vendor.vendor_id' => $vendor_id
										);
										$Q1 = $this->view->view_data($datato);
										if($Q1->num_rows()){
											$R1 = $Q1->row();
											$vendor_id = $R1->vendor_id;
											$vendor_document_siup = $R1->vendor_document_siup;
											$vendor_document_deed_incorporation = $R1->vendor_document_deed_incorporation;
											$vendor_document_change = $R1->vendor_document_change;
											$vendor_document_sign_company = $R1->vendor_document_sign_company;
											$vendor_document_domicile_information = $R1->vendor_document_domicile_information;
											$vendor_document_sppkp = $R1->vendor_document_sppkp;
											$vendor_document_finance_report = $R1->vendor_document_finance_report;
											$vendor_document_statement_later = $R1->vendor_document_statement_later;
											$vendor_document_po_spk = $R1->vendor_document_po_spk;
											$vendor_document_csms = $R1->vendor_document_csms;
											$vendor_document_iso = $R1->vendor_document_iso;
											$vendor_document_bank_reference = $R1->vendor_document_bank_reference;
											$vendor_document_bank_attorney = $R1->vendor_document_bank_attorney;
										}else{
											$vendor_id = null;
											$vendor_document_siup = 'no.pdf';
											$vendor_document_deed_incorporation = 'no.pdf';
											$vendor_document_change = 'no.pdf';
											$vendor_document_sign_company = 'no.pdf';
											$vendor_document_domicile_information = 'no.pdf';
											$vendor_document_sppkp = 'no.pdf';
											$vendor_document_finance_report = 'no.pdf';
											$vendor_document_statement_later = 'no.pdf';
											$vendor_document_po_spk = 'no.pdf';
											$vendor_document_csms = 'no.pdf';
											$vendor_document_iso = 'no.pdf';
											$vendor_document_bank_reference = 'no.pdf';
											$vendor_document_bank_attorney = 'no.pdf';
										}
									?>
									<div class="hr-line-dashed"></div>
									<div class="row">
										<div class="col-md-6">
											<h4>Dokumen Legalitas Vendor</h4>
											<div class="form-group">
												<label class="col-md-6 control-label">SIUP/NIB</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/siup/'.$vendor_document_siup.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-6 control-label">Akta Pendirian Perusahaan Beserta Pengesahan</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/akta_pendirian/'.$vendor_document_deed_incorporation.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-6 control-label">Akta Perubahan Perusahaan Beserta Pengesahan</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/akta_perubahan/'.$vendor_document_change.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-6 control-label">Surat Keterangan Fiskal dan Nomor NITKU</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/tanda_daftar_perusahaan/'.$vendor_document_sign_company.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-6 control-label">Kartu Tanda Pengenal Pengurus Perusahaan</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/surat_domisili/'.$vendor_document_domicile_information.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-6 control-label">Surat Keterangan Perpajakkan PKP/NonPKP</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/sk_pajak/'.$vendor_document_sppkp.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<h4>&emsp;</h4>
											<div class="form-group">
												<label class="col-md-6 control-label">Laporan Keuangan 1 Tahun Terakhir</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/laporan_keuangan/'.$vendor_document_finance_report.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-6 control-label">Surat Pernyataan dan Pakta Integritas</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/surat_pernyataan/'.$vendor_document_statement_later.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-6 control-label">Daftar Pengalaman Perusahaan(Lampirkan PO/SPK/Kontrak 1 Tahun Terakhir)</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/surat_pengalaman_perusahaan/'.$vendor_document_po_spk.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-6 control-label">Sertifikat CSMS</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/sertifikat_csms/'.$vendor_document_csms.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-6 control-label">Surat Pengukuhan Pengusaha Kena Pajak (SPPKP) / Surat Pernyataan apabila NON PKP</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/sertifikat_ISO/'.$vendor_document_iso.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-6 control-label">Referensi Bank</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/referensi_bank/'.$vendor_document_bank_reference.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-6 control-label">Surat Kuasa Bank</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/surat_kuasa_bank/'.$vendor_document_bank_attorney.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="row">
										<div class="col-md-12">
											<h4>Proses Pengadaan</h4>
											<div class="table-responsive">
												<table class="table table-striped table-bordered table-hover" id="table">
													<thead>
														<tr>
															<th>Waktu</th>										
															<th>Nama Proses</th>										
															<th>Keterangan</th>										
															<th>Nama Vendor</th>										
															<th>Dokumen</th>										
														</tr>
													</thead>
													<tbody>
														<?php
															unset($datato);
															$datato['table'] = 'patlog__procurement.entity__request_process';
															$datato['where'] = array(
																'patlog__procurement.entity__request_process.request_id' => $contract_data_id,
																'patlog__procurement.entity__request_process.vendor_id' => $vendor_id
															);
															$Q1 = $this->view->view_data($datato);
															if($Q1->num_rows()){
																foreach($Q1->result() as $R1){
														?>
														<tr>
															<td><?php echo $R1->request_process_proc_date; ?> <?php echo $R1->request_process_proc_time; ?></td>
															<td><?php echo $R1->request_process_proc_name; ?></td>
															<td><?php echo $R1->request_process_note; ?></td>
															<td><?php echo $R1->vendor_name; ?></td>
															<td>
																<?php
																	unset($datato);
																	$datato['table'] = 'patlog__procurement.entity__request_process_attach';
																	$datato['where'] = array(
																		'patlog__procurement.entity__request_process_attach.request_process_id' => $R1->request_process_id
																	);
																	$Q2 = $this->view->view_data($datato);
																	if($Q2->num_rows()){
																		foreach($Q2->result() as $R2){
																?>
																<a href="<?php echo base_url('assets/mod__procurement/attach/request_process_attach/'.$R2->request_process_attach_file.'?time='.date('YmdHis')); ?>" class="btn btn-xs btn-default" target="_blank">
																	<i class="fa fa-eye"></i>
																</a> - <?php echo $R2->request_process_attach_description; ?>
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
															}
														?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<br/>
									<div class="row">
										<?php
											unset($datato);
											$datato['table'] = 'patlog__procurement.entity__request_attachment';
											$datato['where'] = array(
												'patlog__procurement.entity__request_attachment.request_id' => $contract_data_id,
												'patlog__procurement.entity__request_attachment.request_attachment_file != ' => 'no.pdf',
											);
											$Q1 = $this->view->view_data($datato);
											if($Q1->num_rows()){
												foreach($Q1->result() as $R1){
										?>
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-6 control-label"><?php echo $R1->request_attachment_name; ?> <span class="text-danger">*</span></label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/request-attachment-file/'.$R1->request_attachment_file.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
										</div>
										<?php
												}
											}
										?>
									</div>
									<?php
										}
									?>
									<div class="hr-line-dashed"></div>
									<div class="row">
										<div class="col-md-6">
											<h4>Dokumen Pendukung</h4>
											<div class="form-group">
												<label class="col-md-6 control-label">Dokumen SPPK <span class="text-danger">*</span></label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__contract/attach/document-contract-in/'.$contract_document_in.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<?php
												unset($datato);
												$datato['table'] = 'patlog__contract.entity__contract_document';
												$datato['where'] = array(
													'patlog__contract.entity__contract_document.contract_id' => $contract_id,
													'patlog__contract.entity__contract_document.contract_document_file != ' => 'no.pdf',
												);
												$Q1 = $this->view->view_data($datato);
												foreach($Q1->result() as $R1){
											?>
											<div class="form-group">
												<label class="col-md-6 control-label"><?php echo $R1->contract_document_name; ?> <span class="text-danger">*</span></label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__contract/attach/contract-document-file/'.$R1->contract_document_file.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<?php
												}
											?>
											<?php
												unset($datato);
												$datato['table'] = 'patlog__contract.entity__contract_attachment';
												$datato['where'] = array(
													'patlog__contract.entity__contract_attachment.contract_id' => $contract_id
												);
												$Q1 = $this->view->view_data($datato);
												foreach($Q1->result() as $R1){
											?>
											<div class="form-group">
												<label class="col-md-6 control-label"><?php echo $R1->contract_attachment_name; ?> <span class="text-danger">*</span></label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__contract/attach/contract-attachment-file/'.$R1->contract_attachment_file.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<?php
												}
											?>
										</div>
										<div class="col-md-6">
											<h4>Dokumen Legal</h4>
											<?php
												$arr_contract_process_name = array();
												$arr_contract_draft_file_name = array();
												unset($datato);
												$datato['table'] = 'patlog__contract.entity__contract_draft';
												$datato['where'] = array(
													'patlog__contract.entity__contract_draft.contract_id' => $contract_id,
													'patlog__contract.entity__contract_draft.contract_draft_file_name is not null' => null,
													'patlog__contract.entity__contract_draft.contract_process_id is not null' => null,
													'patlog__contract.entity__contract_draft.contract_draft_file_name != ' => 'no.pdf'
												);
												$datato['order'] = array(
													'patlog__contract.entity__contract_draft.contract_draft_id'
												);
												$datato['order_type'] = array(
													'asc'
												);
												$Q1 = $this->view->view_data($datato);
												foreach($Q1->result() as $R1){
													if(!in_array($R1->contract_process_name, $arr_contract_process_name)){
														$arr_contract_process_name[] = $R1->contract_process_name;
														$arr_contract_draft_file_name[] = $R1->contract_draft_file_name;
													}else{
														$key = array_search($R1->contract_process_name, $arr_contract_process_name, true);
														$arr_contract_process_name[$key] = $R1->contract_process_name;
														$arr_contract_draft_file_name[$key] = $R1->contract_draft_file_name;
													}
												}
											?>
											<?php
												for($i=0;$i<count($arr_contract_process_name);$i++){
											?>
											<div class="form-group">
												<label class="col-md-6 control-label"><?php echo $arr_contract_process_name[$i]; ?> <span class="text-danger">*</span></label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__contract/attach/document-contract/'.$arr_contract_draft_file_name[$i].'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<?php
												}
											?>
											<div class="form-group">
												<label class="col-md-6 control-label">Review Dokumen Kontrak <span class="text-danger">*</span></label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__contract/attach/document-contract-summary/'.$contract_summary_file_name.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<?php
												if($contract_summary_file_ttd != 'no.pdf'){
											?>
											<div class="form-group">
												<label class="col-md-6 control-label">Kontrak TTD <span class="text-danger">*</span></label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__contract/attach/document-contract-summary-ttd/'.$contract_summary_file_ttd.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<?php
												}
											?>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="row form-horizontal">
									<div class="col-md-6">
										<h3 class="m-t-none m-b">Log Aktivitas</h3>
										<div id="vertical-timeline" class="vertical-container dark-timeline">
											<?php
												unset($datato);
												$datato['table'] = 'patlog__contract.entity__contract_log';
												$datato['where'] = array(
													'patlog__contract.entity__contract_log.contract_id' => $contract_id
												);
												$datato['order'] = array(
													'patlog__contract.entity__contract_log.contract_log_id'
												);
												$datato['order_type'] = array(
													'asc'
												);
												$Q1 = $this->view->view_data($datato);
												foreach($Q1->result() as $R1){
													if($R1->contract_log_status == 'Created' or $R1->contract_log_status == 'Editing' or $R1->contract_log_status == 'Processing'){
														$color = 'text-default';
														$icon = '<i class="fas fa-ellipsis-h"></i>';
														$status = '<div class="badge badge-default">'.$R1->contract_log_status.'</div>';
													}elseif($R1->contract_log_status == 'Approved' or $R1->contract_log_status == 'Done'){
														$color = 'navy-bg';
														$icon = '<i class="fa fa-check"></i>';
														$status = '<div class="badge navy-bg">'.$R1->contract_log_status.'</div>';
													}elseif($R1->contract_log_status == 'Rejected' or $R1->contract_log_status == 'Failed' or $R1->contract_log_status == 'Trash'){
														$color = 'label-danger';
														$icon = '<i class="fa fa-times"></i>';
														$status = '<div class="badge badge-danger">'.$R1->contract_log_status.'</div>';
													}elseif($R1->contract_log_status == 'Back'){
														$color = 'label-warning';
														$icon = '<i class="fa fa-undo-alt"></i>';
														$status = '<div class="badge badge-warning">'.$R1->contract_log_status.'</div>';
													}else{
														$color = 'text-default';
														$icon = '<i class="fas fa-ellipsis-h"></i>';
														$status = '<div class="badge badge-default">'.$R1->contract_log_status.'</div>';
													}
											?>
											<div class="vertical-timeline-block">
												<div class="vertical-timeline-icon <?php echo $color; ?>">
													<?php echo $icon; ?>
												</div>
												<div class="vertical-timeline-content">
													<label class="font-bold"><?php echo $R1->contract_log_status; ?> oleh <?php echo $R1->contract_log_employee_name; ?></label> - <small>(<?php echo $R1->contract_log_employee_position_detail; ?>)</small>
													<br/>
													<?php echo $status; ?> &bull; <?php echo date_indo(date('Y-m-d', strtotime($R1->contract_log_insert)), true); ?> pukul <small><?php echo date('H:i:s', strtotime($R1->contract_log_insert)); ?></small>
													<?php
														if($R1->contract_log_status_ttd != null){
													?>
													<br/><small class="text-info"><b>Dilakukan tandatangan secara <?php echo $R1->contract_log_status_ttd; ?>.</b></small><br/>
													<?php
														}
													?>
													<?php
														if($R1->contract_log_message != '' or $R1->contract_log_status == 'Processing'){
													?>
													<div class="well well-sm m-t-sm">
														<?php
															if($R1->contract_log_status == 'Processing'){
														?>
														<small><b><?php echo $R1->contract_process_name; ?></b></small><br/>
														<?php
															}
														?>
														<small><?php echo $R1->contract_log_message; ?></small>
													</div>
													<?php
														}
													?>
												</div>
											</div>
											<?php
												}
											?>
										</div>
									</div>
									<div class="col-md-6">
										
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
				<?php
					if($contract_ttd_sign_type == 'Digital Sertifikasi'){
						unset($datato);
						$datato['database'] = 'patlog__contract';
						$datato['table'] = 'entity__contract';
						$datato['contract_ttd_sign_trigger'] = null;
						$datato['field'] = 'contract_id';
						$datato['id'] = $contract_id;
						$this->mod->update($datato);
					}
				?>
				<div class="row">
					<div class="col-md-12">
						<div class="ibox float-e-margins">
							<div class="ibox-title clearfix">
								<div class="pull-left">
									<h4><?php echo strtoupper(str_replace('_',' ',$this->uri->segment(3))); ?></h4>
								</div>
								<div class="pull-right">
									<h4>Kode : <?php echo $contract_no; ?></h4>
								</div>
							</div>
							<div class="ibox-content">
								<div class="row-fluid form-horizontal">
									<div class="form-group">
										<label class="col-md-3 control-label">Pemohon <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Pemohon" value="<?php echo $contract_creator_employee_in_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Approval <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Approval" value="<?php echo $contract_approval_select_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-3 control-label">Ditujukan Kepada <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Ditujukan Kepada" value="<?php echo $contract_category_to; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Jenis Permintaan <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Jenis Permintaan" value="<?php echo $contract_request_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Deskripsi Permintaan <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Deskripsi Permintaan" value="<?php echo $contract_request_description_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-3 control-label">Jenis Kode <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Jenis Kode" value="<?php echo $contract_project_code_category; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Kode <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Kode" value="<?php echo $contract_project_code_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-3 control-label">Nama Proyek <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<textarea class="form-control" placeholder="Nama Proyek" rows="3" onfocus="blur();"><?php echo $contract_project_code_description; ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Tanggal Mulai <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Tanggal Mulai" value="<?php echo $contract_date_start; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Tanggal Selesai <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Tanggal Selesai" value="<?php echo $contract_date_end; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Periode (Hari) <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Periode (Hari)" value="<?php echo $contract_period; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Mata Uang <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Mata Uang" value="<?php echo $contract_project_currency; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Estimasi Total Nilai Pekerjaan <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Estimasi Total Nilai Pekerjaan" value="<?php echo $contract_project_cost; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Terbilang <span class="text-warning">*</span></label>
										<div class="col-md-9">
											<textarea class="form-control" placeholder="Terbilang" rows="3" maxlength="1000" onfocus="blur();"><?php echo $contract_project_calculate; ?></textarea>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-3 control-label">Catatan</label>
										<div class="col-md-9">
											<textarea class="form-control" placeholder="Catatan" rows="3" onfocus="blur();"><?php echo $contract_project_note; ?></textarea>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-3 control-label">Kebutuhan Untuk <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Kebutuhan Untuk" value="<?php echo $contract_third_party_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group" id="input_contract_employee_company">
										<label class="col-md-3 control-label">Nama Perusahaan <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Nama Perusahaan" value="<?php echo $contract_company_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group" id="input_contract_user_name">
										<label class="col-md-3 control-label">Penandatangan <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Penandatangan" value="<?php echo $contract_user_name; ?>" onfocus="blur();" />
										</div>
									</div>
									<div class="form-group" id="input_contract_user_position">
										<label class="col-md-3 control-label">Jabatan <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Jabatan" value="<?php echo $contract_user_position; ?>" onfocus="blur();" />
										</div>
									</div>
									<?php
										if($contract_no_fix != null){
									?>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-3 control-label">Nomor Kontrak <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Nomor Kontrak" value="<?php echo $contract_no_fix; ?>" onfocus="blur();" />
										</div>
									</div>
									<?php
										}
									?>
									<?php
										if($contract_data_id != null){
									?>
									<?php
										unset($datato);
										$datato['table'] = 'patlog__procurement.entity__request_legal';
										$datato['where'] = array(
											'patlog__procurement.entity__request_legal.request_id' => $contract_data_id,
											'patlog__procurement.entity__request_legal.vendor_name' => $contract_company_name
										);
										$Q1 = $this->view->view_data($datato);
										if($Q1->num_rows()){
											$R1 = $Q1->row();
											$vendor_id = $R1->vendor_id;
										}else{
											$vendor_id = null;
										}
									
										unset($datato);
										$datato['table'] = 'patlog__procurement.entity__vendor';
										$datato['where'] = array(
											'patlog__procurement.entity__vendor.vendor_id' => $vendor_id
										);
										$Q1 = $this->view->view_data($datato);
										if($Q1->num_rows()){
											$R1 = $Q1->row();
											$vendor_id = $R1->vendor_id;
											$vendor_document_siup = $R1->vendor_document_siup;
											$vendor_document_deed_incorporation = $R1->vendor_document_deed_incorporation;
											$vendor_document_change = $R1->vendor_document_change;
											$vendor_document_sign_company = $R1->vendor_document_sign_company;
											$vendor_document_domicile_information = $R1->vendor_document_domicile_information;
											$vendor_document_sppkp = $R1->vendor_document_sppkp;
											$vendor_document_finance_report = $R1->vendor_document_finance_report;
											$vendor_document_statement_later = $R1->vendor_document_statement_later;
											$vendor_document_po_spk = $R1->vendor_document_po_spk;
											$vendor_document_csms = $R1->vendor_document_csms;
											$vendor_document_iso = $R1->vendor_document_iso;
											$vendor_document_bank_reference = $R1->vendor_document_bank_reference;
											$vendor_document_bank_attorney = $R1->vendor_document_bank_attorney;
										}else{
											$vendor_id = null;
											$vendor_document_siup = 'no.pdf';
											$vendor_document_deed_incorporation = 'no.pdf';
											$vendor_document_change = 'no.pdf';
											$vendor_document_sign_company = 'no.pdf';
											$vendor_document_domicile_information = 'no.pdf';
											$vendor_document_sppkp = 'no.pdf';
											$vendor_document_finance_report = 'no.pdf';
											$vendor_document_statement_later = 'no.pdf';
											$vendor_document_po_spk = 'no.pdf';
											$vendor_document_csms = 'no.pdf';
											$vendor_document_iso = 'no.pdf';
											$vendor_document_bank_reference = 'no.pdf';
											$vendor_document_bank_attorney = 'no.pdf';
										}
									?>
									<div class="hr-line-dashed"></div>
									<div class="row">
										<div class="col-md-6">
											<h4>Dokumen Legalitas Vendor</h4>
											<div class="form-group">
												<label class="col-md-6 control-label">SIUP/NIB</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/siup/'.$vendor_document_siup.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-6 control-label">Akta Pendirian Perusahaan Beserta Pengesahan</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/akta_pendirian/'.$vendor_document_deed_incorporation.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-6 control-label">Akta Perubahan Perusahaan Beserta Pengesahan</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/akta_perubahan/'.$vendor_document_change.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-6 control-label">Surat Keterangan Fiskal dan Nomor NITKU</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/tanda_daftar_perusahaan/'.$vendor_document_sign_company.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-6 control-label">Kartu Tanda Pengenal Pengurus Perusahaan</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/surat_domisili/'.$vendor_document_domicile_information.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-6 control-label">Surat Keterangan Perpajakkan PKP/NonPKP</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/sk_pajak/'.$vendor_document_sppkp.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<h4>&emsp;</h4>
											<div class="form-group">
												<label class="col-md-6 control-label">Laporan Keuangan 1 Tahun Terakhir</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/laporan_keuangan/'.$vendor_document_finance_report.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-6 control-label">Surat Pernyataan dan Pakta Integritas</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/surat_pernyataan/'.$vendor_document_statement_later.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-6 control-label">Daftar Pengalaman Perusahaan(Lampirkan PO/SPK/Kontrak 1 Tahun Terakhir)</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/surat_pengalaman_perusahaan/'.$vendor_document_po_spk.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-6 control-label">Sertifikat CSMS</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/sertifikat_csms/'.$vendor_document_csms.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-6 control-label">Surat Pengukuhan Pengusaha Kena Pajak (SPPKP) / Surat Pernyataan apabila NON PKP</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/sertifikat_ISO/'.$vendor_document_iso.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-6 control-label">Referensi Bank</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/referensi_bank/'.$vendor_document_bank_reference.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-6 control-label">Surat Kuasa Bank</label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/uploads/surat_kuasa_bank/'.$vendor_document_bank_attorney.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="row">
										<div class="col-md-12">
											<h4>Proses Pengadaan</h4>
											<div class="table-responsive">
												<table class="table table-striped table-bordered table-hover" id="table">
													<thead>
														<tr>
															<th>Waktu</th>										
															<th>Nama Proses</th>										
															<th>Keterangan</th>										
															<th>Nama Vendor</th>										
															<th>Dokumen</th>										
														</tr>
													</thead>
													<tbody>
														<?php
															unset($datato);
															$datato['table'] = 'patlog__procurement.entity__request_process';
															$datato['where'] = array(
																'patlog__procurement.entity__request_process.request_id' => $contract_data_id,
																'patlog__procurement.entity__request_process.vendor_id' => $vendor_id
															);
															$Q1 = $this->view->view_data($datato);
															if($Q1->num_rows()){
																foreach($Q1->result() as $R1){
														?>
														<tr>
															<td><?php echo $R1->request_process_proc_date; ?> <?php echo $R1->request_process_proc_time; ?></td>
															<td><?php echo $R1->request_process_proc_name; ?></td>
															<td><?php echo $R1->request_process_note; ?></td>
															<td><?php echo $R1->vendor_name; ?></td>
															<td>
																<?php
																	unset($datato);
																	$datato['table'] = 'patlog__procurement.entity__request_process_attach';
																	$datato['where'] = array(
																		'patlog__procurement.entity__request_process_attach.request_process_id' => $R1->request_process_id
																	);
																	$Q2 = $this->view->view_data($datato);
																	if($Q2->num_rows()){
																		foreach($Q2->result() as $R2){
																?>
																<a href="<?php echo base_url('assets/mod__procurement/attach/request_process_attach/'.$R2->request_process_attach_file.'?time='.date('YmdHis')); ?>" class="btn btn-xs btn-default" target="_blank">
																	<i class="fa fa-eye"></i>
																</a> - <?php echo $R2->request_process_attach_description; ?>
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
															}
														?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<br/>
									<div class="row">
										<?php
											unset($datato);
											$datato['table'] = 'patlog__procurement.entity__request_attachment';
											$datato['where'] = array(
												'patlog__procurement.entity__request_attachment.request_id' => $contract_data_id,
												'patlog__procurement.entity__request_attachment.request_attachment_file != ' => 'no.pdf',
											);
											$Q1 = $this->view->view_data($datato);
											if($Q1->num_rows()){
												foreach($Q1->result() as $R1){
										?>
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-6 control-label"><?php echo $R1->request_attachment_name; ?> <span class="text-danger">*</span></label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__procurement/attach/request-attachment-file/'.$R1->request_attachment_file.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
										</div>
										<?php
												}
											}
										?>
									</div>
									<?php
										}
									?>
									<div class="hr-line-dashed"></div>
									<div class="row">
										<div class="col-md-6">
											<h4>Dokumen Pendukung</h4>
											<div class="form-group">
												<label class="col-md-6 control-label">Dokumen SPPK <span class="text-danger">*</span></label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__contract/attach/document-contract-in/'.$contract_document_in.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<?php
												unset($datato);
												$datato['table'] = 'patlog__contract.entity__contract_document';
												$datato['where'] = array(
													'patlog__contract.entity__contract_document.contract_id' => $contract_id,
													'patlog__contract.entity__contract_document.contract_document_file != ' => 'no.pdf',
												);
												$Q1 = $this->view->view_data($datato);
												foreach($Q1->result() as $R1){
											?>
											<div class="form-group">
												<label class="col-md-6 control-label"><?php echo $R1->contract_document_name; ?> <span class="text-danger">*</span></label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__contract/attach/contract-document-file/'.$R1->contract_document_file.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<?php
												}
											?>
											<?php
												unset($datato);
												$datato['table'] = 'patlog__contract.entity__contract_attachment';
												$datato['where'] = array(
													'patlog__contract.entity__contract_attachment.contract_id' => $contract_id
												);
												$Q1 = $this->view->view_data($datato);
												foreach($Q1->result() as $R1){
											?>
											<div class="form-group">
												<label class="col-md-6 control-label"><?php echo $R1->contract_attachment_name; ?> <span class="text-danger">*</span></label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__contract/attach/contract-attachment-file/'.$R1->contract_attachment_file.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<?php
												}
											?>
										</div>
										<div class="col-md-6">
											<h4>Dokumen Legal</h4>
											<?php
												$arr_contract_process_name = array();
												$arr_contract_draft_file_name = array();
												unset($datato);
												$datato['table'] = 'patlog__contract.entity__contract_draft';
												$datato['where'] = array(
													'patlog__contract.entity__contract_draft.contract_id' => $contract_id,
													'patlog__contract.entity__contract_draft.contract_draft_file_name is not null' => null,
													'patlog__contract.entity__contract_draft.contract_process_id is not null' => null,
													'patlog__contract.entity__contract_draft.contract_draft_file_name != ' => 'no.pdf'
												);
												$datato['order'] = array(
													'patlog__contract.entity__contract_draft.contract_draft_id'
												);
												$datato['order_type'] = array(
													'asc'
												);
												$Q1 = $this->view->view_data($datato);
												foreach($Q1->result() as $R1){
													if(!in_array($R1->contract_process_name, $arr_contract_process_name)){
														$arr_contract_process_name[] = $R1->contract_process_name;
														$arr_contract_draft_file_name[] = $R1->contract_draft_file_name;
													}else{
														$key = array_search($R1->contract_process_name, $arr_contract_process_name, true);
														$arr_contract_process_name[$key] = $R1->contract_process_name;
														$arr_contract_draft_file_name[$key] = $R1->contract_draft_file_name;
													}
												}
											?>
											<?php
												for($i=0;$i<count($arr_contract_process_name);$i++){
											?>
											<div class="form-group">
												<label class="col-md-6 control-label"><?php echo $arr_contract_process_name[$i]; ?> <span class="text-danger">*</span></label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__contract/attach/document-contract/'.$arr_contract_draft_file_name[$i].'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<?php
												}
											?>
											<div class="form-group">
												<label class="col-md-6 control-label">Review Dokumen Kontrak <span class="text-danger">*</span></label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__contract/attach/document-contract-summary/'.$contract_summary_file_name.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<?php
												if($contract_summary_file_ttd != 'no.pdf'){
											?>
											<div class="form-group">
												<label class="col-md-6 control-label">Kontrak TTD <span class="text-danger">*</span></label>
												<div class="col-md-6">
													<a class="btn btn-sm btn-success" href="<?php echo base_url('assets/mod__contract/attach/document-contract-summary-ttd/'.$contract_summary_file_ttd.'?time='.date('YmdHis')); ?>" target="_blank">
														<i class="fa fa-eye"></i> Lihat
													</a>
												</div>
											</div>
											<?php
												}
											?>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="row form-horizontal">
									<div class="col-md-6">
										<h3 class="m-t-none m-b">Log Aktivitas</h3>
										<div id="vertical-timeline" class="vertical-container dark-timeline">
											<?php
												unset($datato);
												$datato['table'] = 'patlog__contract.entity__contract_log';
												$datato['where'] = array(
													'patlog__contract.entity__contract_log.contract_id' => $contract_id
												);
												$datato['order'] = array(
													'patlog__contract.entity__contract_log.contract_log_id'
												);
												$datato['order_type'] = array(
													'asc'
												);
												$Q1 = $this->view->view_data($datato);
												foreach($Q1->result() as $R1){
													if($R1->contract_log_status == 'Created' or $R1->contract_log_status == 'Editing' or $R1->contract_log_status == 'Processing'){
														$color = 'text-default';
														$icon = '<i class="fas fa-ellipsis-h"></i>';
														$status = '<div class="badge badge-default">'.$R1->contract_log_status.'</div>';
													}elseif($R1->contract_log_status == 'Approved' or $R1->contract_log_status == 'Done'){
														$color = 'navy-bg';
														$icon = '<i class="fa fa-check"></i>';
														$status = '<div class="badge navy-bg">'.$R1->contract_log_status.'</div>';
													}elseif($R1->contract_log_status == 'Rejected' or $R1->contract_log_status == 'Failed' or $R1->contract_log_status == 'Trash'){
														$color = 'label-danger';
														$icon = '<i class="fa fa-times"></i>';
														$status = '<div class="badge badge-danger">'.$R1->contract_log_status.'</div>';
													}elseif($R1->contract_log_status == 'Back'){
														$color = 'label-warning';
														$icon = '<i class="fa fa-undo-alt"></i>';
														$status = '<div class="badge badge-warning">'.$R1->contract_log_status.'</div>';
													}else{
														$color = 'text-default';
														$icon = '<i class="fas fa-ellipsis-h"></i>';
														$status = '<div class="badge badge-default">'.$R1->contract_log_status.'</div>';
													}
											?>
											<div class="vertical-timeline-block">
												<div class="vertical-timeline-icon <?php echo $color; ?>">
													<?php echo $icon; ?>
												</div>
												<div class="vertical-timeline-content">
													<label class="font-bold"><?php echo $R1->contract_log_status; ?> oleh <?php echo $R1->contract_log_employee_name; ?></label> - <small>(<?php echo $R1->contract_log_employee_position_detail; ?>)</small>
													<br/>
													<?php echo $status; ?> &bull; <?php echo date_indo(date('Y-m-d', strtotime($R1->contract_log_insert)), true); ?> pukul <small><?php echo date('H:i:s', strtotime($R1->contract_log_insert)); ?></small>
													<?php
														if($R1->contract_log_status_ttd != null){
													?>
													<br/><small class="text-info"><b>Dilakukan tandatangan secara <?php echo $R1->contract_log_status_ttd; ?>.</b></small><br/>
													<?php
														}
													?>
													<?php
														if($R1->contract_log_message != '' or $R1->contract_log_status == 'Processing'){
													?>
													<div class="well well-sm m-t-sm">
														<?php
															if($R1->contract_log_status == 'Processing'){
														?>
														<small><b><?php echo $R1->contract_process_name; ?></b></small><br/>
														<?php
															}
														?>
														<small><?php echo $R1->contract_log_message; ?></small>
													</div>
													<?php
														}
													?>
												</div>
											</div>
											<?php
												}
											?>
										</div>
									</div>
									<div class="col-md-6">
										<form method="post" id="form-approval" action="<?php echo site_url('module_contract/employee_functions/contract_approval/'.$this->input->get('contract_id')); ?>" enctype="multipart/form-data">
											<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" required />
											<?php
												if($contract_approval_current_category == 'Loket'){
											?>
											<div class="form-group">
												<div class="col-md-12">
													<p><b>Catatan : Untuk SPPK diatas silahkan di mapping ke fungsi Legal di bawah ini.</b></p>
												</div>
											</div>
											<table class="table table-striped table-bordered table-hover" id="table-pic">
												<thead>
													<tr>
														<th>No</th>												
														<th>Penandatangan</th>												
														<th>Jumlah SPPK Diproses (Drafter)</th>											
													</tr>
												</thead>
												<tbody>
													<?php
														unset($datato);
														$datato['table'] = 'patlog__contract.entity__cog';
														$Q1 = $this->view->view_data($datato);
														if($Q1->num_rows()){
															$R1 = $Q1->row();
															$cog_division_id = $R1->cog_division_id;
														}else{
															$cog_division_id = null;
														}
													
														$no = 1;
														unset($datato);
														$datato['table'] = 'patlog__hrms.entity__employee_in';
														$where = '
															(patlog__hrms.entity__employee_in.division_id = '.$cog_division_id.' AND 
															patlog__hrms.entity__employee_in.employee_in_status = "Aktif") AND 
															(patlog__hrms.entity__employee_in.employee_in_position = "Staf" OR 
															patlog__hrms.entity__employee_in.employee_in_position = "Asisten Manajer")
														';
														$datato['where'] = $where;
														$Q1 = $this->view->view_data($datato);
														foreach($Q1->result() as $R1){
															unset($datato);			
															$datato['table'] = 'patlog__contract.entity__contract';
															$datato['where'] = array(
																'patlog__contract.entity__contract.contract_approval_current_id' => $R1->employee_in_id,
																'patlog__contract.entity__contract.contract_approval_current_category' => 'Drafter',
																// Only count SPPK yg belum selesai (done!=yes) & belum dihapus (delete!=yes)
																'patlog__contract.entity__contract.contract_status_done !=' => 'yes',
																'patlog__contract.entity__contract.contract_status_delete !=' => 'yes'
															);
															$Q2 = $this->view->view_data($datato);
															$total_process = $Q2->num_rows();
													?>		
													<tr>
														<td><?php echo $no++; ?></td>
														<td><?php echo $R1->employee_in_name; ?></td>
														<td><?php if ($total_process > 0): ?><a href="javascript:void(0)" class="sppk-mapping-count" data-emp-id="<?php echo $R1->employee_in_id; ?>" data-emp-name="<?php echo htmlspecialchars($R1->employee_in_name, ENT_QUOTES); ?>" style="font-weight:600; color:#1c84c6; text-decoration:underline;"><?php echo $total_process; ?></a><?php else: ?><?php echo $total_process; ?><?php endif; ?></td>
													</tr>
													<?php
														} 
													?>
												</tbody>
											</table>
											<?php
												}
											?>
											<?php
												if($contract_approval_current_category == 'Loket'){
											?>
											<div class="form-group">
												<label class="col-md-3 control-label">Aktor <span class="text-danger">*</span></label>
												<div class="col-md-9">
													<select class="form-control select2" name="contract_approval_current_id" required >
														<option selected disabled value="">--Pilih--</option>
														<?php
															unset($datato);
															$datato['table'] = 'patlog__hrms.entity__employee_in';
															$datato['where'] = array(
																'patlog__hrms.entity__employee_in.employee_in_id' => base64_decode($this->session->userdata('employee_id'))
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
											<div class="form-group">
												<label class="col-md-3 control-label">Disposisikan Kepada <span class="text-danger">*</span></label>
												<div class="col-md-9">
													<select class="form-control select2" name="contract_verstaff_employee_in_id" id="contract_verstaff_employee_in_id" required >
														<option selected disabled value="">--Pilih--</option>
														<?php
															unset($datato);
															$datato['table'] = 'patlog__contract.entity__cog';
															$Q1 = $this->view->view_data($datato);
															if($Q1->num_rows()){
																$R1 = $Q1->row();
																$cog_division_id = $R1->cog_division_id;
															}else{
																$cog_division_id = null;
															}
														
															unset($datato);
															$datato['table'] = 'patlog__hrms.entity__employee_in';
															$where = '
																(patlog__hrms.entity__employee_in.division_id = '.$cog_division_id.' AND 
																patlog__hrms.entity__employee_in.employee_in_status = "Aktif") AND 
																(patlog__hrms.entity__employee_in.employee_in_position = "Staf" OR 
																patlog__hrms.entity__employee_in.employee_in_position = "Asisten Manajer")
															';
															$datato['where'] = $where;
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
												<label class="col-md-3 control-label">Aktor <span class="text-danger">*</span></label>
												<div class="col-md-9">
													<input type="text" class="form-control" placeholder="Aktor" value="<?php echo $contract_approval_current_name; ?>" required onfocus="blur();" />
												</div>
											</div>
											<?php
												unset($datato);
												$datato['table'] = 'patlog__hrms.entity__employee_in';
												$datato['where'] = array(
													'patlog__hrms.entity__employee_in.employee_in_id' => $contract_approval_current_id
												);
												$Q1 = $this->view->view_data($datato);
												if($Q1->num_rows()){
													$R1 = $Q1->row();
													$employee_in_position_detail = $R1->employee_in_position_detail;
												}else{
													$employee_in_position_detail = null;
												}
											?>
											<div class="form-group">
												<label class="col-md-3 control-label">Jabatan <span class="text-danger">*</span></label>
												<div class="col-md-9">
													<input type="text" class="form-control" placeholder="Jabatan" value="<?php echo $employee_in_position_detail; ?>" required onfocus="blur();" />
												</div>
											</div>
											<?php
												}
											?>
											<?php
												if($contract_approval_current_category == 'Drafter'){
											?>
											<div class="hr-line-dashed"></div>
											<div class="form-group">
												<label class="col-md-3 control-label">Template File <span class="text-warning">*</span></label>
												<div class="col-md-7">
													<select class="form-control select2" id="template_id" required>
														<option selected disabled value="">--Pilih--</option>
														<?php
															unset($datato);
															$datato['table']='patlog__contract.entity__template';
															$Q1 = $this->view->view_data($datato);
															foreach($Q1->result() as $R1){
														?>
														<option value="<?php echo urlencode($R1->template_id); ?>"><?php echo $R1->template_name ?></option>
														<?php
															}
														?>
													</select>
												</div>
												<div class="col-md-2">
													<a class="btn btn-sm btn-success" id="template_download" href="#" disabled>
														<i class="fa fa-download"></i> Unduh
													</a>
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group">
												<label class="col-md-3 control-label">Keterangan Proses <span class="text-danger">*</span></label>
												<div class="col-md-9">
													<select class="form-control select2" name="contract_process_id" id="contract_process_id" required>
														<option selected disabled value="">--Pilih--</option>
														<?php
															unset($datato);
															$datato['table']='patlog__contract.entity__process';
															$Q1 = $this->view->view_data($datato);
															foreach($Q1->result() as $R1){
														?>
														<option value="<?php echo urlencode($R1->process_id); ?>"><?php echo $R1->process_name ?></option>
														<?php
															}
														?>
													</select>
												</div>
											</div>
											<div class="form-group" id="input_contract_draft_file_name">
												<label class="col-md-3 control-label">Unggah Dokumen <span class="text-danger">*</span></label>
												<div class="col-md-9">
													<input type="file" class="form-control" name="contract_draft_file_name" id="contract_draft_file_name" required />
												</div>
											</div>
											<div class="form-group" id="input_contract_active_start_date">
												<label class="col-md-3 control-label">Tanggal Mulai <span class="text-danger">*</span></label>
												<div class="col-md-9">
													<input type="text" class="form-control date" name="contract_active_start_date" id="contract_active_start_date" placeholder="Tanggal Mulai Berlakunya Kontrak" value="<?php echo $contract_active_start_date; ?>" required onfocus="blur();" />
												</div>
											</div>
											<div class="form-group" id="input_contract_active_end_date">
												<label class="col-md-3 control-label">Tanggal Selesai <span class="text-danger">*</span></label>
												<div class="col-md-9">
													<input type="text" class="form-control date" name="contract_active_end_date" id="contract_active_end_date" placeholder="Tanggal Selesai Berlakunya Kontrak" value="<?php echo $contract_active_end_date; ?>" required onfocus="blur();" />
												</div>
											</div>
											<div class="form-group" id="input_contract_ttd_place">
												<label class="col-md-3 control-label">Tempat/Hari <span class="text-danger">*</span></label>
												<div class="col-md-9">
													<input type="text" class="form-control" name="contract_ttd_place" id="contract_ttd_place" placeholder="Tempat/Hari" value="<?php echo $contract_ttd_place; ?>" required />
												</div>
											</div>
											<div class="form-group" id="input_contract_ttd_date">
												<label class="col-md-3 control-label">Tanggal (TTD) <span class="text-danger">*</span></label>
												<div class="col-md-9">
													<input type="text" class="form-control date" name="contract_ttd_date" id="contract_ttd_date" placeholder="Tanggal (TTD)" value="<?php echo $contract_ttd_date; ?>" required onfocus="blur();" />
												</div>
											</div>
											<div class="form-group" id="input_contract_summary_file_name">
												<label class="col-md-3 control-label">Dokumen Legal Review (PDF) <span class="text-danger">*</span></label>
												<div class="col-md-9">
													<input type="file" class="form-control" name="contract_summary_file_name" id="contract_summary_file_name" accept="application/pdf" />
													<div id="text_process"></div>
												</div>
											</div>
											<div class="form-group" id="input_user_reviewer_employee_in_id">
												<label class="col-md-3 control-label">PIC Reviewer <span class="text-danger">*</span></label>
												<div class="col-md-9">
													<select class="form-control select2" name="user_reviewer_employee_in_id" id="user_reviewer_employee_in_id" style="width:100%;" required>
														<option selected disabled value="">--Pilih--</option>
														<?php
															unset($datato);
															$datato['table'] = 'patlog__contract.entity__user_reviewer';
															$datato['order'] = array(
																'patlog__contract.entity__user_reviewer.user_reviewer_employee_in_name'
															);
															$datato['order_type'] = array(
																'asc'
															);
															$Q1 = $this->view->view_data($datato);
															foreach($Q1->result() as $R1){
														?>
														<option value="<?php echo urlencode($R1->user_reviewer_employee_in_id); ?>"><?php echo $R1->user_reviewer_employee_in_name; ?></option>
														<?php
															}
														?>
													</select>
												</div>
											</div>
											<?php
												}
											?>
											<?php
												if($contract_approval_current_category == 'Upload'){
											?>
											<div class="form-group">
												<label class="col-md-3 control-label">Nomor Kontrak <span class="text-danger">*</span></label>
												<div class="col-md-9">
													<input type="text" class="form-control" name="contract_no_fix" placeholder="Nomor Kontrak" value="<?php echo $contract_no_fix; ?>" required />
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Kontrak Final dari Vendor (PDF) <span class="text-danger">*</span></label>
												<div class="col-md-9">
													<input type="file" class="form-control" name="contract_summary_file_final" accept="application/pdf" required />
												</div>
											</div>
											<?php
												}
											?>
											<div class="form-group">
												<label class="col-md-3 control-label">Status <span class="text-danger">*</span></label>
												<div class="col-md-9">
													<select class="form-control select2" name="contract_status_process" id="contract_status_process" style="width:100%;" required >
														<option selected disabled value="">--Pilih--</option>
														<?php
															if($contract_approval_current_category == 'Approver' or $contract_approval_current_category == 'Loket' or $contract_approval_current_category == 'Reviewer' or $contract_approval_current_category == 'Upload'){
														?>
														<option value="<?php echo urlencode('Approved'); ?>" >Approve</option>
														<option value="<?php echo urlencode('Rejected'); ?>" >Reject</option>
														<?php
															}
														?>
														<?php
															if(($contract_approval_current_category == 'Approver' or $contract_approval_current_category == 'Loket' or $contract_approval_current_category == 'Reviewer' or $contract_approval_current_category == 'Upload') and $contract_approver_level > 1){
														?>
														<option value="<?php echo urlencode('Back'); ?>" >Kembalikan ke Sebelumnya</option>
														<?php
															}
														?>
													</select>
												</div>
											</div>
											<?php
												if($contract_approval_current_sign == 'yes'){
											?>
											<div class="form-group">
												<label class="col-md-3 control-label">Tipe (TTD) <span class="text-danger">*</span></label>
												<div class="col-md-9">
													<select class="form-control select2" name="contract_ttd_sign_type" id="contract_ttd_sign_type" style="width:100%;" required>
														<option selected disabled value="">--Pilih--</option>
														<?php
															if($contract_ttd_sign_trigger == 'yes'){
														?>
														<option value="<?php echo urlencode($contract_ttd_sign_type); ?>"><?php echo $contract_ttd_sign_type; ?></option>
														<?php
															}else{
														?>
														<?php
															unset($datato);
															$datato['table'] = 'patlog__contract.entity__contract_approval';
															$datato['where'] = array(
																'patlog__contract.entity__contract_approval.contract_id' => $contract_id,
																'patlog__contract.entity__contract_approval.contract_approval_category' => 'Approver',
																'patlog__contract.entity__contract_approval.contract_approval_status is null' => null
															);
															$Q1 = $this->view->view_data($datato);
															$total = $Q1->num_rows();
															if($total > 1){
														?>
														<option value="<?php echo urlencode('Manual'); ?>">Manual (TTD Basah)</option>
														<?php
															if($contract_ttd_sign_type != 'Digital Sertifikasi'){
														?>
														<option value="<?php echo urlencode('Digital'); ?>">Digital</option>
														<?php
															}
														?>
														<?php
															}
														?>
														<?php
															unset($datato);
															$datato['table'] = 'patlog__hrms.entity__employee_in';
															$datato['where'] = array(
																'patlog__hrms.entity__employee_in.employee_in_id' => $contract_approval_current_id
															);
															$Q1 = $this->view->view_data($datato);
															if($Q1->num_rows()){
																$R1 = $Q1->row();
																$employee_in_position = $R1->employee_in_position;
															}else{
																$employee_in_position = null;
															}
														?>
														<?php
															$contract_approval_employee_id = '';
															unset($datato);
															$datato['table'] = 'patlog__contract.entity__contract_approval';
															$datato['where'] = array(
																'patlog__contract.entity__contract_approval.contract_id' => $contract_id,
																'patlog__contract.entity__contract_approval.contract_approval_sign' => 'yes'
															);
															$datato['order'] = array(
																'patlog__contract.entity__contract_approval.contract_approval_level'
															);
															$datato['order_type'] = array(
																'desc'
															);
															$Q1 = $this->view->view_data($datato);
															if($Q1->num_rows()){
																$R1 = $Q1->row();
																$contract_approval_employee_id = $R1->contract_approval_employee_id;
															}
														?>
														<?php
															if($employee_in_position == 'Direktur' or $contract_ttd_sign_type == 'Digital Sertifikasi' or $contract_approval_employee_id == $contract_approval_current_id){
														?>
														<option value="<?php echo urlencode('Digital Sertifikasi'); ?>">Digital Sertifikasi</option>
														<?php
															}
														?>
														<?php
															}
														?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Jenis (TTD) <span class="text-danger">*</span></label>
												<div class="col-md-9">
													<select class="form-control select2" name="contract_ttd_sign_speciment" id="contract_ttd_sign_speciment" style="width:100%;" required>
														<option selected disabled value="">--Pilih--</option>
														
													</select>
												</div>
											</div>
											<div class="form-group" id="form_contract_ttd_sign_type">
												<label class="col-md-3 control-label">Tandatangani Dokumen <span class="text-danger">*</span></label>
												<div class="col-md-9">
													<div id="text_contract_ttd_sign_type"></div>
												</div>
											</div>
											<?php
												}
											?>
											<div class="form-group">
												<label class="col-md-3 control-label">Keterangan</label>
												<div class="col-md-9">
													<textarea class="form-control" name="contract_log_message" placeholder="Keterangan" rows="3" maxlength="1000"></textarea>
													<span class="help-block m-b-none"><span class="text-warning">*</span> maksimal 1000 karakter.</span>
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group">
												<div class="col-md-9 col-md-offset-3">
													<input type="hidden" id="contract_approval_current_id" value="<?php echo $contract_approval_current_id; ?>" />
													<button class="btn btn-primary ladda-button" type="submit" data-style="zoom-in" id="submit-btn">Simpan</button>
													<button class="btn btn-white" type="button" onclick="window.location.href='<?php echo site_url('module_contract/employee/proses_kontrak_utama/'); ?>'">Kembali</button>
												</div>
											</div>
										</form>
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
				
					$(document).ready(function () {
						$("#contract_draft_file_name").prop('disabled', true);
						$("#contract_draft_file_name").prop('required', false);
						$("#input_contract_draft_file_name").hide();
						$("#contract_active_start_date").prop('disabled', true);
						$("#contract_active_start_date").prop('required', false);
						$("#input_contract_active_start_date").hide();
						$("#contract_active_end_date").prop('disabled', true);
						$("#contract_active_end_date").prop('required', false);
						$("#input_contract_active_end_date").hide();
						$("#contract_ttd_place").prop('disabled', true);
						$("#contract_ttd_place").prop('required', false);
						$("#input_contract_ttd_place").hide();
						$("#contract_ttd_date").prop('disabled', true);
						$("#contract_ttd_date").prop('required', false);
						$("#input_contract_ttd_date").hide();
						$("#contract_ttd_date").prop('disabled', true);
						$("#contract_ttd_date").prop('required', false);
						$("#input_contract_ttd_sign").hide();
						$("#contract_ttd_sign").prop('disabled', true);
						$("#contract_ttd_sign").prop('required', false);
						$("#input_contract_ttd_date").hide();
						$("#contract_summary_id").prop('disabled', true);
						$("#contract_summary_id").prop('required', false);
						$("#input_contract_summary_id").hide();
						$("#contract_summary_file_name").prop('disabled', true);
						$("#contract_summary_file_name").prop('required', false);
						$("#input_contract_summary_file_name").hide();
						$("#user_reviewer_employee_in_id").prop('disabled', true);
						$("#user_reviewer_employee_in_id").prop('required', false);
						$("#input_user_reviewer_employee_in_id").hide();
						$("#contract_ttd_sign_type").prop('disabled', true);
						$("#contract_ttd_sign_type").prop('required', false);
						$("#contract_ttd_sign_speciment").prop('disabled', true);
						$("#contract_ttd_sign_speciment").prop('required', false);
						$("#form_contract_ttd_sign_type").hide();
						
						$("#form-approval").submit(function(e){
							if($('#modal_submit').hasClass('in') == false){
								e.preventDefault();
								var str = $('#contract_status_process').val();
								var res = str.toUpperCase();
								$('#submit-text').html(res);
								$('#modal_submit').modal('show');
							}
						});
						
						$('#submit').click(function() {
							$("#form-approval").submit();
						});
						
						setInterval( function () {
							checkTrigger();
						}, 3000);
					});
					
					$("#template_id").change(function(){
						$.ajax({
							type: 'POST',
							data: {
								template_id: $("#template_id").val(),
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							url: "<?php echo site_url(); ?>module_contract/employee_functions/get_form_template_file/",
							success: function(result){
								var data = JSON.parse(result);
								$("#template_download").removeAttr('disabled');
								$("#template_download").attr('href', data['href']);
								$("#template_download").attr('download', data['name']);
							}
						});
					});
					
					$("#contract_process_id").change(function(){
						$.ajax({
							type: 'POST',
							data: {
								contract_process_id: $("#contract_process_id").val(),
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							url: "<?php echo site_url(); ?>module_contract/employee_functions/get_form_contract_process/",
							success: function(result){
								var data = JSON.parse(result);
								if(data['contract_process_attachment_status'] == 'no'){
									$("#contract_draft_file_name").prop('disabled', true);
									$("#contract_draft_file_name").prop('required', false);
									$("#input_contract_draft_file_name").hide();
								}else if(data['contract_process_attachment_status'] == 'yes'){
									$("#contract_draft_file_name").prop('disabled', false);
									$("#contract_draft_file_name").prop('required', true);
									$("#input_contract_draft_file_name").show();
								}
								
								if(data['contract_process_flow'] == 'process'){
									$("#contract_active_start_date").prop('disabled', true);
									$("#contract_active_start_date").prop('required', false);
									$("#input_contract_active_start_date").hide();
									$("#contract_active_end_date").prop('disabled', true);
									$("#contract_active_end_date").prop('required', false);
									$("#input_contract_active_end_date").hide();
									$("#contract_no_fix").prop('disabled', true);
									$("#contract_no_fix").prop('required', false);
									$("#input_contract_no_fix").hide();
									$("#contract_ttd_place").prop('disabled', true);
									$("#contract_ttd_place").prop('required', false);
									$("#input_contract_ttd_place").hide();
									$("#contract_ttd_date").prop('disabled', true);
									$("#contract_ttd_date").prop('required', false);
									$("#input_contract_ttd_sign").hide();
									$("#contract_ttd_sign").prop('disabled', true);
									$("#contract_ttd_sign").prop('required', false);
									$("#input_contract_ttd_date").hide();
									$("#contract_summary_id").prop('disabled', true);
									$("#contract_summary_id").prop('required', false);
									$("#input_contract_summary_id").hide();
									$("#contract_summary_file_name").prop('disabled', true);
									$("#contract_summary_file_name").prop('required', false);
									$("#input_contract_summary_file_name").hide();
									$("#user_reviewer_employee_in_id").prop('disabled', true);
									$("#user_reviewer_employee_in_id").prop('required', false);
									$("#input_user_reviewer_employee_in_id").hide();
									$("#contract_status_process").val('').trigger('change');
									$("#contract_status_process").html(data['contract_status_process']);
								}else if(data['contract_process_flow'] == 'final'){
									$("#contract_active_start_date").prop('disabled', false);
									$("#contract_active_start_date").prop('required', true);
									$("#input_contract_active_start_date").show();
									$("#contract_active_end_date").prop('disabled', false);
									$("#contract_active_end_date").prop('required', true);
									$("#input_contract_active_end_date").show();
									$("#contract_no_fix").prop('disabled', false);
									$("#contract_no_fix").prop('required', true);
									$("#input_contract_no_fix").show();
									$("#contract_ttd_place").prop('disabled', false);
									$("#contract_ttd_place").prop('required', true);
									$("#input_contract_ttd_place").show();
									$("#contract_ttd_date").prop('disabled', false);
									$("#contract_ttd_date").prop('required', true);
									$("#input_contract_ttd_sign").show();
									$("#contract_ttd_sign").prop('disabled', false);
									$("#contract_ttd_sign").prop('required', true);
									$("#input_contract_ttd_date").show();
									$("#contract_summary_id").prop('disabled', false);
									$("#contract_summary_id").prop('required', true);
									$("#input_contract_summary_id").show();
									$("#contract_summary_file_name").prop('disabled', false);
									$("#contract_summary_file_name").prop('required', true);
									$("#input_contract_summary_file_name").show();
									$("#user_reviewer_employee_in_id").prop('disabled', false);
									$("#user_reviewer_employee_in_id").prop('required', true);
									$("#input_user_reviewer_employee_in_id").show();
									$("#contract_status_process").val('').trigger('change');
									$("#contract_status_process").html('');
								}
							}
						});
					});
					
					$("#contract_status_process").change(function(){
						if($("#contract_status_process").val() == 'Approved' || $("#contract_status_process").val() == 'Done'){
							$("#contract_ttd_sign_type").val('').trigger('change');
							$("#contract_ttd_sign_type").prop('disabled', false);
							$("#contract_ttd_sign_type").prop('required', true);
							if($("#contract_status_process").val() == 'Approved'){
								<?php
									if($contract_approval_current_category == 'Approver'){
								?>
								$("#submit-btn").prop('disabled', true);
								<?php
									}
								?>
							}
							
							// $.ajax({
								// type: 'POST',
								// data: {
									// contract_id: <?php echo $contract_id; ?>,
									// contract_ttd_sign_type: 'Digital+Sertifikasi',
									// "<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
								// },
								// url: "<?php echo site_url(); ?>module_contract/employee_functions/get_dropdown_sign_speciment/",
								// success: function(result){
									// var data = JSON.parse(result);
									// if(data['status'] == true){
										// $("#contract_ttd_sign_speciment").prop('disabled', false);
										// $("#contract_ttd_sign_speciment").prop('required', true);
										// $("#contract_ttd_sign_speciment").val('').trigger('change');
										// $("#contract_ttd_sign_speciment").html(data['contract_ttd_sign_speciment']);
									// }else if(data['status'] == false){
										// $("#form_contract_ttd_sign_type").hide();
									// }
								// }
							// });
						}else{
							$("#contract_ttd_sign_type").val('').trigger('change');
							$("#contract_ttd_sign_type").prop('disabled', true);
							$("#contract_ttd_sign_type").prop('required', false);
							$("#contract_ttd_sign_speciment").val('').trigger('change');
							$("#contract_ttd_sign_speciment").prop('disabled', true);
							$("#contract_ttd_sign_speciment").prop('required', false);
							$("#form_contract_ttd_sign_type").hide();
							$("#submit-btn").prop('disabled', false);
						}
					});
					
					$("#contract_summary_file_name").change(function(){
						var form_data = new FormData();
						var f = document.getElementById("contract_summary_file_name").files[0];
						form_data.append("contract_id", "<?php echo $contract_id; ?>");
						form_data.append("contract_process_id", $("#contract_process_id").val());
						form_data.append("contract_summary_file_name", f);
						form_data.append("<?php echo $this->security->get_csrf_token_name(); ?>", "<?php echo $this->security->get_csrf_hash(); ?>");
						$.ajax({
							type: 'POST',
							data: form_data,
							processData: false,
							contentType: false,
							url: "<?php echo site_url(); ?>module_contract/employee_functions/get_form_contract_upload/",
							beforeSend: function(){
								$('#text_process').html("<label class='text-success' style='margin-top:5px;'>Proses mengupload...</label>");
							}, 
							success: function(result){
								var data = JSON.parse(result);
								$('#text_process').html("<label class='text-navy' style='margin-top:5px;'>Upload selesai.</label>");
								$("#contract_status_process").val('').trigger('change');
								$("#contract_status_process").html(data['contract_status_process']);
							},
							error: function(xhr, textStatus, errorThrown) {
								alert('error');
							}
						});
					});
					
					$("#contract_ttd_sign_type").change(function(){
						$.ajax({
							type: 'POST',
							data: {
								contract_id: <?php echo $contract_id; ?>,
								contract_ttd_sign_type: $("#contract_ttd_sign_type").val(),
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							url: "<?php echo site_url(); ?>module_contract/employee_functions/get_dropdown_sign_speciment/",
							success: function(result){
								var data = JSON.parse(result);
								if(data['status'] == false){
									$("#contract_ttd_sign_speciment").prop('disabled', true);
									$("#contract_ttd_sign_speciment").prop('required', false);
									$("#contract_ttd_sign_speciment").val('').trigger('change');
								}else if(data['status'] == true){
									$("#contract_ttd_sign_speciment").prop('disabled', false);
									$("#contract_ttd_sign_speciment").prop('required', true);
									if(data['selected'] != false){
										$("#contract_ttd_sign_speciment").val(data['selected']).trigger('change');
									}else{
										$("#contract_ttd_sign_speciment").val('').trigger('change');
									}
									$("#contract_ttd_sign_speciment").html(data['contract_ttd_sign_speciment']);
								}
								$("#form_contract_ttd_sign_type").hide();
								$("#text_contract_ttd_sign_type").html('');
								
								if($("#contract_ttd_sign_type").val() == 'Manual'){
									$("#contract_ttd_sign_type").prop('disabled', false);
									$("#contract_ttd_sign_type").prop('required', true);
									$("#submit-btn").prop('disabled', false);
								}
							}
						});
					});
					
					$("#contract_ttd_sign_speciment").change(function(){
						if($("#contract_ttd_sign_speciment").val() != null){
							$.ajax({
								type: 'POST',
								data: {
									employee_in_id: $("#contract_approval_current_id").val(),
									contract_id: <?php echo $contract_id; ?>,
									contract_ttd_sign_type: $("#contract_ttd_sign_type").val(),
									"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
								},
								url: "<?php echo site_url(); ?>module_contract/employee_functions/get_input_sign_digital/",
								success: function(result){
									var data = JSON.parse(result);
									$("#form_contract_ttd_sign_type").show();
									$("#text_contract_ttd_sign_type").html(data['text_contract_ttd_sign_type']);
									if(data['trigger'] == 'yes' || $("#contract_ttd_sign_type").val() == 'Manual'){
										$("#contract_ttd_sign_type").prop('disabled', false);
										$("#contract_ttd_sign_type").prop('required', true);
										$("#submit-btn").prop('disabled', false);
									}
								}
							});
						}
					});
					
					function onSign()
					{
						if($("#contract_ttd_sign_type").val() == 'Digital'){
							var url = '<?php echo site_url(); ?>module_contract/employee_functions/contract_sign/<?php echo $contract_id; ?>/' + $("#contract_ttd_sign_speciment").val() + '?time=<?php echo date("YmdHis"); ?>';
						}else if($("#contract_ttd_sign_type").val() == 'Digital+Sertifikasi'){
							var url = '<?php echo site_url(); ?>module_contract/employee_functions/contract_sign_certification/<?php echo $contract_id; ?>/' + $("#contract_ttd_sign_speciment").val() + '?time=<?php echo date("YmdHis"); ?>';
						}
						window.open(url, '_blank').focus();
					}
					
					function checkTrigger()
					{
						$.ajax({
							type: 'POST',
							data: {
								contract_id: <?php echo $contract_id; ?>,
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							url: "<?php echo site_url(); ?>module_contract/employee_functions/get_input_trigger/",
							success: function(result){
								var data = JSON.parse(result);
								if(data['trigger'] == 'yes'){
									$("#submit-btn").prop('disabled', false);
								}
							}
						});
					}
					
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
									<table class="table table-striped table-bordered table-hover" id="table" >
										<thead>
											<tr>
												<th>Kode</th>
												<th>Pemohon</th>
												<th>Jenis Permintaan</th>
												<th>Deskripsi Proyek</th>
												<th>Nama Perusahaan</th>
												<th>TMT Kontrak</th>
												<th>Dokumen Legal</th>
												<th>Proses</th>
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
							"url": "<?php echo site_url('module_contract/employee_functions/get_table_process_contract_project/')?>",
							"data": {
								"<?php echo $this->security->get_csrf_token_name(); ?>": '<?php echo $this->security->get_csrf_hash(); ?>'
							},
							"type": "POST"
						},
						"columnDefs": [
							{ 
								"targets": [ 6, 8 ],
								"orderable": false
							},
						],
						"language": {
							"url": "<?php echo base_url('assets/template/inspinia/js/plugins/dataTables/Indonesian.json'); ?>"
						},
					});
					
					$(document).ready(function () {
						$(document).on('click','.delete',function(e){
							e.preventDefault();
							$('#confirm_str').html('Apakah anda yakin ingin menghapus data ini?');
							$('#delete').show();
							$('#delete_all').hide();
							var id=this.id.substr(7);
							$('#id').val(id);
						});
						
						$('#delete').click(function() {
							window.location = '<?php echo site_url(); ?>module_contract/employee_functions/contract/delete/' + $('#id').val();
						});
					});
					
				</script>
				<?php
					}
				?>
<!-- BEGIN SPPK Drafter list popup (injected) -->
<div class="modal fade" id="modal-sppk-drafter-list" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">SPPK Diproses (Drafter) &mdash; <span id="sppk-modal-emp"></span></h4>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered" id="sppk-drafter-table">
						<thead><tr>
							<th style="width:50px;">No</th>
							<th>Nomor SPPK</th>
							<th>Nomor Fix</th>
							<th>Mitra</th>
							<th>Project</th>
							<th>Drafter Awal</th>
							<th>Last Activity</th>
						</tr></thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button></div>
		</div>
	</div>
</div>
<script>
(function(){
	var URL_SPPK = '<?php echo site_url("module_contract/employee_functions/sppk_drafter_list"); ?>';
	function esc(s){ return (s==null?'':String(s)).replace(/[&<>]/g, function(c){ return {'&':'&amp;','<':'&lt;','>':'&gt;'}[c]; }); }
	$(document).on('click', '.sppk-mapping-count', function(){
		var empId = $(this).data('emp-id'), empName = $(this).data('emp-name');
		$('#sppk-modal-emp').text(empName);
		$('#sppk-drafter-table tbody').html('<tr><td colspan="7" class="text-center"><i class="fa fa-spinner fa-spin"></i> Memuat...</td></tr>');
		$('#modal-sppk-drafter-list').modal('show');
		$.get(URL_SPPK, {employee_in_id: empId}, function(res){
			if(!res || !res.ok){ $('#sppk-drafter-table tbody').html('<tr><td colspan="7" class="text-danger">Gagal memuat.</td></tr>'); return; }
			if(!res.items || !res.items.length){ $('#sppk-drafter-table tbody').html('<tr><td colspan="7" class="text-center text-muted">Tidak ada SPPK.</td></tr>'); return; }
			var html = '';
			for(var i=0;i<res.items.length;i++){
				var r = res.items[i];
				html += '<tr>'
					+ '<td>'+(i+1)+'</td>'
					+ '<td>'+esc(r.contract_no)+'</td>'
					+ '<td>'+esc(r.contract_no_fix||'-')+'</td>'
					+ '<td>'+esc(r.contract_company_name||r.contract_third_party_name||'-')+'</td>'
					+ '<td><small>'+esc(r.contract_project_code_name||'-')+'</small></td>'
					+ '<td>'+esc(r.drafter_awal||'-')+'</td>'
					+ '<td><small>'+esc(r.last_status||'-')+' oleh '+esc(r.last_actor||'-')+'<br/>'+esc(r.last_at||'-')+'</small></td>'
					+ '</tr>';
			}
			$('#sppk-drafter-table tbody').html(html);
		}, 'json');
	});
})();
</script>
<!-- END SPPK Drafter list popup -->
