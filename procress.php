<?php
include 'connect.php';

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

if (empty($username) || empty($password) || empty($email)) {
    $_SESSION['Alert_Login'] = 'โปรดตรวจสอบ Username และ Password';
    header("Location: Regis.php");
    exit();
}

// Check if username already exists
$result = mysqli_query($connect, "SELECT * FROM user WHERE username = '$username'");
if (mysqli_num_rows($result) > 0) {
    // Username already exists, set session alert and redirect
    session_start();
    $_SESSION['Alert_Login'] = "Username นี้ถูกใช้ไปแล้ว";
    header("Location: Regis.php");
    exit();
}

// Username is unique, proceed to insert into database
mysqli_query($connect, "INSERT INTO user (username, password, email, Position) VALUE ('$username', '$password', '$email', '0')");

header("Location: LoginPAGE/login.php");
?>
