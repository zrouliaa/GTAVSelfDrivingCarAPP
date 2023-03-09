<?php
  require('connection.php');

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  function sendMail($username, $email, $verification_code) {
    require('PHPMailer/PHPMailer.php');
    require('PHPMailer/SMTP.php');
    require('PHPMailer/Exception.php');

    $mail = new PHPMailer(true);

    try {
      //Server settings
      $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'your_email';                           //SMTP username
      $mail->Password   = 'your_email_password';                  //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
  
      //Recipients
      $mail->setFrom('zrouli.aa@gmail.com', 'zrouliaa');
      $mail->addAddress($email, $username);     //Add a recipient
  
      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'GTAVSelfDrivingCarAPP Email Verification';
      $mail->Body    = "Hi $username,</br></br>Thank you for signing up! Please click <a href='http://localhost/backend/verify.php?email=$email&verification_code=$verification_code'> here </a> to verify your email address.</br></br>Best regards,</br>GTAVSelfDrivingCarAPP";
  
      $mail->send();
      return true;
    } catch (Exception $e) {
        return false;
    }
  }

  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $age = $_POST["age"];

  $verification_code = bin2hex(random_bytes(16));

  $query = "INSERT INTO `users`(`username`, `email`, `password`, `fname`, `lname`, `age`, `verification_code`, `is_verified`) VALUES ('$username', '$email', '$password', '$fname', '$lname', '$age', '$verification_code', '0')";

  if ($conn->query($query) === TRUE && sendMail($username, $email, $verification_code)) {
    echo " 
      <script>
        alert('Registration Successful');
      </script>
    
    ";
  } else {
    echo "
      <script>
        alert('Username or Email already exists');
      </script>
    ";
  }

  $conn->close();
?>
