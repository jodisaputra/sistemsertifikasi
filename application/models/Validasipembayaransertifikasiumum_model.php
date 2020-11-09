<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Validasipembayaransertifikasiumum_model extends CI_Model
{

    public $table = 'ssc_subsertifikasi_umum';

    function list()
    {
        $this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_subsertifikasi_umum.ssu_subsertifikasi');
        $this->db->join('ssc_sertifikasi_umum', 'ssc_sertifikasi_umum.srtu_id = ssc_subsertifikasi_umum.ssu_sertifikasi_umum');
        $this->db->join('ssc_peserta_umum', 'ssc_peserta_umum.pu_email = ssc_sertifikasi_umum.srtu_peserta');
        return $this->db->get($this->table);
    }

    function listbyid($id_subsertifikasiumum, $subsertifikasi, $peserta)
    {
        $this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_subsertifikasi_umum.ssu_subsertifikasi');
        $this->db->join('ssc_sertifikasi_umum', 'ssc_sertifikasi_umum.srtu_id = ssc_subsertifikasi_umum.ssu_sertifikasi_umum');
        $this->db->join('ssc_peserta_umum', 'ssc_peserta_umum.pu_email = ssc_sertifikasi_umum.srtu_peserta');
        $this->db->where('ssu_id', $id_subsertifikasiumum);
        $this->db->where('ssu_subsertifikasi', $subsertifikasi);
        $this->db->where('ssu_sertifikasi_umum', $peserta);
        return $this->db->get($this->table)->row();
    }

    function cekstatus($id_subsertifikasiumum, $subsertifikasi, $peserta)
    {
        $this->db->where('ssu_id', $id_subsertifikasiumum);
        $this->db->where('ssu_subsertifikasi', $subsertifikasi);
        $this->db->where('ssu_sertifikasi_umum', $peserta);
        $this->db->where('ssu_status', 'Menunggu Pembayaran');
        return $this->db->get($this->table)->row();
    }

    function setLunas($id_subsertifikasiumum, $subsertifikasi, $peserta, $data)
    {
        $this->db->where('ssu_id', $id_subsertifikasiumum);
        $this->db->where('ssu_subsertifikasi', $subsertifikasi);
        $this->db->where('ssu_sertifikasi_umum', $peserta);
        return $this->db->update($this->table, $data);
    }

    function setTolak($id_subsertifikasiumum, $subsertifikasi, $peserta, $data)
    {
        $this->db->where('ssu_id', $id_subsertifikasiumum);
        $this->db->where('ssu_subsertifikasi', $subsertifikasi);
        $this->db->where('ssu_sertifikasi_umum', $peserta);
        return $this->db->update($this->table, $data);
    }

    function update_collectiveumum($umum, $data)
    {
        foreach ($umum as $id) {
            $this->db->where('ssu_id', $id);
            $this->db->update($this->table, $data[$id]);
        }
        return TRUE;
    }

    function inputtotal($id_subsertifikasiumum, $subsertifikasi, $peserta, $data)
    {
        $this->db->where('ssu_id', $id_subsertifikasiumum);
        $this->db->where('ssu_subsertifikasi', $subsertifikasi);
        $this->db->where('ssu_sertifikasi_umum', $peserta);
        return $this->db->update($this->table, $data);
    }

    function getdatarop($id_subsertifikasiumum, $subsertifikasi, $peserta)
    {
        $this->db->join('ssc_sertifikasi_umum', 'ssc_sertifikasi_umum.srtu_id = ssc_subsertifikasi_umum.ssu_sertifikasi_umum');
        $this->db->join('ssc_peserta_umum', 'ssc_peserta_umum.pu_email = ssc_sertifikasi_umum.srtu_peserta');
        $this->db->where('ssu_id', $id_subsertifikasiumum);
        $this->db->where('ssu_subsertifikasi', $subsertifikasi);
        $this->db->where('ssu_sertifikasi_umum', $peserta);
        return $this->db->get($this->table)->row_array();
    }
}

/* End of file Validasipembayaransertifikasiumum_model.php */
/* Location: ./application/models/Validasipembayaransertifikasiumum_model.php */