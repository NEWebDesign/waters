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

    //getting the information from the form://
    //username:
    if(isset($_POST['username'])){
        $username = $_POST['username'];
    }else{
        $username = "";
    }
    //password:
    if(isset($_POST['password'])){
        $password = $_POST['password'];
    }else{
        $password = $_POST['password'];
    }
    if($username != '' && $password != ''){

        $sqlselect = $conn->prepare("select * from workers where username = ?");
        $sqlselect->bind_param("s", $username);
        $sqlselect->execute();
        $sqlselect->store_result();
        $sqlselect->bind_result($id_selected, $username_selected, $password_selected);
        $sqlselect->fetch();
        $sqlselect->close();
        $conn->close();


    }
    if($password_selected != ""){
    // Start the session
    session_start();
    $_SESSION['username'] = $username_selected;
    header("Location: /waters/index.php");

    }











?>
<!DOCTYPE html>
<!-- CLIENT SIDE: HTML -->
<html>
<head>
    <title>Login page</title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body dir = "rtl">
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
				<form class="login100-form validate-form" method = "post">
					<span class="login100-form-title p-b-33">
						התחברות למערכת
					</span>

					<div class="wrap-input100 validate-input" data-validate = "שם משתמש חייב להיות תקין">
						<input class="input100" type="text" name="username" placeholder="שם משתמש">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 rs1 validate-input" data-validate="סיסמא היא חובה">
						<input class="input100" type="password" name="password" placeholder="סיסמא">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="container-login100-form-btn m-t-20">
						<button class="login100-form-btn">
							התחבר
						</button>
					</div>
                    <br>
                    <a href = "/waters/index.php">דף הבית</a>


					
				</form>
			</div>
		</div>
	</div>
	

	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

<!-- if username and password does not match -->
<?php

    if ($password != '' && $password_selected == '')
    {
        echo 'username and password does not match';
    }

?>
<br>
</body>
</html>