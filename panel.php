<?php
session_start();
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    $username = "";
}

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

//form
if(isset($_POST['id'])){
    $id = $_POST['id'];
    if($id != ""){
        $sql = "UPDATE images SET stat='yes' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo '<script type = "text/javascript">alert("העדכון בוצע בהצלחה!");</script>';
        } else {
            echo "בעייה בעדכון המידע " . $conn->error;
        }
    }
}













?>
<!DOCTYPE html>
<html>
<head>
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
    <?php
            

            // Get images from the database
            $query = $conn->query("SELECT * FROM images ORDER BY uploaded_on DESC");

            if($query->num_rows > 0){
                while($row = $query->fetch_assoc()){
                    if($row['stat'] == "no"){
                    $imageURL = 'uploads/'.$row["file_name"];
        ?>
        <img src="<?php echo $imageURL; ?>" width = "250" height = "250" alt="" />
        <form method = "post">
            <input type = "text" name = "id" value = "<?php echo $row['id'];?>" readonly>
            <br>
            <input type = "submit" value = "אישור">
        <?php } }
        }else{ ?>
        <p>אין תמונות זמינות...</p>
        <?php } ?>
        <br>


</body>
</html>