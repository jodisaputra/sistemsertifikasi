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
                 <a href="<?php echo base_url('batch_sertifikasi'); ?>" class="btn btn-danger mb-3">Kembali</a>
                 <table id="example1" class="table table-bordered table-striped">
                   <thead>
                     <tr>
                       <th>No</th>
                       <th>Nama Kegiatan</th>
                       <th width="50%">Aksi</th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php $no = 1; ?>
                     <?php foreach ($list as $l) : ?>
                       <tr>
                         <td><?php echo $no++ ?></td>
                         <td><?php echo $l->as_nama_absen ?></td>
                         <td>
                           <?php error_reporting(E_ALL ^ E_NOTICE); ?>
                           <?php if ($l->as_id == $cek[$l->as_id]) { ?>
                             <a title="Input Ulang Absen Sertifikasi" href="<?php echo base_url('Absen_sertifikasi/absen_update/' . $l->as_id . '/' . $l->as_batch) ?>" class="btn btn-primary mb-1"><i class="fas fa-plus"></i>&nbsp; Input Ulang Absen Sertifikasi</a>
                             <a title="Detail Absensi" href="<?php echo base_url('Absen_sertifikasi/detail/' . $l->as_id . '/' . $l->as_batch) ?>" class="btn btn-info mb-1"><i class="fas fa-eye"></i>&nbsp; Detail Absensi</a>
                             <a title="Cetak Absen" href="<?php echo base_url('Absen_sertifikasi/cetak_absen/' . $l->as_id . '/' . $l->as_batch) ?>" class="btn btn-warning mb-1" target="_blank"><i class="fas fa-print"></i>&nbsp; Cetak Absen</a>
                           <?php } else { ?>
                             <a title="Input Absen Sertifikasi" href="<?php echo base_url('Absen_sertifikasi/absen/' . $l->as_id . '/' . $l->as_batch) ?>" class="btn btn-primary mb-1"><i class="fas fa-plus"></i>&nbsp; Input Absen Sertifikasi</a>
                           <?php } ?>
                         </td>
                       </tr>
                     <?php endforeach ?>
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