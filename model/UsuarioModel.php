<?php

class UsuarioModel
{

    private $db;

    public function __construct()
    {
        require './libs/SPDO.php';
        $this->db = SPDO::getInstance();
    }

    public function registrarUsuario($username, $password, $rol)
    {
        $consulta = $this->db->prepare("CALL sp_registrar_usuario(?, ?, ?)");
        $hashedPassword = hash('sha256', $password);
        $consulta->bindParam(1, $username);
        $consulta->bindParam(2, $hashedPassword);
        $consulta->bindParam(3, $rol);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function inicioSesion($username, $password)
    {
        $consulta = $this->db->prepare("CALL sp_inicio_sesion_usuario(?, ?)");
        $hashedPassword = hash('sha256', $password);
        $consulta->bindParam(1, $username);
        $consulta->bindParam(2, $hashedPassword);
        $consulta->execute();

        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    public function listarUsuarios()
    {
        $consulta = $this->db->prepare('call sp_get_all_user');
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function cambiarEstadoUsuarios($username)
    {
        $consulta = $this->db->prepare('call sp_update_user_activo(?)');
        $consulta->bindParam(1, $username);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function usuariosPage($page)
    {
        $consulta = $this->db->prepare('call sp_get_users_by_page(?)');
        $consulta->bindParam(1, $page);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function registroAnio($anio, $pagina)
    {
        $consulta = $this->db->prepare('call BuscarRegistrosPorAnoPaginado(?,?)');
        $consulta->bindParam(1, $anio);
        $consulta->bindParam(2, $pagina);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function registroRango($fechaInicio, $fechaFinal, $pagina)
    {
        $consulta = $this->db->prepare('call BuscarPorRangoFechasPaginado(?, ?,?)');
        $consulta->bindParam(1, $fechaInicio);
        $consulta->bindParam(2, $fechaFinal);
        $consulta->bindParam(3, $pagina);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function registroRecolector($inicial, $apellido)
    {
        $consulta = $this->db->prepare('call sp_insertar_recolector(?,?)');
        $consulta->bindParam(1, $inicial);
        $consulta->bindParam(2, $apellido);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function recomendaciones($usuario)
    {
        $consulta = $this->db->prepare("CALL sp_obtener_recomendaciones(?)");
        $consulta->bindParam(1, $usuario);
        $consulta->execute();

        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    public function verHistorial($usuario, $numero)
    {
        $consulta = $this->db->prepare("CALL sp_obtener_historial(?, ?)");
        $consulta->bindParam(1, $usuario);
        $consulta->bindParam(2, $numero);
        $consulta->execute();

        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    public function listarUbicacionHistorial($usuario, $fecha)
    {
        $consulta = $this->db->prepare("CALL ObtenerEspecimenesPorUsuarioYFecha(?, ?)");
        $consulta->bindParam(1, $usuario);
        $consulta->bindParam(2, $fecha);
        $consulta->execute();

        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }
}
