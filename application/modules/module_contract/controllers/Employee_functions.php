<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Employee_functions extends MX_Controller{
    
    public function __construct(){
        parent::__construct();
		
	}
	
	public function logout()
	{
		redirect(site_url('desktop/employee/beranda/'));
	}
	
	public function contract()
	{
		if($this->uri->segment(4) == 'add'){
			ini_set('memory_limit', '-1');
			ini_set('max_execution_time', 0);
			set_time_limit(0);
			
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__category';
			$datato['where'] = array(
				'patlog__contract.entity__category.category_id' => urldecode($this->input->post('contract_category_id'))
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$contract_category_id = $R1->category_id;
				$contract_category_to = $R1->category_to;
			}else{
				$contract_category_id = null;
				$contract_category_to = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__request';
			$datato['where'] = array(
				'patlog__contract.entity__request.request_id' => urldecode($this->input->post('contract_request_id'))
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$contract_request_id = $R1->request_id;
				$contract_request_name = $R1->request_name;
			}else{
				$contract_request_id = null;
				$contract_request_name = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__request_description';
			$datato['where'] = array(
				'patlog__contract.entity__request_description.request_description_id' => urldecode($this->input->post('contract_request_description_id'))
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$contract_request_description_id = $R1->request_description_id;
				$contract_request_description_name = $R1->request_description_name;
			}else{
				$contract_request_description_id = null;
				$contract_request_description_name = null;
			}
			
			if(urldecode($this->input->post('contract_project_code_category')) == 'External'){
				unset($datato);
				$datato['table'] = 'patlog__project.entity__project_code';
				$datato['where'] = array(
					'patlog__project.entity__project_code.project_code_id' => urldecode($this->input->post('contract_project_code_id'))
				);
				$Q1 = $this->view->view_data($datato);
				if($Q1->num_rows()){
					$R1 = $Q1->row();
					$contract_project_code_id = $R1->project_code_id;
					$contract_project_code_name = $R1->project_code_name;
					$contract_project_code_description = $R1->project_code_description;
				}
			}elseif(urldecode($this->input->post('contract_project_code_category')) == 'Internal'){
				unset($datato);
				$datato['table'] = 'patlog__project.entity__cost_center';
				$datato['where'] = array(
					'patlog__project.entity__cost_center.cost_center_id' => urldecode($this->input->post('contract_project_code_id'))
				);
				$Q1 = $this->view->view_data($datato);
				if($Q1->num_rows()){
					$R1 = $Q1->row();
					$contract_project_code_id = $R1->cost_center_id;
					$contract_project_code_name = $R1->cost_center_name;
					$contract_project_code_description = $R1->cost_center_description;
				}
			}
			
			if($this->input->post('contract_date_start') != '' and $this->input->post('contract_date_end') != ''){
				$contract_date_start = $this->input->post('contract_date_start');
				$contract_date_end = $this->input->post('contract_date_end');
				$start_date = new DateTime($contract_date_start);
				$end_date = new DateTime($contract_date_end);
				$contract_period = $start_date->diff($end_date)->days;
				$contract_period = $contract_period + 1;
			}else{
				$contract_date_start = null;
				$contract_date_end = null;
				$contract_period = null;
			}
			
			if(urldecode($this->input->post('contract_project_currency')) == 'IDR'){
				$currency = 'Rupiah';
			}elseif(urldecode($this->input->post('contract_project_currency')) == 'USD'){
				$currency = 'Dollar';
			}
			$contract_project_calculate = ucwords($this->func_calculate($this->input->post('contract_project_cost'))).' '.$currency;
			
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__third_party';
			$datato['where'] = array(
				'patlog__contract.entity__third_party.third_party_id' => urldecode($this->input->post('contract_third_party_id'))
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$contract_third_party_id = $R1->third_party_id;
				$contract_third_party_name = $R1->third_party_name;
			}else{
				$contract_third_party_id = null;
				$contract_third_party_name = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__hrms.entity__employee_in';
			$datato['table_join'] = array(
				'patlog__hrms.entity__division'
			);
			$datato['table_join_on'] = array(
				'patlog__hrms.entity__employee_in'
			);
			$datato['join_id'] = array(
				'division_id'
			);
			$datato['join_type'] = array(
				'inner'
			);
			$datato['where'] = array(
				'patlog__hrms.entity__employee_in.employee_in_id' => $this->input->post('contract_creator_employee_in_id')
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$contract_creator_division_id = $R1->division_id;
				$contract_creator_division_name = $R1->division_name;
				$contract_creator_employee_in_id = $R1->employee_in_id;
				$contract_creator_employee_in_code = $R1->employee_in_code;
				$contract_creator_employee_in_name = $R1->employee_in_name;
				$contract_creator_employee_in_position = $R1->employee_in_position;
				$contract_creator_employee_in_position_detail = $R1->employee_in_position_detail;
			}else{
				$contract_creator_division_id = null;
				$contract_creator_division_name = null;
				$contract_creator_employee_in_id = null;
				$contract_creator_employee_in_code = null;
				$contract_creator_employee_in_name = null;
				$contract_creator_employee_in_position = null;
				$contract_creator_employee_in_position_detail = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__config.entity__approval';
			$datato['table_join'] = array(
				'patlog__config.entity__approval_detail'
			);
			$datato['table_join_on'] = array(
				'patlog__config.entity__approval'
			);
			$datato['join_id'] = array(
				'approval_id'
			);
			$datato['join_type'] = array(
				'inner'
			);
			$datato['where'] = array(
				'patlog__config.entity__approval_detail.approval_id' => urldecode($this->input->post('contract_approval_select_id'))
			);
			$datato['order'] = array(
				'patlog__config.entity__approval_detail.approval_detail_level'
			);
			$datato['order_type'] = array(
				'asc'
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$contract_approval_current_id = $R1->approval_detail_employee_in_id;
				$contract_approval_current_name = $R1->approval_detail_employee_in_name;
				$contract_approval_current_category = $R1->approval_detail_role;
				$contract_approval_current_sign = $R1->approval_detail_sign;
				$contract_approval_select_id = $R1->approval_id;
				$contract_approval_select_name = $R1->approval_name;
			}else{
				$contract_approval_current_id = null;
				$contract_approval_current_name = null;
				$contract_approval_current_category = null;
				$contract_approval_current_sign = null;
				$contract_approval_select_id = null;
				$contract_approval_select_name = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__contract';
			$datato['where'] = array(
				'YEAR(patlog__contract.entity__contract.contract_date)' => date('Y')
			);
			$Q1 = $this->view->view_data($datato);
			$total_contract = $Q1->num_rows() + 1;
			$contract_no = 'L'.date('Y').str_pad($total_contract, 5, '0', STR_PAD_LEFT);
			
			unset($datato);
			$datato['database'] = 'patlog__contract';
			$datato['table'] = 'entity__contract';
			$datato['contract_no'] = $contract_no;
			$datato['contract_qr'] = 'no.png';
			$datato['contract_date'] = date('Y-m-d');
			$datato['contract_creator_division_id'] = $contract_creator_division_id;
			$datato['contract_creator_division_name'] = $contract_creator_division_name;
			$datato['contract_creator_employee_in_id'] = $contract_creator_employee_in_id;
			$datato['contract_creator_employee_in_code'] = $contract_creator_employee_in_code;
			$datato['contract_creator_employee_in_name'] = $contract_creator_employee_in_name;
			$datato['contract_creator_employee_in_position'] = $contract_creator_employee_in_position;
			$datato['contract_category_id'] = $contract_category_id;
			$datato['contract_category_to'] = $contract_category_to;
			$datato['contract_request_id'] = $contract_request_id;
			$datato['contract_request_name'] = $contract_request_name;
			$datato['contract_request_description_id'] = $contract_request_description_id;
			$datato['contract_request_description_name'] = $contract_request_description_name;
			$datato['contract_project_code_category'] = urldecode($this->input->post('contract_project_code_category'));
			$datato['contract_project_code_id'] = $contract_project_code_id;
			$datato['contract_project_code_name'] = $contract_project_code_name;
			$datato['contract_project_code_description'] = $contract_project_code_description;
			$datato['contract_date_start'] = $contract_date_start;
			$datato['contract_date_end'] = $contract_date_end;
			$datato['contract_period'] = $contract_period;
			$datato['contract_project_currency'] = urldecode($this->input->post('contract_project_currency'));
			$datato['contract_project_cost'] = $this->input->post('contract_project_cost');
			$datato['contract_project_calculate'] = $contract_project_calculate;
			$datato['contract_project_note'] = $this->input->post('contract_project_note');
			$datato['contract_third_party_id'] = $contract_third_party_id;
			$datato['contract_third_party_name'] = $contract_third_party_name;
			$datato['contract_company_name'] = $this->input->post('contract_company_name');
			$datato['contract_user_name'] = $this->input->post('contract_user_name');
			$datato['contract_user_position'] = $this->input->post('contract_user_position');
			$datato['contract_document_in'] = 'no.pdf';
			$datato['contract_document_temporary'] = 'no.pdf';
			$datato['contract_summary_file_name'] = 'no.pdf';
			$datato['contract_summary_file_ttd'] = 'no.pdf';
			$datato['contract_summary_file_final'] = 'no.pdf';
			$datato['contract_approval_select_id'] = $contract_approval_select_id;
			$datato['contract_approval_select_name'] = $contract_approval_select_name;
			$datato['contract_approval_current_id'] = $contract_approval_current_id;
			$datato['contract_approval_current_name'] = $contract_approval_current_name;
			$datato['contract_approval_current_category'] = $contract_approval_current_category;
			$datato['contract_approval_current_sign'] = $contract_approval_current_sign;
			$datato['contract_approver_level'] = 1;
			$datato['contract_approver_message'] = '<div class="badge badge-default">Waiting</div> &bull; '.$contract_approval_current_name;
			$datato['contract_status_delete'] = 'no';
			$datato['contract_status_done'] = 'no';
			$datato['contract_insert'] = date('Y-m-d H:i:s');
			$contract_id = $this->mod->insert($datato);
			
			unset($datato);
			$datato['table'] = 'patlog__config.entity__approval_detail';
			$datato['where'] = array(
				'patlog__config.entity__approval_detail.approval_id' => urldecode($this->input->post('contract_approval_select_id'))
			);
			$datato['order'] = array(
				'patlog__config.entity__approval_detail.approval_detail_level'
			);
			$datato['order_type'] = array(
				'asc'
			);
			$Q1 = $this->view->view_data($datato);
			foreach($Q1->result() as $R1){
				if($R1->approval_detail_employee_in_id == null){
					if($R1->approval_detail_employee_in_name == 'User'){
						$contract_approval_employee_id = $contract_creator_employee_in_id;
						$contract_approval_employee_name = $contract_creator_employee_in_name;
						$contract_approval_employee_position = $contract_creator_employee_in_position;
						$contract_approval_employee_position_detail = $contract_creator_employee_in_position_detail;
					}elseif($R1->approval_detail_employee_in_name == 'Drafter'){
						$contract_approval_employee_id = null;
						$contract_approval_employee_name = 'Drafter';
						$contract_approval_employee_position = 'Drafter';
						$contract_approval_employee_position_detail = 'Drafter';
					}elseif($R1->approval_detail_employee_in_name == 'Loket'){
						$contract_approval_employee_id = null;
						$contract_approval_employee_name = 'Loket';
						$contract_approval_employee_position = 'Loket';
						$contract_approval_employee_position_detail = 'Loket';
					}else{
						$contract_approval_employee_id = null;
						$contract_approval_employee_name = null;
						$contract_approval_employee_position = null;
						$contract_approval_employee_position_detail = null;
					}
				}else{
					$contract_approval_employee_id = $R1->approval_detail_employee_in_id;
					$contract_approval_employee_name = $R1->approval_detail_employee_in_name;
					$contract_approval_employee_position = $R1->approval_detail_employee_in_position;
					$contract_approval_employee_position_detail = $R1->approval_detail_employee_in_position_detail;
				}
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__contract_approval';
				$datato['contract_id'] = $contract_id;
				$datato['contract_approval_level'] = $R1->approval_detail_level;
				$datato['contract_approval_employee_id'] = $contract_approval_employee_id;
				$datato['contract_approval_employee_name'] = $contract_approval_employee_name;
				$datato['contract_approval_employee_position'] = $contract_approval_employee_position;
				$datato['contract_approval_employee_position_detail'] = $contract_approval_employee_position_detail;
				$datato['contract_approval_category'] = $R1->approval_detail_role;
				$datato['contract_approval_sign'] = $R1->approval_detail_sign;
				$datato['contract_approval_status'] = null;
				$datato['contract_approval_date'] = null;
				$datato['contract_approval_insert'] = date('Y-m-d H:i:s');
				$this->mod->insert($datato);
			}
			
			$arr_document_id = $this->input->post('document_id');
			for($i=0;$i<count($arr_document_id);$i++){
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__document';
				$datato['where'] = array(
					'patlog__contract.entity__document.document_id' => $arr_document_id[$i]
				);
				$Q1 = $this->view->view_data($datato);
				if($Q1->num_rows()){
					$R1 = $Q1->row();
					$contract_document_order = $R1->document_order;
					$contract_document_name = $R1->document_name;
					$contract_document_mandatory = $R1->document_mandatory;
				}else{
					$contract_document_order = null;
					$contract_document_name = null;
					$contract_document_mandatory = null;
				}
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__contract_document';
				$datato['contract_id'] = $contract_id;
				$datato['document_id'] = $arr_document_id[$i];
				$datato['contract_document_order'] = $contract_document_order;
				$datato['contract_document_name'] = $contract_document_name;
				$datato['contract_document_mandatory'] = $contract_document_mandatory;
				$datato['contract_document_file'] = 'no.pdf';
				$datato['contract_document_insert'] = date('Y-m-d H:i:s');
				$contract_document_id = $this->mod->insert($datato);
				
				unset($data);
				foreach($_FILES['contract_document_file'] as $key => $file){
					$data[$key] = $_FILES['contract_document_file'][$key];
				}
				if(isset($data['name'][$i])){
					$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
					$file_name = 'document-file-'.md5($contract_id).'-'.md5($contract_document_id).'.'.$ext;
					$path = './assets/mod__contract/attach/contract-document-file/'.$file_name;
					$arr_type = array(
						'application/pdf',
					);
					if(in_array($data['type'][$i], $arr_type)){
						move_uploaded_file($data['tmp_name'][$i], $path);
						unset($datato);
						$datato['database'] = 'patlog__contract';
						$datato['table'] = 'entity__contract_document';
						$datato['contract_document_file'] = $file_name;
						$datato['field'] = 'contract_document_id';
						$datato['id'] = $contract_document_id;
						$this->mod->update($datato);
					}
				}
			}
			
			if(isset($_FILES['contract_attachment_file'])){
				$arr_contract_attachment_name = $this->input->post('contract_attachment_name');
				$arr_contract_attachment_file = $this->input->post('contract_attachment_file');
				
				foreach($_FILES['contract_attachment_file'] as $key => $file){
					$data[$key] = $_FILES['contract_attachment_file'][$key];
				}
				
				for($i=0;$i<count($arr_contract_attachment_name);$i++){
					if($arr_contract_attachment_name[$i] != ''){
						unset($datato);
						$datato['database'] = 'patlog__contract';
						$datato['table'] = 'entity__contract_attachment';
						$datato['contract_id'] = $contract_id;
						$datato['contract_attachment_name'] = $arr_contract_attachment_name[$i];
						$datato['contract_attachment_file'] = 'no.pdf';
						$datato['contract_attachment_insert'] = date('Y-m-d H:i:s');
						$contract_attachment_id = $this->mod->insert($datato);
						
						$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
						$file_name = 'contract-attachment-file-'.md5($contract_id).'-'.md5($contract_attachment_id).'.'.$ext;
						$path = './assets/mod__contract/attach/contract-attachment-file/'.$file_name;
						$arr_type = array(
							'application/pdf',
							'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
							'application/zip',
							'application/msword',
							'application/x-zip',
							'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
							'application/vnd.ms-excel'
						);
						if(in_array($data['type'][$i], $arr_type)){
							move_uploaded_file($data['tmp_name'][$i], $path);
							unset($datato);
							$datato['database'] = 'patlog__contract';
							$datato['table'] = 'entity__contract_attachment';
							$datato['contract_attachment_file'] = $file_name;
							$datato['field'] = 'contract_attachment_id';
							$datato['id'] = $contract_attachment_id;
							$this->mod->update($datato);
						}
					}
				}
			}
			
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__contract_log';
			$datato['where'] = array(
				'patlog__contract.entity__contract_log.contract_id' => $contract_id
			);
			$Q1 = $this->view->view_data($datato);
			$contract_log_approver_level = $Q1->num_rows() + 1;
			
			unset($datato);
			$datato['database'] = 'patlog__contract';
			$datato['table'] = 'entity__contract_log';
			$datato['contract_id'] = $contract_id;
			$datato['contract_log_approver_level'] = $contract_log_approver_level;
			$datato['contract_log_employee_code'] = $contract_creator_employee_in_code;
			$datato['contract_log_employee_name'] = $contract_creator_employee_in_name;
			$datato['contract_log_employee_position_detail'] = $contract_creator_employee_in_position_detail;
			$datato['contract_log_status'] = 'Created';
			$datato['contract_log_insert'] = date('Y-m-d H:i:s');
			$this->mod->insert($datato);
			
			$this->func_generate_qr($contract_id);
			$this->print_contract($contract_id);
			
			unset($notif);
			$notif['title'] = 'Info Module Contract';
			$notif['message'] = $contract_creator_employee_in_name.' telah mengajukan kontrak, yuk cek di aplikasi Anda.';
			$notif['user_device_employee_in_id'] = array(
				$contract_approval_current_id
			);
			$notif['screen'] = array(
				'ProsesContractApproval'
			);
			$notif['detail_id'] = $contract_id;
			$this->notification($notif);
			
			$this->session->set_flashdata('success', 'Data berhasil ditambah.');
			redirect(site_url().'module_contract/employee/proses_kontrak_utama/');
		}elseif($this->uri->segment(4) == 'edit'){
			ini_set('memory_limit', '-1');
			ini_set('max_execution_time', 0);
			set_time_limit(0);
			
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$contract_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__contract';
			$datato['where'] = array(
				'patlog__contract.entity__contract.contract_id' => $contract_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__category';
				$datato['where'] = array(
					'patlog__contract.entity__category.category_id' => urldecode($this->input->post('contract_category_id'))
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$contract_category_id = $R2->category_id;
					$contract_category_to = $R2->category_to;
				}else{
					$contract_category_id = null;
					$contract_category_to = null;
				}
				
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__request';
				$datato['where'] = array(
					'patlog__contract.entity__request.request_id' => urldecode($this->input->post('contract_request_id'))
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$contract_request_id = $R2->request_id;
					$contract_request_name = $R2->request_name;
				}else{
					$contract_request_id = null;
					$contract_request_name = null;
				}
				
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__request_description';
				$datato['where'] = array(
					'patlog__contract.entity__request_description.request_description_id' => urldecode($this->input->post('contract_request_description_id'))
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$contract_request_description_id = $R2->request_description_id;
					$contract_request_description_name = $R2->request_description_name;
				}else{
					$contract_request_description_id = null;
					$contract_request_description_name = null;
				}
				
				if(urldecode($this->input->post('contract_project_code_category')) == 'External'){
					unset($datato);
					$datato['table'] = 'patlog__project.entity__project_code';
					$datato['where'] = array(
						'patlog__project.entity__project_code.project_code_id' => urldecode($this->input->post('contract_project_code_id'))
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						$contract_project_code_id = $R2->project_code_id;
						$contract_project_code_name = $R2->project_code_name;
						$contract_project_code_description = $R2->project_code_description;
					}
				}elseif(urldecode($this->input->post('contract_project_code_category')) == 'Internal'){
					unset($datato);
					$datato['table'] = 'patlog__project.entity__cost_center';
					$datato['where'] = array(
						'patlog__project.entity__cost_center.cost_center_id' => urldecode($this->input->post('contract_project_code_id'))
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						$contract_project_code_id = $R2->cost_center_id;
						$contract_project_code_name = $R2->cost_center_name;
						$contract_project_code_description = $R2->cost_center_description;
					}
				}
				
				if($this->input->post('contract_date_start') != '' and $this->input->post('contract_date_end') != ''){
					$contract_date_start = $this->input->post('contract_date_start');
					$contract_date_end = $this->input->post('contract_date_end');
					$start_date = new DateTime($contract_date_start);
					$end_date = new DateTime($contract_date_end);
					$contract_period = $start_date->diff($end_date)->days;
					$contract_period = $contract_period + 2;
				}else{
					$contract_date_start = null;
					$contract_date_end = null;
					$contract_period = null;
				}
				
				if(urldecode($this->input->post('contract_project_currency')) == 'IDR'){
					$currency = 'Rupiah';
				}elseif(urldecode($this->input->post('contract_project_currency')) == 'USD'){
					$currency = 'Dollar';
				}
				$contract_project_calculate = ucwords($this->func_calculate($this->input->post('contract_project_cost'))).' '.$currency;
				
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__third_party';
				$datato['where'] = array(
					'patlog__contract.entity__third_party.third_party_id' => urldecode($this->input->post('contract_third_party_id'))
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$contract_third_party_id = $R2->third_party_id;
					$contract_third_party_name = $R2->third_party_name;
				}else{
					$contract_third_party_id = null;
					$contract_third_party_name = null;
				}
				
				unset($datato);
				$datato['table'] = 'patlog__hrms.entity__employee_in';
				$datato['table_join'] = array(
					'patlog__hrms.entity__division'
				);
				$datato['table_join_on'] = array(
					'patlog__hrms.entity__employee_in'
				);
				$datato['join_id'] = array(
					'division_id'
				);
				$datato['join_type'] = array(
					'inner'
				);
				$datato['where'] = array(
					'patlog__hrms.entity__employee_in.employee_in_id' => $R1->contract_creator_employee_in_id
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$contract_creator_employee_in_position_detail = $R2->employee_in_position_detail;
				}else{
					$contract_creator_employee_in_position_detail = null;
				}
				
				unset($datato);
				$datato['table'] = 'patlog__config.entity__approval';
				$datato['table_join'] = array(
					'patlog__config.entity__approval_detail'
				);
				$datato['table_join_on'] = array(
					'patlog__config.entity__approval'
				);
				$datato['join_id'] = array(
					'approval_id'
				);
				$datato['join_type'] = array(
					'inner'
				);
				$datato['where'] = array(
					'patlog__config.entity__approval_detail.approval_id' => urldecode($this->input->post('contract_approval_select_id'))
				);
				$datato['order'] = array(
					'patlog__config.entity__approval_detail.approval_detail_level'
				);
				$datato['order_type'] = array(
					'asc'
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$contract_approval_current_id = $R2->approval_detail_employee_in_id;
					$contract_approval_current_name = $R2->approval_detail_employee_in_name;
					$contract_approval_current_category = $R2->approval_detail_role;
					$contract_approval_current_sign = $R2->approval_detail_sign;
					$contract_approval_select_id = $R2->approval_id;
					$contract_approval_select_name = $R2->approval_name;
				}else{
					$contract_approval_current_id = null;
					$contract_approval_current_name = null;
					$contract_approval_current_category = null;
					$contract_approval_current_sign = null;
					$contract_approval_select_id = null;
					$contract_approval_select_name = null;
				}
				
				$template_by_level = array();
				foreach($Q2->result() as $R2){
					if($R2->approval_detail_employee_in_id == null){
						if($R2->approval_detail_employee_in_name == 'User'){
							$contract_approval_employee_id = $R1->contract_creator_employee_in_id;
							$contract_approval_employee_name = $R1->contract_creator_employee_in_name;
							$contract_approval_employee_position = $R1->contract_creator_employee_in_position;
							$contract_approval_employee_position_detail = $contract_creator_employee_in_position_detail;
						}elseif($R2->approval_detail_employee_in_name == 'Drafter'){
							$contract_approval_employee_id = null;
							$contract_approval_employee_name = 'Drafter';
							$contract_approval_employee_position = 'Drafter';
							$contract_approval_employee_position_detail = 'Drafter';
						}elseif($R2->approval_detail_employee_in_name == 'Loket'){
							$contract_approval_employee_id = null;
							$contract_approval_employee_name = 'Loket';
							$contract_approval_employee_position = 'Loket';
							$contract_approval_employee_position_detail = 'Loket';
						}else{
							$contract_approval_employee_id = null;
							$contract_approval_employee_name = null;
							$contract_approval_employee_position = null;
							$contract_approval_employee_position_detail = null;
						}
					}else{
						$contract_approval_employee_id = $R2->approval_detail_employee_in_id;
						$contract_approval_employee_name = $R2->approval_detail_employee_in_name;
						$contract_approval_employee_position = $R2->approval_detail_employee_in_position;
						$contract_approval_employee_position_detail = $R2->approval_detail_employee_in_position_detail;
					}
					$lvl = (int)$R2->approval_detail_level;
					$template_by_level[$lvl] = array(
						'contract_id' => $R1->contract_id,
						'contract_approval_level' => $lvl,
						'contract_approval_employee_id' => $contract_approval_employee_id,
						'contract_approval_employee_name' => $contract_approval_employee_name,
						'contract_approval_employee_position' => $contract_approval_employee_position,
						'contract_approval_employee_position_detail' => $contract_approval_employee_position_detail,
						'contract_approval_category' => $R2->approval_detail_role,
						'contract_approval_sign' => $R2->approval_detail_sign,
						'contract_approval_status' => null,
						'contract_approval_date' => null
					);
				}
				
				$exist_by_level = array();
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__contract_approval';
				$datato['where'] = array(
					'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id
				);
				$datato['order'] = array(
					'patlog__contract.entity__contract_approval.contract_approval_level'
				);
				$datato['order_type'] = array(
					'asc'
				);
				$Q2 = $this->view->view_data($datato);
				foreach($Q2->result() as $R2){
					$exist_by_level[(int)$R2->contract_approval_level] = $R2;
				}
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__contract';
				$datato['contract_category_id'] = $contract_category_id;
				$datato['contract_category_to'] = $contract_category_to;
				$datato['contract_request_id'] = $contract_request_id;
				$datato['contract_request_name'] = $contract_request_name;
				$datato['contract_request_description_id'] = $contract_request_description_id;
				$datato['contract_request_description_name'] = $contract_request_description_name;
				$datato['contract_project_code_category'] = urldecode($this->input->post('contract_project_code_category'));
				$datato['contract_project_code_id'] = $contract_project_code_id;
				$datato['contract_project_code_name'] = $contract_project_code_name;
				$datato['contract_project_code_description'] = $contract_project_code_description;
				$datato['contract_date_start'] = $contract_date_start;
				$datato['contract_date_end'] = $contract_date_end;
				$datato['contract_period'] = $contract_period;
				$datato['contract_project_currency'] = urldecode($this->input->post('contract_project_currency'));
				$datato['contract_project_cost'] = $this->input->post('contract_project_cost');
				$datato['contract_project_calculate'] = $contract_project_calculate;
				$datato['contract_project_note'] = $this->input->post('contract_project_note');
				$datato['contract_third_party_id'] = $contract_third_party_id;
				$datato['contract_third_party_name'] = $contract_third_party_name;
				$datato['contract_company_name'] = $this->input->post('contract_company_name');
				$datato['contract_user_name'] = $this->input->post('contract_user_name');
				$datato['contract_user_position'] = $this->input->post('contract_user_position');
				$datato['contract_approval_select_id'] = $contract_approval_select_id;
				$datato['contract_approval_select_name'] = $contract_approval_select_name;
				$datato['contract_approval_current_id'] = $contract_approval_current_id;
				$datato['contract_approval_current_name'] = $contract_approval_current_name;
				$datato['contract_approval_current_category'] = $contract_approval_current_category;
				$datato['contract_approval_current_sign'] = $contract_approval_current_sign;
				$datato['contract_approver_level'] = 1;
				$datato['contract_approver_message'] = '<div class="badge badge-default">Waiting</div> &bull; '.$contract_approval_current_name;
				$datato['contract_status_delete'] = 'no';
				$datato['contract_status_done'] = 'no';
				$datato['field'] = 'contract_id';
				$datato['id'] = $R1->contract_id;
				$this->mod->update($datato);
				
				foreach($template_by_level as $lvl => $tpl){
					if(isset($exist_by_level[$lvl])){
						$ex = $exist_by_level[$lvl];	
						unset($datato);
						$datato['database'] = 'patlog__contract';
						$datato['table'] = 'entity__contract_approval';
						if($ex->contract_approval_employee_id !== $tpl['contract_approval_employee_id']){
							$datato['contract_approval_employee_id'] = $tpl['contract_approval_employee_id'];
						}
						if($ex->contract_approval_employee_name !== $tpl['contract_approval_employee_name']){
							$datato['contract_approval_employee_name'] = $tpl['contract_approval_employee_name'];
						}
						if($ex->contract_approval_employee_position !== $tpl['contract_approval_employee_position']){
							$datato['contract_approval_employee_position'] = $tpl['contract_approval_employee_position'];
						}
						if($ex->contract_approval_employee_position_detail !== $tpl['contract_approval_employee_position_detail']){
							$datato['contract_approval_employee_position_detail'] = $tpl['contract_approval_employee_position_detail'];
						}
						if($ex->contract_approval_category !== $tpl['contract_approval_category']){
							$datato['contract_approval_category'] = $tpl['contract_approval_category'];
						}
						if($ex->contract_approval_sign !== $tpl['contract_approval_sign']){
							$datato['contract_approval_sign'] = $tpl['contract_approval_sign'];
						}
						$datato['contract_approval_status'] = null;
						$datato['contract_approval_date'] = null;
						$datato['field'] = 'contract_approval_id';
						$datato['id'] = $ex->contract_approval_id;
						$this->mod->update($datato);
					}else{
						unset($datato);
						$datato['database'] = 'patlog__contract';
						$datato['table'] = 'entity__contract_approval';
						$datato['contract_id'] = $tpl['contract_id'];
						$datato['contract_approval_level'] = $tpl['contract_approval_level'];
						$datato['contract_approval_employee_id'] = $tpl['contract_approval_employee_id'];
						$datato['contract_approval_employee_name'] = $tpl['contract_approval_employee_name'];
						$datato['contract_approval_employee_position'] = $tpl['contract_approval_employee_position'];
						$datato['contract_approval_employee_position_detail'] = $tpl['contract_approval_employee_position_detail'];
						$datato['contract_approval_category'] = $tpl['contract_approval_category'];
						$datato['contract_approval_sign'] = $tpl['contract_approval_sign'];
						$datato['contract_approval_status'] = null;
						$datato['contract_approval_date'] = null;
						$datato['contract_approval_insert'] = date('Y-m-d H:i:s');
						$this->mod->insert($datato);
					}
				}
				
				foreach($exist_by_level as $lvl => $ex){
					if(!isset($template_by_level[$lvl])){
						unset($datato);
						$datato['database'] = 'patlog__contract';
						$datato['table'] = 'entity__contract_approval';
						$datato['field'] = 'contract_approval_id';
						$datato['id'] = $ex->contract_approval_id;
						$this->mod->delete($datato);
					}
				}
				
				$arr_contract_document_id = $this->input->post('contract_document_id');
				for($i=0;$i<count($arr_contract_document_id);$i++){
					unset($data);
					foreach($_FILES['contract_document_file'] as $key => $file){
						$data[$key] = $_FILES['contract_document_file'][$key];
					}
					if(isset($data['name'][$i])){
						$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
						$file_name = 'document-file-'.md5($R1->contract_id).'-'.md5($arr_contract_document_id[$i]).'.'.$ext;
						$path = './assets/mod__contract/attach/contract-document-file/'.$file_name;
						$arr_type = array(
							'application/pdf'
						);
						if(in_array($data['type'][$i], $arr_type)){
							move_uploaded_file($data['tmp_name'][$i], $path);
							unset($datato);
							$datato['database'] = 'patlog__contract';
							$datato['table'] = 'entity__contract_document';
							$datato['contract_document_file'] = $file_name;
							$datato['field'] = 'contract_document_id';
							$datato['id'] = $arr_contract_document_id[$i];
							$this->mod->update($datato);
						}
					}
				}
				
				$arr_contract_attachment_id = $this->input->post('contract_attachment_id');
				$arr_contract_attachment_name = $this->input->post('contract_attachment_name');
				$arr_contract_attachment_file = $this->input->post('contract_attachment_file');
				if(isset($_FILES['contract_attachment_file'])){
					foreach($_FILES['contract_attachment_file'] as $key => $file){
						$data[$key] = $_FILES['contract_attachment_file'][$key];
					}
				}
				if($arr_contract_attachment_name != null){
					for($i=0;$i<count($arr_contract_attachment_name);$i++){
						if($arr_contract_attachment_name[$i] != ''){
							if(isset($arr_contract_attachment_id[$i])){
								unset($datato);
								$datato['database'] = 'patlog__contract';
								$datato['table'] = 'entity__contract_attachment';
								$datato['contract_id'] = $R1->contract_id;
								$datato['contract_attachment_name'] = $arr_contract_attachment_name[$i];
								$datato['field'] = 'contract_attachment_id';
								$datato['id'] = $arr_contract_attachment_id[$i];
								$this->mod->update($datato);
								
								if(isset($data['name'][$i])){
									$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
									$file_name = 'contract-attachment-file-'.md5($R1->contract_id).'-'.md5($arr_contract_attachment_id[$i]).'.'.$ext;
									$path = './assets/mod__contract/attach/contract-attachment-file/'.$file_name;
									$arr_type = array(
										'application/pdf'
									);
									if(in_array($data['type'][$i], $arr_type)){
										move_uploaded_file($data['tmp_name'][$i], $path);
										unset($datato);
										$datato['database'] = 'patlog__contract';
										$datato['table'] = 'entity__contract_attachment';
										$datato['contract_attachment_file'] = $file_name;
										$datato['field'] = 'contract_attachment_id';
										$datato['id'] = $arr_contract_attachment_id[$i];
										$this->mod->update($datato);
									}
								}
							}else{
								unset($datato);
								$datato['database'] = 'patlog__contract';
								$datato['table'] = 'entity__contract_attachment';
								$datato['contract_id'] = $R1->contract_id;
								$datato['contract_attachment_name'] = $arr_contract_attachment_name[$i];
								$datato['contract_attachment_file'] = 'no.pdf';
								$datato['contract_attachment_insert'] = date('Y-m-d H:i:s');
								$contract_attachment_id = $this->mod->insert($datato);
								
								if(isset($data['name'][$i])){
									$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
									$file_name = 'contract-attachment-file-'.md5($R1->contract_id).'-'.md5($contract_attachment_id).'.'.$ext;
									$path = './assets/mod__contract/attach/contract-attachment-file/'.$file_name;
									$arr_type = array(
										'application/pdf',
										'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
										'application/zip',
										'application/msword',
										'application/x-zip',
										'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
										'application/vnd.ms-excel'
									);
									if(in_array($data['type'][$i], $arr_type)){
										move_uploaded_file($data['tmp_name'][$i], $path);
										unset($datato);
										$datato['database'] = 'patlog__contract';
										$datato['table'] = 'entity__contract_attachment';
										$datato['contract_attachment_file'] = $file_name;
										$datato['field'] = 'contract_attachment_id';
										$datato['id'] = $contract_attachment_id;
										$this->mod->update($datato);
									}
								}
							}
						}
					}
				}
				
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__contract_log';
				$datato['where'] = array(
					'patlog__contract.entity__contract_log.contract_id' => $R1->contract_id
				);
				$Q2 = $this->view->view_data($datato);
				$contract_log_approver_level = $Q2->num_rows() + 1;
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__contract_log';
				$datato['contract_id'] = $R1->contract_id;
				$datato['contract_log_approver_level'] = $contract_log_approver_level;
				$datato['contract_log_employee_code'] = $R1->contract_creator_employee_in_code;
				$datato['contract_log_employee_name'] = $R1->contract_creator_employee_in_name;
				$datato['contract_log_employee_position_detail'] = $contract_creator_employee_in_position_detail;
				$datato['contract_log_status'] = 'Edited';
				$datato['contract_log_insert'] = date('Y-m-d H:i:s');
				$this->mod->insert($datato);
				
				$this->func_generate_qr($R1->contract_id);
				$this->print_contract($R1->contract_id);
				
				unset($notif);
				$notif['title'] = 'Info Module Contract';
				$notif['message'] = $R1->contract_creator_employee_in_name.' telah mengajukan kontrak, yuk cek di aplikasi Anda.';
				$notif['user_device_employee_in_id'] = array(
					$contract_approval_current_id
				);
				$notif['screen'] = array(
					'ProsesContractApproval'
				);
				$notif['detail_id'] = $R1->contract_id;
				$this->notification($notif);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect(site_url().'module_contract/employee/proses_kontrak_utama/');
		}elseif($this->uri->segment(4) == 'delete'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$contract_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__contract';
			$datato['where'] = array(
				'patlog__contract.entity__contract.contract_id' => $contract_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				if($R1->contract_data_from == 'Procurement'){
					unset($datato);
					$datato['table'] = 'patlog__procurement.entity__request_legal';
					$datato['where'] = array(
						'patlog__procurement.entity__request_legal.request_id' => $R1->contract_data_id,
						'patlog__procurement.entity__request_legal.contract_id' => $R1->contract_id
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						
						unset($datato);
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__request_legal';
						$datato['contract_id'] = null;
						$datato['contract_no'] = null;
						$datato['request_legal_status'] = 'Dihapus';
						$datato['field'] = 'request_legal_id';
						$datato['id'] = $R2->request_legal_id;
						$this->mod->update($datato);
					}
					
					unset($datato);
					$datato['table'] = 'patlog__procurement.entity__request_legal';
					$datato['where'] = array(
						'patlog__procurement.entity__request_legal.request_id' => $R1->contract_data_id,
						'patlog__procurement.entity__request_legal.request_legal_status' => 'Sudah Kirim'
					);
					$Q2 = $this->view->view_data($datato);
					if(!$Q2->num_rows()){
						$R2 = $Q2->row();
						
						unset($datato);
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__request';
						$datato['request_status_legal'] = 'no';
						$datato['field'] = 'request_id';
						$datato['id'] = $R1->contract_data_id;
						$this->mod->update($datato);
					}
				}
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__contract';
				if($R1->contract_data_from == 'Procurement'){
					$datato['contract_data_id'] = null;
					$datato['contract_data_code'] = null;
					$datato['contract_data_from'] = null;
				}
				$datato['contract_status_delete'] = 'yes';
				$datato['field'] = 'contract_id';
				$datato['id'] = $R1->contract_id;
				$this->mod->update($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect(site_url().'module_contract/employee/proses_kontrak_utama/');
		}
	}
	
	public function contract_attachment()
	{
		if($this->uri->segment(4) == 'delete'){
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__contract_attachment';
			$datato['where'] = array(
				'patlog__contract.entity__contract_attachment.contract_attachment_id' => $this->input->post('contract_attachment_id')
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				if(file_exists('assets/mod__contract/attach/contract-attachment-file/'.$R1->contract_attachment_file) and $R1->contract_attachment_file != 'no.pdf'){
					unlink('assets/mod__contract/attach/contract-attachment-file/'.$R1->contract_attachment_file);
				}
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__contract_attachment';
				$datato['field'] = 'contract_attachment_id';
				$datato['id'] = $R1->contract_attachment_id;
				$this->mod->delete($datato);
			}
		}
	}
	
	public function contract_approval()
	{
		$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(4));
		$contract_id = $this->encrypt->decode($decrypt_id);
		
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__contract';
		$datato['where'] = array(
			'patlog__contract.entity__contract.contract_id' => $contract_id
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			if(!empty(urldecode($this->input->post('user_reviewer_employee_in_id')))){
				unset($datato);
				$datato['table'] = 'patlog__hrms.entity__employee_in';
				$datato['where'] = array(
					'patlog__hrms.entity__employee_in.employee_in_id' => urldecode($this->input->post('user_reviewer_employee_in_id'))
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$employee_in_id_reviewer = $R2->employee_in_id;
					$employee_in_name_reviewer = $R2->employee_in_name;
					$employee_in_position_reviewer = $R2->employee_in_position;
					$employee_in_position_detail_reviewer = $R2->employee_in_position_detail;
				}else{
					$employee_in_id_reviewer = null;
					$employee_in_name_reviewer = null;
					$employee_in_position_reviewer = null;
					$employee_in_position_detail_reviewer = null;
				}
				
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__contract_approval';
				$datato['where'] = array(
					'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
					'patlog__contract.entity__contract_approval.contract_approval_category' => 'Reviewer'
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					unset($datato);
					$datato['database'] = 'patlog__contract';
					$datato['table'] = 'entity__contract_approval';
					$datato['contract_approval_employee_id'] = $employee_in_id_reviewer;
					$datato['contract_approval_employee_name'] = $employee_in_name_reviewer;
					$datato['contract_approval_employee_position'] = $employee_in_position_reviewer;
					$datato['contract_approval_employee_position_detail'] = $employee_in_position_detail_reviewer;
					$datato['field'] = 'contract_approval_id';
					$datato['id'] = $R2->contract_approval_id;
					$this->mod->update($datato);
				}else{
					$contract_approval_level = 0;
					unset($datato);
					$datato['table'] = 'patlog__contract.entity__contract_approval';
					$datato['where'] = array(
						'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
						'patlog__contract.entity__contract_approval.contract_approval_employee_id' => $R1->contract_approval_current_id,
						'patlog__contract.entity__contract_approval.contract_approval_category' => $R1->contract_approval_current_category
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						$contract_approval_level = $R2->contract_approval_level;
					}
					
					$i = 0;
					unset($datato);
					$datato['table'] = 'patlog__contract.entity__contract_approval';
					$datato['where'] = array(
						'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
						'patlog__contract.entity__contract_approval.contract_approval_level > ' => $contract_approval_level
					);
					$datato['order'] = array(
						'patlog__contract.entity__contract_approval.contract_approval_level'
					);
					$datato['order_type'] = array(
						'asc'
					);
					$Q2 = $this->view->view_data($datato);
					foreach($Q2->result() as $R2){
						$contract_approval_level = $contract_approval_level + 1;
						if($i == 0){
							unset($datato);
							$datato['database'] = 'patlog__contract';
							$datato['table'] = 'entity__contract_approval';
							$datato['contract_id'] = $R1->contract_id;
							$datato['contract_approval_level'] = $contract_approval_level;
							$datato['contract_approval_employee_id'] = $employee_in_id_reviewer;
							$datato['contract_approval_employee_name'] = $employee_in_name_reviewer;
							$datato['contract_approval_employee_position'] = $employee_in_position_reviewer;
							$datato['contract_approval_employee_position_detail'] = $employee_in_position_detail_reviewer;
							$datato['contract_approval_category'] = 'Reviewer';
							$datato['contract_approval_sign'] = 'yes';
							$datato['contract_approval_insert'] = date('Y-m-d H:i:s');
							$this->mod->insert($datato);
							
							$contract_approval_level = $contract_approval_level + 1;
						}
						
						unset($datato);
						$datato['database'] = 'patlog__contract';
						$datato['table'] = 'entity__contract_approval';
						$datato['contract_approval_level'] = $contract_approval_level;
						$datato['field'] = 'contract_approval_id';
						$datato['id'] = $R2->contract_approval_id;
						$this->mod->update($datato);
						
						$i++;
					}
				}
			}
			
			$return = 'no';
			if(urldecode($this->input->post('contract_status_process')) == 'Approved'){
				if(!empty($this->input->post('contract_approval_current_id'))){
					unset($datato);
					$datato['table'] = 'patlog__hrms.entity__employee_in';
					$datato['where'] = array(
						'patlog__hrms.entity__employee_in.employee_in_id' => $this->input->post('contract_approval_current_id')
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						
						unset($datato);
						$datato['table'] = 'patlog__contract.entity__contract_approval';
						$datato['where'] = array(
							'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
							'patlog__contract.entity__contract_approval.contract_approval_category' => 'Loket'
						);
						$Q3 = $this->view->view_data($datato);
						if($Q3->num_rows()){
							$R3 = $Q3->row();
							
							$contract_approval_level = $R3->contract_approval_level;
							
							unset($datato);
							$datato['database'] = 'patlog__contract';
							$datato['table'] = 'entity__contract_approval';
							$datato['contract_approval_employee_id'] = $R2->employee_in_id;
							$datato['contract_approval_employee_name'] = $R2->employee_in_name;
							$datato['contract_approval_employee_position'] = $R2->employee_in_position;
							$datato['contract_approval_employee_position_detail'] = $R2->employee_in_position_detail;
							$datato['contract_approval_status'] = 'Approve';
							$datato['contract_approval_date'] = date('Y-m-d H:i:s');
							$datato['field'] = 'contract_approval_id';
							$datato['id'] = $R3->contract_approval_id;
							$this->mod->update($datato);
						}else{
							$contract_approval_level = 1;
						}
					}else{
						$contract_approval_level = 1;
					}
				}else{
					unset($datato);
					$datato['table'] = 'patlog__contract.entity__contract_approval';
					$datato['where'] = array(
						'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
						'patlog__contract.entity__contract_approval.contract_approval_employee_id' => $R1->contract_approval_current_id,
						'patlog__contract.entity__contract_approval.contract_approval_status is null' => null
					);
					$datato['order'] = array(
						'patlog__contract.entity__contract_approval.contract_approval_level'
					);
					$datato['order_type'] = array(
						'asc'
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						
						$contract_approval_level = $R2->contract_approval_level;
						
						unset($datato);
						$datato['database'] = 'patlog__contract';
						$datato['table'] = 'entity__contract_approval';
						$datato['contract_approval_status'] = 'Approve';
						$datato['contract_approval_date'] = date('Y-m-d H:i:s');
						$datato['field'] = 'contract_approval_id';
						$datato['id'] = $R2->contract_approval_id;
						$this->mod->update($datato);
					}else{
						$contract_approval_level = 1;
					}
				}
				
				if(!empty($this->input->post('contract_verstaff_employee_in_id'))){
					$total_approval_level = 1;
					unset($datato);
					$datato['table'] = 'patlog__contract.entity__contract_approval';
					$datato['where'] = array(
						'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
						'patlog__contract.entity__contract_approval.contract_approval_level >= ' => ($contract_approval_level + 1),
					);
					$Q2 = $this->view->view_data($datato);
					foreach($Q2->result() as $R2){
						unset($datato);
						$datato['database'] = 'patlog__contract';
						$datato['table'] = 'entity__contract_approval';
						$datato['contract_approval_level'] = $R2->contract_approval_level;
						$datato['field'] = 'contract_approval_id';
						$datato['id'] = $R2->contract_approval_id;
						$this->mod->update($datato);
						
						$total_approval_level = $R2->contract_approval_level;
					}
					
					unset($datato);
					$datato['table'] = 'patlog__hrms.entity__employee_in';
					$datato['where'] = array(
						'patlog__hrms.entity__employee_in.employee_in_id' => urldecode($this->input->post('contract_verstaff_employee_in_id'))
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						$contract_approval_employee_id = $R2->employee_in_id;
						$contract_approval_employee_name = $R2->employee_in_name;
						$contract_approval_employee_position = $R2->employee_in_position;
						$contract_approval_employee_position_detail = $R2->employee_in_position_detail;
					}else{
						$contract_approval_employee_id = null;
						$contract_approval_employee_name = null;
						$contract_approval_employee_position = null;
						$contract_approval_employee_position_detail = null;
					}
					
					unset($datato);
					$datato['table'] = 'patlog__contract.entity__contract_approval';
					$datato['where'] = array(
						'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
						'patlog__contract.entity__contract_approval.contract_approval_employee_name' => 'Drafter',
					);
					$Q2 = $this->view->view_data($datato);
					foreach($Q2->result() as $R2){
						unset($datato);
						$datato['database'] = 'patlog__contract';
						$datato['table'] = 'entity__contract_approval';
						$datato['contract_approval_employee_id'] = $contract_approval_employee_id;
						$datato['contract_approval_employee_name'] = $contract_approval_employee_name;
						$datato['contract_approval_employee_position'] = $contract_approval_employee_position;
						$datato['contract_approval_employee_position_detail'] = $contract_approval_employee_position_detail;
						$datato['field'] = 'contract_approval_id';
						$datato['id'] = $R2->contract_approval_id;
						$this->mod->update($datato);
					}
					
					unset($datato);
					$datato['table'] = 'patlog__contract.entity__contract_approval';
					$datato['where'] = array(
						'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id
					);
					$Q2 = $this->view->view_data($datato);
					$total_row = $Q2->num_rows();
					
					unset($datato);
					$datato['table'] = 'patlog__hrms.entity__employee_in';
					$datato['where'] = array(
						'patlog__hrms.entity__employee_in.employee_in_id' => $this->input->post('contract_approval_current_id')
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						$contract_approval_employee_id = $R2->employee_in_id;
						$contract_approval_employee_name = $R2->employee_in_name;
						$contract_approval_employee_position = $R2->employee_in_position;
						$contract_approval_employee_position_detail = $R2->employee_in_position_detail;
					}else{
						$contract_approval_employee_id = null;
						$contract_approval_employee_name = null;
						$contract_approval_employee_position = null;
						$contract_approval_employee_position_detail = null;
					}
					
					unset($datato);
					$datato['database'] = 'patlog__contract';
					$datato['table'] = 'entity__contract_approval';
					$datato['contract_id'] = $R1->contract_id;
					$datato['contract_approval_level'] = $total_row + 1;
					$datato['contract_approval_employee_id'] = $contract_approval_employee_id;
					$datato['contract_approval_employee_name'] = $contract_approval_employee_name;
					$datato['contract_approval_employee_position'] = $contract_approval_employee_position;
					$datato['contract_approval_employee_position_detail'] = $contract_approval_employee_position_detail;
					$datato['contract_approval_category'] = 'Upload';
					$datato['contract_approval_sign'] = 'no';
					$datato['contract_approval_insert'] = date('Y-m-d H:i:s');
					$this->mod->insert($datato);
				}
				
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__contract_approval';
				$datato['where'] = array(
					'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
					'patlog__contract.entity__contract_approval.contract_approval_status is null' => null
				);
				$datato['order'] = array(
					'patlog__contract.entity__contract_approval.contract_approval_level'
				);
				$datato['order_type'] = array(
					'asc'
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$contract_approval_current_id = $R2->contract_approval_employee_id;
					$contract_approval_current_name = $R2->contract_approval_employee_name;
					$contract_approval_current_category = $R2->contract_approval_category;
					$contract_approval_current_sign = $R2->contract_approval_sign;
				}else{
					$contract_approval_current_id = null;
					$contract_approval_current_name = null;
					$contract_approval_current_category = null;
					$contract_approval_current_sign = null;
				}
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__contract';
				if($R1->contract_approval_current_category == 'Loket'){
					$datato['contract_date_loket'] = date('Y-m-d');
				}
				if($R1->contract_approval_current_category == 'Upload'){
					$datato['contract_no_fix'] = $this->input->post('contract_no_fix');
				}
				if($R1->contract_approval_current_category == 'Drafter'){
					$datato['contract_status_drafter'] = 'yes';
				}
				$datato['contract_approval_current_id'] = $contract_approval_current_id;
				$datato['contract_approval_current_name'] = $contract_approval_current_name;
				$datato['contract_approval_current_category'] = $contract_approval_current_category;
				$datato['contract_approval_current_sign'] = $contract_approval_current_sign;
				$datato['contract_approver_level'] = $R1->contract_approver_level + 1;
				$datato['contract_approver_message'] = '<div class="badge badge-primary">Approve</div> &bull; '.$R1->contract_approval_current_name;
				$datato['field'] = 'contract_id';
				$datato['id'] = $R1->contract_id;
				$this->mod->update($datato);
				
				if(isset($_FILES['contract_summary_file_final'])){
					unset($data);
					foreach($_FILES['contract_summary_file_final'] as $key => $file){
						$data[$key] = $_FILES['contract_summary_file_final'][$key];
					}
					$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
					$file_name = 'document-contract-summary-final-'.md5($R1->contract_id).'.'.$ext;
					$path = './assets/mod__contract/attach/document-contract-summary-final/'.$file_name;
					$arr_type = array(
						'application/pdf'
					);
					if(in_array($data['type'], $arr_type)){
						move_uploaded_file($data['tmp_name'], $path);
						unset($datato);
						$datato['database'] = 'patlog__contract';
						$datato['table'] = 'entity__contract';
						$datato['contract_summary_file_final'] = $file_name;
						$datato['field'] = 'contract_id';
						$datato['id'] = $R1->contract_id;
						$this->mod->update($datato);
					}
				}
				
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__contract_approval';
				$datato['where'] = array(
					'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
					'patlog__contract.entity__contract_approval.contract_approval_status is null' => null
				);
				$datato['order'] = array(
					'patlog__contract.entity__contract_approval.contract_approval_level'
				);
				$datato['order_type'] = array(
					'asc'
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$contract_status_done = 'no';
				}else{
					$contract_status_done = 'yes';
				}
				
				if(!empty(urldecode($this->input->post('contract_ttd_sign_type')))){
					$contract_log_status_ttd = urldecode($this->input->post('contract_ttd_sign_type'));
				}else{
					$contract_log_status_ttd = null;
				}
			}elseif(urldecode($this->input->post('contract_status_process')) == 'Rejected'){
				if($R1->contract_status_drafter == null){
					unset($datato);
					$datato['table'] = 'patlog__contract.entity__contract_approval';
					$datato['where'] = array(
						'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
						'patlog__contract.entity__contract_approval.contract_approval_category' => 'Loket'
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						
						unset($datato);
						$datato['database'] = 'patlog__contract';
						$datato['table'] = 'entity__contract_approval';
						$datato['contract_approval_employee_id'] = null;
						$datato['contract_approval_employee_name'] = 'Loket';
						$datato['contract_approval_employee_position'] = 'Loket';
						$datato['contract_approval_employee_position_detail'] = 'Loket';
						$datato['field'] = 'contract_approval_id';
						$datato['id'] = $R2->contract_approval_id;
						$this->mod->update($datato);
					}
					
					unset($datato);
					$datato['table'] = 'patlog__contract.entity__contract_approval';
					$datato['where'] = array(
						'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
						'patlog__contract.entity__contract_approval.contract_approval_category' => 'Drafter'
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						
						unset($datato);
						$datato['database'] = 'patlog__contract';
						$datato['table'] = 'entity__contract_approval';
						$datato['contract_approval_employee_id'] = null;
						$datato['contract_approval_employee_name'] = 'Drafter';
						$datato['contract_approval_employee_position'] = 'Drafter';
						$datato['contract_approval_employee_position_detail'] = 'Drafter';
						$datato['field'] = 'contract_approval_id';
						$datato['id'] = $R2->contract_approval_id;
						$this->mod->update($datato);
					}
					
					unset($datato);
					$datato['table'] = 'patlog__contract.entity__contract_approval';
					$datato['where'] = array(
						'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
						'patlog__contract.entity__contract_approval.contract_approval_category' => 'Upload'
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						
						unset($datato);
						$datato['database'] = 'patlog__contract';
						$datato['table'] = 'entity__contract_approval';
						$datato['field'] = 'contract_approval_id';
						$datato['id'] = $R2->contract_approval_id;
						$this->mod->delete($datato);
					}
					
					unset($datato);
					$datato['database'] = 'patlog__contract';
					$datato['table'] = 'entity__contract_approval';
					$datato['contract_approval_status'] = null;
					$datato['contract_approval_date'] = null;
					$datato['field'] = 'contract_id';
					$datato['id'] = $R1->contract_id;
					$this->mod->update($datato);
					
					if($R1->contract_approval_current_category == 'Drafter'){
						unset($datato);
						$datato['database'] = 'patlog__contract';
						$datato['table'] = 'entity__contract';
						$datato['contract_date_loket'] = null;
						$datato['contract_approval_current_id'] = null;
						$datato['contract_approval_current_name'] = 'Loket';
						$datato['contract_approval_current_category'] = 'Loket';
						$datato['contract_approval_current_sign'] = 'no';
						$datato['contract_approver_level'] = 1;
						$datato['contract_approver_message'] = '<div class="badge badge-danger">Rejected</div> &bull; '.$R1->contract_approval_current_name;
						$datato['field'] = 'contract_id';
						$datato['id'] = $R1->contract_id;
						$this->mod->update($datato);
					}else{
						unset($datato);
						$datato['database'] = 'patlog__contract';
						$datato['table'] = 'entity__contract';
						$datato['contract_date_loket'] = null;
						$datato['contract_approval_current_id'] = null;
						$datato['contract_approval_current_name'] = null;
						$datato['contract_approval_current_category'] = null;
						$datato['contract_approval_current_sign'] = null;
						$datato['contract_approver_level'] = 0;
						$datato['contract_approver_message'] = '<div class="badge badge-danger">Rejected</div> &bull; '.$R1->contract_approval_current_name;
						$datato['field'] = 'contract_id';
						$datato['id'] = $R1->contract_id;
						$this->mod->update($datato);
						
						$return = 'yes';
					}
				}elseif($R1->contract_status_drafter == 'yes'){
					unset($datato);
					$datato['table'] = 'patlog__contract.entity__contract_approval';
					$datato['where'] = array(
						'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
						'patlog__contract.entity__contract_approval.contract_approval_category' => 'Drafter'
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						
						$contract_approval_current_id = $R2->contract_approval_employee_id;
						$contract_approval_current_name = $R2->contract_approval_employee_name;
						$contract_approval_current_category = $R2->contract_approval_category;
						$contract_approval_current_sign = $R2->contract_approval_sign;
						$contract_approver_level = $R1->contract_approver_level + 1;
						
						unset($datato);
						$datato['table'] = 'patlog__contract.entity__contract_approval';
						$datato['where'] = array(
							'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
							'patlog__contract.entity__contract_approval.contract_approval_level >= ' => $R2->contract_approval_level
						);
						$Q3 = $this->view->view_data($datato);
						foreach($Q3->result() as $R3){
							unset($datato);
							$datato['database'] = 'patlog__contract';
							$datato['table'] = 'entity__contract_approval';
							$datato['contract_approval_status'] = null;
							$datato['contract_approval_date'] = null;
							$datato['field'] = 'contract_approval_id';
							$datato['id'] = $R3->contract_approval_id;
							$this->mod->update($datato);
						}
					}else{
						$contract_approval_current_id = null;
						$contract_approval_current_name = null;
						$contract_approval_current_category = null;
						$contract_approval_current_sign = null;
						$contract_approver_level = 0;
					}
					
					unset($datato);
					$datato['database'] = 'patlog__contract';
					$datato['table'] = 'entity__contract';
					$datato['contract_approval_current_id'] = $contract_approval_current_id;
					$datato['contract_approval_current_name'] = $contract_approval_current_name;
					$datato['contract_approval_current_category'] = $contract_approval_current_category;
					$datato['contract_approval_current_sign'] = $contract_approval_current_sign;
					$datato['contract_approver_level'] = $contract_approver_level;
					$datato['contract_approver_message'] = '<div class="badge badge-danger">Rejected</div> &bull; '.$R1->contract_approval_current_name;
					$datato['contract_status_drafter'] = null;
					$datato['field'] = 'contract_id';
					$datato['id'] = $R1->contract_id;
					$this->mod->update($datato);
				}
				
				if($R1->contract_document_temporary != null){
					if(file_exists('assets/mod__contract/attach/document-contract-temporary/'.$R1->contract_document_temporary) and $R1->contract_document_temporary != 'no.pdf'){
						unlink('assets/mod__contract/attach/document-contract-temporary/'.$R1->contract_document_temporary);
					}
				}
				
				if($R1->contract_summary_file_ttd != null){
					if(file_exists('assets/mod__contract/attach/document-contract-summary-ttd/'.$R1->contract_summary_file_ttd) and $R1->contract_summary_file_ttd != 'no.pdf'){
						unlink('assets/mod__contract/attach/document-contract-summary-ttd/'.$R1->contract_summary_file_ttd);
					}
				}
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__contract';
				$datato['contract_document_temporary'] = 'no.pdf';
				$datato['contract_summary_file_ttd'] = 'no.pdf';
				$datato['contract_ttd_sign_type'] = null;
				$datato['contract_ttd_sign_speciment'] = null;
				$datato['contract_ttd_sign_token'] = null;
				$datato['contract_ttd_sign_url'] = null;
				$datato['contract_ttd_sign_link'] = null;
				$datato['contract_ttd_sign_download'] = null;
				$datato['contract_ttd_sign_date_sign'] = null;
				$datato['contract_ttd_sign_date_expired'] = null;
				$datato['contract_ttd_sign_status'] = null;
				$datato['contract_ttd_sign_callback'] = null;
				$datato['contract_ttd_sign_webhook'] = null;
				$datato['contract_ttd_sign_webhook_type'] = null;
				$datato['field'] = 'contract_id';
				$datato['id'] = $R1->contract_id;
				$this->mod->update($datato);
				
				$contract_status_done = 'no';
				$contract_log_status_ttd = null;
			}elseif(urldecode($this->input->post('contract_status_process')) == 'Processing'){
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__contract';
				$datato['contract_approver_message'] = '<div class="badge badge-warning">Processing</div> &bull; '.$R1->contract_approval_current_name;
				$datato['field'] = 'contract_id';
				$datato['id'] = $R1->contract_id;
				$this->mod->update($datato);
				
				$contract_status_done = 'no';
				$contract_log_status_ttd = null;
			}elseif(urldecode($this->input->post('contract_status_process')) == 'Done'){
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__contract_approval';
				$datato['where'] = array(
					'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
					'patlog__contract.entity__contract_approval.contract_approval_employee_id' => $R1->contract_approval_current_id,
					'patlog__contract.entity__contract_approval.contract_approval_status is null' => null
				);
				$datato['order'] = array(
					'patlog__contract.entity__contract_approval.contract_approval_level'
				);
				$datato['order_type'] = array(
					'asc'
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					
					unset($datato);
					$datato['database'] = 'patlog__contract';
					$datato['table'] = 'entity__contract_approval';
					$datato['contract_approval_status'] = 'Approve';
					$datato['contract_approval_date'] = date('Y-m-d H:i:s');
					$datato['field'] = 'contract_approval_id';
					$datato['id'] = $R2->contract_approval_id;
					$this->mod->update($datato);
				}
				
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__contract_approval';
				$datato['where'] = array(
					'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
					'patlog__contract.entity__contract_approval.contract_approval_status is null' => null
				);
				$datato['order'] = array(
					'patlog__contract.entity__contract_approval.contract_approval_level'
				);
				$datato['order_type'] = array(
					'asc'
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$contract_approval_current_id = $R2->contract_approval_employee_id;
					$contract_approval_current_name = $R2->contract_approval_employee_name;
					$contract_approval_current_category = $R2->contract_approval_category;
					$contract_approval_current_sign = $R2->contract_approval_sign;
				}else{
					$contract_approval_current_id = null;
					$contract_approval_current_name = null;
					$contract_approval_current_category = null;
					$contract_approval_current_sign = null;
				}
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__contract';
				$datato['contract_active_start_date'] = $this->input->post('contract_active_start_date');
				$datato['contract_active_end_date'] = $this->input->post('contract_active_end_date');
				$datato['contract_ttd_place'] = $this->input->post('contract_ttd_place');
				$datato['contract_ttd_date'] = $this->input->post('contract_ttd_date');
				$datato['contract_approval_current_id'] = $contract_approval_current_id;
				$datato['contract_approval_current_name'] = $contract_approval_current_name;
				$datato['contract_approval_current_category'] = $contract_approval_current_category;
				$datato['contract_approval_current_sign'] = $contract_approval_current_sign;
				$datato['contract_approver_level'] = $R1->contract_approver_level + 1;
				$datato['contract_approver_message'] = '<div class="badge badge-primary">Approve</div> &bull; '.$R1->contract_approval_current_name;
				$datato['contract_status_drafter'] = 'yes';
				$datato['field'] = 'contract_id';
				$datato['id'] = $R1->contract_id;
				$this->mod->update($datato);
				
				$contract_status_done = 'no';
				$contract_log_status_ttd = urldecode($this->input->post('contract_ttd_sign_type'));
			}elseif(urldecode($this->input->post('contract_status_process')) == 'Back'){
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__contract_approval';
				$datato['where'] = array(
					'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
					'patlog__contract.entity__contract_approval.contract_approval_employee_id' => $R1->contract_approval_current_id,
					'patlog__contract.entity__contract_approval.contract_approval_category' => $R1->contract_approval_current_category
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					
					unset($datato);
					$datato['table'] = 'patlog__contract.entity__contract_approval';
					$datato['where'] = array(
						'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
						'patlog__contract.entity__contract_approval.contract_approval_level' => ($R2->contract_approval_level - 1)
					);
					$Q3 = $this->view->view_data($datato);
					if($Q3->num_rows()){
						$R3 = $Q3->row();
						
						unset($datato);
						$datato['database'] = 'patlog__contract';
						$datato['table'] = 'entity__contract_approval';
						$datato['contract_approval_status'] = null;
						$datato['contract_approval_date'] = null;
						$datato['field'] = 'contract_approval_id';
						$datato['id'] = $R3->contract_approval_id;
						$this->mod->update($datato);
					}
				}
				
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__contract_approval';
				$datato['where'] = array(
					'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
					'patlog__contract.entity__contract_approval.contract_approval_status is null' => null
				);
				$datato['order'] = array(
					'patlog__contract.entity__contract_approval.contract_approval_level'
				);
				$datato['order_type'] = array(
					'asc'
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$contract_approval_current_id = $R2->contract_approval_employee_id;
					$contract_approval_current_name = $R2->contract_approval_employee_name;
					$contract_approval_current_category = $R2->contract_approval_category;
					$contract_approval_current_sign = $R2->contract_approval_sign;
				}else{
					$contract_approval_current_id = null;
					$contract_approval_current_name = null;
					$contract_approval_current_category = null;
					$contract_approval_current_sign = null;
				}
				
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__contract_log';
				$datato['where'] = array(
					'patlog__contract.entity__contract_log.contract_id' => $R1->contract_id,
					'patlog__contract.entity__contract_log.contract_log_status != ' => 'Back'
				);
				$datato['order'] = array(
					'patlog__contract.entity__contract_log.contract_log_approver_level'
				);
				$datato['order_type'] = array(
					'desc'
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$contract_ttd_sign_type = $R2->contract_log_status_ttd;
				}else{
					$contract_ttd_sign_type = null;
				}
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__contract';
				$datato['contract_ttd_sign_type'] = $contract_ttd_sign_type;
				$datato['contract_approval_current_id'] = $contract_approval_current_id;
				$datato['contract_approval_current_name'] = $contract_approval_current_name;
				$datato['contract_approval_current_category'] = $contract_approval_current_category;
				$datato['contract_approval_current_sign'] = $contract_approval_current_sign;
				$datato['contract_approver_level'] = $R1->contract_approver_level - 1;
				$datato['contract_approver_message'] = '<div class="badge badge-warning">Back</div> &bull; '.$R1->contract_approval_current_name;
				if($contract_approval_current_category == 'Drafter'){
					$datato['contract_status_drafter'] = null;
				}
				$datato['field'] = 'contract_id';
				$datato['id'] = $R1->contract_id;
				$this->mod->update($datato);
				
				$contract_status_done = 'no';
				$contract_log_status_ttd = null;
			}
			
			unset($datato);
			$datato['database'] = 'patlog__contract';
			$datato['table'] = 'entity__contract';
			$datato['contract_ttd_sign_trigger'] = null;
			$datato['field'] = 'contract_id';
			$datato['id'] = $R1->contract_id;
			$this->mod->update($datato);
		
			if($R1->contract_approval_current_category == 'Loket'){
				$contract_approval_current_id_log = $this->input->post('contract_approval_current_id');
			}else{
				$contract_approval_current_id_log = $R1->contract_approval_current_id;
			}
		
			$contract_approval_current_name = $R1->contract_approval_current_name;
			unset($datato);
			$datato['table'] = 'patlog__hrms.entity__employee_in';
			$datato['where'] = array(
				'patlog__hrms.entity__employee_in.employee_in_id' => $contract_approval_current_id_log
			);
			$Q2 = $this->view->view_data($datato);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$employee_in_code = $R2->employee_in_code;
				$employee_in_position_detail = $R2->employee_in_position_detail;
				if($R1->contract_approval_current_category == 'Loket'){
					$contract_approval_current_name = $R2->employee_in_name;
				}
			}else{
				$employee_in_code = null;
				$employee_in_position_detail = null;
				$employee_in_position_detail = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__contract_log';
			$datato['where'] = array(
				'patlog__contract.entity__contract_log.contract_id' => $R1->contract_id
			);
			$Q2 = $this->view->view_data($datato);
			$contract_log_approver_level = $Q2->num_rows() + 1;
			
			unset($datato);
			$datato['database'] = 'patlog__contract';
			$datato['table'] = 'entity__contract_log';
			$datato['contract_id'] = $R1->contract_id;
			$datato['contract_log_approver_level'] = $contract_log_approver_level;
			$datato['contract_log_employee_code'] = $employee_in_code;
			$datato['contract_log_employee_name'] = $contract_approval_current_name;
			$datato['contract_log_employee_position_detail'] = $employee_in_position_detail;
			$datato['contract_log_status_ttd'] = $contract_log_status_ttd;
			$datato['contract_log_status'] = urldecode($this->input->post('contract_status_process'));
			$datato['contract_log_message'] = $this->input->post('contract_log_message');
			$datato['contract_log_insert'] = date('Y-m-d H:i:s');
			$contract_log_id = $this->mod->insert($datato);
			
			if($R1->contract_approval_current_category == 'Drafter'){
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__process';
				$datato['where'] = array(
					'patlog__contract.entity__process.process_id' => urldecode($this->input->post('contract_process_id'))
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$contract_process_id = $R2->process_id;
					$contract_process_name = $R2->process_name;
					$contract_process_flow = $R2->process_flow;
				}else{
					$contract_process_id = null;
					$contract_process_name = null;
					$contract_process_flow = null;
				}
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__contract_log';
				$datato['contract_process_id'] = $contract_process_id;
				$datato['contract_process_name'] = $contract_process_name;
				$datato['field'] = 'contract_log_id';
				$datato['id'] = $contract_log_id;
				$this->mod->update($datato);
				
				unset($datato);
				$datato['table'] = 'patlog__hrms.entity__employee_in';
				$datato['where'] = array(
					'patlog__hrms.entity__employee_in.employee_in_id' => $R1->contract_approval_current_id
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$contract_draft_employee_code = $R2->employee_in_code;
					$contract_draft_employee_name = $R2->employee_in_name;
				}else{
					$contract_draft_employee_code = null;
					$contract_draft_employee_name = null;
				}
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__contract_draft';
				$datato['contract_id'] = $R1->contract_id;
				$datato['contract_log_id'] = $contract_log_id;
				$datato['contract_process_id'] = $contract_process_id;
				$datato['contract_process_name'] = $contract_process_name;
				$datato['contract_draft_file_name'] = 'no.pdf';
				$datato['contract_draft_date'] = date('Y-m-d');
				$datato['contract_draft_employee_code'] = $contract_draft_employee_code;
				$datato['contract_draft_employee_name'] = $contract_draft_employee_name;
				$contract_draft_id = $this->mod->insert($datato);
				
				if(isset($_FILES['contract_draft_file_name'])){
					unset($data);
					foreach($_FILES['contract_draft_file_name'] as $key => $file){
						$data[$key] = $_FILES['contract_draft_file_name'][$key];
					}
					$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
					$file_name = 'document-contract-'.$contract_process_flow.'-'.md5($R1->contract_id).'-'.md5($contract_draft_id).'.'.$ext;
					$path = './assets/mod__contract/attach/document-contract/'.$file_name;
					$arr_type = array(
						'application/pdf'
					);
					if(in_array($data['type'], $arr_type)){
						move_uploaded_file($data['tmp_name'], $path);
						unset($datato);
						$datato['database'] = 'patlog__contract';
						$datato['table'] = 'entity__contract_draft';
						$datato['contract_draft_file_name'] = $file_name;
						$datato['field'] = 'contract_draft_id';
						$datato['id'] = $contract_draft_id;
						$this->mod->update($datato);
					}
				}
			}
			
			$this->func_generate_qr($R1->contract_id);
			$this->print_contract($R1->contract_id);
			
			if($R1->contract_approval_current_sign == 'yes' and urldecode($this->input->post('contract_status_process')) == 'Approved'){
				if($R1->contract_ttd_sign_token != null and $R1->contract_ttd_sign_type == 'Digital Sertifikasi'){
					$this->api_privy_document_status($R1->contract_id);
				}
			}
			
			if(!empty($this->input->post('contract_verstaff_employee_in_id')) and urldecode($this->input->post('contract_status_process')) == 'Approved'){
				$this->send_email_drafter($R1->contract_id, $this->input->post('contract_verstaff_employee_in_id'), $this->input->post('contract_log_message'));
			}
			
			if(urldecode($this->input->post('contract_status_process')) == 'Approved' and $contract_approval_current_id != null){
				$this->send_email_approve($R1->contract_id, $contract_approval_current_id, $contract_approval_current_name, $this->input->post('contract_log_message'));
			}
			
			if(urldecode($this->input->post('contract_status_process')) == 'Rejected'){
				if($R1->contract_data_id != null and $R1->contract_approval_current_category == 'Loket'){
					unset($datato);
					$datato['table'] = 'patlog__procurement.entity__request';
					$datato['where'] = array(
						'patlog__procurement.entity__request.request_id' => $R1->contract_data_id
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						$this->send_email_reject($R1->contract_id, $R2->request_proc_employee_in_id, $contract_approval_current_name, $this->input->post('contract_log_message'));
					}
				}else{
					$this->send_email_reject($R1->contract_id, $R1->contract_creator_employee_in_id, $contract_approval_current_name, $this->input->post('contract_log_message'));
				}
			}
			
			if($contract_status_done == 'yes' and urldecode($this->input->post('contract_status_process')) == 'Approved'){
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__contract';
				$datato['contract_date_close'] = date('Y-m-d');
				$datato['contract_status_done'] = 'yes';
				$datato['field'] = 'contract_id';
				$datato['id'] = $R1->contract_id;
				$this->mod->update($datato);
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request_legal';
				$datato['request_legal_status'] = 'Selesai';
				$datato['field'] = 'contract_id';
				$datato['id'] = $R1->contract_id;
				$this->mod->update($datato);
				
				$this->send_email_done($R1->contract_id, $this->input->post('contract_log_message'));
			}
			
			if($return == 'yes'){
				if($R1->contract_data_id != null){
					unset($datato);
					$datato['table'] = 'patlog__procurement.entity__request_log';
					$datato['where'] = array(
						'patlog__procurement.entity__request_log.request_id' => $R1->contract_data_id
					);
					$Q2 = $this->view->view_data($datato);
					$request_log_level = $Q2->num_rows() + 1;
					
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__request_log';
					$datato['request_id'] = $R1->contract_data_id;
					$datato['request_log_level'] = $request_log_level;
					$datato['request_log_name'] = $contract_approval_current_name;
					$datato['request_log_status'] = 'Ditolak';
					$datato['request_log_message'] = $this->input->post('contract_log_message');
					$datato['request_log_created_date'] = date('Y-m-d H:i:s');				
					$this->mod->insert($datato);
					
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__request_legal';
					$datato['request_legal_status'] = 'Ditolak';
					$datato['field'] = 'contract_id';
					$datato['id'] = $R1->contract_id;
					$this->mod->update($datato);
				}
			}
			
			$screen_detail = 'ProsesContractView';
			$screen_approve = 'ProsesContractApproval';
			$screen_archive = 'ArsipContractView';
			
			unset($notif);
			$notif['title'] = 'Info Module Contract';
			$notif['message'] = 'Kontrak '.$R1->contract_creator_employee_in_name.' telah '.$this->input->post('contract_status_process').' oleh '.$R1->contract_approval_current_name.', yuk cek di aplikasi Anda.';
			if((urldecode($this->input->post('contract_status_process')) == 'Approved' or urldecode($this->input->post('contract_status_process')) == 'Done') and $contract_status_done == 'no'){
				$notif['user_device_employee_in_id'] = array(
					$R1->contract_creator_employee_in_id,
					$contract_approval_current_id
				);
				$notif['screen'] = array(
					$screen_detail,
					$screen_approve
				);
			}elseif(urldecode($this->input->post('contract_status_process')) == 'Approved' and $contract_status_done == 'yes'){
				$notif['user_device_employee_in_id'] = array(
					$R1->contract_creator_employee_in_id
				);
				$notif['screen'] = array(
					$screen_archive
				);
			}elseif(urldecode($this->input->post('contract_status_process')) == 'Back'){
				$notif['user_device_employee_in_id'] = array(
					$R1->contract_creator_employee_in_id,
					$contract_approval_current_id
				);
				$notif['screen'] = array(
					$screen_detail,
					$screen_approve
				);
			}elseif(urldecode($this->input->post('contract_status_process')) == 'Rejected'){
				$notif['user_device_employee_in_id'] = array(
					$R1->contract_creator_employee_in_id
				);
				$notif['screen'] = array(
					$screen_detail
				);
			}
			$notif['detail_id'] = $R1->contract_id;
			$this->notification($notif);
		}
		
		$this->session->set_flashdata('success', 'Data berhasil diubah.');
		redirect(site_url().'module_contract/employee/proses_kontrak_utama/');
	}
	
	public function contract_sign()
	{
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__contract';
		$datato['where'] = array(
			'patlog__contract.entity__contract.contract_id' => $this->uri->segment(4)
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			$contract_document_temporary = 'contract-temporary-'.md5($R1->contract_id).'.pdf';
			$attachment_file = 'assets/mod__contract/attach/document-contract-summary/'.$R1->contract_summary_file_name;
			$attachment_ttd = 'assets/mod__contract/attach/document-contract-summary-ttd/'.$R1->contract_summary_file_ttd;
			$attachment_temp = 'assets/mod__contract/attach/document-contract-temporary/'.$contract_document_temporary;
			if(file_exists($attachment_ttd) and $R1->contract_summary_file_ttd != 'no.pdf'){
				if(filesize($attachment_ttd) > 0){
					copy($attachment_ttd, $attachment_temp);
				}else{
					if(file_exists($attachment_temp)){
						copy($attachment_temp, $attachment_ttd);
					}else{
						copy($attachment_file, $attachment_ttd);
					}
				}
			}
			
			unset($datato);
			$datato['database'] = 'patlog__contract';
			$datato['table'] = 'entity__contract';
			$datato['contract_document_temporary'] = $contract_document_temporary;
			$datato['contract_ttd_sign_type'] = 'Digital';
			$datato['contract_ttd_sign_speciment'] = $this->uri->segment(5);
			$datato['field'] = 'contract_id';
			$datato['id'] = $R1->contract_id;
			$this->mod->update($datato);
			
			$encrypt_id = $this->encrypt->encode($R1->contract_id);
            $contract_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
			
			$link = site_url('module_contract/employee/ttd_digital/'.$contract_id);
			redirect($link, 'refresh');
		}
	}
	
	public function contract_signed()
	{
		$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(4));
		$contract_id = $this->encrypt->decode($decrypt_id);
		
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__contract';
		$datato['where'] = array(
			'patlog__contract.entity__contract.contract_id' => $contract_id
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			unset($datato);
			$datato['table'] = 'patlog__hrms.entity__employee_in';
			$datato['where'] = array(
				'patlog__hrms.entity__employee_in.employee_in_id' => $R1->contract_approval_current_id
			);
			$Q2 = $this->view->view_data($datato);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				
				if($R1->contract_ttd_sign_speciment == 'TTD'){
					$image_sign = 'upload-sign/'.$R2->employee_in_upload_sign;
				}elseif($R1->contract_ttd_sign_speciment == 'Paraf'){
					$image_sign = 'upload-initial/'.$R2->employee_in_upload_initial;
				}elseif($R1->contract_ttd_sign_speciment == 'System'){
					$image_sign = 'image-sign/'.$R2->employee_in_image_sign;
				}else{
					$image_sign = 'image-sign/no.jpg';
				}
			}else{
				$image_sign = 'image-sign/no.jpg';
			}
			
			$page = round($this->input->post('page'));
			$img_ratio = $this->input->post('img_ratio');
			if($this->input->post('posx') == 0){
				$x = 0;
			}else{
				$x = round($this->input->post('posx') / $this->input->post('scalex'));
			}
			
			if($this->input->post('posy') == 0){
				$y = 0;
			}else{
				$y = round($this->input->post('posy') / $this->input->post('scaley'));
			}
			
			require(APPPATH.'/third_party/fpdf/fpdf.php');
			require(APPPATH.'/third_party/setasign/fpdi/autoload.php');

			$pdf = new setasign\Fpdi\Fpdi();
			
			if($R1->contract_approval_current_category == 'Drafter'){
				$from_path = 'assets/mod__contract/attach/document-contract-summary/'.$R1->contract_summary_file_name;
			}else{
				if($R1->contract_summary_file_ttd == 'no.pdf'){
					$from_path = 'assets/mod__contract/attach/document-contract-summary/'.$R1->contract_summary_file_name;
				}else{
					$from_path = 'assets/mod__contract/attach/document-contract-summary-ttd/'.$R1->contract_summary_file_ttd;
				}
			}
			$filecontent = file_get_contents($from_path);
			if(preg_match('/^%PDF-1.4/', $filecontent)) {
				
			}else{
				$platform = php_uname();
				if(strpos($platform, 'Windows') !== false){
					$ghostscript = 'gswin64c';
				}else{
					$ghostscript = 'gs';
				}
				$to_path = 'assets/mod__contract/attach/temporary/contract-sign-'.md5($R1->contract_id).'.pdf';
				shell_exec($ghostscript.' -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dNOPAUSE -dQUIET -dBATCH -sOutputFile='.$to_path.' '.$from_path);
				rename($to_path, $from_path);
			}
			$to_path = $from_path;
			
			$pageCount = $pdf->setSourceFile($to_path);
			for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
				$tplIdx = $pdf->importPage($pageNo);
				$size = $pdf->getTemplateSize($tplIdx);
				$pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
				$pdf->useTemplate($tplIdx, null, null, $size['width'], $size['height'], false);
				$pdf->SetFont('Helvetica');
				$pdf->SetTextColor(200, 0, 0);
				if ($page == $pageNo) {
					$pdf->SetXY($x, $y);
					$pdf->Image('assets/mod__hrms/attach/'.$image_sign,$x,$y,(34/$img_ratio),0,'');
				}
			}
			
			unset($datato);
			$datato['database'] = 'patlog__contract';
			$datato['table'] = 'entity__contract';
			$datato['contract_summary_file_ttd'] = 'document-contract-summary-ttd-'.md5($R1->contract_id).'.pdf';
			$datato['field'] = 'contract_id';
			$datato['id'] = $R1->contract_id;
			$this->mod->update($datato);
			
			if(strpos($_SERVER['REQUEST_URI'], 'erp') !== false){
				$host = '/erp/';
			}else{
				$host = '/';
			}
			$pdf->Output($_SERVER['DOCUMENT_ROOT'].$host.'assets/mod__contract/attach/document-contract-summary-ttd/document-contract-summary-ttd-'.md5($R1->contract_id).'.pdf', 'F');
			// $pdf->Output('signed.pdf', 'I');
		}
		
		redirect(site_url('module_contract/employee/ttd_digital/'.$this->uri->segment(4).'/signed'));
	}
	
	public function contract_sign_certification()
	{
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__contract';
		$datato['where'] = array(
			'patlog__contract.entity__contract.contract_id' => $this->uri->segment(4)
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			$contract_document_temporary = 'contract-temporary-'.md5($R1->contract_id).'.pdf';
			$attachment_file = 'assets/mod__contract/attach/document-contract-summary/'.$R1->contract_summary_file_name;
			$attachment_ttd = 'assets/mod__contract/attach/document-contract-summary-ttd/'.$R1->contract_summary_file_ttd;
			$attachment_temp = 'assets/mod__contract/attach/document-contract-temporary/'.$contract_document_temporary;
			if(file_exists($attachment_ttd) and $R1->contract_summary_file_ttd != 'no.pdf'){
				if(filesize($attachment_ttd) > 0){
					copy($attachment_ttd, $attachment_temp);
				}else{
					if(file_exists($attachment_temp)){
						copy($attachment_temp, $attachment_ttd);
					}else{
						copy($attachment_file, $attachment_ttd);
					}
				}
			}
			
			unset($datato);
			$datato['database'] = 'patlog__contract';
			$datato['table'] = 'entity__contract';
			$datato['contract_document_temporary'] = $contract_document_temporary;
			$datato['contract_ttd_sign_type'] = 'Digital Sertifikasi';
			$datato['contract_ttd_sign_speciment'] = $this->uri->segment(5);
			$datato['contract_ttd_sign_trigger'] = 'yes';
			$datato['field'] = 'contract_id';
			$datato['id'] = $R1->contract_id;
			$this->mod->update($datato);
			
			if($R1->contract_ttd_sign_status == 'In Progress' and $R1->contract_ttd_sign_link != null){
				redirect($R1->contract_ttd_sign_link, 'refresh');
			}else{
				$link = $this->api_privy_document_upload($R1->contract_id);
				redirect($link, 'refresh');
			}
		}
	}
	
	public function report()
	{
		if($this->uri->segment(4) == 'export'){
			ini_set('memory_limit', '-1');
			ini_set('max_execution_time', 0);
			set_time_limit(0);
			
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
			$datato['table_join'] = array(
				'patlog__hrms.entity__division'
			);
			$datato['table_join_on'] = array(
				'patlog__hrms.entity__employee_in'
			);
			$datato['join_id'] = array(
				'division_id'
			);
			$datato['join_type'] = array(
				'inner'
			);
			$datato['where'] = array(
				'patlog__hrms.entity__employee_in.employee_in_id' => base64_decode($this->session->userdata('employee_id'))
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$employee_in_id = $R1->employee_in_id;
				$division_id = $R1->division_id;
				$division_type = $R1->division_type;
			}else{
				$employee_in_id = null;
				$division_id = null;
				$division_type = null;
			}
			
			// $result = file_get_contents('https://raw.githubusercontent.com/guangrei/APIHariLibur_V2/main/holidays.json');
			// $arr_date = array();
			// $arr_date_holiday = json_decode($result, true);
			// $key = array_keys($arr_date_holiday);
			// for($i=0;$i<count($key);$i++){
				// $arr_date[] = $key[$i];
			// }
			// $start = strtotime($arr_date[0]);
			// $end = strtotime($arr_date[count($arr_date)-2]);
			// while(date('Y-m-d', $start) != date('Y-m-d', $end)){
				// $day_index = date('w', $start);
				// if($day_index == 0 or $day_index == 6){
					// $arr_date[] = date('Y-m-d', $start);
				// }
				// $start = strtotime(date('Y-m-d', $start).'+1 day');
			// }		
			// $arr_date = array_unique($arr_date);
			// $arr_date = array_values($arr_date);
			
			$excel = new PHPExcel();
			$excel->setActiveSheetIndex(0);
			
			$table_columns = array(
				'Kode SPPK',
				'Ditujukan Kepada',
				'Jenis Perminataan',
				'Deskripsi Permintaan',
				'Jenis Kode',
				'Kode',
				'Nama Proyek',
				'Tanggal Mulai',
				'Tanggal Selesai',
				'Periode (hari)',
				'Mata Uang',
				'Nilai Pekerja',
				'Catatan',
				'Divisi',
				'Pemohon',
				'Kebutuhan Untuk',
				'Nama Perusahaan',
				'Penandatangan',
				'Jabatan',
				'Nomor Kontrak',
				'Tanggal Berlakunya Kontrak',
				'Tanggal Berakhirnya Kontrak',
				'Tempat/Hari',
				'Tanggal (TTD)',
				'Status',
				'Proses',
				'Tanggal Dibuat',
				'Tanggal Loket',
				'Tanggal Drafter Upload',
				'Tanggal Selesai',
				'Lama Pengerjaan (Hari)',
				'Lama Pengerjaan (Jam)'
			);
			if(urldecode($this->input->post('export_detail')) == 'Log'){
				$table_columns[] = 'Nama Aktor';
				$table_columns[] = 'Jabatan';
				$table_columns[] = 'Status';
				$table_columns[] = 'Keterangan';
				$table_columns[] = 'Waktu';
				$table_columns[] = 'SLA (Jam)';
				$table_columns[] = 'SLA (Menit)';
			}
			$column = 0;
			foreach($table_columns as $field){
				$excel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
				$column++;
			}
			
			$excel_row = 2;
			
			if(urldecode($this->input->post('export_detail')) == 'Transaction'){
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__contract';
				if(urldecode($this->input->post('export_type')) == 'Process'){
					if($division_id == $cog_division_id){
						$datato['where'] = array(
							'patlog__contract.entity__contract.contract_date >= ' => $this->input->post('export_date_start'),
							'patlog__contract.entity__contract.contract_date <= ' => $this->input->post('export_date_end'),
							'patlog__contract.entity__contract.contract_creator_employee_in_id is not null' => null,
							'patlog__contract.entity__contract.contract_status_done' => 'no',
							'patlog__contract.entity__contract.contract_status_delete' => 'no'
						);
					}else{
						if($division_type == 'Other'){
							$datato['where'] = array(
								'patlog__contract.entity__contract.contract_date >= ' => $this->input->post('export_date_start'),
								'patlog__contract.entity__contract.contract_date <= ' => $this->input->post('export_date_end'),
								'patlog__contract.entity__contract.contract_creator_employee_in_id is not null' => null,
								'patlog__contract.entity__contract.contract_status_done' => 'no',
								'patlog__contract.entity__contract.contract_status_delete' => 'no'
							);
						}else{
							$datato['where'] = array(
								'patlog__contract.entity__contract.contract_date >= ' => $this->input->post('export_date_start'),
								'patlog__contract.entity__contract.contract_date <= ' => $this->input->post('export_date_end'),
								'patlog__contract.entity__contract.contract_creator_division_id' => $division_id,
								'patlog__contract.entity__contract.contract_creator_employee_in_id is not null' => null,
								'patlog__contract.entity__contract.contract_status_done' => 'no',
								'patlog__contract.entity__contract.contract_status_delete' => 'no'
							);
						}
					}
				}elseif(urldecode($this->input->post('export_type')) == 'Archive'){
					if($division_id == $cog_division_id){
						$datato['where'] = array(
							'patlog__contract.entity__contract.contract_date >= ' => $this->input->post('export_date_start'),
							'patlog__contract.entity__contract.contract_date <= ' => $this->input->post('export_date_end'),
							'patlog__contract.entity__contract.contract_creator_employee_in_id is not null' => null,
							'patlog__contract.entity__contract.contract_status_done' => 'yes',
							'patlog__contract.entity__contract.contract_status_delete' => 'no'
						);
					}else{
						if($division_type == 'Other'){
							$datato['where'] = array(
								'patlog__contract.entity__contract.contract_date >= ' => $this->input->post('export_date_start'),
								'patlog__contract.entity__contract.contract_date <= ' => $this->input->post('export_date_end'),
								'patlog__contract.entity__contract.contract_creator_employee_in_id is not null' => null,
								'patlog__contract.entity__contract.contract_status_done' => 'yes',
								'patlog__contract.entity__contract.contract_status_delete' => 'no'
							);
						}else{
							$datato['where'] = array(
								'patlog__contract.entity__contract.contract_date >= ' => $this->input->post('export_date_start'),
								'patlog__contract.entity__contract.contract_date <= ' => $this->input->post('export_date_end'),
								'patlog__contract.entity__contract.contract_creator_division_id' => $division_id,
								'patlog__contract.entity__contract.contract_creator_employee_in_id is not null' => null,
								'patlog__contract.entity__contract.contract_status_done' => 'yes',
								'patlog__contract.entity__contract.contract_status_delete' => 'no'
							);
						}
					}
				}
				$datato['order'] = array(
					'patlog__contract.entity__contract.contract_id'
				);
				$datato['order_type'] = array(
					'asc'
				);
				$Q1 = $this->view->view_data($datato);
				foreach($Q1->result() as $R1){
					if($R1->contract_date_loket == null){
						$day = 0;
						$hour = 0;
					}else{
						if($R1->contract_date_close == null){
							$end_date = date('Y-m-d');
						}else{
							$end_date = $R1->contract_date_close;
						}
						$start_date = new DateTime($R1->contract_date_loket);
						$end_date = new DateTime($end_date);
						$day = $start_date->diff($end_date)->days;
						$day = $day + 1;
						$hour = $day * 24;
					}
					
					$message = '';
					if($R1->contract_approver_level == 0){
						$message = 'Direject';
					}else{
						unset($datato2);
						$datato2['table'] = 'patlog__contract.entity__contract_approval';
						$datato2['where'] = array(
							'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
							'patlog__contract.entity__contract_approval.contract_approval_status is null' => null
						);
						$datato2['order'] = array(
							'patlog__contract.entity__contract_approval.contract_approval_level'
						);
						$datato2['order_type'] = array(
							'asc'
						);
						$Q2 = $this->view->view_data($datato2);
						if($Q2->num_rows()){
							$R2 = $Q2->row();
							if($R2->contract_approval_category == 'Drafter'){
								$message = 'Menunggu Proses Drafting '.$R2->contract_approval_employee_name;
							}else{
								$message = 'Menunggu Approval '.$R2->contract_approval_employee_name;
							}
						}else{
							$message = 'Selesai';
						}
					}
					
					unset($datato2);
					$datato2['table'] = 'patlog__contract.entity__contract_approval';
					$datato2['where'] = array(
						'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
						'patlog__contract.entity__contract_approval.contract_approval_category' => 'Drafter',
						'patlog__contract.entity__contract_approval.contract_approval_date is not null' => null
					);
					$Q2 = $this->view->view_data($datato2);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						$contract_date_drafter = date('Y-m-d', strtotime($R2->contract_approval_date));
					}else{
						$contract_date_drafter = null;
					}
					
					$index = 0;
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_no);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_category_to);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_request_name);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_request_description_name);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_project_code_category);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_project_code_name);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_project_code_description);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_date_start);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_date_end);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_period);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_project_currency);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_project_cost);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_project_note);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_creator_division_name);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_creator_employee_in_name);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_third_party_name);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_company_name);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_user_name);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_user_position);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_no_fix);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_active_start_date);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_active_end_date);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_ttd_place);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_ttd_date);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $this->func_clear_text($R1->contract_approver_message));
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $message);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_date);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_date_loket);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $contract_date_drafter);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_date_close);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $day.' Hari');
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $hour.' Jam');
					$excel_row++;
				}
			}elseif(urldecode($this->input->post('export_detail')) == 'Log'){
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__contract';
				$datato['table_join'] = array(
					'patlog__contract.entity__contract_log'
				);
				$datato['table_join_on'] = array(
					'patlog__contract.entity__contract'
				);
				$datato['join_id'] = array(
					'contract_id'
				);
				$datato['join_type'] = array(
					'inner'
				);
				if(urldecode($this->input->post('export_type')) == 'Process'){
					if($division_id == $cog_division_id){
						$datato['where'] = array(
							'patlog__contract.entity__contract.contract_date >= ' => $this->input->post('export_date_start'),
							'patlog__contract.entity__contract.contract_date <= ' => $this->input->post('export_date_end'),
							'patlog__contract.entity__contract.contract_creator_employee_in_id is not null' => null,
							'patlog__contract.entity__contract.contract_status_done' => 'no',
							'patlog__contract.entity__contract.contract_status_delete' => 'no'
						);
					}else{
						if($division_type == 'Other'){
							$datato['where'] = array(
								'patlog__contract.entity__contract.contract_date >= ' => $this->input->post('export_date_start'),
								'patlog__contract.entity__contract.contract_date <= ' => $this->input->post('export_date_end'),
								'patlog__contract.entity__contract.contract_creator_employee_in_id is not null' => null,
								'patlog__contract.entity__contract.contract_status_done' => 'no',
								'patlog__contract.entity__contract.contract_status_delete' => 'no'
							);
						}else{
							$datato['where'] = array(
								'patlog__contract.entity__contract.contract_date >= ' => $this->input->post('export_date_start'),
								'patlog__contract.entity__contract.contract_date <= ' => $this->input->post('export_date_end'),
								'patlog__contract.entity__contract.contract_creator_division_id' => $division_id,
								'patlog__contract.entity__contract.contract_creator_employee_in_id is not null' => null,
								'patlog__contract.entity__contract.contract_status_done' => 'no',
								'patlog__contract.entity__contract.contract_status_delete' => 'no'
							);
						}
					}
				}elseif(urldecode($this->input->post('export_type')) == 'Archive'){
					if($division_id == $cog_division_id){
						$datato['where'] = array(
							'patlog__contract.entity__contract.contract_date >= ' => $this->input->post('export_date_start'),
							'patlog__contract.entity__contract.contract_date <= ' => $this->input->post('export_date_end'),
							'patlog__contract.entity__contract.contract_creator_employee_in_id is not null' => null,
							'patlog__contract.entity__contract.contract_status_done' => 'yes',
							'patlog__contract.entity__contract.contract_status_delete' => 'no'
						);
					}else{
						if($division_type == 'Other'){
							$datato['where'] = array(
								'patlog__contract.entity__contract.contract_date >= ' => $this->input->post('export_date_start'),
								'patlog__contract.entity__contract.contract_date <= ' => $this->input->post('export_date_end'),
								'patlog__contract.entity__contract.contract_creator_employee_in_id is not null' => null,
								'patlog__contract.entity__contract.contract_status_done' => 'yes',
								'patlog__contract.entity__contract.contract_status_delete' => 'no'
							);
						}else{
							$datato['where'] = array(
								'patlog__contract.entity__contract.contract_date >= ' => $this->input->post('export_date_start'),
								'patlog__contract.entity__contract.contract_date <= ' => $this->input->post('export_date_end'),
								'patlog__contract.entity__contract.contract_creator_division_id' => $division_id,
								'patlog__contract.entity__contract.contract_creator_employee_in_id is not null' => null,
								'patlog__contract.entity__contract.contract_status_done' => 'yes',
								'patlog__contract.entity__contract.contract_status_delete' => 'no'
							);
						}
					}
				}
				$datato['order'] = array(
					'patlog__contract.entity__contract.contract_id',
					'patlog__contract.entity__contract_log.contract_log_approver_level'
				);
				$datato['order_type'] = array(
					'asc',
					'asc'
				);
				$Q1 = $this->view->view_data($datato);
				foreach($Q1->result() as $R1){
					if($R1->contract_date_loket == null){
						$day = 0;
						$hour = 0;
					}else{
						if($R1->contract_date_close == null){
							$end_date = date('Y-m-d');
						}else{
							$end_date = $R1->contract_date_close;
						}
						$start_date = new DateTime($R1->contract_date_loket);
						$end_date = new DateTime($end_date);
						$day = $start_date->diff($end_date)->days;
						$day = $day + 1;
						$hour = $day * 24;
					}
					
					if($R1->contract_log_approver_level == 1){
						$hour_log = 0;
						$minute_log = 0;
					}else{
						$datetime1 = new DateTime($past_time);
						$datetime2 = new DateTime($R1->contract_log_insert);
						$interval = $datetime1->diff($datetime2);
						$hour_log = $interval->format('%h');
						$minute_log = $interval->format('%i');
					}
					$past_time = $R1->contract_log_insert;
					
					$message = '';
					if($R1->contract_approver_level == 0){
						$message = 'Direject';
					}else{
						unset($datato2);
						$datato2['table'] = 'patlog__contract.entity__contract_approval';
						$datato2['where'] = array(
							'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
							'patlog__contract.entity__contract_approval.contract_approval_status is null' => null
						);
						$datato2['order'] = array(
							'patlog__contract.entity__contract_approval.contract_approval_level'
						);
						$datato2['order_type'] = array(
							'asc'
						);
						$Q2 = $this->view->view_data($datato2);
						if($Q2->num_rows()){
							$R2 = $Q2->row();
							if($R2->contract_approval_category == 'Drafter'){
								$message = 'Menunggu Proses Drafting '.$R2->contract_approval_employee_name;
							}else{
								$message = 'Menunggu Approval '.$R2->contract_approval_employee_name;
							}
						}else{
							$message = 'Selesai';
						}
					}
					
					unset($datato2);
					$datato2['table'] = 'patlog__contract.entity__contract_approval';
					$datato2['where'] = array(
						'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
						'patlog__contract.entity__contract_approval.contract_approval_category' => 'Drafter',
						'patlog__contract.entity__contract_approval.contract_approval_date is not null' => null
					);
					$Q2 = $this->view->view_data($datato2);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						$contract_date_drafter = date('Y-m-d', strtotime($R2->contract_approval_date));
					}else{
						$contract_date_drafter = null;
					}
					
					$index = 0;
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_no);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_category_to);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_request_name);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_request_description_name);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_project_code_category);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_project_code_name);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_project_code_description);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_date_start);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_date_end);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_period);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_project_currency);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_project_cost);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_project_note);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_creator_division_name);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_creator_employee_in_name);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_third_party_name);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_company_name);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_user_name);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_user_position);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_no_fix);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_active_start_date);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_active_end_date);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_ttd_place);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_ttd_date);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $this->func_clear_text($R1->contract_approver_message));
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $message);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_date);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_date_loket);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $contract_date_drafter);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_date_close);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $day.' Hari');
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $hour.' Jam');
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_log_employee_name);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_log_employee_position_detail);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_log_status);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_log_message);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_log_insert);
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $hour_log.' Jam');
					$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $minute_log.' Menit');
					$excel_row++;
				}
			}
			
			$detail = urldecode($this->input->post('export_detail'));
			$excel->getActiveSheet()->setTitle('Data '.$detail);
			
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__category';
			$datato['where'] = array(
				'patlog__contract.entity__category.category_id' => urldecode($this->input->post('export_category'))
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$category = $R1->category_name;
			}else{
				$category = null;
			}
			$type = urldecode($this->input->post('export_type'));
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="Laporan '.$detail.' '.$category.' '.$type.' '.date('Y-m-d').'.xlsx"');
			header('Cache-Control: max-age=0');
			$write = IOFactory::createWriter($excel, 'Excel2007');
			$write->save('php://output');
		}
	}
	
	public function contract_import()
	{
		$rand = $this->func_rand_string(10);
		$file_name = 'import-contract-'.date('Y-m-d').'-'.$rand.'.xlsx';
		$config['upload_path'] = './assets/mod__contract/attach/temporary/';
		$config['file_name'] = $file_name;
		$config['allowed_types'] = 'xlsx';
		$config['overwrite'] = TRUE;
		$this->upload->initialize($config);
		if($this->upload->do_upload('file_excel')){
			$inputFileName = './assets/mod__contract/attach/temporary/'.$file_name;
		}else{
			$this->session->set_flashdata('danger', $this->upload->display_errors());
			redirect(site_url().'module_contract/employee/impor/');
		}
		
		try{
			$inputFileType = IOFactory::identify($inputFileName);
			$objReader = IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		}catch(Exception $e){
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();
		for($row=2;$row<=$highestRow;$row++){
			$rowData = $sheet->rangeToArray(
				'A'.$row.':'.$highestColumn.$row,
				NULL,
				TRUE,
				FALSE
			);
			
			if(urldecode($this->input->post('action')) == 'add'){
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__contract_category';
				$datato['where'] = array(
					'patlog__contract.entity__contract_category.contract_category_id' => 2
				);
				$Q1 = $this->view->view_data($datato);
				if($Q1->num_rows()){
					$R1 = $Q1->row();
					$contract_category_id = $R1->contract_category_id;
					$contract_category_to = $R1->division_name;
				}else{
					$contract_category_id = null;
					$contract_category_to = null;
				}
				
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__contract_request';
				$datato['where'] = array(
					'patlog__contract.entity__contract_request.contract_request_id' => 2
				);
				$Q1 = $this->view->view_data($datato);
				if($Q1->num_rows()){
					$R1 = $Q1->row();
					$contract_request_id = $R1->contract_request_id;
					$contract_request_name = $R1->contract_request_name;
				}else{
					$contract_request_id = null;
					$contract_request_name = null;
				}
				
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__contract_request_description';
				$datato['where'] = array(
					'patlog__contract.entity__contract_request_description.contract_request_description_id' => 15
				);
				$Q1 = $this->view->view_data($datato);
				if($Q1->num_rows()){
					$R1 = $Q1->row();
					$contract_request_description_id = $R1->contract_request_description_id;
					$contract_request_description_name = $R1->contract_request_description_name;
				}else{
					$contract_request_description_id = null;
					$contract_request_description_name = null;
				}
				
				$contract_project_code_name = null;
				$contract_project_code_description = null;
				$contract_date_start = null;
				$contract_date_end = null;
				$contract_period = null;
				$contract_project_currency = null;
				$contract_project_cost = null;
				$contract_company_id = null;
				$contract_company_name = null;
				$contract_company_address = null;
				$contract_company_email = null;
				$contract_company_phone = null;
				if($rowData[0][3] == 'Project Code'){
					unset($datato);
					$datato['table'] = 'patlog__project.entity__project_code';
					$datato['where'] = array(
						'patlog__project.entity__project_code.project_code_name' => $rowData[0][4]
					);
					$Q1 = $this->view->view_data($datato);
					if($Q1->num_rows()){
						$R1 = $Q1->row();
						$contract_project_code_id = $R1->project_code_id;
						$contract_project_code_name = $R1->project_code_name;
						$contract_project_code_description = $R1->project_code_description;
						$contract_date_start = $R1->project_code_date_start;
						$contract_date_end = $R1->project_code_date_end;
						$contract_period = $R1->project_code_period;
						$contract_project_currency = $R1->project_code_currency;
						$contract_project_cost = $rowData[0][6];
						$contract_company_id = $R1->project_code_company_id;
						$contract_company_name = $R1->project_code_company_name;
						$contract_company_address = $R1->project_code_company_address;
						$contract_company_email = $R1->project_code_company_email;
						$contract_company_phone = $R1->project_code_company_phone;
					}
				}elseif($rowData[0][3] == 'Cost Center'){
					unset($datato);
					$datato['table'] = 'patlog__project.entity__cost_center';
					$datato['where'] = array(
						'patlog__project.entity__cost_center.cost_center_name' => $rowData[0][4]
					);
					$Q1 = $this->view->view_data($datato);
					if($Q1->num_rows()){
						$R1 = $Q1->row();
						$contract_project_code_id = $R1->cost_center_id;
						$contract_project_code_name = $R1->cost_center_name;
						$contract_project_code_description = $R1->cost_center_description;
						$contract_date_start = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($rowData[0][8]));
						$contract_date_end = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($rowData[0][9]));
						$start_date = new DateTime(date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($rowData[0][8])));
						$end_date = new DateTime(date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($rowData[0][9])));
						$contract_period = $start_date->diff($end_date)->days;
						$contract_period = $contract_period + 1;
						$contract_project_cost = $rowData[0][6];
						
						unset($datato);
						$datato['table'] = 'patlog__contract.entity__cog';
						$Q2 = $this->view->view_data($datato);
						if($Q2->num_rows()){
							$R2 = $Q2->row();
							
							$contract_project_currency = $R2->cog_currency;
							unset($datato);
							$datato['table'] = 'patlog__project.entity__company';
							$datato['where'] = array(
								'patlog__project.entity__company.company_id' => $R2->cog_company_id
							);
							$Q3 = $this->view->view_data($datato);
							if($Q3->num_rows()){
								$R3 = $Q3->row();
								
								$contract_company_id = $R3->company_id;
								$contract_company_name = $R3->company_name;
								$contract_company_address = $R3->company_address;
								$contract_company_email = $R3->company_email;
								$contract_company_phone = $R3->company_phone;
							}
						}
					}
				}
				
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__contract_third_party';
				$datato['where'] = array(
					'patlog__contract.entity__contract_third_party.contract_third_party_id' => 3
				);
				$Q1 = $this->view->view_data($datato);
				if($Q1->num_rows()){
					$R1 = $Q1->row();
					$contract_third_party_id = $R1->contract_third_party_id;
					$contract_third_party_name = $R1->contract_third_party_name;
				}else{
					$contract_third_party_id = null;
					$contract_third_party_name = null;
				}
				
				unset($datato);
				$datato['table'] = 'patlog__hrms.entity__employee_in';
				$datato['table_join'] = array(
					'patlog__hrms.entity__division'
				);
				$datato['table_join_on'] = array(
					'patlog__hrms.entity__employee_in'
				);
				$datato['join_id'] = array(
					'division_id'
				);
				$datato['join_type'] = array(
					'inner'
				);
				$datato['where'] = array(
					'patlog__hrms.entity__employee_in.employee_in_code' => $rowData[0][10]
				);
				$Q1 = $this->view->view_data($datato);
				if($Q1->num_rows()){
					$R1 = $Q1->row();
					$contract_creator_division_id = $R1->division_id;
					$contract_creator_division_name = $R1->division_name;
					$contract_creator_employee_in_id = $R1->employee_in_id;
					$contract_creator_employee_in_code = $R1->employee_in_code;
					$contract_creator_name = $R1->employee_in_name;
					$contract_creator_position = $R1->employee_in_position;
				}else{
					$contract_creator_division_id = null;
					$contract_creator_division_name = null;
					$contract_creator_employee_in_id = null;
					$contract_creator_employee_in_code = null;
					$contract_creator_name = null;
					$contract_creator_position = null;
				}
				
				unset($datato);
				$datato['table'] = 'patlog__hrms.entity__employee_in';
				$datato['where'] = array(
					'patlog__hrms.entity__employee_in.division_id' => $contract_creator_division_id,
					'patlog__hrms.entity__employee_in.employee_in_position' => 'Manajer',
					'patlog__hrms.entity__employee_in.employee_in_status' => 'Aktif'
				);
				$Q1 = $this->view->view_data($datato);
				if($Q1->num_rows()){
					$R1 = $Q1->row();
					$ast_employee_in_id = $R1->employee_in_id;
				}else{
					$ast_employee_in_id = null;
				}
				
				unset($datato);
				$datato['table'] = 'patlog__hrms.entity__employee_in';
				$datato['where'] = array(
					'patlog__hrms.entity__employee_in.employee_in_id' => $ast_employee_in_id
				);
				$Q1 = $this->view->view_data($datato);
				if($Q1->num_rows()){
					$R1 = $Q1->row();
					$contract_cremanager_employee_in_id = $R1->employee_in_id;
					$contract_cremanager_employee_in_code = $R1->employee_in_code;
					$contract_cremanager_name = $R1->employee_in_name;
					$contract_cremanager_position = $R1->employee_in_position;
				}else{
					$contract_cremanager_employee_in_id = null;
					$contract_cremanager_employee_in_code = null;
					$contract_cremanager_name = null;
					$contract_cremanager_position = null;
				}
				
				$contract_verificator_employee_in_id = null;
				$contract_verificator_employee_in_code = null;
				$contract_verificator_name = null;
				$contract_verificator_position = null;
				$contract_vermanager_employee_in_id = null;
				$contract_vermanager_employee_in_code = null;
				$contract_vermanager_name = null;
				$contract_vermanager_position = null;
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__contract_category';
				$datato['where'] = array(
					'patlog__contract.entity__contract_category.contract_category_id' => $contract_category_id
				);
				$Q1 = $this->view->view_data($datato);
				if($Q1->num_rows()){
					$R1 = $Q1->row();
					
					unset($datato);
					$datato['table'] = 'patlog__hrms.entity__employee_in';
					$datato['where'] = array(
						'patlog__hrms.entity__employee_in.functions_id' => $R1->functions_id,
						'patlog__hrms.entity__employee_in.employee_in_position' => 'Asisten Manajer',
						'patlog__hrms.entity__employee_in.employee_in_status' => 'Aktif'
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						$contract_verificator_employee_in_id = $R2->employee_in_id;
						$contract_verificator_employee_in_code = $R2->employee_in_code;
						$contract_verificator_name = $R2->employee_in_name;
						$contract_verificator_position = $R2->employee_in_position;
					}
					
					unset($datato);
					$datato['table'] = 'patlog__hrms.entity__employee_in';
					$datato['where'] = array(
						'patlog__hrms.entity__employee_in.division_id' => $R1->division_id,
						'patlog__hrms.entity__employee_in.employee_in_position' => 'Manajer',
						'patlog__hrms.entity__employee_in.employee_in_status' => 'Aktif'
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						$contract_vermanager_employee_in_id = $R2->employee_in_id;
						$contract_vermanager_employee_in_code = $R2->employee_in_code;
						$contract_vermanager_name = $R2->employee_in_name;
						$contract_vermanager_position = $R2->employee_in_position;
					}
				}
				
				unset($datato);
				$datato['table'] = 'patlog__hrms.entity__employee_in';
				$datato['where'] = array(
					'patlog__hrms.entity__employee_in.functions_id' => 13
				);
				$Q1 = $this->view->view_data($datato);
				if($Q1->num_rows()){
					$R1 = $Q1->row();
					$contract_verstaff_employee_in_id = $R1->employee_in_id;
					$contract_verstaff_employee_in_code = $R1->employee_in_code;
					$contract_verstaff_name = $R1->employee_in_name;
					$contract_verstaff_employee_in_position = $R1->employee_in_position;
				}else{
					$contract_verstaff_employee_in_id = null;
					$contract_verstaff_employee_in_code = null;
					$contract_verstaff_name = null;
					$contract_verstaff_employee_in_position = null;
				}
				
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__vendor';
				$datato['where'] = array(
					'patlog__procurement.entity__vendor.vendor_name' => $rowData[0][7]
				);
				$Q1 = $this->view->view_data($datato);
				if($Q1->num_rows()){
					$R1 = $Q1->row();
					$vendor_sales_name = $R1->vendor_sales_name;
					$vendor_name = $R1->vendor_name;
					$vendor_street_building = $R1->vendor_street_building;
					$vendor_total_employee = $R1->vendor_total_employee;
				}else{
					$vendor_sales_name = null;
					$vendor_name = null;
					$vendor_street_building = null;
					$vendor_total_employee = null;
				}
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__contract_archive';
				$datato['contract_archive_id_old'] = null;
				$datato['contract_archive_no'] = null;
				$datato['contract_archive_date'] = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($rowData[0][2]));
				$datato['contract_archive_category_id'] = $contract_category_id;
				$datato['contract_archive_category_to'] = $contract_category_to;
				$datato['contract_archive_request_id'] = $contract_request_id;
				$datato['contract_archive_request_name'] = $contract_request_name;
				$datato['contract_archive_request_description_id'] = $contract_request_description_id;
				$datato['contract_archive_request_description_name'] = $contract_request_description_name;
				$datato['contract_archive_project_code_category'] = $rowData[0][3];
				$datato['contract_archive_project_code_id'] = $contract_project_code_id;
				$datato['contract_archive_project_code_name'] = $contract_project_code_name;
				$datato['contract_archive_project_code_description'] = $contract_project_code_description;
				$datato['contract_archive_date_start'] = $contract_date_start;
				$datato['contract_archive_date_end'] = $contract_date_end;
				$datato['contract_archive_period'] = $contract_period;
				$datato['contract_archive_project_currency'] = $contract_project_currency;
				$datato['contract_archive_project_cost'] = $contract_project_cost;
				$datato['contract_archive_project_note'] = 'Migrasi';
				$datato['contract_archive_company_id'] = $contract_company_id;
				$datato['contract_archive_company_name'] = $contract_company_name;
				$datato['contract_archive_company_address'] = $contract_company_address;
				$datato['contract_archive_company_email'] = $contract_company_email;
				$datato['contract_archive_company_phone'] = $contract_company_phone;
				$datato['contract_archive_third_party_id'] = $contract_third_party_id;
				$datato['contract_archive_third_party_name'] = $contract_third_party_name;
				$datato['contract_archive_user_name'] = null;
				$datato['contract_archive_employee_name'] = $vendor_sales_name;
				$datato['contract_archive_employee_company'] = $vendor_name;
				$datato['contract_archive_employee_address'] = $vendor_street_building;
				$datato['contract_archive_employee_count'] = $vendor_total_employee;
				$datato['contract_archive_document_in'] = 'no.pdf';
				$datato['contract_archive_support_document1'] = 'no.pdf';
				$datato['contract_archive_support_document2'] = 'no.pdf';
				$datato['contract_archive_support_document3'] = 'no.pdf';
				$datato['contract_archive_support_document4'] = 'no.pdf';
				$datato['contract_archive_support_document5'] = 'no.pdf';
				$datato['contract_archive_support_document6'] = 'no.pdf';
				$datato['contract_archive_support_document7'] = 'no.pdf';
				$datato['contract_archive_creator_division_id'] = $contract_creator_division_id;
				$datato['contract_archive_creator_division_name'] = $contract_creator_division_name;
				$datato['contract_archive_creator_employee_in_id'] = $contract_creator_employee_in_id;
				$datato['contract_archive_creator_employee_in_code'] = $contract_creator_employee_in_code;
				$datato['contract_archive_creator_name'] = $contract_creator_name;
				$datato['contract_archive_creator_position'] = $contract_creator_position;
				$datato['contract_archive_cremanager_employee_in_id'] = $contract_cremanager_employee_in_id;
				$datato['contract_archive_cremanager_employee_in_code'] = $contract_cremanager_employee_in_code;
				$datato['contract_archive_cremanager_name'] = $contract_cremanager_name;
				$datato['contract_archive_cremanager_position'] = $contract_cremanager_position;
				$datato['contract_archive_verificator_employee_in_id'] = $contract_verificator_employee_in_id;
				$datato['contract_archive_verificator_employee_in_code'] = $contract_verificator_employee_in_code;
				$datato['contract_archive_verificator_name'] = $contract_verificator_name;
				$datato['contract_archive_verificator_position'] = $contract_verificator_position;
				$datato['contract_archive_verstaff_employee_in_id'] = $contract_verstaff_employee_in_id;
				$datato['contract_archive_verstaff_employee_in_code'] = $contract_verstaff_employee_in_code;
				$datato['contract_archive_verstaff_name'] = $contract_verstaff_name;
				$datato['contract_archive_verstaff_employee_in_position'] = $contract_verstaff_employee_in_position;
				$datato['contract_archive_vermanager_employee_in_id'] = $contract_vermanager_employee_in_id;
				$datato['contract_archive_vermanager_employee_in_code'] = $contract_vermanager_employee_in_code;
				$datato['contract_archive_vermanager_name'] = $contract_vermanager_name;
				$datato['contract_archive_vermanager_position'] = $contract_vermanager_position;
				$datato['contract_archive_no_fix'] = $rowData[0][0];
				$datato['contract_archive_active_start_date'] = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($rowData[0][8]));
				$datato['contract_archive_active_end_date'] = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($rowData[0][9]));
				$datato['contract_archive_sending_date'] = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($rowData[0][8]));
				$datato['contract_archive_ttd_place'] = 'Jakarta';
				$datato['contract_archive_ttd_date'] = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($rowData[0][8]));
				$datato['contract_archive_summary_id'] = null;
				$datato['contract_archive_summary_description'] = null;
				$datato['contract_archive_summary_file_name'] = 'no.pdf';
				$datato['contract_archive_summary_file_ttd'] = 'no.pdf';
				$datato['contract_archive_infomation'] = null;
				$datato['contract_review_archive_id'] = null;
				$datato['contract_archive_ttd_sign_type'] = null;
				$datato['contract_archive_ttd_sign_token'] = null;
				$datato['contract_archive_ttd_sign_url'] = null;
				$datato['contract_archive_ttd_sign_link'] = null;
				$datato['contract_archive_ttd_sign_download'] = null;
				$datato['contract_archive_ttd_sign_date_sign'] = null;
				$datato['contract_archive_ttd_sign_date_expired'] = null;
				$datato['contract_archive_ttd_sign_status'] = null;
				$datato['contract_archive_ttd_sign_callback'] = null;
				$datato['contract_archive_approver_level'] = 5;
				$datato['contract_archive_approver_message'] = '<div class="badge badge-primary">Approve</div> &bull; '.$contract_vermanager_name;
				$datato['contract_archive_status_progress'] = $contract_request_name;
				$datato['contract_archive_data_from'] = 'MIGRASI';
				$datato['contract_archive_data_id'] = null;
				$datato['contract_archive_data_code'] = null;
				$datato['contract_archive_link_id'] = null;
				$datato['contract_archive_insert_date'] = date('Y-m-d H:i:s');
				$datato['contract_archive_update_date'] = date('Y-m-d H:i:s');
				$datato['contract_archive_log_id'] = '[]';
				$datato['contract_archive_process_id'] = '[]';
				$datato['contract_archive_process_name'] = '[]';
				$datato['contract_archive_log_approver_level'] = '[]';
				$datato['contract_archive_log_employee_code'] = '[]';
				$datato['contract_archive_log_employee_name'] = '[]';
				$datato['contract_archive_log_status'] = '[]';
				$datato['contract_archive_log_message'] = '[]';
				$datato['contract_archive_log_insert'] = '[]';
				$datato['contract_archive_draft_id'] = '[]';
				$datato['contract_archive_draft_file_name'] = '[]';
				$datato['contract_archive_draft_date'] = '[]';
				$datato['contract_archive_draft_employee_code'] = '[]';
				$datato['contract_archive_draft_employee_name'] = '[]';
				$datato['contract_archive_attachment_id'] = '[]';
				$datato['contract_archive_attachment_name'] = '[]';
				$datato['contract_archive_attachment_file'] = '[]';
				$datato['contract_archive_attachment_insert'] = '[]';
				$datato['contract_archive_attachment_update'] = '[]';
				$datato['contract_archive_insert'] = date('Y-m-d H:i:s');
				$datato['contract_archive_user_company'] = null;
				$datato['contract_archive_interval_time'] = null;
				$contract_archive_id = $this->mod->insert($datato);
				
				$array_month = array(
					1 => 'I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'
				);
				$roman_month = $array_month[date('n')];
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__contract_archive';
				$datato['contract_archive_no'] = $contract_archive_id.'/KITUCO-SPPK/'.$roman_month.'/'.date('Y');
				$datato['field'] = 'contract_archive_id';
				$datato['id'] = $contract_archive_id;
				$this->mod->update($datato);
				
				$this->print_contract_archive($contract_archive_id);
			}
		}
		
		$this->session->set_flashdata('success', 'Data berhasil diubah.');
		redirect(site_url().'module_contract/employee/impor/');
	}
	
	public function process()
	{
		if($this->uri->segment(4) == 'add'){
			unset($datato);
			$datato['database'] = 'patlog__contract';
			$datato['table'] = 'entity__process';
			$datato['process_name'] = $this->input->post('process_name');
			$datato['process_attachment_status'] = urldecode($this->input->post('process_attachment_status'));
			$datato['process_flow'] = urldecode($this->input->post('process_flow'));
			$datato['process_insert'] = date('Y-m-d H:i:s');
			$this->mod->insert($datato);
			
			$this->session->set_flashdata('success', 'Data berhasil ditambah.');
			redirect(site_url().'module_contract/employee/data_proses/');
		}elseif($this->uri->segment(4) == 'edit'){
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__process';
			$datato['where'] = array(
				'patlog__contract.entity__process.process_id' => $this->uri->segment(5)
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__process';
				$datato['process_name'] = $this->input->post('process_name');
				$datato['process_attachment_status'] = urldecode($this->input->post('process_attachment_status'));
				$datato['process_flow'] = urldecode($this->input->post('process_flow'));
				$datato['field'] = 'process_id';
				$datato['id'] = $R1->process_id;
				$this->mod->update($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect(site_url().'module_contract/employee/data_proses/');
		}elseif($this->uri->segment(4) == 'delete'){
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__process';
			$datato['where'] = array(
				'patlog__contract.entity__process.process_id' => $this->uri->segment(5)
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__process';
				$datato['field'] = 'process_id';
				$datato['id'] = $R1->process_id;
				$this->mod->delete($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect(site_url().'module_contract/employee/data_proses/');
		}
	}
	
	public function request()
	{
		if($this->uri->segment(4) == 'add'){
			unset($datato);
			$datato['database'] = 'patlog__contract';
			$datato['table'] = 'entity__request';
			$datato['request_name'] = $this->input->post('request_name');
			$datato['request_insert'] = date('Y-m-d H:i:s');
			$this->mod->insert($datato);
			
			$this->session->set_flashdata('success', 'Data berhasil ditambah.');
			redirect(site_url().'module_contract/employee/data_permintaan/');
		}elseif($this->uri->segment(4) == 'edit'){
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__request';
			$datato['where'] = array(
				'patlog__contract.entity__request.request_id' => $this->uri->segment(5)
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__request';
				$datato['request_name'] = $this->input->post('request_name');
				$datato['field'] = 'request_id';
				$datato['id'] = $R1->request_id;
				$this->mod->update($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect(site_url().'module_contract/employee/data_permintaan/');
		}elseif($this->uri->segment(4) == 'delete'){
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__request';
			$datato['where'] = array(
				'patlog__contract.entity__request.request_id' => $this->uri->segment(5)
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__request';
				$datato['field'] = 'request_id';
				$datato['id'] = $R1->request_id;
				$this->mod->delete($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect(site_url().'module_contract/employee/data_permintaan/');
		}
	}
	
	public function request_description()
	{
		if($this->uri->segment(4) == 'add'){
			unset($datato);
			$datato['database'] = 'patlog__contract';
			$datato['table'] = 'entity__request_description';
			$datato['request_id'] = urldecode($this->input->post('request_id'));
			$datato['request_description_name'] = $this->input->post('request_description_name');
			$datato['request_description_insert'] = date('Y-m-d H:i:s');
			$this->mod->insert($datato);
			
			$this->session->set_flashdata('success', 'Data berhasil ditambah.');
			redirect(site_url().'module_contract/employee/data_detail_permintaan/');
		}elseif($this->uri->segment(4) == 'edit'){
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__request_description';
			$datato['where'] = array(
				'patlog__contract.entity__request_description.request_description_id' => $this->uri->segment(5)
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__request_description';
				$datato['request_id'] = urldecode($this->input->post('request_id'));
				$datato['request_description_name'] = $this->input->post('request_description_name');
				$datato['field'] = 'request_description_id';
				$datato['id'] = $R1->request_description_id;
				$this->mod->update($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect(site_url().'module_contract/employee/data_detail_permintaan/');
		}elseif($this->uri->segment(4) == 'delete'){
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__request_description';
			$datato['where'] = array(
				'patlog__contract.entity__request_description.request_description_id' => $this->uri->segment(5)
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__request_description';
				$datato['field'] = 'request_description_id';
				$datato['id'] = $R1->request_description_id;
				$this->mod->delete($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect(site_url().'module_contract/employee/data_detail_permintaan/');
		}
	}
	
	public function third_party()
	{
		if($this->uri->segment(4) == 'add'){
			unset($datato);
			$datato['database'] = 'patlog__contract';
			$datato['table'] = 'entity__third_party';
			$datato['third_party_name'] = $this->input->post('third_party_name');
			$datato['third_party_insert'] = date('Y-m-d H:i:s');
			$this->mod->insert($datato);
			
			$this->session->set_flashdata('success', 'Data berhasil ditambah.');
			redirect(site_url().'module_contract/employee/data_pihak_ketiga/');
		}elseif($this->uri->segment(4) == 'edit'){
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__third_party';
			$datato['where'] = array(
				'patlog__contract.entity__third_party.third_party_id' => $this->uri->segment(5)
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__third_party';
				$datato['third_party_name'] = $this->input->post('third_party_name');
				$datato['field'] = 'third_party_id';
				$datato['id'] = $R1->third_party_id;
				$this->mod->update($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect(site_url().'module_contract/employee/data_pihak_ketiga/');
		}elseif($this->uri->segment(4) == 'delete'){
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__third_party';
			$datato['where'] = array(
				'patlog__contract.entity__third_party.third_party_id' => $this->uri->segment(5)
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__third_party';
				$datato['field'] = 'third_party_id';
				$datato['id'] = $R1->third_party_id;
				$this->mod->delete($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect(site_url().'module_contract/employee/data_pihak_ketiga/');
		}
	}
	
	public function document()
	{
		if($this->uri->segment(4) == 'add'){
			unset($datato);
			$datato['database'] = 'patlog__contract';
			$datato['table'] = 'entity__document';
			$datato['document_order'] = $this->input->post('document_order');
			$datato['document_name'] = $this->input->post('document_name');
			$datato['document_mandatory'] = urldecode($this->input->post('document_mandatory'));
			$datato['document_insert'] = date('Y-m-d H:i:s');
			$this->mod->insert($datato);
			
			$this->session->set_flashdata('success', 'Data berhasil ditambah.');
			redirect(site_url().'module_contract/employee/data_dokumen/');
		}elseif($this->uri->segment(4) == 'edit'){
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__document';
			$datato['where'] = array(
				'patlog__contract.entity__document.document_id' => $this->uri->segment(5)
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__document';
				$datato['document_order'] = $this->input->post('document_order');
				$datato['document_name'] = $this->input->post('document_name');
				$datato['document_mandatory'] = urldecode($this->input->post('document_mandatory'));
				$datato['field'] = 'document_id';
				$datato['id'] = $R1->document_id;
				$this->mod->update($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect(site_url().'module_contract/employee/data_dokumen/');
		}elseif($this->uri->segment(4) == 'delete'){
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__document';
			$datato['where'] = array(
				'patlog__contract.entity__document.document_id' => $this->uri->segment(5)
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__document';
				$datato['field'] = 'document_id';
				$datato['id'] = $R1->document_id;
				$this->mod->delete($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect(site_url().'module_contract/employee/data_dokumen/');
		}
	}
	
	public function template_file()
	{
		if($this->uri->segment(4) == 'add'){
			unset($datato);
			$datato['database'] = 'patlog__contract';
			$datato['table'] = 'entity__template';
			$datato['template_name'] = $this->input->post('template_name');
			$datato['template_file'] = 'no.pdf';
			$datato['template_insert'] = date('Y-m-d H:i:s');
			$template_id = $this->mod->insert($datato);
			
			if(isset($_FILES['template_file'])){
				unset($data);
				foreach($_FILES['template_file'] as $key => $file){
					$data[$key] = $_FILES['template_file'][$key];
				}
				$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
				$file_name = 'template-file-'.md5($template_id).'.'.$ext;
				$path = './assets/mod__contract/attach/template-file/'.$file_name;
				$arr_type = array(
					'application/msword',
					'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
				);
				if(in_array($data['type'], $arr_type)){
					move_uploaded_file($data['tmp_name'], $path);
					unset($datato);
					$datato['database'] = 'patlog__contract';
					$datato['table'] = 'entity__template';
					$datato['template_file'] = $file_name;
					$datato['field'] = 'template_id';
					$datato['id'] = $template_id;
					$this->mod->update($datato);
				}
			}
			
			$this->session->set_flashdata('success', 'Data berhasil ditambah.');
			redirect(site_url().'module_contract/employee/data_template/');
		}elseif($this->uri->segment(4) == 'edit'){
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__template';
			$datato['where'] = array(
				'patlog__contract.entity__template.template_id' => $this->uri->segment(5)
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__template';
				$datato['template_name'] = $this->input->post('template_name');
				$datato['field'] = 'template_id';
				$datato['id'] = $R1->template_id;
				$this->mod->update($datato);
				
				if(isset($_FILES['template_file'])){
					unset($data);
					foreach($_FILES['template_file'] as $key => $file){
						$data[$key] = $_FILES['template_file'][$key];
					}
					$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
					$file_name = 'template-file-'.md5($R1->template_id).'.'.$ext;
					$path = './assets/mod__contract/attach/template-file/'.$file_name;
					$arr_type = array(
						'application/msword',
						'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
					);
					if(in_array($data['type'], $arr_type)){
						move_uploaded_file($data['tmp_name'], $path);
						unset($datato);
						$datato['database'] = 'patlog__contract';
						$datato['table'] = 'entity__template';
						$datato['template_file'] = $file_name;
						$datato['field'] = 'template_id';
						$datato['id'] = $R1->template_id;
						$this->mod->update($datato);
					}
				}
			}
			
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect(site_url().'module_contract/employee/data_template/');
		}elseif($this->uri->segment(4) == 'delete'){
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__template';
			$datato['where'] = array(
				'patlog__contract.entity__template.template_id' => $this->uri->segment(5)
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				if(file_exists('assets/mod__contract/attach/template-file/'.$R1->template_file) and $R1->template_file != 'no.pdf'){
					unlink('assets/mod__contract/attach/template-file/'.$R1->template_file);
				}
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__template';
				$datato['field'] = 'template_id';
				$datato['id'] = $R1->template_id;
				$this->mod->delete($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect(site_url().'module_contract/employee/data_template/');
		}
	}
	
	public function user_reviewer()
	{
		if($this->uri->segment(4) == 'add'){
			unset($datato);
			$datato['table'] = 'patlog__hrms.entity__employee_in';
			$datato['where'] = array(
				'patlog__hrms.entity__employee_in.employee_in_id' => $this->input->post('user_reviewer_employee_in_id')
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$employee_in_id = $R1->employee_in_id;
				$employee_in_name = $R1->employee_in_name;
			}else{
				$employee_in_id = null;
				$employee_in_name = null;
			}
			
			unset($datato);
			$datato['database'] = 'patlog__contract';
			$datato['table'] = 'entity__user_reviewer';
			$datato['user_reviewer_employee_in_id'] = $employee_in_id;
			$datato['user_reviewer_employee_in_name'] = $employee_in_name;
			$datato['user_reviewer_insert'] = date('Y-m-d H:i:s');
			$this->mod->insert($datato);
			
			$this->session->set_flashdata('success', 'Data berhasil ditambah.');
			redirect(site_url().'module_contract/employee/data_user_reviewer/');
		}elseif($this->uri->segment(4) == 'edit'){
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__user_reviewer';
			$datato['where'] = array(
				'patlog__contract.entity__user_reviewer.user_reviewer_id' => $this->uri->segment(5)
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['table'] = 'patlog__hrms.entity__employee_in';
				$datato['where'] = array(
					'patlog__hrms.entity__employee_in.employee_in_id' => $this->input->post('user_reviewer_employee_in_id')
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$employee_in_id = $R2->employee_in_id;
					$employee_in_name = $R2->employee_in_name;
				}else{
					$employee_in_id = null;
					$employee_in_name = null;
				}
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__user_reviewer';
				$datato['user_reviewer_employee_in_id'] = $employee_in_id;
				$datato['user_reviewer_employee_in_name'] = $employee_in_name;
				$datato['field'] = 'user_reviewer_id';
				$datato['id'] = $R1->user_reviewer_id;
				$this->mod->update($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect(site_url().'module_contract/employee/data_user_reviewer/');
		}elseif($this->uri->segment(4) == 'delete'){
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__user_reviewer';
			$datato['where'] = array(
				'patlog__contract.entity__user_reviewer.user_reviewer_id' => $this->uri->segment(5)
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__user_reviewer';
				$datato['field'] = 'user_reviewer_id';
				$datato['id'] = $R1->user_reviewer_id;
				$this->mod->delete($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect(site_url().'module_contract/employee/data_user_reviewer/');
		}
	}
	
	public function cog()
	{
		$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(4));
		$cog_id = $this->encrypt->decode($decrypt_id);
		
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__cog';
		$datato['where'] = array(
			'patlog__contract.entity__cog.cog_id' => $cog_id
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			unset($datato);
			$datato['database'] = 'patlog__contract';
			$datato['table'] = 'entity__cog';
			$datato['cog_currency'] = urldecode($this->input->post('cog_currency'));
			$datato['cog_division_id'] = urldecode($this->input->post('cog_division_id'));
			$datato['cog_functions_id'] = urldecode($this->input->post('cog_functions_id'));
			$datato['cog_running_text'] = $this->input->post('cog_running_text');
			$datato['field'] = 'cog_id';
			$datato['id'] = $R1->cog_id;
			$this->mod->update($datato);
		}
		
		$this->session->set_flashdata('success', 'Data berhasil diubah.');
		redirect(site_url().'module_contract/employee/data_konfigurasi/');
	}
	
	public function print_contract($id)
	{
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__contract';
		$datato['where'] = array(
			'patlog__contract.entity__contract.contract_id' => $id
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			$this->load->library('pdf');
			
			//A4 width : 219mm
			//default margin : 10mm each side
			//writable horizontal : 219-(10*2)=189mm
			
			$pdf = new FPDF('P','mm','A4');
			$pdf->SetMargins(15,10,15,10);	
			$pdf->AddPage();
			
			# ===== HEADER (Start) =====
			$pdf->Image(base_url('assets/public/logo.png'),10,3,40,0,'PNG');
			$pdf->Image(base_url('assets/mod__contract/attach/contract-qr/'.$R1->contract_qr),180,3,20,0,'PNG');
			$pdf->Ln(14);
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln();
			# ===== HEADER (End) =====
			
			# ===== BODY (Start) =====
			// Cell(width,height,text,border,end line,[align])
			$pdf->Cell(190,5,'FORMULIR REQUEST KONTRAK ('.$R1->contract_category_to.')',0,1,'C');
			$pdf->Cell(190,5,$R1->contract_no,0,1,'C');
			$pdf->Ln();
			
			$pdf->SetFont('Arial','',8);		
			$pdf->Cell(100,5,'Jakarta, '.date_indo(date('Y-m-d', strtotime($R1->contract_date))),0,0);
			$pdf->Cell(40,5,$R1->contract_project_code_category.' :',0,0,'R');
			$pdf->Cell(40,5,$R1->contract_project_code_name,0,1);
			$pdf->Ln();
			
			$pdf->SetFont('Arial','B',8);	
			$pdf->Cell(60,5,'Informasi Pemohon',0,1);
			
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(30,5,'Nomor SPPK',0,0,'L');
			$pdf->Cell(60,5,': '.$R1->contract_no,0,0);
			$pdf->Cell(30,5,'Tanggal Pengajuan',0,0,'L');
			$pdf->Cell(60,5,': '.date_indo(date('Y-m-d', strtotime($R1->contract_date))),0,1);
			
			$pdf->Cell(30,5,'Pembuat',0,0,'L');
			$pdf->Cell(60,5,': '.$R1->contract_creator_employee_in_name,0,0);
			$pdf->Cell(30,5,'Divisi',0,0,'L');
			$pdf->Cell(60,5,': '.$R1->contract_creator_division_name,0,1);
			
			$pdf->Cell(30,5,'Approval',0,0,'L');
			$pdf->Cell(60,5,': '.$R1->contract_approval_select_name,0,1);
			
			$pdf->Ln();
			
			$pdf->SetFont('Arial','B',8);		
			$pdf->Cell(60,5,'Informasi Pendukung',0,1);
			
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(30,5,'Jenis Permintaan',0,0,'L');
			$pdf->Cell(60,5,': '.$R1->contract_request_name,0,0);
			$pdf->Cell(30,5,'Ditujukan Kepada',0,0,'L');
			$pdf->Cell(60,5,': '.$R1->contract_category_to,0,1);
			
			$pdf->Cell(30,5,'Deskripsi Permintaan',0,0,'L');
			$pdf->Cell(60,5,': '.$R1->contract_request_description_name,0,1);
			
			$pdf->Cell(30,5,'Nama Proyek',0,0);
			$pdf->MultiCell(150,5,$R1->contract_project_code_description,0,1,false);
			
			$pdf->Cell(30,5,'Tanggal Mulai',0,0,'L');
			$pdf->Cell(60,5,': '.$R1->contract_date_start,0,0);
			$pdf->Cell(30,5,'Mata Uang',0,0,'L');
			$pdf->Cell(60,5,': '.$R1->contract_project_currency,0,1);
			
			$pdf->Cell(30,5,'Tanggal Selesai',0,0,'L');
			$pdf->Cell(60,5,': '.$R1->contract_date_end,0,0);
			$pdf->Cell(30,5,'Estimasi Nilai Pekerjaan',0,0,'L');
			$pdf->Cell(60,5,': '.$R1->contract_project_cost,0,1);
			
			$pdf->Ln();
			
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(180,5,'Catatan:','TLR',1,'');
			$pdf->MultiCell(180,5,$R1->contract_project_note,'LR',1,false);
			$pdf->Cell(180,5,'','LRB',1,'');
			
			$pdf->Ln();
			
			$pdf->SetFont('Arial','B',8);	
			$pdf->Cell(60,5,'Informasi Kebutuhan',0,1);
			
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(30,5,'Kebutuhan Untuk',0,0,'L');
			$pdf->Cell(60,5,': '.$R1->contract_third_party_name,0,0);
			
			$pdf->Cell(30,5,'Penandatangan',0,0,'L');
			$pdf->Cell(60,5,': '.$R1->contract_user_name,0,1);
			
			$pdf->Cell(30,5,'Nama Perusahaan',0,0,'L');
			$pdf->Cell(60,5,': '.$R1->contract_company_name,0,0);
			$pdf->Cell(30,5,'Jabatan',0,0,'L');
			$pdf->Cell(60,5,': '.$R1->contract_user_position,0,1);
			
			$pdf->Ln();
			
			$pdf->SetFont('Arial','B',8);	
			$pdf->Cell(60,5,'Dokumen Pendukung',0,1);
			
			$pdf->SetFont('Arial','',8);
			
			$i = 0;
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__contract_document';
			$datato['where'] = array(
				'patlog__contract.entity__contract_document.contract_id' => $R1->contract_id
			);
			$Q2 = $this->view->view_data($datato);
			foreach($Q2->result() as $R2){
				if($i%2 == 1){
					$line = 1;
				}else{
					$line = 0;
				}
				$pdf->SetTextColor(0, 0, 0);
				$pdf->Cell(90,5,$R2->contract_document_name,0,$line,'L');
				$i++;
			}
			
			$i = 0;
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__contract_attachment';
			$datato['where'] = array(
				'patlog__contract.entity__contract_attachment.contract_id' => $R1->contract_id
			);
			$Q2 = $this->view->view_data($datato);
			foreach($Q2->result() as $R2){
				if($i%2 == 1){
					$line = 1;
				}else{
					$line = 0;
				}
				$pdf->SetTextColor(0, 0, 0);
				$pdf->Cell(90,5,$R2->contract_attachment_name,0,$line,'L');
				$i++;
			}
			
			$pdf->Ln();
			
			$pdf->SetTextColor(0, 0, 0);
			$pdf->SetFont('Arial','B',8);	
			$pdf->Cell(60,5,'Layer Approval',0,1);
			
			$pdf->SetTextColor(0, 0, 0);
			$pdf->SetFont('Arial','B',8);
			$pdf->SetWidths(array(10,50,50,30));
			$pdf->SetAligns(array('C','L','C','C'));
			$arr_data = array(
				'No.',
				'Nama Pejabat',
				'Tanggal Approve',
				'TTD'
			);
			$pdf->Row($arr_data);
			
			$pdf->SetFont('Arial','',8);
			$i = 0;
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__contract_approval';
			$datato['where'] = array(
				'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
				'patlog__contract.entity__contract_approval.contract_approval_category' => 'Approver'
			);
			$Q2 = $this->view->view_data($datato);
			foreach($Q2->result() as $R2){
				$pdf->Cell(10,4,($i+1),'LTR',0,'C');
				$pdf->MultiCell(50,4,$R2->contract_approval_employee_name,'LR','L',false);
				$y = $pdf->getY();
				$pdf->setY($y - 4);
				$pdf->setX(75);
				if($R2->contract_approval_date != null){
					$contract_approval_date = $R2->contract_approval_date;
				}else{
					$contract_approval_date = '';
				}
				$pdf->MultiCell(50,5,$contract_approval_date,'LR','C',false);
				$y = $pdf->getY();
				$pdf->setY($y - 5);
				$pdf->setX(125);
				$pdf->Cell(30,4,'','LR',1,'C');
				
				$pdf->Cell(10,3,'','LR',0,'C');
				$pdf->SetFont('Arial','',6);
				$pdf->MultiCell(50,3,'('.$R2->contract_approval_employee_position_detail.')','LR','L',false);
				$pdf->SetFont('Arial','',8);
				$y = $pdf->getY();
				$pdf->setY($y - 5);
				$pdf->setX(75);
				$pdf->MultiCell(50,5,'','LR','C',false);
				$y = $pdf->getY();
				$pdf->setY($y - 6);
				$pdf->setX(125);
				$pdf->Cell(30,6,'','LR',1,'C');
				
				$pdf->Cell(10,4,'','LRB',0,'C');
				$pdf->MultiCell(50,4,'','LRB','L',false);
				$y = $pdf->getY();
				$pdf->setY($y - 5);
				$pdf->setX(75);
				$pdf->MultiCell(50,5,'','LRB','C',false);
				$y = $pdf->getY();
				$pdf->setY($y - 6);
				$pdf->setX(125);
				$pdf->Cell(30,6,'','LRB',1,'C');
				
				$y = $y - 10;
				if($R2->contract_approval_date != null){
					unset($datato);
					$datato['table'] = 'patlog__hrms.entity__employee_in';
					$datato['where'] = array(
						'patlog__hrms.entity__employee_in.employee_in_id' => $R2->contract_approval_employee_id
					);
					$Q3 = $this->view->view_data($datato);
					if($Q3->num_rows()){
						$R3 = $Q3->row();
						$employee_in_image_sign = $R3->employee_in_image_sign;
					}else{
						$employee_in_image_sign = 'no.jpg';
					}
					$pdf->Image(base_url('assets/mod__hrms/attach/image-sign/'.$employee_in_image_sign),128,$y,25,0,'JPG');
				}
				$i++;
			}
			
			$pdf->Ln(3);
			
			$pdf->SetFont('Arial','B',6);
			$pdf->MultiCell(180,3,'DOKUMEN INI SUDAH DISETUJUI SECARA ELEKTRONIK OLEH YANG BERSANGKUTAN',0,1,false);
			$pdf->SetFont('Arial','',6);
			$pdf->MultiCell(180,3,'"Bersama ini pemohon menyatakan bahwa transaksi yang diajukan ini benar dan absah untuk dibayar. Dokumen-dokumen terkait yang dilampirkan ini adalah dokumen asli dan otentik"',0,1,false);
			
			unset($datato);
			$datato['database'] = 'patlog__contract';
			$datato['table'] = 'entity__contract';
			$datato['contract_document_in'] = 'contract-document-in-'.md5($R1->contract_id).'.pdf';
			$datato['field'] = 'contract_id';
			$datato['id'] = $R1->contract_id;
			$this->mod->update($datato);
			
			if(strpos($_SERVER['REQUEST_URI'], 'erp') !== false){
				$host = '/erp/';
			}else{
				$host = '/';
			}
			$pdf->Output($_SERVER['DOCUMENT_ROOT'].$host.'assets/mod__contract/attach/document-contract-in/contract-document-in-'.md5($R1->contract_id).'.pdf', 'F');
			
			# Preview
			// $pdf->Output('preview.pdf','I');
		}
	}
	
	public function get_table_summary_contract_expired()
	{
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
		$datato['where'] = array(
			'patlog__hrms.entity__employee_in.employee_in_id' => base64_decode($this->session->userdata('employee_id'))
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$employee_in_id = $R1->employee_in_id;
			$division_id = $R1->division_id;
			$employee_in_position = $R1->employee_in_position;
		}else{
			$employee_in_id = null;
			$division_id = null;
			$employee_in_position = null;
		}
		
		$date_cut_off = date('Y-m-d', strtotime('+3 months'));
		
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__contract';
		$datato['where'] = array(
			'patlog__contract.entity__contract.contract_active_end_date <= ' => $date_cut_off,
			'patlog__contract.entity__contract.contract_status_delete' => 'no',
			'patlog__contract.entity__contract.contract_status_done' => 'yes'
		);
		if($division_id != $cog_division_id){
			if($employee_in_position != 'Direktur'){
				$arr_where = array(
					'patlog__contract.entity__contract.contract_creator_division_id' => $division_id
				);
				$datato['where'] = array_merge($arr_where, $datato['where']);
			}
		}
		$datato['column_order'] = array(
			'patlog__contract.entity__contract.contract_no',
			'patlog__contract.entity__contract.contract_creator_division_name',
			'patlog__contract.entity__contract.contract_request_name',
			'patlog__contract.entity__contract.contract_project_code_name',
			'patlog__contract.entity__contract.contract_company_name',
			'patlog__contract.entity__contract.contract_active_end_date',
			null
		);
		$datato['column_search'] = array(
			'patlog__contract.entity__contract.contract_no',
			'patlog__contract.entity__contract.contract_data_code',
			'patlog__contract.entity__contract.contract_project_code_name',
			'patlog__contract.entity__contract.contract_creator_division_name',
			'patlog__contract.entity__contract.contract_creator_employee_in_name',
			'patlog__contract.entity__contract.contract_request_name',
			'patlog__contract.entity__contract.contract_request_description_name',
			'patlog__contract.entity__contract.contract_third_party_name',
			'patlog__contract.entity__contract.contract_project_code_description',
			'patlog__contract.entity__contract.contract_project_currency',
			'patlog__contract.entity__contract.contract_project_cost',
			'patlog__contract.entity__contract.contract_company_name',
			'patlog__contract.entity__contract.contract_user_name'
		);
		$datato['order'] = array(
			'patlog__contract.entity__contract.contract_active_end_date' => 'desc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		foreach($Q1 as $R1){
			$encrypt_id = $this->encrypt->encode($R1->contract_id);
            $contract_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);

			$row = array();
			if($R1->contract_data_code != null){
				$contract_data_code = '
					Nomor PR<br/>
					<b>'.$R1->contract_data_code.'</b>
					<br/><br/>
				';
			}else{
				$contract_data_code = '';
			}
			$row[] = '
				<div class="text-left">
					Nomor SPPK<br/>
					<a target="_blank" href="'.site_url('module_contract/employee/arsip_kontrak_utama?view=preview&contract_id='.$contract_id).'">
						<b>'.$R1->contract_no.'</b>
					</a>
					<br/><br/>
					'.$contract_data_code.'
				</div>
			';
			$row[] = '
				<div class="text-left">
					Divisi :<br/>
					<b>'.$R1->contract_creator_division_name.'</b>
					<br/><br/>
					Nama :<br/>
					<b>'.$R1->contract_creator_employee_in_name.'</b>
					<br/><br/>
				</div>
			';
			$row[] = '
				<div class="text-left">
					Jenis :<br/>
					<b>'.$R1->contract_request_name.'</b>
					<br/><br/>
					Deskripsi :<br/>
					<b>'.$R1->contract_request_description_name.'</b>
					<br/><br/>
				</div>
			';
			$row[] = '
				<div class="text-left">
					<b>'.$R1->contract_project_code_name.'</b><br/>
					<small>'.$R1->contract_project_code_description.'</small>
					<br/><br/>
					Nominal :<br/>
					<b>'.$R1->contract_project_currency.'. '.$this->func_number_format($R1->contract_project_cost).'</b>
					<br/><br/>
				</div>
			';
			$row[] = '
				<div class="text-left">
					<label class="label label-info">'.strtoupper($R1->contract_third_party_name).'</label>
					<br/><br/>
					Nama Perusahaan<br/>
					<b>'.$R1->contract_company_name.'</b>
					<br/><br/>
					Penandatangan<br/>
					<b>'.$R1->contract_user_name.'</b>
				</div>
			';
			$row[] = $R1->contract_active_end_date;
			$now = strtotime(date('Y-m-d'));
			$end = strtotime($R1->contract_active_end_date);
			$days = ($end - $now) / (60 * 60 * 24);
			if($days > 0){
				$label = 'warning';
			}else{
				$label = 'danger';
			}
			$row[] = '<div class="badge badge-'.$label.'">'.$days.' Hari</div>';
			$data[] = $row;
		}

		$output = array(
			'draw' => $_POST['draw'],
			'recordsTotal' => $this->view->count_all($datato),
			'recordsFiltered' => $this->view->count_filtered($datato),
			'data' => $data,
		);
		echo json_encode($output);
	}
	
	public function get_table_dashboard_log()
	{
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
		$datato['where'] = array(
			'patlog__hrms.entity__employee_in.employee_in_id' => base64_decode($this->session->userdata('employee_id'))
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$employee_in_id = $R1->employee_in_id;
			$division_id = $R1->division_id;
			$employee_in_position = $R1->employee_in_position;
		}else{
			$employee_in_id = null;
			$division_id = null;
			$employee_in_position = null;
		}
		
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__contract';
		$datato['table_join'] = array(
			'patlog__contract.entity__contract_log'
		);
		$datato['table_join_on'] = array(
			'patlog__contract.entity__contract'
		);
		$datato['join_id'] = array(
			'contract_id'
		);
		$datato['join_type'] = array(
			'inner'
		);
		$datato['where'] = array(
			'YEAR(patlog__contract.entity__contract_log.contract_log_insert)' => $this->input->post('year'),
			'patlog__contract.entity__contract.contract_status_delete' => 'no',
			'patlog__contract.entity__contract.contract_status_done' => 'no'
		);
		if($this->input->post('month') != 'all'){
			$arr_where = array(
				'MONTH(patlog__contract.entity__contract_log.contract_log_insert)' => $this->input->post('month')
			);
			$datato['where'] = array_merge($arr_where, $datato['where']);
		}
		if($division_id != $cog_division_id){
			if($employee_in_position != 'Direktur'){
				$arr_where = array(
					'patlog__contract.entity__contract.contract_creator_division_id' => $division_id
				);
				$datato['where'] = array_merge($arr_where, $datato['where']);
			}
		}
		$datato['column_order'] = array(
			'patlog__contract.entity__contract.contract_no',
			'patlog__contract.entity__contract.contract_creator_division_name',
			'patlog__contract.entity__contract.contract_request_name',
			'patlog__contract.entity__contract.contract_project_code_name',
			'patlog__contract.entity__contract.contract_company_name',
			'patlog__contract.entity__contract_log.contract_log_employee_name',
			'patlog__contract.entity__contract_log.contract_log_insert'
		);
		$datato['column_search'] = array(
			'patlog__contract.entity__contract.contract_no',
			'patlog__contract.entity__contract.contract_data_code',
			'patlog__contract.entity__contract.contract_project_code_name',
			'patlog__contract.entity__contract.contract_creator_division_name',
			'patlog__contract.entity__contract.contract_creator_employee_in_name',
			'patlog__contract.entity__contract.contract_request_name',
			'patlog__contract.entity__contract.contract_request_description_name',
			'patlog__contract.entity__contract.contract_third_party_name',
			'patlog__contract.entity__contract.contract_project_code_description',
			'patlog__contract.entity__contract.contract_project_currency',
			'patlog__contract.entity__contract.contract_project_cost',
			'patlog__contract.entity__contract.contract_company_name',
			'patlog__contract.entity__contract.contract_user_name',
			'patlog__contract.entity__contract_log.contract_log_employee_name',
			'patlog__contract.entity__contract_log.contract_log_insert'
		);
		$datato['order'] = array(
			'patlog__contract.entity__contract_log.contract_log_insert' => 'desc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		foreach($Q1 as $R1){
			$encrypt_id = $this->encrypt->encode($R1->contract_id);
            $contract_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);

			$row = array();
			if($R1->contract_data_code != null){
				$contract_data_code = '
					Nomor PR<br/>
					<b>'.$R1->contract_data_code.'</b>
					<br/><br/>
				';
			}else{
				$contract_data_code = '';
			}
			$row[] = '
				<div class="text-left">
					Nomor SPPK<br/>
					<a target="_blank" href="'.site_url('module_contract/employee/proses_kontrak_utama?view=preview&contract_id='.$contract_id).'">
						<b>'.$R1->contract_no.'</b>
					</a>
					<br/><br/>
					'.$contract_data_code.'
				</div>
			';
			$row[] = '
				<div class="text-left">
					Divisi :<br/>
					<b>'.$R1->contract_creator_division_name.'</b>
					<br/><br/>
					Nama :<br/>
					<b>'.$R1->contract_creator_employee_in_name.'</b>
					<br/><br/>
				</div>
			';
			$row[] = '
				<div class="text-left">
					Jenis :<br/>
					<b>'.$R1->contract_request_name.'</b>
					<br/><br/>
					Deskripsi :<br/>
					<b>'.$R1->contract_request_description_name.'</b>
					<br/><br/>
				</div>
			';
			$row[] = '
				<div class="text-left">
					<b>'.$R1->contract_project_code_name.'</b><br/>
					<small>'.$R1->contract_project_code_description.'</small>
					<br/><br/>
					Nominal :<br/>
					<b>'.$R1->contract_project_currency.'. '.$this->func_number_format($R1->contract_project_cost).'</b>
					<br/><br/>
				</div>
			';
			$row[] = '
				<div class="text-left">
					<label class="label label-info">'.strtoupper($R1->contract_third_party_name).'</label>
					<br/><br/>
					Nama Perusahaan<br/>
					<b>'.$R1->contract_company_name.'</b>
					<br/><br/>
					Penandatangan<br/>
					<b>'.$R1->contract_user_name.'</b>
				</div>
			';
			if($R1->contract_log_status == 'Created' or $R1->contract_log_status == 'Editing' or $R1->contract_log_status == 'Processing'){
				$status = '<div class="badge badge-default">'.$R1->contract_log_status.'</div>';
			}elseif($R1->contract_log_status == 'Approved' or $R1->contract_log_status == 'Done'){
				$status = '<div class="badge navy-bg">'.$R1->contract_log_status.'</div>';
			}elseif($R1->contract_log_status == 'Rejected' or $R1->contract_log_status == 'Failed' or $R1->contract_log_status == 'Trash'){
				$status = '<div class="badge badge-danger">'.$R1->contract_log_status.'</div>';
			}elseif($R1->contract_log_status == 'Back'){
				$status = '<div class="badge badge-warning">'.$R1->contract_log_status.'</div>';
			}else{
				$status = '<div class="badge badge-default">'.$R1->contract_log_status.'</div>';
			}
			$information = '';
			if($R1->contract_log_message != '' and $R1->contract_log_message != null){
				$information = '
					<br/><br/>
					<b>Keterangan :</b> '.$R1->contract_log_message.'
				';
			}
			$row[] = '
				'.$status.' &bull; '.$R1->contract_log_employee_name.'
				<small>
					'.$information.'
				</small><br/>
			';
			$row[] = $R1->contract_log_insert;
			$data[] = $row;
		}

		$output = array(
			'draw' => $_POST['draw'],
			'recordsTotal' => $this->view->count_all($datato),
			'recordsFiltered' => $this->view->count_filtered($datato),
			'data' => $data,
		);
		echo json_encode($output);
	}
	
	public function get_table_process_contract_project()
	{
		$arr_date = array();
		unset($datato);
		$datato['table'] = 'patlog__value.entity__holiday';
		$Q1 = $this->view->view_data($datato);
		foreach($Q1->result() as $R1){
			$arr_date[] = $R1->holiday_date;
		}
		
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__cog';
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$cog_sla = $R1->cog_sla;
			$cog_functions_id = $R1->cog_functions_id;
		}else{
			$cog_sla = 0;
			$cog_functions_id = null;
		}
		
		unset($datato);
		$datato['table'] = 'patlog__hrms.entity__employee_in';	
		$datato['where'] = array(
			'patlog__hrms.entity__employee_in.employee_in_id' => base64_decode($this->session->userdata('employee_id'))
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$employee_in_id = $R1->employee_in_id;
			$functions_id = $R1->functions_id;
		}else{
			$employee_in_id = null;
			$functions_id = null;
		}
	
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__contract';
		if($cog_functions_id == $functions_id){
			$where = '
				patlog__contract.entity__contract.contract_status_delete = "no" AND 
				patlog__contract.entity__contract.contract_status_done = "no" AND 
				(patlog__contract.entity__contract.contract_approval_current_category = "Loket" OR 
				patlog__contract.entity__contract.contract_approval_current_id = '.$employee_in_id.')
			';
		}else{
			$where = '
				patlog__contract.entity__contract.contract_status_delete = "no" AND 
				patlog__contract.entity__contract.contract_status_done = "no" AND 
				(patlog__contract.entity__contract.contract_creator_employee_in_id = '.$employee_in_id.' OR 
				patlog__contract.entity__contract.contract_approval_current_id = '.$employee_in_id.')
			';
		}
		$datato['where'] = $where;
		$datato['column_order'] = array(
			'patlog__contract.entity__contract.contract_no',
			'patlog__contract.entity__contract.contract_creator_employee_in_name',
			'patlog__contract.entity__contract.contract_request_name',
			'patlog__contract.entity__contract.contract_project_code_description',
			'patlog__contract.entity__contract.contract_third_party_name',
			'patlog__contract.entity__contract.contract_active_start_date',
			null,
			'patlog__contract.entity__contract.contract_update',
			null
		);
		$datato['column_search'] = array(
			'patlog__contract.entity__contract.contract_no',
			'patlog__contract.entity__contract.contract_data_code',
			'patlog__contract.entity__contract.contract_project_code_name',
			'patlog__contract.entity__contract.contract_creator_division_name',
			'patlog__contract.entity__contract.contract_creator_employee_in_name',
			'patlog__contract.entity__contract.contract_request_name',
			'patlog__contract.entity__contract.contract_request_description_name',
			'patlog__contract.entity__contract.contract_third_party_name',
			'patlog__contract.entity__contract.contract_project_code_description',
			'patlog__contract.entity__contract.contract_project_currency',
			'patlog__contract.entity__contract.contract_project_cost',
			'patlog__contract.entity__contract.contract_company_name',
			'patlog__contract.entity__contract.contract_user_name',
			'patlog__contract.entity__contract.contract_active_start_date',
			'patlog__contract.entity__contract.contract_active_end_date',
			'patlog__contract.entity__contract.contract_no_fix',
			'patlog__contract.entity__contract.contract_approver_message',
		);
		$datato['order'] = array(
			'patlog__contract.entity__contract.contract_id' => 'desc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		foreach($Q1 as $R1){
			$encrypt_id = $this->encrypt->encode($R1->contract_id);
            $contract_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);

			$row = array();
			if($R1->contract_date_loket == null){
				$loket = '<b>-</b>';
			}else{
				$day = 0;
				$period = new DatePeriod(
					new DateTime($R1->contract_date_loket),
					new DateInterval('P1D'),
					new DateTime(date('Y-m-d'))
				);
				foreach($period as $key => $value){
					if(!in_array($value->format('Y-m-d'), $arr_date)){
						$day = $day + 1;
					}
				}
				if($day > $cog_sla){
					$label = 'danger';
				}else{
					$label = 'primary';
				}
				$loket = '<b>'.$R1->contract_date_loket.'</b><br/><span class="badge badge-'.$label.'">'.$day.' hari</span>';
			}
			if($R1->contract_data_code != null){
				$contract_data_code = '
					Nomor PR<br/>
					<b>'.$R1->contract_data_code.'</b>
					<br/><br/>
				';
			}else{
				$contract_data_code = '';
			}
			$row[] = '
				<div class="text-left">
					Nomor SPPK<br/>
					<b>'.$R1->contract_no.'</b>
					<br/><br/>
					'.$contract_data_code.'
					SLA Loket<br/>
					'.$loket.'
				</div>
			';
			$row[] = '
				<div class="text-left">
					Divisi :<br/>
					<b>'.$R1->contract_creator_division_name.'</b>
					<br/><br/>
					Nama :<br/>
					<b>'.$R1->contract_creator_employee_in_name.'</b>
					<br/><br/>
				</div>
			';
			$row[] = '
				<div class="text-left">
					Jenis :<br/>
					<b>'.$R1->contract_request_name.'</b>
					<br/><br/>
					Deskripsi :<br/>
					<b>'.$R1->contract_request_description_name.'</b>
					<br/><br/>
				</div>
			';
			$row[] = '
				<div class="text-left">
					<b>'.$R1->contract_project_code_name.'</b><br/>
					<small>'.$R1->contract_project_code_description.'</small>
					<br/><br/>
					Nominal :<br/>
					<b>'.$R1->contract_project_currency.'. '.$this->func_number_format($R1->contract_project_cost).'</b>
					<br/><br/>
				</div>
			';
			$row[] = '
				<div class="text-left">
					<label class="label label-info">'.strtoupper($R1->contract_third_party_name).'</label>
					<br/><br/>
					Nama Perusahaan<br/>
					<b>'.$R1->contract_company_name.'</b>
					<br/><br/>
					Penandatangan<br/>
					<b>'.$R1->contract_user_name.'</b>
				</div>
			';
			if($R1->contract_active_start_date == null){
				$row[] = '
					<div class="text-center">
						Belum ditentukan
					</div>
				';
			}else{
				$row[] = '
					<div class="text-center">
						'.$R1->contract_active_start_date.'<br/>
						<i class="fa fa-arrow-down"></i><br/>
						'.$R1->contract_active_end_date.'
					</div>
				';
			}
			$arr_document = array();
			if($R1->contract_summary_file_name != 'no.pdf'){
				$file = '
					<a class="btn btn-xs btn-default" href="'.base_url('assets/mod__contract/attach/document-contract-summary/'.$R1->contract_summary_file_name.'?time='.date('YmdHis')).'" target="_blank">
						<i class="fa fa-eye"></i>
					</a>
				';
				$arr_document[] = '<small>Review Dokumen Kontrak</small> - '.$file;
			}
			if($R1->contract_summary_file_ttd != 'no.pdf'){
				$file = '
					<a class="btn btn-xs btn-default" href="'.base_url('assets/mod__contract/attach/document-contract-summary-ttd/'.$R1->contract_summary_file_ttd.'?time='.date('YmdHis')).'" target="_blank">
						<i class="fa fa-eye"></i>
					</a>
				';
				$arr_document[] = '<small>Kontrak TTD</small> - '.$file;
				$arr_document[] = '<small class="font-bold text-success">'.$R1->contract_ttd_sign_type.'</small>';
			}
			if($R1->contract_no_fix != null){
				$arr_document[] = '<small>Nomor Kontrak :<br/><b>'.$R1->contract_no_fix.'</b></small>';
			}
			if(count($arr_document) > 0){
				$row[] = implode('<br/>', $arr_document);
			}else{
				$row[] = 'Belum ada proses';
			}
			$message = '';
			if($R1->contract_approver_level == 0){
				$message = 'Direject';
			}else{
				unset($datato2);
				$datato2['table'] = 'patlog__contract.entity__contract_approval';
				$datato2['where'] = array(
					'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
					'patlog__contract.entity__contract_approval.contract_approval_status is null' => null
				);
				$datato2['order'] = array(
					'patlog__contract.entity__contract_approval.contract_approval_level'
				);
				$datato2['order_type'] = array(
					'asc'
				);
				$Q2 = $this->view->view_data($datato2);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					if($R2->contract_approval_category == 'Drafter'){
						$message = 'Menunggu Proses Drafting '.$R2->contract_approval_employee_name;
					}else{
						$message = 'Menunggu Approval '.$R2->contract_approval_employee_name;
					}
				}else{
					$message = 'Selesai';
				}
			}
			$information = '';
			unset($datato2);
			$datato2['table'] = 'patlog__contract.entity__contract_log';
			$datato2['where'] = array(
				'patlog__contract.entity__contract_log.contract_id' => $R1->contract_id
			);
			$datato2['order'] = array(
				'patlog__contract.entity__contract_log.contract_log_approver_level'
			);
			$datato2['order_type'] = array(
				'desc'
			);
			$Q2 = $this->view->view_data($datato2);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				if($R2->contract_log_message != '' and $R2->contract_log_message != null){
					$information = '
						<br/>
						<b>Keterangan :</b> '.$R2->contract_log_message.'
					';
				}
			}
			if($R1->contract_update != null){
				$last_date = '<br/><br/>Terakhir diperbarui :<br/><b>'.$R1->contract_update.'</b>';
			}else{
				$last_date = '';
			}
			$row[] = '
				'.$R1->contract_approver_message.'<br/><br/>
				<small>
					'.$message.'
					'.$information.'
					'.$last_date.'
				</small><br/>
			';
			$view = '
				<a class="btn btn-sm btn-default" target="_blank" href="'.site_url('module_contract/employee/proses_kontrak_utama?view=preview&contract_id='.$contract_id).'">
					<i class="fa fa-eye"></i>
				</a>
			';
			$print = '
				<a class="btn btn-sm btn-default" target="_blank" href="'.base_url('assets/mod__contract/attach/document-contract-in/'.$R1->contract_document_in.'?time='.date('YmdHis')).'">
					<i class="fa fa-print"></i>
				</a>
			';
			if($R1->contract_approver_level == 0){
				$approval = '';
			}else{
				if($employee_in_id == $R1->contract_approval_current_id or $cog_functions_id == $functions_id){
					$approval = '
						<a class="btn btn-sm btn-primary" target="_blank" href="'.site_url('module_contract/employee/proses_kontrak_utama?view=approval&contract_id='.$contract_id).'">
							<i class="fa fa-check"></i>
						</a>
					';
				}else{
					$approval = '';
				}
			}
			$edit = '';
			if($R1->contract_approver_level < 2){
				if($R1->contract_data_id == null){
					$edit = '
						<a class="btn btn-sm btn-info" target="_blank" href="'.site_url('module_contract/employee/proses_kontrak_utama?view=manipulation&action=edit&contract_id='.$contract_id).'">
							<i class="fa fa-edit"></i>
						</a>
					';
				}
				if($employee_in_id == $R1->contract_creator_employee_in_id and $R1->contract_data_id == null){
					$delete = '
						<a class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#confirm" id="delete_'.$contract_id.'">
							<i class="fa fa-trash"></i>
						</a>
					';
				}else{
					$delete = '';
				}
			}else{
				$delete = '';
			}
			$row[] = '
				<div class="text-center">
					'.$view.'
					'.$print.'
					'.$approval.'
					'.$edit.'
					'.$delete.'
				</div>
			';
			
			$data[] = $row;
		}

		$output = array(
			'draw' => $_POST['draw'],
			'recordsTotal' => $this->view->count_all($datato),
			'recordsFiltered' => $this->view->count_filtered($datato),
			'data' => $data,
		);
		echo json_encode($output);
	}
	
	public function get_table_monitoring()
	{
		$arr_date = array();
		unset($datato);
		$datato['table'] = 'patlog__value.entity__holiday';
		$Q1 = $this->view->view_data($datato);
		foreach($Q1->result() as $R1){
			$arr_date[] = $R1->holiday_date;
		}
		
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__cog';
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$cog_division_id = $R1->cog_division_id;
			$cog_sla = $R1->cog_sla;
		}else{
			$cog_division_id = null;
			$cog_sla = 0;
		}
		
		unset($datato);
		$datato['table'] = 'patlog__hrms.entity__employee_in';
		$datato['table_join'] = array(
			'patlog__hrms.entity__division'
		);
		$datato['table_join_on'] = array(
			'patlog__hrms.entity__employee_in'
		);
		$datato['join_id'] = array(
			'division_id'
		);
		$datato['join_type'] = array(
			'inner'
		);
		$datato['where'] = array(
			'patlog__hrms.entity__employee_in.employee_in_id' => base64_decode($this->session->userdata('employee_id'))
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$employee_in_id = $R1->employee_in_id;
			$employee_in_position = $R1->employee_in_position;
			$division_id = $R1->division_id;
			$division_type = $R1->division_type;
		}else{
			$employee_in_id = null;
			$employee_in_position = null;
			$division_id = null;
			$division_type = null;
		}
		
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__contract';
		if($division_id == $cog_division_id or $employee_in_position == 'Vice President' or $employee_in_position == 'Direktur'){
			$datato['where'] = array(
				'patlog__contract.entity__contract.contract_status_delete' => 'no',
				'patlog__contract.entity__contract.contract_status_done' => 'no'
			);
		}else{
			if($division_type == 'Other'){
				$datato['where'] = array(
					'patlog__contract.entity__contract.contract_status_delete' => 'no',
					'patlog__contract.entity__contract.contract_status_done' => 'no'
				);
			}else{
				$datato['table_join'] = array(
					'patlog__contract.entity__contract_approval'
				);
				$datato['table_join_on'] = array(
					'patlog__contract.entity__contract'
				);
				$datato['join_id'] = array(
					'contract_id'
				);
				$datato['join_type'] = array(
					'inner'
				);
				$where = '
					patlog__contract.entity__contract.contract_status_delete = "no" AND 
					patlog__contract.entity__contract.contract_status_done = "no" AND 
					(patlog__contract.entity__contract.contract_creator_division_id = '.$division_id.' OR 
					(patlog__contract.entity__contract_approval.contract_approval_employee_id = '.$employee_in_id.' AND 
					patlog__contract.entity__contract_approval.contract_approval_status = "Approve"))
				';
				$datato['where'] = $where;
				$datato['group'] = array(
					'patlog__contract.entity__contract_approval.contract_id'
				);
			}
		}
		$datato['column_order'] = array(
			'patlog__contract.entity__contract.contract_no',
			'patlog__contract.entity__contract.contract_creator_employee_in_name',
			'patlog__contract.entity__contract.contract_request_name',
			'patlog__contract.entity__contract.contract_project_code_description',
			'patlog__contract.entity__contract.contract_third_party_name',
			'patlog__contract.entity__contract.contract_active_start_date',
			null,
			'patlog__contract.entity__contract.contract_update',
			null
		);
		$datato['column_search'] = array(
			'patlog__contract.entity__contract.contract_no',
			'patlog__contract.entity__contract.contract_data_code',
			'patlog__contract.entity__contract.contract_project_code_name',
			'patlog__contract.entity__contract.contract_creator_division_name',
			'patlog__contract.entity__contract.contract_creator_employee_in_name',
			'patlog__contract.entity__contract.contract_request_name',
			'patlog__contract.entity__contract.contract_request_description_name',
			'patlog__contract.entity__contract.contract_third_party_name',
			'patlog__contract.entity__contract.contract_project_code_description',
			'patlog__contract.entity__contract.contract_project_currency',
			'patlog__contract.entity__contract.contract_project_cost',
			'patlog__contract.entity__contract.contract_company_name',
			'patlog__contract.entity__contract.contract_user_name',
			'patlog__contract.entity__contract.contract_active_start_date',
			'patlog__contract.entity__contract.contract_active_end_date',
			'patlog__contract.entity__contract.contract_no_fix',
			'patlog__contract.entity__contract.contract_approver_message',
		);
		$datato['order'] = array(
			'patlog__contract.entity__contract.contract_id' => 'desc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		foreach($Q1 as $R1){
			$encrypt_id = $this->encrypt->encode($R1->contract_id);
            $contract_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);

			$row = array();
			if($R1->contract_date_loket == null){
				$loket = '<b>-</b>';
			}else{
				$day = 0;
				$period = new DatePeriod(
					new DateTime($R1->contract_date_loket),
					new DateInterval('P1D'),
					new DateTime(date('Y-m-d'))
				);
				foreach($period as $key => $value){
					if(!in_array($value->format('Y-m-d'), $arr_date)){
						$day = $day + 1;
					}
				}
				if($day > $cog_sla){
					$label = 'danger';
				}else{
					$label = 'primary';
				}
				$loket = '<b>'.$R1->contract_date_loket.'</b><br/><span class="badge badge-'.$label.'">'.$day.' hari</span>';
			}
			if($R1->contract_data_code != null){
				$contract_data_code = '
					Nomor PR<br/>
					<b>'.$R1->contract_data_code.'</b>
					<br/><br/>
				';
			}else{
				$contract_data_code = '';
			}
			$row[] = '
				<div class="text-left">
					Nomor SPPK<br/>
					<b>'.$R1->contract_no.'</b>
					<br/><br/>
					'.$contract_data_code.'
					SLA Loket<br/>
					'.$loket.'
				</div>
			';
			$row[] = '
				<div class="text-left">
					Divisi :<br/>
					<b>'.$R1->contract_creator_division_name.'</b>
					<br/><br/>
					Nama :<br/>
					<b>'.$R1->contract_creator_employee_in_name.'</b>
					<br/><br/>
				</div>
			';
			$row[] = '
				<div class="text-left">
					Jenis :<br/>
					<b>'.$R1->contract_request_name.'</b>
					<br/><br/>
					Deskripsi :<br/>
					<b>'.$R1->contract_request_description_name.'</b>
					<br/><br/>
				</div>
			';
			$row[] = '
				<div class="text-left">
					<b>'.$R1->contract_project_code_name.'</b><br/>
					<small>'.$R1->contract_project_code_description.'</small>
					<br/><br/>
					Nominal :<br/>
					<b>'.$R1->contract_project_currency.'. '.$this->func_number_format($R1->contract_project_cost).'</b>
					<br/><br/>
				</div>
			';
			$row[] = '
				<div class="text-left">
					<label class="label label-info">'.strtoupper($R1->contract_third_party_name).'</label>
					<br/><br/>
					Nama Perusahaan<br/>
					<b>'.$R1->contract_company_name.'</b>
					<br/><br/>
					Penandatangan<br/>
					<b>'.$R1->contract_user_name.'</b>
				</div>
			';
			if($R1->contract_active_start_date == null){
				$row[] = '
					<div class="text-center">
						Belum ditentukan
					</div>
				';
			}else{
				$row[] = '
					<div class="text-center">
						'.$R1->contract_active_start_date.'<br/>
						<i class="fa fa-arrow-down"></i><br/>
						'.$R1->contract_active_end_date.'
					</div>
				';
			}
			$arr_document = array();
			if($R1->contract_summary_file_name != 'no.pdf'){
				$file = '
					<a class="btn btn-xs btn-default" href="'.base_url('assets/mod__contract/attach/document-contract-summary/'.$R1->contract_summary_file_name.'?time='.date('YmdHis')).'" target="_blank">
						<i class="fa fa-eye"></i>
					</a>
				';
				$arr_document[] = '<small>Review Dokumen Kontrak</small> - '.$file;
			}
			if($R1->contract_summary_file_ttd != 'no.pdf'){
				$file = '
					<a class="btn btn-xs btn-default" href="'.base_url('assets/mod__contract/attach/document-contract-summary-ttd/'.$R1->contract_summary_file_ttd.'?time='.date('YmdHis')).'" target="_blank">
						<i class="fa fa-eye"></i>
					</a>
				';
				$arr_document[] = '<small>Kontrak TTD</small> - '.$file;
				$arr_document[] = '<small class="font-bold text-success">'.$R1->contract_ttd_sign_type.'</small>';
			}
			if($R1->contract_no_fix != null){
				$arr_document[] = '<small>Nomor Kontrak :<br/><b>'.$R1->contract_no_fix.'</b></small>';
			}
			if(count($arr_document) > 0){
				$row[] = implode('<br/>', $arr_document);
			}else{
				$row[] = 'Belum ada proses';
			}
			$message = '';
			if($R1->contract_approver_level == 0){
				$message = 'Direject';
			}else{
				unset($datato2);
				$datato2['table'] = 'patlog__contract.entity__contract_approval';
				$datato2['where'] = array(
					'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
					'patlog__contract.entity__contract_approval.contract_approval_status is null' => null
				);
				$datato2['order'] = array(
					'patlog__contract.entity__contract_approval.contract_approval_level'
				);
				$datato2['order_type'] = array(
					'asc'
				);
				$Q2 = $this->view->view_data($datato2);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					if($R2->contract_approval_category == 'Drafter'){
						$message = 'Menunggu Proses Drafting '.$R2->contract_approval_employee_name;
					}else{
						$message = 'Menunggu Approval '.$R2->contract_approval_employee_name;
					}
				}else{
					$message = 'Selesai';
				}
			}
			$information = '';
			unset($datato2);
			$datato2['table'] = 'patlog__contract.entity__contract_log';
			$datato2['where'] = array(
				'patlog__contract.entity__contract_log.contract_id' => $R1->contract_id
			);
			$datato2['order'] = array(
				'patlog__contract.entity__contract_log.contract_log_approver_level'
			);
			$datato2['order_type'] = array(
				'desc'
			);
			$Q2 = $this->view->view_data($datato2);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				if($R2->contract_log_message != '' and $R2->contract_log_message != null){
					$information = '
						<br/>
						<b>Keterangan :</b> '.$R2->contract_log_message.'
					';
				}
			}
			if($R1->contract_update != null){
				$last_date = '<br/><br/>Terakhir diperbarui :<br/><b>'.$R1->contract_update.'</b>';
			}else{
				$last_date = '';
			}
			$row[] = '
				'.$R1->contract_approver_message.'<br/><br/>
				<small>
					'.$message.'
					'.$information.'
					'.$last_date.'
				</small><br/>
			';
			$row[] = '
				<div class="text-center">
					<a class="btn btn-sm btn-default" target="_blank" href="'.site_url('module_contract/employee/monitoring?view=preview&contract_id='.$contract_id).'">
						<i class="fa fa-eye"></i>
					</a>
					<a class="btn btn-sm btn-default" target="_blank" href="'.base_url('assets/mod__contract/attach/document-contract-in/'.$R1->contract_document_in.'?time='.date('YmdHis')).'">
						<i class="fa fa-print"></i>
					</a>
				</div>
			';
			$data[] = $row;
		}

		$output = array(
			'draw' => $_POST['draw'],
			'recordsTotal' => $this->view->count_all($datato),
			'recordsFiltered' => $this->view->count_filtered($datato),
			'data' => $data,
		);
		echo json_encode($output);
	}
	
	public function get_table_archive_contract_project()
	{
		$arr_date = array();
		unset($datato);
		$datato['table'] = 'patlog__value.entity__holiday';
		$Q1 = $this->view->view_data($datato);
		foreach($Q1->result() as $R1){
			$arr_date[] = $R1->holiday_date;
		}
		
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__cog';
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$cog_division_id = $R1->cog_division_id;
			$cog_sla = $R1->cog_sla;
		}else{
			$cog_division_id = null;
			$cog_sla = 0;
		}
		
		unset($datato);
		$datato['table'] = 'patlog__hrms.entity__employee_in';
		$datato['table_join'] = array(
			'patlog__hrms.entity__division'
		);
		$datato['table_join_on'] = array(
			'patlog__hrms.entity__employee_in'
		);
		$datato['join_id'] = array(
			'division_id'
		);
		$datato['join_type'] = array(
			'inner'
		);
		$datato['where'] = array(
			'patlog__hrms.entity__employee_in.employee_in_id' => base64_decode($this->session->userdata('employee_id'))
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$employee_in_id = $R1->employee_in_id;
			$employee_in_position = $R1->employee_in_position;
			$division_id = $R1->division_id;
			$division_type = $R1->division_id;
		}else{
			$employee_in_id = null;
			$employee_in_position = null;
			$division_id = null;
			$division_type = null;
		}
		
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__contract';
		if($division_id == $cog_division_id or $employee_in_position == 'Vice President' or $employee_in_position == 'Direktur'){
			$datato['where'] = array(
				'patlog__contract.entity__contract.contract_status_delete' => 'no',
				'patlog__contract.entity__contract.contract_status_done' => 'yes'
			);
		}else{
			if($division_type == 'Other'){
				$datato['where'] = array(
					'patlog__contract.entity__contract.contract_status_delete' => 'no',
					'patlog__contract.entity__contract.contract_status_done' => 'yes'
				);
			}else{
				$datato['table_join'] = array(
					'patlog__contract.entity__contract_approval'
				);
				$datato['table_join_on'] = array(
					'patlog__contract.entity__contract'
				);
				$datato['join_id'] = array(
					'contract_id'
				);
				$datato['join_type'] = array(
					'inner'
				);
				$where = '
					patlog__contract.entity__contract.contract_status_delete = "no" AND 
					patlog__contract.entity__contract.contract_status_done = "yes" AND 
					((patlog__contract.entity__contract.contract_creator_division_id = '.$division_id.') OR 
					(patlog__contract.entity__contract_approval.contract_approval_employee_id = '.$employee_in_id.' AND 
					patlog__contract.entity__contract_approval.contract_approval_status = "Approve"))
				';
				$datato['where'] = $where;
				$datato['group'] = array(
					'patlog__contract.entity__contract_approval.contract_id'
				);
			}
		}
		$datato['column_order'] = array(
			'patlog__contract.entity__contract.contract_no',
			'patlog__contract.entity__contract.contract_creator_employee_in_name',
			'patlog__contract.entity__contract.contract_request_name',
			'patlog__contract.entity__contract.contract_project_code_description',
			'patlog__contract.entity__contract.contract_third_party_name',
			'patlog__contract.entity__contract.contract_active_start_date',
			null,
			'patlog__contract.entity__contract.contract_update',
			null
		);
		$datato['column_search'] = array(
			'patlog__contract.entity__contract.contract_no',
			'patlog__contract.entity__contract.contract_data_code',
			'patlog__contract.entity__contract.contract_project_code_name',
			'patlog__contract.entity__contract.contract_creator_division_name',
			'patlog__contract.entity__contract.contract_creator_employee_in_name',
			'patlog__contract.entity__contract.contract_request_name',
			'patlog__contract.entity__contract.contract_request_description_name',
			'patlog__contract.entity__contract.contract_third_party_name',
			'patlog__contract.entity__contract.contract_project_code_description',
			'patlog__contract.entity__contract.contract_project_currency',
			'patlog__contract.entity__contract.contract_project_cost',
			'patlog__contract.entity__contract.contract_company_name',
			'patlog__contract.entity__contract.contract_user_name',
			'patlog__contract.entity__contract.contract_active_start_date',
			'patlog__contract.entity__contract.contract_active_end_date',
			'patlog__contract.entity__contract.contract_no_fix',
			'patlog__contract.entity__contract.contract_approver_message',
		);
		$datato['order'] = array(
			'patlog__contract.entity__contract.contract_id' => 'desc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		foreach($Q1 as $R1){
			$encrypt_id = $this->encrypt->encode($R1->contract_id);
            $contract_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);

			$row = array();
			if($R1->contract_date_loket == null){
				$loket = '<b>-</b>';
			}else{
				$day = 0;
				$period = new DatePeriod(
					new DateTime($R1->contract_date_loket),
					new DateInterval('P1D'),
					new DateTime($R1->contract_date_close)
				);
				foreach($period as $key => $value){
					if(!in_array($value->format('Y-m-d'), $arr_date)){
						$day = $day + 1;
					}
				}
				if($day > $cog_sla){
					$label = 'danger';
				}else{
					$label = 'primary';
				}
				$loket = '<b>'.$R1->contract_date_loket.'</b><br/><span class="badge badge-'.$label.'">'.$day.' hari</span>';
			}
			if($R1->contract_data_code != null){
				$contract_data_code = '
					Nomor PR<br/>
					<b>'.$R1->contract_data_code.'</b>
					<br/><br/>
				';
			}else{
				$contract_data_code = '';
			}
			$row[] = '
				<div class="text-left">
					Nomor SPPK<br/>
					<b>'.$R1->contract_no.'</b>
					<br/><br/>
					'.$contract_data_code.'
					SLA Loket<br/>
					'.$loket.'
				</div>
			';
			$row[] = '
				<div class="text-left">
					Divisi :<br/>
					<b>'.$R1->contract_creator_division_name.'</b>
					<br/><br/>
					Nama :<br/>
					<b>'.$R1->contract_creator_employee_in_name.'</b>
					<br/><br/>
				</div>
			';
			$row[] = '
				<div class="text-left">
					Jenis :<br/>
					<b>'.$R1->contract_request_name.'</b>
					<br/><br/>
					Deskripsi :<br/>
					<b>'.$R1->contract_request_description_name.'</b>
					<br/><br/>
				</div>
			';
			$row[] = '
				<div class="text-left">
					<b>'.$R1->contract_project_code_name.'</b><br/>
					<small>'.$R1->contract_project_code_description.'</small>
					<br/><br/>
					Nominal :<br/>
					<b>'.$R1->contract_project_currency.'. '.$this->func_number_format($R1->contract_project_cost).'</b>
					<br/><br/>
				</div>
			';
			$row[] = '
				<div class="text-left">
					<label class="label label-info">'.strtoupper($R1->contract_third_party_name).'</label>
					<br/><br/>
					Nama Perusahaan<br/>
					<b>'.$R1->contract_company_name.'</b>
					<br/><br/>
					Penandatangan<br/>
					<b>'.$R1->contract_user_name.'</b>
				</div>
			';
			if($R1->contract_active_start_date == null){
				$row[] = '
					<div class="text-center">
						Belum ditentukan
					</div>
				';
			}else{
				$row[] = '
					<div class="text-center">
						'.$R1->contract_active_start_date.'<br/>
						<i class="fa fa-arrow-down"></i><br/>
						'.$R1->contract_active_end_date.'
					</div>
				';
			}
			$arr_document = array();
			if($R1->contract_summary_file_name != 'no.pdf'){
				$file = '
					<a class="btn btn-xs btn-default" href="'.base_url('assets/mod__contract/attach/document-contract-summary/'.$R1->contract_summary_file_name.'?time='.date('YmdHis')).'" target="_blank">
						<i class="fa fa-eye"></i>
					</a>
				';
				$arr_document[] = '<small>Review Dokumen Kontrak</small> - '.$file;
			}
			if($R1->contract_summary_file_ttd != 'no.pdf'){
				$file = '
					<a class="btn btn-xs btn-default" href="'.base_url('assets/mod__contract/attach/document-contract-summary-ttd/'.$R1->contract_summary_file_ttd.'?time='.date('YmdHis')).'" target="_blank">
						<i class="fa fa-eye"></i>
					</a>
				';
				$arr_document[] = '<small>Kontrak TTD</small> - '.$file;
				$arr_document[] = '<small class="font-bold text-success">'.$R1->contract_ttd_sign_type.'</small>';
			}
			if($R1->contract_summary_file_final != 'no.pdf'){
				$file = '
					<a class="btn btn-xs btn-default" href="'.base_url('assets/mod__contract/attach/document-contract-summary-final/'.$R1->contract_summary_file_final.'?time='.date('YmdHis')).'" target="_blank">
						<i class="fa fa-eye"></i>
					</a>
				';
				$arr_document[] = '<small class="badge badge-primary">Kontrak Final</small> - '.$file;
			}
			if($R1->contract_no_fix != null){
				$arr_document[] = '<small>Nomor Kontrak :<br/><b>'.$R1->contract_no_fix.'</b></small>';
			}
			if(count($arr_document) > 0){
				$row[] = implode('<br/>', $arr_document);
			}else{
				$row[] = 'Belum ada proses';
			}
			$message = '';
			if($R1->contract_approver_level == 0){
				$message = 'Direject';
			}else{
				unset($datato2);
				$datato2['table'] = 'patlog__contract.entity__contract_approval';
				$datato2['where'] = array(
					'patlog__contract.entity__contract_approval.contract_id' => $R1->contract_id,
					'patlog__contract.entity__contract_approval.contract_approval_status is null' => null
				);
				$datato2['order'] = array(
					'patlog__contract.entity__contract_approval.contract_approval_level'
				);
				$datato2['order_type'] = array(
					'asc'
				);
				$Q2 = $this->view->view_data($datato2);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					if($R2->contract_approval_category == 'Drafter'){
						$message = 'Menunggu Proses Drafting '.$R2->contract_approval_employee_name;
					}else{
						$message = 'Menunggu Approval '.$R2->contract_approval_employee_name;
					}
				}else{
					$message = 'Selesai';
				}
			}
			$information = '';
			unset($datato2);
			$datato2['table'] = 'patlog__contract.entity__contract_log';
			$datato2['where'] = array(
				'patlog__contract.entity__contract_log.contract_id' => $R1->contract_id
			);
			$datato2['order'] = array(
				'patlog__contract.entity__contract_log.contract_log_approver_level'
			);
			$datato2['order_type'] = array(
				'desc'
			);
			$Q2 = $this->view->view_data($datato2);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				if($R2->contract_log_message != '' and $R2->contract_log_message != null){
					$information = '
						<br/>
						<b>Keterangan :</b> '.$R2->contract_log_message.'
					';
				}
			}
			if($R1->contract_update != null){
				$last_date = '<br/><br/>Terakhir diperbarui :<br/><b>'.$R1->contract_update.'</b>';
			}else{
				$last_date = '';
			}
			$row[] = '
				'.$R1->contract_approver_message.'<br/><br/>
				<small>
					'.$message.'
					'.$information.'
					'.$last_date.'
				</small><br/>
			';
			$view = '
				<a class="btn btn-sm btn-default" target="_blank" href="'.site_url('module_contract/employee/arsip_kontrak_utama?view=preview&contract_id='.$contract_id).'">
					<i class="fa fa-eye"></i>
				</a>
			';
			$print = '
				<a class="btn btn-sm btn-default" target="_blank" href="'.base_url('assets/mod__contract/attach/document-contract-in/'.$R1->contract_document_in.'?time='.date('YmdHis')).'">
					<i class="fa fa-print"></i>
				</a>
			';
			$file = '
				<a class="btn btn-sm btn-default" target="_blank" href="'.base_url('assets/mod__contract/attach/document-contract-summary-final/'.$R1->contract_summary_file_final.'?time='.date('YmdHis')).'">
					<i class="fa fa-file"></i>
				</a>
			';
			$row[] = '
				<div class="text-center">
					'.$view.'
					'.$print.'
					'.$file.'
				</div>
			';
			
			$data[] = $row;
		}

		$output = array(
			'draw' => $_POST['draw'],
			'recordsTotal' => $this->view->count_all($datato),
			'recordsFiltered' => $this->view->count_filtered($datato),
			'data' => $data,
		);
		echo json_encode($output);
	}
	
	public function get_table_process()
	{	
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__process';
		$datato['column_order'] = array(
			'patlog__contract.entity__process.process_name',
			'patlog__contract.entity__process.process_attachment_status',
			'patlog__contract.entity__process.process_flow',
			null
		);
		$datato['column_search'] = array(
			'patlog__contract.entity__process.process_name',
			'patlog__contract.entity__process.process_attachment_status',
			'patlog__contract.entity__process.process_flow'
		);
		$datato['order'] = array(
			'patlog__contract.entity__process.process_name' => 'asc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		foreach($Q1 as $R1){
			# Encrypt ID
			$encrypt_id = $this->encrypt->encode($R1->process_id);
			$process_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);

			$row = array();
			$row[] = $R1->process_name;
			$row[] = $R1->process_attachment_status;
			$row[] = $R1->process_flow;
			$row[] = '
				<div class="text-center">
					<a class="btn btn-sm btn-default" href="'.site_url('module_contract/employee/data_proses?view=preview&process_id='.$process_id).'">
						<i class="fa fa-eye"></i>
					</a>
					<a class="btn btn-sm btn-info" href="'.site_url('module_contract/employee/data_proses?view=manipulation&action=edit&process_id='.$process_id).'">
						<i class="fa fa-edit"></i>
					</a>
					<a class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#confirm" id="delete_'.$R1->process_id.'">
						<i class="fa fa-trash"></i>
					</a>
				</div>
			';
			
			$data[] = $row;
		}

		$output = array(
			'draw' => $_POST['draw'],
			'recordsTotal' => $this->view->count_all($datato),
			'recordsFiltered' => $this->view->count_filtered($datato),
			'data' => $data,
		);
		echo json_encode($output);
	}
	
	public function get_table_request()
	{	
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__request';
		$datato['column_order'] = array(
			'patlog__contract.entity__request.request_name',
			null
		);
		$datato['column_search'] = array(
			'patlog__contract.entity__request.request_name'
		);
		$datato['order'] = array(
			'patlog__contract.entity__request.request_name' => 'asc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		foreach($Q1 as $R1){
			# Encrypt ID
			$encrypt_id = $this->encrypt->encode($R1->request_id);
			$request_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);

			$row = array();
			$row[] = $R1->request_name;
			$row[] = '
				<div class="text-center">
					<a class="btn btn-sm btn-default" href="'.site_url('module_contract/employee/data_permintaan?view=preview&request_id='.$request_id).'">
						<i class="fa fa-eye"></i>
					</a>
					<a class="btn btn-sm btn-info" href="'.site_url('module_contract/employee/data_permintaan?view=manipulation&action=edit&request_id='.$request_id).'">
						<i class="fa fa-edit"></i>
					</a>
					<a class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#confirm" id="delete_'.$R1->request_id.'">
						<i class="fa fa-trash"></i>
					</a>
				</div>
			';
			
			$data[] = $row;
		}

		$output = array(
			'draw' => $_POST['draw'],
			'recordsTotal' => $this->view->count_all($datato),
			'recordsFiltered' => $this->view->count_filtered($datato),
			'data' => $data,
		);
		echo json_encode($output);
	}
	
	public function get_table_request_description()
	{	
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__request_description';
		$datato['table_join'] = array(
			'patlog__contract.entity__request'
		);
		$datato['table_join_on'] = array(
			'patlog__contract.entity__request_description'
		);
		$datato['join_id'] = array(
			'request_id'
		);
		$datato['join_type'] = array(
			'inner'
		);
		$datato['column_order'] = array(
			'patlog__contract.entity__request.request_name',
			'patlog__contract.entity__request_description.request_description_name',
			null
		);
		$datato['column_search'] = array(
			'patlog__contract.entity__request.request_name',
			'patlog__contract.entity__request_description.request_description_name'
		);
		$datato['order'] = array(
			'patlog__contract.entity__request_description.request_description_name' => 'asc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		foreach($Q1 as $R1){
			# Encrypt ID
			$encrypt_id = $this->encrypt->encode($R1->request_description_id);
			$request_description_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);

			$row = array();
			$row[] = $R1->request_name;
			$row[] = $R1->request_description_name;
			$row[] = '
				<div class="text-center">
					<a class="btn btn-sm btn-default" href="'.site_url('module_contract/employee/data_detail_permintaan?view=preview&request_description_id='.$request_description_id).'">
						<i class="fa fa-eye"></i>
					</a>
					<a class="btn btn-sm btn-info" href="'.site_url('module_contract/employee/data_detail_permintaan?view=manipulation&action=edit&request_description_id='.$request_description_id).'">
						<i class="fa fa-edit"></i>
					</a>
					<a class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#confirm" id="delete_'.$R1->request_description_id.'">
						<i class="fa fa-trash"></i>
					</a>
				</div>
			';
			
			$data[] = $row;
		}

		$output = array(
			'draw' => $_POST['draw'],
			'recordsTotal' => $this->view->count_all($datato),
			'recordsFiltered' => $this->view->count_filtered($datato),
			'data' => $data,
		);
		echo json_encode($output);
	}
	
	public function get_table_third_party()
	{	
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__third_party';
		$datato['column_order'] = array(
			'patlog__contract.entity__third_party.third_party_name',
			null
		);
		$datato['column_search'] = array(
			'patlog__contract.entity__third_party.third_party_name'
		);
		$datato['order'] = array(
			'patlog__contract.entity__third_party.third_party_name' => 'asc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		foreach($Q1 as $R1){
			# Encrypt ID
			$encrypt_id = $this->encrypt->encode($R1->third_party_id);
			$third_party_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);

			$row = array();
			$row[] = $R1->third_party_name;
			$row[] = '
				<div class="text-center">
					<a class="btn btn-sm btn-default" href="'.site_url('module_contract/employee/data_pihak_ketiga?view=preview&third_party_id='.$third_party_id).'">
						<i class="fa fa-eye"></i>
					</a>
					<a class="btn btn-sm btn-info" href="'.site_url('module_contract/employee/data_pihak_ketiga?view=manipulation&action=edit&third_party_id='.$third_party_id).'">
						<i class="fa fa-edit"></i>
					</a>
					<a class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#confirm" id="delete_'.$R1->third_party_id.'">
						<i class="fa fa-trash"></i>
					</a>
				</div>
			';
			
			$data[] = $row;
		}

		$output = array(
			'draw' => $_POST['draw'],
			'recordsTotal' => $this->view->count_all($datato),
			'recordsFiltered' => $this->view->count_filtered($datato),
			'data' => $data,
		);
		echo json_encode($output);
	}
	
	public function get_table_document()
	{	
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__document';
		$datato['column_order'] = array(
			'patlog__contract.entity__document.document_order',
			'patlog__contract.entity__document.document_name',
			'patlog__contract.entity__document.document_mandatory',
			null
		);
		$datato['column_search'] = array(
			'patlog__contract.entity__document.document_order',
			'patlog__contract.entity__document.document_name',
			'patlog__contract.entity__document.document_mandatory'
		);
		$datato['order'] = array(
			'patlog__contract.entity__document.document_order' => 'asc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		foreach($Q1 as $R1){
			# Encrypt ID
			$encrypt_id = $this->encrypt->encode($R1->document_id);
			$document_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);

			$row = array();
			$row[] = $R1->document_order;
			$row[] = $R1->document_name;
			$row[] = $R1->document_mandatory;
			$row[] = '
				<div class="text-center">
					<a class="btn btn-sm btn-default" href="'.site_url('module_contract/employee/data_dokumen?view=preview&document_id='.$document_id).'">
						<i class="fa fa-eye"></i>
					</a>
					<a class="btn btn-sm btn-info" href="'.site_url('module_contract/employee/data_dokumen?view=manipulation&action=edit&document_id='.$document_id).'">
						<i class="fa fa-edit"></i>
					</a>
					<a class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#confirm" id="delete_'.$R1->document_id.'">
						<i class="fa fa-trash"></i>
					</a>
				</div>
			';
			
			$data[] = $row;
		}

		$output = array(
			'draw' => $_POST['draw'],
			'recordsTotal' => $this->view->count_all($datato),
			'recordsFiltered' => $this->view->count_filtered($datato),
			'data' => $data,
		);
		echo json_encode($output);
	}
	
	public function get_table_template()
	{	
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__template';
		$datato['column_order'] = array(
			'patlog__contract.entity__template.template_name',
			null,
			null
		);
		$datato['column_search'] = array(
			'patlog__contract.entity__template.template_name'
		);
		$datato['order'] = array(
			'patlog__contract.entity__template.template_name' => 'asc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		foreach($Q1 as $R1){
			# Encrypt ID
			$encrypt_id = $this->encrypt->encode($R1->template_id);
			$template_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);

			$row = array();
			$row[] = $R1->template_name;
			$href = base_url('assets/mod__contract/attach/template-file/'.$R1->template_file.'?time='.date('YmdHis'));
			$ext = pathinfo($R1->template_file, PATHINFO_EXTENSION);
			$filename = $R1->template_name.'.'.$ext;
			$row[] = '
				<div class="text-center">
					<a class="btn btn-sm btn-default" href="'.$href.'" download="'.$filename.'" target="_blank">
						<i class="fa fa-eye"></i> Lihat Dokumen
					</a>
				</div>
			';
			$row[] = '
				<div class="text-center">
					<a class="btn btn-sm btn-default" href="'.site_url('module_contract/employee/data_template?view=preview&template_id='.$template_id).'">
						<i class="fa fa-eye"></i>
					</a>
					<a class="btn btn-sm btn-info" href="'.site_url('module_contract/employee/data_template?view=manipulation&action=edit&template_id='.$template_id).'">
						<i class="fa fa-edit"></i>
					</a>
					<a class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#confirm" id="delete_'.$R1->template_id.'">
						<i class="fa fa-trash"></i>
					</a>
				</div>
			';
			
			$data[] = $row;
		}

		$output = array(
			'draw' => $_POST['draw'],
			'recordsTotal' => $this->view->count_all($datato),
			'recordsFiltered' => $this->view->count_filtered($datato),
			'data' => $data,
		);
		echo json_encode($output);
	}
	
	public function get_table_user_reviewer()
	{	
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__user_reviewer';
		$datato['column_order'] = array(
			'patlog__contract.entity__user_reviewer.user_reviewer_employee_in_name',
			null
		);
		$datato['column_search'] = array(
			'patlog__contract.entity__user_reviewer.user_reviewer_employee_in_name'
		);
		$datato['order'] = array(
			'patlog__contract.entity__user_reviewer.user_reviewer_employee_in_name' => 'asc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		foreach($Q1 as $R1){
			# Encrypt ID
			$encrypt_id = $this->encrypt->encode($R1->user_reviewer_id);
			$user_reviewer_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);

			$row = array();
			$row[] = $R1->user_reviewer_employee_in_name;
			$row[] = '
				<div class="text-center">
					<a class="btn btn-sm btn-default" href="'.site_url('module_contract/employee/data_user_reviewer?view=preview&user_reviewer_id='.$user_reviewer_id).'">
						<i class="fa fa-eye"></i>
					</a>
					<a class="btn btn-sm btn-info" href="'.site_url('module_contract/employee/data_user_reviewer?view=manipulation&action=edit&user_reviewer_id='.$user_reviewer_id).'">
						<i class="fa fa-edit"></i>
					</a>
					<a class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#confirm" id="delete_'.$R1->user_reviewer_id.'">
						<i class="fa fa-trash"></i>
					</a>
				</div>
			';
			
			$data[] = $row;
		}

		$output = array(
			'draw' => $_POST['draw'],
			'recordsTotal' => $this->view->count_all($datato),
			'recordsFiltered' => $this->view->count_filtered($datato),
			'data' => $data,
		);
		echo json_encode($output);
	}
	
	public function get_dropdown_approval()
	{
		unset($datato);
		$datato['table'] = 'patlog__hrms.entity__employee_in';
		$datato['where'] = array(
			'patlog__hrms.entity__employee_in.employee_in_id' => $this->input->post('contract_creator_employee_in_id')
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$division_id = $R1->division_id;
		}else{
			$division_id = null;
		}
		
		$data['contract_approval_select_id'][] = '<option selected disabled value="" hidden>--Pilih--</option>';
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
			$data['contract_approval_select_id'][] = '<option value="'.urlencode($R1->approval_id).'">'.$R1->approval_name.'</option>';
		}
		
		echo json_encode($data, true);
	}
	
	public function get_dropdown_request_description()
	{
		$data['contract_request_description_id'][] = '<option selected disabled value="" hidden>--Pilih--</option>';
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__request_description';
		$datato['where'] = array(
			'patlog__contract.entity__request_description.request_id' => $this->input->post('contract_request_id')
		);
		$datato['order'] = array(
			'patlog__contract.entity__request_description.request_description_name'
		);
		$datato['order_type'] = array(
			'asc'
		);
		$Q1 = $this->view->view_data($datato);
		foreach($Q1->result() as $R1){
			$data['contract_request_description_id'][] = '<option value="'.urlencode($R1->request_description_id).'">'.$R1->request_description_name.'</option>';
		}
		
		echo json_encode($data, true);
	}
	
	public function get_dropdown_project_code()
	{
		$data['contract_project_code_id'][] = '<option selected disabled value="" hidden>--Pilih--</option>';
		if($this->input->post('contract_project_code_category') == 'External'){
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
				$data['contract_project_code_id'][] = '<option value="'.urlencode($R1->project_code_id).'">'.$R1->project_code_name.'</option>';
			}
		}elseif($this->input->post('contract_project_code_category') == 'Internal'){
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
				$data['contract_project_code_id'][] = '<option value="'.urlencode($R1->cost_center_id).'">'.$R1->cost_center_name.'</option>';
			}
		}
		
		echo json_encode($data, true);
	}
	
	public function get_dropdown_sign_speciment()
	{
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__contract';
		$datato['where'] = array(
			'patlog__contract.entity__contract.contract_id' => $this->input->post('contract_id')
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			if($this->input->post('contract_ttd_sign_type') == 'Manual'){
				$data['status'] = false;
				$data['selected'] = false;
			}else{
				if($R1->contract_ttd_sign_trigger == 'yes'){
					$data['status'] = true;
					$data['selected'] = $R1->contract_ttd_sign_speciment;
					$data['contract_ttd_sign_speciment'][] = '<option value="'.urlencode($R1->contract_ttd_sign_speciment).'">'.$R1->contract_ttd_sign_speciment.'</option>';
				}else{
					if($this->input->post('contract_ttd_sign_type') == 'Digital'){
						$data['status'] = true;
						$data['contract_ttd_sign_speciment'][] = '<option selected disabled value="" hidden>--Pilih--</option>';
						$data['contract_ttd_sign_speciment'][] = '<option value="'.urlencode('TTD').'">TTD</option>';
						$data['contract_ttd_sign_speciment'][] = '<option value="'.urlencode('Paraf').'">Paraf</option>';
						$data['contract_ttd_sign_speciment'][] = '<option value="'.urlencode('System').'">System</option>';
					}elseif($this->input->post('contract_ttd_sign_type') == 'Digital+Sertifikasi'){
						$data['status'] = true;
						$data['contract_ttd_sign_speciment'][] = '<option selected disabled value="" hidden>--Pilih--</option>';
						$data['contract_ttd_sign_speciment'][] = '<option value="'.urlencode('Approver').'">Approver by paraf</option>';
						$data['contract_ttd_sign_speciment'][] = '<option value="'.urlencode('Signer').'">Signer by TTD</option>';
					}
					$data['selected'] = false;
				}
			}
		}
		
		echo json_encode($data, true);
	}
	
	public function get_form_project_code_detail()
	{
		$data['contract_project_code_description'] = null;
		if($this->input->post('contract_project_code_category') == 'External'){
			unset($datato);
			$datato['table'] = 'patlog__project.entity__project_code';
			$datato['where'] = array(
				'patlog__project.entity__project_code.project_code_id' => $this->input->post('contract_project_code_id')
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				$data['contract_project_code_description'] = $R1->project_code_description;
			}
		}elseif($this->input->post('contract_project_code_category') == 'Internal'){
			unset($datato);
			$datato['table'] = 'patlog__project.entity__cost_center';
			$datato['where'] = array(
				'patlog__project.entity__cost_center.cost_center_id' => $this->input->post('contract_project_code_id')
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				$data['contract_project_code_description'] = $R1->cost_center_description;
			}
		}
		
		echo json_encode($data, true);
	}
	
	public function get_form_project_code_period()
	{
		$start_date = new DateTime($this->input->post('contract_date_start'));
		$end_date = new DateTime($this->input->post('contract_date_end'));
		$contract_period = $start_date->diff($end_date)->days;
		$data['contract_period'] = $contract_period + 1;
		
		echo json_encode($data, true);
	}
	
	public function get_form_project_calculate()
	{
		if(urldecode($this->input->post('contract_project_currency')) == 'IDR'){
			$currency = 'Rupiah';
		}elseif(urldecode($this->input->post('contract_project_currency')) == 'USD'){
			$currency = 'Dollar';
		}else{
			$currency = null;
		}
		$contract_project_calculate = ucwords($this->func_calculate($this->input->post('contract_project_cost'))).' '.$currency;
		$data['contract_project_calculate'] = $contract_project_calculate;
		
		echo json_encode($data, true);
	}
	
	public function get_form_contract_process()
	{
		$data['contract_status_process'][] = '<option selected disabled value="" hidden>--Pilih--</option>';
		
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__process';
		$datato['where'] = array(
			'patlog__contract.entity__process.process_id' => $this->input->post('contract_process_id')
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$data['contract_process_attachment_status'] = $R1->process_attachment_status;
			$data['contract_process_flow'] = $R1->process_flow;
			
			if($R1->process_flow == 'process'){
				$data['contract_status_process'][] = '<option value="'.urlencode('Processing').'">Processing</option>';
				$data['contract_status_process'][] = '<option value="'.urlencode('Rejected').'">Reject</option>';
			}elseif($R1->process_flow == 'final'){
				$data['contract_status_process'][] = '<option value="'.urlencode('Done').'">Done</option>';
			}
		}else{
			$data['contract_process_attachment_status'] = null;
			$data['contract_process_flow'] = null;
		}
		
		echo json_encode($data, true);
	}
	
	public function get_form_contract_upload()
	{
		$data['contract_process_attachment_status'] = null;
		$data['contract_process_flow'] = null;
		
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__contract';
		$datato['where'] = array(
			'patlog__contract.entity__contract.contract_id' => $this->input->post('contract_id')
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			unset($data);
			foreach($_FILES['contract_summary_file_name'] as $key => $file){
				$data[$key] = $_FILES['contract_summary_file_name'][$key];
			}
			$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
			$file_name = 'document-contract-summary-'.md5($R1->contract_id).'.'.$ext;
			$path = './assets/mod__contract/attach/document-contract-summary/'.$file_name;
			$arr_type = array(
				'application/pdf'
			);
			if(in_array($data['type'], $arr_type)){
				move_uploaded_file($data['tmp_name'], $path);
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__contract';
				$datato['contract_summary_file_name'] = $file_name;
				$datato['contract_summary_file_ttd'] = 'no.pdf';
				$datato['field'] = 'contract_id';
				$datato['id'] = $R1->contract_id;
				$this->mod->update($datato);
				
				if(file_exists('assets/mod__contract/attach/document-contract-summary-ttd/'.$R1->contract_summary_file_ttd) and $R1->contract_summary_file_ttd != 'no.pdf'){
					unlink('assets/mod__contract/attach/document-contract-summary-ttd/'.$R1->contract_summary_file_ttd);
				}
			}
			
			$data['contract_status_process'][] = '<option selected disabled value="" hidden>--Pilih--</option>';
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__process';
			$datato['where'] = array(
				'patlog__contract.entity__process.process_id' => $this->input->post('contract_process_id')
			);
			$Q2 = $this->view->view_data($datato);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$data['contract_process_attachment_status'] = $R2->process_attachment_status;
				$data['contract_process_flow'] = $R2->process_flow;
				
				if($R2->process_flow == 'process'){
					$data['contract_status_process'][] = '<option value="'.urlencode('Processing').'">Processing</option>';
					$data['contract_status_process'][] = '<option value="'.urlencode('Rejected').'">Reject</option>';
				}elseif($R2->process_flow == 'final'){
					$data['contract_status_process'][] = '<option value="'.urlencode('Done').'">Done</option>';
				}
			}
		}
		
		echo json_encode($data, true);
	}
	
	public function get_form_template_file()
	{
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__template';
		$datato['where'] = array(
			'patlog__contract.entity__template.template_id' => $this->input->post('template_id')
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$href = base_url('assets/mod__contract/attach/template-file/'.$R1->template_file.'?time='.date('YmdHis'));
			$ext = pathinfo($R1->template_file, PATHINFO_EXTENSION);
			$filename = $R1->template_name.'.'.$ext;
			$data['href'] = $href;
			$data['name'] = $filename;
		}else{
			$data['href'] = '#';
			$data['name'] = '';
		}
		
		echo json_encode($data, true);
	}
	
	public function get_form_size()
	{
		$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(4));
		$contract_id = $this->encrypt->decode($decrypt_id);
		
		$data = array();
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__contract';
		$datato['where'] = array(
			'patlog__contract.entity__contract.contract_id' => $contract_id
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$page = $this->uri->segment(5);
			
			require(APPPATH.'/third_party/fpdf/fpdf.php');
			require(APPPATH.'/third_party/setasign/fpdi/autoload.php');

			$pdf = new setasign\Fpdi\Fpdi();
			
			if($R1->contract_approval_current_category == 'Drafter'){
				$from_path = 'assets/mod__contract/attach/document-contract-summary/'.$R1->contract_summary_file_name;
			}else{
				if($R1->contract_summary_file_ttd == 'no.pdf'){
					$from_path = 'assets/mod__contract/attach/document-contract-summary/'.$R1->contract_summary_file_name;
				}else{
					$from_path = 'assets/mod__contract/attach/document-contract-summary-ttd/'.$R1->contract_summary_file_ttd;
				}
			}
			$filecontent = file_get_contents($from_path);
			if(preg_match('/^%PDF-1.4/', $filecontent)) {
				
			}else{
				$platform = php_uname();
				if(strpos($platform, 'Windows') !== false){
					$ghostscript = 'gswin64c';
				}else{
					$ghostscript = 'gs';
				}
				$to_path = 'assets/mod__contract/attach/temporary/contract-sign-'.md5($R1->contract_id).'.pdf';
				shell_exec($ghostscript.' -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dNOPAUSE -dQUIET -dBATCH -sOutputFile='.$to_path.' '.$from_path);
				rename($to_path, $from_path);
			}
			$to_path = $from_path;
			
			// Hitung halaman yang sesuai
			$pageCount = $pdf->setSourceFile($to_path);
			for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
				$tplIdx = $pdf->importPage($pageNo);
				$size = $pdf->getTemplateSize($tplIdx);
				if($pageNo == $page){
					$data['width'] = $size['width'];
					$data['height'] = $size['height'];
				}
			}
		}
		
		echo json_encode($data, true);
	}
	
	public function get_input_document()
	{
		$i = 0;
		$arr_data = array();
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__document';
		$datato['where'] = array(
			'patlog__contract.entity__document.request_description_id' => $this->input->post('contract_request_description_id')
		);
		$datato['order'] = array(
			'patlog__contract.entity__document.document_order'
		);
		$datato['order_type'] = array(
			'asc'
		);
		$Q1 = $this->view->view_data($datato);
		foreach($Q1->result() as $R1){
			if($R1->document_mandatory == 'yes'){
				$required = 'required';
				$detail = '<span class="text-danger small">(wajib)</span>';
			}else{
				$required = '';
				$detail = '<span class="text-warning small">(opsional)</span>';
			}
			
			$arr_data[] = '
				<div class="form-group">
					<label class="col-md-3 control-label">'.$R1->document_name.' '.$detail.'</label>
					<div class="col-md-9">
						<input type="file" class="form-control" name="contract_document_file['.$i.']" '.$required.'/>
						<input type="hidden" name="document_id['.$i.']" value="'.$R1->document_id.'" />
					</div>
				</div>
			';
			$i++;
		}
		
		$data['form-document'] = implode('',$arr_data);
		
		echo json_encode($data, true);
	}
	
	public function get_input_sign_digital()
	{
		$data = array();
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__contract';
		$datato['where'] = array(
			'patlog__contract.entity__contract.contract_id' => $this->input->post('contract_id')
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$data['trigger'] = $R1->contract_ttd_sign_trigger;
			$data['type'] = $R1->contract_ttd_sign_type;
		}else{
			$data['trigger'] = null;
			$data['type'] = null;
		}
		
		if($data['trigger'] != 'yes'){
			if($this->input->post('contract_ttd_sign_type') == 'Manual'){
				$data['text_contract_ttd_sign_type'] = '
					<p class="text-info" style="margin-top:13px;"><b>Dokumen ditandatangan secara manual.</b></p>
				';
			}elseif($this->input->post('contract_ttd_sign_type') == 'Digital'){
				$data['text_contract_ttd_sign_type'] = '
					<a class="btn btn-lg btn-info" style="width:100%;" href="#" onclick="onSign();">
						<b>Klik untuk menandatangani [<i class="fas fa-signature"></i>]</b>
					</a>
				';
			}elseif($this->input->post('contract_ttd_sign_type') == 'Digital+Sertifikasi'){
				unset($datato);
				$datato['table'] = 'patlog__config.entity__user_digital';
				$datato['where'] = array(
					'patlog__config.entity__user_digital.employee_in_id' => $this->input->post('employee_in_id'),
					'patlog__config.entity__user_digital.user_digital_privy_id is not null' => null
				);
				$Q1 = $this->view->view_data($datato);
				if($Q1->num_rows()){
					$R1 = $Q1->row();
					$data['text_contract_ttd_sign_type'] = '
						<a class="btn btn-lg btn-info" style="width:100%;" href="#" onclick="onSign();">
							<b>Klik untuk menandatangani [<i class="fas fa-signature"></i>]</b>
						</a>
					';
				}else{
					$data['text_contract_ttd_sign_type'] = '
						<p class="text-danger" style="margin-top:13px;"><b>Mohon maaf akun Anda belum terdaftar sebagai penandatangan digital, silahkan hubungi Admin.</b></p>
					';
				}
			}
		}else{
			$data['text_contract_ttd_sign_type'] = '
				<p class="text-info" style="margin-top:13px;"><b>Dokumen sudah ditandatangan secara '.$data['type'].', silahkan lanjutkan untuk Approve.</b></p>
			';
		}
		
		echo json_encode($data, true);
	}
	
	public function get_input_trigger()
	{
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__contract';
		$datato['where'] = array(
			'patlog__contract.entity__contract.contract_id' => $this->input->post('contract_id')
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$data['trigger'] = $R1->contract_ttd_sign_trigger;
		}else{
			$data['trigger'] = null;
		}
		
		echo json_encode($data, true);
	}
	
	public function get_input_otp()
	{
		$arr_data = array();
		$data = $this->input->post('form_data');
		for($i=0;$i<count($data);$i++){
			$arr_data[$data[$i]['name']] = $data[$i]['value'];
		}
		
		$data['status'] = 'false';
		if(count($arr_data) > 0){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $arr_data['contract_id']);
			$contract_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__contract';
			$datato['where'] = array(
				'patlog__contract.entity__contract.contract_id' => $contract_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__otp';
				$datato['where'] = array(
					'patlog__contract.entity__otp.contract_id' => $R1->contract_id,
					'patlog__contract.entity__otp.otp_code' => $arr_data['sign_code']
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					
					unset($datato);
					$datato['table'] = 'patlog__hrms.entity__employee_in';
					$datato['where'] = array(
						'patlog__hrms.entity__employee_in.employee_in_id' => $R1->contract_approval_current_id
					);
					$Q3 = $this->view->view_data($datato);
					if($Q3->num_rows()){
						$R3 = $Q3->row();
						
						if(urldecode($arr_data['sign_type']) == 'TTD'){
							$data['status'] = 'true';
							$data['image'] = base_url('assets/mod__hrms/attach/upload-sign/'.$R3->employee_in_upload_sign.'?time='.date('YmdHis'));
							$sign_type = urldecode($arr_data['sign_type']);
						}elseif(urldecode($arr_data['sign_type']) == 'Paraf'){
							$data['status'] = 'true';
							$data['image'] = base_url('assets/mod__hrms/attach/upload-initial/'.$R3->employee_in_upload_initial.'?time='.date('YmdHis'));
							$sign_type = urldecode($arr_data['sign_type']);
						}elseif(urldecode($arr_data['sign_type']) == 'System'){
							$data['status'] = 'true';
							$data['image'] = base_url('assets/mod__hrms/attach/image-sign/'.$R3->employee_in_image_sign.'?time='.date('YmdHis'));
							$sign_type = urldecode($arr_data['sign_type']);
						}else{
							$data['message'] = '<label class="text-danger">TTD tidak ditemukan.</label>';
							$sign_type = null;
						}
						
						unset($datato);
						$datato['database'] = 'patlog__contract';
						$datato['table'] = 'entity__contract';
						$datato['contract_ttd_sign_speciment'] = $sign_type;
						$datato['field'] = 'contract_id';
						$datato['id'] = $R1->contract_id;
						$this->mod->update($datato);
						
						unset($datato);
						$datato['database'] = 'patlog__contract';
						$datato['table'] = 'entity__otp';
						$datato['field'] = 'otp_id';
						$datato['id'] = $R2->otp_id;
						$this->mod->delete($datato);
					}else{
						$data['message'] = '<label class="text-danger">User tidak ditemukan.</label>';
					}
				}else{
					$data['message'] = '<label class="text-danger">Kode OTP tidak sesuai.</label>';
				}
			}else{
				$data['message'] = '<label class="text-danger">Kontrak tidak ditemukan.</label>';
			}
		}else{
			$data['message'] = '<label class="text-danger">Data tidak ditemukan.</label>';
		}
		
		echo json_encode($data, true);
	}
	
	public function func_rand_string($length)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for($i=0;$i<$length;$i++){
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	public function func_calculate($nilai)
	{
		if($nilai<0) {
			$hasil = "minus ".trim($this->func_denominator($nilai));
		} else {
			$hasil = trim($this->func_denominator($nilai));
		}     		
		return $hasil;
	}
	
	public function func_denominator($nilai)
	{
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = $this->func_denominator($nilai - 10)." belas";
		} else if ($nilai < 100) {
			$temp = $this->func_denominator($nilai/10)." puluh".$this->func_denominator($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus".$this->func_denominator($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = $this->func_denominator($nilai/100)." ratus".$this->func_denominator($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu".$this->func_denominator($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = $this->func_denominator($nilai/1000)." ribu".$this->func_denominator($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = $this->func_denominator($nilai/1000000)." juta".$this->func_denominator($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = $this->func_denominator($nilai/1000000000)." milyar".$this->func_denominator(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = $this->func_denominator($nilai/1000000000000)." trilyun".$this->func_denominator(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
	
	public function func_generate_qr($id)
	{
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__contract';
		$datato['where'] = array(
			'patlog__contract.entity__contract.contract_id' => $id
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			unset($config);
			$config['cacheable'] = true; //boolean, the default is true
			$config['cachedir'] = 'assets/mod__contract/attach/contract-qr/cache/'; //string, the default is application/cache/
			$config['errorlog'] = 'assets/mod__contract/attach/contract-qr/error_log/'; //string, the default is application/logs/
			$config['imagedir'] = 'assets/mod__contract/attach/contract-qr/'; //direktori penyimpanan qr code
			$config['quality'] = true; //boolean, the default is true
			$config['size'] = '1024'; //interger, the default is 1024
			$config['black'] = array(224,255,255); // array, default is array(255,255,255)
			$config['white'] = array(70,130,180); // array, default is array(0,0,0)
			$this->ciqrcode->initialize($config);
			
			$image_name = 'contract-qr-'.md5($R1->contract_id).'.png'; //buat name dari qr code sesuai dengan nim
			$encrypt_id = $this->encrypt->encode($R1->contract_id);
            $contract_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
			$params['data'] = site_url('module_contract/employee/lacak_kontrak/'.$contract_id); //data yang akan di jadikan QR CODE
			$params['level'] = 'H'; //H=High
			$params['size'] = 10;
			$params['savename'] = $config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
			$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
			
			$QR = imagecreatefrompng($config['imagedir'].$image_name);
			$logo = imagecreatefromstring(file_get_contents(APPPATH.'../assets/public/logo/logo.jpg'));
			imagecolortransparent($logo , imagecolorallocatealpha($logo , 0, 0, 0, 127));
			imagealphablending($logo , false);
			imagesavealpha($logo , true);
			$QR_width = imagesx($QR);//get logo width
			$QR_height = imagesy($QR);//get logo width
			$logo_width = imagesx($logo);
			$logo_height = imagesy($logo);
			$logo_qr_width = $QR_width/2;
			$scale = $logo_width/$logo_qr_width;
			$logo_qr_height = $logo_height/$scale;
			imagecopyresampled($QR, $logo, $QR_width/4, $QR_height/2.17, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

			$space = 1;
			$main = imagecreatetruecolor($QR_width, $QR_height + $space);
			// Create the image
			$im = imagecreatetruecolor($QR_width, $space);
			// Create some colors
			$white = imagecolorallocate($im, 255, 255, 255);
			$black = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im, 0, 0, 399, $space - 1, $white);
			// Font path
			$font = realpath('assets/mod__contract/public/arial.ttf');
			// Add the text
			// imagettftext($im, 20, 0, 63, 20, $black, $font, $params['data']);
			$this->imagecopymerge_alpha($main, $QR, 0, 0, 0, 0, $QR_width, $QR_height, 100);
			// $this->imagecopymerge_alpha($main, $im, 0, $QR_width, 0, 0, $QR_width, $space, 100);
			imagepng($main, $config['imagedir'].$image_name);
			
			unset($datato);
			$datato['database'] = 'patlog__contract';
			$datato['table'] = 'entity__contract';
			$datato['contract_qr'] = $image_name;
			$datato['field'] = 'contract_id';
			$datato['id'] = $R1->contract_id;
			$this->mod->update($datato);
		}
	}
	
	function func_number_format($numVal,$afterPoint=2,$minAfterPoint=0,$thousandSep=".",$decPoint=",")
	{
		// Same as number_format() but without unnecessary zeros.
		$ret = number_format($numVal,$afterPoint,$decPoint,$thousandSep);
		if($afterPoint!=$minAfterPoint){
			while(($afterPoint>$minAfterPoint) && (substr($ret,-1) =="0") ){
				// $minAfterPoint!=$minAfterPoint and number ends with a '0'
				// Remove '0' from end of string and set $afterPoint=$afterPoint-1
				$ret = substr($ret,0,-1);
				$afterPoint = $afterPoint-1;
			}
		}
		if(substr($ret,-1)==$decPoint) {$ret = substr($ret,0,-1);}
		return $ret;
	}
	
	function func_clear_text($text)
	{
		// Strip HTML Tags
		$clear = strip_tags($text);
		// Clean up things like &amp;
		$clear = html_entity_decode($clear);
		// Strip out any url-encoded stuff
		$clear = urldecode($clear);
		// Replace non-AlNum characters with space
		$clear = preg_replace('/[^A-Za-z0-9]/', ' ', $clear);
		// Replace Multiple spaces with single space
		$clear = preg_replace('/ +/', ' ', $clear);
		// Trim the string of leading/trailing space
		return $clear = trim($clear);
	}
	
	function func_date_range($start, $end)
	{
		$result = array();
		$from = mktime(1,0,0,substr($start,5,2),substr($start,8,2),substr($start,0,4));
		$until = mktime(1,0,0,substr($end,5,2),substr($end,8,2),substr($end,0,4));
		if($until >= $from){
			array_push($result, date('Y-m-d',$from));
			while($from < $until){
				$from += 86400;
				array_push($result ,date('Y-m-d',$from));
			}
		}
		return $result;
	}
	
	function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
		// creating a cut resource
		$cut = imagecreatetruecolor($src_w, $src_h);

		// copying relevant section from background to the cut resource
		imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);

		// copying relevant section from watermark to the cut resource
		imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);

		// insert cut resource to destination image
		imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
	}
	
	public function api_privy_document_upload($id)
	{
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__contract';
		$datato['where'] = array(
			'patlog__contract.entity__contract.contract_id' => $id
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			unset($datato);
			$datato['table'] = 'patlog__config.sys__project';
			$Q2 = $this->view->view_data($datato);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$project_privy_status = $R2->project_privy_status;
			}else{
				$project_privy_status = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__config.entity__privy_cog';
			$datato['where'] = array(
				'patlog__config.entity__privy_cog.privy_cog_type' => $project_privy_status
			);
			$Q2 = $this->view->view_data($datato);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$user = $R2->privy_cog_user;
				$pass = $R2->privy_cog_pass;
				$key = $R2->privy_cog_key;
				$enterprise_token = $R2->privy_cog_token;
				$url = $R2->privy_cog_url;
			}else{
				$user = null;
				$pass = null;
				$key = null;
				$enterprise_token = null;
				$url = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__config.entity__user_digital';
			$datato['where'] = array(
				'patlog__config.entity__user_digital.employee_in_id' => $R1->contract_approval_current_id,
				'patlog__config.entity__user_digital.user_digital_privy_type' => $project_privy_status
			);
			$Q2 = $this->view->view_data($datato);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$user_digital_id = $R2->user_digital_id;
				$user_digital_privy_id = $R2->user_digital_privy_id;
				$user_digital_privy_token = $R2->user_digital_privy_token;
				$user_digital_privy_email = $R2->user_digital_privy_email;
			}else{
				$user_digital_id = null;
				$user_digital_privy_id = null;
				$user_digital_privy_token = null;
				$user_digital_privy_email = null;
			}
			
			$url = $url.'/merchant/document/upload';
			
			$code = base64_encode($user.':'.$pass);
			
			$owner_privy_id = $user_digital_privy_id;
			$owner = array(
				'privyId' => $owner_privy_id,
				'enterpriseToken' => $enterprise_token
			);
			
			$recipients_privy_id = $user_digital_privy_id;
			$recipients = array(
				'privyId' => $recipients_privy_id,
				'type' => $R1->contract_ttd_sign_speciment, # Signer / Reviewer / Approver (enterprise)
				'enterpriseToken' => $enterprise_token
			);
			$value_doc = 'false';
			if($R1->contract_summary_file_ttd == 'no.pdf'){
				if(file_exists(FCPATH.'assets/mod__contract/attach/document-contract-summary/'.$R1->contract_summary_file_name)){
					$file_document = curl_file_create(FCPATH.'assets/mod__contract/attach/document-contract-summary/'.$R1->contract_summary_file_name);
					$value_doc = 'true';
				}
			}elseif($R1->contract_summary_file_ttd != 'no.pdf'){
				if(file_exists(FCPATH.'assets/mod__contract/attach/document-contract-summary-ttd/'.$R1->contract_summary_file_ttd)){
					$file_document = curl_file_create(FCPATH.'assets/mod__contract/attach/document-contract-summary-ttd/'.$R1->contract_summary_file_ttd);
					$value_doc = 'true';
				}
			}
			if($value_doc == 'false'){
				echo 'Dokumen tidak ditemukan.';
				die;				
			}
			// $template_id = '';
			$arr_data = array(
				'documentTitle' => 'Dokumen Kontrak '.$R1->contract_project_code_name,
				'docType' => 'Serial', # Serial = approval ttd berjenjang / Parallel = approval ttd bisa acak
				'owner' => json_encode($owner, true),
				'document' => $file_document,
				'recipients' => '['.json_encode($recipients, true).']', 
				// 'templateId' => $template_id # Autosign
			);
			
			$header = array(
				'Content-Type: multipart/form-data',
				'Merchant-Key: '.$key,
				'Authorization: Basic '.$code
			);
			
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_POST => 1,
				CURLOPT_POSTFIELDS => $arr_data,
				CURLOPT_HTTPHEADER => $header
			));
			
			echo $response = curl_exec($curl);
			if(curl_errno($curl)){
				echo curl_error($curl);
				die;
			}
			curl_close($curl);
			
			$response = json_decode($response, true);
			if(isset($response['data'])){
				$privy_log_data = $response['data'];
			}elseif(isset($response['errors'])){
				$privy_log_data = $response['errors'];
			}else{
				$privy_log_data = null;
			}
			
			unset($datato);
			$datato['database'] = 'patlog__config';
			$datato['table'] = 'entity__privy_log';
			$datato['user_digital_id'] = $user_digital_id;
			$datato['privy_log_email'] = $user_digital_privy_email;
			$datato['privy_log_api'] = $url;
			if(isset($response['code'])){
				$datato['privy_log_code'] = $response['code'];
			}
			if(isset($response['message'])){
				$datato['privy_log_message'] = $response['message'];
			}
			$datato['privy_log_header'] = json_encode($header, true);
			$datato['privy_log_request'] = json_encode($arr_data, true);
			$datato['privy_log_data'] = json_encode($privy_log_data, true);
			$datato['privy_log_token'] = $user_digital_privy_token;
			$datato['privy_log_insert'] = date('Y-m-d H:i:s');
			$this->mod->insert($datato);
			
			if(isset($response['data']['docToken'])){
				$contract_ttd_sign_token = $response['data']['docToken'];
			}else{
				$contract_ttd_sign_token = null;
			}
			
			if(isset($response['data']['urlDocument'])){
				$contract_ttd_sign_url = $response['data']['urlDocument'];
			}else{
				$contract_ttd_sign_url = null;
			}
			
			if(isset($response['data']['recipients'][0]['magicLink']['link'])){
				$contract_ttd_sign_link = $response['data']['recipients'][0]['magicLink']['link'];
			}else{
				$contract_ttd_sign_link = null;
			}
			
			unset($datato);
			$datato['database'] = 'patlog__contract';
			$datato['table'] = 'entity__contract';
			$datato['contract_ttd_sign_token'] = $contract_ttd_sign_token;
			$datato['contract_ttd_sign_url'] = $contract_ttd_sign_url;
			$datato['contract_ttd_sign_link'] = $contract_ttd_sign_link;
			$datato['contract_ttd_sign_download'] = null;
			$datato['contract_ttd_sign_date_sign'] = null;
			$datato['contract_ttd_sign_date_expired'] = null;
			$datato['contract_ttd_sign_status'] = 'In Progress';
			$datato['contract_ttd_sign_callback'] = json_encode($response, true);
			$datato['field'] = 'contract_id';
			$datato['id'] = $R1->contract_id;
			$this->mod->update($datato);
			
			if(isset($response['code'])){
				if($response['code'] != 200 and $response['code'] != 201){
					print_r($response);
					die;
				}
			}
			
			return $contract_ttd_sign_link;
		}
	}
	
	public function api_privy_document_status($id)
	{
		unset($datato);
		$datato['table'] = 'patlog__contract.entity__contract';
		$datato['where'] = array(
			'patlog__contract.entity__contract.contract_id' => $id
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			unset($datato);
			$datato['table'] = 'patlog__config.sys__project';
			$Q2 = $this->view->view_data($datato);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$project_privy_status = $R2->project_privy_status;
			}else{
				$project_privy_status = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__config.entity__privy_cog';
			$datato['where'] = array(
				'patlog__config.entity__privy_cog.privy_cog_type' => $project_privy_status
			);
			$Q2 = $this->view->view_data($datato);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$user = $R2->privy_cog_user;
				$pass = $R2->privy_cog_pass;
				$key = $R2->privy_cog_key;
				$token = $R2->privy_cog_token;
				$url = $R2->privy_cog_url;
			}else{
				$user = null;
				$pass = null;
				$key = null;
				$token = null;
				$url = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__config.entity__user_digital';
			$datato['where'] = array(
				'patlog__config.entity__user_digital.employee_in_id' => $R1->contract_approval_current_id,
				'patlog__config.entity__user_digital.user_digital_privy_type' => $project_privy_status
			);
			$Q2 = $this->view->view_data($datato);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$user_digital_id = $R2->user_digital_id;
				$user_digital_privy_id = $R2->user_digital_privy_id;
				$user_digital_privy_token = $R2->user_digital_privy_token;
				$user_digital_privy_email = $R2->user_digital_privy_email;
			}else{
				$user_digital_id = null;
				$user_digital_privy_id = null;
				$user_digital_privy_token = null;
				$user_digital_privy_email = null;
			}
		
			$doc_token = $R1->contract_ttd_sign_token;
			$url = $url.'/merchant/document/status/'.$doc_token;
			
			$code = base64_encode($user.':'.$pass);
			
			$arr_data = array(
				'docToken' => $doc_token
			);
			
			$header = array(
				'Merchant-Key: '.$key,
				'Authorization: Basic '.$code
			);
			
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_CUSTOMREQUEST => 'GET',
				CURLOPT_POSTFIELDS => $arr_data,
				CURLOPT_HTTPHEADER => $header
			));
			
			echo $response = curl_exec($curl);
			if(curl_errno($curl)){
				echo curl_error($curl);
			}
			curl_close($curl);
			
			$response = json_decode($response, true);
			if(isset($response['data'])){
				$privy_log_data = $response['data'];
			}elseif(isset($response['errors'])){
				$privy_log_data = $response['errors'];
			}else{
				$privy_log_data = null;
			}
			
			unset($datato);
			$datato['database'] = 'patlog__config';
			$datato['table'] = 'entity__privy_log';
			$datato['user_digital_id'] = $user_digital_id;
			$datato['privy_log_email'] = $user_digital_privy_email;
			$datato['privy_log_api'] = $url;
			if(isset($response['code'])){
				$datato['privy_log_code'] = $response['code'];
			}
			if(isset($response['message'])){
				$datato['privy_log_message'] = $response['message'];
			}
			$datato['privy_log_header'] = json_encode($header, true);
			$datato['privy_log_request'] = json_encode($arr_data, true);
			$datato['privy_log_data'] = json_encode($privy_log_data, true);
			$datato['privy_log_token'] = $user_digital_privy_token;
			$datato['privy_log_insert'] = date('Y-m-d H:i:s');
			$this->mod->insert($datato);
			
			if(isset($response['data']['download']['url'])){
				$contract_ttd_sign_download = $response['data']['download']['url'];
			}else{
				$contract_ttd_sign_download = null;
			}
			
			if(isset($response['data']['recipients'][0]['signedAt'])){
				$contract_ttd_sign_date_sign = $response['data']['recipients'][0]['signedAt'];
			}else{
				$contract_ttd_sign_date_sign = null;
			}
			
			if(isset($response['data']['download']['expiredAt'])){
				$date = $response['data']['download']['expiredAt'];
				$contract_ttd_sign_date_expired = substr($date, 0, 10).' '.substr($date, 11, 8);
			}else{
				$contract_ttd_sign_date_expired = null;
			}
			
			if(isset($response['data']['documentStatus'])){
				$contract_ttd_sign_status = $response['data']['documentStatus'];
			}else{
				$contract_ttd_sign_status = null;
			}
			
			$path = FCPATH.'assets/mod__contract/attach/document-contract-summary-ttd/document-contract-summary-ttd-'.md5($R1->contract_id).'.pdf';
			file_put_contents($path, file_get_contents($contract_ttd_sign_download));
			
			unset($datato);
			$datato['database'] = 'patlog__contract';
			$datato['table'] = 'entity__contract';
			$datato['contract_summary_file_ttd'] = 'document-contract-summary-ttd-'.md5($R1->contract_id).'.pdf';
			$datato['contract_ttd_sign_download'] = $contract_ttd_sign_download;
			$datato['contract_ttd_sign_date_sign'] = $contract_ttd_sign_date_sign;
			$datato['contract_ttd_sign_date_expired'] = $contract_ttd_sign_date_expired;
			$datato['contract_ttd_sign_status'] = $contract_ttd_sign_status;
			$datato['contract_ttd_sign_callback'] = json_encode($response, true);
			$datato['field'] = 'contract_id';
			$datato['id'] = $R1->contract_id;
			$this->mod->update($datato);
			
			if(isset($response['code'])){
				if($response['code'] != 200 and $response['code'] != 201){
					print_r($response);
					die;
				}
			}
		}
	}
	
	public function send_email_approve($id, $employee_id_to, $employee_name_from, $message=null)
	{
		unset($datato);
		$datato['table'] = 'patlog__config.sys__project';
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			if($R1->project_smtp_status == 'yes'){
				ini_set('SMTP','true');
				ini_set('SMTP_host',$R1->project_smtp_host);
				ini_set('SMTP_user',$R1->project_smtp_user);
				ini_set('SMTP_pass',$R1->project_smtp_pass);
				ini_set('smtp_port',$R1->project_smtp_port);
				
				$this->load->library('email');
				$config = array(
					'protocol'  => 'smtp',
					'smtp_host' => $R1->project_smtp_host,
					'smtp_port' => $R1->project_smtp_port,
					'smtp_user' => $R1->project_smtp_user,
					'smtp_pass' => $R1->project_smtp_pass,
					'smtp_keepalive' => TRUE,
					'smtp_crypto' => 'tls',
					'smtp_timeout' => 60,
					'wordwrap'  => TRUE,
					'wrapchars' => 80,
					'mailtype'  => 'html',
					'charset'   => 'utf-8',
					'validate'  => TRUE,
					'crlf'      => "\r\n",
					'newline'   => "\r\n"
				);
				$this->email->initialize($config);
				
				$email_from = $R1->project_smtp_user;
				$email_from_name = $R1->project_smtp_header;
				$subject = 'Notifikasi '.$R1->project_smtp_header;
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__contract';
				$datato['where'] = array(
					'patlog__contract.entity__contract.contract_id' => $id
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					
					unset($datato);
					$datato['table'] = 'patlog__hrms.entity__employee_in';
					$datato['where'] = array(
						'patlog__hrms.entity__employee_in.employee_in_id' => $employee_id_to
					);
					$Q3 = $this->view->view_data($datato);
					if($Q3->num_rows()){
						$R3 = $Q3->row();
						
						if($message != null){
							$note = '<br/><small>Keterangan : '.$message.'</small>';
						}else{
							$note = '<br/>';
						}
						
						$arr_email_to = $R3->employee_in_email;
						$employee_to = $R3->employee_in_name;
						$message = '
							Dear '.$employee_to.'<br/><br/>
							Data pengajuan kontrak '.$R2->contract_no.' telah diapprove oleh '.$employee_name_from.'.<br/><br/>
							Jenis Permintaan : '.$R2->contract_request_description_name.'<br/>
							Nama Proyek : '.$R2->contract_project_code_description.'<br/>
							Nama Vendor : '.$R2->contract_company_name.'<br/>
							Nominal : '.$R2->contract_project_currency.'. '.number_format($R2->contract_project_cost,0,',','.').'
							'.$note.'
							<br/><br/>
							Silahkan cek di aplikasi '.$R1->project_smtp_header.'.
						';
						$this->email->from($email_from, $email_from_name);
						$this->email->to($arr_email_to);
						$this->email->subject($subject);
						$data = array(
							'subject' => $subject,
							'message' => $message,
							'header' => $R1->project_smtp_header,
							'company' => $R1->project_smtp_company,
							'address' => $R1->project_smtp_address
						); 
						$body = $this->load->view('email/message', $data, TRUE);
						$this->email->message($body);
						$result = $this->email->send();
						if (!$result){
							$result = $this->email->print_debugger();
							echo $this->email->print_debugger();
						}
						
						# Insert Log
						unset($datato);
						$datato['database'] = 'patlog__config';
						$datato['table'] = 'entity__log_email';
						$datato['log_email_name'] = 'Contract - Approve';
						$datato['log_email_to'] = $arr_email_to;
						$datato['log_email_subject'] = $subject;
						$datato['log_email_message'] = $message;
						$datato['log_email_response'] = $result;
						$datato['log_email_insert'] = date('Y-m-d H:i:s');
						$this->mod->insert($datato);
					}
				}
			}
		}
	}
	
	public function send_email_reject($id, $employee_id_to, $employee_name_from, $message=null)
	{
		unset($datato);
		$datato['table'] = 'patlog__config.sys__project';
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			if($R1->project_smtp_status == 'yes'){
				ini_set('SMTP','true');
				ini_set('SMTP_host',$R1->project_smtp_host);
				ini_set('SMTP_user',$R1->project_smtp_user);
				ini_set('SMTP_pass',$R1->project_smtp_pass);
				ini_set('smtp_port',$R1->project_smtp_port);
				
				$this->load->library('email');
				$config = array(
					'protocol'  => 'smtp',
					'smtp_host' => $R1->project_smtp_host,
					'smtp_port' => $R1->project_smtp_port,
					'smtp_user' => $R1->project_smtp_user,
					'smtp_pass' => $R1->project_smtp_pass,
					'smtp_keepalive' => TRUE,
					'smtp_crypto' => 'tls',
					'smtp_timeout' => 60,
					'wordwrap'  => TRUE,
					'wrapchars' => 80,
					'mailtype'  => 'html',
					'charset'   => 'utf-8',
					'validate'  => TRUE,
					'crlf'      => "\r\n",
					'newline'   => "\r\n"
				);
				$this->email->initialize($config);
				
				$email_from = $R1->project_smtp_user;
				$email_from_name = $R1->project_smtp_header;
				$subject = 'Notifikasi '.$R1->project_smtp_header;
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__contract';
				$datato['where'] = array(
					'patlog__contract.entity__contract.contract_id' => $id
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					
					unset($datato);
					$datato['table'] = 'patlog__hrms.entity__employee_in';
					$datato['where'] = array(
						'patlog__hrms.entity__employee_in.employee_in_id' => $employee_id_to
					);
					$Q3 = $this->view->view_data($datato);
					if($Q3->num_rows()){
						$R3 = $Q3->row();
						
						if($message != null){
							$note = '<br/><small>Keterangan : '.$message.'</small>';
						}else{
							$note = '<br/>';
						}
						
						$arr_email_to = $R3->employee_in_email;
						$employee_to = $R3->employee_in_name;
						if($R2->contract_data_code != null){
							$add_request = ' dengan nomor pengadaan '.$R2->contract_data_code;
						}else{
							$add_request = '';
						}
						$message = '
							Dear '.$employee_to.'<br/><br/>
							Data pengajuan kontrak '.$R2->contract_no.$add_request.' telah direject oleh '.$employee_name_from.'.<br/><br/>
							Jenis Permintaan : '.$R2->contract_request_description_name.'<br/>
							Nama Proyek : '.$R2->contract_project_code_description.'<br/>
							Nama Vendor : '.$R2->contract_company_name.'<br/>
							Nominal : '.$R2->contract_project_currency.'. '.number_format($R2->contract_project_cost,0,',','.').'
							'.$note.'
							<br/><br/>
							Silahkan cek di aplikasi '.$R1->project_smtp_header.'.
						';
						$this->email->from($email_from, $email_from_name);
						$this->email->to($arr_email_to);
						$this->email->subject($subject);
						$data = array(
							'subject' => $subject,
							'message' => $message,
							'header' => $R1->project_smtp_header,
							'company' => $R1->project_smtp_company,
							'address' => $R1->project_smtp_address
						); 
						$body = $this->load->view('email/message', $data, TRUE);
						$this->email->message($body);
						$result = $this->email->send();
						if (!$result){
							$result = $this->email->print_debugger();
							echo $this->email->print_debugger();
						}
						
						# Insert Log
						unset($datato);
						$datato['database'] = 'patlog__config';
						$datato['table'] = 'entity__log_email';
						$datato['log_email_name'] = 'Contract - Reject';
						$datato['log_email_to'] = $arr_email_to;
						$datato['log_email_subject'] = $subject;
						$datato['log_email_message'] = $message;
						$datato['log_email_response'] = $result;
						$datato['log_email_insert'] = date('Y-m-d H:i:s');
						$this->mod->insert($datato);
					}
				}
			}
		}
	}
	
	public function send_email_drafter($id, $employee_id_to, $message=null)
	{
		unset($datato);
		$datato['table'] = 'patlog__config.sys__project';
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			if($R1->project_smtp_status == 'yes'){
				ini_set('SMTP','true');
				ini_set('SMTP_host',$R1->project_smtp_host);
				ini_set('SMTP_user',$R1->project_smtp_user);
				ini_set('SMTP_pass',$R1->project_smtp_pass);
				ini_set('smtp_port',$R1->project_smtp_port);
				
				$this->load->library('email');
				$config = array(
					'protocol'  => 'smtp',
					'smtp_host' => $R1->project_smtp_host,
					'smtp_port' => $R1->project_smtp_port,
					'smtp_user' => $R1->project_smtp_user,
					'smtp_pass' => $R1->project_smtp_pass,
					'smtp_keepalive' => TRUE,
					'smtp_crypto' => 'tls',
					'smtp_timeout' => 60,
					'wordwrap'  => TRUE,
					'wrapchars' => 80,
					'mailtype'  => 'html',
					'charset'   => 'utf-8',
					'validate'  => TRUE,
					'crlf'      => "\r\n",
					'newline'   => "\r\n"
				);
				$this->email->initialize($config);
				
				$email_from = $R1->project_smtp_user;
				$email_from_name = $R1->project_smtp_header;
				$subject = 'Notifikasi '.$R1->project_smtp_header;
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__contract';
				$datato['where'] = array(
					'patlog__contract.entity__contract.contract_id' => $id
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					
					unset($datato);
					$datato['table'] = 'patlog__hrms.entity__employee_in';
					$datato['where'] = array(
						'patlog__hrms.entity__employee_in.employee_in_id' => $employee_id_to
					);
					$Q3 = $this->view->view_data($datato);
					if($Q3->num_rows()){
						$R3 = $Q3->row();
						
						if($message != null){
							$note = '<br/><small>Keterangan : '.$message.'</small>';
						}else{
							$note = '<br/>';
						}
						
						$arr_email_to = $R3->employee_in_email;
						$employee_to = $R3->employee_in_name;
						$employee_from = $R2->contract_creator_employee_in_name;
						$message = '
							Dear '.$employee_to.'<br/><br/>
							Data pengajuan kontrak '.$R2->contract_no.' telah diajukan oleh '.$employee_from.'.<br/><br/>
							Jenis Permintaan : '.$R2->contract_request_description_name.'<br/>
							Nama Proyek : '.$R2->contract_project_code_description.'<br/>
							Nama Vendor : '.$R2->contract_company_name.'<br/>
							Nominal : '.$R2->contract_project_currency.'. '.number_format($R2->contract_project_cost,0,',','.').'
							'.$note.'
							<br/><br/>
							Silahkan cek di aplikasi '.$R1->project_smtp_header.'.
						';
						$this->email->from($email_from, $email_from_name);
						$this->email->to($arr_email_to);
						$this->email->subject($subject);
						$data = array(
							'subject' => $subject,
							'message' => $message,
							'header' => $R1->project_smtp_header,
							'company' => $R1->project_smtp_company,
							'address' => $R1->project_smtp_address
						); 
						$body = $this->load->view('email/message', $data, TRUE);
						$this->email->message($body);
						$result = $this->email->send();
						if (!$result){
							$result = $this->email->print_debugger();
							echo $this->email->print_debugger();
						}
						
						# Insert Log
						unset($datato);
						$datato['database'] = 'patlog__config';
						$datato['table'] = 'entity__log_email';
						$datato['log_email_name'] = 'Contract - Kirim Drafter';
						$datato['log_email_to'] = $arr_email_to;
						$datato['log_email_subject'] = $subject;
						$datato['log_email_message'] = $message;
						$datato['log_email_response'] = $result;
						$datato['log_email_insert'] = date('Y-m-d H:i:s');
						$this->mod->insert($datato);
					}
				}
			}
		}
	}
	
	public function send_email_done($id, $message=null)
	{
		unset($datato);
		$datato['table'] = 'patlog__config.sys__project';
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			if($R1->project_smtp_status == 'yes'){
				ini_set('SMTP','true');
				ini_set('SMTP_host',$R1->project_smtp_host);
				ini_set('SMTP_user',$R1->project_smtp_user);
				ini_set('SMTP_pass',$R1->project_smtp_pass);
				ini_set('smtp_port',$R1->project_smtp_port);
				
				$this->load->library('email');
				$config = array(
					'protocol'  => 'smtp',
					'smtp_host' => $R1->project_smtp_host,
					'smtp_port' => $R1->project_smtp_port,
					'smtp_user' => $R1->project_smtp_user,
					'smtp_pass' => $R1->project_smtp_pass,
					'smtp_keepalive' => TRUE,
					'smtp_crypto' => 'tls',
					'smtp_timeout' => 60,
					'wordwrap'  => TRUE,
					'wrapchars' => 80,
					'mailtype'  => 'html',
					'charset'   => 'utf-8',
					'validate'  => TRUE,
					'crlf'      => "\r\n",
					'newline'   => "\r\n"
				);
				$this->email->initialize($config);
				
				$email_from = $R1->project_smtp_user;
				$email_from_name = $R1->project_smtp_header;
				$subject = 'Notifikasi '.$R1->project_smtp_header;
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__contract';
				$datato['where'] = array(
					'patlog__contract.entity__contract.contract_id' => $id
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					
					unset($datato);
					$datato['table'] = 'patlog__hrms.entity__employee_in';
					$datato['where'] = array(
						'patlog__hrms.entity__employee_in.employee_in_id' => $R2->contract_creator_employee_in_id
					);
					$Q3 = $this->view->view_data($datato);
					if($Q3->num_rows()){
						$R3 = $Q3->row();
						
						if($message != null){
							$note = '<br/><small>Keterangan : '.$message.'</small>';
						}else{
							$note = '<br/>';
						}
						
						$arr_email_to = $R3->employee_in_email;
						$employee_to = $R3->employee_in_name;
						$message = '
							Dear '.$employee_to.'<br/><br/>
							Data pengajuan kontrak '.$R2->contract_no.' telah selesai.<br/><br/>
							Jenis Permintaan : '.$R2->contract_request_description_name.'<br/>
							Nama Proyek : '.$R2->contract_project_code_description.'<br/>
							Nama Vendor : '.$R2->contract_company_name.'<br/>
							Nominal : '.$R2->contract_project_currency.'. '.number_format($R2->contract_project_cost,0,',','.').'
							'.$note.'
							<br/><br/>
							Silahkan cek di aplikasi '.$R1->project_smtp_header.'.
						';
						$this->email->from($email_from, $email_from_name);
						$this->email->to($arr_email_to);
						$this->email->subject($subject);
						$data = array(
							'subject' => $subject,
							'message' => $message,
							'header' => $R1->project_smtp_header,
							'company' => $R1->project_smtp_company,
							'address' => $R1->project_smtp_address
						); 
						$body = $this->load->view('email/message', $data, TRUE);
						$this->email->message($body);
						$result = $this->email->send();
						if (!$result){
							$result = $this->email->print_debugger();
							echo $this->email->print_debugger();
						}
						
						# Insert Log
						unset($datato);
						$datato['database'] = 'patlog__config';
						$datato['table'] = 'entity__log_email';
						$datato['log_email_name'] = 'Contract - Selesai';
						$datato['log_email_to'] = $arr_email_to;
						$datato['log_email_subject'] = $subject;
						$datato['log_email_message'] = $message;
						$datato['log_email_response'] = $result;
						$datato['log_email_insert'] = date('Y-m-d H:i:s');
						$this->mod->insert($datato);
					}
				}
			}
		}
	}
	
	public function send_email_otp()
	{
		unset($datato);
		$datato['table'] = 'patlog__config.sys__project';
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			$data['status'] = 'false';
			if($R1->project_smtp_status == 'yes'){
				ini_set('SMTP','true');
				ini_set('SMTP_host',$R1->project_smtp_host);
				ini_set('SMTP_user',$R1->project_smtp_user);
				ini_set('SMTP_pass',$R1->project_smtp_pass);
				ini_set('smtp_port',$R1->project_smtp_port);
				
				$this->load->library('email');
				$config = array(
					'protocol'  => 'smtp',
					'smtp_host' => $R1->project_smtp_host,
					'smtp_port' => $R1->project_smtp_port,
					'smtp_user' => $R1->project_smtp_user,
					'smtp_pass' => $R1->project_smtp_pass,
					'smtp_keepalive' => TRUE,
					'smtp_crypto' => 'tls',
					'smtp_timeout' => 60,
					'wordwrap'  => TRUE,
					'wrapchars' => 80,
					'mailtype'  => 'html',
					'charset'   => 'utf-8',
					'validate'  => TRUE,
					'crlf'      => "\r\n",
					'newline'   => "\r\n"
				);
				$this->email->initialize($config);
				
				$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->post('contract_id'));
				$id = $this->encrypt->decode($decrypt_id);
				
				$email_from = $R1->project_smtp_user;
				$email_from_name = $R1->project_smtp_header;
				$subject = 'Kode OTP '.$R1->project_smtp_header;
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__contract';
				$datato['where'] = array(
					'patlog__contract.entity__contract.contract_id' => $id
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					
					unset($datato);
					$datato['table'] = 'patlog__hrms.entity__employee_in';
					$datato['where'] = array(
						'patlog__hrms.entity__employee_in.employee_in_id' => $R2->contract_approval_current_id
					);
					$Q3 = $this->view->view_data($datato);
					if($Q3->num_rows()){
						$R3 = $Q3->row();
						
						$length = 4;
						$characters = '0123456789';
						$charactersLength = strlen($characters);
						$otp_code = '';
						for($i=0;$i<$length;$i++){
							$otp_code .= $characters[rand(0, $charactersLength - 1)];
						}
						
						unset($datato);
						$datato['table'] = 'patlog__contract.entity__otp';
						$datato['where'] = array(
							'patlog__contract.entity__otp.contract_id' => $R2->contract_id
						);
						$Q4 = $this->view->view_data($datato);
						if($Q4->num_rows()){
							$R4 = $Q4->row();
							unset($datato);
							$datato['database'] = 'patlog__contract';
							$datato['table'] = 'entity__otp';
							$datato['otp_code'] = $otp_code;
							$datato['otp_insert'] = date('Y-m-d H:i:s');
							$datato['field'] = 'contract_id';
							$datato['id'] = $R4->contract_id;
							$this->mod->update($datato);
						}else{
							unset($datato);
							$datato['database'] = 'patlog__contract';
							$datato['table'] = 'entity__otp';
							$datato['contract_id'] = $R2->contract_id;
							$datato['otp_code'] = $otp_code;
							$datato['otp_insert'] = date('Y-m-d H:i:s');
							$this->mod->insert($datato);
						}
						
						$arr_email_to = $R3->employee_in_email;
						$employee_to = $R3->employee_in_name;
						$message = '
							Dear '.$employee_to.'<br/><br/>
							Berikut Kode Verifikasi OTP Anda :<br/>
							<b style="font-size:24pt;">'.$otp_code.'</b>.<br/>
						';
						$this->email->from($email_from, $email_from_name);
						$this->email->to($arr_email_to);
						$this->email->subject($subject);
						$data = array(
							'subject' => $subject,
							'message' => $message,
							'header' => $R1->project_smtp_header,
							'company' => $R1->project_smtp_company,
							'address' => $R1->project_smtp_address
						); 
						$body = $this->load->view('email/message', $data, TRUE);
						$this->email->message($body);
						
						unset($data);
						$data['status'] = 'true';
						$data['message'] = '<label class="text-success">Kode OTP berhasil dikirim.</label>';
						
						$result = $this->email->send();
						if (!$result){
							$result = $this->email->print_debugger();
							// echo $this->email->print_debugger();
						}
						
						# Insert Log
						unset($datato);
						$datato['database'] = 'patlog__config';
						$datato['table'] = 'entity__log_email';
						$datato['log_email_name'] = 'Contract - OTP';
						$datato['log_email_to'] = $arr_email_to;
						$datato['log_email_subject'] = $subject;
						$datato['log_email_message'] = $message;
						$datato['log_email_response'] = $result;
						$datato['log_email_insert'] = date('Y-m-d H:i:s');
						$this->mod->insert($datato);
					}else{
						$data['message'] = '<label class="text-danger">User tidak ditemukan.</label>';
					}
				}else{
					$data['message'] = '<label class="text-danger">ID tidak ditemukan.</label>';
				}
			}else{
				$data['message'] = '<label class="text-danger">SMTP tidak aktif.</label>';
			}
		}
		
		echo json_encode($data, true);
	}
	
	public function notification($result)
    {
        $arr_data = $result;
        $arr_user_device_token = array();
		if(isset($arr_data['user_device_employee_in_id'])){
			for ($i = 0; $i < count($arr_data['user_device_employee_in_id']); $i++) {
				unset($datato);
				$datato['table'] = 'patlog__config.entity__user_device';
				$datato['where'] = array(
					'patlog__config.entity__user_device.user_device_employee_in_id' => $arr_data['user_device_employee_in_id'][$i]
				);
				$Q1 = $this->view->view_data($datato);
				if($Q1->num_rows()){
					foreach ($Q1->result() as $R1) {
						$arr_user_device_token[$arr_data['screen'][$i]][] = $R1->user_device_token;
					}
				}else{
					$arr_user_device_token[$arr_data['screen'][$i]] = array();
				}
			}
		}

        if (count($arr_user_device_token) > 0) {
			$api_key_access = 'AAAABmRbu20:APA91bGMV6Deykm_MDBNYiSynbft7G10-BjqBNSbpj7N4fy92H0Q98xhYtzrS-h8mpcs2u4GjBq3FJ4tFGvVQ20o6kDXn8oOMvGYSouKkuNqc2UBVwhHogw9ds7brx6wonlbUl3aOmtp';
            $project_id = 27453537133;
            $arr_json = array();

            for ($i = 0; $i < count($arr_data['screen']); $i++) {
                $id = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1, 10))), 1, 10);
                $params = array(
                    'operation' => 'create',
                    'notification_key_name' => 'patlog-erp-' . $id,
                    'registration_ids' => $arr_user_device_token[$arr_data['screen'][$i]]
                );
                $headers = array(
                    'Authorization: key=' . $api_key_access,
                    'Content-Type: application/json',
                    'project_id: ' . $project_id
                );

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/notification');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params, true));
                $result = curl_exec($ch);
                $arr_result = json_decode($result, true);

                if (isset($arr_result['notification_key'])) {
                    $unique_token = $arr_result['notification_key'];
                    $data = array(
                        'title' => $arr_data['title'],
                        'message' => $arr_data['message'],
                        'icon'  => 'icon_square',
                        'sound' => 'mySound',
                        'screen' => $arr_data['screen'][$i],
                        'detail_id' => $arr_data['detail_id']
                    );
                    $params = array(
                        'to' => $unique_token,
                        'priority' => 'high',
                        'contentAvailable' => true,
                        'notification' => array(
                            'title' => $arr_data['title'],
                            'body' => $arr_data['message']
                        ),
                        'data'  => $data
                    );
                    $headers = array(
                        'Authorization: key=' . $api_key_access,
                        'Content-Type: application/json'
                    );

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params, true));
                    $result = curl_exec($ch);

                    $arr_json[] = array(
                        'result' => json_decode($result, true),
                        'user_device_token' => $arr_user_device_token[$arr_data['screen'][$i]],
                        'status' => 'OK',
                        'message' => ''
                    );
                } else {
                    $arr_json[] = array(
                        'status' => 'ERROR',
                        'message' => 'Kunci notifikasi gagal didapat.'
                    );
                }
            }

            $data['data'] = $arr_json;
			$data['status'] = 'OK';
        } else {
            $data['status'] = 'ERROR';
            $data['message'] = 'Tidak ada token yang dikirim.';
        }
		
		echo json_encode($data, true);
    }

	// Return list of SPPK yang saat ini nyangkut di satu employee sebagai
	// Drafter role (belum done, belum delete). Dipakai popup "Jumlah SPPK
	// Diproses (Drafter)" di mapping table proses_kontrak_utama supaya
	// reviewer bisa liat sendiri list-nya tanpa perlu tanya admin.
	public function sppk_drafter_list()
	{
		$emp_id = (int)$this->input->get('employee_in_id');
		if ($emp_id <= 0) {
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('ok'=>false, 'error'=>'employee_in_id wajib')));
			return;
		}
		$rows = $this->db->query("
			SELECT c.contract_id, c.contract_no, c.contract_no_fix,
			       c.contract_company_name, c.contract_third_party_name,
			       c.contract_project_code_name,
			       c.contract_creator_employee_in_name AS drafter_awal,
			       (SELECT l.contract_log_status FROM patlog__contract.entity__contract_log l
			         WHERE l.contract_id=c.contract_id ORDER BY l.contract_log_id DESC LIMIT 1) AS last_status,
			       (SELECT l.contract_log_employee_name FROM patlog__contract.entity__contract_log l
			         WHERE l.contract_id=c.contract_id ORDER BY l.contract_log_id DESC LIMIT 1) AS last_actor,
			       (SELECT l.contract_log_insert FROM patlog__contract.entity__contract_log l
			         WHERE l.contract_id=c.contract_id ORDER BY l.contract_log_id DESC LIMIT 1) AS last_at
			  FROM patlog__contract.entity__contract c
			 WHERE c.contract_approval_current_id = ?
			   AND c.contract_approval_current_category = 'Drafter'
			   AND (c.contract_status_done   IS NULL OR c.contract_status_done   != 'yes')
			   AND (c.contract_status_delete IS NULL OR c.contract_status_delete != 'yes')
			 ORDER BY last_at DESC", array($emp_id))->result();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode(array('ok'=>true, 'items'=>$rows)));
	}

}
?>