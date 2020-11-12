<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seminar extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('seminar_model');
		$this->load->model('modelsertifikat_model');
	}

	public function index()
	{
		if (!isset($this->session->userdata['username'])) {
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}

		$data = [
			'title'	=> 'Seminar',
			'seminar'    => $this->seminar_model->listseminar(),
			'view'	=> 'admin/seminar/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function tambah()
	{
		if (!isset($this->session->userdata['username'])) {
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}
		$data = [
			'title'	=> 'Seminar',
			'model'      => $this->modelsertifikat_model->listmodelsertifikat(),
			'view'	=> 'admin/seminar/tambah'
		];
		$this->load->view('admin/template/wrapper', $data);
	}

	public function simpan()
	{
		$this->form_validation->set_rules('nama_seminar', 'Nama Seminar', 'required');
		$this->form_validation->set_rules('tanggal_pelaksanaan', 'Tanggal Pelaksanaan', 'required');
		$this->form_validation->set_rules('tempat_pelaksanaan', 'Tempat Pelaksanaan', 'required|required');
		$this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'required');
		$this->form_validation->set_rules('jam_selesai', 'Jam Selesai', 'required');
		$this->form_validation->set_rules('nama_moderator', 'Nama Moderator', 'required');
		$this->form_validation->set_rules('biaya_mhs', 'Biaya Mahasiswa', 'required');
		$this->form_validation->set_rules('biaya_umum', 'Biaya umum', 'required');
		$this->form_validation->set_rules('model_sertifikat', 'Model sertifikat', 'required');
		$this->form_validation->set_rules('jumlah_max_peserta', 'Jumlah Max Peserta', 'required|trim');

		if ($_FILES['gambar']['name'] == "") {
			$this->form_validation->set_rules('gambar', 'Banner Seminar', 'required');
		}

		$this->form_validation->set_message('required', '{field} harus diisi');

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Mohon isi data sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->tambah();
		} else {

			$namafile = $this->seminar_model->seminarkode();

			$config['upload_path']          = './assets/banner_seminar/';
			$config['allowed_types']        = 'gif|jpeg|jpg|png';
			$config['file_name']            = $namafile . '_' . "Banner";
			$config['overwrite']            = true;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('gambar')) {
				$this->session->set_flashdata('message', $this->upload->display_errors('<p>', '</p>'));
				$this->session->set_flashdata('tipe', 'warning');
				$this->tambah();
			} else {

				$data = [
					'smr_acara'                => $this->input->post('nama_seminar'),
					'smr_tanggal'              => $this->input->post('tanggal_pelaksanaan'),
					'smr_tempat'               => $this->input->post('tempat_pelaksanaan'),
					'smr_jam_mulai'            => $this->input->post('jam_mulai'),
					'smr_jam_selesai'          => $this->input->post('jam_selesai'),
					'smr_moderator'            => $this->input->post('nama_moderator'),
					'smr_biaya_mhs'            => $this->input->post('biaya_mhs'),
					'smr_biaya_umum'           => $this->input->post('biaya_umum'),
					'smr_link_online'          => $this->input->post('link'),
					'smr_banner'               => $this->upload->data('file_name'),
					'smr_keterangan'           => $this->input->post('keterangan'),
					'smr_jumlahmax'            => $this->input->post('jumlah_max_peserta'),
					'smr_model_sertifikat'     => $this->input->post('model_sertifikat'),
					'smr_userupdate'           => $this->session->userdata('username'),
					'smr_lastupdate'           => date('Y-m-d H:i:s')
				];

				if ($this->seminar_model->insert($data)) {
					$this->session->set_flashdata('message', 'Data berhasil ditambah');
					$this->session->set_flashdata('tipe', 'success');
					redirect(base_url('seminar'));
				} else {
					$this->session->set_flashdata('message', 'Data gagal ditambah');
					$this->session->set_flashdata('tipe', 'error');
					redirect(base_url('seminar'));
				}
			}
		}
	}

	public function ubah($id)
	{
		if (!isset($this->session->userdata['username'])) {
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}

		$row = $this->seminar_model->listseminarbyid($id);

		if ($row) {
			$data = [
				'title'	=> 'Seminar',
				'seminar'	=> $row,
				'model'      => $this->modelsertifikat_model->listmodelsertifikat(),
				'view'	=> 'admin/seminar/ubah'
			];

			$this->load->view('admin/template/wrapper', $data);
		} else {
			$this->session->set_flashdata('message', 'Data tidak ada');
			$this->session->set_flashdata('tipe', 'error');
			redirect(site_url('seminar'));
		}
	}

	public function simpan_perubahan()
	{
		$this->form_validation->set_rules('nama_seminar', 'Nama Seminar', 'required');
		$this->form_validation->set_rules('tanggal_pelaksanaan', 'Tanggal Pelaksanaan', 'required');
		$this->form_validation->set_rules('tempat_pelaksanaan', 'Tempat Pelaksanaan', 'required|required');
		$this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'required');
		$this->form_validation->set_rules('jam_selesai', 'Jam Selesai', 'required');
		$this->form_validation->set_rules('nama_moderator', 'Nama Moderator', 'required|trim');
		$this->form_validation->set_rules('biaya_mhs', 'Biaya Mahasiswa', 'required|trim');
		$this->form_validation->set_rules('biaya_umum', 'Biaya umum', 'required|trim');
		$this->form_validation->set_rules('jumlah_max_peserta', 'Jumlah Max Peserta', 'required|trim');
		$this->form_validation->set_rules('model_sertifikat', 'Model sertifikat', 'required');

		$this->form_validation->set_message('required', '{field} harus diisi');

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Mohon isi data sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->update($this->input->post('seminar_id'));
		} else {

			if ($_FILES['gambar']['name'] != "") {
				$namafile = $this->input->post('seminar_id') . '_' . "Banner";

				$getid = $this->modelsertifikat_model->getid();
				$config['upload_path']          = './assets/banner_seminar/';
				$config['allowed_types']        = 'gif|jpeg|jpg|png';
				$config['file_name']            = $namafile;
				$config['overwrite']            = true;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('gambar')) {
					$this->session->set_flashdata('message', $this->upload->display_errors('<p>', '</p>'));
					$this->session->set_flashdata('tipe', 'warning');
					$this->ubah($this->input->post('model_id'));
				} else {
					$data = [
						'smr_acara'                => $this->input->post('nama_seminar'),
						'smr_tanggal'              => $this->input->post('tanggal_pelaksanaan'),
						'smr_tempat'               => $this->input->post('tempat_pelaksanaan'),
						'smr_jam_mulai'            => $this->input->post('jam_mulai'),
						'smr_jam_selesai'          => $this->input->post('jam_selesai'),
						'smr_moderator'            => $this->input->post('nama_moderator'),
						'smr_biaya_mhs'            => $this->input->post('biaya_mhs'),
						'smr_biaya_umum'           => $this->input->post('biaya_umum'),
						'smr_link_online'          => $this->input->post('link'),
						'smr_model_sertifikat'     => $this->input->post('model_sertifikat'),
						'smr_jumlahmax'            => $this->input->post('jumlah_max_peserta'),
						'smr_banner'               => $this->upload->data('file_name'),
						'smr_keterangan'           => $this->input->post('keterangan'),
						'smr_userupdate'           => $this->session->userdata('username'),
						'smr_lastupdate'           => date('Y-m-d H:i:s')
					];

					if ($this->seminar_model->update($this->input->post('seminar_id'), $data)) {
						$this->session->set_flashdata('message', 'Data berhasil diubah');
						$this->session->set_flashdata('tipe', 'success');
						redirect(base_url('seminar'));
					} else {
						$this->session->set_flashdata('message', 'Data gagal diubah');
						$this->session->set_flashdata('tipe', 'error');
						redirect(base_url('seminar'));
					}
				}
			} else {
				$data = [
					'smr_acara'                => $this->input->post('nama_seminar'),
					'smr_tanggal'              => $this->input->post('tanggal_pelaksanaan'),
					'smr_tempat'               => $this->input->post('tempat_pelaksanaan'),
					'smr_jam_mulai'            => $this->input->post('jam_mulai'),
					'smr_jam_selesai'          => $this->input->post('jam_selesai'),
					'smr_moderator'            => $this->input->post('nama_moderator'),
					'smr_biaya_mhs'            => $this->input->post('biaya_mhs'),
					'smr_biaya_umum'           => $this->input->post('biaya_umum'),
					'smr_link_online'          => $this->input->post('link'),
					'smr_model_sertifikat'     => $this->input->post('model_sertifikat'),
					'smr_jumlahmax'            => $this->input->post('jumlah_max_peserta'),
					'smr_banner'               => $this->input->post('oldfile'),
					'smr_keterangan'           => $this->input->post('keterangan'),
					'smr_userupdate'           => $this->session->userdata('username'),
					'smr_lastupdate'           => date('Y-m-d H:i:s')
				];

				if ($this->seminar_model->update($this->input->post('seminar_id'), $data)) {
					$this->session->set_flashdata('message', 'Data berhasil diubah');
					$this->session->set_flashdata('tipe', 'success');
					redirect(base_url('seminar'));
				} else {
					$this->session->set_flashdata('message', 'Data gagal diubah');
					$this->session->set_flashdata('tipe', 'error');
					redirect(base_url('seminar'));
				}
			}
		}
	}

	function delete($id)
	{
		if (!isset($this->session->userdata['username'])) {
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}

		if ($this->seminar_model->delete($id)) {
			$this->session->set_flashdata('message', 'Data berhasil dihapus');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('seminar'));
		} else {
			$this->session->set_flashdata('message', 'Data gagal dihapus');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('seminar'));
		}
	}

	public function daftar_umum($id)
	{
		if (!isset($this->session->userdata['email'])) {
			$this->session->set_flashdata('message', 'Anda belum login! Silahkan login terlebih dahulu');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('home/detail_seminar/' . $id));
		} else {
			$cek = $this->seminar_model->cek($this->session->userdata['email']);
			if ($cek->num_rows() > 0) {
				$this->session->set_flashdata('message', 'Anda sudah mendaftar');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('home/detail_seminar/' . $id));
			} else {

				//Total Jumlah Peserta
				$umum           = $this->seminar_model->listseminarumum()->row();
				$jumlah_mhs     = $this->seminar_model->jumlahpesertamhs($id);
				$jumlah_umum    = $this->seminar_model->jumlahpesertaumum($umum->su_seminar);
				$total          = $jumlah_mhs->jumlah_mahasiswa + $jumlah_umum->jumlah;
				$seminar        = $this->seminar_model->getjumlahmaxseminar($id)->row();
				$jumlahmax      = $seminar->smr_jumlahmax;

				if ($total >= $seminar->smr_jumlahmax) {
					$this->session->set_flashdata('message', 'Maaf Pendaftaran sudah penuh!');
					$this->session->set_flashdata('tipe', 'error');
					redirect(base_url('home/detail_seminar/' . $id));
				} else {
					$data = [
						'su_seminar'        => $id,
						'su_peserta'        => $this->session->userdata['email'],
						'su_tanggaldaftar'  => date('Y-m-d H:i:s'),
						'su_status'         => "Menunggu Pembayaran",
						'su_userupdate'     => $this->session->userdata('email'),
						'su_lastupdate'     => date('Y-m-d H:i:s')
					];

					if ($this->seminar_model->daftar_seminar_umum($data)) {
						$this->session->set_flashdata('message', 'Anda Berhasil mendaftar');
						$this->session->set_flashdata('tipe', 'success');
						redirect(base_url('akun_umum/akun'));
					} else {
						$this->session->set_flashdata('message', 'Anda gagal mendaftar');
						$this->session->set_flashdata('tipe', 'error');
						redirect(base_url('seminar'));
					}
				}
			}
		}
	}

	public function daftar_mahasiswa($id)
	{
		if (!isset($this->session->userdata['npm'])) {
			$this->session->set_flashdata('message', 'Anda belum login! Silahkan login terlebih dahulu');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('home/detail_seminar/' . $id));
		} else {
			$cek = $this->seminar_model->cekmahasiswa($id, $this->session->userdata['npm']);
			if ($cek->num_rows() > 0) {
				$this->session->set_flashdata('message', 'Anda sudah mendaftar');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('home/detail_seminar/' . $id));
			} else {
				//Total Jumlah Peserta
				$umum           = $this->seminar_model->listseminarumum()->row();
				$jumlah_mhs     = $this->seminar_model->jumlahpesertamhs($id);
				$jumlah_umum    = $this->seminar_model->jumlahpesertaumum($umum->su_seminar);
				$total          = $jumlah_mhs->jumlah_mahasiswa + $jumlah_umum->jumlah;
				$seminar        = $this->seminar_model->getjumlahmaxseminar($id)->row();
				$jumlahmax      = $seminar->smr_jumlahmax;

				if ($total >= $seminar->smr_jumlahmax) {
					$this->session->set_flashdata('message', 'Maaf Pendaftaran sudah penuh!');
					$this->session->set_flashdata('tipe', 'error');
					redirect(base_url('home/detail_seminar/' . $id));
				} else {
					$data = [
						'smhs_seminar'        => $id,
						'smhs_mahasiswa'      => $this->session->userdata['npm'],
						'smhs_tanggaldaftar'  => date('Y-m-d H:i:s'),
						'smhs_status'         => "Menunggu Pembayaran",
						'smhs_userupdate'     => $this->session->userdata('npm'),
						'smhs_lastupdate'     => date('Y-m-d H:i:s')
					];

					if ($this->seminar_model->daftar_seminar_mahasiswa($data)) {
						$this->session->set_flashdata('message', 'Anda Berhasil mendaftar');
						$this->session->set_flashdata('tipe', 'success');
						redirect(base_url('akun_mahasiswa/akun'));
					} else {
						$this->session->set_flashdata('message', 'Anda gagal mendaftar');
						$this->session->set_flashdata('tipe', 'error');
						redirect(base_url('seminar'));
					}
				}
			}
		}
	}

	public function buktibayarumum($id)
	{
		if (!isset($this->session->userdata['email'])) {
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('akun_umum');
		}
		$data = [
			'bukti'         => $this->seminar_model->getdatasebelumbayar($id, $this->session->userdata('email')),
			'view'	=> 'akun/umum/buktibayarseminar'
		];
		$this->load->view('template/wrapper', $data);
	}

	public function upload_umum()
	{
		$this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim');
		$this->form_validation->set_rules('no_rek', 'No Rekening', 'required|trim|numeric');
		$this->form_validation->set_rules('nama_pemilik', 'Nama Pemilik', 'required|trim');

		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_message('numeric', '{field} harus diisi dengan angka');

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->buktibayarumum($this->input->post('seminar_id'));
		} else {
			if (empty($_FILES['buktibayar']['name'])) {
				$data = [
					'su_bank'           => $this->input->post('nama_bank'),
					'su_norekening'     => $this->input->post('no_rek'),
					'su_namapemilik'    => $this->input->post('nama_pemilik'),
					'su_status'         => "Validasi Pembayaran",
					'su_userupdate'     => $this->session->userdata('email'),
					'su_lastupdate'     => date('Y-m-d H:i:s')
				];

				if ($this->seminar_model->updatebayarumum($this->input->post('seminar_id'), $this->session->userdata('email'), $data)) {
					$this->session->set_flashdata('message', 'Bukti bayar berhasil diupload');
					$this->session->set_flashdata('tipe', 'success');
					redirect(base_url('akun_umum/akun'));
				} else {
					$this->session->set_flashdata('message', 'Bukti bayar gagal diupload');
					$this->session->set_flashdata('tipe', 'success');
					redirect(base_url('akun_umum/akun'));
				}
			} else {
				$config['upload_path']          = './assets/transfer_seminar_umum/';
				$config['allowed_types']        = 'jpeg|jpg|png';
				$config['file_name']            = $this->session->userdata('ktp') . '_' . $this->input->post('seminar_id');
				$config['overwrite']            = true;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('buktibayar')) {
					$this->session->set_flashdata('message', $this->upload->display_errors('<p>', '</p>'));
					$this->session->set_flashdata('tipe', 'warning');
					$this->buktibayarumum($this->input->post('seminar_id'));
				} else {
					$data = [
						'su_bank'           => $this->input->post('nama_bank'),
						'su_norekening'     => $this->input->post('no_rek'),
						'su_namapemilik'    => $this->input->post('nama_pemilik'),
						'su_bukti'          => $this->upload->data('file_name'),
						'su_status'         => "Validasi Pembayaran",
						'su_userupdate'     => $this->session->userdata('email'),
						'su_lastupdate'     => date('Y-m-d H:i:s')
					];

					if ($this->seminar_model->updatebayarumum($this->input->post('seminar_id'), $this->session->userdata('email'), $data)) {
						$this->session->set_flashdata('message', 'Bukti bayar berhasil diupload');
						$this->session->set_flashdata('tipe', 'success');
						redirect(base_url('akun_umum/akun'));
					} else {
						$this->session->set_flashdata('message', 'Bukti bayar gagal diupload');
						$this->session->set_flashdata('tipe', 'success');
						redirect(base_url('akun_umum/akun'));
					}
				}
			}
		}
	}

	public function buktibayarmahasiswa($id)
	{
		if (!isset($this->session->userdata['npm'])) {
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('akun_mahasiswa');
		}
		$data = [
			'bukti'         => $this->seminar_model->getdatasebelumbayarmahasiswa($id, $this->session->userdata('npm')),
			'view'	=> 'akun/mahasiswa/buktibayarseminar'
		];
		$this->load->view('template/wrapper', $data);
	}

	public function upload_mahasiswa()
	{
		$this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim');
		$this->form_validation->set_rules('no_rek', 'No Rekening', 'required|trim|numeric');
		$this->form_validation->set_rules('nama_pemilik', 'Nama Pemilik', 'required|trim');

		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_message('numeric', '{field} harus diisi dengan angka');

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->buktibayarmahasiswa($this->input->post('seminar_id'));
		} else {
			if (empty($_FILES['buktibayar']['name'])) {
				$data = [
					'smhs_bank'           => $this->input->post('nama_bank'),
					'smhs_norekening'     => $this->input->post('no_rek'),
					'smhs_namapemilik'    => $this->input->post('nama_pemilik'),
					'smhs_status'         => "Validasi Pembayaran",
					'smhs_userupdate'     => $this->session->userdata('npm'),
					'smhs_lastupdate'     => date('Y-m-d H:i:s')
				];

				if ($this->seminar_model->updatebayarmahasiswa($this->input->post('seminar_id'), $this->session->userdata('npm'), $data)) {
					$this->session->set_flashdata('message', 'Bukti bayar berhasil diupload');
					$this->session->set_flashdata('tipe', 'success');
					redirect(base_url('akun_mahasiswa/akun'));
				} else {
					$this->session->set_flashdata('message', 'Bukti bayar gagal diupload');
					$this->session->set_flashdata('tipe', 'success');
					redirect(base_url('akun_mahasiswa/akun'));
				}
			} else {
				$config['upload_path']          = './assets/transfer_seminar_mahasiswa/';
				$config['allowed_types']        = 'jpeg|jpg|png';
				$config['file_name']            = $this->session->userdata('npm') . '_' . $this->input->post('seminar_id');
				$config['overwrite']            = true;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('buktibayar')) {
					$this->session->set_flashdata('message', $this->upload->display_errors('<p>', '</p>'));
					$this->session->set_flashdata('tipe', 'warning');
					$this->buktibayarmahasiswa($this->input->post('seminar_id'));
				} else {
					$data = [
						'smhs_bank'           => $this->input->post('nama_bank'),
						'smhs_norekening'     => $this->input->post('no_rek'),
						'smhs_namapemilik'    => $this->input->post('nama_pemilik'),
						'smhs_bukti'          => $this->upload->data('file_name'),
						'smhs_status'         => "Validasi Pembayaran",
						'smhs_userupdate'     => $this->session->userdata('npm'),
						'smhs_lastupdate'     => date('Y-m-d H:i:s')
					];

					if ($this->seminar_model->updatebayarmahasiswa($this->input->post('seminar_id'), $this->session->userdata('npm'), $data)) {
						$this->session->set_flashdata('message', 'Bukti bayar berhasil diupload');
						$this->session->set_flashdata('tipe', 'success');
						redirect(base_url('akun_mahasiswa/akun'));
					} else {
						$this->session->set_flashdata('message', 'Bukti bayar gagal diupload');
						$this->session->set_flashdata('tipe', 'success');
						redirect(base_url('akun_mahasiswa/akun'));
					}
				}
			}
		}
	}

	public function listpesertaumum($id_seminar)
	{
		if (!isset($this->session->userdata['username'])) {
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}

		$data = [
			'title'	=> 'List Sertifikat Peserta',
			'list'         => $this->seminar_model->listpesertaseminarumum($id_seminar),
			'view'	=> 'admin/seminar/sertifikat/umum/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function cetak_sertifikat_umum($id_seminar, $peserta)
	{
		if (!isset($this->session->userdata['username'])) {
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}

		$row = $this->seminar_model->cetaksertifikatseminarumum($id_seminar, $peserta);


		if ($row) {
			$data = [
				'list'         => $row,
				'ttd'	   => $this->seminar_model->get_ttd_narasumber($id_seminar)
			];

			$this->load->view('admin/seminar/template_sertifikat/template_umum', $data);

			$this->load->library('pdf');
			$paper_size			= 'A4';
			$orientation		= 'landscape';
			$html               = $this->output->get_output();

			$this->pdf->set_paper($paper_size, $orientation);
			$this->pdf->load_html($html);
			$this->pdf->render();
			$this->pdf->stream($peserta . ".pdf", array('Attachment' => 0));
		} else {
			$this->session->set_flashdata('message', 'User ini tidak ada atau belum pernah mendaftar!');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('akun'));
		}
	}

	public function listpesertamhs($id_seminar)
	{
		if (!isset($this->session->userdata['username'])) {
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}

		$data_mhs = array();

		$query =  $this->seminar_model->listpesertaseminarmhs($id_seminar);

		foreach ($query as $q) {
			$mhs = $this->seminar_model->getnama($q->smhs_mahasiswa);
			$data_mhs[$q->smhs_mahasiswa] = $mhs->name;
		}

		$data = [
			'title'	=> 'List Sertifikat Mahasiswa',
			'list'         => $query,
			'mhs'	=> $data_mhs,
			'view'	=> 'admin/seminar/sertifikat/mahasiswa/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function cetak_sertifikat_mhs($id_seminar, $npm)
	{
		if (!isset($this->session->userdata['username'])) {
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}

		$row = $this->seminar_model->cetaksertifikatseminarmhs($id_seminar, $npm);

		if ($row) {

			$data2 = ['npm'  => $npm];
			$data_json = json_encode($data2);
			$curl = curl_init('http://apps.uib.ac.id/portal/api/v2/myprofile');

			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

			curl_setopt($curl, CURLOPT_HTTPHEADER, array(
				'content-type:application/json',
				'Content-Length: ' . strlen($data_json)
			));

			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data_json);

			$result = curl_exec($curl);

			curl_close($curl);
			$mahasiswa = json_decode($result);

			$data = [
				'list'     => $row,
				'profil'   => $mahasiswa,
				'ttd'	   => $this->seminar_model->get_ttd_narasumber($id_seminar)
			];

			$this->load->view('admin/seminar/template_sertifikat/template_mahasiswa', $data);

			$this->load->library('pdf');
			$paper_size			= 'A4';
			$orientation		= 'landscape';
			$html               = $this->output->get_output();

			$this->pdf->set_paper($paper_size, $orientation);
			$this->pdf->load_html($html);
			$this->pdf->render();
			$this->pdf->stream($npm . ".pdf", array('Attachment' => 0));
		} else {
			$this->session->set_flashdata('message', 'Mahasiswa ini belum Daftar!');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('akun_mahasiswa'));
		}
	}

	// Image Upload Summernote
	public function imageUpload()
	{
		if (isset($_FILES["image"]["name"])) {
			$length = 10;
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
			$filename = $randomString . '.' . $ext;
			$config['upload_path'] = './assets/summernote/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = $filename;
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('image')) {
				$this->upload->display_errors();
				return FALSE;
			} else {
				$data = $this->upload->data();
				echo base_url() . './assets/summernote/' . $filename;
			}
		}
	}
	public function deleteImage()
	{
		$src = $this->input->post('src');
		$file_name = str_replace(base_url(), '', $src);
		if (unlink($file_name)) {
			echo 'File Delete Successfully';
		}
	}
}
/* End of file Seminar.php */
/* Location: ./application/controllers/Seminar.php */