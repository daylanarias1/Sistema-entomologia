<?php

class CarritoModel
{

    private $db;

    public function __construct()
    {
        require './libs/SPDO.php';
        $this->db = SPDO::getInstance();
    }

    public function verCarritoEspecie($usuario)
    {
        $consulta = $this->db->prepare("CALL sp_ver_carrito_especie(?)");
        $consulta->bindParam(1, $usuario);
        $consulta->execute();

        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    public function verCarritoGenero($usuario)
    {
        $consulta = $this->db->prepare("CALL sp_ver_carrito_genero(?)");
        $consulta->bindParam(1, $usuario);
        $consulta->execute();

        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    public function numeroCarrito($usuario)
    {
        $consulta = $this->db->prepare("CALL sp_numero_carrito(?)");
        $consulta->bindParam(1, $usuario);
        $consulta->execute();

        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    public function listarUbicacionHistorialCarrito($usuario)
    {
        $consulta = $this->db->prepare("CALL ObtenerEspecimenesPorUsuario(?)");
        $consulta->bindParam(1, $usuario);
        $consulta->execute();

        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    public function especiesVisto($usuario, $pagina)
    {
        $consulta = $this->db->prepare("CALL vistosEspecie(?, ?)");
        $consulta->bindParam(1, $pagina);
        $consulta->bindParam(2, $usuario);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function generoVisto($usuario, $pagina)
    {
        $consulta = $this->db->prepare("CALL vistosGenero(?, ?)");
        $consulta->bindParam(1, $pagina);
        $consulta->bindParam(2, $usuario);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function agregarVistoEspecie($especie, $usuario)
    {
        $consulta = $this->db->prepare("CALL sp_agregar_visto_especie(?, ?)");
        $consulta->bindParam(1, $usuario);
        $consulta->bindParam(2, $especie);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function eliminarVistoEspecie($especie, $usuario)
    {
        $consulta = $this->db->prepare("CALL sp_eliminar_visto_especie(?, ?)");
        $consulta->bindParam(1, $usuario);
        $consulta->bindParam(2, $especie);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function agregarVistoGenero($genero, $usuario)
    {
        $consulta = $this->db->prepare("CALL sp_agregar_visto_genero(?, ?)");
        $consulta->bindParam(1, $usuario);
        $consulta->bindParam(2, $genero);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function eliminarVistoGenero($genero, $usuario)
    {
        $consulta = $this->db->prepare("CALL sp_eliminar_visto_genero(?, ?)");
        $consulta->bindParam(1, $usuario);
        $consulta->bindParam(2, $genero);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function agregarAlCarritoGenero($genero, $usuario)
    {
        $consulta = $this->db->prepare("CALL sp_agregar_carrito_genero(?, ?)");
        $consulta->bindParam(1, $usuario);
        $consulta->bindParam(2, $genero);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function eliminarDelCarritoGenero($genero, $usuario)
    {
        $consulta = $this->db->prepare("CALL sp_eliminar_carrito_genero(?, ?)");
        $consulta->bindParam(1, $usuario);
        $consulta->bindParam(2, $genero);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function agregarAlCarritoEspecie($especie, $usuario)
    {
        $consulta = $this->db->prepare("CALL sp_agregar_carrito_especie(?, ?)");
        $consulta->bindParam(1, $usuario);
        $consulta->bindParam(2, $especie);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function eliminarDelCarritoEspecie($especie, $usuario)
    {
        $consulta = $this->db->prepare("CALL sp_eliminar_carrito_especie(?, ?)");
        $consulta->bindParam(1, $usuario);
        $consulta->bindParam(2, $especie);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function listarUbicacionesCarrito($usuario, $pagina)
    {
        $consulta = $this->db->prepare("CALL sp_ubicaciones_carrito(?,?)");
        $consulta->bindParam(1, $usuario);
        $consulta->bindParam(2, $pagina);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function limpiarCarrito($usuario)
    {
        $consulta = $this->db->prepare("CALL sp_limpiar_carrito(?)");
        $consulta->bindParam(1, $usuario);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function eliminarCarritoGenero($usuario, $idGenero)
    {
        $consulta = $this->db->prepare("CALL sp_eliminar_carrito_genero(?, ?)");
        $consulta->bindParam(1, $usuario);
        $consulta->bindParam(2, $idGenero);
        $consulta->execute();

        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    public function eliminarCarritoEspecie($usuario, $idEspecie)
    {
        $consulta = $this->db->prepare("CALL sp_eliminar_carrito_especie(?, ?)");
        $consulta->bindParam(1, $usuario);
        $consulta->bindParam(2, $idEspecie);
        $consulta->execute();

        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }
}
