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
        <div id="dashboardArea" class="container dashboard">
            <div class="dashboardInfo text-center">
                <div class="row">
                    <div class="col-6 dashboardCard">
                        <h3>Tasa del dolar</h3>
                        <input v-model="inputDolar" type="number" name="tasaDolar" id="tasaDolar" :disabled="deshabilitarInputDolar">
                        <button v-if="!this.cambiar" class="btn btn-warning" @click="toggleCambiar">Cambiar</button>
                        <button v-if="this.cambiar"  class="btn btn-secondary" @click="cancelarNuevoDolar">Cancelar</button-btn>
                        <button v-if="this.cambiar" class="btn btn-primary" @click="actualizarDolar(inputDolar)">Aceptar</button>
                    </div>

                    <div id="pedidosPorGestionar" class="col-6 dashboardCard">
                        <h3>Pedidos por Gestionar</h3>
                        <span>{{ cantidadPedidosGestionar }}</span>
                    </div>

                </div>
                <div class="row">
                    <div class="col-6 dashboardCard">
                        <h3>Peidos por Confirmar</h3>
                        <span>{{ cantidadPedidosConfirmar }}</span>
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
            el: '#dashboardArea',
            data: {
                inputDolar: 0,
                dolarPrevio: 0,
                cambiar: false,
                cantidadPedidosGestionar: 0,
                cantidadPedidosConfirmar: 0,
                totalProductos: 0,
                deshabilitarInputDolar: true,
            },
            methods: {
                toggleCambiar: function() {
                    this.cambiar = !this.cambiar;
                    this.deshabilitarInputDolar =  !this.deshabilitarInputDolar;
                },
                cancelarNuevoDolar: function(){
                    this.cambiar = !this.cambiar;
                    this.deshabilitarInputDolar =  !this.deshabilitarInputDolar;
                    this.inputDolar = this.dolarPrevio;
                },
                actualizarDolar: function(precio){
                    fetch(`./accionesAdmin.php?actualizarDolar=${precio}`);
                    window.location.reload();
                }
            },
            created() {
                fetch('./infogeneralJson.php')
                    .then(response => response.json())
                    .then((data) => {
                        this.inputDolar = parseInt(data[0].precio_dolar);
                        this.dolarPrevio = parseInt(data[0].precio_dolar);
                    }).catch(err => {
                        console.log(err);
                    })

                fetch('./pedidosJson.php')
                    .then(response => response.json())
                    .then(data => {
                        // POR GESTIONAR
                        let tempGestionar = 0;
                        for(let x in data){
                            if(data[x].status==1 || data[x].status=='1'){
                                tempGestionar++;
                            }
                        }
                        this.cantidadPedidosGestionar = tempGestionar;

                        // POR CONFIRMAR
                        let tempConfirmar = 0;
                        for(let x in data){
                            if(data[x].status==2 || data[x].status=='2'){
                                tempConfirmar++;
                            }
                        }
                        this.cantidadPedidosConfirmar = tempConfirmar;
                    }).catch(err => {
                        console.log(err);
                    })

                fetch("../db_to_json.php")
                    .then(response => response.json())
                    .then(data => {
                        this.totalProductos = data.length;
                    }).catch(err => {
                        console.log(err);
                    })
            }
        })
    </script>
</body>

</html>