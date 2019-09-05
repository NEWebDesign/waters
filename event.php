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
$sqlEvents = "SELECT id, title, start_date, end_date FROM events LIMIT 20";
$resultset = mysqli_query($conn, $sqlEvents) or die("database error:". mysqli_error($conn));
$calendar = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
// convert date to milliseconds
$start = strtotime($rows['start_date']) * 1000;
$end = strtotime($rows['end_date']) * 1000;
$calendar[] = array(
'id' =>$rows['id'],
'title' => $rows['title'],
'url' => "#",
"class" => 'event-important',
'start' => "$start",
'end' => "$end"
);
}
$calendarData = array(
"success" => 1,
"result"=>$calendar);
echo json_encode($calendarData);
?>