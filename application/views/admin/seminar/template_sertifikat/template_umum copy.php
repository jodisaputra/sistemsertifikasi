<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Sertifikat</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>@page { size: A5 landscape }</style>

  <!-- Custom styles for this document -->
  <link href='https://fonts.googleapis.com/css?family=Tangerine:700' rel='stylesheet' type='text/css'>
  <style>
    body   { font-family: cursive }
    h1     { font-family: cursive; font-size: 40pt; line-height: 18mm}
    h2, h3 { font-family: cursive; font-size: 24pt; line-height: 7mm }
    h4     { font-size: 32pt; line-height: 14mm }
    h2 + p { font-size: 18pt; line-height: 7mm }
    h3 + p { font-size: 14pt; line-height: 7mm }
    li     { font-size: 11pt; line-height: 5mm }

    h1      { margin: 0 }
    h1 + ul { margin: 2mm 0 5mm }
    h2, h3  { margin: 0 3mm 3mm 0; float: left }
    h2 + p,
    h3 + p  { margin: 0 0 3mm 50mm }
    h4      { margin: 2mm 0 0 50mm; border-bottom: 2px solid black }
    h4 + ul { margin: 5mm 0 0 50mm }
    article { border: 4px double black; padding: 5mm 10mm; border-radius: 3mm }
    
    #background {
      background-size: cover;
      background-repeat: no-repeat;
      background-image: url(<?php echo base_url('assets/template_sertifikat/' . $list->ms_sertifikat); ?>);
    }
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A5 landscape">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section id="background" class="sheet padding-20mm">
        
        <h1 style="font-size: 30px !important; text-align: center; margin-top: 45px; margin-left: 40px;">Sertifikat</h1>
        
        <p style="text-align: center; font-size: 19px; margin-top: 3px; font-style: italic; margin-left: 40px; margin-bottom: 0px;">Diberikan Kepada</p>
        
        <p style="text-align: center; font-size: 25px; font-weight: bold; margin-top: 14px; margin-left: 65px;"><?php echo $list->pu_nama ?></p>
        
        <hr width="70%" style="margin-left: 120px; margin-top: -10px;">

        <p style="text-align: center; font-size: 17px; margin-top: -2px; margin-left: 40px; margin-bottom: 0px;">Atas Partisipasinya Sebagai</p>

        <h1 style="font-size: 30px !important; text-align: center; margin-top: -12px; margin-left: 30px;">Peserta</h1>

        <p style="text-align: center; font-size: 17px; margin-top: -2px; margin-left: 30px; margin-bottom: 0px;">Dalam Kegiatan</p>

        <h1 style="font-size: 25px !important; text-align: center; margin-top: -12px; margin-left: 30px;"><?php echo $list->smr_acara ?></h1>

        <p style="text-align: center; font-size: 15px; margin-top: -2px; margin-left: 40px; margin-bottom: 0px;">Batam, <?php echo date('d M Y',strtotime($list->smr_tanggal)) ?> </p>
        <p style="text-align: center; font-size: 15px; margin-top: 4px; margin-left: 40px; margin-bottom: 0px;">Mengetahui, </p>

        <hr width="45%" style="margin-left: 190px; margin-top: 45px;">
        <p style="text-align: center; font-size: 15px; font-weight: bold; margin-top: 4px; margin-left: 40px; margin-bottom: 0px;"> </p>

  </section>

</body>

</html>
