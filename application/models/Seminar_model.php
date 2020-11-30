<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seminar_model extends CI_Model
{

	public $table = 'ssc_seminar';
	public $id    = 'smr_id';

	function listseminar()
	{
		$this->db->join('ssc_model_sertifikat', 'ssc_model_sertifikat.ms_id = ssc_seminar.smr_model_sertifikat');
		return $this->db->get($this->table)->result();
	}

	function listnarasumber($id)
	{
		$this->db->where('ns_seminar', $id);
		return $this->db->get('ssc_narasumber_seminar')->result();
	}

	function listseminarbyid($id)
	{
		$this->db->join('ssc_model_sertifikat', 'ssc_model_sertifikat.ms_id = ssc_seminar.smr_model_sertifikat');
		$this->db->where($this->id, $id);
		return $this->db->get($this->table)->row();
	}

	function jadwal_seminar()
	{
		$tgl = date("Y/m/d", now('Asia/Jakarta'));
		$this->db->join('ssc_model_sertifikat', 'ssc_model_sertifikat.ms_id = ssc_seminar.smr_model_sertifikat');
		$this->db->where('smr_tanggal >= ', $tgl);
		return $this->db->get($this->table)->result();
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

	function daftar_seminar_umum($data)
	{
		return $this->db->insert('ssc_seminar_umum', $data);
	}

	function daftar_seminar_mahasiswa($data)
	{
		return $this->db->insert('ssc_seminar_mahasiswa', $data);
	}

	function listseminarbyuser($email)
	{
		$this->db->join('ssc_seminar', 'ssc_seminar_umum.su_seminar = ssc_seminar.smr_id');
		$this->db->join('ssc_model_sertifikat', 'ssc_model_sertifikat.ms_id = ssc_seminar.smr_model_sertifikat');
		$this->db->where('su_peserta', $email);
		return $this->db->get('ssc_seminar_umum')->result();
	}

	function listseminarbymahasiswa($npm)
	{
		$this->db->join('ssc_seminar', 'ssc_seminar_mahasiswa.smhs_seminar = ssc_seminar.smr_id');
		$this->db->where('smhs_mahasiswa', $npm);
		return $this->db->get('ssc_seminar_mahasiswa')->result();
	}

	function cek($email)
	{
		$this->db->where('su_peserta', $email);
		return $this->db->get('ssc_seminar_umum');
	}

	function cekmahasiswa($id, $npm)
	{
		$this->db->where('smhs_seminar', $id);
		$this->db->where('smhs_mahasiswa', $npm);
		return $this->db->get('ssc_seminar_mahasiswa');
	}

	function getdatasebelumbayar($id, $email)
	{
		$this->db->where('su_seminar', $id);
		$this->db->where('su_peserta', $email);
		return $this->db->get('ssc_seminar_umum')->row();
	}

	function updatebayarumum($id, $email, $data)
	{
		$this->db->where('su_seminar', $id);
		$this->db->where('su_peserta', $email);
		return $this->db->update('ssc_seminar_umum', $data);
	}

	function getdatasebelumbayarmahasiswa($id, $npm)
	{
		$this->db->where('smhs_seminar', $id);
		$this->db->where('smhs_mahasiswa', $npm);
		return $this->db->get('ssc_seminar_mahasiswa')->row();
	}

	function updatebayarmahasiswa($id, $npm, $data)
	{
		$this->db->where('smhs_seminar', $id);
		$this->db->where('smhs_mahasiswa', $npm);
		return $this->db->update('ssc_seminar_mahasiswa', $data);
	}

	function seminarkode()
	{
		$this->db->select_max('smr_id');
		$query = $this->db->get('ssc_seminar')->row();
		$id = $query->smr_id;
		if ($id) {
			$id = $id + 1;
		} else {
			$id = 1;
		}
		return $id;
	}

	function listseminarumum()
	{
		return $this->db->get('ssc_seminar_umum');
	}

	function getjumlahmaxseminar($id)
	{
		$this->db->where($this->id, $id);
		return $this->db->get($this->table);
	}

	function jumlahpesertamhs($id)
	{
		$this->db->select('count(smhs_seminar) AS jumlah_mahasiswa');
		$this->db->where('smhs_seminar', $id);
		return $this->db->get('ssc_seminar_mahasiswa')->row();
	}

	function jumlahpesertaumum($id)
	{
		$this->db->select('count(su_seminar) AS jumlah');
		$this->db->where('su_seminar', $id);
		return $this->db->get('ssc_seminar_umum')->row();
	}

	function listpesertaseminarmhs($id_seminar)
	{
		$this->db->join('ssc_seminar', 'ssc_seminar_mahasiswa.smhs_seminar = ssc_seminar.smr_id');
		$this->db->where('smhs_ishadir', 'y');
		$this->db->where('smhs_status', 'Lunas');
		$this->db->where('smhs_seminar', $id_seminar);
		return $this->db->get('ssc_seminar_mahasiswa')->result();
	}

	function listpesertaseminarumum($id_seminar)
	{
		$this->db->join('ssc_seminar', 'ssc_seminar_umum.su_seminar = ssc_seminar.smr_id');
		$this->db->join('ssc_peserta_umum', 'ssc_peserta_umum.pu_email = ssc_seminar_umum.su_peserta');
		$this->db->where('su_ishadir', 'y');
		$this->db->where('su_status', 'Lunas');
		$this->db->where('su_seminar', $id_seminar);
		return $this->db->get('ssc_seminar_umum')->result();
	}

	public function cetaksertifikatseminarmhs($id_seminar, $npm)
	{
		$this->db->join('ssc_seminar', 'ssc_seminar_mahasiswa.smhs_seminar = ssc_seminar.smr_id');
		$this->db->join('ssc_model_sertifikat', 'ssc_model_sertifikat.ms_id = ssc_seminar.smr_model_sertifikat');
		$this->db->where('smhs_seminar', $id_seminar);
		$this->db->where('smhs_mahasiswa', $npm);
		return $this->db->get('ssc_seminar_mahasiswa')->row();
	}

	public function get_ttd_narasumber($id_seminar)
	{
		$this->db->where('ns_seminar', $id_seminar);
		$this->db->where('ns_set_tandatangan', 'y');
		return $this->db->get('ssc_narasumber_seminar')->row();
	}

	public function cetaksertifikatseminarumum($id_seminar, $peserta)
	{
		$this->db->join('ssc_seminar', 'ssc_seminar_umum.su_seminar = ssc_seminar.smr_id');
		$this->db->join('ssc_model_sertifikat', 'ssc_model_sertifikat.ms_id = ssc_seminar.smr_model_sertifikat');
		$this->db->join('ssc_peserta_umum', 'ssc_peserta_umum.pu_email = ssc_seminar_umum.su_peserta');
		$this->db->where('su_seminar', $id_seminar);
		$this->db->where('su_peserta', $peserta);
		return $this->db->get('ssc_seminar_umum')->row();
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
	// ROP
	function listseminarmahasiswa($id)
	{
		$this->db->where('smhs_seminar', $id);
		$this->db->where('smhs_status', 'Lunas');
		return $this->db->get('ssc_seminar_mahasiswa')->result();
	}

	function getdatarop($npm, $seminar)
	{
		$this->db->where('smhs_mahasiswa', $npm);
		$this->db->where('smhs_seminar', $seminar);
		return $this->db->get('ssc_seminar_mahasiswa')->row_array();
	}

	function cek_jika_seminar_gratis($seminar)
	{
		$this->db->where('smr_id', $seminar);
		$this->db->where('smr_status_seminar', 'gratis');
		return $this->db->get('ssc_seminar')->row();
	}
}

/* End of file Seminar_model.php */
/* Location: ./application/models/Seminar_model.php */