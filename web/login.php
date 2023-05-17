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
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card border border-secondary shadow-0">
            <div class="card-body p-4 text-center">
              <h3 class="card-title mb-4">Iniciar sesión</h3>
              <!-- Formulario -->
              <form class="d-grid gap-3 needs-validation" id="fLogin" novalidate>
                <!-- Email input -->
                <div class="mb-1">
                  <div class="form-outline">
                    <input type="email" id="iEmail" class="form-control" required />
                    <label class="form-label" for="iEmail">Email</label>
                    <div class="invalid-feedback">Ingresa un email correcto.</div>
                  </div>
                </div>

                <!-- Password input -->
                <div class="mb-1">
                  <div class="form-outline">
                    <input type="password" id="iPass" class="form-control" required />
                    <label class="form-label" for="iPass">Password</label>
                    <div class="invalid-feedback">Ingresa un password correcto.</div>
                  </div>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-3">Iniciar sesión</button>

                <!-- Register buttons -->
                <div class="text-center">
                  <p>¿No tienes cuenta? <a href="signup.php">Registrate</a></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- JavaScripts -->
  <?php require_once(dirname(__FILE__) . '/partials/scripts.php'); ?>
  <script type="text/javascript" src="login.js"></script>
  
</body>

</html>