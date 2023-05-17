<div class="col-2 border border-secondary rounded-end">
  <div class="list-group list-group-light">    

    <?php
    // Menu Empresa
    echo '<p class="list-group-item px-3 border-0">'. $_SESSION['user']['mail'] .'</p>';

    if ($_SESSION['user']['tipoUsuario'] == 'Empresa') {
      echo '<a href="#" id="aPerfilEmpresa" onclick="rePerfilEmpresa()" class="list-group-item list-group-item-action px-3 border-0">Perfil</a>
            <a href="#" id="aVacantesEmpresa" onclick="reVacantesEmpresa()" class="list-group-item list-group-item-action px-3 border-0">Vacantes</a>
            <a href="#" id="aPostulados" onclick="rePostulados()" class="list-group-item list-group-item-action px-3 border-0">Postulados</a>';

      // Menu Solicitante
    } elseif ($_SESSION['user']['tipoUsuario'] == 'Solicitante') {
      echo '<a href="#" id="aPerfilSolicitante" onclick="rePerfilSolicitante()" class="list-group-item list-group-item-action px-3 border-0">Perfil</a>
            <a href="#" id="aVacantesSolicitante" onclick="reVacantesSolicitante()" class="list-group-item list-group-item-action px-3 border-0">Vacantes</a>';
    }
    ?>

    <a href="#" id="aSalir" onclick="logout()" class="list-group-item list-group-item-action px-3 border-0">Salir</a>
  </div>
</div>

<script type="text/javascript">
  // Pantallas Empresa
  const rePerfilEmpresa = () => window.location.replace(WEB.PERFIL_EMPRESA);
  const reVacantesEmpresa = () => window.location.replace(WEB.VACANTES_EMPRESA);
  const rePostulados = () => window.location.replace(WEB.POSTULADOS_EMPRESA);

  // Pantallas Solicitante
  const rePerfilSolicitante = () => window.location.replace(WEB.PERFIL_SOLICITANTE);
  const reVacantesSolicitante = () => window.location.replace(WEB.VACANTES_SOLICITANTE);

  // Muestra el boton presionado en la pantalla.
  function activarBotonMenu(idBtn) {
    document.getElementById(idBtn).className += ' active';
  }

  // Cerrar sesion.
  function logout() {
    fetch(API.LOGOUT_CONTROLLER, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({})
      })
      .then(res => window.location.replace(WEB.LOGIN))
      .catch(err => Swal.mixin({
                customClass: { confirmButton: "btn btn-primary btn-lg" },
                buttonsStyling: false
            })
            .fire({
                title: 'ERROR',
                showClass: { popup: 'animate__animated animate__fadeInDown' },
                hideClass: { popup: 'animate__animated animate__fadeOutUpBig' },
                confirmButtonText: "OK"
            })
        );
  }
</script>