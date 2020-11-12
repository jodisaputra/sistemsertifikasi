<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penilaian extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('penilaian_model');
		$this->load->model('sertifikasi_model');
		if (!isset($this->session->userdata['username'])) {
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}
	}

	public function index()
	{
		$data = [
			'title'	=> 'Penilaian',
			'list'      => $this->penilaian_model->list(),
			'view'	=> 'admin/penilaian/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function tambah()
	{
		$data = [
			'title'	=> 'Penilaian',
			'sertifikasi'      => $this->sertifikasi_model->get_all_sertifikasi(),
			'view'	=> 'admin/penilaian/tambah'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function simpan()
	{
		$this->form_validation->set_rules('sertifikasi', 'Sertifikasi', 'required');
		$this->form_validation->set_rules('nilai_min', 'Nilai Minimal', 'required|numeric');
		$this->form_validation->set_rules('nilai_max', 'Nilai Maximal', 'required|numeric');
		$this->form_validation->set_rules('grade', 'Grade', 'required');
		$this->form_validation->set_rules('penghargaan', 'Penghargaan', 'required');
		$this->form_validation->set_rules('lembaga', 'Lembaga', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');

		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_message('numeric', 'Mohon isi {field} dengan angka saja!');

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->tambah();
		} else {

			$data = [
				'pn_sertifikasi'        => $this->input->post('sertifikasi'),
				'pn_min'                => $this->input->post('nilai_min'),
				'pn_max'                => $this->input->post('nilai_max'),
				'pn_grade'              => $this->input->post('grade'),
				'pn_penghargaan'        => $this->input->post('penghargaan'),
				'pn_lembagasertifikat'  => $this->input->post('lembaga'),
				'pn_status'             => $this->input->post('status'),
				'pn_userupdate'         => $this->session->userdata('username'),
				'pn_lastupdate'         => date('Y-m-d H:i:s')
			];

			if ($this->penilaian_model->insert($data)) {
				$this->session->set_flashdata('message', 'Data berhasil disimpan');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('penilaian'));
			} else {
				$this->session->set_flashdata('message', 'Data gagal disimpan');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('penilaian'));
			}
		}
	}

	public function ubah($id)
	{
		$row = $this->penilaian_model->listbyid($id);

		if ($row) {
			$data = [
				'title'	=> 'Pelatih Sertifikasi',
				'sertifikasi'   => $this->sertifikasi_model->get_all_sertifikasi(),
				'list'             => $row,
				'view'	=> 'admin/penilaian/ubah'
			];

			$this->load->view('admin/template/wrapper', $data);
		} else {
			$this->session->set_flashdata('message', 'Data tidak ada');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('penilaian'));
		}
	}

	public function simpan_perubahan()
	{
		$this->form_validation->set_rules('sertifikasi', 'Sertifikasi', 'required');
		$this->form_validation->set_rules('nilai_min', 'Nilai Minimal', 'required|numeric');
		$this->form_validation->set_rules('nilai_max', 'Nilai Maximal', 'required|numeric');
		$this->form_validation->set_rules('grade', 'Grade', 'required');
		$this->form_validation->set_rules('penghargaan', 'Penghargaan', 'required');
		$this->form_validation->set_rules('lembaga', 'Lembaga', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');

		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_message('numeric', 'Mohon isi {field} dengan angka saja!');

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->ubah($this->input->post('penilaian_id'));
		} else {
			$data = [
				'pn_sertifikasi'        => $this->input->post('sertifikasi'),
				'pn_min'                => $this->input->post('nilai_min'),
				'pn_max'                => $this->input->post('nilai_max'),
				'pn_grade'              => $this->input->post('grade'),
				'pn_penghargaan'        => $this->input->post('penghargaan'),
				'pn_lembagasertifikat'  => $this->input->post('lembaga'),
				'pn_status'             => $this->input->post('status'),
				'pn_userupdate'         => $this->session->userdata('email'),
				'pn_lastupdate'         => date('Y-m-d H:i:s')
			];

			if ($this->penilaian_model->update($this->input->post('penilaian_id'), $data)) {
				$this->session->set_flashdata('message', 'Data berhasil diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('penilaian'));
			} else {
				$this->session->set_flashdata('message', 'Data gagal diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('penilaian'));
			}
		}
	}

	public function delete($id)
	{
		if ($this->penilaian_model->delete($id)) {
			$this->session->set_flashdata('message', 'Data berhasil dihapus');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('penilaian'));
		} else {
			$this->session->set_flashdata('message', 'Data gagal dihapus');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('penilaian'));
		}
	}
}

/* End of file Penilaian.php */
/* Location: ./application/controllers/Penilaian.php */