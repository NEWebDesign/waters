<?php
    session_start();
    if(isset($_SESSION['username']) && isset($_SESSION['fullname'])){
        $fullname = $_SESSION['fullname'];
        $username = $_SESSION['username'];
    }else{
        header('Location: login.php');
    }
    include_once('connect.php');
    $sqlselect = $conn->prepare("select * from clients where fullname = ?");
    $sqlselect->bind_param("s", $fullname);
    $sqlselect->execute();
    $sqlselect->store_result();
    $sqlselect->bind_result($id, $fullname, $pname1, $pname2, $cell1, $cell2, $payed, $type, $treatmentnum, $comments);
    $sqlselect->fetch();
    $sqlselect->close();

    if(isset($_POST['price'])){
        $price = $_POST['price'];
    }else{
        $price = '';
    }
    if($price != ''){
        $payed = $payed + $price;
        $treatmentnum = $treatmentnum + 1;
        $sql = "UPDATE clients SET payed = $payed, treatmentnum = $treatmentnum WHERE fullname = '$fullname'";
        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
    if(isset($_POST['comments1'])){
        $comments1 = $_POST['comments1'];
    }else{
        $comments1 = '';
    }
    if($comments1 != ''){
        $sql = "UPDATE clients SET comments = '$comments1' WHERE fullname = '$fullname'";
        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>לקוח</title>
</head>
<body dir = "rtl">
<h1><?php echo $fullname; ?></h1>
<hr>
<span>שם הורה ראשון: <?php echo $pname1; ?> </span> 
<br>
<span> מספר טלפון: <?php echo $cell1; ?></span>
<br>
<span>שם הורה שני: <?php echo $pname2; ?> </span>
<br>
<span>מספר טלפון: <?php echo $cell2; ?></span>
<br>
<span>סוג טיפול: <?php echo $type; ?></span>
<br>
<span>מספר טיפול: <?php echo $treatmentnum; ?></span>
<br>
<span>עד כה שילם <?php echo $payed; ?> שקלים.</span>
<br>
<span>הערות: <?php echo $comments; ?></span>

<form method = "post">
    <h1>הוספת טיפול ותשלום</h1>
    <input type = "text" name = "price" placeholder = "מחיר">
    <br>
    <input type = "submit" value = "הוסף">
</form>
<form method = "post">
    <h1>שינוי הערות</h1>
    <textarea name = "comments1" placeholder = "הערה חדשה"></textarea>
    <br>
    <input type = "submit" value = "עדכון">
</form>







<a href = "panel.php">בחזרה לפאנל</a>
</body>
</html>