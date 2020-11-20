<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Validasipembayaranseminarmahasiswa extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('validasipembayaranseminarmahasiswa_model');
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

		$query = $this->validasipembayaranseminarmahasiswa_model->list()->result_array();

		// $listmhs = $this->validasipembayaranseminarmahasiswa_model->list()->row_array();

		foreach ($query as $q) {
			$data_mhs = $this->validasipembayaranseminarmahasiswa_model->getnama($q['smhs_mahasiswa']);
			$nama_mhs[$q['smhs_mahasiswa']] = $data_mhs->name;
		}

		$data = [
			'title'	=> 'Validasi Pembayaran Seminar Mahasiswa',
			'list'          => $query,
			'nama_mhs'		=> $nama_mhs,
			// 'listbyid'      => $this->validasipembayaranseminarmahasiswa_model->listbyid($listmhs['smhs_mahasiswa'], $listmhs['smhs_seminar']),
			'view'	=> 'admin/validasipembayaran/pembayaranseminarmahasiswa/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function detail($npm, $seminar)
	{
		$mhs = $this->validasipembayaranseminarmahasiswa_model->getnama($npm);

		$data = [
			'title'	=> 'Validasi Pembayaran Seminar Mahasiswa',
			'list'      => $this->validasipembayaranseminarmahasiswa_model->listbyid($npm, $seminar),
			'mahasiswa'	=> $mhs->name,
			'view'	=> 'admin/validasipembayaran/pembayaranseminarmahasiswa/detail'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function setLunas($npm, $seminar)
	{
		//Cek status jika mahasiswa belum bayar tidak bisa set lunas atau tolak
		$cekstatus = $this->validasipembayaranseminarmahasiswa_model->cekstatus($npm, $seminar);

		if ($cekstatus) {
			$this->session->set_flashdata('message', 'Mahasiswa belum melakukan pembayaran!');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('validasipembayaranseminarmahasiswa'));
		} else {
			$data = [
				'smhs_keteranganpembayaran'     => 'Pembayaran Lunas',
				'smhs_status'                   => 'Lunas',
				'smhs_userupdate'               => $this->session->userdata('username'),
				'smhs_lastupdate'               => date('Y-m-d H:i:s')
			];

			if ($this->validasipembayaranseminarmahasiswa_model->setLunas($npm, $seminar, $data)) {
				$this->session->set_flashdata('message', 'Data berhasil Diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('validasipembayaranseminarmahasiswa'));
			} else {
				$this->session->set_flashdata('message', 'Data gagal Diubah');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('validasipembayaranseminarmahasiswa'));
			}
		}
	}

	public function setTolak()
	{
		//Cek status jika mahasiswa belum bayar tidak bisa set lunas atau tolak
		$cekstatus = $this->validasipembayaranseminarmahasiswa_model->cekstatus($this->input->post('idmahasiswa'), $this->input->post('seminar'));

		if ($cekstatus) {
			$this->session->set_flashdata('message', 'Mahasiswa belum melakukan pembayaran!');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('validasipembayaranseminarmahasiswa'));
		} else {
			$data = [
				'smhs_keteranganpembayaran'     => $this->input->post('keterangan'),
				'smhs_status'                   => 'Tolak',
				'smhs_userupdate'               => $this->session->userdata('username'),
				'smhs_lastupdate'               => date('Y-m-d H:i:s')
			];

			if ($this->validasipembayaranseminarmahasiswa_model->setTolak($this->input->post('idmahasiswa'), $this->input->post('seminar'), $data)) {
				$this->session->set_flashdata('message', 'Data berhasil Diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('validasipembayaranseminarmahasiswa'));
			} else {
				$this->session->set_flashdata('message', 'Data gagal Diubah');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('validasipembayaranseminarmahasiswa'));
			}
		}
	}

	public function inputtotal()
	{
		//Cek status jika mahasiswa belum bayar tidak bisa set lunas atau tolak
		$cekstatus = $this->validasipembayaranseminarmahasiswa_model->cekstatus($this->input->post('idmahasiswa'), $this->input->post('seminar'));

		if ($cekstatus) {
			$this->session->set_flashdata('message', 'Mahasiswa belum melakukan pembayaran!');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('validasipembayaranseminarmahasiswa'));
		} else {
			$data = [
				'smhs_totalbayar'		        => preg_replace("/[^0-9]/", '', substr($this->input->post('total', TRUE), 2)),
				'smhs_userupdate'               => $this->session->userdata('username'),
				'smhs_lastupdate'               => date('Y-m-d H:i:s')
			];

			if ($this->validasipembayaranseminarmahasiswa_model->inputtotal($this->input->post('idmahasiswa'), $this->input->post('seminar'), $data)) {
				$this->session->set_flashdata('message', 'Total bayar berhasil disimpan');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('validasipembayaranseminarmahasiswa'));
			} else {
				$this->session->set_flashdata('message', 'Total bayar gagal disimpan');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('validasipembayaranseminarmahasiswa'));
			}
		}
	}

	public function submit_checkall_setuju()
	{
		$checkall = $this->input->post('mhs');

		if ($checkall == NULL) {
			$this->session->set_flashdata('message', 'Tidak ada data yang dipilih !');
			$this->session->set_flashdata('tipe', 'error');
			redirect('validasipembayaranseminarmahasiswa');
		} else {
			$mhs = $this->input->post('mhs');
			$seminar = $this->input->post('seminar');

			foreach ($mhs as $i) {
				$data[$i] = [
					'smhs_keteranganpembayaran'     => 'Pembayaran Lunas',
					'smhs_status'                   => 'Lunas',
					'smhs_userupdate'               => $this->session->userdata('email'),
					'smhs_lastupdate'               => date('Y-m-d H:i:s')
				];
			}

			if ($this->validasipembayaranseminarmahasiswa_model->update_collectivemahasiswa($mhs, $seminar, $data)) {
				$this->session->set_flashdata('message', 'Validasi Pembayaran Berhasil');
				$this->session->set_flashdata('tipe', 'success');
				redirect('validasipembayaranseminarmahasiswa');
			} else {
				$this->session->set_flashdata('message', 'Validasi Pembayaran Gagal');
				$this->session->set_flashdata('tipe', 'error');
				redirect('validasipembayaranseminarmahasiswa');
			}
		}
	}

	public function cetak_rop($npm, $seminar)
	{
		$mhs = array();
		$query = $this->validasipembayaranseminarmahasiswa_model->listseminarmahasiswa($seminar);

		foreach ($query as $q) {
			$data_mhs = $this->validasipembayaranseminarmahasiswa_model->getnama($q->smhs_mahasiswa);
			$mhs[$q->smhs_mahasiswa] = [
				'nama' => $data_mhs->name,
				'prodi'	=> $data_mhs->major
			];
		}

		$data_transfer = $this->validasipembayaranseminarmahasiswa_model->getdatarop($npm, $seminar);
		$dana = "Rp " . number_format($data_transfer['smhs_totalbayar'], 2, ',', '.');
		$terbilang = terbilang(intval($data_transfer['smhs_totalbayar']));

		$data = [
			'id'			=> $data_transfer['smhs_seminar'],
			'npm'			=> $data_transfer['smhs_mahasiswa'],
			'nama'			=> $mhs,
			'diterima_dari'	=> $data_transfer['smhs_namapemilik'],
			'bank'			=> $data_transfer['smhs_bank'],
			'total_dana'	=> $dana,
			'terbilang'		=> $terbilang
		];
		// header('content-type: application/json');
		// echo json_encode($query);
		// die;
		$this->load->view('admin/validasipembayaran/pembayaranseminarmahasiswa/format_ropmhs', $data);
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

/* End of file Validasipembayaranseminarmahasiswa.php */
/* Location: ./application/controllers/Validasipembayaranseminarmahasiswa.php */