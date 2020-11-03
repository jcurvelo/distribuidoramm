<?php

$host = "localhost";
$username = "root";
$password = "";
$db = "distribuidoramm";

$conn = new mysqli($host,$username,$password,$db);

if($conn->connect_error){
    die("Error al conectar a la base de datos".mysqli_connect_error());
}
