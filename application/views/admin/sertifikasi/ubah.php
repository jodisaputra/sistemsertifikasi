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
                <form method="post" action="<?php echo base_url() ?>sertifikasi/simpan_perubahan">

                  <input type="hidden" name="id_sertifikasi" value="<?php echo $list->cert_id ?>">

                  <div class="form-group">
                    <label for="nama">Nama Sertifikasi </label>
                    <input type="text" class="form-control" name="nama" value="<?php echo $list->cert_sertifikasi ?>">
                    <?php echo form_error('nama') ?>
                  </div>

                  <div class="form-group">
                    <label>Program Studi</label>
                    <select name="prodi" class="form-control">
                      <option value="">Pilih Salah Satu</option>

                      <option value="42" <?php if($list->cert_prodi == "42"){echo "selected";} ?>>Akuntansi</option>

                      <option value="12" <?php if($list->cert_prodi == "12"){echo "selected";} ?>>Arsitektur</option>

                      <option value="51" <?php if($list->cert_prodi == "51"){echo "selected";} ?>>Ilmu Hukum</option>

                      <option value="41" <?php if($list->cert_prodi == "41"){echo "selected";} ?>>Manajemen</option>

                      <option value="53" <?php if($list->cert_prodi == "53"){echo "selected";} ?>>Magister Manajemen</option>

                      <option value="52" <?php if($list->cert_prodi == "52"){echo "selected";} ?>>Magister Hukum</option>

                      <option value="55" <?php if($list->cert_prodi == "55"){echo "selected";} ?>>Pariwisata</option>
                      
                      <option value="56" <?php if($list->cert_prodi == "56"){echo "selected";} ?>>Pendidikan Bahasa Inggris</option>

                      <option value="31" <?php if($list->cert_prodi == "31"){echo "selected";} ?>>Sistem Informasi</option>

                      <option value="11" <?php if($list->cert_prodi == "11"){echo "selected";} ?>>Teknik Sipil</option>
                     
                      <option value="21" <?php if($list->cert_prodi == "21"){echo "selected";} ?>>Teknik Elektro</option>
                     
                      <option value="32" <?php if($list->cert_prodi == "32"){echo "selected";} ?>>Teknologi Informasi</option>
                      
                     
                    </select>
                    <?php echo form_error('prodi') ?>
                  </div>

                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option value="">Pilih Salah Satu</option>
                      <option value="y" <?php if($list->cert_isaktif == "y"){echo "selected";} ?>>Aktif</option>
                      <option value="n" <?php  if($list->cert_isaktif == "n"){echo "selected";} ?>>Non Aktif</option>
                    </select>
                    <?php echo form_error('status') ?>
                  </div>
                  
                  <button class="btn btn-success" type="submit">Ubah</button>
                  <a href="<?php echo base_url() ?>sertifikasi" class="btn btn-danger">Kembali</a>
                </form>
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