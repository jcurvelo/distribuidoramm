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
        <!-- <h3>Buscar Productos</h3>
        <h5>Filtrar búqueda</h5>
        <form action="">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="btn btn-secondary input-group-text" type="button">Buscar</button>
                </div>
                <input class="form-control" type="text" name="buscarProducto" id="buscarProducto">
                <div class="input-group-prepend">
                    <select class="custom-select" name="categoria" id="categoria">
                        <option value="todo" selected>Todo</option>
                        <option value="res">Res</option>
                        <option value="pollo">Pollo</option>
                        <option value="cerdo">Cerdo</option>
                        <option value="varios">Varios</option>
                    </select>
                </div>
            </div>
        </form> -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Carrito de Compras</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="pagar">
                        <div v-if="section_pagar=='sec1'" v-for="producto in productos" class="row">
                            <div :style="producto.imagen" class="col-2 imagen_producto_carrito"></div>
                            <div class="col-8">
                                <h3>{{ producto.nombre }}</h3><br>
                                <span>Bs.S{{ producto.precioTotal }}</span>
                            </div>
                            <div class="col-2">
                                <span @click="addArticle(producto.id)" class="cantidadBoton"><i class="fas fa-angle-up"></i></span><br>
                                <span>{{ producto.cantidad }}</span><br>
                                <span @click="removeArticle(producto.id)" class="cantidadBoton"><i class="fas fa-angle-down"></i></span>
                            </div>
                        </div>
                        <div v-if="section_pagar=='sec2'" class="datosCliente">
                            <form action="./procesoCompra.php" method="post">
                                <input type="text" name="lista_productos" id="lista_productos" class="d-none" :value="JSON.stringify(productos)">
                                <input type="text" name="total_pagar" class="d-none" :value="total_pagar">
                                <div class="form-group">
                                    <label for="nombre_cliente">Nombre y Apellido</label>
                                    <input type="text" name="nombre_cliente" id="nombre_cliente" class="form-control" required>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="tel_cliente">Teléfono</label>
                                        <input type="tel" name="tel_cliente" id="tel_cliente" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email_cliente">Email</label>
                                        <input type="email" name="email_cliente" id="email_cliente" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input v-model="domicilioCheck" type="radio" name="delivery_type" id="domicilio" class="form-check-input" value="domicilio">
                                    <label for="domicilio" class="form-check-label">Entrega a Domicilio</label>
                                </div>
                                <div class="form-check">
                                    <input v-model="domicilioCheck" type="radio" name="delivery_type" id="presencial" class="form-check-input" value="presencial" checked>
                                    <label for="presencial" class="form-check-label">Búsqueda Personal</label>
                                </div>
                                <div v-if="domicilioCheck=='domicilio'">
                                    <div class="form-group">
                                        <label for="delivery_date">Fecha de entrega</label>
                                        <input type="date" name="delivery_date" id="delivery_date" class="form-control" :min="fechaHoy" :value="fechaHoy" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label>
                                        <input type="text" name="direccion" id="direccion" class="form-control" value="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="metodo_pago">Método de pago</label>
                                    <select class="custom-select" name="metodo_pago" id="metodo_pago">
                                        <option value="transferencia">Transferencia Bancaria</option>
                                        <option value="efectivo">Efectivo</option>
                                        <option value="divisas">Divisas (USD)</option>
                                        <option v-if="domicilioCheck!='domicilio'" value="punto">Punto de venta</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="detalles">Detalles de su compra</label>
                                    <textarea name="detalles" id="detalles" cols="30" rows="5" class="form-control" placeholder="Detalles extras de su compra"></textarea>
                                </div>
                                <input type="submit" class="btn btn-success" value="Confirmar compra">
                            </form>
                        </div>
                        <div v-if="section_pagar=='sec1'" class="modal-footer">
                            <span>Total a Pagar: Bs.S {{ total_pagar }}</span>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                            <button type="button" class="btn btn-primary" @click="continuarCompra">Continuar</button>
                        </div>
                        <div v-if="section_pagar=='sec2'" class="modal-footer">
                            <span>Total a Pagar: Bs.S {{ total_pagar }}</span>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                            <button type="button" class="btn btn-primary" @click="regresarCompra">Regresar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="display-products" class="d-flex justify-content-around flex-wrap">
            <producto v-for="product in products.slice(0,6)" :key="products.id_product" :nombre="product.product_name" :precio="product.product_price_bss" :unidad="product.product_unit" :imagen="{ backgroundImage: 'url('+product.product_img+')' }" :id="product.id_product" :description="product.product_description" :stock="product.current_stock"></producto>
        </div>

    </div>
    <?php
    require('../footer.php');
    ?>
    <script>
        const bus = new Vue();
        Vue.component('producto', {
            data: function() {
                return {
                    isPicked: false,
                }
            },
            methods: {
                carrito: function() {
                    if (this.isPicked) {
                        bus.$emit('eliminarProducto', {
                            nombre: this.nombre,
                            precio: this.precio,
                            precioTotal: this.precio,
                            imagen: this.imagen,
                            unidad: this.unidad,
                            id: this.id,
                            descripcion: this.description,
                            stock: this.sotck,
                            cantidad: 1
                        });
                    } else {
                        bus.$emit('agregarProducto', {
                            nombre: this.nombre,
                            precio: this.precio,
                            precioTotal: this.precio,
                            imagen: this.imagen,
                            unidad: this.unidad,
                            id: this.id,
                            descripcion: this.description,
                            stock: this.sotck,
                            cantidad: 1
                        });
                    }
                    this.isPicked = !this.isPicked;
                }
            },
            props: ['nombre', 'precio', 'unidad', 'imagen', 'id', 'description', 'stock'],
            template: `
            <div @click="carrito" class="product d-flex align-items-end" :style="imagen">
                <span v-if="isPicked" class="picked"><i class="fas fa-shopping-cart"></i></span>

                <div class="product-info text-center">
                    <h3>{{ nombre }}</h3>
                    <span>Bs.{{ precio }}</span>
                </div>
            </div>
            `
        })

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

        new Vue({
            el: '#pagar',
            data: {
                showThis: false,
                productos: [],
                domicilioCheck: null,
                section_pagar: 'sec1',
                total_pagar: 0,
                fechaHoy: ''
            },
            methods: {
                cerrar: function() {
                    this.showThis = false;
                },
                updateTotal: function(){
                    let temp = 0;
                    for(let x in this.productos){
                        temp += parseInt(this.productos[x].precioTotal);
                    }
                    this.total_pagar = temp;
                },
                addArticle: function(id) {
                    for (const key in this.productos) {
                        if (this.productos.hasOwnProperty(key)) {
                            if (this.productos[key].id == id) {
                                this.productos[key].cantidad++;
                                this.productos[key].precioTotal = this.productos[key].cantidad * this.productos[key].precio;
                            }
                        }
                    }
                    this.updateTotal();
                },
                removeArticle: function(id) {
                    for (const key in this.productos) {
                        if (this.productos.hasOwnProperty(key)) {
                            if (this.productos[key].id == id) {
                                this.productos[key].cantidad > 1 ? this.productos[key].cantidad-- : 1;
                                this.productos[key].precioTotal = this.productos[key].cantidad * this.productos[key].precio;
                            }
                        }
                    }
                    this.updateTotal();
                },
                continuarCompra: function() {
                    this.section_pagar = 'sec2';
                },
                regresarCompra: function() {
                    this.section_pagar = 'sec1';
                },
            },
            created() {
                bus.$on('mostrarPagar', (data) => {
                    this.showThis = true;
                    this.productos = data;
                    this.productos.length > 1 ? this.total_pagar = this.productos.reduce((x, y) => parseFloat(x.precio) + parseFloat(y.precio)) : this.total_pagar = this.productos[0].precio;
                    // FECHA HOY
                    let fecha = new Date();
                    fecha.setMonth(fecha.getMonth()+1);
                    this.fechaHoy = `${fecha.getFullYear()}-${fecha.getMonth()}-${fecha.getDate()}`
                });
            }
        });
    </script>
</body>


</html>