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
      <div class="card border border-secondary shadow-0">
        <div class="card-body">
          <h5 class="card-title">Perfil</h5>
          <!-- Formulario -->
          <form class="d-grid gap-3 needs-validation" id="fPerfil" novalidate>
            <!-- Nombre input -->
            <div class="mb-1">
              <div class="form-outline">
                <input type="text" id="iNombre" class="form-control" required />
                <label class="form-label" for="iNombre">Nombre</label>
                <div class="invalid-feedback">Ingresa un nombre correcto.</div>
              </div>
            </div>

            <!-- Telefono -->
            <div class="mb-1">
              <div class="form-outline">
                <input type="number" id="iTelefono" class="form-control" required />
                <label class="form-label" for="iTelefono">Telefono</label>
                <div class="invalid-feedback">Ingresa un telefono correcto.</div>
              </div>
            </div>
            <!-- Edad -->
            <div class="mb-1">
              <div class="form-outline">
                <input type="number" id="iEdad" class="form-control" required />
                <label class="form-label" for="iEdad">Edad</label>
                <div class="invalid-feedback">Ingresa tu edad.</div>
              </div>
            </div>
            <!-- Escolaridad input -->
            <div class="mb-1">
              <div class="form-outline">
                <input type="text" id="iEscolaridad" class="form-control" required />
                <label class="form-label" for="iEscolaridad">Escolaridad</label>
                <div class="invalid-feedback">Ingresa tu escolaridad.</div>
              </div>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-3">Actualizar Perfil</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScripts -->
  <?php require_once(dirname(__FILE__) . '/partials/scripts.php'); ?>
  <script type="text/javascript" src="perfilSolicitante.js"></script>
</body>

</html>