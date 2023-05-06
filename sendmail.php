<?php
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\SMTP;
	
	require_once(__DIR__ . '/PHPMailer/src/Exception.php');
	require_once(__DIR__ . '/PHPMailer/src/PHPMailer.php');
	require_once(__DIR__ . '/PHPMailer/src/SMTP.php');
	
	$mimetype ='application/octet-stream';
	$encoding = 'base64';
	$csv_file = 'order_of_products.csv';

	$email = new PHPMailer();

	// Authentifikation mittels SMTP
	$email->isSMTP();
	$email->SMTPAuth = true;

	// Login
	$email->Host = "mail.domain-of-your-mail-server.com";
	$email->Port = "587";
	$email->Username = "no-reply@domain-of-your-mail-server.com";
	$email->Password = "crypticpassword";
	$email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	//$email->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;


	$email->SetFrom('no-reply@domain-of-your-mail-server.com', 'domain-of-your-mail-server.com'); //Name is optional
	$email->Subject   = 'Orders';
	$email->Body      = 'Incoming Orders';
	$email->AddAddress( 'deeloper@domain-of-your-mail-server.com' );
	
	$email->CharSet = 'utf-8';

	$file_path_to_attach = __DIR__ ;


	$email->AddAttachment( $file_path_to_attach . '/' . $csv_file , $csv_file, $encoding, $mimetype);

	//var_dump($email);
	$email->SMTPDebug = SMTP::DEBUG_SERVER;
	if($email->Send()== TRUE){
		echo 'Mail send';
		return $email->Send();
	}else{
		echo 'Mail not send';
	}