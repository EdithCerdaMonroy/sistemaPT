const cPostulantes = document.getElementById('cPostulantes');
activarBotonMenu('aPostulados');

// Se pide al servidor los datos necesarios para registrar una Vacante.
fetch(API.VACANTE_EMPRESA_CONTROLLER + '?postulados', { method: 'GET' })
    // Respuesta del servidor.
    .then(res => res.json())
    // Se muestran los postulantes de cada Vacante en la pagina.
    .then(vacantes => {
        // Si no hay vacantes registradas.
        if (!vacantes.length) {
            cPostulantes.innerHTML = '<div class="note note-danger">No tienes vacantes registradas</div>';
            return;
        }

        let htmlPostulados;
        let htmlTabla;

        for (const vacante of vacantes) {
            htmlPostulados = '';
            htmlTabla = '';

            // Si hay postulantes.
            for (const postulado of vacante.postulados) {
                htmlTabla += '' +
                    '</tr>' +
                    '  <th scope="row">' + postulado.nombre + '</th>' +
                    '  <td>' + postulado.mail + '</td>' +
                    '  <td>' + postulado.telefono + '</td>' +
                    '  <td>' + postulado.edad + '</td>' +
                    '  <td>' + postulado.escolaridad + '</td>' +
                    '</tr>';
            }

            if (vacante.postulados.length) {
                htmlPostulados = '' +
                    '<div class="table-responsive">' +
                    '  <table class="table table-striped">' +
                    '    <thead>' +
                    '      <tr>' +
                    '        <th scope="col">Nombre</th>' +
                    '        <th scope="col">Email</th>' +
                    '        <th scope="col">Telefono</th>' +
                    '        <th scope="col">Edad</th>' +
                    '        <th scope="col">Escolaridad</th>' +
                    '      </tr>' +
                    '    </thead>' +
                    '    <tbody>' + htmlTabla + '</tbody>' +
                    '  </table>' +
                    '</div>';
            }



            cPostulantes.innerHTML += '' +
                '<div class="card border border-secondary shadow-0 mb-3">' +
                '  <div class="card-body">' +
                '    <h5 class="card-title">Vacante Id: ' + vacante.id + '</h5>' +
                '    <h6 class="card-subtitle mb-2 text-muted">Area: ' + vacante.nombreArea + ', Rol: ' + vacante.rol + ', Modalidad: ' + vacante.modalidad + ', Sueldo: $' + vacante.sueldo + '</h6>' +
                '    <h6 class="card-subtitle mt-3">Total de Postulantes: ' + vacante.postulados.length + '</h6>' +
                htmlPostulados +
                '  </div>' +
                '</div>';
        }
    })
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