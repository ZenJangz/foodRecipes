<?php
include 'connect.php';
session_start();
// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบแล้วหรือยัง
if (!isset($_SESSION['username'])) {

    // header("Location: index.php"); // เปลี่ยนเส้นทางไปยังหน้า
    $listpage = ('
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<header>
    <div class="logo-1">
    <h1><a href="index.php">food<span>Recipes</span></a></h1>
     <li class="nav">
         <a href="index.php">Home</a>
         <a href="about.php">About</a>
         <a href="Recipes-nl.php" class="Active">Recipes</a>
         <a href="contact.php">Contact</a>
         <a href="LoginPAGE/login.php">Login</a>
         <a href="Regis.php" class="Runaway">Register</a>
     </li>
 </div>
 </header>');
    // echo $listpage;

}

// โค้ดอื่นๆ ของหน้า welcome.php
// ...

$sql = "UPDATE a_data SET a_views=a_views+1";
$result = mysqli_query($connect, $sql);

$sql = "SELECT a_views FROM a_data";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
$a_views = $row['a_views'];



$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM menu_data WHERE Menu_name LIKE '%$search%'";
$query_Menu = mysqli_query($connect, $sql);





if ($result) {
    $row = mysqli_fetch_array($result);
    // Process the data as needed
} else {
    // Display the SQL error message
    echo "Error: " . mysqli_error($connect);
}
$sql = "SELECT * FROM menu_data";
$result = $connect->query($sql);
$data = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="Style.css"> -->
    <?php include('HeaderStyle.php'); ?>
    <style>
        .product-container {
            margin-top: 50px;
        }

        .product-image-main {
            cursor: pointer;
            width: 100%;
            object-fit: cover;
            transition: 0.3s ease;
            max-height: 100%;
        }

        .product-thumbnail {
            object-fit: cover;
            width: 100%;
            height: 100%;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .product-image-main:hover {
            border-radius: 25px;
            transform: scale(1.05);
            opacity: 0.7;
            transition: 0.3s ease;
        }

        .product-thumbnail:hover {
            border-radius: 25px;
            transform: scale(1.1);
            opacity: 0.7;
            transition: 0.3s ease;
        }

        .Search-System {
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .Search-Form {
            text-align: center;
            transition: .3s ease;
        }

        .Search-Label {
            margin-right: 10px;
        }

        .Search-input {
            padding: .3rem;
            padding-right: 35rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: .3s ease;
        }

        .Search-Form:hover {
            transform: scale(1.035);
            transition: .3s ease;
        }

        .Search-Submit {
            padding: 5px 10px;
            background-color: rgb(255, 174, 0);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: .3s ease;
        }

        .Search-Submit:hover {
            background-color: rgb(218, 149, 3);
            padding: 10px 20px;
            transition: .3s ease;
            font-size: 1rem;
        }

        #popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 998;
            border-radius: 2rem;
            text-align: center;
            overflow: hidden;
            transition: 0.3s ease;
        }

        #popup img {
            min-width: 45rem;
            min-height: 45rem;
            max-width: 70rem;
            max-height: 50rem;
            object-fit: cover;
            transition: 0.3s ease;
        }

        #overlay {
            display: none;
            position: fixed;
            left: 0;
            right: 0;
            padding: 0;
            margin: 0;
            top: 0;
            width: 100%;
            height: 100vh;
            min-height: 100vh;
            background-color: rgba(0, 0, 0);
            z-index: 997;
            /* ลด z-index ลงเพื่อให้เป็นต่ำกว่า #popup */
            overflow: hidden;
        }

        #popup.show {
            width: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s ease;
            cursor: pointer;
        }

        #overlay.show {
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s ease;
            opacity: 50%;
        }
    </style>
</head>

