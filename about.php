<?php
session_start();
// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบแล้วหรือยัง
if (!isset($_SESSION['username'])) {
    $Login = 0;
} else {
    $Login = 1;
}

// โค้ดอื่นๆ ของหน้า welcome.php
// ...
?>
<?
$sql = "SELECT a_views FROM a_data";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
$a_views = $row['a_views'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" href="img/icon/ico.png" type="image/png">
    <?php include('HeaderStyle.php'); ?>
    <style>

    body p{
        font-size: 1.35rem;
    }

    .our-team {
    overflow:visible;
    text-align: center;
    border-radius: 20px;
    position: relative;
    transition: all 0.3s ease;
}

.our-team .pic {
    transition: all 0.3s ease 0s;
}

.our-team:hover .pic {
    padding: 10px;
    border-radius: 25px;
    transform: scale(0.8) translateY(-10%);
    cursor: pointer;
}

.our-team .pic img {
    border-radius: 100%;
    width: 200px;
    height: 200px;
    object-fit: cover;
}

.our-team .team-content {
    width: 100%;
    padding: 7px 15px;
    position: absolute;
    bottom: -40%;
    right: 0;
    opacity: 0;
    transition: all 0.3s ease 0s;
}

.our-team:hover .team-content {
    opacity: 1;
    bottom: -40%;
}

.our-team .title {
    font-size: 22px;
    color: #fff;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin: 0 0 5px 0;
}

.our-team .post {
    display: block;
    font-size: 1.3rem;
    font-weight: 600;
    color: #fff;
    font-style: italic;
    text-transform: capitalize;
    margin: 0 0 5px 0;
}

.our-team .social {
    padding: 0;
    margin: 0;
    list-style: none;
    transition: all 0.35s ease 0s;
}

.our-team .social li {
    transform: scale(1.3);
    display: inline-block;
    margin: 0 5px 0 0;
}

.our-team .social li a {
    display: block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    border-radius: 15px 0 15px 0;
    font-size: 20px;
    color: #fff;
    overflow: hidden;
    z-index: 1;
    position: relative;
    transition: all 0.35s ease 0s;
}

.our-team .social li a:before {
    content: "";
    width: 100%;
    height: 100%;
    background: #e06f06;
    position: absolute;
    top: 0;
    left: -100%;
    z-index: -1;
    transition: all 0.3s ease-in-out 0s;
}

.our-team .social li a:hover:before {
    left: 0;
}

@media only screen and (max-width: 990px) {
    .our-team {
        margin-bottom: 30px;
    }
}</style>
</head>
<header>
    <?php
    if ($Login == 1) {
    ?>
        <div class="logo-1">
            <h1><a href="welcome.php">food<span>Recipes</span></a></h1>
            <li class="nav">
                <a href="welcome.php">Home</a>
                <a href="about.php" class="Active">About</a>
                <a href="Recipes.php">Recipes</a>
                <a href="contact.php">Contact</a>
                <a href="MyFavorite.php">Favorate</a>
                <a href="logout.php" class="Runaway">Logout</a>
            </li>
        </div>
    <?php } ?>
    <?php
    if ($Login == 0) {
    ?>
            <div class="logo-1">
                <h1><a href="index.php">food<span>Recipes</span></a></h1>
                <li class="nav">
                    <a href="index.php">Home</a>
                    <a href="about.php" class="Active">About</a>
                    <a href="Recipes.php">Recipes</a>
                    <a href="contact.php">Contact</a>
                    <a href="LoginPAGE/login.php">Login</a>
                    <a href="Regis.php" class="Runaway">Register</a>
                </li>
            </div>
    <?php } ?>
</header>

<body style="overflow: hidden;">
<script type='text/javascript' src=''></script>
    <div class="Container">
        <div class="bg-image position-relative">
            <img src="Video-Login\Login-Video2.gif" class="img-fluid" style="width: 100vw; height:100vh; object-fit:cover;" alt="Login Video">
            <div class="mask position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.6);">
                <div class="justify-content-center align-items-center h-100 font-weight-bold">
                    <div class="text-white text-center" style="margin-top: 5%;">
                        <h1 class="mb-0 font-weight-bold" style="font-weight: bold; font-size:3rem;">ABOUT US<br>Food<span style="color:rgb(255, 174, 0);">Recipes</span></h1><br>
                        <p class="mb-0 w-100 text-center" style="padding-left:10%; padding-right:10%;">FoodRecipes เป็นเสมือนตัวทนที่ช่วยนำเสนอความหลากหลายของความอร่อยจากทุกมุมไปสู่การเรียนรู้ของชั้น 'ปวช.3' เว็บไซต์นี้ไม่เพียงแค่เป็นที่รวบรวมสูตรอาหารที่แสนอร่อยและน่าสนใจจากทั่วประเทศไทยเท่านั้น แต่ยังเป็นสถานที่ที่เชื่อมโยงความรู้สึกและวัฒนธรรมของคนไทย

การแบ่งปันสูตรอาหารที่อร่อยและสดใสไม่เพียงเป็นการส่งต่อความอร่อยจากบนโต๊ะอาหารไปยังหัวใจของคนหลาย ๆ คน แต่ยังเป็นวิทยาทานที่น่าประทับใจที่ช่วยเชื่อมโยงคนไทยและวัฒนธรรมที่หลากหลายในทุกภาคของประเทศนี้ไว้ด้วยกัน

เราไม่เพียงแค่มุ่งเน้นที่การนำเสนอสูตรอาหารของไทยที่หลากหลายและโดดเด่น แต่ยังให้ความสำคัญกับการสอนทุกขั้นตอนอย่างละเอียด ทำให้ทุกคนสามารถทำอาหารไทยที่อร่อยได้ด้วยตัวเอง

ด้วยรายการสูตรอาหารที่กระชับและเต็มไปด้วยข้อมูลเกี่ยวกับส่วนผสมที่ใช้ในแต่ละสูตร เรานำเสนอความง่ายต่อการทำและความอร่อยที่คุณสามารถพบเจอได้ตามคำแนะนำ ในที่สุด นอกจากความอร่อยแล้ว เรายังสร้างประสบการณ์การทำอาหารที่สมบูรณ์แบบที่ทำให้ทุกคนหลงรักในการทำอาหารไทยมากยิ่งขึ้นไปอีก</p>
                        </div>
                        <div style="margin-top: 2%;"></div>
    <div class="row justify-content-center">
    <h1 class="text-white text-center shadow shadow-lg p-2" style="margin-top: 0%; width:100vw; background-color: rgba(255, 174, 0, .35);"><i class="fa-solid fa-user-secret me-1"></i> ทีมงาน <span style="font-weight: bold;">Food<span style="color:#ffbc2c;">Recipes</span></span></h1>
        <div class="col-md-3 col-sm-3">
            <div class="our-team">
                <div class="pic">
                    <a target="_blank" href="https://www.facebook.com/profile.php?id=100035650962189"><img src="img/Fb_Pro/Om.jpg"></a>
                </div>
                <div class="team-content">
                    <h3 class="title">โอมครับ โอมครับ</h3>
                    <span class="post">Data Entry</span>
                    <ul class="social">
                        <li><a target="_blank" href="https://www.facebook.com/profile.php?id=100035650962189"><i class="fab fa-facebook"></i></a></li>
                        <li><a target="_blank" href="https://www.facebook.com/messages/t/100035650962189"><i class="fa-solid fa-message"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="our-team">
                <div class="pic">
                    <a target="_blank" href="https://www.facebook.com/profile.php?id=100077677238365"><img src="img/Fb_Pro/Songpon.jpg"></a>
                </div>
                <div class="team-content">
                    <h3 class="title">Songpon ST</h3>
                    <span class="post">web developer</span>
                    <ul class="social">
                        <li><a target="_blank" href="https://www.facebook.com/profile.php?id=100077677238365"><i class="fab fa-facebook"></i></a></li>
                        <li><a target="_blank" href="https://www.facebook.com/messages/t/100077677238365"><i class="fa-solid fa-message"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="our-team">
                <div class="pic">
                    <a target="_blank" href="https://www.facebook.com/profile.php?id=100082043061698"><img src="img/Fb_Pro/IMG_0365.jpeg"></a>
                </div>
                <div class="team-content">
                    <h3 class="title">Wirawat Auraikun</h3>
                    <span class="post">Data Entry</span>
                    <ul class="social">
                        <li><a target="_blank" href="https://www.facebook.com/profile.php?id=100082043061698"><i class="fab fa-facebook"></i></a></li>
                        <li><a target="_blank" href="https://www.facebook.com/messages/t/100082043061698"><i class="fa-solid fa-message"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/cefc293317.js" crossorigin="anonymous"></script>
    <script type='text/javascript'></script>
</body>

</html>