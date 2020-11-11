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
                 <a href="<?php echo base_url() ?>jadwal_subsertifikasi/tambah" class="btn btn-success">Tambah Jadwal</a>
               </div>
               <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                   <thead>
                     <tr>
                       <th>No</th>
                       <th>Batch Sertifikasi</th>
                       <th>Tanggal Subsertifikasi</th>
                       <th>Jam Mulai</th>
                       <th>Jam Selesai</th>
                       <th>Tempat</th>
                       <th>Link</th>
                       <th>Aksi</th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php
                      $no = 1;
                      foreach ($jadwal as $j) { ?>
                       <tr>
                         <td><?php echo $no++ ?></td>
                         <td><?php echo $j->scert_subsertifikasi ?></td>
                         <td><?php echo date('d M Y', strtotime($j->js_tanggal)) ?></td>
                         <td><?php echo $j->js_mulai ?></td>
                         <td><?php echo $j->js_selesai ?></td>
                         <td><?php echo $j->js_tempat ?></td>
                         <td><?php echo $j->js_link ?></td>
                         <td width="20%">
                           <a title="Ubah Jadwal Ujian" href="<?php echo base_url('jadwal_subsertifikasi/ubah/' . $j->js_batch) ?>" class="btn btn-warning mb-1"><i class="fas fa-edit"></i>&nbsp; Ubah</a>

                           <a title="Hapus Jadwal Ujian" href="<?php echo base_url('jadwal_subsertifikasi/delete/' . $j->js_batch) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger mb-1"><i class="fas fa-trash"></i>&nbsp; Hapus</a>
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