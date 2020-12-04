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
              <div class="card-body">
                <form method="post" action="<?php echo base_url('liststatusbayar/cari') ?>">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label>Nama Sertifikasi</label>
                        <select class="form-control" name="nama_sertifikasi">
                          <option value="">Pilih Salah Satu</option>
                          <?php  
                          foreach($sertifikasi as $s)
                          {
                          ?>
                          <option value="<?php echo $s->scert_id ?>" <?php echo set_value('nama_sertifikasi') == $s->scert_id ? 'selected' : null ?>><?php echo $s->scert_subsertifikasi ?></option>
                          <?php  
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label>Status Pembayaran</label>
                        <select class="form-control" name="status_pembayaran">
                          <option value="">Pilih Salah Satu</option>
                          <option value="Menunggu Pembayaran" <?php echo set_value('status_pembayaran') == 'Menunggu Pembayaran' ? 'selected' : null ?>>Menunggu Pembayaran</option>
                          <option value="Validasi Pembayaran" <?php echo set_value('status_pembayaran') == 'Validasi Pembayaran' ? 'selected' : null ?>>Validasi Pembayaran</option>
                          <option value="Lunas" <?php echo set_value('status_pembayaran') == 'Lunas' ? 'selected' : null ?>>Lunas</option>
                          <option value="Tolak" <?php echo set_value('status_pembayaran') == 'Tolak' ? 'selected' : null ?>>Tolak</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-4">
                      <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> &nbsp;Cari</button>
                      <a href="<?php echo base_url('liststatusbayar/mahasiswa') ?>" class="btn btn-danger"><i class="fas fa-times"></i> &nbsp;Reset Filter</a>
                    </div>  
                  </div>
                </form>
              </div>
            </div>
           </div>
         </div>
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

                               <div class="badge badge-info">Menunggu Validasi Pembayaran</div>

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