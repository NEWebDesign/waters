<?php



session_start();
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}
else{
    $username = '';
}




include_once("calandar/db_connect.php");
//HANDELL FORM//
//TITLE
if(isset($_POST['title'])){
	$title = $_POST['title'];
}else{
	$title = '';
}
//description
if(isset($_POST['description'])){
	$description = $_POST['description'];
}else{
	$description = '';
}
//start and end
if(isset($_POST['start_date'])){
	$start_date = $_POST['start_date'];
}else{
	$start_date = '';
}
if(isset($_POST['start_time'])){
	$start_time = $_POST['start_time'];
}else{
	$start_time = '';
}
$end_date = $start_date;
if(isset($_POST['end_time'])){
	$end_time = $_POST['end_time'];
}else{
	$end_time = '';
}

$created = date("Y-m-d") . " " . date("H:i:s");
$status = 1;
if($title != '' && $description != '' && $start_date != "" && $end_date != "" && $start_time != '' && $end_time != ''){
	$id = rand();
	$start_date = $start_date . " " . $start_time;
	$end_date = $end_date . " " . $end_time;
	$sql = "INSERT INTO events (id,title,description,start_date,end_date,created,status) VALUES ($id, '$title', '$description', '$start_date', '$end_date', '$created', $status)";
	if(mysqli_query($conn, $sql)){
        echo '<script type = "text/javascript">alert("העדכון בוצע בהצלחה!");</script>';
        echo "<script type = 'text/javascript'>window.location.replace('calandar/calandar.php');</script>";

	} else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
	}
	$conn->close();
}







?>
<!DOCTYPE html>
<html>
<head>
    <title>הוספת פעילות </title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <style>
    .navbar{
            z-index:1;
        }
    .body{
        background-color: #6699ff;
    }
    </style>
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
    <div class = "body">
        <br>
        <div class = "form">
            <center>
			<form class="contact1-form validate-form" method = "post">
				<span class="contact1-form-title">
                <h1>הוספת פעילות</h1>
				</span>

				<div class="wrap-input1 validate-input" data-validate = "כותרת חובה">
					<input class="input1" type="text" name="title" placeholder="כותרת">
					<span class="shadow-input1"></span>
				</div>

				<div class="wrap-input1 validate-input" data-validate = "פירוט חובה">
					<input class="input1" type="text" name="description" placeholder="פירוט">
					<span class="shadow-input1"></span>
				</div>
				<div class="wrap-input1 validate-input" data-validate = "תאריך חובה">
					<input class="input1" type="text" name="start_date" placeholder="תאריך(02-02-2019)">
					<span class="shadow-input1"></span>
				</div>
				<div class="wrap-input1 validate-input" data-validate = "שעת התחלה חובה">
					<input type = "text" class="input1" name="start_time" placeholder="שעת התחלה(14:30)">
					<span class="shadow-input1"></span>
                </div>
                <div class="wrap-input1 validate-input" data-validate = "שעת סיום חובה">
					<input type = "text" class="input1" name="end_time" placeholder="שעת סיום">
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

</body>
</html>