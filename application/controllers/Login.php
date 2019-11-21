<?php defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_user');
	}

	public function index()
	{
		if ($this->session->userdata('status') == 'login') redirect(base_url('dashboard'));
		$data['title'] = 'Cajero - Login Page';
		$this->load->view('components/vc_head', $data);
		$this->load->view('v_login');
		$this->load->view('components/vc_end');
	}

	public function login()
	{
		if (isset($_POST['username']) && isset($_POST['password'])) {
			$username = $this->input->post('username');
			$userpass = $this->input->post('password');
			$sql = $this->m_user->get_by_username($username);
			if ($sql) {
				if ($sql->Status == 1) {
					if (password_verify($userpass, $sql->Password)) {
						$this->session->set_userdata(['username' => $sql->Username, 'kelas' => $sql->Kelas, 'status' => 'login']);
						helper_log("login", "login");
						redirect(base_url("dashboard"));
					} else {
						$this->session->set_flashdata('error', 'Password salah!');
						redirect(base_url('login'));
					}
				} elseif ($sql->Status == 2) {
					$this->session->set_flashdata('error', 'Status akun menunggu untuk disetujui Admin');
					redirect(base_url('login'));
				} elseif ($sql->Status == 3) {
					$this->session->set_flashdata('error', 'Akun ditolak oleh Admin');
					redirect(base_url('login'));
				}
			} else {
				$this->session->set_flashdata('error', 'Username / password tidak ditemukan');
				redirect(base_url('login'));
			}
		} else {
			show_error('Something Went Wrong!', 500);
		}
	}

	function logout()
	{
		helper_log("logout", "logout");
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}
