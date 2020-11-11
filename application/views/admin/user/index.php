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
                 <a href="<?php echo base_url() ?>user/tambah" class="btn btn-success">Tambah User</a>
               </div>
               <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                   <thead>
                     <tr>
                       <th>No</th>
                       <th>Email</th>
                       <th>User Group</th>
                       <th>Status</th>
                       <th>Prodi</th>
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
                         <td><?php echo $l->usr_email ?></td>
                         <td><?php echo $l->ug_group ?></td>
                         <td>
                           <?php if ($l->usr_isaktif == 'y') { ?>
                             <div class="badge badge-success">Aktif</div>
                           <?php } else { ?>
                             <div class="badge badge-danger">Tidak Aktif</div>
                           <?php } ?>
                         </td>
                         <td>
                           <?php if ($l->usr_prodi == '0') { ?>
                             <p>Tidak ada Prodi</p>
                           <?php } elseif ($l->usr_prodi == '11') { ?>
                             <p>Prodi Teknik Sipil</p>
                           <?php } elseif ($l->usr_prodi == '12') { ?>
                             <p>Prodi Arsitektur</p>
                           <?php } elseif ($l->usr_prodi == '21') { ?>
                             <p>Prodi Teknik Elektro</p>
                           <?php } elseif ($l->usr_prodi == '31') { ?>
                             <p>Prodi Sistem Informasi</p>
                           <?php } elseif ($l->usr_prodi == '32') { ?>
                             <p>Prodi Teknologi Informasi</p>
                           <?php } elseif ($l->usr_prodi == '41') { ?>
                             <p>Prodi Manajemen</p>
                           <?php } elseif ($l->usr_prodi == '42') { ?>
                             <p>Prodi Akuntansi</p>
                           <?php } elseif ($l->usr_prodi == '53') { ?>
                             <p>Prodi Magister Manajemen</p>
                           <?php } elseif ($l->usr_prodi == '55') { ?>
                             <p>Prodi Pariwisata</p>
                           <?php } elseif ($l->usr_prodi == '51') { ?>
                             <p>Prodi Ilmu Hukum</p>
                           <?php } elseif ($l->usr_prodi == '52') { ?>
                             <p>Prodi Magister hukum</p>
                           <?php } elseif ($l->usr_prodi == '56') { ?>
                             <p>Prodi Pendidikan Bahasa Inggris</p>
                           <?php } ?>
                         </td>
                         <td>
                           <a title="Ubah User" href="<?php echo base_url('user/ubah/' . $l->usr_email) ?>" class="btn btn-warning mb-1"><i class="fas fa-edit"></i> Ubah</a>
                           <a title="Hapus User" href="<?php echo base_url('user/delete/' . $l->usr_email) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger mb-1"><i class="fas fa-trash"></i> &nbsp; Hapus</a>
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