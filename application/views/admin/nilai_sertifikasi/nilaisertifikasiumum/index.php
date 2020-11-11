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
               <div class="card-header">
                 <a href="<?php echo base_url() ?>batch_sertifikasi" class="btn btn-danger">Kembali</a>
               </div>
               <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                   <thead>
                     <tr>
                       <th>No</th>
                       <th>Nama Peserta</th>
                       <th>Skor</th>
                       <th>Aksi</th>
                     </tr>
                     </tr>
                   </thead>
                   <tbody>
                     <?php
                      $no = 1;
                      foreach ($list as $l) { ?>
                       <tr>
                         <td><?php echo $no++ ?></td>
                         <td><?php echo $l->pu_nama ?></td>
                         <td>
                           <?php if ($l->ssu_skor == '') { ?>
                             <p class="text-danger">Skor Masih Belum Diisi</p>
                           <?php } else { ?>
                             <?php echo $l->ssu_skor ?>
                           <?php } ?>
                         </td>
                         <td>
                           <?php if ($l->ssu_skor == '') {
                            ?>
                             <a title="Input Nilai Sertifikasi Umum" href="<?php echo base_url('input_nilai_sertifikasi/input_nilai_umum/' . $l->ssu_id . '/' . $l->ssu_sertifikasi_umum . '/' . $l->ssu_batch); ?>" class="btn btn-info mb-1"><i class="fa fa-book"></i>&nbsp; Input Nilai</a>
                           <?php
                            } else {
                            ?>
                             <a title="Input Ulang Nilai Sertifikasi Umum" href="<?php echo base_url('input_nilai_sertifikasi/input_nilai_umum/' . $l->ssu_id . '/' . $l->ssu_sertifikasi_umum . '/' . $l->ssu_batch); ?>" class="btn btn-info mb-1"><i class="fa fa-book"></i>&nbsp; Input Nilai Ulang</a>
                           <?php
                            }
                            ?>
                         </td>
                       </tr>
                     <?php } ?>
                   </tbody>
                 </table>
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