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
        <h3>Buscar Productos</h3>
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
        </form>
        <div v-if="showThis" id="pagar" class="pagar">
            <span @click="cerrar" class="cerrarPagar text-right">&times;</span><br>
            <div v-for="producto in productos" class="row">
                <div :style="producto.imagen" class="col-2 imagen_producto_carrito"></div>
                <div class="col-9">
                    <h3>{{ producto.nombre }}</h3><br>
                    <span>{{ producto.descripcion }}</span>
                    <span><span>$</span>{{ producto.precio }}</span>
                </div>
                <div class="col-1">
                    <span @click="addArticle(producto.id)" class="cantidadBoton"><i class="fas fa-angle-up"></i></span><br>
                    <span>{{ producto.cantidad }}</span><br>
                    <span @click="removeArticle(producto.id)" class="cantidadBoton"><i class="fas fa-angle-down"></i></span>
                </div>
            </div>
            <button class="btn btn-success" @click="continuarCompra">Continuar compra</button>
        </div>
        <div id="display-products" class="d-flex justify-content-around flex-wrap">
            <producto v-for="product in products.slice(0,9)" 
            :key="products.id_product" 
            :nombre="product.product_name"
            :precio="product.product_price" 
            :unidad="product.product_unit"
            :imagen="{ backgroundImage: 'url('+product.product_img+')' }" 
            :id="product.id_product" 
            :descripcion="product.description" 
            :stock="product.current_stock"></producto>

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
                        imagen: this.imagen,
                        unidad: this.unidad,
                        id: this.id,
                        descripcion: this.descripcion,
                        stock: this.sotck,
                        cantidad: 1
                    });
                } else {
                    bus.$emit('agregarProducto', {
                        nombre: this.nombre,
                        precio: this.precio,
                        imagen: this.imagen,
                        unidad: this.unidad,
                        id: this.id,
                        descripcion: this.descripcion,
                        stock: this.sotck,
                        cantidad: 1
                    });
                }
                this.isPicked = !this.isPicked;
            }
        },
        props: ['nombre', 'precio', 'unidad', 'imagen', 'id','descripcion','stock'],
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
                bus.$emit('mostrarPagar',this.cart);
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
        el:'#pagar',
        data:{
            showThis: false,
            productos: []
        },
        methods:{
            cerrar: function(){
                this.showThis = false;
            },
            addArticle: function(id){
                for (const key in this.productos) {
                    if (this.productos.hasOwnProperty(key)) {
                        if(this.productos[key].id == id){
                            this.productos[key].cantidad++; 
                            this.productos[key].precio *= this.productos[key].cantidad;
                        }                     
                    }
                }
            },
            removeArticle: function(id){
                for (const key in this.productos) {
                    if (this.productos.hasOwnProperty(key)) {
                        if(this.productos[key].id == id){
                            this.productos[key].cantidad > 1 ? this.productos[key].cantidad-- : 1;
                            this.productos[key].precio *= this.productos[key].cantidad;
                        }                     
                    }
                }
            },
            continuarCompra: function(){
                console.log(this.productos)
            }
        },
        created(){
            bus.$on('mostrarPagar',(data)=>{
                this.showThis = true;
                this.productos = data;
            });
        }
    });
    </script>
</body>


</html>