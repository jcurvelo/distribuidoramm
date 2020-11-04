<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require('../sharedHead.php');
    ?>
</head>

<body>
    <?php
    require('../navbar.php');
    ?>

    <div class="container">
        <div class="frase">
            <h3>Productos en oferta</h3>
        </div>
        <div id="display-products" class="d-flex justify-content-around flex-wrap">
            <div v-for="product in products.slice(0,9)" class="product d-flex align-items-end" @click="addItem(product.id_product)" :style="{ backgroundImage: 'url('+product.product_img+')' }">
                <div class="product-info text-center">
                    <h3>{{ product.product_name }}</h3>
                    <span>Bs.{{ product.product_price }} - {{ product.product_unit }}</span>
                </div>
            </div>
        </div>
    </div>

</body>
<?php
require('../footer.php');
?>

</html>