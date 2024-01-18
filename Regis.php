<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@500&display=swap" rel="stylesheet">
    <?php include('HeaderStyle.php'); ?>
    <style>
        .btn-primary{
            background-color: rgb(255, 174, 0);
            border-color: rgb(255, 174, 0);
        }
        .btn-primary:hover{
            background-color: #df9800;
            border-color: #df9800;
        }

        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>
</head>
<header>
        <div class="logo-1">
           <h1><a href="index.php">food<span>Recipes</span></a></h1>
            <li class="nav">
                <a href="index.php">Home</a>
                <a href="about.php">About</a>
                <a href="Recipes">Recipes</a>
                <a href="contact.php">Contact</a>
                <a href="LoginPAGE/login.php" class="Runaway">Login</a>
            </li>
        </div>
    </header>
    <body>
    <div class="container-fluid h-custom mt-4">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="Video-Login/Login-Video2.gif" class="img-fluid w-100" style="box-shadow: 0 30px 40px rgba(0,0,0,.35); border-radius: 25px;" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 mt-5">
                <form action="procress.php" method="POST" >
                    <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start me-1">
                        <p class="lead fw-normal mb-0 me-3">Sign in with</p>
                        <h1 style="font-weight:bold;">food<span style="color: rgb(255, 174, 0);">Recipes</span><i class="fa-solid fa-user ms-3"></i></h1>
                    </div>

                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0">Account Register<i class="fa-solid fa-user-pen ms-1"></i></p>
                    </div>

                    <!-- Username input -->
                    <div class="form-outline mb-4">
                        <input required name="username" type="text" id="form3Example2" class="form-control form-control-lg" placeholder="Username" />
                        <label class="form-label" for="form3Example3">Username</label>
                    </div>
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input required name="email" type="email" id="form3Example3" class="form-control form-control-lg" placeholder="Email" />
                        <label class="form-label" for="form3Example3">Email</label>
                    </div>
                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input required name="password" type="password" id="form3Example4" class="form-control form-control-lg" placeholder="Password" />
                        <label class="form-label" for="form3Example4">Password</label>
                    </div>

                    <?php if(!empty($_SESSION['Alert_Login'])){
                    ?>
                    <div class="alert alert-danger text-center fade show alert-warning" role="alert">
                      <?=$_SESSION['Alert_Login'];?>
                      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php }?>
                    <?php unset($_SESSION['Alert_Login']);?>

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">สมัคร</button>
                        <p class="small fw-bold mt-2 pt-1 mb-0">ถ้ามีบัญชีแล้ว กดตรงนี้เพื่อ Login <a href="LoginPAGE/login.php" class="link-success">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/cefc293317.js" crossorigin="anonymous"></script>
</body>

</html>