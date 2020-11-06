<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Batch_sertifikasi extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('batchsertifikasi_model');
		$this->load->model('sertifikasi_model');
	}

	public function index()
	{
		if(!isset($this->session->userdata['username']))
		{
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}

		$data = [
			'title'	=> 'Batch Sertifikasi',
			'batch'     => $this->batchsertifikasi_model->listbatch(),
			'view'	=> 'admin/batchsertifikasi/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function detail($id)
	{
		if(!isset($this->session->userdata['username']))
		{
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}

		$data = [
			'title'	=> 'Batch Sertifikasi',
			'batch'     => $this->batchsertifikasi_model->listbatchbyid($id),
			'view'	=> 'admin/batchsertifikasi/detail'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function tambah()
	{
		if(!isset($this->session->userdata['username']))
		{
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}

		$data = [
			'title'	=> 'Batch Sertifikasi',
			'subsertifikasi'     => $this ->sertifikasi_model->get_all_sub_sertifikasibystatus(),
			'view'	=> 'admin/batchsertifikasi/tambah'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function simpan()
	{
		$this->form_validation->set_rules('sub_sertifikasi', 'Sub Sertifikasi', 'required');
		$this->form_validation->set_rules('tanggal_daftar', 'Tanggal Daftar', 'required');
		$this->form_validation->set_rules('tanggal_terakhir', 'Tanggal Terakhir', 'required');
		$this->form_validation->set_rules('biaya_mhs', 'Biaya Mahasiswa', 'required|trim|numeric');
		$this->form_validation->set_rules('biaya_umum', 'Biaya Umum', 'required|trim|numeric');
		$this->form_validation->set_rules('jumlah_max_peserta', 'Jumlah Max Peserta', 'required|trim|numeric');
		$this->form_validation->set_rules('jumlah_min_peserta', 'Jumlah Min Peserta', 'required|trim|numeric');
		$this->form_validation->set_rules('jumlah_pertemuan', 'Jumlah Pertemuan', 'required|trim|numeric');
		if(empty($_FILES['banner']['name']))
		{
			$this->form_validation->set_rules('banner', 'Gambar Banner', 'required');
		}
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_message('numeric', '{field} harus diisi dengan angka');
		$this->form_validation->set_error_delimiters('<small class="text-danger">','</small>');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('message', 'Mohon Isi data sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->tambah();
		}
		else
		{
            //Penamaan file upload Gambar
			$nama = $this->batchsertifikasi_model->batchsertifikasikode();
			$config['upload_path']          = './assets/banner_batchsertifikasi/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['file_name']            = $nama . '_' . "Banner";
			$config['overwrite']            = true;

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('banner')) 
			{
				$this->upload->display_errors();
				die;
			}
			else 
			{
				$upload_data = $this->upload->data();
				$namafile = $upload_data['file_name'];
				$data = [
					'bs_subsertifikasi'         => $this->input->post('sub_sertifikasi'),
					'bs_mulai_daftar'           => $this->input->post('tanggal_daftar'),
					'bs_terakhir_daftar'        => $this->input->post('tanggal_terakhir'),
					'bs_biaya_mhs'              => $this->input->post('biaya_mhs'),
					'bs_biaya_umum'             => $this->input->post('biaya_umum'),
					'bs_banner'                 => $namafile,
					'bs_keterangan'             => $this->input->post('keterangan'),
					'bs_jumlahmax'              => $this->input->post('jumlah_max_peserta'),
					'bs_jumlahmin'              => $this->input->post('jumlah_min_peserta'),
					'bs_userupdate'             => $this->session->userdata('username'),
					'bs_jumlahpertemuan'        => $this->input->post('jumlah_pertemuan'), 
					'bs_lastupdate'             => date('Y-m-d H:i:s')
				];

				if($this->batchsertifikasi_model->insert($data))
				{
					$jumlah = $this->input->post('jumlah_pertemuan');

					for($i = 1; $i <= $jumlah; $i++ )
					{
						$absen[$i] = [
							'as_batch'      => $this->db->insert_id(),
							'as_nama_absen' => "Pertemuan Ke ",
							'as_userupdate' => $this->session->userdata('username'),
							'as_lastupdate' => date('Y-m-d H:i:s')
						];
					}
					$this->batchsertifikasi_model->simpan_absen($absen);

					$this->session->set_flashdata('message', 'Data berhasil disimpan');
					$this->session->set_flashdata('tipe', 'success');
					redirect(base_url('batch_sertifikasi'));
				}
				else
				{
					$this->session->set_flashdata('message', 'Data gagal disimpan');
					$this->session->set_flashdata('tipe', 'error');
					redirect(base_url('batch_sertifikasi'));
				}
			}
		}
	}

	public function ubah($id)
	{
		if(!isset($this->session->userdata['username']))
		{
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}

		$row = $this->batchsertifikasi_model->listbatchbyid($id);

		if($row)
		{
			$data = [
				'title'	=> 'Batch Sertifikasi',
				'subsertifikasi'     => $this->sertifikasi_model->get_all_sub_sertifikasibystatus(),
				'list'               => $row,
				'view'	=> 'admin/batchsertifikasi/ubah'
			];

			$this->load->view('admin/template/wrapper', $data);
		}
		else
		{
			$this->session->set_flashdata('message', 'Data tidak ada!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('batch_sertifikasi');
		}
	}

	public function simpan_perubahan()
	{
		$this->form_validation->set_rules('sub_sertifikasi', 'Sub Sertifikasi', 'required');
		$this->form_validation->set_rules('tanggal_daftar', 'Tanggal Daftar', 'required');
		$this->form_validation->set_rules('tanggal_terakhir', 'Tanggal Terakhir', 'required');
		$this->form_validation->set_rules('biaya_mhs', 'Biaya Mahasiswa', 'required|trim');
		$this->form_validation->set_rules('biaya_umum', 'Biaya Umum', 'required');
		$this->form_validation->set_rules('jumlah_max_peserta', 'Jumlah Max Peserta', 'required|trim|numeric');
		$this->form_validation->set_rules('jumlah_min_peserta', 'Jumlah Min Peserta', 'required|trim|numeric');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		$this->form_validation->set_rules('jumlah_pertemuan', 'Jumlah Pertemuan', 'required|trim|numeric');

		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_message('numeric', '{field} harus diisi dengan angka');
		$this->form_validation->set_error_delimiters('<small class="text-danger">','</small>');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('message', 'Mohon Isi data sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->ubah($this->input->post('batch_id'));
		}
		else
		{
			$config['upload_path']          = './assets/banner_batchsertifikasi/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['file_name']            = $this->input->post('batch_id') . '_' . "Banner";
			$config['overwrite']            = true;

			$this->upload->initialize($config);

			if (!empty($_FILES['banner']['name'])) {
				if (!$this->upload->do_upload('banner')) 
				{
					$this->upload->display_errors();
					die;    
				}
				else
				{

				}
			}   

			if (!empty($_FILES['banner']['name'])) {
				$namafile = $this->upload->data('file_name');
			} else {
				$namafile = $this->input->post('oldfile');
			}

			$data = [
				'bs_subsertifikasi'         => $this->input->post('sub_sertifikasi'),
				'bs_mulai_daftar'           => $this->input->post('tanggal_daftar'),
				'bs_terakhir_daftar'        => $this->input->post('tanggal_terakhir'),
				'bs_biaya_mhs'              => $this->input->post('biaya_mhs'),
				'bs_biaya_umum'             => $this->input->post('biaya_umum'),
				'bs_banner'                 => $namafile,
				'bs_keterangan'             => $this->input->post('keterangan'),
				'bs_jumlahmax'              => $this->input->post('jumlah_max_peserta'),
				'bs_jumlahmin'              => $this->input->post('jumlah_min_peserta'),
				'bs_jumlahpertemuan'        => $this->input->post('jumlah_pertemuan'), 
				'bs_userupdate'             => $this->session->userdata('username'),
				'bs_lastupdate'             => date('Y-m-d H:i:s')
			];

			if($this->batchsertifikasi_model->update($this->input->post('batch_id'),$data))
			{
				$cekjumlah = $this->batchsertifikasi_model->cekjumlahtabel($this->input->post('batch_id'));
				$jumlah = $this->input->post('jumlah_pertemuan');
				$cekid = $this->batchsertifikasi_model->cekid($this->input->post('batch_id'));

				if($jumlah > $cekjumlah)
				{
					$total = $jumlah - $cekjumlah;

					for($i = 1; $i <= $total; $i++ )
					{
						$absen[$i] = [
							'as_batch'      => $this->input->post('batch_id'),
							'as_nama_absen' => "Pertemuan Ke",
							'as_userupdate' => $this->session->userdata('username'),
							'as_lastupdate' => date('Y-m-d H:i:s')
						];
					}
					$this->batchsertifikasi_model->simpan_absen($absen);
				}
				else
				{
                    //Parameter awal
					$i = 1;
					$jumlahpertemuan = $this->input->post('jumlah_pertemuan');

					$detail = $this->batchsertifikasi_model->detailabsen($this->input->post('batch_id'));

					foreach($detail as $d)
					{
						if ($i <= $jumlahpertemuan)
						{
                            //jika jumlahpertemuan lebih kecil dari $i
						}
						else
						{ 
                            //jika jumlahpertemuan lebih dari $i maka akan loop
							$this->batchsertifikasi_model->delete_absen($d->as_id);
						}
						$i++;
					}
				}
				$this->session->set_flashdata('message', 'Data berhasil diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('batch_sertifikasi'));
			}
			else
			{
				$this->session->set_flashdata('message', 'Data gagal diubah');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('batch_sertifikasi'));
			}
		}
	}

	public function delete($id)
	{
		if(!isset($this->session->userdata['username']))
		{
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}

		if($this->batchsertifikasi_model->delete($id))
		{
			$this->session->set_flashdata('message', 'Data berhasil dihapus');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('batch_sertifikasi'));
		}
		else
		{
			$this->session->set_flashdata('message', 'Data gagal dihapus');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('batch_sertifikasi'));
		}
	}

	public function daftar_umum($id_batch, $id_subser, $id_sertifikasi)
	{
		if (!isset($this->session->userdata['email'])) 
		{
			$this->session->set_flashdata('message', 'Anda belum login! Silahkan login terlebih dahulu');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('home/detail_sertifikasi/' . $id_batch));
		} 
		else 
		{
			$cek = $this->batchsertifikasi_model->cek($id_batch, $id_subser,$id_sertifikasi)->row();
			
			header('content-type: application/json');
			echo json_encode($cek);
			die;
			
			if ($cek->srtu_status == 'Lulus' || $cek) 
			{
                //jika sudah pernah daftar
				$this->session->set_flashdata('message', 'Anda sudah mendaftar!');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('home/detail_sertifikasi/' . $id_batch));
			} 
			else 
			{
                 // Jika Sudah pernah daftar tapi belum lulus
				if($cek->srtu_status == 'Tidak Lulus' )
				{
					$data_blm = $cek;
					$update = [
						'srtu_status' => NULL,
						'srtu_grade' => NULL,
						'srtu_penghargaan' => NULL,
						'srtu_lembagasertifikasi' => NULL,
						'srtu_catatan'	=> NULL
					];
					$this->batchsertifikasi_model->updatetidaklulusumum($data_blm->srtu_id, $data_blm->srtu_sertifikasi, $this->session->userdata('email'), $update);

					$this->daftar_umum_tidaklulus($data_blm->ssu_sertifikasi_umum,$data_blm->ssu_subsertifikasi, $data_blm->ssu_batch);
				}
				else
				{
					$kode = "U".$this->session->userdata('ktp')."-";
					$count = $this->batchsertifikasi_model->generateidsertifikasiumum($kode);
					$totalcount = intval($count->total);
					$no = $totalcount + 1;

					if($no < 10)
					{
						$no = "00" . $no;
					}
					elseif($no >= 10 && $no < 100)
					{
						$no = "0" . $no;
					}
					elseif ($no >= 100 && $no < 1000)
					{
						$no = $no;
					}

					$id = $kode . $no;

					$data = [
						'srtu_id'                 => $id,
						'srtu_sertifikasi'        => $this->uri->segment(5),
						'srtu_peserta'            => $this->session->userdata('email'),
						'srtu_tanggal_daftar'     => date('Y-m-d H:i:s'),
						'srtu_userupdate'         => $this->session->userdata('email'),
						'srtu_lastupdate'         => date('Y-m-d H:i:s')
					];

					$ceksertifikasi = $this->sertifikasi_model->ceksertifikasi($this->uri->segment(5), $this->session->userdata('email'));

					if($ceksertifikasi->num_rows() > 0)
					{
                        //Insert ke tabel untuk detail pembayaran sertifikasi Umum
                        // Generate ID
						$id_subsertifikasi_umum = $this->batchsertifikasi_model->getidsertifikasiumum()."-";

						$count = $this->batchsertifikasi_model->generateIDsubsertifikasiumum($id_subsertifikasi_umum);
						$totalcount = intval($count->total);
						$no = $totalcount + 1;

						if($no < 10)
						{
							$no = "0" . $no;
						}
						else
						{
							$no = $no;
						}

						$id_subsertifikasiumum = $id_subsertifikasi_umum.$no;
						$subsertifikasi = $this->uri->segment(4);

						$data2 = [
							'ssu_id'                     => $id_subsertifikasiumum,
							'ssu_sertifikasi_umum'       => $this->batchsertifikasi_model->getidsertifikasiumum(),
							'ssu_subsertifikasi'         => $subsertifikasi,
							'ssu_batch'                  => $id_batch,
							'ssu_tanggaldaftar'          => date('Y-m-d H:i:s'),
							'ssu_status'                 => "Menunggu Pembayaran",
							'ssu_userupdate'             => $this->session->userdata('email'),
							'ssu_lastupdate'             => date('Y-m-d H:i:s')
						];

						$this->batchsertifikasi_model->insert_subsertifikasiumum($data2);
						$this->session->set_flashdata('message', 'Anda Berhasil mendaftar');
						$this->session->set_flashdata('tipe', 'success');
						redirect(base_url('akun_umum/akun'));
					}
					else
					{
						if ($this->batchsertifikasi_model->daftar_sertifikasi_umum($data)) 
						{
                            //Insert ke tabel untuk detail pembayaran sertifikasi Umum
                            // Generate ID
							$id_subsertifikasi_umum = $this->batchsertifikasi_model->getidsertifikasiumum()."-";

							$count = $this->batchsertifikasi_model->generateIDsubsertifikasiumum($id_subsertifikasi_umum);
							$totalcount = intval($count->total);
							$no = $totalcount + 1;

							if($no < 10)
							{
								$no = "0" . $no;
							}
							else
							{
								$no = $no;
							}

							$id_subsertifikasiumum = $id_subsertifikasi_umum.$no;
							$subsertifikasi = $this->uri->segment(4);

							$data2 = [
								'ssu_id'                     => $id_subsertifikasiumum,
								'ssu_sertifikasi_umum'       => $this->batchsertifikasi_model->getidsertifikasiumum(),
								'ssu_subsertifikasi'         => $subsertifikasi,
								'ssu_batch'                  => $id_batch,
								'ssu_tanggaldaftar'          => date('Y-m-d H:i:s'),
								'ssu_status'                 => "Menunggu Pembayaran",
								'ssu_userupdate'             => $this->session->userdata('email'),
								'ssu_lastupdate'             => date('Y-m-d H:i:s')
							];

							$this->batchsertifikasi_model->insert_subsertifikasiumum($data2);
							$this->session->set_flashdata('message', 'Anda Berhasil mendaftar');
							$this->session->set_flashdata('tipe', 'success');
							redirect(base_url('akun_umum/akun'));
						} 
						else 
						{
							$this->session->set_flashdata('message', 'Anda gagal mendaftar');
							$this->session->set_flashdata('tipe', 'error');
							redirect(base_url('home'));
						}
					}
				}
			}
		}
	}

	public function daftar_mahasiswa($id_batch, $id_subser, $id_sertifikasi)
	{
		if (!isset($this->session->userdata['npm'])) 
		{
			$this->session->set_flashdata('message', 'Anda belum login! Silahkan login terlebih dahulu');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('home/detail_sertifikasi/' . $id_batch));
		} 
		else 
		{
			$cek = $this->batchsertifikasi_model->cekmahasiswa($this->session->userdata('npm'))->row_array();
			// header('content-type: application/json');
			// echo json_encode($cek);
			// die;

			if ($cek['sm_status'] == 'Lulus')
			{
                //jika sudah pernah daftar dan lulus
				$this->session->set_flashdata('message', 'Anda sudah Lulus sertifikasi ini');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('home/detail_sertifikasi/' . $id_batch));
			} 
			else 
			{
				if($cek['sm_sertifikasi'] == $id_sertifikasi && $cek['ssm_batch'] == $id_batch &&  $cek['ssm_subsertifikasi'] == $id_subser && $cek['sm_status'] == '' || $cek['sm_status'] == NULL)
				{
					//jika sudah pernah daftar
					$this->session->set_flashdata('message', 'Anda sudah pernah mendaftar sertifikasi ini');
					$this->session->set_flashdata('tipe', 'error');
					redirect(base_url('home/detail_sertifikasi/' . $id_batch));
				}
				else
				{
					// Jika Sudah pernah daftar tapi belum lulus
					if($cek['sm_status'] == 'Tidak Lulus')
					{
						echo 'daftar tidak lulus';
						die;
						$data_blm = $cek;
						$update = [
							'sm_status' => NULL,
							'sm_grade' => NULL,
							'sm_penghargaan' => NULL,
							'sm_lembagasertifikasi' => NULL,
							'sm_catatan'	=> NULL
						];

						$this->batchsertifikasi_model->updatetidaklulusmahasiswa($data_blm['sm_id'], $data_blm['sm_sertifikasi'], $this->session->userdata('npm'), $update);

						$this->daftar_mhs_tidaklulus($data_blm['ssm_sertifikasi_mahasiswa'],$data_blm['ssm_subsertifikasi'], $data_blm['ssm_batch']);
					}
					else
					{
						//Generate Kode
						$npm = $this->session->userdata('npm');
						$count = $this->batchsertifikasi_model->generateID($npm);
						$totalcount = intval($count->total);
						$no = $totalcount + 1;

						if($no < 10)
						{
							$no = "00" . $no;
						}
						elseif($no >= 10 && $no < 100)
						{
							$no = "0" . $no;
						}
						else
						{
							$no = $no;
						}

						$id_sertifikasi_mhs = $npm.$no;
						//Jika Baru daftar pertama kali
						$data = [
							'sm_id'                   => $id_sertifikasi_mhs,
							'sm_sertifikasi'          => $this->uri->segment(5),
							'sm_mahasiswa'            => $this->session->userdata('npm'),
							'sm_tanggal_daftar'       => date('Y-m-d H:i:s'),
							'sm_userupdate'           => $this->session->userdata('npm'),
							'sm_lastupdate'           => date('Y-m-d H:i:s')
						];

						$ceksertifikasi = $this->sertifikasi_model->ceksertifikasimahasiswa($this->uri->segment(5), $this->session->userdata('npm'));

						if($ceksertifikasi->num_rows() > 0)
						{
							//Insert ke tabel untuk detail pembayaran sertifikasi mahasiswa
							// Generate ID
							$id_subsertifikasi_mhs = $this->batchsertifikasi_model->getidsertifikasimahasiswa();
							$count = $this->batchsertifikasi_model->generateIDsubsertifikasimhs($id_subsertifikasi_mhs);
							$totalcount = intval($count->total);
							$no = $totalcount + 1;

							if($no < 10)
							{
								$no = "0" . $no;
							}
							else
							{
								$no = $no;
							}

							$id_subsertifikasimhs = $id_subsertifikasi_mhs.$no;
							$subsertifikasi = $this->uri->segment(4);

							$data2 = [
								'ssm_id'                     => $id_subsertifikasimhs,
								'ssm_sertifikasi_mahasiswa'  => $this->batchsertifikasi_model->getidsertifikasimahasiswa(),
								'ssm_subsertifikasi'         => $subsertifikasi,
								'ssm_batch'                  => $id_batch,
								'ssm_tanggaldaftar'          => date('Y-m-d H:i:s'),
								'ssm_status'                 => "Menunggu Pembayaran",
								'ssm_userupdate'             => $this->session->userdata('npm'),
								'ssm_lastupdate'             => date('Y-m-d H:i:s')
							];

							$this->batchsertifikasi_model->insert_subsertifikasimhs($data2);

							$this->session->set_flashdata('message', 'Anda Berhasil mendaftar');
							$this->session->set_flashdata('tipe', 'success');
							redirect(base_url('akun_mahasiswa/akun'));
						}
						else
						{
							if ($this->batchsertifikasi_model->daftar_sertifikasi_mhs($data)) 
							{
								//Insert ke tabel untuk detail pembayaran sertifikasi mahasiswa
								// Generate ID
								$id_subsertifikasi_mhs = $id_sertifikasi_mhs;
								$count = $this->batchsertifikasi_model->generateIDsubsertifikasimhs($id_subsertifikasi_mhs);
								$totalcount = intval($count->total);
								$no = $totalcount + 1;

								if($no < 10)
								{
									$no = "0" . $no;
								}
								else
								{
									$no = $no;
								}

								$id_subsertifikasimhs = $id_subsertifikasi_mhs.$no;
								$subsertifikasi = $this->uri->segment(4);

								$data2 = [
									'ssm_id'                     => $id_subsertifikasimhs,
									'ssm_sertifikasi_mahasiswa'  => $this->batchsertifikasi_model->getidsertifikasimahasiswa(),
									'ssm_subsertifikasi'         => $subsertifikasi,
									'ssm_batch'                  => $id_batch,
									'ssm_tanggaldaftar'          => date('Y-m-d H:i:s'),
									'ssm_status'                 => "Menunggu Pembayaran",
									'ssm_userupdate'             => $this->session->userdata('npm'),
									'ssm_lastupdate'             => date('Y-m-d H:i:s')
								];

								$this->batchsertifikasi_model->insert_subsertifikasimhs($data2);

								$this->session->set_flashdata('message', 'Anda Berhasil mendaftar');
								$this->session->set_flashdata('tipe', 'success');
								redirect(base_url('akun_mahasiswa/akun'));
							} 
							else 
							{
								$this->session->set_flashdata('message', 'Anda gagal mendaftar');
								$this->session->set_flashdata('tipe', 'error');
								redirect(base_url('home/detail_sertifikasi/' . $id));
							}
						}
					}
				}
			}
		}
	}

	public function daftar_umum_tidaklulus($id_sertifikasiumum,$id_subser)
	{
        //Insert ke tabel untuk detail pembayaran sertifikasi Umum
        // Generate ID
		$id_subsertifikasi_umum = $this->batchsertifikasi_model->getidsertifikasiumum()."-";

		$count = $this->batchsertifikasi_model->generateIDsubsertifikasiumum($id_subsertifikasi_umum);
		$totalcount = intval($count->total);
		$no = $totalcount + 1;

		if($no < 10)
		{
			$no = "0" . $no;
		}
		else
		{
			$no = $no;
		}

		$id_subsertifikasiumum = $id_subsertifikasi_umum.$no;

		$data = [
			'ssu_id'                     => $id_subsertifikasiumum,
			'ssu_sertifikasi_umum'       => $id_sertifikasiumum,
			'ssu_subsertifikasi'         => $id_subser,
			'ssu_batch'                  => $this->uri->segment(3),
			'ssu_tanggaldaftar'          => date('Y-m-d H:i:s'),
			'ssu_status'                 => "Menunggu Pembayaran",
			'ssu_userupdate'             => $this->session->userdata('email'),
			'ssu_lastupdate'             => date('Y-m-d H:i:s')
		];

		if ($this->batchsertifikasi_model->daftar_sertifikasi_umum_tidaklulus($data)) 
		{
			$this->session->set_flashdata('message', 'Anda Berhasil mendaftar Ulang');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('akun_umum/akun'));
		} 
		else 
		{
			$this->session->set_flashdata('message', 'Anda gagal mendaftar');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('home'));
		}
	}

	public function daftar_mhs_tidaklulus($id_sertifikasimahasiswa, $id_subser)
	{
         //Insert ke tabel untuk detail pembayaran sertifikasi mahasiswa
        // Generate ID
		$id_subsertifikasi_mhs = $this->batchsertifikasi_model->getidsertifikasimahasiswa();
		$count = $this->batchsertifikasi_model->generateIDsubsertifikasimhs($id_subsertifikasi_mhs);
		$totalcount = intval($count->total);
		$no = $totalcount + 1;

		if($no < 10)
		{
			$no = "0" . $no;
		}
		else
		{
			$no = $no;
		}

		$id_subsertifikasimhs = $id_subsertifikasi_mhs.$no;
		$subsertifikasi = $this->uri->segment(4);

		$data = [
			'ssm_id'                     => $id_subsertifikasimhs,
			'ssm_sertifikasi_mahasiswa'  => $this->batchsertifikasi_model->getidsertifikasimahasiswa(),
			'ssm_subsertifikasi'         => $subsertifikasi,
			'ssm_batch'                  => $this->uri->segment(3),
			'ssm_tanggaldaftar'          => date('Y-m-d H:i:s'),
			'ssm_status'                 => "Menunggu Pembayaran",
			'ssm_userupdate'             => $this->session->userdata('npm'),
			'ssm_lastupdate'             => date('Y-m-d H:i:s')
		];

		if($this->batchsertifikasi_model->insert_subsertifikasimhs($data))
		{
			$this->session->set_flashdata('message', 'Anda Berhasil Mendaftar Ulang');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('akun_mahasiswa/akun'));
		}
		else
		{
			$this->session->set_flashdata('message', 'Anda Gagal mendaftar');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('home'));
		}
	}
}

/* End of file Batch_sertifikasi.php */
/* Location: ./application/controllers/Batch_sertifikasi.php */