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
               <form method="post" action="<?php echo base_url('validasipembayaranseminarumum/submit_checkall_setuju') ?>">
                 <div class="card-header">
                   <button type="submit" class="btn btn-success">Set Lunas </button>
                 </div>
                 <div class="card-body">
                   <table id="example1" class="table table-bordered table-striped">
                     <thead>
                       <tr>
                         <th><input type="checkbox" id="check_all" class="checked_all"></th>
                         <th>No</th>
                         <th>Nama Peserta</th>
                         <th>Nama Seminar</th>
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
                              if ($l->su_status == 'Menunggu Pembayaran') {

                              ?>

                             <?php

                              } elseif ($l->su_status == 'Lunas') {

                              ?>

                             <?php

                              } elseif ($l->su_status == 'Tolak') {
                              ?>
                             <?php
                              } else {
                              ?>
                               <input type="checkbox" name="umum[]" id="c<?php echo $l->su_peserta; ?>" class="checkbox" value="<?php echo $l->su_peserta; ?>">
                               <input type="hidden" name="seminar" id="c<?php echo $l->su_seminar; ?>" value="<?php echo $l->su_seminar; ?>">
                             <?php
                              }
                              ?>
                           </td>

                           <td><?php echo $no++ ?></td>
                           <td><?php echo $l->su_peserta ?></td>
                           <td><?php echo $l->smr_acara ?></td>
                           <td><?php echo date('d M Y', strtotime($l->su_tanggaldaftar)) ?></td>

                           <td>
                             <?php
                              if ($l->su_status == 'Menunggu Pembayaran') {
                              ?>
                               <div class="badge badge-warning">Menunggu Pembayaran</div>

                             <?php
                              } elseif ($l->su_status == 'Validasi Pembayaran') {
                              ?>

                               <div class="badge badge-info">Validasi Pembayaran</div>

                             <?php
                              } elseif ($l->su_status == 'Lunas') {

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
                              if ($l->su_status == 'Menunggu Pembayaran' || $l->su_status == 'Validasi Pembayaran') {
                              ?>

                               <a title="Detail Pembayaran Seminar Umum" href="<?php echo base_url('validasipembayaranseminarumum/detail/' . $l->su_seminar . '/' . $l->su_peserta) ?>" class="btn btn-info mb-1"><i class="fas fa-eye"></i>&nbsp; Detail</a>

                               <a title="Set Status Lunas Pembayaran Seminar Umum" href="<?php echo base_url('validasipembayaranseminarumum/setLunas/' . $l->su_seminar . '/' . $l->su_peserta) ?>" onclick="return confirm('Apakah anda yakin ingin set Status Lunas?')" class="btn btn-success mb-1"><i class="fas fa-check"></i>&nbsp; Set Lunas</a>

                               <a title="Set Status Tolak Seminar Umum" href="javascript:;" data-id="<?php echo $l->su_peserta ?>" data-seminar="<?php echo $l->su_seminar ?>" data-toggle="modal" data-target="#exampleModal"><button type="button" class="btn btn-danger mb-1">
                                   <i class="fas fa-times"></i>&nbsp; Set Tolak
                                 </button>

                               <?php
                              } else {
                                ?>
                                 <a title="Detail Pembayaran Seminar Umum" href="<?php echo base_url('validasipembayaranseminarumum/detail/' . $l->su_seminar . '/' . $l->su_peserta) ?>" class="btn btn-info mb-1"><i class="fas fa-eye"></i>&nbsp; Detail</a>

                               <?php
                              }
                                ?>

                               <?php if ($l->su_status == 'Lunas' && $l->su_totalbayar == NULL) { ?>
                                 <a title="Isi Total pembayaran Seminar umum" href="javascript:;" data-id="<?php echo $l->su_peserta ?>" data-seminar="<?php echo $l->su_seminar ?>" data-toggle="modal" data-target="#exampleModalTotal"><button type="button" class="btn btn-warning mb-1">
                                     <i class="fas fa-money-check-alt"></i>&nbsp; Isi Total Bayar
                                   </button>
                                 <?php } elseif ($l->su_status == 'Lunas' && $l->su_totalbayar != NULL) { ?>
                                   <a title="Cetak ROP" href="<?php echo base_url('Validasipembayaranseminarumum/cetak_rop/' . $l->su_peserta . '/' . $l->su_seminar) ?>" class="btn btn-primary mb-1" target="_BLANK"><i class="fas fa-print"></i>&nbsp; Cetak ROP</a>
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

       <!-- Modal -->
       <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Set Tolak</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <form action="<?php echo base_url('Validasipembayaranseminarumum/setTolak'); ?>" method="post">
               <div class="modal-body">
                 <input type="hidden" name="idpeserta" id="id" value="">
                 <input type="hidden" name="seminar" id="seminar" value="">
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

       <!-- Modal -->
       <div class="modal fade" id="exampleModalTotal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Input Total</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <form action="<?php echo base_url('Validasipembayaranseminarumum/inputtotal'); ?>" method="post">
               <div class="modal-body">
                 <input type="hidden" name="idpeserta" id="id" value="">
                 <input type="hidden" name="seminar" id="seminar" value="">
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
             modal.find('#seminar').attr("value", div.data('seminar'));
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
             modal.find('#seminar').attr("value", div.data('seminar'));
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