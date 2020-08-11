<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("m_produk");
		$this->load->model("m_kategori");
		if ($this->session->userdata('status') != 'login' || $this->session->userdata('username') == null) redirect(base_url('login'));
	}

	public function index()
	{
		$data['title'] = 'Cajero - Kategori';
		$data['username'] = $this->session->userdata('username');

		$this->load->view('components/vc_head', $data);
		$this->load->view('components/vc_wrapper', $data);
		$this->load->view('v_kategori', $data);
		$this->load->view('components/vc_modal_logout');
		$this->load->view('components/vc_footer');
		$this->load->view('components/vc_end');
	}

	public function add()
	{
		if (isset($_POST['submit'])) {
			if (!$this->m_kategori->get_by_katagori($this->input->post("kategori"))) {
				$data['KategoriNama'] = $this->input->post("kategori");
				$data['Deskripsi'] = $this->input->post("deskripsi");
				if ($this->m_kategori->insert($data)) {
					$this->session->set_flashdata('success', 'Kategori <strong>' . $this->input->post("kategori") . '</strong> berhasil ditambahkan');
					helper_log("add", "menambahkan kategori " . $this->input->post("kategori"));
					redirect(base_url('kategori'));
				}
			} else {
				$this->session->set_flashdata('error', 'Kategori <strong>' . $this->input->post("kategori") . '</strong> sudah terdaftar');
				redirect(base_url('kategori/add'));
			}
		} else {
			$data['title'] = 'Cajero - Tambah Kategori';
			$data['username'] = $this->session->userdata('username');
			$data['kategori'] = $this->m_kategori->get_all();

			$this->load->view('components/vc_head', $data);
			$this->load->view('components/vc_wrapper', $data);
			$this->load->view('v_tambah_kategori', $data);
			$this->load->view('components/vc_modal_logout');
			$this->load->view('components/vc_footer');
			$this->load->view('components/vc_end');
		}
	}

	public function edit($id = null)
	{
		if (isset($_POST['submit'])) {
			$data_baru['KategoriNama'] = $this->input->post("kategori");
			$data_baru['Deskripsi'] = $this->input->post("deskripsi");
			if ($this->m_kategori->update($data_baru)) {
				$this->session->set_flashdata('success', 'Kategori <strong>' . $this->input->post("kategori") . '</strong> berhasil diubah');
				helper_log("edit", "mengubah kategori produk " . $this->input->post("kategori"));
				redirect(base_url('kategori'));
			}
			$this->session->set_flashdata('error', 'Oops! telah terjadi kesalahan');
			redirect(base_url('kategori'));
		} else {
			if (!isset($id)) redirect(base_url('kategori'));

			$data["kategori"] = $this->m_kategori->get_by_id($id);
			if (!$data["kategori"]) redirect(base_url('error404'));

			$data['title'] = 'Cajero - Edit kategori produk ' . $data["kategori"]->KategoriNama;
			$data['username'] = $this->session->userdata('username');
			$data['kategori_all'] = $this->m_kategori->get_all();

			$this->load->view('components/vc_head', $data);
			$this->load->view('components/vc_wrapper', $data);
			$this->load->view('v_edit_kategori', $data);
			$this->load->view('components/vc_modal_logout');
			$this->load->view('components/vc_footer');
			$this->load->view('components/vc_end');
		}
	}

	public function delete($id = null)
	{
		if (!isset($id)) redirect(base_url('kategori'));

		$data = $this->m_kategori->get_by_id($id);
		if (!$data) redirect(base_url('error404'));

		if ($this->m_kategori->delete($id)) {
			$this->session->set_flashdata('success', 'Kategori produk <strong>' . $data->KategoriNama . '</strong> berhasil dihapus');
			helper_log("delete", "menghapus kategori produk " . $data->KategoriNama);
			redirect(base_url('kategori'));
		}
	}
}
