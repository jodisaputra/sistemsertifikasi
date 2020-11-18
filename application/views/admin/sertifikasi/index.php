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
                 <a href="<?php echo base_url() ?>sertifikasi/tambah" class="btn btn-success">Tambah Sertifikasi</a>
               </div>
               <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                   <thead>
                     <tr>
                       <th>No</th>
                       <th width="20%">Nama Sertifikasi</th>
                       <th width="20%">Program Studi</th>
                       <th>Status</th>
                       <th width="45%">Aksi</th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php
                      $no = 1;
                      foreach ($sertifikasi as $s) { ?>
                       <tr>
                         <td><?php echo $no++ ?></td>
                         <td><?php echo $s->cert_sertifikasi ?></td>
                         <td>
                           <?php if ($s->cert_prodi == 11) {
                              echo "Teknik Sipil";
                            } elseif ($s->cert_prodi == 12) {
                              echo "Arsitektur";
                            } elseif ($s->cert_prodi == 21) {
                              echo "Teknik Elektro";
                            } elseif ($s->cert_prodi == 31) {
                              echo "Sistem Informasi";
                            } elseif ($s->cert_prodi == 32) {
                              echo "Teknologi Informasi";
                            } elseif ($s->cert_prodi == 41) {
                              echo "Manajemen";
                            } elseif ($s->cert_prodi == 42) {
                              echo "Akutansi";
                            } elseif ($s->cert_prodi == 53) {
                              echo "Magister Manajemen";
                            } elseif ($s->cert_prodi == 55) {
                              echo "Pariwisata";
                            } elseif ($s->cert_prodi == 51) {
                              echo "Ilmu Hukum";
                            } elseif ($s->cert_prodi == 52) {
                              echo "MAgister Hukum";
                            } elseif ($s->cert_prodi == 56) {
                              echo "Pendidikan Bahasa Inggris";
                            } ?>
                         </td>
                         <td>
                           <?php if ($s->cert_isaktif == "y") { ?>
                             <div class="badge badge-success">Aktif</div>
                           <?php } else { ?>
                             <div class="badge badge-danger">Tidak Aktif</div>
                           <?php } ?>
                         </td>
                         <td class="text-center">

                           <a title="Edit Sertifikasi" href="<?php echo base_url('sertifikasi/ubah/' . $s->cert_id) ?>" class="btn btn-warning btn-sm mb-3"><i class="fas fa-edit"></i>&nbsp; Ubah</a>

                           <a title="Hapus Sertifikasi" href="<?php echo base_url('sertifikasi/delete/' . $s->cert_id) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus Sertifikasi ini?')" class="btn btn-danger btn-sm mb-3"><i class="fas fa-trash"></i>&nbsp; Hapus</a>

                           <a title="Daftar Subsertifikasi" href="<?php echo base_url('subsertifikasi/index/' . $s->cert_id) ?>" class="btn btn-info btn-sm mb-3"><i class="fas fa-certificate"></i>&nbsp; Sub-Sertifikasi</a>

                           <a title="Input Nilai Terakhir dan Sertifikat Peserta Umum" href="<?php echo base_url('input_nilai_sertifikasi_final/nilai_umum_final/' . $s->cert_id) ?>" class="btn btn-primary btn-sm mb-3"><i class="fas fa-sort-numeric-up-alt"></i>&nbsp; Input Nilai Terakhir Umum</a>

                           <a title="Input Nilai Terakhir dan Sertifikat Mahasiswa" href="<?php echo base_url('input_nilai_sertifikasi_final/nilai_mahasiswa_final/' . $s->cert_id) ?>" class="btn btn-primary btn-sm mb-3"><i class="fas fa-sort-numeric-up-alt"></i>&nbsp; Input Nilai Terakhir Mahasiswa</a>
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