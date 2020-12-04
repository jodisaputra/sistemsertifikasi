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
               <div class="card-body">

                 <div class="row">
                   <div class="col-4">
                     <div class="form-group">
                       <label>Nama Sub Sertifikasi </label>
                       <input type="text" class="form-control" value="<?php echo $batch->scert_subsertifikasi ?>" readonly>

                     </div>
                   </div>

                   <div class="col-4">
                     <div class="form-group">
                       <label>Tanggal Daftar </label>
                       <input type="text" class="form-control" value="<?php echo tgl_indo($batch->bs_mulai_daftar) ?>" readonly>
                     </div>
                   </div>

                   <div class="col-4">
                     <div class="form-group">
                       <label>Tanggal Terakhir Daftar </label>
                       <input type="text" class="form-control" value="<?php echo tgl_indo($batch->bs_terakhir_daftar) ?>" readonly>
                     </div>
                   </div>


                   <div class="col-4">
                     <div class="form-group">
                       <label>Biaya Mahasiswa </label>
                       <input type="text" class="form-control" value="<?php echo 'Rp. ' . number_format($batch->bs_biaya_mhs, '0', ',', '.') ?>" readonly>
                     </div>
                   </div>


                   <div class="col-4">
                     <div class="form-group">
                       <label>Biaya Umum </label>
                       <input type="text" class="form-control" value="<?php echo 'Rp. ' . number_format($batch->bs_biaya_umum, '0', ',', '.') ?>" readonly>
                     </div>
                   </div>

                   <div class="col-4">
                     <div class="form-group">
                       <label>Jumlah Max Peserta </label>
                       <input type="text" class="form-control" value="<?php echo $batch->bs_jumlahmax . ' Orang' ?>" readonly>
                     </div>
                   </div>
                   <div class="col-12">
                     <div class="form-group">
                       <label>Banner</label>
                       <br>
                       <img width="20%" src="<?php echo base_url('assets/banner_batchsertifikasi/' . $batch->bs_banner); ?>">
                     </div>
                     <hr>
                   </div>

                   <div class="col-12">
                     <div class="form-group">
                       <label>Keterangan</label>
                       <?php echo $batch->bs_keterangan; ?>
                     </div>
                   </div>

                   <div class="col-12 mb-5">
                     <h1 class="text-center">Jadwal Ujian</h1>
                   </div>

                   <div class="col-4">
                     <div class="form-group">
                       <label>Tanggal Pelaksanaan *</label>
                       <input type="date" class="form-control" name="tanggal_pelaksanaan" value="<?php echo $jadwal->js_tanggal ?>" readonly>
                     </div>
                   </div>

                   <div class="col-4">
                     <div class="form-group">
                       <label>Jam Mulai *</label>
                       <input type="time" class="form-control" name="jam_mulai" value="<?php echo $jadwal->js_mulai ?>" readonly>
                     </div>
                   </div>

                   <div class="col-4">
                     <div class="form-group">
                       <label>Jam Selesai *</label>
                       <input type="time" class="form-control" name="jam_selesai" value="<?php echo $jadwal->js_selesai ?>" readonly>
                     </div>
                   </div>

                   <div class="col-6">
                     <div class="form-group">
                       <label>Tempat</label>
                       <input type="text" class="form-control" name="tempat" value="<?php echo $jadwal->js_tempat ?>" readonly>
                     </div>
                   </div>

                   <div class="col-6">
                     <div class="form-group">
                       <label>Link</label>
                       <input type="text" class="form-control" name="link" value="<?php echo $jadwal->js_link ?>" readonly>
                     </div>
                   </div>

                   <div class="col-12">
                     <a href="<?php echo base_url('batch_sertifikasi') ?>" class="btn btn-danger">Kembali</a>
                   </div>
                 </div>

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