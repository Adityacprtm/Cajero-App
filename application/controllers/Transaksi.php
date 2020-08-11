<?php defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("m_produk");
		$this->load->model("m_kategori");
		$this->load->model("m_supplier");
		if ($this->session->userdata('status') != 'login' || $this->session->userdata('username') == null) redirect(base_url('login'));
	}

	public function index()
	{
		$data['title'] = 'Cajero - transaksi';
		$data['username'] = $this->session->userdata('username');

		$this->load->view('components/vc_head', $data);
		$this->load->view('components/vc_wrapper', $data);
		$this->load->view('v_transaksi', $data);
		$this->load->view('components/vc_modal_logout');
		$this->load->view('components/vc_footer');
		$this->load->view('components/vc_end');
	}
}
