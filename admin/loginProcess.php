<?php
require('../connection.php');

$username = $_POST['username'];
$password = $_POST['password'];

$consultaTablaUsuarios = "SELECT * FROM usuarios WHERE `username` = '$username' AND `password` = '$password'";

$loginResult = $conn->query($consultaTablaUsuarios);

if($loginResult->num_rows > 0){
    header("Location:./dashboard.php");

}else{
    header("Location:./login.php");
}