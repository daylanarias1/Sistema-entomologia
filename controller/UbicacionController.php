<?php

class UbicacionController
{
    //put your code here
    private $view;
    public function __construct()
    {
        $this->view = new View();
    } // constructor

    public function listarPais()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {

                include 'model/UbicacionModel.php';
                $especimenModel = new UbicacionModel();

                $lista = $especimenModel->listarPais();

                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            }
        }
    }

    public function listarProvinciaPorPais()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {

                include 'model/UbicacionModel.php';
                $especimenModel = new UbicacionModel();

                $generos = $especimenModel->listarProvinciaPorPais($_POST['pais']);
                header('Content-Type: application/json');
                echo json_encode($generos);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            }
        }
    }

    public function listarCantonPorProvincia()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {

                include 'model/UbicacionModel.php';
                $especimenModel = new UbicacionModel();

                $generos = $especimenModel->listarCantonPorProvincia($_POST['provincia']);
                header('Content-Type: application/json');
                echo json_encode($generos);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            }
        }
    }


    public function listarDistritoPorCanton()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {

                include 'model/UbicacionModel.php';
                $especimenModel = new UbicacionModel();

                $generos = $especimenModel->listarDistritoPorCanton($_POST['canton']);
                header('Content-Type: application/json');
                echo json_encode($generos);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            }
        }
    }

    public function registroPais()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                require 'model/UbicacionModel.php';
                $gavineteModel = new UbicacionModel();
                $lista = $gavineteModel->registroPais(
                    $_POST['pais']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            }
        }
    }

    public function registroProvincia()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                require 'model/UbicacionModel.php';
                $gavineteModel = new UbicacionModel();
                $lista = $gavineteModel->registroProvincia(
                    $_POST['provincia'],
                    $_POST['pais']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            }
        }
    }

    public function registroCanton()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                require 'model/UbicacionModel.php';
                $gavineteModel = new UbicacionModel();
                $lista = $gavineteModel->registroCanton(
                    $_POST['canton'],
                    $_POST['provincia']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            }
        }
    }

    public function registroDistrito()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                require 'model/UbicacionModel.php';
                $gavineteModel = new UbicacionModel();
                $lista = $gavineteModel->registroDistrito(
                    $_POST['distrito'],
                    $_POST['canton']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            }
        }
    }
}
