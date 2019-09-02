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




?>
<!DOCTYPE html>
<html>
<head>
    <title>רוגע על המים</title>
    <style>
        .footer{
            position:fixed;
            top:95%;
        }
        .navbar{
            position:fixed;
            top:0%;
        }
    </style>
</head>
<body dir = "rtl">


    <div class = "navbar">
    <!-- NAVBAR -->
    
    <a href = "index.php">דף הבית</a> | 
    <a href = "contact.php">צרו קשר</a> | 
    <a href = "payments.php">תשלומים</a> | 
    <?php
        if(isset($username)){
            if($username == "keren" || $username == "elran"){
            ?>
            <a href = "panel.php">פאנל ניהולי</a> | 
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
    <br>
    <h1>רוגע על המים</h1>
    <hr>

    <h2>מדיה</h2>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <br>
        <input type="submit" name="submit" value="Upload">
    </form>
    <?php
        

        // Get images from the database
        $query = $conn->query("SELECT * FROM images ORDER BY uploaded_on DESC");

        if($query->num_rows > 0){
            while($row = $query->fetch_assoc()){
                if($row['stat'] == "yes"){
                $imageURL = 'uploads/'.$row["file_name"];
    ?>
    <img src="<?php echo $imageURL; ?>" width = "250" height = "250" alt="" />
    <?php } }
    }else{ ?>
    <p>אין תמונות זמינות...</p>
    <?php } ?>
    <br>
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