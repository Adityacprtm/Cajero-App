<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != 'login') redirect(base_url('login'));
        $this->load->model("m_produk");
        $this->load->model("m_detail_penjualan");
    }

    public function index()
    {

        if ($this->session->userdata('kelas') != 1) redirect(base_url('penjualan'));

        $data['title'] = 'Cajero - Dashboard';
        $data['username'] = $this->session->userdata('username');
        $data['summary'] = $this->m_detail_penjualan->get_query("SELECT P.ProdukID, P.ProdukNama, P.Modal, P.Harga, SUM(D.Jumlah) AS JumlahTerjual, (P.Modal * SUM(D.Jumlah)) AS TotalModal ,(P.Harga * SUM(D.Jumlah)) AS TotalPenjualan FROM detail_penjualan as D INNER JOIN produk as P ON P.ProdukID = D.ProdukID GROUP BY P.ProdukID");

        $this->load->view('components/vc_head', $data);
        $this->load->view('components/vc_wrapper', $data);
        $this->load->view('v_dashboard');
        $this->load->view('components/vc_modal_logout');
        $this->load->view('components/vc_footer');
        $this->load->view('components/vc_end');
    }
}
