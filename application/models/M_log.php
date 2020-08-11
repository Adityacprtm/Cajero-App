<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_log extends CI_Model
{

	private $_table = 'log';

	public function save_log($param = null)
	{
		$sql = $this->db->insert_string($this->_table, $param);
		$ex = $this->db->query($sql);
		return $this->db->affected_rows($sql);
	}

	public function get_query($query = null)
	{
		if ($this->session->userdata('kelas') != 1) redirect(base_url('user'));
		return $this->db->query($query)->result();
	}

	public function get_query_by_user_id($query = null)
	{
		return $this->db->query($query)->result();
	}
}
