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
                 <form action="<?php echo base_url('input_nilai_sertifikasi_final/simpan_umum'); ?>" method="post" enctype="multipart/form-data">

                   <input type="hidden" name="id_sertifikasi" value="<?php echo $list->srtu_sertifikasi ?>">
                   <input type="hidden" name="id_peserta" value="<?php echo $list->srtu_peserta ?>">

                   <div class="form-group">
                     <label>Skor Total</label>
                     <input type="text" class="form-control" name="skor" value="<?php echo $skortotal ?>" readonly>
                   </div>

                   <div class="form-group">
                     <label>Grade</label>
                     <input type="text" class="form-control" name="grade" value="<?php echo $grade ?>" readonly>
                   </div>

                   <div class="form-group">
                     <label>Penghargaan</label>
                     <input type="text" class="form-control" name="penghargaan" value="<?php echo $penghargaan ?>" readonly>
                   </div>

                   <div class="form-group">
                     <label>Lembaga Sertifikat</label>
                     <input type="text" class="form-control" name="lembaga" value="<?php echo $lembaga ?>" readonly>
                   </div>

                   <div class="form-group">
                     <label>Status</label>
                     <input type="text" class="form-control" name="status" value="<?php echo $status ?>" readonly>
                   </div>

                   <div class="form-group">
                     <label>Upload Sertifikat <small class="text-danger"> Jika Belum lulus silahkan kosongkan !</small></label>
                     <br>
                     File Sertifikat :<?php if ($list->srtu_sertifikat != NULL || $list->srtu_sertifikat != '') { ?> <a href="<?php echo base_url('assets/sertifikat_umum/' . $list->srtu_sertifikat); ?>">Klik Disini</a>
                   <?php } ?>
                   <br>
                   <input type="file" class="form-control mt-2" name="sertifikat">
                   <input type="hidden" name="sertifikat_old" value="<?php echo $list->srtu_sertifikat ?>">
                   </div>

                   <?php if ($status == 'Lulus') { ?>
                     <div class="form-group">
                       <label>Tanggal Lulus *</label>
                       <input type="date" class="form-control" name="tanggal_lulus" value="<?php echo $this->input->post('tanggal_lulus') ?? $list->srtu_tanggal_lulus  ?>">
                       <?php echo form_error('tanggal_lulus') ?>
                     </div>
                   <?php } ?>

                   <div class="form-group">
                     <label>Catatan</label>
                     <textarea class="form-control" name="catatan"><?php echo $this->input->post('catatan') ?? $list->srtu_catatan ?></textarea>
                   </div>

                   <button class="btn btn-success" type="submit">Simpan</button>
                   <a href="<?php echo base_url('input_nilai_sertifikasi_final/nilai_umum_final/' . $list->srtu_sertifikasi) ?>" class="btn btn-danger">Kembali</a>
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