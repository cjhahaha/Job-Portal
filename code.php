<?php
session_start();
include('connect.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Error reporting and output buffering
error_reporting(E_ALL);
ob_start();

function sendemail_verify($username, $email, $verification_token) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
        $mail->Username = 'odd.pug01@gmail.com';  // Your email
        $mail->Password = 'zwtzwsosdhinkuen';  // Your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('odd.pug01@gmail.com', 'Barangay Real');  // Your email and name
        $mail->addAddress($email, $username);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification From Barangay Real';
        $email_template = "
            <h2>You have Registered to Oportunidad Real</h2>
            <h5>Verify Your Email Address for Oportunidad Real</h5><br/>
            Hi $username,<br/>
            Thank you for registering on Oportunidad Real!<br/>
            To activate your account and access all the features of Oportunidad Real, please verify your email address by clicking on the following link:<br/><br/>
            <a href='http://localhost/oportunidadreal/include/verification.php?token=$verification_token' style='display: inline-block; padding: 10px 20px; font-size: 16px; color: white; background-color: #007BFF; text-decoration: none; border-radius: 5px;'>Verify</a>
            <br/><br/>
        ";
        $mail->Body = $email_template;

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}

if (isset($_POST['submit'])) {
    
    $f_name = mysqli_real_escape_string($con, $_POST['f_name']);
    $l_name = mysqli_real_escape_string($con, $_POST['l_name']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $birthday = isset($_POST['birthday']) ? mysqli_real_escape_string($con, $_POST['birthday']) : ''; // Handle if birthday is not set
    $location = mysqli_real_escape_string($con, $_POST['location']);
    $sex = mysqli_real_escape_string($con, $_POST['sex']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $verification_token = md5(rand());
    $terms_agreed = isset($_POST['terms_agreed']) ? 1 : 0;

    // Calculate age from date of birth
  

    // Validate age (must be 15 or older to register)
    if ($age < 15) {
        $_SESSION['status'] = 'You must be at least 15 years old to register.';
        header('Location: register.php');
        exit;
    }

    // Basic validation
    if ($password !== $confirm_password) {
        $_SESSION['status'] = 'Passwords do not match';
        header('Location: register.php');
        exit;
    }
    if (!preg_match('/^[a-zA-Z ]+$/', $f_name)) {
        $_SESSION['status'] = 'First name should contain only letters.';
        header('Location: register.php');
        exit;
    }

    if (!preg_match('/^[a-zA-Z ]+$/', $l_name)) {
        $_SESSION['status'] = 'Last name should contain only letters.';
        header('Location: register.php');
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $password_max_length = 30; // Maximum length for password
    $password_min_length = 6; // Minimum length for password

    if (strlen($password) > $password_max_length) {
        $_SESSION['status'] = 'Password is too long. Maximum length is ' . $password_max_length . ' characters.';
        header('Location: register.php');
        exit;
    } elseif (strlen($password) < $password_min_length) {
        $_SESSION['status'] = 'Password is too short. Minimum length is ' . $password_min_length . ' characters.';
        header('Location: register.php');
        exit;
    }

    // Password character check
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $password)) {
        $_SESSION['status'] = 'Password can only contain letters, numbers, and underscores.';
        header('Location: register.php');
        exit;
    }

    $username_max_length = 55; // Maximum length for username
    $username_min_length = 6; // Minimum length for username

    if (strlen($username) > $username_max_length) {
        $_SESSION['status'] = 'Username is too long. Maximum length is ' . $username_max_length . ' characters.';
        header('Location: register.php');
        exit;
    } elseif (strlen($username) < $username_min_length) {
        $_SESSION['status'] = 'Username is too short. Minimum length is ' . $username_min_length . ' characters.';
        header('Location: register.php');
        exit;
    }

    // Username character check
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $_SESSION['status'] = 'Username can only contain letters, numbers, and underscores.';
        header('Location: register.php');
        exit;
    }

    $check_email_query = "SELECT email FROM regular_user WHERE email='$email' LIMIT 1";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if (mysqli_num_rows($check_email_query_run) > 0) {
        $_SESSION['status'] = 'Email ID already exists';
        header('Location: register.php');
        exit;
    } else {
        
        // Insert user / Registered User Data
        if (sendemail_verify($username, $email, $verification_token)) {
            $query = "INSERT INTO regular_user (f_name, l_name, username, password, age, sex, email, location, birthday, verification_token, terms_agreed) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, 'ssssissssss', $f_name, $l_name, $username, $hashed_password, $age, $sex, $email, $location, $birthday, $verification_token, $terms_agreed);
            $query_run = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            if ($query_run) {
                $_SESSION['status'] = 'Registration successful! Please verify your email address. <br> Go back to <a href="regular_login.php">login</a>';
                header('Location: registrationsuccessful.php');
                exit;
            } else {
                $_SESSION['status'] = 'Registration failed';
                header('Location: register.php');
                exit;
            }
        } else {
            $_SESSION['status'] = 'Email could not be sent. Please try again later';
            header('Location: register.php');
            exit;
        }
    }
}
?>
