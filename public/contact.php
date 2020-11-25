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
        <div class="contact content-area d-flex align-items-center">
            <div class="bg-contact"></div>
            <div class="container">
                <h2>Contáctanos</h2>
                <br /><br />
                <div class="row">
                    <div class="col-6">
                        <form action="#">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre y Apellido" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <input class="form-control" type="email" name="email" id="email" placeholder="ejemplo@email.com" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Asunto</label>
                                <input class="form-control" type="email" name="email" id="email" placeholder="¿Sobre qué desea hablarnos?" required />
                            </div>
                            <div class="form-group">
                                <label for="desc">Descripción</label>
                                <textarea class="form-control" name="desc" id="desc" cols="30" rows="10" placeholder="Describa su mensaje"></textarea>
                            </div>
                            <input class="btn btn-primary" type="button" value="Enviar" />
                        </form>
                    </div>
                    <div class="col-6 text-center">
                        <h4>Ubicación</h4>
                        <div id="mapa"></div>
                        <span>Av. Principal de Ruiz Pineda, zona 1, casa número D-6, Guarenas,
                            Estado Miranda</span>
                    </div>
                </div>
            </div>
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