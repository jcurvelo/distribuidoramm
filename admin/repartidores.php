<?php
session_start();

if (!$_SESSION['session_id']) {
    header('Location: ./index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require('./adminHead.php');
    ?>
    <script src="../public/libraries/vue.js"></script>
</head>

<body>
    <div class="mainContent">
        <?php
        require('./menuAdmin.php');
        ?>
        <div id="repartidores" class="container">
        <table class="table">
                <thead>
                    <th>Foto</th>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cédula</th>
                    <th>Vehículo</th>
                    <th>Placa</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    <tr v-for="repartidor in listaRepartidores">
                        <td>
                            <img :src="repartidor.deliverer_picture" alt="deliverer_picture" style="max-width: 100px; max-height:100px;">
                        </td>
                        <td>{{ repartidor.id_deliverer }}</td>
                        <td>{{ repartidor.deliverer_name }} {{ repartidor.deliverer_lastname }}</td>
                        <td>{{ repartidor.deliverer_ci }}</td>
                        <td>{{ repartidor.deliverer_veh }}</td>
                        <td>{{ repartidor.deliverer_plate }}</td>
                        <td>{{ repartidor.deliverer_status }}</td>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-primary">Agrenar Nuevo</button>    

        </div>
    </div>
    <script>
        new Vue({
            el: '#repartidores',
            data: {
                listaRepartidores: []
            },
            created() {
                fetch('./repartidoresJson.php')
                .then(response=>response.json())
                .then(data=>{
                    this.listaRepartidores = data;
                })
            }
        })
    </script>
</body>