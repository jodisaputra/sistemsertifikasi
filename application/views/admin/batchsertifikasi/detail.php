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

                 <div class="form-group">
                   <label>Nama Sub Sertifikasi *</label>
                   <input type="text" class="form-control" value="<?php echo $batch->scert_subsertifikasi ?>" readonly>

                 </div>

                 <div class="form-group">
                   <label>Tanggal Daftar *</label>
                   <input type="text" class="form-control" value="<?php echo date('d M Y', strtotime($batch->bs_mulai_daftar)) ?>" readonly>
                 </div>

                 <div class="form-group">
                   <label>Tanggal Terakhir Daftar *</label>
                   <input type="text" class="form-control" value="<?php echo date('d M Y', strtotime($batch->bs_terakhir_daftar)) ?>" readonly>
                 </div>

                 <div class="form-group">
                   <label>Biaya Mahasiswa *</label>
                   <input type="text" class="form-control" value="<?php echo 'Rp. ' . number_format($batch->bs_biaya_mhs, '0', ',', '.') ?>" readonly>
                 </div>

                 <div class="form-group">
                   <label>Biaya Umum *</label>
                   <input type="text" class="form-control" value="<?php echo 'Rp. ' . number_format($batch->bs_biaya_umum, '0', ',', '.') ?>" readonly>
                 </div>

                 <div class="form-group">
                   <label>Jumlah Max Peserta *</label>
                   <input type="text" class="form-control" value="<?php echo $batch->bs_jumlahmax . ' Orang' ?>" readonly>
                 </div>

                 <div class="form-group">
                   <label>Banner *</label>
                   <br>
                   <img width="20%" src="<?php echo base_url('assets/banner_batchsertifikasi/' . $batch->bs_banner); ?>">
                 </div>

                 <div class="form-group">
                   <label>Keterangan *</label>
                   <?php echo $batch->bs_keterangan; ?>
                 </div>
                 <a href="<?php echo base_url('batch_sertifikasi') ?>" class="btn btn-danger">Kembali</a>
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