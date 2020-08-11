<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_user extends CI_Model
{

	private $_table = 'user';

	public function get_all()
	{
		return $this->db->get($this->_table)->result();
	}

	//------------
	public function get_user()
	{
		$this->db->select('UserID,NamaDepan,NamaBelakang,Username,Kelas,Tanggal, Status');
		return $this->db->get($this->_table)->result();
	}

	public function get_by_username($username = null)
	{
		return $this->db->get_where($this->_table, ["Username" => $username])->row();
	}

	public function get_by_id($id = null)
	{
		return $this->db->get_where($this->_table, ["UserID" => $id])->row();
	}

	public function get_user_alert()
	{
		return $this->db->get_where($this->_table, ["Status =" => 2])->result();
	}

	public function insert($data = null)
	{
		return $this->db->insert($this->_table, $data);
	}

	public function update_profil($data = null, $id = null)
	{
		return $this->db->update($this->_table, $data, array('UserID' => $id));
	}

	public function update_password($password = null, $id = null)
	{
		return $this->db->update($this->_table, $password, array('UserID' => $id));
	}

	public function delete($id = null)
	{
		return $this->db->delete($this->_table, array("UserID" => $id));
	}
}
