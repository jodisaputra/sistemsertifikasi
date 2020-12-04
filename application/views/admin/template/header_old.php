<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Admin | Sertifikasi</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/dist/css/adminlte.min.css">
  <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/dist/css/custom.css"> -->
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Sweetalert -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/sweetalert/sweetalert2.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Summernote -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/summernote/summernote-bs4.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo base_url() ?>assets/img/logo.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a class="d-block"><?php echo $this->session->userdata('nama'); ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
              <a href="<?php echo base_url() ?>dashboard" class="nav-link <?php echo ($this->uri->segment(1) == 'dashboard') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <!--   <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Active Page</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inactive Page</p>
                  </a>
                </li>
              </ul>
            </li> -->

            <?php


            $this->db->from('ssc_user');
            $this->db->join('ssc_user_group', 'ssc_user_group.ug_id = ssc_user.usr_group');
            $this->db->join('ssc_modul_group', 'ssc_modul_group.mg_usergroup = ssc_user.usr_group');
            $this->db->join('ssc_modul', 'ssc_modul.mdl_id = ssc_modul_group.mg_modul');
            $this->db->where('usr_email', $this->session->userdata('username'));
            $this->db->where('mdl_mainmenu', 0);
            $this->db->order_by('mdl_mainmenu', 'ASC');
            $main_menu = $this->db->get()->result();

            foreach ($main_menu as $main) {
              $this->db->from('ssc_user');
              $this->db->join('ssc_user_group', 'ssc_user_group.ug_id = ssc_user.usr_group');
              $this->db->join('ssc_modul_group', 'ssc_modul_group.mg_usergroup = ssc_user.usr_group');
              $this->db->join('ssc_modul', 'ssc_modul.mdl_id = ssc_modul_group.mg_modul');
              $this->db->where('usr_email', $this->session->userdata('username'));
              $this->db->where('mdl_mainmenu', $main->mdl_id);
              $this->db->order_by('ssc_modul.mdl_id', 'ASC');
              $menu = $this->db->get()->result();

              if ($menu) {
                echo
                  '<li class="nav-item has-treeview ' . ($this->uri->segment(1) == $main->mdl_link ? 'menu-open' : '') . '"><a href="" class="nav-link ' . ($this->uri->segment(1) == $main->mdl_link ? 'active' : '') . '">
                    <i class="nav-icon ' . $main->mdl_icon . '"></i>
                      <p>
                        ' . $main->mdl_modul . '
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>';

                foreach ($menu as $m) {
                  echo '
                      <ul class="nav nav-treeview">
                       <li class="nav-item">
                          <a href="' . base_url() . $m->mdl_link . '" class="nav-link ' . ($this->uri->segment(1) == $m->mdl_link ? 'active' : '') . '">
                            <i class="' . $m->mdl_icon . ' nav-icon"></i>
                            <p>' . $m->mdl_modul . '</p>
                          </a>
                        </li>
                      </ul>';
                }
              }
            }


            ?>

            <li class="nav-item">
              <a href="<?php echo base_url() ?>auth/logout" class="nav-link">
                <i class="fas fa-sign-out-alt nav-icon text-danger"></i>
                <p>
                  Logout
                </p>
              </a>
            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">