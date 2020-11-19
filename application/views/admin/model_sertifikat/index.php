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
                 <a href="<?php echo base_url() ?>model_sertifikat/tambah" class="btn btn-success">Tambah Model Sertifikat</a>
               </div>
               <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                   <thead>
                     <tr>
                     <tr>
                       <th>No</th>
                       <th>Nama Model</th>
                       <th>Link Cetak</th>
                       <th>Aksi</th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php
                      $no = 1;
                      foreach ($list as $l) { ?>
                       <tr>
                         <td><?php echo $no++ ?></td>
                         <td><?php echo $l->ms_model ?></td>
                         <td><a href="<?php echo base_url('assets/template_sertifikat/' . $l->ms_sertifikat) ?>">Model Sertifikat</a></td>
                         <td>
                           <a title="Ubah Model Sertifikat" href="<?php echo base_url('model_sertifikat/ubah/' . $l->ms_id) ?>" class="btn btn-warning mb-1"><i class="fas fa-edit"></i>&nbsp; Ubah</a>
                           <a title="Hapus Model Sertifikat" href="<?php echo base_url('model_sertifikat/delete/' . $l->ms_id) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger mb-1"><i class="fas fa-trash"></i> Hapus</a>
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