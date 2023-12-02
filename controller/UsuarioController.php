<?php

class UsuarioController
{
    private $view;
    public function __construct()
    {
        $this->view = new View();
    } // constructor

    public function cerrarSession()
    {
        session_start();
        session_destroy();
        $data['mensaje'] = '';
        $this->view->show("indexView.php", $data);
    }

    public function registrarUsuario()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {

                require 'model/UsuarioModel.php';

                $usuarioModel = new UsuarioModel();
                $resultado = $usuarioModel->registrarUsuario(
                    $_POST['cod_username'],
                    $_POST['cod_password'],
                    isset($_POST['tipo']) ? $_POST['tipo'] : 2
                );
                header('Content-Type: application/json');
                echo json_encode($resultado);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            }
        }
    }

    public function iniciarSession()
    {
        if (isset($_POST['username']) && isset($_POST['hashedPassword'])) {
            require 'model/UsuarioModel.php';

            $usuarioModel = new UsuarioModel();
            $respuesta = $usuarioModel->inicioSesion($_POST['username'], $_POST['hashedPassword']);

            if (empty($respuesta)) {
                $data['mensaje'] = 'Contraseña y usuarios inválidos';
                $this->view->show("loginView.php", $data);
                return;
            }

            session_start();

            foreach ($respuesta as $value) {
                $idUsuario = $value[0];
                $nombreRol = $value[1];
            }

            // Verificar si el usuario ya tiene una sesión activa
            if (isset($_SESSION['usuarios_sesion'][$idUsuario])) {
                $data['mensaje'] = 'Ya hay una sesión activa con este usuario';
                $this->view->show("loginView.php", $data);
                return;
            }

            $_SESSION['usuario_id'] = $idUsuario;
            $_SESSION['usuario_nombre_rol'] = $nombreRol;

            // Almacenar el usuario en la sesión
            $_SESSION['usuarios_sesion'][$idUsuario] = session_id();

            if (!isset($_SESSION['usuario_nombre_rol'])) {
                $data['mensaje'] = '';
                $this->view->show("indexView.php", $data);
            } else {
                if ($nombreRol == 'SA') {
                    return $this->view->show("homeAdministradorGeneralView.php", null);
                } else if ($nombreRol == 'ADMIN') {
                    return $this->view->show("homeAdministradorView.php", NULL);
                } else if ($nombreRol == 'USER') {
                    $this->view->show("homeClienteView.php", NULL);
                }
            }
        } else {
            echo 'ERROR: la petición no cumple con los requisitos';
        }
    }

    public function cambiarEstadoUsuarios()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA') {
                require 'model/UsuarioModel.php';
                $gavineteModel = new UsuarioModel();

                $lista['lista'] = $gavineteModel->cambiarEstadoUsuarios(
                    $_POST['cod_username']
                );

                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                return $this->view->show("homeAdministradorView.php", NULL);
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            }
        }
    }

    public function usuariosPage()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {

                require 'model/UsuarioModel.php';
                $gavineteModel = new UsuarioModel();

                $lista['lista'] = $gavineteModel->usuariosPage(
                    $_POST['cod_page']
                );

                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            }
        }
    }

    public function registroAnio()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {

                require 'model/UsuarioModel.php';
                $gavineteModel = new UsuarioModel();

                $lista['lista'] = $gavineteModel->registroAnio(
                    $_POST['anioBusqueda'],
                    $_POST['pagina']
                );

                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            }
        }
    }

    public function registroRango()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {

                require 'model/UsuarioModel.php';
                $gavineteModel = new UsuarioModel();

                $lista['lista'] = $gavineteModel->registroRango(
                    $_POST['fechaInicio'],
                    $_POST['fechaFin'],
                    $_POST['pagina']
                );

                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            }
        }
    }

    public function registroRecolector()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                require 'model/UsuarioModel.php';
                $gavineteModel = new UsuarioModel();
                $lista = $gavineteModel->registroRecolector(
                    $_POST['inicial'],
                    $_POST['apellidos']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            }
        }
    }

    public function recomendaciones()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("indexView.php", null);
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                require 'model/UsuarioModel.php';
                $usuarioModel = new UsuarioModel();
                $lista['lista'] = $usuarioModel->recomendaciones(
                    $_SESSION['usuario_id']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            }
        }
    }

    public function verHistorial()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("homeClienteView.php", NULL);
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                require 'model/UsuarioModel.php';
                $provinciaModel = new usuarioModel();
                $lista['lista'] = $provinciaModel->verHistorial($_SESSION['usuario_id'], $_POST['numero']);
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            }
        }
    }

    public function listarUbicacionHistorial()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                session_start();
                require 'model/UsuarioModel.php';
                $usuarioModel = new UsuarioModel();
                $lista['lista'] = $usuarioModel->listarUbicacionHistorial(
                    $_SESSION['usuario_id'],
                    $_POST['fecha']
                );
                $this->view->show("ListaUbicacionView.php", $lista);
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            }
        }
    }
}//fin clase
