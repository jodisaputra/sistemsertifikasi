<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwalsubsertifikasi_model extends CI_Model {

	public $table = 'ssc_jadwal_subsertifikasi';
	public $id    = 'js_batch';

	function list()
	{
		$this->db->join('ssc_batch_sertifikasi', 'ssc_batch_sertifikasi.bs_id = ssc_jadwal_subsertifikasi.js_batch');
		$this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_batch_sertifikasi.bs_subsertifikasi');
		$this->db->join('ssc_sertifikasi', 'ssc_sertifikasi.cert_id = ssc_subsertifikasi.scert_sertifikasi');
		$this->db->join('ssc_pelatih_subsertifikasi', 'ssc_pelatih_subsertifikasi.ps_batch = ssc_batch_sertifikasi.bs_id');
		$this->db->where('ssc_sertifikasi.cert_isaktif', 'y');
		$this->db->where('ssc_subsertifikasi.scert_isaktif', 'y');
		return $this->db->get($this->table)->result();
	}

	function jadwal_batch()
	{
		$tgl = date("Y/m/d",now('Asia/Jakarta'));
		$this->db->join('ssc_batch_sertifikasi', 'ssc_batch_sertifikasi.bs_id = ssc_jadwal_subsertifikasi.js_batch');
		$this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_batch_sertifikasi.bs_subsertifikasi');
		$this->db->join('ssc_sertifikasi', 'ssc_sertifikasi.cert_id = ssc_subsertifikasi.scert_sertifikasi');
		$this->db->join('ssc_pelatih_subsertifikasi', 'ssc_pelatih_subsertifikasi.ps_batch = ssc_batch_sertifikasi.bs_id');
		$this->db->where('ssc_sertifikasi.cert_isaktif', 'y');
		$this->db->where('ssc_subsertifikasi.scert_isaktif', 'y');
		$this->db->where('ssc_batch_sertifikasi.bs_mulai_daftar <= ', $tgl);
		$this->db->where('ssc_batch_sertifikasi.bs_terakhir_daftar >= ', $tgl);
		return $this->db->get($this->table)->result();
	}

	function listbyid($id)
	{
		$this->db->join('ssc_batch_sertifikasi', 'ssc_batch_sertifikasi.bs_id = ssc_jadwal_subsertifikasi.js_batch');
		$this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_batch_sertifikasi.bs_subsertifikasi');
		$this->db->join('ssc_pelatih_subsertifikasi', 'ssc_pelatih_subsertifikasi.ps_batch = ssc_batch_sertifikasi.bs_id');
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

	function cektanggal($tanggal, $jam)
	{
        //Cek tanggal dan jam jika sudah ada
		$query  = $this->db->query("SELECT * FROM ssc_jadwal_subsertifikasi WHERE js_tanggal LIKE '" . $tanggal ."%' AND js_mulai LIKE '" . $jam . "%'");
		return $query;
	}	

}

/* End of file Jadwalsubertifikasi_model.php */
/* Location: ./application/models/Jadwalsubertifikasi_model.php */