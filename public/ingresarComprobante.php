<?php
    if(!isset($_GET['pedido'])){
        header('Location: ./index.php');
    }
?>

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
    <div class="container">
        <div class="text-center">
            <h2>Ingresar Número de referencia</h2>
            <form action="./procesoComprobante.php" method="post">
                <span>ID del pedido: <?php echo $_GET['pedido']?></span>
                <input type="text" name="idPedido" id="idPedido" class="d-none" value='<?php echo $_GET['pedido']?>'>
                <div class="form-group">
                    <label for="numeroReferencia">Número de referencia</label>
                    <input type="number" name="numeroReferencia" id="numeroReferencia" required>
                </div>
                <input type="submit" value="Enviar" class="btn btn-success">
            </form>
        </div>
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