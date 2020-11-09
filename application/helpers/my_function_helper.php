<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// Fungsi untuk membuat tanggal dengan format Indonesia
function tgl_indo($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = getBulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

// Fungsi untuk membuat bulan dengan format Indonesia
function getBulan($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}

//untuk menampilkan gambar soal
function tampil_gambar($file)
{
    $result = '';

    $pecah_file = explode(".", $file);
    $eks = end($pecah_file);

    $eks_image = array("jpeg", "jpg", "gif", "bmp", "png");

    if (!in_array($eks, $eks_image)) {
        $result .= '';
    } else {
        if (in_array($eks, $eks_image)) {
            if (is_file("./" . $file)) {
                $result .= '<img width=100%" src="' . base_url() . $file . '" class="mb-4">';
            } else {
                $result .= '';
            }
        }
    }


    return $result;
}

// Fungsi untuk melakukan input data	
function inputtext($name, $table, $field, $primary_key, $selected)
{
    $ci = get_instance();
    $data = $ci->db->get($table)->result();
    foreach ($data as $t) {
        if ($selected == $t->$primary_key) {
            $txt = $t->$field;
        }
    }
    return $txt;
}

// Fungsi untuk menampilkan data dalam bentuk combobox
function combobox($name, $table, $field, $primary_key, $selected)
{
    $ci = get_instance();
    $cmb = "<select name='$name' class='form-control'>";
    $data = $ci->db->get($table)->result();
    $cmb .= "<option value=''>-- PILIH --</option>";
    foreach ($data as $d) {
        $cmb .= "<option value='" . $d->$primary_key . "'";
        $cmb .= $selected == $d->$primary_key ? "selected='selected'" : '';
        $cmb .= ">" . strtoupper($d->$field) . "</option>";
    }
    $cmb .= "</select>";
    return $cmb;
}

//fungsi SEO
function seo_title($s)
{
    $c = array(' ');
    $d = array('-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']', '{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+');

    $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d

    $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
    return $s;
}
// Fungsi Terbilang
function terbilang($num, $dec = 4)
{
    $stext = array(
        "Nol",
        "Satu",
        "Dua",
        "Tiga",
        "Empat",
        "Lima",
        "Enam",
        "Tujuh",
        "Delapan",
        "Sembilan",
        "Sepuluh",
        "Sebelas"
    );
    $say  = array(
        "Ribu",
        "Juta",
        "Milyar",
        "Triliun",
        "Biliun", // remember limitation of float
        "--apaan---" ///setelah biliun namanya apa?
    );
    $w = "";

    if ($num < 0) {
        $w  = "Minus ";
        //make positive
        $num *= -1;
    }

    $snum = number_format($num, $dec, ",", ".");
    // die($snum);
    $strnum =  explode(".", substr($snum, 0, strrpos($snum, ",")));
    //parse decimalnya
    $koma = substr($snum, strrpos($snum, ",") + 1);

    $isone = substr($num, 0, 1)  == 1;
    if (count($strnum) == 1) {
        $num = $strnum[0];
        switch (strlen($num)) {
            case 1:
            case 2:
                if (!isset($stext[$strnum[0]])) {
                    if ($num < 19) {
                        $w .= $stext[substr($num, 1)] . " Belas";
                    } else {
                        $w .= $stext[substr($num, 0, 1)] . " Puluh " .
                            (intval(substr($num, 1)) == 0 ? "" : $stext[substr($num, 1)]);
                    }
                } else {
                    $w .= $stext[$strnum[0]];
                }
                break;
            case 3:
                $w .=  ($isone ? "Seratus" : terbilang(substr($num, 0, 1)) .
                    " Ratus") .
                    " " . (intval(substr($num, 1)) == 0 ? "" : terbilang(substr($num, 1)));
                break;
            case 4:
                $w .=  ($isone ? "Seribu" : terbilang(substr($num, 0, 1)) .
                    " Ribu") .
                    " " . (intval(substr($num, 1)) == 0 ? "" : terbilang(substr($num, 1)));
                break;
            default:
                break;
        }
    } else {
        $text = $say[count($strnum) - 2];
        $w = ($isone && strlen($strnum[0]) == 1 && count($strnum) <= 3 ? "Satu " . strtolower($text) : terbilang($strnum[0]) . ' ' . $text);
        array_shift($strnum);
        $i = count($strnum) - 2;
        foreach ($strnum as $k => $v) {
            if (intval($v)) {
                $w .= ' ' . terbilang($v) . ' ' . ($i >= 0 ? $say[$i] : "");
            }
            $i--;
        }
    }
    $w = trim($w);
    if ($dec = intval($koma)) {
        $w .= " Koma " . terbilang($koma);
    }
    return trim(ucwords($w));
}
