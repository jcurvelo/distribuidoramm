<?php

require('../connection.php');

$name = $_POST['nombreProducto'];
$image = $_POST['imagenProducto'];
$desc = $_POST['descripcionProducto'];
$price = $_POST['precioProducto'];
$stock = $_POST['stockActualProducto'];
$unitType = $_POST['tipoUnidad'];
$unitMin = $_POST['unidadProducto'];

$date = date('Y-m-d');

// echo $date;

$sql = "INSERT INTO productos (product_name, product_img, product_description, product_price, 
product_unit, product_min_unit, current_stock, creation_date, update_date) VALUES 
('$name','$image','$desc','$price','$stock','$unitType','$unitMin','$date','$date')";

if($conn->query($sql)){
    header('Location: ./productos.php');
}else{
    die("Error al agregar productos: ".$conn->error);
}