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
               <form action="<?php echo base_url('narasumberseminar/simpan_perubahan'); ?>" method="post" enctype="multipart/form-data">

              <input type="hidden" name="seminar" value="<?php echo $list->ns_seminar ?>">
              <input type="hidden" name="narasumber_id" value="<?php echo $list->ns_id ?>">

              <div class="form-group">
               <label>Nama Narasumber *</label>
               <input type="text" class="form-control" name="nama_narasumber" value="<?php echo $list->ns_narasumber ?>">
               <?php echo form_error('nama_narasumber') ?>
             </div>

             <div class="form-group">
               <label>Asal Institusi *</label>
               <input type="text" class="form-control" name="asal_institusi" value="<?php echo $list->ns_institusi ?>">
               <?php echo form_error('asal_institusi') ?>
             </div>

             <div class="form-group">
               <label>Sebagai *</label>
               <input type="text" class="form-control" name="sebagai" value="<?php echo $list->ns_sebagai ?>">
               <?php echo form_error('sebagai') ?>
             </div>

             <div class="form-group">
                <label>Set Tanda tangan untuk sertifikat ?</label>
                <br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input ya" type="radio" name="set_ttd" value="y" <?php echo $list->ns_set_tandatangan == 'y' ? "checked='checked'" : null ?>  id="y" onchange="show()">
                  <label class="form-check-label">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input tidak" type="radio" name="set_ttd" value="n" <?php echo $list->ns_set_tandatangan == 'n' ? "checked='checked'" : null ?> id="t" onchange="hide()">
                  <label class="form-check-label">Tidak</label>
                </div>
                <br>
                <?php echo form_error('set_ttd') ?>
              </div>

              <div class="form-group" <?php if($list->ns_set_tandatangan == 'y') { echo 'style="display: block;"'; } elseif($list->ns_set_tandatangan == 'n') { echo 'style="display: none;"'; } else { echo 'style="display: none;"'; } ?> id="tanda_tangan">
                <label>Upload Tanda Tangan</label>
                <br>
                <img width="20%" src="<?php echo base_url('assets/tanda_tangan/' . $list->ns_tandatangan) ?>" alt="">
                <br>
                <br>
                <input type="file" name="gambar" class="form-control">
                <input type="hidden" name="gambar_old" value="<?php echo $list->ns_tandatangan ?>">
                <?php echo form_error('gambar') ?>
              </div>

             <button class="btn btn-success" type="submit">Ubah</button>
             <a href="<?php echo base_url('narasumberseminar/list_narasumber/' . $list->ns_seminar) ?>" class="btn btn-danger">Kembali</a>
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

  <script src="<?php echo base_url() ?>/assets/frontend/js/jquery-1.12.1.min.js"></script>
  <script>
    function show() {
      document.getElementById('tanda_tangan').style.display = "block";
    }

    function hide() {
      document.getElementById('tanda_tangan').style.display = "none";
    }
  </script>