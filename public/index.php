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
    <div id="home" class="content-area">
        <div class="slash"></div>
        <div class="slash"></div>
        <div class="bg-image"></div>
        <div id="first-section" class="container d-flex align-items-center justify-content-around">
            <div class="slogan">
                <h2>TU MEJOR OPCIÓN</h2>
                <br />
                <span class="slogan-subphrase">CON LOS MEJORES <span>PRECIOS</span></span><br>
                <a href="store.php" class="btn btn-warning" style="text-shadow: none;">
                    <i class="fas fa-shopping-cart"></i> Visitar la Tienda
                </a>
            </div>
            <div class="logo"></div>
        </div>
    </div>
    <?php
    require('../footer.php');
    ?>
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