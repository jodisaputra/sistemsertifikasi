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
                <a href="<?php echo base_url() ?>seminar/tambah" class="btn btn-success">Tambah Seminar</a>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Seminar</th>
                      <th>Tempat</th>
                      <th>Tanggal Seminar</th>
                      <th>Nama Moderator</th>
                      <th>Jam Mulai</th>
                      <th width="40%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($seminar as $s) { ?>
                     <tr>
                       <td><?php echo $no++ ?></td>
                       <td><?php echo $s->smr_acara ?></td>
                       <td><?php echo $s->smr_tempat ?></td>
                       <td><?php echo $s->smr_tanggal ?></td>
                       <td><?php echo $s->smr_moderator ?></td>
                       <td><?php echo $s->smr_jam_mulai ?></td>
                       <td class="text-center">
                         <a href="<?php echo base_url('seminar/ubah/' . $s->smr_id) ?>" class="btn btn-warning btn-sm">Ubah</a>

                         <a href="<?php echo base_url('seminar/delete/' . $s->smr_id) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus</a>
                         
                         <a href="<?php echo base_url('narasumberseminar/list_narasumber/' . $s->smr_id); ?>" class="btn btn-secondary btn-sm btn-block mt-2">Input Narasumber</a>

                         <a href="<?php echo base_url('absen_seminar/absen_mahasiswa/' . $s->smr_id); ?>" class="btn btn-primary btn-sm btn-block mt-2">Absen Mahasiswa</a>
                         
                         <a href="<?php echo base_url('absen_seminar/absen_umum/' . $s->smr_id); ?>" class="btn btn-primary btn-sm btn-block mt-2">Absen Umum</a>
                         
                         <a href="<?php echo base_url('seminar/listpesertamhs/' . $s->smr_id); ?>" class="btn btn-info mt-2 btn-block btn-sm"><i class="fa fa-print"></i>&nbsp;&nbsp; Cetak Sertifikat Seminar Mahasiswa</a>
                         
                         <a href="<?php echo base_url('seminar/listpesertaumum/' . $s->smr_id ); ?>" class="btn btn-info mt-2 btn-block btn-sm"><i class="fa fa-print"></i>&nbsp;&nbsp; Cetak Sertifikat Seminar Umum</a>
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