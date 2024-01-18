<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: LoginPAGE/login.php");
    exit();
}

$Mid = isset($_GET['id']) ? $_GET['id'] : 0;

$usernameL = $_SESSION['username'];

// คิวรีอัปเดต
$updateSql = "UPDATE user SET user_favoIds = TRIM(BOTH ',' FROM REPLACE(user_favoIds, '$Mid, ', '')) WHERE username = '$usernameL' AND FIND_IN_SET('$Mid', REPLACE(user_favoIds, ' ', '')) > 0";
$query = mysqli_query($connect, $updateSql) or die(mysqli_error($connect));

$updateSql = "UPDATE user SET user_favoIds = TRIM(BOTH ',' FROM REPLACE(user_favoIds, ', $Mid', '')) WHERE username = '$usernameL' AND FIND_IN_SET('$Mid', REPLACE(user_favoIds, ' ', '')) > 0";
$query = mysqli_query($connect, $updateSql) or die(mysqli_error($connect));

if ($query) {
    
} else {
    echo "อัปเดตไม่สำเร็จ: " . mysqli_error($connect) . "<br>";
}

// คิวรีเลือก
$selectSql = "SELECT * FROM user WHERE username = '$usernameL'";
$query = mysqli_query($connect, $selectSql) or die(mysqli_error($connect));
$row = mysqli_fetch_array($query);

mysqli_close($connect);
header('location: MyFavorite.php');
exit();
?>
