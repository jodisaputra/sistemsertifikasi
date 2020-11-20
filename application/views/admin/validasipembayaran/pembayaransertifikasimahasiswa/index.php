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
               <form method="post" action="<?php echo base_url('validasipembayaransertifikasimahasiswa/submit_checkall_setuju') ?>">
                 <div class="card-header">
                   <button type="submit" class="btn btn-success">Set Lunas </button>
                 </div>
                 <div class="card-body">
                   <table id="example1" class="table table-bordered table-striped">
                     <thead>
                       <tr>
                         <th><input type="checkbox" id="check_all" class="checked_all"></th>
                         <th>No</th>
                         <th>Nama Mahasiswa</th>
                         <th>Nama Subsertifikasi</th>
                         <th>Tanggal Daftar</th>
                         <th>Status Pembayaran</th>
                         <th width="30%">Aksi</th>
                       </tr>
                     </thead>
                     <tbody>
                       <?php
                        $no = 1;
                        foreach ($list as $l) { ?>
                         <tr>
                           <td>
                             <?php
                              if ($l['ssm_status'] == 'Menunggu Pembayaran') {

                              ?>

                             <?php

                              } elseif ($l['ssm_status'] == 'Lunas') {

                              ?>

                             <?php

                              } elseif ($l['ssm_status'] == 'Tolak') {
                              ?>
                             <?php
                              } else {
                              ?>

                               <input type="checkbox" name="mhs[]" id="c<?php echo $l['ssm_id']; ?>" class="checkbox" value="<?php echo $l['ssm_id']; ?>">

                             <?php
                              }
                              ?>
                           </td>
                           <td><?php echo $no++ ?></td>
                           <td><?php echo $nama_mhs[$l['sm_mahasiswa']] ?></td>
                           <td><?php echo $l['scert_subsertifikasi'] ?></td>
                           <td><?php echo date('d M Y', strtotime($l['ssm_tanggaldaftar'])) ?></td>

                           <td>
                             <?php
                              if ($l['ssm_status'] == 'Menunggu Pembayaran') {
                              ?>
                               <div class="badge badge-warning">Menunggu Pembayaran</div>

                             <?php
                              } elseif ($l['ssm_status'] == 'Validasi Pembayaran') {
                              ?>

                               <div class="badge badge-info">Validasi Pembayaran</div>

                             <?php
                              } elseif ($l['ssm_status'] == 'Lunas') {

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

                           <td>

                             <?php
                              if ($l['ssm_status'] == 'Menunggu Pembayaran' || $l['ssm_status'] == 'Validasi Pembayaran') {
                              ?>

                               <a title="Detail Pembayaran Sertifikasi Mahasiswa" href="<?php echo base_url('validasipembayaransertifikasimahasiswa/detail/' . $l['ssm_id'] . '/' . $l['ssm_subsertifikasi'] . '/' . $l['ssm_sertifikasi_mahasiswa']) ?>" class="btn btn-info btn-sm mb-1"><i class="fas fa-eye"></i>&nbsp; Detail</a>

                               <a title="Set Status Lunas Pembayaran Sertifikasi Mahasiswa" href="<?php echo base_url('validasipembayaransertifikasimahasiswa/setLunas/' . $l['ssm_id'] . '/' . $l['ssm_subsertifikasi'] . '/' . $l['ssm_sertifikasi_mahasiswa']) ?>" onclick="return confirm('Apakah anda yakin ingin set Status Lunas?')" class="btn btn-success btn-sm mb-1"><i class="fas fa-check"></i>&nbsp; Set Lunas</a>

                               <a title="Set Status Tolak Pembayaran Sertifikasi Mahasiswa" href="javascript:;" data-id="<?php echo $l['ssm_id'] ?>" data-subsertifikasi="<?php echo $l['ssm_subsertifikasi'] ?>" data-mahasiswa="<?php echo $l['ssm_sertifikasi_mahasiswa'] ?>" data-toggle="modal" data-target="#exampleModal"><button type="button" class="btn btn-danger btn-sm mb-1">
                                   <i class="fas fa-times"></i>&nbsp; Set Tolak
                                 </button>
                               </a>

                             <?php
                              } else {
                              ?>
                               <a title="Detail Pembayaran Sertifikasi Mahasiswa" href="<?php echo base_url('validasipembayaransertifikasimahasiswa/detail/' . $l['ssm_id'] . '/' . $l['ssm_subsertifikasi'] . '/' . $l['ssm_sertifikasi_mahasiswa']) ?>" class="btn btn-info btn-sm mb-1"><i class="fas fa-eye"></i>&nbsp; Detail</a>

                             <?php
                              }
                              ?>

                             <?php if ($l['ssm_status'] == 'Lunas' && $l['ssm_totalbayar'] == NULL) { ?>
                               <a title="Isi total Pembayaran Sertifikasi" href="javascript:;" data-id="<?php echo $l['ssm_id'] ?>" data-subsertifikasi="<?php echo $l['ssm_subsertifikasi'] ?>" data-mahasiswa="<?php echo $l['ssm_sertifikasi_mahasiswa'] ?>" data-toggle="modal" data-target="#exampleModalTotal"><button type="button" class="btn btn-warning btn-sm mb-1">
                                   <i class="fas fa-money-check-alt"></i>&nbsp; Isi Total Bayar
                                 </button>
                               <?php } elseif ($l['ssm_status'] == 'Lunas' && $l['ssm_totalbayar'] != NULL) { ?>
                                 <a title="Cetak ROP" href="<?php echo base_url('validasipembayaransertifikasimahasiswa/cetak_rop/' . $l['ssm_id'] . '/' . $l['ssm_subsertifikasi'] . '/' . $l['ssm_sertifikasi_mahasiswa']) ?>" class="btn btn-primary btn-sm mb-1" target="_BLANK"><i class="fas fa-print"></i>&nbsp; Cetak ROP</a>
                               <?php } ?>
                           </td>
                         </tr>
                       <?php } ?>
                     </tbody>
                   </table>
                 </div>
                 <!-- /.card-body -->
               </form>
             </div>
             <!-- /.card -->
           </div>
           <!-- /.col -->
         </div>
         <!-- /.row -->
       </section>
       <!-- /.content -->

       <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Set Tolak</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <form action="<?php echo base_url('validasipembayaransertifikasimahasiswa/setTolak'); ?>" method="post">
               <div class="modal-body">
                 <input type="hidden" name="id_subsertifikasimahasiswa" class="form-control" id="id" value="">
                 <input type="hidden" name="subsertifikasi" id="subsertifikasi" class="form-control" value="">
                 <input type="hidden" name="mahasiswa" id="mahasiswa" class="form-control" value="">
                 <label>Keterangan</label>
                 <textarea class="form-control" rows="5" cols="5" name="keterangan"></textarea>
               </div>
               <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-danger">Set Tolak</button>
               </div>
             </form>
           </div>
         </div>
       </div>

       <div class="modal fade" id="exampleModalTotal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Input Total</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <form action="<?php echo base_url('validasipembayaransertifikasimahasiswa/inputtotal'); ?>" method="post">
               <div class="modal-body">
                 <input type="hidden" name="id_subsertifikasimahasiswa" class="form-control" id="id" value="">
                 <input type="hidden" name="subsertifikasi" id="subsertifikasi" class="form-control" value="">
                 <input type="hidden" name="mahasiswa" id="mahasiswa" class="form-control" value="">
                 <label>Total Biaya yang ditransfer</label>
                 <input type="text" name="total" class="form-control uang">
               </div>
               <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary">Simpan</button>
               </div>
             </form>
           </div>
         </div>
       </div>

       <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
       <script>
         $(document).ready(function() {
           // Untuk sunting
           $('#exampleModal').on('show.bs.modal', function(event) {
             var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
             var modal = $(this)

             // Isi nilai pada field
             modal.find('#id').attr("value", div.data('id'));
             modal.find('#subsertifikasi').attr("value", div.data('subsertifikasi'));
             modal.find('#mahasiswa').attr("value", div.data('mahasiswa'));
           });
         });
       </script>
       <script>
         $(document).ready(function() {
           // Untuk sunting
           $('#exampleModalTotal').on('show.bs.modal', function(event) {
             var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
             var modal = $(this)

             // Isi nilai pada field
             modal.find('#id').attr("value", div.data('id'));
             modal.find('#subsertifikasi').attr("value", div.data('subsertifikasi'));
             modal.find('#mahasiswa').attr("value", div.data('mahasiswa'));
           });
         });
       </script>
       <script type="text/javascript">
         $('.checked_all').on('change', function() {
           $('.checkbox').prop('checked', $(this).prop("checked"));
         });
         //deselect "checked all", if one of the listed checkbox product is unchecked amd select "checked all" if all of the listed checkbox product is checked
         $('.checkbox').change(function() { //".checkbox" change 
           if ($('.checkbox:checked').length == $('.checkbox').length) {
             $('.checked_all').prop('checked', true);
           } else {
             $('.checked_all').prop('checked', false);
           }
         });
       </script>