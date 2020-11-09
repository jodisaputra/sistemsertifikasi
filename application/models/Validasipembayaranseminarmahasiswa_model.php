<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Validasipembayaranseminarmahasiswa_model extends CI_Model
{

	public $table = 'ssc_seminar_mahasiswa';

	function list()
	{
		$this->db->join('ssc_seminar', 'ssc_seminar.smr_id = ssc_seminar_mahasiswa.smhs_seminar');
		return $this->db->get($this->table);
	}

	function listbyid($npm, $seminar)
	{
		$this->db->join('ssc_seminar', 'ssc_seminar.smr_id = ssc_seminar_mahasiswa.smhs_seminar');
		$this->db->where('smhs_mahasiswa', $npm);
		$this->db->where('smhs_seminar', $seminar);
		return $this->db->get($this->table)->row();
	}

	function cekstatus($npm, $seminar)
	{
		$this->db->where('smhs_mahasiswa', $npm);
		$this->db->where('smhs_seminar', $seminar);
		$this->db->where('smhs_status', 'Menunggu Pembayaran');
		return $this->db->get($this->table)->row();
	}

	function setLunas($npm, $seminar, $data)
	{
		$this->db->where('smhs_mahasiswa', $npm);
		$this->db->where('smhs_seminar', $seminar);
		return $this->db->update($this->table, $data);
	}

	function setTolak($npm, $seminar, $data)
	{
		$this->db->where('smhs_mahasiswa', $npm);
		$this->db->where('smhs_seminar', $seminar);
		return $this->db->update($this->table, $data);
	}

	function inputtotal($npm, $seminar, $data)
	{
		$this->db->where('smhs_mahasiswa', $npm);
		$this->db->where('smhs_seminar', $seminar);
		return $this->db->update($this->table, $data);
	}

	function update_collectivemahasiswa($mhs, $seminar, $data)
	{
		$this->db->where('smhs_seminar', $seminar);
		foreach ($mhs as $id) {
			$this->db->where('smhs_mahasiswa', $id);
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

	function getdatarop($npm, $seminar)
	{
		$this->db->where('smhs_mahasiswa', $npm);
		$this->db->where('smhs_seminar', $seminar);
		return $this->db->get($this->table)->row_array();
	}

	function listseminarmahasiswa($id)
	{
		$this->db->where('smhs_seminar', $id);
		$this->db->where('smhs_status', 'Lunas');
		return $this->db->get('ssc_seminar_mahasiswa')->result();
	}
}

/* End of file Validasipembayaranseminarmahasiswa_model.php */
/* Location: ./application/models/Validasipembayaranseminarmahasiswa_model.php */