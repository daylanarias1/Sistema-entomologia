<?php

class PlantaController
{
    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function listarAllPlantas()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            include 'model/PlantaModel.php';
            $especimenModel = new PlantaModel();
            $lista = $especimenModel->listarAllPlantas();
            header('Content-Type: application/json');
            echo json_encode($lista);
            exit;
        }
    }

    public function insertarPlantas()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                include 'model/PlantaModel.php';
                $especimenModel = new PlantaModel();
                $lista = $especimenModel->insertarPlantas(
                    $_POST['planta']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else {
                $this->view->show("indexView.php");
            }
        }
    }


    public function asociarPlantaGenero()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                include 'model/PlantaModel.php';
                $especimenModel = new PlantaModel();
                $lista = $especimenModel->asociarPlantaGenero(
                    $_POST['planta'],
                    $_POST['genero'],
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else {
                $this->view->show("indexView.php");
            }
        }
    }

    public function eliminarPlantaGenero()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                include 'model/PlantaModel.php';
                $especimenModel = new PlantaModel();

                $resultado = $especimenModel->eliminarPlantaGenero($_POST['planta'], $_POST['genero']);

                header('Content-Type: application/json');
                echo json_encode($resultado);
                exit;
            } else {
                $this->view->show("indexView.php");
            }
        }
    }

    public function actualizarPlanta()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                include 'model/PlantaModel.php';
                $especimenModel = new PlantaModel();

                $resultado = $especimenModel->actualizarPlanta($_POST['planta'], $_POST['nuevo_nombre']);

                header('Content-Type: application/json');
                echo json_encode($resultado);
                exit;
            } else {
                $this->view->show("indexView.php");
            }
        }
    }

    public function buscarPlanta()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            include 'model/PlantaModel.php';
            $especimenModel = new PlantaModel();

            $lista = $especimenModel->buscarPlanta(
                $_POST['planta'],
                $_POST['numero'],
                $_SESSION['usuario_id']
            );

            header('Content-Type: application/json');
            echo json_encode($lista);
            exit;
        }
    }
}
