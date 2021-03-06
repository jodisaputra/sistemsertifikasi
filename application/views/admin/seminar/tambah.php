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
                 <form action="<?php echo base_url('seminar/simpan'); ?>" method="post" enctype="multipart/form-data">

                   <div class="form-group">
                     <label>Nama Seminar *</label>
                     <input type="text" class="form-control" name="nama_seminar" value="<?php echo set_value('nama_seminar') ?>">
                     <?php echo form_error('nama_seminar') ?>
                   </div>

                   <div class="form-group">
                     <label>Tanggal Pelaksanaan *</label>
                     <input type="date" class="form-control" name="tanggal_pelaksanaan" value="<?php echo set_value('tanggal_pelaksanaan') ?>">
                     <?php echo form_error('tanggal_pelaksanaan') ?>
                   </div>

                   <div class="form-group">
                     <label>Tempat Pelaksanaan *</label>
                     <input type="text" class="form-control" name="tempat_pelaksanaan" value="<?php echo set_value('tempat_pelaksanaan') ?>">
                     <?php echo form_error('tempat_pelaksanaan') ?>
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
                     <label>Nama Moderator *</label>
                     <input type="text" class="form-control" name="nama_moderator" value="<?php echo set_value('nama_moderator') ?>">
                     <?php echo form_error('nama_moderator') ?>
                   </div>
                  

                   <div class="col-12">
                        <div class="form-group">
                          <label>Status Seminar *</label>
                          <br>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input gratis" type="radio" name="status_seminar" value="gratis" <?php echo set_value('status_seminar') == 'gratis' ? "checked='checked'" : null ?>  id="gratis" onchange="biaya_gratis()">
                            <label class="form-check-label">Gratis</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input bayar" type="radio" name="status_seminar" value="bayar" <?php echo set_value('status_seminar') == 'bayar' ? "checked='checked'" : null ?> id="bayar" onchange="biaya_bayar()">
                            <label class="form-check-label">Bayar</label>
                          </div>
                          <br>
                          <?php echo form_error('status_seminar') ?>
                        </div>
                     </div>
        
                     <div class="col-6" id="mhs" <?php if($this->input->post('status_bayar') == 'bayar') { echo 'style="display: inline;"'; } else { echo 'style="display: none;"'; } ?> >
                       <div class="form-group">
                         <label>Biaya Mahasiswa *</label>
                         <input type="text" class="form-control uang" name="biaya_mhs" value="<?php echo set_value('biaya_mhs') ?>">
                         <?php echo form_error('biaya_mhs') ?>
                       </div>
                     </div>

                     <div class="col-6" id="umum" <?php if($this->input->post('status_bayar') == 'bayar') { echo 'style="display: inline;"'; } else { echo 'style="display: none;"'; } ?>>
                       <div class="form-group">
                         <label>Biaya Umum *</label>
                         <input type="text" class="form-control uang" name="biaya_umum" value="<?php echo set_value('biaya_umum') ?>">
                         <?php echo form_error('biaya_umum') ?>
                       </div>
                     </div>

                   <div class="form-group">
                     <label>Link Online</label>
                     <input type="text" class="form-control" name="link" value="<?php echo set_value('link') ?>">
                   </div>

                   <div class="form-group">
                     <label>Jumlah Max Peserta *</label>
                     <input type="text" class="form-control" name="jumlah_max_peserta" value="<?php echo set_value('jumlah_max_peserta') ?>">
                     <?php echo form_error('jumlah_max_peserta') ?>
                   </div>

                   <div class="form-group">
                     <label>Banner</label>
                     <p class="text-danger"><b>(Mohon upload gambar dengan ukuran 275 x 183)</p>
                     <input type="file" class="form-control" name="gambar">
                     <?php echo form_error('gambar') ?>
                   </div>

                   <div class="form-group">
                     <label>Keterangan</label>
                     <textarea name="keterangan" id="keterangan" class="form-control cust_sumnote" rows="10" cols="80"><?php echo set_value('keterangan') ?></textarea>
                   </div>

                   <div class="form-group">
                     <label>Model Sertifikat</label>
                     <select name="model_sertifikat" class="form-control">
                       <option value="">Pilih Salah Satu</option>
                       <?php foreach ($model as $m) { ?>
                         <option value="<?php echo $m->ms_id ?>"><?php echo $m->ms_model ?></option>
                       <?php } ?>
                     </select>
                     <?php echo form_error('model_sertifikat') ?>
                   </div>

                   <button class="btn btn-success" type="submit">Tambah</button>
                   <a href="<?php echo base_url('seminar') ?>" class="btn btn-danger">Kembali</a>
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

       <script src="<?php echo base_url() ?>assets/backend/plugins/jquery/jquery.min.js"></script>
       <script src="<?php echo base_url(); ?>assets/js/summernote/summernote-bs4.js"></script>
       <script>
         $(document).ready(function() {
           $('.cust_sumnote').summernote({
             dialogsInBody: true,
             minHeight: 250,
             callbacks: {
               onImageUpload: function(image, editor) {
                 uploadImage(image[0], $(this).attr('id'));
               },
               onMediaDelete: function(target) {
                 // alert(target[0].src) 
                 deleteImage(target[0].src);
               },
               onChange: function(contents) {
                 if ($("#" + $(this).attr('id')).summernote('isEmpty')) {
                   $("#" + $(this).attr('id')).summernote('code', '');
                 } else {
                   $("#" + $(this).attr('id')).val(contents);
                 }
               }
             },
             toolbar: [
               ['style', ['style']],
               ['font', ['bold', 'italic', 'underline', 'clear']],
               ['fontname', ['fontname']],
               ['color', ['color']],
               ['para', ['ul', 'ol', 'paragraph']],
               // ['table', ['table']],
               ['insert', ['link', 'picture']],
               ['view', ['codeview']],
               ['help', ['help']]
             ],
           });
         });

         function uploadImage(image, editor) {
           var data = new FormData();
           data.append("image", image);
           $.ajax({
             url: "<?php echo base_url('seminar/imageUpload') ?>",
             cache: false,
             contentType: false,
             processData: false,
             data: data,
             type: "POST",
             success: function(url) {
               $("#" + editor).summernote("insertImage", url);
             },
             error: function(data) {
               console.log(data);
             }
           });
         }

         function deleteImage(src) {
           $.ajax({
             data: {
               src: src
             },
             type: "POST",
             url: "<?php echo base_url('seminar/deleteImage') ?>",
             cache: false,
             success: function(response) {
               console.log(response);
             }
           });
         }
       </script>
       <script>
         
        function biaya_gratis() {
          document.getElementById('mhs').style.display = "none";
          document.getElementById('umum').style.display = "none";
        }

        function biaya_bayar() {
          document.getElementById('umum').style.display = "inline";
          document.getElementById('mhs').style.display = "inline";
        }
      </script>