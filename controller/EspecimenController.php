<?php

class EspecimenController
{
    //put your code here
    private $view;
    public function __construct()
    {
        $this->view = new View();
    } // constructor

    public function obtenerDetallesEspecimen()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            require 'model/EspecimenModel.php';
            $gavineteModel = new EspecimenModel();
            $lista['lista'] = $gavineteModel->obtenerDetallesEspecimen(
                $_POST['id']
            );
            header('Content-Type: application/json');
            echo json_encode($lista);
            exit;
        }
    }

    public function buscarEspecimenesEspecie()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            include 'model/EspecimenModel.php';
            $especimenModel = new EspecimenModel();
            $resultado = $especimenModel->buscarEspecimenesEspecie($_POST['especie'], $_POST['numero']);
            header('Content-Type: application/json');
            echo json_encode($resultado);
            exit;
        }
    }

    public function buscarEspecimenesGenero()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            include 'model/EspecimenModel.php';
            $especimenModel = new EspecimenModel();
            $resultado = $especimenModel->buscarEspecimenesGenero($_POST['genero'], $_POST['numero']);
            header('Content-Type: application/json');
            echo json_encode($resultado);
            exit;
        }
    }

    public function especimenesHistorial()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("indexView.php");
            } else {
                include 'model/EspecimenModel.php';
                $especimenModel = new EspecimenModel();
                $lista = $especimenModel->especimenesHistorial(
                    $_SESSION['usuario_id'],
                    $_POST['fecha']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            }
        }
    }

    public function especimenEspecie()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            session_start();
            include 'model/EspecimenModel.php';
            $especimenModel = new EspecimenModel();
            $lista = $especimenModel->especimenEspecie(
                $_POST['especie']
            );
            header('Content-Type: application/json');
            echo json_encode($lista);
            exit;
        }
    }

    public function especimenGenero()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            session_start();
            include 'model/EspecimenModel.php';
            $especimenModel = new EspecimenModel();
            $lista = $especimenModel->especimenGenero(
                $_POST['genero']
            );
            header('Content-Type: application/json');
            echo json_encode($lista);
            exit;
        }
    }


    public function buscarEspecimenEspecie()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            include 'model/EspecimenModel.php';
            $especimenModel = new EspecimenModel();
            $lista = $especimenModel->buscarEspecimenEspecie(
                $_POST['especie'],
                $_POST['numero']
            );
            header('Content-Type: application/json');
            echo json_encode($lista);
            exit;
        }
    }


    public function getEspecimen()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            include 'model/EspecimenModel.php';
            $especimenModel = new EspecimenModel();
            $lista = $especimenModel->getEspecimen(
                $_POST['especimen']
            );
            header('Content-Type: application/json');
            echo json_encode($lista);
            exit;
        }
    }

    public function listarRecolector()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                include 'model/EspecimenModel.php';
                $especimenModel = new EspecimenModel();
                $lista = $especimenModel->listarRecolector();
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            }
        }
    }


    public function insertarEspecimenGaveta()
    {

        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                include 'model/EspecimenModel.php';
                $especimenModel = new EspecimenModel();

                $rutasImagenes = array();
                if (isset($_FILES['imagenes'])) {
                    $numImagenes = count($_FILES['imagenes']['name']);
                    for ($i = 0; $i < $numImagenes; $i++) {
                        $nombreImagen = basename($_FILES['imagenes']['name'][$i]);
                        $rutaImagen = $_FILES['imagenes']['tmp_name'][$i];
                        $rutaImagenGuardada = "public/assets/img/" . $nombreImagen;
                        move_uploaded_file($rutaImagen, $rutaImagenGuardada);
                        $rutaImagenGuardada = stripslashes($rutaImagenGuardada);
                        $rutasImagenes[] = $rutaImagenGuardada;
                    }
                }

                $lista = $especimenModel->insertarEspecimenGaveta(
                    $_POST['id_especie'],
                    $_POST['id_recolector'],
                    $_POST['id_genero'],
                    $_POST['distrito'],
                    $_POST['latitud'],
                    $_POST['longitud'],
                    $_POST['fecha_recoleccion'],
                    $rutasImagenes,
                    $_POST['gaveta'],
                );

                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else {
                $this->view->show("indexView.php");
            }
        }
    }

    public function insertarEspecimenVial()
    {

        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                include 'model/EspecimenModel.php';
                $especimenModel = new EspecimenModel();

                $rutasImagenes = array();
                if (isset($_FILES['imagenes'])) {
                    $numImagenes = count($_FILES['imagenes']['name']);
                    for ($i = 0; $i < $numImagenes; $i++) {
                        $nombreImagen = basename($_FILES['imagenes']['name'][$i]);
                        $rutaImagen = $_FILES['imagenes']['tmp_name'][$i];
                        $rutaImagenGuardada = "public/assets/img/" . $nombreImagen;
                        move_uploaded_file($rutaImagen, $rutaImagenGuardada);
                        $rutasImagenes[] = $rutaImagenGuardada;
                    }
                }

                $lista = $especimenModel->insertarEspecimenVial(
                    $_POST['id_especie'],
                    $_POST['id_recolector'],
                    $_POST['id_genero'],
                    $_POST['distrito'],
                    $_POST['latitud'],
                    $_POST['longitud'],
                    $_POST['fecha_recoleccion'],
                    $rutasImagenes,
                    $_POST['vial'],
                );

                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else {
                $this->view->show("indexView.php");
            }
        }
    }

    public function eliminarEspecimen()
    {

        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                include 'model/EspecimenModel.php';
                $especimenModel = new EspecimenModel();

                $lista = $especimenModel->eliminarEspecimen(
                    $_POST['especimen']
                );

                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else {
                $this->view->show("indexView.php");
            }
        }
    }

    public function actualizarGavetaEspecimen()
    {

        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                include 'model/EspecimenModel.php';
                $especimenModel = new EspecimenModel();

                $lista = $especimenModel->actualizarGavetaEspecimen(
                    $_POST['especimen'],
                    $_POST['gaveta']
                );

                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else {
                $this->view->show("indexView.php");
            }
        }
    }

    public function actualizarVialEspecimen()
    {

        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                include 'model/EspecimenModel.php';
                $especimenModel = new EspecimenModel();

                $lista = $especimenModel->actualizarVialEspecimen(
                    $_POST['especimen'],
                    $_POST['vial']
                );

                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else {
                $this->view->show("indexView.php");
            }
        }
    }

    public function actualizarRecoleccionEspecimen()
    {


        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                include 'model/EspecimenModel.php';
                $especimenModel = new EspecimenModel();

                $lista = $especimenModel->actualizarRecoleccionEspecimen(
                    $_POST['especimen'],
                    $_POST['distrito']
                );

                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else {
                $this->view->show("indexView.php");
            }
        }
    }

    public function actualizarTaxonomiaEspecimen()
    {

        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                include 'model/EspecimenModel.php';
                $especimenModel = new EspecimenModel();

                $lista = $especimenModel->actualizarTaxonomiaEspecimen(
                    $_POST['especimen'],
                    $_POST['genero'],
                    $_POST['especie']
                );

                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else {
                $this->view->show("indexView.php");
            }
        }
    }
}
