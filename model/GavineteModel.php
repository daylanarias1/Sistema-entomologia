<?php

class GavineteModel
{

    private $db;

    public function __construct()
    {
        require './libs/SPDO.php';
        $this->db = SPDO::getInstance();
    }

    public function listarGavinetes()
    {
        $consulta = $this->db->prepare('call sp_get_all_gabinetes');
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function listarCajas()
    {
        $consulta = $this->db->prepare('call sp_get_all_cajas');
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function listarGavetas($id_gavinete)
    {
        $consulta = $this->db->prepare('call sp_get_all_gavetas(?)');
        $consulta->bindParam(1, $id_gavinete);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function listarViales($id_caja)
    {
        $consulta = $this->db->prepare('CALL sp_get_all_viales(?)');
        $consulta->bindParam(1, $id_caja);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function registrarCaja($numeroCaja)
    {
        $consulta = $this->db->prepare("CALL sp_insertar_caja(?)");
        $consulta->bindParam(1, $numeroCaja);
        $consulta->execute();
        $resultado = $consulta->fetchColumn();

        return $resultado;
    }

    public function registrarVial($numeroVial, $numeroCaja)
    {
        $consulta = $this->db->prepare("CALL sp_insertar_vial(?, ?)");
        $consulta->bindParam(1, $numeroVial);
        $consulta->bindParam(2, $numeroCaja);
        $consulta->execute();
        $resultado = $consulta->fetchColumn();

        return $resultado;
    }

    public function registrarGavinete($numeroGavinete)
    {
        $consulta = $this->db->prepare("CALL sp_insertar_gabinete(?)");
        $consulta->execute([$numeroGavinete]);

        $resultado = $consulta->fetchColumn();

        return $resultado;
    }

    public function registrarGaveta($numeroGaveta, $idGavetin)
    {
        $consulta = $this->db->prepare("CALL sp_insertar_gaveta(?, ?)");
        $consulta->bindParam(1, $numeroGaveta);
        $consulta->bindParam(2, $idGavetin);
        $consulta->execute();
        $resultado = $consulta->fetchAll();

        return $resultado;
    }

    public function actualizarGabinete($numeroGabinete, $idGabinete)
    {
        $consulta = $this->db->prepare("CALL actualizar_numero_gabinete(?, ?)");
        $consulta->bindParam(1, $idGabinete);
        $consulta->bindParam(2, $numeroGabinete);
        $consulta->execute();
        $resultado = $consulta->fetchAll();

        return $resultado;
    }

    public function actualizarGaveta($numeroGaveta, $idGaveta)
    {
        $consulta = $this->db->prepare("CALL actualizar_numero_gaveta(?, ?)");
        $consulta->bindParam(1, $idGaveta);
        $consulta->bindParam(2, $numeroGaveta);
        $consulta->execute();
        $resultado = $consulta->fetchAll();

        return $resultado;
    }

    public function actualizarCaja($numeroCaja, $idCaja)
    {
        $consulta = $this->db->prepare("CALL actualizar_numero_caja(?, ?)");
        $consulta->bindParam(1, $idCaja);
        $consulta->bindParam(2, $numeroCaja);
        $consulta->execute();
        $resultado = $consulta->fetchAll();

        return $resultado;
    }

    public function actualizarVial($numeroVial, $idVial)
    {
        $consulta = $this->db->prepare("CALL actualizar_numero_vial(?, ?)");
        $consulta->bindParam(1, $idVial);
        $consulta->bindParam(2, $numeroVial);
        $consulta->execute();
        $resultado = $consulta->fetchAll();

        return $resultado;
    }

}
