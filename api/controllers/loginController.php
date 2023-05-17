<?php
require_once(dirname(dirname(__FILE__)) . '/database/database.php');

/**
 * Si se quiere loguear un Usuario en el sistema. 
 * Peticion por JSON: { 'mail': , 'password': }
 * Respuesta: {'mail': , 'tipoUsuario': }
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'), true);

    // Si no contiene correo ni contrasenia se manda error.
    if (!(isset($json['mail']) && isset($json['password']))) {
        header('HTTP/1.1 400 Bad Request');
        return;
    }

    // Si contiene correo y contrasenia se busca al usuario en la base de datos.
    $stmt = $conn->prepare('SELECT Usuario.id, Usuario.mail, Usuario.idEmpresa, TipoUsuario.nombre as tipoUsuario FROM Usuario
                            JOIN TipoUsuario ON TipoUsuario.id = Usuario.idTipoUsuario 
                            WHERE mail = :mail AND password = :password');
    $stmt->execute([
        'mail' => $json['mail'],
        'password' => $json['password'],
    ]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si no se encontro el usuario en la base de datos se manda error.
    if (!$user) {
        header('HTTP/1.1 404 Not Found');
        return;
    }

    // Si se encontro el usuario en la base de datos se almacena en la sesion y se regresan sus datos.
    session_start();
    $_SESSION['user'] = $user;
    echo json_encode($user);
}
