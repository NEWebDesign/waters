<?php

    include_once('connect.php');

    // FORM HANDALING //
    if(isset($_POST['fullname'])){
        $fullname = $_POST['fullname'];
    }else{
        $fullname = '';
    }
    if(isset($_POST['pname1'])){
        $pname1 = $_POST['pname1'];
    }else{
        $pname1 = '';
    }
    if(isset($_POST['pname2'])){
        $pname2 = $_POST['pname2'];
    }else{
        $pname2 = '';
    }
    if(isset($_POST['cell1'])){
        $cell1 = $_POST['cell1'];
    }else{
        $cell1 = '';
    }
    if(isset($_POST['cell2'])){
        $cell2 = $_POST['cell2'];
    }else{
        $cell2 = '';
    }
    if(isset($_POST['type'])){
        $type = $_POST['type'];
    }else{
        $type = '';
    }
    if(isset($_POST['comments'])){
        $comments = $_POST['comments'];
    }else{
        $comments = '';
    }
    $payed = 0;
    $treatmentnum = 0;

    if($fullname != '' && $pname1 != '' && $pname2 != '' && $cell1 != '' && $cell2 != '' && $type != '' && $comments != ''){
        $id = uniqid();

        // inserting the data to the DB //
        $sqlinsert = $conn->prepare("insert into clients(id,fullname,pname1,pname2,cell1,cell2,payed,type,treatmentnum,comments) values(?,?,?,?,?,?,?,?,?,?)");
        $sqlinsert->bind_param("ssssssisis", $id, $fullname, $pname1, $pname2, $cell1, $cell2, $payed, $type, $treatmentnum, $comments);
        $sqlinsert->execute();
        //closing the connection
        $sqlinsert->close();
        $conn->close();
        header('Location: clients.php');
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>הוספת לקוח</title>
</head>
<body>
    <h1>הוספת לקוח</h1>
    <form method = "post">
        <input type = "text" name = "fullname" placeholder = "שם מלא של הלקוח">
        <br>
        <input type = "text" name = "pname1" placeholder = "שם הורה ראשון">
        <br>
        <input type = "text" name = "cell1" placeholder = "מספר טלפון">
        <br>
        <input type = "text" name = "pname2" placeholder = "שם הורה שני">
        <br>
        <input type = "text" name = "cell2" placeholder = "מספר טלפון">
        <br>
        <input type = "text" name = "type" placeholder = "סוג טיפול">
        <br>
        <input type = "text" name = "comments" placeholder = "הערות">
        <br>
        <input type = "submit" value = "הוסף">
        





</body>
</html>