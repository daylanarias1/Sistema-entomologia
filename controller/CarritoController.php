<?php

class CarritoController
{

    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function verCarritoEspecie()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("indexView.php");
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                require 'model/CarritoModel.php';
                $usuarioModel = new CarritoModel();
                $lista['lista'] = $usuarioModel->verCarritoEspecie(
                    $_SESSION['usuario_id']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            }
        }
    }

    public function verCarritoGenero()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("indexView.php");
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                require 'model/CarritoModel.php';
                $usuarioModel = new CarritoModel();
                $lista['lista'] = $usuarioModel->verCarritoGenero(
                    $_SESSION['usuario_id']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            }
        }
    }

    public function numeroCarrito()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("indexView.php");
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                require 'model/CarritoModel.php';
                $usuarioModel = new CarritoModel();
                $lista['lista'] = $usuarioModel->numeroCarrito(
                    $_SESSION['usuario_id']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            }
        }
    }

    public function listarUbicacionCarrito()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("indexView.php");
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                require 'model/CarritoModel.php';
                $usuarioModel = new CarritoModel();
                $lista['lista'] = $usuarioModel->listarUbicacionHistorialCarrito(
                    $_SESSION['usuario_id']
                );
                $this->view->show("ListaUbicacionView.php", $lista);
            }
        }
    }

    public function especiesVisto()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("indexView.php");
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                require 'model/CarritoModel.php';
                $especimenModel = new CarritoModel();
                $lista = $especimenModel->especiesVisto(
                    $_SESSION['usuario_id'],
                    $_POST['numero']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            }
        }
    }


    public function generoVisto()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("indexView.php");
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                require 'model/CarritoModel.php';
                $especimenModel = new CarritoModel();
                $lista = $especimenModel->generoVisto(
                    $_SESSION['usuario_id'],
                    $_POST['numero']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            }
        }
    }

    public function agregarVistoEspecie()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("indexView.php");
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                require 'model/CarritoModel.php';
                $especimenModel = new CarritoModel();
                $lista = $especimenModel->agregarVistoEspecie(
                    $_POST['especie'],
                    $_SESSION['usuario_id']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            }
        }
    }

    public function eliminarVistoEspecie()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("indexView.php");
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                require 'model/CarritoModel.php';
                $especimenModel = new CarritoModel();
                $lista = $especimenModel->eliminarVistoEspecie(
                    $_POST['especie'],
                    $_SESSION['usuario_id']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            }
        }
    }

    public function agregarVistoGenero()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("indexView.php");
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                require 'model/CarritoModel.php';
                $especimenModel = new CarritoModel();
                $lista = $especimenModel->agregarVistoGenero(
                    $_POST['genero'],
                    $_SESSION['usuario_id']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            }
        }
    }

    public function eliminarVistoGenero()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("indexView.php");
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                require 'model/CarritoModel.php';
                $usuarioModel = new CarritoModel();
                $lista = $usuarioModel->eliminarVistoGenero(
                    $_POST['genero'],
                    $_SESSION['usuario_id']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            }
        }
    }

    public function agregarAlCarritoGenero()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("indexView.php");
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                require 'model/CarritoModel.php';
                $especimenModel = new CarritoModel();
                $lista = $especimenModel->agregarAlCarritoGenero(
                    $_POST['genero'],
                    $_SESSION['usuario_id']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            }
        }
    }

    public function eliminarDelCarritoGenero()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("indexView.php");
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                require 'model/CarritoModel.php';
                $especimenModel = new CarritoModel();
                $lista = $especimenModel->eliminarDelCarritoGenero(
                    $_POST['genero'],
                    $_SESSION['usuario_id']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            }
        }
    }

    public function agregarAlCarritoEspecie()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("indexView.php");
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                require 'model/CarritoModel.php';
                $especimenModel = new CarritoModel();
                $lista = $especimenModel->agregarAlCarritoEspecie(
                    $_POST['especie'],
                    $_SESSION['usuario_id']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            }
        }
    }

    public function eliminarDelCarritoEspecie()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("indexView.php");
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                require 'model/CarritoModel.php';
                $especimenModel = new CarritoModel();
                $lista = $especimenModel->eliminarDelCarritoEspecie(
                    $_POST['especie'],
                    $_SESSION['usuario_id']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            }
        }
    }

    public function listarUbicacionesCarrito()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("indexView.php");
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                require 'model/CarritoModel.php';
                $especimenModel = new CarritoModel();

                $lista = $especimenModel->listarUbicacionesCarrito(
                    $_SESSION['usuario_id'],
                    $_POST['numero']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            }
        }
    }

    public function limpiarCarrito()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("indexView.php");
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                require 'model/CarritoModel.php';
                $especimenModel = new CarritoModel();
                $lista = $especimenModel->limpiarCarrito(
                    $_SESSION['usuario_id']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            }
        }
    }

    public function eliminarCarritoGenero()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("indexView.php");
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                require 'model/CarritoModel.php';
                $usuarioModel = new CarritoModel();
                $lista['lista'] = $usuarioModel->eliminarCarritoGenero(
                    $_SESSION['usuario_id'],
                    $_POST['genero']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            }
        }
    }

    public function eliminarCarritoEspecie()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("indexView.php");
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                require 'model/CarritoModel.php';
                $usuarioModel = new CarritoModel();
                $lista['lista'] = $usuarioModel->eliminarCarritoEspecie(
                    $_SESSION['usuario_id'],
                    $_POST['especie']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            }
        }
    }
}
