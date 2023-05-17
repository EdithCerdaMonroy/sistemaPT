const cPostulaciones = document.getElementById('cPostulaciones');
const cVacantes = document.getElementById('cVacantes');
activarBotonMenu('aVacantesSolicitante');

// Ids de las Vacantes del Usuario en las que se postulo.
const idsPostulaciones = [];

// Se pide al servidor las Vacantes del Usuario en las que se postulo.
fetch(API.VACANTE_SOLICITANTE_CONTROLLER + '?postuladas', { method: 'GET' })
    // Respuesta del servidor.
    .then(res => res.json())
    // Se muestran las Vacantes del Usuario en las que se postulo.
    .then(postulaciones => {
        // Si el Usuario no tiene postulaciones.
        if (!postulaciones.length) {
            cPostulaciones.innerHTML = '<div class="note note-danger">No tienes nunguna postulación</div>';
            return;
        }

        // Si el Usuario tiene postulaciones se muestran en la pantalla.
        const tbPostulaciones = document.getElementById('tbPostulaciones');
        for (const postulacion of postulaciones) {
            idsPostulaciones.push(postulacion.id);
            tbPostulaciones.innerHTML += '' +
                '<th scope="row">' + postulacion.id + '</th>' +
                '<td>' + postulacion.nombreEmpresa + '</td>' +
                '<td>' + postulacion.nombreArea + '</td>' +
                '<td>' + postulacion.rol + '</td>' +
                '<td>' + postulacion.modalidad + '</td>' +
                '<td>' + postulacion.descripcion + '</td>' +
                '<td>$' + postulacion.sueldo + '</td>';
        }
    })
    // Se pide al servidor las Vacantes del Usuario en las que se postulo.
    .then(() => fetch(API.VACANTE_SOLICITANTE_CONTROLLER + '?all', { method: 'GET' }))
    // Respuesta del servidor.
    .then(res => res.json())
    // Se muestran las Vacantes del Usuario en las que se postulo.
    .then(vacantes => {
        // Si no hay vacantes registradas.
        if (!vacantes.length) {
            cVacantes.innerHTML = '<div class="note note-danger">No no hay vacantes registradas</div>';
            return;
        }

        // Si hay vacantes registradas se muestran en la pantalla.
        const tbVacantes = document.getElementById('tbVacantes');
        for (const vacante of vacantes) {
            // Si el Usuario ya se postulo en la vacante no se muestra.
            if (idsPostulaciones.includes(vacante.id)) {
                continue;
            }

            tbVacantes.innerHTML += '' +
                '<th scope="row">' + vacante.id + '</th>' +
                '<td>' + vacante.nombreEmpresa + '</td>' +
                '<td>' + vacante.nombreArea + '</td>' +
                '<td>' + vacante.rol + '</td>' +
                '<td>' + vacante.modalidad + '</td>' +
                '<td>' + vacante.descripcion + '</td>' +
                '<td>$' + vacante.sueldo + '</td>' +
                '<td><button type="button" onclick="postularse(' + vacante.id + ')" class="btn btn-primary btn-block">Postularse</button></td>';
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

// Registra en el sistema que el Usuario logeado se quiere postular a una Vacante.
function postularse(idVacante) {
    // Json a enviar al servidor.
    const data = { 'idVacante': idVacante };

    // Envio de datos.
    fetch(API.VACANTE_SOLICITANTE_CONTROLLER, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        })
        // Respuesta del servidor.
        .then(res => res.json())
        .then(json => {
            Swal.mixin({
                    customClass: { confirmButton: "btn btn-primary btn-lg" },
                    buttonsStyling: false
                })
                .fire({
                    title: 'Se postuló correctamente',
                    showClass: { popup: 'animate__animated animate__fadeInDown' },
                    hideClass: { popup: 'animate__animated animate__fadeOutUpBig' },
                    confirmButtonText: "OK"
                })
                .then(() => window.location.replace(WEB.VACANTES_SOLICITANTE));
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
}