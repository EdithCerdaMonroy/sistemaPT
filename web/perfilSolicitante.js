const fPerfil = document.getElementById('fPerfil');
activarBotonMenu('aPerfilSolicitante');

// Se envian los datos para regsitrar una Empresa.
fPerfil.addEventListener('submit', (event) => {
    event.preventDefault();

    // Elementos del formulario.
    const iNombre = document.getElementById('iNombre');
    const iTelefono = document.getElementById('iTelefono');
    const iEdad = document.getElementById('iEdad');
    const iEscolaridad = document.getElementById('iEscolaridad');

    // Si los datos del formulario son incorrectos se termina la funcion.
    if (!(iNombre.checkValidity() && iTelefono.checkValidity() && iEdad.checkValidity() && iEscolaridad.checkValidity())) {
        return;
    }

    // Json a enviar al servidor.
    const data = {
        'nombre': iNombre.value,
        'telefono': iTelefono.value,
        'edad': iEdad.value,
        'escolaridad': iEscolaridad.value
    };

    // Envio de datos.
    fetch(API.CREAR_SOLICITANTE_CONTROLLER, {
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
                    title: 'Perfil Actualizado',
                    showClass: { popup: 'animate__animated animate__fadeInDown' },
                    hideClass: { popup: 'animate__animated animate__fadeOutUpBig' },
                    confirmButtonText: "OK"
                });
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