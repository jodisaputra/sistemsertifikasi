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

                    <div class="form-group">
                        <label>Nama Seminar *</label>
                        <input type="text" class="form-control" name="nama_seminar" value="<?php echo $seminar->smr_acara ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Pelaksanaan *</label>
                        <input type="date" class="form-control" name="tanggal_pelaksanaan" value="<?php echo $seminar->smr_tanggal ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Tempat Pelaksanaan *</label>
                        <input type="text" class="form-control" name="tempat_pelaksanaan" value="<?php echo $seminar->smr_tempat ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Jam Mulai *</label>
                        <input type="time" class="form-control" name="jam_mulai" value="<?php echo $seminar->smr_jam_mulai ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Jam Selesai *</label>
                        <input type="time" class="form-control" name="jam_selesai" value="<?php echo $seminar->smr_jam_selesai ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Nama Moderator *</label>
                        <input type="text" class="form-control" name="nama_moderator" value="<?php echo $seminar->smr_moderator ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Biaya Mahasiswa *</label>
                        <input type="text" class="form-control" name="biaya_mhs" value="<?php echo $seminar->smr_biaya_mhs ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Biaya Umum *</label>
                        <input type="text" class="form-control" name="biaya_umum" value="<?php echo $seminar->smr_biaya_umum ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Link Online</label>
                        <input type="text" class="form-control" name="link" value="<?php echo $seminar->smr_link_online ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Max Peserta *</label>
                        <input type="text" class="form-control" name="jumlah_max_peserta" value="<?php echo $seminar->smr_jumlahmax ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Banner</label>
                        <br>
                        <img width="20%" src="<?php echo base_url('assets/banner_seminar/' . $seminar->smr_banner); ?>">
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control cust_sumnote" rows="10" cols="80" readonly><?php echo $seminar->smr_keterangan ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Model Sertifikat</label>
                        <br>
                        <img src="<?php echo base_url('assets/template_sertifikat/' . $seminar->ms_sertifikat) ?>" class="img-fluid w-25">
                    </div>

                    <a href="<?php echo base_url('seminar') ?>" class="btn btn-danger">Kembali</a>
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