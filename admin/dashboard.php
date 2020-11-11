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
        <div class="container dashboard">
            <div id="dashboard" class="dashboardInfo text-center">
                <div class="row">
                    <div class="col-6 dashboardCard">
                        <h3>Tasa del dolar</h3>
                        <input type="number" name="tasaDolar" id="tasaDolar" value="520000" disabled>
                        <button class="btn btn-warning">Cambiar</button>
                    </div>

                    <div class="col-6 dashboardCard">
                        <h3>Pedidos por Gestionar</h3>
                        <span>0</span>
                    </div>

                </div>
                <div class="row">
                    <div class="col-6 dashboardCard">
                        <h3>Peidos por Confirmar</h3>
                        <span>0</span>
                    </div>
                    <div class="col-6 dashboardCard">
                        <h3>Número de productos</h3>
                        <span>{{ totalPedidos }}</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>