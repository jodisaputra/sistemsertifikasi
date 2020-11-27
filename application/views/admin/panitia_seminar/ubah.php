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
               <form action="<?php echo base_url('panitiaseminar/simpan_perubahan'); ?>" method="post" enctype="multipart/form-data">

                <input type="hidden" name="panitia_id" value="<?php echo $list->pan_id ?>">
                <input type="hidden" name="seminar" value="<?php echo $list->pan_seminar ?>">

                <div class="form-group">
                 <label>Nama Panitia *</label>
                 <input type="text" class="form-control" name="nama_panitia" value="<?php echo $list->pan_nama ?>">
                 <?php echo form_error('nama_panitia') ?>
               </div>

               <div class="form-group">
                 <label>Email Panitia *</label>
                 <input type="text" class="form-control" name="email_panitia" value="<?php echo $list->pan_email ?>">
                 <?php echo form_error('email_panitia') ?>
               </div>

               <button class="btn btn-success" type="submit">Ubah</button>
               <a href="<?php echo base_url('panitiaseminar/list_panitia/' . $seminarid) ?>" class="btn btn-danger">Kembali</a>
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