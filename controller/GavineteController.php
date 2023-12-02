<?php

class GavineteController
{
    private $view;

    public function __construct()
    {
        $this->view = new View();
    } // constructor

    public function listarGavetines()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                require 'model/GavineteModel.php';
                $gavineteModel = new gavineteModel();
                $lista['lista'] = $lista['lista'] = $gavineteModel->listarGavinetes();
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("indexView.php");
            }
        }
    }

    public function listarGavetas()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                require 'model/GavineteModel.php';
                $gavineteModel = new gavineteModel();
                $lista['lista'] = $lista['lista'] = $gavineteModel->listarGavetas($_POST['cod_gavetin']);
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("indexView.php");
            }
        }
    }

    public function listarCajas()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                require 'model/GavineteModel.php';
                $gavineteModel = new gavineteModel();
                $lista['lista'] = $lista['lista'] = $gavineteModel->listarCajas();
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("indexView.php");
            }
        }
    }

    public function listarViales()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                require 'model/GavineteModel.php';
                $gavineteModel = new gavineteModel();
                $lista['lista'] = $gavineteModel->listarViales($_POST['cod_caja']);
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("indexView.php");
            }
        }
    }


    public function registrarCaja()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                require 'model/GavineteModel.php';
                $gavineteModel = new gavineteModel();
                $lista['lista'] = $gavineteModel->registrarCaja(
                    $_POST['cod_caja']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("indexView.php");
            }
        }
    }

    public function registrarVial()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                require 'model/GavineteModel.php';
                $gavineteModel = new gavineteModel();
                $lista['lista'] = $gavineteModel->registrarVial(
                    $_POST['cod_vial'],
                    $_POST['cod_caja']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("indexView.php");
            }
        }
    }

    public function registrarGaveta()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                require 'model/GavineteModel.php';
                $gavineteModel = new gavineteModel();
                $lista['lista'] = $gavineteModel->registrarGaveta(
                    $_POST['cod_gaveta'],
                    $_POST['cod_gavetin']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("indexView.php");
            }
        }
    }

    public function registrarGavinete()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                require 'model/GavineteModel.php';
                $gavineteModel = new gavineteModel();
                $lista['lista'] = $gavineteModel->registrarGavinete(
                    $_POST['cod_gavinete']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("indexView.php");
            }
        }
    }

    public function actualizarGabinete()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                include 'model/GavineteModel.php';
                $gabinetesModel = new gavineteModel();
                $resultado = $gabinetesModel->actualizarGabinete($_POST['numeroGabinete'], $_POST['idGabinete']);
                header('Content-Type: application/json');
                echo json_encode($resultado);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("indexView.php");
            }
        }
    }

    public function actualizarGaveta()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                include 'model/GavineteModel.php';
                $gabinetesModel = new gavineteModel();
                $resultado = $gabinetesModel->actualizarGaveta($_POST['numeroGaveta'], $_POST['idGaveta']);
                header('Content-Type: application/json');
                echo json_encode($resultado);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("indexView.php");
            }
        }
    }


    public function actualizarCaja()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                include 'model/GavineteModel.php';
                $gabinetesModel = new gavineteModel();
                $resultado = $gabinetesModel->actualizarCaja($_POST['numeroCaja'], $_POST['idCaja']);
                header('Content-Type: application/json');
                echo json_encode($resultado);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("indexView.php");
            }
        }
    }

    public function actualizarVial()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                include 'model/GavineteModel.php';
                $gabinetesModel = new gavineteModel();
                $resultado = $gabinetesModel->actualizarVial($_POST['numeroVial'], $_POST['idVial']);
                header('Content-Type: application/json');
                echo json_encode($resultado);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("indexView.php");
            }
        }
    }
} // fin clase
