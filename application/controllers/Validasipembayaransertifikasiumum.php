<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Validasipembayaransertifikasiumum extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('my_function_helper');
		$this->load->model('validasipembayaransertifikasiumum_model');
		if (!isset($this->session->userdata['username'])) {
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}
	}

	public function index()
	{
		$query = $this->validasipembayaransertifikasiumum_model->list()->row_array();

		$data = [
			'title'	=> 'Validasi Pembayaran Sertifikasi Umum',
			'list'      => $this->validasipembayaransertifikasiumum_model->list()->result(),
			// 'listbyid'  => $this->validasipembayaransertifikasiumum_model->listbyid($query['ssu_id'], $query['ssu_subsertifikasi'], $query['ssu_sertifikasi_umum']),
			'view'	=> 'admin/validasipembayaran/pembayaransertifikasiumum/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function detail($id_subsertifikasiumum, $subsertifikasi, $peserta)
	{
		$data = [
			'title'	=> 'Validasi Pembayaran Seminar Mahasiswa',
			'list'      => $this->validasipembayaransertifikasiumum_model->listbyid($id_subsertifikasiumum, $subsertifikasi, $peserta),
			'view'	=> 'admin/validasipembayaran/pembayaransertifikasiumum/detail'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function setLunas($id_subsertifikasiumum, $subsertifikasi, $peserta)
	{
		//Cek status jika mahasiswa belum bayar tidak bisa set lunas atau tolak
		$cekstatus = $this->validasipembayaransertifikasiumum_model->cekstatus($id_subsertifikasiumum, $subsertifikasi, $peserta);

		if ($cekstatus) {
			$this->session->set_flashdata('message', 'Peserta belum melakukan pembayaran!');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('validasipembayaransertifikasiumum'));
		} else {
			$data = [
				'ssu_keteranganpembayaran'     => 'Pembayaran Lunas',
				'ssu_status'                   => 'Lunas',
				'ssu_userupdate'               => $this->session->userdata('username'),
				'ssu_lastupdate'               => date('Y-m-d H:i:s')
			];

			if ($this->validasipembayaransertifikasiumum_model->setLunas($id_subsertifikasiumum, $subsertifikasi, $peserta, $data)) {
				$this->session->set_flashdata('message', 'Data berhasil Diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('validasipembayaransertifikasiumum'));
			} else {
				$this->session->set_flashdata('message', 'Data gagal Diubah');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('validasipembayaransertifikasiumum'));
			}
		}
	}

	public function setTolak()
	{
		//Cek status jika mahasiswa belum bayar tidak bisa set lunas atau tolak
		$cekstatus = $this->validasipembayaransertifikasiumum_model->cekstatus($this->input->post('id_subsertifikasiumum'), $this->input->post('subsertifikasi'), $this->input->post('peserta'));

		if ($cekstatus) {
			$this->session->set_flashdata('message', 'Peserta belum melakukan pembayaran!');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('validasipembayaransertifikasiumum'));
		} else {
			$data = [
				'ssu_keteranganpembayaran'     => $this->input->post('keterangan'),
				'ssu_status'                   => 'Tolak',
				'ssu_userupdate'               => $this->session->userdata('username'),
				'ssu_lastupdate'               => date('Y-m-d H:i:s')
			];

			if ($this->validasipembayaransertifikasiumum_model->setTolak($this->input->post('id_subsertifikasiumum'), $this->input->post('subsertifikasi'), $this->input->post('peserta'), $data)) {
				$this->session->set_flashdata('message', 'Data berhasil Diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('validasipembayaransertifikasiumum'));
			} else {
				$this->session->set_flashdata('message', 'Data gagal Diubah');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('validasipembayaransertifikasiumum'));
			}
		}
	}

	public function inputtotal()
	{
		//Cek status jika mahasiswa belum bayar tidak bisa set lunas atau tolak
		$cekstatus = $this->validasipembayaransertifikasiumum_model->cekstatus($this->input->post('id_subsertifikasiumum'), $this->input->post('subsertifikasi'), $this->input->post('peserta'));

		if ($cekstatus) {
			$this->session->set_flashdata('message', 'Peserta belum melakukan pembayaran!');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('validasipembayaransertifikasiumum'));
		} else {
			$data = [
				'ssu_totalbayar'     		   => preg_replace("/[^0-9]/", '', substr($this->input->post('total', TRUE), 2)),
				'ssu_userupdate'               => $this->session->userdata('username'),
				'ssu_lastupdate'               => date('Y-m-d H:i:s')
			];

			if ($this->validasipembayaransertifikasiumum_model->inputtotal($this->input->post('id_subsertifikasiumum'), $this->input->post('subsertifikasi'), $this->input->post('peserta'), $data)) {
				$this->session->set_flashdata('message', 'Total biaya berhasil disimpan');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('validasipembayaransertifikasiumum'));
			} else {
				$this->session->set_flashdata('message', 'Total biaya gagal disimpan');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('validasipembayaransertifikasiumum'));
			}
		}
	}

	public function submit_checkall_setuju()
	{
		$checkall = $this->input->post('umum');

		if ($checkall == NULL) {
			$this->session->set_flashdata('message', 'Tidak ada data yang dipilih !');
			$this->session->set_flashdata('tipe', 'error');
			redirect('validasipembayaransertifikasiumum');
		} else {
			$umum = $this->input->post('umum');

			foreach ($umum as $i) {
				$data[$i] = [
					'ssu_keteranganpembayaran'     => 'Pembayaran Lunas',
					'ssu_status'                   => 'Lunas',
					'ssu_userupdate'               => $this->session->userdata('username'),
					'ssu_lastupdate'               => date('Y-m-d H:i:s')
				];
			}

			if ($this->validasipembayaransertifikasiumum_model->update_collectiveumum($umum, $data)) {
				$this->session->set_flashdata('message', 'Validasi Pembayaran Berhasil');
				$this->session->set_flashdata('tipe', 'success');
				redirect('validasipembayaransertifikasiumum');
			} else {
				$this->session->set_flashdata('message', 'Validasi Pembayaran gagal');
				$this->session->set_flashdata('tipe', 'error');
				redirect('validasipembayaransertifikasiumum');
			}
		}
	}

	public function cetak_rop($id_ssu, $id_subsertifikasi, $id_sertifikasi_umum)
	{
		$data_transfer = $this->validasipembayaransertifikasiumum_model->getdatarop($id_ssu, $id_subsertifikasi, $id_sertifikasi_umum);

		$dana = "Rp " . number_format($data_transfer['ssu_totalbayar'], 2, ',', '.');
		$terbilang = terbilang(intval($data_transfer['ssu_totalbayar']));

		$data = [
			'id'			=> $data_transfer['ssu_subsertifikasi'],
			'email'			=> $data_transfer['pu_email'],
			'nama'			=> $data_transfer['pu_nama'],
			'diterima_dari'	=> $data_transfer['ssu_namapemilik'],
			'bank'			=> $data_transfer['ssu_bank'],
			'total_dana'	=> $dana,
			'terbilang'		=> $terbilang
		];
		// header('content-type: application/json');
		// echo json_encode($data_transfer);
		// die;
		$this->load->view('admin/validasipembayaran/pembayaransertifikasiumum/format_ropumum', $data);
		$this->load->library('pdf');

		$paper_size         = 'A4';
		$orientation        = 'potrait';
		$html               = $this->output->get_output();

		$this->pdf->set_paper($paper_size, $orientation);
		$this->pdf->load_html($html);
		$this->pdf->render();
		$this->pdf->stream("ROP.pdf", array('Attachment' => 0));
	}
}

/* End of file Validasipembayaransertifikasiumum.php */
/* Location: ./application/controllers/Validasipembayaransertifikasiumum.php */