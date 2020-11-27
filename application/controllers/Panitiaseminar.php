<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panitiaseminar extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('panitiaseminar_model');
		$this->load->model('seminar_model');

		if (!isset($this->session->userdata['username'])) {
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}
	}

	public function list_panitia($seminar)
	{
		$data = [
			'title'	=> 'Panitia',
			'seminar'	=> $seminar,
			'list'      => $this->panitiaseminar_model->list($seminar),
			'view'	=> 'admin/panitia_seminar/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function tambah($seminar)
	{
		$data = [
			'title'	=> 'Panitia',
			'seminarid' => $seminar,
			'view'	=> 'admin/panitia_seminar/tambah'
		];
		$this->load->view('admin/template/wrapper', $data);
	}

	public function simpan()
	{
		$this->form_validation->set_rules('nama_panitia', 'Nama Panitia', 'required|trim');
		$this->form_validation->set_rules('email_panitia', 'Email Panitia', 'required|trim');

		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->tambah($this->input->post('seminar'));
		} 
		else 
		{
			
			$data = [
				'pan_nama'            => $this->input->post('nama_panitia'),
				'pan_email'			  => $this->input->post('email_panitia'),
				'pan_seminar'		  => $this->input->post('seminar'),
				'pan_userupdate'      => $this->session->userdata('username'),
				'pan_lastupdate'      => date('Y-m-d H:i:s')
			];

			if ($this->panitiaseminar_model->insert($data)) {
				$this->session->set_flashdata('message', 'Data berhasil ditambah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('panitiaseminar/list_panitia/' . $this->input->post('seminar')));
			} else {
				$this->session->set_flashdata('message', 'Data gagal ditambah');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('panitiaseminar/list_panitia/' . $this->input->post('seminar')));
			}
		}
	}

	public function ubah($id)
	{
		$row = $this->panitiaseminar_model->listbyid($id);

		if ($row) {
			$data = [
				'title'	=> 'Panitia',
				'list'      => $row,
				'seminarid' => $row->pan_seminar,
				'view'	=> 'admin/panitia_seminar/ubah'
			];
			$this->load->view('admin/template/wrapper', $data);
		} else {
			$this->session->set_flashdata('message', 'Data tidak ada');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('panitiaseminar/list_panitia/' . $this->uri->segment(3)));
		}
	}

	public function simpan_perubahan()
	{
		$this->form_validation->set_rules('nama_panitia', 'Nama Panitia', 'required|trim');
		$this->form_validation->set_rules('email_panitia', 'Email Panitia', 'required|trim');

		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->ubah($this->input->post('panitia_id'));
		} 
		else 
		{
			
			$data = [
				'pan_nama'            => $this->input->post('nama_panitia'),
				'pan_email'			  => $this->input->post('email_panitia'),
				'pan_userupdate'      => $this->session->userdata('username'),
				'pan_lastupdate'      => date('Y-m-d H:i:s')
			];

			if ($this->panitiaseminar_model->update($this->input->post('panitia_id'), $data)) {
				$this->session->set_flashdata('message', 'Data berhasil diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('panitiaseminar/list_panitia/' . $this->input->post('seminar')));
			} else {
				$this->session->set_flashdata('message', 'Data gagal diubah');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('panitiaseminar/list_panitia/' . $this->input->post('seminar')));
			}
		}
	}

	public function delete($id, $seminar)
	{
		if ($this->panitiaseminar_model->delete($id, $seminar)) {
			$this->session->set_flashdata('message', 'Data berhasil dihapus');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('panitiaseminar/list_panitia/' . $this->uri->segment(4)));
		} else {
			$this->session->set_flashdata('message', 'Data gagal dihapus');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('panitiaseminar/list_panitia/' . $this->uri->segment(4)));
		}
	}

	public function send_sertifikat($id_seminar, $email)
	{

		$row = $this->panitiaseminar_model->cetaksertifikatpanitia($id_seminar, $email);


		$data = [
			'list'     => $row,
			'ttd'	   => $this->seminar_model->get_ttd_narasumber($id_seminar)
		];
		
		$this->load->library('pdf');

		if($row->ms_bentuk_sertifikat == 'portrait')
		{
			$this->load->view('admin/seminar/template_sertifikat/template_panitia_portrait', $data);
			$orientation		= 'portrait';
			$paper_size			= 'A4';
			$html               = $this->output->get_output();
		}
		else
		{
			$this->load->view('admin/seminar/template_sertifikat/template_panitia', $data);
			$orientation		= 'landscape';
			$paper_size			= 'A4';
			$html               = $this->output->get_output();
		}

		$this->pdf->set_paper($paper_size, $orientation);
		$this->pdf->load_html($html);
		$this->pdf->render();
		$filename = $row->pan_nama . '.pdf';
		$file = $this->pdf->output();

		// $this->pdf->stream($row->pan_nama . ".pdf", array('Attachment' => 0));


		// simpan hasil export pdf
		file_put_contents($filename, $file);

		$this->load->library('phpmailer_lib');
		$mail = $this->phpmailer_lib->load();

		$mail->setFrom('noreply.uib.ac.id@gmail.com', 'Universitas Internasional Batam');
		$mail->AddAttachment($filename); 
		$mail->addAddress($row->pan_email, ucfirst($row->pan_nama));
		$mail->Subject = 'Sertifikat Seminar Untuk Panitia ' . $row->pan_nama;
		$mail->Body = 'Berikut ini kami kirimkan sertifikat seminar atas nama ' . $row->pan_nama;
		$mail->IsHTML(true);
		$mail->send();

		if($mail->send())
		{
			$this->session->set_flashdata('message', 'Sertifikat berhasil dikirim');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('panitiaseminar/list_panitia/' . $row->pan_seminar));
		}
		// agar hasil sertifikat tidak ditampilkan
		unlink($filename);

	}
}

/* End of file Panitiaseminar.php */
/* Location: ./application/controllers/Panitiaseminar.php */