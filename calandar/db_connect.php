<?php
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
?>