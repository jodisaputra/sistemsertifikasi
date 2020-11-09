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
								<table id="example" class="table table-striped table-bordered">
									<thead>
										<th>No</th>
										<th>Nama Sertifikasi</th>
										<th>Status Pembayaran</th>
										<th>Keterangan</th>
										<th>Tanggal Batch</th>
										<th>Skor</th>
										<th>Aksi</th>
									</thead>
									<tbody>
										<?php $no = 1;
										foreach ($sertifikasi as $s) :
										?>
											<tr>
												<td><?php echo $no++ ?></td>
												<td><?php echo $s->scert_subsertifikasi ?></td>
												<td>
													<?php if ($s->ssm_status == "Menunggu Pembayaran") { ?>
														<div class="badge badge-warning">Menunggu Pembayaran</div>
													<?php } elseif ($s->ssm_status == "Validasi Pembayaran") { ?>
														<div class="badge badge-info">Validasi Pembayaran</div>
													<?php } elseif ($s->ssm_status == 'Lunas') { ?>
														<div class="badge badge-success">Lunas</div>
													<?php } else { ?>
														<div class="badge badge-danger">Tolak</div>
													<?php } ?>
												</td>
												<td>
													<?php if ($s->ssm_status == "Menunggu Pembayaran") { ?>
														<p style="color: black; font-weight: bold">Belum Melakukan Pembayaran</p>
													<?php } elseif ($s->ssm_status == 'Validasi Pembayaran') { ?>
														<p class="text-info" style="font-weight: bold">Menunggu Validasi Admin</p>
													<?php } elseif ($s->ssm_status == 'Lunas') { ?>
														<p style="color: green; font-weight: bold"><?php echo $s->ssm_keteranganpembayaran; ?></p>
													<?php } elseif ($s->ssm_status == 'Tolak') { ?>
														<p style="color: red; font-weight: bold"><?php echo $s->ssm_keteranganpembayaran; ?></p>
													<?php } ?>
												</td>
												<td><?php echo date('d M Y', strtotime($s->bs_mulai_daftar)) ?></td>
												<td><?php echo $s->ssm_skor ?></td>
												<td>
													<?php if ($s->ssm_status == "Menunggu Pembayaran") { ?>
														<a href="<?php echo base_url('sertifikasi/buktibayarmahasiswa/' . $s->ssm_id . '/' . $s->sm_sertifikasi); ?>" class="btn btn-warning btn-sm">Upload Bukti Bayar</a>
													<?php } else { ?>
														<?php if ($s->ssm_status == "Lunas") { ?>
														<?php } else { ?>
															<?php if ($s->ssm_status == "Tolak" || $s->ssm_status == "Validasi Pembayaran") { ?>
																<a href="<?php echo base_url('sertifikasi/buktibayarmahasiswa/' . $s->ssm_id . '/' . $s->sm_sertifikasi); ?>" class="btn btn-warning btn-sm">Upload Ulang Bukti Bayar</a>
													<?php }
														}
													} ?>

													<!-- ROP -->
													<?php if ($s->ssm_totalbayar != NULL && $s->ssm_status == 'Lunas') { ?>
														<form action="<?php echo base_url('akun_mahasiswa/cetak_struksertifikasi') ?>" method="POST" target="_BLANK">
															<input type="hidden" name="id_ssu" value="<?php echo $s->ssm_id ?>">

															<input type="hidden" name="id_subsertifikasi" value="<?php echo $s->ssm_subsertifikasi ?>">

															<input type="hidden" name="sertifikasi_mahasiswa" value="<?php echo $s->ssm_sertifikasi_mahasiswa ?>">
															<button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-print"></i> Cetak Struk Bayar</button>
														</form>
													<?php } ?>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
								<a href="<?php echo base_url('akun_mahasiswa/akun') ?>" class="btn btn-info btn-sm mt-5">Kembali</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

</section>