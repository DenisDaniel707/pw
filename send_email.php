<?php
   require('register.php');
   $to_email = $email;
   $subject = "Account confirmation";
   $body = "Your confirmation link: " . '<a href="login/confirmation.php"></a>' ;
   $headers = "From: ardelean_denis707@yahoo.com";
 
   if (mail($to_email, $subject, $body, $headers)) {
      echo("Email successfully sent to $to_email...");
   } else {
      echo("Email sending failed...");
   }
?>