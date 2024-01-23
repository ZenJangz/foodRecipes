<?php
    session_start();
    // ตรวจสอบว่าผู้ใช้เข้าสู่ระบบแล้วหรือยัง
if (!isset($_SESSION['username'])) {
    header("Location: index.php"); // เปลี่ยนเส้นทางไปยังหน้า index.html
    exit(); // ออกจากสคริปต์
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

$chackuser = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE (username = '$chackuser')";
$row = mysqli_query($connect, $sql);
$data = mysqli_fetch_assoc($row);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@500&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="img/icon/ico.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">

    <style>
        #displayedImage {
        animation: fadeInOut 7s ease-in-out infinite;
    }

    @keyframes fadeInOut {
        0% {
            opacity: 0;
        }
        10% {
            opacity: 0;
        }
        25% {
            opacity: 1;
        }
        50% {
            opacity: 1;
        }
        75% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }
    </style>
</head>
<body>
    <header>
    <div class="logo-1">
            <h1><a href="welcome.php">food<span>Recipes</span></a></h1>
            <li class="nav">
                <a href="welcome.php" class="Active">Home</a>
                <a href="about.php">About</a>
                <a href="Recipes.php">Recipes</a>
                <a href="contact.php">Contact</a>
                <a href="MyFavorite.php">Favorate</a>
                <a href="logout.php" class="Runaway">Logout</a>
            </li>
        </div>
    </header>
    <main>
        <!-- <div class="main-img">
            <img src="img/Untitled-1.png" alt="">
        </div> -->
        <?php
        // กำหนดที่พาธของโฟลเดอร์
        $folderPath = 'img/';

        // กำหนดรูปแบบของไฟล์ที่ต้องการค้นหา (.png)
        $filePattern = $folderPath . '*.png';

        // ใช้ฟังก์ชัน glob เพื่อดึงรายชื่อไฟล์ที่ตรงกับรูปแบบที่กำหนด
        $files = glob($filePattern);

        // นับจำนวนไฟล์
        $fileCount = count($files);
        ?>


        <div class="main-img" id="imageContainer">
            <img src="img/<?=$fileCount?>.png" alt="Image" id="displayedImage" class="main-img-img">
        </div>



        <div class="ms1">
            <h1>ยินดีต้อนรับ <span style="color:rgb(255,174,0)";><?php echo $_SESSION['username'];?></span></h1>
            <h1>เริ่มทำอาหารกับสูตร<br>เมนูสุดพิเศษของเราสิ</h1>
            <p>วันนี้มาเรียนสูตรเจ๋ง ๆ กันดีกว่า! อยากได้สูตรการทำแต่ละภาคใช่ไหมล่ะ? <br>เตรียมพบกับสูตรที่ฟินสุด ๆ รับรองได้เลย!</p>
        </div>
        <div class="btugetstart">
            <a href="Recipes.php">เริ่มเล่อ</a>
        </div>
        <!-- <div class="btugetstart">
            <a href="">เริ่มเล่อ</a>
            <div class="TestOnlyText">
                 <h1>จำนวนการชม = <?php echo $a_views; ?></h1>
                 <p class="TestOnlyText">(Test Only)</p>
            </div>
        </div> -->
    </main>
    <footer>

    </footer>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let currentImageIndex = 1;
            const imageContainer = document.getElementById("imageContainer");
            const displayedImage = document.getElementById("displayedImage");

            setInterval(function () {
                // Increment the current image index
                currentImageIndex++;

                // Reset to the first image if it exceeds the total number of images
                if (currentImageIndex > <?=$fileCount?>) {
                    currentImageIndex = 1;
                }

                // Update the source of the displayed image
                displayedImage.src = `img/${currentImageIndex}.png`;
            }, 7000); // Change image every 5 seconds
        });
    </script>
</body>
</html>
