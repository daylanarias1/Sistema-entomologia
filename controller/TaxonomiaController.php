<?php

class TaxonomiaController
{

    private $view;

    public function __construct()
    {
        $this->view = new View();
    }


    public function registroOrden()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                require 'model/TaxonomiaModel.php';
                $gavineteModel = new TaxonomiaModel();
                session_start();
                $lista['lista'] = $gavineteModel->registroOrden(
                    $_POST['nombre_orden'],
                    $_SESSION['usuario_id']
                );

                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else {
                $this->view->show("indexView.php");
            }
        }
    }


    public function registroFamilia()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {

                require 'model/TaxonomiaModel.php';
                $gavineteModel = new TaxonomiaModel();
                session_start();
                $lista['lista'] = $gavineteModel->registroFamilia(
                    $_POST['nombre_familia'],
                    $_POST['id_orden'],
                    $_SESSION['usuario_id']
                );

                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else {
                $this->view->show("indexView.php");
            }
        }
    }

    public function registroSubFamilia()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {

                require 'model/TaxonomiaModel.php';
                $gavineteModel = new TaxonomiaModel();
                session_start();
                $lista['lista'] = $gavineteModel->registroSubFamilia(
                    $_POST['nombre_subFamilia'],
                    $_POST['id_familia'],
                    $_SESSION['usuario_id']
                );

                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else {
                $this->view->show("indexView.php");
            }
        }
    }

    public function registroGeneroSubFamilia()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {

                require 'model/TaxonomiaModel.php';
                $gavineteModel = new TaxonomiaModel();
                session_start();
                $lista['lista'] = $gavineteModel->registroGeneroSubFamilia(
                    $_POST['nombre_genero'],
                    $_POST['id_subfamilia'],
                    $_SESSION['usuario_id']
                );

                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else {
                $this->view->show("indexView.php");
            }
        }
    }

    public function registroGeneroFamilia()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {

                require 'model/TaxonomiaModel.php';
                $gavineteModel = new TaxonomiaModel();
                session_start();
                $lista['lista'] = $gavineteModel->registroGeneroFamilia(
                    $_POST['nombre_genero'],
                    $_POST['id_familia'],
                    $_SESSION['usuario_id']
                );
                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else {
                $this->view->show("indexView.php");
            }
        }
    }


    public function registroEspecie()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {

                require 'model/TaxonomiaModel.php';
                $gavineteModel = new TaxonomiaModel();
                session_start();
                $lista['lista'] = $gavineteModel->registroEspecie(
                    $_POST['nombre_genero'],
                    $_POST['id_genero'],
                    $_SESSION['usuario_id']
                );

                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else {
                $this->view->show("indexView.php");
            }
        }
    }


    public function actualizarOrden()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {

                require 'model/TaxonomiaModel.php';
                $usuarioModel = new TaxonomiaModel();

                $resultado = $usuarioModel->actualizarOrden($_POST['orden_id'], $_POST['orden_nombre']);

                header('Content-Type: application/json');
                echo json_encode($resultado);
                exit;
            } else {
                $this->view->show("indexView.php");
            }
        }
    }

    public function actualizarFamilia()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                require 'model/TaxonomiaModel.php';
                $usuarioModel = new TaxonomiaModel();

                $resultado = $usuarioModel->actualizarFamilia($_POST['familia_id'], $_POST['familia_nombre']);

                header('Content-Type: application/json');
                echo json_encode($resultado);
                exit;
            } else {
                $this->view->show("indexView.php");
            }
        }
    }

    public function actualizarSubfamilia()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                require 'model/TaxonomiaModel.php';
                $usuarioModel = new TaxonomiaModel();

                $resultado = $usuarioModel->actualizarSubfamilia($_POST['subfamilia_id'], $_POST['subfamilia_nombre']);

                header('Content-Type: application/json');
                echo json_encode($resultado);
                exit;
            } else {
                $this->view->show("indexView.php");
            }
        }
    }

    public function actualizarGenero()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {


                require 'model/TaxonomiaModel.php';
                $usuarioModel = new TaxonomiaModel();

                $resultado = $usuarioModel->actualizarGenero($_POST['genero_id'], $_POST['genero_nombre']);

                header('Content-Type: application/json');
                echo json_encode($resultado);
                exit;
            } else {
                $this->view->show("indexView.php");
            }
        }
    }

    public function actualizarEspecie()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {

                require 'model/TaxonomiaModel.php';
                $usuarioModel = new TaxonomiaModel();

                $resultado = $usuarioModel->actualizarEspecie($_POST['especie_id'], $_POST['especie_nombre']);

                header('Content-Type: application/json');
                echo json_encode($resultado);
                exit;
            } else {
                $this->view->show("indexView.php");
            }
        }
    }

    public function listarOrden()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {

                include 'model/TaxonomiaModel.php';
                $especimenModel = new TaxonomiaModel();

                $lista = $especimenModel->listarOrden();

                header('Content-Type: application/json');
                echo json_encode($lista);
                exit;
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            }
        }
    }

    public function listarFamiliasPorOrden()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            } else {
                if (isset($_POST['orden'])) {
                    include 'model/TaxonomiaModel.php';
                    $especimenModel = new TaxonomiaModel();

                    $familias = $especimenModel->listarFamiliaPorOrden($_POST['orden']);

                    header('Content-Type: application/json');
                    echo json_encode($familias);
                    exit;
                } else {
                    echo 'ERROR: la petición no cumpe con los requisitos';
                }
            }
        }
    }

    public function listarSubfamiliasPorFamilia()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            } else {
                if (isset($_POST['familia'])) {
                    include 'model/TaxonomiaModel.php';
                    $especimenModel = new TaxonomiaModel();

                    $subfamilias = $especimenModel->listarSubFamiliaPorFamilia($_POST['familia']);

                    header('Content-Type: application/json');
                    echo json_encode($subfamilias);
                    exit;
                } else {
                    echo 'ERROR: la petición no cumpe con los requisitos';
                }
            }
        }
    }

    public function listarGeneroPorSubFamilia()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            } else {
                if (isset($_POST['subfamilia'])) {
                    include 'model/TaxonomiaModel.php';
                    $especimenModel = new TaxonomiaModel();

                    $generos = $especimenModel->listarGeneroPorSubFamilia($_POST['subfamilia']);
                    header('Content-Type: application/json');
                    echo json_encode($generos);
                    exit;
                } else {
                    echo 'ERROR: la petición no cumpe con los requisitos';
                }
            }
        }
    }

    public function listarGeneroPorFamilia()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            } else {

                include 'model/TaxonomiaModel.php';
                $especimenModel = new TaxonomiaModel();

                $generos = $especimenModel->listarGeneroPorFamilia($_POST['familia']);
                header('Content-Type: application/json');
                echo json_encode($generos);
                exit;
            }
        }
    }

    public function listarEspeciePorGenero()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            } else {
                if (isset($_POST['genero'])) {
                    include 'model/TaxonomiaModel.php';
                    $especimenModel = new TaxonomiaModel();
                    $generos = $especimenModel->listarEspeciePorGenero($_POST['genero']);
                    header('Content-Type: application/json');
                    echo json_encode($generos);
                    exit;
                } else {
                    echo 'ERROR: la petición no cumpe con los requisitos';
                }
            }
        }
    }

    public function listarAllGeneros()
    {
        include 'model/TaxonomiaModel.php';
        $especimenModel = new TaxonomiaModel();

        $lista = $especimenModel->listarAllGeneros();

        header('Content-Type: application/json');
        echo json_encode($lista);
        exit;
    }

    public function buscarEspecieGenero()
    {
        include 'model/TaxonomiaModel.php';
        $especimenModel = new TaxonomiaModel();

        $lista = $especimenModel->buscarEspecieGenero(
            $_POST['genero'],
            $_POST['numero']
        );

        header('Content-Type: application/json');
        echo json_encode($lista);
        exit;
    }

    public function buscarGenero()
    {
        session_start();
        include 'model/TaxonomiaModel.php';
        $especimenModel = new TaxonomiaModel();

        $lista = $especimenModel->buscarGenero(
            $_POST['genero'],
            $_POST['numero'],
            $_SESSION['usuario_id']
        );

        header('Content-Type: application/json');
        echo json_encode($lista);
        exit;
    }

    public function buscarEspecie()
    {
        session_start();
        include 'model/TaxonomiaModel.php';
        $especimenModel = new TaxonomiaModel();

        $lista = $especimenModel->buscarEspecie(
            $_POST['especie'],
            $_POST['numero'],
            $_SESSION['usuario_id']
        );

        header('Content-Type: application/json');
        echo json_encode($lista);
        exit;
    }

    public function buscarGeneros()
    {
        session_start();
        include 'model/TaxonomiaModel.php';
        $especimenModel = new TaxonomiaModel();

        $lista = $especimenModel->buscarGeneros(
            $_POST['genero'],
            $_POST['numero'],
            $_SESSION['usuario_id']
        );

        header('Content-Type: application/json');
        echo json_encode($lista);
        exit;
    }

    public function buscarEspecies()
    {
        session_start();
        include 'model/TaxonomiaModel.php';
        $especimenModel = new TaxonomiaModel();

        $lista = $especimenModel->buscarEspecies(
            $_POST['especie'],
            $_POST['numero'],
            $_SESSION['usuario_id']
        );

        header('Content-Type: application/json');
        echo json_encode($lista);
        exit;
    }


    public function buscarOrdenesAsc()
    {
        include 'model/TaxonomiaModel.php';
        $especimenModel = new TaxonomiaModel();

        $lista = $especimenModel->buscarOrdenesAsc(
            $_POST['busqueda'],
            $_POST['numero']
        );

        header('Content-Type: application/json');
        echo json_encode($lista);
        exit;
    }

    public function buscarFamiliaAsc()
    {
        include 'model/TaxonomiaModel.php';
        $especimenModel = new TaxonomiaModel();

        $lista = $especimenModel->buscarFamiliaAsc(
            $_POST['busqueda'],
            $_POST['numero']
        );

        header('Content-Type: application/json');
        echo json_encode($lista);
        exit;
    }

    public function buscarSubFamiliaAsc()
    {
        include 'model/TaxonomiaModel.php';
        $especimenModel = new TaxonomiaModel();

        $lista = $especimenModel->buscarSubFamiliaAsc(
            $_POST['busqueda'],
            $_POST['numero']
        );

        header('Content-Type: application/json');
        echo json_encode($lista);
        exit;
    }

    public function buscarOrdenesDesc()
    {
        include 'model/TaxonomiaModel.php';
        $especimenModel = new TaxonomiaModel();

        $lista = $especimenModel->buscarOrdenesDesc(
            $_POST['busqueda'],
            $_POST['numero']
        );

        header('Content-Type: application/json');
        echo json_encode($lista);
        exit;
    }

    public function buscarFamiliaDesc()
    {
        include 'model/TaxonomiaModel.php';
        $especimenModel = new TaxonomiaModel();

        $lista = $especimenModel->buscarFamiliaDesc(
            $_POST['busqueda'],
            $_POST['numero']
        );

        header('Content-Type: application/json');
        echo json_encode($lista);
        exit;
    }

    public function buscarSubFamiliaDesc()
    {
        include 'model/TaxonomiaModel.php';
        $especimenModel = new TaxonomiaModel();

        $lista = $especimenModel->buscarSubFamiliaDesc(
            $_POST['busqueda'],
            $_POST['numero']
        );

        header('Content-Type: application/json');
        echo json_encode($lista);
        exit;
    }


    public function actualizarTaxonomiaEspecie()
    {
        include 'model/TaxonomiaModel.php';
        $especimenModel = new TaxonomiaModel();

        $lista = $especimenModel->actualizarTaxonomiaEspecie(
            $_POST['genero'],
            $_POST['especie']
        );

        header('Content-Type: application/json');
        echo json_encode($lista);
        exit;
    }
}
