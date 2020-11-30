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
                 <p class="text-danger mb-5">Tanda <b>*</b> Wajib Diisi !</p>

                 <form action="<?php echo base_url('batch_sertifikasi/simpan'); ?>" method="post" enctype="multipart/form-data">

                   <div class="row">
                     <div class="col-3">
                       <div class="form-group">
                         <label>Nama Sub Sertifikasi *</label>
                         <select name="sub_sertifikasi" class="form-control">
                           <option value="">Pilih Salah Satu</option>
                           <?php foreach ($subsertifikasi as $s) : ?>
                             <option value="<?php echo $s->scert_id ?>" <?php echo set_value('sub_sertifikasi') == $s->scert_id ? "selected" : null ?>><?php echo $s->scert_subsertifikasi ?></option>
                           <?php endforeach ?>
                         </select>
                         <?php echo form_error('sub_sertifikasi') ?>
                       </div>
                     </div>

                     <div class="col-3">
                       <div class="form-group">
                         <label>Jumlah Pertemuan *</label>
                         <input type="text" class="form-control" name="jumlah_pertemuan" value="<?php echo set_value('jumlah_pertemuan') ?>">
                         <?php echo form_error('jumlah_pertemuan') ?>
                       </div>
                     </div>

                     <div class="col-3">
                       <div class="form-group">
                         <label>Tanggal Daftar *</label>
                         <input type="date" class="form-control" name="tanggal_daftar" value="<?php echo set_value('tanggal_daftar') ?>">
                         <?php echo form_error('tanggal_daftar') ?>
                       </div>
                     </div>

                     <div class="col-3">
                       <div class="form-group">
                         <label>Tanggal Terakhir Daftar *</label>
                         <input type="date" class="form-control" name="tanggal_terakhir" value="<?php echo set_value('tanggal_terakhir') ?>">
                         <?php echo form_error('tanggal_terakhir') ?>
                       </div>
                     </div>
                     
                     <div class="col-12">
                        <div class="form-group">
                          <label>Pendaftaran Untuk *</label>
                          <br>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input mahasiswa" type="radio" name="pendaftaran_untuk" value="mahasiswa" <?php echo set_value('pendaftaran_untuk') == 'mahasiswa' ? "checked='checked'" : null ?>  id="mahasiswa" onchange="mahasiswa()">
                            <label class="form-check-label">Mahasiswa</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input umum" type="radio" name="pendaftaran_untuk" value="umum" <?php echo set_value('pendaftaran_untuk') == 'umum' ? "checked='checked'" : null ?> id="umum" onchange="umum()">
                            <label class="form-check-label">Umum</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input both" type="radio" name="pendaftaran_untuk" value="mahasiswa dan umum" <?php echo set_value('pendaftaran_untuk') == 'mahasiswa dan umum' ? "checked='checked'" : null ?> id="both" onchange="both()">
                            <label class="form-check-label">Mahasiswa dan Umum</label>
                          </div>
                          <br>
                          <?php echo form_error('pendaftaran_untuk') ?>
                        </div>
                     </div>

                     <div class="col-6" id="mahasiswa" <?php if($this->input->post('pendaftaran_untuk') == 'mahasiswa') { echo 'style="display: inline;"'; } elseif($this->input->post('pendaftaran_untuk') == 'umum') { echo 'style="display: none;"'; } elseif($this->input->post('pendaftaran_untuk') == 'mahasiswa dan umum') { echo 'style="display: inline;"'; } else { echo 'style="display: none;"'; } ?>">
                       <div class="form-group">
                         <label>Biaya Mahasiswa *</label>
                         <input type="text" class="form-control uang" name="biaya_mhs" value="<?php echo set_value('biaya_mhs') ?>">
                         <?php echo form_error('biaya_mhs') ?>
                       </div>
                     </div>

                     <div class="col-6" id="umum" <?php if($this->input->post('pendaftaran_untuk') == 'umum') { echo 'style="display: inline;"'; } elseif($this->input->post('pendaftaran_untuk') == 'mahasiswa') { echo 'style="display: none;"'; } elseif($this->input->post('pendaftaran_untuk') == 'mahasiswa dan umum') { echo 'style="display: inline;"'; } else { echo 'style="display: none;"'; } ?>">
                       <div class="form-group">
                         <label>Biaya Umum *</label>
                         <input type="text" class="form-control uang" name="biaya_umum" value="<?php echo set_value('biaya_umum') ?>">
                         <?php echo form_error('biaya_umum') ?>
                       </div>
                     </div>

                     <div class="col-12"></div>
                     <br>

                     <div class="col-4">
                       <div class="form-group">
                         <label>Jumlah Max Peserta *</label>
                         <input type="text" class="form-control input-rupiah" name="jumlah_max_peserta" value="<?php echo set_value('jumlah_max_peserta') ?>">
                         <?php echo form_error('jumlah_max_peserta') ?>
                       </div>
                     </div>

                     <div class="col-4">
                       <div class="form-group">
                         <label>Jumlah Min Peserta *</label>
                         <input type="text" class="form-control" name="jumlah_min_peserta" value="<?php echo set_value('jumlah_min_peserta') ?>">
                         <?php echo form_error('jumlah_min_peserta') ?>
                       </div>
                     </div>

                     <div class="col-4">
                       <div class="form-group">
                         <label>Banner *</label>
                         <input type="file" class="form-control" name="banner">
                         <?php echo form_error('banner') ?>
                       </div>
                     </div>

                     <div class="col-12">
                       <div class="form-group">
                         <label>Keterangan *</label>
                         <textarea id="keterangan" name="keterangan" class="form-control cust_sumnote" rows="10" cols="80"><?php echo set_value('keterangan') ?></textarea>
                         <?php echo form_error('keterangan') ?>
                       </div>
                     </div>

                     <div class="col-12 text-center mt-3 mb-4">
                       <h1>Jadwal Ujian Sertifikasi</h1>
                     </div>

                     <div class="col-4">
                       <div class="form-group">
                         <label>Tanggal Pelaksanaan *</label>
                         <input type="date" class="form-control" name="tanggal_pelaksanaan" value="<?php echo set_value('tanggal_pelaksanaan') ?>">
                         <?php echo form_error('tanggal_pelaksanaan') ?>
                       </div>
                     </div>

                     <div class="col-4">
                       <div class="form-group">
                         <label>Jam Mulai *</label>
                         <input type="time" class="form-control" name="jam_mulai" value="<?php echo set_value('jam_mulai') ?>">
                         <?php echo form_error('jam_mulai') ?>
                       </div>
                     </div>

                     <div class="col-4">
                       <div class="form-group">
                         <label>Jam Selesai *</label>
                         <input type="time" class="form-control" name="jam_selesai" value="<?php echo set_value('jam_selesai') ?>">
                         <?php echo form_error('jam_selesai') ?>
                       </div>
                     </div>

                     <div class="col-6">
                       <div class="form-group">
                         <label>Tempat</label>
                         <input type="text" class="form-control" name="tempat" value="<?php echo set_value('tempat') ?>">
                       </div>
                     </div>

                     <div class="col-6">
                       <div class="form-group">
                         <label>Link</label>
                         <input type="text" class="form-control" name="link" value="<?php echo set_value('link') ?>">
                       </div>
                     </div>

                     <div class="col-12 mt-4">
                       <button class="btn btn-success" type="submit">Tambah</button>
                       <a href="<?php echo base_url('batch_sertifikasi') ?>" class="btn btn-danger">Kembali</a>
                     </div>
                 </form>
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
       <script>
        function mahasiswa() {
          document.getElementById('mahasiswa').style.display = "inline";
          document.getElementById('umum').style.display = "none";
        }

        function umum() {
          document.getElementById('umum').style.display = "inline";
          document.getElementById('mahasiswa').style.display = "none";
        }

        function both() {
          document.getElementById('umum').style.display = "inline";
          document.getElementById('mahasiswa').style.display = "inline";
        }
      </script>