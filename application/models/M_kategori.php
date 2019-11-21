<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_kategori extends CI_Model
{

    private $_table = 'kategori';

    public function get_all()
    {
        return $this->db->get($this->_table)->result();
    }

    public function get_by_id($id = null)
    {
        return $this->db->get_where($this->_table, ["KategoriID" => $id])->row();
    }

    public function get_by_katagori($kategoriNama = null)
    {
        return $this->db->get_where($this->_table, ["KategoriNama" => $kategoriNama])->row();
    }

    public function get_query($query = null)
    {
        if (!$query) retrun;
        return $this->db->query($query)->result();
    }

    public function get_query_row($query = null)
    {
        if (!$query) retrun;
        return $this->db->query($query)->row();
    }

    public function insert($data = null)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function update($data_baru = null)
    {
        return $this->db->update($this->_table, $data_baru, array('KategoriID' => $this->input->post('kategori-id')));
    }

    public function delete($id = null)
    {
        return $this->db->delete($this->_table, array("KategoriID" => $id));
    }
}
