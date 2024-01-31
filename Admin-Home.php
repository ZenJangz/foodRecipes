<?php 
include 'connect.php';
session_start();
if(!empty($_SESSION['Position'])){
  if(($_SESSION['Position']==0)){
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
      <a href="index.php">&larr; Go to Home-Page</a>
  </div>';
  exit;
  }
}else{
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
      <a href="index.php">&larr; Go to Home-Page</a>
  </div>';
  exit;
}

$sql = "SELECT * FROM a_data";
$result = mysqli_query($connect, $sql);
$adata = mysqli_fetch_array($result);


$sql = "SELECT COUNT(*) FROM user";
$result = mysqli_query($connect, $sql);
$col = mysqli_fetch_assoc($result);
$usersdata = $col['COUNT(*)'];



$sql = "SELECT COUNT(*) FROM menu_data";
$result = mysqli_query($connect, $sql);
$col_Menu = mysqli_fetch_assoc($result);
$menusdata = $col_Menu['COUNT(*)'];


$sql = "SELECT COUNT(*) FROM wh_contact";
$result = mysqli_query($connect, $sql);
$col_wh = mysqli_fetch_assoc($result);
$whdata = $col_wh['COUNT(*)'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="AdminHome.css">
    <style>
      .Menu-H{
        transition: .3s ease;
      }
      .Menu-H:hover{
        margin-left: 1rem;
        margin-right: 1rem;
        transform: scale(1.05);
        transition: .3s ease;
      }
    </style>
</head>
<?php include('AdminHeader.php'); ?>
<body>
<body class="bg-default">
  <div class="main-content">
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <h2 class="mb-5 text-white"><i class="fa-solid fa-microchip me-1"></i>ค่าสถานะของเว็บไซต์ <span style="font-weight: bold; font-size: larger;">food<span style="color: rgb(255, 174, 0);">Recipes</span></span></h2>
        <div class="header-body">
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">จำนวนเข้ารับชมทั้งหมด</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$adata['a_views'];?><span class="text-secondary" style="font-size: 1rem; font-weight:lighter;"> ครั้ง</span></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                      <i class="fa-solid fa-eye"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                   
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">จำนวนบัญชี users</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$usersdata;?><span class="text-secondary" style="font-size: 1rem; font-weight:lighter;"> บัญชี</span></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                      <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    
                    
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">จำนวนเมนูในระบบ</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$menusdata?><span class="text-secondary" style="font-size: 1rem; font-weight:lighter;"> เมนู</span></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                      <i class="fa-solid fa-bowl-food"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-warning mr-2"><i class="fas"></i>    </span>
                    <span class="text-nowrap">    </span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <a href="Admin-Messages.php" class=" text-decoration-none">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">ข้อเสนอแนะจาก users</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$whdata?><span class="text-secondary" style="font-size: 1rem; font-weight:lighter;"> จดหมาย</span></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                      <i class="fa-solid fa-envelope"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                                       
                  </p>
                </div>
              </div>
              </a>
            </div>
          </div>
        </div>
      </div>
      <?php
        
      ?>
      <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row">
            <div class="col-xl-3 col-lg-6 ">
              <a href="Add-Menu.php" class="text-decoration-none">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h1 class="card-title text-center mb-0" style="color: #333;">เพิ่มเมนู</h1>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                      <i class="fa-solid fa-eye"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </a>
            </div>
            <div class="col-xl-3 col-lg-6 ">
              <a href="Admin-Menulist.php" class=" text-decoration-none">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h1 class="card-title text-center mb-0" style="color: #333;">แก้ไขเมนู</h1>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                      <i class="fa-solid fa-bowl-food"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </a>
            </div>
            <div class="col-xl-3 col-lg-6">
              <a href="Admin-Messages.php" class=" text-decoration-none">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h1 class="card-title text-center mb-0" style="color: #333; font-size:2rem;">ข้อเสนอแนะจาก Users</h1>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                      <i class="fa-solid fa-envelope"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </a>
            </div>
            <div class="col-xl-3 col-lg-6">
              <a target="_blank" href="https://docs.google.com/forms/d/1FR27_TlskpyriyycyFwycWz7Ljp8RGHLzDLajiFumyo/edit#responses" class=" text-decoration-none">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h1 class="card-title text-center mb-0" style="color: #333; font-size:2rem;">แบบสำรวจ</h1>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                      <i class="fa-solid fa-envelope"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
  </div>










    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/cefc293317.js" crossorigin="anonymous"></script>
    
</body>
</html>