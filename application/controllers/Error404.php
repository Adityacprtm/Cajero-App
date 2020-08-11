<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Error404 extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != 'login') redirect(base_url('login'));
		$this->load->model("m_produk");
	}

	public function index()
	{

		$data['title'] = 'Cajero - 404';
		$data['username'] = $this->session->userdata('username');

		$this->load->view('components/vc_head', $data);
		$this->load->view('components/vc_wrapper', $data);
		$this->load->view('v_404');
		$this->load->view('components/vc_modal_logout');
		$this->load->view('components/vc_footer');
		$this->load->view('components/vc_end');
	}
}
