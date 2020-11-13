<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Batchsertifikasi_model extends CI_Model
{
    public $table = 'ssc_batch_sertifikasi';
    public $id    = 'bs_id';

    function listbatch()
    {
        $this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_batch_sertifikasi.bs_subsertifikasi');
        $this->db->join('ssc_sertifikasi', 'ssc_sertifikasi.cert_id = ssc_subsertifikasi.scert_sertifikasi');
        $this->db->where('ssc_sertifikasi.cert_isaktif', 'y');
        $this->db->where('ssc_subsertifikasi.scert_isaktif', 'y');
        return $this->db->get($this->table)->result();
    }

    function listbatchbyid($id)
    {
        $this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_batch_sertifikasi.bs_subsertifikasi');
        $this->db->join('ssc_sertifikasi', 'ssc_sertifikasi.cert_id = ssc_subsertifikasi.scert_sertifikasi');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function listjadwal($id)
    {
        $this->db->where('js_batch', $id);
        return $this->db->get('ssc_jadwal_subsertifikasi')->row();
    }

    function listbatchbyidhome($id)
    {
        $this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_batch_sertifikasi.bs_subsertifikasi');
        $this->db->join('ssc_sertifikasi', 'ssc_sertifikasi.cert_id = ssc_subsertifikasi.scert_sertifikasi');
        $this->db->join('ssc_pelatih_subsertifikasi', 'ssc_pelatih_subsertifikasi.ps_batch = ssc_batch_sertifikasi.bs_id');
        $this->db->join('ssc_jadwal_subsertifikasi', 'ssc_jadwal_subsertifikasi.js_batch = ssc_batch_sertifikasi.bs_id');
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

    function cek_sub_mahasiswa($id_sertifikasi_mahasiswa)
    {
        $this->db->where('ssm_sertifikasi_mahasiswa', $id_sertifikasi_mahasiswa);
        return $this->db->get('ssc_subsertifikasi_mahasiswa')->result();
    }

    function cek_sub_umum($id_sertifikasi_umum)
    {
        $this->db->where('ssu_sertifikasi_umum', $id_sertifikasi_umum);
        return $this->db->get('ssc_subsertifikasi_umum')->result();
    }

    function batchsertifikasikode()
    {
        $this->db->select_max('bs_id');
        $query = $this->db->get('ssc_batch_sertifikasi')->row();
        $id = $query->bs_id;
        if ($id) {
            $id = $id + 1;
        } else {
            $id = 1;
        }
        return $id;
    }

    function simpan_absen($absen)
    {
        foreach ($absen as $a) {
            $query = $this->db->insert('ssc_absen_sertifikasi', $a);
        }
        return $query;
    }

    function delete_absen($id_absen)
    {
        $this->db->where('as_id', $id_absen);
        $this->db->delete('ssc_absen_sertifikasi');
    }

    function generateidsertifikasiumum($kode)
    {
        $query = $this->db->query("SELECT MAX(RIGHT(ssc_sertifikasi_umum.srtu_id,3)) as total FROM ssc_sertifikasi_umum WHERE srtu_id LIKE '" . $kode . "%'");
        return $query->row();
    }

    function getidsertifikasiumum()
    {
        $email = $this->session->userdata('email');
        $this->db->select_max('srtu_id');
        $this->db->where('srtu_peserta', $email);
        $result = $this->db->get('ssc_sertifikasi_umum')->row();
        return $result->srtu_id;
    }

    function getidsertifikasimahasiswa()
    {
        $npm = $this->session->userdata('npm');
        $this->db->select_max('sm_id');
        $this->db->where('sm_mahasiswa', $npm);
        $result = $this->db->get('ssc_sertifikasi_mahasiswa')->row();
        return $result->sm_id;
    }

    function cek($email, $id_sertifikasi)
    {
        $this->db->join('ssc_sertifikasi_umum', 'ssc_sertifikasi_umum.srtu_id = ssc_subsertifikasi_umum.ssu_sertifikasi_umum');
        $this->db->where('ssc_sertifikasi_umum.srtu_peserta', $email);
        $this->db->where('ssc_sertifikasi_umum.srtu_sertifikasi', $id_sertifikasi);
        return $this->db->get('ssc_subsertifikasi_umum');
    }

    function updatetidaklulusumum($id_srtu, $id_sertifikasi, $id_peserta, $update)
    {
        $this->db->where('srtu_id', $id_srtu);
        $this->db->where('srtu_sertifikasi', $id_sertifikasi);
        $this->db->where('srtu_peserta', $id_peserta);
        return $this->db->update('ssc_sertifikasi_umum', $update);
    }

    function updatetidaklulusmahasiswa($id_srtu, $id_sertifikasi, $npm, $update)
    {
        $this->db->where('sm_id', $id_srtu);
        $this->db->where('sm_sertifikasi', $id_sertifikasi);
        $this->db->where('sm_mahasiswa', $npm);
        return $this->db->update('ssc_sertifikasi_mahasiswa', $update);
    }

    function cekmahasiswa($npm, $id_sertifikasi)
    {
        $this->db->join('ssc_sertifikasi_mahasiswa', 'ssc_sertifikasi_mahasiswa.sm_id = ssc_subsertifikasi_mahasiswa.ssm_sertifikasi_mahasiswa');
        // $this->db->where('ssm_batch', $id_batch);
        // $this->db->where('ssm_subsertifikasi', $id_subsertifikasi);
        $this->db->where('ssc_sertifikasi_mahasiswa.sm_mahasiswa', $npm);
        $this->db->where('ssc_sertifikasi_mahasiswa.sm_sertifikasi', $id_sertifikasi);
        return $this->db->get('ssc_subsertifikasi_mahasiswa');
    }

    function cekbelumlulushome($email, $sertifikasi, $id_subser)
    {
        $this->db->join('ssc_subsertifikasi_umum', 'ssc_sertifikasi_umum.srtu_id = ssc_subsertifikasi_umum.ssu_sertifikasi_umum');
        $this->db->where('srtu_peserta', $email);
        $this->db->where('srtu_sertifikasi', $sertifikasi);
        $this->db->where('ssc_subsertifikasi_umum.ssu_subsertifikasi', $id_subser);
        $this->db->where('srtu_status', 'Tidak Lulus');
        return $this->db->get('ssc_sertifikasi_umum');
    }

    function daftar_sertifikasi_umum($data)
    {
        return $this->db->insert('ssc_sertifikasi_umum', $data);
    }

    function daftar_sertifikasi_umum_tidaklulus($data)
    {
        return $this->db->insert('ssc_subsertifikasi_umum', $data);
    }

    function getssu_id($id_batch)
    {
        $this->db->where('ssu_batch', $id_batch);
        return $this->db->get('ssc_subsertifikasi_umum')->row();
    }

    function daftar_sertifikasi_mhs($data)
    {
        return $this->db->insert('ssc_sertifikasi_mahasiswa', $data);
    }

    function daftar_sertifikasi_mhs_tidaklulus($id_sertifikasi, $data)
    {
        $this->db->where('sm_id', $id_sertifikasi);
        return $this->db->update('ssc_sertifikasi_mahasiswa', $data);
    }

    function generateID($npm)
    {
        $query = $this->db->query("SELECT MAX(RIGHT(ssc_sertifikasi_mahasiswa.sm_id,3)) as total FROM ssc_sertifikasi_mahasiswa WHERE sm_id LIKE '" . $npm . "%'");
        return $query->row();
    }

    function generateIDsubsertifikasiumum($id_subsertifikasi)
    {
        $query = $this->db->query("SELECT MAX(RIGHT(ssc_subsertifikasi_umum.ssu_id,2)) as total FROM ssc_subsertifikasi_umum WHERE ssu_id LIKE '" . $id_subsertifikasi . "%'");
        return $query->row();
    }

    function insert_subsertifikasiumum($data2)
    {
        return $this->db->insert('ssc_subsertifikasi_umum', $data2);
    }

    function generateIDsubsertifikasimhs($id_subsertifikasi)
    {
        $query = $this->db->query("SELECT MAX(RIGHT(ssc_subsertifikasi_mahasiswa.ssm_id,2)) as total FROM ssc_subsertifikasi_mahasiswa WHERE ssm_id LIKE '" . $id_subsertifikasi . "%'");
        return $query->row();
    }

    function insert_subsertifikasimhs($data2)
    {
        return $this->db->insert('ssc_subsertifikasi_mahasiswa', $data2);
    }

    function cekjumlahtabel($id_batch)
    {
        $this->db->where('as_batch', $id_batch);
        return $this->db->get('ssc_absen_sertifikasi')->num_rows();
    }

    function cekid($id_batch)
    {
        $this->db->select_max('as_id');
        $this->db->where('as_batch', $id_batch);
        return $this->db->get('ssc_absen_sertifikasi')->row();
    }

    function detailabsen($id_batch)
    {
        $this->db->where('as_batch', $id_batch);
        return $this->db->get('ssc_absen_sertifikasi')->result();
    }

    function listbatchbysertifikasistatus()
    {
        $this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_batch_sertifikasi.bs_subsertifikasi');
        $this->db->join('ssc_sertifikasi', 'ssc_sertifikasi.cert_id = ssc_subsertifikasi.scert_sertifikasi');
        $this->db->where('ssc_sertifikasi.cert_isaktif', 'y');
        $this->db->where('ssc_subsertifikasi.scert_isaktif', 'y');
        return $this->db->get($this->table)->result();
    }
}
                        
/* End of file Batchsertifikasi_model.php */
