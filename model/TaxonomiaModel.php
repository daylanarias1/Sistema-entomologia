<?php

class TaxonomiaModel
{

    private $db;

    public function __construct()
    {
        require './libs/SPDO.php';
        $this->db = SPDO::getInstance();
    }

    public function registroOrden($nombre, $id_usuario)
    {
        $consulta = $this->db->prepare('call sp_insertar_orden(?, ?)');
        $consulta->bindParam(1, $nombre);
        $consulta->bindParam(2, $id_usuario);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function registroFamilia($nombre, $id_orden, $id_usuario)
    {
        $consulta = $this->db->prepare('call sp_insertar_familia(?, ?, ?)');
        $consulta->bindParam(1, $nombre);
        $consulta->bindParam(2, $id_orden);
        $consulta->bindParam(3, $id_usuario);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function registroSubFamilia($nombre, $id_familia, $id_usuario)
    {
        $consulta = $this->db->prepare('call sp_insertar_subfamilia(?, ?, ?)');
        $consulta->bindParam(1, $nombre);
        $consulta->bindParam(2, $id_familia);
        $consulta->bindParam(3, $id_usuario);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function registroGeneroSubFamilia($nombre, $id_subfamilia, $id_usuario)
    {
        $consulta = $this->db->prepare('call sp_insertar_genero_subfamilia(?, ?, ?)');
        $consulta->bindParam(1, $nombre);
        $consulta->bindParam(2, $id_subfamilia);
        $consulta->bindParam(3, $id_usuario);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function registroGeneroFamilia($nombre, $id_familia, $id_usuario)
    {
        $consulta = $this->db->prepare('call sp_insertar_genero_familia(?, ?, ?)');
        $consulta->bindParam(1, $nombre);
        $consulta->bindParam(2, $id_familia);
        $consulta->bindParam(3, $id_usuario);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function registroEspecie($nombre, $id_genero, $id_usuario)
    {
        $consulta = $this->db->prepare('call sp_insertar_especie(?, ?, ?)');
        $consulta->bindParam(1, $nombre);
        $consulta->bindParam(2, $id_genero);
        $consulta->bindParam(3, $id_usuario);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function actualizarOrden($orden_id, $orden_nombre)
    {
        $consulta = $this->db->prepare('CALL sp_actualizar_orden(?, ?)');
        $consulta->bindParam(1, $orden_id, PDO::PARAM_INT);
        $consulta->bindParam(2, $orden_nombre, PDO::PARAM_STR);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function actualizarFamilia($familia_id, $familia_nombre)
    {
        $consulta = $this->db->prepare('CALL sp_actualizar_familia(?, ?)');
        $consulta->bindParam(1, $familia_id, PDO::PARAM_INT);
        $consulta->bindParam(2, $familia_nombre, PDO::PARAM_STR);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function actualizarSubfamilia($subfamilia_id, $subfamilia_nombre)
    {
        $consulta = $this->db->prepare('CALL sp_actualizar_subfamilia(?, ?)');
        $consulta->bindParam(1, $subfamilia_id, PDO::PARAM_INT);
        $consulta->bindParam(2, $subfamilia_nombre, PDO::PARAM_STR);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function actualizarGenero($genero_id, $genero_nombre)
    {
        $consulta = $this->db->prepare('CALL sp_actualizar_genero(?, ?)');
        $consulta->bindParam(1, $genero_id, PDO::PARAM_INT);
        $consulta->bindParam(2, $genero_nombre, PDO::PARAM_STR);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function actualizarEspecie($especie_id, $especie_nombre)
    {
        $consulta = $this->db->prepare('CALL sp_actualizar_especie(?, ?)');
        $consulta->bindParam(1, $especie_id, PDO::PARAM_INT);
        $consulta->bindParam(2, $especie_nombre, PDO::PARAM_STR);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }


    public function listarOrden()
    {
        $consulta = $this->db->prepare('call sp_listar_orden');
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function listarFamiliaPorOrden($orden)
    {
        $consulta = $this->db->prepare("CALL sp_listar_familia_por_orden(?)");
        $consulta->bindParam(1, $orden);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function listarSubFamiliaPorFamilia($familia)
    {
        $consulta = $this->db->prepare("CALL sp_listar_subfamilias_por_familia(?)");
        $consulta->bindParam(1, $familia);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function listarGeneroPorSubFamilia($subfamilia)
    {
        $consulta = $this->db->prepare("CALL sp_listar_genero_por_subfamilia(?)");
        $consulta->bindParam(1, $subfamilia);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function listarGeneroPorFamilia($familia)
    {
        $consulta = $this->db->prepare("CALL sp_listar_genero_por_familia(?)");
        $consulta->bindParam(1, $familia);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function listarEspeciePorGenero($genero)
    {
        $consulta = $this->db->prepare("CALL sp_listar_especies_por_genero(?)");
        $consulta->bindParam(1, $genero);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function listarAllGeneros()
    {
        $consulta = $this->db->prepare("CALL sp_get_all_genero");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    
    public function buscarEspecieGenero($genero, $numero)
    {
        $consulta = $this->db->prepare("CALL sp_buscar_especie_genero(?, ?)");
        $consulta->bindParam(1, $genero);
        $consulta->bindParam(2, $numero);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    
    public function buscarGeneros($genero, $numero)
    {
        $consulta = $this->db->prepare("CALL sp_genero_cliente(?, ?)");
        $consulta->bindParam(1, $numero);
        $consulta->bindParam(2, $genero);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function buscarEspecies($especie, $numero)
    {
        $consulta = $this->db->prepare("CALL sp_especies_cliente(?, ?)");
        $consulta->bindParam(1, $numero);
        $consulta->bindParam(2, $especie);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    
    public function buscarGenero($genero, $numero, $usuario)
    {
        $consulta = $this->db->prepare("CALL sp_genero_page(?, ?, ?)");
        $consulta->bindParam(1, $numero);
        $consulta->bindParam(2, $genero);
        $consulta->bindParam(3, $usuario);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function buscarEspecie($especie, $numero, $usuario)
    {
        $consulta = $this->db->prepare("CALL sp_especies_page(?, ?, ?)");
        $consulta->bindParam(1, $numero);
        $consulta->bindParam(2, $especie);
        $consulta->bindParam(3, $usuario);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function buscarOrdenesAsc($orden, $numero)
    {
        $consulta = $this->db->prepare("CALL sp_buscar_orden_asc(?, ?)");
        $consulta->bindParam(1, $orden);
        $consulta->bindParam(2, $numero);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function buscarFamiliaAsc($familia, $numero)
    {
        $consulta = $this->db->prepare("CALL sp_buscar_familia_asc(?, ?)");
        $consulta->bindParam(1, $familia);
        $consulta->bindParam(2, $numero);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function buscarSubFamiliaAsc($subFamilia, $numero)
    {
        $consulta = $this->db->prepare("CALL sp_buscar_subfamilia_asc(?, ?)");
        $consulta->bindParam(1, $subFamilia);
        $consulta->bindParam(2, $numero);
        $consulta->execute();
        return $consulta->fetchAll();
    }


    public function buscarOrdenesDesc($orden, $numero)
    {
        $consulta = $this->db->prepare("CALL sp_buscar_orden_desc(?, ?)");
        $consulta->bindParam(1, $orden);
        $consulta->bindParam(2, $numero);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function buscarFamiliaDesc($familia, $numero)
    {
        $consulta = $this->db->prepare("CALL sp_buscar_familia_desc(?, ?)");
        $consulta->bindParam(1, $familia);
        $consulta->bindParam(2, $numero);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function buscarSubFamiliaDesc($subFamilia, $numero)
    {
        $consulta = $this->db->prepare("CALL sp_buscar_subfamilia_desc(?, ?)");
        $consulta->bindParam(1, $subFamilia);
        $consulta->bindParam(2, $numero);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function actualizarTaxonomiaEspecie($genero, $especie)
    {
        $consulta = $this->db->prepare("CALL sp_actualizarGeneroEspecie(?, ?)");
        $consulta->bindParam(1, $especie);
        $consulta->bindParam(2, $genero);
        $consulta->execute();

        $resultado = $consulta->fetchAll();

        return $resultado;
    }

    public function buscarPlantas($planta, $numero)
    {
        $consulta = $this->db->prepare("CALL sp_planta_cliente(?, ?)");
        $consulta->bindParam(1, $numero);
        $consulta->bindParam(2, $planta);
        $consulta->execute();
        return $consulta->fetchAll();
    }
}
