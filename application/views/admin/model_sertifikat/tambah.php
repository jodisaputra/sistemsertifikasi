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
                 <form action="<?php echo base_url('model_sertifikat/simpan'); ?>" method="post" enctype="multipart/form-data">

                   <div class="form-group">
                     <label>Nama Model Sertifikat</label>
                     <input type="text" class="form-control" name="nama_model" value="<?php echo set_value('nama_model') ?>">
                     <?php echo form_error('nama_model') ?>
                   </div>

                   <div class="form-group">
                     <label>Gambar <br>
                       <p class="text-danger">(Mohon Upload Gambar dengan tipe file .jpg, .jpeg, atau .png Ukuran 84 x 60 cm. Bila gambar melebihi ukuran tersebut mohon diedit agar tidak terjadi kesalahan saat mencetak sertifikat)</p>
                       <a href="<?php echo base_url('assets/contohsertifikat.png'); ?>" target="_BLANK">Contoh Model Sertifikat</a>
                     </label>
                     <input type="file" class="form-control" name="gambar" value="<?php echo set_value('gambar') ?>">
                     <?php echo form_error('gambar') ?>
                   </div>

                   <button class="btn btn-success" type="submit">Tambah</button>
                   <a href="<?php echo base_url('model_sertifikat') ?>" class="btn btn-danger">Kembali</a>
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