<?php defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != 'login') redirect(base_url('login'));
        $this->load->model("m_user");
        $this->load->model("m_produk");
        $this->load->model("m_penjualan");
        $this->load->model("m_detail_penjualan");
    }

    public function index()
    {

        $data['title'] = 'Cajero - Penjualan';
        $data['username'] = $this->session->userdata('username');
        $data['produk'] = $this->m_produk->get_query("SELECT P.*, K.KategoriNama, S.SupplierNama FROM produk AS P, kategori AS K, supplier AS S WHERE P.KategoriID = K.KategoriID AND P.SupplierID = S.SupplierID");

        $this->load->view('components/vc_head', $data);
        $this->load->view('components/vc_wrapper', $data);
        $this->load->view('v_penjualan');
        $this->load->view('components/vc_modal_logout');
        $this->load->view('components/vc_footer');
        $this->load->view('components/vc_end');
    }

    public function checkout()
    {
        $status = false;
        $raw = file_get_contents('php://input');
        $user = $this->m_user->get_by_username($this->session->userdata('username'));
        $data = json_decode($raw);

        $data_penjualan['Tanggal'] = date("Y-m-d H:i:s");
        $data_penjualan['UserID'] = $user->UserID;

        if ($this->m_penjualan->insert($data_penjualan)) {
            $penjualan = $this->m_penjualan->get_query("SELECT * FROM penjualan ORDER BY PenjualanID DESC LIMIT 1");
            // var_dump($penjualan);
            for ($i = 0; $i < count($data) - 1; $i++) {
                $produk = $this->m_produk->get_by_id($data[$i]->ProdukID);

                $data_detail_penjualan['PenjualanID'] = $penjualan[0]->PenjualanID;
                $data_detail_penjualan['ProdukID'] = $data[$i]->ProdukID;
                $data_detail_penjualan['Jumlah'] = $data[$i]->Jumlah;

                $sisa_jumlah_produk = (int) $produk->Jumlah - (int) $data[$i]->Jumlah;

                if ($sisa_jumlah_produk < 0) {
                    // $this->session->set_flashdata('error', 'Transaksi Gagal!');
                    // var_dump((object) ['status' => 'No', 'message' => 'Transaksi gagal. Stok produk habis']);
                    $res = ['status' => 'No', 'message' => 'Transaksi gagal. Stok produk habis'];
                    header('Content-Type: application/json');
                    echo json_encode($res);
                    break;
                }

                $data_produk_baru['Jumlah'] = $sisa_jumlah_produk;

                $this->m_produk->update_query($data_produk_baru, $data[$i]->ProdukID);

                if ($this->m_detail_penjualan->insert($data_detail_penjualan)) {
                    $status = true;
                    // var_dump((object) ['status' => 'Ok', 'message' => 'Transaksi berhasil!']);
                } else {
                    // $this->session->set_flashdata('error', 'Transaksi Gagal!');
                    $res = ['status' => 'No', 'message' => 'Transaksi gagal'];
                    header('Content-Type: application/json');
                    echo json_encode($res);
                    break;
                }
            }
            if ($status == true) {
                // $this->session->set_flashdata('success', 'Transaksi berhasil!');
                $res = ['status' => 'Ok', 'message' => 'Transaksi berhasil!'];
                header('Content-Type: application/json');
                echo json_encode($res);
                helper_log("jual", "transaksi penjualan produk");
            }
        } else {
            $res = ['status' => 'Ok', 'message' => 'Transaksi berhasil!'];
            header('Content-Type: application/json');
            echo json_encode($res);
            helper_log("jual", "transaksi penjualan produk");
        }
    }
}
