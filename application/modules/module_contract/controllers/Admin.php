<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends MX_Controller{
	
	public function __construct(){
		parent::__construct();
		
	}
	
	public function beranda()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/page/beranda');
		$this->load->view('admin/footer');
	}
	
	public function dashboard()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/page/dashboard');
		$this->load->view('admin/footer');
	}

	public function formulir()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/page/formulir');
		$this->load->view('admin/footer');
	}
	
	public function proses_kontrak_utama()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/page/proses_kontrak_utama');
		$this->load->view('admin/footer');
	}
	
	public function lacak_kontrak()
	{
		$this->load->view('admin/page/lacak_kontrak');
	}
	
	public function monitoring()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/page/monitoring');
		$this->load->view('admin/footer');
	}

	public function monitoring_kontrak()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/page/monitoring_kontrak');
		$this->load->view('admin/footer');
	}
	
	public function arsip_kontrak_utama()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/page/arsip_kontrak_utama');
		$this->load->view('admin/footer');
	}
	
	public function laporan()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/page/laporan');
		$this->load->view('admin/footer');
	}
	
	public function impor()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/page/impor');
		$this->load->view('admin/footer');
	}
	
	public function ttd_digital()
	{
		$this->load->view('admin/page/ttd_digital');
	}

	public function data_proses()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/page/data_proses');
		$this->load->view('admin/footer');
	}

	public function data_permintaan()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/page/data_permintaan');
		$this->load->view('admin/footer');
	}

	public function data_detail_permintaan()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/page/data_detail_permintaan');
		$this->load->view('admin/footer');
	}

	public function data_pihak_ketiga()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/page/data_pihak_ketiga');
		$this->load->view('admin/footer');
	}
	
	public function data_dokumen()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/page/data_dokumen');
		$this->load->view('admin/footer');
	}
	
	public function data_template()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/page/data_template');
		$this->load->view('admin/footer');
	}
	
	public function data_user_reviewer()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/page/data_user_reviewer');
		$this->load->view('admin/footer');
	}
	
	public function data_pengingat()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/page/data_pengingat');
		$this->load->view('admin/footer');
	}
	
	public function data_konfigurasi()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/page/data_konfigurasi');
		$this->load->view('admin/footer');
	}
	
	public function fungsi_dokumen_temporary()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/page/fungsi_dokumen_temporary');
		$this->load->view('admin/footer');
	}
	
	public function fungsi_inject()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/page/fungsi_inject');
		$this->load->view('admin/footer');
	}
	
	public function fungsi_ke_loket()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/page/fungsi_ke_loket');
		$this->load->view('admin/footer');
	}
	
	public function fungsi_rollback()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/page/fungsi_rollback');
		$this->load->view('admin/footer');
	}
	
	public function fungsi_arsip()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/page/fungsi_arsip');
		$this->load->view('admin/footer');
	}

}
?>
