<?php
session_start();
if($_SESSION['Position']==0){
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
        <a href="/food_web/index.php">&larr; Back to Dashboard</a>
    </div>';
    exit;
  }
include 'connect.php';
$uid = $_GET['id'];

$sql = "SELECT * FROM user WHERE ID = '$uid'";
$result = mysqli_query($connect, $sql);
$data = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add-Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@500&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9fa
        }

        .padding {
            padding: 3rem !important
        }

        .user-card-full {
            overflow: hidden;
        }

        .card {
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
            box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
            border: none;
            margin-bottom: 30px;
        }

        .m-r-0 {
            margin-right: 0px;
        }

        .m-l-0 {
            margin-left: 0px;
        }

        .user-card-full .user-profile {
            border-radius: 5px 0 0 5px;
        }

        .bg-c-lite-green {
            background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
            background: linear-gradient(to right, #ee5a6f, #f29263);
        }

        .user-profile {
            padding: 20px 0;
        }

        .card-block {
            padding: 1.25rem;
        }

        .m-b-25 {
            margin-bottom: 25px;
        }

        .img-radius {
            border-radius: 5px;
        }



        h6 {
            font-size: 14px;
        }

        .card .card-block p {
            line-height: 25px;
        }

        @media only screen and (min-width: 1400px) {
            p {
                font-size: 14px;
            }
        }

        .card-block {
            padding: 1.25rem;
        }

        .b-b-default {
            border-bottom: 1px solid #e0e0e0;
        }

        .m-b-20 {
            margin-bottom: 20px;
        }

        .p-b-5 {
            padding-bottom: 5px !important;
        }

        .card .card-block p {
            line-height: 25px;
        }

        .m-b-10 {
            margin-bottom: 10px;
        }

        .text-muted {
            color: #919aa3 !important;
        }

        .b-b-default {
            border-bottom: 1px solid #e0e0e0;
        }

        .f-w-600 {
            font-weight: 600;
        }

        .m-b-20 {
            margin-bottom: 20px;
        }

        .m-t-40 {
            margin-top: 20px;
        }

        .p-b-5 {
            padding-bottom: 5px !important;
        }

        .m-b-10 {
            margin-bottom: 10px;
        }

        .m-t-40 {
            margin-top: 20px;
        }

        .user-card-full .social-link li {
            display: inline-block;
        }

        .user-card-full .social-link li a {
            font-size: 20px;
            margin: 0 10px 0 0;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>
<?php include('AdminHeader.php'); ?>

<body>
    <div class="card user-card-full">
                <form action="Admin-List-Users-Edit-Pro.php?id=<?=$uid?>" class="form-control" method="post">
                    <div class="card-block">
                        <h1 class="m-b-20 p-b-5 b-b-default f-w-600 text-center">ข้อมูลของ user <?= $data['username'] ?></h1>
                        <div class="row justify-content-center">
                            <div class="col-sm-2">
                                <label for="username"class="m-b-10 f-w-600 form-label">Username</label>
                                <input id="username" name="username" value="<?= $data['username'] ?>" class="form-control" required>
                            </div>
                            <div class="col-sm-2">
                                <label for="password"class="m-b-10 f-w-600 form-label">Password</label>
                                <input id="password" name="password" value="<?= $data['password'] ?>" class="form-control" required>
                            </div>
                            <div class="col-sm-3">
                                <label for="email"class="m-b-10 f-w-600 form-label">Email</label>
                                <input id="email" name="email" value="<?= $data['email'] ?>" class="form-control" required>
                            </div>
                            <div class="col-sm-2">
                                <label for="Position"class="m-b-10 f-w-600 form-label">Position <span class=" text-danger" style="font-size: 0.8rem;">1=Admin, 0=Normal user</span></label>
                                <input id="Position" name="Position" value="<?= $data['Position'] ?>" class="form-control" required>
                            </div>
                        </div>
                        <br>
                        <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600 text-center">บันทึกลงฐานข้อมูล</h6>
                        <button class="form-control w-25 btn btn-primary d-block m-auto" name="submit">บันทึก</button>
                        <p class="text-center mt-3 <?php if(!empty($_SESSION['Setcolor'])){echo $_SESSION['Setcolor'];}?>" style="font-size: 1.35rem; font-weight:bold;"><?php if(!empty($_SESSION['Alert'])){echo $_SESSION['Alert'];}?></p>
                        <?php unset($_SESSION['Alert'])?>

                    </div>
                </form>
            </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/cefc293317.js" crossorigin="anonymous"></script>

</body>

</html>