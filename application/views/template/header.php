<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sertifikasi | Universitas Internasional Batam</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/frontend/css/bootstrap.min.css">
    <!-- animate CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/frontend/css/animate.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/frontend/css/owl.carousel.min.css">
    <!-- themify CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/frontend/css/themify-icons.css">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/frontend/css/flaticon.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/frontend/css/magnific-popup.css">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/frontend/css/slick.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/frontend/css/style.css">

    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />

    <!-- Sweetalert -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/sweetalert/sweetalert2.css">
</head>

<body>
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="<?php echo base_url() ?>"> <img src="<?php echo base_url() ?>assets/img/uib.png" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item justify-content-end" id="navbarSupportedContent">
                            <ul class="navbar-nav align-items-center">

                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url('home') ?>">Beranda</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url() ?>#sertifikasi">Sertifikasi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url() ?>#seminar">Seminar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="https://sertifikasi.uib.ac.id/">Berita</a>
                                </li>

                                <?php

                                if ($this->session->userdata('npm')) {

                                ?>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Akun </a>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="<?php echo base_url() ?>akun_mahasiswa/akun"><?php echo $this->session->userdata('nama') ?></a>
                                            <a class="dropdown-item" href="<?php echo base_url() ?>logout">Logout</a>
                                        </div>
                                    </li>

                                <?php

                                } elseif ($this->session->userdata('email')) {

                                ?>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Akun </a>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="<?php echo base_url() ?>akun_umum/akun"><?php echo $this->session->userdata('nama') ?></a>
                                            <a class="dropdown-item" href="<?php echo base_url() ?>logout">Logout</a>
                                        </div>
                                    </li>


                                <?php

                                } else {

                                ?>

                                    <li class="d-none d-lg-block">
                                        <a class="btn_1" href="<?php echo base_url() ?>home/login">Masuk</a>
                                    </li>

                                <?php
                                }
                                ?>

                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header part end-->