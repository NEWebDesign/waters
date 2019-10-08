<?php
// Include the database configuration file
include 'connect.php';
$statusMsg = '';

// File upload path
$targetDir = "uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf', 'flv', 'avi', 'mov', 'mp4');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $insert = $conn->query("INSERT into images (file_name, uploaded_on, stat) VALUES ('".$fileName."', NOW(), 'no')");
            if($insert){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                echo "<script type='text/javascript'>alert('$statusMsg');</script>";
                echo "<script type = 'text/javascript'>window.location.replace('index.php');</script>";

            }else{
                $statusMsg = "File upload failed, please try again.";
                echo "<script type='text/javascript'>alert('$statusMsg');</script>";
                echo "<script type = 'text/javascript'>window.location.replace('index.php');</script>";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
            echo "<script type='text/javascript'>alert('$statusMsg');</script>";
            echo "<script type = 'text/javascript'>window.location.replace('index.php');</script>";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        echo "<script type='text/javascript'>alert('$statusMsg');</script>";
        echo "<script type = 'text/javascript'>window.location.replace('index.php');</script>";
    }
}else{
    $statusMsg = 'Please select a file to upload.';
    echo "<script type='text/javascript'>alert('$statusMsg');</script>";
    echo "<script type = 'text/javascript'>window.location.replace('index.php');</script>";
}

// Display status message
echo $statusMsg;
?>