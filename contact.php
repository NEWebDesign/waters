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
            echo $fullname;
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
</head>
<body dir = "rtl">




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




</body>
</html>