<?php
include 'connect.php';
session_start();
if($_SESSION['Position']==0){
    echo'
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
  
    <!-- Custom styles for this template-->
    <link href="Admin/css/sb-admin-2.min.css" rel="stylesheet">
  
    <div class="container-fluid">
  
    <!-- 404 Error Text -->
    <div class="text-center">
        <div class="error mx-auto" data-text="404">404</div>
        <p class="lead text-gray-800 mb-5">Page Not Found</p>
        <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
        <a href="/food_web/index.php">&larr; Back to Dashboard</a>
    </div>';
    exit;
  }



if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $Position = mysqli_real_escape_string($connect, $_POST['Position']);

    $result = mysqli_query($connect, "SELECT * FROM user WHERE username = '$username'") or die (mysqli_error($connect));
if (mysqli_num_rows($result) > 0) {
    // Username already exists, set session alert and redirect
    $_SESSION['Alert'] = "Username นี้ถูกใช้ไปแล้ว";
    $_SESSION['Setcolor'] = 'text-danger';
    header("Location: Admin-List-Users-AddUser.php");
    exit();
}

if ($Position > 1){
    $_SESSION['Alert'] = "Position ต้องไม่มากกว่า 1";
    $_SESSION['Setcolor'] = 'text-danger';
    header("Location: Admin-List-Users-AddUser.php");
    exit();
}

$sql = "INSERT INTO user
(username, password, email, Position) VALUE
('$username', '$password', '$email', '$Position')";
$query = mysqli_query($connect, $sql) or die (mysqli_error($connect));

if($query){
    $_SESSION['Alert'] = 'บันทึกลงฐานข้อมูลแล้ว';
    $_SESSION['Setcolor'] = 'text-success';
    header("Location: Admin-List-Users-AddUser.php");
    exit();
}else{
    $_SESSION['Alert'] = 'บันทึกลงฐานข้อมูลล้มเหลว';
    $_SESSION['Setcolor'] = 'text-danger';
    header("Location: Admin-List-Users-AddUser.php");
    exit();
}

}?>