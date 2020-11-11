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
                 <a href="<?php echo base_url() ?>batch_sertifikasi/tambah" class="btn btn-success">Tambah Batch Sertifikasi</a>
               </div>
               <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                   <thead>
                     <tr>
                       <th>No</th>
                       <th width="27%">Nama Sub Sertifikasi</th>
                       <th width="15%">Mulai Daftar</th>
                       <th width="15%">Akhir Daftar</th>
                       <th>Jumlah Max</th>
                       <th>Aksi</th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php
                      $no = 1;
                      foreach ($batch as $b) { ?>
                       <tr>
                         <td><?php echo $no++ ?></td>
                         <td><?php echo $b->scert_subsertifikasi ?></td>
                         <td><?php echo date('d M Y', strtotime($b->bs_mulai_daftar)) ?></td>
                         <td><?php echo date('d M Y', strtotime($b->bs_terakhir_daftar)) ?></td>
                         <td><?php echo $b->bs_jumlahmax ?></td>
                         <td>

                           <a href="<?php echo base_url('batch_sertifikasi/detail/' . $b->bs_id) ?>" title="Detail Batch Sertifikasi" class="btn btn-info mb-1"><i class="fas fa-eye"></i> &nbsp;Detail Batch</a>

                           <a href="<?php echo base_url('batch_sertifikasi/ubah/' . $b->bs_id) ?>" title="Ubah Batch Sertifikasi" class="btn btn-warning mb-1"><i class="fas fa-edit"></i> &nbsp;Ubah Batch</a>

                           <a href="<?php echo base_url('batch_sertifikasi/delete/' . $b->bs_id) ?>" title="Hapus Batch Sertifikasi" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger mb-1"><i class="fas fa-trash"></i> &nbsp; Hapus</a>

                           <a title="Tambah Pelatih Sertifikasi" href="<?php echo base_url('pelatih_subsertifikasi/list_pelatih/' . $b->bs_id) ?>" class="btn btn-secondary mb-1"><i class="fas fa-plus"></i> &nbsp;Pelatih</a>

                           <a title="Input Nilai Peserta Umum" href="<?php echo base_url('input_nilai_sertifikasi/nilai_umum/' . $b->bs_id) ?>" class="btn btn-info mb-1"><i class="fas fa-sort-numeric-up-alt"></i> &nbsp;Nilai Umum</a>

                           <a title="Input Nilai Mahasiswa" href="<?php echo base_url('input_nilai_sertifikasi/nilai_mahasiswa/' . $b->bs_id) ?>" class="btn btn-info mb-1"><i class="fas fa-sort-numeric-up-alt"></i> &nbsp;Nilai Mahasiswa</a>

                           <a title="Lihat Pertemuan" href="<?php echo base_url('Absen_sertifikasi/absen_pertemuan/' . $b->bs_id) ?>" class="btn btn-warning mb-1"><i class="fas fa-list-alt"></i> &nbsp; Lihat Pertemuan</a>

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