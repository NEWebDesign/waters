<?php
    // SERVER SIDE: PHP

    //CONNECTION TO DATABASE//

    $sqlservername = 'localhost';
    $sqlusername = 'root';
    $sqlpassword = 'xzaq1234';
    $sqldbname = 'waters_db';

    //creating the connection
    $conn = new mysqli($sqlservername, $sqlusername, $sqlpassword, $sqldbname);

    //checking if connection is failling, if it is failling, then kill the script.
    if ($conn->connect_error){
    die("connection failled!\n" . $conn->connect_error);
    }

    // HANDELLING FORM //

    //full name
    if(isset($_POST['fullname'])){
        $fullname = $_POST['fullname'];
    }else{
        $fullname = "";
    }

    //email
    if(isset($_POST['email'])){
        $email = $_POST['email'];
    }else{
        $email = "";
    }

    //title
    if(isset($_POST['title'])){
        $title = $_POST['title'];
    }else{
        $title = "";
    }

    //message
    if(isset($_POST['message'])){
        $message = $_POST['message'];
    }else{
        $message = "";
    }

    // END OF FORM HANDELLING //

    // INSERTING DATA //
    
    //checking if all feilds are entered
    if($fullname != "" && $email != "" && $title != "" && $message != ""){
        $id = uniqid();
        // inserting the data to the DB //
        $sqlinsert = $conn->prepare("insert into contact(id,fullname,email,title,message) values(?,?,?,?,?)");
        $sqlinsert->bind_param("sssss", $id, $fullname, $email, $title, $message);
        $sqlinsert->execute();
        //closing the connection
        $sqlinsert->close();
        $conn->close();
        if($fullname != "")
        {
            require 'PHPMailerAutoload.php';

            $mail = new PHPMailer;

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'localhost';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'noamg.j2@gmail.com';                 // SMTP username
            $mail->Password = 'noamking12!';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

            $mail->From = 'noamg.j2@gmail.com';
            $mail->FromName = 'Noam';
            $mail->addAddress($email, $fullname);     // Add a recipient


            $mail->WordWrap = 50;                                 // Set word wrap to 50 characters

            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = $title;
            $mail->Body    = $message;
            $mail->AltBody = $message;

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent';
            }
            echo '<script type = "text/javascript">alert("הבקשה נשלחה בהצלחה!");</script>';
            echo "<script type = 'text/javascript'>window.location.replace('index.php');</script>";
        }
    }
    session_start();
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    }else{
        $username = "";
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>צרו קשר!</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body dir = "rtl">



    <div class = "navbar">
        <!-- NAVBAR -->
        
        <a href = "index.php">דף הבית</a> | 
        <a href = "contact.php">צרו קשר</a> | 
        <a href = "pay.php">תשלומים</a> | 
        <?php
            if(isset($username)){
                if($username == "keren" || $username == "elran"){
                ?>
                <a href = "panel.php">פאנל ניהולי</a> | 
                <a href = "calandar/calandar.php">לוח זמנים</a> | 
                <a href = "logout.php">התנתקות</a>
        <?php
            }else{
        ?>
                <a href = "login.php">התחברות</a>
        <?php
            }}
        ?>
        <!-- END OF NAVBAR -->
    </div>

    <!-- BODY -->
    <div class = "body">
        <form method = "post">


            <input type = "text" name = "fullname" placeholder = "שם מלא כאן">
            <br>
            <input type = "text" name = "email" placeholder = 'דוא״ל'>
            <br>
            <input type = "text" name = "title" placeholder = "כותרת הפנייה">
            <br>
            <textarea type = "text" name = "message" placeholder = "הפנייה כאן"></textarea>
            <br>
            <input type = "submit" value = "שלח">


        </form>
    </div>
    <!-- END OF BODY -->

    <div class = "footer">
        <hr>
        <!-- FOOTER -->

        <span>רוגע על המים</span> | 
        <span>טיפולים הוליסטים</span> | 
        <span>לימוד שחייה לכל הגילאים<span> | 
        <span>לרוגע חייגו: אלרן - 0509014223</span>

        <!-- END OF FOOTER -->
    </div>
</body>
</html>