<?php

require('../connection.php');

$numeroReferencia = $_POST['numeroReferencia'];
$idPedido = $_POST['idPedido'];
$sql = "UPDATE pedidos SET payment_proof='$numeroReferencia' WHERE id_order='$idPedido'";

$result = $conn->query($sql);

if($result){
    header('Location: ./index.php');
}else{
    echo $conn->error;
}