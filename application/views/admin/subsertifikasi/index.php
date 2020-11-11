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
                 <a href="<?php echo base_url() ?>subsertifikasi/kembali" class="btn btn-danger">Kembali</a>
                 <a href="<?php echo base_url() ?>subsertifikasi/tambah" class="btn btn-success">Tambah Sub Sertifikasi</a>
               </div>
               <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                   <thead>
                     <tr>
                       <th>No</th>
                       <th>Nama Sub-Sertifikasi</th>
                       <th>Nama Sertifikasi</th>
                       <th>Status</th>
                       <th>Aksi</th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php
                      $no = 1;
                      foreach ($sub_sertifikasi as $s) { ?>
                       <tr>
                         <td><?php echo $no++ ?></td>
                         <td><?php echo $s->scert_subsertifikasi ?></td>
                         <td><?php echo $s->cert_sertifikasi ?></td>
                         <td>
                           <?php if ($s->scert_isaktif == "y") { ?>
                             <div class="badge badge-success">Aktif</div>
                           <?php } else { ?>
                             <div class="badge badge-danger">Tidak Aktif</div>
                           <?php } ?>
                         </td>
                         <td>
                           <a title="Ubah Subsertifikasi" href="<?php echo base_url('subsertifikasi/ubah/' . $s->scert_id) ?>" class="btn btn-warning mb-1"><i class="fas fa-edit"></i>&nbsp; Edit</a>
                           <a title="Hapus Subsertifikasi" href="<?php echo base_url('subsertifikasi/delete/' . $s->scert_id) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus Sub-Sertifikasi ini?')" class="btn btn-danger mb-1"><i class="fas fa-trash"></i>&nbsp; Hapus</a>
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