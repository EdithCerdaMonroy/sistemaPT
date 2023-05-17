<?php
require_once(dirname(dirname(__FILE__)) . '/database/database.php');

/**
 * Si se quiere registrar un Usuario en el sistema. 
 * Peticion por JSON: { 'mail': , 'password': , 'tipoUsuario': }
 * Respuesta: {'id': }
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'), true);

    // Si no contiene correo ni contrasenia se manda error.
    if (!(isset($json['mail']) && isset($json['password']) && isset($json['tipoUsuario']))) {
        header('HTTP/1.1 400 Bad Request');
        return;
    }

    // Si contiene correo y contrasenia registra al usuario en la base de datos.
    $stmt = $conn->prepare('INSERT INTO Usuario (idTipoUsuario, mail, password) VALUES 
                        ((SELECT id FROM TipoUsuario WHERE nombre = :tipoUsuario), :mail, :password)');
    $res = $stmt->execute([
        'tipoUsuario' => $json['tipoUsuario'],
        'mail' => $json['mail'],
        'password' => $json['password']
    ]);

    // Si no se registro el Usuario en la base de datos, no se regresa nada.
    if (!$res) {
        return;
    }

    // Si se registro el Usuario en la base de datos se regresa el id.
    $response = array('id' => $conn->lastInsertId());
    echo json_encode($response);
}
