<?php

class UbicacionModel
{

    private $db;

    public function __construct()
    {
        require './libs/SPDO.php';
        $this->db = SPDO::getInstance();
    }


    public function registroPais($pais)
    {
        $consulta = $this->db->prepare('call sp_registrar_pais(?)');
        $consulta->bindParam(1, $pais);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function registroProvincia($provincia, $pais)
    {
        $consulta = $this->db->prepare('call sp_registrar_provincia(?,?)');
        $consulta->bindParam(1, $provincia);
        $consulta->bindParam(2, $pais);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function registroCanton($canton, $provincia)
    {
        $consulta = $this->db->prepare('call sp_registrar_canton(?,?)');
        $consulta->bindParam(1, $canton);
        $consulta->bindParam(2, $provincia);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function registroDistrito($distrito, $canton)
    {
        $consulta = $this->db->prepare('call sp_registrar_distrito(?,?)');
        $consulta->bindParam(1, $distrito);
        $consulta->bindParam(2, $canton);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function listarPais()
    {
        $consulta = $this->db->prepare("CALL sp_listar_pais");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function listarProvinciaPorPais($pais)
    {
        $consulta = $this->db->prepare("CALL sp_provincia_por_pais(?)");
        $consulta->bindParam(1, $pais);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function listarCantonPorProvincia($provincia)
    {
        $consulta = $this->db->prepare("CALL sp_canton_por_provincia(?)");
        $consulta->bindParam(1, $provincia);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function listarDistritoPorCanton($canton)
    {
        $consulta = $this->db->prepare("CALL sp_distrito_por_canton(?)");
        $consulta->bindParam(1, $canton);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

}