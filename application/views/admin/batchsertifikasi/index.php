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
                <a href="<?php echo base_url() ?>batch_sertifikasi/tambah" class="btn btn-success">Tambah Batch Sertifikasi</a>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Sub Sertifikasi</th>
                      <th>Mulai Daftar</th>
                      <th>Akhir Daftar</th>
                      <th>Jumlah Max</th>
                      <th width="30%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                   $no = 1;
                   foreach ($batch as $b) { ?>
                     <tr>
                       <td><?php echo $no++ ?></td>
                       <td><?php echo $b->scert_subsertifikasi ?></td>
                       <td><?php echo date('d m Y', strtotime($b->bs_mulai_daftar)) ?></td>
                       <td><?php echo date('d m Y', strtotime($b->bs_terakhir_daftar)) ?></td>
                       <td><?php echo $b->bs_jumlahmax ?></td>
                       <td class="text-center">
                         <a href="<?php echo base_url('batch_sertifikasi/detail/' . $b->bs_id) ?>" class="btn btn-info btn-sm">Detail</a>
                         
                         <a href="<?php echo base_url('batch_sertifikasi/ubah/' . $b->bs_id) ?>" class="btn btn-warning btn-sm">Ubah</a>
                         
                         <a href="<?php echo base_url('batch_sertifikasi/delete/' . $b->bs_id) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus</a>
                         
                          <a href="<?php echo base_url('pelatih_subsertifikasi/list_pelatih/' . $b->bs_id) ?>" class="btn btn-secondary btn-sm mt-2 btn-block">Input Pelatih Sertifikasi</a>

                         <a href="<?php echo base_url('input_nilai_sertifikasi/nilai_umum/' . $b->bs_id) ?>" class="btn btn-primary btn-sm mt-2 btn-block">Input Nilai Peserta Umum</a>
                         
                         <a href="<?php echo base_url('input_nilai_sertifikasi/nilai_mahasiswa/' . $b->bs_id) ?>" class="btn btn-primary btn-sm mt-2 btn-block">Input Nilai Peserta Mahasiswa</a>
                         
                         <a href="<?php echo base_url('Absen_sertifikasi/absen_pertemuan/' . $b->bs_id) ?>" class="btn btn-warning btn-sm mt-2 btn-block">Lihat Pertemuan</a>

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