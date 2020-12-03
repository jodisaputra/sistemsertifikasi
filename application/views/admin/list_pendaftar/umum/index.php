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
                 <table id="example1" class="table table-bordered table-striped">
                   <thead>
                     <tr>
                       <th>No</th>
                       <th>Nama Mahasiswa</th>
                       <th>Nama Subsertifikasi</th>
                       <th>Tanggal Daftar</th>
                       <th>Status Pembayaran</th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php
                      $no = 1;
                      foreach ($list as $l) 
                      {
                      ?>

                       <tr>
                          <td><?php echo $no++ ?></td>
                          <td><?php echo $l->pu_nama ?></td>
                          <td><?php echo $l->scert_subsertifikasi ?></td>
                          <td><?php echo date('d M Y', strtotime($l->ssu_tanggaldaftar)) ?></td>
                          <td>
                             <?php
                              if ($l->ssu_status == 'Menunggu Pembayaran') {
                              ?>
                               <div class="badge badge-warning">Menunggu Pembayaran</div>

                             <?php
                              } elseif ($l->ssu_status == 'Validasi Pembayaran') {
                              ?>

                               <div class="badge badge-info">Menunggu Validasi Pembayaran</div>

                             <?php
                              } elseif ($l->ssu_status == 'Lunas') {

                              ?>
                               <div class="badge badge-success">Lunas</div>

                             <?php

                              } else {
                              ?>

                               <div class="badge badge-danger">Tolak</div>

                             <?php

                              }
                              ?>
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