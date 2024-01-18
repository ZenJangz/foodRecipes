<!-- <?php
include("connect.php");
$sql = "UPDATE a_data SET a_views=a_views+1";
$result = mysqli_query($connect, $sql);

$sql = "SELECT a_views FROM a_data";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
$a_views = $row['a_views'];

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
    <title>About us</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="Style.css">
</head>
<body>
<?php 
        // include("menulist.php");
    ?>

</body>
</html> -->