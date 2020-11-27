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
                 <form action="<?php echo base_url('model_sertifikat/simpan_perubahan'); ?>" method="post" enctype="multipart/form-data">

                   <input type="hidden" name="model_id" value="<?php echo $list->ms_id ?>">
                   <div class="form-group">
                     <label>Nama Model Sertifikat</label>
                     <input type="text" class="form-control" name="nama_model" value="<?php echo $list->ms_model ?>">
                     <?php echo form_error('nama_model') ?>
                   </div>

                   <div class="form-group">
                     <label>Gambar <br>
                       <p class="text-danger">(Mohon Upload Gambar dengan tipe file .jpg, .jpeg, atau .png.</p>
                     </label>
                     <br>
                     <img width="30%" src="<?php echo base_url('assets/template_sertifikat/' . $list->ms_sertifikat); ?>" alt="">
                     <br>
                     <br>
                     <small class="text-danger">Gambar Sebelumnya</small>
                     <br>
                     <br>
                     <input type="file" class="form-control" name="gambar" value="<?php echo set_value('gambar') ?>">
                     <input type="hidden" name="gambar_old" value="<?php echo $list->ms_sertifikat ?>">
                     <?php echo form_error('gambar') ?>
                   </div>

                   <div class="form-group">
                     <label>Bentuk Sertifikat</label>
                      <select class="form-control" name="bentuk_sertifikat">
                        <option value="landscape" <?php if($list->ms_bentuk_sertifikat == 'landscape') { echo 'selected'; } ?>>Landscape</option>
                        <option value="portrait" <?php if($list->ms_bentuk_sertifikat == 'portrait') { echo 'selected'; } ?>>Portrait</option>
                      </select>
                     <?php echo form_error('bentuk_sertifikat') ?>
                   </div>


                   <button class="btn btn-success" type="submit">Ubah</button>
                   <a href="<?php echo base_url('model_sertifikat') ?>" class="btn btn-secondary">Kembali</a>
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