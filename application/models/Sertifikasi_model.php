<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sertifikasi_model extends CI_Model {

	function get_all_sertifikasi() {
		return $this->db->get('ssc_sertifikasi')->result();
	}
	function insert_sertifikasi($data) {
		return $this->db->insert('ssc_sertifikasi',$data);
	}
	function get_sertifikasi($id) {
		$this->db->where('cert_id',$id);
		return $this->db->get('ssc_sertifikasi')->row();
	}
	function update_sertifikasi($id,$data){
		$this->db->where('cert_id',$id);
		return $this->db->update('ssc_sertifikasi',$data);
	}
	function delete_sertifikasi($id) {
		$this->db->where('cert_id',$id);
		return $this->db->delete('ssc_sertifikasi');
	}
	function get_all_sub_sertifikasi() {
		$this->db->join('ssc_sertifikasi','ssc_sertifikasi.cert_id = ssc_subsertifikasi.scert_sertifikasi');
		return $this->db->get('ssc_subsertifikasi')->result();
	}

	function get_all_sub_sertifikasibystatus() {
		$this->db->join('ssc_sertifikasi','ssc_sertifikasi.cert_id = ssc_subsertifikasi.scert_sertifikasi');
		$this->db->where('scert_isaktif', 'y');
		return $this->db->get('ssc_subsertifikasi')->result();
	}

	function get_sub_sertifikasi_by_main($idsertifikasi) {
		$this->db->where('scert_sertifikasi',$idsertifikasi);
		$this->db->join('ssc_sertifikasi','ssc_sertifikasi.cert_id = ssc_subsertifikasi.scert_sertifikasi');
		return $this->db->get('ssc_subsertifikasi')->result();
	}

	function totalsubsertifikasi($idsertifikasi) {
		$this->db->where('scert_sertifikasi',$idsertifikasi);
		$this->db->where('scert_isaktif', 'y');
		$this->db->join('ssc_sertifikasi','ssc_sertifikasi.cert_id = ssc_subsertifikasi.scert_sertifikasi');
		return $this->db->get('ssc_subsertifikasi');
	}

	function insert_sub_sertifikasi($data) {
		return $this->db->insert('ssc_subsertifikasi',$data);
	}	
	function get_sub_sertifikasi($id) {
		$this->db->where('scert_id',$id);
		return $this->db->get('ssc_subsertifikasi')->row();
	}
	function update_sub_sertifikasi($id,$data) {
		$this->db->where('scert_id',$id);
		return $this->db->update('ssc_subsertifikasi',$data);
	}
	function delete_sub_sertifikasi($id) {
		$this->db->where('scert_id',$id);
		return $this->db->delete('ssc_subsertifikasi');
	}

	function listsertifikasibyuser($id_sertifikasi)
	{
		$email = $this->session->userdata('email');
		$this->db->join('ssc_sertifikasi_umum', 'ssc_sertifikasi_umum.srtu_id = ssc_subsertifikasi_umum.ssu_sertifikasi_umum');
		$this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_subsertifikasi_umum.ssu_subsertifikasi');
		$this->db->join('ssc_batch_sertifikasi', 'ssc_batch_sertifikasi.bs_id = ssc_subsertifikasi_umum.ssu_batch');
		$this->db->where('ssc_sertifikasi_umum.srtu_peserta', $email);
		$this->db->where('ssc_sertifikasi_umum.srtu_sertifikasi', $id_sertifikasi);
		return $this->db->get('ssc_subsertifikasi_umum')->result();
	}

	function listsertifikasibyuserdetail($id_sertifikasi)
	{
		$email = $this->session->userdata('email');
		$this->db->join('ssc_sertifikasi_umum', 'ssc_sertifikasi_umum.srtu_id = ssc_subsertifikasi_umum.ssu_sertifikasi_umum');
		$this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_subsertifikasi_umum.ssu_subsertifikasi');
		$this->db->join('ssc_batch_sertifikasi', 'ssc_batch_sertifikasi.bs_id = ssc_subsertifikasi_umum.ssu_batch');
		$this->db->where('ssc_sertifikasi_umum.srtu_peserta', $email);
		$this->db->where('ssc_sertifikasi_umum.srtu_sertifikasi', $id_sertifikasi);
		return $this->db->get('ssc_subsertifikasi_umum')->result();
	}

	function listsertifikasibyuser2($email)
	{
		$this->db->join('ssc_subsertifikasi_umum', 'ssc_subsertifikasi_umum.ssu_sertifikasi_umum = ssc_sertifikasi_umum.srtu_id');
		$this->db->join('ssc_sertifikasi', 'ssc_sertifikasi.cert_id = ssc_sertifikasi_umum.srtu_sertifikasi');
		$this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_subsertifikasi_umum.ssu_subsertifikasi');
		$this->db->join('ssc_batch_sertifikasi', 'ssc_batch_sertifikasi.bs_id = ssc_subsertifikasi_umum.ssu_batch');
		$this->db->where('ssc_sertifikasi_umum.srtu_peserta', $email);
		$this->db->group_by('ssc_sertifikasi_umum.srtu_sertifikasi');
		return $this->db->get('ssc_sertifikasi_umum')->result();
	}

	function getdatasebelumbayar($id_subsertifikasi, $id_sertifikasi, $email)
	{
		$this->db->join('ssc_sertifikasi_umum', 'ssc_sertifikasi_umum.srtu_id = ssc_subsertifikasi_umum.ssu_sertifikasi_umum');
		$this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_subsertifikasi_umum.ssu_subsertifikasi');
		$this->db->join('ssc_batch_sertifikasi', 'ssc_batch_sertifikasi.bs_id = ssc_subsertifikasi_umum.ssu_batch');
		$this->db->where('ssc_subsertifikasi_umum.ssu_id', $id_subsertifikasi);
		$this->db->where('ssc_sertifikasi_umum.srtu_sertifikasi', $id_sertifikasi);
		$this->db->where('ssc_sertifikasi_umum.srtu_peserta', $email);
		return $this->db->get('ssc_subsertifikasi_umum')->row();
	}

	function updatebayarumum($id_subsertifikasi, $data)
	{
		$this->db->where('ssu_id', $id_subsertifikasi);
		return $this->db->update('ssc_subsertifikasi_umum', $data);
	}

	// Mahasiswa
	function listsertifikasibymhs($id_sertifikasi)
	{
		$npm = $this->session->userdata('npm');
		$this->db->join('ssc_sertifikasi_mahasiswa', 'ssc_sertifikasi_mahasiswa.sm_id = ssc_subsertifikasi_mahasiswa.ssm_sertifikasi_mahasiswa');
		$this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_subsertifikasi_mahasiswa.ssm_subsertifikasi');
		$this->db->join('ssc_batch_sertifikasi', 'ssc_batch_sertifikasi.bs_id = ssc_subsertifikasi_mahasiswa.ssm_batch');
		$this->db->where('ssc_sertifikasi_mahasiswa.sm_sertifikasi', $id_sertifikasi);
		$this->db->where('ssc_sertifikasi_mahasiswa.sm_mahasiswa', $npm);
		return $this->db->get('ssc_subsertifikasi_mahasiswa')->result();
	}

	function listsertifikasibymhs2($npm)
	{
		$this->db->join('ssc_subsertifikasi_mahasiswa', 'ssc_subsertifikasi_mahasiswa.ssm_sertifikasi_mahasiswa = ssc_sertifikasi_mahasiswa.sm_id');
		$this->db->join('ssc_sertifikasi', 'ssc_sertifikasi.cert_id = ssc_sertifikasi_mahasiswa.sm_sertifikasi');
		$this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_subsertifikasi_mahasiswa.ssm_subsertifikasi');
		$this->db->join('ssc_batch_sertifikasi', 'ssc_batch_sertifikasi.bs_id = ssc_subsertifikasi_mahasiswa.ssm_batch');
		$this->db->where('ssc_sertifikasi_mahasiswa.sm_mahasiswa', $npm);
		$this->db->group_by('ssc_sertifikasi_mahasiswa.sm_sertifikasi');
		return $this->db->get('ssc_sertifikasi_mahasiswa')->result();
	}
	
	function getdatasebelumbayarmhs($id_subsertifikasi, $id_sertifikasi, $npm)
	{
		$this->db->join('ssc_sertifikasi_mahasiswa', 'ssc_sertifikasi_mahasiswa.sm_id = ssc_subsertifikasi_mahasiswa.ssm_sertifikasi_mahasiswa');
		$this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_subsertifikasi_mahasiswa.ssm_subsertifikasi');
		$this->db->join('ssc_batch_sertifikasi', 'ssc_batch_sertifikasi.bs_id = ssc_subsertifikasi_mahasiswa.ssm_batch');
		$this->db->where('ssc_subsertifikasi_mahasiswa.ssm_id', $id_subsertifikasi);
		$this->db->where('ssc_sertifikasi_mahasiswa.sm_sertifikasi', $id_sertifikasi);
		$this->db->where('ssc_sertifikasi_mahasiswa.sm_mahasiswa', $npm);
		return $this->db->get('ssc_subsertifikasi_mahasiswa')->row();
	}

	function updatebayarmhs($id_subsertifikasi, $data)
	{
		$this->db->where('ssm_id', $id_subsertifikasi);
		return $this->db->update('ssc_subsertifikasi_mahasiswa', $data);
	}

	function ceksertifikasi($id_sertifikasi, $email)
	{
		$this->db->where('srtu_sertifikasi', $id_sertifikasi);
		$this->db->where('srtu_peserta', $email);
		return $this->db->get('ssc_sertifikasi_umum');
	}

	function ceksertifikasimahasiswa($id_sertifikasi, $npm)
	{
		$this->db->where('sm_sertifikasi', $id_sertifikasi);
		$this->db->where('sm_mahasiswa', $npm);
		return $this->db->get('ssc_sertifikasi_mahasiswa');
	}	

}

/* End of file Sertifikasi_model.php */
/* Location: ./application/models/Sertifikasi_model.php */