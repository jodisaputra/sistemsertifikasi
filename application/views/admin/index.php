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
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                  <div class="inner">
                    <h3><?php echo $totaldaftar ?></h3>

                    <p>Jumlah Pendaftar <br> Umum</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-users"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?php echo $totalseminar; ?></h3>

                    <p>Jumlah Seminar</p>
                    <br>
                  </div>
                  <div class="icon">
                    <i class="fas fa-calendar-alt"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3><?= $totallulus; ?></h3>

                    <p>Jumlah Mahasiswa <br> Lulus</p>
                  </div>
                  <div class="icon">
                    <i class="far fa-check-square"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3><?= $totaltidaklulus; ?></h3>

                    <p>Jumlah Mahasiswa <br> Tidak Lulus</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-times"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
            </div>