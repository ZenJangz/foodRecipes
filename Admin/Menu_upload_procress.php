<?php
include '../connect.php';
session_start();

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $menuName = mysqli_real_escape_string($connect, $_POST['Menu_name']);
    $menuEP = mysqli_real_escape_string($connect, $_POST['Menu_EP']);
    $menuHow1 = mysqli_real_escape_string($connect, $_POST['Menu_How1']);;
    // $imgNameMain = mysqli_real_escape_string($connect, $_FILES['Img_Name_Main']['name']);
    $imgURLMain = mysqli_real_escape_string($connect, $_POST['Img_URL_Main']);
    $imgURLSec1 = mysqli_real_escape_string($connect, $_POST['Image_URL_Sec1']);
    // $imgNameSec1 = mysqli_real_escape_string($connect, $_POST['Image_Name_Sec1']);
    $imgURLSec2 = mysqli_real_escape_string($connect, $_POST['Image_URL_Sec2']);
    // $imgNameSec2 = mysqli_real_escape_string($connect, $_POST['Image_Name_Sec2']);
    $imgURLSec3 = mysqli_real_escape_string($connect, $_POST['Image_URL_Sec3']);
    // $imgNameSec3 = mysqli_real_escape_string($connect, $_POST['Image_Name_Sec3']);

    $Menu_Mat1 = mysqli_real_escape_string($connect, $_POST['Menu_Mat1']);

    $ytURL = mysqli_real_escape_string($connect, $_POST['YT_URL']);


// function getUniqueFilename($filename, $directory) {
//     $fullPath = $directory . DIRECTORY_SEPARATOR . $filename;
//ตรวจไฟล์ซ้ำ
//     while (file_exists($fullPath)) {
//         $info = pathinfo($filename);
//         $newFilename = $info['filename'] .' . $info['extension'];
//         $fullPath = $directory . DIRECTORY_SEPARATOR . $newFilename;
//         $counter++;
//     }

//     return $newFilename;
// }

// Upload Main Image
if (!empty($_FILES['Img_Name_Main']['name'])) {
    $imgNameMain = $_FILES['Img_Name_Main']['name'];
    $imgTemp = $_FILES['Img_Name_Main']['tmp_name'];
    move_uploaded_file($imgTemp, 'Image_Uploaded/' . $imgNameMain);
} 
// elseif (!empty($imgURLMain)) {
//     // Assuming $imgURLMain is a valid URL
//     $imgNameMain = basename($imgURLMain);
//     file_put_contents('Image_Uploaded/' . $imgNameMain, file_get_contents($imgURLMain));
// }

// Upload Secondary Image 1
if (!empty($_FILES['Image_Name_Sec1']['name'])) {
    $imgNameSec1 = $_FILES['Image_Name_Sec1']['name'];
    $imgTempSec1 = $_FILES['Image_Name_Sec1']['tmp_name'];
    move_uploaded_file($imgTempSec1, 'Image_Uploaded/' . $imgNameSec1);
} 
// elseif (!empty($imgURLSec1)) {
//     // Assuming $imgURLSec1 is a valid URL
//     $imgNameSec1 = basename($imgURLSec1);
//     file_put_contents('Image_Uploaded/' . $imgNameSec1, file_get_contents($imgURLSec1));
// }

// Upload Secondary Image 2
if (!empty($_FILES['Image_Name_Sec2']['name'])) {
    $imgNameSec2 = $_FILES['Image_Name_Sec2']['name'];
    $imgTempSec2 = $_FILES['Image_Name_Sec2']['tmp_name'];
    move_uploaded_file($imgTempSec2, 'Image_Uploaded/' . $imgNameSec2);
} 
// elseif (!empty($imgURLSec2)) {
//     // Assuming $imgURLSec2 is a valid URL
//     $imgNameSec2 = basename($imgURLSec2);
//     file_put_contents('Image_Uploaded/' . $imgNameSec2, file_get_contents($imgURLSec2));
// }

// Upload Secondary Image 3
if (!empty($_FILES['Image_Name_Sec3']['name'])) {
    $imgNameSec3 = $_FILES['Image_Name_Sec3']['name'];
    $imgTempSec3 = $_FILES['Image_Name_Sec3']['tmp_name'];
    move_uploaded_file($imgTempSec3, 'Image_Uploaded/' . $imgNameSec3);
}
//  elseif (!empty($imgURLSec3)) {
//     // Assuming $imgURLSec3 is a valid URL
//     $imgNameSec3 = basename($imgURLSec3);
//     file_put_contents('Image_Uploaded/' . $imgNameSec3, file_get_contents($imgURLSec3));
// }

    // Repeat the above process for other images (Secondary Image 2, Secondary Image 3, etc.) if needed.

    $originalURL = $ytURL;
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

    $checkDuplicateQuery = "SELECT * FROM menu_data WHERE Menu_name = '$menuName'";
    $checkDuplicateResult = mysqli_query($connect, $checkDuplicateQuery);

    if (mysqli_num_rows($checkDuplicateResult) > 0) {
        // ถ้าพบว่า Menu_name ซ้ำ
        $_SESSION['Alert'] = "ชื่อเมนูนี้มีอยู่ในระบบแล้ว กรุณาเลือกชื่ออื่น";
        header('Location: ../Add-Menu.php');
        exit();
    } else {
        // ถ้า Menu_name ไม่ซ้ำ
        $sql = "INSERT INTO menu_data (Menu_name, Menu_EP, Menu_How1, Img_URL_Main, Image_URL_Sec1, Image_URL_Sec2, Image_URL_Sec3, Menu_Mat1, YT_URL) 
        VALUES ('$menuName', '$menuEP', '$menuHow1', '$imgURLMain', '$imgURLSec1', '$imgURLSec2', '$imgURLSec3', '$Menu_Mat1', '$embedURL')";

        if (mysqli_query($connect, $sql)) {
            $_SESSION['Alert'] = "บันทึกข้อมูลสำเร็จ";
            header('Location: ../Add-Menu.php');
            exit;
        } else {
            $_SESSION['Alert'] = "บันทึกข้อมูลผิดพลาดโปรดลองใหม่";
            header('Location: ../Add-Menu.php');
            exit;
        }
    }
    mysqli_close($connect);
}
exit;
