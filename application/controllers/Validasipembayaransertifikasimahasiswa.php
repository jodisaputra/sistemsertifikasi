<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Validasipembayaransertifikasimahasiswa extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('validasipembayaransertifikasimahasiswa_model');
		$this->load->model('sertifikasi_model');
		$this->load->helper('my_function_helper');
		if (!isset($this->session->userdata['username'])) {
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}
	}

	public function index()
	{
		$nama_mhs = array();

		$query =  $this->validasipembayaransertifikasimahasiswa_model->list()->result_array();

		foreach ($query as $q) {
			$data_mhs = $this->validasipembayaransertifikasimahasiswa_model->getnama($q['sm_mahasiswa']);
			$nama_mhs[$q['sm_mahasiswa']] = $data_mhs->name;
		}

		$listmhs = $this->validasipembayaransertifikasimahasiswa_model->list()->row_array();

		$data = [
			'title'	=> 'Validasi Pembayaran Sertifikasi Mahasiswa',
			'list'      => $query,
			'nama_mhs'	=> $nama_mhs,
			'sertifikasi' => $this->sertifikasi_model->get_all_sub_sertifikasi(),
			'view'	=> 'admin/validasipembayaran/pembayaransertifikasimahasiswa/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function cari()
	{
		$sertifikasi = $this->input->post('nama_sertifikasi');
		$bayar = $this->input->post('status_pembayaran');

		$nama_mhs = array();

		$query =  $this->validasipembayaransertifikasimahasiswa_model->filter($sertifikasi, $bayar)->result_array();

		foreach ($query as $q) {
			$data_mhs = $this->validasipembayaransertifikasimahasiswa_model->getnama($q['sm_mahasiswa']);
			$nama_mhs[$q['sm_mahasiswa']] = $data_mhs->name;
		}

		$listmhs = $this->validasipembayaransertifikasimahasiswa_model->list()->row_array();

		$data = [
			'title'	=> 'Validasi Pembayaran Sertifikasi Mahasiswa',
			'list'      => $query,
			'nama_mhs'	=> $nama_mhs,
			'sertifikasi' => $this->sertifikasi_model->get_all_sub_sertifikasi(),
			'view'	=> 'admin/validasipembayaran/pembayaransertifikasimahasiswa/index'
		];

		$this->load->view('admin/template/wrapper', $data);


	}

	public function detail($id_subsertifikasimahasiswa, $subsertifikasi, $mahasiswa)
	{
		$data = [
			'title'	=> 'Validasi Pembayaran Sertifikasi Umum',
			'list'      => $this->validasipembayaransertifikasimahasiswa_model->listbyid($id_subsertifikasimahasiswa, $subsertifikasi, $mahasiswa),
			'view'	=> 'admin/validasipembayaran/pembayaransertifikasimahasiswa/detail'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function setLunas($id_subsertifikasimahasiswa, $subsertifikasi, $mahasiswa)
	{
		//Cek status jika mahasiswa belum bayar tidak bisa set lunas atau tolak
		$cekstatus = $this->validasipembayaransertifikasimahasiswa_model->cekstatus($id_subsertifikasimahasiswa, $subsertifikasi, $mahasiswa);

		if ($cekstatus) {
			$this->session->set_flashdata('message', 'Mahasiswa belum melakukan pembayaran!');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('validasipembayaransertifikasimahasiswa'));
		} else {
			$data = [
				'ssm_keteranganpembayaran'     => 'Pembayaran Lunas',
				'ssm_status'                   => 'Lunas',
				'ssm_userupdate'               => $this->session->userdata('username'),
				'ssm_lastupdate'               => date('Y-m-d H:i:s')
			];

			if ($this->validasipembayaransertifikasimahasiswa_model->setLunas($id_subsertifikasimahasiswa, $subsertifikasi, $mahasiswa, $data)) {
				$this->session->set_flashdata('message', 'Data berhasil Diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('validasipembayaransertifikasimahasiswa'));
			} else {
				$this->session->set_flashdata('message', 'Data gagal Diubah');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('validasipembayaransertifikasimahasiswa'));
			}
		}
	}

	public function setTolak()
	{
		//Cek status jika mahasiswa belum bayar tidak bisa set lunas atau tolak
		$cekstatus = $this->validasipembayaransertifikasimahasiswa_model->cekstatus($this->input->post('id_subsertifikasimahasiswa'), $this->input->post('subsertifikasi'), $this->input->post('mahasiswa'));

		if ($cekstatus) {
			$this->session->set_flashdata('message', 'Mahasiswa belum melakukan pembayaran!');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('validasipembayaransertifikasimahasiswa'));
		} else {
			$data = [
				'ssm_keteranganpembayaran'     => $this->input->post('keterangan'),
				'ssm_status'                   => 'Tolak',
				'ssm_userupdate'               => $this->session->userdata('username'),
				'ssm_lastupdate'               => date('Y-m-d H:i:s')
			];

			if ($this->validasipembayaransertifikasimahasiswa_model->setTolak($this->input->post('id_subsertifikasimahasiswa'), $this->input->post('subsertifikasi'), $this->input->post('mahasiswa'), $data)) {
				$this->session->set_flashdata('message', 'Data berhasil Diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('validasipembayaransertifikasimahasiswa'));
			} else {
				$this->session->set_flashdata('message', 'Data gagal Diubah');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('validasipembayaransertifikasimahasiswa'));
			}
		}
	}

	public function inputtotal()
	{
		//Cek status jika mahasiswa belum bayar tidak bisa set lunas atau tolak
		$cekstatus = $this->validasipembayaransertifikasimahasiswa_model->cekstatus($this->input->post('id_subsertifikasimahasiswa'), $this->input->post('subsertifikasi'), $this->input->post('mahasiswa'));

		if ($cekstatus) {
			$this->session->set_flashdata('message', 'Mahasiswa belum melakukan pembayaran!');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('validasipembayaransertifikasimahasiswa'));
		} else {
			$data = [
				'ssm_totalbayar'     		   => preg_replace("/[^0-9]/", '', substr($this->input->post('total', TRUE), 2)),
				'ssm_userupdate'               => $this->session->userdata('username'),
				'ssm_lastupdate'               => date('Y-m-d H:i:s')
			];

			if ($this->validasipembayaransertifikasimahasiswa_model->inputtotal($this->input->post('id_subsertifikasimahasiswa'), $this->input->post('subsertifikasi'), $this->input->post('mahasiswa'), $data)) {
				$this->session->set_flashdata('message', 'Total bayar berhasil disimpan');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('validasipembayaransertifikasimahasiswa'));
			} else {
				$this->session->set_flashdata('message', 'Total bayar gagal disimpan');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('validasipembayaransertifikasimahasiswa'));
			}
		}
	}

	public function submit_checkall_setuju()
	{
		$checkall = $this->input->post('mhs');

		if ($checkall == NULL) {
			$this->session->set_flashdata('message', 'Tidak ada data yang dipilih !');
			$this->session->set_flashdata('tipe', 'error');
			redirect('validasipembayaransertifikasimahasiswa');
		} else {
			$mhs = $this->input->post('mhs');

			foreach ($mhs as $i) {
				$data[$i] = [
					'ssm_keteranganpembayaran'     => 'Pembayaran Lunas',
					'ssm_status'                   => 'Lunas',
					'ssm_userupdate'               => $this->session->userdata('username'),
					'ssm_lastupdate'               => date('Y-m-d H:i:s')
				];
			}

			if ($this->validasipembayaransertifikasimahasiswa_model->update_collectivemahasiswa($mhs, $data)) {
				$this->session->set_flashdata('message', 'Validasi Pembayaran Berhasil');
				$this->session->set_flashdata('tipe', 'success');
				redirect('validasipembayaransertifikasimahasiswa');
			} else {
				$this->session->set_flashdata('message', 'Validasi Pembayaran Gagal');
				$this->session->set_flashdata('tipe', 'error');
				redirect('validasipembayaransertifikasimahasiswa');
			}
		}
	}

	public function cetak_rop($id_ssu, $id_subsertifikasi, $id_sertifikasi_mahasiswa)
	{
		$mhs = array();
		$query = $this->validasipembayaransertifikasimahasiswa_model->listmahasiswarop($id_subsertifikasi);

		foreach ($query as $q) {
			$data_mhs = $this->validasipembayaransertifikasimahasiswa_model->getnama($q->sm_mahasiswa);
			$mhs[$q->sm_mahasiswa] = [
				'nama' => $data_mhs->name,
				'prodi'	=> $data_mhs->major
			];
		}

		$data_transfer = $this->validasipembayaransertifikasimahasiswa_model->getdatarop($id_ssu, $id_subsertifikasi, $id_sertifikasi_mahasiswa);
		$dana = "Rp " . number_format($data_transfer['ssm_totalbayar'], 2, ',', '.');
		$terbilang = terbilang(intval($data_transfer['ssm_totalbayar']));

		$data = [
			'id'			=> $data_transfer['ssm_subsertifikasi'],
			'npm'			=> $data_transfer['sm_mahasiswa'],
			'nama'			=> $mhs,
			'diterima_dari'	=> $data_transfer['ssm_namapemilik'],
			'bank'			=> $data_transfer['ssm_bank'],
			'total_dana'	=> $dana,
			'terbilang'		=> $terbilang
		];
		// header('content-type: application/json');
		// echo json_encode($data_transfer);
		// die;
		$this->load->view('admin/validasipembayaran/pembayaransertifikasimahasiswa/format_ropmhs', $data);
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

/* End of file Validasipembayaransertifikasimahasiswa.php */
/* Location: ./application/controllers/Validasipembayaransertifikasimahasiswa.php */