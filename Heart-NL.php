<?php 
session_start();
include 'connect.php';
    if (!isset($_SESSION['username'])){
        header("Location: LoginPAGE/login.php");
        exit(); }// ออกจากสคริป 
?>
<?php
$Mid = 0;
$Mid = $_GET['id'];
$chackuser = $_SESSION['username'];

$sql = "SELECT Menu_name FROM menu_data WHERE id_menu='$Mid'";
$row77 = mysqli_query($connect, $sql) or die (mysqli_error($connect));
$menudata88 = mysqli_fetch_array($row77);

$sql = "SELECT * FROM user WHERE username= '$chackuser'";
$row = mysqli_query($connect, $sql) or die(mysqli_error($connect));
$data = mysqli_fetch_array($row);
$olddata = $data['user_favoIds'];
?>
<?php
if(empty($olddata)){
    $olddata = '0';
    $sql = "UPDATE user SET user_favoIds ='$olddata' WHERE username = '$chackuser'";
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
}

$sql = "UPDATE user SET user_favoIds ='$olddata, $Mid' WHERE username = '$chackuser'";
$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));


mysqli_close($connect);
$_SESSION['Alert'] = $menudata88['Menu_name'];
header("location: Recipes.php#".$Mid);
exit();
?>