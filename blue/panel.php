<?php



session_start();
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}
else{
    $username = '';
}
if($username != 'elran'){
	echo "<script type = 'text/javascript'>window.location.replace('login.php');</script>";
}




include_once("connect.php");
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
	<html lang="zxx" class="no-js">
	<head>

	</head>
		<body dir = "rtl">
		<a style="font-size:5vw;" href = "calandar/index.html">לוח זמנים</a> | 
		<a style="font-size:5vw;" href = "logout.php">התנתקות</a>
		<h1 style="font-size:7vw;">ניהול פוסטים</h1>
		<?php
                

                // Get images from the database
                $query = $conn->query("SELECT * FROM images ORDER BY uploaded_on DESC");

                if($query->num_rows > 0){
                    while($row = $query->fetch_assoc()){
                        if($row['stat'] == "no"){
						$imageURL = 'uploads/'.$row["file_name"];
						if(substr($imageURL, -3) == 'mov' || substr($imageURL, -3) == 'flv' || substr($imageURL, -3) == 'avi' || substr($imageURL, -3) == 'mp4'){
							
							?>
							<video width="320" height="300" controls>
                                <source src="<?php echo $imageURL; ?>" type="video/ogg" alt ="">
                                <source src="<?php echo $imageURL; ?>" type="video/mp4" alt ="">
							</video>
							<?php

                                }else{
                            ?>
							<img src="<?php echo $imageURL; ?>" alt="Work 1">
							<?php }?>
				            <form method = "post">
								<input type = "hidden" name = "id" value = "<?php echo $row['id'];?>" readonly>
								<input type = "submit" class = "button1" value = "אישור תמונה" style = "border-radius:25px;">
							</form>
							<form method = "post">
								<input type = "hidden" name = "ids" value = "<?php echo $row['id'];?>" readonly>
								<input type = "submit" class = "button2" value = "מחיקה" style = "border-radius:25px;">
							
							</form>
						  <?php } }
							}?>
						
				                		        
				        
				    

				

		
				
				
				

		
        <a style="font-size:5vw;" href = "files/prices.pdf" download>מחירון</a>
        <br>
        <a style="font-size:5vw;" href = "files/beginconnection.pdf" download>טופס חתימת תחילת התקשרות</a>
		</body>
	</html>



