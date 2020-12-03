<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Liststatusbayar extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('liststatusbayar_model');

		if(!isset($this->session->userdata['username']))
		{
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}
	}

	public function mahasiswa()
	{
		$nama_mhs = array();

		$query =  $this->liststatusbayar_model->list()->result_array();

		foreach ($query as $q) {
			$data_mhs = $this->liststatusbayar_model->getnama($q['sm_mahasiswa']);
			$nama_mhs[$q['sm_mahasiswa']] = $data_mhs->name;
		}

		$data = [
			'title'	=> 'List Pendaftar Sertifikasi Mahasiswa',
			'list'      => $query,
			'nama_mhs'	=> $nama_mhs,
			'view'	=> 'admin/list_pendaftar/mahasiswa/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function umum()
	{

		$data = [
			'title'	=> 'List Pendaftar Sertifikasi Umum',
			'list'      => $this->liststatusbayar_model->list_umum()->result(),
			'view'	=> 'admin/list_pendaftar/umum/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}


}