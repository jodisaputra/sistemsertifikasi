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
                 <h3>Header Absen</h3>
                 <!-- <small class="text-danger">Mohon Diisi Sesuai dengan Format!</small> -->
                 <!-- <br> -->
                 <small class="text-danger">Catatan: Sebelum mengisi absen, silahkan simpan header absen terlebih dahulu!</small>
                 <br>
                 <br>
                 <form action="<?php echo base_url('absen_sertifikasi/simpan_header'); ?>" method="post">
                   <div class="row">
                     <div class="col-md-6 mb-3">
                       <input type="hidden" name="id_absen" value="<?php echo $header->as_id ?>">
                       <label>Nama Kegiatan</label>
                       <input type="text" name="nama_kegiatan" class="form-control" value="<?php echo $this->input->post('nama_kegiatan') ?? $header->as_nama_absen ?>">
                       <?php echo form_error('nama_kegiatan') ?>
                     </div>
                   </div>
                   <div class="row">
                     <div class="col-md-2">
                       <label>Tanggal Pelaksanaan</label>
                       <input type="date" class="form-control" name="tanggal_pelaksanaan" value="<?php echo $this->input->post('tanggal_pelaksanaan') ?? $header->as_tanggal ?>">
                       <?php echo form_error('tanggal_pelaksanaan') ?>
                     </div>
                     <!-- <div class="col-md-5">
                       <label>Nama Instruktur</label>
                       <input type="text" class="form-control" name="nama_instruktur" value="<?php echo $this->input->post('nama_instruktur') ?? $header->as_nama_instruktur ?>">
                       <?php echo form_error('nama_instruktur') ?>
                     </div> -->
                     <div class="col-md-5">
                       <label>Nama Instruktur</label>
                       <select name="nama_instruktur" class="form-control">
                         <?php foreach ($pelatih as $p) : ?>
                           <option value="<?php echo $p->ps_email; ?>" <?php if ($p->ps_email == $header->as_nama_instruktur) {
                                                                          echo 'selected';
                                                                        } ?>><?php echo $p->ps_nama; ?></option>
                         <?php endforeach; ?>
                         <?php echo form_error('nama_instruktur') ?>
                       </select>
                     </div>
                     <div class="col-md-3 form-check form-check-inline pt-4">
                       <input class="form-check-input" type="radio" name="name_<?php echo $header->as_id ?>" <?php if ($header->as_instruktur_ishadir == 'y') {
                                                                                                                echo 'checked';
                                                                                                              }  ?> value="y" required>
                       <label class="form-check-label mr-3">Hadir</label>
                       <input class="form-check-input" type="radio" name="name_<?php echo $header->as_id ?>" <?php if ($header->as_instruktur_ishadir == 'n') {
                                                                                                                echo 'checked';
                                                                                                              }  ?> value="n" required>
                       <label class="form-check-label">Tidak Hadir</label>
                     </div>
                   </div>
                   <div class="row">
                     <div class="col-md-12">
                       <label>Catatan</label>
                       <textarea class="form-control" name="catatan"><?php echo $this->input->post('catatan') ?? $header->as_catatan ?></textarea>
                     </div>
                     <div class="col pt-4">
                       <button type="submit" class="btn btn-warning"><i class="fas fa-sync"></i> Simpan Header Absen</button>
                     </div>
                   </div>
                 </form>
               </div>
               <!-- /.card-body -->
             </div>
             <!-- /.card -->
           </div>
           <!-- /.col -->
         </div>
         <div class="row">
           <div class="col-12">
             <div class="card">
               <!-- /.card-header -->
               <div class="card-body">
                 <form action="<?php echo base_url('absen_sertifikasi/simpan_absen'); ?>" method="post">
                   <table class="table table-stripped" id="table-2">
                     <thead>
                       <tr>
                         <th width="30%%">Nama Peserta</th>
                         <th width="25%">Hadir</th>
                         <th width="25%">Tidak Hadir</th>
                         <th width="25%">Izin</th>
                       </tr>
                     </thead>
                     <tbody>

                       <?php foreach ($peserta as $p) : ?>
                         <tr>
                           <input type="hidden" name="id_absensertifikasi" value="<?php echo $header->as_id ?>">
                           <input type="hidden" name="id_batch" value="<?php echo $p->ssu_batch ?>">
                           <td><?php echo $p->pu_nama ?></td>
                           <td class="text-left"><input type="radio" name="name<?php echo str_replace('.', '', $p->pu_email)  ?>" value="y" required></td>
                           <td class="text-left"><input type="radio" name="name<?php echo str_replace('.', '', $p->pu_email)  ?>" value="n" required></td>
                           <td class="text-left"><input type="radio" name="name<?php echo str_replace('.', '', $p->pu_email)  ?>" value="i" required></td>
                         </tr>
                       <?php endforeach ?>

                       <?php foreach ($mahasiswa as $m) : ?>
                         <tr>
                           <input type="hidden" name="id_batch" value="<?php echo $m->ssm_batch ?>">
                           <input type="hidden" name="id_absenmhs" value="<?php echo $header->as_id ?>">
                           <td><?php echo $mhs[$m->sm_mahasiswa] ?></td>
                           <td class="text-left"><input type="radio" name="name<?php echo $m->sm_mahasiswa  ?>" value="y" required></td>
                           <td class="text-left"><input type="radio" name="name<?php echo $m->sm_mahasiswa  ?>" value="n" required></td>
                           <td class="text-left"><input type="radio" name="name<?php echo $m->sm_mahasiswa  ?>" value="i" required></td>
                         </tr>
                       <?php endforeach ?>

                     </tbody>
                   </table>
                   <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                   <a href="<?php echo base_url('absen_sertifikasi/absen_pertemuan/' . $header->as_batch); ?>" class="btn btn-danger mt-3">Kembali</a>
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