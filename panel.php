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
if(isset($_POST['ids'])){
    $id = $_POST['ids'];
    if($id != ""){
        $sql = "DELETE FROM images WHERE id = ?";
        if($query = $conn->prepare($sql)) { // assuming $mysqli is the connection
            $query->bind_param("i", $id);
            $query->execute();
            echo '<script type = "text/javascript">alert("המחיקה בוצעה בהצלחה!");</script>';
            } 
            else {
            $error = $conn->errno . ' ' . $conn->error;
            echo $error; // 1054 Unknown column 'foo' in 'field list'
            
        }
    }
}













?>
<!DOCTYPE html>
<html>
<head>
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

    <div class = "body">
    <!-- BODY -->
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
                <input type = "hidden" name = "id" value = "<?php echo $row['id'];?>" readonly>
                <input type = "submit" value = "אישור תמונה">
            </form>
            <form method = "post">
                <input type = "hidden" name = "ids" value = "<?php echo $row['id'];?>" readonly>
                <input type = "submit" value = "מחיקה">
            </form>
            
            <?php } }
            }else{ ?>
            <p>אין תמונות זמינות...</p>
            <?php } ?>
            <br>

        <!-- END OF BODY -->
        </div>
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
</html>