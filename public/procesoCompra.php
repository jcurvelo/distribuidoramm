<?php require('../connection.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require('../sharedHead.php');
    ?>
    <script src="./libraries/vue.js"></script>
</head>

<body>
    <?php
    require('../navbar.php');
    ?>
    <div class="container" class="text-center">
        <h1>Su pedido está siendo procesado</h1>
        <h3>Recibirá una notificación a su correo para confirmar</h3>
        <h5>Debe confirmar en un máximo de 24 horas o su pedido será cancelado</h5>
    </div>
    <script>
        new Vue({
            el: "#shoppingbar",
            data: {
                cart: []
            },
            methods: {
                pagar: function() {
                    bus.$emit('mostrarPagar', this.cart);
                }
            },
            created() {
                bus.$on("agregarProducto", (data) => {
                    this.cart.push(data);
                });
                bus.$on("eliminarProducto", (data) => {
                    for (const x in this.cart) {
                        if (this.cart.hasOwnProperty(x)) {
                            if (this.cart[x].id == data.id) {
                                this.cart.splice(x, 1);
                            }
                        }
                    }
                });
            },
        });
    </script>
</body>

</html>
<?php

$nombre_cliente = $_POST['nombre_cliente'];
$tel_cliente = $_POST['tel_cliente'];
$email_cliente = $_POST['email_cliente'];
$delivery_type = $_POST['delivery_type'];
$detalles = $_POST['detalles'];
$metodo_pago = $_POST['metodo_pago'];
$total_pagar = $_POST['total_pagar'];
$lista_productos = $_POST['lista_productos'];

if ($_POST['delivery_type'] == 'domicilio') {
    $delivery_date = $_POST['delivery_date'];
    $direccion = $_POST['direccion'];
    $sql = "INSERT INTO pedidos (client_name, client_phone, client_email, payment_method, delivery_type, delivery_date, product_list, status, address, total_pay) 
VALUES ('$nombre_cliente','$tel_cliente','$email_cliente','$metodo_pago','$delivery_type','$delivery_date','$lista_productos',1,'$direccion','$total_pagar')";
}else{
    $sql = "INSERT INTO pedidos (client_name, client_phone, client_email, payment_method, delivery_type, product_list, status, total_pay) 
VALUES ('$nombre_cliente','$tel_cliente','$email_cliente','$metodo_pago','$delivery_type','$lista_productos',1,'$total_pagar')";

}

$result = $conn->query($sql);

if (!$result) {
    echo 'Error de conexión ' . $conn->error;
}
