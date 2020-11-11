<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PHPMailer_Lib
{
  public function __construct()
  {
    log_message('Debug', 'PHPMailer class is loaded.');
  }

  public function load()
  {
    // Include PHPMailer library files
    require_once APPPATH . 'third_party/PHPMailer/Exception.php';
    require_once APPPATH . 'third_party/PHPMailer/PHPMailer.php';
    require_once APPPATH . 'third_party/PHPMailer/SMTP.php';

    $mail = new PHPMailer(TRUE);
    $mail->isSMTP();
    // $mail->Host = "smtp.office365.com";
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = TRUE;
    $mail->SMTPSecure = 'tls';
    // $mail->Username = 'noreply@uib.ac.id';
    $mail->Username = 'noreply.uib.ac.id@gmail.com';
    $mail->Password = 'Qwerty123$%^';
    $mail->Port = 587;
    // $mail->Port = 465;
    return $mail;
  }
}
