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
    header("Location: index.php");

    }











?>
<!DOCTYPE html>
<!-- CLIENT SIDE: HTML -->
<html>
<head>
    <title>Login page</title>
</head>
<body>
<h1>Login</h1>
<hr>
<form method = "post">
<input type = "text" name = "username" placeholder = "username here">
<br>
<input type = "password" name = "password" placeholder = "password">
<br>
<input type = "submit" value = "submit">





</form>
<br>
<!-- if username and password does not match -->
<?php

    if ($password != '' && $password_selected == '')
    {
        echo 'username and password does not match';
    }

?>
<br>
<a href = "index.php">דף הבית</a>
</body>
</html>