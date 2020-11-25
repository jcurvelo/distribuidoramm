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
                    <tr v-for="pedido in listaPedidos" v-if="pedido.status==1">
                        <td>{{ pedido.id_order }}</td>
                        <td>{{ pedido.client_name }}</td>
                        <td>{{ pedido.payment_method }}</td>
                        <td>{{ pedido.delivery_type }}</td>
                        <td>{{ pedido.total_pay }}</td>
                        <td>{{ pedido.address }}</td>
                        <td>
                            <ul>
                                <li v-for="producto in JSON.parse(pedido.product_list)">{{ producto.nombre }} x{{ producto.cantidad }}</li>
                            </ul>
                        </td>
                        <td>
                            <button class="btn btn-success" @click="aceptarPedido(pedido.id_order)">Aceptar</button>
                            <button class="btn btn-warning" @click="eliminarPedido(pedido.id_order)">Declinar</button>
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
                        <th>Datos de pedido</th>
                        <th>Repartidor</th>
                        <th>Comprobante</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <tr v-for="pedido in listaPedidos" v-if="pedido.status==2">
                        <td>{{ pedido.id_order }}</td>
                        <td>{{ pedido.client_name }}</td>
                        <td>{{ pedido.client_phone }}</td>
                        <td>{{ pedido.client_email }}</td>
                        <td>
                            <span>Entrega: {{ pedido.delivery_type }}</span><br>
                            <span>Dirección: {{ pedido.address }}</span><br>
                            <span>Método de Pago: {{ pedido.payment_method }}</span><br>
                            <span>A Pagar: Bs.S{{ pedido.total_pay }}</span>
                        </td>
                        <td>
                            <select v-model="repartidores" class="custom-select" v-if="pedido.delivery_type=='domicilio'" name="repartidor" id="repartidor">
                                <option v-for="repartidor in listaRepartidores" :value="repartidor.id_deliverer">{{ repartidor.deliverer_name }}#{{ repartidor.id_deliverer }}</option>
                            </select>
                            <span v-else>N/A</span>
                        </td>
                        <td>{{ pedido.payment_proof }}</td>
                        <td>
                            <button class="btn btn-success form-control" @click="confirmarEntrega(pedido.id_order, repartidores)">Aceptar</button><br>
                            <button class="btn btn-warning form-control" @click="cancelarEntrega(pedido.id_order)">Declinar</button>
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
                <td>{{ id }}</td>                
                <td>{{ nombre }}</td>
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
            listaPedidos: [],
            listaRepartidores: [],
            repartidores: ''
        },
        methods: {
            eliminarPedido: function(id){
                fetch(`./accionesAdmin.php?eliminarPedido=${id}`);
                location.reload();
            },
            aceptarPedido: function(id){
                fetch(`./accionesAdmin.php?aceptarPedido=${id}`);
                location.reload();
            },
            confirmarEntrega: function(id, repartidor){
                fetch(`./accionesAdmin.php?confirmarEntrega=${id}&repartidor=${repartidor}`);
                location.reload();
            },
            cancelarEntrega: function(id){
                fetch(`./accionesAdmin.php?cancelarEntrega=${id}`);
                location.reload();
            }
        },
        created(){
            // Obtener lista de pedidos
            fetch('./pedidosJson.php').then(response=>response.json()).then(data=>{
                this.listaPedidos = data;
            });

            // Obtener repartidores
            fetch('./repartidoresJson.php').then(response=>response.json()).then(data=>{
                this.listaRepartidores = data;
                console.log(data);
            })
        }
    })
</script>

</html>