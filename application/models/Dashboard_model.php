<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

	function gettotalpendaftar()
	{
		$query = $this->db->get('ssc_peserta_umum');

		return $query->num_rows();
	}

	function gettotalseminar()
	{
		$query = $this->db->get('ssc_seminar');

		return $query->num_rows();
	}

	function gettotalmhslulus()
	{
		$this->db->where('sm_status', 'Lulus');

		$query = $this->db->get('ssc_sertifikasi_mahasiswa');

		return $query->num_rows();
	}

	function gettotalmhstidaklulus()
	{
		$this->db->where('sm_status', 'Tidak Lulus');

		$query = $this->db->get('ssc_sertifikasi_mahasiswa');

		return $query->num_rows();
	}

	function list_sertifikasi()
	{
		$this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_batch_sertifikasi.bs_subsertifikasi');
		$this->db->join('ssc_sertifikasi', 'ssc_sertifikasi.cert_id = ssc_subsertifikasi.scert_sertifikasi');
		$this->db->join('ssc_jadwal_subsertifikasi', 'ssc_jadwal_subsertifikasi.js_batch = ssc_batch_sertifikasi.bs_id');
		$this->db->limit(3);
		$this->db->order_by('bs_mulai_daftar', 'DESC');
		return $this->db->get('ssc_batch_sertifikasi')->result();
	}
}

/* End of file Dashboard_model.php */
/* Location: ./application/models/Dashboard_model.php */