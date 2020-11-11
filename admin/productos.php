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
</head>

<body>
    <div class="mainContent">
        <?php
        require('./menuAdmin.php');
        ?>
        <div class="container">
            <button class="btn btn-success" data-toggle="formularioProductos">Agregar Nuevo Producto</button>
            <div class="formularioProductos">
                <h2>Nuevo Producto</h2>
                <form action="./productProcess.php" method="post">
                    <div class="form-row">
                        <div class="col form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Nombre</span>
                                </div>
                                <input placeholder="Nombre del producto" class="form-control" type="text" name="nombreProducto" id="nombreProducto">
                            </div>
                        </div>
                        <div class="col form-group">
                            <label id="botonSubirImagen" for="imagenProducto"><i class="fas fa-images"></i> Subir Imagen
                                <input class="btn btn-primary" type="file" name="imagenProducto" id="imagenProducto" accept="image/*">
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Descripción</span>
                            </div>
                            <input class="form-control" placeholder="Descripción del producto" type="text" name="descripcionProducto" id="descripcionProducto">
                        </div>
                    </div>

                    <div class="input-group priceAndUnit">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input class="form-control" type="number" name="precioProducto" id="precioProducto" placeholder="Precio del producto">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cantidad Inicial</span>
                        </div>
                        <input class="form-control" type="number" placeholder="Cantidad inicial de productos" name="stockActualProducto" id="stockActualProducto">
                    </div>
                    <div class="input-group priceAndUnit">
                        <div class="input-prepend">
                            <span class="input-group-text">Tipo de Unidad</span>
                        </div>
                        <select name="tipoUnidad" id="tipoUnidad" class="custom-select">
                            <option value="kilos">Kilogramos | Kg</option>
                            <option value="litros">Litros | L</option>
                            <option value="gramos">Gramos | g</option>
                            <option value="individual">Unidad | u</option>
                        </select>
                        <div class="input-prepend">
                            <span class="input-group-text">Mínimo por Unidad</span>
                        </div>
                        <input class="form-control" type="text" name="unidadProducto" id="unidadProducto" placeholder="Ej. 250g ó 1Kg">
                    </div>
                    <input type="submit" value="Agregar" class="btn btn-primary">
                </form>
            </div>

            <b>TODO</b><br>
            Agregar un padding al listado
            <div id="filter" class="filter">
                <span>Odenar por</span>
                <select id="categorySort">
                    <option value="id">ID</option>
                    <option value="nombre">Nombre</option>
                    <option value="precio">Precio</option>
                    <option value="stock">Stock</option>
                    <option value="fechaMod">Fecha Modificacion</option>
                </select>
                <button class="btn btn-secondary">Buscar</button>
            </div>
            <div class="tableContainer">
                <table id="table" class="table">
                    <thead>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Unidad</th>
                        <th scope="col">Stock Actaul</th>
                        <th scope="col">Fecha de Atualización</th>
                    </thead>
                    <tbody id="productTable">
                        <tr v-for="product in products.slice(startSlice,endSlice)">
                            <td style="max-width: 15ch;">{{ product.id_product }}</td>
                            <td>{{ product.product_name }}</td>
                            <td style="max-width: 20ch;">{{ product.product_description }}</td>
                            <td>{{ product.product_price }}</td>
                            <td>{{ product.product_unit }}</td>
                            <td>{{ product.current_stock }}</td>
                            <td>{{ product.update_date }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation example">
                <ul id="navTable" class="pagination">
                    <li class="page-item">
                        <span class="page-link" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </span>
                    </li>
                    <li v-for="page in pages" class="page-item">
                        <span @click="changePage(page)" class="page-link">{{ page }}</span>
                    </li>
                    <li class="page-item">
                        <span class="page-link" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </span>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</body>

</html>