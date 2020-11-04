<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Narasumberseminar_model extends CI_Model {
	
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

	function delete($id)
	{
		$this->db->where($this->id, $id);
		return $this->db->delete($this->table);
	}

}

/* End of file Narasumberseminar_model.php */
/* Location: ./application/models/Narasumberseminar_model.php */