<?php

require('../connection.php');

if(isset($_GET['eliminarPedido'])){
    $pedidoId = $_GET['eliminarPedido'];
    $sqlEliminar = "DELETE FROM pedidos WHERE id_order = '$pedidoId'";

    $responseEliminar = $conn->query($sqlEliminar);
}

if(isset($_GET['aceptarPedido'])){
    $pedidoId = $_GET['aceptarPedido'];
    $sqlAceptar = "UPDATE pedidos SET `status`=2 WHERE id_order='$pedidoId'";
    $responseAceptar = $conn->query($sqlAceptar);
}

if(isset($_GET['actualizarDolar'])){
    $precio = $_GET['actualizarDolar'];
    $sqlActualizarDolar = "UPDATE informacion_general SET precio_dolar='$precio'";
    $conn->query($sqlActualizarDolar);
}

if(isset($_GET['confirmarEntrega'])){
    $pedidoId = $_GET['confirmarEntrega'];
    $repartidor = $_GET['repartidor'];
    $sqlConfirmarEntrega = "UPDATE pedidos SET `status`=3, `deliverer`='$repartidor' WHERE id_order = '$pedidoId'";
    $conn->query($sqlConfirmarEntrega);
}

if(isset($_GET['cancelarEntrega'])){
    $pedidoId = $_GET['cancelarEntrega'];
    $sqlCancelarEntrega = "DELETE FROM pedidos WHERE id_order = '$pedidoId'";
    $conn->query($sqlCancelarEntrega);
}