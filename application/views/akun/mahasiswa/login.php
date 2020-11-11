<section class="section-gap-top section-gap-bottom">

	<div class="container">

		<div class="row justify-content-center">

			<div class="col-6 align-center">
				<h2 class="text-center mb-5">Masuk Mahasiswa</h2>

				<form action="<?php echo base_url('akun_mahasiswa/login') ?>" method="post">

					<div class="mt-10">
						<input type="text" name="username" placeholder="NPM" class="single-input" value="<?php echo set_value('username') ?>">
					</div>

					<div class="mt-10">
						<input type="password" name="password" placeholder="Password" class="single-input">
					</div>

					<button type="submit" class="btn btn-primary mt-5 btn-block">Masuk</button>

					<div class="mt-5">
						<p class="text-danger">Catatan : Untuk Mahasiswa masuk menggunakan Akun Portal Masing-masing</p>
					</div>

				</form>

			</div>
		</div>
	</div>

</section>