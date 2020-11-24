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
        <div class="container dashboard">
            <div id="dashboard" class="dashboardInfo text-center">
                <div class="row">
                    <div id="tasaDolarContainer" class="col-6 dashboardCard">
                        <h3>Tasa del dolar</h3>
                        <input type="number" name="tasaDolar" id="tasaDolar" value="620000" disabled>
                        <button v-if="!this.cambiar" class="btn btn-warning" @click="toggleCambiar">Cambiar</button>
                        <button v-if="this.cambiar"  class="btn btn-secondary" @click="toggleCambiar">Cancelar</button-btn>
                        <button v-if="this.cambiar" class="btn btn-primary">Aceptar</button>
                    </div>

                    <div id="pedidosPorGestionar" class="col-6 dashboardCard">
                        <h3>Pedidos por Gestionar</h3>
                        <span>{{ cantidadPedidosGestionar }}</span>
                    </div>

                </div>
                <div class="row">
                    <div class="col-6 dashboardCard">
                        <h3>Peidos por Confirmar</h3>
                        <span>0</span>
                    </div>
                    <div class="col-6 dashboardCard">
                        <h3>Número de productos</h3>
                        <span>{{ totalProductos }}</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        new Vue({
            el:'#tasaDolarContainer',
            data:{
                dolar: 0,
                cambiar: false
            },
            methods: {
                toggleCambiar: function(){
                    this.cambiar = !this.cambiar;
                }
            },
            created(){
                fetch('./infogeneralJson.php')
                .then(response=>response.json())
                .then((data)=>{
                    this.dolar = data[0];
                })
            }
        });

        new Vue({
            el: '#pedidosPorGestionar',
            data:{
                cantidadPedidosGestionar: 0
            },
            created(){
                fetch('./pedidosJson.php')
                .then(response=>response.json())
                .then(data=>{
                    this.cantidadPedidosGestionar = data.length;
                })
            }
        });
    </script>
</body>

</html>