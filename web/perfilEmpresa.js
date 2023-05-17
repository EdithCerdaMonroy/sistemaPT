const fEmpresa = document.getElementById('fEmpresa');
activarBotonMenu('aPerfilEmpresa');

// Se envian los datos para regsitrar una Empresa.
fEmpresa.addEventListener('submit', (event) => {
    event.preventDefault();

    // Elementos del formulario.
    const iNombre = document.getElementById('iNombre');
    const iDescripcion = document.getElementById('iDescripcion');

    // Si los datos del formulario son incorrectos se termina la funcion.
    if (!(iNombre.checkValidity() && iDescripcion.checkValidity())) {
        return;
    }

    // Json a enviar al servidor.
    const data = {
        'nombre': iNombre.value,
        'giro': iDescripcion.value
    };

    // Envio de datos.
    fetch(API.CREAR_EMPRESA_CONTROLLER, {
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