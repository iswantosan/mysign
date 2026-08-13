<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Employee extends MX_Controller{
	
	public function __construct(){
		parent::__construct();
		
	}
	
	public function beranda()
	{
		$this->load->view('employee/header');
		$this->load->view('employee/page/beranda');
		$this->load->view('employee/footer');
	}
	
	public function dashboard()
	{
		$this->load->view('employee/header');
		$this->load->view('employee/page/dashboard');
		$this->load->view('employee/footer');
	}

	public function formulir()
	{
		$this->load->view('employee/header');
		$this->load->view('employee/page/formulir');
		$this->load->view('employee/footer');
	}
	
	public function proses_kontrak_utama()
	{
		$this->load->view('employee/header');
		$this->load->view('employee/page/proses_kontrak_utama');
		$this->load->view('employee/footer');
	}
	
	public function lacak_kontrak()
	{
		$this->load->view('employee/page/lacak_kontrak');
	}
	
	public function monitoring()
	{
		$this->load->view('employee/header');
		$this->load->view('employee/page/monitoring');
		$this->load->view('employee/footer');
	}

	public function monitoring_kontrak()
	{
		// Access gate: employee must be in the whitelist.
		$employee_id_b64 = $this->session->userdata('employee_id');
		$employee_in_id  = $employee_id_b64 ? (int) base64_decode($employee_id_b64) : 0;
		$has_access = false;
		if ($employee_in_id > 0) {
			$row = $this->db
				->query("SELECT 1 FROM patlog__contract.entity__monitoring_kontrak_access WHERE employee_in_id = ? LIMIT 1", array($employee_in_id))
				->row();
			$has_access = (bool) $row;
		}
		if (! $has_access) {
			$this->session->set_flashdata('danger', 'Anda tidak memiliki akses ke Monitoring Kontrak. Hubungi admin.');
			redirect(site_url('module_contract/employee/beranda/'));
			return;
		}
		$this->load->view('employee/header');
		$this->load->view('employee/page/monitoring_kontrak');
		$this->load->view('employee/footer');
	}
	
	public function arsip_kontrak_utama()
	{
		$this->load->view('employee/header');
		$this->load->view('employee/page/arsip_kontrak_utama');
		$this->load->view('employee/footer');
	}
	
	public function laporan()
	{
		$this->load->view('employee/header');
		$this->load->view('employee/page/laporan');
		$this->load->view('employee/footer');
	}
	
	public function impor()
	{
		$this->load->view('employee/header');
		$this->load->view('employee/page/impor');
		$this->load->view('employee/footer');
	}
	
	public function ttd_digital()
	{
		$this->load->view('employee/page/ttd_digital');
	}

	public function data_proses()
	{
		$this->load->view('employee/header');
		$this->load->view('employee/page/data_proses');
		$this->load->view('employee/footer');
	}

	public function data_permintaan()
	{
		$this->load->view('employee/header');
		$this->load->view('employee/page/data_permintaan');
		$this->load->view('employee/footer');
	}

	public function data_detail_permintaan()
	{
		$this->load->view('employee/header');
		$this->load->view('employee/page/data_detail_permintaan');
		$this->load->view('employee/footer');
	}

	public function data_pihak_ketiga()
	{
		$this->load->view('employee/header');
		$this->load->view('employee/page/data_pihak_ketiga');
		$this->load->view('employee/footer');
	}
	
	public function data_dokumen()
	{
		$this->load->view('employee/header');
		$this->load->view('employee/page/data_dokumen');
		$this->load->view('employee/footer');
	}
	
	public function data_template()
	{
		$this->load->view('employee/header');
		$this->load->view('employee/page/data_template');
		$this->load->view('employee/footer');
	}
	
	public function data_user_reviewer()
	{
		$this->load->view('employee/header');
		$this->load->view('employee/page/data_user_reviewer');
		$this->load->view('employee/footer');
	}
	
	public function notifikasi()
	{
		$this->load->view('employee/header');
		$this->load->view('employee/page/notifikasi');
		$this->load->view('employee/footer');
	}

}
?>
