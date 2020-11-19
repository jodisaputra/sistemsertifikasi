<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensertifikasi_model extends CI_Model
{

	function listsertifikasimahasiswa($id_batch)
	{
		$this->db->join('ssc_sertifikasi_mahasiswa', 'ssc_sertifikasi_mahasiswa.sm_id = ssc_subsertifikasi_mahasiswa.ssm_sertifikasi_mahasiswa');
		$this->db->where('ssm_batch', $id_batch);
		$this->db->where('ssm_status', 'Lunas');
		return $this->db->get('ssc_subsertifikasi_mahasiswa')->result();
	}

	function update_mahasiswa($id_batchsertifikasi, $id_mahasiswa, $data)
	{
		$this->db->where('ssm_batch', $id_batchsertifikasi);
		foreach ($id_mahasiswa as $d) {
			$this->db->where('ssm_sertifikasi_mahasiswa', $d);
			$this->db->update('ssc_subsertifikasi_mahasiswa', $data[$d]);
		}
		return TRUE;
	}

	function sertifikasi_mahasiswa()
	{
		return $this->db->get('ssc_subsertifikasi_mahasiswa')->result();
	}

	function listsertifikasiumum($id_batch)
	{
		$this->db->join('ssc_sertifikasi_umum', 'ssc_sertifikasi_umum.srtu_id = ssc_subsertifikasi_umum.ssu_sertifikasi_umum');
		$this->db->join('ssc_peserta_umum', 'ssc_peserta_umum.pu_email = ssc_sertifikasi_umum.srtu_peserta');
		$this->db->where('ssu_batch', $id_batch);
		$this->db->where('ssu_status', 'Lunas');
		return $this->db->get('ssc_subsertifikasi_umum')->result();
	}

	function listsertifikasiumumrow($id_absen)
	{
		$this->db->where('aps_absen', $id_absen);
		// $this->db->where('aps_peserta', $id_peserta);
		return $this->db->get('ssc_absen_peserta_sertifikasi')->result();
	}

	function listsertifikasiumum_row($id_absen)
	{
		$this->db->where('aps_absen', $id_absen);
		// $this->db->where('aps_peserta', $id_peserta);
		return $this->db->get('ssc_absen_peserta_sertifikasi')->row();
	}

	function peserta_row($id_absen)
	{
		$this->db->where('aps_absen', $id_absen);
		return $this->db->get('ssc_absen_peserta_sertifikasi')->row();
	}

	function batchrow($id_absen)
	{
		$this->db->where('as_id', $id_absen);
		return $this->db->get('ssc_absen_sertifikasi')->row();
	}

	function insert_absen($data)
	{
		foreach ($data as $d) {
			$this->db->insert('ssc_absen_peserta_sertifikasi', $d);
		}
		return TRUE;
	}

	function updateabsen($id_absen, $id_peserta, $data)
	{
		$this->db->where('aps_absen', $id_absen);
		foreach ($id_peserta as $d) {
			$this->db->where('aps_peserta', $d);
			$this->db->update('ssc_absen_peserta_sertifikasi', $data[$d]);
		}
		return TRUE;
	}

	function insert_absenmhs($data_mhs)
	{
		foreach ($data_mhs as $dm) {
			$this->db->insert('ssc_absen_peserta_sertifikasi', $dm);
		}
		return TRUE;
	}

	function absen_sertifikasiumum()
	{
		$this->db->join('ssc_subsertifikasi_umum', 'ssc_subsertifikasi_umum.ssu_sertifikasi_umum = ssc_sertifikasi_umum.srtu_id');
		$this->db->where('ssc_subsertifikasi_umum.ssu_status', 'Lunas');
		return $this->db->get('ssc_sertifikasi_umum')->result();
	}

	function listsemuaabsen()
	{
		return $this->db->get('ssc_absen_peserta_sertifikasi')->result();
	}

	function absen_sertifikasimahasiswa()
	{
		$this->db->join('ssc_subsertifikasi_mahasiswa', 'ssc_subsertifikasi_mahasiswa.ssm_sertifikasi_mahasiswa = ssc_sertifikasi_mahasiswa.sm_id');
		$this->db->where('ssc_subsertifikasi_mahasiswa.ssm_status', 'Lunas');
		return $this->db->get('ssc_sertifikasi_mahasiswa')->result();
	}

	function listabsen($id_batch)
	{
		$this->db->join('ssc_batch_sertifikasi', 'ssc_batch_sertifikasi.bs_id = ssc_absen_sertifikasi.as_batch');
		// $this->db->join('ssc_absen_peserta_sertifikasi', 'ssc_absen_peserta_sertifikasi.aps_absen = ssc_absen_sertifikasi.as_id');
		$this->db->where('as_batch', $id_batch);
		return $this->db->get('ssc_absen_sertifikasi');
	}

	function listabsencek($id_batch)
	{
		$this->db->join('ssc_absen_sertifikasi', 'ssc_absen_sertifikasi.as_id = ssc_absen_peserta_sertifikasi.aps_absen');
		$this->db->where('ssc_absen_sertifikasi.as_batch', $id_batch);
		return $this->db->get('ssc_absen_peserta_sertifikasi');
	}

	function header($id_absen)
	{
		$this->db->where('as_id', $id_absen);
		return $this->db->get('ssc_absen_sertifikasi')->row();
	}

	function list_pelatih($id_batch)
	{
		$this->db->where('ps_batch', $id_batch);
		return $this->db->get('ssc_pelatih_subsertifikasi')->result();
	}

	function insert_header($id_absen, $data)
	{
		$this->db->where('as_id', $id_absen);
		return $this->db->update('ssc_absen_sertifikasi', $data);
	}

	function listpesertarow($id_absen)
	{
		$this->db->join('ssc_absen_sertifikasi', 'ssc_absen_peserta_sertifikasi.aps_absen = ssc_absen_sertifikasi.as_id');
		$this->db->where('ssc_absen_sertifikasi.as_id', $id_absen);
		return $this->db->get('ssc_absen_peserta_sertifikasi')->row();
	}

	function getabsen($id_batch)
	{
		$this->db->where('as_batch', $id_batch);
		return $this->db->get('ssc_absen_sertifikasi')->row();
	}

	public function cetakabsen($id_absen, $id_batch)
	{
		$this->db->join('ssc_absen_sertifikasi', 'ssc_absen_sertifikasi.as_id = ssc_absen_peserta_sertifikasi.aps_absen');
		$this->db->join('ssc_batch_sertifikasi', 'ssc_batch_sertifikasi.bs_id = ssc_absen_sertifikasi.as_batch');
		$this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_batch_sertifikasi.bs_subsertifikasi');
		$this->db->join('ssc_sertifikasi', 'ssc_sertifikasi.cert_id = ssc_subsertifikasi.scert_sertifikasi');
		$this->db->where('ssc_absen_sertifikasi.as_id', $id_absen);
		$this->db->where('ssc_absen_sertifikasi.as_batch', $id_batch);
		return $this->db->get('ssc_absen_peserta_sertifikasi')->result();
	}

	public function cetakabsenrow($id_absen, $id_batch)
	{
		$this->db->join('ssc_batch_sertifikasi', 'ssc_batch_sertifikasi.bs_id = ssc_absen_sertifikasi.as_batch');
		$this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_batch_sertifikasi.bs_subsertifikasi');
		$this->db->join('ssc_sertifikasi', 'ssc_sertifikasi.cert_id = ssc_subsertifikasi.scert_sertifikasi');
		$this->db->where('as_id', $id_absen);
		$this->db->where('as_batch', $id_batch);
		return $this->db->get('ssc_absen_sertifikasi')->row();
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

/* End of file Absensertifikasi_model.php */
/* Location: ./application/models/Absensertifikasi_model.php */