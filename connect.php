<?php
$connect = mysqli_connect('localhost', 'root', '', 'db_foodweb'); //Xamp
// $connect = mysqli_connect('localhost', 'id21795235_foodrecipes', 'Fp=7Fp=7Fp=7', 'id21795235_foodrecipes'); 000Webhost
if (mysqli_connect_errno()) {
    echo 'Error Connect: ' . mysqli_connect_error();
}
    //echo'Connected';
?>
