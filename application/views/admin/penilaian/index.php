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
                 <a href="<?php echo base_url() ?>penilaian/tambah" class="btn btn-success">Tambah Penilaian</a>
               </div>
               <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                   <thead>
                     <tr>
                       <th>No</th>
                       <th>Nama Sertifikasi</th>
                       <th>Nilai Min</th>
                       <th>Nilai Max</th>
                       <th>Grade</th>
                       <th>Penghargaan</th>
                       <th>Lembaga Sertifikat</th>
                       <th>Status</th>
                       <th width="25%">Aksi</th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php
                      $no = 1;
                      foreach ($list as $l) { ?>
                       <tr>
                         <td><?php echo $no++ ?></td>
                         <td><?php echo $l->cert_sertifikasi ?></td>
                         <td><?php echo $l->pn_min ?></td>
                         <td><?php echo $l->pn_max ?></td>
                         <td><?php echo $l->pn_grade ?></td>
                         <td><?php echo $l->pn_penghargaan ?></td>
                         <td><?php echo $l->pn_lembagasertifikat ?></td>
                         <td>
                           <?php if ($l->pn_status == 'Lulus') { ?>
                             <div class="badge badge-success">Lulus</div>
                           <?php } else { ?>
                             <div class="badge badge-danger">Tidak Lulus</div>
                           <?php } ?>
                         </td>
                         <td>
                           <a title="Ubah Penilaian Sertifikasi" href="<?php echo base_url('penilaian/ubah/' . $l->pn_id) ?>" class="btn btn-warning mb-1"><i class="fas fa-edit"></i>&nbsp; Ubah</a>
                           <a title="Hapus Penilaian Sertifikasi" href="<?php echo base_url('penilaian/delete/' . $l->pn_id) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger mb-1"><i class="fas fa-trash"></i> &nbsp; Hapus</a>
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