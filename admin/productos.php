<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require('./menuHead.php');
    ?>
</head>

<body>
    <div class="mainContent">
        <?php
        require('./menuAdmin.php');
        ?>
        <div class="container p5">
            <span id="loading" class="d-block">Loading......</span>
            <table id="table" class="table d-none">
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
                <ul id="navTable" class="pagination d-none">
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
    <script src="adminScript.js"></script>
</body>

</html>