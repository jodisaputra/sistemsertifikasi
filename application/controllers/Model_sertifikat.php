<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_sertifikat extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('modelsertifikat_model');
		if (!isset($this->session->userdata['username'])) {
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}
	}

	public function index()
	{
		$data = [
			'title'	=> 'Model Sertifikat',
			'list'      => $this->modelsertifikat_model->listmodelsertifikat(),
			'view'	=> 'admin/model_sertifikat/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function tambah()
	{
		$data = [
			'title'	=> 'Model Sertifikat',
			'view'	=> 'admin/model_sertifikat/tambah'
		];
		$this->load->view('admin/template/wrapper', $data);
	}

	public function simpan()
	{
		$this->form_validation->set_rules('nama_model', 'Nama Model Sertifikat', 'required|trim');
		if (empty($_FILES['gambar']['name'])) {
			$this->form_validation->set_rules('gambar', 'Gambar Model', 'required');
		}

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
		$this->form_validation->set_message('required', '{field} harus diisi!');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'warning');
			$this->tambah();
		} else {
			$dname = explode(".", $_FILES['gambar']['name']);
			$ext = end($dname);
			$getid = $this->modelsertifikat_model->getid();
			$filename = $getid . "." . $ext;
			$config['upload_path']          = './assets/template_sertifikat/';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['file_name']            =  $filename;
			$config['overwrite']            = TRUE;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			// $uploadData = $this->upload->data();


			if (!$this->upload->do_upload('gambar')) {
				$this->session->set_flashdata('message', $this->upload->display_errors('<p>', '</p>'));
				$this->session->set_flashdata('tipe', 'warning');
				$this->tambah();
			} else {
				$this->load->library('image_lib');
				$image_data =   $this->upload->data();
				$configer =  array(
					'image_library'   => 'gd2',
					'source_image'    =>  $image_data['full_path'],
					'maintain_ratio'  =>  TRUE,
					'width'           =>  748,
					'height'          =>  489,
				);
				$this->image_lib->clear();
				$this->image_lib->initialize($configer);
				$this->image_lib->resize();
				$data = [
					'ms_model'          => $this->input->post('nama_model'),
					'ms_sertifikat'     => $filename,
					'ms_linkmodel'      => 'model_sertifikat/template/' . $filename,
					'ms_userupdate'     => $this->session->userdata('username'),
					'ms_lastupdate'     => date('Y-m-d H:i:s')
				];

				if ($this->modelsertifikat_model->insert($data)) {
					$this->session->set_flashdata('message', 'Data berhasil disimpan');
					$this->session->set_flashdata('tipe', 'success');
					redirect(base_url('model_sertifikat'));
				} else {
					$this->session->set_flashdata('message', 'Data gagal disimpan');
					$this->session->set_flashdata('tipe', 'error');
					redirect(base_url('model_sertifikat'));
				}
			}
		}
	}

	public function ubah($id)
	{
		$row = $this->modelsertifikat_model->listmodelsertifikatbyid($id);

		if ($row) {
			$data = [
				'title'	=> 'Model Sertifikat',
				'list'               => $row,
				'view'	=> 'admin/model_sertifikat/ubah'
			];

			$this->load->view('admin/template/wrapper', $data);
		} else {
			$this->session->set_flashdata('message', 'Data tidak ada!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('model_sertifikat');
		}
	}

	public function simpan_perubahan()
	{
		$this->form_validation->set_rules('nama_model', 'Nama Model Sertifikat', 'required|trim');

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
		$this->form_validation->set_message('required', '{field} harus diisi!');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'warning');
			$this->ubah($this->input->post('model_id'));
		} else {
			if ($_FILES['gambar']['name'] != "") {
				$dname = explode(".", $_FILES['gambar']['name']);
				$ext = end($dname);
				$filename = $this->input->post('model_id') . "." . $ext;
				$config['upload_path']          = './assets/template_sertifikat/';
				$config['allowed_types']        = 'jpg|png|jpeg';
				$config['file_name']            =  $filename;
				$config['overwrite']            = TRUE;

				$this->load->library('upload');
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('gambar')) {
					$this->session->set_flashdata('message', $this->upload->display_errors('<p>', '</p>'));
					$this->session->set_flashdata('tipe', 'warning');
					$this->ubah($this->input->post('model_id'));
				} else {
					$this->load->library('image_lib');
					$image_data =   $this->upload->data();
					$configer =  array(
						'image_library'   => 'gd2',
						'source_image'    =>  $image_data['full_path'],
						'maintain_ratio'  =>  TRUE,
						'width'           =>  748,
						'height'          =>  489,
					);
					$this->image_lib->clear();
					$this->image_lib->initialize($configer);
					$this->image_lib->resize();
					$data = [
						'ms_model'          => $this->input->post('nama_model'),
						'ms_sertifikat'     => $this->upload->data('file_name'),
						'ms_linkmodel'      => $this->input->post('link_model'),
						'ms_userupdate'     => $this->session->userdata('username'),
						'ms_lastupdate'     => date('Y-m-d H:i:s')
					];

					if ($this->modelsertifikat_model->update($this->input->post('model_id'), $data)) {
						$this->session->set_flashdata('message', 'Data berhasil diubah');
						$this->session->set_flashdata('tipe', 'success');
						redirect(base_url('model_sertifikat'));
					} else {
						$this->session->set_flashdata('message', 'Data gagal diubah');
						$this->session->set_flashdata('tipe', 'error');
						redirect(base_url('model_sertifikat'));
					}
				}
			} else {
				$data = [
					'ms_model'          => $this->input->post('nama_model'),
					'ms_sertifikat'     => $this->input->post('gambar_old'),
					'ms_linkmodel'      => $this->input->post('link_model'),
					'ms_userupdate'     => $this->session->userdata('email'),
					'ms_lastupdate'     => date('Y-m-d H:i:s')
				];

				if ($this->modelsertifikat_model->update($this->input->post('model_id'), $data)) {
					$this->session->set_flashdata('message', 'Data berhasil diubah');
					$this->session->set_flashdata('tipe', 'success');
					redirect(base_url('model_sertifikat'));
				} else {
					$this->session->set_flashdata('message', 'Data gagal diubah');
					$this->session->set_flashdata('tipe', 'error');
					redirect(base_url('model_sertifikat'));
				}
			}
		}
	}

	public function delete($id)
	{
		if ($this->modelsertifikat_model->delete($id)) {
			$this->session->set_flashdata('message', 'Data berhasil dihapus');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('model_sertifikat'));
		} else {
			$this->session->set_flashdata('message', 'Data gagal dihapus');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('model_sertifikat'));
		}
	}

	public function template($id)
	{
		$data = [
			'list'      => $this->modelsertifikat_model->listmodelsertifikatbyid($id)
		];
		$this->load->view('admin/model_sertifikat/template', $data);
	}
}

/* End of file Model_sertifikat.php */
/* Location: ./application/controllers/Model_sertifikat.php */