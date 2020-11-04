<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Sertifikat</title>
  <style>
        @page { 
            size: 19.8cm 13cm;
            margin: 0; 
        }
        body {
          margin: 0px;
          background-image: url(<?php echo base_url('assets/template_sertifikat/' . $list->ms_sertifikat); ?>);
          background-repeat: no-repeat;
          background-position: center;
        }
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body>

    <h1 style="font-size: 30px !important; text-align: center; margin-top: 45px; margin-left: 40px;">Sertifikat</h1>
        
    <p style="text-align: center; font-size: 19px; margin-top: 3px; font-style: italic; margin-left: 40px; margin-bottom: 0px;">Diberikan Kepada</p>
    
    <p style="text-align: center; font-size: 25px; font-weight: bold; margin-top: 14px; margin-left: 65px;"><?php echo $profil->name ?></p>
    
    <hr width="70%" style="margin-left:20% !important; margin-top: -10px;">

    <p style="text-align: center; font-size: 17px; margin-top: -2px; margin-left: 40px; margin-bottom: 0px;">Atas Partisipasinya Sebagai</p>

    <h1 style="font-size: 30px !important; text-align: center; margin-top: -12px; margin-left: 30px;">Peserta</h1>

    <p style="text-align: center; font-size: 17px; margin-top: -2px; margin-left: 30px; margin-bottom: 0px;">Dalam Kegiatan</p>

    <h1 style="font-size: 25px !important; text-align: center; margin-top: -12px; margin-left: 30px;"><?php echo $list->smr_acara ?></h1>

    <p style="text-align: center; font-size: 15px; margin-top: -2px; margin-left: 40px; margin-bottom: 0px;">Batam, <?php echo date('d M Y',strtotime($list->smr_tanggal)) ?> </p>
    <p style="text-align: center; font-size: 15px; margin-top: 4px; margin-left: 40px; margin-bottom: 0px;">Mengetahui, </p>

    <hr width="50%" style="margin-left: 190px; margin-top: 45px;">
    <p style="text-align: center; font-size: 15px; font-weight: bold; margin-top: 4px; margin-left: 40px; margin-bottom: 0px;">Yefta Christian S.Kom </p>

</body>

</html>