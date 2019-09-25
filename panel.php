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
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
.navbar{
    z-index:1;
}

.button1 {
        background-color: #4CAF50; 
        border: none;
        color: white;
        padding: 5px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }
.button2 {
        background-color: #f44336; 
        border: none;
        color: white;
        padding: 5px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }
    #image{
        border:1.5px solid black;
        border-radius: 25px;
        padding-right:1%;
        padding-left:1%;
        padding-top:1%;
        display: inline-block;
    }
    @font-face {
    font-family: Nehama;
    src: url("fonts/Nehama.ttf");
    }
    .body{
        background-color: #6699ff;
}
</style>
</head>
<body dir = "rtl">
    <div class = "navbar">
        <!-- NAVBAR -->
        
        
        <div class="w3-top">
        <div class="w3-bar w3-white w3-wide w3-padding w3-card">
            <a href="index.php" class="w3-bar-item w3-button"><b>רוגע על המים</b></a>
            <!-- Float links to the right. Hide them on small screens -->
            <div class="w3-right w3-hide-small">
            <a href="index.php" class="w3-bar-item w3-button">דף הבית</a>
            <a href="contact.php" class="w3-bar-item w3-button">צרו קשר</a>
            <a href="pay.php" class="w3-bar-item w3-button">תשלומים</a>
            <?php
            if(isset($username)){
                if($username == "keren" || $username == "elran"){
                ?>
                <a href="panel.php" class="w3-bar-item w3-button">פאנל ניהולי</a>
                <a href="calandar/calandar.php" class="w3-bar-item w3-button">לוח זמנים</a>
                <a href="logout.php" class="w3-bar-item w3-button">התנתקות</a>
        <?php
            }else{
        ?>
            <a href="/waters/login/login.php" class="w3-bar-item w3-button">התחברות</a>
        <?php
            }}
        ?>
            </div>
        </div>
        </div>
        <!-- END OF NAVBAR -->
    </div>
    <center>
    <div class = "body">
    <!-- BODY -->
        <h1 style = "font-family:Nehama;">!אישור/מחיקה של פוסטים</h1>
        <?php
                

                // Get images from the database
                $query = $conn->query("SELECT * FROM images ORDER BY uploaded_on DESC");

                if($query->num_rows > 0){
                    while($row = $query->fetch_assoc()){
                        if($row['stat'] == "no"){
                        $imageURL = 'uploads/'.$row["file_name"];
            ?>
            <div id = "image">
            <img src="<?php echo $imageURL; ?>" width = "250" height = "250" alt="" />
            <form method = "post">
                <input type = "hidden" name = "id" value = "<?php echo $row['id'];?>" readonly>
                <input type = "submit" class = "button1" value = "אישור תמונה" style = "border-radius:25px;">
            </form>
            <form method = "post">
                <input type = "hidden" name = "ids" value = "<?php echo $row['id'];?>" readonly>
                <input type = "submit" class = "button2" value = "מחיקה" style = "border-radius:25px;">
            
            </form>
            </div>
            
            <?php } }
            }else{ ?>
            <p>אין תמונות זמינות...</p>
            <?php } ?>
            <br>

        <!-- END OF BODY -->
        </div>
        </cemter>
        <div class = "footer">
        <!-- FOOTER -->
        
        <span>רוגע על המים</span> | 
        <span>טיפולים הוליסטים</span> | 
        <span>לימוד שחייה לכל הגילאים<span> | 
        <span>לרוגע חייגו: אלרן - 0509014223</span> | 
        <span>האתר פותח על ידי נועם גלוברמן</span>

        <!-- END OF FOOTER -->

    </div>
    <div class = "downer"></div>

</body>
</html>