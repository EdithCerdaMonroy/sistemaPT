<?php

// Si se quiere cerrar sesion del Usuario logueado en el sistema.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    session_destroy();
}