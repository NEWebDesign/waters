<?php

//CONNECTION TO DATABASE//

$sqlservername = 'localhost';
$sqlusername = 'root';
$sqlpassword = '';
$sqldbname = 'waters_db';
//creating the connection
$conn = new mysqli($sqlservername, $sqlusername, $sqlpassword, $sqldbname);
//checking if connection is failling, if it is failling, then kill the script.
if ($conn->connect_error){
    die("connection failled!\n" . $conn->connect_error);
    }

?>