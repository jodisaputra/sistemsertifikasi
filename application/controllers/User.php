<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('usergroup_model');

		if (!isset($this->session->userdata['username'])) {
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}
	}

	public function index()
	{
		$data = [
			'title'	=> 'User',
			'list'  => $this->user_model->list(),
			'view'	=> 'admin/user/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function tambah()
	{
		$data = [
			'title'	=> 'User',
			'usergroup'   => $this->usergroup_model->list(),
			'view'	=> 'admin/user/tambah'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function simpan()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[ssc_user.usr_email]');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('user_group', 'User Group', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_rules('prodi', 'Prodi', 'required');

		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_message('is_unique', '{field} ini sudah ada');

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Mohon isi data sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->tambah();
		} else {
			$data = [
				'usr_email'         => $this->input->post('email'),
				'usr_nama'          => $this->input->post('nama'),
				'usr_group'         => $this->input->post('user_group'),
				'usr_prodi'         => $this->input->post('prodi'),
				'usr_isaktif'       => $this->input->post('status'),
				'usr_userupdate'    => $this->session->userdata('username'),
				'usr_lastupdate'    => date('Y-m-d H:i:s')
			];

			if ($this->user_model->insert($data)) {
				$this->session->set_flashdata('message', 'Data berhasil disimpan');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('user'));
			} else {
				$this->session->set_flashdata('message', 'Data gagal disimpan');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('user'));
			}
		}
	}

	public function ubah($id)
	{
		$row = $this->user_model->listbyid($id);

		if ($row) {
			$data = [
				'title'	=> 'User',
				'list'			=> $row,
				'usergroup'   => $this->usergroup_model->list(),
				'view'	=> 'admin/user/ubah'
			];
			$this->load->view('admin/template/wrapper', $data);
		} else {
			$this->session->set_flashdata('message', 'Data tidak ada');
			$this->session->set_flashdata('tipe', 'error');
			redirect(site_url('user'));
		}
	}


	public function simpan_perubahan()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('user_group', 'User Group', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_rules('prodi', 'Prodi', 'required');

		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_message('is_unique', '{field} ini sudah ada');

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Mohon isi data sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->ubah($this->input->post('user_id'));
		} else {
			$data = [
				'usr_nama'          => $this->input->post('nama'),
				'usr_group'         => $this->input->post('user_group'),
				'usr_prodi'         => $this->input->post('prodi'),
				'usr_isaktif'       => $this->input->post('status'),
				'usr_userupdate'    => $this->session->userdata('username'),
				'usr_lastupdate'    => date('Y-m-d H:i:s')
			];

			if ($this->user_model->update($this->input->post('user_id'), $data)) {
				$this->session->set_flashdata('message', 'Data berhasil diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('user'));
			} else {
				$this->session->set_flashdata('message', 'Data gagal diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('user'));
			}
		}
	}

	public function delete($id)
	{
		if ($this->user_model->delete($id)) {
			$this->session->set_flashdata('message', 'Data berhasil dihapus');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('user'));
		} else {
			$this->session->set_flashdata('message', 'Data gagal dihapus');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('user'));
		}
	}
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */