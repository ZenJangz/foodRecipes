<?php
session_start(); // เริ่มต้นใช้งาน session

// เคลียร์ข้อมูล session
$_SESSION = array();

// ทำลาย session
session_destroy();

// กลับไปยังหน้า login
header("Location: LoginPAGE/login.php");
exit;
?>
