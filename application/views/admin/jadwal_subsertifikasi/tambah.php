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
                 <form action="<?php echo base_url('jadwal_subsertifikasi/simpan'); ?>" method="post">

                   <div class="form-group">
                     <label>Batch Sertifikasi *</label>
                     <select name="batch_sertifikasi" class="form-control">
                       <option value="">Pilih Salah Satu</option>
                       <?php foreach ($batch as $b) { ?>
                         <option value="<?php echo $b->bs_id ?>" <?php echo set_value('batch_sertifikasi') == $b->bs_id ? "selected" : null ?>><?php echo $b->scert_subsertifikasi ?></option>
                       <?php } ?>
                     </select>
                     <?php echo form_error('batch_sertifikasi') ?>
                   </div>

                   <div class="form-group">
                     <label>Tanggal Pelaksanaan *</label>
                     <input type="date" class="form-control" name="tanggal_pelaksanaan" value="<?php echo set_value('tanggal_pelaksanaan') ?>">
                     <?php echo form_error('tanggal_pelaksanaan') ?>
                   </div>

                   <div class="form-group">
                     <label>Jam Mulai *</label>
                     <input type="time" class="form-control" name="jam_mulai" value="<?php echo set_value('jam_mulai') ?>">
                     <?php echo form_error('jam_mulai') ?>
                   </div>

                   <div class="form-group">
                     <label>Jam Selesai *</label>
                     <input type="time" class="form-control" name="jam_selesai" value="<?php echo set_value('jam_selesai') ?>">
                     <?php echo form_error('jam_selesai') ?>
                   </div>

                   <div class="form-group">
                     <label>Tempat</label>
                     <input type="text" class="form-control" name="tempat" value="<?php echo set_value('tempat') ?>">
                   </div>

                   <div class="form-group">
                     <label>Link</label>
                     <input type="text" class="form-control" name="link" value="<?php echo set_value('link') ?>">
                   </div>

                   <button class="btn btn-success" type="submit">Tambah</button>
                   <a href="<?php echo base_url('jadwal_subsertifikasi') ?>" class="btn btn-secondary">Kembali</a>
                 </form>
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