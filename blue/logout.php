<?php
    //SERVER SIDE: PHP
    session_start();
    if(isset($_SESSION['username'])){
        session_destroy();
        header('Location: login.php');
    }
    else{
        header('Location: login.php');
    }
?>