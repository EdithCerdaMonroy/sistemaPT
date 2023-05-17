const fLogin = document.getElementById('fLogin');

// Se envian los datos para que se loguee un Usuario.
fLogin.addEventListener('submit', (event) => {
    event.preventDefault();

    // Elementos del formulario.
    const iEmail = document.getElementById('iEmail');
    const iPass = document.getElementById('iPass');

    // Si los datos del formulario son incorrectos se termina la funcion.
    if (!(iEmail.checkValidity() && iPass.checkValidity())) {
        return;
    }

    // Json a enviar al servidor.
    const data = {
        'mail': iEmail.value,
        'password': iPass.value
    };

    // Envio de datos.
    fetch(API.LOGIN_CONTROLLER, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        })
        // Respuesta del servidor.
        .then(res => {
            // Si no se encontro el Usuario en el sistema, se muestra error.
            if (res.status === 404) {
                Swal.mixin({
                        customClass: { confirmButton: "btn btn-primary btn-lg" },
                        buttonsStyling: false
                    })
                    .fire({
                        title: 'Usuario no encontrado',
                        text: 'Verifique sus datos por favor',
                        showClass: { popup: 'animate__animated animate__fadeInDown' },
                        hideClass: { popup: 'animate__animated animate__fadeOutUpBig' },
                        confirmButtonText: "OK"
                    });
                throw new Error('Usuario no encontrado');
            }

            // Si el Usuario se encuentra en el sistema.
            return res.json();
        })
        // Se cambia de pagina segun el tipo de Usuario.
        .then(json => {
            if (json.tipoUsuario === 'Empresa') {
                window.location.replace(WEB.PERFIL_EMPRESA);

            } else if (json.tipoUsuario === 'Solicitante') {
                window.location.replace(WEB.PERFIL_SOLICITANTE);
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
});