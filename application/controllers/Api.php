<?php defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('status') != 'login') redirect(base_url('login'));
		// if ($this->session->userdata('kelas') != '1') redirect(base_url('penjualan'));

		$this->load->model('m_detail_penjualan');
		$this->load->model('m_kategori');
		$this->load->model('m_log');
		$this->load->model('m_penjualan');
		$this->load->model('m_produk');
		$this->load->model('m_supplier');
		$this->load->model('m_user');
	}

	public function index()
	{
		redirect(base_url('error404'));
	}

	public function transaksi()
	{
		header('Content-Type: application/json');
		$data['transaksi'] = $this->m_detail_penjualan->getSemuaTransaksi();
		echo json_encode($data);
	}

	public function produk()
	{
		header('Content-Type: application/json');
		$data['produk'] = $this->m_produk->get_query("SELECT P.*, K.KategoriNama, S.SupplierNama 
        FROM produk AS P, kategori AS K, supplier AS S 
        WHERE P.KategoriID = K.KategoriID AND P.SupplierID = S.SupplierID");
		echo json_encode($data);
	}

	public function kategori()
	{
		header('Content-Type: application/json');
		$data['kategori'] = array();
		foreach ($this->m_kategori->get_all() as $kategori) {
			array_push($data['kategori'], $this->m_kategori->get_query_row("SELECT K.*,COUNT(*) AS JumlahProduk FROM produk AS P , kategori AS K WHERE P.KategoriID = K.KategoriID AND P.KategoriID = " . $kategori->KategoriID));
		}
		echo json_encode($data);
	}

	public function supplier()
	{
		header('Content-Type: application/json');
		$data['suppliers'] = $this->m_supplier->get_all();
		echo json_encode($data);
	}

	public function user()
	{
		header('Content-Type: application/json');
		$data['users'] = $this->m_user->get_user();
		echo json_encode($data);
	}

	public function alert()
	{
		header('Content-Type: application/json');
		$data['stok'] = $this->m_produk->get_jumlah_alert();
		$data['user'] = $this->m_user->get_user_alert();
		echo json_encode($data);
	}
}
