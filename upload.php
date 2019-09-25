<?php
// Include the database configuration file
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

$statusMsg = '';

// File upload path
$targetDir = "uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $insert = $conn->query("INSERT into images (file_name, uploaded_on, stat) VALUES ('".$fileName."', NOW(), 'no')");
            if($insert){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                echo '<script type = "text/javascript">alert("התמונה הועלתה בהצלחה!");</script>';
                echo "<script type = 'text/javascript'>window.location.replace('index.php');</script>";
            }else{
                echo '<script type = "text/javascript">alert("העלאת הקובץ נכשלה..");</script>';
                echo "<script type = 'text/javascript'>window.location.replace('index.php');</script>";
                $statusMsg = "File upload failed, please try again.";
            } 
        }else{
            echo '<script type = "text/javascript">alert("בעייה בהעלאת הקובץ שבחרת");</script>';
            echo "<script type = 'text/javascript'>window.location.replace('index.php');</script>";
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        echo '<script type = "text/javascript">alert("רק קבצים מסוג jpg, jpeg, png, gif & pdf מתקבלים");</script>';
        echo "<script type = 'text/javascript'>window.location.replace('index.php');</script>";
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    echo '<script type = "text/javascript">alert("לא נבחרו קבצים להעלאה...");</script>';
    echo "<script type = 'text/javascript'>window.location.replace('index.php');</script>";
    $statusMsg = 'Please select a file to upload.';
}

// Display status message
echo $statusMsg;
?>