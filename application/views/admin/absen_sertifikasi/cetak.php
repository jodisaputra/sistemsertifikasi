<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Absensi Sertifikasi - Sistem Sertifikasi</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/cetak/print.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
</head>

<body>
    <div id="common">
        <div id="page-khs">

            <div class="header-khs">
                <img src="<?php echo base_url('assets/cetak/logo.jpg') ?>" alt="">
                <h1>UNIVERSITAS INTERNASIONAL BATAM</h1>
            </div>

            <h2 style="margin-top: 10px; text-align: left;">Absensi <?php echo $row->scert_subsertifikasi ?></h2>

            <table width="677" class="table-common">
                <tr>
                    <td width="130">Nama Kegiatan</td>
                    <td width="1">:</td>
                    <td><?php echo $row->as_nama_absen ?></td>
                </tr>
                <tr>
                    <td>Tanggal Pelaksanaan</td>
                    <td>:</td>
                    <td><?php echo date('d M Y', strtotime($row->as_tanggal)) ?></td>
                </tr>
            </table>

            <table width="100%" class="table-khs">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Nama Peserta</th>
                        <th colspan="3">Status Kehadiran</th>
                    </tr>
                    <tr>
                        <th>Hadir</th>
                        <th>Tidak Hadir</th>
                        <th>Izin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;  ?>
                    <?php foreach ($listabsen as $l) : ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $nama[$l->aps_peserta] ?></td>
                            <td>
                                <?php if ($l->aps_ishadir == 'y') { ?>
                                    <i class="fas fa-check"></i>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if ($l->aps_ishadir == 'n') { ?>
                                    <i class="fas fa-check"></i>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if ($l->aps_ishadir == 'i') { ?>
                                    <i class="fas fa-check"></i>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <br>
            <p>Keterangan : <?php echo $row->as_catatan ?></p>
        </div>
    </div>
</body>

</html>