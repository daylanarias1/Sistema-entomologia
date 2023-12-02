<?php

class EspecimenModel
{
    private $db;

    public function __construct()
    {
        require './libs/SPDO.php';
        $this->db = SPDO::getInstance();
    }

    public function obtenerDetallesEspecimen($id)
    {
        $consulta = $this->db->prepare("CALL obtenerDetallesEspecimen(?)");
        $consulta->bindParam(1, $id);
        $consulta->execute();
        $resultado = $consulta->fetchAll();

        return $resultado;
    }

    public function buscarEspecimenesEspecie($especie, $numero)
    {
        $consulta = $this->db->prepare("CALL ListarEspecimenesPorEspecie(?, ?)");
        $consulta->bindParam(1, $especie);
        $consulta->bindParam(2, $numero);
        $consulta->execute();
        return $consulta->fetchAll();
    }


    public function buscarEspecimenesGenero($genero, $numero)
    {
        $consulta = $this->db->prepare("CALL ListarEspecimenesPorGenero(?, ?)");
        $consulta->bindParam(1, $genero);
        $consulta->bindParam(2, $numero);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function especimenesHistorial($usuario, $fecha)
    {
        $consulta = $this->db->prepare("CALL sp_ubicaciones_historial(?, ?)");
        $consulta->bindParam(1, $usuario);
        $consulta->bindParam(2, $fecha);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function especimenEspecie($especieId)
    {
        $consulta = $this->db->prepare("CALL sp_especimen_especie(?)");
        $consulta->bindParam(1, $especieId);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function especimenGenero($generoId)
    {
        $consulta = $this->db->prepare("CALL sp_especimen_genero(?)");
        $consulta->bindParam(1, $generoId);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function buscarEspecimenEspecie($especie, $numero)
    {
        $consulta = $this->db->prepare("CALL sp_obtener_especimenes_especie(?, ?)");
        $consulta->bindParam(1, $especie);
        $consulta->bindParam(2, $numero);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function getEspecimen($especimen)
    {
        $consulta = $this->db->prepare("CALL sp_get_especimen(?)");
        $consulta->bindParam(1, $especimen);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function listarRecolector()
    {
        $consulta = $this->db->prepare("CALL sp_obtener_recolectores");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function insertarEspecimenGaveta($especie, $recolector, $genero, $distrito, $latitud, $longitud, $fecha, $imagenes, $gaveta)
    {
        $rutasImagenesJSON = json_encode($imagenes);

        $consulta = $this->db->prepare("CALL sp_insertar_especimen_en_gaveta(?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $consulta->bindParam(1, $especie);
        $consulta->bindParam(2, $recolector);
        $consulta->bindParam(3, $genero);
        $consulta->bindParam(4, $distrito);
        $consulta->bindParam(5, $latitud);
        $consulta->bindParam(6, $longitud);
        $consulta->bindParam(7, $fecha);
        $consulta->bindParam(8, $rutasImagenesJSON);
        $consulta->bindParam(9, $gaveta);
        $consulta->execute();

        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function insertarEspecimenVial($especie, $recolector, $genero, $distrito, $latitud, $longitud, $fecha, $imagenes, $vial)
    {
        $rutasImagenesJSON = json_encode($imagenes);

        $consulta = $this->db->prepare("CALL sp_insertar_especimen_en_vial(?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $consulta->bindParam(1, $especie);
        $consulta->bindParam(2, $recolector);
        $consulta->bindParam(3, $genero);
        $consulta->bindParam(4, $distrito);
        $consulta->bindParam(5, $latitud);
        $consulta->bindParam(6, $longitud);
        $consulta->bindParam(7, $fecha);
        $consulta->bindParam(8, $rutasImagenesJSON);
        $consulta->bindParam(9, $vial);
        $consulta->execute();

        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function eliminarEspecimen($especimenNombre)
    {
        $consulta = $this->db->prepare("CALL eliminar_especimen(?)");
        $consulta->bindParam(1, $especimenNombre);
        $consulta->execute();

        $resultado = $consulta->fetchAll();

        return $resultado;
    }

    public function actualizarGavetaEspecimen($especimenId, $gaveta)
    {
        $consulta = $this->db->prepare("CALL sp_actualizar_ubicacion_gaveta(?, ?)");
        $consulta->bindParam(1, $especimenId);
        $consulta->bindParam(2, $gaveta);
        $consulta->execute();

        $resultado = $consulta->fetchAll();

        return $resultado;
    }

    public function actualizarVialEspecimen($especimenId, $vial)
    {
        $consulta = $this->db->prepare("CALL sp_actualizar_ubicacion_vial(?, ?)");
        $consulta->bindParam(1, $especimenId);
        $consulta->bindParam(2, $vial);
        $consulta->execute();

        $resultado = $consulta->fetchAll();

        return $resultado;
    }

    public function actualizarRecoleccionEspecimen($especimenId, $distrito)
    {
        $consulta = $this->db->prepare("CALL sp_actualizar_distrito_recoleccion(?, ?)");
        $consulta->bindParam(1, $distrito);
        $consulta->bindParam(2, $especimenId);
        $consulta->execute();

        $resultado = $consulta->fetchAll();

        return $resultado;
    }

    public function actualizarTaxonomiaEspecimen($especimen, $genero, $especie)
    {
        $consulta = $this->db->prepare("CALL sp_actualizar_genero_especie(?, ?, ?)");
        $consulta->bindParam(1, $especimen);
        $consulta->bindParam(2, $genero);
        $consulta->bindParam(3, $especie);
        $consulta->execute();

        $resultado = $consulta->fetchAll();

        return $resultado;
    }
}
