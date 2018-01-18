<?php

// TODO fix this function and make it more secure.
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function generateRandomString() {
$randomString = openssl_random_pseudo_bytes(16);
$randomString= bin2hex($randomString);

return $randomString;
    }


function emailValidation($mysqli, $email) {
    
    
  $checkEmail = mysqli_query($mysqli, "SELECT * FROM users WHERE email='$email'");
    
   if(mysqli_num_rows($checkEmail) > 0)
	{
		return $checkEmail = 'true';
	}else
	{
		return $checkEmail = 'false';
	}    

}


function sendEmail($token, $username, $to)
{

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';
	$mail = new PHPMailer;
	$mail->setFrom('charlottenestmonitoring@gmail.com', 'Scooter C. | Founder of CNM');
$mail->addAddress($to);
$mail->Subject = 'Charlotte Nest Monitoring Password Recovery Instructions';
$link = 'http://localhost/charlottenestmonitoring/passwordresetpage.php?email='.$to.'&token='.$token . '&username='.$username;
	$mail->Body    = "<b>Hello " . $username . "! </b><br><br>Forgot your password? no problem, just follow the link to reset it. <a href='$link' target='_blank'>Click here</a> to reset your password. If you are unable to click the link then copy the link below and paste in your browser to reset your password.<br><i>". $link."</i><br> As always, thanks for using CNM<b>- Scooter</b>";
	
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
	if(!$mail->send()) {
		return $to;
	} else {
		return 'success';
	}
}



function verifytoken($email, $username, $token, $mysqli)
 
{             
 
    
 
        $query = mysqli_query($mysqli, "SELECT * FROM recovery_keys WHERE username = '$username' AND token = '$token'");
 
        $row = mysqli_fetch_assoc($query);     
 
        if(mysqli_num_rows($query) > 0)
        {
 
            if($row['token'] == $token)
            {
              return 1;
            }else
            {
              return 0;
            }
        }else
        {
             return 0;
        }



}


?>