<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Validasipembayaranseminarumum extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('validasipembayaranseminarumum_model');
		if (!isset($this->session->userdata['username'])) {
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}
	}

	public function index()
	{
		$query = $this->validasipembayaranseminarumum_model->list()->row_array();
		$data = [
			'title'	=> 'Validasi Pembayaran Seminar Umum',
			'list'          => $this->validasipembayaranseminarumum_model->list()->result(),
			'listbyid'      => $this->validasipembayaranseminarumum_model->listbyid($query['su_seminar'], $query['su_peserta']),
			'view'	=> 'admin/validasipembayaran/pembayaranseminarumum/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function detail($seminar, $email)
	{
		$data = [
			'title'	=> 'Validasi Pembayaran Seminar Umum',
			'list'      => $this->validasipembayaranseminarumum_model->listbyid($seminar, $email),
			'view'	=> 'admin/validasipembayaran/pembayaranseminarumum/detail'
		];
		// header('content-type: application/json');
		// echo json_encode($data);
		// die;

		$this->load->view('admin/template/wrapper', $data);
	}

	public function setLunas($seminar, $email)
	{
		//Cek status jika mahasiswa belum bayar tidak bisa set lunas atau tolak
		$cekstatus = $this->validasipembayaranseminarumum_model->cekstatus($seminar, $email);

		if ($cekstatus) {
			$this->session->set_flashdata('message', 'Peserta belum melakukan pembayaran!');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('validasipembayaranseminarumum'));
		} else {
			$data = [
				'su_keteranganpembayaran'     => 'Pembayaran Lunas',
				'su_status'                   => 'Lunas',
				'su_userupdate'               => $this->session->userdata('username'),
				'su_lastupdate'               => date('Y-m-d H:i:s')
			];

			if ($this->validasipembayaranseminarumum_model->setLunas($seminar, $email, $data)) {
				$this->session->set_flashdata('message', 'Data berhasil Diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('validasipembayaranseminarumum'));
			} else {
				$this->session->set_flashdata('message', 'Data gagal Diubah');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('validasipembayaranseminarumum'));
			}
		}
	}

	public function setTolak()
	{
		//Cek status jika mahasiswa belum bayar tidak bisa set lunas atau tolak
		$cekstatus = $this->validasipembayaranseminarumum_model->cekstatus($this->input->post('seminar'), $this->input->post('idpeserta'));

		if ($cekstatus) {
			$this->session->set_flashdata('message', 'Peserta belum melakukan pembayaran!');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('validasipembayaranseminarumum'));
		} else {
			$data = [
				'su_keteranganpembayaran'     => $this->input->post('keterangan'),
				'su_status'                   => 'Tolak',
				'su_userupdate'               => $this->session->userdata('username'),
				'su_lastupdate'               => date('Y-m-d H:i:s')
			];

			if ($this->validasipembayaranseminarumum_model->setTolak($this->input->post('seminar'), $this->input->post('idpeserta'), $data)) {
				$this->session->set_flashdata('message', 'Data berhasil Diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('validasipembayaranseminarumum'));
			} else {
				$this->session->set_flashdata('message', 'Data gagal Diubah');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('validasipembayaranseminarumum'));
			}
		}
	}

	public function submit_checkall_setuju()
	{
		$checkall = $this->input->post('umum');

		if ($checkall == NULL) {
			$this->session->set_flashdata('message', 'Tidak ada data yang dipilih !');
			$this->session->set_flashdata('tipe', 'error');
			redirect('validasipembayaranseminarumum');
		} else {
			$umum = $this->input->post('umum');
			$seminar = $this->input->post('seminar');

			foreach ($umum as $i) {
				$data[$i] = [
					'su_keteranganpembayaran'     => 'Pembayaran Lunas',
					'su_status'                   => 'Lunas',
					'su_userupdate'               => $this->session->userdata('username'),
					'su_lastupdate'               => date('Y-m-d H:i:s')
				];
			}

			if ($this->validasipembayaranseminarumum_model->update_collectiveumum($umum, $seminar, $data)) {
				$this->session->set_flashdata('message', 'Validasi Pembayaran Berhasil');
				$this->session->set_flashdata('tipe', 'success');
				redirect('validasipembayaranseminarumum');
			} else {
				$this->session->set_flashdata('message', 'Validasi Pembayaran Gagal');
				$this->session->set_flashdata('tipe', 'error');
				redirect('validasipembayaranseminarumum');
			}
		}
	}
}

/* End of file Validasipembayaranseminarumum.php */
/* Location: ./application/controllers/Validasipembayaranseminarumum.php */