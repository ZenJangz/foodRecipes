<?php include 'connect.php';
    session_start();

    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if (empty($name) || empty($lastname) || empty($email) || empty($message)) {
        exit(); }
    
    $sql = "INSERT INTO wh_contact (name, lastname, email, message) VALUE ('$name', '$lastname', '$email', '$message')";
    $query = mysqli_query($connect, $sql);
    if($query == true) {
        $_SESSION['Alert'] = "ส่งข้อมูลแล้ว";
        header('location: contact.php');
        exit();
    }
?>