<section class="section-gap-top section-gap-bottom">

	<div class="container">

		<div class="row justify-content-center">

			<div class="col-6 align-center">
				<h2 class="text-center mb-5">Daftar Akun</h2>

				<form action="<?php echo base_url() ?>akun_umum/register_member" method="post">

					<div class="mt-10">
						<label class="pb-2">Nama Lengkap</label>
						<input type="text" class="single-input" name="nama_lengkap" value="<?php echo set_value('nama_lengkap') ?>">
						<?php echo form_error('nama_lengkap') ?>
					</div>

					<div class="mt-10">
						<label class="pb-2">No. KTP</label>
						<input type="text" class="single-input" maxlength="16" name="no_ktp" value="<?php echo set_value('no_ktp') ?>">
						<?php echo form_error('no_ktp') ?>
					</div>

					<div class="mt-10">
						<label class="pb-2">No. Whatsapp</label>
						<input type="text" class="single-input" maxlength="13" name="no_wa" value="<?php echo set_value('no_wa') ?>">
						<?php echo form_error('no_wa') ?>
					</div>

					<div class="mt-10">
						<label class="pb-2">Asal Instansi</label>
						<input type="text" class="single-input" name="asal_instansi" value="<?php echo set_value('asal_instansi') ?>">
						<?php echo form_error('asal_instansi') ?>
					</div>

					<div class="mt-10">
						<label class="pb-2">Email</label>
						<input type="text" class="single-input" name="email" value="<?php echo set_value('email') ?>">
						<?php echo form_error('email') ?>
					</div>

					<div class="mt-10">
						<label class="pb-2">Password</label>
						<input type="password" class="single-input" name="password" value="<?php echo set_value('password') ?>">
						<?php echo form_error('password') ?>
					</div>

					<div class="row">

						<div class="col-8 mt-3">
							Sudah punya akun ? <a href="<?php echo base_url() ?>akun_umum">Masuk Sekarang</a>
						</div>

					</div>

					<button type="submit" class="btn btn-primary mt-3 btn-block">Daftar Sekarang</button>

				</form>

			</div>
		</div>
	</div>

</section>