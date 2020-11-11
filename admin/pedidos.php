<?php
    session_start();
    
    if(!$_SESSION['session_id']){
        header('Location: ./index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require('./adminHead.php');
    ?>
</head>

<body>
    <div class="mainContent">
        <?php
        require('./menuAdmin.php');
        ?>
        <div class="container">
            <h4>Por Gestionar</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tipo de pago</th>
                        <th>Delivery</th>
                        <th>Total</th>
                        <th>Dirección</th>
                        <th>Productos</th>
                    </tr>
                </thead>
            </table>
            <br>
            <h4>Por Confirmar</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tipo de pago</th>
                        <th>Delivery</th>
                        <th>Total</th>
                        <th>Dirección</th>
                        <th>Productos</th>
                    </tr>
                </thead>
            </table>
            <h2>Lista de cosas por hacer aquí</h2>
            <ul>
                <li>Crear lista de pedidos</li>
                <li>La información de los pedidos debe ser id, nombre de la persona, dirección y método de pago</li>
                <li>Crear un historial de pedidos pasados</li>
                <li>Separar los pedidos for gestionar de los pedidos por confirmar</li>
            </ul>
        </div>
    </div>
</body>

</html>