<?php
    header('Access-Control-Allow-Origin: *');
    $db_host = "localhost";
    $db_user = "zrouliaa";
    $db_password = "itsaazrouli2002";
    $db_name = "email_verif_test";

    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
?>