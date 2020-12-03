<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Liststatusbayar_model extends CI_Model {

	public $table = 'ssc_subsertifikasi_mahasiswa';

	function list()
	{
		$this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_subsertifikasi_mahasiswa.ssm_subsertifikasi');
		$this->db->join('ssc_sertifikasi_mahasiswa', 'ssc_sertifikasi_mahasiswa.sm_id = ssc_subsertifikasi_mahasiswa.ssm_sertifikasi_mahasiswa');
		return $this->db->get($this->table);
	}

	function getnama($npm)
	{
		$data_mhs = [
			'npm'  => $npm,
		];

		$data_json = json_encode($data_mhs);
		$curl = curl_init('http://apps.uib.ac.id/portal/api/v2/myprofile');

		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'content-type:application/json',
			'Content-Length: ' . strlen($data_json)
		));

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_json);

		$result = curl_exec($curl);
		$data_mahasiswa = json_decode($result);

		curl_close($curl);
		return $data_mahasiswa;
	}

	function list_umum()
    {
        $this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_subsertifikasi_umum.ssu_subsertifikasi');
        $this->db->join('ssc_sertifikasi_umum', 'ssc_sertifikasi_umum.srtu_id = ssc_subsertifikasi_umum.ssu_sertifikasi_umum');
        $this->db->join('ssc_peserta_umum', 'ssc_peserta_umum.pu_email = ssc_sertifikasi_umum.srtu_peserta');
        return $this->db->get('ssc_subsertifikasi_umum');
    }

}

/* End of file Liststatusbayar_model.php */
/* Location: ./application/models/Liststatusbayar_model.php */