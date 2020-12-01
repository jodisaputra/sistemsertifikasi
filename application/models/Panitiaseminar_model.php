<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panitiaseminar_model extends CI_Model
{

	public $table = 'ssc_panitia_seminar';
	public $id    = 'pan_id';

	function list($seminar)
	{
		$this->db->join('ssc_seminar', 'ssc_seminar.smr_id = ssc_panitia_seminar.pan_seminar');
		$this->db->where('pan_seminar', $seminar);
		return $this->db->get($this->table)->result();
	}

	function listbyid($id)
	{
		$this->db->join('ssc_seminar', 'ssc_seminar.smr_id = ssc_panitia_seminar.pan_seminar');
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
		$this->db->where('pan_seminar', $seminar);
		return $this->db->delete($this->table);
	}

	function cetaksertifikatpanitia($id_seminar, $email)
	{
		$this->db->join('ssc_seminar', 'ssc_seminar.smr_id = ssc_panitia_seminar.pan_seminar');
		$this->db->join('ssc_model_sertifikat', 'ssc_model_sertifikat.ms_id = ssc_seminar.smr_model_sertifikat');
		$this->db->where('pan_seminar', $id_seminar);
		$this->db->where('pan_email', $email);
		return $this->db->get($this->table)->row();
	}

	public function cek_narasumber($seminar)
	{
		$this->db->where('ns_seminar', $seminar);
		return $this->db->get('ssc_narasumber_seminar')->row();
	}

}