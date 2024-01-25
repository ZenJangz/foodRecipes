<?php
    session_start();
    if ($_SESSION['Position'] == 0) {
        echo '
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

    $Mid = $_GET['id'];

    $sql = "SELECT * FROM wh_contact WHERE id_Contact = '$Mid'";
    $result = mysqli_query($connect, $sql) or die (mysqli_error($connect));
    $data = mysqli_fetch_array($result);

    if (isset($Mid)) {
        // echo $Mid;
        $sql = "DELETE FROM wh_contact WHERE id_Contact = '$Mid'";
        $query = mysqli_query($connect, $sql);
        if($query == TRUE){
            $_SESSION['Menu-Name'] = $data['Menu_name'];
            $_SESSION['Alert'] = 'ลบเมนู '.$data['Menu_name']. ' ID: '.$data['id_Contact'].' ออกจากระบบแล้ว';
            header('location: Admin-Messages.php#'.$Mid);
        }else{
            $_SESSION['Menu-Name'] = $data['Menu_name'];
            $_SESSION['Alert'] = 'เกิดข้อผิดพลาด';
            header('location: Admin-Messages.php#'.$Mid);
        }
        exit();
    }
?>