<?php

    $to = "noamg.j2@gmail.com";
    $subject = "יצירת קשר";
    $message = "שלום חבר";

    $headers = "From: The Sender Name <noamg.j2@gmail.com>\r\n";
    $headers = "Reply-To: noamg.j2@gmail.com\r\n";
    $headers = "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);

?>