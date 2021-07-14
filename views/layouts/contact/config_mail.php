<?php

require(ROOT . "/assets/vendor/PHPMailer/src/PHPMailer.php");
require(ROOT . "/assets/vendor/PHPMailer/src/SMTP.php");
require(ROOT . "/assets/vendor/PHPMailer/src/Exception.php");

$mail = new PHPMailer\PHPMailer\PHPMailer();

//Server settings
$mail->SMTPDebug  = false;
$mail->isSMTP();
$mail->Host       = 'smtp.gmail.com';
$mail->SMTPAuth   = true;
$mail->Username   = 'nhblong1234@gmail.com';
$mail->Password   = '@Long192797';
$mail->SMTPSecure = 'tls';
$mail->Port       = 587;

//Recipients
$mail->addAddress('nhblong1234@gmail.com', 'Admin');