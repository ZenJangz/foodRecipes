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
    <title>Menu-Detail</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@500&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="img/icon/ico.png" type="image/x-icon">
    <link rel="stylesheet" href="Style.css">
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
    <h1 Style="margin:auto; text-align:center; font-size:3rem;">เมนู <?= $row['Menu_name']; ?></h1>
    <p class="tell-date" style="text-align: center;" ><?= $row['Date']; ?></p>
    <br>
    <div class="menu-data-container">
        <div class="Menudata-Main-Img">
            <div class="image-container">
                <img src="<?php if (!empty($row['Img_Name_Main'])) {
                                echo 'Admin/Image_Uploaded/'.$row['Img_Name_Main'];
                            } else if (!empty($row['Img_URL_Main'])) {
                                echo $row['Img_URL_Main'];
                            } else if (!empty($row['Image_URL_Sec1'])) {
                                echo $row['Image_URL_Sec1'];
                            } else if (!empty($row['Image_Name_Sec1'])) {
                                echo 'Admin/Image_Uploaded/'.$row['Image_Name_Sec1'];
                            } else if (!empty($row['Image_URL_Sec2'])) {
                                echo $row['Image_URL_Sec2'];
                            } else if (!empty($row['Image_Name_Sec2'])) {
                                echo 'Admin/Image_Uploaded/'.$row['Image_Name_Sec2'];
                            } else if (!empty($row['Image_URL_Sec3'])) {
                                echo $row['Image_URL_Sec3'];
                            } else if (!empty($row['Image_Name_Sec3'])) {
                                echo 'Admin/Image_Uploaded/'.$row['Image_Name_Sec3'];
                            } else {
                                echo 'https://italiancinemaaudiences.org/wp-content/themes/trend/assets/img/empty/424x500.png';
                            }
                            ?>" alt="Image" onclick="openPopup(this)" class="Zoomable main-image">
                <div class="image-gallery">
                    <img src="<?php if (!empty($row['Image_URL_Sec1'])) {
                                    echo $row['Image_URL_Sec1'];
                                } else if (!empty($row['Image_Name_Sec1'])) {
                                    echo 'Admin/Image_Uploaded/'.$row['Image_Name_Sec1'];
                                } else if (!empty($row['Image_URL_Sec2'])) {
                                    echo $row['Image_URL_Sec2'];
                                } else if (!empty($row['Image_Name_Sec2'])) {
                                    echo 'Admin/Image_Uploaded/'.$row['Image_Name_Sec2'];
                                } else if (!empty($row['Image_URL_Sec3'])) {
                                    echo $row['Image_URL_Sec3'];
                                } else if (!empty($row['Image_Name_Sec3'])) {
                                    echo 'Admin/Image_Uploaded/'.$row['Image_Name_Sec3'];
                                } else if (!empty($row['Img_Name_Main'])) {
                                    echo 'Admin/Image_Uploaded/'.$row['Img_Name_Main'];
                                } else if (!empty($row['Img_URL_Main'])) {
                                    echo $row['Img_URL_Main'];
                                } else {
                                    echo 'https://italiancinemaaudiences.org/wp-content/themes/trend/assets/img/empty/424x500.png';
                                }
                                ?>" alt="Image" onclick="openPopup(this)" class="Zoomable secondary-image">
                    <img src="<?php
                                if (!empty($row['Image_URL_Sec2'])) {
                                    echo $row['Image_URL_Sec2'];
                                } else if (!empty($row['Image_Name_Sec2'])) {
                                    echo 'Admin/Image_Uploaded/'.$row['Image_Name_Sec2'];
                                } else if (!empty($row['Image_URL_Sec3'])) {
                                    echo $row['Image_URL_Sec3'];
                                } else if (!empty($row['Image_Name_Sec3'])) {
                                    echo 'Admin/Image_Uploaded/'.$row['Image_Name_Sec3'];
                                } else if (!empty($row['Image_URL_Sec1'])) {
                                    echo $row['Image_URL_Sec1'];
                                } else if (!empty($row['Image_Name_Sec1'])) {
                                    echo 'Admin/Image_Uploaded/'.$row['Image_Name_Sec1'];
                                } else if (!empty($row['Img_Name_Main'])) {
                                    echo 'Admin/Image_Uploaded/'.$row['Img_Name_Main'];
                                } else if (!empty($row['Img_URL_Main'])) {
                                    echo $row['Img_URL_Main'];
                                } else {
                                    echo 'https://italiancinemaaudiences.org/wp-content/themes/trend/assets/img/empty/424x500.png';
                                } ?>" alt="Image" onclick="openPopup(this)" class="Zoomable secondary-image">
                    <img src="<?php
                                if (!empty($row['Image_URL_Sec3'])) {
                                    echo $row['Image_URL_Sec3'];
                                } else if (!empty($row['Image_Name_Sec3'])) {
                                    echo 'Admin/Image_Uploaded/'.$row['Image_Name_Sec3'];
                                } else if (!empty($row['Image_URL_Sec1'])) {
                                    echo $row['Image_URL_Sec1'];
                                } else if (!empty($row['Image_Name_Sec1'])) {
                                    echo 'Admin/Image_Uploaded/'.$row['Image_Name_Sec1'];
                                } else if (!empty($row['Image_URL_Sec2'])) {
                                    echo $row['Image_URL_Sec2'];
                                } else if (!empty($row['Image_Name_Sec2'])) {
                                    echo 'Admin/Image_Uploaded/'.$row['Image_Name_Sec2'];
                                } else if (!empty($row['Img_Name_Main'])) {
                                    echo 'Admin/Image_Uploaded/'.$row['Img_Name_Main'];
                                } else if (!empty($row['Img_URL_Main'])) {
                                    echo $row['Img_URL_Main'];
                                } else {
                                    echo 'https://italiancinemaaudiences.org/wp-content/themes/trend/assets/img/empty/424x500.png';
                                } ?>" alt="Image" onclick="openPopup(this)" class="Zoomable secondary-image">
                    <div class="menu-details">
                        <H1><?= $row['Menu_name'] ?></H1>
                        <!-- <p>TTEESdffdsddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddffffffffffffffffffffffffffffffddddddSTT</p> -->
                        <p><?= $row['Menu_EP'] ?></p>
                    </div>
                </div>
                <div class="material">
                    <h1>วัตถุดิบ</h1>
                    <P>
                        <?php
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
                        ?>
                        <?php
                        if (!empty($row['Menu_Mat4'])) {
                            echo "- " . $row['Menu_Mat4'] . '<br>';
                        } else {
                        }
                        ?>
                        <?php
                        if (!empty($row['Menu_Mat5'])) {
                            echo "- " . $row['Menu_Mat5'] . '<br>';
                        } else {
                        }
                        ?>
                        <?php
                        if (!empty($row['Menu_Mat6'])) {
                            echo "- " . $row['Menu_Mat6'] . '<br>';
                        } else {
                        }
                        ?>
                        <?php
                        if (!empty($row['Menu_Mat7'])) {
                            echo "- " . $row['Menu_Mat7'] . '<br>';
                        } else {
                        }
                        ?>
                        <?php
                        if (!empty($row['Menu_Mat8'])) {
                            echo "- " . $row['Menu_Mat8'] . '<br>';
                        } else {
                        }
                        ?>
                    </P>
                </div>

            </div>
            <div id="popup">
                <img id="popup-image" src="" alt="Popup Image">
                <!-- <div id="overlay" onclick="closePopup()"></div> -->
            </div>
            <div id="overlay"></div>
            <br>
        </div>
    </div>

    <div class="HOW-YT">
        <div class="Menu_How">
            <h1>วิธีทำเมนู <?= $row['Menu_name'] ?></h1>
            <p>
                <?php
                if (!empty($row['Menu_How1'])) {
                    echo "- " . $row['Menu_How1'];
                } else {
                    echo 'ไม่มีข้อมูล';
                }
                ?>
            </p>
            <br>
            <p>
                <?php
                if (!empty($row['Menu_How2'])) {
                    echo "- " . $row['Menu_How2'];
                } else {
                    echo '';
                }
                ?>
            </p>
            <br>
            <p>
                <?php
                if (!empty($row['Menu_How3'])) {
                    echo "- " . $row['Menu_How3'];
                } else {
                    echo '';
                }
                ?>
            </p>
            <br>
            <p>
                <?php
                if (!empty($row['Menu_How4'])) {
                    echo "- " . $row['Menu_How4'];
                } else {
                    echo '';
                }
                ?>
            </p>
            <br>
            <p>
                <?php
                if (!empty($row['Menu_How5'])) {
                    echo "- " . $row['Menu_How5'];
                } else {
                    echo '';
                }
                ?>
            </p>
            <br>
            <p>
                <?php
                if (!empty($row['Menu_How6'])) {
                    echo "- " . $row['Menu_How6'];
                } else {
                    echo '';
                }
                ?>
            </p>
            <br>
            <p>
                <?php
                if (!empty($row['Menu_How7'])) {
                    echo "- " . $row['Menu_How7'];
                } else {
                    echo '';
                }
                ?>
            </p>
            <br>
            <p>
                <?php
                if (!empty($row['Menu_How8'])) {
                    echo "- " . $row['Menu_How8'];
                } else {
                    echo '';
                }
                ?>
            </p>
            <br>
            <p>
                <?php
                if (!empty($row['Menu_How9'])) {
                    echo "- " . $row['Menu_How9'];
                } else {
                    echo '';
                }
                ?>
            </p>
            <br>
            <p>
                <?php
                if (!empty($row['Menu_How10'])) {
                    echo "- " . $row['Menu_How10'];
                } else {
                    echo '';
                }
                ?>
            </p>
        </div>
        <?php
        if (!empty($row['YT_URL'])) {
            echo '<div class="YT-PS">
                <H1>วีดีโอวิธีการทำ</H1>';
        }
        ?>
        <iframe width="560" height="315" src="<?= $row['YT_URL']; ?>" frameborder="0" allowfullscreen></iframe>
        <!-- <iframe width="560" height="315" src="" frameborder="0" allowfullscreen></iframe> -->

    </div>
    <br>
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


</body>

</html>