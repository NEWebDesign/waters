<?php
    include_once('connect.php');
    session_start();
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    }else{
        header('Location: login.php');
    }

    if(isset($_POST['fullname1'])){
        $fullname1 = $_POST['fullname1'];
    }else{
        $fullname1 = '';
    }
    if($fullname1 != ''){
        $_SESSION['fullname'] = $fullname1;
        header('Location: client.php');
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>רשימת לקוחות</title>
</head>
<body>
<h1>רשימת לקוחות</h1>
<?php
    $query = $conn->query("SELECT * FROM clients");
    if($query->num_rows > 0){
        while ($row = $query->fetch_assoc()) {
            ?>
            <form method = "post">
                <input type = "hidden" name = "fullname1" value = "<?php echo $row['fullname'];?>">
                <input type = "submit" value = "<?php echo $row['fullname'];?>">
            </form>
            <?php
        }
    }
?>






</body>
</html>