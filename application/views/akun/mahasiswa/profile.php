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
										<h5>NPM</h5>
									</td>
									<td>
										<h5>:</h5>
									</td>
									<td>
										<h5><?php echo $npm ?></h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Jurusan</h5>
									</td>
									<td>
										<h5>:</h5>
									</td>
									<td>
										<h5><?php echo $jurusan ?></h5>
									</td>
								</tr>
							</table>
						</div>

						<hr class="mt-5 mb-4">
						<h4 class="text-center">Data Sertifikasi</h4>

						<div class="mt-4">
							<div class="table-responsive">
								<table id="example" class="table table-striped table-bordered" style="width:100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Sertifikasi</th>
											<th>Status Sertifikasi</th>
											<th>Grade</th>
											<th>Sertifikat</th>
											<th>Catatan</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1;
										foreach ($cert as $s) :
										?>
											<tr>
												<td><?php echo $no++ ?></td>
												<td><?php echo $s->cert_sertifikasi ?></td>
												<td>
													<?php if ($s->sm_status == "Lulus") { ?>
														<div class="badge badge-success">Lulus</div>
													<?php } elseif ($s->sm_status == "") { ?>
														<div class="badge badge-warning">Belum Mengikuti Sertifikasi</div>
													<?php } else { ?>
														<div class="badge badge-danger">Tidak Lulus</div>
													<?php } ?>
												</td>
												<td><b><?php echo $s->sm_grade ?></b></td>
												<td>
													<?php if ($s->sm_sertifikat == NULL) { ?>
														<div class="badge badge-warning">Sertifikat Belum Ada</div>
													<?php } else { ?>
														<a href="<?php echo base_url('assets/sertifikat_mahasiswa/' . $s->sm_sertifikat) ?>" class="btn btn-warning btn-sm" target="_blank">Lihat Sertifikat</a>
													<?php } ?>
												</td>
												<td><?php echo $s->sm_catatan ?></td>
												<td>
													<a href="<?php echo base_url('akun_mahasiswa/detailsertifikasi/' . $s->sm_sertifikasi); ?>" class="btn btn-info btn-sm">Detail</a>
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
								<table id="example2" class="table table-striped table-bordered" style="width:100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Seminar</th>
											<th>Status Pembayaran</th>
											<th>Keterangan</th>
											<th>Sertifikat</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1; ?>
										<?php foreach ($seminar as $s) : ?>
											<tr>
												<td><?php echo $no++ ?></td>
												<td><?php echo $s->smr_acara ?></td>
												<td>
													<?php if ($s->smhs_status == "Menunggu Pembayaran") { ?>
														<div class="badge badge-warning">Menunggu Pembayaran</div>
													<?php } elseif ($s->smhs_status == "Validasi Pembayaran") { ?>
														<div class="badge badge-info">Validasi Pembayaran</div>
													<?php } elseif ($s->smhs_status == "Lunas") { ?>
														<div class="badge badge-success">Lunas</div>
													<?php } elseif ($s->smhs_status == "Tolak") { ?>
														<div class="badge badge-danger">Tolak</div>
													<?php } ?>
												</td>
												<td>
													<?php if ($s->smhs_status == "Menunggu Pembayaran") { ?>
														<p style="color: black; font-weight: bold">Belum Melakukan Pembayaran</p>
													<?php } elseif ($s->smhs_status == 'Validasi Pembayaran') { ?>
														<p class="text-info" style="font-weight: bold">Menunggu Validasi Admin</p>
													<?php } elseif ($s->smhs_status == 'Lunas') { ?>
														<p style="color: green; font-weight: bold"><?php echo $s->smhs_keteranganpembayaran; ?></p>
													<?php } elseif ($s->smhs_status == 'Tolak') { ?>
														<p style="color: red; font-weight: bold"><?php echo $s->smhs_keteranganpembayaran; ?></p>
													<?php } ?>
												</td>
												<td>
													<?php if ($s->smhs_ishadir == NULL || $s->smhs_ishadir == "n" || $s->smhs_status == "Tolak") { ?>
														<p class="text-danger">Sertifikat Belum Ada</p>
													<?php } else { ?>
														<form method="post" action="<?php echo base_url('akun_mahasiswa/modelsertifikat'); ?>">
															<input type="hidden" name="id_seminar" value="<?php echo $s->smr_id ?>">
															<input type="hidden" name="npm" value="<?php echo $this->session->userdata('npm') ?>">
															<button target="_blank" class="btn btn-warning btn-sm">Lihat Sertifikat</a>
														</form>
													<?php } ?>
												</td>
												<td>
													<?php if ($s->smhs_status == "Menunggu Pembayaran") { ?>
														<a href="<?php echo base_url('seminar/buktibayarmahasiswa/' . $s->smr_id . '/' . $this->session->userdata('npm')); ?>" class="btn btn-warning btn-sm">Upload Bukti Bayar</a>
													<?php } else { ?>
														<?php if ($s->smhs_status == "Lunas") { ?>
														<?php } else { ?>
															<a href="<?php echo base_url('seminar/buktibayarmahasiswa/' . $s->smr_id . '/' . $this->session->userdata('npm')); ?>" class="btn btn-warning btn-sm">Upload Ulang Bukti Bayar</a>
													<?php }
													} ?>

													<!-- ROP -->
													<?php if ($s->smhs_totalbayar != NULL && $s->smhs_status == 'Lunas') { ?>
														<form action="<?php echo base_url('akun_mahasiswa/cetak_strukseminar') ?>" method="POST" target="_BLANK">

															<input type="hidden" name="npm_mhs" value="<?php echo $s->smhs_mahasiswa ?>">

															<input type="hidden" name="seminar" value="<?php echo $s->smhs_seminar ?>">
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

							<a href="<?php echo base_url() ?>logout" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>

						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

</section>