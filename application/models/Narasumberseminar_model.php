<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Narasumberseminar_model extends CI_Model
{

	public $table = 'ssc_narasumber_seminar';
	public $id    = 'ns_id';

	function list($seminar)
	{
		$this->db->join('ssc_seminar', 'ssc_seminar.smr_id = ssc_narasumber_seminar.ns_seminar');
		$this->db->where('ns_seminar', $seminar);
		return $this->db->get($this->table)->result();
	}

	function listbyid($id)
	{
		$this->db->join('ssc_seminar', 'ssc_seminar.smr_id = ssc_narasumber_seminar.ns_seminar');
		$this->db->where($this->id, $id);
		return $this->db->get($this->table)->row();
	}

	function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}

	function update($id, $data)
	{
		$this->db->where($this->id, $id);
		return $this->db->update($this->table, $data);
	}

	function delete($id, $seminar)
	{
		$this->db->where($this->id, $id);
		$this->db->where('ns_seminar', $seminar);
		return $this->db->delete($this->table);
	}

	function cek_ttdsertifikatseminar($seminar)
	{
		$this->db->where('ns_seminar', $seminar);
		$this->db->where('ns_set_tandatangan', 'y');
		return $this->db->get($this->table);
	}

	function cek_ttdsertifikatseminarsamaid($narasumber, $seminar)
	{
		$this->db->where('ns_id !=', $narasumber);
		$this->db->where('ns_seminar', $seminar);
		$this->db->where('ns_set_tandatangan', 'y');
		return $this->db->get($this->table);
	}

	function gettandatangan($narasumber_id)
	{
		$this->db->where('ns_id', $narasumber_id);
		return $this->db->get($this->table)->row_array();
	}
}

/* End of file Narasumberseminar_model.php */
/* Location: ./application/models/Narasumberseminar_model.php */