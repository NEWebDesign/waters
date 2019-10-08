<?php
    // SERVER SIDE: PHP

    //CONNECTION TO DATABASE//

    include_once('connect.php');
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
    header("Location: panel.php");

    }











?>
<!DOCTYPE html>
<html lang="he">
<head>
	<title>רוגע על המים- ניהולי</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/css/util.css">
	<link rel="stylesheet" type="text/css" href="login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="login/images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" method = "post">
					<span class="login100-form-title">
						התחברות ניהולית
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid username is required">
						<input class="input100" type="text" name="username" placeholder="שם משתמש">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="סיסמה">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<input type = "submit" value = "התחברות" class="login100-form-btn">
						
					</div>

					

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							התחברות לפאנל הניהולי
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
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
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>