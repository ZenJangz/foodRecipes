<?php
session_start(); // เริ่มต้นเซสชัน (session)

include 'connect.php'; // เชื่อมต่อกับฐานข้อมูล

if (!isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $email = mysqli_real_escape_string($connect, $_POST['username']);
    // if(!empty($cpAll)){
    //     header("Location: Menu-detail.php");
    // }else{
    //     echo"No Login";
    // }
    // ค้นหาผู้ใช้งานในฐานข้อมูล
    $query = "SELECT * FROM user WHERE (username = '$username' OR email = '$email') AND password = '$password'";
    $result = mysqli_query($connect, $query);
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if ($count == 1) {
        if ($row['Position'] == 1) {
            $usernameFromDB = $row['username'];
            $_SESSION['username'] = $usernameFromDB;
            $_SESSION['Position'] = $row['Position'];
            header("Location: Admin-Home.php");
        } else {
            // ผู้ใช้งานพบ
            $_SESSION["myID"] = $row["ID"];
            $usernameFromDB = $row['username'];
            $_SESSION['username'] = $usernameFromDB;
            $_SESSION['Position'] = $row['Position'];
            header("Location: welcome.php");
        }
    } else {
        // ผู้ใช้งานไม่พบ หรือ username/password/ID ไม่ตรง
        $_SESSION['Alert_Login'] = 'โปรดตรวจสอบ Username และ Password';
        header("Location: LoginPAGE\login.php");
        exit();
    }
}
