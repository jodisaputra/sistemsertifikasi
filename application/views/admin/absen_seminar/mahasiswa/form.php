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
                 <table class="table table-stripped" id="table-2">
                   <thead>
                     <tr>
                       <th width="30%%">NPM Mahasiswa</th>
                       <th width="25%">Hadir</th>
                       <th width="25%">Tidak Hadir</th>
                     </tr>
                   </thead>
                   <form action="<?php echo base_url('absen_seminar/simpan_mahasiswa'); ?>" method="post">
                     <tbody>
                       <?php foreach ($list as $l) : ?>
                         <tr>
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