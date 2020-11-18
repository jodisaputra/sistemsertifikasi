<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dashboard_model');
	}

	public function index()
	{
		if (!isset($this->session->userdata['username'])) {
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}

		// $result_mhs = array();
		// $query_mhs = $this->dashboard_model->getresultmahasiswa();

		// foreach ($query_mhs as $query) {
		// 	$total = $this->dashboard_model->gettotalsertifikasimahasiswa($query['ssm_batch']);

		// 	if (!$total) {
		// 	} else {
		// 		$result_mhs[$query['ssm_batch']] = $total;
		// 	}
		// }

		// header('content-type: application/json');
		// echo json_encode($result_mhs);
		// die;

		$data = [
			'title'	=> 'Dashboard',
			'totaldaftar' => $this->dashboard_model->gettotalpendaftar(),
			'totalseminar' => $this->dashboard_model->gettotalseminar(),
			'totallulus' => $this->dashboard_model->gettotalmhslulus(),
			'totaltidaklulus' => $this->dashboard_model->gettotalmhstidaklulus(),
			'sertifikasi' => $this->dashboard_model->list_sertifikasi(),
			// 'totalmahasiswaperbatch' => $result_mhs,
			'view'	=> 'admin/index'
		];
		// header('content-type: application/json');
		// echo json_encode($data);
		// die;

		$this->load->view('admin/template/wrapper', $data);
	}
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */