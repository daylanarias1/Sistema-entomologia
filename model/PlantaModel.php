<?php

class PlantaModel
{
    
    private $db;

    public function __construct()
    {
        require './libs/SPDO.php';
        $this->db = SPDO::getInstance();
    }
    
    public function listarAllPlantas()
    {
        $consulta = $this->db->prepare("CALL sp_plantas");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function insertarPlantas($planta)
    {
        $consulta = $this->db->prepare("CALL sp_registrar_planta(?)");
        $consulta->bindParam(1, $planta);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function asociarPlantaGenero($planta, $genero)
    {
        $consulta = $this->db->prepare("CALL sp_asociar_genero_planta(?, ?)");
        $consulta->bindParam(1, $genero);
        $consulta->bindParam(2, $planta);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function eliminarPlantaGenero($planta, $genero)
    {
        $consulta = $this->db->prepare("CALL eliminar_planta_genero(?, ?)");
        $consulta->bindParam(1, $planta);
        $consulta->bindParam(2, $genero);
        $consulta->execute();

        $resultado = $consulta->fetchAll();

        return $resultado;
    }

    public function actualizarPlanta($planta, $nuevoNombre)
    {
        $consulta = $this->db->prepare("CALL actualizar_planta(?, ?)");
        $consulta->bindParam(1, $planta);
        $consulta->bindParam(2, $nuevoNombre);
        $consulta->execute();

        $resultado = $consulta->fetchAll();

        return $resultado;
    }

    public function buscarPlanta($planta, $numero, $usuario)
    {
        $consulta = $this->db->prepare("CALL sp_planta_page(?, ?, ?)");
        $consulta->bindParam(1, $numero);
        $consulta->bindParam(2, $planta);
        $consulta->bindParam(3, $usuario);
        $consulta->execute();
        return $consulta->fetchAll();
    }
}