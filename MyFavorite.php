<?php
include 'connect.php';
session_start();
// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบแล้วหรือยัง
if (!isset($_SESSION['username'])) {

    header("Location: Recipes-nl.php"); // เปลี่ยนเส้นทางไปยังหน้า -nl
    exit(); // ออกจากสคริปต์
}

// โค้ดอื่นๆ ของหน้า welcome.php
// ...
$sql = "UPDATE a_data SET a_views=a_views+1";
$result = mysqli_query($connect, $sql);

$sql = "SELECT a_views FROM a_data";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
$a_views = $row['a_views'];

if (empty($ids)) {
    $dataUsername = $_SESSION['username'];

    $sql = "SELECT user_favoIds FROM user WHERE username=('$dataUsername')";
    $row = mysqli_query($connect, $sql);
    $result = mysqli_fetch_array($row);

        if(empty($result['user_favoIds'])) {
            $EMTCC = 1;
        }else{
            $ids = $result['user_favoIds'];
        $sql = "SELECT * FROM menu_data WHERE id_menu IN ($ids)";
        $query_Menu = mysqli_query($connect, $sql);
        if (!$query_Menu) {
            die("Query failed: " . mysqli_error($connect));
    }
    $EMTCC = 0;
        }
} else {
    $ids = $_SESSION['ids'];
    $sql = "SELECT * FROM menu_data WHERE id_menu IN ($ids)";
    $query_Menu = mysqli_query($connect, $sql);
    if (!$query_Menu) {
        die("Query failed: " . mysqli_error($connect));
    }
    $EMTCC = 0;
}
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
    <!-- <link rel="stylesheet" href="Style.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?php include('HeaderStyle.php'); ?>
    <style>
        .Search-System {
    display: flex;
    justify-content: center;
    align-items: center;
}

.Search-Form {
    text-align: center;
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
.Search-input:hover{
    padding: 1rem;
    padding-right: 35rem;
    border: 1px solid #ccc;
    border-radius: 5px;
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
    </style>
</head>

<body>
    <header>
        <div class="logo-1">
            <h1><a href="index.php">food<span>Recipes</span></a></h1>
            <li class="nav">
                <a href="welcome.php">Home</a>
                <a href="about.php">About</a>
                <a href="Recipes.php">Recipes</a>
                <a href="contact.php">Contact</a>
                <a href="MyFavorite.php" class="Active">Favorate</a>
                <a href="logout.php" class="Runaway">Logout</a>
            </li>
        </div>
    </header>
    <?php 
        if($EMTCC ==1){?>
            <div>
        <h1 class="text-center m-lg-4">ไม่มีรายการที่ชอบ</h1>
    </div>
    <?php }else{ ?>
        <div>
        <h1 class="text-center m-lg-4">รายการเมนูที่ชอบ</h1>
    </div>
    <?php }?>
    <div class="Search-System">
        <form method="GET" action="" class="Search-Form">
            <label for="search" class="Search-Label">ค้นหาเมนู: </label>
            <input type="text" name="search" id="search" class="Search-input">
            <input type="submit" value="ค้นหา" class="Search-Submit">
        </form>
    </div>
    <?php
        if($EMTCC ==0){
    ?>
    <div class="container d-flex flex-wrap m-auto justify-content-center" style="max-width: 100%;">
    <?php foreach ($query_Menu as $data) : ?>
        <section class="HoverThis mt-5" style="max-width: 20%;">
            <div class="card mx-2">
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                    <a href="">
                        <img src="<?php echo getImageUrl($data); ?>" alt="Menu Image" class="img-fluid w-100 ImgHover" style="max-height: 20vh; object-fit:cover;">
                    </a>
                </div>
                <div class="card-body">
                    <h5 class="card-title font-weight-bold"><a><?= $data['Menu_name']; ?></a></h5>
                    <p class="mb-2"><i class="fa-solid fa-bowl-food me-1"></i> • อาหาร </p>
                    <p class="card-text"><?= $data['Menu_EP']; ?></p>
                    <hr class="my-4" />
                    <p class="lead text-center"><strong>ลบออกจากรายการที่ชอบ</strong></p>
                    <a href="Heart-Delete.php?id=<?= $data['id_menu']; ?>" class=" btn btn-danger p-md-1 mb-0 w-100"><i class="fa-solid fa-square-minus me-1"></i></i>ลบ</a>
                </div>
            </div>
        </section>
    <?php endforeach; ?>
</div>
    <?php }?>
    <?php
    function getImageUrl($data)
    {
        if (!empty($data['Img_Name_Main'])) {
            return 'Admin/Image_Uploaded/' . $data['Img_Name_Main'];
        } elseif (!empty($data['Img_URL_Main'])) {
            return $data['Img_URL_Main'];
        } elseif (!empty($data['Image_URL_Sec1'])) {
            return $data['Image_URL_Sec1'];
        } elseif (!empty($data['Image_Name_Sec1'])) {
            return $data['Image_Name_Sec1'];
        } elseif (!empty($data['Image_URL_Sec2'])) {
            return $data['Image_URL_Sec2'];
        } elseif (!empty($data['Image_Name_Sec2'])) {
            return $data['Image_Name_Sec2'];
        } elseif (!empty($data['Image_URL_Sec3'])) {
            return $data['Image_URL_Sec3'];
        } elseif (!empty($data['Image_Name_Sec3'])) {
            return $data['Image_Name_Sec3'];
        } else {
            return 'Admin/Image_Uploaded/NO-IMG.png';
        }
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/cefc293317.js" crossorigin="anonymous"></script>
</body>