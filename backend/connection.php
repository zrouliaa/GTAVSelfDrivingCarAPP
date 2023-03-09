<?php
    header('Access-Control-Allow-Origin: *');
    $db_host = "localhost";
    $db_user = "your_username";
    $db_password = "your_db_password";
    $db_name = "email_verif_test";

    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
?>
