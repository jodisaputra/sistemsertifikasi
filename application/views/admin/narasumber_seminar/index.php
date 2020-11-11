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
                 <a href="<?php echo base_url() ?>narasumberseminar/tambah/<?php echo $seminar ?>" class="btn btn-success">Tambah Narasumber</a>
               </div>
               <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                   <thead>
                     <tr>
                       <th>No</th>
                       <th width="10%">Seminar</th>
                       <th>Nama Narasumber</th>
                       <th>Asal Institusi</th>
                       <th>Sebagai</th>
                       <th width="20%">Tanda tangan</th>
                       <th width="20%">Aksi</th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php
                      $no = 1;
                      foreach ($list as $l) { ?>
                       <tr>
                         <td><?php echo $no++ ?></td>
                         <td><?php echo $l->smr_acara ?></td>
                         <td><?php echo $l->ns_narasumber ?></td>
                         <td><?php echo $l->ns_institusi ?></td>
                         <td><?php echo $l->ns_sebagai ?></td>
                         <td style="text-align: center;">
                           <?php if ($l->ns_tandatangan == NULL || $l->ns_tandatangan == '') { ?>
                             <p class="text-danger">Tidak Ada Tanda tangan</p>
                           <?php } else { ?>
                             <img style="width: 50%; heigh: 50%;" src="<?php echo base_url('assets/tanda_tangan/' . $l->ns_tandatangan) ?>" alt="">
                           <?php } ?>
                         </td>
                         <td>
                           <a title="Ubah Narasumber Seminar" href="<?php echo base_url('narasumberseminar/ubah/' . $l->ns_id) ?>" class="btn btn-warning mb-1"><i class="fas fa-edit"></i>&nbsp; Ubah</a>
                           <a title="Hapus Narasumber Seminar" href="<?php echo base_url('narasumberseminar/delete/' . $l->ns_id . '/' . $l->ns_seminar) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger mb-1"><i class="fas fa-trash"></i>&nbsp; Hapus</a>
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