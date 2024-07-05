<?php
require_once('controladores/controller_login.php');

// Iniciar la sesión si aún no se ha iniciado
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $controller = new UsuarioController();
    $error = $controller->loginUser($username, $password);

    if ($error) {
        // Almacenar el mensaje de error en la sesión
        $_SESSION['login_error'] = $error;

        // Redireccionar a la página de inicio de sesión
        header("Location: index.php?page=Login");
        exit();
    } else {
        // Redireccionar al index si el inicio de sesión fue exitoso
        header("Location: index.php?page=");
        exit();
    }
}
