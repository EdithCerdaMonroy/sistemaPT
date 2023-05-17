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

        <div class="col-8">
            <div class="card border border-secondary shadow-0">
                <div class="card-body">
                    <h5 class="card-title">Vacante</h5>
                    <!-- Formulario -->
                    <form class="d-grid gap-3 needs-validation" id="fVacante" novalidate>
                        <!-- Rol -->
                        <div class="mb-1">
                            <label for="perfil">Rol</label>
                            <select id="sRol" class="form-select form-select-lg mb-3"></select>
                        </div>
                        <!-- Modalidad -->
                        <div class="mb-1">
                            <label for="perfil">Modalidad</label>
                            <select id="sModalidad" class="form-select form-select-lg mb-3"></select>
                        </div>
                        <!-- Desacripcion -->
                        <div class="mb-1">
                            <div class="form-outline">
                                <textarea class="form-control" id="iDescripcion" rows="4" required></textarea>
                                <label class="form-label" for="iDescripcion">Descripción</label>
                                <div class="invalid-feedback">Ingresa una descripción.</div>
                            </div>
                        </div>
                        <!-- Sueldo -->
                        <div class="mb-1">
                            <div class="form-outline">
                                <input type="number" id="iSueldo" class="form-control" required/>
                                <label class="form-label" for="iSueldo">Sueldo</label>
                                <div class="invalid-feedback">Ingresa un sueldo válido.</div>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block mb-3">Registrar vacante</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScripts -->
    <?php require_once(dirname(__FILE__) . '/partials/scripts.php'); ?>
    <script type="text/javascript" src="vacantesEmpresa.js"></script>
</body>

</html>