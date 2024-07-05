<?php
require_once("recursos/config/db.php");

class UsuarioModel
{
    private $conexion;

    public function __construct()
    {
        $con = new Conectar();
        $this->conexion = $con->conexionBD();
    }

    public function login($username, $password)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM Usuarios WHERE Nombre = ? AND Contra = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
}
