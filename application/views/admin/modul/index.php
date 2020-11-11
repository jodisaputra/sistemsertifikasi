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
                 <a href="<?php echo base_url() ?>modul/tambah" class="btn btn-success">Tambah Modul</a>
               </div>
               <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                   <thead>
                     <tr>
                       <th>No</th>
                       <th>Nama Modul</th>
                       <th>Link</th>
                       <th>Icon</th>
                       <th>Main Menu</th>
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
                         <td><?php echo $l->mdl_modul ?></td>
                         <td><?php echo $l->mdl_link ?></td>
                         <td><i class="<?php echo $l->mdl_icon ?>"></i> <?php echo $l->mdl_icon ?></td>
                         <td>
                           <?php if ($l->mdl_mainmenu == '0') { ?>
                             <p>Main Menu</p>
                           <?php } else { ?>
                             <p>Sub Menu</p>
                           <?php } ?>
                         </td>
                         <td>
                           <a title="Ubah Modul" href="<?php echo base_url('modul/ubah/' . $l->mdl_id) ?>" class="btn btn-warning mb-1"><i class="fas fa-edit"></i>&nbsp; Ubah</a>
                           <a title="Hapus Modul" href="<?php echo base_url('modul/delete/' . $l->mdl_id) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger mb-1"><i class="fas fa-trash"></i> Hapus</a>
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