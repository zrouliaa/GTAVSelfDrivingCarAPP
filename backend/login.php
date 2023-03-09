<?php
  require('connection.php');

  if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];


    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

    $result = $conn->query($query);


    if ($result->num_rows > 0) {
      echo "You are logged in";
    } else {
      echo "Wrong username or password.";
    }

  } else {
    echo "Please enter username and password.";
  }
  $conn->close();

?>
