<?php
// SERVER SIDE //
    include_once('connect.php');


    
    // HANDEL FORM //

    //full name
    if(isset($_POST['firstname'])){
        $firstname = $_POST['firstname'];
    }else{
        $firstname = "";
    }
    if(isset($_POST['lastname'])){
        $lastname = $_POST['lastname'];
    }else{
        $lastname = "";
    }
    $fullname = $firstname . " " . $lastname;

    //description
    if(isset($_POST['description'])){
        $description = $_POST['description'];
    }else{
        $description = '';
    }

    //price
    if(isset($_POST['price'])){
        $price = $_POST['price'];
    }else{
        $price = '';
    }

    //date
    $date = date("d:m:Y-H:i:s");

    // END OF FORM HANDELLING //

    // KEEPING RECORD OF THE PAYEMENT //
    if($fullname != "" && $price != "" && $description != ""){
        $id = uniqid();

        // inserting the data to the DB //
        $sqlinsert = $conn->prepare("insert into payments(id,fullname,description,price) values(?,?,?,?)");
        $sqlinsert->bind_param("sssi", $id, $fullname, $description, $price);
        $sqlinsert->execute();
        //closing the connection
        $sqlinsert->close();
        $conn->close();
        if($fullname != "")
        {   
            echo '<script type = "text/javascript">alert("התשלום בוצע בהצלחה!");</script>';
            echo "<script type = 'text/javascript'>window.location.replace('index.php');</script>";       
        }

    }




?>
<!DOCTYPE HTML>
<!--
    Vortex by Pixelarity
    pixelarity.com | hello@pixelarity.com
    License: pixelarity.com/license
-->
<html>
<head>
    <title>רוגע על המים</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />

</head>
<body class="is-preload">

    <!-- Header -->
    <header id="header">

        <!-- Logo -->
        <div class="logo">
            <a href="index.php"><strong>רוגע</strong> על המים</a>
        </div>

        <!-- Nav -->
        <nav id="nav">
            <ul>
                <li><a href="index.php">דף הבית</a></li>
                <li>
                    <a href="#" class=" icon solid fa-angle-down">הטיפולים שלנו</a>
                    <ul>

                        <li>
                            <a href="lesson.php">שיעורי שחייה</a>
                            <!-- <ul>
                                <li><a href="#">פרטני</a></li>
                                <li><a href="#">קבוצות</a></li>
                                <li><a href="#">מבוגרים</a></li>
                                <li><a href="#">שיפור סגנון</a></li>
                                <li><a href="#">שחייה טיפולית</a></li>
                            </ul> -->
                        </li>
                        <li>
                            <a href="#">טיפולים</a>
                            <ul>
                                <li>
                                    <a href="hydrotherapy.php">הידרותרפיה</a>
                                    <!-- <ul>
                                        <li><a href="#">תינוקות</a></li>
                                        <li><a href="#">ילדים</a></li>
                                        <li><a href="#">הורים</a></li>
                                    </ul> -->
                                </li>
                                <li>
                                    <a href="#">וואטסו</a><ul>
                                        <li><a href="#">ילדים</a></li>
                                        <li><a href="#">נשים בהריון</a></li>
                                        <li><a href="#">מבוגרים</a></li>
                                    </ul>
                                </li>
                                <li><a href="waterdance.php">water dance</a></li>

                            </ul>
                        </li>
                        <li>
                            <a href="#">ספורתרפיה</a>
                            <ul>
                                <li><a href="#">טיפול בפציעות ספורט</a></li>
                                <li><a href="#">עיסוי רפואי</a></li>
                                <li><a href="#">עיסוי ספורטאים</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">עיסויים</a>
                            <ul>
                                <li><a href="#">עיסוי אביזרים</a></li>
                                <li><a href="#">שיאטסו</a></li>
                                <li><a href="#">עיסוי שוודי</a></li>
                                <li><a href="#">עיסוי רקמות</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="payment.php">תשלום</a></li>
                <li><a href="links.php">קישורים חיצוניים</a></li>

                <li><a href="elements.php"></a></li>
            </ul>
        </nav>

    </header>
    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Section -->
        <section class="main style1">
            <header class="small">
                <h1>תשלום</h1>
                <p>לחצו על כפתור הקנייה, שם תתבצע ההעברה. הכניסו את הכמות המבוקשת, בחרו באופציית התשלום(כרטיס אשראי או פייפאל), והכניסו את פרטי ההעברה(שם המעביר, בעבור מה, ובאיזה תאריך קרה האירוע שבעקבותיו מתבצע התשלום)</p>
                <br>
                <center>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_donations" />
<input type="hidden" name="business" value="2C2MKQXD6KA7S" />
<input type="hidden" name="currency_code" value="ILS" />
<input type="image" src="https://www.paypalobjects.com/he_IL/IL/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="תרומה באמצעות לחצן PayPal" />
<img alt="" border="0" src="https://www.paypal.com/he_IL/i/scr/pixel.gif" width="1" height="1" />
</form>
                </center>
            </header>
         
           
            
        </section>

        <!-- Section -->
        <section class="main style2">
            <header class="small">
                <h2>
                    צור קשר
                </h2>
                <p>תוכן</p>
            </header>
            <div class="inner special medium">
                <form action="#" method="post">
                    <div class="fields">
                        <div class="field half">
                            <input name="name" id="name" placeholder="שם מלא" type="text" />
                        </div>
                        <div class="field half">
                            <input name="email" id="email" placeholder="מייל" type="email" />
                        </div>
                        <div class="field">
                            <textarea name="message" id="message" rows="8" placeholder="כתוב את ההודעה שלך כאן"></textarea>
                        </div>
                    </div>
                    <ul class="actions special">
                        <li><input value="שלח" class="button next" type="submit" /></li>
                    </ul>
                </form>

            </div>
            <footer>
                <ul class="icons">
                    <li><a href="#" class="icon brands alt fa-twitter"><span class="label">Twitter</span></a></li>
                    <li><a href="https://www.facebook.com/tipulbamaimelrancohen/" class="icon brands alt fa-facebook-f"><span class="label">Facebook</span></a></li>
                    <li><a href="https://www.instagram.com/roga_elran/" class="icon brands alt fa-instagram"><span class="label">Instagram</span></a></li>
                    <li><a href="#" class="icon solid alt fa-phone"><span class="label">Phone</span></a></li>
                    <li><a href="#" class="icon solid alt fa-envelope"><span class="label">Email</span></a></li>
                </ul>
            </footer>
        </section>

    </div>

    <!-- Footer -->
    <footer id="footer">
        Copyright &copy; Noam Globerman and Einav Raviv Web Development. All rights reserved.
    </footer>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.dropotron.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>