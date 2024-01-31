<?php
    session_start();
    // ตรวจสอบว่าผู้ใช้เข้าสู่ระบบแล้วหรือยัง
if (!isset($_SESSION['username'])) {
    $Login= 0;
}else{
    $Login=1;
}

// โค้ดอื่นๆ ของหน้า welcome.php
// ...
include 'connect.php';
$sql ="UPDATE a_data SET a_views=a_views+1";
$result = mysqli_query($connect, $sql);

$sql ="SELECT a_views FROM a_data";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
$a_views = $row['a_views']; 

$sql = "SELECT * FROM menu_data";
$query_Menu = mysqli_query($connect, $sql);

if (!$query_Menu) {
    die("Query failed: " . mysqli_error($connect));
}
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM menu_data WHERE Menu_name LIKE '%$search%'";

$query_Menu = mysqli_query($connect, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recipes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="shortcut icon" href="img/icon/ico.png" type="image/x-icon">
    <!-- <link rel="stylesheet" href="Style.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?php include('HeaderStyle.php'); ?>
</head>
<body>
    <header>
        <div class="logo-1">
           <h1><a href="index.php">food<span>Recipes</span></a></h1>
           <?php if($Login==1){?>
            <li class="nav">
                <a href="welcome.php">Home</a>
                <a href="about.php">About</a>
                <a href="Recipes.php" class="Active">Recipes</a>
                <a href="contact.php">Contact</a>
                <a href="MyFavorite.php">Favorate</a>
                <a href="logout.php" class="Runaway">Logout</a>
            </li>
            <?php }else{?>
                <li class="nav">
                <a href="index.php">Home</a>
                <a href="about.php">About</a>
                <a href="Recipes.php" class="Active">Recipes</a>
                <a href="contact.php">Contact</a>
                <a href="LoginPAGE/login.php">Login</a>
                <a href="Regis.php" class="Runaway">Register</a>
            </li>
            <?php }?>
        </div>
    </header>
    <div>
        <h1 class="text-center m-lg-4">รายการเมนู</h1>
    </div>
    <?php 
        include("menulist.php");
    ?>
    <div style="margin-top: 5%;"></div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/cefc293317.js" crossorigin="anonymous"></script>
</html>