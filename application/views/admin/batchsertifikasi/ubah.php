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
                 <p class="text-danger">Tanda <b>*</b> Wajib Diisi !</p>

                 <form action="<?php echo base_url('batch_sertifikasi/simpan_perubahan'); ?>" method="post" enctype="multipart/form-data">

                   <input type="hidden" name="batch_id" value="<?php echo $list->bs_id ?>">

                   <div class="form-group">
                     <label>Nama Sub Sertifikasi *</label>
                     <select name="sub_sertifikasi" class="form-control">
                       <option value="">Pilih Salah Satu</option>
                       <?php foreach ($subsertifikasi as $s) : ?>
                         <option value="<?php echo $s->scert_id ?>" <?php if ($s->scert_id == $list->bs_subsertifikasi) {
                                                                      echo 'selected';
                                                                    } ?>><?php echo $s->scert_subsertifikasi ?></option>
                       <?php endforeach ?>
                     </select>
                     <?php echo form_error('sub_sertifikasi') ?>
                   </div>

                   <div class="form-group">
                     <label>Jumlah Pertemuan *</label>
                     <input type="text" class="form-control" name="jumlah_pertemuan" value="<?php echo $list->bs_jumlahpertemuan ?>">
                     <?php echo form_error('jumlah_pertemuan') ?>
                   </div>

                   <div class="form-group">
                     <label>Tanggal Daftar *</label>
                     <input type="date" class="form-control" name="tanggal_daftar" value="<?php echo $list->bs_mulai_daftar ?>">
                     <?php echo form_error('tanggal_daftar') ?>
                   </div>

                   <div class="form-group">
                     <label>Tanggal Terakhir Daftar *</label>
                     <input type="date" class="form-control" name="tanggal_terakhir" value="<?php echo $list->bs_terakhir_daftar ?>">
                     <?php echo form_error('tanggal_terakhir') ?>
                   </div>

                   <div class="form-group">
                     <label>Biaya Mahasiswa *</label>
                     <input type="number" class="form-control" name="biaya_mhs" value="<?php echo $list->bs_biaya_mhs ?>">
                     <?php echo form_error('biaya_mhs') ?>
                   </div>

                   <div class="form-group">
                     <label>Biaya Umum *</label>
                     <input type="number" class="form-control" name="biaya_umum" value="<?php echo $list->bs_biaya_umum ?>">
                     <?php echo form_error('biaya_umum') ?>
                   </div>

                   <div class="form-group">
                     <label>Jumlah Max Peserta *</label>
                     <input type="text" class="form-control" name="jumlah_max_peserta" value="<?php echo $list->bs_jumlahmax ?>">
                     <?php echo form_error('jumlah_max_peserta') ?>
                   </div>

                   <div class="form-group">
                     <label>Jumlah Min Peserta *</label>
                     <input type="text" class="form-control" name="jumlah_min_peserta" value="<?php echo $list->bs_jumlahmin ?>">
                     <?php echo form_error('jumlah_min_peserta') ?>
                   </div>

                   <div class="form-group">
                     <label>Banner *</label>
                     <br>
                     <img width="20%" src="<?php echo base_url('assets/banner_batchsertifikasi/' . $list->bs_banner); ?>" alt="">
                     <br>
                     <small class="text-danger">Gambar Sebelumnya</small>
                     <br>
                     <input type="hidden" name="oldfile" value="<?php echo $list->bs_banner ?>">
                     <input type="file" class="form-control" name="banner">
                     <?php echo form_error('banner') ?>
                   </div>

                   <div class="form-group">
                     <label>Keterangan *</label>
                     <textarea name="keterangan" id="keterangan" class="form-control cust_sumnote" rows="10" cols="80"><?php echo $list->bs_keterangan ?></textarea>
                     <?php echo form_error('keterangan') ?>
                   </div>

                   <button class="btn btn-success" type="submit">Ubah</button>
                   <a href="<?php echo base_url('batch_sertifikasi') ?>" class="btn btn-danger">Kembali</a>
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
             url: "<?php echo base_url('batch_sertifikasi/imageUpload') ?>",
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
             url: "<?php echo base_url('batch_sertifikasi/deleteImage') ?>",
             cache: false,
             success: function(response) {
               console.log(response);
             }
           });
         }
       </script>