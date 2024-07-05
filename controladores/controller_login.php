<?php
require_once("modelos/model_login.php");

class UsuarioController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UsuarioModel();
    }

    public function loginUser($username, $password)
    {
        $user = $this->userModel->login($username, $password);
        if ($user) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['username'];
            // Puedes agregar más datos a la sesión si lo necesitas
            return null; // Retorna null si el inicio de sesión fue exitoso
        } else {
            // Devolver un error de inicio de sesión
            return "Usuario o contraseña incorrectos";
        }
    }
}
