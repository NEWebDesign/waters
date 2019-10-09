<?php
    $mailto = 'noamg.j2@gmail.com';
    $mailSub = $_POST['name'];
    $mailMsg = $_POST['message'];
   require 'PHPMailer-master/PHPMailerAutoload.php';
   $mail = new PHPMailer();
   $mail ->IsSmtp();
   $mail ->SMTPDebug = 0;
   $mail ->SMTPAuth = true;
   $mail ->SMTPSecure = 'ssl';
   $mail ->Host = "smtp.gmail.com";
   $mail ->Port = 465; // or 587
   $mail ->IsHTML(true);
   $mail ->Username = "noamg.j2@gmail.com";
   $mail ->Password = "noamking12!";
   $mail ->SetFrom("noamg.j2@gmail.com");
   $mail ->Subject = $mailSub;
   $mail ->Body = $mailMsg . "\n<br>כתובת לחזרה: ". $_POST['email'];
   $mail ->AddAddress($mailto);

   if(!$mail->Send())
   {
        echo "<script type = 'text/javascript'>alert('בעייה בשליחת הבקשה');</script>";
        echo "<script type = 'text/javascript'>window.location.replace('index.php');</script>";
   }
   else
   {
        echo "<script type = 'text/javascript'>alert('הבקשה נשלחה בהצלחה');</script>";
        echo "<script type = 'text/javascript'>window.location.replace('index.php');</script>";
}





   

?>