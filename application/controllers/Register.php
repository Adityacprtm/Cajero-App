<?php defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_user');
		if ($this->session->userdata('status') == 'login') redirect(base_url('dashboard'));
	}

	public function index()
	{
		$data['title'] = 'Cajero - Register';
		$this->load->view('components/vc_head', $data);
		$this->load->view('v_register');
		$this->load->view('components/vc_end');
	}

	public function signup()
	{
		if (isset($_POST['submit'])) {
			$namaDepan = $this->input->post('nama-depan');
			$namaBelakang = $this->input->post('nama-belakang');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$repassword = $this->input->post('repassword');

			if ($this->m_user->get_by_username($username) > 0) {
				$this->session->set_flashdata('error', 'Username telah digunakan');
			} else {
				if ($password == $repassword) {
					$data = array(
						'NamaDepan' => $namaDepan,
						'NamaBelakang' => $namaBelakang,
						'Username' => $username,
						'Password' => password_hash($password, PASSWORD_DEFAULT),
						'Kelas' => 2,
						'Tanggal' => date("Y-m-d H:i:s"),
						'Status' => 2
					);
					if ($this->m_user->insert($data)) {
						$this->session->set_flashdata('success', 'Akun berhasil didaftarkan.<br>Menunggu <strong>Admin</strong> untuk menyetujui.');
						redirect(base_url('register'));
					} else {
						$this->session->set_flashdata('error', 'Oops, terjadi kesalahan');
						redirect(base_url('register'));
					}
				} else {
					$this->session->set_flashdata('error', 'Password tidak sama');
					redirect(base_url('register'));
				}
			}
		} else {
			show_error('Something Went Wrong!', 500);
		}
	}
}
