<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Heads -->
  <?php require_once(dirname(__FILE__) . '/partials/header.php') ?>
</head>

<body>
  <section>
    <div class="container py-5">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-8">
          <div class="card border border-secondary shadow-0">
            <div class="card-body p-4 text-center">
              <h3 class="mb-4">Por favor Inicia sesión o Registrate</h3>
              <a href="login.php">Iniciar sesión</a> or
              <a href="signup.php">Registro</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- JavaScripts -->
  <?php require_once(dirname(__FILE__) . '/partials/scripts.php'); ?>
</body>

</html>