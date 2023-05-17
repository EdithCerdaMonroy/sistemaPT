const fSignup = document.getElementById('fSignup');

// Se envian los datos para regsitrar una Empresa.
fSignup.addEventListener('submit', (event) => {
    event.preventDefault();

    // Elementos del formulario.
    const iEmail = document.getElementById('iEmail');
    const iPass = document.getElementById('iPass');
    const sTipoUsuario = document.getElementById('sTipoUsuario');

    // Si los datos del formulario son incorrectos se termina la funcion.
    if (!(iEmail.checkValidity() && iPass.checkValidity())) {
        return;
    }

    // Json a enviar al servidor.
    const data = {
        'mail': iEmail.value,
        'password': iPass.value,
        'tipoUsuario': sTipoUsuario.value
    };

    // Envio de datos.
    fetch(API.SIGNUP_CONTROLLER, {
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
                    title: 'Usuario regsitrado',
                    showClass: { popup: 'animate__animated animate__fadeInDown' },
                    hideClass: { popup: 'animate__animated animate__fadeOutUpBig' },
                    confirmButtonText: "OK"
                })
                .then(() => window.location.replace(WEB.LOGIN));
        })
        .catch(err => Swal.mixin({
                customClass: { confirmButton: "btn btn-primary btn-lg" },
                buttonsStyling: false
            })
            .fire({
                title: 'Email ya registrado',
                showClass: { popup: 'animate__animated animate__fadeInDown' },
                hideClass: { popup: 'animate__animated animate__fadeOutUpBig' },
                confirmButtonText: "OK"
            })
        );
});