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

    session_start();
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    }else{
        $username = "";
    }

    // HANDEL FORM //

    //full name
    if(isset($_POST['fullname'])){
        $fullname = $_POST['fullname'];
    }else{
        $fullname = "";
    }

    //description
    if(isset($_POST['description'])){
        $description = $_POST['description'];
    }else{
        $description = '';
    }

    //price
    if(isset($_POST['price'])){
        $price = $_POST['price'];
    }else{
        $price = '';
    }

    //date
    $date = date("d:m:Y-H:i:s");

    // END OF FORM HANDELLING //

    // KEEPING RECORD OF THE PAYEMENT //
    if($fullname != "" && $price != "" && $description != ""){
        $id = uniqid();

        // inserting the data to the DB //
        $sqlinsert = $conn->prepare("insert into payments(id,fullname,description,price) values(?,?,?,?)");
        $sqlinsert->bind_param("sssi", $id, $fullname, $description, $price);
        $sqlinsert->execute();
        //closing the connection
        $sqlinsert->close();
        $conn->close();
        if($fullname != "")
        {   
            echo '<script type = "text/javascript">alert("התשלום בוצע בהצלחה!");</script>';
            echo "<script type = 'text/javascript'>window.location.replace('index.php');</script>";       
        }

    }

?> 
<!DOCTYPE html>
<html>
<head>
    <title>תשלומים</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
    .navbar{
            z-index:1;
        }
    .body{
        background-color: #6699ff;
    }
    </style>
    <link rel="stylesheet" type="text/css" href="main.css">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
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
    
    <!-- BODY -->
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
				<span class="contact1-form-title">
					השלמת תשלומים
				</span>

				<div class="wrap-input1 validate-input" data-validate = "שם מלא חובה">
					<input class="input1" type="text" name="fullname" placeholder="שם מלא">
					<span class="shadow-input1"></span>
				</div>

				<div class="wrap-input1 validate-input" data-validate = "תיאור חובה">
					<input class="input1" type="text" name="description" placeholder="תיאור תשלום">
					<span class="shadow-input1"></span>
				</div>

				

				<div class="wrap-input1 validate-input" data-validate = "סכום">
					<input type = "number"  id = "myTextBox" class="input1" name="price" placeholder="סכום">
					<span class="shadow-input1"></span>
				</div>

				<div class="container-contact1-form-btn">
					<button class="contact1-form-btn">
						<span>
							שלם
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



    <!-- END OF BODY -->

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
    <script type = "text/javascript">
        // Restricts input for the given textbox to the given inputFilter.
        function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
            textbox.addEventListener(event, function() {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            }
            });
        });
        }

        // Restrict input to digits and '.' by using a regular expression filter.
        setInputFilter(document.getElementById("myTextBox"), function(value) {
        return /^\d*\.?\d*$/.test(value);
        });
    </script>
</body>
</head>