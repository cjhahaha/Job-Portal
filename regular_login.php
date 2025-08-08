<?php
require("connect.php");
session_start();

if (isset($_POST['submit'])) {
    if (!empty(trim($_POST['username'])) && !empty(trim($_POST['password']))) {
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        // Use prepared statements to fetch the user
        $stmt = $con->prepare("SELECT * FROM regular_user WHERE username = ? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];

            // Verify the provided password against the hashed password
            if (password_verify($password, $hashed_password)) {
                if ($row['verify_status'] == "0") {
                    $_SESSION['status'] = "Please verify your email to login.";
                } elseif ($row['verification'] == "0") {
                    $_SESSION['status'] = "Your account is pending verification by the admin. Please wait.";
                } elseif ($row['verify_status'] == "1" && $row['verification'] == "1") {
                    $_SESSION['authenticated'] = TRUE;
                    $_SESSION['auth_user'] = [
                        'user_id' => $row['user_id'],
                        'username' => $row['username'],
                        'email' => $row['email'],
                        'age' => $row['age'],
                    ];
                    $_SESSION['status'] = "You are logged in successfully";
                    header("Location: skprojects.php");
                    exit(0);
                }
            } else {
                $_SESSION['status'] = "Invalid Username or Password";
            }
        } else {
            $_SESSION['status'] = "User not found";
        }
        header("Location: regular_login.php");
        exit(0);
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
    <style>
        .alert {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            margin-bottom: 50px;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            text-align: center;
            width: 100%;
        }
        .alert h5 {
            margin: 0;
            font-size: 16px;
        }
    </style>
</head>
<body style="background-image: linear-gradient(180deg, #282b2cbd 0%, rgba(0, 0, 0, .9) 1200px), url(images/sk.jpg);">
    <div class="account-form-container">
        <section class="account-form">
            <form action="regular_login.php" method="POST">
                <?php if (isset($_SESSION['status'])): ?>
                    <div class="alert alert-success">
                        <h5><?= $_SESSION['status']; ?></h5>
                    </div>
                    <?php unset($_SESSION['status']); ?>
                <?php endif; ?>
                <div class="form-wrapper">
                    <div class="sign-in">
                        <img src="images/Bacoor-official_logo.png" alt="barangay logo" class="barangay-logo">
                        <div class="sign-in_head">User Login</div>
                        <div class="sign-in_form">
                            <input type="text" name="username" maxlength="50" id="uname" placeholder="Username" required>
                            <input type="password" name="password" maxlength="50" id="password" placeholder="Password" required>
                            <div class="showpass-center">
                                <div class="center-wrapper">
                                    <div class="showpass-check">
                                        <input type="checkbox" name="showpass" id="showpass" onclick="togglePasswordVisibility()">
                                        <label for="showpass">Show Password</label>
                                    </div>
                                    <div class="admin-login">
                                        <a href="login.php">Admin Login</a>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" value="login" name="submit" class="btn login-button">Login</button>
                            <p>Don't have an account? <a href="register.php">Register</a></p>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>

    <script src="js/script.js"></script>
    <script>
        function togglePasswordVisibility() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>
</html>
