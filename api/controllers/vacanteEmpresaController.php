<?php
require_once(dirname(dirname(__FILE__)) . '/database/database.php');

// Validacion de Usuario Solicitante logueado.
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['tipoUsuario'] != 'Empresa') {
    header('HTTP/1.1 401 Unauthorized');
    return;
}

/**
 * Si se quiere obtener los Roles y Modalidades registradas en el sistema.
 * Respuesta: { 'roles': { '<area>': { 'id': ,'area':, 'nombre': }, ... }, 
 *              'modalidades': [ {'id': ,'nombre': }, ... ]}
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['rolesYmodalidades'])) {
    // Se obtienen los Roles que estan registrados en la base de datos.
    $stmt = $conn->prepare('SELECT Rol.id, Area.nombre as area, Rol.nombre FROM Rol
                            JOIN Area ON Area.id = Rol.idArea');
    $res = $stmt->execute();
    $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Se agrupan los Roles por su Area.
    $rolesXarea = array();
    foreach ($roles as $val) {
        $rolesXarea[$val['area']][] = $val;
    }

    // Se obtienen las Modalides que estan registradas en la base de datos.
    $stmt = $conn->prepare('SELECT id, nombre FROM Modalidad');
    $res = $stmt->execute();
    $modalidades = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $rolesYmodalidaes = array('roles' => $rolesXarea, 'modalidades' => $modalidades);
    echo json_encode($rolesYmodalidaes);
}

/**
 * Si se quiere obtener a los postulantes de cada Vacante registrados en el sistema.
 * Respuesta: [ { 'id': ,'nombreArea': ,'rol': ,'modalidad': ,'descripcion': ,'sueldo': ,
 *                'postulados': [ {'id': ,'idUsuario': ,'mail': ,'nombre': ,'telefono': ,'edad': ,'escolaridad': }, ... ]}, ... ]
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['postulados'])) {
    // Se obtienen las Vacantes
    $stmt = $conn->prepare('SELECT Vacante.id, Area.nombre as nombreArea, Rol.nombre as rol, Modalidad.nombre as modalidad, Vacante.descripcion, Vacante.sueldo FROM Vacante                             
                            JOIN Rol ON Rol.id = Vacante.idRol 
                            JOIN Area ON Area.id = Rol.idArea 
                            JOIN Modalidad ON Modalidad.id = Vacante.idModalidad
                            WHERE Vacante.idEmpresa = :idEmpresa');
    $res = $stmt->execute([
        'idEmpresa' => $_SESSION['user']['idEmpresa']
    ]);
    $vacantes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Se obtienen los postulantes de cada Vacante.
    foreach ($vacantes as $key => $vacante) {
        $stmt = $conn->prepare('SELECT UsuarioVacante.id, UsuarioVacante.idUsuario, Usuario.mail, Usuario.nombre, Usuario.telefono, Usuario.edad, Usuario.escolaridad FROM UsuarioVacante
                                JOIN Usuario ON Usuario.id = UsuarioVacante.idUsuario
                                WHERE UsuarioVacante.idVacante = :idVacante');
        $res = $stmt->execute([
            'idVacante' => $vacante['id']
        ]);
        $vacantes[$key]['postulados'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    echo json_encode($vacantes);
}

/**
 * Si se quiere registrar una Vacante en el sistema.
 * Peticion por JSON: { 'idRol': ,'idModalidad': ,'descripcion': ,'sueldo': }
 * Respuesta: {'id': }
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'), true);

    // Si no contiene los datos necesarios se manda error.
    if (!(isset($json['idRol']) && isset($json['idModalidad']) && isset($json['descripcion']) && isset($json['sueldo']))) {
        header('HTTP/1.1 400 Bad Request');
        return;
    }

    // Si contiene los datos necesarios se registra en la base de datos la Vacante.
    $stmt = $conn->prepare('INSERT INTO Vacante (idEmpresa, idRol, idModalidad, descripcion, sueldo) VALUES (:idEmpresa, :idRol, :idModalidad, :descripcion, :sueldo)');
    $res = $stmt->execute([
        'idEmpresa' => $_SESSION['user']['idEmpresa'],
        'idRol' => $json['idRol'],
        'idModalidad' => $json['idModalidad'],
        'descripcion' => $json['descripcion'],
        'sueldo' => $json['sueldo']
    ]);

    // Si no se registro en la base de datos, se termina y no se regresa nada.
    if (!$res) {
        return;
    }

    // Si se registro correctamente en la base de datos se regresa el id.
    $response = array('id' => $conn->lastInsertId());
    echo json_encode($response);
}
