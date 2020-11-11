        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $title ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        </div>
        </div>

        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">

            <div class="row">
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                  <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Jumlah Pendaftar</span>
                    <span class="info-box-number">
                      <?php echo $totaldaftar ?>
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-calendar-alt"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Jumlah Seminar</span>
                    <span class="info-box-number"><?php echo $totalseminar ?></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->

              <!-- fix for small devices only -->
              <div class="clearfix hidden-md-up"></div>

              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Jumlah Mahasiswa Lulus</span>
                    <span class="info-box-number"><?php echo $totallulus ?></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-times"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Jumlah Mahasiswa<br> Belum Lulus</span>
                    <span class="info-box-number"><?php echo $totaltidaklulus ?></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- <div class="row">
              <div class="col-md-6">
                <div class="card card-default">
                  <div class="card-header">
                    <h3 class="card-title">
                      <i class="fas fa-bullhorn"></i>
                      Informasi Cara Membuat Pendaftaran Sertifikasi
                    </h3>
                  </div> -->
            <!-- /.card-header -->
            <!-- <div class="card-body">
                    <div class="callout callout-info">
                      <h5>I am a danger callout!</h5>

                      <p>There is a problem that we need to fix. A wonderful serenity has taken possession of my entire
                        soul,
                        like these sweet mornings of spring which I enjoy with my whole heart.</p>
                    </div>
                  </div> -->
            <!-- /.card-body -->
            <!-- </div> -->
            <!-- /.card -->
            <!-- </div>
              <div class="col-md-6">
                <div class="card card-default">
                  <div class="card-header">
                    <h3 class="card-title">
                      <i class="fas fa-bullhorn"></i>
                      Informasi Cara Membuat Pendaftaran Seminar
                    </h3>
                  </div> -->
            <!-- /.card-header -->
            <!-- <div class="card-body">
                    <div class="callout callout-info">
                      <h5>I am a danger callout!</h5>

                      <p>There is a problem that we need to fix. A wonderful serenity has taken possession of my entire
                        soul,
                        like these sweet mornings of spring which I enjoy with my whole heart.</p>
                    </div>
                  </div> -->
            <!-- /.card-body -->
            <!-- </div> -->
            <!-- /.card -->
            <!-- </div> -->
            <!-- </div> -->