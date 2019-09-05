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
        <input type = "text" name = "fullname" placeholder = "שם מלא">
        <br>
        <input type = "text" name = "description" placeholder = "פירוט(על מה התשלום)">
        <br>
        <input type = "number" name = "price" placeholder = "סכום">
        <br>
        <input type = "submit" value = "שלם!">
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
</head>