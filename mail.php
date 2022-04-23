<?php

/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function sendEmail ($code, $toEmail, $fromEmail, $password){


		require 'PHPMailer\src\Exception.php';
		require 'PHPMailer\src\PHPMailer.php';
		require 'PHPMailer\src\SMTP.php';


		$mail = new PHPMailer(TRUE);

		try {
		   
		   $mail->setFrom($fromEmail, 'Password Manager');
		   $mail->addAddress($toEmail,$toEmail);
		   $mail->Subject = 'Login attempt';
		   $mail->Body = "Your secret code is:  [$code] \n please log in within 5 minutes";
		   
		   /* SMTP parameters. */
		   $mail->isSMTP();
		   $mail->Host = 'smtp.gmail.com';
		   $mail->SMTPAuth = TRUE;
		   $mail->SMTPSecure = 'TLS';
		   $mail->Username = $fromEmail;
		   $mail->Password = $password;
		   $mail->Port = 587;
		   
		   /* Disable some SSL checks. */
		   $mail->SMTPOptions = array(
			  'ssl' => array(
			  'verify_peer' => false,
			  'verify_peer_name' => false,
			  'allow_self_signed' => true
			  )
		   );
		   
		   /* Finally send the mail. */
		   $mail->send();
		   return true;
		}
		catch (Exception $e)
		{
		   echo $e->errorMessage();
		    return false;
		}
		catch (\Exception $e)
		{
		   echo $e->getMessage();
		    return false;
		}
}


function sendRecoverEmail ($link, $toEmail, $fromEmail, $password){


		require 'PHPMailer\src\Exception.php';
		require 'PHPMailer\src\PHPMailer.php';
		require 'PHPMailer\src\SMTP.php';


		$mail = new PHPMailer(TRUE);

		try {
		   
		   $mail->setFrom($fromEmail, 'Password Manager');
		   $mail->addAddress($toEmail,$toEmail);
		   $mail->Subject = 'Forget Password';
		   $mail->Body = "Click here to reset your password:  $link ";
		   
		   
		   /* SMTP parameters. */
		   $mail->isSMTP();
		   $mail->Host = 'smtp.gmail.com';
		   $mail->SMTPAuth = TRUE;
		   $mail->SMTPSecure = 'TLS';
		   $mail->Username = $fromEmail;
		   $mail->Password = $password;
		   $mail->Port = 587;
		   
		   /* Disable some SSL checks. */
		   $mail->SMTPOptions = array(
			  'ssl' => array(
			  'verify_peer' => false,
			  'verify_peer_name' => false,
			  'allow_self_signed' => true
			  )
		   );
		   
		   /* Finally send the mail. */
		   $mail->send();
		   return true;
		}
		catch (Exception $e)
		{
		   echo $e->errorMessage();
		    return false;
		}
		catch (\Exception $e)
		{
		   echo $e->getMessage();
		    return false;
		}
}

function sendTextEmail ($text, $toEmail, $fromEmail, $password){


		require 'PHPMailer\src\Exception.php';
		require 'PHPMailer\src\PHPMailer.php';
		require 'PHPMailer\src\SMTP.php';


		$mail = new PHPMailer(TRUE);

		try {
		   
		   $mail->setFrom($fromEmail, 'Password Manager');
		   $mail->addAddress($toEmail,$toEmail);
		   $mail->Subject = 'Your Accont blocked';
		   $mail->Body = "$text";
		   
		   
		   /* SMTP parameters. */
		   $mail->isSMTP();
		   $mail->Host = 'smtp.gmail.com';
		   $mail->SMTPAuth = TRUE;
		   $mail->SMTPSecure = 'TLS';
		   $mail->Username = $fromEmail;
		   $mail->Password = $password;
		   $mail->Port = 587;
		   
		   /* Disable some SSL checks. */
		   $mail->SMTPOptions = array(
			  'ssl' => array(
			  'verify_peer' => false,
			  'verify_peer_name' => false,
			  'allow_self_signed' => true
			  )
		   );
		   
		   /* Finally send the mail. */
		   $mail->send();
		   return true;
		}
		catch (Exception $e)
		{
		   echo $e->errorMessage();
		    return false;
		}
		catch (\Exception $e)
		{
		   echo $e->getMessage();
		    return false;
		}
}