const fVacante = document.getElementById('fVacante');
const sRol = document.getElementById('sRol');
const sModalidad = document.getElementById('sModalidad');
activarBotonMenu('aVacantesEmpresa');

// Se pide al servidor los datos necesarios para registrar una Vacante.
fetch(API.VACANTE_EMPRESA_CONTROLLER + '?rolesYmodalidades', { method: 'GET' })
    // Respuesta del servidor.
    .then(res => res.json())
    // Se muestran los Roles y Modalidades en la pagina.
    .then(rolesYmodalidades => {
        // Se muestran los Roles.        
        sRol.innerHTML = '';
        for (const area in rolesYmodalidades.roles) {
            sRol.innerHTML += '<optgroup label="' + area + '">';
            for (const rol of rolesYmodalidades.roles[area]) {
                sRol.innerHTML += '<option value="' + rol.id + '">' + rol.nombre + '</option>';
            }
            sRol.innerHTML += '</optgroup>';
        }
        // Se muestran las Modalidades.        
        sModalidad.innerHTML = '';
        for (const modalidad of rolesYmodalidades.modalidades) {
            sModalidad.innerHTML += '<option value="' + modalidad.id + '">' + modalidad.nombre + '</option>';
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



// Se envian los datos para regsitrar una Vacante.
fVacante.addEventListener('submit', (event) => {
    event.preventDefault();

    // Elementos del formulario.
    const iDescripcion = document.getElementById('iDescripcion');
    const iSueldo = document.getElementById('iSueldo');

    // Si los datos del formulario son incorrectos se termina la funcion.
    if (!(iDescripcion.checkValidity() && iSueldo.checkValidity())) {
        return;
    }

    // Json a enviar al servidor.
    const data = {
        "idRol": sRol.value,
        "idModalidad": sModalidad.value,
        "descripcion": iDescripcion.value,
        "sueldo": iSueldo.value
    };

    // Envio de datos.
    fetch(API.VACANTE_EMPRESA_CONTROLLER, {
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
                    title: 'Vacante regsitrada',
                    showClass: { popup: 'animate__animated animate__fadeInDown' },
                    hideClass: { popup: 'animate__animated animate__fadeOutUpBig' },
                    confirmButtonText: "OK"
                })
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
});