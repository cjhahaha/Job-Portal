<?php
require("connect.php");
session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind the statement
    $stmt = $con->prepare("SELECT * FROM `login` WHERE `username` = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verify the entered password against the hashed password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['AdminLoginID'] = $username;
            $_SESSION['auth'] = true;
            $_SESSION['auth_user'] = [
                'username' => $row['username']
            ];

            // Check the role and redirect accordingly
            if ($row['usertype'] == 'super admin') {
                $_SESSION['auth_role'] = "super admin";
                $_SESSION['message'] = "Welcome Superior Admin";
                header("Location: admin/superadminhome.php");
                exit;
            } elseif ($row['usertype'] == 'listing') {
                $_SESSION['auth_role'] = "listing";
                $_SESSION['message'] = "Welcome Listing Admin";
                header("Location: admin/home.php");
                exit;
            } elseif ($row['usertype'] == 'maintenance') {
                $_SESSION['auth_role'] = "maintenance";
                $_SESSION['message'] = "Welcome Maintenance Admin";
                header("Location: admin/contacts.php");
                exit;
            }
        } else {
            $_SESSION['error'] = "Invalid username or password";
            header("Location: login.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "No Admin Account Registered";
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login-register.css">
</head>
<body style="background-image: linear-gradient(180deg, #282b2cbd 0%, rgba(0, 0, 0, .9) 1200px), url(images/sk.jpg);">
<div class="form-wrapper">
    <div class="sign-in">
        <img src="images/Bacoor-official_logo.png" alt="barangay logo" class="barangay-logo">
        <div class="sign-in_head">Admin Login</div>
        <div class="sign-in_form">
            <form method="POST">
                <input type="text" name="username" maxlength="50" id="uname" placeholder="Username" required>
                <input type="password" name="password" maxlength="50" id="pword" placeholder="Password" required>
                <div class="showpass-center">
                    <div class="center-wrapper">
                        <div class="showpass-check">
                            <input type="checkbox" name="showpass" id="showpass" onclick="togglePassword()">
                            <label for="showpass">Show Password</label>
                        </div>
                        <div class="admin-login">
                            <a href="regular_login.php">User Login</a>
                        </div>
                    </div>
                </div>
                <button type="submit" value="login" name="submit" class="btn login-button">Login</button>
            </form>
            
        </div>
    </div>
</div>
<script>
    function togglePassword() {
        var x = document.getElementById("pword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
</body>
</html>
