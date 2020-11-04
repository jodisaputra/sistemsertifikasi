<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelatih_subsertifikasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pelatihsubsertifikasi_model');
		$this->load->model('batchsertifikasi_model');
		if(!isset($this->session->userdata['username']))
		{
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}
	}

	public function list_pelatih($batch)
	{
		$data = [
			'title'	=> 'Pelatih Sertifikasi',
			'batch'	=> $batch,
			'list'     => $this->pelatihsubsertifikasi_model->listpelatihsubsertifikasi($batch),
			'view'	=> 'admin/pelatih_subsertifikasi/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function tambah($batch)
	{
		$data = [
			'title'	=> 'Pelatih Sertifikasi',
			'batch'	=> $batch,
			'view'	=> 'admin/pelatih_subsertifikasi/tambah'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function simpan()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[ssc_pelatih_subsertifikasi.ps_email]');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_message('is_unique', '{field} ini sudah ada!');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->tambah();
		}
		else
		{
			$data = [
				'ps_batch'      => $this->input->post('batch_id'),
				'ps_email'      => $this->input->post('email'),
				'ps_nama'       => $this->input->post('nama'),
				'ps_institusi'  => $this->input->post('asal_institusi'),
				'ps_sebagai'    => $this->input->post('sebagai'),
				'ps_userupdate' => $this->session->userdata('username'),
				'ps_lastupdate' => date('Y-m-d H:i:s')
			];

			if($this->pelatihsubsertifikasi_model->insert($data))
			{
				$this->session->set_flashdata('message', 'Data berhasil disimpan');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('pelatih_subsertifikasi/list_pelatih/' . $this->input->post('batch_id')));
			}
			else
			{
				$this->session->set_flashdata('message', 'Data gagal disimpan');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('pelatih_subsertifikasi/list_pelatih/' . $this->input->post('batch_id')));

			}
		}
	}

	public function ubah($id_batch, $id_pelatih)
	{
		$row = $this->pelatihsubsertifikasi_model->listpelatihsubsertifikasibyid($id_batch, $id_pelatih);
		if($row)
		{
			$data = [
				'title'	=> 'Pelatih Sertifikasi',
				'list'     => $this->batchsertifikasi_model->listbatch(),
				'pelatih'  => $row,
				'view'	=> 'admin/pelatih_subsertifikasi/ubah'
			];

			$this->load->view('admin/template/wrapper', $data);
		}
		else
		{
			$this->session->set_flashdata('message', 'Data tidak ada');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('pelatih_subsertifikasi'));
		}
	}

	public function simpan_perubahan()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
		$this->form_validation->set_message('required', '{field} harus diisi');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->ubah($this->input->post('batch_id'), $this->input->post('pelatih_id'));
		}
		else
		{
			$data = [
				'ps_nama'       => $this->input->post('nama'),
				'ps_institusi'  => $this->input->post('asal_institusi'),
				'ps_sebagai'    => $this->input->post('sebagai'),
				'ps_userupdate' => $this->session->userdata('email'),
				'ps_lastupdate' => date('Y-m-d H:i:s')
			];

			if($this->pelatihsubsertifikasi_model->update($this->input->post('batch_id'), $this->input->post('pelatih_id'), $data))
			{
				$this->session->set_flashdata('message', 'Data berhasil diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('pelatih_subsertifikasi/list_pelatih/' . $this->input->post('batch_id')));
			}
			else
			{
				$this->session->set_flashdata('message', 'Data gagal diubah');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('pelatih_subsertifikasi/list_pelatih/' . $this->input->post('batch_id')));
			}
		}
	}

	public function delete($id_batch, $id_pelatih)
	{
		if($this->pelatihsubsertifikasi_model->delete($id_batch, $id_pelatih))
		{
			$this->session->set_flashdata('message', 'Data berhasil dihapus');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('pelatih_subsertifikasi/list_pelatih/' . $id_batch));
		}
		else
		{
			$this->session->set_flashdata('message', 'Data gagal dihapus');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('pelatih_subsertifikasi/list_pelatih/' . $id_batch));
		}
	}


}

/* End of file Pelatih_subsertifikasi.php */
/* Location: ./application/controllers/Pelatih_subsertifikasi.php */