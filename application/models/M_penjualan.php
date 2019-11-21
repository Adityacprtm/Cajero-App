<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_penjualan extends CI_Model
{

    private $_table = 'penjualan';

    public function get_all()
    {
        return $this->db->get($this->_table)->result();
    }

    public function get_by_id($id = null)
    {
        return $this->db->get_where($this->_table, ["PenjualanID" => $id])->row();
    }

    public function get_query($query = null)
    {
        return $this->db->query($query)->result();
    }

    public function insert($data = null)
    {
        return $this->db->insert($this->_table, $data);
    }

    // public function update($data_baru = null)
    // {
    //     return $this->db->update($this->_table, $data_baru, array('ProdukID' => $this->input->post('produk-id')));
    // }

    // public function delete($id = null)
    // {
    //     return $this->db->delete($this->_table, array("ProdukID" => $id));
    // }
}
