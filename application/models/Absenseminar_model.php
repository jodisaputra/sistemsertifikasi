<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absenseminar_model extends CI_Model
{

	// Seminar Mahasiswa
	function listseminarmahasiswa($id)
	{
		$this->db->where('smhs_seminar', $id);
		$this->db->where('smhs_status', 'Lunas');
		return $this->db->get('ssc_seminar_mahasiswa')->result();
	}

	function update_mahasiswa($id_seminar, $id_mahasiswa, $data)
	{
		$this->db->where('smhs_seminar', $id_seminar);
		foreach ($id_mahasiswa as $d) {
			$this->db->where('smhs_mahasiswa', $d);
			$this->db->update('ssc_seminar_mahasiswa', $data[$d]);
		}
		return TRUE;
	}

	// Seminar Umum
	function listseminarumum($id)
	{
		$this->db->join('ssc_peserta_umum', 'ssc_peserta_umum.pu_email = ssc_seminar_umum.su_peserta');
		$this->db->where('su_seminar', $id);
		$this->db->where('su_status', 'Lunas');
		return $this->db->get('ssc_seminar_umum')->result();
	}

	function update_umum($id_seminar, $id_peserta, $data)
	{
		$this->db->where('su_seminar', $id_seminar);
		foreach ($id_peserta as $d) {
			$this->db->where('su_peserta', $d);
			$this->db->update('ssc_seminar_umum', $data[$d]);
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
}

/* End of file Absenseminar_model.php */
/* Location: ./application/models/Absenseminar_model.php */