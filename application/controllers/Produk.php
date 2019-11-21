<?php defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
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
        $data['title'] = 'Cajero - produk';
        $data['username'] = $this->session->userdata('username');

        $this->load->view('components/vc_head', $data);
        $this->load->view('components/vc_wrapper', $data);
        $this->load->view('v_produk', $data);
        $this->load->view('components/vc_modal_logout');
        $this->load->view('components/vc_footer');
        $this->load->view('components/vc_end');
    }

    public function add()
    {
        if (isset($_POST['submit'])) {
            $data['ProdukNama'] = $this->input->post("produk-nama");
            $data['KategoriID'] = $this->input->post("kategori");
            $data['SupplierID'] = $this->input->post("supplier");
            $data['Modal'] = $this->input->post("modal");
            $data['Harga'] = $this->input->post("harga");
            $data['Jumlah'] = $this->input->post("jumlah");
            $data['Unit'] = $this->input->post("unit");
            if ($this->m_produk->insert($data)) {
                $this->session->set_flashdata('success', 'Produk <strong>' . $this->input->post("produk-nama") . '</strong> berhasil ditambahkan');
                helper_log("add", "menambahkan produk " . $this->input->post("produk-nama"));
                redirect(base_url('produk'));
            }
        } else {
            $data['title'] = 'Cajero - Tambah produk';
            $data['username'] = $this->session->userdata('username');
            $data['kategori'] = $this->m_kategori->get_all();
            $data['supplier'] = $this->m_supplier->get_all();

            $this->load->view('components/vc_head', $data);
            $this->load->view('components/vc_wrapper', $data);
            $this->load->view('v_tambah_produk', $data);
            $this->load->view('components/vc_modal_logout');
            $this->load->view('components/vc_footer');
            $this->load->view('components/vc_end');
        }
    }

    public function edit($id = null)
    {
        if (isset($_POST['submit'])) {
            $data_baru['ProdukNama'] = $this->input->post("produk-nama");
            $data_baru['KategoriID'] = $this->input->post("kategori");
            $data_baru['SupplierID'] = $this->input->post("supplier");
            $data_baru['Modal'] = $this->input->post("modal");
            $data_baru['Harga'] = $this->input->post("harga");
            $data_baru['Jumlah'] = $this->input->post("jumlah");
            $data_baru['Unit'] = $this->input->post("unit");
            if ($this->m_produk->update($data_baru)) {
                $this->session->set_flashdata('success', 'Produk <strong>' . $this->input->post("produk-nama") . '</strong> berhasil diubah');
                helper_log("edit", "mengubah data produk " . $this->input->post("produk-nama"));
                redirect(base_url('produk'));
            }
        } else {
            if (!isset($id)) redirect(base_url('produk'));

            $data["produk"] = $this->m_produk->get_by_id($id);
            if (!$data["produk"]) redirect(base_url('error404'));

            $data['title'] = 'Cajero - Edit produk ' . $data["produk"]->ProdukNama;
            $data['username'] = $this->session->userdata('username');
            $data['kategori'] = $this->m_kategori->get_all();
            $data['supplier'] = $this->m_supplier->get_all();

            $this->load->view('components/vc_head', $data);
            $this->load->view('components/vc_wrapper', $data);
            $this->load->view('v_edit_produk', $data);
            $this->load->view('components/vc_modal_logout');
            $this->load->view('components/vc_footer');
            $this->load->view('components/vc_end');
        }
    }

    public function delete($id = null)
    {
        if (!isset($id)) redirect(base_url('produk'));

        $data = $this->m_produk->get_by_id($id);
        if (!$data) redirect(base_url('error404'));

        if ($this->m_produk->delete($id)) {
            $this->session->set_flashdata('success', 'Produk <strong>' . $data->ProdukNama . '</strong> berhasil dihapus');
            helper_log("delete", "menghapus produk " . $data->ProdukNama);
            redirect(base_url('produk'));
        }
    }
}
