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

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header border-transparent">
                    <h3 class="card-title">List Sertifikasi yang berjalan</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table m-0">
                        <thead>
                          <tr>
                            <th>Nama Sertifikasi</th>
                            <th>Tanggal Mulai Daftar</th>
                            <th>Jumlah Pendaftar</th>
                            <th>Tanggal Pelaksanaan Ujian</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($sertifikasi as $s) : ?>
                            <tr>
                              <td><?php echo $s->scert_subsertifikasi; ?></td>
                              <td><?php echo date('d M y', strtotime($s->bs_mulai_daftar)) ?></td>
                              <td>
                                mahasiswa (<?php echo $totaldaftar ?>) + Umum () = Orang
                              </td>
                              <td><?php echo date('d M y', strtotime($s->js_tanggal)); ?></td>
                              <td>
                                <a href="<?php echo base_url('batch_sertifikasi/detail/' . $s->bs_id) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Detail</a>
                              </td>
                            <?php endforeach; ?>
                            </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.table-responsive -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                  </div>
                  <!-- /.card-footer -->
                </div>
              </div>
            </div>