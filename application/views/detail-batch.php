 <!-- breadcrumb start-->
 <section class="breadcrumb breadcrumb_bg">
     <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <div class="breadcrumb_iner text-center">
                     <div class="breadcrumb_iner_item">
                         <h2><?php echo $batch->scert_subsertifikasi ?></h2>
                         <p>Home<span>/</span><?php echo $batch->scert_subsertifikasi ?></p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- breadcrumb start-->

 <!--================ Start Course Details Area =================-->
 <section class="course_details_area section_padding">
     <div class="container">
         <div class="row">
             <div class="col-lg-8 course_details_left mt-0">
                 <div class="content_wrapper">
                     <div class="content">
                         <?php echo $batch->bs_keterangan ?>
                     </div>
                 </div>
             </div>


             <div class="col-lg-4 right-contents">
                 <div class="sidebar_top">
                     <ul>
                         <li>
                             <?php $i = 1; ?>
                             <?php foreach ($pelatih as $p) { ?>
                                 <a class="justify-content-between d-flex">
                                     <p>Nama Pelatih <?php echo $i++; ?></p>
                                     <span class="color"><?php echo $p->ps_nama ?></span>
                                 </a>
                         </li>
                     <?php } ?>
                     <li>
                         <a class="justify-content-between d-flex">
                             <p>Tanggal Ujian </p>
                             <span><?php echo date('d M Y', strtotime($batch->js_tanggal)) ?></span>
                         </a>
                     </li>
                     <li>
                         <a class="justify-content-between d-flex">
                             <p>Waktu Ujian </p>
                             <span><?php echo $batch->js_mulai . ' - ' . $batch->js_selesai ?></span>
                         </a>
                     </li>

                     </ul>


                     <?php
                        if (!$this->session->userdata('npm') && !$this->session->userdata('email')) {
                        ?>

                         <a href="<?php echo base_url('batch_sertifikasi/daftar_mahasiswa/' . $batch->bs_id . '/' . $batch->bs_subsertifikasi . '/' . $batch->scert_sertifikasi) ?>" class="btn_1 d-block">Daftar Mahasiswa</a>

                         <a href="<?php echo base_url('batch_sertifikasi/daftar_umum/' . $batch->bs_id . '/' . $batch->bs_subsertifikasi . '/' . $batch->scert_sertifikasi); ?>" class="btn_1 d-block">Daftar Umum</a>

                     <?php
                        }
                        ?>

                     <?php
                        if ($this->session->userdata('npm')) {
                        ?>

                         <a href="<?php echo base_url('batch_sertifikasi/daftar_mahasiswa/' . $batch->bs_id . '/' . $batch->bs_subsertifikasi . '/' . $batch->scert_sertifikasi) ?>" class="btn_1 d-block" onclick="return confirm('Apakah anda yakin ingin mendaftar sebagai Peserta Mahasiswa ?')">Daftar Mahasiswa</a>

                     <?php
                        }
                        ?>


                     <?php
                        if ($this->session->userdata('email')) {
                        ?>

                         <a href="<?php echo base_url('batch_sertifikasi/daftar_umum/' . $batch->bs_id . '/' . $batch->bs_subsertifikasi . '/' . $batch->scert_sertifikasi); ?>" class="btn_1 d-block" onclick="return confirm('Apakah anda yakin ingin mendaftar sebagai Peserta Umum ?')">Daftar Umum</a>

                     <?php
                        }
                        ?>

                 </div>
             </div>
         </div>
     </div>
 </section>
 <!--================ End Course Details Area =================-->