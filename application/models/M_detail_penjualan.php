<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_detail_penjualan extends CI_Model
{

    private $_table = 'detail_penjualan';

    public function getSemuaTransaksi()
    {
        $this->db->select('P.ProdukNama, DP.Jumlah, U.Username, PJ.Tanggal');
        $this->db->from('detail_penjualan as DP');
        $this->db->join('produk as P', 'DP.ProdukID = P.ProdukID');
        $this->db->join('penjualan as PJ', 'PJ.PenjualanID = DP.PenjualanID');
        $this->db->join('user as U', 'u.UserID = PJ.UserID');
        $this->db->order_by('PJ.Tanggal', 'desc');
        return $this->db->get()->result();
    }

    public function get_all()
    {
        return $this->db->get($this->_table)->result();
    }

    public function get_by_id($id = null)
    {
        return $this->db->get_where($this->_table, ["DetailPenjualanID" => $id])->row();
    }

    public function get_query($query = null)
    {
        return $this->db->query($query)->result();
    }

    public function insert($data = null)
    {
        return $this->db->insert($this->_table, $data);
    }
}
