<?php
require_once(dirname(dirname(__FILE__)) . '/database/database.php');

// Validacion de Usuario Solicitante logueado.
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['tipoUsuario'] != 'Solicitante') {
    header('HTTP/1.1 401 Unauthorized');
    return;
}

/**
 * Si se quiere obtener las vacantes registradas en el sistema. 
 * Respuesta: [ { 'id': ,'nombreEmpresa': ,'giroEmpresa': ,'nombreArea': ,'rol': ,'modalidad': ,'descripcion': ,'sueldo': }, ... ]
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['all'])) {
    $stmt = $conn->prepare('SELECT Vacante.id, Empresa.nombre as nombreEmpresa, Empresa.giro as giroEmpresa, Area.nombre as nombreArea, Rol.nombre as rol, Modalidad.nombre as modalidad, Vacante.descripcion, Vacante.sueldo FROM Vacante 
                            JOIN Empresa ON Empresa.id = Vacante.idEmpresa 
                            JOIN Rol ON Rol.id = Vacante.idRol 
                            JOIN Area ON Area.id = Rol.idArea 
                            JOIN Modalidad ON Modalidad.id = Vacante.idModalidad');
    $res = $stmt->execute();
    $vacantes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($vacantes);
}

/**
 * Si se quiere obtener las vacantes postuladas por el Usaurio logueado. 
 * Respuesta: [ { 'id': ,'nombreEmpresa': ,'giroEmpresa': ,'nombreArea': ,'rol': ,'modalidad': ,'descripcion': ,'sueldo': }, ... ]
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['postuladas'])) {
    $stmt = $conn->prepare('SELECT Vacante.id, Empresa.nombre as nombreEmpresa, Empresa.giro as giroEmpresa, Area.nombre as nombreArea, Rol.nombre as rol, Modalidad.nombre as modalidad, Vacante.descripcion, Vacante.sueldo FROM UsuarioVacante
                            JOIN Vacante ON Vacante.id = UsuarioVacante.idVacante
                            JOIN Empresa ON Empresa.id = Vacante.idEmpresa 
                            JOIN Rol ON Rol.id = Vacante.idRol 
                            JOIN Area ON Area.id = Rol.idArea 
                            JOIN Modalidad ON Modalidad.id = Vacante.idModalidad
                            WHERE UsuarioVacante.idUsuario = :idUsuario');
    $res = $stmt->execute([
        'idUsuario' => $_SESSION['user']['id']
    ]);
    $postulaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($postulaciones);
}

/**
 * Si un Usuario logueado se quiere postular a una vacante .
 * Peticion por JSON: { 'idVacante': }
 * Respuesta: {'id': }
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'), true);

    // Si no contiene idVacante se manda error.
    if (!(isset($json['idVacante']))) {
        header('HTTP/1.1 400 Bad Request');
        return;
    }

    // Si contiene idVacante se registra en la base de datos que el Usuario se postulo en la Vacante.
    $stmt = $conn->prepare('INSERT INTO UsuarioVacante (idUsuario, idVacante) VALUES (:idUsuario, :idVacante)');
    $res = $stmt->execute([
        'idUsuario' => $_SESSION['user']['id'],
        'idVacante' => $json['idVacante']
    ]);

    // Si no se registro en la base de datos, se termina y no se regresa nada.
    if (!$res) {
        return;
    }

    // Si se registro correctamente en la base de datos se regresa el id.
    $response = array('id' => $conn->lastInsertId());
    echo json_encode($response);
}