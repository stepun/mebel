<?php

///////////////// EDITABLE OPTIONS   /////////////////////

$receiving_email_address = "stepun@gmail.com";  // Set your email address here which you want to receive emails to

$receiving_email_address_name = "Алексей"; // Add name that is associated with your email address above.

$custom_subject = "Запрос звонка с сайта [mebelproff.by]"; // Change the subject line of email as per your choice.


// =============================  DO NOT EDIT BELOW THIS LINE  ======================================

if ((isset($_POST['phone'])) && (strlen(trim($_POST['phone'])) > 0)) {
	$phone = stripslashes(strip_tags($_POST['phone']));
} else {$phone = 'No phone entered';}

ob_start();


// Email Building
$to 					        = $receiving_email_address;
$email 							= 'info@mebelproff.by';
$fromaddress 					= 'info@mebelproff.by';
$fromname 						= 'mebelproff';
$body = "Клиент просит перезвонить.<br><br> Телефон: ".$_POST['phone'];


require("phpmailer.php");
$mail = new PHPMailer();

$mail->From    					= "$email";
$mail->FromName 			= "$fromname";
$mail->AddAddress("$receiving_email_address","$receiving_email_address_name");

$mail->IsHTML(true);

$mail->Subject  				= "$custom_subject";
$mail->Body     					= $body;
$mail->AltBody 					= "This is the text-only body";

if(!$mail->Send()) {
	$recipient 					= '$receiving_email_address';
	$subject 						= 'Contact form failed';
	$content						= $body;	
	
  // Send Mail
  mail($recipient, $subject, $content, "From: $receiving_email_address\r\nReply-To: $email\r\nX-Mailer: DT_formmail");
  exit;
}