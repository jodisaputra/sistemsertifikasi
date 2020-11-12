<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Input_nilai_sertifikasi_final extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('inputnilaisertifikasifinal_model');
		$this->load->model('sertifikasi_model');

		if (!isset($this->session->userdata['username'])) {
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}
	}

	public function nilai_umum_final($id_sertifikat)
	{
		$cek = $this->inputnilaisertifikasifinal_model->listsertifikasiumum($id_sertifikat)->result();

		// cek jika belum ada nilai sertifikasi yang diisi
		if ($cek != NULL) {
			$data = [
				'title'	=> 'Input Nilai Final Sertifikasi Umum',
				'list'      => $this->inputnilaisertifikasifinal_model->listsertifikasiumum($id_sertifikat)->result(),
				'view'	=> 'admin/nilai_sertifikasi_final/umum/index'
			];
			$this->load->view('admin/template/wrapper', $data);
		} else {
			$this->session->set_flashdata('message', 'Nilai sertifikasi peserta umum belum diisi !');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('sertifikasi'));
		}
	}

	public function input_nilai_umum($id_sertifikat, $id_peserta)
	{
		$cek_penilaian = $this->inputnilaisertifikasifinal_model->cek_penilaian($id_sertifikat);

		if (!$cek_penilaian) {
			$this->session->set_flashdata('message', 'Modul Penilaian masih kosong!');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('input_nilai_sertifikasi_final/nilai_umum_final/' . $id_sertifikat));
		} else {

			$total = 0;
			$status = 'y';

			//Get Nilai Max
			$getnilaimax = $this->inputnilaisertifikasifinal_model->nilaimax($id_sertifikat, $id_peserta);

			$sub = $this->inputnilaisertifikasifinal_model->listsertifikasicount($id_sertifikat, $id_peserta)->num_rows();

			$totalsubsertifikasi = $this->sertifikasi_model->totalsubsertifikasi($id_sertifikat)->num_rows();

			// Cek jika tidak mengikuti semua subsertifikasi (dengan syarat ada lebih dari 1 subsertifikasi);

			if ($sub < $totalsubsertifikasi) {
				$status = 'n';
			}

			foreach ($getnilaimax as $g) {
				$total += $g->ssu_skor;
			}

			// Untuk Set Grade : Contoh Grade A
			$getgrade = $this->inputnilaisertifikasifinal_model->getgrade($id_sertifikat)->result();

			// $grade = '';
			// $penghargaan = '';
			// $lembaga = '';
			// $statuslulus = '';

			if ($status == 'y') {
				foreach ($getgrade as $g) {
					if ($total >= $g->pn_min && $total <= $g->pn_max) {
						$grade = $g->pn_grade;
						$penghargaan = $g->pn_penghargaan;
						$lembaga = $g->pn_lembagasertifikat;
						$statuslulus = $g->pn_status;
					}
				}

				$data = [
					'title'	=> 'Input Nilai Final Sertifikasi Umum',
					'list'           => $this->inputnilaisertifikasifinal_model->listsertifikasiumumlistid($id_sertifikat, $id_peserta),
					'skortotal'      => $total,
					'grade'          => $grade,
					'penghargaan'    => $penghargaan,
					'lembaga'        => $lembaga,
					'status'         => $statuslulus,
					'view'	=> 'admin/nilai_sertifikasi_final/umum/tambah'
				];

				$this->load->view('admin/template/wrapper', $data);
			} else {
				$this->session->set_flashdata('message', 'Peserta Belum Mengikuti Semua Subsertifikasi');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('input_nilai_sertifikasi_final/nilai_umum_final/' . $id_sertifikat));
			}
		}
	}

	public function simpan_umum()
	{
		// placeholder
		$this->form_validation->set_rules('id_sertifikasi', '', 'required');

		if ($this->input->post('status') == 'Lulus') {
			$this->form_validation->set_rules('tanggal_lulus', 'Tanggal lulus', 'required');
		}

		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Mohon Isi data sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('input_nilai_sertifikasi_final/nilai_umum_final/' . $this->input->post('id_sertifikasi')));
		} else {
			$config['upload_path']          = './assets/sertifikat_umum/';
			$config['allowed_types']        = 'pdf';
			$config['overwrite']            = true;

			$this->upload->initialize($config);

			if (empty($_FILES['sertifikat']['name'])) {
				$data = [
					'srtu_skor'                 => $this->input->post('skor'),
					'srtu_grade'                => $this->input->post('grade'),
					'srtu_penghargaan'          => $this->input->post('penghargaan'),
					'srtu_lembagasertifikasi'   => $this->input->post('lembaga'),
					'srtu_status'               => $this->input->post('status'),
					'srtu_tanggal_lulus'        => $this->input->post('tanggal_lulus'),
					'srtu_catatan'              => $this->input->post('catatan'),
					'srtu_userupdate'           => $this->session->userdata('username'),
					'srtu_lastupdate'           => date('Y-m-d H:i:s')
				];

				if ($this->inputnilaisertifikasifinal_model->insert_umum($this->input->post('id_sertifikasi'), $this->input->post('id_peserta'), $data)) {
					$this->session->set_flashdata('message', 'Nilai berhasil disimpan');
					$this->session->set_flashdata('tipe', 'success');
					redirect(base_url('input_nilai_sertifikasi_final/nilai_umum_final/' . $this->input->post('id_sertifikasi')));
				} else {
					$this->session->set_flashdata('message', 'Nilai gagal disimpan');
					$this->session->set_flashdata('tipe', 'error');
					redirect(base_url('input_nilai_sertifikasi_final/nilai_umum_final/' . $this->input->post('id_sertifikasi')));
				}
			} else {
				if (!$this->upload->do_upload('sertifikat')) {
					$this->session->set_flashdata('message', $this->upload->display_errors('<p>', '</p>'));
					$this->session->set_flashdata('tipe', 'warning');
					$this->input_nilai_umum($this->input->post('id_sertifikasi'), $this->input->post('id_peserta'));
				} else {
					if (!empty($_FILES['sertifikat']['name'])) {
						$namafile = $this->upload->data('file_name');
					} else {
						$namafile = $this->input->post('sertifikat_old');
					}

					$data = [
						'srtu_skor'                 => $this->input->post('skor'),
						'srtu_grade'                => $this->input->post('grade'),
						'srtu_penghargaan'          => $this->input->post('penghargaan'),
						'srtu_lembagasertifikasi'   => $this->input->post('lembaga'),
						'srtu_status'               => $this->input->post('status'),
						'srtu_sertifikat'           => $namafile,
						'srtu_tanggal_lulus'        => $this->input->post('tanggal_lulus'),
						'srtu_catatan'              => $this->input->post('catatan'),
						'srtu_userupdate'           => $this->session->userdata('username'),
						'srtu_lastupdate'           => date('Y-m-d H:i:s')
					];

					if ($this->inputnilaisertifikasifinal_model->insert_umum($this->input->post('id_sertifikasi'), $this->input->post('id_peserta'), $data)) {
						$this->session->set_flashdata('message', 'Nilai berhasil disimpan');
						$this->session->set_flashdata('tipe', 'success');
						redirect(base_url('input_nilai_sertifikasi_final/nilai_umum_final/' . $this->input->post('id_sertifikasi')));
					} else {
						$this->session->set_flashdata('message', 'Nilai gagal disimpan');
						$this->session->set_flashdata('tipe', 'error');
						redirect(base_url('input_nilai_sertifikasi_final/nilai_umum_final/' . $this->input->post('id_sertifikasi')));
					}
				}
			}
		}
	}

	public function nilai_mahasiswa_final($id_sertifikat)
	{
		$cek_penilaian = $this->inputnilaisertifikasifinal_model->cek_penilaian($id_sertifikat);

		if (!$cek_penilaian) {
			$this->session->set_flashdata('message', 'Modul Penilaian masih kosong!');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('input_nilai_sertifikasi_final/nilai_umum_final/' . $id_sertifikat));
		} else {

			$cek = $this->inputnilaisertifikasifinal_model->listsertifikasimahasiswa($id_sertifikat)->result();

			if ($cek != NULL) {

				$query = $this->inputnilaisertifikasifinal_model->listsertifikasimahasiswa($id_sertifikat)->result();

				$mhs = array();

				foreach ($query as $q) {
					$mahasiswa = $this->inputnilaisertifikasifinal_model->getnama($q->sm_mahasiswa);
					$mhs[$q->sm_mahasiswa] = $mahasiswa->name;
				}

				$data = [
					'title'	=> 'Input Nilai Final Sertifikasi Mahasiswa',
					'list'      => $query,
					'mhs'	=> $mhs,
					'view'	=> 'admin/nilai_sertifikasi_final/mahasiswa/index'
				];

				$this->load->view('admin/template/wrapper', $data);
			} else {
				$this->session->set_flashdata('message', 'Nilai sertifikasi mahasiswa belum diisi !');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('sertifikasi'));
			}
		}
	}

	public function input_nilai_mahasiswa($id_sertifikat, $id_mahasiswa)
	{
		$total = 0;
		$status = 'y';

		//Get Nilai Max
		$getnilaimax = $this->inputnilaisertifikasifinal_model->nilaimaxmahasiswa($id_sertifikat, $id_mahasiswa);

		$sub = $this->inputnilaisertifikasifinal_model->listsertifikasicountmahasiswa($id_sertifikat, $id_mahasiswa)->num_rows();

		$totalsubsertifikasi = $this->sertifikasi_model->totalsubsertifikasi($id_sertifikat)->num_rows();

		// header('content-type: application/json');
		// echo json_encode($totalsubsertifikasi);
		// die;

		// Cek jika tidak mengikuti semua subsertifikasi (dengan syarat ada lebih dari 1 subsertifikasi);

		if ($sub < $totalsubsertifikasi) {
			$status = 'n';
		}

		foreach ($getnilaimax as $g) {
			$total += $g->ssm_skor;
		}

		// Untuk Set Grade : Contoh Grade A
		$getgrade = $this->inputnilaisertifikasifinal_model->getgrade($id_sertifikat)->result();

		// $grade = '';
		// $penghargaan = '';
		// $lembaga = '';
		// $statuslulus = '';

		if ($status == 'y') {
			foreach ($getgrade as $g) {
				if ($total >= $g->pn_min && $total <= $g->pn_max) {
					$grade = $g->pn_grade;
					$penghargaan = $g->pn_penghargaan;
					$lembaga = $g->pn_lembagasertifikat;
					$statuslulus = $g->pn_status;
				}
			}

			$data = [
				'title'	=> 'Input Nilai Final Sertifikasi Mahasiswa',
				'list'           => $this->inputnilaisertifikasifinal_model->listsertifikasimahasiswalistid($id_sertifikat, $id_mahasiswa),
				'skortotal'      => $total,
				'grade'          => $grade,
				'penghargaan'    => $penghargaan,
				'lembaga'        => $lembaga,
				'status'         => $statuslulus,
				'view'	=> 'admin/nilai_sertifikasi_final/mahasiswa/tambah'
			];

			$this->load->view('admin/template/wrapper', $data);
		} else {
			$this->session->set_flashdata('message', 'Peserta Belum Mengikuti Semua Subsertifikasi');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('input_nilai_sertifikasi_final/nilai_mahasiswa_final/' . $id_sertifikat));
		}
	}

	public function simpan_mahasiswa()
	{
		// placeholder
		$this->form_validation->set_rules('id_sertifikasi', '', 'required');

		if ($this->input->post('status') == 'Lulus') {
			$this->form_validation->set_rules('tanggal_lulus', 'Tanggal lulus', 'required');
		}

		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Mohon Isi data sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->input_nilai_mahasiswa($this->input->post('id_sertifikasi'), $this->input->post('id_mahasiswa'));
		} else {
			$config['upload_path']          = './assets/sertifikat_mahasiswa/';
			$config['allowed_types']        = 'pdf';
			$config['overwrite']            = true;

			$this->upload->initialize($config);

			if (empty($_FILES['sertifikat']['name'])) {
				$data = [
					'sm_skor'                 => $this->input->post('skor'),
					'sm_grade'                => $this->input->post('grade'),
					'sm_penghargaan'          => $this->input->post('penghargaan'),
					'sm_lembagasertifikasi'   => $this->input->post('lembaga'),
					'sm_status'               => $this->input->post('status'),
					'sm_tanggal_lulus'        => $this->input->post('tanggal_lulus'),
					'sm_catatan'              => $this->input->post('catatan'),
					'sm_userupdate'           => $this->session->userdata('username'),
					'sm_lastupdate'           => date('Y-m-d H:i:s')
				];

				if ($this->inputnilaisertifikasifinal_model->insert_mahasiswa($this->input->post('id_sertifikasi'), $this->input->post('id_mahasiswa'), $data)) {
					$this->session->set_flashdata('message', 'Nilai berhasil disimpan');
					$this->session->set_flashdata('tipe', 'success');
					redirect(base_url('input_nilai_sertifikasi_final/nilai_mahasiswa_final/' . $this->input->post('id_sertifikasi')));
				} else {
					$this->session->set_flashdata('message', 'Nilai gagal disimpan');
					$this->session->set_flashdata('tipe', 'error');
					redirect(base_url('input_nilai_sertifikasi_final/nilai_mahasiswa_final/' . $this->input->post('id_sertifikasi')));
				}
			} else {
				if (!$this->upload->do_upload('sertifikat')) {
					$this->session->set_flashdata('message', $this->upload->display_errors('<p>', '</p>'));
					$this->session->set_flashdata('tipe', 'warning');
					$this->input_nilai_mahasiswa($this->input->post('id_sertifikasi'), $this->input->post('id_peserta'));
				} else {
					if (!empty($_FILES['sertifikat']['name'])) {
						$namafile = $this->upload->data('file_name');
					} else {
						$namafile = $this->input->post('sertifikat_old');
					}

					$data = [
						'sm_skor'                 => $this->input->post('skor'),
						'sm_grade'                => $this->input->post('grade'),
						'sm_penghargaan'          => $this->input->post('penghargaan'),
						'sm_lembagasertifikasi'   => $this->input->post('lembaga'),
						'sm_status'               => $this->input->post('status'),
						'sm_sertifikat'           => $namafile,
						'sm_tanggal_lulus'        => $this->input->post('tanggal_lulus'),
						'sm_catatan'              => $this->input->post('catatan'),
						'sm_userupdate'           => $this->session->userdata('username'),
						'sm_lastupdate'           => date('Y-m-d H:i:s')
					];

					if ($this->inputnilaisertifikasifinal_model->insert_mahasiswa($this->input->post('id_sertifikasi'), $this->input->post('id_mahasiswa'), $data)) {
						$this->session->set_flashdata('message', 'Nilai berhasil disimpan');
						$this->session->set_flashdata('tipe', 'success');
						redirect(base_url('input_nilai_sertifikasi_final/nilai_mahasiswa_final/' . $this->input->post('id_sertifikasi')));
					} else {
						$this->session->set_flashdata('message', 'Nilai gagal disimpan');
						$this->session->set_flashdata('tipe', 'error');
						redirect(base_url('input_nilai_sertifikasi_final/nilai_mahasiswa_final/' . $this->input->post('id_sertifikasi')));
					}
				}
			}
		}
	}
}

/* End of file Input_nilai_sertifikasi_final.php */
/* Location: ./application/controllers/Input_nilai_sertifikasi_final.php */