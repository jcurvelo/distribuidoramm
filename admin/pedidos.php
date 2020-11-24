<?php
session_start();

if (!$_SESSION['session_id']) {
    header('Location: ./index.php');
}
require('../connection.php');
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
        <div id="tablas" class="container">
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
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="pedido in pedidosPorGestionar">
                        <td>{{ pedido.id_order }}</td>
                        <td>{{ pedido.client_name }}</td>
                        <td>{{ pedido.payment_method }}</td>
                        <td>{{ pedido.delivery_type }}</td>
                        <td>{{ pedido.total_pay }}</td>
                        <td>{{ pedido.address }}</td>
                        <td>{{ JSON.parse(pedido.product_list).length }}</td>
                        <td>
                            <button class="btn btn-success">Aceptar</button>
                            <button class="btn btn-warning">Declinar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <br>
            <h4>Por Confirmar</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Total a pagar</th>
                        <th>Tipo de Entrega</th>
                        <th>Dirección</th>
                    </tr>
                </thead>
                <tbody>
                <tr v-for="pedido in pedidosPorConfirmar">
                        <td>{{ pedido.id_order }}</td>
                        <td>{{ pedido.client_name }}</td>
                        <td>{{ pedido.client_phone }}</td>
                        <td>{{ pedido.client_email }}</td>
                        <td>{{ pedido.total_pay }}</td>
                        <td>{{ pedido-delivery_type }}</td>
                        <td>{{ pedido.address }}</td>
                        <td>
                            <button class="btn btn-success">Aceptar</button>
                            <button class="btn btn-warning">Declinar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
    Vue.component('pedido', {
        data: function() {
            return {
            }
        },
        props: ['id', 'nombre', 'tipo_pago', 'delivery', 'total', 'direccion', 'productos', 'status'],
        template: `
            <tr>
                <td>{{ id }}</td>                <td>{{ nombre }}</td>
                <td>{{ tipo_pago }}</td>
                <td>{{ delivery }}</td>
                <td>{{ total }}</td>
                <td>{{ direccion }}</td>
            </tr>
        `
    })
    new Vue({
        el: '#tablas',
        data: {
            pedidosPorGestionar: [],
            pedidosPorConfirmar: []

        },
        created(){
            fetch('./pedidosJson.php').then(response=>response.json()).then(data=>{
                this.pedidosPorGestionar = data;
                
            })
        }
    })
</script>

</html>