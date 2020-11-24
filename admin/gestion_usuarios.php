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
    <script src="../public/libraries/vue.js"></script>
</head>

<body>
    <div class="mainContent">
        <?php
        require('./menuAdmin.php');
        ?>
        <div id="usuarios" class="container">
            <form action="post" style="width: 50vw; background-color: gray; padding: 1vw;">
                <h3 class="text-white">Agregar nuevo Usuario</h3>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Nombre de Usuario</div>
                    </div>
                    <input type="text" class="form-control">
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Contraseña</div>
                    </div>
                    <input type="password" class="form-control">
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Nivel de acceso</div>
                    </div>
                    <select class="custom-select" name="" id="">
                        <option value="1">Administrador</option>
                        <option value="2">Gestor</option>
                        <option value="3">Usuario</option>
                    </select>
                </div>
                <button class="btn btn-success btn-lg">Aceptar</button>
            </form>
            <table class="table">
                <thead>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Nivel de Acceso</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    <tr v-for="usuario in listaUsuarios">
                        <td>{{ usuario.user_id }}</td>
                        <td>{{ usuario.username }}</td>
                        <td>{{ usuario.access_level }}</td>
                        <td>
                            <button @click="toggleMostrarNivel" class="btn btn-secondary">Gestionar</button>
                            <button class="btn btn-danger">Eliminar</button>

                        <td v-if="mostrarNivel">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Nivel de Acceso</div>
                                </div>
                                <select class="custom-select" name="" id="">
                                    <option value="1">Administrador</option>
                                    <option value="2">Gestor</option>
                                    <option value="3">Usuario</option>
                                </select>
                            </div>
                        </td>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        new Vue({
            el: '#usuarios',
            data: {
                listaUsuarios: [],
                mostrarNivel: false
            },
            methods: {
                toggleMostrarNivel: function() {
                    this.mostrarNivel = !this.mostrarNivel;
                }
            },
            created() {
                fetch('./usuariosJson.php')
                    .then(response => response.json())
                    .then((data) => {
                        this.listaUsuarios = data;
                    })
            }
        })
    </script>
</body>

</html>