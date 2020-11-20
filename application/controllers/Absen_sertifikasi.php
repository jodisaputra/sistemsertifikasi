<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absen_sertifikasi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('absensertifikasi_model');
		$this->load->model('users_model');

		if (!isset($this->session->userdata['username'])) {
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}
	}

	public function absen_pertemuan($id_batch)
	{

		$cekabsen = $this->absensertifikasi_model->listabsencek($id_batch)->result();

		$cekid = array();

		foreach ($cekabsen as $c) {
			$cekid[$c->aps_absen] = $c->as_id;
		}

		$data = [
			'title'	=> 'Daftar Pertemuan Absen',
			'list'      => $this->absensertifikasi_model->listabsen($id_batch)->result(),
			'cek'       => $cekid,
			'view'	=> 'admin/absen_sertifikasi/pertemuan'
		];

		$this->load->view('admin/template/wrapper', $data);
	}


	public function absen($id_absen)
	{

		$batch = $this->absensertifikasi_model->batchrow($id_absen);

		$mhs = array();

		$query = $this->absensertifikasi_model->listsertifikasimahasiswa($batch->as_batch);

		foreach ($query as $q) {
			$data_mhs = $this->absensertifikasi_model->getnama($q->sm_mahasiswa);
			$mhs[$q->sm_mahasiswa] = $data_mhs->name;
		}

		$data = [
			'title'	=> 'Absen Sertifikasi',
			'peserta'        => $this->absensertifikasi_model->listsertifikasiumum($batch->as_batch),
			'header'         => $this->absensertifikasi_model->header($id_absen),
			'pelatih'		 => $this->absensertifikasi_model->list_pelatih($batch->as_batch),
			'mahasiswa'      => $query,
			'mhs'			=> $mhs,
			'view'	=> 'admin/absen_sertifikasi/absen'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function simpan_header()
	{
		$this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required|trim');
		$this->form_validation->set_rules('tanggal_pelaksanaan', 'Tanggal', 'required');
		$this->form_validation->set_rules('nama_instruktur', 'Nama Instruktur', 'required|trim');

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
		$this->form_validation->set_message('required', '{field} harus diisi');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format !');
			$this->session->set_flashdata('tipe', 'error');
			$this->absen($this->input->post('id_absen'));
		} else {
			$namaform = $this->absensertifikasi_model->header($this->input->post('id_absen'));
			$data = [
				'as_nama_absen'         => $this->input->post('nama_kegiatan'),
				'as_tanggal'            => $this->input->post('tanggal_pelaksanaan'),
				'as_nama_instruktur'    => $this->input->post('nama_instruktur'),
				'as_instruktur_ishadir' => $this->input->post('name_' . $namaform->as_id),
				'as_catatan'            => $this->input->post('catatan')
			];

			if ($this->absensertifikasi_model->insert_header($this->input->post('id_absen'), $data)) {
				$this->session->set_flashdata('message', 'Header Absen berhasil Diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('absen_sertifikasi/absen/' . $this->input->post('id_absen')));
			} else {
				$this->session->set_flashdata('message', 'Header Absen gagal Diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('absen_sertifikasi/absen/' . $this->input->post('id_absen')));
			}
		}
	}

	public function simpan_headerupdate()
	{
		$this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required|trim');
		$this->form_validation->set_rules('tanggal_pelaksanaan', 'Tanggal', 'required');
		$this->form_validation->set_rules('nama_instruktur', 'Nama Instruktur', 'required|trim');

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
		$this->form_validation->set_message('required', '{field} harus diisi');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format !');
			$this->session->set_flashdata('tipe', 'error');
			$this->absen_update($this->input->post('id_absen'));
		} else {
			$namaform = $this->absensertifikasi_model->header($this->input->post('id_absen'));
			$data = [
				'as_nama_absen'         => $this->input->post('nama_kegiatan'),
				'as_tanggal'            => $this->input->post('tanggal_pelaksanaan'),
				'as_nama_instruktur'    => $this->input->post('nama_instruktur'),
				'as_instruktur_ishadir' => $this->input->post('name_' . $namaform->as_id),
				'as_catatan'            => $this->input->post('catatan')
			];

			if ($this->absensertifikasi_model->insert_header($this->input->post('id_absen'), $data)) {
				$this->session->set_flashdata('message', 'Header Absen berhasil Diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('absen_sertifikasi/absen_update/' . $this->input->post('id_absen')));
			} else {
				$this->session->set_flashdata('message', 'Header Absen gagal Diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('absen_sertifikasi/absen_update/' . $this->input->post('id_absen')));
			}
		}
	}

	public function simpan_absen()
	{
		$absen = $this->absensertifikasi_model->absen_sertifikasiumum();

		foreach ($absen as $a) {
			$form = str_replace('.', '', $a->srtu_peserta);

			$data[$a->srtu_peserta] = [
				'aps_absen'         => $this->input->post('id_absensertifikasi'),
				'aps_peserta'       => $a->srtu_peserta,
				'aps_ishadir'       => $this->input->post('name' . $form),
				'aps_userupdate'    => $this->session->userdata('username'),
				'aps_lastupdate'    => date('Y-m-d H:i:s')
			];
		}

		if ($this->absensertifikasi_model->insert_absen($data)) {
			$absen_mahasiswa = $this->absensertifikasi_model->absen_sertifikasimahasiswa();

			foreach ($absen_mahasiswa as $am) {
				$form = str_replace('.', '', $am->sm_mahasiswa);

				$data_mhs[$am->sm_mahasiswa] = [
					'aps_absen'         => $this->input->post('id_absenmhs'),
					'aps_peserta'       => $am->sm_mahasiswa,
					'aps_ishadir'       => $this->input->post('name' . $form),
					'aps_userupdate'    => $this->session->userdata('username'),
					'aps_lastupdate'    => date('Y-m-d H:i:s')
				];
			}

			$this->absensertifikasi_model->insert_absenmhs($data_mhs);

			$this->session->set_flashdata('message', 'Absen berhasil disimpan');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('absen_sertifikasi/absen_pertemuan/' . $this->input->post('id_batch')));
		} else {
			$this->session->set_flashdata('message', 'Absen gagal disimpan');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('absen_sertifikasi/absen_pertemuan/' . $this->input->post('id_batch')));
		}
	}

	public function detail($id_absen)
	{

		$batch = $this->absensertifikasi_model->batchrow($id_absen);

		$ps_row = array();
		$query = $this->absensertifikasi_model->listsertifikasiumumrow($id_absen);

		$mhs = $this->absensertifikasi_model->absen_sertifikasimahasiswa();
		$peserta = $this->absensertifikasi_model->absen_sertifikasiumum();

		$data_match = array();

		foreach ($query as $q) {

			foreach ($mhs as $m) {
				$data_mhs = $this->absensertifikasi_model->getnama($m->sm_mahasiswa);
				$data_match[$m->sm_mahasiswa] = $data_mhs->name;
			}

			foreach ($peserta as $p) {
				$data_peserta = $this->users_model->listusers($p->srtu_peserta);
				$data_match[$p->srtu_peserta] = $data_peserta->pu_nama;


				// Kehadiran
				$ps_row[$q->aps_peserta]  = $q->aps_ishadir;
			}
		}

		$data = [
			'title'	=> 'Detail Absen Sertifikasi',
			'peserta'        => $query,
			'pesertarow'     => $ps_row,
			'header'         => $this->absensertifikasi_model->header($id_absen),
			'mahasiswa'      => $this->absensertifikasi_model->listsertifikasimahasiswa($batch->as_batch),
			'nama'	=> $data_match,
			'view'	=> 'admin/absen_sertifikasi/detail'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function absen_update($id_absen)
	{

		$batch = $this->absensertifikasi_model->batchrow($id_absen);

		$ps_row = array();
		$query = $this->absensertifikasi_model->listsertifikasiumumrow($id_absen);

		$mhs = $this->absensertifikasi_model->absen_sertifikasimahasiswa();
		$peserta = $this->absensertifikasi_model->absen_sertifikasiumum();

		$data_match = array();

		foreach ($query as $q) {
			foreach ($mhs as $m) {
				$data_mhs = $this->absensertifikasi_model->getnama($m->sm_mahasiswa);
				$data_match[$m->sm_mahasiswa] = $data_mhs->name;
			}

			foreach ($peserta as $p) {
				$data_peserta = $this->users_model->listusers($p->srtu_peserta);
				$data_match[$p->srtu_peserta] = $data_peserta->pu_nama;

				// Kehadiran
				$ps_row[$q->aps_peserta]  = $q->aps_ishadir;
			}
		}

		$data = [
			'title'	=> 'Absen Sertifikasi',
			'peserta'        => $query,
			'pesertarow'     => $ps_row,
			'header'         => $this->absensertifikasi_model->header($id_absen),
			'mahasiswa'      => $this->absensertifikasi_model->listsertifikasimahasiswa($batch->as_batch),
			'pelatih'		 => $this->absensertifikasi_model->list_pelatih($batch->as_batch),
			'nama'	=> $data_match,
			'view'	=> 'admin/absen_sertifikasi/absen_update'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function simpan_absenperubahan()
	{
		$absen = $this->absensertifikasi_model->listsemuaabsen();

		foreach ($absen as $a) {
			$form = str_replace('.', '', $a->aps_peserta);

			$data[$a->aps_peserta] = [
				'aps_ishadir'       => $this->input->post('name' . $form),
				'aps_userupdate'    => $this->session->userdata('username'),
				'aps_lastupdate'    => date('Y-m-d H:i:s')
			];
		}

		if ($this->absensertifikasi_model->updateabsen($this->input->post('id_absen'), $this->input->post('id_peserta'), $data)) {
			$this->session->set_flashdata('message', 'Absen berhasil diubah');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('absen_sertifikasi/absen_pertemuan/' . $this->input->post('id_batch')));
		} else {
			$this->session->set_flashdata('message', 'Absen gagal diubah');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('absen_sertifikasi/absen_pertemuan/' . $this->input->post('id_batch')));
		}
	}

	public function cetak_absen($id_absen, $id_batch)
	{
		$query = $this->absensertifikasi_model->cetakabsen($id_absen, $id_batch);

		$mhs = $this->absensertifikasi_model->absen_sertifikasimahasiswa();
		$peserta = $this->absensertifikasi_model->absen_sertifikasiumum();

		$data_match = array();

		foreach ($mhs as $m) {
			$data_mhs = $this->absensertifikasi_model->getnama($m->sm_mahasiswa);
			$data_match[$m->sm_mahasiswa] = $data_mhs->name;
		}

		foreach ($peserta as $p) {
			$data_peserta = $this->users_model->listusers($p->srtu_peserta);
			$data_match[$p->srtu_peserta] = $data_peserta->pu_nama;
		}

		$data = [
			'listabsen'         => $query,
			'row'               => $this->absensertifikasi_model->cetakabsenrow($id_absen, $id_batch),
			'nama'				=> $data_match
		];

		$this->load->view('admin/absen_sertifikasi/cetak', $data);
	}
}

/* End of file Absen_sertifikasi.php */
/* Location: ./application/controllers/Absen_sertifikasi.php */