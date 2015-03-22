<?php

$config = parse_ini_file('config.ini.php', TRUE);

$_FROM_NAME = "pandark@iitk.ac.in";
$_FROM_EMAIL = "pandark@iitk.ac.in";
$_FROM_USERNAME = "pandark";
$_FROM_PASSWORD = "raw-jet";


$_TO_NAME = "test";
$_TO_EMAIL = "mailtorajatk@gmail.com";

$prof = "TEST NAME";
$paper = "TEST RESEARCH PAPER";
include('data/' . "ameyas" . '/letter.php');


require_once('phpmailer/class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

$body             = $letter;

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "smtp.cc.iitk.ac.in"; // SMTP server
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "smtp.cc.iitk.ac.in"; // sets the SMTP server
$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
$mail->Username   = $_FROM_USERNAME; // SMTP account username
$mail->Password   = $_FROM_PASSWORD;        // SMTP account password

$mail->SetFrom($_FROM_EMAIL, $_FROM_NAME);

$mail->AddReplyTo($_FROM_EMAIL, $_FROM_NAME);

$mail->Subject    = "Opportunity for a summer internship";

//$mail->MsgHTML($body);
$mail->Body = $body;

$mail->AddAddress($_TO_EMAIL, $_TO_NAME);
$mail->AddAttachment('data/' . 'ameyas' . '/' . $config['cv']);

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "<h2>TEST MAIL SUCCESSFULLY SENT</h2>";
}

?>
