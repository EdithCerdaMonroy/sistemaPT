const SISTEMA = {
    'URL_HOST': 'https://puntotalento.000webhostapp.com/',
    'URL_CONTROLLERS': '/sistemaPT/api/controllers',
    'URL_WEB': '/sistemaPT/web',
}

const API = {
    'LOGIN_CONTROLLER': SISTEMA.URL_HOST + SISTEMA.URL_CONTROLLERS + '/loginController.php',
    'LOGOUT_CONTROLLER': SISTEMA.URL_HOST + SISTEMA.URL_CONTROLLERS + '/logoutController.php',
    'SIGNUP_CONTROLLER': SISTEMA.URL_HOST + SISTEMA.URL_CONTROLLERS + '/signupController.php',

    'CREAR_EMPRESA_CONTROLLER': SISTEMA.URL_HOST + SISTEMA.URL_CONTROLLERS + '/crearEmpresaController.php',
    'VACANTE_EMPRESA_CONTROLLER': SISTEMA.URL_HOST + SISTEMA.URL_CONTROLLERS + '/vacanteEmpresaController.php',

    'CREAR_SOLICITANTE_CONTROLLER': SISTEMA.URL_HOST + SISTEMA.URL_CONTROLLERS + '/crearSolicitanteController.php',
    'VACANTE_SOLICITANTE_CONTROLLER': SISTEMA.URL_HOST + SISTEMA.URL_CONTROLLERS + '/vacanteSolicitanteController.php',
}

const WEB = {
    'LOGIN': SISTEMA.URL_HOST + SISTEMA.URL_WEB + '/login.php',

    'PERFIL_EMPRESA': SISTEMA.URL_HOST + SISTEMA.URL_WEB + '/perfilEmpresa.php',
    'VACANTES_EMPRESA': SISTEMA.URL_HOST + SISTEMA.URL_WEB + '/vacantesEmpresa.php',
    'POSTULADOS_EMPRESA': SISTEMA.URL_HOST + SISTEMA.URL_WEB + '/postuladosEmpresa.php',

    'PERFIL_SOLICITANTE': SISTEMA.URL_HOST + SISTEMA.URL_WEB + '/perfilSolicitante.php',
    'VACANTES_SOLICITANTE': SISTEMA.URL_HOST + SISTEMA.URL_WEB + '/vacantesSolicitante.php',
}