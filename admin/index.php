<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require('./adminHead.php');
    ?>
</head>

<body>
    <div id="login" class="d-flex justify-content-center">
        <img src="../public/img/Logo-empresa-png.png" alt="logo" width="300" height="300">

        <div class="container">
            <h2 class="text-center">Sistema Administrador</h2>
            <form action="./loginProcess.php" method="post">
                <div class="form-group">
                    <label for="username">Nombre de usuario</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Usuario">
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="password">
                </div>
                <input type="submit" name="ingresar" value="Ingresar" class="btn btn-primary form-control">
            </form>
        </div>
    </div>
</body>

</html>