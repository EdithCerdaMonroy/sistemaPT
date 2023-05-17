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
    if (!isset($_SESSION['user']) || $_SESSION['user']['tipoUsuario'] != 'Empresa') {
        echo '<div class="card text-white bg-danger my-5">
      <div class="card-body text-center">Favor de loguearse con los permisos necesarios.</div>
      </div>';
        exit();
    }
    ?>

    <div class="row my-4">
        <!-- Menu -->
        <?php require_once(dirname(__FILE__) . '/partials/menu.php') ?>

        <div class="col-8" id="cPostulantes"></div>
    </div>

    <!-- JavaScripts -->
    <?php require_once(dirname(__FILE__) . '/partials/scripts.php'); ?>
    <script type="text/javascript" src="postuladosEmpresa.js"></script>
</body>

</html>