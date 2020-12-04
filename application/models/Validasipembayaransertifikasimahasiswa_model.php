<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Validasipembayaransertifikasimahasiswa_model extends CI_Model
{

	public $table = 'ssc_subsertifikasi_mahasiswa';

	function list()
	{
		$this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_subsertifikasi_mahasiswa.ssm_subsertifikasi');
		$this->db->join('ssc_sertifikasi_mahasiswa', 'ssc_sertifikasi_mahasiswa.sm_id = ssc_subsertifikasi_mahasiswa.ssm_sertifikasi_mahasiswa');
		return $this->db->get($this->table);
	}

	public function filter($sertifikasi, $bayar)
	{
		$this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_subsertifikasi_mahasiswa.ssm_subsertifikasi');
		$this->db->join('ssc_sertifikasi_mahasiswa', 'ssc_sertifikasi_mahasiswa.sm_id = ssc_subsertifikasi_mahasiswa.ssm_sertifikasi_mahasiswa');

		if($sertifikasi)
		{
			$this->db->where('ssm_subsertifikasi', $sertifikasi);
		}

		if($bayar)
		{
			$this->db->where('ssm_status', $bayar);
		}
		
		return $this->db->get($this->table);
	}

	function listbyid($id_subsertifikasimahasiswa, $subsertifikasi, $mahasiswa)
	{
		$this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_subsertifikasi_mahasiswa.ssm_subsertifikasi');
		$this->db->join('ssc_sertifikasi_mahasiswa', 'ssc_sertifikasi_mahasiswa.sm_id = ssc_subsertifikasi_mahasiswa.ssm_sertifikasi_mahasiswa');
		$this->db->where('ssm_id', $id_subsertifikasimahasiswa);
		$this->db->where('ssm_subsertifikasi', $subsertifikasi);
		$this->db->where('ssm_sertifikasi_mahasiswa', $mahasiswa);
		return $this->db->get($this->table)->row();
	}

	function cekstatus($id_subsertifikasimahasiswa, $subsertifikasi, $mahasiswa)
	{
		$this->db->where('ssm_id', $id_subsertifikasimahasiswa);
		$this->db->where('ssm_subsertifikasi', $subsertifikasi);
		$this->db->where('ssm_sertifikasi_mahasiswa', $mahasiswa);
		$this->db->where('ssm_status', 'Menunggu Pembayaran');
		return $this->db->get($this->table)->row();
	}

	function setLunas($id_subsertifikasimahasiswa, $subsertifikasi, $mahasiswa, $data)
	{
		$this->db->where('ssm_id', $id_subsertifikasimahasiswa);
		$this->db->where('ssm_subsertifikasi', $subsertifikasi);
		$this->db->where('ssm_sertifikasi_mahasiswa', $mahasiswa);
		return $this->db->update($this->table, $data);
	}

	function setTolak($id_subsertifikasimahasiswa, $subsertifikasi, $mahasiswa, $data)
	{
		$this->db->where('ssm_id', $id_subsertifikasimahasiswa);
		$this->db->where('ssm_subsertifikasi', $subsertifikasi);
		$this->db->where('ssm_sertifikasi_mahasiswa', $mahasiswa);
		return $this->db->update($this->table, $data);
	}

	function getlistmahasiswa($checkall)
	{
		$this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_subsertifikasi_mahasiswa.ssm_subsertifikasi');
		$this->db->join('ssc_sertifikasi_mahasiswa', 'ssc_sertifikasi_mahasiswa.sm_id = ssc_subsertifikasi_mahasiswa.ssm_sertifikasi_mahasiswa');
		$this->db->where('ssm_id', $checkall);
		return $this->db->get($this->table)->row();
	}

	function update_collectivemahasiswa($mhs, $data)
	{
		foreach ($mhs as $id) {
			$this->db->where('ssm_id', $id);
			$this->db->update($this->table, $data[$id]);
		}
		return TRUE;
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

	function inputtotal($id_subsertifikasimahasiswa, $subsertifikasi, $mahasiswa, $data)
	{
		$this->db->where('ssm_id', $id_subsertifikasimahasiswa);
		$this->db->where('ssm_subsertifikasi', $subsertifikasi);
		$this->db->where('ssm_sertifikasi_mahasiswa', $mahasiswa);
		return $this->db->update($this->table, $data);
	}

	function getdatarop($id_subsertifikasimahasiswa, $subsertifikasi, $mahasiswa)
	{
		$this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_subsertifikasi_mahasiswa.ssm_subsertifikasi');
		$this->db->join('ssc_sertifikasi_mahasiswa', 'ssc_sertifikasi_mahasiswa.sm_id = ssc_subsertifikasi_mahasiswa.ssm_sertifikasi_mahasiswa');
		$this->db->where('ssm_id', $id_subsertifikasimahasiswa);
		$this->db->where('ssm_subsertifikasi', $subsertifikasi);
		$this->db->where('ssm_sertifikasi_mahasiswa', $mahasiswa);
		return $this->db->get($this->table)->row_array();
	}

	function listmahasiswarop($subsertifikasi)
	{
		$this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_subsertifikasi_mahasiswa.ssm_subsertifikasi');
		$this->db->join('ssc_sertifikasi_mahasiswa', 'ssc_sertifikasi_mahasiswa.sm_id = ssc_subsertifikasi_mahasiswa.ssm_sertifikasi_mahasiswa');
		$this->db->where('ssm_subsertifikasi', $subsertifikasi);
		return $this->db->get($this->table)->result();
	}
}

/* End of file Validasipembayaransertifikasimahasiswa_model.php */
/* Location: ./application/models/Validasipembayaransertifikasimahasiswa_model.php */