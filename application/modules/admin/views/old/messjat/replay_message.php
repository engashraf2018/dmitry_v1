<?php
ob_start();
$dd=base_url();
include('opendb.inc');
$to=$_POST['to'];
$subject=$_POST['subject'];
$name=$_POST['name'];
$message=$_POST['message'];

class SendMessage {

  function sender($fromName, $from, $subject, $message, $toName, $to){  
     include("PHPMailer/class.phpmailer.php");
  
     $mail = new PHPMailer();
	 $mail->CharSet  = "utf-8";
	 $mail->From     = $from;            //print_r($from);
	 $mail->FromName = $fromName;
	  
	 $mail->IsSMTP();
	  
	 $mail->SMTPAuth = true;     // turn of SMTP authentication
     $mail->Username = "test@cnt-e.com";  // SMTP username
	 $mail->Password = "HnU&+Kha.N[&"; // SMTP password
	 //$mail->SMTPSecure = "ssl";              // for gmail
	 //$mail->Host = "smtp.mail.yahoo.com";  // for yahoo
	 //$mail->Port = 587;                    // yahoo port
	 $mail->Host = "nova.websitewelcome.com";         // for gmail
	 $mail->Port = 465;                      // for gmail
	 $mail->SMTPDebug  = 2; // Enables SMTP debug information (for testing, remove this line on production mode)
	 // 1 = errors and messages
	 // 2 = messages only
	   
	 //$mail->Sender   =  "EMAIL ADDRESS TO RECIEVE BOUNCES";// $bounce_email;
	 $mail->ConfirmReadingTo  = "EMAIL ADDRESS TO GET READING REPORT";
	  
	 $mail->AddReplyTo($from,$fromName);
	 $mail->IsHTML(true); //turn on to send html email
	 $mail->Subject = $subject;
	 
	 $mail->Body     =  $message;
	 $mail->AltBody  =  $message;
	  
	 $mail->AddAddress($to,$toName);
	        
	 if($mail->Send()){
	  $mail->ClearAddresses();
	   return "success";  
	 }
  }
}

$send = new SendMessage();
$send->sender("موقع مول","islam@tech4lifeegypt.com","$subject","$message", "$name", "islam.devphp@gmail.com");
?>
