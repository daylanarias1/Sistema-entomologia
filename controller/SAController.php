<?php

class SAController
{

    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function iniciarSessionSA()
    {
        if (isset($_POST['username']) && isset($_POST['hashedPassword'])) {
            require 'model/SAModel.php';

            $usuarioModel = new SAModel();
            $respuesta = $usuarioModel->inicioSesionSA($_POST['username'], $_POST['hashedPassword']);

            if (empty($respuesta)) {
                $data['mensaje'] = 'Contraseña y usuarios inválidos';
                $this->view->show("loginView.php", $data);
                return;
            }

            session_start();

            foreach ($respuesta as $value) {
                $idUsuario = $value[0];
                $nombreRol = $value[1];
                $logueado = $value[2];
            }

            // Verificar si el usuario ya tiene una sesión activa
            if (isset($_SESSION['usuarios_sesion'][$idUsuario])) {
                $data['mensaje'] = 'Ya hay una sesión activa con este usuario';
                $this->view->show("loginView.php", $data);
                return;
            }

            $_SESSION['usuario_id'] = $idUsuario;
            $_SESSION['usuario_nombre_rol'] = $nombreRol;
            $_SESSION['logueado'] = $logueado;

            // Almacenar el usuario en la sesión
            $_SESSION['usuarios_sesion'][$idUsuario] = session_id();

            if (!isset($_SESSION['usuario_nombre_rol'])) {
                $data['mensaje'] = '';
                $this->view->show("indexView.php", $data);
            } else {

                if ($logueado == 0) {
                    return $this->view->show("cambioContra.php", null);
                } else {
                    return $this->view->show("homeAdministradorGeneralView.php", null);
                }
            }
        } else {
            echo 'ERROR: la petición no cumple con los requisitos';
        }
    }

    public function cambioContrasenaSA()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA') {
                require 'model/SAModel.php';
                $usuarioModel = new SAModel();
                $lista = $usuarioModel->cambioContrasenaSA(
                    $_SESSION['usuario_id'],
                    $_POST['hashedPassword']
                );

                if ($lista[0]['cambio'] == 1) {
                    $_SESSION['logueado'] = 1;
                    return $this->view->show("homeAdministradorGeneralView.php", null);
                } else {
                    $data['mensaje'] = 'Error';
                    $this->view->show("cambioContra.php", $data);
                    return;
                }
            } else {
                $this->view->show("indexView.php");
            }
        }
    }
}
