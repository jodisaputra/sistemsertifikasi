<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Narasumberseminar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('narasumberseminar_model');
		$this->load->model('seminar_model');

		if(!isset($this->session->userdata['username']))
		{
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}
	}

	public function list_narasumber($seminar)
	{
		$data = [
			'title'	=> 'Narasumber',
			'seminar'	=> $seminar,
			'list'      => $this->narasumberseminar_model->list($seminar),
			'view'	=> 'admin/narasumber_seminar/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function tambah($seminar)
	{
		$data = [
			'title'	=> 'Modul',
			'seminarid' => $seminar,
			'seminar'   => $this->seminar_model->listseminar(),
			'view'	=> 'admin/narasumber_seminar/tambah'
		];
		$this->load->view('admin/template/wrapper', $data);
	}

	public function simpan()
	{
		$this->form_validation->set_rules('nama_narasumber', 'Nama Narasumber', 'required|trim');
		$this->form_validation->set_rules('asal_institusi', 'Asal Institusi', 'required|trim');
		$this->form_validation->set_rules('sebagai', 'Narasumber sebagai', 'required|trim');

		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->tambah($this->input->post('seminar'));
		}
		else
		{
			$data = [
				'ns_seminar'            => $this->input->post('seminar'),
				'ns_narasumber'         => $this->input->post('nama_narasumber'),
				'ns_institusi'          => $this->input->post('asal_institusi'),
				'ns_sebagai'            => $this->input->post('sebagai'),
				'ns_userupdate'         => $this->session->userdata('username'),
				'ns_lastupdate'         => date('Y-m-d H:i:s')
			];

			if($this->narasumberseminar_model->insert($data))
			{
				$this->session->set_flashdata('message', 'Data berhasil ditambah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('narasumberseminar/list_narasumber/' . $this->input->post('seminar')));
			}
			else
			{
				$this->session->set_flashdata('message', 'Data gagal ditambah');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('narasumberseminar/list_narasumber/' . $this->input->post('seminar')));
			}
		}
	}

	public function ubah($id)
	{
		$row = $this->narasumberseminar_model->listbyid($id);

		if($row)
		{
			$data = [
				'title'	=> 'Modul',
				'list'      => $row,
				'view'	=> 'admin/narasumber_seminar/ubah'
			];
			$this->load->view('admin/template/wrapper', $data);
		}
		else
		{
			$this->session->set_flashdata('message', 'Data tidak ada');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('narasumberseminar/list_narasumber/' . $this->uri->segment(3)));

		}
		
	}

	public function simpan_perubahan()
	{
		$this->form_validation->set_rules('nama_narasumber', 'Nama Narasumber', 'required|trim');
		$this->form_validation->set_rules('asal_institusi', 'Asal Institusi', 'required|trim');
		$this->form_validation->set_rules('sebagai', 'Narasumber sebagai', 'required|trim');

		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->ubah($this->input->post('narasumber_id'));
		}
		else
		{
			$data = [
				'ns_seminar'            => $this->input->post('seminar'),
				'ns_narasumber'         => $this->input->post('nama_narasumber'),
				'ns_institusi'          => $this->input->post('asal_institusi'),
				'ns_sebagai'            => $this->input->post('sebagai'),
				'ns_userupdate'         => $this->session->userdata('email'),
				'ns_lastupdate'         => date('Y-m-d H:i:s')
			];

			if($this->narasumberseminar_model->update($this->input->post('narasumber_id'), $data))
			{
				$this->session->set_flashdata('message', 'Data berhasil diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('narasumberseminar/list_narasumber/' . $this->input->post('seminar')));
			}
			else
			{
				$this->session->set_flashdata('message', 'Data gagal diubah');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('narasumberseminar/list_narasumber/' . $this->input->post('seminar')));
			}
		}
	}

	public function delete($id)
	{
		if($this->narasumberseminar_model->delete($id))
		{
			$this->session->set_flashdata('message', 'Data berhasil dihapus');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('narasumberseminar/list_narasumber/' . $this->uri->segment(3)));

		}
		else
		{
			$this->session->set_flashdata('message', 'Data gagal dihapus');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('narasumberseminar/list_narasumber/' . $this->uri->segment(3)));
		}
	}

}

/* End of file Narasumberseminar.php */
/* Location: ./application/controllers/Narasumber_seminar.php */