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
                 <a href="<?php echo base_url() ?>seminar" class="btn btn-danger">Kembali</a>
                 <a href="<?php echo base_url() ?>panitiaseminar/tambah/<?php echo $seminar ?>" class="btn btn-success">Tambah Panitia</a>
               </div>
               <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                   <thead>
                     <tr>
                       <th>No</th>
                       <th>Nama Panitia</th>
                       <th>Email</th>
                       <th>Sertifikat</th>
                       <th width="20%">Aksi</th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php
                      $no = 1;
                      foreach ($list as $l) { ?>
                       <tr>
                         <td><?php echo $no++ ?></td>
                         <td><?php echo $l->pan_nama ?></td>
                         <td><?php echo $l->pan_email ?></td>
                         <td><a href="<?php echo base_url('panitiaseminar/send_sertifikat/' . $l->pan_seminar . '/' . $l->pan_email) ?>" class="btn btn-success btn-sm">Kirim Sertifikat</a></td>
                         <td>
                           <a title="Ubah Panitia Seminar" href="<?php echo base_url('panitiaseminar/ubah/' . $l->pan_id) ?>" class="btn btn-warning mb-1"><i class="fas fa-edit"></i>&nbsp; Ubah</a>
                           <a title="Hapus Panitia Seminar" href="<?php echo base_url('panitiaseminar/delete/' . $l->pan_id . '/' . $l->pan_seminar) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger mb-1"><i class="fas fa-trash"></i>&nbsp; Hapus</a>
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