<?php defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
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
		$data['title'] = 'Cajero - Supplier';
		$data['username'] = $this->session->userdata('username');

		$this->load->view('components/vc_head', $data);
		$this->load->view('components/vc_wrapper', $data);
		$this->load->view('v_supplier', $data);
		$this->load->view('components/vc_modal_logout');
		$this->load->view('components/vc_footer');
		$this->load->view('components/vc_end');
	}

	public function add()
	{
		if (isset($_POST['submit'])) {
			if (!$this->m_supplier->get_by_supplier($this->input->post("supplier-nama"))) {
				$data['SupplierNama'] = $this->input->post("supplier-nama");
				$data['Alamat'] = $this->input->post("alamat");
				$data['Telepon'] = $this->input->post("telepon");
				if ($this->m_supplier->insert($data)) {
					$this->session->set_flashdata('success', 'Supplier <strong>' . $this->input->post("supplier-nama") . '</strong> berhasil ditambahkan');
					helper_log("add", "menambahkan supplier " . $this->input->post("supplier-nama"));
					redirect(base_url('supplier'));
				}
			} else {
				$this->session->set_flashdata('error', 'Supplier <strong>' . $this->input->post("supplier-nama") . '</strong> sudah terdaftar');
				redirect(base_url('supplier/add'));
			}
		} else {
			$data['title'] = 'Cajero - Tambah Supplier';
			$data['username'] = $this->session->userdata('username');
			$data['suppliers'] = $this->m_supplier->get_all();

			$this->load->view('components/vc_head', $data);
			$this->load->view('components/vc_wrapper', $data);
			$this->load->view('v_tambah_supplier', $data);
			$this->load->view('components/vc_modal_logout');
			$this->load->view('components/vc_footer');
			$this->load->view('components/vc_end');
		}
	}

	public function edit($id = null)
	{
		if (isset($_POST['submit'])) {
			$data_baru['SupplierNama'] = $this->input->post("supplier-nama");
			$data_baru['Alamat'] = $this->input->post("alamat");
			$data_baru['Telepon'] = $this->input->post("telepon");
			if ($this->m_supplier->update($data_baru)) {
				$this->session->set_flashdata('success', 'Supplier <strong>' . $this->input->post("supplier-nama") . '</strong> berhasil diubah');
				helper_log("edit", "mengubah data supplier " . $this->input->post("supplier-nama"));
				redirect(base_url('supplier'));
			}
			$this->session->set_flashdata('error', 'Oops! telah terjadi kesalahan.');
			redirect(base_url('supplier'));
		} else {
			if (!isset($id)) redirect(base_url('supplier'));

			$data["supplier"] = $this->m_supplier->get_by_id($id);
			if (!$data["supplier"]) redirect(base_url('error404'));

			$data['title'] = 'Cajero - Edit supplier ' . $data["supplier"]->SupplierNama;
			$data['username'] = $this->session->userdata('username');
			$data['suppliers'] = $this->m_supplier->get_all();

			$this->load->view('components/vc_head', $data);
			$this->load->view('components/vc_wrapper', $data);
			$this->load->view('v_edit_supplier', $data);
			$this->load->view('components/vc_modal_logout');
			$this->load->view('components/vc_footer');
			$this->load->view('components/vc_end');
		}
	}

	public function delete($id = null)
	{
		if (!isset($id)) redirect(base_url('supplier'));

		$supplier = $this->m_supplier->get_by_id($id);
		if (!$supplier) redirect(base_url('error404'));

		if ($this->m_supplier->delete($id)) {
			$this->session->set_flashdata('success', 'Supplier <strong>' . $supplier->SupplierNama . '</strong> berhasil dihapus');
			helper_log("delete", "menghapus supplier " . $supplier->SupplierNama);
			redirect(base_url('supplier'));
		}
	}
}
