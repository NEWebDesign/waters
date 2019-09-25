<?php
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

session_start();
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    $username = "";
}




?>
<!DOCTYPE html>
<html>
<head>
    <title>רוגע על המים</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Custom File Inputs | Codrops</title>
		<meta name="description" content="Demo for the tutorial: Styling and Customizing File Inputs the Smart Way" />
		<meta name="keywords" content="cutom file input, styling, label, cross-browser, accessible, input type file" />
		<meta name="author" content="Osvaldas Valutis for Codrops" />
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
    <style>
    .navbar{
            z-index:1;
        }
    .image {display:none;}


    .body{
        background: #ffffff;
        background-image: url('background.jpeg');
        background-repeat: no-repeat;
        background-size: cover;
    }
    .button {
        background-color: #555555; /* Green */
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
    /* input[type='file'] {
        color: transparent;
        width: 100px;
        overflow:hidden;
    } */
    #image{
        width:80%;
        max-height:20%;
        border: 1px solid white;
        
        
    }
    #click_left{
        position:absolute;
        left:10%;
        top:50%;
        width:5%;

    }
    #click_right{
        position:absolute;
        right:10%;
        top:50%;
        width:5%;

    }
    
   
    </style>
</head>
<body dir = "rtl">

<div class = "downer"></div>

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
    <br>
    <center>
    <!-- BODY -->
    <div class ="body">
    <b><h1 style = "font-family:Nehama;">רוגע על המים</h1></b>


    
    <div class = "images">
    <?php
        

        // Get images from the database
        $query = $conn->query("SELECT * FROM images ORDER BY uploaded_on DESC");

        if($query->num_rows > 0){
            while($row = $query->fetch_assoc()){
                if($row['stat'] == "yes"){
                $imageURL = 'uploads/'.$row["file_name"];
    ?>
    <div class="w3-content w3-display-container">
    <img id = "image" class = "image" src="<?php echo $imageURL; ?>" height = "600" alt="" onclick="window.open(this.src)"/>
    
    <?php } }
    }else{ ?>
    <!-- <p>אין תמונות זמינות...</p> -->
    <?php } ?>
    <button id = "click_left" class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)"> ></button>
    <button id = "click_right" class="w3-button w3-black w3-display-right" onclick="plusDivs(1)"><</button>
    </div>
    </div>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <br>
			<input type="file" name="file" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} מספר קבצים שנבחרו " multiple hidden/>
			<label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>בחר תמונות&hellip;</span></label>
        <br>
        <input type="submit" class = "button" name="submit" value="העלה!">
    </form>
    </div>
    <!-- END OF BODY -->
    </center>
    <br>

    <div class = "footer">
        <!-- FOOTER -->
        
        <span>רוגע על המים</span> | 
        <span>טיפולים הוליסטים</span> | 
        <span>לימוד שחייה לכל הגילאים<span> | 
        <span>לרוגע חייגו: אלרן - 0509014223</span> | 
        <span>האתר פותח על ידי נועם גלוברמן</span>

        <!-- END OF FOOTER -->
    </div>

    <script>
        var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
        showDivs(slideIndex += n);
        }

        function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("image");
        if (n > x.length) {slideIndex = 1}
        if (n < 1) {slideIndex = x.length}
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
        }
        x[slideIndex-1].style.display = "block";  
        }
</script>
</body>
</html>