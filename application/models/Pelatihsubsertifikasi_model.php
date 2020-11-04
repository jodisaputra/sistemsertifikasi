<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Pelatihsubsertifikasi_model extends CI_Model {

    public $table = 'ssc_pelatih_subsertifikasi';

    function listpelatihsubsertifikasi($batch)
    {
        $this->db->join('ssc_batch_sertifikasi', 'ssc_batch_sertifikasi.bs_id = ssc_pelatih_subsertifikasi.ps_batch');
        $this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_batch_sertifikasi.bs_subsertifikasi');
        $this->db->where('ssc_pelatih_subsertifikasi.ps_batch', $batch);
        return $this->db->get($this->table)->result();
    }

    function listpelatihsubsertifikasibyid($id_batch, $id_pelatih)
    {
        $this->db->join('ssc_batch_sertifikasi', 'ssc_batch_sertifikasi.bs_id = ssc_pelatih_subsertifikasi.ps_batch');
        $this->db->join('ssc_subsertifikasi', 'ssc_subsertifikasi.scert_id = ssc_batch_sertifikasi.bs_subsertifikasi');
        $this->db->where('ps_batch', $id_batch);
        $this->db->where('ps_email', $id_pelatih);
        return $this->db->get($this->table)->row();
    }

    function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    function update($id_batch, $id_pelatih, $data)
    {
        $this->db->where('ps_batch', $id_batch);
        $this->db->where('ps_email', $id_pelatih);
        return $this->db->update($this->table, $data);
    }

    function delete($id_batch, $id_pelatih)
    {
        $this->db->where('ps_batch', $id_batch);
        $this->db->where('ps_email', $id_pelatih);
        return $this->db->delete($this->table);
    }
  

}

/* End of file Pelatihsubsertifikasi_model.php */

