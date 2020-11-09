<section class="section-gap-top section-gap-bottom">

	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">

						<div class="mt-4">
							<table>
								<tr>
									<td>
										<h5>Nama</h5>
									</td>
									<td>
										<h5>:</h5>
									</td>
									<td>
										<h5><?php echo $nama ?></h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Email</h5>
									</td>
									<td>
										<h5>:</h5>
									</td>
									<td>
										<h5><?php echo $email ?></h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>KTP</h5>
									</td>
									<td>
										<h5>:</h5>
									</td>
									<td>
										<h5><?php echo $ktp ?></h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>WA</h5>
									</td>
									<td>
										<h5>:</h5>
									</td>
									<td>
										<h5><?php echo $wa ?></h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Instansi</h5>
									</td>
									<td>
										<h5>:</h5>
									</td>
									<td>
										<h5><?php echo $asal ?></h5>
									</td>
								</tr>
							</table>
						</div>

						<hr class="mt-5 mb-4">
						<h4 class="text-center">Data Sertifikasi</h4>

						<div class="mt-4">
							<div class="table-responsive">
								<table id="example" class="table table-striped table-bordered">
									<thead>
										<th>No</th>
										<th>Nama Sertifikasi</th>
										<th>Status Sertifikasi</th>
										<th>Grade</th>
										<th>Sertifikat</th>
										<th>Catatan</th>
										<th>Aksi</th>
									</thead>
									<tbody>
										<?php $no = 1;
										foreach ($cert as $s) :
										?>
											<tr>
												<td><?php echo $no++ ?></td>
												<td><?php echo $s->cert_sertifikasi ?></td>
												<td>
													<?php if ($s->srtu_status == "Lulus") { ?>
														<div class="badge badge-success">Lulus</div>
													<?php } elseif ($s->srtu_status == "Tidak Lulus") { ?>
														<div class="badge badge-danger">Tidak Lulus</div>
													<?php } else { ?>
														<div class="badge badge-warning">Belum Mengikuti Sertifikasi</div>
													<?php } ?>
												</td>
												<td><b><?php echo $s->srtu_grade ?></b></td>
												<td>
													<?php if ($s->srtu_sertifikat == NULL) { ?>
														<div class="badge badge-warning">Belum Ada Sertifikat</div>
													<?php } else { ?>
														<a href="<?php echo base_url('assets/sertifikat_umum/' . $s->srtu_sertifikat) ?>" class="btn btn-warning btn-sm" target="_blank">Lihat Sertifikat</a>
													<?php } ?>
												</td>
												<td><?php echo $s->srtu_catatan ?></td>
												<td>
													<a href="<?php echo base_url('akun_umum/detailsertifikasi/' . $s->srtu_sertifikasi); ?>" class="btn btn-info btn-sm">Detail</a>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>

						<hr class="mt-5 mb-4">
						<h4 class="text-center">Data Seminar</h4>

						<div class="mt-4">
							<div class="table-responsive">
								<table id="example2" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Seminar</th>
											<th>Status Pembayaran</th>
											<th>Keterangan</th>
											<th>Sertifikat</th>
											<th width="20%">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1; ?>
										<?php foreach ($seminar as $s) : ?>
											<tr>
												<td><?php echo $no++ ?></td>
												<td><?php echo $s->smr_acara ?></td>
												<td>
													<?php if ($s->su_status == "Menunggu Pembayaran") { ?>
														<div class="badge badge-warning">Menunggu Pembayaran</div>
													<?php } elseif ($s->su_status == "Validasi Pembayaran") { ?>
														<div class="badge badge-info">Validasi Pembayaran</div>
													<?php } elseif ($s->su_status == 'Lunas') { ?>
														<div class="badge badge-success">Lunas</div>
													<?php } else { ?>
														<div class="badge badge-danger">Tolak</div>
													<?php } ?>
												</td>
												<td>
													<?php if ($s->su_status == "Menunggu Pembayaran") { ?>
														<p style="color: black; font-weight: bold">Belum Melakukan Pembayaran</p>
													<?php } elseif ($s->su_status == 'Validasi Pembayaran') { ?>
														<p class="text-info" style="font-weight: bold">Menunggu Validasi Admin</p>
													<?php } elseif ($s->su_status == 'Lunas') { ?>
														<p style="color: green; font-weight: bold"><?php echo $s->su_keteranganpembayaran; ?></p>
													<?php } elseif ($s->su_status == 'Tolak') { ?>
														<p style="color: red; font-weight: bold"><?php echo $s->su_keteranganpembayaran; ?></p>
													<?php } ?>
												</td>
												<td>
													<?php if ($s->su_ishadir == NULL) { ?>
														<p class="text-danger">Sertifikat Belum Ada</p>
													<?php } else { ?>
														<form action="<?php echo base_url('akun_umum/modelsertifikat'); ?>" method="post">
															<input type="hidden" name="id_seminar" value="<?php echo $s->smr_id ?>">
															<input type="hidden" name="id_peserta" value="<?php echo $this->session->userdata('email') ?>">
															<button target="_blank" class="btn btn-warning btn-sm">Lihat Sertifikat</button>
														</form>
													<?php } ?>
												</td>
												<td>
													<?php if ($s->su_status == "Menunggu Pembayaran") { ?>
														<a href="<?php echo base_url('seminar/buktibayarumum/' . $s->smr_id); ?>" class="btn btn-warning btn-sm">Upload Bukti Bayar</a>
													<?php } else { ?>
														<?php if ($s->su_status == "Lunas") { ?>
														<?php } else { ?>
															<?php if ($s->su_status == "Tolak" || $s->su_status == "Validasi Pembayaran") { ?>
																<a href="<?php echo base_url('seminar/buktibayarumum/' . $s->smr_id); ?>" class="btn btn-warning btn-sm">Upload Ulang Bukti Bayar</a>
													<?php }
														}
													} ?>

													<!-- ROP -->
													<?php if ($s->su_totalbayar != NULL && $s->su_status == 'Lunas') { ?>
														<form action="<?php echo base_url('akun_umum/cetak_strukseminar') ?>" method="POST" target="_BLANK">

															<input type="hidden" name="emailpeserta" value="<?php echo $s->su_peserta ?>">
															<input type="hidden" name="seminarumum" value="<?php echo $s->smr_id ?>">

															<button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-print"></i> Cetak Struk Bayar</button>
														</form>
													<?php } ?>
												</td>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
							</div>
						</div>

						<div class="text-center mt-5">

							<a href="<?php echo base_url() ?>akun_umum/ganti_password" class="btn btn-warning"><i class="fas fa-lock"></i> Ubah Password ?</a>

							<a href="<?php echo base_url() ?>logout" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>


						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

</section>