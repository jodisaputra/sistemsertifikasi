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
                 <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                   Set Semua Hadir
                 </button>
                 <table class="table table-stripped" id="table-2">
                   <thead>
                     <tr>
                       <th width="30%%">Nama Peserta</th>
                       <th width="25%">Hadir</th>
                       <th width="25%">Tidak Hadir</th>
                     </tr>
                   </thead>
                   <form action="<?php echo base_url('absen_seminar/simpan_umum'); ?>" method="post">
                     <tbody>
                       <?php foreach ($list as $l) : ?>
                         <tr>
                           <input type="hidden" name="id_peserta[]" value="<?php echo $l->su_peserta ?>">
                           <input type="hidden" name="id_seminar" value="<?php echo $l->su_seminar ?>">
                           <td><?php echo $l->pu_nama ?></td>
                           <td class="text-left"><input type="radio" name="name<?php echo str_replace('.', '_', $l->su_peserta)  ?>" <?php if ($l->su_ishadir == 'y') {
                                                                                                                                        echo 'checked';
                                                                                                                                      } ?> value="y" required></td>
                           <td class="text-left"><input type="radio" name="name<?php echo str_replace('.', '_', $l->su_peserta) ?>" <?php if ($l->su_ishadir == 'n') {
                                                                                                                                      echo 'checked';
                                                                                                                                    } ?> value="n" required></td>
                         </tr>
                       <?php endforeach ?>
                     </tbody>
                 </table>
                 <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                 <a href="<?php echo base_url('seminar'); ?>" class="btn btn-danger mt-3">Kembali</a>
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

       <!-- Modal -->
       <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-md">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Set Semua Hadir</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body">
               <form action="<?php echo base_url('absen_seminar/simpan_pesertaall'); ?>" method="POST">
                 <table class="table table-bordered table-striped">
                   <thead>
                     <tr>
                       <th>Nama Peserta</th>
                       <th>Hadir</th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php foreach ($list as $l) : ?>
                       <tr>
                         <input type="hidden" name="id_peserta[]" value="<?php echo $l->su_peserta ?>">
                         <input type="hidden" name="id_seminar" value="<?php echo $l->su_seminar ?>">
                         <td><?php echo $l->pu_nama ?></td>
                         <td class="text-left"><input type="radio" name="name<?php echo str_replace('.', '_', $l->su_peserta)  ?>" checked="checked"></td>
                       </tr>
                     <?php endforeach; ?>
                   </tbody>
                 </table>
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Simpan</button>
             </div>
             </form>
           </div>
         </div>
       </div>