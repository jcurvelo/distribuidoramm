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
</body>

</html>