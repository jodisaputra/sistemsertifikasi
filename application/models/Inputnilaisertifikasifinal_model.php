<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inputnilaisertifikasifinal_model extends CI_Model
{

	function listsertifikasiumum($id_sertifikasi)
	{
		// SELECT UNTUK GROUP BY BERDASARKAN ID SSC_SERTIFIKASI_UMUM
		$this->db->select('*');
		$this->db->from('ssc_sertifikasi_umum');
		$this->db->join('ssc_subsertifikasi_umum', 'ssc_subsertifikasi_umum.ssu_sertifikasi_umum = ssc_sertifikasi_umum.srtu_id');
		$this->db->where('ssc_sertifikasi_umum.srtu_sertifikasi', $id_sertifikasi);
		$get = $this->db->get()->row();

		$this->db->join('ssc_subsertifikasi_umum', 'ssc_subsertifikasi_umum.ssu_sertifikasi_umum = ssc_sertifikasi_umum.srtu_id');
		$this->db->join('ssc_peserta_umum', 'ssc_peserta_umum.pu_email = ssc_sertifikasi_umum.srtu_peserta');
		$this->db->where('srtu_sertifikasi', $id_sertifikasi);
		$this->db->where('ssu_status', 'Lunas');
		// $this->db->where('ssu_ishadir', 'y');
		$this->db->where('ssu_skor is NOT NULL');
		$this->db->group_by('ssc_subsertifikasi_umum.ssu_sertifikasi_umum', $get->ssu_sertifikasi_umum);
		return $this->db->get('ssc_sertifikasi_umum');
	}

	function listsertifikasicount($id_sertifikasi, $id_peserta)
	{
		$this->db->join('ssc_subsertifikasi_umum', 'ssc_subsertifikasi_umum.ssu_sertifikasi_umum = ssc_sertifikasi_umum.srtu_id');
		$this->db->join('ssc_peserta_umum', 'ssc_peserta_umum.pu_email = ssc_sertifikasi_umum.srtu_peserta');
		$this->db->where('srtu_sertifikasi', $id_sertifikasi);
		$this->db->where('srtu_peserta', $id_peserta);
		$this->db->where('ssu_status', 'Lunas');
		// $this->db->where('ssu_ishadir', 'y');
		$this->db->where('ssu_skor is NOT NULL');
		return $this->db->get('ssc_sertifikasi_umum');
	}

	function listsertifikasiumumlistid($id_sertifikasi, $id_peserta)
	{
		$this->db->join('ssc_sertifikasi_umum', 'ssc_sertifikasi_umum.srtu_id = ssc_subsertifikasi_umum.ssu_sertifikasi_umum');
		$this->db->join('ssc_peserta_umum', 'ssc_peserta_umum.pu_email = ssc_sertifikasi_umum.srtu_peserta');
		$this->db->where('ssc_sertifikasi_umum.srtu_sertifikasi', $id_sertifikasi);
		$this->db->where('ssc_sertifikasi_umum.srtu_peserta', $id_peserta);
		$this->db->where('ssu_status', 'Lunas');
		// $this->db->where('ssu_ishadir', 'y');
		$this->db->where('ssu_skor is NOT NULL');
		$this->db->group_by('ssc_sertifikasi_umum.srtu_sertifikasi');
		return $this->db->get('ssc_subsertifikasi_umum')->row();
	}

	function nilaimax($id_sertifikasi, $email)
	{
		$query = $this->db->query(" SELECT t1.*
			FROM ssc_subsertifikasi_umum t1
			JOIN ssc_sertifikasi_umum ON ssc_sertifikasi_umum.srtu_id = t1.ssu_sertifikasi_umum
			WHERE srtu_sertifikasi = '" . $id_sertifikasi . "' AND srtu_peserta = '" . $email . "' AND
			ssu_skor >= 
			(
			SELECT MAX(ssu_skor)
			FROM ssc_subsertifikasi_umum t2
			JOIN ssc_sertifikasi_umum ON ssc_sertifikasi_umum.srtu_id = t2.ssu_sertifikasi_umum
			WHERE srtu_sertifikasi = '" . $id_sertifikasi . "' AND srtu_peserta = '" . $email . "' AND t2.																ssu_subsertifikasi = t1.ssu_subsertifikasi
			)
			GROUP BY ssu_subsertifikasi");
		return $query->result();
	}

	function getgrade($id_sertifikasi)
	{
		$this->db->join('ssc_sertifikasi', 'ssc_sertifikasi.cert_id = ssc_penilaian.pn_sertifikasi');
		$this->db->where('pn_sertifikasi', $id_sertifikasi);
		return $this->db->get('ssc_penilaian');
	}

	function insert_umum($id_sertifikasi, $id_peserta, $data)
	{
		$this->db->where('srtu_sertifikasi', $id_sertifikasi);
		$this->db->where('srtu_peserta', $id_peserta);
		return $this->db->update('ssc_sertifikasi_umum', $data);
	}

	function listsertifikasimahasiswa($id_sertifikasi)
	{
		// SELECT UNTUK GROUP BY BERDASARKAN ID SSC_SERTIFIKASI_MAHASISWA
		$this->db->select('*');
		$this->db->from('ssc_sertifikasi_mahasiswa');
		$this->db->join('ssc_subsertifikasi_mahasiswa', 'ssc_subsertifikasi_mahasiswa.ssm_sertifikasi_mahasiswa = ssc_sertifikasi_mahasiswa.sm_id');
		$this->db->where('ssc_sertifikasi_mahasiswa.sm_sertifikasi', $id_sertifikasi);
		$get = $this->db->get()->row();

		$this->db->join('ssc_subsertifikasi_mahasiswa', 'ssc_subsertifikasi_mahasiswa.ssm_sertifikasi_mahasiswa = ssc_sertifikasi_mahasiswa.sm_id');
		$this->db->where('sm_sertifikasi', $id_sertifikasi);
		$this->db->where('ssm_status', 'Lunas');
		// $this->db->where('ssm_ishadir', 'y');
		$this->db->where('ssm_skor is NOT NULL');
		$this->db->group_by('ssc_subsertifikasi_mahasiswa.ssm_sertifikasi_mahasiswa', $get->ssm_sertifikasi_mahasiswa);
		return $this->db->get('ssc_sertifikasi_mahasiswa');
	}

	function nilaimaxmahasiswa($id_sertifikasi, $npm)
	{
		$query = $this->db->query(" SELECT t1.*
			FROM ssc_subsertifikasi_mahasiswa t1
			JOIN ssc_sertifikasi_mahasiswa ON ssc_sertifikasi_mahasiswa.sm_id = t1.ssm_sertifikasi_mahasiswa
			WHERE sm_sertifikasi = '" . $id_sertifikasi . "' AND sm_mahasiswa = '" . $npm . "' AND
			ssm_skor >= 
			(
			SELECT MAX(ssm_skor)
			FROM ssc_subsertifikasi_mahasiswa t2
			JOIN ssc_sertifikasi_mahasiswa ON ssc_sertifikasi_mahasiswa.sm_id = t2.ssm_sertifikasi_mahasiswa
			WHERE sm_sertifikasi = '" . $id_sertifikasi . "' AND sm_mahasiswa = '" . $npm . "' AND t2.																ssm_subsertifikasi = t1.ssm_subsertifikasi
			)
			GROUP BY ssm_subsertifikasi");
		return $query->result();
	}

	function getskormahasiswa($id_sertifikasi, $id_mahasiswa)
	{
		$this->db->join('ssc_sertifikasi_mahasiswa', 'ssc_sertifikasi_mahasiswa.sm_id = ssc_subsertifikasi_mahasiswa.ssu_sertifikasi_mahasiswa');
		$this->db->where('ssc_sertifikasi_mahasiswa.sm_sertifikasi', $id_sertifikasi);
		$this->db->where('ssc_sertifikasi_umum.sm_peserta', $id_mahasiswa);
		return $this->db->get('ssc_subsertifikasi_mahasiswa');
	}

	function listsertifikasicountmahasiswa($id_sertifikasi, $id_mahasiswa)
	{
		$this->db->join('ssc_subsertifikasi_mahasiswa', 'ssc_subsertifikasi_mahasiswa.ssm_sertifikasi_mahasiswa = ssc_sertifikasi_mahasiswa.sm_id');
		$this->db->where('sm_sertifikasi', $id_sertifikasi);
		$this->db->where('sm_mahasiswa', $id_mahasiswa);
		$this->db->where('ssm_status', 'Lunas');
		// $this->db->where('ssm_ishadir', 'y');
		$this->db->where('ssm_skor is NOT NULL');
		return $this->db->get('ssc_sertifikasi_mahasiswa');
	}

	function listsertifikasimahasiswalistid($id_sertifikasi, $id_mahasiswa)
	{
		$this->db->join('ssc_sertifikasi_mahasiswa', 'ssc_sertifikasi_mahasiswa.sm_id = ssc_subsertifikasi_mahasiswa.ssm_sertifikasi_mahasiswa');
		$this->db->join('ssc_sertifikasi', 'ssc_sertifikasi.cert_id = ssc_sertifikasi_mahasiswa.sm_sertifikasi');
		$this->db->where('ssc_sertifikasi_mahasiswa.sm_sertifikasi', $id_sertifikasi);
		$this->db->where('ssc_sertifikasi_mahasiswa.sm_mahasiswa', $id_mahasiswa);
		$this->db->where('ssm_status', 'Lunas');
		// $this->db->where('ssm_ishadir', 'y');
		$this->db->where('ssm_skor is NOT NULL');
		$this->db->group_by('ssc_sertifikasi_mahasiswa.sm_sertifikasi');
		return $this->db->get('ssc_subsertifikasi_mahasiswa')->row();
	}

	function insert_mahasiswa($id_sertifikasi, $id_mahasiswa, $data)
	{
		$this->db->where('sm_sertifikasi', $id_sertifikasi);
		$this->db->where('sm_mahasiswa', $id_mahasiswa);
		return $this->db->update('ssc_sertifikasi_mahasiswa', $data);
	}


	function generateIDLOG($npm)
	{
		$query = $this->db->query("SELECT MAX(RIGHT(ssc_log_sertifikasi.ls_id,3)) as total FROM ssc_log_sertifikasi WHERE ls_id LIKE '" . $npm . "%'");
		return $query->row();
	}

	function insert_log($data_log)
	{
		return $this->db->insert('ssc_log_sertifikasi', $data_log);
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

	function cek_penilaian($id_sertifikasi)
	{
		$this->db->where('pn_sertifikasi', $id_sertifikasi);
		return $this->db->get('ssc_penilaian')->num_rows();
	}
}

/* End of file Inputnilaisertifikasifinal_model.php */
/* Location: ./application/models/Inputnilaisertifikasifinal_model.php */