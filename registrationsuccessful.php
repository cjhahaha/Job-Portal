<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Succesfull</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .box1 {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            width: 48%;
            box-sizing: border-box;
        }
        .box1 i {
            margin-right: 10px;
            font-size: 18px;
        }
        .box1 input, .box1 select {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }
        .header .flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .account-form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .account-form {
            width: 100%;
            max-width: 700px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 10px;
        }
        .input-group {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .status-message {
            color: green;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 10px;
        }
        
        @media (max-width: 768px) {
            .box1 {
                width: 100%;
            }
        }
    </style>
</head>
<body style="background-image: linear-gradient(180deg, #282b2cbd 0%, rgba(0, 0, 0, .9) 1200px), url(images/sk.jpg);">
    <div class="account-form-container">

        <section class="account-form">


            <form action="regular_login.php" method="POST">
                
                <div class="form-wrapper">
                    <div class="sign-in">
                        <img src="images/Bacoor-official_logo.png" alt="barangay logo" class="barangay-logo">
                        <div class="sign-in_head"></div>
                        <div class="sign-in_form">
                           

   
                <?php
                if(isset($_SESSION['status'])){

                    echo "<h4 class='status-message'>".$_SESSION['status']."</h4>";
                    unset($_SESSION['status']);
                }

                ?>

</form>
        </section>
    </div>
    <script>
        function validateForm() {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirm_password').value;
            if (password !== confirmPassword) {
                alert('Passwords do not match. Please try again.');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
