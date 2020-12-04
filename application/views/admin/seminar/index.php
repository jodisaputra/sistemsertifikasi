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
                       <th width="50%">Aksi</th>
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
                         <td>

                           <a title="Ubah Seminar" href="<?php echo base_url('seminar/detail/' . $s->smr_id) ?>" class="btn btn-info btn-sm mb-4"><i class="fas fa-eye"></i>&nbsp; Detail</a>

                           <a title="Ubah Seminar" href="<?php echo base_url('seminar/ubah/' . $s->smr_id) ?>" class="btn btn-warning btn-sm mb-4"><i class="fas fa-edit"></i>&nbsp; Ubah</a>

                           <a title="Hapus Seminar" href="<?php echo base_url('seminar/delete/' . $s->smr_id) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger mb-4 btn-sm"><i class="fas fa-trash"></i>&nbsp; Hapus</a>

                           <a title="Input Narasumber Seminar" href="<?php echo base_url('narasumberseminar/list_narasumber/' . $s->smr_id); ?>" class="btn btn-success btn-sm mb-4"><i class="fas fa-user"></i>&nbsp; Narasumber</a>

                           <a title="Input Panitia Seminar" href="<?php echo base_url('panitiaseminar/list_panitia/' . $s->smr_id); ?>" class="btn btn-success btn-sm mb-4"><i class="fas fa-users"></i>&nbsp; Panitia</a>

                           <a title="Absensi Mahasiswa" href="<?php echo base_url('absen_seminar/absen_mahasiswa/' . $s->smr_id); ?>" class="btn btn-primary btn-sm mb-4"><i class="fas fa-file-alt"></i>&nbsp; Absen Mahasiswa</a>

                           <a title="Absen Umum" href="<?php echo base_url('absen_seminar/absen_umum/' . $s->smr_id); ?>" class="btn btn-primary btn-sm mb-4"><i class="fas fa-file-alt"></i>&nbsp; Absen Umum</a>

                           <a title="Cetak Sertifikat Seminar Mahasiswa" href="<?php echo base_url('seminar/listpesertamhs/' . $s->smr_id); ?>" class="btn btn-info btn-sm mb-4"><i class="fa fa-print"></i>&nbsp; Cetak Sertifikat Mahasiswa</a>

                           <a title="Cetak Sertifikat Seminar Peserta Umum" href="<?php echo base_url('seminar/listpesertaumum/' . $s->smr_id); ?>" class="btn btn-info btn-sm mb-4"><i class="fa fa-print"></i>&nbsp; Cetak Sertifikat Umum</a>
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