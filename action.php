<?php

    $conn = new mysqli("localhost", "root", "", "admin");
    if(isset($_POST['send'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subline = $_POST['subline'];
        $msg = $_POST['msg'];
        $comma = ",";
        $semi = "'";
        $sql = "insert into message(name, email, subline, msg) values ('$name', '$email', '$subline', '$msg')";
        $conn->query($sql);
        header('location: index.php');
        
    }
    