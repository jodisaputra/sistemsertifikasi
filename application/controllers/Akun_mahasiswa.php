<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun_mahasiswa extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Jika ada session user umum maka diblok
		$this->load->model('seminar_model');
		$this->load->model('sertifikasi_model');
		$this->load->helper('my_function_helper');
		if (isset($this->session->userdata['email'])) {
			$this->session->set_flashdata('message', 'Maaf anda sedang login sebagai umum !');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('home'));
		}
		// Jika ada session user admin maka diblok
	}

	public function index()
	{
		if (isset($this->session->userdata['npm'])) {
			redirect(base_url('home'));
		}

		$data = [
			'view'	=> 'akun/mahasiswa/login'
		];

		$this->load->view('template/wrapper', $data);
	}

	public function akun()
	{
		if (!isset($this->session->userdata['npm'])) {
			redirect(base_url('akun_mahasiswa'));
		}

		$data = [
			'nama'          => $this->session->userdata['nama'],
			'jurusan'       => $this->session->userdata['jurusan'],
			'npm'           => $this->session->userdata['npm'],
			'seminar'       => $this->seminar_model->listseminarbymahasiswa($this->session->userdata['npm']),
			'cert'          => $this->sertifikasi_model->listsertifikasibymhs2($this->session->userdata['npm']),
			'view'			=> 'akun/mahasiswa/profile'
		];

		// header('content-type: application/json');
		// echo json_encode($data);
		// die;
		$this->load->view('template/wrapper', $data);
	}

	public function detailsertifikasi($id_sertifikasi)
	{
		if (!isset($this->session->userdata['npm'])) {
			redirect(base_url('akun_mahasiswa'));
		}

		$data = [
			'nama'          => $this->session->userdata['nama'],
			'jurusan'       => $this->session->userdata['jurusan'],
			'npm'           => $this->session->userdata['npm'],
			'sertifikasi'   => $this->sertifikasi_model->listsertifikasibymhs($id_sertifikasi),
			'view'			=> 'akun/mahasiswa/profile-detail'
		];

		$this->load->view('template/wrapper', $data);
	}

	public function login()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');


		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Mohon isi dengan benar');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('akun_mahasiswa'));
		} else {
			//Login API
			$data = [
				'username'          => $this->input->post('username'),
				'password'          => $this->input->post('password')
			];

			$data_json = json_encode($data);

			$curl = curl_init('http://apps.uib.ac.id/portal/api/v2/login');

			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

			curl_setopt($curl, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Content-Length: ' . strlen($data_json)
			));

			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data_json);

			$result = curl_exec($curl);

			curl_close($curl);

			$data = json_decode($result);

			if (isset($data->id)) {
				$sess['npm']        = $data->id;
				$sess['nama']       = $data->name;
				$sess['jurusan']    = $data->major;

				$this->session->set_userdata($sess);
				$this->session->set_flashdata('message', 'Hello ' . $data->name);
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('home'));
			} else {
				$this->session->set_flashdata('message', 'Username atau Password Salah');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('akun_mahasiswa'));
			}
		}
	}

	public function modelsertifikat()
	{
		$seminar = $this->input->post('id_seminar');
		$npm     = $this->input->post('npm');

		$row = $this->seminar_model->cetaksertifikatseminarmhs($seminar, $npm);

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
				'ttd'	   => $this->seminar_model->get_ttd_narasumber($seminar)
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

	public function cetak_struksertifikasi()
	{
		$ssu_id = $this->input->post('id_ssu');
		$subsertifikasi = $this->input->post('id_subsertifikasi');
		$sertifikasi_mhs = $this->input->post('sertifikasi_mahasiswa');

		$mhs = array();
		$query = $this->sertifikasi_model->listmahasiswarop($subsertifikasi);

		foreach ($query as $q) {
			$data_mhs = $this->sertifikasi_model->getnama($q->sm_mahasiswa);
			$mhs[$q->sm_mahasiswa] = [
				'nama' => $data_mhs->name,
				'prodi'	=> $data_mhs->major
			];
		}

		$data_transfer = $this->sertifikasi_model->getdatarop($ssu_id, $subsertifikasi, $sertifikasi_mhs);
		$dana = "Rp " . number_format($data_transfer['ssm_totalbayar'], 2, ',', '.');
		$terbilang = terbilang(intval($data_transfer['ssm_totalbayar']));

		$data = [
			'id'			=> $data_transfer['ssm_subsertifikasi'],
			'npm'			=> $data_transfer['sm_mahasiswa'],
			'nama'			=> $mhs,
			'diterima_dari'	=> $data_transfer['ssm_namapemilik'],
			'bank'			=> $data_transfer['ssm_bank'],
			'total_dana'	=> $dana,
			'terbilang'		=> $terbilang
		];
		// header('content-type: application/json');
		// echo json_encode($sertifikasi_mhs);
		// die;
		$this->load->view('akun/mahasiswa/format_ropmhssertifikasi', $data);
		$this->load->library('pdf');

		$paper_size         = 'A4';
		$orientation        = 'potrait';
		$html               = $this->output->get_output();

		$this->pdf->set_paper($paper_size, $orientation);
		$this->pdf->load_html($html);
		$this->pdf->render();
		$this->pdf->stream("ROP.pdf", array('Attachment' => 0));
	}

	public function cetak_strukseminar()
	{
		$npm = $this->input->post('npm_mhs');
		$seminar = $this->input->post('seminar');

		$mhs = array();
		$query = $this->seminar_model->listseminarmahasiswa($seminar);

		foreach ($query as $q) {
			$data_mhs = $this->seminar_model->getnama($q->smhs_mahasiswa);
			$mhs[$q->smhs_mahasiswa] = [
				'nama' => $data_mhs->name,
				'prodi'	=> $data_mhs->major
			];
		}

		$data_transfer = $this->seminar_model->getdatarop($npm, $seminar);
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
		// echo json_encode($npm);
		// die;
		$this->load->view('akun/mahasiswa/format_ropmhsseminar', $data);
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

/* End of file Akun_mahasiswa.php */
/* Location: ./application/controllers/Akun_mahasiswa.php */