<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absen_seminar extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('absenseminar_model');

		if (!isset($this->session->userdata['username'])) {
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}
	}

	public function absen_umum($id)
	{
		$data = [
			'title'	=> 'Absen Seminar Umum',
			'list'      => $this->absenseminar_model->listseminarumum($id),
			'view'	=> 'admin/absen_seminar/umum/form'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function simpan_umum()
	{
		$absen =  $this->absenseminar_model->listseminarumum($this->input->post('id_seminar'));
		foreach ($absen as $a) {
			$data[$a->su_peserta] = [
				'su_ishadir'        => $this->input->post('name' . str_replace('.', '_', $a->su_peserta)),
				'su_userupdate'     => $this->session->userdata('username'),
				'su_lastupdate'     => date('Y-m-d H:i:s')
			];
		}

		if ($this->absenseminar_model->update_umum($this->input->post('id_seminar'), $this->input->post('id_peserta'), $data)) {
			$this->session->set_flashdata('message', 'Absen berhasil Ditambah');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('seminar'));
		} else {
			$this->session->set_flashdata('message', 'Absen gagal Ditambah');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('seminar'));
		}
	}

	public function absen_mahasiswa($id)
	{
		$mhs = array();

		$query = $this->absenseminar_model->listseminarmahasiswa($id);

		foreach ($query as $q) {
			$data_mhs = $this->absenseminar_model->getnama($q->smhs_mahasiswa);
			$mhs[$q->smhs_mahasiswa] = $data_mhs->name;
		}

		$data = [
			'title'	=> 'Absen Seminar Mahasiswa',
			'list'      => $query,
			'mhs'		=> $mhs,
			'view'	=> 'admin/absen_seminar/mahasiswa/form'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function simpan_mahasiswa()
	{
		$absen =  $this->absenseminar_model->listseminarmahasiswa($this->input->post('id_seminar'));
		foreach ($absen as $a) {
			$data[$a->smhs_mahasiswa] = [
				'smhs_ishadir'        => $this->input->post('name_' . $a->smhs_mahasiswa),
				'smhs_userupdate'    => $this->session->userdata('username'),
				'smhs_lastupdate'    => date('Y-m-d H:i:s')
			];
		}

		if ($this->absenseminar_model->update_mahasiswa($this->input->post('id_seminar'), $this->input->post('id_mahasiswa'), $data)) {
			$this->session->set_flashdata('message', 'Absen berhasil Ditambah');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('seminar'));
		} else {
			$this->session->set_flashdata('message', 'Absen gagal Ditambah');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('seminar'));
		}
	}
}

/* End of file Absen_seminar.php */
/* Location: ./application/controllers/Absen_seminar.php */