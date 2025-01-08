<?php
define('E_HOST', 'smtp...');
define('E_USER', 'postmaster@');
define('E_PASSWORD', '');
define('E_PORT', '465');
define('E_FROM_MAIL', 'postmaster@');
define('E_FROM_TEXT', 'EP TMV');

$mail->isSMTP();
//$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Host       = E_HOST;
$mail->SMTPAuth   = true;
$mail->Username   = E_USER;
$mail->Password   = E_PASSWORD;
$mail->SMTPSecure = 'ssl';
$mail->Port       = E_PORT;
$mail->CharSet = 'UTF-8';
$mail->isHTML(true);
//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->setFrom(E_FROM_MAIL, E_FROM_TEXT);

//$mail->AddEmbeddedImage($_SERVER[ 'DOCUMENT_ROOT'] . APP_MANUFATURER, 'kms');
//$mail->AddEmbeddedImage($_SERVER[ 'DOCUMENT_ROOT'] . APP_LOGO, 'logo');

$mail->AddEmbeddedImage($_SERVER[ 'DOCUMENT_ROOT'] . "/img/miticka_logo.png", 'miticka');
$mail->AddEmbeddedImage($_SERVER[ 'DOCUMENT_ROOT'] . "/img/minera_logo.png", 'minera');

define('SQL_EMAIL_ADDRESS', "SELECT email AS email, to_cc_bcc AS to_cc_bcc, trn As trn FROM email_dist");
define('SQL_PDO_EMAIL_ADDRESS', "SELECT email AS email, to_cc_bcc AS to_cc_bcc, trn As trn FROM email_dist WHERE trn = :trn");
?>
