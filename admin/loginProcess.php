<?php
require('../connection.php');

$username = $_POST['username'];
$password = $_POST['password'];

$consultaTablaUsuarios = "SELECT * FROM usuarios WHERE `username` = '$username' AND `password` = '$password'";

$loginResult = $conn->query($consultaTablaUsuarios);

if($loginResult->num_rows > 0){
    session_start();
    while($row = $loginResult->fetch_assoc()){
        $_SESSION['session_id'] = crypt($username,'abcdefghijklmnopqrstuvwxyz');
        $_SESSION['username'] = $username;
        $_SESSION['access_level'] = $row['access_level'];
    }
    $insertSessionSql = "UPDATE usuarios SET `session_id` = '$_SESSION[session_id]'";
    $resultadoSession = $conn->query($insertSessionSql);
    if(!$resultadoSession){
        die("Error al guardar session");
        header("Location:./login.php");
    }
    header("Location:./dashboard.php");

}else{
    header("Location:./login.php");
}