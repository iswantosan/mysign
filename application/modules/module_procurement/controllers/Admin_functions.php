<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_functions extends MX_Controller{
    
    public function __construct(){
        parent::__construct();
		
	}
	
	public function logout()
	{
		redirect(site_url('desktop/admin/beranda/'));
	}
	
	public function data_vendor()
	{	
		if($this->uri->segment(4) == 'add'){
			unset($datato);
			$datato['table'] = 'patlog__hrms.entity__employee_in';
			$datato['where'] = array(
				'patlog__hrms.entity__employee_in.employee_in_id' => urldecode($this->input->post('vendor_employee_in_id'))
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$vendor_employee_in_id = $R1->employee_in_id;
				$vendor_employee_in_code = $R1->employee_in_code;
				$vendor_employee_in_name = $R1->employee_in_name;
			}else{
				$vendor_employee_in_id = null;
				$vendor_employee_in_code = null;
				$vendor_employee_in_name = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__legal';
			$datato['where'] = array(
				'patlog__procurement.data__legal.legal_entity_id' => urldecode($this->input->post('vendor_legal_entity_id'))
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$vendor_legal_entity_id = $R1->legal_entity_id;
				$vendor_legal_entity_name = $R1->legal_entity_name;
			}else{
				$vendor_legal_entity_id = null;
				$vendor_legal_entity_name = null;
			}

			$ktp = base64_encode($this->input->post('vendor_id_card'));
			$npwp = base64_encode($this->input->post('vendor_tax_number'));
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__vendor';
			$datato['where'] = array(
				'patlog__procurement.entity__vendor.vendor_id_card' => $ktp
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$this->session->set_flashdata('danger', 'Data KTP Penanggung Jawab Perusahaan Sudah Terdaftar Pada Data Vendor Lain.');
				redirect(site_url().'module_procurement/admin/vendor_registrasi/');
			}

			unset($datato);
			$datato['table'] = 'patlog__value.entity__province';
			$datato['where'] = array(
				'patlog__value.entity__province.province_id' => urldecode($this->input->post('vendor_province_id'))
			);
			$Q1 = $this->view->view_data($datato);
			if ($Q1->num_rows()) {
				$R1 = $Q1->row();
				$province_id = $R1->province_id;
				$province_name = $R1->province_name;
			}else{
				$province_id = null;
				$province_name = null;
			}

			unset($datato);
			$datato['table'] = 'patlog__value.entity__city';
			$datato['where'] = array(
				'patlog__value.entity__city.city_id' => urldecode($this->input->post('vendor_city_id'))
			);
			$Q1 = $this->view->view_data($datato);
			if ($Q1->num_rows()) {
				$R1 = $Q1->row();
				$city_id = $R1->city_id;
				$city_name = $R1->city_name;
			}else{
				$city_id = null;
				$city_name = null;
			}

			unset($datato);
			$datato['table'] = 'patlog__value.entity__district';
			$datato['where'] = array(
				'patlog__value.entity__district.district_id' => urldecode($this->input->post('vendor_district_id'))
			);
			$Q1 = $this->view->view_data($datato);
			if ($Q1->num_rows()) {
				$R1 = $Q1->row();
				$district_id = $R1->district_id;
				$district_name = $R1->district_name;
			}else{
				$district_id = null;
				$district_name = null;
			}

			unset($datato);
			$datato['table'] = 'patlog__value.entity__village';
			$datato['where'] = array(
				'patlog__value.entity__village.village_id' => urldecode($this->input->post('vendor_village_id'))
			);
			$Q1 = $this->view->view_data($datato);
			if ($Q1->num_rows()) {
				$R1 = $Q1->row();
				$village_id = $R1->village_id;
				$village_name = $R1->village_name;
			}else{
				$village_id = null;
				$village_name = null;
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
				'patlog__config.entity__approval.approval_type_id' => 1
			);
			$datato['order'] = array(
				'patlog__config.entity__approval_detail.approval_detail_level'
			);
			$datato['order_type'] = array(
				'desc'
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$vendor_approval_id = $R1->approval_detail_employee_in_id;
			}else{
				$vendor_approval_id = null;
			}
			
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__vendor';
			$datato['vendor_employee_in_id'] = $vendor_employee_in_id;
			$datato['vendor_employee_in_code'] = $vendor_employee_in_code;
			$datato['vendor_employee_in_name'] = $vendor_employee_in_name;
			$datato['vendor_legal_entity_id'] = $vendor_legal_entity_id;
			$datato['vendor_legal_entity_name'] = $vendor_legal_entity_name;
			$datato['vendor_province_id'] = $province_id;
			$datato['vendor_province_name'] = $province_name;
			$datato['vendor_city_id'] = $city_id;
			$datato['vendor_city_name'] = $city_name;
			$datato['vendor_district_id'] = $district_id;
			$datato['vendor_district_name'] = $district_name;
			$datato['vendor_village_id'] = $village_id;
			$datato['vendor_village_name'] = $village_name;
			$datato['vendor_code_mysap'] = $this->input->post('vendor_code_mysap');
			$datato['vendor_name'] = $this->input->post('vendor_name');
			$datato['vendor_street_building'] = $this->input->post('vendor_street_building');
			$datato['vendor_postal_code'] = $this->input->post('vendor_postal_code');
			$datato['vendor_region'] = $this->input->post('vendor_region');
			$datato['vendor_phone'] = $this->input->post('vendor_phone');
			$datato['vendor_email'] = $this->input->post('vendor_email');
			$datato['vendor_email_marketing'] = $this->input->post('vendor_email_marketing');
			$datato['vendor_id_card'] = $ktp;
			$datato['vendor_sales_name'] = $this->input->post('vendor_sales_name');
			$datato['vendor_sales_phone_number'] = $this->input->post('vendor_sales_phone_number');
			$datato['vendor_taxation_status'] = urldecode($this->input->post('vendor_taxation_status'));
			$datato['vendor_building_status'] = urldecode($this->input->post('vendor_building_status'));
			$datato['vendor_status_company'] = urldecode($this->input->post('vendor_status_company'));
			$datato['vendor_branch_number'] = $this->input->post('vendor_branch_number');
			$datato['vendor_company_owner_name'] = $this->input->post('vendor_company_owner_name');
			$datato['vendor_total_employee'] = $this->input->post('vendor_total_employee');
			$datato['vendor_category'] = urldecode($this->input->post('vendor_category'));
			$datato['vendor_csms'] = urldecode($this->input->post('vendor_csms'));
			$datato['vendor_quota_tad'] = $this->input->post('vendor_quota_tad');
			$datato['vendor_tax_number'] = $npwp;
			$datato['vendor_agency_type'] = urldecode($this->input->post('vendor_agency_type'));
			$datato['vendor_distributor_type'] = urldecode($this->input->post('vendor_distributor_type'));
			$datato['vendor_document_siup'] = 'no.pdf';
			$datato['vendor_document_deed_incorporation'] = 'no.pdf';
			$datato['vendor_document_change'] = 'no.pdf';
			$datato['vendor_document_sign_company'] = 'no.pdf';
			$datato['vendor_document_domicile_information'] = 'no.pdf';
			$datato['vendor_document_sppkp'] = 'no.pdf';
			$datato['vendor_document_finance_report'] = 'no.pdf';
			$datato['vendor_document_statement_later'] = 'no.pdf';
			$datato['vendor_document_po_spk'] = 'no.pdf';
			$datato['vendor_document_csms'] = 'no.pdf';
			$datato['vendor_document_iso'] = 'no.pdf';
			$datato['vendor_document_bank_reference'] = 'no.pdf';
			$datato['vendor_document_bank_attorney'] = 'no.pdf';
			$datato['vendor_approval_id'] = $vendor_approval_id;
			$datato['vendor_level'] = 1;
			$datato['vendor_actor'] = $vendor_employee_in_name;
			$datato['vendor_status'] = 'Waiting';
			$datato['vendor_done'] = 'no';
			$datato['vendor_insert'] = date('Y-m-d H:i:s');
			$vendor_id = $this->mod->insert($datato);

			$vendor_code = 'V-'.date('Y').'-'.$vendor_id;
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__vendor';
			$datato['vendor_code'] = $vendor_code;
			$datato['field'] = 'vendor_id';
			$datato['id'] = $vendor_id;
			$this->mod->update($datato);

			$arr_vendor_agency_name = $this->input->post('vendor_agency_name');
			foreach($_FILES['vendor_agency_file'] as $key => $file){
				$data[$key] = $_FILES['vendor_agency_file'][$key];
			}
			for($i=0;$i<count($arr_vendor_agency_name);$i++){
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor_agency';
				$datato['vendor_id'] = $vendor_id;
				$datato['vendor_agency_name'] = $arr_vendor_agency_name[$i];
				$datato['vendor_agency_file'] = 'no.pdf';
				$datato['vendor_agency_insert'] = date('Y-m-d H:i:s');
				$vendor_agency_id = $this->mod->insert($datato);
				
				$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
				$file_name = 'document-vendor-attachment-'.md5($vendor_id).'-'.md5($vendor_agency_id).'.'.$ext;
				$path = './assets/mod__procurement/attach/uploads/vendor/'.$file_name;
				$arr_type = array(
					'application/pdf'
				);
				if(in_array($data['type'][$i], $arr_type)){
					move_uploaded_file($data['tmp_name'][$i], $path);
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor_agency';
					$datato['vendor_agency_file'] = $file_name;
					$datato['field'] = 'vendor_agency_id';
					$datato['id'] = $vendor_agency_id;
					$this->mod->update($datato);
				}
			}

			$arr_vendor_distributor_name = $this->input->post('vendor_distributor_name');
			foreach($_FILES['vendor_distributor_file'] as $key => $file){
				$data[$key] = $_FILES['vendor_distributor_file'][$key];
			}
			for($i=0;$i<count($arr_vendor_distributor_name);$i++){
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor_distributor';
				$datato['vendor_id'] = $vendor_id;
				$datato['vendor_distributor_name'] = $arr_vendor_distributor_name[$i];
				$datato['vendor_distributor_file'] = 'no.pdf';
				$datato['vendor_distributor_insert'] = date('Y-m-d H:i:s');
				$vendor_distributor_id = $this->mod->insert($datato);
				
				$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
				$file_name = 'document-distributor-attachment-'.md5($vendor_id).'-'.md5($vendor_distributor_id).'.'.$ext;
				$path = './assets/mod__procurement/attach/uploads/distributor/'.$file_name;
				$arr_type = array(
					'application/pdf'
				);
				if(in_array($data['type'][$i], $arr_type)){
					move_uploaded_file($data['tmp_name'][$i], $path);
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor_distributor';
					$datato['vendor_distributor_file'] = $file_name;
					$datato['field'] = 'vendor_distributor_id';
					$datato['id'] = $vendor_distributor_id;
					$this->mod->update($datato);
				}
			}
			
			if(!empty($this->input->post('kbli_id'))){
				unset($data);
				foreach($_FILES['vendor_kbli_legality_attachment'] as $key => $file){
					$data[$key] = $_FILES['vendor_kbli_legality_attachment'][$key];
				}
				$arr_kbli_id = $this->input->post('kbli_id');
				$arr_kbli_legality_id = $this->input->post('kbli_legality_id');
				for($i=0;$i<count($arr_kbli_id);$i++){
					unset($datato);
					$datato['table'] = 'patlog__procurement.data__kbli';
					$datato['where'] = array(
						'patlog__procurement.data__kbli.kbli_id' => urldecode($arr_kbli_id[$i])
					);
					$Q1 = $this->view->view_data($datato);
					if ($Q1->num_rows()) {
						$R1 = $Q1->row();
						$kbli_id = $R1->kbli_id;
						$kbli_code = $R1->kbli_code;
						$kbli_name = $R1->kbli_name;
					}else{
						$kbli_id = null;
						$kbli_code = null;
						$kbli_name = null;
					}
					
					unset($datato);
					$datato['table'] = 'patlog__procurement.data__kbli_legality';
					$datato['where'] = array(
						'patlog__procurement.data__kbli_legality.kbli_legality_id' => urldecode($arr_kbli_legality_id[$i])
					);
					$Q1 = $this->view->view_data($datato);
					if ($Q1->num_rows()) {
						$R1 = $Q1->row();
						$kbli_legality_id = $R1->kbli_legality_id;
						$kbli_legality_name = $R1->kbli_legality_name;
					}else{
						$kbli_legality_name = null;
						$kbli_legality_name = null;
					}

					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor_kbli';
					$datato['vendor_id'] = $vendor_id;
					$datato['kbli_id'] = $kbli_id;
					$datato['vendor_kbli_code'] = $kbli_code;
					$datato['vendor_kbli_name'] = $kbli_name;
					$datato['vendor_kbli_legality_id'] = $kbli_legality_id;
					$datato['vendor_kbli_legality_name'] = $kbli_legality_name;
					$datato['vendor_kbli_legality_attachment'] = 'no.pdf';
					$datato['vendor_kbli_insert'] = date('Y-m-d H:i:s');
					$vendor_kbli_id = $this->mod->insert($datato);
					
					if(!empty($data['tmp_name'][$i])){
						$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
						$file_name = 'vendor-kbli-legality-attachment-'.md5($vendor_id).'-'.md5($vendor_kbli_id).'.'.$ext;
						$path = './assets/mod__procurement/attach/vendor-kbli-legality-attachment/'.$file_name;
						$arr_type = array(
							'application/pdf'
						);
						if(in_array($data['type'][$i], $arr_type)){
							move_uploaded_file($data['tmp_name'][$i], $path);
							unset($datato);
							$datato['database'] = 'patlog__procurement';
							$datato['table'] = 'entity__vendor_kbli';
							$datato['vendor_kbli_legality_attachment'] = $file_name;
							$datato['field'] = 'vendor_kbli_id';
							$datato['id'] = $vendor_kbli_id;
							$this->mod->update($datato);
						}
					}
				}
			}

			$arr_vendor_pic_name = $this->input->post('vendor_pic_name');
			$arr_vendor_pic_position = $this->input->post('vendor_pic_position');
			for($i=0;$i<count($arr_vendor_pic_name);$i++){
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor_pic';
				$datato['vendor_id'] = $vendor_id;
				$datato['vendor_pic_name'] = $arr_vendor_pic_name[$i];
				$datato['vendor_pic_position'] = $arr_vendor_pic_position[$i];
				$datato['vendor_pic_insert'] = date('Y-m-d H:i:s');
				$vendor_pic_id = $this->mod->insert($datato);
			}
			
			if(!empty($this->input->post('bank_id'))){
				// unset($data);
				// foreach($_FILES['vendor_bank_attachment'] as $key => $file){
					// $data[$key] = $_FILES['vendor_bank_attachment'][$key];
				// }
				$arr_bank_id = $this->input->post('bank_id');
				$arr_vendor_bank_number = $this->input->post('vendor_bank_number');
				$arr_vendor_bank_branch = $this->input->post('vendor_bank_branch');
				$arr_vendor_bank_holder_name = $this->input->post('vendor_bank_holder_name');
				for($i=0;$i<count($arr_bank_id);$i++){
					unset($datato);
					$datato['table'] = 'patlog__value.entity__bank';
					$datato['where'] = array(
						'patlog__value.entity__bank.bank_id' => $arr_bank_id[$i]
					);
					$Q1 = $this->view->view_data($datato);
					if ($Q1->num_rows()) {
						$R1 = $Q1->row();
						$bank_id = $R1->bank_id;
						$bank_code = $R1->bank_code;
						$bank_name = $R1->bank_name;
					}else{
						$bank_id = null;
						$bank_code = null;
						$bank_name = null;
					}

					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor_bank';
					$datato['bank_id'] = $bank_id;
					$datato['vendor_id'] = $vendor_id;
					$datato['vendor_bank_name'] = $bank_name;
					$datato['vendor_bank_number'] = $arr_vendor_bank_number[$i];
					$datato['vendor_bank_branch'] = $arr_vendor_bank_branch[$i];
					$datato['vendor_bank_holder_name'] = $arr_vendor_bank_holder_name[$i];
					$datato['vendor_bank_attachment'] = 'no.pdf';
					$datato['vendor_bank_insert'] = date('Y-m-d H:i:s');
					$vendor_bank_id = $this->mod->insert($datato);
					
					// if(!empty($data['tmp_name'][$i])){
						// $ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
						// $file_name = 'vendor-bank-attachment-'.md5($vendor_id).'-'.md5($vendor_bank_id).'.'.$ext;
						// $path = './assets/mod__procurement/attach/vendor-bank-attachment/'.$file_name;
						// $arr_type = array(
							// 'application/pdf'
						// );
						// if(in_array($data['type'][$i], $arr_type)){
							// move_uploaded_file($data['tmp_name'][$i], $path);
							// unset($datato);
							// $datato['database'] = 'patlog__procurement';
							// $datato['table'] = 'entity__vendor_bank';
							// $datato['vendor_bank_attachment'] = $file_name;
							// $datato['field'] = 'vendor_bank_id';
							// $datato['id'] = $vendor_bank_id;
							// $this->mod->update($datato);
						// }
					// }
				}
			}
			
			foreach($_FILES['vendor_document_siup'] as $key => $file){
				$data[$key] = $_FILES['vendor_document_siup'][$key];
			}
			$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
			$file_name = 'siup-'.md5($vendor_id).'.'.$ext;
			$path = './assets/mod__procurement/attach/uploads/siup/'.$file_name;
			$arr_type = array(
				'application/pdf'
			);
			if(in_array($data['type'], $arr_type)){
				move_uploaded_file($data['tmp_name'], $path);
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor';
				$datato['vendor_document_siup'] = $file_name;
				$datato['field'] = 'vendor_id';
				$datato['id'] = $vendor_id;
				$this->mod->update($datato);
			}
			
			foreach($_FILES['vendor_document_deed_incorporation'] as $key => $file){
				$data[$key] = $_FILES['vendor_document_deed_incorporation'][$key];
			}
			$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
			$file_name = 'akta_pendirian-'.md5($vendor_id).'.'.$ext;
			$path = './assets/mod__procurement/attach/uploads/akta_pendirian/'.$file_name;
			$arr_type = array(
				'application/pdf'
			);
			if(in_array($data['type'], $arr_type)){
				move_uploaded_file($data['tmp_name'], $path);
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor';
				$datato['vendor_document_deed_incorporation'] = $file_name;
				$datato['field'] = 'vendor_id';
				$datato['id'] = $vendor_id;
				$this->mod->update($datato);
			}
			
			foreach($_FILES['vendor_document_change'] as $key => $file){
				$data[$key] = $_FILES['vendor_document_change'][$key];
			}
			$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
			$file_name = 'akta_perubahan-'.md5($vendor_id).'.'.$ext;
			$path = './assets/mod__procurement/attach/uploads/akta_perubahan/'.$file_name;
			$arr_type = array(
				'application/pdf'
			);
			if(in_array($data['type'], $arr_type)){
				move_uploaded_file($data['tmp_name'], $path);
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor';
				$datato['vendor_document_change'] = $file_name;
				$datato['field'] = 'vendor_id';
				$datato['id'] = $vendor_id;
				$this->mod->update($datato);
			}
			
			foreach($_FILES['vendor_document_sign_company'] as $key => $file){
				$data[$key] = $_FILES['vendor_document_sign_company'][$key];
			}
			$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
			$file_name = 'tanda_daftar_perusahaan-'.md5($vendor_id).'.'.$ext;
			$path = './assets/mod__procurement/attach/uploads/tanda_daftar_perusahaan/'.$file_name;
			$arr_type = array(
				'application/pdf'
			);
			if(in_array($data['type'], $arr_type)){
				move_uploaded_file($data['tmp_name'], $path);
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor';
				$datato['vendor_document_sign_company'] = $file_name;
				$datato['field'] = 'vendor_id';
				$datato['id'] = $vendor_id;
				$this->mod->update($datato);
			}
			
			foreach($_FILES['vendor_document_domicile_information'] as $key => $file){
				$data[$key] = $_FILES['vendor_document_domicile_information'][$key];
			}
			$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
			$file_name = 'surat_domisili-'.md5($vendor_id).'.'.$ext;
			$path = './assets/mod__procurement/attach/uploads/surat_domisili/'.$file_name;
			$arr_type = array(
				'application/pdf'
			);
			if(in_array($data['type'], $arr_type)){
				move_uploaded_file($data['tmp_name'], $path);
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor';
				$datato['vendor_document_domicile_information'] = $file_name;
				$datato['field'] = 'vendor_id';
				$datato['id'] = $vendor_id;
				$this->mod->update($datato);
			}
			
			foreach($_FILES['vendor_document_sppkp'] as $key => $file){
				$data[$key] = $_FILES['vendor_document_sppkp'][$key];
			}
			$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
			$file_name = 'sk_pajak-'.md5($vendor_id).'.'.$ext;
			$path = './assets/mod__procurement/attach/uploads/sk_pajak/'.$file_name;
			$arr_type = array(
				'application/pdf'
			);
			if(in_array($data['type'], $arr_type)){
				move_uploaded_file($data['tmp_name'], $path);
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor';
				$datato['vendor_document_sppkp'] = $file_name;
				$datato['field'] = 'vendor_id';
				$datato['id'] = $vendor_id;
				$this->mod->update($datato);
			}
			
			foreach($_FILES['vendor_document_finance_report'] as $key => $file){
				$data[$key] = $_FILES['vendor_document_finance_report'][$key];
			}
			$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
			$file_name = 'laporan_keuangan-'.md5($vendor_id).'.'.$ext;
			$path = './assets/mod__procurement/attach/uploads/laporan_keuangan/'.$file_name;
			$arr_type = array(
				'application/pdf'
			);
			if(in_array($data['type'], $arr_type)){
				move_uploaded_file($data['tmp_name'], $path);
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor';
				$datato['vendor_document_finance_report'] = $file_name;
				$datato['field'] = 'vendor_id';
				$datato['id'] = $vendor_id;
				$this->mod->update($datato);
			}
			
			foreach($_FILES['vendor_document_statement_later'] as $key => $file){
				$data[$key] = $_FILES['vendor_document_statement_later'][$key];
			}
			$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
			$file_name = 'surat_pernyataan-'.md5($vendor_id).'.'.$ext;
			$path = './assets/mod__procurement/attach/uploads/surat_pernyataan/'.$file_name;
			$arr_type = array(
				'application/pdf'
			);
			if(in_array($data['type'], $arr_type)){
				move_uploaded_file($data['tmp_name'], $path);
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor';
				$datato['vendor_document_statement_later'] = $file_name;
				$datato['field'] = 'vendor_id';
				$datato['id'] = $vendor_id;
				$this->mod->update($datato);
			}
			
			foreach($_FILES['vendor_document_po_spk'] as $key => $file){
				$data[$key] = $_FILES['vendor_document_po_spk'][$key];
			}
			$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
			$file_name = 'surat_pengalaman_perusahaan-'.md5($vendor_id).'.'.$ext;
			$path = './assets/mod__procurement/attach/uploads/surat_pengalaman_perusahaan/'.$file_name;
			$arr_type = array(
				'application/pdf'
			);
			if(in_array($data['type'], $arr_type)){
				move_uploaded_file($data['tmp_name'], $path);
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor';
				$datato['vendor_document_po_spk'] = $file_name;
				$datato['field'] = 'vendor_id';
				$datato['id'] = $vendor_id;
				$this->mod->update($datato);
			}
			
			foreach($_FILES['vendor_document_csms'] as $key => $file){
				$data[$key] = $_FILES['vendor_document_csms'][$key];
			}
			$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
			$file_name = 'sertifikat_csms-'.md5($vendor_id).'.'.$ext;
			$path = './assets/mod__procurement/attach/uploads/sertifikat_csms/'.$file_name;
			$arr_type = array(
				'application/pdf'
			);
			if(in_array($data['type'], $arr_type)){
				move_uploaded_file($data['tmp_name'], $path);
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor';
				$datato['vendor_document_csms'] = $file_name;
				$datato['field'] = 'vendor_id';
				$datato['id'] = $vendor_id;
				$this->mod->update($datato);
			}
			
			foreach($_FILES['vendor_document_iso'] as $key => $file){
				$data[$key] = $_FILES['vendor_document_iso'][$key];
			}
			$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
			$file_name = 'sertifikat_ISO-'.md5($vendor_id).'.'.$ext;
			$path = './assets/mod__procurement/attach/uploads/sertifikat_ISO/'.$file_name;
			$arr_type = array(
				'application/pdf'
			);
			if(in_array($data['type'], $arr_type)){
				move_uploaded_file($data['tmp_name'], $path);
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor';
				$datato['vendor_document_iso'] = $file_name;
				$datato['field'] = 'vendor_id';
				$datato['id'] = $vendor_id;
				$this->mod->update($datato);
			}
			
			foreach($_FILES['vendor_document_bank_reference'] as $key => $file){
				$data[$key] = $_FILES['vendor_document_bank_reference'][$key];
			}
			$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
			$file_name = 'referensi_bank-'.md5($vendor_id).'.'.$ext;
			$path = './assets/mod__procurement/attach/uploads/referensi_bank/'.$file_name;
			$arr_type = array(
				'application/pdf'
			);
			if(in_array($data['type'], $arr_type)){
				move_uploaded_file($data['tmp_name'], $path);
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor';
				$datato['vendor_document_bank_reference'] = $file_name;
				$datato['field'] = 'vendor_id';
				$datato['id'] = $vendor_id;
				$this->mod->update($datato);
			}
			
			foreach($_FILES['vendor_document_bank_attorney'] as $key => $file){
				$data[$key] = $_FILES['vendor_document_bank_attorney'][$key];
			}
			$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
			$file_name = 'surat_kuasa_bank-'.md5($vendor_id).'.'.$ext;
			$path = './assets/mod__procurement/attach/uploads/surat_kuasa_bank/'.$file_name;
			$arr_type = array(
				'application/pdf'
			);
			if(in_array($data['type'], $arr_type)){
				move_uploaded_file($data['tmp_name'], $path);
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor';
				$datato['vendor_document_bank_attorney'] = $file_name;
				$datato['field'] = 'vendor_id';
				$datato['id'] = $vendor_id;
				$this->mod->update($datato);
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
				'patlog__config.entity__approval.approval_type_id' => 1
			);
			$Q1 = $this->view->view_data($datato);
			foreach($Q1->result() as $R1){
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor_approval';
				$datato['vendor_id'] = $vendor_id;
				$datato['vendor_approval_level'] = $R1->approval_detail_level;
				$datato['employee_in_id'] = $R1->approval_detail_employee_in_id;
				$datato['vendor_approval_code'] = $R1->approval_detail_employee_in_code;
				$datato['vendor_approval_name'] = $R1->approval_detail_employee_in_name;
				$datato['vendor_approval_position'] = $R1->approval_detail_employee_in_position;
				$datato['vendor_approval_status'] = null;
				$datato['vendor_approval_date'] = null;
				$datato['vendor_approval_created'] = date('Y-m-d H:i:s');
				$datato['vendor_approval_modified'] = date('Y-m-d H:i:s');
				$vendor_approval_id = $this->mod->insert($datato);
			}

			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__vendor_log';
			$datato['where'] = array(
				'patlog__procurement.entity__vendor_log.vendor_id' => $vendor_id
			);
			$Q1 = $this->view->view_data($datato);
			$vendor_log_level = $Q1->num_rows() + 1;

			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__vendor_log';
			$datato['vendor_id'] = $vendor_id;
			$datato['vendor_log_level'] = $vendor_log_level;
			$datato['vendor_log_name'] = $vendor_employee_in_name;
			$datato['vendor_log_status'] = 'Waiting';
			$datato['vendor_log_message'] = 'Ditambah';
			$datato['vendor_log_information'] = '';
			$datato['vendor_log_insert'] = date('Y-m-d H:i:s');
			$vendor_log_id = $this->mod->insert($datato);
			
			$this->session->set_flashdata('success', 'Data berhasil ditambah.');
			redirect(site_url().'module_procurement/admin/vendor_proses/');
		}elseif($this->uri->segment(4) == 'edit'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$vendor_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__vendor';
			$datato['where'] = array(
				'patlog__procurement.entity__vendor.vendor_id' => $vendor_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['table'] = 'patlog__procurement.data__legal';
				$datato['where'] = array(
					'patlog__procurement.data__legal.legal_entity_id' => urldecode($this->input->post('vendor_legal_entity_id'))
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$vendor_legal_entity_id = $R2->legal_entity_id;
					$vendor_legal_entity_name = $R2->legal_entity_name;
				}else{
					$vendor_legal_entity_id = null;
					$vendor_legal_entity_name = null;
				}

				$ktp = base64_encode($this->input->post('vendor_id_card'));
				$npwp = base64_encode($this->input->post('vendor_tax_number'));
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__vendor';
				$datato['where'] = array(
					'patlog__procurement.entity__vendor.vendor_id != ' => $R1->vendor_id,
					'patlog__procurement.entity__vendor.vendor_id_card' => $ktp
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$this->session->set_flashdata('danger', 'Data KTP Penanggung Jawab Perusahaan Sudah Terdaftar Pada Data Vendor Lain.');
					redirect(site_url().'module_procurement/admin/vendor_proses?view=manipulation&action=edit&vendor_id='.$this->input->post('vendor_id'));
				}

				unset($datato);
				$datato['table'] = 'patlog__value.entity__province';
				$datato['where'] = array(
					'patlog__value.entity__province.province_id' => urldecode($this->input->post('vendor_province_id'))
				);
				$Q2 = $this->view->view_data($datato);
				if ($Q2->num_rows()) {
					$R2 = $Q2->row();
					$province_id = $R2->province_id;
					$province_name = $R2->province_name;
				}else{
					$province_id = null;
					$province_name = null;
				}

				unset($datato);
				$datato['table'] = 'patlog__value.entity__city';
				$datato['where'] = array(
					'patlog__value.entity__city.city_id' => urldecode($this->input->post('vendor_city_id'))
				);
				$Q2 = $this->view->view_data($datato);
				if ($Q2->num_rows()) {
					$R2 = $Q2->row();
					$city_id = $R2->city_id;
					$city_name = $R2->city_name;
				}else{
					$city_id = null;
					$city_name = null;
				}

				unset($datato);
				$datato['table'] = 'patlog__value.entity__district';
				$datato['where'] = array(
					'patlog__value.entity__district.district_id' => urldecode($this->input->post('vendor_district_id'))
				);
				$Q2 = $this->view->view_data($datato);
				if ($Q2->num_rows()) {
					$R2 = $Q2->row();
					$district_id = $R2->district_id;
					$district_name = $R2->district_name;
				}else{
					$district_id = null;
					$district_name = null;
				}

				unset($datato);
				$datato['table'] = 'patlog__value.entity__village';
				$datato['where'] = array(
					'patlog__value.entity__village.village_id' => urldecode($this->input->post('vendor_village_id'))
				);
				$Q2 = $this->view->view_data($datato);
				if ($Q2->num_rows()) {
					$R2 = $Q2->row();
					$village_id = $R2->village_id;
					$village_name = $R2->village_name;
				}else{
					$village_id = null;
					$village_name = null;
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
					'patlog__config.entity__approval.approval_type_id' => 1
				);
				$datato['order'] = array(
					'patlog__config.entity__approval_detail.approval_detail_level'
				);
				$datato['order_type'] = array(
					'desc'
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$vendor_approval_id = $R2->approval_detail_employee_in_id;
				}else{
					$vendor_approval_id = null;
				}
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor';
				$datato['vendor_legal_entity_id'] = $vendor_legal_entity_id;
				$datato['vendor_province_id'] = $province_id;
				$datato['vendor_province_name'] = $province_name;
				$datato['vendor_city_id'] = $city_id;
				$datato['vendor_city_name'] = $city_name;
				$datato['vendor_district_id'] = $district_id;
				$datato['vendor_district_name'] = $district_name;
				$datato['vendor_village_id'] = $village_id;
				$datato['vendor_village_name'] = $village_name;
				$datato['vendor_code_mysap'] = $this->input->post('vendor_code_mysap');
				$datato['vendor_name'] = $this->input->post('vendor_name');
				$datato['vendor_street_building'] = $this->input->post('vendor_street_building');
				$datato['vendor_postal_code'] = $this->input->post('vendor_postal_code');
				$datato['vendor_region'] = $this->input->post('vendor_region');
				$datato['vendor_phone'] = $this->input->post('vendor_phone');
				$datato['vendor_email'] = $this->input->post('vendor_email');
				$datato['vendor_email_marketing'] = $this->input->post('vendor_email_marketing');
				$datato['vendor_id_card'] = $ktp;
				$datato['vendor_sales_name'] = $this->input->post('vendor_sales_name');
				$datato['vendor_sales_phone_number'] = $this->input->post('vendor_sales_phone_number');
				$datato['vendor_taxation_status'] = urldecode($this->input->post('vendor_taxation_status'));
				$datato['vendor_building_status'] = urldecode($this->input->post('vendor_building_status'));
				$datato['vendor_status_company'] = urldecode($this->input->post('vendor_status_company'));
				$datato['vendor_branch_number'] = $this->input->post('vendor_branch_number');
				$datato['vendor_company_owner_name'] = $this->input->post('vendor_company_owner_name');
				$datato['vendor_total_employee'] = $this->input->post('vendor_total_employee');
				$datato['vendor_category'] = urldecode($this->input->post('vendor_category'));
				$datato['vendor_csms'] = urldecode($this->input->post('vendor_csms'));
				$datato['vendor_quota_tad'] = $this->input->post('vendor_quota_tad');
				$datato['vendor_tax_number'] = $npwp;
				$datato['vendor_agency_type'] = urldecode($this->input->post('vendor_agency_type'));
				$datato['vendor_distributor_type'] = urldecode($this->input->post('vendor_distributor_type'));
				if($R1->vendor_status == 'Reject'){
					$datato['vendor_approval_id'] = $vendor_approval_id;
					$datato['vendor_level'] = 1;
					$datato['vendor_actor'] = $R1->vendor_employee_in_name;
					$datato['vendor_status'] = 'Waiting';
				}
				$datato['field'] = 'vendor_id';
				$datato['id'] = $R1->vendor_id;
				$this->mod->update($datato);

				$arr_vendor_agency_id = $this->input->post('vendor_agency_id');
				$arr_vendor_agency_name = $this->input->post('vendor_agency_name');
				foreach($_FILES['vendor_agency_file'] as $key => $file){
					$data[$key] = $_FILES['vendor_agency_file'][$key];
				}
				for($i=0;$i<count($arr_vendor_agency_name);$i++){
					if(isset($arr_vendor_agency_id[$i])){
						unset($datato);
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__vendor_agency';
						$datato['vendor_agency_name'] = $arr_vendor_agency_name[$i];
						$datato['field'] = 'vendor_agency_id';
						$datato['id'] = $arr_vendor_agency_id[$i];
						$this->mod->update($datato);
						
						$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
						$file_name = 'document-vendor-attachment-'.md5($R1->vendor_id).'-'.md5($arr_vendor_agency_id[$i]).'.'.$ext;
						$path = './assets/mod__procurement/attach/uploads/vendor/'.$file_name;
						$arr_type = array(
							'application/pdf'
						);
						if(in_array($data['type'][$i], $arr_type)){
							move_uploaded_file($data['tmp_name'][$i], $path);
							unset($datato);
							$datato['database'] = 'patlog__procurement';
							$datato['table'] = 'entity__vendor_agency';
							$datato['vendor_agency_file'] = $file_name;
							$datato['field'] = 'vendor_agency_id';
							$datato['id'] = $arr_vendor_agency_id[$i];
							$this->mod->update($datato);
						}
					}else{
						unset($datato);
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__vendor_agency';
						$datato['vendor_id'] = $R1->vendor_id;
						$datato['vendor_agency_name'] = $arr_vendor_agency_name[$i];
						$datato['vendor_agency_file'] = 'no.pdf';
						$datato['vendor_agency_insert'] = date('Y-m-d H:i:s');
						$vendor_agency_id = $this->mod->insert($datato);
						
						$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
						$file_name = 'document-vendor-attachment-'.md5($R1->vendor_id).'-'.md5($vendor_agency_id).'.'.$ext;
						$path = './assets/mod__procurement/attach/uploads/vendor/'.$file_name;
						$arr_type = array(
							'application/pdf'
						);
						if(in_array($data['type'][$i], $arr_type)){
							move_uploaded_file($data['tmp_name'][$i], $path);
							unset($datato);
							$datato['database'] = 'patlog__procurement';
							$datato['table'] = 'entity__vendor_agency';
							$datato['vendor_agency_file'] = $file_name;
							$datato['field'] = 'vendor_agency_id';
							$datato['id'] = $vendor_agency_id;
							$this->mod->update($datato);
						}
					}
				}

				$arr_vendor_distributor_id = $this->input->post('vendor_distributor_id');
				$arr_vendor_distributor_name = $this->input->post('vendor_distributor_name');
				foreach($_FILES['vendor_distributor_file'] as $key => $file){
					$data[$key] = $_FILES['vendor_distributor_file'][$key];
				}
				for($i=0;$i<count($arr_vendor_distributor_name);$i++){
					if(isset($arr_vendor_distributor_id[$i])){
						unset($datato);
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__vendor_distributor';
						$datato['vendor_distributor_name'] = $arr_vendor_distributor_name[$i];
						$datato['field'] = 'vendor_distributor_id';
						$datato['id'] = $arr_vendor_distributor_id[$i];
						$this->mod->update($datato);
						
						$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
						$file_name = 'document-distributor-attachment-'.md5($R1->vendor_id).'-'.md5($arr_vendor_distributor_id[$i]).'.'.$ext;
						$path = './assets/mod__procurement/attach/uploads/distributor/'.$file_name;
						$arr_type = array(
							'application/pdf'
						);
						if(in_array($data['type'][$i], $arr_type)){
							move_uploaded_file($data['tmp_name'][$i], $path);
							unset($datato);
							$datato['database'] = 'patlog__procurement';
							$datato['table'] = 'entity__vendor_distributor';
							$datato['vendor_distributor_file'] = $file_name;
							$datato['field'] = 'vendor_distributor_id';
							$datato['id'] = $arr_vendor_distributor_id[$i];
							$this->mod->update($datato);
						}
					}else{
						unset($datato);
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__vendor_distributor';
						$datato['vendor_id'] = $R1->vendor_id;
						$datato['vendor_distributor_name'] = $arr_vendor_distributor_name[$i];
						$datato['vendor_distributor_file'] = 'no.pdf';
						$datato['vendor_distributor_insert'] = date('Y-m-d H:i:s');
						$vendor_distributor_id = $this->mod->insert($datato);
						
						$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
						$file_name = 'document-distributor-attachment-'.md5($R1->vendor_id).'-'.md5($vendor_distributor_id).'.'.$ext;
						$path = './assets/mod__procurement/attach/uploads/distributor/'.$file_name;
						$arr_type = array(
							'application/pdf'
						);
						if(in_array($data['type'][$i], $arr_type)){
							move_uploaded_file($data['tmp_name'][$i], $path);
							unset($datato);
							$datato['database'] = 'patlog__procurement';
							$datato['table'] = 'entity__vendor_distributor';
							$datato['vendor_distributor_file'] = $file_name;
							$datato['field'] = 'vendor_distributor_id';
							$datato['id'] = $vendor_distributor_id;
							$this->mod->update($datato);
						}
					}
				}
				
				if(!empty($this->input->post('kbli_id'))){
					unset($data);
					foreach($_FILES['vendor_kbli_legality_attachment'] as $key => $file){
						$data[$key] = $_FILES['vendor_kbli_legality_attachment'][$key];
					}
					$arr_vendor_kbli_id = $this->input->post('vendor_kbli_id');
					$arr_kbli_id = $this->input->post('kbli_id');
					$arr_kbli_legality_id = $this->input->post('kbli_legality_id');
					for($i=0;$i<count($arr_kbli_id);$i++){
						unset($datato);
						$datato['table'] = 'patlog__procurement.data__kbli';
						$datato['where'] = array(
							'patlog__procurement.data__kbli.kbli_id' => urldecode($arr_kbli_id[$i])
						);
						$Q2 = $this->view->view_data($datato);
						if ($Q2->num_rows()) {
							$R2 = $Q2->row();
							$kbli_id = $R2->kbli_id;
							$kbli_code = $R2->kbli_code;
							$kbli_name = $R2->kbli_name;
						}else{
							$kbli_id = null;
							$kbli_code = null;
							$kbli_name = null;
						}
						
						unset($datato);
						$datato['table'] = 'patlog__procurement.data__kbli_legality';
						$datato['where'] = array(
							'patlog__procurement.data__kbli_legality.kbli_legality_id' => urldecode($arr_kbli_legality_id[$i])
						);
						$Q2 = $this->view->view_data($datato);
						if ($Q2->num_rows()) {
							$R2 = $Q2->row();
							$kbli_legality_id = $R2->kbli_legality_id;
							$kbli_legality_name = $R2->kbli_legality_name;
						}else{
							$kbli_legality_id = null;
							$kbli_legality_name = null;
						}
						
						if(isset($arr_vendor_kbli_id[$i])){
							unset($datato);
							$datato['database'] = 'patlog__procurement';
							$datato['table'] = 'entity__vendor_kbli';
							$datato['kbli_id'] = $kbli_id;
							$datato['vendor_kbli_code'] = $kbli_code;
							$datato['vendor_kbli_name'] = $kbli_name;
							$datato['vendor_kbli_legality_id'] = $kbli_legality_id;
							$datato['vendor_kbli_legality_name'] = $kbli_legality_name;
							$datato['field'] = 'vendor_kbli_id';
							$datato['id'] = $arr_vendor_kbli_id[$i];
							$this->mod->update($datato);
							$vendor_kbli_id = $arr_vendor_kbli_id[$i];
						}else{
							unset($datato);
							$datato['database'] = 'patlog__procurement';
							$datato['table'] = 'entity__vendor_kbli';
							$datato['vendor_id'] = $R1->vendor_id;
							$datato['kbli_id'] = $kbli_id;
							$datato['vendor_kbli_code'] = $kbli_code;
							$datato['vendor_kbli_name'] = $kbli_name;
							$datato['vendor_kbli_legality_id'] = $kbli_legality_id;
							$datato['vendor_kbli_legality_name'] = $kbli_legality_name;
							$datato['vendor_kbli_legality_attachment'] = 'no.pdf';
							$datato['vendor_kbli_insert'] = date('Y-m-d H:i:s');
							$vendor_kbli_id = $this->mod->insert($datato);
						}
						
						if(!empty($data['tmp_name'][$i])){
							$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
							$file_name = 'vendor-kbli-legality-attachment-'.md5($R1->vendor_id).'-'.md5($vendor_kbli_id).'.'.$ext;
							$path = './assets/mod__procurement/attach/vendor-kbli-legality-attachment/'.$file_name;
							$arr_type = array(
								'application/pdf'
							);
							if(in_array($data['type'][$i], $arr_type)){
								move_uploaded_file($data['tmp_name'][$i], $path);
								unset($datato);
								$datato['database'] = 'patlog__procurement';
								$datato['table'] = 'entity__vendor_kbli';
								$datato['vendor_kbli_legality_attachment'] = $file_name;
								$datato['field'] = 'vendor_kbli_id';
								$datato['id'] = $vendor_kbli_id;
								$this->mod->update($datato);
							}
						}
					}
				}

				$arr_vendor_pic_id = $this->input->post('vendor_pic_id');
				$arr_vendor_pic_name = $this->input->post('vendor_pic_name');
				$arr_vendor_pic_position = $this->input->post('vendor_pic_position');
				for($i=0;$i<count($arr_vendor_pic_name);$i++){
					if(isset($arr_vendor_pic_id[$i])){
						unset($datato);
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__vendor_pic';
						$datato['vendor_pic_name'] = $arr_vendor_pic_name[$i];
						$datato['vendor_pic_position'] = $arr_vendor_pic_position[$i];
						$datato['field'] = 'vendor_pic_id';
						$datato['id'] = $arr_vendor_pic_id[$i];
						$this->mod->update($datato);
					}else{
						unset($datato);
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__vendor_pic';
						$datato['vendor_id'] = $R1->vendor_id;
						$datato['vendor_pic_name'] = $arr_vendor_pic_name[$i];
						$datato['vendor_pic_position'] = $arr_vendor_pic_position[$i];
						$datato['vendor_pic_insert'] = date('Y-m-d H:i:s');
						$vendor_pic_id = $this->mod->insert($datato);
					}
				}

				if(!empty($this->input->post('bank_id'))){
					// unset($data);
					// foreach($_FILES['vendor_bank_attachment'] as $key => $file){
						// $data[$key] = $_FILES['vendor_bank_attachment'][$key];
					// }
					$arr_vendor_bank_id = $this->input->post('vendor_bank_id');
					$arr_bank_id = $this->input->post('bank_id');
					$arr_vendor_bank_number = $this->input->post('vendor_bank_number');
					$arr_vendor_bank_branch = $this->input->post('vendor_bank_branch');
					$arr_vendor_bank_holder_name = $this->input->post('vendor_bank_holder_name');
					for($i=0;$i<count($arr_bank_id);$i++){
						unset($datato);
						$datato['table'] = 'patlog__value.entity__bank';
						$datato['where'] = array(
							'patlog__value.entity__bank.bank_id' => urldecode($arr_bank_id[$i])
						);
						$Q2 = $this->view->view_data($datato);
						if ($Q2->num_rows()) {
							$R2 = $Q2->row();
							$bank_id = $R2->bank_id;
							$bank_code = $R2->bank_code;
							$bank_name = $R2->bank_name;
						}else{
							$bank_id = null;
							$bank_code = null;
							$bank_name = null;
						}
						
						if(isset($arr_vendor_bank_id[$i])){
							unset($datato);
							$datato['database'] = 'patlog__procurement';
							$datato['table'] = 'entity__vendor_bank';
							$datato['bank_id'] = $bank_id;
							$datato['vendor_bank_name'] = $bank_name;
							$datato['vendor_bank_number'] = $arr_vendor_bank_number[$i];
							$datato['vendor_bank_branch'] = $arr_vendor_bank_branch[$i];
							$datato['vendor_bank_holder_name'] = $arr_vendor_bank_holder_name[$i];
							$datato['field'] = 'vendor_bank_id';
							$datato['id'] = $arr_vendor_bank_id[$i];
							$this->mod->update($datato);
							
							$vendor_bank_id = $arr_vendor_bank_id[$i];
						}else{
							unset($datato);
							$datato['database'] = 'patlog__procurement';
							$datato['table'] = 'entity__vendor_bank';
							$datato['bank_id'] = $bank_id;
							$datato['vendor_id'] = $R1->vendor_id;
							$datato['vendor_bank_name'] = $bank_name;
							$datato['vendor_bank_number'] = $arr_vendor_bank_number[$i];
							$datato['vendor_bank_branch'] = $arr_vendor_bank_branch[$i];
							$datato['vendor_bank_holder_name'] = $arr_vendor_bank_holder_name[$i];
							$datato['vendor_bank_attachment'] = 'no.pdf';
							$datato['vendor_bank_insert'] = date('Y-m-d H:i:s');
							$vendor_bank_id = $this->mod->insert($datato);
						}
						
						// if(!empty($data['tmp_name'][$i])){
							// $ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
							// $file_name = 'vendor-bank-attachment-'.md5($R1->vendor_id).'-'.md5($vendor_bank_id).'.'.$ext;
							// $path = './assets/mod__procurement/attach/vendor-bank-attachment/'.$file_name;
							// $arr_type = array(
								// 'application/pdf'
							// );
							// if(in_array($data['type'][$i], $arr_type)){
								// move_uploaded_file($data['tmp_name'][$i], $path);
								// unset($datato);
								// $datato['database'] = 'patlog__procurement';
								// $datato['table'] = 'entity__vendor_bank';
								// $datato['vendor_bank_attachment'] = $file_name;
								// $datato['field'] = 'vendor_bank_id';
								// $datato['id'] = $vendor_bank_id;
								// $this->mod->update($datato);
							// }
						// }
					}
				}
				
				foreach($_FILES['vendor_document_siup'] as $key => $file){
					$data[$key] = $_FILES['vendor_document_siup'][$key];
				}
				$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
				$file_name = 'siup-'.md5($R1->vendor_id).'.'.$ext;
				$path = './assets/mod__procurement/attach/uploads/siup/'.$file_name;
				$arr_type = array(
					'application/pdf'
				);
				if(in_array($data['type'], $arr_type)){
					move_uploaded_file($data['tmp_name'], $path);
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor';
					$datato['vendor_document_siup'] = $file_name;
					$datato['field'] = 'vendor_id';
					$datato['id'] = $R1->vendor_id;
					$this->mod->update($datato);
				}
				
				foreach($_FILES['vendor_document_deed_incorporation'] as $key => $file){
					$data[$key] = $_FILES['vendor_document_deed_incorporation'][$key];
				}
				$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
				$file_name = 'akta_pendirian-'.md5($R1->vendor_id).'.'.$ext;
				$path = './assets/mod__procurement/attach/uploads/akta_pendirian/'.$file_name;
				$arr_type = array(
					'application/pdf'
				);
				if(in_array($data['type'], $arr_type)){
					move_uploaded_file($data['tmp_name'], $path);
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor';
					$datato['vendor_document_deed_incorporation'] = $file_name;
					$datato['field'] = 'vendor_id';
					$datato['id'] = $R1->vendor_id;
					$this->mod->update($datato);
				}
				
				foreach($_FILES['vendor_document_change'] as $key => $file){
					$data[$key] = $_FILES['vendor_document_change'][$key];
				}
				$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
				$file_name = 'akta_perubahan-'.md5($R1->vendor_id).'.'.$ext;
				$path = './assets/mod__procurement/attach/uploads/akta_perubahan/'.$file_name;
				$arr_type = array(
					'application/pdf'
				);
				if(in_array($data['type'], $arr_type)){
					move_uploaded_file($data['tmp_name'], $path);
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor';
					$datato['vendor_document_change'] = $file_name;
					$datato['field'] = 'vendor_id';
					$datato['id'] = $R1->vendor_id;
					$this->mod->update($datato);
				}
				
				foreach($_FILES['vendor_document_sign_company'] as $key => $file){
					$data[$key] = $_FILES['vendor_document_sign_company'][$key];
				}
				$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
				$file_name = 'tanda_daftar_perusahaan-'.md5($R1->vendor_id).'.'.$ext;
				$path = './assets/mod__procurement/attach/uploads/tanda_daftar_perusahaan/'.$file_name;
				$arr_type = array(
					'application/pdf'
				);
				if(in_array($data['type'], $arr_type)){
					move_uploaded_file($data['tmp_name'], $path);
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor';
					$datato['vendor_document_sign_company'] = $file_name;
					$datato['field'] = 'vendor_id';
					$datato['id'] = $R1->vendor_id;
					$this->mod->update($datato);
				}
				
				foreach($_FILES['vendor_document_domicile_information'] as $key => $file){
					$data[$key] = $_FILES['vendor_document_domicile_information'][$key];
				}
				$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
				$file_name = 'surat_domisili-'.md5($R1->vendor_id).'.'.$ext;
				$path = './assets/mod__procurement/attach/uploads/surat_domisili/'.$file_name;
				$arr_type = array(
					'application/pdf'
				);
				if(in_array($data['type'], $arr_type)){
					move_uploaded_file($data['tmp_name'], $path);
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor';
					$datato['vendor_document_domicile_information'] = $file_name;
					$datato['field'] = 'vendor_id';
					$datato['id'] = $R1->vendor_id;
					$this->mod->update($datato);
				}
				
				foreach($_FILES['vendor_document_sppkp'] as $key => $file){
					$data[$key] = $_FILES['vendor_document_sppkp'][$key];
				}
				$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
				$file_name = 'sk_pajak-'.md5($R1->vendor_id).'.'.$ext;
				$path = './assets/mod__procurement/attach/uploads/sk_pajak/'.$file_name;
				$arr_type = array(
					'application/pdf'
				);
				if(in_array($data['type'], $arr_type)){
					move_uploaded_file($data['tmp_name'], $path);
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor';
					$datato['vendor_document_sppkp'] = $file_name;
					$datato['field'] = 'vendor_id';
					$datato['id'] = $R1->vendor_id;
					$this->mod->update($datato);
				}
				
				foreach($_FILES['vendor_document_finance_report'] as $key => $file){
					$data[$key] = $_FILES['vendor_document_finance_report'][$key];
				}
				$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
				$file_name = 'laporan_keuangan-'.md5($R1->vendor_id).'.'.$ext;
				$path = './assets/mod__procurement/attach/uploads/laporan_keuangan/'.$file_name;
				$arr_type = array(
					'application/pdf'
				);
				if(in_array($data['type'], $arr_type)){
					move_uploaded_file($data['tmp_name'], $path);
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor';
					$datato['vendor_document_finance_report'] = $file_name;
					$datato['field'] = 'vendor_id';
					$datato['id'] = $R1->vendor_id;
					$this->mod->update($datato);
				}
				
				foreach($_FILES['vendor_document_statement_later'] as $key => $file){
					$data[$key] = $_FILES['vendor_document_statement_later'][$key];
				}
				$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
				$file_name = 'surat_pernyataan-'.md5($R1->vendor_id).'.'.$ext;
				$path = './assets/mod__procurement/attach/uploads/surat_pernyataan/'.$file_name;
				$arr_type = array(
					'application/pdf'
				);
				if(in_array($data['type'], $arr_type)){
					move_uploaded_file($data['tmp_name'], $path);
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor';
					$datato['vendor_document_statement_later'] = $file_name;
					$datato['field'] = 'vendor_id';
					$datato['id'] = $R1->vendor_id;
					$this->mod->update($datato);
				}
				
				foreach($_FILES['vendor_document_po_spk'] as $key => $file){
					$data[$key] = $_FILES['vendor_document_po_spk'][$key];
				}
				$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
				$file_name = 'surat_pengalaman_perusahaan-'.md5($R1->vendor_id).'.'.$ext;
				$path = './assets/mod__procurement/attach/uploads/surat_pengalaman_perusahaan/'.$file_name;
				$arr_type = array(
					'application/pdf'
				);
				if(in_array($data['type'], $arr_type)){
					move_uploaded_file($data['tmp_name'], $path);
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor';
					$datato['vendor_document_po_spk'] = $file_name;
					$datato['field'] = 'vendor_id';
					$datato['id'] = $R1->vendor_id;
					$this->mod->update($datato);
				}
				
				foreach($_FILES['vendor_document_csms'] as $key => $file){
					$data[$key] = $_FILES['vendor_document_csms'][$key];
				}
				$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
				$file_name = 'sertifikat_csms-'.md5($R1->vendor_id).'.'.$ext;
				$path = './assets/mod__procurement/attach/uploads/sertifikat_csms/'.$file_name;
				$arr_type = array(
					'application/pdf'
				);
				if(in_array($data['type'], $arr_type)){
					move_uploaded_file($data['tmp_name'], $path);
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor';
					$datato['vendor_document_csms'] = $file_name;
					$datato['field'] = 'vendor_id';
					$datato['id'] = $R1->vendor_id;
					$this->mod->update($datato);
				}
				
				foreach($_FILES['vendor_document_iso'] as $key => $file){
					$data[$key] = $_FILES['vendor_document_iso'][$key];
				}
				$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
				$file_name = 'sertifikat_ISO-'.md5($R1->vendor_id).'.'.$ext;
				$path = './assets/mod__procurement/attach/uploads/sertifikat_ISO/'.$file_name;
				$arr_type = array(
					'application/pdf'
				);
				if(in_array($data['type'], $arr_type)){
					move_uploaded_file($data['tmp_name'], $path);
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor';
					$datato['vendor_document_iso'] = $file_name;
					$datato['field'] = 'vendor_id';
					$datato['id'] = $R1->vendor_id;
					$this->mod->update($datato);
				}
				
				foreach($_FILES['vendor_document_bank_reference'] as $key => $file){
					$data[$key] = $_FILES['vendor_document_bank_reference'][$key];
				}
				$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
				$file_name = 'referensi_bank-'.md5($R1->vendor_id).'.'.$ext;
				$path = './assets/mod__procurement/attach/uploads/referensi_bank/'.$file_name;
				$arr_type = array(
					'application/pdf'
				);
				if(in_array($data['type'], $arr_type)){
					move_uploaded_file($data['tmp_name'], $path);
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor';
					$datato['vendor_document_bank_reference'] = $file_name;
					$datato['field'] = 'vendor_id';
					$datato['id'] = $R1->vendor_id;
					$this->mod->update($datato);
				}
				
				foreach($_FILES['vendor_document_bank_attorney'] as $key => $file){
					$data[$key] = $_FILES['vendor_document_bank_attorney'][$key];
				}
				$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
				$file_name = 'surat_kuasa_bank-'.md5($R1->vendor_id).'.'.$ext;
				$path = './assets/mod__procurement/attach/uploads/surat_kuasa_bank/'.$file_name;
				$arr_type = array(
					'application/pdf'
				);
				if(in_array($data['type'], $arr_type)){
					move_uploaded_file($data['tmp_name'], $path);
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor';
					$datato['vendor_document_bank_attorney'] = $file_name;
					$datato['field'] = 'vendor_id';
					$datato['id'] = $R1->vendor_id;
					$this->mod->update($datato);
				}
				
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__vendor_log';
				$datato['where'] = array(
					'patlog__procurement.entity__vendor_log.vendor_id' => $R1->vendor_id
				);
				$Q2 = $this->view->view_data($datato);
				$vendor_log_level = $Q2->num_rows() + 1;

				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor_log';
				$datato['vendor_id'] = $R1->vendor_id;
				$datato['vendor_log_level'] = $vendor_log_level;
				$datato['vendor_log_name'] = $R1->vendor_employee_in_name;
				$datato['vendor_log_status'] = 'Edited';
				$datato['vendor_log_message'] = 'Diubah';
				$datato['vendor_log_information'] = '';
				$datato['vendor_log_insert'] = date('Y-m-d H:i:s');
				$vendor_log_id = $this->mod->insert($datato);
			}

			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect(site_url().'module_procurement/admin/vendor_proses/');
		}elseif($this->uri->segment(4) == 'delete'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$vendor_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__vendor';
			$datato['where'] = array(
				'patlog__procurement.entity__vendor.vendor_id' => $vendor_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				if(file_exists('./assets/mod__procurement/attach/uploads/siup/'.$R1->vendor_document_siup) and $R1->vendor_document_siup != 'no.pdf'){
					unlink('./assets/mod__procurement/attach/uploads/siup/'.$R1->vendor_document_siup);
				}
				
				if(file_exists('./assets/mod__procurement/attach/uploads/akta_pendirian/'.$R1->vendor_document_deed_incorporation) and $R1->vendor_document_deed_incorporation != 'no.pdf'){
					unlink('./assets/mod__procurement/attach/uploads/akta_pendirian/'.$R1->vendor_document_deed_incorporation);
				}
				
				if(file_exists('./assets/mod__procurement/attach/uploads/akta_perubahan/'.$R1->vendor_document_change) and $R1->vendor_document_change != 'no.pdf'){
					unlink('./assets/mod__procurement/attach/uploads/akta_perubahan/'.$R1->vendor_document_change);
				}
				
				if(file_exists('./assets/mod__procurement/attach/uploads/tanda_daftar_perusahaan/'.$R1->vendor_document_sign_company) and $R1->vendor_document_sign_company != 'no.pdf'){
					unlink('./assets/mod__procurement/attach/uploads/tanda_daftar_perusahaan/'.$R1->vendor_document_sign_company);
				}
				
				if(file_exists('./assets/mod__procurement/attach/uploads/surat_domisili/'.$R1->vendor_document_domicile_information) and $R1->vendor_document_domicile_information != 'no.pdf'){
					unlink('./assets/mod__procurement/attach/uploads/surat_domisili/'.$R1->vendor_document_domicile_information);
				}
				
				if(file_exists('./assets/mod__procurement/attach/uploads/sk_pajak/'.$R1->vendor_document_sppkp) and $R1->vendor_document_sppkp != 'no.pdf'){
					unlink('./assets/mod__procurement/attach/uploads/sk_pajak/'.$R1->vendor_document_sppkp);
				}
				
				if(file_exists('./assets/mod__procurement/attach/uploads/laporan_keuangan/'.$R1->vendor_document_finance_report) and $R1->vendor_document_finance_report != 'no.pdf'){
					unlink('./assets/mod__procurement/attach/uploads/laporan_keuangan/'.$R1->vendor_document_finance_report);
				}
				
				if(file_exists('./assets/mod__procurement/attach/uploads/surat_pernyataan/'.$R1->vendor_document_statement_later) and $R1->vendor_document_statement_later != 'no.pdf'){
					unlink('./assets/mod__procurement/attach/uploads/surat_pernyataan/'.$R1->vendor_document_statement_later);
				}
				
				if(file_exists('./assets/mod__procurement/attach/uploads/surat_pengalaman_perusahaan/'.$R1->vendor_document_po_spk) and $R1->vendor_document_po_spk != 'no.pdf'){
					unlink('./assets/mod__procurement/attach/uploads/surat_pengalaman_perusahaan/'.$R1->vendor_document_po_spk);
				}
				
				if(file_exists('./assets/mod__procurement/attach/uploads/sertifikat_csms/'.$R1->vendor_document_csms) and $R1->vendor_document_csms != 'no.pdf'){
					unlink('./assets/mod__procurement/attach/uploads/sertifikat_csms/'.$R1->vendor_document_csms);
				}
				
				if(file_exists('./assets/mod__procurement/attach/uploads/sertifikat_ISO/'.$R1->vendor_document_iso) and $R1->vendor_document_iso != 'no.pdf'){
					unlink('./assets/mod__procurement/attach/uploads/sertifikat_ISO/'.$R1->vendor_document_iso);
				}
				
				if(file_exists('./assets/mod__procurement/attach/uploads/referensi_bank/'.$R1->vendor_document_bank_reference) and $R1->vendor_document_bank_reference != 'no.pdf'){
					unlink('./assets/mod__procurement/attach/uploads/referensi_bank/'.$R1->vendor_document_bank_reference);
				}
				
				if(file_exists('./assets/mod__procurement/attach/uploads/surat_kuasa_bank/'.$R1->vendor_document_bank_attorney) and $R1->vendor_document_bank_attorney != 'no.pdf'){
					unlink('./assets/mod__procurement/attach/uploads/surat_kuasa_bank/'.$R1->vendor_document_bank_attorney);
				}
				
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__vendor_bank';
				$datato['where'] = array(
					'patlog__procurement.entity__vendor_bank.vendor_id' => $R1->vendor_id
				);
				$Q2 = $this->view->view_data($datato);
				foreach($Q2->result() as $R2){
					if(file_exists('./assets/mod__procurement/attach/vendor-bank-attachment/'.$R2->vendor_bank_attachment) and $R2->vendor_bank_attachment != 'no.pdf'){
						unlink('./assets/mod__procurement/attach/vendor-bank-attachment/'.$R2->vendor_bank_attachment);
					}
				}
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor_agency';
				$datato['field'] = 'vendor_id';
				$datato['id'] = $R1->vendor_id;
				$this->mod->delete($datato);
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor_bank';
				$datato['field'] = 'vendor_id';
				$datato['id'] = $R1->vendor_id;
				$this->mod->delete($datato);
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor_distributor';
				$datato['field'] = 'vendor_id';
				$datato['id'] = $R1->vendor_id;
				$this->mod->delete($datato);
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor_kbli';
				$datato['field'] = 'vendor_id';
				$datato['id'] = $R1->vendor_id;
				$this->mod->delete($datato);
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor_log';
				$datato['field'] = 'vendor_id';
				$datato['id'] = $R1->vendor_id;
				$this->mod->delete($datato);
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor_pic';
				$datato['field'] = 'vendor_id';
				$datato['id'] = $R1->vendor_id;
				$this->mod->delete($datato);
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor';
				$datato['field'] = 'vendor_id';
				$datato['id'] = $R1->vendor_id;
				$this->mod->delete($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect(site_url().'module_procurement/admin/vendor_proses/');
		}
	}
	
	public function vendor_agency()
	{
		if($this->uri->segment(4) == 'delete'){
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__vendor_agency';
			$datato['where'] = array(
				'patlog__procurement.entity__vendor_agency.vendor_agency_id' => $this->input->post('vendor_agency_id')
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__vendor_agency';
				$datato['where'] = array(
					'patlog__procurement.entity__vendor_agency.vendor_id' => $R1->vendor_id
				);
				$Q2 = $this->view->view_data($datato);
				$total = $Q2->num_rows();
				if($total == 1){
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor';
					$datato['vendor_agency_type'] = 'no'; 
					$datato['field'] = 'vendor_id';
					$datato['id'] = $R1->vendor_id;
					$this->mod->update($datato);
					
					$data['vendor_agency_type'] = 'no';
				}else{
					$data['vendor_agency_type'] = 'yes';
				}
				
				if(file_exists('./assets/mod__procurement/attach/uploads/vendor/'.$R1->vendor_agency_file) and $R1->vendor_agency_file != 'no.pdf'){
					unlink('./assets/mod__procurement/attach/uploads/vendor/'.$R1->vendor_agency_file);
				}
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor_agency';
				$datato['field'] = 'vendor_agency_id';
				$datato['id'] = $R1->vendor_agency_id;
				$this->mod->delete($datato);
			}
			
			echo json_encode($data, true);
		}
	}
	
	public function vendor_distributor()
	{
		if($this->uri->segment(4) == 'delete'){
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__vendor_distributor';
			$datato['where'] = array(
				'patlog__procurement.entity__vendor_distributor.vendor_distributor_id' => $this->input->post('vendor_distributor_id')
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__vendor_distributor';
				$datato['where'] = array(
					'patlog__procurement.entity__vendor_distributor.vendor_id' => $R1->vendor_id
				);
				$Q2 = $this->view->view_data($datato);
				$total = $Q2->num_rows();
				if($total == 1){
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor';
					$datato['vendor_distributor_type'] = 'no'; 
					$datato['field'] = 'vendor_id';
					$datato['id'] = $R1->vendor_id;
					$this->mod->update($datato);
					
					$data['vendor_distributor_type'] = 'no';
				}else{
					$data['vendor_distributor_type'] = 'yes';
				}
				
				if(file_exists('./assets/mod__procurement/attach/uploads/distributor/'.$R1->vendor_distributor_file) and $R1->vendor_distributor_file != 'no.pdf'){
					unlink('./assets/mod__procurement/attach/uploads/distributor/'.$R1->vendor_distributor_file);
				}
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor_distributor';
				$datato['field'] = 'vendor_distributor_id';
				$datato['id'] = $R1->vendor_distributor_id;
				$this->mod->delete($datato);
			}
			
			echo json_encode($data, true);
		}
	}
	
	public function vendor_pic()
	{
		if($this->uri->segment(4) == 'delete'){
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__vendor_pic';
			$datato['where'] = array(
				'patlog__procurement.entity__vendor_pic.vendor_pic_id' => $this->input->post('vendor_pic_id')
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor_pic';
				$datato['field'] = 'vendor_pic_id';
				$datato['id'] = $R1->vendor_pic_id;
				$this->mod->delete($datato);
			}
		}
	}
	
	public function vendor_bank()
	{
		if($this->uri->segment(4) == 'delete'){
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__vendor_bank';
			$datato['where'] = array(
				'patlog__procurement.entity__vendor_bank.vendor_bank_id' => $this->input->post('vendor_bank_id')
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				if(file_exists('./assets/mod__procurement/attach/vendor-bank-attachment/'.$R1->vendor_bank_attachment) and $R1->vendor_bank_attachment != 'no.pdf'){
					unlink('./assets/mod__procurement/attach/vendor-bank-attachment/'.$R1->vendor_bank_attachment);
				}
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor_bank';
				$datato['field'] = 'vendor_bank_id';
				$datato['id'] = $R1->vendor_bank_id;
				$this->mod->delete($datato);
			}
		}
	}
	
	public function vendor_kbli()
	{
		if($this->uri->segment(4) == 'delete'){
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__vendor_kbli';
			$datato['where'] = array(
				'patlog__procurement.entity__vendor_kbli.vendor_kbli_id' => $this->input->post('vendor_kbli_id')
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor_kbli';
				$datato['field'] = 'vendor_kbli_id';
				$datato['id'] = $R1->vendor_kbli_id;
				$this->mod->delete($datato);
			}
		}
	}
	
	public function vendor_approval()
	{
		$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(4));
		$vendor_id = $this->encrypt->decode($decrypt_id);
		
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__vendor';
		$datato['where'] = array(
			'patlog__procurement.entity__vendor.vendor_id' => $vendor_id
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			$vendor_done = 'no';

			unset($datato);
			$datato['table'] = 'patlog__hrms.entity__employee_in';
			$datato['where'] = array(
				'patlog__hrms.entity__employee_in.employee_in_id' => $R1->vendor_approval_id
			);
			$Q2 = $this->view->view_data($datato);
			if ($Q2->num_rows()) {
				$R2 = $Q2->row();
				$vendor_actor = $R2->employee_in_name;
			}else{
				$vendor_actor = null;
			}
			
			if (urldecode($this->input->post('vendor_log_status')) == 'Approve') {
				unset($datato);
					$datato['table'] = 'patlog__procurement.entity__vendor_approval';
					$datato['where'] = array(
						'patlog__procurement.entity__vendor_approval.vendor_id' => $R1->vendor_id,
						'patlog__procurement.entity__vendor_approval.vendor_approval_status is null' => null,
					);
					$datato['order'] = array(
						'patlog__procurement.entity__vendor_approval.vendor_approval_level'
					);
					$datato['order_type'] = array(
						'asc'
					);
					$Q2 = $this->view->view_data($datato);
					if ($Q2->num_rows()) {
						$R2 = $Q2->row();
						
						unset($datato);
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__vendor_approval';
						$datato['vendor_approval_status'] = urldecode($this->input->post('vendor_log_status'));
						$datato['vendor_approval_date'] = date('Y-m-d H:i:s');
						$datato['field'] = 'vendor_approval_id'; 
						$datato['id'] = $R2->vendor_approval_id;
						$this->mod->update($datato);

						$vendor_level = $R2->vendor_approval_level + 1;
					}

					if($Q2->num_rows() == 1){
						$vendor_done = 'yes';
					}

					unset($datato);
					$datato['table'] = 'patlog__procurement.entity__vendor_approval';
					$datato['where'] = array(
						'patlog__procurement.entity__vendor_approval.vendor_id' => $R1->vendor_id,
						'patlog__procurement.entity__vendor_approval.vendor_approval_status is null' => null,
					);
					$datato['order'] = array(
						'patlog__procurement.entity__vendor_approval.vendor_approval_level'
					);
					$datato['order_type'] = array(
						'asc'
					);
					$Q2 = $this->view->view_data($datato);
					if ($Q2->num_rows()) {
						$R2 = $Q2->row();
						$vendor_approval_id = $R2->employee_in_id;
					}else{
						$vendor_approval_id = null;
					}
			}elseif(urldecode($this->input->post('vendor_log_status')) == 'Reject') {
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__vendor_approval';
				$datato['vendor_approval_status'] = null;
				$datato['vendor_approval_date'] = null;
				$datato['field'] = 'vendor_id'; 
				$datato['id'] = $R1->vendor_id;
				$this->mod->update($datato);

				$vendor_level = 0;
				$vendor_approval_id = null;
			}

			$vendor_status = urldecode($this->input->post('vendor_log_status'));

			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__vendor';
			$datato['vendor_approval_id'] = $vendor_approval_id;
			$datato['vendor_level'] = $vendor_level;
			$datato['vendor_actor'] = $vendor_actor;
			$datato['vendor_status'] = $vendor_status;
			$datato['vendor_done'] = $vendor_done;
			$datato['field'] = 'vendor_id';
			$datato['id'] = $R1->vendor_id;
			$this->mod->update($datato);

			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__vendor_log';
			$datato['where'] = array(
				'patlog__procurement.entity__vendor_log.vendor_id' => $R1->vendor_id
			);
			$Q2 = $this->view->view_data($datato);
			$vendor_log_level = $Q2->num_rows() + 1;

			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__vendor_log';
			$datato['vendor_id'] = $R1->vendor_id;
			$datato['vendor_log_level'] = $vendor_log_level;
			$datato['vendor_log_name'] = $vendor_actor;
			$datato['vendor_log_status'] = $vendor_status;
			$datato['vendor_log_message'] = 'Di'.strtolower($vendor_status);
			$datato['vendor_log_information'] = $this->input->post('vendor_log_information');
			$datato['vendor_log_insert'] = date('Y-m-d H:i:s');
			$this->mod->insert($datato);
		}
		
		$this->session->set_flashdata('success', 'Data berhasil diubah.');
		redirect(site_url().'module_procurement/admin/vendor_proses/');
	}
	
	public function vendor_import()
	{
		$vendor_actor = null;
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
			'patlog__config.entity__approval.approval_type_id' => 1
		);
		$datato['order'] = array(
			'patlog__config.entity__approval_detail.approval_detail_level'
		);
		$datato['order_type'] = array(
			'desc'
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$vendor_actor = $R1->approval_detail_employee_in_name;
		}
		
		$rand = $this->func_rand_string(10);
		$file_name = 'import-vendor-'.date('Y-m-d').'-'.$rand.'.xlsx';
		$config['upload_path'] = './assets/mod__procurement/attach/temporary/';
		$config['file_name'] = $file_name;
		$config['allowed_types'] = 'xlsx';
		$config['overwrite'] = TRUE;
		$this->upload->initialize($config);
		if($this->upload->do_upload('file_excel')){
			$inputFileName = './assets/mod__procurement/attach/temporary/'.$file_name;
		}else{
			$this->session->set_flashdata('danger', $this->upload->display_errors());
			redirect(site_url().'module_procurement/admin/vendor_data?view=import');
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
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__legal';
			$datato['where'] = array(
				'patlog__procurement.data__legal.legal_entity_name' => $rowData[0][2]
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$vendor_legal_entity_id = $R1->vendor_legal_entity_id;
				$vendor_legal_entity_name = $R1->vendor_legal_entity_name;
			}else{
				$vendor_legal_entity_id = null;
				$vendor_legal_entity_name = null;
			}
			
			if(urldecode($this->input->post('action')) == 'add'){
				if($rowData[0][0] == ''){
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor';
					$datato['vendor_legal_entity_id'] = $vendor_legal_entity_id;
					$datato['vendor_legal_entity_name'] = $vendor_legal_entity_name;
					$datato['vendor_code_mysap'] = $rowData[0][1];
					$datato['vendor_name'] = $rowData[0][3];
					$datato['vendor_street_building'] = $rowData[0][4];
					$datato['vendor_postal_code'] = $rowData[0][5];
					$datato['vendor_region'] = $rowData[0][6];
					$datato['vendor_phone'] = $rowData[0][7];
					$datato['vendor_email'] = $rowData[0][8];
					$datato['vendor_email_marketing'] = $rowData[0][9];
					$datato['vendor_id_card'] = base64_encode($rowData[0][10]);
					$datato['vendor_sales_name'] = $rowData[0][11];
					$datato['vendor_sales_phone_number'] = $rowData[0][12];
					$datato['vendor_taxation_status'] = $rowData[0][13];
					$datato['vendor_csms'] = $rowData[0][19];
					$datato['vendor_category'] = $rowData[0][20];
					$datato['vendor_tax_number'] = base64_encode($rowData[0][21]);
					$datato['vendor_document_siup'] = 'no.pdf';
					$datato['vendor_document_deed_incorporation'] = 'no.pdf';
					$datato['vendor_document_change'] = 'no.pdf';
					$datato['vendor_document_sign_company'] = 'no.pdf';
					$datato['vendor_document_domicile_information'] = 'no.pdf';
					$datato['vendor_document_sppkp'] = 'no.pdf';
					$datato['vendor_document_finance_report'] = 'no.pdf';
					$datato['vendor_document_statement_later'] = 'no.pdf';
					$datato['vendor_document_po_spk'] = 'no.pdf';
					$datato['vendor_document_csms'] = 'no.pdf';
					$datato['vendor_document_iso'] = 'no.pdf';
					$datato['vendor_document_bank_reference'] = 'no.pdf';
					$datato['vendor_document_bank_attorney'] = 'no.pdf';
					$datato['vendor_approval_id'] = null;
					$datato['vendor_level'] = 2;
					$datato['vendor_actor'] = $vendor_actor;
					$datato['vendor_status'] = 'Approve';
					$datato['vendor_done'] = 'yes';
					$datato['vendor_insert'] = date('Y-m-d H:i:s');
					$vendor_id = $this->mod->insert($datato);

					$vendor_code = 'V-'.date('Y').'-'.$vendor_id;
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor';
					$datato['vendor_code'] = $vendor_code;
					$datato['field'] = 'vendor_id';
					$datato['id'] = $vendor_id;
					$this->mod->update($datato);
					
					unset($datato);
					$datato['table'] = 'patlog__value.entity__bank';
					$datato['where'] = array(
						'patlog__value.entity__bank.bank_id' => $rowData[0][14]
					);
					$Q1 = $this->view->view_data($datato);
					if ($Q1->num_rows()) {
						$R1 = $Q1->row();
						$bank_id = $R1->bank_id;
						$bank_code = $R1->bank_code;
						$bank_name = $R1->bank_name;
					}else{
						$bank_id = null;
						$bank_code = null;
						$bank_name = null;
					}

					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor_bank';
					$datato['bank_id'] = $bank_id;
					$datato['vendor_id'] = $vendor_id;
					$datato['vendor_bank_name'] = $bank_name;
					$datato['vendor_bank_number'] = $rowData[0][16];
					$datato['vendor_bank_branch'] = $rowData[0][17];
					$datato['vendor_bank_holder_name'] = $rowData[0][18];
					$datato['vendor_bank_insert'] = date('Y-m-d H:i:s');
					$vendor_bank_id = $this->mod->insert($datato);
				}
			}elseif(urldecode($this->input->post('action')) == 'edit'){
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__vendor';
				$datato['where'] = array(
					'patlog__procurement.entity__vendor.vendor_code' => $rowData[0][0]
				);
				$Q1 = $this->view->view_data($datato);
				if($Q1->num_rows()){
					$R1 = $Q1->row();
					
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor';
					$datato['vendor_legal_entity_id'] = $vendor_legal_entity_id;
					$datato['vendor_legal_entity_name'] = $vendor_legal_entity_name;
					$datato['vendor_code_mysap'] = $rowData[0][1];
					$datato['vendor_name'] = $rowData[0][3];
					$datato['vendor_street_building'] = $rowData[0][4];
					$datato['vendor_postal_code'] = $rowData[0][5];
					$datato['vendor_region'] = $rowData[0][6];
					$datato['vendor_phone'] = $rowData[0][7];
					$datato['vendor_email'] = $rowData[0][8];
					$datato['vendor_email_marketing'] = $rowData[0][9];
					$datato['vendor_id_card'] = base64_encode($rowData[0][10]);
					$datato['vendor_sales_name'] = $rowData[0][11];
					$datato['vendor_sales_phone_number'] = $rowData[0][12];
					$datato['vendor_taxation_status'] = $rowData[0][13];
					$datato['vendor_csms'] = $rowData[0][19];
					$datato['vendor_category'] = $rowData[0][20];
					$datato['vendor_tax_number'] = base64_encode($rowData[0][21]);
					$datato['field'] = 'vendor_id';
					$datato['id'] = $R1->vendor_id;
					$this->mod->update($datato);
					
					unset($datato);
					$datato['table'] = 'patlog__value.entity__bank';
					$datato['where'] = array(
						'patlog__value.entity__bank.bank_id' => $rowData[0][14]
					);
					$Q2 = $this->view->view_data($datato);
					if ($Q2->num_rows()) {
						$R2 = $Q2->row();
						$bank_id = $R2->bank_id;
						$bank_code = $R2->bank_code;
						$bank_name = $R2->bank_name;
					}else{
						$bank_id = null;
						$bank_code = null;
						$bank_name = null;
					}
					
					unset($datato);
					$datato['table'] = 'patlog__procurement.entity__vendor_bank';
					$datato['where'] = array(
						'patlog__procurement.entity__vendor_bank.vendor_id' => $R1->vendor_id
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						
						unset($datato);
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__vendor_bank';
						$datato['bank_id'] = $bank_id;
						$datato['vendor_bank_name'] = $bank_name;
						$datato['vendor_bank_number'] = $rowData[0][16];
						$datato['vendor_bank_branch'] = $rowData[0][17];
						$datato['vendor_bank_holder_name'] = $rowData[0][18];
						$datato['field'] = 'vendor_bank_id';
						$datato['id'] = $R2->vendor_bank_id;
						$this->mod->update($datato);
					}
				}
			}elseif(urldecode($this->input->post('action')) == 'delete'){
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__vendor';
				$datato['where'] = array(
					'patlog__procurement.entity__vendor.vendor_code' => $rowData[0][0]
				);
				$Q1 = $this->view->view_data($datato);
				if($Q1->num_rows()){
					$R1 = $Q1->row();
					
					if(file_exists('./assets/mod__procurement/attach/uploads/siup/'.$R1->vendor_document_siup) and $R1->vendor_document_siup != 'no.pdf'){
						unlink('./assets/mod__procurement/attach/uploads/siup/'.$R1->vendor_document_siup);
					}
					
					if(file_exists('./assets/mod__procurement/attach/uploads/akta_pendirian/'.$R1->vendor_document_deed_incorporation) and $R1->vendor_document_deed_incorporation != 'no.pdf'){
						unlink('./assets/mod__procurement/attach/uploads/akta_pendirian/'.$R1->vendor_document_deed_incorporation);
					}
					
					if(file_exists('./assets/mod__procurement/attach/uploads/akta_perubahan/'.$R1->vendor_document_change) and $R1->vendor_document_change != 'no.pdf'){
						unlink('./assets/mod__procurement/attach/uploads/akta_perubahan/'.$R1->vendor_document_change);
					}
					
					if(file_exists('./assets/mod__procurement/attach/uploads/tanda_daftar_perusahaan/'.$R1->vendor_document_sign_company) and $R1->vendor_document_sign_company != 'no.pdf'){
						unlink('./assets/mod__procurement/attach/uploads/tanda_daftar_perusahaan/'.$R1->vendor_document_sign_company);
					}
					
					if(file_exists('./assets/mod__procurement/attach/uploads/surat_domisili/'.$R1->vendor_document_domicile_information) and $R1->vendor_document_domicile_information != 'no.pdf'){
						unlink('./assets/mod__procurement/attach/uploads/surat_domisili/'.$R1->vendor_document_domicile_information);
					}
					
					if(file_exists('./assets/mod__procurement/attach/uploads/sk_pajak/'.$R1->vendor_document_sppkp) and $R1->vendor_document_sppkp != 'no.pdf'){
						unlink('./assets/mod__procurement/attach/uploads/sk_pajak/'.$R1->vendor_document_sppkp);
					}
					
					if(file_exists('./assets/mod__procurement/attach/uploads/laporan_keuangan/'.$R1->vendor_document_finance_report) and $R1->vendor_document_finance_report != 'no.pdf'){
						unlink('./assets/mod__procurement/attach/uploads/laporan_keuangan/'.$R1->vendor_document_finance_report);
					}
					
					if(file_exists('./assets/mod__procurement/attach/uploads/surat_pernyataan/'.$R1->vendor_document_statement_later) and $R1->vendor_document_statement_later != 'no.pdf'){
						unlink('./assets/mod__procurement/attach/uploads/surat_pernyataan/'.$R1->vendor_document_statement_later);
					}
					
					if(file_exists('./assets/mod__procurement/attach/uploads/surat_pengalaman_perusahaan/'.$R1->vendor_document_po_spk) and $R1->vendor_document_po_spk != 'no.pdf'){
						unlink('./assets/mod__procurement/attach/uploads/surat_pengalaman_perusahaan/'.$R1->vendor_document_po_spk);
					}
					
					if(file_exists('./assets/mod__procurement/attach/uploads/sertifikat_csms/'.$R1->vendor_document_csms) and $R1->vendor_document_csms != 'no.pdf'){
						unlink('./assets/mod__procurement/attach/uploads/sertifikat_csms/'.$R1->vendor_document_csms);
					}
					
					if(file_exists('./assets/mod__procurement/attach/uploads/sertifikat_ISO/'.$R1->vendor_document_iso) and $R1->vendor_document_iso != 'no.pdf'){
						unlink('./assets/mod__procurement/attach/uploads/sertifikat_ISO/'.$R1->vendor_document_iso);
					}
					
					if(file_exists('./assets/mod__procurement/attach/uploads/referensi_bank/'.$R1->vendor_document_bank_reference) and $R1->vendor_document_bank_reference != 'no.pdf'){
						unlink('./assets/mod__procurement/attach/uploads/referensi_bank/'.$R1->vendor_document_bank_reference);
					}
					
					if(file_exists('./assets/mod__procurement/attach/uploads/surat_kuasa_bank/'.$R1->vendor_document_bank_attorney) and $R1->vendor_document_bank_attorney != 'no.pdf'){
						unlink('./assets/mod__procurement/attach/uploads/surat_kuasa_bank/'.$R1->vendor_document_bank_attorney);
					}
					
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor_agency';
					$datato['field'] = 'vendor_id';
					$datato['id'] = $R1->vendor_id;
					$this->mod->delete($datato);
					
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor_approval';
					$datato['field'] = 'vendor_id';
					$datato['id'] = $R1->vendor_id;
					$this->mod->delete($datato);
					
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor_bank';
					$datato['field'] = 'vendor_id';
					$datato['id'] = $R1->vendor_id;
					$this->mod->delete($datato);
					
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor_distributor';
					$datato['field'] = 'vendor_id';
					$datato['id'] = $R1->vendor_id;
					$this->mod->delete($datato);
					
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor_kbli';
					$datato['field'] = 'vendor_id';
					$datato['id'] = $R1->vendor_id;
					$this->mod->delete($datato);
					
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor_log';
					$datato['field'] = 'vendor_id';
					$datato['id'] = $R1->vendor_id;
					$this->mod->delete($datato);
					
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor_pic';
					$datato['field'] = 'vendor_id';
					$datato['id'] = $R1->vendor_id;
					$this->mod->delete($datato);
					
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor';
					$datato['field'] = 'vendor_id';
					$datato['id'] = $R1->vendor_id;
					$this->mod->delete($datato);
				}
			}
		}
		
		$this->session->set_flashdata('success', 'Data berhasil diubah.');
		redirect(site_url().'module_procurement/admin/vendor_data/');
	}
	
	public function vendor_import_document()
	{
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__vendor';
		$datato['where'] = array(
			'patlog__procurement.entity__vendor.vendor_id' => urldecode($this->input->post('vendor_id'))
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$vendor_id = $R1->vendor_id;
			$vendor_code = $R1->vendor_code;
			$vendor_name = $R1->vendor_name;
		}else{
			$vendor_id = null;
			$vendor_code = null;
			$vendor_name = null;
		}
		
		$arr_document = array(
			'SIUP/NIB',
			'SK dan Akta Pendirian Perusahaan Beserta Pengesahan',
			'SK dan Akta pengangkatan direksi (maksimal 5 tahun sebelum)',
			'Surat Keterangan Fiskal dan Nomor NITKU',
			'Kartu Tanda Pengenal Pengurus Perusahaan',
			'Surat Keterangan Perpajakkan PKP/NonPKP',
			'Laporan Keuangan 1 Tahun Terakhir',
			'Surat Pernyataan dan Pakta Integritas',
			'Daftar Pengalaman Perusahaan(Lampirkan PO/SPK/Kontrak 1 Tahun Terakhir)',
			'Sertifikat CSMS',
			'Surat Pengukuhan Pengusaha Kena Pajak (SPPKP) / Surat Pernyataan apabila NON PKP',
			'Referensi Bank',
			'Surat Kuasa Bank',
		);
		
		$arr_field = array(
			'vendor_document_siup',
			'vendor_document_deed_incorporation',
			'vendor_document_change',
			'vendor_document_sign_company',
			'vendor_document_domicile_information',
			'vendor_document_sppkp',
			'vendor_document_finance_report',
			'vendor_document_statement_later',
			'vendor_document_po_spk',
			'vendor_document_csms',
			'vendor_document_iso',
			'vendor_document_bank_reference',
			'vendor_document_bank_attorney'
		);
		
		$arr_name = array(
			'siup',
			'akta_pendirian',
			'akta_perubahan',
			'tanda_daftar_perusahaan',
			'surat_domisili',
			'sk_pajak',
			'laporan_keuangan',
			'surat_pernyataan',
			'surat_pengalaman_perusahaan',
			'sertifikat_csms',
			'sertifikat_ISO',
			'referensi_bank',
			'surat_kuasa_bank'
		);	
		
		$rand = $this->func_rand_string(10);
		$file_name = 'zip-document-vendor-'.date('Y-m-d').'-'.$rand.'.zip';
		$config['upload_path'] = './assets/mod__procurement/attach/temporary/zip/';
		$config['file_name'] = $file_name;
		$config['allowed_types'] = 'zip';
		$config['overwrite'] = TRUE;
		$this->upload->initialize($config);
		if($this->upload->do_upload('file_zip')){
			$inputFileNameZip = './assets/mod__procurement/attach/temporary/zip/'.$file_name;
		}else{
			$this->session->set_flashdata('danger', $this->upload->display_errors());
			redirect(site_url().'module_procurement/admin/vendor_data?view=import_document');
		}
		
		$zip = new ZipArchive;
		$extractPath = './assets/mod__procurement/attach/temporary/zip/'.$rand.'/'; 
		if (!file_exists($extractPath)) {
			mkdir($extractPath, 0777, true);  
		}  
		if ($zip->open($inputFileNameZip) === TRUE){
			$zip->extractTo($extractPath);  
			$zip->close();
		} else {
			$this->session->set_flashdata('danger', 'Gagal membuka file ZIP.');
			redirect(site_url().'module_procurement/admin/vendor_data?view=import_document');
		}
		
		$file_name = 'import-document-vendor-'.date('Y-m-d').'-'.$rand.'.xlsx';
		$config['upload_path'] = './assets/mod__procurement/attach/temporary/';
		$config['file_name'] = $file_name;
		$config['allowed_types'] = 'xlsx';
		$config['overwrite'] = TRUE;
		$this->upload->initialize($config);
		if($this->upload->do_upload('file_excel')){
			$inputFileName = './assets/mod__procurement/attach/temporary/'.$file_name;
		}else{
			$this->session->set_flashdata('danger', $this->upload->display_errors());
			redirect(site_url().'module_procurement/admin/vendor_data?view=import_document');
		}
		
		try{
			$inputFileType = IOFactory::identify($inputFileName);
			$objReader = IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		}catch(Exception $e){
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		$i = 0;
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
			
			if($arr_document[$i] == $rowData[0][2]){
				if(file_exists($extractPath.$rowData[0][3])){
					$the_path = FCPATH.'/assets/mod__procurement/attach/uploads/'.$arr_name[$i].'/'.$arr_name[$i].'-'.md5($vendor_id).'.pdf';
					$output_name = FCPATH.'/assets/mod__procurement/attach/temporary/zip/'.$rand.'/'.$rowData[0][3];
					rename($output_name, $the_path);
					$the_name = $arr_name[$i].'-'.md5($vendor_id).'.pdf';
				}else{
					$the_name = 'no.pdf';
				}
				
				if($the_name != 'no.pdf'){
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__vendor';
					$datato[$arr_field[$i]] = $the_name;
					$datato['field'] = 'vendor_id';
					$datato['id'] = $vendor_id;
					$this->mod->update($datato);
				}
			}
			
			$i++;
		}
		
		unlink($inputFileNameZip);
		$this->func_delete_dir($extractPath);
		
		$this->session->set_flashdata('success', 'Data berhasil diubah.');
		redirect(site_url().'module_procurement/admin/vendor_data/');
	}
	
	public function vendor_template_document()
	{
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 0);
		set_time_limit(0);
		
		$excel = new PHPExcel();
		$excel->setActiveSheetIndex(0);

		$table_columns = array(
			'Kode Vendor',
			'Nama Vendor',
			'Nama Dokumen',
			'Nama File',
		);
		$column = 0;
		foreach($table_columns as $field){
			$excel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}
		$excel_row = 2;
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__vendor';
		$datato['where'] = array(
			'patlog__procurement.entity__vendor.vendor_id' => $this->uri->segment(4)
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$vendor_code = $R1->vendor_code;
			$vendor_name = $R1->vendor_name;
		}else{
			$vendor_code = null;
			$vendor_name = null;
		}
		
		$arr_document = array(
			'SIUP/NIB',
			'SK dan Akta Pendirian Perusahaan Beserta Pengesahan',
			'SK dan Akta pengangkatan direksi (maksimal 5 tahun sebelum)',
			'Surat Keterangan Fiskal dan Nomor NITKU',
			'Kartu Tanda Pengenal Pengurus Perusahaan',
			'Surat Keterangan Perpajakkan PKP/NonPKP',
			'Laporan Keuangan 1 Tahun Terakhir',
			'Surat Pernyataan dan Pakta Integritas',
			'Daftar Pengalaman Perusahaan(Lampirkan PO/SPK/Kontrak 1 Tahun Terakhir)',
			'Sertifikat CSMS',
			'Surat Pengukuhan Pengusaha Kena Pajak (SPPKP) / Surat Pernyataan apabila NON PKP',
			'Referensi Bank',
			'Surat Kuasa Bank',
		);
		
		for($i=0;$i<count($arr_document);$i++){
			$index = 0;
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->vendor_code);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->vendor_name);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $arr_document[$i]);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, ($i+1).'.pdf');
			$excel_row++;
		}
		
		$title1 = 'Impor Dokumen Vendor';
		$excel->getActiveSheet()->setTitle($title1);
		
		$excel->setActiveSheetIndex(0);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Template Impor Dokumen Vendor '.$vendor_code.'.xlsx"');
		header('Cache-Control: max-age=0');
		$write = IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}
	
	public function vendor_export()
	{
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 0);
		set_time_limit(0);
		
		$excel = new PHPExcel();
		$excel->setActiveSheetIndex(0);

		$table_columns = array(
			'Kode Vendor',
			'Kode MYSAP',
			'Badan Hukum',
			'Nama Vendor',
			'Alamat',
			'Kode Pos',
			'Wilayah Usaha',
			'Telepon Perusahaan',
			'Email Perusahaan',
			'Email Marketing Perusahaan',
			'KTP Penanggung Jawab Perusahaan',
			'Nama PIC',
			'Nomor Telepon PIC',
			'Status Perpajakan Perusahaan',
			'ID Bank',
			'Nama Bank',
			'Nomor Rekening',
			'Cabang',
			'Nama Pemilik Rekening',
			'Status CSMS',
			'Kategori Barang/Jasa',
			'NPWP Vendor'
		);
		$column = 0;
		foreach($table_columns as $field){
			$excel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}
		$excel_row = 2;
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__vendor';
		$Q1 = $this->view->view_data($datato);
		foreach($Q1->result() as $R1){
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__vendor_bank';
			$datato['where'] = array(
				'patlog__procurement.entity__vendor_bank.vendor_id' => $R1->vendor_id 
			);
			$Q2 = $this->view->view_data($datato);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$bank_id = $R2->bank_id;
				$vendor_bank_name = $R2->vendor_bank_name;
				$vendor_bank_number = $R2->vendor_bank_number;
				$vendor_bank_branch = $R2->vendor_bank_branch;
				$vendor_bank_holder_name = $R2->vendor_bank_holder_name;
			}else{
				$bank_id = null;
				$vendor_bank_name = null;
				$vendor_bank_number = null;
				$vendor_bank_branch = null;
				$vendor_bank_holder_name = null;
			}
			
			$index = 0;
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->vendor_code);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->vendor_code_mysap);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->vendor_legal_entity_name);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->vendor_name);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->vendor_street_building);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->vendor_postal_code);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->vendor_region);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->vendor_phone);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->vendor_email);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->vendor_email_marketing);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, base64_decode($R1->vendor_id_card));
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->vendor_sales_name);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->vendor_sales_phone_number);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->vendor_taxation_status);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $bank_id);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $vendor_bank_name);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $vendor_bank_number);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $vendor_bank_branch);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $vendor_bank_holder_name);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->vendor_csms);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->vendor_category);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, base64_decode($R1->vendor_tax_number));
			$excel_row++;
		}
		$title1 = 'Data Vendor';
		$excel->getActiveSheet()->setTitle($title1);
		
		$excel->createSheet();
		$excel->setActiveSheetIndex(1);
		$table_columns = array(
			'Badan Hukum',
		);
		$column = 0;
		foreach($table_columns as $field){
			$excel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}
		$excel_row = 2;
		unset($datato);
		$datato['table'] = 'patlog__procurement.data__legal';
		$Q1 = $this->view->view_data($datato);
		foreach($Q1->result() as $R1){
			$index = 0;
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->legal_entity_name);
			$excel_row++;
		}
		$title2 = 'Badan Hukum';
		$excel->getActiveSheet()->setTitle($title2);
		
		$excel->createSheet();
		$excel->setActiveSheetIndex(2);
		$table_columns = array(
			'ID Bank',
			'Nama Bank'
		);
		$column = 0;
		foreach($table_columns as $field){
			$excel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}
		$excel_row = 2;
		unset($datato);
		$datato['table'] = 'patlog__value.entity__bank';
		$Q1 = $this->view->view_data($datato);
		foreach($Q1->result() as $R1){
			$index = 0;
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->bank_id);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->bank_name);
			$excel_row++;
		}
		$title3 = 'Data Bank';
		$excel->getActiveSheet()->setTitle($title3);
		
		$excel->setActiveSheetIndex(0);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Ekspor Data Vendor '.date('Y-m-d').'.xlsx"');
		header('Cache-Control: max-age=0');
		$write = IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}
	
	public function request()
	{
		if($this->uri->segment(4) == 'add'){
			ini_set('memory_limit', '-1');
			ini_set('max_execution_time', 0);
			set_time_limit(0);
			
			unset($datato);
			$datato['table'] = 'patlog__hrms.entity__employee_in';
			$datato['table_join'] = array(
				'patlog__hrms.entity__division',
				'patlog__hrms.entity__functions'
			);
			$datato['table_join_on'] = array(
				'patlog__hrms.entity__employee_in',
				'patlog__hrms.entity__employee_in'
			);
			$datato['join_id'] = array(
				'division_id',
				'functions_id'
			);
			$datato['join_type'] = array(
				'inner',
				'inner'
			);
			$datato['where'] = array(
				'patlog__hrms.entity__employee_in.employee_in_id' => urldecode($this->input->post('employee_in_id'))
			);	
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$employee_in_id = $R1->employee_in_id;
				$request_employee_in_name = $R1->employee_in_name;	
				$division_id = $R1->division_id;	
				$request_division_name = $R1->division_name;	
				$functions_id = $R1->functions_id;	
				$request_functions_name = $R1->functions_name;	
			}else{
				$employee_in_id = null;
				$request_employee_in_name = null;
				$division_id = null;
				$request_division_name = null;
				$functions_id = null;
				$request_functions_name = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__cost_category';		
			$datato['where'] = array(
				'patlog__procurement.data__cost_category.cost_category_id' => urldecode($this->input->post('cost_category_id'))
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$cost_category_id = $R1->cost_category_id;
				$request_cost_category_name = $R1->cost_category_name;		
			}else{
				$cost_category_id = null;
				$request_cost_category_name = null;
			}
			
			$request_source_id = null;
			$request_source_code = null;
			$request_source_code_description = null;
			if(urldecode($this->input->post('cost_category_id')) == 1){ 
				unset($datato);
				$datato['table'] = 'patlog__project.entity__cost_center';
				$datato['where'] = array(
					'patlog__project.entity__cost_center.cost_center_id' => urldecode($this->input->post('type_code_id'))
				);
				$Q1 = $this->view->view_data($datato);
				if($Q1->num_rows()){
					$R1 = $Q1->row();
					$request_source_id = $R1->cost_center_id;
					$request_source_code = $R1->cost_center_name;
					$request_source_code_description = $R1->cost_center_description;			
				}
			}elseif(urldecode($this->input->post('cost_category_id')) == 2){ 
				unset($datato);
				$datato['table'] = 'patlog__project.entity__project_code';
				$datato['where'] = array(
					'patlog__project.entity__project_code.project_code_id' => urldecode($this->input->post('type_code_id'))
				);
				$Q1 = $this->view->view_data($datato);
				if($Q1->num_rows()){
					$R1 = $Q1->row();
					$request_source_id = $R1->project_code_id;
					$request_source_code = $R1->project_code_name;
					$request_source_code_description = $R1->project_code_description;			
				}
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
				'patlog__config.entity__approval.approval_type_id' => 2,
				'patlog__config.entity__approval.division_id' => $division_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$request_approval_employee_in_id = $R1->approval_detail_employee_in_id;
				$request_approval_employee_in_name = $R1->approval_detail_employee_in_name;
				$request_approval_level = $R1->approval_detail_level;
			}else{
				$request_approval_employee_in_id = null;
				$request_approval_employee_in_name = null;
				$request_approval_level = null;
			}
			
			$request_grandtotal_estimate = 0;
			$arr_request_det_qty = $this->input->post('request_det_qty');
			$arr_request_det_estimate_price = $this->input->post('request_det_estimate_price');
			for($i=0;$i<count($arr_request_det_qty);$i++){
				$request_grandtotal_estimate = $request_grandtotal_estimate + ($arr_request_det_qty[$i] * $arr_request_det_estimate_price[$i]);
			}
			
			unset($datato);
			$datato['table'] = 'patlog__hrms.entity__employee_in';
			$datato['where'] = array(
				'patlog__hrms.entity__employee_in.employee_in_id' => urldecode($this->input->post('request_pic_contract_id'))
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$request_pic_contract_id = $R1->employee_in_id;
				$request_pic_contract_name = $R1->employee_in_name;
			}else{
				$request_pic_contract_id = null;
				$request_pic_contract_name = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__config.entity__approval';
			$datato['where'] = array(
				'patlog__config.entity__approval.approval_id' => urldecode($this->input->post('request_pic_contract_approval_id'))
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$request_pic_contract_approval_id = $R1->approval_id;
				$request_pic_contract_approval_name = $R1->approval_name;
			}else{
				$request_pic_contract_approval_id = null;
				$request_pic_contract_approval_name = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__request';
			$datato['where'] = array(
				'patlog__contract.entity__request.request_id' => urldecode($this->input->post('request_pic_contract_request_id'))
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$request_pic_contract_request_id = $R1->request_id;
				$request_pic_contract_request_name = $R1->request_name;
			}else{
				$request_pic_contract_request_id = null;
				$request_pic_contract_request_name = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__request_description';
			$datato['where'] = array(
				'patlog__contract.entity__request_description.request_description_id' => urldecode($this->input->post('request_pic_contract_request_description_id'))
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$request_pic_contract_request_description_id = $R1->request_description_id;
				$request_pic_contract_request_description_name = $R1->request_description_name;
			}else{
				$request_pic_contract_request_description_id = null;
				$request_pic_contract_request_description_name = null;
			}
			
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__request';
			$datato['request_qr'] = 'no.png';
			$datato['request_category_name'] = urldecode($this->input->post('request_category_name'));
			$datato['request_type_name'] = $this->input->post('request_type_name');
			$datato['request_pic_contract_id'] = $request_pic_contract_id;
			$datato['request_pic_contract_name'] = $request_pic_contract_name;
			$datato['request_pic_contract_approval_id'] = $request_pic_contract_approval_id;
			$datato['request_pic_contract_approval_name'] = $request_pic_contract_approval_name;
			$datato['request_pic_contract_request_id'] = $request_pic_contract_request_id;
			$datato['request_pic_contract_request_name'] = $request_pic_contract_request_name;
			$datato['request_pic_contract_request_description_id'] = $request_pic_contract_request_description_id;
			$datato['request_pic_contract_request_description_name'] = $request_pic_contract_request_description_name;
			$datato['employee_in_id'] = $employee_in_id;
			$datato['request_employee_in_name'] = $request_employee_in_name;
			$datato['division_id'] = $division_id;
			$datato['request_division_name'] = $request_division_name;
			$datato['functions_id'] = $functions_id;
			$datato['request_functions_name'] = $request_functions_name;
			$datato['cost_category_id'] = $cost_category_id;
			$datato['request_cost_category_name'] = $request_cost_category_name;
			$datato['request_source_id'] = $request_source_id;
			$datato['request_source_code'] = $request_source_code;
			$datato['request_source_code_description'] = $request_source_code_description;
			$datato['request_used_date'] = $this->input->post('request_used_date');
			$datato['request_currency'] = urldecode($this->input->post('request_currency'));
			$datato['request_grandtotal_estimate'] = $request_grandtotal_estimate;
			$datato['request_note'] = $this->input->post('request_note');
			$datato['request_approval_employee_in_id'] = $request_approval_employee_in_id;
			$datato['request_approval_employee_in_name'] = $request_approval_employee_in_name;
			$datato['request_process_document'] = 'no.pdf';
			$datato['request_approval_level'] = $request_approval_level;
			$datato['request_status'] = 'waiting_approve'; 
			$datato['request_status_information'] = 'Menunggu disetujui '.$request_approval_employee_in_name;
			$datato['request_is_finish'] = 0; 
			$datato['request_is_delete'] = 0; 
			$datato['request_created_by'] = $request_employee_in_name;
			$datato['request_created_date'] = date('Y-m-d H:i:s');
			$request_id = $this->mod->insert($datato);
			
			$initial_code = 'PR-'.date('y');
			unset($datato);
			$datato['select'] = 'MAX(patlog__procurement.entity__request.request_code) as max_code';		
			$datato['table'] = 'patlog__procurement.entity__request';	
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();		
				$max_code = $R1->max_code;
				if(date('y') == (int)substr($max_code,3,2)){			
					$max_code_plus = (int)substr($max_code,3,6)+1; 
					$request_code = 'PR-'.$max_code_plus;	
				}else{
					$request_code = $initial_code.sprintf('%04s', 1);
				}
			}	
			
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__request';
			$datato['request_code'] = $request_code;
			$datato['field'] = 'request_id';
			$datato['id'] = $request_id;
			$this->mod->update($datato);

			$arr_document_id = $this->input->post('document_id');
			for($i=0;$i<count($arr_document_id);$i++){
				unset($datato);
				$datato['table'] = 'patlog__procurement.data__document';
				$datato['where'] = array(
					'patlog__procurement.data__document.document_id' => $arr_document_id[$i]
				);
				$Q1 = $this->view->view_data($datato);
				if($Q1->num_rows()){
					$R1 = $Q1->row();
					$request_document_order = $R1->document_order;
					$request_document_name = $R1->document_name;
					$request_document_mandatory = $R1->document_mandatory;
					$request_document_mimes = $R1->document_mimes;
				}else{
					$request_document_order = null;
					$request_document_name = null;
					$request_document_mandatory = null;
					$request_document_mimes = null;
				}
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request_document';
				$datato['request_id'] = $request_id;
				$datato['document_id'] = $arr_document_id[$i];
				$datato['request_document_order'] = $request_document_order;
				$datato['request_document_name'] = $request_document_name;
				$datato['request_document_mandatory'] = $request_document_mandatory;
				$datato['request_document_mimes'] = $request_document_mimes;
				$datato['request_document_file'] = 'no.pdf';
				$datato['request_document_insert'] = date('Y-m-d H:i:s');
				$request_document_id = $this->mod->insert($datato);
				
				unset($data);
				foreach($_FILES['request_document_file'] as $key => $file){
					$data[$key] = $_FILES['request_document_file'][$key];
				}
				if(isset($data['name'][$i])){
					$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
					$file_name = 'document-file-'.md5($request_id).'-'.md5($request_document_id).'.'.$ext;
					$path = './assets/mod__procurement/attach/request-document-file/'.$file_name;
					if (strpos($request_document_mimes, ',') !== false) {
						$arr_type = explode(',', $request_document_mimes);
					} else {
						$arr_type = array($request_document_mimes);
					}
					$arr_type = explode(',',$request_document_mimes);
					if(in_array($data['type'][$i], $arr_type)){
						move_uploaded_file($data['tmp_name'][$i], $path);
						unset($datato);
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__request_document';
						$datato['request_document_file'] = $file_name;
						$datato['field'] = 'request_document_id';
						$datato['id'] = $request_document_id;
						$this->mod->update($datato);
					}
				}
			}
			
			foreach($_FILES['request_det_attachment'] as $key => $file){
				$data[$key] = $_FILES['request_det_attachment'][$key];
			}
			$arr_request_det_item = $this->input->post('request_det_item');
			$arr_request_det_qty = $this->input->post('request_det_qty');
			$arr_request_det_unit = $this->input->post('request_det_unit');
			$arr_request_det_estimate_price = $this->input->post('request_det_estimate_price');
			$arr_request_det_note = $this->input->post('request_det_note');
			for($i=0;$i<count($arr_request_det_item);$i++){
				unset($datato);
				$datato['table'] = 'patlog__procurement.data__unit';		
				$datato['where'] = array(
					'patlog__procurement.data__unit.unit_id' => urldecode($arr_request_det_unit[$i])
				);
				$Q1 = $this->view->view_data($datato);
				if($Q1->num_rows()){
					$R1 = $Q1->row();
					$request_det_unit_id = $R1->unit_id;	
					$request_det_unit = $R1->unit_name;			
				}else{
					$request_det_unit_id = null;
					$request_det_unit = null;
				}			
				
				unset($datato);	
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request_det';
				$datato['request_id'] = $request_id;
				$datato['request_det_item'] = $arr_request_det_item[$i];
				$datato['request_det_qty'] = $arr_request_det_qty[$i];
				$datato['unit_id'] = $request_det_unit_id;
				$datato['request_det_unit'] = $request_det_unit;
				$datato['request_det_estimate_price'] = $arr_request_det_estimate_price[$i];
				$datato['request_det_note'] = $arr_request_det_note[$i];
				$datato['request_det_attachment'] = 'no.pdf';
				$datato['request_det_created_date'] = date('Y-m-d h:i:s');				
				$request_det_id = $this->mod->insert($datato);
				
				$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
				$file_name = 'request_doc-'.md5($request_id).'-'.md5($request_det_id).'.'.$ext;
				$path = './assets/mod__procurement/attach/request_document/'.$file_name;
				$arr_type = array(
					'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
					'application/vnd.ms-excel',
					'application/pdf',
					'image/jpg',
					'image/jpeg',
					'image/png'
				);
				if(in_array($data['type'][$i], $arr_type)){
					move_uploaded_file($data['tmp_name'][$i], $path);
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__request_det';
					$datato['request_det_attachment'] = $file_name;
					$datato['field'] = 'request_det_id';
					$datato['id'] = $request_det_id;
					$this->mod->update($datato);
				}
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
				'patlog__config.entity__approval.approval_type_id' => 2,
				'patlog__config.entity__approval.division_id' => $division_id
			);
			$Q1 = $this->view->view_data($datato);
			foreach($Q1->result() as $R1){
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request_approval';
				$datato['request_id'] = $request_id;
				$datato['request_approval_level'] = $R1->approval_detail_level;
				$datato['employee_in_id'] = $R1->approval_detail_employee_in_id;
				$datato['request_approval_name'] = $R1->approval_detail_employee_in_name;
				$datato['request_approval_position'] = $R1->approval_detail_employee_in_position;
				$datato['request_approval_category'] = $R1->approval_detail_role;
				$datato['request_approval_status'] =  null;
				$datato['request_approval_date'] = null;
				$datato['request_approval_created'] = date('Y-m-d H:i:s');
				$request_approval_id = $this->mod->insert($datato);
			}
			
			if(isset($_FILES['request_attachment_file'])){
				$arr_request_attachment_name = $this->input->post('request_attachment_name');
				$arr_request_attachment_file = $this->input->post('request_attachment_file');
				
				foreach($_FILES['request_attachment_file'] as $key => $file){
					$data[$key] = $_FILES['request_attachment_file'][$key];
				}
				
				for($i=0;$i<count($arr_request_attachment_name);$i++){
					if($arr_request_attachment_name[$i] != ''){
						unset($datato);
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__request_attachment';
						$datato['request_id'] = $request_id;
						$datato['request_attachment_name'] = $arr_request_attachment_name[$i];
						$datato['request_attachment_file'] = 'no.pdf';
						$datato['request_attachment_insert'] = date('Y-m-d H:i:s');
						$request_attachment_id = $this->mod->insert($datato);
						
						$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
						$file_name = 'request-attachment-file-'.md5($request_id).'-'.md5($request_attachment_id).'.'.$ext;
						$path = './assets/mod__procurement/attach/request-attachment-file/'.$file_name;
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
							$datato['database'] = 'patlog__procurement';
							$datato['table'] = 'entity__request_attachment';
							$datato['request_attachment_file'] = $file_name;
							$datato['field'] = 'request_attachment_id';
							$datato['id'] = $request_attachment_id;
							$this->mod->update($datato);
						}
					}
				}
			}
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_log';
			$datato['where'] = array(
				'patlog__procurement.entity__request_log.request_id' => $request_id
			);
			$Q1 = $this->view->view_data($datato);
			$request_log_level = $Q1->num_rows() + 1;
			
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__request_log';
			$datato['request_id'] = $request_id;
			$datato['request_log_level'] = $request_log_level;
			$datato['request_log_name'] = $request_employee_in_name;
			$datato['request_log_status'] = 'Dibuat';
			$datato['request_log_message'] = '';	
			$datato['request_log_created_date'] = date('Y-m-d H:i:s');				
			$request_log_id = $this->mod->insert($datato);
			
			$this->func_generate_qr($request_id);
			$this->send_email_request($request_id, $request_approval_employee_in_id, $request_employee_in_name);
			
			# Notification
			unset($notif);
            $notif['title'] = 'Info Module Procurement';
            $notif['message'] = $request_employee_in_name.' telah mengajukan permintaan, yuk cek di aplikasi Anda.';
			$notif['user_device_employee_in_id'] = array(
				$request_approval_employee_in_id
			);
			$notif['screen'] = array(
				'ProsesProcurementApproval'
			);
            $notif['detail_id'] = $request_id;
            $this->notification($notif);
			
			$this->session->set_flashdata('success', 'Data berhasil ditambah.');
			redirect(site_url().'module_procurement/admin/formulir/');
		}elseif($this->uri->segment(4) == 'edit'){
			ini_set('memory_limit', '-1');
			ini_set('max_execution_time', 0);
			set_time_limit(0);
			
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$request_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request';
			$datato['where'] = array(
				'patlog__procurement.entity__request.request_id' => $request_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['table'] = 'patlog__hrms.entity__employee_in';
				$datato['table_join'] = array(
					'patlog__hrms.entity__division',
					'patlog__hrms.entity__functions'
				);
				$datato['table_join_on'] = array(
					'patlog__hrms.entity__employee_in',
					'patlog__hrms.entity__employee_in'
				);
				$datato['join_id'] = array(
					'division_id',
					'functions_id'
				);
				$datato['join_type'] = array(
					'inner',
					'inner'
				);
				$datato['where'] = array(
					'patlog__hrms.entity__employee_in.employee_in_id' => urldecode($this->input->post('employee_in_id'))
				);	
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$employee_in_id = $R2->employee_in_id;
					$request_employee_in_name = $R2->employee_in_name;	
					$division_id = $R2->division_id;	
					$request_division_name = $R2->division_name;	
					$functions_id = $R2->functions_id;	
					$request_functions_name = $R2->functions_name;	
				}else{
					$employee_in_id = null;
					$request_employee_in_name = null;
					$division_id = null;
					$request_division_name = null;
					$functions_id = null;
					$request_functions_name = null;
				}
				
				unset($datato);
				$datato['table'] = 'patlog__procurement.data__cost_category';		
				$datato['where'] = array(
					'patlog__procurement.data__cost_category.cost_category_id' => urldecode($this->input->post('cost_category_id'))
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$cost_category_id = $R2->cost_category_id;
					$request_cost_category_name = $R2->cost_category_name;		
				}else{
					$cost_category_id = null;
					$request_cost_category_name = null;
				}
				
				$request_source_id = null;
				$request_source_code = null;
				$request_source_code_description = null;
				if(urldecode($this->input->post('cost_category_id')) == 1){ 
					unset($datato);
					$datato['table'] = 'patlog__project.entity__cost_center';
					$datato['where'] = array(
						'patlog__project.entity__cost_center.cost_center_id' => urldecode($this->input->post('type_code_id'))
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						$request_source_id = $R2->cost_center_id;
						$request_source_code = $R2->cost_center_name;
						$request_source_code_description = $R2->cost_center_description;			
					}
				}elseif(urldecode($this->input->post('cost_category_id')) == 2){ 
					unset($datato);
					$datato['table'] = 'patlog__project.entity__project_code';
					$datato['where'] = array(
						'patlog__project.entity__project_code.project_code_id' => urldecode($this->input->post('type_code_id'))
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						$request_source_id = $R2->project_code_id;
						$request_source_code = $R2->project_code_name;
						$request_source_code_description = $R2->project_code_description;			
					}
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
					'patlog__config.entity__approval.approval_type_id' => 2,
					'patlog__config.entity__approval.division_id' => $division_id
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$request_approval_employee_in_id = $R2->approval_detail_employee_in_id;
					$request_approval_employee_in_name = $R2->approval_detail_employee_in_name;
					$request_approval_level = $R2->approval_detail_level;
				}else{
					$request_approval_employee_in_id = null;
					$request_approval_employee_in_name = null;
					$request_approval_level = null;
				}
				
				$request_grandtotal_estimate = 0;
				$arr_request_det_qty = $this->input->post('request_det_qty');
				$arr_request_det_estimate_price = $this->input->post('request_det_estimate_price');
				for($i=0;$i<count($arr_request_det_qty);$i++){
					$request_grandtotal_estimate = $request_grandtotal_estimate + ($arr_request_det_qty[$i] * $arr_request_det_estimate_price[$i]);
				}
				
				unset($datato);
				$datato['table'] = 'patlog__hrms.entity__employee_in';
				$datato['where'] = array(
					'patlog__hrms.entity__employee_in.employee_in_id' => urldecode($this->input->post('request_pic_contract_id'))
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$request_pic_contract_id = $R2->employee_in_id;
					$request_pic_contract_name = $R2->employee_in_name;
				}else{
					$request_pic_contract_id = null;
					$request_pic_contract_name = null;
				}
				
				unset($datato);
				$datato['table'] = 'patlog__config.entity__approval';
				$datato['where'] = array(
					'patlog__config.entity__approval.approval_id' => urldecode($this->input->post('request_pic_contract_approval_id'))
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$request_pic_contract_approval_id = $R2->approval_id;
					$request_pic_contract_approval_name = $R2->approval_name;
				}else{
					$request_pic_contract_approval_id = null;
					$request_pic_contract_approval_name = null;
				}
				
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__request';
				$datato['where'] = array(
					'patlog__contract.entity__request.request_id' => urldecode($this->input->post('request_pic_contract_request_id'))
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$request_pic_contract_request_id = $R2->request_id;
					$request_pic_contract_request_name = $R2->request_name;
				}else{
					$request_pic_contract_request_id = null;
					$request_pic_contract_request_name = null;
				}
				
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__request_description';
				$datato['where'] = array(
					'patlog__contract.entity__request_description.request_description_id' => urldecode($this->input->post('request_pic_contract_request_description_id'))
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$request_pic_contract_request_description_id = $R2->request_description_id;
					$request_pic_contract_request_description_name = $R2->request_description_name;
				}else{
					$request_pic_contract_request_description_id = null;
					$request_pic_contract_request_description_name = null;
				}
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request';
				$datato['request_category_name'] = urldecode($this->input->post('request_category_name'));
				$datato['request_type_name'] = $this->input->post('request_type_name');
				$datato['request_pic_contract_id'] = $request_pic_contract_id;
				$datato['request_pic_contract_name'] = $request_pic_contract_name;
				$datato['request_pic_contract_approval_id'] = $request_pic_contract_approval_id;
				$datato['request_pic_contract_approval_name'] = $request_pic_contract_approval_name;
				$datato['request_pic_contract_request_id'] = $request_pic_contract_request_id;
				$datato['request_pic_contract_request_name'] = $request_pic_contract_request_name;
				$datato['request_pic_contract_request_description_id'] = $request_pic_contract_request_description_id;
				$datato['request_pic_contract_request_description_name'] = $request_pic_contract_request_description_name;
				$datato['employee_in_id'] = $employee_in_id;
				$datato['request_employee_in_name'] = $request_employee_in_name;
				$datato['division_id'] = $division_id;
				$datato['request_division_name'] = $request_division_name;
				$datato['functions_id'] = $functions_id;
				$datato['request_functions_name'] = $request_functions_name;
				$datato['cost_category_id'] = $cost_category_id;
				$datato['request_cost_category_name'] = $request_cost_category_name;
				$datato['request_source_id'] = $request_source_id;
				$datato['request_source_code'] = $request_source_code;
				$datato['request_source_code_description'] = $request_source_code_description;
				$datato['request_used_date'] = $this->input->post('request_used_date');
				$datato['request_currency'] = urldecode($this->input->post('request_currency'));
				$datato['request_grandtotal_estimate'] = $request_grandtotal_estimate;
				$datato['request_note'] = $this->input->post('request_note');
				if($R1->request_approval_level == 1 or $R1->request_status == 'reject'){
					$datato['request_approval_employee_in_id'] = $request_approval_employee_in_id;
					$datato['request_approval_employee_in_name'] = $request_approval_employee_in_name;
					$datato['request_process_document'] = 'no.pdf';
					$datato['request_approval_level'] = $request_approval_level;
					$datato['request_status'] = 'waiting_approve'; 
					$datato['request_status_information'] = 'Menunggu disetujui '.$request_approval_employee_in_name;
					$datato['request_is_finish'] = 0; 
					$datato['request_is_delete'] = 0; 
					$datato['request_created_by'] = $request_employee_in_name;
					$datato['request_created_date'] = date('Y-m-d H:i:s');
				}
				$datato['field'] = 'request_id';
				$datato['id'] = $R1->request_id;
				$this->mod->update($datato);
				
				$arr_request_document_id = $this->input->post('request_document_id');
				$__admin_audit = $this->_get_current_admin_for_audit();
				for($i=0;$i<count($arr_request_document_id);$i++){
					unset($datato);
					$datato['table'] = 'patlog__procurement.entity__request_document';
					$datato['where'] = array(
						'patlog__procurement.entity__request_document.request_document_id' => $arr_request_document_id[$i]
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						$request_document_mimes = $R2->request_document_mimes;
						$request_document_current_file = $R2->request_document_file;
					}else{
						$request_document_mimes = null;
						$request_document_current_file = 'no.pdf';
					}

					unset($data);
					foreach($_FILES['request_document_file'] as $key => $file){
						$data[$key] = $_FILES['request_document_file'][$key];
					}
					if(isset($data['name'][$i])){
						$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
						$file_name = 'document-file-'.md5($R1->request_id).'-'.md5($arr_request_document_id[$i]).'.'.$ext;
						$path = './assets/mod__procurement/attach/request-document-file/'.$file_name;
						if (strpos($request_document_mimes, ',') !== false) {
							$arr_type = explode(',', $request_document_mimes);
						} else {
							$arr_type = array($request_document_mimes);
						}
						$arr_type = explode(',',$request_document_mimes);
						if(in_array($data['type'][$i], $arr_type)){
							$this->_archive_request_document_version($arr_request_document_id[$i], $R1->request_id, $request_document_current_file, 'replace', $__admin_audit['id'], $__admin_audit['name'], 'admin', null);
							move_uploaded_file($data['tmp_name'][$i], $path);
							unset($datato);
							$datato['database'] = 'patlog__procurement';
							$datato['table'] = 'entity__request_document';
							$datato['request_document_file'] = $file_name;
							$datato['field'] = 'request_document_id';
							$datato['id'] = $arr_request_document_id[$i];
							$this->mod->update($datato);
						}
					}
				}
				
				foreach($_FILES['request_det_attachment'] as $key => $file){
					$data[$key] = $_FILES['request_det_attachment'][$key];
				}
				$arr_request_det_id = $this->input->post('request_det_id');
				$arr_request_det_item = $this->input->post('request_det_item');
				$arr_request_det_qty = $this->input->post('request_det_qty');
				$arr_request_det_unit = $this->input->post('request_det_unit');
				$arr_request_det_estimate_price = $this->input->post('request_det_estimate_price');
				$arr_request_det_note = $this->input->post('request_det_note');
				for($i=0;$i<count($arr_request_det_item);$i++){
					unset($datato);
					$datato['table'] = 'patlog__procurement.data__unit';		
					$datato['where'] = array(
						'patlog__procurement.data__unit.unit_id' => urldecode($arr_request_det_unit[$i])
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						$request_det_unit_id = $R2->unit_id;	
						$request_det_unit = $R2->unit_name;			
					}else{
						$request_det_unit_id = null;
						$request_det_unit = null;
					}
					
					if(isset($arr_request_det_id[$i])){
						unset($datato);	
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__request_det';
						$datato['request_det_item'] = $arr_request_det_item[$i];
						$datato['request_det_qty'] = $arr_request_det_qty[$i];
						$datato['unit_id'] = $request_det_unit_id;
						$datato['request_det_unit'] = $request_det_unit;
						$datato['request_det_estimate_price'] = $arr_request_det_estimate_price[$i];
						$datato['request_det_note'] = $arr_request_det_note[$i];
						$datato['field'] = 'request_det_id';
						$datato['id'] = $arr_request_det_id[$i];
						$this->mod->update($datato);
						
						$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
						$file_name = 'request_doc-'.md5($R1->request_id).'-'.md5($arr_request_det_id[$i]).'.'.$ext;
						$path = './assets/mod__procurement/attach/request_document/'.$file_name;
						$arr_type = array(
							'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
							'application/vnd.ms-excel',
							'application/pdf',
							'image/jpg',
							'image/jpeg',
							'image/png'
						);
						if(in_array($data['type'][$i], $arr_type)){
							move_uploaded_file($data['tmp_name'][$i], $path);
							unset($datato);
							$datato['database'] = 'patlog__procurement';
							$datato['table'] = 'entity__request_det';
							$datato['request_det_attachment'] = $file_name;
							$datato['field'] = 'request_det_id';
							$datato['id'] = $arr_request_det_id[$i];
							$this->mod->update($datato);
						}
					}else{
						unset($datato);	
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__request_det';
						$datato['request_id'] = $R1->request_id;
						$datato['request_det_item'] = $arr_request_det_item[$i];
						$datato['request_det_qty'] = $arr_request_det_qty[$i];
						$datato['unit_id'] = $request_det_unit_id;
						$datato['request_det_unit'] = $arr_request_det_unit[$i];
						$datato['request_det_estimate_price'] = $arr_request_det_estimate_price[$i];
						$datato['request_det_note'] = $arr_request_det_note[$i];
						$datato['request_det_attachment'] = 'no.pdf';
						$datato['request_det_created_date'] = date('Y-m-d h:i:s');				
						$request_det_id = $this->mod->insert($datato);
						
						$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
						$file_name = 'request_doc-'.md5($R1->request_id).'-'.md5($request_det_id).'.'.$ext;
						$path = './assets/mod__procurement/attach/request_document/'.$file_name;
						$arr_type = array(
							'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
							'application/vnd.ms-excel',
							'application/pdf',
							'image/jpg',
							'image/jpeg',
							'image/png'
						);
						if(in_array($data['type'][$i], $arr_type)){
							move_uploaded_file($data['tmp_name'][$i], $path);
							unset($datato);
							$datato['database'] = 'patlog__procurement';
							$datato['table'] = 'entity__request_det';
							$datato['request_det_attachment'] = $file_name;
							$datato['field'] = 'request_det_id';
							$datato['id'] = $request_det_id;
							$this->mod->update($datato);
						}
					}
				}
				
				if($R1->request_approval_level == 1 or $R1->request_status == 'reject'){
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__request_approval';
					$datato['field'] = 'request_id';
					$datato['id'] = $R1->request_id;
					$this->mod->delete($datato);
					
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
						'patlog__config.entity__approval.approval_type_id' => 2,
						'patlog__config.entity__approval.division_id' => $division_id
					);
					$Q2 = $this->view->view_data($datato);
					foreach($Q2->result() as $R2){
						unset($datato);
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__request_approval';
						$datato['request_id'] = $R1->request_id;
						$datato['request_approval_level'] = $R2->approval_detail_level;
						$datato['employee_in_id'] = $R2->approval_detail_employee_in_id;
						$datato['request_approval_name'] = $R2->approval_detail_employee_in_name;
						$datato['request_approval_position'] = $R2->approval_detail_employee_in_position;
						$datato['request_approval_category'] = $R2->approval_detail_role;
						$datato['request_approval_status'] =  null;
						$datato['request_approval_date'] = null;
						$datato['request_approval_created'] = date('Y-m-d H:i:s');
						$request_approval_id = $this->mod->insert($datato);
					}
				}
				
				$arr_request_attachment_id = $this->input->post('request_attachment_id');
				$arr_request_attachment_name = $this->input->post('request_attachment_name');
				$arr_request_attachment_file = $this->input->post('request_attachment_file');
				if(isset($_FILES['request_attachment_file'])){
					foreach($_FILES['request_attachment_file'] as $key => $file){
						$data[$key] = $_FILES['request_attachment_file'][$key];
					}
				}
				for($i=0;$i<count($arr_request_attachment_name);$i++){
					if($arr_request_attachment_name[$i] != ''){
						if(isset($arr_request_attachment_id[$i])){
							unset($datato);
							$datato['database'] = 'patlog__procurement';
							$datato['table'] = 'entity__request_attachment';
							$datato['request_id'] = $R1->request_id;
							$datato['request_attachment_name'] = $arr_request_attachment_name[$i];
							$datato['field'] = 'request_attachment_id';
							$datato['id'] = $arr_request_attachment_id[$i];
							$this->mod->update($datato);
							
							if(isset($data['name'][$i])){
								$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
								$file_name = 'request-attachment-file-'.md5($R1->request_id).'-'.md5($arr_request_attachment_id[$i]).'.'.$ext;
								$path = './assets/mod__procurement/attach/request-attachment-file/'.$file_name;
								$arr_type = array(
									'application/pdf'
								);
								if(in_array($data['type'][$i], $arr_type)){
									move_uploaded_file($data['tmp_name'][$i], $path);
									unset($datato);
									$datato['database'] = 'patlog__procurement';
									$datato['table'] = 'entity__request_attachment';
									$datato['request_attachment_file'] = $file_name;
									$datato['field'] = 'request_attachment_id';
									$datato['id'] = $arr_request_attachment_id[$i];
									$this->mod->update($datato);
								}
							}
						}else{
							unset($datato);
							$datato['database'] = 'patlog__procurement';
							$datato['table'] = 'entity__request_attachment';
							$datato['request_id'] = $R1->request_id;
							$datato['request_attachment_name'] = $arr_request_attachment_name[$i];
							$datato['request_attachment_file'] = 'no.pdf';
							$datato['request_attachment_insert'] = date('Y-m-d H:i:s');
							$request_attachment_id = $this->mod->insert($datato);
							
							if(isset($data['name'][$i])){
								$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
								$file_name = 'request-attachment-file-'.md5($R1->request_id).'-'.md5($request_attachment_id).'.'.$ext;
								$path = './assets/mod__procurement/attach/request-attachment-file/'.$file_name;
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
									$datato['database'] = 'patlog__procurement';
									$datato['table'] = 'entity__request_attachment';
									$datato['request_attachment_file'] = $file_name;
									$datato['field'] = 'request_attachment_id';
									$datato['id'] = $request_attachment_id;
									$this->mod->update($datato);
								}
							}
						}
					}
				}
				
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__request_log';
				$datato['where'] = array(
					'patlog__procurement.entity__request_log.request_id' => $R1->request_id
				);
				$Q2 = $this->view->view_data($datato);
				$request_log_level = $Q2->num_rows() + 1;
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request_log';
				$datato['request_id'] = $R1->request_id;
				$datato['request_log_level'] = $request_log_level;
				$datato['request_log_name'] = $request_employee_in_name;
				$datato['request_log_status'] = 'Diedit';
				$datato['request_log_message'] = '';	
				$datato['request_log_created_date'] = date('Y-m-d H:i:s');				
				$request_log_id = $this->mod->insert($datato);
				
				$this->func_generate_qr($R1->request_id);
				$this->send_email_request($R1->request_id, $R1->request_approval_employee_in_id, $R1->request_employee_in_name);
				
				if($R1->request_approval_level == 1 or $R1->request_status == 'reject'){
					# Notification
					unset($notif);
					$notif['title'] = 'Info Module Procurement';
					$notif['message'] = $R1->request_employee_in_name.' telah mengajukan permintaan, yuk cek di aplikasi Anda.';
					$notif['user_device_employee_in_id'] = array(
						$request_approval_employee_in_id
					);
					$notif['screen'] = array(
						'ProsesProcurementApproval'
					);
					$notif['detail_id'] = $R1->request_id;
					$this->notification($notif);
				}
			}
			
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect(site_url().'module_procurement/admin/proses_permintaan/');
		}elseif($this->uri->segment(4) == 'delete'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$request_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request';
			$datato['where'] = array(
				'patlog__procurement.entity__request.request_id' => $request_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request';
				$datato['request_status_information'] = 'Dihapus';
				$datato['request_is_delete'] = 1;
				$datato['field'] = 'request_id';
				$datato['id'] = $R1->request_id;
				$this->mod->update($datato);
				
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__request_log';
				$datato['where'] = array(
					'patlog__procurement.entity__request_log.request_id' => $R1->request_id
				);
				$Q2 = $this->view->view_data($datato);
				$request_log_level = $Q2->num_rows() + 1;
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request_log';
				$datato['request_id'] = $R1->request_id;
				$datato['request_log_level'] = $request_log_level;
				$datato['request_log_name'] = $R1->request_employee_in_name;
				$datato['request_log_status'] = 'Dihapus';
				$datato['request_log_message'] = '';	
				$datato['request_log_created_date'] = date('Y-m-d H:i:s');				
				$request_log_id = $this->mod->insert($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect(site_url().'module_procurement/admin/proses_permintaan/');
		}
	}
	
	public function request_det()
	{
		if($this->uri->segment(4) == 'delete'){
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_det';
			$datato['where'] = array(
				'patlog__procurement.entity__request_det.request_det_id' => $this->input->post('request_det_id')
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				if(file_exists('./assets/mod__procurement/attach/request_document//'.$R1->request_det_attachment) and $R1->request_det_attachment != 'no.pdf'){
					unlink('./assets/mod__procurement/attach/request_document/'.$R1->request_det_attachment);
				}
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request_det';
				$datato['field'] = 'request_det_id';
				$datato['id'] = $R1->request_det_id;
				$this->mod->delete($datato);
			}
		}
	}
	
	public function request_attachment()
	{
		if($this->uri->segment(4) == 'delete'){
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_attachment';
			$datato['where'] = array(
				'patlog__procurement.entity__request_attachment.request_attachment_id' => $this->input->post('request_attachment_id')
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				if(file_exists('assets/mod__procurement/attach/request-attachment-file/'.$R1->request_attachment_file) and $R1->request_attachment_file != 'no.pdf'){
					unlink('assets/mod__procurement/attach/request-attachment-file/'.$R1->request_attachment_file);
				}
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request_attachment';
				$datato['field'] = 'request_attachment_id';
				$datato['id'] = $R1->request_attachment_id;
				$this->mod->delete($datato);
			}
		}
	}
	
	public function request_approval()
	{
		$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(4));
		$request_id = $this->encrypt->decode($decrypt_id);
		
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__request';
		$datato['where'] = array(
			'patlog__procurement.entity__request.request_id' => $request_id
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			if(!empty(urldecode($this->input->post('request_approval_employee_in_id')))){
				unset($datato);
				$datato['table'] = 'patlog__hrms.entity__employee_in';
				$datato['where'] = array(
					'patlog__hrms.entity__employee_in.employee_in_id' => urldecode($this->input->post('request_approval_employee_in_id'))
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
			}else{
				$employee_in_id = null;
				$employee_in_name = null;
			}
			
			$request_approval_employee_in_id = null;
			if(urldecode($this->input->post('request_log_status')) == 'Disetujui'){
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__request_approval';	
				if($employee_in_id != null){				
					$datato['where'] = array(
						'patlog__procurement.entity__request_approval.request_id' => $R1->request_id,
						'patlog__procurement.entity__request_approval.employee_in_id is null' => null,
						'patlog__procurement.entity__request_approval.request_approval_name' => 'Loket'
					);
				}else{
					$datato['where'] = array(
						'patlog__procurement.entity__request_approval.request_id' => $R1->request_id,
						'patlog__procurement.entity__request_approval.employee_in_id' => $R1->request_approval_employee_in_id,
						'patlog__procurement.entity__request_approval.request_approval_status is null' => null
					);
				}
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__request_approval';	
					if($employee_in_id != null){
						$datato['employee_in_id'] = $employee_in_id;
						$datato['request_approval_name'] = $employee_in_name;
					}
					$datato['request_approval_status'] = 'Disetujui';
					$datato['request_approval_date'] = date('Y-m-d H:i:s');
					$datato['field'] = 'request_approval_id';
					$datato['id'] = $R2->request_approval_id;
					$this->mod->update($datato);
					
					if($R2->request_approval_category == 'Assigner'){
						unset($datato);
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__request';
						if($employee_in_id != null){
							$datato['request_process_employee_in_id'] = $employee_in_id;
							$datato['request_process_employee_in_name'] = $employee_in_name;
						}
						$datato['request_process_date_end'] = date('Y-m-d H:i:s');
						$datato['field'] = 'request_id';
						$datato['id'] = $R1->request_id;
						$this->mod->update($datato);
					}
				}
				
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__request_approval';		
				$datato['where'] = array(
					'patlog__procurement.entity__request_approval.request_id' => $R1->request_id,
					'patlog__procurement.entity__request_approval.request_approval_status is null' => null
				);	
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					
					$request_approval_employee_in_id = $R2->employee_in_id;
					
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__request';		
					$datato['request_approval_employee_in_id'] = $R2->employee_in_id;
					$datato['request_approval_employee_in_name'] = $R2->request_approval_name;
					$datato['request_approval_level'] = $R2->request_approval_level;
					$datato['request_status_information'] = 'Menunggu disetujui '.$R2->request_approval_name;
					$datato['field'] = 'request_id';
					$datato['id'] = $R1->request_id;
					$this->mod->update($datato);
					
					if($R2->request_approval_category == 'Assigner'){
						unset($datato);
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__request';
						$datato['request_process_employee_in_id'] = $R2->employee_in_id;
						$datato['request_process_employee_in_name'] = $R2->request_approval_name;
						$datato['request_process_date_start'] = date('Y-m-d H:i:s');
						$datato['field'] = 'request_id';
						$datato['id'] = $R1->request_id;
						$this->mod->update($datato);
					}
				}
			}elseif(urldecode($this->input->post('request_log_status')) == 'Ditolak'){
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__request_approval';		
				$datato['where'] = array(
					'patlog__procurement.entity__request_approval.request_id' => $R1->request_id,
					'patlog__procurement.entity__request_approval.employee_in_id' => $R1->request_approval_employee_in_id,
					'patlog__procurement.entity__request_approval.request_approval_status is null' => null
				);	
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();

					if($R1->request_process_date_end == null){
						unset($datato);
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__request';
						$datato['request_process_employee_in_id'] = null;
						$datato['request_process_employee_in_name'] = null;
						$datato['request_process_date_start'] = null;
						$datato['request_process_date_end'] = null;				
						$datato['request_approval_employee_in_id'] = null;
						$datato['request_approval_employee_in_name'] = null;
						$datato['request_status'] = 'reject';
						$datato['request_approval_level'] = null;
						$datato['request_status_information'] = 'Ditolak '.$R2->request_approval_name;
						$datato['field'] = 'request_id';
						$datato['id'] = $R1->request_id;
						$this->mod->update($datato);
						
						unset($datato);
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__request_approval';				
						$datato['request_approval_status'] = null;
						$datato['request_approval_date'] = null;
						$datato['field'] = 'request_id';
						$datato['id'] = $R1->request_id;
						$this->mod->update($datato);
						
						$request_approval_employee_in_id = $R1->employee_in_id;
					}else{
						$request_approval_level = null;
						$set = 'false';
						unset($datato);
						$datato['table'] = 'patlog__procurement.entity__request_approval';
						$datato['where'] = array(
							'patlog__procurement.entity__request_approval.request_id' => $R1->request_id
						);
						$Q3 = $this->view->view_data($datato);
						foreach($Q3->result() as $R3){
							if($R3->request_approval_position == 'Loket'){
								$request_approval_level = $R3->request_approval_level;
								$set = 'true';
							}
							
							if($set == 'true'){
								unset($datato);
								$datato['database'] = 'patlog__procurement';
								$datato['table'] = 'entity__request_approval';				
								$datato['request_approval_status'] = null;
								$datato['request_approval_date'] = null;
								$datato['field'] = 'request_approval_id';
								$datato['id'] = $R3->request_approval_id;
								$this->mod->update($datato);
							}
						}
						
						unset($datato);
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__request';
						$datato['request_process_date_end'] = null;
						$datato['request_approval_employee_in_id'] = $R1->request_process_employee_in_id;
						$datato['request_approval_employee_in_name'] = $R1->request_process_employee_in_name;
						$datato['request_status'] = 'waiting_approve';
						$datato['request_approval_level'] = $request_approval_level;
						$datato['request_status_information'] = 'Menunggu disetujui Loket';
						$datato['field'] = 'request_id';
						$datato['id'] = $R1->request_id;
						$this->mod->update($datato);
						
						$request_approval_employee_in_id = $R1->request_process_employee_in_id;
					}
				}
			}
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_approval';
			$datato['where'] = array(
				'patlog__procurement.entity__request_approval.request_id' => $R1->request_id,
				'patlog__procurement.entity__request_approval.request_approval_status is null' => NULL
			);
			$datato['order'] = array(
				'patlog__procurement.entity__request_approval.request_approval_id'
			);
			$datato['order_type'] = array(
				'asc'
			);
			$Q2 = $this->view->view_data($datato);
			if(!$Q2->num_rows()){
				$R2 = $Q2->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request';
				$datato['request_approval_employee_in_id'] = null;
				$datato['request_approval_employee_in_name'] = null;
				$datato['request_approval_level'] = 3;	
				$datato['request_status'] = 'process_procurement';	
				$datato['request_status_information'] = 'Proses Penugasan ke PIC Procurement';	
				$datato['field'] = 'request_id';
				$datato['id'] = $R1->request_id;
				$this->mod->update($datato);
			}
			
			if(isset($_FILES['request_process_document'])){
				unset($data);
				foreach($_FILES['request_process_document'] as $key => $file){
					$data[$key] = $_FILES['request_process_document'][$key];
				}
				if(isset($data['name'])){
					$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
					$file_name = 'request-process-document-'.md5($R1->request_id).'.'.$ext;
					$path = './assets/mod__procurement/attach/request-process-document/'.$file_name;
					$arr_type = array(
						'application/pdf',
					);
					if(in_array($data['type'], $arr_type)){
						$__loket_audit = $this->_get_current_admin_for_audit();
						$this->_archive_request_document_version(null, $R1->request_id, $R1->request_process_document, 'replace', $__loket_audit['id'], $__loket_audit['name'], 'admin', null, 'loket_process', './assets/mod__procurement/attach/request-process-document/');
						move_uploaded_file($data['tmp_name'], $path);
						unset($datato);
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__request';
						$datato['request_process_document'] = $file_name;
						$datato['field'] = 'request_id';
						$datato['id'] = $request_id;
						$this->mod->update($datato);
					}
				}
			}
			
			if($employee_in_id != null){
				$request_approval_employee_in_name = $employee_in_name;
			}else{
				$request_approval_employee_in_name = $R1->request_approval_employee_in_name;
			}
			
			if($request_approval_employee_in_name == 'Loket'){
				$request_approval_employee_in_name = 'Tim Procurement';
			}
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_log';
			$datato['where'] = array(
				'patlog__procurement.entity__request_log.request_id' => $R1->request_id
			);
			$Q2 = $this->view->view_data($datato);
			$request_log_level = $Q2->num_rows() + 1;
			
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__request_log';				
			$datato['request_id'] = $R1->request_id;
			$datato['request_log_level'] = $request_log_level;
			$datato['request_log_name'] = $request_approval_employee_in_name;
			$datato['request_log_status'] = urldecode($this->input->post('request_log_status'));
			$datato['request_log_message'] = $this->input->post('request_log_message');
			$datato['request_log_created_date'] = date('Y-m-d H:i:s');				
			$request_log_id = $this->mod->insert($datato);
			
			if($request_approval_employee_in_id != null){
				if(urldecode($this->input->post('request_log_status')) == 'Disetujui'){
					$this->send_email_approve($R1->request_id, $request_approval_employee_in_id, $request_approval_employee_in_name, $this->input->post('request_log_message'));
				}
				
				if(urldecode($this->input->post('request_log_status')) == 'Ditolak'){
					$this->send_email_reject($R1->request_id, $request_approval_employee_in_id, $request_approval_employee_in_name, $this->input->post('request_log_message'));
				}
			}
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_approval';		
			$datato['where'] = array(
				'patlog__procurement.entity__request_approval.request_id' => $R1->request_id,
				'patlog__procurement.entity__request_approval.request_approval_status is null' => null
			);	
			$Q2 = $this->view->view_data($datato);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$next_approval_id = $R2->employee_in_id;
			}else{
				$next_approval_id = null;
			}
			
			# Notification
			unset($notif);
            $notif['title'] = 'Info Module Procurement';
            $notif['message'] = 'Pemintaan '.$R1->request_employee_in_name.' telah '.$this->input->post('request_log_status').' oleh '.$request_approval_employee_in_name.', yuk cek di aplikasi Anda.';
            if ($this->input->post('request_log_status') == 'Disetujui') {
                $notif['user_device_employee_in_id'] = array(
                    $R1->employee_in_id,
                    $next_approval_id
                );
                $notif['screen'] = array(
                    'ProsesProcurementView',
                    'ProsesProcurementApproval'
                );
			}elseif ($this->input->post('request_log_status') == 'Ditolak') {
                $notif['user_device_employee_in_id'] = array(
                    $R1->employee_in_id
                );
				$notif['screen'] = array(
					'ProsesProcurementView'
				);
            }
            $notif['detail_id'] = $R1->request_id;
            $this->notification($notif);
		}
		
		$this->session->set_flashdata('success', 'Data berhasil diubah.');
		redirect(site_url().'module_procurement/admin/proses_permintaan/');
	}
	
	public function request_mapping()
	{
		$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(4));
		$request_id = $this->encrypt->decode($decrypt_id);
		
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__request';
		$datato['where'] = array(
			'patlog__procurement.entity__request.request_id' => $request_id
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			unset($datato);
			$datato['table'] = 'patlog__hrms.entity__employee_in';				
			$datato['where'] = array(
				'patlog__hrms.entity__employee_in.employee_in_id' => urldecode($this->input->post('request_proc_employee_in_id'))
			);
			$Q2 = $this->view->view_data($datato);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$request_proc_employee_in_id = $R2->employee_in_id;	
				$request_proc_employee_in_name = $R2->employee_in_name;	
			}else{
				$request_proc_employee_in_id = null;	
				$request_proc_employee_in_name = null;	
			}
			
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__request';		
			$datato['request_status_information'] = 'Ditugaskan ke '.$request_proc_employee_in_name;		
			$datato['request_proc_employee_in_id'] = $request_proc_employee_in_id;
			$datato['request_proc_employee_in_name'] = $request_proc_employee_in_name;
			$datato['request_proc_date_start'] = date('Y-m-d H:i:s');
			$datato['field'] = 'request_id';
			$datato['id'] = $R1->request_id;
			$this->mod->update($datato);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_log';
			$datato['where'] = array(
				'patlog__procurement.entity__request_log.request_id' => $R1->request_id
			);
			$Q2 = $this->view->view_data($datato);
			$request_log_level = $Q2->num_rows() + 1;
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_approval';
			$datato['where'] = array(
				'patlog__procurement.entity__request_approval.request_id' => $R1->request_id,
				'patlog__procurement.entity__request_approval.request_approval_category' => 'Assigner'
			);
			$Q2 = $this->view->view_data($datato);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$employee_in_id = $R2->employee_in_id;
			}else{
				$employee_in_id = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__hrms.entity__employee_in';				
			$datato['where'] = array(
				'patlog__hrms.entity__employee_in.employee_in_id' => $employee_in_id
			);
			$Q2 = $this->view->view_data($datato);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$request_log_name = $R2->employee_in_name;
			}else{
				$request_log_name = null;
			}
			
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__request_log';				
			$datato['request_id'] = $R1->request_id;
			$datato['request_log_level'] = $request_log_level;
			$datato['request_log_name'] = $request_log_name;
			$datato['request_log_status'] = 'Dimapping oleh';
			$datato['request_log_message'] = 'ke <b>'.$request_proc_employee_in_name.'</b>';
			$datato['request_log_created_date'] = date('Y-m-d H:i:s');				
			$request_log_id = $this->mod->insert($datato);
			
			$this->send_email_mapping($R1->request_id, $request_proc_employee_in_id, $request_proc_employee_in_name);
		}
		
		$this->session->set_flashdata('success', 'Data berhasil diubah.');
		redirect(site_url().'module_procurement/admin/proses_permintaan/');
	}
	
	public function request_vendor()
	{
		if($this->uri->segment(4) == 'add'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$request_id = $this->encrypt->decode($decrypt_id);
			
			$request_is_finish = 0;
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request';
			$datato['where'] = array(
				'patlog__procurement.entity__request.request_id' => $request_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();

				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__vendor';
				$datato['where'] = array(
					'patlog__procurement.entity__vendor.vendor_id' => urldecode($this->input->post('vendor_id'))
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$vendor_id = $R2->vendor_id;
					$vendor_name = $R2->vendor_name;
				}else{
					$vendor_id = null;
					$vendor_name = null;
				}
				
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__request_legal';
				$datato['where'] = array(
					'patlog__procurement.entity__request_legal.request_id' => $R1->request_id,
					'patlog__procurement.entity__request_legal.vendor_id' => $vendor_id
				);
				$Q2 = $this->view->view_data($datato);
				if(!$Q2->num_rows()){
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__request_legal';
					$datato['request_id'] = $R1->request_id;
					$datato['contract_id'] = null;
					$datato['contract_no'] = null;
					$datato['vendor_id'] = $vendor_id;
					$datato['vendor_name'] = $vendor_name;
					$datato['request_legal_date_start'] = $this->input->post('request_legal_date_start');
					$datato['request_legal_date_end'] = $this->input->post('request_legal_date_end');
					$datato['request_legal_status'] = 'Belum Kirim';
					$datato['request_legal_insert'] = date('Y-m-d H:i:s');
					$this->mod->insert($datato);
				}
				
				$request_is_finish = $R1->request_is_finish;
			}
			
			if($request_is_finish == 1){
				$page = 'arsip_permintaan';
			}else{
				$page = 'proses_permintaan';
			}
			
			$this->session->set_flashdata('success', 'Data berhasil ditambah.');
			redirect(site_url().'module_procurement/admin/'.$page.'?view=process&request_id='.$this->uri->segment(5));
		}elseif($this->uri->segment(4) == 'edit'){
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_legal';
			$datato['where'] = array(
				'patlog__procurement.entity__request_legal.request_legal_id' => $this->uri->segment(5)
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				$encrypt_id = $this->encrypt->encode($R1->request_id);
				$request_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request_legal';
				$datato['request_legal_date_start'] = $this->input->post('request_legal_date_start');
				$datato['request_legal_date_end'] = $this->input->post('request_legal_date_end');
				$datato['field'] = 'request_legal_id';
				$datato['id'] = $R1->request_legal_id;
				$this->mod->update($datato);
				
				$request_id_real = $R1->request_id;
			}else{
				$request_id = null;
				$request_id_real = null;
			}
			
			$request_is_finish = 0;
			$request_log_name = null;
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request';
			$datato['where'] = array(
				'patlog__procurement.entity__request.request_id' => $request_id_real
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$request_is_finish = $R1->request_is_finish;
				$request_log_name = $R1->request_proc_employee_in_name;
			}
			
			if($request_is_finish == 1){
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__request_log';
				$datato['where'] = array(
					'patlog__procurement.entity__request_log.request_id' => $request_id_real
				);
				$Q1 = $this->view->view_data($datato);
				$request_log_level = $Q1->num_rows() + 1;
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request_log';
				$datato['request_id'] = $request_id_real;
				$datato['request_log_level'] = $request_log_level;
				$datato['request_log_name'] = $request_log_name;
				$datato['request_log_status'] = 'Diedit';
				$datato['request_log_message'] = '';	
				$datato['request_log_created_date'] = date('Y-m-d H:i:s');				
				$request_log_id = $this->mod->insert($datato);
				
				$page = 'arsip_permintaan';
			}else{
				$page = 'proses_permintaan';
			}
			
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect(site_url().'module_procurement/admin/'.$page.'?view=process&request_id='.$request_id);
		}elseif($this->uri->segment(4) == 'delete'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$request_legal_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_legal';
			$datato['where'] = array(
				'patlog__procurement.entity__request_legal.request_legal_id' => $request_legal_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				$encrypt_id = $this->encrypt->encode($R1->request_id);
				$request_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
				
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__request_process';
				$datato['where'] = array(
					'patlog__procurement.entity__request_process.request_id' => $R1->request_id,
					'patlog__procurement.entity__request_process.vendor_id' => $R1->vendor_id
				);
				$Q2 = $this->view->view_data($datato);
				foreach($Q2->result() as $R2){
					unset($datato);
					$datato['table'] = 'patlog__procurement.entity__request_process_attach';
					$datato['where'] = array(
						'patlog__procurement.entity__request_process_attach.request_process_id' => $R2->request_process_id
					);
					$Q3 = $this->view->view_data($datato);
					foreach($Q3->result() as $R3){
						if(file_exists('./assets/mod__procurement/attach/request_process_attach/'.$R3->request_process_attach_file) and $R3->request_process_attach_file != 'no.pdf'){
							unlink('./assets/mod__procurement/attach/request_process_attach/'.$R3->request_process_attach_file);
						}
					}
					
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__request_process_attach';
					$datato['field'] = 'request_process_id';
					$datato['id'] = $R2->request_process_id;
					$this->mod->delete($datato);
					
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__request_process';
					$datato['field'] = 'request_process_id';
					$datato['id'] = $R2->request_process_id;
					$this->mod->delete($datato);
				}
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request_legal';
				$datato['field'] = 'request_legal_id';
				$datato['id'] = $R1->request_legal_id;
				$this->mod->delete($datato);
				
				$request_id_real = $R1->request_id;
			}else{
				$request_id = null;
				$request_id_real = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_process';
			$datato['where'] = array(
				'patlog__procurement.entity__request_process.request_id' => $request_id_real,
				'patlog__procurement.entity__request_process.process_proc_id' => 10
			);
			$Q1 = $this->view->view_data($datato);
			$total_winner = $Q1->num_rows();
			if($total_winner == 0){
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request';
				$datato['vendor_id'] = null;
				$datato['request_vendor_name'] = null;
				$datato['field'] = 'request_id';
				$datato['id'] = $request_id_real;
				$this->mod->update($datato);
			}

			$request_is_finish = 0;
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request';
			$datato['where'] = array(
				'patlog__procurement.entity__request.request_id' => $request_id_real
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$request_is_finish = $R1->request_is_finish;
			}
			
			if($request_is_finish == 1){
				$page = 'arsip_permintaan';
			}else{
				$page = 'proses_permintaan';
			}
			
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect(site_url().'module_procurement/admin/'.$page.'?view=process&request_id='.$request_id);
		}
	}
	
	public function request_process()
	{
		if($this->uri->segment(4) == 'add'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$request_id = $this->encrypt->decode($decrypt_id);
			
			$request_is_finish = 0;
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request';
			$datato['where'] = array(
				'patlog__procurement.entity__request.request_id' => $request_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();

				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__vendor';
				$datato['where'] = array(
					'patlog__procurement.entity__vendor.vendor_id' => urldecode($this->input->post('vendor_id'))
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$vendor_id = $R2->vendor_id;
					$vendor_name = $R2->vendor_name;
				}else{
					$vendor_id = null;
					$vendor_name = null;
				}
				
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__request_process';
				$datato['where'] = array(
					'patlog__procurement.entity__request_process.request_id' => $R1->request_id,
					'patlog__procurement.entity__request_process.vendor_id' => $vendor_id,
					'patlog__procurement.entity__request_process.process_proc_id' => 10
				);
				$Q2 = $this->view->view_data($datato);
				$total_vendor = $Q2->num_rows();
				
				if($total_vendor == 0){
					unset($datato);
					$datato['table'] = 'patlog__procurement.data__process_proc';		
					$datato['where'] = array(
						'patlog__procurement.data__process_proc.process_proc_id' => urldecode($this->input->post('process_proc_id'))
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						$request_process_proc_name = $R2->process_proc_name;
					}else{
						$request_process_proc_name = null;
					}
					
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__request';
					$datato['request_status_information'] = $request_process_proc_name;
					$datato['field'] = 'request_id';
					$datato['id'] = $R1->request_id;
					$this->mod->update($datato);
					
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__request_process';
					$datato['request_id'] = $R1->request_id;
					$datato['vendor_id'] = $vendor_id;
					$datato['vendor_name'] = $vendor_name;
					$datato['process_proc_id'] = urldecode($this->input->post('process_proc_id'));
					$datato['request_process_proc_name'] = $request_process_proc_name;
					$datato['request_process_proc_date'] = $this->input->post('request_process_date');
					$datato['request_process_proc_time'] = $this->input->post('request_process_time').':00';
					$datato['request_process_note'] = $this->input->post('request_process_note');
					$datato['request_process_created_date'] = date('Y-m-d H:i:s');			
					$request_process_id = $this->mod->insert($datato);
					
					if(urldecode($this->input->post('process_proc_id')) == 10){
						unset($datato);
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__request';
						$datato['vendor_id'] = $vendor_id;
						$datato['request_vendor_name'] = $vendor_name;
						$datato['field'] = 'request_id';
						$datato['id'] = $R1->request_id;
						$this->mod->update($datato);
					}
				}
				
				$request_is_finish = $R1->request_is_finish;
			}
			
			if($request_is_finish == 1){
				$page = 'arsip_permintaan';
			}else{
				$page = 'proses_permintaan';
			}
			
			$this->session->set_flashdata('success', 'Data berhasil ditambah.');
			redirect(site_url().'module_procurement/admin/'.$page.'?view=process&request_id='.$this->uri->segment(5));
		}elseif($this->uri->segment(4) == 'delete'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$request_process_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_process';
			$datato['where'] = array(
				'patlog__procurement.entity__request_process.request_process_id' => $request_process_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				$encrypt_id = $this->encrypt->encode($R1->request_id);
				$request_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
				
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__request_process';
				$datato['where'] = array(
					'patlog__procurement.entity__request_process.request_id' => $R1->request_id,
					'patlog__procurement.entity__request_process.process_proc_id' => 10
				);
				$Q2 = $this->view->view_data($datato);
				$total_vendor = $Q2->num_rows();
				
				if($R1->process_proc_id == 10 and $total_vendor == 1){
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__request';
					$datato['vendor_id'] = null;
					$datato['request_vendor_name'] = null;
					$datato['field'] = 'request_id';
					$datato['id'] = $R1->request_id;
					$this->mod->update($datato);
				}
				
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__request_process_attach';
				$datato['where'] = array(
					'patlog__procurement.entity__request_process_attach.request_process_id' => $R1->request_process_id
				);
				$Q2 = $this->view->view_data($datato);
				foreach($Q2->result() as $R2){
					if(file_exists('./assets/mod__procurement/attach/request_process_attach/'.$R2->request_process_attach_file) and $R2->request_process_attach_file != 'no.pdf'){
						unlink('./assets/mod__procurement/attach/request_process_attach/'.$R2->request_process_attach_file);
					}
				}
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request_process_attach';
				$datato['field'] = 'request_process_id';
				$datato['id'] = $R1->request_process_id;
				$this->mod->delete($datato);
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request_process';
				$datato['field'] = 'request_process_id';
				$datato['id'] = $R1->request_process_id;
				$this->mod->delete($datato);
				
				$request_id_real = $R1->request_id;
			}else{
				$request_id = null;
				$request_id_real = null;
			}

			$request_is_finish = 0;
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request';
			$datato['where'] = array(
				'patlog__procurement.entity__request.request_id' => $request_id_real
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$request_is_finish = $R1->request_is_finish;
			}
			
			if($request_is_finish == 1){
				$page = 'arsip_permintaan';
			}else{
				$page = 'proses_permintaan';
			}
			
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect(site_url().'module_procurement/admin/'.$page.'?view=process&request_id='.$request_id);
		}
	}
	
	public function request_process_attach()
	{
		if($this->uri->segment(4) == 'add'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$request_id = $this->encrypt->decode($decrypt_id);
			
			$request_is_finish = 0;
			$request_log_name = null;
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request';
			$datato['where'] = array(
				'patlog__procurement.entity__request.request_id' => $request_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__request_legal';
				$datato['where'] = array(
					'patlog__procurement.entity__request_legal.request_legal_id' => $this->input->post('request_legal_id')
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$request_legal_id = $R2->request_legal_id;
					$vendor_id = $R2->vendor_id;
					$vendor_name = $R2->vendor_name;
				}else{
					$request_legal_id = null;
					$vendor_id = null;
					$vendor_name = null;
				}
				
				unset($datato);
				$datato['table'] = 'patlog__procurement.data__process_proc';
				$datato['where'] = array(
					'patlog__procurement.data__process_proc.process_proc_id' => $this->input->post('process_proc_id')
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$process_proc_id = $R2->process_proc_id;
					$process_proc_name = $R2->process_proc_name;
					$process_proc_flag = $R2->process_proc_flag;
				}else{
					$process_proc_id = null;
					$process_proc_name = null;
					$process_proc_flag = null;
				}
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request_process';
				$datato['request_id'] = $R1->request_id;
				$datato['process_proc_id'] = $process_proc_id;
				$datato['vendor_id'] = $vendor_id;
				$datato['vendor_name'] = $vendor_name;
				$datato['request_process_proc_name'] = $process_proc_name;
				$datato['request_process_proc_date'] = $this->input->post('request_process_proc_date');
				$datato['request_process_proc_time'] = $this->input->post('request_process_proc_time');
				$datato['request_process_note'] = $this->input->post('request_process_attach_description');
				$datato['request_process_created_date'] = date('Y-m-d H:i:s');
				$request_process_id = $this->mod->insert($datato);
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request_process_attach';
				$datato['request_process_id'] = $request_process_id;			
				$datato['request_process_attach_description'] = $this->input->post('request_process_attach_description');
				$datato['request_process_attach_file'] = 'no.pdf';
				$datato['request_process_attach_created_date'] = date('Y-m-d H:i:s');			
				$request_process_attach_id = $this->mod->insert($datato);
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request_legal';
				$datato['vendor_id'] = $vendor_id;
				if($this->input->post('request_legal_user_name') != ''){
					$datato['request_legal_user_name'] = $this->input->post('request_legal_user_name');
				}
				if($this->input->post('request_legal_user_position') != ''){
					$datato['request_legal_user_position'] = $this->input->post('request_legal_user_position');
				}
				if($this->input->post('request_legal_total_estimate') != ''){
					$datato['request_legal_total_estimate'] = $this->input->post('request_legal_total_estimate');
				}
				$datato['field'] = 'request_legal_id';
				$datato['id'] = $request_legal_id;
				$this->mod->update($datato);
				
				if($process_proc_flag == 'yes' and $R1->vendor_id == null){
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__request';
					$datato['vendor_id'] = $vendor_id;
					$datato['request_vendor_name'] = $vendor_name;
					$datato['field'] = 'request_id';
					$datato['id'] = $R1->request_id;
					$this->mod->update($datato);
				}
				
				foreach($_FILES['request_process_attach_file'] as $key => $file){
					$data[$key] = $_FILES['request_process_attach_file'][$key];
				}
				$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
				$file_name = 'attachment-'.md5($request_process_attach_id).'.'.$ext;
				$path = './assets/mod__procurement/attach/request_process_attach/'.$file_name;
				$arr_type = array(
					'application/pdf'
				);
				if(in_array($data['type'], $arr_type)){
					move_uploaded_file($data['tmp_name'], $path);
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__request_process_attach';
					$datato['request_process_attach_file'] = $file_name;
					$datato['field'] = 'request_process_attach_id';
					$datato['id'] = $request_process_attach_id;
					$this->mod->update($datato);
				}
				
				$request_is_finish = $R1->request_is_finish;
				$request_log_name = $R1->request_proc_employee_in_name;
			}
			
			if($request_is_finish == 1){
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__request_log';
				$datato['where'] = array(
					'patlog__procurement.entity__request_log.request_id' => $request_id
				);
				$Q1 = $this->view->view_data($datato);
				$request_log_level = $Q1->num_rows() + 1;
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request_log';
				$datato['request_id'] = $request_id;
				$datato['request_log_level'] = $request_log_level;
				$datato['request_log_name'] = $request_log_name;
				$datato['request_log_status'] = 'Diedit';
				$datato['request_log_message'] = $this->input->post('request_process_attach_description');	
				$datato['request_log_created_date'] = date('Y-m-d H:i:s');				
				$request_log_id = $this->mod->insert($datato);
				
				$page = 'arsip_permintaan';
			}else{
				$page = 'proses_permintaan';
			}
			
			$this->session->set_flashdata('success', 'Data berhasil ditambah.');
			redirect(site_url().'module_procurement/admin/'.$page.'?view=process&request_id='.$this->uri->segment(5));
		}elseif($this->uri->segment(4) == 'delete'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$request_process_attach_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_process_attach';
			$datato['where'] = array(
				'patlog__procurement.entity__request_process_attach.request_process_attach_id' => $request_process_attach_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__request_process';
				$datato['where'] = array(
					'patlog__procurement.entity__request_process.request_process_id' => $R1->request_process_id
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$encrypt_id = $this->encrypt->encode($R2->request_id);
					$request_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
					$request_id_real = $R2->request_id;
				}else{
					$request_id = null;
					$request_id_real = null;
				}
				
				if(file_exists('./assets/mod__procurement/attach/request_process_attach/'.$R1->request_process_attach_file) and $R1->request_process_attach_file != 'no.pdf'){
					unlink('./assets/mod__procurement/attach/request_process_attach/'.$R1->request_process_attach_file);
				}
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request_process_attach';
				$datato['field'] = 'request_process_attach_id';
				$datato['id'] = $R1->request_process_attach_id;
				$this->mod->delete($datato);
				
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__request_process_attach';
				$datato['where'] = array(
					'patlog__procurement.entity__request_process_attach.request_process_id' => $R1->request_process_id
				);
				$Q2 = $this->view->view_data($datato);
				$total_process = $Q2->num_rows();
				if($total_process == 0){
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__request_process';
					$datato['field'] = 'request_process_id';
					$datato['id'] = $R1->request_process_id;
					$this->mod->delete($datato);
				}
			}else{
				$request_id = null;
				$request_id_real = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_process';
			$datato['where'] = array(
				'patlog__procurement.entity__request_process.request_id' => $request_id_real,
				'patlog__procurement.entity__request_process.process_proc_id' => 10
			);
			$Q1 = $this->view->view_data($datato);
			$total_winner = $Q1->num_rows();
			if($total_winner == 0){
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request';
				$datato['vendor_id'] = null;
				$datato['request_vendor_name'] = null;
				$datato['field'] = 'request_id';
				$datato['id'] = $request_id_real;
				$this->mod->update($datato);
			}
			
			$request_is_finish = 0;
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request';
			$datato['where'] = array(
				'patlog__procurement.entity__request.request_id' => $request_id_real
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$request_is_finish = $R1->request_is_finish;
			}
			
			if($request_is_finish == 1){
				$page = 'arsip_permintaan';
			}else{
				$page = 'proses_permintaan';
			}
			
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect(site_url().'module_procurement/admin/'.$page.'?view=process&request_id='.$request_id);
		}
	}
	
	public function request_undo()
	{
		$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(4));
		$request_id = $this->encrypt->decode($decrypt_id);
		
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__request';
		$datato['where'] = array(
			'patlog__procurement.entity__request.request_id' => $request_id
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();

			$request_proc_employee_in_name = $R1->request_proc_employee_in_name;
			$request_proc_date_start = $R1->request_proc_date_start;

			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__request';
			$datato['vendor_id'] = null;
			$datato['request_vendor_name'] = null;
			$datato['request_proc_employee_in_id'] = null;
			$datato['request_proc_employee_in_name'] = null;
			$datato['request_proc_date_start'] = null;
			$datato['request_status_information'] = 'Proses Penugasan ke PIC Procurement';
			$datato['field'] = 'request_id';
			$datato['id'] = $R1->request_id;
			$this->mod->update($datato);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_process';
			$datato['where'] = array(
				'patlog__procurement.entity__request_process.request_id' => $R1->request_id
			);
			$Q2 = $this->view->view_data($datato);
			foreach($Q2->result() as $R2){
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__request_process_attach';
				$datato['where'] = array(
					'patlog__procurement.entity__request_process_attach.request_process_id' => $R2->request_process_id
				);
				$Q3 = $this->view->view_data($datato);
				foreach($Q3->result() as $R3){
					if(file_exists('./assets/mod__procurement/attach/request_process_attach/'.$R3->request_process_attach_file) and $R3->request_process_attach_file != 'no.pdf'){
						unlink('./assets/mod__procurement/attach/request_process_attach/'.$R3->request_process_attach_file);
					}
					
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__request_process_attach';
					$datato['field'] = 'request_process_attach_id';
					$datato['id'] = $R3->request_process_attach_id;
					$this->mod->delete($datato);
				}
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request_process';
				$datato['field'] = 'request_process_id';
				$datato['id'] = $R2->request_process_id;
				$this->mod->delete($datato);
			}
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_log';
			$datato['where'] = array(
				'patlog__procurement.entity__request_log.request_id' => $R1->request_id
			);
			$Q2 = $this->view->view_data($datato);
			$request_log_level = $Q2->num_rows() + 1;
			
			$request_log_duration_seconds = null;
			if(!empty($request_proc_date_start) && $request_proc_date_start != '0000-00-00 00:00:00'){
				$__ts_start = strtotime($request_proc_date_start);
				if($__ts_start !== false){
					$request_log_duration_seconds = max(0, time() - $__ts_start);
				}
			}

			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__request_log';
			$datato['request_id'] = $R1->request_id;
			$datato['request_log_level'] = $request_log_level;
			$datato['request_log_name'] = $request_proc_employee_in_name;
			$datato['request_log_status'] = 'Back';
			$datato['request_log_message'] = '';
			$datato['request_log_created_date'] = date('Y-m-d H:i:s');
			$datato['request_log_duration_seconds'] = $request_log_duration_seconds;
			$this->mod->insert($datato);

			$this->send_email_undo($R1->request_id, $R1->request_process_employee_in_id, $request_proc_employee_in_name);
		}
		
		$this->session->set_flashdata('success', 'Data berhasil diubah.');
		redirect(site_url().'module_procurement/admin/proses_permintaan/');
	}
	
	public function request_cancel()
	{
		$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(4));
		$request_id = $this->encrypt->decode($decrypt_id);
		
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__request';
		$datato['where'] = array(
			'patlog__procurement.entity__request.request_id' => $request_id
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			unset($datato);
			$datato['table'] = 'patlog__hrms.entity__employee_in';
			$datato['where'] = array(
				'patlog__hrms.entity__employee_in.employee_in_id' => $R1->request_proc_employee_in_id
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
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__request';
			$datato['request_process_employee_in_id'] = null;
			$datato['request_process_employee_in_name'] = null;
			$datato['request_process_date_start'] = null;
			$datato['request_process_date_end'] = null;
			$datato['request_proc_employee_in_id'] = null;
			$datato['request_proc_employee_in_name'] = null;
			$datato['request_proc_date_start'] = null;
			$datato['request_approval_employee_in_id'] = null;
			$datato['request_approval_employee_in_name'] = null;
			$datato['request_status'] = 'reject';
			$datato['request_approval_level'] = null;
			$datato['request_status_information'] = 'Dibatalkan '.$employee_in_name;
			$datato['field'] = 'request_id';
			$datato['id'] = $R1->request_id;
			$this->mod->update($datato);
			
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__request_approval';				
			$datato['request_approval_status'] = null;
			$datato['request_approval_date'] = null;
			$datato['field'] = 'request_id';
			$datato['id'] = $R1->request_id;
			$this->mod->update($datato);
			
			$request_approval_employee_in_id = $R1->employee_in_id;
			$request_approval_employee_in_name = $employee_in_name;
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_log';
			$datato['where'] = array(
				'patlog__procurement.entity__request_log.request_id' => $R1->request_id
			);
			$Q2 = $this->view->view_data($datato);
			$request_log_level = $Q2->num_rows() + 1;
			
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__request_log';				
			$datato['request_id'] = $R1->request_id;
			$datato['request_log_level'] = $request_log_level;
			$datato['request_log_name'] = $request_approval_employee_in_name;
			$datato['request_log_status'] = 'Ditolak';
			$datato['request_log_message'] = $this->input->post('request_log_message');
			$datato['request_log_created_date'] = date('Y-m-d H:i:s');				
			$request_log_id = $this->mod->insert($datato);
			
			if(!empty($_FILES['request_log_file'])){
				unset($data);
				foreach($_FILES['request_log_file'] as $key => $file){
					$data[$key] = $_FILES['request_log_file'][$key];
				}
				$ext = pathinfo($data['name'], PATHINFO_EXTENSION);
				$file_name = 'request-log-file-'.md5($request_log_id).'.'.$ext;
				$path = './assets/mod__procurement/attach/request-log-file/'.$file_name;
				$arr_type = array(
					'application/pdf',
					'image/png',
					'image/jpg',
					'image/jpeg'
				);
				if($data['size'] > 0){
					if(in_array($data['type'], $arr_type)){
						move_uploaded_file($data['tmp_name'], $path);
						unset($datato);
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__request_log';
						$datato['request_log_file'] = $file_name;
						$datato['field'] = 'request_log_id';
						$datato['id'] = $request_log_id;
						$this->mod->update($datato);
					}
				}
			}
			
			$this->send_email_cancel($R1->request_id, $request_approval_employee_in_id, $request_approval_employee_in_name, $this->input->post('request_log_message'));
			
			# Notification
			unset($notif);
            $notif['title'] = 'Info Module Procurement';
            $notif['message'] = 'Pemintaan '.$R1->request_employee_in_name.' telah dibatalkan oleh '.$request_approval_employee_in_name.', yuk cek di aplikasi Anda.';
			$notif['user_device_employee_in_id'] = array(
				$R1->employee_in_id
			);
			$notif['screen'] = array(
				'ProsesProcurementView'
			);
            $notif['detail_id'] = $R1->request_id;
            $this->notification($notif);
		}
		
		$this->session->set_flashdata('success', 'Data berhasil diubah.');
		redirect(site_url().'module_procurement/admin/proses_permintaan/');
	}
	
	public function request_finish()
	{
		$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(4));
		$request_id = $this->encrypt->decode($decrypt_id);
		
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__request';
		$datato['where'] = array(
			'patlog__procurement.entity__request.request_id' => $request_id
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			unset($datato);
			$datato['table'] = 'patlog__hrms.entity__employee_in';
			$datato['where'] = array(
				'patlog__hrms.entity__employee_in.employee_in_id' => urldecode($this->input->post('request_pic_contract_id'))
			);
			$Q2 = $this->view->view_data($datato);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$request_pic_contract_id = $R2->employee_in_id;
				$request_pic_contract_name = $R2->employee_in_name;
			}else{
				$request_pic_contract_id = null;
				$request_pic_contract_name = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__config.entity__approval';
			$datato['where'] = array(
				'patlog__config.entity__approval.approval_id' => urldecode($this->input->post('request_pic_contract_approval_id'))
			);
			$Q2 = $this->view->view_data($datato);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$request_pic_contract_approval_id = $R2->approval_id;
				$request_pic_contract_approval_name = $R2->approval_name;
			}else{
				$request_pic_contract_approval_id = null;
				$request_pic_contract_approval_name = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__request';
			$datato['where'] = array(
				'patlog__contract.entity__request.request_id' => urldecode($this->input->post('request_pic_contract_request_id'))
			);
			$Q2 = $this->view->view_data($datato);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$request_pic_contract_request_id = $R2->request_id;
				$request_pic_contract_request_name = $R2->request_name;
			}else{
				$request_pic_contract_request_id = null;
				$request_pic_contract_request_name = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__request_description';
			$datato['where'] = array(
				'patlog__contract.entity__request_description.request_description_id' => urldecode($this->input->post('request_pic_contract_request_description_id'))
			);
			$Q2 = $this->view->view_data($datato);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$request_pic_contract_request_description_id = $R2->request_description_id;
				$request_pic_contract_request_description_name = $R2->request_description_name;
			}else{
				$request_pic_contract_request_description_id = null;
				$request_pic_contract_request_description_name = null;
			}
			
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__request';
			$datato['request_pic_contract_id'] = $request_pic_contract_id;
			$datato['request_pic_contract_name'] = $request_pic_contract_name;
			$datato['request_pic_contract_approval_id'] = $request_pic_contract_approval_id;
			$datato['request_pic_contract_approval_name'] = $request_pic_contract_approval_name;
			$datato['request_pic_contract_request_id'] = $request_pic_contract_request_id;
			$datato['request_pic_contract_request_name'] = $request_pic_contract_request_name;
			$datato['request_pic_contract_request_description_id'] = $request_pic_contract_request_description_id;
			$datato['request_pic_contract_request_description_name'] = $request_pic_contract_request_description_name;
			$datato['request_status'] = 'finish';
			$datato['request_status_information'] = 'Selesai';
			$datato['request_status_legal'] = urlencode($this->input->post('request_status_legal'));
			$datato['request_is_finish'] = 1;
			$datato['request_is_finish_date'] = date('Y-m-d H:i:s');
			$datato['field'] = 'request_id';
			$datato['id'] = $R1->request_id;
			$this->mod->update($datato);
			
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
			
			$arr_vendor_id = array();
			$arr_request_legal_id = array();
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_process';
			$datato['where'] = array(
				'patlog__procurement.entity__request_process.request_id' => $R1->request_id,
				'patlog__procurement.entity__request_process.process_proc_id' => $process_proc_id_win
			);
			$Q2 = $this->view->view_data($datato);
			foreach($Q2->result() as $R2){
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__request_legal';
				$datato['where'] = array(
					'patlog__procurement.entity__request_legal.request_id' => $R2->request_id,
					'patlog__procurement.entity__request_legal.vendor_id' => $R2->vendor_id
				);
				$Q3 = $this->view->view_data($datato);
				foreach($Q3->result() as $R3){
					$arr_vendor_id[] = $R3->vendor_id;
					$arr_request_legal_id[] = $R3->request_legal_id;
				
					unset($datato);
					$datato['database'] = 'patlog__procurement';
					$datato['table'] = 'entity__request_legal';
					if(urlencode($this->input->post('request_status_legal')) == 'yes'){
						$datato['request_legal_status'] = 'Sudah Kirim';
					}else{
						$datato['request_legal_status'] = 'Belum Kirim';
					}
					$datato['field'] = 'request_legal_id';
					$datato['id'] = $R3->request_legal_id;
					$this->mod->update($datato);
				}
			}
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_log';
			$datato['where'] = array(
				'patlog__procurement.entity__request_log.request_id' => $R1->request_id
			);
			$Q2 = $this->view->view_data($datato);
			$request_log_level = $Q2->num_rows() + 1;
			
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__request_log';
			$datato['request_id'] = $R1->request_id;
			$datato['request_log_level'] = $request_log_level;
			$datato['request_log_name'] = $R1->request_proc_employee_in_name;
			$datato['request_log_status'] = 'Finish';
			$datato['request_log_message'] = '';	
			$datato['request_log_created_date'] = date('Y-m-d H:i:s');				
			$request_log_id = $this->mod->insert($datato);
			
			if(urlencode($this->input->post('request_status_legal')) == 'yes'){
				for($i=0;$i<count($arr_vendor_id);$i++){
					$this->api_to_contract($R1->request_id, $arr_vendor_id[$i], $arr_request_legal_id[$i]);
				}
			}
			
			$this->send_email_finish($R1->request_id);
		}
		
		$this->session->set_flashdata('success', 'Data berhasil diubah.');
		redirect(site_url().'module_procurement/admin/proses_permintaan/');
	}
	
	public function request_submit()
	{
		$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(4));
		$request_legal_id = $this->encrypt->decode($decrypt_id);
		
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__request_legal';
		$datato['where'] = array(
			'patlog__procurement.entity__request_legal.request_legal_id' => $request_legal_id
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			unset($datato);
			$datato['table'] = 'patlog__hrms.entity__employee_in';
			$datato['where'] = array(
				'patlog__hrms.entity__employee_in.employee_in_id' => urldecode($this->input->post('request_pic_contract_id'))
			);
			$Q2 = $this->view->view_data($datato);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$request_pic_contract_id = $R2->employee_in_id;
				$request_pic_contract_name = $R2->employee_in_name;
			}else{
				$request_pic_contract_id = null;
				$request_pic_contract_name = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__config.entity__approval';
			$datato['where'] = array(
				'patlog__config.entity__approval.approval_id' => urldecode($this->input->post('request_pic_contract_approval_id'))
			);
			$Q2 = $this->view->view_data($datato);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$request_pic_contract_approval_id = $R2->approval_id;
				$request_pic_contract_approval_name = $R2->approval_name;
			}else{
				$request_pic_contract_approval_id = null;
				$request_pic_contract_approval_name = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__request';
			$datato['where'] = array(
				'patlog__contract.entity__request.request_id' => urldecode($this->input->post('request_pic_contract_request_id'))
			);
			$Q2 = $this->view->view_data($datato);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$request_pic_contract_request_id = $R2->request_id;
				$request_pic_contract_request_name = $R2->request_name;
			}else{
				$request_pic_contract_request_id = null;
				$request_pic_contract_request_name = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__request_description';
			$datato['where'] = array(
				'patlog__contract.entity__request_description.request_description_id' => urldecode($this->input->post('request_pic_contract_request_description_id'))
			);
			$Q2 = $this->view->view_data($datato);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$request_pic_contract_request_description_id = $R2->request_description_id;
				$request_pic_contract_request_description_name = $R2->request_description_name;
			}else{
				$request_pic_contract_request_description_id = null;
				$request_pic_contract_request_description_name = null;
			}
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request';
			$datato['where'] = array(
				'patlog__procurement.entity__request.request_id' => $R1->request_id
			);
			$Q2 = $this->view->view_data($datato);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$request_proc_employee_in_name = $R2->request_proc_employee_in_name;
			}else{
				$request_proc_employee_in_name = null;
			}
			
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__request';
			$datato['request_pic_contract_id'] = $request_pic_contract_id;
			$datato['request_pic_contract_name'] = $request_pic_contract_name;
			$datato['request_pic_contract_approval_id'] = $request_pic_contract_approval_id;
			$datato['request_pic_contract_approval_name'] = $request_pic_contract_approval_name;
			$datato['request_pic_contract_request_id'] = $request_pic_contract_request_id;
			$datato['request_pic_contract_request_name'] = $request_pic_contract_request_name;
			$datato['request_pic_contract_request_description_id'] = $request_pic_contract_request_description_id;
			$datato['request_pic_contract_request_description_name'] = $request_pic_contract_request_description_name;
			$datato['request_status_legal'] = 'yes';
			$datato['field'] = 'request_id';
			$datato['id'] = $R1->request_id;
			$this->mod->update($datato);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_log';
			$datato['where'] = array(
				'patlog__procurement.entity__request_log.request_id' => $R1->request_id
			);
			$Q2 = $this->view->view_data($datato);
			$request_log_level = $Q2->num_rows() + 1;
			
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__request_log';
			$datato['request_id'] = $R1->request_id;
			$datato['request_log_level'] = $request_log_level;
			$datato['request_log_name'] = $request_proc_employee_in_name;
			$datato['request_log_status'] = 'Finish';
			$datato['request_log_message'] = 'Submit - '.$R1->vendor_name;	
			$datato['request_log_created_date'] = date('Y-m-d H:i:s');				
			$request_log_id = $this->mod->insert($datato);
			
			if($R1->request_legal_status == 'Ditolak'){
				$this->api_to_contract_update($R1->request_id, $R1->vendor_id, $R1->request_legal_id);
			}else{
				$this->api_to_contract($R1->request_id, $R1->vendor_id, $R1->request_legal_id);
			}
		}
		
		$page = $this->input->post('page');
		
		$this->session->set_flashdata('success', 'Data berhasil diubah.');
		redirect(site_url().'module_procurement/admin/'.$page.'/');
	}
	
	public function request_archive()
	{
		if($this->uri->segment(4) == 'edit'){
			ini_set('memory_limit', '-1');
			ini_set('max_execution_time', 0);
			set_time_limit(0);
			
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$request_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request';
			$datato['where'] = array(
				'patlog__procurement.entity__request.request_id' => $request_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['table'] = 'patlog__hrms.entity__employee_in';
				$datato['where'] = array(
					'patlog__hrms.entity__employee_in.employee_in_id' => urldecode($this->input->post('request_pic_contract_id'))
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$request_pic_contract_id = $R2->employee_in_id;
					$request_pic_contract_name = $R2->employee_in_name;
				}else{
					$request_pic_contract_id = null;
					$request_pic_contract_name = null;
				}
				
				unset($datato);
				$datato['table'] = 'patlog__config.entity__approval';
				$datato['where'] = array(
					'patlog__config.entity__approval.approval_id' => urldecode($this->input->post('request_pic_contract_approval_id'))
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$request_pic_contract_approval_id = $R2->approval_id;
					$request_pic_contract_approval_name = $R2->approval_name;
				}else{
					$request_pic_contract_approval_id = null;
					$request_pic_contract_approval_name = null;
				}
				
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__request';
				$datato['where'] = array(
					'patlog__contract.entity__request.request_id' => urldecode($this->input->post('request_pic_contract_request_id'))
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$request_pic_contract_request_id = $R2->request_id;
					$request_pic_contract_request_name = $R2->request_name;
				}else{
					$request_pic_contract_request_id = null;
					$request_pic_contract_request_name = null;
				}
				
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__request_description';
				$datato['where'] = array(
					'patlog__contract.entity__request_description.request_description_id' => urldecode($this->input->post('request_pic_contract_request_description_id'))
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$request_pic_contract_request_description_id = $R2->request_description_id;
					$request_pic_contract_request_description_name = $R2->request_description_name;
				}else{
					$request_pic_contract_request_description_id = null;
					$request_pic_contract_request_description_name = null;
				}
				
				unset($datato);
				$datato['table'] = 'patlog__procurement.data__cost_category';		
				$datato['where'] = array(
					'patlog__procurement.data__cost_category.cost_category_id' => urldecode($this->input->post('cost_category_id'))
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$cost_category_id = $R2->cost_category_id;
					$request_cost_category_name = $R2->cost_category_name;		
				}else{
					$cost_category_id = null;
					$request_cost_category_name = null;
				}
				
				$request_source_id = null;
				$request_source_code = null;
				$request_source_code_description = null;
				if(urldecode($this->input->post('cost_category_id')) == 1){ 
					unset($datato);
					$datato['table'] = 'patlog__project.entity__cost_center';
					$datato['where'] = array(
						'patlog__project.entity__cost_center.cost_center_id' => urldecode($this->input->post('type_code_id'))
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						$request_source_id = $R2->cost_center_id;
						$request_source_code = $R2->cost_center_name;
						$request_source_code_description = $R2->cost_center_description;			
					}
				}elseif(urldecode($this->input->post('cost_category_id')) == 2){ 
					unset($datato);
					$datato['table'] = 'patlog__project.entity__project_code';
					$datato['where'] = array(
						'patlog__project.entity__project_code.project_code_id' => urldecode($this->input->post('type_code_id'))
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						$request_source_id = $R2->project_code_id;
						$request_source_code = $R2->project_code_name;
						$request_source_code_description = $R2->project_code_description;			
					}
				}
				
				$request_grandtotal_estimate = 0;
				$arr_request_det_qty = $this->input->post('request_det_qty');
				$arr_request_det_estimate_price = $this->input->post('request_det_estimate_price');
				for($i=0;$i<count($arr_request_det_qty);$i++){
					$request_grandtotal_estimate = $request_grandtotal_estimate + ($arr_request_det_qty[$i] * $arr_request_det_estimate_price[$i]);
				}
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request';
				$datato['request_category_name'] = urldecode($this->input->post('request_category_name'));
				$datato['request_type_name'] = $this->input->post('request_type_name');
				$datato['request_pic_contract_id'] = $request_pic_contract_id;
				$datato['request_pic_contract_name'] = $request_pic_contract_name;
				$datato['request_pic_contract_approval_id'] = $request_pic_contract_approval_id;
				$datato['request_pic_contract_approval_name'] = $request_pic_contract_approval_name;
				$datato['request_pic_contract_request_id'] = $request_pic_contract_request_id;
				$datato['request_pic_contract_request_name'] = $request_pic_contract_request_name;
				$datato['request_pic_contract_request_description_id'] = $request_pic_contract_request_description_id;
				$datato['request_pic_contract_request_description_name'] = $request_pic_contract_request_description_name;
				$datato['cost_category_id'] = $cost_category_id;
				$datato['request_cost_category_name'] = $request_cost_category_name;
				$datato['request_source_id'] = $request_source_id;
				$datato['request_source_code'] = $request_source_code;
				$datato['request_source_code_description'] = $request_source_code_description;
				$datato['request_used_date'] = $this->input->post('request_used_date');
				$datato['request_currency'] = urldecode($this->input->post('request_currency'));
				$datato['request_grandtotal_estimate'] = $request_grandtotal_estimate;
				$datato['request_note'] = $this->input->post('request_note');
				$datato['field'] = 'request_id';
				$datato['id'] = $R1->request_id;
				$this->mod->update($datato);
				
				$arr_request_document_id = $this->input->post('request_document_id');
				$__admin_audit = $this->_get_current_admin_for_audit();
				for($i=0;$i<count($arr_request_document_id);$i++){
					unset($datato);
					$datato['table'] = 'patlog__procurement.entity__request_document';
					$datato['where'] = array(
						'patlog__procurement.entity__request_document.request_document_id' => $arr_request_document_id[$i]
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						$request_document_mimes = $R2->request_document_mimes;
						$request_document_current_file = $R2->request_document_file;
					}else{
						$request_document_mimes = null;
						$request_document_current_file = 'no.pdf';
					}

					unset($data);
					foreach($_FILES['request_document_file'] as $key => $file){
						$data[$key] = $_FILES['request_document_file'][$key];
					}
					if($data['error'][$i] == 0){
						$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
						$file_name = 'document-file-'.md5($R1->request_id).'-'.md5($arr_request_document_id[$i]).'.'.$ext;
						$path = './assets/mod__procurement/attach/request-document-file/'.$file_name;
						$arr_type = explode(','.$request_document_mimes);
						if(in_array($data['type'][$i], $arr_type)){
							$this->_archive_request_document_version($arr_request_document_id[$i], $R1->request_id, $request_document_current_file, 'replace', $__admin_audit['id'], $__admin_audit['name'], 'admin', null);
							move_uploaded_file($data['tmp_name'][$i], $path);
							unset($datato);
							$datato['database'] = 'patlog__procurement';
							$datato['table'] = 'entity__request_document';
							$datato['request_document_file'] = $file_name;
							$datato['field'] = 'request_document_id';
							$datato['id'] = $arr_request_document_id[$i];
							$this->mod->update($datato);
						}
					}
				}
				
				foreach($_FILES['request_det_attachment'] as $key => $file){
					$data[$key] = $_FILES['request_det_attachment'][$key];
				}
				$arr_request_det_id = $this->input->post('request_det_id');
				$arr_request_det_item = $this->input->post('request_det_item');
				$arr_request_det_qty = $this->input->post('request_det_qty');
				$arr_request_det_unit = $this->input->post('request_det_unit');
				$arr_request_det_estimate_price = $this->input->post('request_det_estimate_price');
				$arr_request_det_note = $this->input->post('request_det_note');
				for($i=0;$i<count($arr_request_det_item);$i++){
					unset($datato);
					$datato['table'] = 'patlog__procurement.data__unit';		
					$datato['where'] = array(
						'patlog__procurement.data__unit.unit_id' => urldecode($arr_request_det_unit[$i])
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						$request_det_unit_id = $R2->unit_id;	
						$request_det_unit = $R2->unit_name;			
					}else{
						$request_det_unit_id = null;
						$request_det_unit = null;
					}
					
					if(isset($arr_request_det_id[$i])){
						unset($datato);	
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__request_det';
						$datato['request_det_item'] = $arr_request_det_item[$i];
						$datato['request_det_qty'] = $arr_request_det_qty[$i];
						$datato['unit_id'] = $request_det_unit_id;
						$datato['request_det_unit'] = $request_det_unit;
						$datato['request_det_estimate_price'] = $arr_request_det_estimate_price[$i];
						$datato['request_det_note'] = $arr_request_det_note[$i];
						$datato['field'] = 'request_det_id';
						$datato['id'] = $arr_request_det_id[$i];
						$this->mod->update($datato);
						
						$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
						$file_name = 'request_doc-'.md5($R1->request_id).'-'.md5($arr_request_det_id[$i]).'.'.$ext;
						$path = './assets/mod__procurement/attach/request_document/'.$file_name;
						$arr_type = array(
							'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
							'application/vnd.ms-excel',
							'application/pdf',
							'image/jpg',
							'image/jpeg',
							'image/png'
						);
						if(in_array($data['type'][$i], $arr_type)){
							move_uploaded_file($data['tmp_name'][$i], $path);
							unset($datato);
							$datato['database'] = 'patlog__procurement';
							$datato['table'] = 'entity__request_det';
							$datato['request_det_attachment'] = $file_name;
							$datato['field'] = 'request_det_id';
							$datato['id'] = $arr_request_det_id[$i];
							$this->mod->update($datato);
						}
					}else{
						unset($datato);	
						$datato['database'] = 'patlog__procurement';
						$datato['table'] = 'entity__request_det';
						$datato['request_id'] = $R1->request_id;
						$datato['request_det_item'] = $arr_request_det_item[$i];
						$datato['request_det_qty'] = $arr_request_det_qty[$i];
						$datato['unit_id'] = $request_det_unit_id;
						$datato['request_det_unit'] = $arr_request_det_unit[$i];
						$datato['request_det_estimate_price'] = $arr_request_det_estimate_price[$i];
						$datato['request_det_note'] = $arr_request_det_note[$i];
						$datato['request_det_attachment'] = 'no.pdf';
						$datato['request_det_created_date'] = date('Y-m-d h:i:s');				
						$request_det_id = $this->mod->insert($datato);
						
						$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
						$file_name = 'request_doc-'.md5($R1->request_id).'-'.md5($request_det_id).'.'.$ext;
						$path = './assets/mod__procurement/attach/request_document/'.$file_name;
						$arr_type = array(
							'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
							'application/vnd.ms-excel',
							'application/pdf',
							'image/jpg',
							'image/jpeg',
							'image/png'
						);
						if(in_array($data['type'][$i], $arr_type)){
							move_uploaded_file($data['tmp_name'][$i], $path);
							unset($datato);
							$datato['database'] = 'patlog__procurement';
							$datato['table'] = 'entity__request_det';
							$datato['request_det_attachment'] = $file_name;
							$datato['field'] = 'request_det_id';
							$datato['id'] = $request_det_id;
							$this->mod->update($datato);
						}
					}
				}
				
				$arr_request_attachment_id = $this->input->post('request_attachment_id');
				$arr_request_attachment_name = $this->input->post('request_attachment_name');
				$arr_request_attachment_file = $this->input->post('request_attachment_file');
				foreach($_FILES['request_attachment_file'] as $key => $file){
					$data[$key] = $_FILES['request_attachment_file'][$key];
				}
				for($i=0;$i<count($arr_request_attachment_name);$i++){
					if($arr_request_attachment_name[$i] != ''){
						if(isset($arr_request_attachment_id[$i])){
							unset($datato);
							$datato['database'] = 'patlog__procurement';
							$datato['table'] = 'entity__request_attachment';
							$datato['request_id'] = $R1->request_id;
							$datato['request_attachment_name'] = $arr_request_attachment_name[$i];
							$datato['field'] = 'request_attachment_id';
							$datato['id'] = $arr_request_attachment_id[$i];
							$this->mod->update($datato);
							
							$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
							$file_name = 'request-attachment-file-'.md5($R1->request_id).'-'.md5($arr_request_attachment_id[$i]).'.'.$ext;
							$path = './assets/mod__procurement/attach/request-attachment-file/'.$file_name;
							$arr_type = array(
								'application/pdf'
							);
							if(in_array($data['type'][$i], $arr_type)){
								move_uploaded_file($data['tmp_name'][$i], $path);
								unset($datato);
								$datato['database'] = 'patlog__procurement';
								$datato['table'] = 'entity__request_attachment';
								$datato['request_attachment_file'] = $file_name;
								$datato['field'] = 'request_attachment_id';
								$datato['id'] = $arr_request_attachment_id[$i];
								$this->mod->update($datato);
							}
						}else{
							unset($datato);
							$datato['database'] = 'patlog__procurement';
							$datato['table'] = 'entity__request_attachment';
							$datato['request_id'] = $R1->request_id;
							$datato['request_attachment_name'] = $arr_request_attachment_name[$i];
							$datato['request_attachment_file'] = 'no.pdf';
							$datato['request_attachment_insert'] = date('Y-m-d H:i:s');
							$request_attachment_id = $this->mod->insert($datato);
							
							$ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
							$file_name = 'request-attachment-file-'.md5($R1->request_id).'-'.md5($request_attachment_id).'.'.$ext;
							$path = './assets/mod__procurement/attach/request-attachment-file/'.$file_name;
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
								$datato['database'] = 'patlog__procurement';
								$datato['table'] = 'entity__request_attachment';
								$datato['request_attachment_file'] = $file_name;
								$datato['field'] = 'request_attachment_id';
								$datato['id'] = $request_attachment_id;
								$this->mod->update($datato);
							}
						}
					}
				}
				
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__request_log';
				$datato['where'] = array(
					'patlog__procurement.entity__request_log.request_id' => $R1->request_id
				);
				$Q2 = $this->view->view_data($datato);
				$request_log_level = $Q2->num_rows() + 1;
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request_log';
				$datato['request_id'] = $R1->request_id;
				$datato['request_log_level'] = $request_log_level;
				$datato['request_log_name'] = $R1->request_proc_employee_in_name;
				$datato['request_log_status'] = 'Diedit';
				$datato['request_log_message'] = '';	
				$datato['request_log_created_date'] = date('Y-m-d H:i:s');				
				$request_log_id = $this->mod->insert($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect(site_url().'module_procurement/admin/arsip_permintaan/');
		}
	}
	
	public function report()
	{
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 0);
		set_time_limit(0);
		
		$excel = new PHPExcel();
		$excel->setActiveSheetIndex(0);

		$table_columns = array(
			'Nomor PR',
			'Nama Pemohon',
			'Divisi',
			'Nama PIC (Legal)',
			'Nama Approval (Legal)',
			'Jenis Permintaan (Legal)',
			'Deskripsi Permintaan (Legal)',
			'Metode',
			'Jenis Permintaan',
			'Tipe Kode',
			'Kode Proyek/Cost Center',
			'Deskripsi',
			'Due Date',
			'Mata Uang',
			'Biaya',
			'Catatan/Deskripsi Pekerjaan',
			'Nama PIC Loket',
			'Tanggal Proses PIC Loket',
			'Nama PIC Pengadaan',
			'Tanggal Proses PIC Pengadaan',
			'Status',
			'Informasi',
			'Posisi'
		);
		if(urldecode($this->input->post('export_detail')) == 'Detail Biaya'){
			$table_columns[] = 'Nama Barang/Jasa';
			$table_columns[] = 'Jumlah Barang';
			$table_columns[] = 'Harga Satuan';
			$table_columns[] = 'Unit';
			$table_columns[] = 'Spesifikasi';
		}elseif(urldecode($this->input->post('export_detail')) == 'Detail Vendor'){
			$table_columns[] = 'Nomor SPPK (Legal)';
			$table_columns[] = 'Nama Vendor';
			$table_columns[] = 'Penandatangan';
			$table_columns[] = 'Jabatan';
			$table_columns[] = 'Tanggal Mulai';
			$table_columns[] = 'Tanggal Selesai';
			$table_columns[] = 'Estimasi Biaya';
			$table_columns[] = 'Status Legal';
		}elseif(urldecode($this->input->post('export_detail')) == 'Detail Proses Pengadaan'){
			$table_columns[] = 'Nama Vendor';
			$table_columns[] = 'Nama Proses';
			$table_columns[] = 'Tanggal';
			$table_columns[] = 'Jam';
			$table_columns[] = 'Keterangan';
		}elseif(urldecode($this->input->post('export_detail')) == 'Detail Log Aktivitas'){
			$table_columns[] = 'Nama Aktor';
			$table_columns[] = 'Status';
			$table_columns[] = 'Keterangan';
			$table_columns[] = 'Waktu';
		}
		$column = 0;
		foreach($table_columns as $field){
			$excel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}
		
		$excel_row = 2;
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__request';
		if(urldecode($this->input->post('export_detail')) == 'Detail Biaya'){
			$datato['table_join'] = array(
				'patlog__procurement.entity__request_det'
			);
			$datato['table_join_on'] = array(
				'patlog__procurement.entity__request'
			);
			$datato['join_id'] = array(
				'request_id'
			);
			$datato['join_type'] = array(
				'inner'
			);
		}elseif(urldecode($this->input->post('export_detail')) == 'Detail Vendor'){
			$datato['table_join'] = array(
				'patlog__procurement.entity__request_legal'
			);
			$datato['table_join_on'] = array(
				'patlog__procurement.entity__request'
			);
			$datato['join_id'] = array(
				'request_id'
			);
			$datato['join_type'] = array(
				'inner'
			);
		}elseif(urldecode($this->input->post('export_detail')) == 'Detail Proses Pengadaan'){
			$datato['table_join'] = array(
				'patlog__procurement.entity__request_process'
			);
			$datato['table_join_on'] = array(
				'patlog__procurement.entity__request'
			);
			$datato['join_id'] = array(
				'request_id'
			);
			$datato['join_type'] = array(
				'inner'
			);
		}elseif(urldecode($this->input->post('export_detail')) == 'Detail Log Aktivitas'){
			$datato['table_join'] = array(
				'patlog__procurement.entity__request_log'
			);
			$datato['table_join_on'] = array(
				'patlog__procurement.entity__request'
			);
			$datato['join_id'] = array(
				'request_id'
			);
			$datato['join_type'] = array(
				'inner'
			);
		}
		if(urldecode($this->input->post('export_type')) == 'Process'){
			$datato['where'] = array(
				'patlog__procurement.entity__request.request_is_finish' => 0,
				'patlog__procurement.entity__request.request_is_delete' => 0,
				'patlog__procurement.entity__request.request_used_date >= ' => $this->input->post('export_date_start'),
				'patlog__procurement.entity__request.request_used_date <= ' => $this->input->post('export_date_end'),
			);
		}elseif(urldecode($this->input->post('export_type')) == 'Archive'){
			$datato['where'] = array(
				'patlog__procurement.entity__request.request_is_finish' => 1,
				'patlog__procurement.entity__request.request_is_delete' => 0,
				'patlog__procurement.entity__request.request_used_date >= ' => $this->input->post('export_date_start'),
				'patlog__procurement.entity__request.request_used_date <= ' => $this->input->post('export_date_end'),
			);
		}
		$Q1 = $this->view->view_data($datato);
		foreach($Q1->result() as $R1){
			$index = 0;
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_code);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_employee_in_name);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_division_name);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_pic_contract_name);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_pic_contract_approval_name);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_pic_contract_request_name);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_pic_contract_request_description_name);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_category_name);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_type_name);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_cost_category_name);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_source_code);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_source_code_description);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_used_date);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_currency);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_grandtotal_estimate);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_note);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_process_employee_in_name);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_process_date_start);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_proc_employee_in_name);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_proc_date_start);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, ucwords(str_replace('_',' ',$R1->request_status)));
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_status_information);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, urldecode($this->input->post('export_type')));
			if(urldecode($this->input->post('export_detail')) == 'Detail Biaya'){
				$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_det_item);
				$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_det_qty);
				$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_det_estimate_price);
				$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_det_unit);
				$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_det_note);
			}elseif(urldecode($this->input->post('export_detail')) == 'Detail Vendor'){
				$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->contract_no);
				$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->vendor_name);
				$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_legal_user_name);
				$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_legal_user_position);
				$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_legal_date_start);
				$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_legal_date_end);
				$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_legal_total_estimate);
				$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_legal_status);
			}elseif(urldecode($this->input->post('export_detail')) == 'Detail Proses Pengadaan'){
				$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->vendor_name);
				$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_process_proc_name);
				$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_process_proc_date);
				$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_process_proc_time);
				$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_process_note);
			}elseif(urldecode($this->input->post('export_detail')) == 'Detail Log Aktivitas'){
				$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_log_name);
				$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_log_status);
				$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_log_message);
				$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->request_log_created_date);
			}
			$excel_row++;
		}
		
		$type = urldecode($this->input->post('export_type'));
		$detail = urldecode($this->input->post('export_detail'));
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Laporan Permintaan '.$type.' '.$detail.' '.date('Y-m-d').'.xlsx"');
		header('Cache-Control: max-age=0');
		$write = IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}
	
	public function data_category()
	{
		if($this->uri->segment(4) == 'add'){
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'data__category';
			$datato['category_name'] = $this->input->post('category_name');
			$datato['category_insert'] = date('Y-m-d H:i:s');
			$category_id = $this->mod->insert($datato);
			
			$this->session->set_flashdata('success', 'Data berhasil ditambah.');
			redirect(site_url().'module_procurement/admin/data_kategori/');
		}elseif($this->uri->segment(4) == 'edit'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$category_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__category';
			$datato['where'] = array(
				'patlog__procurement.data__category.category_id' => $category_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__category';
				$datato['category_name'] = $this->input->post('category_name');
				$datato['field'] = 'category_id';
				$datato['id'] = $R1->category_id;
				$this->mod->update($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect(site_url().'module_procurement/admin/data_kategori/');
		}elseif($this->uri->segment(4) == 'delete'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$category_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__category';
			$datato['where'] = array(
				'patlog__procurement.data__category.category_id' => $category_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__category';
				$datato['field'] = 'category_id';
				$datato['id'] = $R1->category_id;
				$this->mod->delete($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect(site_url().'module_procurement/admin/data_kategori/');
		}
	}
	
	public function data_document()
	{
		if($this->uri->segment(4) == 'add'){
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'data__document';
			$datato['document_order'] = $this->input->post('document_order');
			$datato['document_name'] = $this->input->post('document_name');
			$datato['document_mimes'] = $this->input->post('document_mimes');
			$datato['document_mandatory'] = urldecode($this->input->post('document_mandatory'));
			$datato['document_insert'] = date('Y-m-d H:i:s');
			$this->mod->insert($datato);
			
			$this->session->set_flashdata('success', 'Data berhasil ditambah.');
			redirect(site_url().'module_procurement/admin/data_dokumen/');
		}elseif($this->uri->segment(4) == 'edit'){
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__document';
			$datato['where'] = array(
				'patlog__procurement.data__document.document_id' => $this->uri->segment(5)
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__document';
				$datato['document_order'] = $this->input->post('document_order');
				$datato['document_name'] = $this->input->post('document_name');
				$datato['document_mimes'] = $this->input->post('document_mimes');
				$datato['document_mandatory'] = urldecode($this->input->post('document_mandatory'));
				$datato['field'] = 'document_id';
				$datato['id'] = $R1->document_id;
				$this->mod->update($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect(site_url().'module_procurement/admin/data_dokumen/');
		}elseif($this->uri->segment(4) == 'delete'){
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__document';
			$datato['where'] = array(
				'patlog__procurement.data__document.document_id' => $this->uri->segment(5)
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__document';
				$datato['field'] = 'document_id';
				$datato['id'] = $R1->document_id;
				$this->mod->delete($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect(site_url().'module_procurement/admin/data_dokumen/');
		}
	}
	
	public function data_type()
	{
		if($this->uri->segment(4) == 'add'){
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'data__type';
			$datato['type_name'] = $this->input->post('type_name');
			$datato['type_category'] = $this->input->post('type_category');
			$datato['type_insert'] = date('Y-m-d H:i:s');
			$type_id = $this->mod->insert($datato);
			
			$this->session->set_flashdata('success', 'Data berhasil ditambah.');
			redirect(site_url().'module_procurement/admin/data_tipe/');
		}elseif($this->uri->segment(4) == 'edit'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$type_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__type';
			$datato['where'] = array(
				'patlog__procurement.data__type.type_id' => $type_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__type';
				$datato['type_name'] = $this->input->post('type_name');
				$datato['type_category'] = $this->input->post('type_category');
				$datato['field'] = 'type_id';
				$datato['id'] = $R1->type_id;
				$this->mod->update($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect(site_url().'module_procurement/admin/data_tipe/');
		}elseif($this->uri->segment(4) == 'delete'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$type_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__type';
			$datato['where'] = array(
				'patlog__procurement.data__type.type_id' => $type_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__type';
				$datato['field'] = 'type_id';
				$datato['id'] = $R1->type_id;
				$this->mod->delete($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect(site_url().'module_procurement/admin/data_tipe/');
		}
	}
	
	public function data_unit()
	{
		if($this->uri->segment(4) == 'add'){
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'data__unit';
			$datato['unit_name'] = $this->input->post('unit_name');
			$datato['unit_insert'] = date('Y-m-d H:i:s');
			$unit_id = $this->mod->insert($datato);
			
			$this->session->set_flashdata('success', 'Data berhasil ditambah.');
			redirect(site_url().'module_procurement/admin/data_unit/');
		}elseif($this->uri->segment(4) == 'edit'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$unit_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__unit';
			$datato['where'] = array(
				'patlog__procurement.data__unit.unit_id' => $unit_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__unit';
				$datato['unit_name'] = $this->input->post('unit_name');
				$datato['field'] = 'unit_id';
				$datato['id'] = $R1->unit_id;
				$this->mod->update($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect(site_url().'module_procurement/admin/data_unit/');
		}elseif($this->uri->segment(4) == 'delete'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$unit_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__unit';
			$datato['where'] = array(
				'patlog__procurement.data__unit.unit_id' => $unit_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__unit';
				$datato['field'] = 'unit_id';
				$datato['id'] = $R1->unit_id;
				$this->mod->delete($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect(site_url().'module_procurement/admin/data_unit/');
		}
	}
	
	public function data_item()
	{
		if($this->uri->segment(4) == 'add'){
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'data__item';
			$datato['item_category_id'] = urldecode($this->input->post('item_category_id'));
			$datato['type_id'] = urldecode($this->input->post('type_id'));
			$datato['item_name'] = $this->input->post('item_name');
			$datato['item_merk'] = $this->input->post('item_merk');
			$datato['item_unit'] = $this->input->post('item_unit');
			$datato['item_price'] = $this->input->post('item_price');
			$datato['item_insert'] = date('Y-m-d H:i:s');
			$item_id = $this->mod->insert($datato);
			
			$this->session->set_flashdata('success', 'Data berhasil ditambah.');
			redirect(site_url().'module_procurement/admin/data_item/');
		}elseif($this->uri->segment(4) == 'edit'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$item_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__item';
			$datato['where'] = array(
				'patlog__procurement.data__item.item_id' => $item_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__item';
				$datato['item_category_id'] = urldecode($this->input->post('item_category_id'));
				$datato['type_id']	= urldecode($this->input->post('type_id'));
				$datato['item_name'] = $this->input->post('item_name');
				$datato['item_merk'] = $this->input->post('item_merk');
				$datato['item_unit'] = $this->input->post('item_unit');
				$datato['item_price'] = $this->input->post('item_price');
				$datato['field'] = 'item_id';
				$datato['id'] = $R1->item_id;
				$this->mod->update($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect(site_url().'module_procurement/admin/data_item/');
		}elseif($this->uri->segment(4) == 'delete'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$item_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__item';
			$datato['where'] = array(
				'patlog__procurement.data__item.item_id' => $item_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__item';
				$datato['field'] = 'item_id';
				$datato['id'] = $R1->item_id;
				$this->mod->delete($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect(site_url().'module_procurement/admin/data_item/');
		}
	}
	
	public function data_item_import()
	{
		$rand = $this->rand_string(10);
		$file_name = 'import_vendor-'.date('Y-m-d').'-'.$rand.'.xlsx';
		$config['upload_path'] = './assets/mod__procurement/attach/temporary/';
		$config['file_name'] = $file_name;
		$config['allowed_types'] = 'xlsx|csv|xls';
		$config['overwrite'] = TRUE;
		$this->upload->initialize($config);
		if($this->upload->do_upload('import_excel')){
			$inputFileName = './assets/mod__procurement/attach/temporary/'.$file_name;
		}else{
			$this->session->set_flashdata('danger', $this->upload->display_errors());
			redirect(site_url().'module_procurement/admin/data_item?view=import');
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
			
			$item_category_id  = $this->input->post('item_category_id');
			$type_id  = $this->input->post('type_id');	
			
			if(urldecode($this->input->post('rule_action')) == 'add'){						
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__item';
				$datato['item_category_id'] = $item_category_id;
				$datato['type_id'] = $type_id;
				$datato['item_name'] = $rowData[0][1];
				$datato['item_merk'] = $rowData[0][2];
				$datato['item_unit'] = $rowData[0][3];
				$datato['item_price'] = $rowData[0][4];
				$datato['item_insert'] = date('Y-m-d H:i:s');
				$item_id = $this->mod->insert($datato);
			}
		}
		
		$this->session->set_flashdata('success', 'Data berhasil diubah.');
		redirect(site_url().'module_procurement/admin/data_item/');
	}
	
	public function data_item_export()
	{
		$excel = new PHPExcel();
		$excel->setActiveSheetIndex(0);
		$table_columns = array(
			'Item',
			'Spesifikasi Merk / Type',
			'Harga',
			'ID Kategori',
			'Nama Kategori'
		);
		$column = 0;
		foreach($table_columns as $field){
			$excel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}
		$excel_row = 2;
		unset($datato);
		$datato['table'] = 'patlog__procurement.data__item';
		$datato['table_join'] = array(
			'patlog__procurement.data__item_category'
		);
		$datato['table_join_on'] = array(
			'patlog__procurement.data__item'
		);
		$datato['join_id'] = array(
			'item_category_id'
		);
		$datato['join_type'] = array(
			'inner'
		);
		$Q1 = $this->view->view_data($datato);
		foreach($Q1->result() as $R1){
			$index = 0;
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->item_name);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->item_merk);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->item_price);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->item_category_id);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->item_category_name);			
			$excel_row++;
		}
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Ekspor Data Item.xlsx"');
		header('Cache-Control: max-age=0');
		$write = IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}
	
	public function data_process_proc()
	{
		if($this->uri->segment(4) == 'add'){
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'data__process_proc';
			$datato['process_proc_name'] = $this->input->post('process_proc_name');
			$datato['process_proc_flag'] = urldecode($this->input->post('process_proc_flag'));
			$datato['process_proc_insert'] = date('Y-m-d H:i:s');
			$process_proc_id = $this->mod->insert($datato);
			
			$this->session->set_flashdata('success', 'Data berhasil ditambah.');
			redirect(site_url().'module_procurement/admin/data_proses_pengadaan/');
		}elseif($this->uri->segment(4) == 'edit'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$process_proc_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__process_proc';
			$datato['where'] = array(
				'patlog__procurement.data__process_proc.process_proc_id' => $process_proc_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__process_proc';
				$datato['process_proc_name'] = $this->input->post('process_proc_name');
				$datato['process_proc_flag'] = urldecode($this->input->post('process_proc_flag'));
				$datato['field'] = 'process_proc_id';
				$datato['id'] = $R1->process_proc_id;
				$this->mod->update($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect(site_url().'module_procurement/admin/data_proses_pengadaan/');
		}elseif($this->uri->segment(4) == 'delete'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$process_proc_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__process_proc';
			$datato['where'] = array(
				'patlog__procurement.data__process_proc.process_proc_id' => $process_proc_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__process_proc';
				$datato['field'] = 'process_proc_id';
				$datato['id'] = $R1->process_proc_id;
				$this->mod->delete($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect(site_url().'module_procurement/admin/data_proses_pengadaan/');
		}
	}
	
	public function data_legal()
	{
		if($this->uri->segment(4) == 'add'){
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'data__legal';
			$datato['legal_entity_name'] = $this->input->post('legal_entity_name');
			$datato['legal_entity_insert'] = date('Y-m-d H:i:s');
			$legal_entity_id = $this->mod->insert($datato);
			
			$this->session->set_flashdata('success', 'Data berhasil ditambah.');
			redirect(site_url().'module_procurement/admin/data_badan_hukum/');
		}elseif($this->uri->segment(4) == 'edit'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$legal_entity_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__legal';
			$datato['where'] = array(
				'patlog__procurement.data__legal.legal_entity_id' => $legal_entity_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__legal';
				$datato['legal_entity_name'] = $this->input->post('legal_entity_name');
				$datato['field'] = 'legal_entity_id';
				$datato['id'] = $R1->legal_entity_id;
				$this->mod->update($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect(site_url().'module_procurement/admin/data_badan_hukum/');
		}elseif($this->uri->segment(4) == 'delete'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$legal_entity_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__legal';
			$datato['where'] = array(
				'patlog__procurement.data__legal.legal_entity_id' => $legal_entity_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__legal';
				$datato['field'] = 'legal_entity_id';
				$datato['id'] = $R1->legal_entity_id;
				$this->mod->delete($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect(site_url().'module_procurement/admin/data_badan_hukum/');
		}
	}
	
	public function data_kbli()
	{
		if($this->uri->segment(4) == 'add'){
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'data__kbli';
			$datato['kbli_code'] = $this->input->post('kbli_code');
			$datato['kbli_name'] = $this->input->post('kbli_name');
			$datato['kbli_description'] = $this->input->post('kbli_description');
			$datato['kbli_insert'] = date('Y-m-d H:i:s');
			$kbli_id = $this->mod->insert($datato);
			
			$this->session->set_flashdata('success', 'Data berhasil ditambah.');
			redirect(site_url().'module_procurement/admin/data_kbli/');
		}elseif($this->uri->segment(4) == 'edit'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$kbli_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__kbli';
			$datato['where'] = array(
				'patlog__procurement.data__kbli.kbli_id' => $kbli_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__kbli';
				$datato['kbli_code'] = $this->input->post('kbli_code');
				$datato['kbli_name'] = $this->input->post('kbli_name');
				$datato['kbli_description'] = $this->input->post('kbli_description');
				$datato['field'] = 'kbli_id';
				$datato['id'] = $R1->kbli_id;
				$this->mod->update($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect(site_url().'module_procurement/admin/data_kbli/');
		}elseif($this->uri->segment(4) == 'delete'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$kbli_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__kbli';
			$datato['where'] = array(
				'patlog__procurement.data__kbli.kbli_id' => $kbli_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__kbli';
				$datato['field'] = 'kbli_id';
				$datato['id'] = $R1->kbli_id;
				$this->mod->delete($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect(site_url().'module_procurement/admin/data_kbli/');
		}
	}
	
	public function data_kbli_import()
	{
		$rand = $this->rand_string(10);
		$file_name = 'import-kbli-'.date('Y-m-d').'-'.$rand.'.xlsx';
		$config['upload_path'] = './assets/mod__procurement/attach/temporary/';
		$config['file_name'] = $file_name;
		$config['allowed_types'] = 'xlsx|csv|xls';
		$config['overwrite'] = TRUE;
		$this->upload->initialize($config);
		if($this->upload->do_upload('import_excel')){
			$inputFileName = './assets/mod__procurement/attach/temporary/'.$file_name;
		}else{
			$this->session->set_flashdata('danger', $this->upload->display_errors());
			redirect(site_url().'module_procurement/admin/data_kbli?view=import');
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
			
			if(urldecode($this->input->post('rule_action')) == 'add'){				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__kbli';
				$datato['kbli_code'] = $rowData[0][0];
				$datato['kbli_name'] = $rowData[0][1];
				$datato['kbli_description'] = $rowData[0][2];
				$datato['kbli_insert'] = date('Y-m-d H:i:s');
				$kbli_id = $this->mod->insert($datato);
			}elseif(urldecode($this->input->post('rule_action')) == 'edit'){
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__kbli';
				$datato['kbli_name'] = $rowData[0][1];
				$datato['kbli_description'] = $rowData[0][2];
				$datato['field'] = 'kbli_code';
				$datato['id'] = $rowData[0][0];
				$this->mod->update($datato);
			}elseif(urldecode($this->input->post('rule_action')) == 'delete'){
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__kbli';
				$datato['field'] = 'kbli_code';
				$datato['id'] = $rowData[0][0];
				$this->mod->delete($datato);
			}
		}
		
		$this->session->set_flashdata('success', 'Data berhasil diubah.');
		redirect(site_url().'module_procurement/admin/data_kbli/');
	}
	
	public function data_kbli_export()
	{
		$excel = new PHPExcel();
		$excel->setActiveSheetIndex(0);
		$table_columns = array(
			'Kode KBLI',
			'Nama KBLI',
			'Deskripsi KBLI'
		);
		$column = 0;
		foreach($table_columns as $field){
			$excel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}
		$excel_row = 2;
		unset($datato);
		$datato['table'] = 'patlog__procurement.data__kbli';
		$Q1 = $this->view->view_data($datato);
		foreach($Q1->result() as $R1){
			$index = 0;
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->kbli_code);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->kbli_name);
			$excel->getActiveSheet()->setCellValueByColumnAndRow($index++, $excel_row, $R1->kbli_description);			
			$excel_row++;
		}
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Ekspor Data KBLI.xlsx"');
		header('Cache-Control: max-age=0');
		$write = IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}
	
	public function data_kbli_legality()
	{
		if($this->uri->segment(4) == 'add'){
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'data__kbli_legality';
			$datato['kbli_legality_name'] = $this->input->post('kbli_legality_name');
			$datato['kbli_legality_insert'] = date('Y-m-d H:i:s');
			$kbli_legality_id = $this->mod->insert($datato);
			
			$this->session->set_flashdata('success', 'Data berhasil ditambah.');
			redirect(site_url().'module_procurement/admin/data_legalitas_kbli/');
		}elseif($this->uri->segment(4) == 'edit'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$kbli_legality_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__kbli_legality';
			$datato['where'] = array(
				'patlog__procurement.data__kbli_legality.kbli_legality_id' => $kbli_legality_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__kbli_legality';
				$datato['kbli_legality_name'] = $this->input->post('kbli_legality_name');
				$datato['field'] = 'kbli_legality_id';
				$datato['id'] = $R1->kbli_legality_id;
				$this->mod->update($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect(site_url().'module_procurement/admin/data_legalitas_kbli/');
		}elseif($this->uri->segment(4) == 'delete'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$kbli_legality_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__kbli_legality';
			$datato['where'] = array(
				'patlog__procurement.data__kbli_legality.kbli_legality_id' => $kbli_legality_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__kbli_legality';
				$datato['field'] = 'kbli_legality_id';
				$datato['id'] = $R1->kbli_legality_id;
				$this->mod->delete($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect(site_url().'module_procurement/admin/data_legalitas_kbli/');
		}
	}
	
	public function data_csms()
	{
		if($this->uri->segment(4) == 'add'){
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'data__csms';
			$datato['csms_name'] = $this->input->post('csms_name');
			$datato['csms_insert'] = date('Y-m-d H:i:s');
			$csms_id = $this->mod->insert($datato);
			
			$this->session->set_flashdata('success', 'Data berhasil ditambah.');
			redirect(site_url().'module_procurement/admin/data_csms/');
		}elseif($this->uri->segment(4) == 'edit'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$csms_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__csms';
			$datato['where'] = array(
				'patlog__procurement.data__csms.csms_id' => $csms_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__csms';
				$datato['csms_name'] = $this->input->post('csms_name');
				$datato['field'] = 'csms_id';
				$datato['id'] = $R1->csms_id;
				$this->mod->update($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect(site_url().'module_procurement/admin/data_csms/');
		}elseif($this->uri->segment(4) == 'delete'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$csms_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__csms';
			$datato['where'] = array(
				'patlog__procurement.data__csms.csms_id' => $csms_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__csms';
				$datato['field'] = 'csms_id';
				$datato['id'] = $R1->csms_id;
				$this->mod->delete($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect(site_url().'module_procurement/admin/data_csms/');
		}
	}
	
	public function data_sla()
	{
		if($this->uri->segment(4) == 'add'){
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'data__sla';
			$datato['sla_code'] = $this->input->post('sla_code');
			$datato['sla_day'] = $this->input->post('sla_day');
			$datato['sla_insert'] = date('Y-m-d H:i:s');
			$sla_id = $this->mod->insert($datato);
			
			$this->session->set_flashdata('success', 'Data berhasil ditambah.');
			redirect(site_url().'module_procurement/admin/data_sla/');
		}elseif($this->uri->segment(4) == 'edit'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$sla_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__sla';
			$datato['where'] = array(
				'patlog__procurement.data__sla.sla_id' => $sla_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__sla';
				$datato['sla_code'] = $this->input->post('sla_code');
				$datato['sla_day'] = $this->input->post('sla_day');
				$datato['field'] = 'sla_id';
				$datato['id'] = $R1->sla_id;
				$this->mod->update($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect(site_url().'module_procurement/admin/data_sla/');
		}elseif($this->uri->segment(4) == 'delete'){
			$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(5));
			$sla_id = $this->encrypt->decode($decrypt_id);
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.data__sla';
			$datato['where'] = array(
				'patlog__procurement.data__sla.sla_id' => $sla_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'data__sla';
				$datato['field'] = 'sla_id';
				$datato['id'] = $R1->sla_id;
				$this->mod->delete($datato);
			}
			
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect(site_url().'module_procurement/admin/data_sla/');
		}
	}
	
	public function data_cog()
	{
		$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(4));
		$cog_id = $this->encrypt->decode($decrypt_id);
		
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__cog';
		$datato['where'] = array(
			'patlog__procurement.entity__cog.cog_id' => $cog_id
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__cog';
			$datato['cog_division_id'] = urldecode($this->input->post('cog_division_id'));
			$datato['cog_functions_id'] = urldecode($this->input->post('cog_functions_id'));
			$datato['cog_mapping_employee_in_id'] = urldecode($this->input->post('cog_mapping_employee_in_id'));
			$datato['cog_running_text'] = $this->input->post('cog_running_text');
			$datato['field'] = 'cog_id';
			$datato['id'] = $R1->cog_id;
			$this->mod->update($datato);
		}
		
		$this->session->set_flashdata('success', 'Data berhasil diubah.');
		redirect(site_url().'module_procurement/admin/data_konfigurasi/');
	}
	
	public function print_request($id)
	{
		$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(4));
		$request_id = $this->encrypt->decode($decrypt_id);
		
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__request';
		$datato['where'] = array(
			'patlog__procurement.entity__request.request_id' => $request_id
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			$this->load->library('pdf');
			
			//A4 width : 219mm
			//default margin : 10mm each side
			//writable horizontal : 219-(10*2)=189mm
			
			$pdf = new FPDF('L','mm','A4');
			$pdf->SetMargins(15,10,15,10);	
			$pdf->AddPage();
			
			$pdf->Image(base_url('assets/public/logo.png'),10,3,40,0,'PNG');
			$pdf->Image(base_url('assets/mod__procurement/attach/request-qr/'.$R1->request_qr),270,3,20,0,'PNG');
			$pdf->Ln(14);
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln();
			
			$pdf->Cell(270,5,'FORMULIR PERMINTAAN BARANG/JASA',0,1,'C');
			$pdf->Cell(270,5,$R1->request_code,0,1,'C');
			$pdf->Ln();
			
			$pdf->SetFont('Arial','B',8);	
			$pdf->Cell(80,5,'Informasi Pemesanan',0,1);				
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(40,5,'Nama Lengkap ',0,0,'L');
			$pdf->Cell(80,5,': '.$R1->request_employee_in_name,0,0);
			$pdf->Cell(40,5,'Jenis Permintaan',0,0,'L');
			$pdf->Cell(80,5,': '.$R1->request_type_name,0,1);
			
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(40,5,'Divisi',0,0,'L');
			$pdf->Cell(80,5,': '.$R1->request_division_name,0,0);
			
			$pdf->Ln(5);
			
			$pdf->SetFont('Arial','B',8);	
			$pdf->Cell(80,5,'Atas Kebutuhan',0,1);				
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(40,5,'Project/ Cost Center ',0,0,'L');
			$pdf->Cell(80,5,': '.$R1->request_source_code,0,0);
			$pdf->Cell(40,5,'Digunakan tanggal  ',0,0,'L');
			$pdf->Cell(80,5,': '.$R1->request_used_date,0,1);
			
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(40,5,'Deskripsi',0,0,'L');
			$pdf->Cell(120,5,': '.$R1->request_source_code_description,0,0);
			
			$pdf->Ln(6);
			
			# TABLE
			$pdf->SetFont('Arial','B',8);		
			$pdf->Cell(10,5,'No',1,0,'C');
			$pdf->Cell(120,5,'Nama Barang/Jasa',1,0,'C');
			$pdf->Cell(15,5,'Qty',1,0,'C');
			$pdf->Cell(20,5,'Unit',1,0,'C');
			$pdf->Cell(35,5,'Estimasi Harga ('.$R1->request_currency.')',1,0,'R');
			$pdf->Cell(35,5,'Sub Total ('.$R1->request_currency.')',1,1,'R');
			
			$pdf->SetFont('Arial','',8);
			$pdf->SetWidths(array(10,120,15,20,35,35));
			$pdf->SetAligns(array('C','L','C','C','R','R','L'));
			
			$i = 0;
			$grand_total = 0;
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_det';
			$datato['where'] = array(
				'patlog__procurement.entity__request_det.request_id' => $R1->request_id
			);
			$Q2 = $this->view->view_data($datato);
			foreach($Q2->result() as $R2){
				$arr_data = array(
					($i+1),
					$R2->request_det_item,
					$R2->request_det_qty,
					$R2->request_det_unit,
					number_format($R2->request_det_estimate_price,0,'.','.'),
					number_format(($R2->request_det_qty * $R2->request_det_estimate_price),0,',','.')
				);
				$pdf->Row($arr_data);
				$grand_total = $grand_total + ($R2->request_det_qty * $R2->request_det_estimate_price);
				$i++;
			}
			$pdf->SetFont('Arial','B',8);		
			$pdf->Cell(200,5,'Total Estimasi',1,0,'R');
			$pdf->Cell(35,5,number_format($grand_total,0,',','.'),1,1,'R');
			
			$pdf->Ln(6);
			
			$image1 = base_url('assets/public/approved.png');
			$pdf->SetFont('Arial','B',8);
			$pdf->Image($image1, $pdf->GetX()+6, $pdf->GetY()+6,30,0,'PNG');
			$pdf->Cell(45,5,'Pemohon',1,0,'C');	
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_approval';
			$datato['where'] = array(
				'patlog__procurement.entity__request_approval.request_id' => $R1->request_id											
			);	
			$Q2 = $this->view->view_data($datato);
			foreach($Q2->result() as $R2){
				$pdf->Cell(45,5,$R2->request_approval_position,1,0,'C');
			}
			$pdf->Cell(45,5,'Penyerahan Barang',1,0,'C');
			$pdf->Cell(45,5,'Penerima Barang',1,1,'C');
			$pdf->Cell(45,25,'',1,0,'C');
			foreach($Q2->result() as $R2){
				if($R2->request_approval_date != null){
					$pdf->Cell( 45, 25, $pdf->Image($image1, $pdf->GetX()+6, $pdf->GetY()+1, 30), 1, 0, 'C', false );
				}else{
					$pdf->Cell(45,25,'',1,0,'C');
				}
			}
			$pdf->Cell(45,25,'',1,0,'C');
			$pdf->Cell(45,25,'',1,1,'C');
			$pdf->Cell(45,5,$R1->request_employee_in_name,1,0,'C');
			foreach($Q2->result() as $R2){
				$pdf->Cell(45,5,$R2->request_approval_name,1,0,'C');
			}
			$pdf->Cell(45,5,'',1,0,'C');
			$pdf->Cell(45,5,'',1,1,'C');
			$pdf->Cell(45,5,'Tgl : '.date('d-m-Y H:i', strtotime($R1->request_created_date)),1,0,'L');
			foreach($Q2->result() as $R2){
				if($R2->request_approval_date == null){
					$request_approval_date = '';
				}else{
					$request_approval_date = date('d-m-Y H:i', strtotime($R2->request_approval_date));
				}
				$pdf->Cell(45,5,'Tgl : '.$request_approval_date,1,0,'L');
			}
			$pdf->Cell(45,5,'',1,0,'L');
			$pdf->Cell(45,5,'',1,1,'L');	
			$pdf->Ln(6);
			
			$pdf->Output('document-request-'.md5($R1->request_id).'.pdf','I');
		}
	}
	
	public function get_table_dashboard_request_archive_reject()
	{
		$process_proc_id_win = null;
		unset($datato);
		$datato['table'] = 'patlog__procurement.data__process_proc';
		$datato['where'] = array(
			'patlog__procurement.data__process_proc.process_proc_flag' => 'yes'
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$process_proc_id_win = $R1->process_proc_id;
		}
		
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__request';
		$datato['table_join'] = array(
			'patlog__procurement.entity__request_legal'
		);
		$datato['table_join_on'] = array(
			'patlog__procurement.entity__request'
		);
		$datato['join_id'] = array(
			'request_id'
		);
		$datato['join_type'] = array(
			'inner'
		);
		$datato['where_in'] = array(
			'patlog__procurement.entity__request.request_is_finish',
			'patlog__procurement.entity__request.request_is_delete',
			'patlog__procurement.entity__request_legal.request_legal_status'
		);
		$datato['where_in_data'] = array(
			array(1),
			array(0),
			array('Dihapus','Ditolak')
		);
		$datato['column_order'] = array(
			'patlog__procurement.entity__request.request_code',
			'patlog__procurement.entity__request.request_type_name',
			'patlog__procurement.entity__request.request_created_date',
			'patlog__procurement.entity__request.request_employee_in_name',
			'patlog__procurement.entity__request.request_source_code',
			'patlog__procurement.entity__request.request_grandtotal_estimate',
			'patlog__procurement.entity__request.request_proc_employee_in_name',
			'patlog__procurement.entity__request_legal.vendor_name',
			null
		);
		$datato['column_search'] = array(
			'patlog__procurement.entity__request.request_code',
			'patlog__procurement.entity__request.request_category_name',
			'patlog__procurement.entity__request.request_type_name',
			'patlog__procurement.entity__request.request_note',
			'patlog__procurement.entity__request.request_created_date',
			'patlog__procurement.entity__request.request_employee_in_name',
			'patlog__procurement.entity__request.request_division_name',
			'patlog__procurement.entity__request.request_cost_category_name',
			'patlog__procurement.entity__request.request_source_code',
			'patlog__procurement.entity__request.request_currency',
			'patlog__procurement.entity__request.request_grandtotal_estimate',
			'patlog__procurement.entity__request.request_proc_employee_in_name',
			'patlog__procurement.entity__request_legal.request_legal_status',
			'patlog__procurement.entity__request_legal.vendor_name',
			'patlog__procurement.entity__request_legal.contract_no'
		);
		$datato['order'] = array(
			'patlog__procurement.entity__request.request_id' => 'desc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		$no = $_POST['start'];
		foreach($Q1 as $R1){
			$encrypt_id = $this->encrypt->encode($R1->request_id);
            $request_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
			
			$encrypt_id = $this->encrypt->encode($R1->request_legal_id);
            $request_legal_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
			
			$row = array();
			$row[] = '
				<div class="text-left">
					Nomor PR<br/>
					<b>'.$R1->request_code.'</b>
				</div>
			';
			if(strlen($R1->request_note) > 100){
				$request_note = substr($R1->request_note,0,100).'...';
			}else{
				$request_note = $R1->request_note;
			}
			$row[] = '
				<div class="text-left">
					<b>'.$R1->request_category_name.'</b><br/>
					'.$R1->request_type_name.'<br/><br/>
					<small>'.$request_note.'</small>
				</div>
			';
			$row[] = '
				<div class="text-left">
					Tanggal Submit<br/>
					<b>'.$R1->request_created_date.'</b>
				</div>
			';
			$row[] = '
				<div class="text-left">
					'.$R1->request_employee_in_name.'<br/>
					<b>'.$R1->request_division_name.'</b>
				</div>
			';
			$row[] = '
				<div class="text-left">
					'.$R1->request_cost_category_name.'<br/>
					<b>'.$R1->request_source_code.'</b>
				</div>
			';
			$row[] = '
				<div class="text-left">
					'.$R1->request_currency.'<br/>
					<b>'.number_format($R1->request_grandtotal_estimate,0,',','.').'</b>
				</div>
			';
			$row[] = $R1->request_proc_employee_in_name;
			if($R1->request_legal_status == 'Ditolak'){
				$label = 'danger';
			}else{
				$label = 'defaut';
			}
			$request_status = '<div class="badge badge-'.$label.'">'.ucwords(str_replace('_',' ',$R1->request_legal_status)).'</div>';
			$button = '';
			if($R1->request_legal_status == 'Dihapus' or $R1->request_legal_status == 'Ditolak'){
				$button = '
					<a class="btn btn-xs btn-success submit" data-toggle="modal" data-target="#modal_detail" id="submit_'.$request_legal_id.'" title="Kirim">
						<b><small><i class="fa fa-paper-plane"></i> Kirim</small></b>
					</a>
				';
			}
			$row[] = '
				<div class="text-left">
					'.$request_status.'<br/><br/>
					'.$R1->vendor_name.'<br/>
					<b>'.$R1->contract_no.'</b><br/><br/>
					'.$button.'
				</div>
			';
			$view = '
				<a class="btn btn-sm btn-default" target="_blank" href="'.site_url('module_procurement/admin/arsip_permintaan?view=preview&request_id='.$request_id).'">
					<i class="fa fa-eye"></i>
				</a>
			';
			$process = '';
			$edit = '';
			if(!$this->session->userdata('role')){
				$process = '
					<a class="btn btn-sm btn-warning" target="_blank" href="'.site_url('module_procurement/admin/arsip_permintaan?view=process&request_id='.$request_id).'">
						<i class="fa fa-random"></i>
					</a>
				';
				$edit = '
					<a class="btn btn-sm btn-info" target="_blank" href="'.site_url('module_procurement/admin/arsip_permintaan?view=manipulation&action=edit&request_id='.$request_id).'">
						<i class="fa fa-edit"></i>
					</a>
				';
			}
			$row[] = '
				<div class="text-center">
					'.$view.'
					'.$process.'
					'.$edit.'
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
	
	public function get_table_data_vendor_process()
	{
		$data = array();
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__vendor';
		$datato['where'] = array(
			'patlog__procurement.entity__vendor.vendor_done' => 'no'
		);
		$datato['column_order'] = array(
			'patlog__procurement.entity__vendor.vendor_code',
			'patlog__procurement.entity__vendor.vendor_code_mysap',
			'patlog__procurement.entity__vendor.vendor_name',
			'patlog__procurement.entity__vendor.vendor_street_building',
			'patlog__procurement.entity__vendor.vendor_region',
			'patlog__procurement.entity__vendor.vendor_csms',
			'patlog__procurement.entity__vendor.vendor_status',
			null
		);
		$datato['column_search'] = array(
			'patlog__procurement.entity__vendor.vendor_code',
			'patlog__procurement.entity__vendor.vendor_code_mysap',
			'patlog__procurement.entity__vendor.vendor_name',
			'patlog__procurement.entity__vendor.vendor_street_building',
			'patlog__procurement.entity__vendor.vendor_region',
			'patlog__procurement.entity__vendor.vendor_csms',
			'patlog__procurement.entity__vendor.vendor_status'
		);
		$datato['order'] = array(
			'patlog__procurement.entity__vendor.vendor_id' => 'asc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		$no = $_POST['start'];
		foreach($Q1 as $R1){
			$encrypt_id = $this->encrypt->encode($R1->vendor_id);
            $vendor_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
			
			unset($datato2);
			$datato2['table'] = 'patlog__hrms.entity__employee_in';
			$datato2['where'] = array(
				'patlog__hrms.entity__employee_in.employee_in_id' => $R1->vendor_approval_id
			);
			$Q2 = $this->view->view_data($datato2);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$employee_in_name = $R2->employee_in_name;
			}else{
				$employee_in_name = null;
			}
			
			$row = array();
			$row[] = $R1->vendor_code;
			$row[] = $R1->vendor_code_mysap;
			$row[] = $R1->vendor_name;
			$row[] = $R1->vendor_street_building;
			$row[] = $R1->vendor_region;
			$row[] = $R1->vendor_csms;
			if($R1->vendor_done == 'yes'){
				$vendor_status = 'Approve';
			}elseif($R1->vendor_done == 'no'){
				if($R1->vendor_status != 'Reject'){
					$vendor_status = 'Menunggu Approve <b>'.$employee_in_name.'</b>';
				}else{
					$vendor_status = 'Direject';
				}
			}else{
				$vendor_status = '';
			}
			$row[] = $vendor_status;
			$view = '
				<a class="btn btn-sm btn-default" href="'.site_url('module_procurement/admin/vendor_proses?view=preview&vendor_id='.$vendor_id).'">
					<i class="fas fa-eye"></i>
				</a>
			';
			if($R1->vendor_level > 0 and $R1->vendor_done == 'no'){
				$approve = '
					<a class="btn btn-sm btn-primary" href="'.site_url('module_procurement/admin/vendor_proses?view=approval&vendor_id='.$vendor_id).'" >
						<i class="fa fa-check"></i>
					</a>
				';
			}else{
				$approve = '';
			}
			$edit = '
				<a class="btn btn-sm btn-info" href="'.site_url('module_procurement/admin/vendor_proses?view=manipulation&action=edit&vendor_id='.$vendor_id).'">
					<i class="fa fa-edit"></i>
				</a>
			';
			$delete	= '
				<a class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#confirm" id="delete_'.$vendor_id.'" title="Hapus">
					<i class="fa fa-trash"></i> <span class="hidden-xs"></span>
				</a>
			';
			$row[] = '
				<div class="text-center">
					'.$view.'
					'.$approve.'
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
	
	public function get_table_data_vendor()
	{
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__vendor';
		$datato['where'] = array(
			'patlog__procurement.entity__vendor.vendor_done' => 'yes'
		);
		$datato['column_order'] = array(
			'patlog__procurement.entity__vendor.vendor_code',
			'patlog__procurement.entity__vendor.vendor_code_mysap',
			'patlog__procurement.entity__vendor.vendor_name',
			'patlog__procurement.entity__vendor.vendor_street_building',
			'patlog__procurement.entity__vendor.vendor_region',
			'patlog__procurement.entity__vendor.vendor_csms',
			null,
			null
		);
		$datato['column_search'] = array(
			'patlog__procurement.entity__vendor.vendor_code',
			'patlog__procurement.entity__vendor.vendor_code_mysap',
			'patlog__procurement.entity__vendor.vendor_name',
			'patlog__procurement.entity__vendor.vendor_street_building',
			'patlog__procurement.entity__vendor.vendor_region',
			'patlog__procurement.entity__vendor.vendor_csms'
		);
		$datato['order'] = array(
			'patlog__procurement.entity__vendor.vendor_id' => 'asc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		$no = $_POST['start'];
		foreach($Q1 as $R1){
			$encrypt_id = $this->encrypt->encode($R1->vendor_id);
            $vendor_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
			
			unset($datato2);
			$datato2['table'] = 'patlog__hrms.entity__employee_in';
			$datato2['where'] = array(
				'patlog__hrms.entity__employee_in.employee_in_id' => $R1->vendor_approval_id
			);
			$Q2 = $this->view->view_data($datato2);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$employee_in_name = $R2->employee_in_name;
			}else{
				$employee_in_name = null;
			}
			
			$row = array();
			$row[] = $R1->vendor_code;
			$row[] = $R1->vendor_code_mysap;
			$row[] = $R1->vendor_name;
			$row[] = $R1->vendor_street_building;
			$row[] = $R1->vendor_region;
			$row[] = $R1->vendor_csms;
			$row[] = '
				<div class="text-center">
					<a class="btn btn-sm btn-default" href="'.site_url('module_procurement/admin/vendor_data?view=history&vendor_id='.$vendor_id).'">
						<i class="fas fa-eye"></i> Lihat
					</a>
				</div>
			';
			$view = '
				<a class="btn btn-sm btn-default" href="'.site_url('module_procurement/admin/vendor_data?view=preview&vendor_id='.$vendor_id).'">
					<i class="fas fa-eye"></i>
				</a>
			';
			$edit = '
				<a class="btn btn-sm btn-info" href="'.site_url('module_procurement/admin/vendor_data?view=manipulation&action=edit&vendor_id='.$vendor_id).'">
					<i class="fa fa-edit"></i>
				</a>
			';
			$delete	= '
				<a class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#confirm" id="delete_'.$vendor_id.'" title="Hapus">
					<i class="fa fa-trash"></i> <span class="hidden-xs"></span>
				</a>
			';
			$row[] = '
				<div class="text-center">
					'.$view.'
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
	
	public function get_table_data_vendor_history()
	{
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__request';	
		$datato['where'] = array(
			'patlog__procurement.entity__request.vendor_id' => $this->input->post('vendor_id'),
			'patlog__procurement.entity__request.request_is_finish' => 1,
			'patlog__procurement.entity__request.request_is_delete' => 0
		);
		$datato['column_order'] = array(
			'patlog__procurement.entity__request.request_code',
			'patlog__procurement.entity__request.request_type_name',
			'patlog__procurement.entity__request.request_used_date',
			'patlog__procurement.entity__request.request_source_code',
			'patlog__procurement.entity__request.request_grandtotal_estimate',
			'patlog__procurement.entity__request.request_proc_employee_in_name',
			null
		);
		$datato['column_search'] = array(
			'patlog__procurement.entity__request.request_code',
			'patlog__procurement.entity__request.request_type_name',
			'patlog__procurement.entity__request.request_used_date',
			'patlog__procurement.entity__request.request_cost_category_name',
			'patlog__procurement.entity__request.request_source_code',
			'patlog__procurement.entity__request.request_currency',
			'patlog__procurement.entity__request.request_grandtotal_estimate',
			'patlog__procurement.entity__request.request_proc_employee_in_name'
		);
		$datato['order'] = array(
			'patlog__procurement.entity__request.request_id' => 'desc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		$no = $_POST['start'];
		foreach($Q1 as $R1){
			$encrypt_id = $this->encrypt->encode($R1->request_id);
            $request_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
			
			$row = array();
			$row[] = '
				<a href="'.site_url('module_procurement/admin/arsip_permintaan?view=preview&request_id='.$request_id).'" target="_blank">
					<b>'.$R1->request_code.'</b>
				</a>
			';
			$row[] = $R1->request_type_name;
			$row[] = $R1->request_used_date;
			$row[] = '
				<div class="text-left">
					'.$R1->request_cost_category_name.'<br/>
					<b>'.$R1->request_source_code.'</b>
				</div>
			';
			$row[] = '
				<div class="text-left">
					'.$R1->request_currency.'<br/>
					<b>'.number_format($R1->request_grandtotal_estimate,0,',','.').'</b>
				</div>
			';
			$row[] = $R1->request_proc_employee_in_name;
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
	
	public function get_table_request_process()
	{
		$arr_date = array();
		unset($datato);
		$datato['table'] = 'patlog__value.entity__holiday';
		$Q1 = $this->view->view_data($datato);
		foreach($Q1->result() as $R1){
			$arr_date[] = $R1->holiday_date;
		}
		
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__request';	
		$datato['where'] = array(
			'patlog__procurement.entity__request.request_is_finish' => 0,
			'patlog__procurement.entity__request.request_is_delete' => 0
		);
		$datato['column_order'] = array(
			'patlog__procurement.entity__request.request_code',
			'patlog__procurement.entity__request.request_type_name',
			'patlog__procurement.entity__request.request_process_date_start',
			'patlog__procurement.entity__request.request_employee_in_name',
			'patlog__procurement.entity__request.request_source_code',
			'patlog__procurement.entity__request.request_grandtotal_estimate',
			'patlog__procurement.entity__request.request_proc_employee_in_name',
			'patlog__procurement.entity__request.request_status_information',
			null
		);
		$datato['column_search'] = array(
			'patlog__procurement.entity__request.request_code',
			'patlog__procurement.entity__request.request_category_name',
			'patlog__procurement.entity__request.request_type_name',
			'patlog__procurement.entity__request.request_note',
			'patlog__procurement.entity__request.request_process_date_start',
			'patlog__procurement.entity__request.request_employee_in_name',
			'patlog__procurement.entity__request.request_division_name',
			'patlog__procurement.entity__request.request_cost_category_name',
			'patlog__procurement.entity__request.request_source_code',
			'patlog__procurement.entity__request.request_currency',
			'patlog__procurement.entity__request.request_grandtotal_estimate',
			'patlog__procurement.entity__request.request_proc_employee_in_name',
			'patlog__procurement.entity__request.request_status_information',
			'patlog__procurement.entity__request.request_status'
		);
		$datato['order'] = array(
			'patlog__procurement.entity__request.request_id' => 'desc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		$no = $_POST['start'];
		foreach($Q1 as $R1){
			$encrypt_id = $this->encrypt->encode($R1->request_id);
            $request_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
			
			$row = array();
			
			if($R1->request_process_date_start == null){
				$date_locket = '-';
			}else{
				$date_locket = $R1->request_process_date_start;
			}
			
			unset($datato2);
			$datato2['table'] = 'patlog__procurement.data__sla';
			$datato2['where'] = array(
				'patlog__procurement.data__sla.sla_code' => $R1->request_category_name
			);
			$Q2 = $this->view->view_data($datato2);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$cog_sla = $R2->sla_day;
			}else{
				$cog_sla = 0;
			}
			if($R1->request_proc_date_start == null){
				$date_pic = '<b>-</b>';
			}else{
				$day = 0;
				$period = new DatePeriod(
					new DateTime($R1->request_proc_date_start),
					new DateInterval('P1D'),
					new DateTime($R1->request_is_finish_date)
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
				$date_pic = '<b>'.$R1->request_proc_date_start.'</b><br/><span class="badge badge-'.$label.'">'.$day.' hari</span>';
			}
			$row[] = '
				<div class="text-left">
					Nomor PR<br/>
					<b>'.$R1->request_code.'</b>
					<br/><br/>
					Tanggal Submit<br/>
					<b>'.$R1->request_created_date.'</b>
				</div>
			';
			if(strlen($R1->request_note) > 100){
				$request_note = substr($R1->request_note,0,100).'...';
			}else{
				$request_note = $R1->request_note;
			}
			$row[] = '
				<div class="text-left">
					<b>'.$R1->request_category_name.'</b><br/>
					'.$R1->request_type_name.'<br/><br/>
					<small>'.$request_note.'</small>
				</div>
			';
			$row[] = '
				<div class="text-left">
					Menuju Loket<br/>
					<b>'.$date_locket.'</b>
					<br/><br/>
					SLA Procurement<br/>
					'.$date_pic.'
				</div>
			';
			$row[] = '
				<div class="text-left">
					'.$R1->request_employee_in_name.'<br/>
					<b>'.$R1->request_division_name.'</b>
				</div>
			';
			$row[] = '
				<div class="text-left">
					'.$R1->request_cost_category_name.'<br/>
					<b>'.$R1->request_source_code.'</b>
				</div>
			';
			$row[] = '
				<div class="text-left">
					'.$R1->request_currency.'<br/>
					<b>'.number_format($R1->request_grandtotal_estimate,0,',','.').'</b>
				</div>
			';
			$row[] = $R1->request_proc_employee_in_name;
			if($R1->request_status == 'finish'){
				$label = 'primary';
			}elseif($R1->request_status == 'waiting_approve'){
				$label = 'defaut';
			}elseif($R1->request_status == 'process_procurement'){
				$label = 'warning';
			}elseif($R1->request_status == 'reject'){
				$label = 'danger';
			}else{
				$label = 'defaut';
			}
			$request_status = '<div class="badge badge-'.$label.'">'.ucwords(str_replace('_',' ',$R1->request_status)).'</div>';
			$information = '';
			unset($datato2);
			$datato2['table'] = 'patlog__procurement.entity__request_log';
			$datato2['where'] = array(
				'patlog__procurement.entity__request_log.request_id' => $R1->request_id
			);
			$datato2['order'] = array(
				'patlog__procurement.entity__request_log.request_log_level'
			);
			$datato2['order_type'] = array(
				'desc'
			);
			$Q2 = $this->view->view_data($datato2);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				if($R2->request_log_message != '' and $R2->request_log_message != null){
					$information = '
						<small><b>Keterangan :</b> '.$R2->request_log_message.'</small>
					';
				}
			}
			$row[] = '
				<div class="text-left">
					Pengadaan - <b>'.$R1->request_status_information.'</b><br/><br/>
					'.$request_status.'<br/>
					'.$information.'
				</div>
			';
			$view =	'
				<a class="btn btn-sm btn-default" target="_blank" href="'.site_url('module_procurement/admin/proses_permintaan?view=preview&request_id='.$request_id).'">
					<i class="fa fa-eye"></i>
				</a>
			';
			$print = '
				<a class="btn btn-sm btn-default" target="_blank" href="'.site_url('module_procurement/admin_functions/print_request/'.$request_id).'">
					<i class="fas fa-print"></i>
				</a>
			';
			if($R1->request_status == 'waiting_approve'){
				$approve = '
					<a class="btn btn-sm btn-primary" target="_blank" href="'.site_url('module_procurement/admin/proses_permintaan?view=approval&request_id='.$request_id).'">
						<i class="fa fa-check"></i>
					</a>
				';
			}else{
				$approve = '';
			}
			$edit = '
				<a class="btn btn-sm btn-info" target="_blank" href="'.site_url('module_procurement/admin/proses_permintaan?view=manipulation&action=edit&request_id='.$request_id).'">
					<i class="fa fa-edit"></i>
				</a>
			';
			if($R1->request_status == 'process_procurement' and $R1->request_proc_employee_in_id == null){
				$mapping = '
					<a class="btn btn-sm btn-warning" target="_blank" href="'.site_url('module_procurement/admin/proses_permintaan?view=mapping&request_id='.$request_id).'">
						<i class="fa fa-share-alt"></i>
					</a>
				';
			}else{
				$mapping = '';
			}
			if($R1->request_status == 'process_procurement' and $R1->request_proc_employee_in_id != null){
				$process = '
					<a class="btn btn-sm btn-warning" target="_blank" href="'.site_url('module_procurement/admin/proses_permintaan?view=process&request_id='.$request_id).'">
						<i class="fa fa-random"></i>
					</a>
				';
			}else{
				$process = '';
			}
			if($R1->vendor_id != null){
				$finish	= '
					<a class="btn btn-sm btn-success finish" data-toggle="modal" data-target="#modal_detail" id="finish_'.$request_id.'" title="Selesai">
						<i class="fa fa-flag-checkered"></i> <span class="hidden-xs"></span>
					</a>
				';
			}else{
				$finish	= '';
			}
			if($R1->request_status == 'process_procurement' and $R1->request_proc_employee_in_id != null){
				$undo	= '
					<a class="btn btn-sm btn-primary undo" data-toggle="modal" data-target="#confirm" id="undo_'.$request_id.'" title="Kembalikan">
						<i class="fa fa-undo"></i> <span class="hidden-xs"></span>
					</a>
				';
				$cancel = '
					<a class="btn btn-sm btn-danger cancel" data-toggle="modal" data-target="#modal_detail" id="cancel_'.$request_id.'" title="Batalkan">
						<i class="fa fa-times"></i> <span class="hidden-xs"></span>
					</a>
				';
			}else{
				$undo = '';
				$cancel = '';
			}
			$delete	= '
				<a class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#confirm" id="delete_'.$request_id.'" title="Hapus">
					<i class="fa fa-trash"></i> <span class="hidden-xs"></span>
				</a>
			';
			$row[] = '
				<div class="text-center">
					'.$view.'
					'.$print.'
					'.$mapping.'
					'.$approve.'
					'.$process.'
					'.$finish.'
					'.$undo.'
					'.$edit.'
					'.$delete.'
					'.$cancel.'
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
	
	public function get_table_request_process_attach()
	{
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__request_legal';
		$datato['where'] = array(
			'patlog__procurement.entity__request_legal.request_legal_id' => $this->input->post('request_legal_id')
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$request_id = $R1->request_id;
			$vendor_id = $R1->vendor_id;
		}else{
			$request_id = null;
			$vendor_id = null;
		}
		
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__request';
		$datato['table_join'] = array(
			'patlog__procurement.entity__request_process',
			'patlog__procurement.entity__request_process_attach'
		);
		$datato['table_join_on'] = array(
			'patlog__procurement.entity__request',
			'patlog__procurement.entity__request_process'
		);
		$datato['join_id'] = array(
			'request_id',
			'request_process_id'
		);
		$datato['join_type'] = array(
			'inner',
			'inner'
		);
		$datato['where'] = array(
			'patlog__procurement.entity__request_process.request_id' => $request_id,
			'patlog__procurement.entity__request_process.vendor_id' => $vendor_id
		);
		$datato['column_order'] = array(
			'patlog__procurement.entity__request_process_attach.request_process_attach_description',
			null,
			null
		);
		$datato['column_search'] = array(
			'patlog__procurement.entity__request_process_attach.request_process_attach_description'
		);
		$datato['order'] = array(
			'patlog__procurement.entity__request_process_attach.request_process_attach_id' => 'asc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		$no = $_POST['start'];
		foreach($Q1 as $R1){
			$encrypt_id = $this->encrypt->encode($R1->request_process_attach_id);
            $request_process_attach_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
			
			$row = array();
			$row[] = $R1->request_process_proc_name;
			$row[] = $R1->request_process_proc_date;
			$row[] = $R1->request_process_proc_time;
			$row[] = '
				<a class="btn btn-sm btn-default" href="'.base_url('assets/mod__procurement/attach/request_process_attach/'.$R1->request_process_attach_file.'?time='.date('YmdHis')).'" target="_blank">
					<i class="fa fa-eye"></i> Lihat
				</a>
			';
			$row[] = $R1->request_process_attach_description;
			$row[] = '
				<a class="btn btn-sm btn-danger delete_attach" data-toggle="modal" data-target="#confirm" id="delete_attach_'.$request_process_attach_id.'" title="Hapus">
					<i class="fa fa-trash"></i>
				</a>
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
	
	public function get_table_official()
	{
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__request_legal';
		$datato['where'] = array(
			'patlog__procurement.entity__request_legal.request_legal_id' => $this->input->post('request_legal_id')
		);
		$datato['column_order'] = array(
			'patlog__procurement.entity__request_legal.request_legal_user_name',
			'patlog__procurement.entity__request_legal.request_legal_user_position',
			'patlog__procurement.entity__request_legal.request_legal_total_estimate'
		);
		$datato['column_search'] = array(
			'patlog__procurement.entity__request_legal.request_legal_user_name',
			'patlog__procurement.entity__request_legal.request_legal_user_position',
			'patlog__procurement.entity__request_legal.request_legal_total_estimate'
		);
		$datato['order'] = array(
			'patlog__procurement.entity__request_legal.request_legal_user_name' => 'asc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		$no = $_POST['start'];
		foreach($Q1 as $R1){
			$row = array();
			$row[] = $R1->request_legal_user_name;
			$row[] = $R1->request_legal_user_position;
			$row[] = 'IDR. '.number_format($R1->request_legal_total_estimate,0,',','.');
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
		$datato['table'] = 'patlog__procurement.entity__request';	
		$datato['where'] = array(
			'patlog__procurement.entity__request.request_is_finish' => 0,
			'patlog__procurement.entity__request.request_is_delete' => 0
		);
		$datato['column_order'] = array(
			'patlog__procurement.entity__request.request_code',
			'patlog__procurement.entity__request.request_type_name',
			'patlog__procurement.entity__request.request_process_date_start',
			'patlog__procurement.entity__request.request_employee_in_name',
			'patlog__procurement.entity__request.request_source_code',
			'patlog__procurement.entity__request.request_grandtotal_estimate',
			'patlog__procurement.entity__request.request_proc_employee_in_name',
			'patlog__procurement.entity__request.request_status_information',
			null
		);
		$datato['column_search'] = array(
			'patlog__procurement.entity__request.request_code',
			'patlog__procurement.entity__request.request_category_name',
			'patlog__procurement.entity__request.request_type_name',
			'patlog__procurement.entity__request.request_note',
			'patlog__procurement.entity__request.request_process_date_start',
			'patlog__procurement.entity__request.request_employee_in_name',
			'patlog__procurement.entity__request.request_division_name',
			'patlog__procurement.entity__request.request_cost_category_name',
			'patlog__procurement.entity__request.request_source_code',
			'patlog__procurement.entity__request.request_currency',
			'patlog__procurement.entity__request.request_grandtotal_estimate',
			'patlog__procurement.entity__request.request_proc_employee_in_name',
			'patlog__procurement.entity__request.request_status_information',
			'patlog__procurement.entity__request.request_status'
		);
		$datato['order'] = array(
			'patlog__procurement.entity__request.request_id' => 'desc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		$no = $_POST['start'];
		foreach($Q1 as $R1){
			$encrypt_id = $this->encrypt->encode($R1->request_id);
            $request_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
			
			$row = array();
			
			if($R1->request_process_date_start == null){
				$date_locket = '-';
			}else{
				$date_locket = $R1->request_process_date_start;
			}
			
			unset($datato2);
			$datato2['table'] = 'patlog__procurement.data__sla';
			$datato2['where'] = array(
				'patlog__procurement.data__sla.sla_code' => $R1->request_category_name
			);
			$Q2 = $this->view->view_data($datato2);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$cog_sla = $R2->sla_day;
			}else{
				$cog_sla = 0;
			}
			if($R1->request_proc_date_start == null){
				$date_pic = '<b>-</b>';
			}else{
				$day = 0;
				$period = new DatePeriod(
					new DateTime($R1->request_proc_date_start),
					new DateInterval('P1D'),
					new DateTime($R1->request_is_finish_date)
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
				$date_pic = '<b>'.$R1->request_proc_date_start.'</b><br/><span class="badge badge-'.$label.'">'.$day.' hari</span>';
			}
			$row[] = '
				<div class="text-left">
					Nomor PR<br/>
					<b>'.$R1->request_code.'</b>
					<br/><br/>
					Tanggal Submit<br/>
					<b>'.$R1->request_created_date.'</b>
				</div>
			';
			if(strlen($R1->request_note) > 100){
				$request_note = substr($R1->request_note,0,100).'...';
			}else{
				$request_note = $R1->request_note;
			}
			$row[] = '
				<div class="text-left">
					<b>'.$R1->request_category_name.'</b><br/>
					'.$R1->request_type_name.'<br/><br/>
					<small>'.$request_note.'</small>
				</div>
			';
			$row[] = '
				<div class="text-left">
					Menuju Loket<br/>
					<b>'.$date_locket.'</b>
					<br/><br/>
					SLA Procurement<br/>
					'.$date_pic.'
				</div>
			';
			$row[] = '
				<div class="text-left">
					'.$R1->request_employee_in_name.'<br/>
					<b>'.$R1->request_division_name.'</b>
				</div>
			';
			$row[] = '
				<div class="text-left">
					'.$R1->request_cost_category_name.'<br/>
					<b>'.$R1->request_source_code.'</b>
				</div>
			';
			$row[] = '
				<div class="text-left">
					'.$R1->request_currency.'<br/>
					<b>'.number_format($R1->request_grandtotal_estimate,0,',','.').'</b>
				</div>
			';
			$row[] = $R1->request_proc_employee_in_name;
			if($R1->request_status == 'finish'){
				$label = 'primary';
			}elseif($R1->request_status == 'waiting_approve'){
				$label = 'defaut';
			}elseif($R1->request_status == 'process_procurement'){
				$label = 'warning';
			}elseif($R1->request_status == 'reject'){
				$label = 'danger';
			}else{
				$label = 'defaut';
			}
			$request_status = '<div class="badge badge-'.$label.'">'.ucwords(str_replace('_',' ',$R1->request_status)).'</div>';
			$information = '';
			unset($datato2);
			$datato2['table'] = 'patlog__procurement.entity__request_log';
			$datato2['where'] = array(
				'patlog__procurement.entity__request_log.request_id' => $R1->request_id
			);
			$datato2['order'] = array(
				'patlog__procurement.entity__request_log.request_log_level'
			);
			$datato2['order_type'] = array(
				'desc'
			);
			$Q2 = $this->view->view_data($datato2);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				if($R2->request_log_message != '' and $R2->request_log_message != null){
					$information = '
						<small><b>Keterangan :</b> '.$R2->request_log_message.'</small>
					';
				}
			}
			$row[] = '
				<div class="text-left">
					Pengadaan - <b>'.$R1->request_status_information.'</b><br/><br/>
					'.$request_status.'<br/>
					'.$information.'
				</div>
			';
			$view = '
				<a class="btn btn-sm btn-default" target="_blank" href="'.site_url('module_procurement/admin/monitoring?view=preview&request_id='.$request_id).'">
					<i class="fa fa-eye"></i>
				</a>
			';
			$print = '
				<a class="btn btn-sm btn-default" target="_blank" href="'.site_url('module_procurement/admin_functions/print_request/'.$request_id).'">
					<i class="fas fa-print"></i>
				</a>
			';
			$row[] = '
				<div class="text-center">
					'.$view.'
					'.$print.'
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
	
	public function get_table_request_archive()
	{
		$arr_date = array();
		unset($datato);
		$datato['table'] = 'patlog__value.entity__holiday';
		$Q1 = $this->view->view_data($datato);
		foreach($Q1->result() as $R1){
			$arr_date[] = $R1->holiday_date;
		}
		
		$process_proc_id_win = null;
		unset($datato);
		$datato['table'] = 'patlog__procurement.data__process_proc';
		$datato['where'] = array(
			'patlog__procurement.data__process_proc.process_proc_flag' => 'yes'
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$process_proc_id_win = $R1->process_proc_id;
		}
		
		$data = array();
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__request';	
		$datato['where'] = array(
			'patlog__procurement.entity__request.request_is_finish' => 1,
			'patlog__procurement.entity__request.request_is_delete' => 0
		);
		$datato['order'] = array(
			'patlog__procurement.entity__request.request_id'
		);
		$datato['order_type'] = array(
			'desc'
		);
		$Q1 = $this->view->view_data($datato);
		foreach($Q1->result() as $R1){
			$encrypt_id = $this->encrypt->encode($R1->request_id);
            $request_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
			
			$row = array();
			
			if($R1->request_process_date_start == null){
				$date_locket = '-';
			}else{
				$date_locket = $R1->request_process_date_start;
			}
			
			unset($datato2);
			$datato2['table'] = 'patlog__procurement.data__sla';
			$datato2['where'] = array(
				'patlog__procurement.data__sla.sla_code' => $R1->request_category_name
			);
			$Q2 = $this->view->view_data($datato2);
			if($Q2->num_rows()){
				$R2 = $Q2->row();
				$cog_sla = $R2->sla_day;
			}else{
				$cog_sla = 0;
			}
			if($R1->request_proc_date_start == null){
				$date_pic = '<b>-</b>';
			}else{
				$day = 0;
				$period = new DatePeriod(
					new DateTime($R1->request_proc_date_start),
					new DateInterval('P1D'),
					new DateTime($R1->request_is_finish_date)
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
				$date_pic = '<b>'.$R1->request_proc_date_start.'</b><br/><span class="badge badge-'.$label.'">'.$day.' hari</span>';
			}
			$row[] = '
				<div class="text-left">
					Nomor PR<br/>
					<b>'.$R1->request_code.'</b>
					<br/><br/>
					Tanggal Submit<br/>
					<b>'.$R1->request_created_date.'</b>
				</div>
			';
			if(strlen($R1->request_note) > 100){
				$request_note = substr($R1->request_note,0,100).'...';
			}else{
				$request_note = $R1->request_note;
			}
			$row[] = '
				<div class="text-left">
					<b>'.$R1->request_category_name.'</b><br/>
					'.$R1->request_type_name.'<br/><br/>
					<small>'.$request_note.'</small>
				</div>
			';
			$row[] = '
				<div class="text-left">
					Menuju Loket<br/>
					<b>'.$date_locket.'</b>
					<br/><br/>
					SLA Procurement<br/>
					'.$date_pic.'
				</div>
			';
			$row[] = '
				<div class="text-left">
					'.$R1->request_employee_in_name.'<br/>
					<b>'.$R1->request_division_name.'</b>
				</div>
			';
			$row[] = '
				<div class="text-left">
					'.$R1->request_cost_category_name.'<br/>
					<b>'.$R1->request_source_code.'</b>
				</div>
			';
			$row[] = '
				<div class="text-left">
					'.$R1->request_currency.'<br/>
					<b>'.number_format($R1->request_grandtotal_estimate,0,',','.').'</b>
				</div>
			';
			$row[] = $R1->request_proc_employee_in_name;
			if($R1->request_status == 'finish'){
				$label = 'primary';
			}elseif($R1->request_status == 'waiting_approve'){
				$label = 'defaut';
			}elseif($R1->request_status == 'process_procurement'){
				$label = 'warning';
			}elseif($R1->request_status == 'reject'){
				$label = 'danger';
			}else{
				$label = 'defaut';
			}
			$request_status = '<div class="badge badge-'.$label.'">'.ucwords(str_replace('_',' ',$R1->request_status)).'</div>';
			$arr_contract = array();
			unset($datato2);
			$datato2['table'] = 'patlog__procurement.entity__request_process';
			$datato2['where'] = array(
				'patlog__procurement.entity__request_process.request_id' => $R1->request_id,
				'patlog__procurement.entity__request_process.process_proc_id' => $process_proc_id_win
			);
			$Q2 = $this->view->view_data($datato2);
			foreach($Q2->result() as $R2){
				unset($datato3);
				$datato3['table'] = 'patlog__procurement.entity__request_legal';
				$datato3['where'] = array(
					'patlog__procurement.entity__request_legal.request_id' => $R2->request_id,
					'patlog__procurement.entity__request_legal.vendor_id' => $R2->vendor_id
				);
				$Q3 = $this->view->view_data($datato3);
				if($Q3->num_rows()){
					$R3 = $Q3->row();
					$encrypt_id = $this->encrypt->encode($R3->request_legal_id);
					$request_legal_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
					
					if($R3->contract_no == null){
						$contract_no = '';
					}else{
						$contract_no = '('.$R3->contract_no.')';
					}
					$button = '';
					if($R3->request_legal_status == 'Belum Kirim' or $R3->request_legal_status == 'Dihapus' or $R3->request_legal_status == 'Ditolak'){
						$button = '
							<a class="btn btn-xs btn-success submit" data-toggle="modal" data-target="#modal_detail" id="submit_'.$request_legal_id.'" title="Kirim">
								<b><small><i class="fa fa-paper-plane"></i> Kirim</small></b>
							</a>
						';
					}
					$arr_contract[] = $R3->vendor_name.' - '.$R3->request_legal_status.' - '.$button.$contract_no;
				}
			}
			if(count($arr_contract) > 0){
				$contract = implode('<br/>',$arr_contract);
			}else{
				$contract = '';
			}
			$row[] = '
				<div class="text-left">
					Pengadaan - <b>'.$R1->request_status_information.'</b><br/><br/>
					Kontrak :<br/><b><small>'.$contract.'</small></b><br/><br/>
					'.$request_status.'
				</div>
			';
			$view = '
				<a class="btn btn-sm btn-default" target="_blank" href="'.site_url('module_procurement/admin/arsip_permintaan?view=preview&request_id='.$request_id).'">
					<i class="fa fa-eye"></i>
				</a>
			';
			$print = '
				<a class="btn btn-sm btn-default" target="_blank" href="'.site_url('module_procurement/admin_functions/print_request/'.$request_id).'">
					<i class="fas fa-print"></i>
				</a>
			';
			$process = '';
			$edit = '';
			$submit_contract = '';
			if(!$this->session->userdata('role')){
				$process = '
					<a class="btn btn-sm btn-warning" target="_blank" href="'.site_url('module_procurement/admin/arsip_permintaan?view=process&request_id='.$request_id).'">
						<i class="fa fa-random"></i>
					</a>
				';
				$edit = '
					<a class="btn btn-sm btn-info" target="_blank" href="'.site_url('module_procurement/admin/arsip_permintaan?view=manipulation&action=edit&request_id='.$request_id).'">
						<i class="fa fa-edit"></i>
					</a>
				';
			}
			$row[] = '
				<div class="text-center">
					'.$view.'
					'.$print.'
					'.$process.'
					'.$edit.'
				</div>
			';
			$data[] = $row;
		}

		$output = array(
			// 'draw' => $_POST['draw'],
			// 'recordsTotal' => $this->view->count_all($datato),
			// 'recordsFiltered' => $this->view->count_filtered($datato),
			'data' => $data,
		);
		echo json_encode($output);
	}
	
	public function get_table_data_category()
	{
		unset($datato);
		$datato['table'] = 'patlog__procurement.data__category';	
		$datato['column_order'] = array(
			'patlog__procurement.data__category.category_name',
			null
		);
		$datato['column_search'] = array(
			'patlog__procurement.data__category.category_name'
		);
		$datato['order'] = array(
			'patlog__procurement.data__category.category_name' => 'asc'
		);							
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		$no = $_POST['start'];
		foreach($Q1 as $R1){
			$encrypt_id = $this->encrypt->encode($R1->category_id);
            $category_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
			
			$row = array();
			$row[] = $R1->category_name;
			$edit = '
				<a class="btn btn-sm btn-info" href="'.site_url('module_procurement/admin/data_kategori?view=manipulation&action=edit&category_id='.$category_id).'">
					<i class="fa fa-edit"></i> <span class="hidden-xs"></span>
				</a>
			';		
			$delete	= '
				<a class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#confirm" id="delete_'.$category_id.'" title="Hapus">
					<i class="fa fa-trash"></i> <span class="hidden-xs"></span>
				</a>
			';
			$row[] = '
				<div class="text-center">
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
	
	public function get_table_data_document()
	{	
		unset($datato);
		$datato['table'] = 'patlog__procurement.data__document';
		$datato['column_order'] = array(
			'patlog__procurement.data__document.document_order',
			'patlog__procurement.data__document.document_name',
			'patlog__procurement.data__document.document_mimes',
			'patlog__procurement.data__document.document_mandatory',
			null
		);
		$datato['column_search'] = array(
			'patlog__procurement.data__document.document_order',
			'patlog__procurement.data__document.document_name',
			'patlog__procurement.data__document.document_mimes',
			'patlog__procurement.data__document.document_mandatory'
		);
		$datato['order'] = array(
			'patlog__procurement.data__document.document_order' => 'asc'
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
			$row[] = $R1->document_mimes;
			$row[] = $R1->document_mandatory;
			$row[] = '
				<div class="text-center">
					<a class="btn btn-sm btn-default" href="'.site_url('module_procurement/admin/data_dokumen?view=preview&document_id='.$document_id).'">
						<i class="fa fa-eye"></i>
					</a>
					<a class="btn btn-sm btn-info" href="'.site_url('module_procurement/admin/data_dokumen?view=manipulation&action=edit&document_id='.$document_id).'">
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
	
	public function get_table_data_type()
	{
		unset($datato);
		$datato['table'] = 'patlog__procurement.data__type';					
		$datato['column_order'] = array(
			'patlog__procurement.data__type.type_name',
			'patlog__procurement.data__type.type_category',
			null
		);
		$datato['column_search'] = array(
			'patlog__procurement.data__type.type_name',
			'patlog__procurement.data__type.type_category'
		);
		$datato['order'] = array(
			'patlog__procurement.data__type.type_name' => 'asc'
		);							
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		$no = $_POST['start'];
		foreach($Q1 as $R1){
			$encrypt_id = $this->encrypt->encode($R1->type_id);
            $type_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
			
			$row = array();
			$row[] = $R1->type_name;
			$row[] = $R1->type_category;
			$edit = '
				<a class="btn btn-sm btn-info" href="'.site_url('module_procurement/admin/data_tipe?view=manipulation&action=edit&type_id='.$type_id).'">
					<i class="fa fa-edit"></i> <span class="hidden-xs"></span>
				</a>
			';		
			$delete	= '
				<a class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#confirm" id="delete_'.$type_id.'" title="Hapus">
					<i class="fa fa-trash"></i> <span class="hidden-xs"></span>
				</a>
			';
			$row[] = '
				<div class="text-center">
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
	
	public function get_table_data_unit()
	{
		unset($datato);
		$datato['table'] = 'patlog__procurement.data__unit';	
		$datato['column_order'] = array(
			'patlog__procurement.data__unit.unit_name',
			null
		);
		$datato['column_search'] = array(
			'patlog__procurement.data__unit.unit_name'
		);
		$datato['order'] = array(
			'patlog__procurement.data__unit.unit_name' => 'asc'
		);							
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		$no = $_POST['start'];
		foreach($Q1 as $R1){
			$encrypt_id = $this->encrypt->encode($R1->unit_id);
            $unit_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
			
			$row = array();
			$row[] = $R1->unit_name;
			$edit = '
				<a class="btn btn-sm btn-info" href="'.site_url('module_procurement/admin/data_unit?view=manipulation&action=edit&unit_id='.$unit_id).'">
					<i class="fa fa-edit"></i> <span class="hidden-xs"></span>
				</a>
			';		
			$delete	= '
				<a class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#confirm" id="delete_'.$unit_id.'" title="Hapus">
					<i class="fa fa-trash"></i> <span class="hidden-xs"></span>
				</a>
			';
			$row[] = '
				<div class="text-center">
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
	
	public function get_table_data_item()
	{
		unset($datato);
		$datato['table'] = 'patlog__procurement.data__item';	
		$datato['table_join'] = array(
			'patlog__procurement.data__item_category',
			'patlog__procurement.data__type'
		);
		$datato['table_join_on'] = array(
			'patlog__procurement.data__item',
			'patlog__procurement.data__item'
		);
		$datato['join_id'] = array(
			'item_category_id',
			'type_id'
		);
		$datato['join_type'] = array(
			'inner',
			'inner'
		);			
		$datato['order'] = array(
			'patlog__procurement.data__item.item_name' => 'asc'
		);								
		$datato['column_order'] = array(
			'patlog__procurement.data__item_category.item_category_name',
			'patlog__procurement.data__type.type_name',
			'patlog__procurement.data__item.item_name',
			'patlog__procurement.data__item.item_merk',
			'patlog__procurement.data__item.item_unit',
			'patlog__procurement.data__item.item_price',
			null
		);
		$datato['column_search'] = array(
			'patlog__procurement.data__item_category.item_category_name',
			'patlog__procurement.data__type.type_name',
			'patlog__procurement.data__item.item_name',
			'patlog__procurement.data__item.item_merk',
			'patlog__procurement.data__item.item_unit',
			'patlog__procurement.data__item.item_price'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		$no = $_POST['start'];
		foreach($Q1 as $R1){
			$encrypt_id = $this->encrypt->encode($R1->item_id);
            $item_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
			
			$row = array();
			$row[] = $R1->item_category_name;
			$row[] = $R1->type_name;
			$row[] = $R1->item_name;
			$row[] = $R1->item_merk;
			$row[] = $R1->item_unit;
			$row[] = 'IDR. '.number_format($R1->item_price,0,',','.');
			$edit = '
				<a class="btn btn-sm btn-info" href="'.site_url('module_procurement/admin/data_item?view=manipulation&action=edit&item_id='.$item_id).'">
					<i class="fa fa-edit"></i> <span class="hidden-xs"></span>
				</a>
			';		
			$delete	= '
				<a class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#confirm" id="delete_'.$item_id.'" title="Hapus">
					<i class="fa fa-trash"></i> <span class="hidden-xs"></span>
				</a>
			';
			$row[] = '
				<div class="text-center">
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
	
	public function get_table_data_process_proc()
	{
		unset($datato);
		$datato['table']= 'patlog__procurement.data__process_proc';	
		$datato['column_order'] = array(
			'patlog__procurement.data__process_proc.process_proc_name',
			'patlog__procurement.data__process_proc.process_proc_flag',
			null
		);
		$datato['column_search'] = array(
			'patlog__procurement.data__process_proc.process_proc_name',
			'patlog__procurement.data__process_proc.process_proc_flag'
		);
		$datato['order'] = array(
			'patlog__procurement.data__process_proc.process_proc_name' => 'asc'
		);		
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		$no = $_POST['start'];
		foreach($Q1 as $R1){
			$encrypt_id = $this->encrypt->encode($R1->process_proc_id);
            $process_proc_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
			
			$row = array();
			$row[] = $R1->process_proc_name;
			$row[] = $R1->process_proc_flag;
			$edit = '
				<a class="btn btn-sm btn-info" href="'.site_url('module_procurement/admin/data_proses_pengadaan?view=manipulation&action=edit&process_proc_id='.$process_proc_id).'">
					<i class="fa fa-edit"></i> <span class="hidden-xs"></span>
				</a>
			';		
			$delete	= '
				<a class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#confirm" id="delete_'.$process_proc_id.'" title="Hapus">
					<i class="fa fa-trash"></i> <span class="hidden-xs"></span>
				</a>
			';
			$row[] = '
				<div class="text-center">
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
	
	public function get_table_data_legal()
	{
		unset($datato);
		$datato['table'] = 'patlog__procurement.data__legal';
		$datato['column_order'] = array(
			'patlog__procurement.data__legal.legal_entity_name',
			null
		);
		$datato['column_search'] = array(
			'patlog__procurement.data__legal.legal_entity_name'
		);
		$datato['order'] = array(
			'patlog__procurement.data__legal.legal_entity_name' => 'asc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		$no = $_POST['start'];
		foreach($Q1 as $R1){
			$encrypt_id = $this->encrypt->encode($R1->legal_entity_id);
            $legal_entity_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
			
			$row = array();
			$row[] = $R1->legal_entity_name;
			$edit = '
				<a class="btn btn-sm btn-info" href="'.site_url('module_procurement/admin/data_badan_hukum?view=manipulation&action=edit&legal_entity_id='.$legal_entity_id).'">
					<i class="fa fa-edit"></i> <span class="hidden-xs"></span>
				</a>
			';		
			$delete	= '
				<a class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#confirm" id="delete_'.$legal_entity_id.'" title="Hapus">
					<i class="fa fa-trash"></i> <span class="hidden-xs"></span>
				</a>
			';
			$row[] = '
				<div class="text-center">
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
	
	public function get_table_data_kbli()
	{
		unset($datato);
		$datato['table'] = 'patlog__procurement.data__kbli';
		$datato['column_order'] = array(
			'patlog__procurement.data__kbli.kbli_code',
			'patlog__procurement.data__kbli.kbli_name',
			'patlog__procurement.data__kbli.kbli_description',
			null
		);
		$datato['column_search'] = array(
			'patlog__procurement.data__kbli.kbli_code',
			'patlog__procurement.data__kbli.kbli_name',
			'patlog__procurement.data__kbli.kbli_description'
		);
		$datato['order'] = array(
			'patlog__procurement.data__kbli.kbli_code' => 'asc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		$no = $_POST['start'];
		foreach($Q1 as $R1){
			$encrypt_id = $this->encrypt->encode($R1->kbli_id);
            $kbli_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
			
			$row = array();			
			$row[] = $R1->kbli_code;
			$row[] = $R1->kbli_name;
			$row[] = substr($R1->kbli_description,0,200).'...';
			$edit = '
				<a class="btn btn-sm btn-info" href="'.site_url('module_procurement/admin/data_kbli?view=manipulation&action=edit&kbli_id='.$kbli_id).'">
					<i class="fa fa-edit"></i> <span class="hidden-xs"></span>
				</a>
			';		
			$delete	= '
				<a class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#confirm" id="delete_'.$kbli_id.'" title="Hapus">
					<i class="fa fa-trash"></i> <span class="hidden-xs"></span>
				</a>
			';
			$row[] = '
				<div class="text-center">
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
	
	public function get_table_data_kbli_legality()
	{
		unset($datato);
		$datato['table'] = 'patlog__procurement.data__kbli_legality';
		$datato['column_order'] = array(
			'patlog__procurement.data__kbli_legality.kbli_legality_name',
			null
		);
		$datato['column_search'] = array(
			'patlog__procurement.data__kbli_legality.kbli_legality_name'
		);
		$datato['order'] = array(
			'patlog__procurement.data__kbli_legality.kbli_legality_id' => 'asc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		$no = $_POST['start'];
		foreach($Q1 as $R1){
			$encrypt_id = $this->encrypt->encode($R1->kbli_legality_id);
            $kbli_legality_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
			
			$row = array();
			$row[] = $R1->kbli_legality_name;
			$edit = '
				<a class="btn btn-sm btn-info" href="'.site_url('module_procurement/admin/data_legalitas_kbli?view=manipulation&action=edit&kbli_legality_id='.$kbli_legality_id).'">
					<i class="fa fa-edit"></i> <span class="hidden-xs"></span>
				</a>
			';		
			$delete	= '
				<a class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#confirm" id="delete_'.$kbli_legality_id.'" title="Hapus">
					<i class="fa fa-trash"></i> <span class="hidden-xs"></span>
				</a>
			';
			$row[] = '
				<div class="text-center">
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
	
	public function get_table_data_csms()
	{
		unset($datato);
		$datato['table'] = 'patlog__procurement.data__csms';
		$datato['column_order'] = array(
			'patlog__procurement.data__csms.csms_name',
			null
		);
		$datato['column_search'] = array(
			'patlog__procurement.data__csms.csms_name'
		);
		$datato['order'] = array(
			'patlog__procurement.data__csms.csms_id' => 'asc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		$no = $_POST['start'];
		foreach($Q1 as $R1){
			$encrypt_id = $this->encrypt->encode($R1->csms_id);
            $csms_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
			
			$row = array();
			$row[] = $R1->csms_name;
			$edit = '
				<a class="btn btn-sm btn-info" href="'.site_url('module_procurement/admin/data_csms?view=manipulation&action=edit&csms_id='.$csms_id).'">
					<i class="fa fa-edit"></i> <span class="hidden-xs"></span>
				</a>
			';		
			$delete	= '
				<a class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#confirm" id="delete_'.$csms_id.'" title="Hapus">
					<i class="fa fa-trash"></i> <span class="hidden-xs"></span>
				</a>
			';
			$row[] = '
				<div class="text-center">
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
	
	public function get_table_data_sla()
	{
		unset($datato);
		$datato['table'] = 'patlog__procurement.data__sla';
		$datato['column_order'] = array(
			'patlog__procurement.data__sla.sla_code',
			'patlog__procurement.data__sla.sla_day',
			null
		);
		$datato['column_search'] = array(
			'patlog__procurement.data__sla.sla_code',
			'patlog__procurement.data__sla.sla_day',
		);
		$datato['order'] = array(
			'patlog__procurement.data__sla.sla_code' => 'asc'
		);
		$Q1 = $this->view->get_datatables($datato);
		$data = array();
		$no = $_POST['start'];
		foreach($Q1 as $R1){
			$encrypt_id = $this->encrypt->encode($R1->sla_id);
            $sla_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
			
			$row = array();			
			$row[] = $R1->sla_code;
			$row[] = $R1->sla_day;
			$edit = '
				<a class="btn btn-sm btn-info" href="'.site_url('module_procurement/admin/data_sla?view=manipulation&action=edit&sla_id='.$sla_id).'">
					<i class="fa fa-edit"></i> <span class="hidden-xs"></span>
				</a>
			';		
			$delete	= '
				<a class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#confirm" id="delete_'.$sla_id.'" title="Hapus">
					<i class="fa fa-trash"></i> <span class="hidden-xs"></span>
				</a>
			';
			$row[] = '
				<div class="text-center">
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
	
	public function get_dropdown_approval_contract()
	{
		unset($datato);
		$datato['table'] = 'patlog__hrms.entity__employee_in';
		$datato['where'] = array(
			'patlog__hrms.entity__employee_in.employee_in_id' => $this->input->post('request_pic_contract_id')
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$division_id = $R1->division_id;
		}else{
			$division_id = null;
		}
		
		$data['request_pic_contract_approval_id'][] = '<option selected disabled value="" hidden>--Pilih--</option>';
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
			$data['request_pic_contract_approval_id'][] = '<option value="'.urlencode($R1->approval_id).'">'.$R1->approval_name.'</option>';
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
	
	public function get_dropdown_city()
	{
		$data['city_id'][] = '<option selected disabled value="">--Pilih--</option>';
		
		unset($datato);
		$datato['table'] = 'patlog__value.entity__city';
		$datato['where'] = array(
			'patlog__value.entity__city.province_id' => urldecode($this->input->post('province_id'))
		);
		$datato['order'] = array('patlog__value.entity__city.city_name');
		$datato['order_type'] = array('asc');
		$Q1 = $this->view->view_data($datato);
		foreach($Q1->result() as $R1){
			$data['city_id'][] = '<option value="'.urlencode($R1->city_id).'">'.$R1->city_name.'</option>';
		}
		
		echo json_encode($data, true);
	}
	
	public function get_dropdown_district()
	{
		$data['district_id'][] = '<option selected disabled value="">--Pilih--</option>';
		
		unset($datato);
		$datato['table'] = 'patlog__value.entity__district';
		$datato['where'] = array(
			'patlog__value.entity__district.city_id' => urldecode($this->input->post('city_id'))
		);
		$datato['order'] = array('patlog__value.entity__district.district_name');
		$datato['order_type'] = array('asc');
		$Q1 = $this->view->view_data($datato);
		foreach($Q1->result() as $R1){
			$data['district_id'][] = '<option value="'.urlencode($R1->district_id).'">'.$R1->district_name.'</option>';
		}
		
		echo json_encode($data, true);
	}
	
	public function get_dropdown_village()
	{
		$data['village_id'][] = '<option selected disabled value="">--Pilih--</option>';
		
		unset($datato);
		$datato['table'] = 'patlog__value.entity__village';
		$datato['where'] = array(
			'patlog__value.entity__village.district_id' => urldecode($this->input->post('district_id'))
		);
		$datato['order'] = array('patlog__value.entity__village.village_name');
		$datato['order_type'] = array('asc');
		$Q1 = $this->view->view_data($datato);
		foreach($Q1->result() as $R1){
			$data['village_id'][] = '<option value="'.urlencode($R1->village_id).'">'.$R1->village_name.'</option>';
		}
		
		echo json_encode($data, true);
	}
	
	public function get_dropdown_type_code()
	{
		$data['type_code_id'][] = '<option selected disabled value="">--Pilih--</option>';
		
		if(urldecode($this->input->post('cost_category_id')) == 1){
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
				$data['type_code_id'][] = '<option value="'.urlencode($R1->cost_center_id).'">'.$R1->cost_center_name.' - '.$R1->cost_center_description.'</option>';
			}
		}elseif(urldecode($this->input->post('cost_category_id')) == 2){
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
				$data['type_code_id'][] = '<option value="'.urlencode($R1->project_code_id).'">'.$R1->project_code_name.' - '.$R1->project_code_description.'</option>';
			}
		}
		
		echo json_encode($data, true);
	}
	
	public function get_input_vendor_id_card()
	{
		$ktp = base64_encode($this->input->post('vendor_id_card'));
	
	 	unset($datato);
	 	$datato['table'] = 'patlog__procurement.entity__vendor';
		if($this->input->post('vendor_id') == ''){
			$datato['where'] = array(
				'patlog__procurement.entity__vendor.vendor_id_card' => $ktp
			);
		}else{
			$datato['where'] = array(
				'patlog__procurement.entity__vendor.vendor_id != ' => $this->input->post('vendor_id'),
				'patlog__procurement.entity__vendor.vendor_id_card' => $ktp
			);
		}
	 	$Q1 = $this->view->view_data($datato);
	 	if ($Q1->num_rows()){
			$R1 = $Q1->row();
			$data['text'] = '<span class="badge badge-danger">* KTP Sudah Terdaftar<span>' ;
			$data['status'] = 'false';
	 	}else{
	 		$data['text'] = '<span class="badge badge-info">* KTP dapat digunakan</span>';
			$data['status'] = 'true';
	 	}

	 	echo json_encode($data, true);
	}
	
	public function get_input_employee()
	{
		unset($datato);
		$datato['table'] = 'patlog__hrms.entity__employee_in';
		$datato['table_join'] = array(
			'patlog__hrms.entity__division',
			'patlog__hrms.entity__functions'
		);
		$datato['table_join_on'] = array(
			'patlog__hrms.entity__employee_in',
			'patlog__hrms.entity__employee_in'
		);
		$datato['join_id'] = array(
			'division_id',
			'functions_id'
		);
		$datato['join_type'] = array(
			'inner',
			'inner'
		);
		$datato['where'] = array(
			'patlog__hrms.entity__employee_in.employee_in_id' => $this->input->post('employee_in_id')
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			$data['employee_in_code'] = $R1->employee_in_code;
			$data['employee_in_name'] = $R1->employee_in_name;
			$data['division_id'] = $R1->division_id;	
			$data['division_name'] = $R1->division_name;
			$data['functions_id'] = $R1->functions_id;
			$data['functions_name'] = $R1->functions_name;
			
			$data['request_pic_contract_id'][] = '<option selected disabled value="">--Pilih--</option>';
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
			$Q2 = $this->view->view_data($datato);
			foreach($Q2->result() as $R2){
				$data['request_pic_contract_id'][] = '<option value="'.urlencode($R2->employee_in_id).'">'.$R2->employee_in_code.' | '.$R2->employee_in_name.'</option>';
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
				'patlog__config.entity__approval.approval_type_id' => 2,
				'patlog__config.entity__approval.division_id' => $R1->division_id
			);
			$Q2 = $this->view->view_data($datato);
			foreach($Q2->result() as $R2){
				$data['approver_level'][] = '
				<div class="vertical-timeline-block">
					<div class="vertical-timeline-icon">
						<i class="fa fa-check-circle"></i>
					</div>
					<div class="vertical-timeline-content">
						<p><b>'.$R2->approval_detail_employee_in_name.'</b></p>
						<span class="vertical-date small text-muted">'.$R2->approval_detail_employee_in_position.'</span>
					</div>
				</div>';
			}
			
			$data['approver_level'][] = '
				<div class="vertical-timeline-block">
					<div class="vertical-timeline-icon">
						<i class="fa fa-ellipsis-h"></i>
					</div>
					<div class="vertical-timeline-content">
						<p><b>Proses Pengadaan</b></p>
						<span class="vertical-date small text-muted"></span>
					</div>
				</div>';
		}else{
			$data['employee_in_code'] = '';
			$data['employee_in_name'] = '';
			$data['division_name'] = '';
			$data['functions_name'] = '';
			$data['approver_level'] = '';
		}
		
		echo json_encode($data, true);
	}
	
	public function get_input_item()
	{
		unset($datato);
		$datato['table'] = 'patlog__procurement.data__item';
		$datato['where'] = array(
			'patlog__procurement.data__item.item_id' => $this->input->post('request_det_item')
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$data['item_price'] = $R1->item_price;
			$data['item_unit'] = $R1->item_unit;
		}else{			
			$data['item_price'] = 0;
			$data['item_unit'] = '';		
		}
		
		echo json_encode($data, true);
	}
	
	public function get_input_request_message()
	{
		$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->post('request_id'));
		$request_id = $this->encrypt->decode($decrypt_id);
		
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__request';
		$datato['where'] = array(
			'patlog__procurement.entity__request.request_id' => $request_id
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			if($R1->vendor_id != null){
				$message = '<b class="text-navy">Anda sudah menentukan pemenang.</b>';
			}else{
				$message = '<b class="text-danger">Anda belum memiliki pemenang !</b>';
			}
		}else{			
			$message = '<b class="text-danger">Anda belum memiliki pemenang !</b>';
		}
		
		$data['message'] = '
			Apakah anda yakin telah menyelesaikan proses <b>Pengadaan ini?</b><br/>
			'.$message.'<br/>
			Catatan : Data PR yang sudah diselesaikan, tidak dapat diubah kembali.
		';
		
		echo json_encode($data, true);
	}
	
	public function get_input_request_legal()
	{
		$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->post('request_id'));
		$request_id = $this->encrypt->decode($decrypt_id);
		
		$arr_vendor_id = array();
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__request_legal';
		$datato['where'] = array(
			'patlog__procurement.entity__request_legal.request_id' => $request_id
		);
		$Q1 = $this->view->view_data($datato);
		foreach($Q1->result() as $R1){
			$arr_vendor_id[] = $R1->vendor_id;
		}
		
	 	unset($datato);
	 	$datato['table'] = 'patlog__procurement.entity__request_legal';
		$datato['where'] = array(
			'patlog__procurement.entity__request_legal.request_legal_id' => $this->input->post('request_legal_id')
		);
	 	$Q1 = $this->view->view_data($datato);
	 	if ($Q1->num_rows()){
			$R1 = $Q1->row();
			$data['vendor_id'] = $R1->vendor_id;
			$data['vendor_name'] = $R1->vendor_name;
			$data['request_legal_date_start'] = $R1->request_legal_date_start;
			$data['request_legal_date_end'] = $R1->request_legal_date_end;
	 	}else{
	 		$data['vendor_id'] = null;
	 		$data['vendor_name'] = null;
			$data['request_legal_date_start'] = null;
			$data['request_legal_date_end'] = null;
	 	}
		
		$data['vendor'][] = '<option selected disabled value="">--Pilih--</option>';
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__vendor';
		if($this->input->post('request_legal_id')){
			$datato['where'] = array(
				'patlog__procurement.entity__vendor.vendor_id' => $data['vendor_id']
			);
		}else{
			if(count($arr_vendor_id) > 0){
				$datato['where_not_in'] = array(
					'patlog__procurement.entity__vendor.vendor_id'
				);
				$datato['where_not_in_data'] = array(
					$arr_vendor_id
				);
			}
		}
		$Q1 = $this->view->view_data($datato);
		foreach($Q1->result() as $R1){
			$data['vendor'][] = '<option value="'.urlencode($R1->vendor_id).'">'.$R1->vendor_name.'</option>';
		}
		
		$data['vendor'][] = '
			<script type="text/javascript">
				$("#vendor_id").val("'.$data['vendor_id'].'").trigger("change");
			</script>
		';

	 	echo json_encode($data, true);
	}
	
	public function get_input_official()
	{
		$data['status'] = 'false';
		unset($datato);
		$datato['table'] = 'patlog__procurement.data__process_proc';
		$datato['where'] = array(
			'patlog__procurement.data__process_proc.process_proc_id' => $this->input->post('process_proc_id'),
			'patlog__procurement.data__process_proc.process_proc_flag' => 'yes'
		);
		$Q1 = $this->view->view_data($datato);
	 	if ($Q1->num_rows()){
			$R1 = $Q1->row();
			$data['status'] = 'true';
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_legal';
			$datato['where'] = array(
				'patlog__procurement.entity__request_legal.request_legal_id' => $this->input->post('request_legal_id')
			);
			$Q2 = $this->view->view_data($datato);
			if ($Q2->num_rows()){
				$R2 = $Q2->row();
				$data['request_legal_user_name'] = $R2->request_legal_user_name;
				$data['request_legal_user_position'] = $R2->request_legal_user_position;
				$data['request_legal_total_estimate'] = $R2->request_legal_total_estimate;
			}else{
				$data['request_legal_user_name'] = null;
				$data['request_legal_user_position'] = null;
				$data['request_legal_total_estimate'] = null;
			}
		}

	 	echo json_encode($data, true);
	}
	
	public function get_modal_cancel()
	{
		$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->post('request_id'));
		$request_id = $this->encrypt->decode($decrypt_id);
		
		$data['isi'] = '
			<form method="post" action="'.site_url('module_procurement/admin_functions/request_cancel/'.$this->input->post('request_id')).'" enctype="multipart/form-data">
				<input type="hidden" name="'.$this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'" required="">
				<div class="modal-header">
					<button class="close" data-dismiss="modal">
						&times;
					</button>
					<h4 class="modal-title">Konfirmasi</h4>
				</div>
				<div class="modal-body">
					<p>Apakah anda yakin ingin membatalkan data ini ?</p>
					<div class="form-group">
						<label>Keterangan Pembatalan <span class="text-danger">*</span></label>
						<textarea class="form-control" name="request_log_message" placeholder="Keterangan Pembatalan" rows="3" maxlength="1000"></textarea>
						<span class="help-block m-b-none small"><span class="text-warning">*</span> maksimal 1000 karakter.</span>
					</div>
					<div class="form-group">
						<label>Lampiran Pembatalan (Opsional) <span class="text-warning">*</span></label>
						<input type="file" class="form-control" name="request_log_file" accept="application/pdf,image/jpg,image/png" />
						<span class="help-block m-b-none small"><span class="text-warning">*</span> Format file PDF/JPG/JPEG/PNG.</span>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-success" type="submit"> Ya</button>
					<button class="btn btn-default" data-dismiss="modal"> Tidak</button>
				</div>
			</form>
		';
		
		echo json_encode($data, true);
	}
	
	public function get_modal_finish()
	{
		$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->post('request_id'));
		$request_id = $this->encrypt->decode($decrypt_id);
		
		$request_pic_contract_id = null;
		$request_pic_contract_name = null;
		$request_pic_contract_approval_id = null;
		$request_pic_contract_approval_name = null;
		$request_pic_contract_request_id = null;
		$request_pic_contract_request_name = null;
		$request_pic_contract_request_description_id = null;
		$request_pic_contract_request_description_name = null;
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__request';
		$datato['where'] = array(
			'patlog__procurement.entity__request.request_id' => $request_id
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$request_pic_contract_id = $R1->request_pic_contract_id;
			$request_pic_contract_name = $R1->request_pic_contract_name;
			$request_pic_contract_approval_id = $R1->request_pic_contract_approval_id;
			$request_pic_contract_approval_name = $R1->request_pic_contract_approval_name;
			$request_pic_contract_request_id = $R1->request_pic_contract_request_id;
			$request_pic_contract_request_name = $R1->request_pic_contract_request_name;
			$request_pic_contract_request_description_id = $R1->request_pic_contract_request_description_id;
			$request_pic_contract_request_description_name = $R1->request_pic_contract_request_description_name;
			if($R1->vendor_id != null){
				$message = '<b class="text-navy">Anda sudah menentukan pemenang.</b>';
			}else{
				$message = '<b class="text-danger">Anda belum memiliki pemenang !</b>';
			}
		}else{			
			$message = '<b class="text-danger">Anda belum memiliki pemenang !</b>';
		}
		
		$arr_pic_name = array();
		unset($datato);
		$datato['table'] = 'patlog__hrms.entity__employee_in';	
		$datato['where_in'] = array(
			'patlog__hrms.entity__employee_in.employee_in_position',
			'patlog__hrms.entity__employee_in.employee_in_status'
		);
		$datato['where_in_data'] = array(
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
			$arr_pic_name[] = '<option value="'.urlencode($R1->employee_in_id).'" '.$selected.'>'.$R1->employee_in_code.' | '.$R1->employee_in_name.'</option>';
		}
		
		unset($datato);
		$datato['table'] = 'patlog__hrms.entity__employee_in';
		$datato['where'] = array(
			'patlog__hrms.entity__employee_in.employee_in_id' => $request_pic_contract_id
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$division_id = $R1->division_id;
		}else{
			$division_id = null;
		}
		
		$arr_pic_approval = array();
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
			$arr_pic_approval[] = '<option value="'.urlencode($R1->approval_id).'" '.$selected.'>'.$R1->approval_name.'</option>';
		}
		
		$arr_pic_contract_request = array();
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
			$arr_pic_contract_request[] = '<option value="'.urlencode($R1->request_id).'" '.$selected.'>'.$R1->request_name.'</option>';
		}
		
		$arr_pic_contract_request_description = array();
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
			$arr_pic_contract_request_description[] = '<option value="'.urlencode($R1->request_description_id).'" '.$selected.'>'.$R1->request_description_name.'</option>';
		}
		
		$data['isi'] = '
			<style>
				.select2-dropdown {  
					z-index: 10060 !important;/*1051;*/
				}
			</style>
		
			<form method="post" action="'.site_url('module_procurement/admin_functions/request_finish/'.$this->input->post('request_id')).'" enctype="multipart/form-data">
				<input type="hidden" name="'.$this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'" required="">
				<div class="modal-header">
					<button class="close" data-dismiss="modal">
						&times;
					</button>
					<h4 class="modal-title">Konfirmasi</h4>
				</div>
				<div class="modal-body">
					<p>
						Apakah anda yakin telah menyelesaikan proses <b>Pengadaan ini?</b><br/>
						'.$message.'<br/>
					</p>
					<div class="form-group">
						<label>Kirim ke Modul Kontrak ? <span class="text-danger">*</span></label>
						<select class="form-control select2" name="request_status_legal" style="width:100%;" required >
							<option selected disabled value="">--Pilih--</option>
							<option value="'.urlencode('yes').'">Ya</option>
							<option value="'.urlencode('no').'">Tidak</option>
						</select>
						<span class="help-block m-b-none small"><span class="text-warning">*</span> Jika memilik <b>Tidak</b>, bisa dilakukan kirim di menu arsip.</span>
					</div>
					<div class="form-group">
						<label>PIC Modul Kontrak <span class="text-danger">*</span></label>
						<select class="form-control select2" name="request_pic_contract_id" id="request_pic_contract_id" style="width:100%;" required >
							<option selected value="">--Pilih--</option>
							'.implode('',$arr_pic_name).'
						</select>
					</div>
					<div class="form-group">
						<label>Approval Modul Kontrak <span class="text-danger">*</span></label>
						<select class="form-control select2" name="request_pic_contract_approval_id" id="request_pic_contract_approval_id" style="width:100%;" required >
							<option selected value="">--Pilih--</option>
							'.implode('',$arr_pic_approval).'
						</select>
					</div>
					<div class="form-group">
						<label>Jenis Permintaan Kontrak <span class="text-danger">*</span></label>
						<select class="form-control select2" name="request_pic_contract_request_id" id="request_pic_contract_request_id" style="width:100%;" required >
							<option selected value="">--Pilih--</option>
							'.implode('',$arr_pic_contract_request).'
						</select>
					</div>
					<div class="form-group">
						<label>Deskripsi Permintaan Kontrak <span class="text-danger">*</span></label>
						<select class="form-control select2" name="request_pic_contract_request_description_id" id="request_pic_contract_request_description_id" style="width:100%;" required >
							<option selected value="">--Pilih--</option>
							'.implode('',$arr_pic_contract_request_description).'
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-success" type="submit"> Ya</button>
					<button class="btn btn-default" data-dismiss="modal"> Tidak</button>
				</div>
			</form>
			
			<script type="text/javascript">
			
				$(".select2").select2({
					theme: "bootstrap"
				});
				
				$("#request_pic_contract_id").change(function(){
					$.ajax({
						type: "POST",
						data: {
							"request_pic_contract_id" : $("#request_pic_contract_id").val(),
							"'.$this->security->get_csrf_token_name().'": "'.$this->security->get_csrf_hash().'"
						},
						url: "'.site_url('module_procurement/admin_functions/get_dropdown_approval_contract/').'",
						success: function(result){
							var data = JSON.parse(result);
							$("#request_pic_contract_approval_id").val("").trigger("change");
							$("#request_pic_contract_approval_id").html(data["request_pic_contract_approval_id"]);
						}
					});
				});
				
				$("#request_pic_contract_request_id").change(function(){
					$.ajax({
						type: "POST",
						data: {
							contract_request_id: $("#request_pic_contract_request_id").val(),
							"'.$this->security->get_csrf_token_name().'": "'.$this->security->get_csrf_hash().'"
						},
						url: "'.site_url('module_procurement/admin_functions/get_dropdown_request_description/').'",
						success: function(result){
							var data = JSON.parse(result);
							$("#request_pic_contract_request_description_id").val("").trigger("change");
							$("#request_pic_contract_request_description_id").html(data["contract_request_description_id"]);
						}
					});
				});
				
			</script>
		';
		
		echo json_encode($data, true);
	}
	
	public function get_modal_submit()
	{
		$decrypt_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->post('request_legal_id'));
		$request_legal_id = $this->encrypt->decode($decrypt_id);
		
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__request_legal';
		$datato['where'] = array(
			'patlog__procurement.entity__request_legal.request_legal_id' => $request_legal_id
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$request_id = $R1->request_id;
		}else{
			$request_id = null;
		}
		
		$request_pic_contract_id = null;
		$request_pic_contract_name = null;
		$request_pic_contract_approval_id = null;
		$request_pic_contract_approval_name = null;
		$request_pic_contract_request_id = null;
		$request_pic_contract_request_name = null;
		$request_pic_contract_request_description_id = null;
		$request_pic_contract_request_description_name = null;
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__request';
		$datato['where'] = array(
			'patlog__procurement.entity__request.request_id' => $request_id
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$request_pic_contract_id = $R1->request_pic_contract_id;
			$request_pic_contract_name = $R1->request_pic_contract_name;
			$request_pic_contract_approval_id = $R1->request_pic_contract_approval_id;
			$request_pic_contract_approval_name = $R1->request_pic_contract_approval_name;
			$request_pic_contract_request_id = $R1->request_pic_contract_request_id;
			$request_pic_contract_request_name = $R1->request_pic_contract_request_name;
			$request_pic_contract_request_description_id = $R1->request_pic_contract_request_description_id;
			$request_pic_contract_request_description_name = $R1->request_pic_contract_request_description_name;
			if($R1->vendor_id != null){
				$message = '<b class="text-navy">Anda sudah menentukan pemenang.</b>';
			}else{
				$message = '<b class="text-danger">Anda belum memiliki pemenang !</b>';
			}
		}else{			
			$message = '<b class="text-danger">Anda belum memiliki pemenang !</b>';
		}
		
		$arr_pic_name = array();
		unset($datato);
		$datato['table'] = 'patlog__hrms.entity__employee_in';	
		$datato['where_in'] = array(
			'patlog__hrms.entity__employee_in.employee_in_position',
			'patlog__hrms.entity__employee_in.employee_in_status'
		);
		$datato['where_in_data'] = array(
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
			$arr_pic_name[] = '<option value="'.urlencode($R1->employee_in_id).'" '.$selected.'>'.$R1->employee_in_code.' | '.$R1->employee_in_name.'</option>';
		}
		
		unset($datato);
		$datato['table'] = 'patlog__hrms.entity__employee_in';
		$datato['where'] = array(
			'patlog__hrms.entity__employee_in.employee_in_id' => $request_pic_contract_id
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$division_id = $R1->division_id;
		}else{
			$division_id = null;
		}
		
		$arr_pic_approval = array();
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
			$arr_pic_approval[] = '<option value="'.urlencode($R1->approval_id).'" '.$selected.'>'.$R1->approval_name.'</option>';
		}
		
		$arr_pic_contract_request = array();
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
			$arr_pic_contract_request[] = '<option value="'.urlencode($R1->request_id).'" '.$selected.'>'.$R1->request_name.'</option>';
		}
		
		$arr_pic_contract_request_description = array();
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
			$arr_pic_contract_request_description[] = '<option value="'.urlencode($R1->request_description_id).'" '.$selected.'>'.$R1->request_description_name.'</option>';
		}
		
		$template = '
			<div class="form-group">
				<label>PIC Modul Kontrak <span class="text-danger">*</span></label>
				<select class="form-control select2" name="request_pic_contract_id" id="request_pic_contract_id" style="width:100%;" required >
					<option selected value="">--Pilih--</option>
					'.implode('',$arr_pic_name).'
				</select>
			</div>
			<div class="form-group">
				<label>Approval Modul Kontrak <span class="text-danger">*</span></label>
				<select class="form-control select2" name="request_pic_contract_approval_id" id="request_pic_contract_approval_id" style="width:100%;" required >
					<option selected value="">--Pilih--</option>
					'.implode('',$arr_pic_approval).'
				</select>
			</div>
			<div class="form-group">
				<label>Jenis Permintaan Kontrak <span class="text-danger">*</span></label>
				<select class="form-control select2" name="request_pic_contract_request_id" id="request_pic_contract_request_id" style="width:100%;" required >
					<option selected value="">--Pilih--</option>
					'.implode('',$arr_pic_contract_request).'
				</select>
			</div>
			<div class="form-group">
				<label>Deskripsi Permintaan Kontrak <span class="text-danger">*</span></label>
				<select class="form-control select2" name="request_pic_contract_request_description_id" id="request_pic_contract_request_description_id" style="width:100%;" required >
					<option selected value="">--Pilih--</option>
					'.implode('',$arr_pic_contract_request_description).'
				</select>
			</div>
		';
		
		$data['isi'] = '
			<style>
				.select2-dropdown {  
					z-index: 10060 !important;/*1051;*/
				}
			</style>
		
			<form method="post" action="'.site_url('module_procurement/admin_functions/request_submit/'.$this->input->post('request_legal_id')).'" enctype="multipart/form-data">
				<input type="hidden" name="'.$this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'" required="">
				<input type="hidden" name="page" value="'.$this->uri->segment(4).'" required="">
				<div class="modal-header">
					<button class="close" data-dismiss="modal">
						&times;
					</button>
					<h4 class="modal-title">Konfirmasi</h4>
				</div>
				<div class="modal-body">
					<p>Anda yakin melanjukan proses ini ke modul kontrak ?</p>
					'.$template.'
				</div>
				<div class="modal-footer">
					<button class="btn btn-success" type="submit"> Ya</button>
					<button class="btn btn-default" data-dismiss="modal"> Tidak</button>
				</div>
			</form>
			
			<script type="text/javascript">
			
				$(".select2").select2({
					theme: "bootstrap"
				});
				
				$("#request_pic_contract_id").change(function(){
					$.ajax({
						type: "POST",
						data: {
							"request_pic_contract_id" : $("#request_pic_contract_id").val(),
							"'.$this->security->get_csrf_token_name().'": "'.$this->security->get_csrf_hash().'"
						},
						url: "'.site_url('module_procurement/admin_functions/get_dropdown_approval_contract/').'",
						success: function(result){
							var data = JSON.parse(result);
							$("#request_pic_contract_approval_id").val("").trigger("change");
							$("#request_pic_contract_approval_id").html(data["request_pic_contract_approval_id"]);
						}
					});
				});
				
				$("#request_pic_contract_request_id").change(function(){
					$.ajax({
						type: "POST",
						data: {
							contract_request_id: $("#request_pic_contract_request_id").val(),
							"'.$this->security->get_csrf_token_name().'": "'.$this->security->get_csrf_hash().'"
						},
						url: "'.site_url('module_procurement/admin_functions/get_dropdown_request_description/').'",
						success: function(result){
							var data = JSON.parse(result);
							$("#request_pic_contract_request_description_id").val("").trigger("change");
							$("#request_pic_contract_request_description_id").html(data["contract_request_description_id"]);
						}
					});
				});
				
			</script>
		';
		
		echo json_encode($data, true);
	}
	
	public function send_email_request($id, $employee_id_to, $employee_name_from, $message=null)
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
				$datato['table'] = 'patlog__procurement.entity__request';
				$datato['where'] = array(
					'patlog__procurement.entity__request.request_id' => $id
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
							Data permintaan pengadaan '.$R2->request_code.' telah diajukan oleh '.$employee_name_from.'.<br/><br/>
							Jenis Permintaan : '.$R2->request_category_name.'<br/>
							Nama Proyek : '.$R2->request_source_code_description.'<br/>
							Nominal : '.$R2->request_currency.'. '.number_format($R2->request_grandtotal_estimate,0,',','.').'
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
						$datato['log_email_name'] = 'Procurement - Create';
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
				$datato['table'] = 'patlog__procurement.entity__request';
				$datato['where'] = array(
					'patlog__procurement.entity__request.request_id' => $id
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
							Data permintaan pengadaan '.$R2->request_code.' telah diapprove oleh '.$employee_name_from.'.<br/><br/>
							Jenis Permintaan : '.$R2->request_category_name.'<br/>
							Nama Proyek : '.$R2->request_source_code_description.'<br/>
							Nominal : '.$R2->request_currency.'. '.number_format($R2->request_grandtotal_estimate,0,',','.').'
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
						$datato['log_email_name'] = 'Procurement - Approve';
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
				$datato['table'] = 'patlog__procurement.entity__request';
				$datato['where'] = array(
					'patlog__procurement.entity__request.request_id' => $id
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
							Data permintaan pengadaan '.$R2->request_code.' telah direject oleh '.$employee_name_from.'.<br/><br/>
							Jenis Permintaan : '.$R2->request_category_name.'<br/>
							Nama Proyek : '.$R2->request_source_code_description.'<br/>
							Nominal : '.$R2->request_currency.'. '.number_format($R2->request_grandtotal_estimate,0,',','.').'
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
						$datato['log_email_name'] = 'Procurement - Approve';
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
	
	public function send_email_mapping($id, $employee_id_to, $employee_name_from, $message=null)
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
				$datato['table'] = 'patlog__procurement.entity__request';
				$datato['where'] = array(
					'patlog__procurement.entity__request.request_id' => $id
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
							Data permintaan pengadaan '.$R2->request_code.' telah dimapping ke '.$employee_name_from.'.<br/><br/>
							Jenis Permintaan : '.$R2->request_category_name.'<br/>
							Nama Proyek : '.$R2->request_source_code_description.'<br/>
							Nominal : '.$R2->request_currency.'. '.number_format($R2->request_grandtotal_estimate,0,',','.').'
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
						$datato['log_email_name'] = 'Procurement - Mapping';
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
	
	public function send_email_undo($id, $employee_id_to, $employee_name_from, $message=null)
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
				$datato['table'] = 'patlog__procurement.entity__request';
				$datato['where'] = array(
					'patlog__procurement.entity__request.request_id' => $id
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
							Data permintaan pengadaan '.$R2->request_code.' telah dikembalikan ke '.$employee_name_from.'.<br/><br/>
							Jenis Permintaan : '.$R2->request_category_name.'<br/>
							Nama Proyek : '.$R2->request_source_code_description.'<br/>
							Nominal : '.$R2->request_currency.'. '.number_format($R2->request_grandtotal_estimate,0,',','.').'
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
						$datato['log_email_name'] = 'Procurement - Back';
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
	
	public function send_email_cancel($id, $employee_id_to, $employee_name_from, $message=null)
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
				$datato['table'] = 'patlog__procurement.entity__request';
				$datato['where'] = array(
					'patlog__procurement.entity__request.request_id' => $id
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
							Data permintaan pengadaan '.$R2->request_code.' telah dibatalkan oleh '.$employee_name_from.'.<br/><br/>
							Jenis Permintaan : '.$R2->request_category_name.'<br/>
							Nama Proyek : '.$R2->request_source_code_description.'<br/>
							Nominal : '.$R2->request_currency.'. '.number_format($R2->request_grandtotal_estimate,0,',','.').'
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
						$datato['log_email_name'] = 'Procurement - Approve';
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
	
	public function send_email_finish($id, $message=null)
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
				$datato['table'] = 'patlog__procurement.entity__request';
				$datato['where'] = array(
					'patlog__procurement.entity__request.request_id' => $id
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					
					$arr_email_to = array();
					unset($datato);
					$datato['select'] = '
						patlog__hrms.entity__employee_in.employee_in_email 
					';
					$datato['table'] = 'patlog__hrms.entity__employee_in';
					$datato['where'] = array(
						'patlog__hrms.entity__employee_in.employee_in_id' => $R2->employee_in_id
					);
					$Q3 = $this->view->view_data($datato);
					if($Q3->num_rows()){
						$R3 = $Q3->row();
						$arr_email_to[] = $R3->employee_in_email;
					}
					
					unset($datato);
					$datato['table'] = 'patlog__procurement.entity__request_approval';
					$datato['where'] = array(
						'patlog__procurement.entity__request_approval.request_id' => $R2->request_id
					);
					$datato['group'] = array(
						'patlog__procurement.entity__request_approval.request_approval_employee_in_id'
					);
					$Q3 = $this->view->view_data($datato);
					foreach($Q3->result() as $R3){
						unset($datato);
						$datato['select'] = '
							patlog__hrms.entity__employee_in.employee_in_email 
						';
						$datato['table'] = 'patlog__hrms.entity__employee_in';
						$datato['where'] = array(
							'patlog__hrms.entity__employee_in.employee_in_id' => $R3->request_approval_employee_in_id
						);
						$Q4 = $this->view->view_data($datato);
						if($Q4->num_rows()){
							$R4 = $Q4->row();
							$arr_email_to[] = $R4->employee_in_email;
						}
					}
					
					$arr_email_to = array_unique($arr_email_to);
					
					if(count($arr_email_to) > 0){
						if($message != null){
							$note = '<br/><small>Keterangan : '.$message.'</small>';
						}else{
							$note = '<br/>';
						}
						
						$employee_to = $R2->employee_in_name;
						$employee_from = $R2->request_proc_employee_in_name;
						$message = '
							Dear '.$employee_to.'<br/><br/>
							Data permintaan pengadaan '.$R2->request_code.' telah diselesaikan oleh '.$employee_from.'.<br/><br/>
							Jenis Permintaan : '.$R2->request_category_name.'<br/>
							Nama Proyek : '.$R2->request_source_code_description.'<br/>
							Nominal : '.$R2->request_currency.'. '.number_format($R2->request_grandtotal_estimate,0,',','.').'
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
						$body = $this->load->view('email/finish', $data, TRUE);
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
						$datato['log_email_name'] = 'Procurement - Kirim Selesai';
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
		$datato['table'] = 'patlog__procurement.entity__request';
		$datato['where'] = array(
			'patlog__procurement.entity__request.request_id' => $id
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			
			unset($config);
			$config['cacheable'] = true; //boolean, the default is true
			$config['cachedir'] = 'assets/mod__procurement/attach/request-qr/cache/'; //string, the default is application/cache/
			$config['errorlog'] = 'assets/mod__procurement/attach/request-qr/error_log/'; //string, the default is application/logs/
			$config['imagedir'] = 'assets/mod__procurement/attach/request-qr/'; //direktori penyimpanan qr code
			$config['quality'] = true; //boolean, the default is true
			$config['size'] = '1024'; //interger, the default is 1024
			$config['black'] = array(224,255,255); // array, default is array(255,255,255)
			$config['white'] = array(70,130,180); // array, default is array(0,0,0)
			$this->ciqrcode->initialize($config);
			
			$image_name = 'request-qr-'.md5($R1->request_id).'.png'; //buat name dari qr code sesuai dengan nim
			$encrypt_id = $this->encrypt->encode($R1->request_id);
            $request_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $encrypt_id);
			$params['data'] = site_url('module_procurement/admin/lacak_permintaan/'.$request_id); //data yang akan di jadikan QR CODE
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
			$font = realpath('assets/mod__procurement/public/arial.ttf');
			// Add the text
			// imagettftext($im, 20, 0, 63, 20, $black, $font, $params['data']);
			$this->imagecopymerge_alpha($main, $QR, 0, 0, 0, 0, $QR_width, $QR_height, 100);
			// $this->imagecopymerge_alpha($main, $im, 0, $QR_width, 0, 0, $QR_width, $space, 100);
			imagepng($main, $config['imagedir'].$image_name);
			
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__request';
			$datato['request_qr'] = $image_name;
			$datato['field'] = 'request_id';
			$datato['id'] = $R1->request_id;
			$this->mod->update($datato);
		}
	}
	
	public function func_generate_qr_contract($id)
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
			$params['data'] = site_url('module_contract/admin/lacak_kontrak/'.$contract_id); //data yang akan di jadikan QR CODE
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
	
	public function func_delete_dir($dir)
	{
		if (!is_dir($dir)) {  
			return false;
		}  
	
		$items = scandir($dir);  
		foreach ($items as $item) { 
			if ($item == '.' || $item == '..') {  
				continue;  
			}  
			$path = $dir . DIRECTORY_SEPARATOR . $item; 
			if (is_dir($path)) {  
				$this->func_delete_dir($path);  
			} else {
				unlink($path);  
			}  
		}  
		
		return rmdir($dir);
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
	
	public function api_to_contract($id, $vendor_id, $request_legal_id)
	{
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__request';
		$datato['table_join'] = array(
			'patlog__procurement.entity__request_legal' 
		);
		$datato['table_join_on'] = array(
			'patlog__procurement.entity__request' 
		);
		$datato['join_id'] = array(
			'request_id' 
		);
		$datato['join_type'] = array(
			'inner' 
		);
		$datato['where'] = array(
			'patlog__procurement.entity__request.request_id' => $id,
			'patlog__procurement.entity__request_legal.request_legal_id' => $request_legal_id,
			'patlog__procurement.entity__request_legal.vendor_id' => $vendor_id,
			'patlog__procurement.entity__request_legal.contract_id is null' => null
		);
		$Q0 = $this->view->view_data($datato);
		if($Q0->num_rows()){
			$R0 = $Q0->row();
				
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__category';
			$datato['where'] = array(
				'patlog__contract.entity__category.category_id' => 1
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
				'patlog__contract.entity__request.request_id' => $R0->request_pic_contract_request_id
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
				'patlog__contract.entity__request_description.request_description_id' => $R0->request_pic_contract_request_description_id
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
			
			if($R0->cost_category_id == 2){
				unset($datato);
				$datato['table'] = 'patlog__project.entity__project_code';
				$datato['where'] = array(
					'patlog__project.entity__project_code.project_code_id' => $R0->request_source_id
				);
				$Q1 = $this->view->view_data($datato);
				if($Q1->num_rows()){
					$R1 = $Q1->row();
					$contract_project_code_id = $R1->project_code_id;
					$contract_project_code_name = $R1->project_code_name;
					$contract_project_code_description = $R1->project_code_description;
				}
				
				$contract_project_code_category = 'External';
			}elseif($R0->cost_category_id == 1){
				unset($datato);
				$datato['table'] = 'patlog__project.entity__cost_center';
				$datato['where'] = array(
					'patlog__project.entity__cost_center.cost_center_id' => $R0->request_source_id
				);
				$Q1 = $this->view->view_data($datato);
				if($Q1->num_rows()){
					$R1 = $Q1->row();
					$contract_project_code_id = $R1->cost_center_id;
					$contract_project_code_name = $R1->cost_center_name;
					$contract_project_code_description = $R1->cost_center_description;
				}
				
				$contract_project_code_category = 'Internal';
			}
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_legal';
			$datato['where'] = array(
				'patlog__procurement.entity__request_legal.request_id' => $R0->request_id,
				'patlog__procurement.entity__request_legal.vendor_id' => $vendor_id
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				$contract_company_name = $R1->vendor_name;
				$contract_user_name = $R1->request_legal_user_name;
				$contract_user_position = $R1->request_legal_user_position;
				$contract_date_start = $R1->request_legal_date_start;
				$contract_date_end = $R1->request_legal_date_end;
				$start_date = new DateTime($contract_date_start);
				$end_date = new DateTime($contract_date_end);
				$contract_period = $start_date->diff($end_date)->days;
				$contract_period = $contract_period + 1;
				$contract_project_cost = $R1->request_legal_total_estimate;
			}else{
				$contract_company_name = null;
				$contract_user_name = null;
				$contract_user_position = null;
				$contract_date_start = null;
				$contract_date_end = null;
				$contract_period = null;
				$contract_project_cost = 0;
			}
			
			$contract_project_currency = $R0->request_currency;
			
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__third_party';
			$datato['where'] = array(
				'patlog__contract.entity__third_party.third_party_id' => 2
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
				'patlog__hrms.entity__employee_in.employee_in_id' => $R0->request_pic_contract_id
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
				'patlog__config.entity__approval_detail.approval_id' => $R0->request_pic_contract_approval_id
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
			
			if($contract_project_currency == 'IDR'){
				$currency = 'Rupiah';
			}elseif($contract_project_currency == 'USD'){
				$currency = 'Dollar';
			}
			$contract_project_calculate = ucwords($this->func_calculate($contract_project_cost)).' '.$currency;
			
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
			$datato['contract_project_code_category'] = $contract_project_code_category;
			$datato['contract_project_code_id'] = $contract_project_code_id;
			$datato['contract_project_code_name'] = $contract_project_code_name;
			$datato['contract_project_code_description'] = $contract_project_code_description;
			$datato['contract_date_start'] = $contract_date_start;
			$datato['contract_date_end'] = $contract_date_end;
			$datato['contract_period'] = $contract_period;
			$datato['contract_project_currency'] = $contract_project_currency;
			$datato['contract_project_cost'] = $contract_project_cost;
			$datato['contract_project_calculate'] = $contract_project_calculate;
			$datato['contract_project_note'] = $R0->request_note;
			$datato['contract_third_party_id'] = $contract_third_party_id;
			$datato['contract_third_party_name'] = $contract_third_party_name;
			$datato['contract_company_name'] = $contract_company_name;
			$datato['contract_user_name'] = $contract_user_name;
			$datato['contract_user_position'] = $contract_user_position;
			$datato['contract_document_in'] = 'no.pdf';
			$datato['contract_summary_file_name'] = 'no.pdf';
			$datato['contract_summary_file_ttd'] = 'no.pdf';
			$datato['contract_summary_file_final'] = 'no.pdf';
			$datato['contract_approval_select_id'] = $contract_approval_select_id;
			$datato['contract_approval_select_name'] = $contract_approval_select_name;
			$datato['contract_approval_current_id'] = $contract_approval_current_id;
			$datato['contract_approval_current_name'] = $contract_approval_current_name;
			$datato['contract_approval_current_category'] = $contract_approval_current_category;
			$datato['contract_approval_current_sign'] = $contract_approval_current_sign;
			$datato['contract_data_id'] = $R0->request_id;
			$datato['contract_data_code'] = $R0->request_code;
			$datato['contract_data_from'] = 'Procurement';
			$datato['contract_approver_level'] = 1;
			$datato['contract_approver_message'] = '<div class="badge badge-default">Waiting</div> &bull; '.$contract_approval_current_name;
			$datato['contract_status_delete'] = 'no';
			$datato['contract_status_done'] = 'no';
			$datato['contract_insert'] = date('Y-m-d H:i:s');
			$contract_id = $this->mod->insert($datato);
			
			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__request_legal';
			$datato['contract_id'] = $contract_id;
			$datato['contract_no'] = $contract_no;
			$datato['request_legal_status'] = 'Sudah Kirim';
			$datato['field'] = 'request_legal_id';
			$datato['id'] = $request_legal_id;
			$this->mod->update($datato);
			
			unset($datato);
			$datato['table'] = 'patlog__config.entity__approval_detail';
			$datato['where'] = array(
				'patlog__config.entity__approval_detail.approval_id' => $contract_approval_select_id
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
			
			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_document';
			$datato['where'] = array(
				'patlog__procurement.entity__request_document.request_id' => $R0->request_id
			);
			$Q1 = $this->view->view_data($datato);
			foreach($Q1->result() as $R1){
				if($R1->request_document_file != 'no.pdf'){
					unset($datato);
					$datato['database'] = 'patlog__contract';
					$datato['table'] = 'entity__contract_attachment';
					$datato['contract_id'] = $contract_id;
					$datato['contract_attachment_name'] = $R1->request_document_name;
					$datato['contract_attachment_file'] = 'no.pdf';
					$datato['contract_attachment_insert'] = date('Y-m-d H:i:s');
					$contract_attachment_id = $this->mod->insert($datato);
					
					$ext = pathinfo($R1->request_document_file, PATHINFO_EXTENSION);
					$path_old = './assets/mod__procurement/attach/request-document-file/';
					$file_name = 'contract-attachment-file-'.md5($contract_id).'-'.md5($contract_attachment_id).'.'.$ext;
					$path = './assets/mod__contract/attach/contract-attachment-file/'.$file_name;
					if(file_exists($path_old.$R1->request_document_file)){
						copy($path_old.$R1->request_document_file, $path);
					}else{
						$file_name = 'no.pdf';
					}
					
					unset($datato);
					$datato['database'] = 'patlog__contract';
					$datato['table'] = 'entity__contract_attachment';
					$datato['contract_attachment_file'] = $file_name;
					$datato['field'] = 'contract_attachment_id';
					$datato['id'] = $contract_attachment_id;
					$this->mod->update($datato);
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
			
			$this->func_generate_qr_contract($contract_id);
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
		}
	}
	
	public function api_to_contract_update($id, $vendor_id, $request_legal_id)
	{
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__request';
		$datato['table_join'] = array(
			'patlog__procurement.entity__request_legal' 
		);
		$datato['table_join_on'] = array(
			'patlog__procurement.entity__request' 
		);
		$datato['join_id'] = array(
			'request_id' 
		);
		$datato['join_type'] = array(
			'inner' 
		);
		$datato['where'] = array(
			'patlog__procurement.entity__request.request_id' => $id,
			'patlog__procurement.entity__request_legal.request_legal_id' => $request_legal_id,
			'patlog__procurement.entity__request_legal.vendor_id' => $vendor_id
		);
		$Q0 = $this->view->view_data($datato);
		if($Q0->num_rows()){
			$R0 = $Q0->row();
			
			unset($datato);
			$datato['table'] = 'patlog__contract.entity__contract';
			$datato['where'] = array(
				'patlog__contract.entity__contract.contract_data_id' => $R0->request_id,
				'patlog__contract.entity__contract.contract_company_name' => $R0->vendor_name
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$R1 = $Q1->row();
				
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__category';
				$datato['where'] = array(
					'patlog__contract.entity__category.category_id' => 1
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
					'patlog__contract.entity__request.request_id' => $R0->request_pic_contract_request_id
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
					'patlog__contract.entity__request_description.request_description_id' => $R0->request_pic_contract_request_description_id
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
				
				if($R0->cost_category_id == 2){
					unset($datato);
					$datato['table'] = 'patlog__project.entity__project_code';
					$datato['where'] = array(
						'patlog__project.entity__project_code.project_code_id' => $R0->request_source_id
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						$contract_project_code_id = $R2->project_code_id;
						$contract_project_code_name = $R2->project_code_name;
						$contract_project_code_description = $R2->project_code_description;
					}
					
					$contract_project_code_category = 'External';
				}elseif($R0->cost_category_id == 1){
					unset($datato);
					$datato['table'] = 'patlog__project.entity__cost_center';
					$datato['where'] = array(
						'patlog__project.entity__cost_center.cost_center_id' => $R0->request_source_id
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						$contract_project_code_id = $R2->cost_center_id;
						$contract_project_code_name = $R2->cost_center_name;
						$contract_project_code_description = $R2->cost_center_description;
					}
					
					$contract_project_code_category = 'Internal';
				}
				
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__request_legal';
				$datato['where'] = array(
					'patlog__procurement.entity__request_legal.request_id' => $R0->request_id,
					'patlog__procurement.entity__request_legal.vendor_id' => $vendor_id
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$contract_company_name = $R2->vendor_name;
					$contract_user_name = $R2->request_legal_user_name;
					$contract_user_position = $R2->request_legal_user_position;
					$contract_date_start = $R2->request_legal_date_start;
					$contract_date_end = $R2->request_legal_date_end;
					$start_date = new DateTime($contract_date_start);
					$end_date = new DateTime($contract_date_end);
					$contract_period = $start_date->diff($end_date)->days;
					$contract_period = $contract_period + 1;
					$contract_project_cost = $R2->request_legal_total_estimate;
				}else{
					$contract_company_name = null;
					$contract_user_name = null;
					$contract_user_position = null;
					$contract_date_start = null;
					$contract_date_end = null;
					$contract_period = null;
					$contract_project_cost = 0;
				}
				
				$contract_project_currency = $R0->request_currency;
				
				unset($datato);
				$datato['table'] = 'patlog__contract.entity__third_party';
				$datato['where'] = array(
					'patlog__contract.entity__third_party.third_party_id' => 2
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
					'patlog__hrms.entity__employee_in.employee_in_id' => $R0->request_pic_contract_id
				);
				$Q2 = $this->view->view_data($datato);
				if($Q2->num_rows()){
					$R2 = $Q2->row();
					$contract_creator_division_id = $R2->division_id;
					$contract_creator_division_name = $R2->division_name;
					$contract_creator_employee_in_id = $R2->employee_in_id;
					$contract_creator_employee_in_code = $R2->employee_in_code;
					$contract_creator_employee_in_name = $R2->employee_in_name;
					$contract_creator_employee_in_position = $R2->employee_in_position;
					$contract_creator_employee_in_position_detail = $R2->employee_in_position_detail;
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
					'patlog__config.entity__approval_detail.approval_id' => $R0->request_pic_contract_approval_id
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
				
				if($contract_project_currency == 'IDR'){
					$currency = 'Rupiah';
				}elseif($contract_project_currency == 'USD'){
					$currency = 'Dollar';
				}
				$contract_project_calculate = ucwords($this->func_calculate($contract_project_cost)).' '.$currency;
				
				unset($datato);
				$datato['database'] = 'patlog__contract';
				$datato['table'] = 'entity__contract';
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
				$datato['contract_project_code_category'] = $contract_project_code_category;
				$datato['contract_project_code_id'] = $contract_project_code_id;
				$datato['contract_project_code_name'] = $contract_project_code_name;
				$datato['contract_project_code_description'] = $contract_project_code_description;
				$datato['contract_date_start'] = $contract_date_start;
				$datato['contract_date_end'] = $contract_date_end;
				$datato['contract_period'] = $contract_period;
				$datato['contract_project_currency'] = $contract_project_currency;
				$datato['contract_project_cost'] = $contract_project_cost;
				$datato['contract_project_calculate'] = $contract_project_calculate;
				$datato['contract_project_note'] = $R0->request_note;
				$datato['contract_third_party_id'] = $contract_third_party_id;
				$datato['contract_third_party_name'] = $contract_third_party_name;
				$datato['contract_company_name'] = $contract_company_name;
				$datato['contract_user_name'] = $contract_user_name;
				$datato['contract_user_position'] = $contract_user_position;
				if($R1->contract_approver_level == 0){
					$datato['contract_approval_select_id'] = $contract_approval_select_id;
					$datato['contract_approval_select_name'] = $contract_approval_select_name;
					$datato['contract_approval_current_id'] = $contract_approval_current_id;
					$datato['contract_approval_current_name'] = $contract_approval_current_name;
					$datato['contract_approval_current_category'] = $contract_approval_current_category;
					$datato['contract_approval_current_sign'] = $contract_approval_current_sign;
					$datato['contract_approver_level'] = 1;
					$datato['contract_approver_message'] = '<div class="badge badge-default">Waiting</div> &bull; '.$contract_approval_current_name;
				}
				$datato['contract_status_delete'] = 'no';
				$datato['contract_status_done'] = 'no';
				$datato['field'] = 'contract_id';
				$datato['id'] = $R1->contract_id;
				$this->mod->update($datato);
				
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request_legal';
				$datato['contract_id'] = $R1->contract_id;
				$datato['contract_no'] = $R1->contract_no;
				$datato['request_legal_status'] = 'Sudah Kirim';
				$datato['field'] = 'request_legal_id';
				$datato['id'] = $request_legal_id;
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
				
				unset($datato);
				$datato['table'] = 'patlog__procurement.entity__request_document';
				$datato['where'] = array(
					'patlog__procurement.entity__request_document.request_id' => $R0->request_id
				);
				$Q2 = $this->view->view_data($datato);
				foreach($Q2->result() as $R2){
					if($R2->request_document_file != 'no.pdf'){
						unset($datato);
						$datato['table'] = 'patlog__contract.entity__contract_attachment';
						$datato['where'] = array(
							'patlog__contract.entity__contract_attachment.contract_id' => $R1->contract_id,
							'patlog__contract.entity__contract_attachment.contract_attachment_name' => $R2->request_document_name
						);
						$Q3 = $this->view->view_data($datato);
						if($Q3->num_rows()){
							$R3 = $Q3->row();
							$contract_attachment_id = $R3->contract_attachment_id;
						}else{
							unset($datato);
							$datato['database'] = 'patlog__contract';
							$datato['table'] = 'entity__contract_attachment';
							$datato['contract_id'] = $R1->contract_id;
							$datato['contract_attachment_name'] = $R2->request_document_name;
							$datato['contract_attachment_file'] = 'no.pdf';
							$datato['contract_attachment_insert'] = date('Y-m-d H:i:s');
							$contract_attachment_id = $this->mod->insert($datato);
						}
						
						$ext = pathinfo($R2->request_document_file, PATHINFO_EXTENSION);
						$path_old = './assets/mod__procurement/attach/request-document-file/';
						$file_name = 'contract-attachment-file-'.md5($R1->contract_id).'-'.md5($contract_attachment_id).'.'.$ext;
						$path = './assets/mod__contract/attach/contract-attachment-file/'.$file_name;
						if(file_exists($path_old.$R2->request_document_file)){
							copy($path_old.$R2->request_document_file, $path);
						}else{
							$file_name = 'no.pdf';
						}
						
						unset($datato);
						$datato['database'] = 'patlog__contract';
						$datato['table'] = 'entity__contract_attachment';
						$datato['contract_attachment_file'] = $file_name;
						$datato['field'] = 'contract_attachment_id';
						$datato['id'] = $contract_attachment_id;
						$this->mod->update($datato);
					}
				}
				
				if($R1->contract_approver_level == 0){
					unset($datato);
					$datato['table'] = 'patlog__contract.entity__contract_log';
					$datato['where'] = array(
						'patlog__contract.entity__contract_log.contract_id' => $R1->contract_id
					);
					$Q2 = $this->view->view_data($datato);
					$contract_log_approver_level = $Q2->num_rows() + 1;
					
					unset($datato);
					$datato['table'] = 'patlog__hrms.entity__employee_in';
					$datato['where'] = array(
						'patlog__hrms.entity__employee_in.employee_in_id' => $R1->contract_creator_employee_in_id
					);
					$Q2 = $this->view->view_data($datato);
					if($Q2->num_rows()){
						$R2 = $Q2->row();
						$contract_log_employee_position_detail = $R2->employee_in_position_detail;
					}else{
						$contract_log_employee_position_detail = null;
					}
					
					unset($datato);
					$datato['database'] = 'patlog__contract';
					$datato['table'] = 'entity__contract_log';
					$datato['contract_id'] = $R1->contract_id;
					$datato['contract_log_approver_level'] = $contract_log_approver_level;
					$datato['contract_log_employee_code'] = $R1->contract_creator_employee_in_code;
					$datato['contract_log_employee_name'] = $R1->contract_creator_employee_in_name;
					$datato['contract_log_employee_position_detail'] = $contract_log_employee_position_detail;
					$datato['contract_log_status'] = 'Edited';
					$datato['contract_log_insert'] = date('Y-m-d H:i:s');
					$this->mod->insert($datato);
				}
				
				$this->func_generate_qr_contract($R1->contract_id);
				$this->print_contract($R1->contract_id);
				
				if($R1->contract_approver_level == 0){
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
			}
		}
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
			$pdf->Cell(60,5,': '.number_format($R1->contract_project_cost,0,',','.'),0,1);
			
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

	public function get_document_history()
	{
		$request_document_id = $this->input->get('request_document_id');
		$request_id = $this->input->get('request_id');
		$kind = $this->input->get('kind');
		if(!$kind){ $kind = 'document'; }

		$rows = array();
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__request_document_history';
		$where = array(
			'patlog__procurement.entity__request_document_history.request_document_history_kind' => $kind
		);
		if($kind == 'loket_process'){
			$where['patlog__procurement.entity__request_document_history.request_id'] = $request_id;
		}else{
			$where['patlog__procurement.entity__request_document_history.request_document_id'] = $request_document_id;
		}
		$datato['where'] = $where;
		$datato['order'] = array('patlog__procurement.entity__request_document_history.request_document_history_id');
		$datato['order_type'] = array('desc');
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$dir = ($kind == 'loket_process') ? 'request-process-document' : 'request-document-file';
			foreach($Q1->result() as $R1){
				$rows[] = array(
					'action' => $R1->request_document_history_action,
					'file' => $R1->request_document_history_file,
					'file_url' => base_url('assets/mod__procurement/attach/'.$dir.'/history/'.$R1->request_document_history_file),
					'by_name' => $R1->request_document_history_by_name,
					'by_role' => $R1->request_document_history_by_role,
					'note' => $R1->request_document_history_note,
					'created_date' => $R1->request_document_history_created_date,
				);
			}
		}
		header('Content-Type: application/json');
		echo json_encode(array('status' => 'OK', 'data' => $rows));
	}

	private function _archive_request_document_version($request_document_id, $request_id, $current_file, $action, $by_id, $by_name, $by_role, $note = null, $kind = 'document', $source_dir = './assets/mod__procurement/attach/request-document-file/')
	{
		if($current_file == null || $current_file === '' || $current_file == 'no.pdf'){
			return;
		}
		$current_path = rtrim($source_dir,'/').'/'.$current_file;
		if(!file_exists($current_path)){
			return;
		}
		$old_ext = pathinfo($current_file, PATHINFO_EXTENSION);
		$key = $request_document_id !== null ? $request_document_id : ('rp'.$request_id);
		$history_file = 'history-'.md5($key).'-'.date('YmdHis').'-'.substr(md5(mt_rand()),0,6).'.'.$old_ext;
		$history_dir = rtrim($source_dir,'/').'/history/';
		if(!is_dir($history_dir)){
			@mkdir($history_dir, 0777, true);
		}
		if(!@copy($current_path, $history_dir.$history_file)){
			return;
		}
		unset($datato);
		$datato['database'] = 'patlog__procurement';
		$datato['table'] = 'entity__request_document_history';
		$datato['request_document_id'] = $request_document_id;
		$datato['request_id'] = $request_id;
		$datato['request_document_history_kind'] = $kind;
		$datato['request_document_history_file'] = $history_file;
		$datato['request_document_history_action'] = $action;
		$datato['request_document_history_by_id'] = $by_id;
		$datato['request_document_history_by_name'] = $by_name;
		$datato['request_document_history_by_role'] = $by_role;
		$datato['request_document_history_note'] = $note;
		$datato['request_document_history_created_date'] = date('Y-m-d H:i:s');
		$this->mod->insert($datato);
	}

	private function _get_current_admin_for_audit()
	{
		$admin_id = null;
		$admin_name = 'Admin';
		if(isset($_SESSION) && is_array($_SESSION)){
			foreach($_SESSION as $key => $val){
				if(is_string($key) && substr($key, -3) === '_id' && !is_array($val) && $val !== ''){
					$maybe_id = base64_decode($val, true);
					if($maybe_id !== false && is_numeric($maybe_id)){
						unset($datato);
						$datato['table'] = 'patlog__config.entity__user_admin';
						$datato['where'] = array(
							'patlog__config.entity__user_admin.user_admin_id' => $maybe_id
						);
						$Q = $this->view->view_data($datato);
						if($Q->num_rows()){
							$R = $Q->row();
							$admin_id = $R->user_admin_id;
							$admin_name = $R->user_admin_name;
							break;
						}
					}
				}
			}
		}
		return array('id' => $admin_id, 'name' => $admin_name);
	}

	public function adjust_winner()
	{
		if($this->session->userdata('role')){
			$this->session->set_flashdata('danger', 'Anda tidak memiliki akses ke fitur ini.');
			redirect(site_url('module_procurement/admin/penyesuaian_pemenang/'));
			return;
		}

		$action = $this->uri->segment(4);
		if(!in_array($action, array('add','delete'))){
			$this->session->set_flashdata('danger', 'Aksi tidak valid.');
			redirect(site_url('module_procurement/admin/penyesuaian_pemenang/'));
			return;
		}

		$reason = trim((string)$this->input->post('adjustment_reason'));
		if(strlen($reason) < 10){
			$this->session->set_flashdata('danger', 'Alasan penyesuaian wajib diisi minimal 10 karakter.');
			redirect(site_url('module_procurement/admin/penyesuaian_pemenang/'));
			return;
		}

		$process_proc_id_win = null;
		$process_proc_name_win = null;
		unset($datato);
		$datato['table'] = 'patlog__procurement.data__process_proc';
		$datato['where'] = array(
			'patlog__procurement.data__process_proc.process_proc_flag' => 'yes'
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$R1 = $Q1->row();
			$process_proc_id_win = $R1->process_proc_id;
			$process_proc_name_win = $R1->process_proc_name;
		}
		if($process_proc_id_win === null){
			$this->session->set_flashdata('danger', 'Tahap pemenang belum dikonfigurasi pada master proses pengadaan.');
			redirect(site_url('module_procurement/admin/penyesuaian_pemenang/'));
			return;
		}

		$admin = $this->_get_current_admin_for_audit();

		if($action === 'add'){
			$decrypt = str_replace(array('-','_','~'), array('+','/','='), $this->uri->segment(5));
			$request_legal_id = $this->encrypt->decode($decrypt);

			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_legal';
			$datato['where'] = array(
				'patlog__procurement.entity__request_legal.request_legal_id' => $request_legal_id
			);
			$Q1 = $this->view->view_data($datato);
			if(!$Q1->num_rows()){
				$this->session->set_flashdata('danger', 'Data vendor tidak ditemukan.');
				redirect(site_url('module_procurement/admin/penyesuaian_pemenang/'));
				return;
			}
			$RL = $Q1->row();

			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request';
			$datato['where'] = array(
				'patlog__procurement.entity__request.request_id' => $RL->request_id,
				'patlog__procurement.entity__request.request_is_finish' => 1,
				'patlog__procurement.entity__request.request_is_delete' => 0
			);
			$Q1 = $this->view->view_data($datato);
			if(!$Q1->num_rows()){
				$this->session->set_flashdata('danger', 'Pengadaan tidak ditemukan atau belum berstatus selesai.');
				redirect(site_url('module_procurement/admin/penyesuaian_pemenang/'));
				return;
			}
			$RR = $Q1->row();

			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_process';
			$datato['where'] = array(
				'patlog__procurement.entity__request_process.request_id' => $RL->request_id,
				'patlog__procurement.entity__request_process.vendor_id' => $RL->vendor_id,
				'patlog__procurement.entity__request_process.process_proc_id' => $process_proc_id_win
			);
			$Q1 = $this->view->view_data($datato);
			if($Q1->num_rows()){
				$encrypt_id = $this->encrypt->encode($RL->request_id);
				$enc = str_replace(array('+','/','='), array('-','_','~'), $encrypt_id);
				$this->session->set_flashdata('danger', 'Vendor sudah berstatus pemenang.');
				redirect(site_url('module_procurement/admin/penyesuaian_pemenang/').'?view=detail&request_id='.$enc);
				return;
			}

			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__request';
			$datato['request_status_information'] = $process_proc_name_win;
			$datato['field'] = 'request_id';
			$datato['id'] = $RL->request_id;
			$this->mod->update($datato);

			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__request_process';
			$datato['request_id'] = $RL->request_id;
			$datato['vendor_id'] = $RL->vendor_id;
			$datato['vendor_name'] = $RL->vendor_name;
			$datato['process_proc_id'] = $process_proc_id_win;
			$datato['request_process_proc_name'] = $process_proc_name_win;
			$datato['request_process_proc_date'] = date('Y-m-d');
			$datato['request_process_proc_time'] = date('H:i:s');
			$datato['request_process_note'] = 'Penyesuaian oleh '.$admin['name'].'. Alasan: '.$reason;
			$datato['request_process_created_date'] = date('Y-m-d H:i:s');
			$request_process_id = $this->mod->insert($datato);

			if($RR->vendor_id == null){
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request';
				$datato['vendor_id'] = $RL->vendor_id;
				$datato['request_vendor_name'] = $RL->vendor_name;
				$datato['field'] = 'request_id';
				$datato['id'] = $RL->request_id;
				$this->mod->update($datato);
			}

			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_log';
			$datato['where'] = array(
				'patlog__procurement.entity__request_log.request_id' => $RL->request_id
			);
			$log_level = $this->view->view_data($datato)->num_rows() + 1;

			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__request_log';
			$datato['request_id'] = $RL->request_id;
			$datato['request_log_level'] = $log_level;
			$datato['request_log_name'] = $admin['name'];
			$datato['request_log_status'] = 'Penyesuaian Pemenang';
			$datato['request_log_message'] = 'TAMBAH pemenang: '.$RL->vendor_name.'. Alasan: '.$reason;
			$datato['request_log_created_date'] = date('Y-m-d H:i:s');
			$this->mod->insert($datato);

			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__winner_adjustment_log';
			$datato['request_id'] = $RL->request_id;
			$datato['request_legal_id'] = $RL->request_legal_id;
			$datato['request_process_id'] = $request_process_id;
			$datato['vendor_id'] = $RL->vendor_id;
			$datato['vendor_name'] = $RL->vendor_name;
			$datato['winner_adjustment_action'] = 'add';
			$datato['winner_adjustment_reason'] = $reason;
			$datato['winner_adjustment_by_user_admin_id'] = $admin['id'];
			$datato['winner_adjustment_by_user_admin_name'] = $admin['name'];
			$datato['winner_adjustment_created_date'] = date('Y-m-d H:i:s');
			$this->mod->insert($datato);

			$encrypt_id = $this->encrypt->encode($RL->request_id);
			$enc = str_replace(array('+','/','='), array('-','_','~'), $encrypt_id);
			$this->session->set_flashdata('success', 'Vendor '.$RL->vendor_name.' berhasil ditambahkan sebagai pemenang.');
			redirect(site_url('module_procurement/admin/penyesuaian_pemenang/').'?view=detail&request_id='.$enc);
			return;
		}

		if($action === 'delete'){
			$decrypt = str_replace(array('-','_','~'), array('+','/','='), $this->uri->segment(5));
			$request_process_id = $this->encrypt->decode($decrypt);

			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_process';
			$datato['where'] = array(
				'patlog__procurement.entity__request_process.request_process_id' => $request_process_id
			);
			$Q1 = $this->view->view_data($datato);
			if(!$Q1->num_rows()){
				$this->session->set_flashdata('danger', 'Data proses tidak ditemukan.');
				redirect(site_url('module_procurement/admin/penyesuaian_pemenang/'));
				return;
			}
			$RP = $Q1->row();

			if($RP->process_proc_id != $process_proc_id_win){
				$encrypt_id = $this->encrypt->encode($RP->request_id);
				$enc = str_replace(array('+','/','='), array('-','_','~'), $encrypt_id);
				$this->session->set_flashdata('danger', 'Baris yang dipilih bukan baris pemenang.');
				redirect(site_url('module_procurement/admin/penyesuaian_pemenang/').'?view=detail&request_id='.$enc);
				return;
			}

			$request_id = $RP->request_id;
			$vendor_id = $RP->vendor_id;
			$vendor_name = $RP->vendor_name;

			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_legal';
			$datato['where'] = array(
				'patlog__procurement.entity__request_legal.request_id' => $request_id,
				'patlog__procurement.entity__request_legal.vendor_id' => $vendor_id
			);
			$Q1 = $this->view->view_data($datato);
			$request_legal_id_log = $Q1->num_rows() ? $Q1->row()->request_legal_id : null;

			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_process';
			$datato['where'] = array(
				'patlog__procurement.entity__request_process.request_id' => $request_id,
				'patlog__procurement.entity__request_process.process_proc_id' => $process_proc_id_win
			);
			$Qall = $this->view->view_data($datato);
			$other_winners = array();
			foreach($Qall->result() as $rw){
				if($rw->request_process_id != $request_process_id){
					$other_winners[] = $rw;
				}
			}

			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request';
			$datato['where'] = array(
				'patlog__procurement.entity__request.request_id' => $request_id
			);
			$QR = $this->view->view_data($datato);
			$RR = $QR->num_rows() ? $QR->row() : null;

			if(count($other_winners) == 0){
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request';
				$datato['vendor_id'] = null;
				$datato['request_vendor_name'] = null;
				$datato['field'] = 'request_id';
				$datato['id'] = $request_id;
				$this->mod->update($datato);
			}elseif($RR && $RR->vendor_id == $vendor_id){
				$next = $other_winners[0];
				unset($datato);
				$datato['database'] = 'patlog__procurement';
				$datato['table'] = 'entity__request';
				$datato['vendor_id'] = $next->vendor_id;
				$datato['request_vendor_name'] = $next->vendor_name;
				$datato['field'] = 'request_id';
				$datato['id'] = $request_id;
				$this->mod->update($datato);
			}

			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_process_attach';
			$datato['where'] = array(
				'patlog__procurement.entity__request_process_attach.request_process_id' => $request_process_id
			);
			$Qatt = $this->view->view_data($datato);
			foreach($Qatt->result() as $RA){
				if(file_exists('./assets/mod__procurement/attach/request_process_attach/'.$RA->request_process_attach_file) and $RA->request_process_attach_file != 'no.pdf'){
					unlink('./assets/mod__procurement/attach/request_process_attach/'.$RA->request_process_attach_file);
				}
			}

			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__request_process_attach';
			$datato['field'] = 'request_process_id';
			$datato['id'] = $request_process_id;
			$this->mod->delete($datato);

			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__request_process';
			$datato['field'] = 'request_process_id';
			$datato['id'] = $request_process_id;
			$this->mod->delete($datato);

			unset($datato);
			$datato['table'] = 'patlog__procurement.entity__request_log';
			$datato['where'] = array(
				'patlog__procurement.entity__request_log.request_id' => $request_id
			);
			$log_level = $this->view->view_data($datato)->num_rows() + 1;

			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__request_log';
			$datato['request_id'] = $request_id;
			$datato['request_log_level'] = $log_level;
			$datato['request_log_name'] = $admin['name'];
			$datato['request_log_status'] = 'Penyesuaian Pemenang';
			$datato['request_log_message'] = 'HAPUS pemenang: '.$vendor_name.'. Alasan: '.$reason;
			$datato['request_log_created_date'] = date('Y-m-d H:i:s');
			$this->mod->insert($datato);

			unset($datato);
			$datato['database'] = 'patlog__procurement';
			$datato['table'] = 'entity__winner_adjustment_log';
			$datato['request_id'] = $request_id;
			$datato['request_legal_id'] = $request_legal_id_log;
			$datato['request_process_id'] = $request_process_id;
			$datato['vendor_id'] = $vendor_id;
			$datato['vendor_name'] = $vendor_name;
			$datato['winner_adjustment_action'] = 'delete';
			$datato['winner_adjustment_reason'] = $reason;
			$datato['winner_adjustment_by_user_admin_id'] = $admin['id'];
			$datato['winner_adjustment_by_user_admin_name'] = $admin['name'];
			$datato['winner_adjustment_created_date'] = date('Y-m-d H:i:s');
			$this->mod->insert($datato);

			$encrypt_id = $this->encrypt->encode($request_id);
			$enc = str_replace(array('+','/','='), array('-','_','~'), $encrypt_id);
			$this->session->set_flashdata('success', 'Status pemenang vendor '.$vendor_name.' berhasil dicabut.');
			redirect(site_url('module_procurement/admin/penyesuaian_pemenang/').'?view=detail&request_id='.$enc);
			return;
		}
	}

	public function get_table_penyesuaian_pemenang()
	{
		$process_proc_id_win = null;
		unset($datato);
		$datato['table'] = 'patlog__procurement.data__process_proc';
		$datato['where'] = array(
			'patlog__procurement.data__process_proc.process_proc_flag' => 'yes'
		);
		$Q1 = $this->view->view_data($datato);
		if($Q1->num_rows()){
			$process_proc_id_win = $Q1->row()->process_proc_id;
		}

		$data = array();
		unset($datato);
		$datato['table'] = 'patlog__procurement.entity__request';
		$datato['where'] = array(
			'patlog__procurement.entity__request.request_is_finish' => 1,
			'patlog__procurement.entity__request.request_is_delete' => 0
		);
		$datato['order'] = array('patlog__procurement.entity__request.request_is_finish_date');
		$datato['order_type'] = array('desc');
		$Q1 = $this->view->view_data($datato);
		foreach($Q1->result() as $R1){
			$encrypt_id = $this->encrypt->encode($R1->request_id);
			$enc_request_id = str_replace(array('+','/','='), array('-','_','~'), $encrypt_id);

			$winners = array();
			if($process_proc_id_win !== null){
				unset($datato2);
				$datato2['table'] = 'patlog__procurement.entity__request_process';
				$datato2['where'] = array(
					'patlog__procurement.entity__request_process.request_id' => $R1->request_id,
					'patlog__procurement.entity__request_process.process_proc_id' => $process_proc_id_win
				);
				$Q2 = $this->view->view_data($datato2);
				foreach($Q2->result() as $R2){
					$winners[] = $R2->vendor_name;
				}
			}
			$winner_html = count($winners) > 0
				? '<b>'.implode('<br/>',$winners).'</b>'
				: '<span class="text-muted"><i>Belum ada pemenang</i></span>';

			$row = array();
			$row[] = '<b>'.$R1->request_code.'</b>';
			$row[] = $R1->request_category_name.' / '.$R1->request_type_name;
			$row[] = $R1->request_employee_in_name.'<br/><small>'.$R1->request_division_name.'</small>';
			$row[] = $R1->request_proc_employee_in_name;
			$row[] = $winner_html;
			$row[] = $R1->request_is_finish_date;
			$row[] = '<a class="btn btn-sm btn-primary" href="'.site_url('module_procurement/admin/penyesuaian_pemenang/?view=detail&request_id='.$enc_request_id).'"><i class="fa fa-edit"></i> Pilih</a>';
			$data[] = $row;
		}

		$output = array(
			'draw' => isset($_POST['draw']) ? $_POST['draw'] : 0,
			'recordsTotal' => count($data),
			'recordsFiltered' => count($data),
			'data' => $data
		);
		echo json_encode($output);
	}

}
?>