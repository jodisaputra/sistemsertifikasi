<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Sertifikat</title>
  <link href="https://fonts.googleapis.com/css2?family=Lusitana&display=swap" rel="stylesheet">

  <style>
    @page {
      size: 21cm 29cm;
      margin: 0;
      font-family: 'Lusitana', serif;
    }

    body {
      margin: 0px;
      background-image: url(<?php echo base_url('assets/template_sertifikat/' . $list->ms_sertifikat); ?>);
      background-repeat: no-repeat;
      font-family: 'Lusitana', serif;
    }
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body>

  <h1 align="center" style="font-size: 35px !important; text-align: center; margin-top: 200px;">Sertifikat</h1>

  <p align="center" style="text-align: center; font-size: 19px; margin-top: -15px; font-style: italic; margin-bottom: 0px;">Diberikan Kepada</p>

  <p align="center" style="text-align: center; font-size: 25px; font-weight: bold; margin-top: 40px;"><?php echo $list->pu_nama ?></p>

  <hr align="center" width="60%" style="margin-top: -10px;">

  <p align="center" style="text-align: center; font-size: 17px; margin-top: 10px; margin-bottom: 0px;">Atas Partisipasinya Sebagai</p>

  <h1 align="center" style="font-size: 30px !important; text-align: center; margin-top: 15px;">Peserta</h1>

  <p align="center" style="font-size: 17px; margin-top: 10px; margin-bottom: 0px;">Dalam Kegiatan</p>

  <h1 align="center" style="font-size: 25px !important; text-align: center; margin-top: 10px;"><?php echo $list->smr_acara ?></h1>

  <p align="center" style="text-align: center; font-size: 15px; margin-top: 20px; margin-bottom: 0px;">Batam, <?php echo date('d M Y', strtotime($list->smr_tanggal)) ?> </p>

  <p align="center" style="font-size: 15px; margin-top: 20px; margin-bottom: 0px;">Mengetahui, </p>

  <div style="text-align: center; margin-top: 12px;">
    <img width="15%" height="10%" src="<?php echo base_url('assets/tanda_tangan/' . $ttd->ns_tandatangan) ?>" alt="">
  </div>
  <p align="center" style="font-size: 15px; font-weight: bold; margin-bottom: 0px;"><?php echo $ttd->ns_gelardepan . ' ' . $ttd->ns_narasumber . ' ' .  $ttd->ns_gelarbelakang ?> </p>
  <hr align="center" width="30%" style="margin-top: 8px;">
  <p align="center" style="font-size: 15px; font-weight: bold; margin-bottom: 0px;"><?php echo $ttd->ns_sebagai ?> </p>

</body>

</html>