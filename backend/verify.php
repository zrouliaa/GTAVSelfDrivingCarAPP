<?php

    require('connection.php');

    if(isset($_GET['email']) && isset($_GET['verification_code'])) {

        $query = "SELECT * FROM `users` WHERE `email` = '$_GET[email]' AND `verification_code` = '$_GET[verification_code]'";
        $result = $conn->query($query);

        if($result === TRUE) {
            if(mysqli_num_rows($result) == 1) {
                $result_fetch = mysqli_fetch_assoc($result);
                if($result_fetch['is_verified'] == 0) {
                    $update = "UPDATE `users` SET `is_verified`='1' WHERE `email`='$result_fetch[email]'";
                    if($conn->query($update) === TRUE) {
                        echo " 
                            <script>
                                alert('Email Verification Successful');
                                window.location.href='/src/html/index.html';
                            </script>
                            
                        ";
                    } else {
                        echo " 
                            <script>
                                alert('Cannot Run Query');
                                window.location.href='/src/html/index.html';
                            </script>
                            
                        ";
                    }
                } else {
                    echo " 
                        <script>
                            alert('Email Already Registered');
                            window.location.href='/src/html/index.html';
                        </script>
                        
                    ";
                }
            }
        } else {
            echo " 
                <script>
                    alert('Cannot Run Query');
                    window.location.href='/src/html/index.html';
                </script>
                
            ";
        }

    }

?>