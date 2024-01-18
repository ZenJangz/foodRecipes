<?php
session_start();
include 'connect.php';
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
$pid = $_GET['id'];
$sql = "SELECT * FROM menu_data WHERE id_menu = '$pid'";
$result = mysqli_query($connect, $sql);
$data = mysqli_fetch_array($result);

if(isset($_POST['submit'])){
    $Menu_name = mysqli_real_escape_string($connect, $_POST['Menu_name']);
    $Menu_Mat1 = mysqli_real_escape_string($connect, $_POST['Menu_Mat1']);
    $Menu_How1 = mysqli_real_escape_string($connect, $_POST['Menu_How1']);
    $Menu_EP = mysqli_real_escape_string($connect, $_POST['Menu_EP']);
    $Img_URL_Main = mysqli_real_escape_string($connect, $_POST['Img_URL_Main']);
    $Image_URL_Sec1 = mysqli_real_escape_string($connect, $_POST['Image_URL_Sec1']);
    $Image_URL_Sec2 = mysqli_real_escape_string($connect, $_POST['Image_URL_Sec2']);
    $Image_URL_Sec3 = mysqli_real_escape_string($connect, $_POST['Image_URL_Sec3']);
    $YT_URL = mysqli_real_escape_string($connect, $_POST['YT_URL']);


    if($YT_URL==$data['YT_URL']){
  
    }else{
        $originalURL = $YT_URL;
        // ฟังก์ชันสำหรับแปลง URL เป็น embed URL
    function convertToEmbedURL($originalURL) {
        // ในกรณีที่ URL เป็น https://www.youtube.com/watch?v=xxxxxxxxxxx
        if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $originalURL, $matches)) {
            $videoID = $matches[1];
            return "https://www.youtube.com/embed/$videoID";
        } 
        // ในกรณีที่ URL เป็น https://youtu.be/xxxxxxxxxxx
        elseif (preg_match('/youtu\.be\/([^\&\?\/]+)/', $originalURL, $matches)) {
            $videoID = $matches[1];
            return "https://www.youtube.com/embed/$videoID";
        }
        // กรณีไม่ตรงกับรูปแบบที่กำหนด
        else {
            return false;
        }
    }
    
    // เรียกใช้ฟังก์ชันแปลง URL เป็น embed URL
    $embedURL = convertToEmbedURL($originalURL);
    }

    if(isset($embedURL)){
        $YT_URL = $embedURL;
    }
        $sql = "UPDATE menu_data SET 
        Menu_name = '$Menu_name',
        Menu_Mat1 = '$Menu_Mat1',
        Menu_How1 = '$Menu_How1',
        Menu_EP = '$Menu_EP',
        Img_URL_Main = '$Img_URL_Main',
        Image_URL_Sec1 = '$Image_URL_Sec1',
        Image_URL_Sec2 = '$Image_URL_Sec2',
        Image_URL_Sec3 = '$Image_URL_Sec3',
        YT_URL = '$YT_URL'
        WHERE id_menu = '$pid'";
        
        $result = mysqli_query($connect, $sql) or die (mysqli_error($connect)); 
        if ($result){
            $_SESSION['Alert'] = "บันทึกข้อมูลสำเร็จ";
            header("Location: Admin-MenuEdit.php?id=$pid");
            // echo $YT_URL;
            exit();
        } else {
            $_SESSION['Alert'] = "บันทึกข้อมูลผิดพลาดโปรดลองใหม่";
            header("Location: Admin-MenuEdit.php?id=$pid");
            // echo $YT_URL;
            exit();
        }
    // mysqli_close($connect);
}
?>