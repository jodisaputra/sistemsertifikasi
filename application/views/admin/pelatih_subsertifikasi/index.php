       <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?php echo $title ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Home</a></li>
            <li class="breadcrumb-item active"><?php echo $title ?></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->

      <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-header">
                <a href="<?php echo base_url() ?>batch_sertifikasi" class="btn btn-danger">Kembali</a>
                <a href="<?php echo base_url() ?>pelatih_subsertifikasi/tambah/<?php echo $batch ?>" class="btn btn-success">Tambah Pelatih</a>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <tr>
                        <th>No</th>
                        <th>Nama Batch Sertifikasi</th>
                        <th>Nama Pelatih</th>
                        <th>Email</th>
                        <th>Institusi</th>
                        <th>Sebagai</th>
                        <th>Aksi</th>
                      </tr>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach($list as $l) { ?>                                 
                      <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $l->scert_subsertifikasi ?></td>
                        <td><?php echo $l->ps_nama ?></td>
                        <td><?php echo $l->ps_email ?></td>
                        <td><?php echo $l->ps_institusi ?></td>
                        <td><?php echo $l->ps_sebagai ?></td>
                        <td>
                          
                          <a href="<?php echo base_url('pelatih_subsertifikasi/ubah/'.$l->ps_batch .'/' . $l->ps_email) ?>" class="btn btn-warning">Edit</a>

                          <a href="<?php echo base_url('pelatih_subsertifikasi/delete/'.$l->ps_batch .'/' . $l->ps_email) ?>"  onclick="return confirm('Apakah anda yakin ingin menghapus Pelatih ini?')" class="btn btn-danger">Hapus</a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
  <!-- /.content -->