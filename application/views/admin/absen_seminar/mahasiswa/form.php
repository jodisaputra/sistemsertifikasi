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

               <div class="card-body">
                 <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                   Set Semua Hadir
                 </button>
                 <form action="<?php echo base_url('absen_seminar/simpan_mahasiswa'); ?>" method="post">
                   <table class="table table-stripped" id="table-2">
                     <thead>
                       <tr>
                         <!-- <th width="2%"><input type="checkbox" id="check_all" class="checked_all"></th> -->
                         <th width="30%%">NPM Mahasiswa</th>
                         <th width="25%">Hadir</th>
                         <th width="25%">Tidak Hadir</th>
                       </tr>
                     </thead>
                     <tbody>
                       <?php foreach ($list as $l) : ?>
                         <tr>
                           <!-- <td><input type="checkbox" name="mahasiswa[]" id="c<?php echo $l->smhs_mahasiswa; ?>" class="checkbox" value="<?php echo $l->smhs_mahasiswa ?>"></td> -->
                           <input type="hidden" name="id_mahasiswa[]" value="<?php echo $l->smhs_mahasiswa ?>">
                           <input type="hidden" name="id_seminar" value="<?php echo $l->smhs_seminar ?>">
                           <td><?php echo $mhs[$l->smhs_mahasiswa] ?></td>
                           <td class="text-left"><input type="radio" name="name_<?php echo $l->smhs_mahasiswa ?>" <?php if ($l->smhs_ishadir == 'y') {
                                                                                                                    echo 'checked';
                                                                                                                  } ?> value="y" required></td>
                           <td class="text-left"><input type="radio" name="name_<?php echo $l->smhs_mahasiswa ?>" <?php if ($l->smhs_ishadir == 'n') {
                                                                                                                    echo 'checked';
                                                                                                                  } ?> value="n" required></td>
                         </tr>
                       <?php endforeach ?>
                     </tbody>
                   </table>
                   <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                   <a href="<?php echo base_url('seminar'); ?>" class="btn btn-danger mt-3">Kembali</a>
               </div>
               </form>
               <!-- /.card-body -->
             </div>
             <!-- /.card -->
           </div>
           <!-- /.col -->
         </div>
         <!-- /.row -->
       </section>
       <!-- /.content -->

       <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

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
               <form action="<?php echo base_url('absen_seminar/simpan_mahasiswaall'); ?>" method="POST">
                 <table class="table table-bordered table-striped">
                   <thead>
                     <tr>
                       <th>Nama Mahasiswa</th>
                       <th>Hadir</th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php foreach ($list as $l) : ?>
                       <tr>
                         <input type="hidden" name="id_mahasiswa[]" value="<?php echo $l->smhs_mahasiswa ?>">
                         <input type="hidden" name="id_seminar" value="<?php echo $l->smhs_seminar ?>">
                         <td><?php echo $mhs[$l->smhs_mahasiswa] ?></td>
                         <td class="text-left"><input type="radio" name="name_<?php echo $l->smhs_mahasiswa ?>" value="y" checked="checked"></td>
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