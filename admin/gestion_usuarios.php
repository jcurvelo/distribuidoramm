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
            <h2>Lista de cosas por hacer aquí</h2>
            <ul>
                <li>Agregar una lista de usuarios</li>
                <li>Agregar botón para nuevo usuario</li>
                <li>En la lista debe haber opciones para gestionar los usuarios</li>
                <li>Editar debe tener opción para ver o cambiar la contraseña</li>
                <li>Esta opción solo puede ser vista por usuarios nivel 1</li>
            </ul>
            <div id="test">
                <buttoncounter></buttoncounter>

            </div>
        </div>
    </div>
    <script>

    </script>
</body>

</html>