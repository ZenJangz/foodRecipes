<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisger</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
<div class="logo-1">
            <h1>food<span>Recipes</span></h1>
            <li class="nav">
                <a href="welcome.php">Home</a>
                <a href="about.php">About</a>
                <a href="Recipes.php">Recipes</a>
                <a href="contact.php">Contact</a>
                <a href="LoginPAGE/login.php">Login</a>
                <a href="Regis.php" class="Runawayclass Active" >Register</a>
            </li>
        </div>
    </header>
    <div class="blackpad">
        <div class="logi-data">
            <h2>Register</h2>
            <p style="color:red;">โปรดใส่ Username, Password, Email</p>
            <br>
            <form action="procress.php" method="post">
                <input type="text" placeholder="Username" name="username">
            <br>
                <input type="password" placeholder="Password" name="password">
            <br>
            <input type="email" placeholder="Email" name="email">
            <br>
                <input type="submit" value="Register" class="submit">
            </form>
            <br>
                <p>มีบัญชีแล้วรึ? <span><a href="\Food_Web\LoginPAGE\login.php">ล็อคอินโล้ด</a></span></p>
        </div>
    </div>
    <?php include("login-videoplay.php");?>
</body>
</html>