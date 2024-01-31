<?php
session_start();
if ($_SESSION['Position'] == 0) {
    echo '
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
include 'connect.php';

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu-List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="AdminHome.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.all.min.js"></script>
    <style>
        .ImgHover {
            border-radius: 0px;
            transition: .3s ease;
            object-fit: cover;
        }

        .ImgHover:hover {
            transform: scaleY(1.09);
            transition: .3s ease;
        }

        .HoverThis {
            transition: .3s ease;
        }

        .HoverThis:hover {
            /* margin-left: 5%;
        margin-right: 5%; */
            transition: .3s ease;
            transform: scale(1.05);
        }

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

        .Search-input:hover {
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

        .menu-list {}

        .menu-list ul {}
    </style>
</head>
<?php include('AdminHeader.php'); ?>

<body>
    <br>
    <div class="Search-System">
        <form method="GET" action="" class="Search-Form " id="searchForm">
            <label for="search" class="Search-Label">ค้นหาเมนู: </label>
            <input type="text" name="search" id="search" class="Search-input">
            <input type="submit" value="รีเซ็ต" class="Search-Submit">
        </form>
    </div>
    <div id="searchResult"></div>

    <?php if (!empty($_SESSION['Alert'])) { ?>
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "<?= $_SESSION['Alert'] ?>",
                showConfirmButton: false,
                timer: 3500
            });
        </script>
    <?php } ?>

    <?php unset($_SESSION['Alert']) ?>
    <div class="menu-list">
        <div class="container d-flex flex-wrap m-auto justify-content-center" style="max-width: 100%;">
            <?php foreach ($query_Menu as $data) : ?>
                <section class="HoverThis mt-5" style="max-width: 20%;">
                    <div class="card mx-2">
                        <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                            <a href="Admin-Menu-Detail.php?id=<?= $data['id_menu'] ?>">
                            <img src="<?php echo getImageUrl($data); ?>" alt="Menu Image" class="img-fluid w-100 ImgHover" style="max-height: 20vh; object-fit:cover;">
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold"><a><?= $data['Menu_name']; ?></a></h5>
                            <p class="mb-2"><i class="fa-solid fa-bowl-food me-1"></i> • อาหาร </p>
                            <p class="card-text"><?= $data['Menu_EP']; ?></p>
                            <hr class="my-4" />
                            <p class="lead text-center"><strong>จัดการ <?= $data['id_menu'] ?></strong></p>
                            <a href="Admin-MenuEdit.php?id=<?= $data['id_menu']; ?>" class=" btn btn-danger p-md-1 mb-0 w-100"><i class="fa-solid fa-pen-to-square me-1"></i>แก้ไข</a>
                            <a href="" class="btn btn-danger p-md-1 mb-0 w-100 mt-2 delete-menu-link" data-menu-id="<?= $data['id_menu']; ?>" data-menu-name="<?= $data['Menu_name']; ?>"><i class="fa-solid fa-pen-to-square me-1"></i>ลบ</a>

                        </div>
                    </div>
                </section>
            <?php endforeach; ?>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var deleteMenuLinks = document.querySelectorAll('.delete-menu-link');
                deleteMenuLinks.forEach(function(link) {
                    link.addEventListener('click', function(event) {
                        event.preventDefault();
                        var menuId = this.getAttribute('data-menu-id');
                        var menuName = this.getAttribute('data-menu-name'); // เพิ่มตัวแปรนี้

                        // แสดง SweetAlert สำหรับการยืนยันการลบ
                        Swal.fire({
                            title: "ต้องการลบ User: " + menuName + " ออกจากระบบ??",
                            text: "คำเตือนไม่สามารถกู้คืนรายการที่ถูกลบได้",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#d33",
                            cancelButtonColor: "#3085d6",
                            confirmButtonText: "ใช่ลบ User " + menuName + " !!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // ลิงค์ไปยังหน้า Admin-MenuDelete.php พร้อมส่งค่า id_menu
                                window.location.href = "Admin-MenuDelete.php?id=" + menuId;
                            }
                        });
                    });
                });
            });
        </script>




        <?php unset($_SESSION['Alert']);
        unset($_SESSION['Menu-Name']) ?>
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
                return 'Admin/Image_Uploaded/' .$data['Image_Name_Sec1'];
            } elseif (!empty($data['Image_URL_Sec2'])) {
                return $data['Image_URL_Sec2'];
            } elseif (!empty($data['Image_Name_Sec2'])) {
                return 'Admin/Image_Uploaded/' .$data['Image_Name_Sec2'];
            } elseif (!empty($data['Image_URL_Sec3'])) {
                return $data['Image_URL_Sec3'];
            } elseif (!empty($data['Image_Name_Sec3'])) {
                return 'Admin/Image_Uploaded/' .$data['Image_Name_Sec3'];
            } else {
                return 'Admin/Image_Uploaded/NO-IMG.png';
            }
        }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/cefc293317.js" crossorigin="anonymous"></script>
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
                        $('.menu-list').hide(); // หรือใช้ .remove() ถ้าต้องการลบทันที
                    } else {
                        // ถ้าไม่มีค่า ให้แสดง div ที่มี class="menu-list"
                        $('.menu-list').show();
                    }

                    // แสดงผล Realtime ที่ div id="searchResult"
                    $('#searchResult').load('SearchMenu.php?search=' + searchValue);
                    // เมื่อโหลดเสร็จแล้ว ลบรายการเมนูที่เก่าออกไป
                    $('.menu-list ul').empty();
                });
            });
        </script>




</body>

</html>