<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuitansi</title>
    <style rel="stylesheet" type="text/css" title="Default" media="all">
        @page size-A4 {
            size: 21.0cm 29.7cm;
            margin: 1.5cm;
        }

        .header {
            top: 0px;
            font-size: 9px;
            font-weight: bold;
            text-align: right;
        }

        body {
            font-family: Times New Roman;
        }

        /*table, th, td {
			border: 1px solid black;
			padding: 5px;
		}

		table {
			border-collapse: collapse;
			font-size: 9px;
		}
		*/
        @media print {
            .bgcol {
                background-color: #999;
            }
        }

        .content td {
            border: 1px solid #666666;
            margin: 0px 0px 0px 0px;
            padding: 2px 6px 2px 4px;
        }

        .table-common {
            border: none;
            font-size: 11px;
            border-collapse: collapse;
            margin: 30px 0px 20px 0px;
            padding: 0px 0px 0px 0px;
        }

        .table-common th {
            font-weight: bold;
            text-align: left;
            vertical-align: top;
            margin: 0px 0px 0px 0px;
            padding: 0px 20px 3px 0px;
        }

        .table-common td {
            vertical-align: top;
            margin: 0px 0px 0px 0px;
            padding: 0px 15px 3px 0px;
        }
    </style>
</head>

<body>
    <div style="padding: 0.5cm 0.5cm; margin: 0px auto 0px 10px;">
        <div style="width:100%;margin-left:-10px;text-align:left;font-size: 7pt; display: inline-block;">
            <img style="width:7.5%; padding-right: 10px;" src="./assets/img/logo.png">
            <div style="width:90%;display: inline-block;">
                Universitas Internasional Batam<br>
                Biro Administrasi Keuangan<br>
                Jl. Gajah Mada, Baloi, Sei Ladi, Batam<br>
                (+62) 778-7437111, ext:121 / finance@uib.ac.id
            </div>
        </div>


        <table class="table-common" style="width: 100%">
            <tr>
                <td colspan="4" style="text-align: center">
                    <center>
                        <h3><strong>RECEIPT OF PAYMENT</strong></h3>
                    </center>
                </td>
            </tr>
            <tr>
                <td style="width:40%"></td>
                <td style="width:15%">ROP number</td>
                <td style="width:1%">:</td>
                <td style="width:40%"><?php echo $id . '/X/ROP-TR/KEU/UIB/2020' ?></td>
            </tr>
            <tr>
                <td style="width:40%"></td>
                <td style="width:15%">Date</td>
                <td style="width:1%">:</td>
                <td style="width:40%"><?php echo date('d/m/Y') ?></td>
            </tr>
        </table>

        <table class="table-common" style="width: 100%;align-self:left;">
            <tr>
                <td style="width:19%">Nama</td>
                <td style="width:1%">:</td>
                <td style="width:80%"><?php echo $nama[$npm]['nama'] ?></td>
            </tr>
            <tr>
                <td style="width:19%">NPM</td>
                <td style="width:1%">:</td>
                <td style="width:80%"><?php echo $npm ?></td>
            </tr>
            <tr>
                <td style="width:19%">Program Studi</td>
                <td style="width:1%">:</td>
                <td style="width:80%"><?php echo $nama[$npm]['prodi'] ?></td>
            </tr>
            <tr>
                <td style="width:19%">Pembayaran Untuk</td>
                <td style="width:1%">:</td>
                <td style="width:80%">Transfer Pembayaran Seminar</td>
            </tr>
            <tr>
                <td style="width:19%">Diterima Dari</td>
                <td style="width:1%">:</td>
                <td style="width:80%"><?php echo $diterima_dari ?></td>
            </tr>
            <tr>
                <td style="width:19%">Bank</td>
                <td style="width:1%">:</td>
                <td style="width:80%"><?php echo $bank ?></td>
            </tr>
            <tr>
                <td style="width:19%">Total</td>
                <td style="width:1%">:</td>
                <td style="width:80%"><?php echo $total_dana ?></td>
            </tr>
            <tr>
                <td style="width:19%">Total Terbilang</td>
                <td style="width:1%">:</td>
                <td style="width:80%"><?php echo $terbilang ?> Rupiah</td>
            </tr>
        </table>
        <table class="table-common" style="width: 100%">
            <tr>
                <td style="width: 80%"></td>
                <td style="text-align: center;width: 20%">Received By,</td>
            </tr>
            <tr>
                <td style="width: 80%"></td>
                <td style="height: 50px;width: 20%"></td>
            </tr>
            <tr>
                <td style="width: 80%"></td>
                <td style="text-align: center;width: 20%">&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;</td>
            </tr>
            <tr>
                <td style="width: 80%"></td>
                <td style="text-align: center;width: 20%">Finance Departement</td>
            </tr>
        </table>

        <!-- 	<div style="width:100%;margin-left:-10px;text-align:center;font-size: 9pt;color:black;">

			<h1><strong>RECEIPT OF PAYMENT</strong></h1>
		</div> -->

        <!-- <br />

		<div id="letter-header" style="width:100%;margin-left:-10px;text-align:right;font-size: 9pt;color:black;">

			ROP Number &nbsp; :&nbsp; 0/X/ROP-TR/KEU/UIB/2020<br/>
			Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;<?php echo date('d/m/Y') ?><br />
			<br />    
		</div>

		<div id="letter-content" style="width:100%;margin-left:-10px;text-align:justify;font-size: 9pt;color:black;">

			Nama : Test<br/>
			NIK : Test<br/>
			Departement : Test<br/>
			For Payment Of : Test<br/>
			Received from : Test<br/>
			Bank : Test<br/>
			Transfer Date : Test<br/>
			Amount : Test<br/>
			Amount in Word : Test<br/>
			<br>
			<br>
			
			<br/>
			<br /><br />
			<table class="table-common" width="100%">
				<tr>
					<td style="text-align: center;width: 100px"></td>
					<td style="text-align: center;width: 100px"></td>
					<td style="text-align: center;width: 20px">Received By,</td>
				</tr>
				<tr>
					<td style="height: 50px;width: 100px"></td>
					<td style="height: 50px;width: 100px"></td>
					<td style="height: 50px;width: 20px"></td>
				</tr>
				<tr>
					<td style="text-align: center;width: 100px"></td>
					<td style="text-align: center;width: 100px"></td>
					<td style="text-align: center;width: 20px">&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;</td>
				</tr>
				<tr>
					<td style="text-align: center;width: 100px"></td>
					<td style="text-align: center;width: 100px"></td>
					<td style="text-align: center;width: 20px">Finance Departement</td>
				</tr>
			</table>
		</div> -->

    </div>
</body>

</html>
<!-- END Format Cetak Tagihan -->