<body>
    <?php
    if (!isset($_SESSION['username'])) {
        echo $listpage;
    } else {
        echo '<header>
            <div class="logo-1">
               <h1><a href="index.php">food<span>Recipes</span></a></h1>
               <li class="nav">
                    <a href="welcome.php">Home</a>
                    <a href="about.php">About</a>
                    <a href="Recipes.php" class="Active">Recipes</a>
                    <a href="contact.php">Contact</a>
                    <a href="MyFavorite.php">Favorate</a>
                    <a href="logout.php" class="Runaway">Logout</a>
                </li>
            </div>
        </header>';
    }
    ?>
    <div class="Search-System">
        <form method="GET" action="SearchMenu.php" class="Search-Form">
            <label for="search" class="Search-Label">ค้นหาเมนู: </label>
            <input type="text" name="search" id="search" class="Search-input">
            <input type="submit" value="ค้นหา" class="Search-Submit">
        </form>
    </div>
    <div class="s" id="searchResult"></div>
    <?php
    $p_id = $_GET["Menu-ID"];
    $sql = "SELECT * FROM menu_data WHERE id_menu = $p_id";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);
    ?>
    <?php
    $p_id = $_GET["Menu-ID"];
    $sql = "SELECT * FROM menu_data WHERE id_menu = $p_id";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);
    ?>
    <br>
    <div class="container product-container">
        <div class="row">
            <div class="col-5">
                <img src="<?php if (!empty($row['Img_Name_Main'])) {
                                echo 'Admin/Image_Uploaded/' . $row['Img_Name_Main'];
                            } else if (!empty($row['Img_URL_Main'])) {
                                echo $row['Img_URL_Main'];
                            } else if (!empty($row['Image_URL_Sec1'])) {
                                echo $row['Image_URL_Sec1'];
                            } else if (!empty($row['Image_Name_Sec1'])) {
                                echo 'Admin/Image_Uploaded/' . $row['Image_Name_Sec1'];
                            } else if (!empty($row['Image_URL_Sec2'])) {
                                echo $row['Image_URL_Sec2'];
                            } else if (!empty($row['Image_Name_Sec2'])) {
                                echo 'Admin/Image_Uploaded/' . $row['Image_Name_Sec2'];
                            } else if (!empty($row['Image_URL_Sec3'])) {
                                echo $row['Image_URL_Sec3'];
                            } else if (!empty($row['Image_Name_Sec3'])) {
                                echo 'Admin/Image_Uploaded/' . $row['Image_Name_Sec3'];
                            } else {
                                echo 'https://italiancinemaaudiences.org/wp-content/themes/trend/assets/img/empty/424x500.png';
                            }
                            ?>" alt="Image" onclick="openPopup(this)" class="img-fluid product-image-main m-auto">
                <div class="row mt-4 justify-content-center">
                    <div class="col">
                        <img src="<?php if (!empty($row['Image_URL_Sec1'])) {
                                        echo $row['Image_URL_Sec1'];
                                    } else if (!empty($row['Image_Name_Sec1'])) {
                                        echo 'Admin/Image_Uploaded/' . $row['Image_Name_Sec1'];
                                    } else if (!empty($row['Image_URL_Sec2'])) {
                                        echo $row['Image_URL_Sec2'];
                                    } else if (!empty($row['Image_Name_Sec2'])) {
                                        echo 'Admin/Image_Uploaded/' . $row['Image_Name_Sec2'];
                                    } else if (!empty($row['Image_URL_Sec3'])) {
                                        echo $row['Image_URL_Sec3'];
                                    } else if (!empty($row['Image_Name_Sec3'])) {
                                        echo 'Admin/Image_Uploaded/' . $row['Image_Name_Sec3'];
                                    } else if (!empty($row['Img_Name_Main'])) {
                                        echo 'Admin/Image_Uploaded/' . $row['Img_Name_Main'];
                                    } else if (!empty($row['Img_URL_Main'])) {
                                        echo $row['Img_URL_Main'];
                                    } else {
                                        echo 'https://italiancinemaaudiences.org/wp-content/themes/trend/assets/img/empty/424x500.png';
                                    }
                                    ?>" alt="Image" onclick="openPopup(this)" class="img-fluid product-thumbnail">
                    </div>
                    <div class="col">
                        <img src="<?php
                                    if (!empty($row['Image_URL_Sec2'])) {
                                        echo $row['Image_URL_Sec2'];
                                    } else if (!empty($row['Image_Name_Sec2'])) {
                                        echo 'Admin/Image_Uploaded/' . $row['Image_Name_Sec2'];
                                    } else if (!empty($row['Image_URL_Sec3'])) {
                                        echo $row['Image_URL_Sec3'];
                                    } else if (!empty($row['Image_Name_Sec3'])) {
                                        echo 'Admin/Image_Uploaded/' . $row['Image_Name_Sec3'];
                                    } else if (!empty($row['Image_URL_Sec1'])) {
                                        echo $row['Image_URL_Sec1'];
                                    } else if (!empty($row['Image_Name_Sec1'])) {
                                        echo 'Admin/Image_Uploaded/' . $row['Image_Name_Sec1'];
                                    } else if (!empty($row['Img_Name_Main'])) {
                                        echo 'Admin/Image_Uploaded/' . $row['Img_Name_Main'];
                                    } else if (!empty($row['Img_URL_Main'])) {
                                        echo $row['Img_URL_Main'];
                                    } else {
                                        echo 'https://italiancinemaaudiences.org/wp-content/themes/trend/assets/img/empty/424x500.png';
                                    } ?>" alt="Image" onclick="openPopup(this)" class="img-fluid product-thumbnail">
                    </div>
                    <div class="col">
                        <img src="<?php
                                    if (!empty($row['Image_URL_Sec3'])) {
                                        echo $row['Image_URL_Sec3'];
                                    } else if (!empty($row['Image_Name_Sec3'])) {
                                        echo 'Admin/Image_Uploaded/' . $row['Image_Name_Sec3'];
                                    } else if (!empty($row['Image_URL_Sec1'])) {
                                        echo $row['Image_URL_Sec1'];
                                    } else if (!empty($row['Image_Name_Sec1'])) {
                                        echo 'Admin/Image_Uploaded/' . $row['Image_Name_Sec1'];
                                    } else if (!empty($row['Image_URL_Sec2'])) {
                                        echo $row['Image_URL_Sec2'];
                                    } else if (!empty($row['Image_Name_Sec2'])) {
                                        echo 'Admin/Image_Uploaded/' . $row['Image_Name_Sec2'];
                                    } else if (!empty($row['Img_Name_Main'])) {
                                        echo 'Admin/Image_Uploaded/' . $row['Img_Name_Main'];
                                    } else if (!empty($row['Img_URL_Main'])) {
                                        echo $row['Img_URL_Main'];
                                    } else {
                                        echo 'https://italiancinemaaudiences.org/wp-content/themes/trend/assets/img/empty/424x500.png';
                                    } ?>" alt="Image" onclick="openPopup(this)" class="img-fluid product-thumbnail">
                    </div>
                </div>
            </div>
            <div id="popup">
                <img id="popup-image" src="" alt="Popup Image">
                <!-- <div id="overlay" onclick="closePopup()"></div> -->
            </div>
            <div id="overlay"></div>
            <div class="col" style="font-size: 1.4231rem;">
                <h1><?= $row['Menu_name'] ?></h1>
                <p><strong>คำอธิบาย:</strong><?= $row['Menu_EP'] ?></p>
                <p><strong>วัตถุดิบ:</strong> <?php
                                                if (!empty($row['Menu_Mat1'])) {
                                                    echo "- " . $row['Menu_Mat1'] . '<br>';
                                                } else {
                                                }
                                                ?>
                    <?php
                    if (!empty($row['Menu_Mat2'])) {
                        echo "- " . $row['Menu_Mat2'] . '<br>';
                    } else {
                    }
                    ?>
                    <?php
                    if (!empty($row['Menu_Mat3'])) {
                        echo "- " . $row['Menu_Mat3'] . '<br>';
                    } else {
                    }
                    ?></p>
                <p><strong>วันที่:</strong> <?= $row['Date'] ?></p>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" width="560" height="315" src="<?= $row['YT_URL']; ?>" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            // เมื่อมีการพิมพ์ใน input id="search"
            $('#search').on('input', function() {
                // ดึงค่าจาก input
                var searchValue = $(this).val();

                // ตรวจสอบว่ามีค่าใน id "search" หรือไม่
                if (searchValue) {
                    // ถ้ามีค่า ให้ซ่อนหรือลบ div ที่มี class="menu-list"
                    $('.container').hide(); // หรือใช้ .remove() ถ้าต้องการลบทันที
                } else {
                    // ถ้าไม่มีค่า ให้แสดง div ที่มี class="menu-list"
                    $('.container').show();
                }

                // แสดงผล Realtime ที่ div id="searchResult"
                $('#searchResult').load('SearchMenu.php?search=' + searchValue);
                // เมื่อโหลดเสร็จแล้ว ลบรายการเมนูที่เก่าออกไป
                $('.container ul').empty();
            });
        });
    </script>

    <script>
        function openPopup(img) {
            var popupImage = document.getElementById('popup-image');
            popupImage.src = img.src;

            document.getElementById('popup').classList.add('show');
            document.getElementById('overlay').classList.add('show');
        }

        function closePopup() {
            document.getElementById('popup').classList.remove('show');
            document.getElementById('overlay').classList.remove('show');
        }

        // เพิ่ม event listener สำหรับ #popup.show
        // document.getElementById('popup').addEventListener('click', function() {
        //     closePopup();
        // });

        // เพิ่ม event listener สำหรับ #overlay.show
        document.getElementById('overlay').addEventListener('click', function() {
            closePopup();
        });
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/cefc293317.js" crossorigin="anonymous"></script>
</body>

</html>