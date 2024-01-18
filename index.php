<?php
    session_start();
//     ตรวจสอบว่าผู้ใช้เข้าสู่ระบบแล้วหรือยัง
if (isset($_SESSION['username'])) {
    header("Location: welcome.php"); 
}
include 'connect.php';

$sql ="SELECT a_views FROM a_data";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
$a_views = $row['a_views']; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo-1">
           <h1><a href="index.php">food<span>Recipes</span></a></h1>
            <li class="nav">
                <a href="index.php" class="Active">Home</a>
                <a href="about.php">About</a>
                <a href="Recipes.php">Recipes</a>
                <a href="contact.php">Contact</a>
                <a href="LoginPAGE/login.php">Login</a>
                <a href="Regis.php" class="Runaway">Register</a>
            </li>
        </div>
    </header>
    <main>
        <div class="main-img">
            <img src="img/Untitled-1.png" alt="">
        </div>
        <div class="ms1">
            <h1>เริ่มทำอาหาร<br>กับสูตรเมนูสุดพิเศษ<br>ของเราสิ</h1>
            <p>วันนี้มาเรียนสูตรเจ๋ง ๆ กันดีกว่า! อยากได้สูตรการทำแต่ละภาคใช่ไหมล่ะ? <br>เตรียมพบกับสูตรที่ฟินสุด ๆ รับรองได้เลย!</p>
        </div>
        <div class="btugetstart">
            <a href="Recipes-nl.php">เริ่มเล่อ</a>
            <a href="LoginPAGE/login.php" class="logi">Login</a>
        </div>
    </main>
    <footer>

    </footer>
</body>
</html>
