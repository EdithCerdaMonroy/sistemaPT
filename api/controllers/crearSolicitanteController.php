<?php
require_once(dirname(dirname(__FILE__)) . '/database/database.php');

// Validacion de Usuario Solicitante logueado.
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['tipoUsuario'] != 'Solicitante') {
    header('HTTP/1.1 401 Unauthorized');
    return;
}

/**
 * Si se quiere completar el perfil del Solicitante en el sistema. 
 * Peticion por JSON: { 'nombre': , 'telefono': ,'edad': , 'escolaridad': }
 * Respuesta: {'actualizado': }
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'), true);

    // Si no contiene { 'nombre': , 'telefono': ,'edad': , 'escolaridad'  }
    if (!(isset($json['nombre']) && isset($json['telefono']) && isset($json['edad']) && isset($json['escolaridad']))) {
        header('HTTP/1.1 400 Bad Request');
        return;
    }

    // Se actualiza el Usuario en la base de datos con la Empresa registrada anteriormente.    
    $stmt = $conn->prepare('UPDATE Usuario SET nombre  = :nombre, telefono = :telefono, edad = :edad, escolaridad = :escolaridad 
                            WHERE id = :idUsuario');
    $res = $stmt->execute([
        'nombre' => $json['nombre'],
        'telefono' => $json['telefono'],
        'edad' => $json['edad'],
        'escolaridad' => $json['escolaridad'],
        'idUsuario' => $_SESSION['user']['id']
    ]);


    // Si no se registro el Usuario en la base de datos, no se regresa nada.
    if (!$res) {
        return;
    }

    // Si se actualizo el Usuario en la base de datos se regresa true.
    $response = array('actualizado' => $res);
    echo json_encode($response);
}
