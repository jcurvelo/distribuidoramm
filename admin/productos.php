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
        <div class="container p5">
        <b>TODO</b><br>
        Agregar un padding al listado
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