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
                 <a href="<?php echo base_url() ?>usergroup/tambah" class="btn btn-success">Tambah User Group</a>
               </div>
               <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                   <thead>
                     <tr>
                       <th>No</th>
                       <th>Nama Group</th>
                       <th>Keterangan</th>
                       <th>Status</th>
                       <th>Aksi</th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php
                      $no = 1;
                      foreach ($list as $l) {
                      ?>

                       <tr>
                         <td><?php echo $no++ ?></td>
                         <td><?php echo $l->ug_group ?></td>
                         <td><?php echo $l->ug_keterangan ?></td>
                         <td>
                           <?php if ($l->ug_isaktif == 'y') { ?>
                             <div class="badge badge-success">Aktif</div>
                           <?php } else { ?>
                             <div class="badge badge-danger">Tidak Aktif</div>
                           <?php } ?>
                         </td>
                         <td>
                           <a title="Set Modul" href="<?php echo base_url('modul_group/tambah/' . $l->ug_id) ?>" class="btn btn-info mb-1"><i class="fas fa-bars"></i>&nbsp; Set Modul</a>
                           <a title="Ubah User Grup" href="<?php echo base_url('usergroup/ubah/' . $l->ug_id) ?>" class="btn btn-warning mb-1"><i class="fas fa-edit"></i> &nbsp; Ubah</a>
                           <a title="Hapus User Grup" href="<?php echo base_url('usergroup/delete/' . $l->ug_id) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger mb-1"><i class="fas fa-trash"></i> Hapus</a>
                         </td>
                       </tr>

                     <?php
                      }
                      ?>
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