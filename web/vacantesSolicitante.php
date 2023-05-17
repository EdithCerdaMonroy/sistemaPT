<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Heads -->
    <?php require_once(dirname(__FILE__) . '/partials/header.php') ?>
</head>

<body>
    <?php
    // Validacion de Usuarios.
    if (!isset($_SESSION['user']) || $_SESSION['user']['tipoUsuario'] != 'Solicitante') {
        echo '<div class="card text-white bg-danger my-5">
      <div class="card-body text-center">Favor de loguearse con los permisos necesarios.</div>
      </div>';
        exit();
    }
    ?>

    <div class="row my-4">
        <!-- Menu -->
        <?php require_once(dirname(__FILE__) . '/partials/menu.php') ?>

        <div class="col-8">
            <!-- Vacantes Postuladas -->
            <div class="card border border-secondary rounded-end mb-4">
                <div class="card-body">
                    <h5 class="card-title">Mis postulaciones</h5>
                    <div id="cPostulaciones">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">Empresa</th>
                                        <th scope="col">Area</th>
                                        <th scope="col">Rol</th>
                                        <th scope="col">Modalidad</th>
                                        <th scope="col">Descripcion</th>
                                        <th scope="col">Sueldo</th>
                                    </tr>
                                </thead>
                                <tbody id="tbPostulaciones"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vacantes para Postularse -->
            <div class="card border border-secondary rounded-end">
                <div class="card-body">
                    <h5 class="card-title">Vacantes</h5>
                    <div id="cVacantes">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">Empresa</th>
                                        <th scope="col">Area</th>
                                        <th scope="col">Rol</th>
                                        <th scope="col">Modalidad</th>
                                        <th scope="col">Descripcion</th>
                                        <th scope="col">Sueldo</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="tbVacantes"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScripts -->
    <?php require_once(dirname(__FILE__) . '/partials/scripts.php'); ?>
    <script type="text/javascript" src="vacantesSolicitante.js"></script>
</body>

</html>