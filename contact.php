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
<html lang="he">
<head>
	<title>צרו קשר</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
<style>
.navbar{
    width:100%;
    z-index:1;
}

@font-face {
    font-family: Nehama;
    src: url("fonts/Nehama.ttf");
}
.body{
    position:absolute;
    background-color: #6699ff;
    color:white;
    font-family:Nehama;
}
</style>
<link rel="stylesheet" type="text/css" href="main.css">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body dir = "rtl">
    <div class = "navbar">
       <!-- NAVBAR -->
        
        
       <div class="w3-top">
        <div class="w3-bar w3-white w3-wide w3-padding w3-card">
            <a href="index.php" class="w3-bar-item w3-button"><b>רוגע על המים</b></a>
            <!-- Float links to the right. Hide them on small screens -->
            <div class="w3-right w3-hide-small">
            <a href="index.php" class="w3-bar-item w3-button">דף הבית</a>
            <a href="contact.php" class="w3-bar-item w3-button">צרו קשר</a>
            <a href="pay.php" class="w3-bar-item w3-button">תשלומים</a>
            <?php
            if(isset($username)){
                if($username == "keren" || $username == "elran"){
                ?>
                <a href="panel.php" class="w3-bar-item w3-button">פאנל ניהולי</a>
                <a href="calandar/calandar.php" class="w3-bar-item w3-button">לוח זמנים</a>
                <a href="logout.php" class="w3-bar-item w3-button">התנתקות</a>
        <?php
            }else{
        ?>
            <a href="/waters/login/login.php" class="w3-bar-item w3-button">התחברות</a>
        <?php
            }}
        ?>
            </div>
        </div>
        </div>
        <!-- END OF NAVBAR -->
    </div>

    <div class = "body" style = "background-color: #6699ff;">
    <!-- <div class="contact1">
		<div class="container-contact1">
			<div class="contact1-pic js-tilt" data-tilt>
				<img src="images/img-01.png" alt="IMG">
			</div> -->
            <br>
        <div class = "form">
            <center>
			<form class="contact1-form validate-form" method = "post">
				<span class="contact1-form-title" style = "color:white;font-family:Nehama;">
					דברו איתנו
				</span>

				<div class="wrap-input1 validate-input" data-validate = "שם מלא חובה">
					<input class="input1" type="text" name="fullname" placeholder="שם מלא">
					<span class="shadow-input1"></span>
				</div>

				<div class="wrap-input1 validate-input" data-validate = "חובה כתובת דו״אל תקינה">
					<input class="input1" type="text" name="email" placeholder="דוא״ל">
					<span class="shadow-input1"></span>
				</div>

				<div class="wrap-input1 validate-input" data-validate = "כותרת חובה">
					<input class="input1" type="text" name="title" placeholder="כותרת">
					<span class="shadow-input1"></span>
				</div>

				<div class="wrap-input1 validate-input" data-validate = "תוכן ההודעה חובה">
					<textarea class="input1" name="message" placeholder="ההודעה"></textarea>
					<span class="shadow-input1"></span>
				</div>

				<div class="container-contact1-form-btn">
					<button class="contact1-form-btn">
						<span>
							שלח
							<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						</span>
					</button>
				</div>
			</form>
        </div>
        </center>
		</div>
        <!-- </div>
        </div> -->



        <div class = "footer">
        <!-- FOOTER -->
        
        <span>רוגע על המים</span> | 
        <span>טיפולים הוליסטים</span> | 
        <span>לימוד שחייה לכל הגילאים<span> | 
        <span>לרוגע חייגו: אלרן - 0509014223</span> | 
        <span>האתר פותח על ידי נועם גלוברמן</span>

        <!-- END OF FOOTER -->
    </div>
    <div class = "downer"></div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

<!--===============================================================================================-->
	<script src="js/main.js"></script>
    
</body>
</html>
