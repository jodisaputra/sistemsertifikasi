<section class="section-gap-top section-gap-bottom">

	<div class="container">

		<div class="row justify-content-center">

			<div class="col-6 align-center">
				<h2 class="text-center mb-5">Masuk Umum</h2>

				<form action="<?php echo base_url() ?>akun_umum/login" method="post">

					<div class="mt-10">
						<input type="text" name="email" placeholder="Email" class="single-input">
					</div>

					<div class="mt-10">
						<input type="password" name="password" placeholder="Password" class="single-input">
					</div>

					<div class="row mt-3 mb-3">

						<div class="col-6 mt-3">
							Belum punya akun? <a href="<?php echo base_url() ?>akun_umum/register">Daftar disini</a>
						</div>

						<div class="col-6 mt-3 text-right">
							<a href="<?php echo base_url() ?>akun_umum/lupa_password">Lupa Password</a>
						</div>

					</div>

					<button type="submit" class="btn btn-primary mt-3 btn-block">Masuk</button>

				</form>

			</div>
		</div>
	</div>

</section>