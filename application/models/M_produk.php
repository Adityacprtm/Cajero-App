<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_produk extends CI_Model
{

    private $_table = 'produk';

    public function get_all()
    {
        return $this->db->get($this->_table)->result();
    }

    public function get_by_id($id = null)
    {
        return $this->db->get_where($this->_table, ["ProdukID" => $id])->row();
    }

    public function get_jumlah_alert()
    {
        return $this->db->get_where($this->_table, ["Jumlah <" => getenv('BATAS_PERINGATAN')])->result();
    }

    public function get_query($query = null)
    {
        if (!$query) retrun;
        return $this->db->query($query)->result();
    }

    public function insert($data = null)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function update($data_baru = null)
    {
        return $this->db->update($this->_table, $data_baru, array('ProdukID' => $this->input->post('produk-id')));
    }

    public function update_query($data_baru = null, $id = null)
    {
        return $this->db->update($this->_table, $data_baru, array('ProdukID' => $id));
    }

    public function delete($id = null)
    {
        return $this->db->delete($this->_table, array("ProdukID" => $id));
    }
}
