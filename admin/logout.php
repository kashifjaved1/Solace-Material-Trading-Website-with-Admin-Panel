<?php

    session_start();

    if($_SESSION['is_allowed'] == "yes"){
        unset($_SESSION['is_allowed']);
        header('location: index.php');
    }
    else{
        header('location: index.php');
    }