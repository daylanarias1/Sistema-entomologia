<?php

class SAModel
{

    private $db;

    public function __construct()
    {
        require './libs/SPDO.php';
        $this->db = SPDO::getInstance();
    }

    public function cambioContrasenaSA($usuario, $contrasena)
    {
        $hashedPassword = hash('sha256', $contrasena);
        $consulta = $this->db->prepare("CALL sp_cambiar_contrasena_sa(?, ?)");
        $consulta->bindParam(1, $usuario);
        $consulta->bindParam(2, $hashedPassword);
        $consulta->execute();

        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    public function inicioSesionSA($username, $password)
    {
        $consulta = $this->db->prepare("CALL sp_inicio_sesion_sa(?, ?)");
        $hashedPassword = hash('sha256', $password);
        $consulta->bindParam(1, $username);
        $consulta->bindParam(2, $hashedPassword);
        $consulta->execute();

        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }
}
