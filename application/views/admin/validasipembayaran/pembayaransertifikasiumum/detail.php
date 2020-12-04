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

              <div class="form-group">
                <label>Nama Sertifikasi</label>
                <input type="text" class="form-control" value="<?php echo $list->scert_subsertifikasi ?>" readonly>
              </div>

              <div class="form-group">
                <label>Nama Peserta</label>
                <input type="text" class="form-control" value="<?php echo $list->pu_nama ?>" readonly>
              </div>

              <div class="form-group">
                <label>Tanggal Daftar</label>
                <input type="text" class="form-control" value="<?php echo tgl_indo($list->ssu_tanggaldaftar) ?>" readonly>
              </div>

              <div class="form-group">
                <label>Bank</label>
                <input type="text" class="form-control" value="<?php echo $list->ssu_bank ?>" readonly>
              </div>

              <div class="form-group">
                <label>No. Rekening</label>
                <input type="text" class="form-control" value="<?php echo $list->ssu_norekening ?>" readonly>
              </div>

              <div class="form-group">
                <label>Nama Pemilik</label>
                <input type="text" class="form-control" value="<?php echo $list->ssu_namapemilik ?>" readonly>
              </div>

              <div class="form-group">
                <label>Bukti Transfer</label>
                <br>
                <img src="<?php echo base_url('assets/buktitransfersertifikasiumum/' . $list->ssu_bukti); ?>" width="30%">
              </div>

              <div class="form-group">
                <label>Status</label>
                <input type="text" class="form-control" value="<?php echo $list->ssu_status ?>" readonly>
              </div>

              <div class="form-group">
                <label>Keterangan</label>
                <input type="text" class="form-control" value="<?php echo $list->ssu_keteranganpembayaran ?>" readonly>
              </div>

              <a href="<?php echo base_url('validasipembayaransertifikasiumum') ?>" class="btn btn-secondary">Kembali</a>

              <?php 
              if($list->ssu_status == "Validasi Pembayaran")
              {
                ?>

                <a href="<?php echo base_url('validasipembayaransertifikasiumum/setLunas/' . $list->ssu_id . '/' .$list->ssu_subsertifikasi . '/' . $list->ssu_sertifikasi_umum) ?>" onclick="return confirm('Apakah anda yakin ingin set Status Lunas?')" class="btn btn-success">Set Lunas</a>

                <a href="javascript:;" data-id="<?php echo $list->ssu_id ?>" data-subsertifikasi="<?php echo $list->ssu_subsertifikasi ?>" data-peserta="<?php echo $list->ssu_sertifikasi_umum ?>" data-toggle="modal" data-target="#exampleModal"><button type="button" class="btn btn-danger">
                  Set Tolak
                </button>
              </a>

              <?php 
            }
            ?>

          </div>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
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
        <form action="<?php echo base_url('validasipembayaransertifikasiumum/setTolak'); ?>" method="post">
          <div class="modal-body">
            <input type="hidden" name="id_subsertifikasiumum" class="form-control" id="id" value="">
            <input type="hidden" name="subsertifikasi" id="subsertifikasi" class="form-control" value="">
            <input type="hidden" name="peserta" id="peserta" class="form-control" value="">
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

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script>
   $(document).ready(function() {
         // Untuk sunting
         $('#exampleModal').on('show.bs.modal', function (event) {
            var div            = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal          = $(this)

            // Isi nilai pada field
            modal.find('#id').attr("value",div.data('id'));
            modal.find('#subsertifikasi').attr("value",div.data('subsertifikasi'));
            modal.find('#peserta').attr("value",div.data('peserta'));
          });
       });
     </script>