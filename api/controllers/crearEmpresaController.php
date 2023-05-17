<?php
require_once(dirname(dirname(__FILE__)) . '/database/database.php');

// Validacion de Usuario Empresa logueado.
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['tipoUsuario'] != 'Empresa') {
    header('HTTP/1.1 401 Unauthorized');
    return;
}

/**
 * Si se quiere registra una Empresa en el sistema. 
 * Peticion por JSON: { 'nombre': , 'giro': }
 * Respuesta: {'idEmpresa': }
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'), true);

    // Si no contiene nombre ni giro se manda error.
    if (!(isset($json['nombre']) && isset($json['giro']))) {
        header('HTTP/1.1 400 Bad Request');
        return;
    }

    // Si contiene nombre y descripcion se registra la Empresa en la base de datos.
    $stmt = $conn->prepare('INSERT INTO Empresa (nombre, giro) VALUES (:nombre, :giro)');
    $res = $stmt->execute([
        'nombre' => $json['nombre'],
        'giro' => $json['giro']
    ]);

    // Si no se registro la Empresa en la base de datos, se termina y no se regresa nada.
    if (!$res) {
        return;
    }

    // Se actualiza el Usuario en la base de datos con la Empresa registrada anteriormente.
    $idEmpresa = $conn->lastInsertId();
    $stmt = $conn->prepare('UPDATE Usuario SET idEmpresa = :idEmpresa WHERE id = :idUsuario');
    $res = $stmt->execute([
        'idEmpresa' => $idEmpresa,
        'idUsuario' => $_SESSION['user']['id']
    ]);

    // Si no se registro el Usuario en la base de datos, no se regresa nada.
    if (!$res) {
        return;
    }

    // Si se registro el Usuario en la base de datos se regresa el id.
    $_SESSION['user']['idEmpresa'] = $idEmpresa;
    $response = array('idEmpresa' => $idEmpresa);    
    echo json_encode($response);
}
