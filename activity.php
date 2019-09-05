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
    <center style = 'border:1px solid black;'>
    <form method = "post">

        <h1>הוספת פעילות</h1>
        <span>כותרת</span>
        <br>
        <input type = "text" name = "title" placeholder = "כותרת">
        <br>
        <span>פירוט על הפעילות</span>
        <br>
        <textarea name = "description" placeholder = "פירוט"></textarea>
        <br>
        <span>דוגמא לצורת הכנסה: 02-02-2019</span>
        <br>
        <input type = "text" name = "start_date" placeholder = "תאריך">
        <br>
        <span>דוגמא לצורת הכנסה: 22:10:00 </span>
        <br>
        <input type = "text" name = "start_time" placeholder = "שעת התחלה">
        <br>
        <span>דוגמא לצורת הכנסה: 22:10:00</span>
        <br>
        <input type = "text" name = "end_time" placeholder = "שעת סיום">
        <br>
        <input type = "submit" value = "הוסף פעילות">



    </form>
    </center>
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