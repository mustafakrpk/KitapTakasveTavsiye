<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



$mail_kullaniciAdi = $_POST['fullname'];
$mail_kullaniciMailAdresi = $_POST['email'];
$mail_konu = $_POST['subject'];
$mail_kullaniciMesaji = $_POST['message'];
$telefon = $_POST['phone'];

$mail_gönderilecekVeri = "\nMüşteri Adı - Soyadı  :" . $mail_kullaniciAdi . "\n
                        Müşteri Mail Adresi : " . $mail_kullaniciMailAdresi . "\n
                        Müşteri Mesaj Başlığı  : " . $mail_konu . "\n
                        Mesaj : " . $mail_kullaniciMesaji . "\n
                        Telefon : " . $telefon . "\n";


$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->CharSet = "utf-8";
$mail->SMTPSecure = "tls";
$mail->Port = 465;
$mail->Host = "ssl://smtp.gmail.com";
$mail->Username = "muskirp42@gmail.com";
$mail->Password = "kxlmirptolxmhjhw";
$mail->addAddress("muskirp42@gmail.com");
$mail->Subject = 'Kitap takas iletişim';

$mail->Body = $mail_gönderilecekVeri;


$mail->Send();
echo "Mail Gönderildi.";
header("Refresh: 1; url=http://localhost/kitabimm/contact.html");