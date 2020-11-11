<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Sertifikasi | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Sweetalert -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/sweetalert/sweetalert2.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href=""><b>Sistem Sertifikasi</b></a>
    </div>
    <!-- /.login-logo -->

    <div class="text-center">
      <img src="<?php echo base_url() ?>assets/img/logo.png" class="w-50 pb-2">
    </div>


    <div class="card">
      <div class="card-body login-card-body">

        <form action="<?php echo base_url() ?>auth/login" method="post">

          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username" name="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Log In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?php echo base_url() ?>assets/backend/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url() ?>assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() ?>assets/backend/dist/js/adminlte.min.js"></script>
  <!-- Sweetalert -->
  <script type="text/javascript" src="<?php echo base_url() ?>assets/sweetalert/sweetalert2.all.min.js"></script>

  <script>
    <?php
    // Validasi error, jika username atau password tidak cocok
    if (validation_errors() || $this->session->flashdata('message')) {
      if ($this->session->flashdata('tipe') == 'success') {
    ?>

        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 2800,
          timerProgressBar: true,
        })

        Toast.fire({
          icon: "<?php echo $this->session->flashdata('tipe'); ?>",
          title: "<?php echo $this->session->flashdata('message'); ?>"
        })
      <?php
      } else {
      ?>
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 2800,
          timerProgressBar: true,
        })

        Toast.fire({
          icon: "<?php echo $this->session->flashdata('tipe'); ?>",
          title: 'Oops...',
          title: "<?php echo $this->session->flashdata('message'); ?>"
        })

    <?php
      }
    }
    ?>
  </script>

</body>

</html>