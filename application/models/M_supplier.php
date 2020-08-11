<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_supplier extends CI_Model
{

	private $_table = 'supplier';

	public function get_all()
	{
		return $this->db->get($this->_table)->result();
	}

	public function get_by_id($id = null)
	{
		return $this->db->get_where($this->_table, ["SupplierID" => $id])->row();
	}

	public function get_by_supplier($supplier = null)
	{
		return $this->db->get_where($this->_table, ["SupplierNama" => $supplier])->row();
	}

	public function insert($data = null)
	{
		return $this->db->insert($this->_table, $data);
	}

	public function update($data_baru = null)
	{
		return $this->db->update($this->_table, $data_baru, array('SupplierID' => $this->input->post('supplier-id')));
	}

	public function delete($id = null)
	{
		return $this->db->delete($this->_table, array("SupplierID" => $id));
	}
}
