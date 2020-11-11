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
                 <a href="<?php echo base_url('sertifikasi') ?>" class="btn btn-danger">Kembali</a>
               </div>
               <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                   <thead>
                     <tr>
                       <th>No</th>
                       <th>Nama Peserta</th>
                       <th>Skor Total</th>
                       <th>Grade</th>
                       <th>Status</th>
                       <th>Aksi</th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php
                      $no = 1;
                      foreach ($list as $l) { ?>
                       <tr>
                         <td><?php echo $no++ ?></td>
                         <td><?php echo $mhs[$l->sm_mahasiswa] ?></td>
                         <td>
                           <?php if ($l->sm_skor == '') { ?>
                             <p class="text-danger">Skor Masih Belum Diisi</p>
                           <?php } else { ?>
                             <?php echo $l->sm_skor ?>
                           <?php } ?>
                         </td>
                         <td>
                           <?php if ($l->sm_grade == '') { ?>
                             <p class="text-danger">Skor Masih Belum Diisi</p>
                           <?php } else { ?>
                             <?php echo $l->sm_grade ?>
                           <?php } ?>
                         </td>
                         <td>
                           <?php if ($l->sm_status == '') { ?>
                             <p class="text-danger">Skor Masih Belum Diisi</p>
                           <?php } elseif ($l->sm_status == 'Lulus') { ?>
                             <div class="badge badge-success">Lulus</div>
                           <?php } elseif ($l->sm_status == 'Tidak Lulus') { ?>
                             <div class="badge badge-danger">Tidak Lulus</div>
                           <?php } ?>
                         </td>
                         <td>
                           <?php if ($l->sm_skor == '') { ?>
                             <a title="Input Nilai dan Sertifikat" href="<?php echo base_url('input_nilai_sertifikasi_final/input_nilai_mahasiswa/' . $l->sm_sertifikasi . '/' . $l->sm_mahasiswa); ?>" class="btn btn-info mb-1"><i class="fa fa-book"></i>&nbsp; Input Sertifikat</a>
                           <?php } else { ?>
                             <a title="Input Nilai dan Sertifikat Ulang" href="<?php echo base_url('input_nilai_sertifikasi_final/input_nilai_mahasiswa/' . $l->sm_sertifikasi . '/' . $l->sm_mahasiswa); ?>" class="btn btn-info mb-1"><i class="fa fa-book"></i>&nbsp; Input Sertifikat Ulang</a>
                           <?php } ?>
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