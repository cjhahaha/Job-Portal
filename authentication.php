<?php
session_start();

require("connect.php"); // Assuming "connect.php" contains the database connection

if (!isset($_SESSION['authenticated'])) {
    header("location: login.php");
    exit(0);
} else {
    $user_id = $_SESSION['auth_user']['user_id'];
    $sql = "SELECT * FROM `regular_user` WHERE user_id = $user_id";
    $query = mysqli_query($con, $sql);
    $userdata = mysqli_fetch_array($query);

    // Check if user data is found
    if ($userdata) {
        //echo "User ID: " . $userdata['user_id'];
    } else {
        echo "User data not found";
    }
}

?>
