<?php

class IndexController
{
    private $view;
    public function __construct()
    {
        $this->view = new View();
    } // constructor


    public function mostrar()
    {
        $this->view->show("indexView.php", NULL);
    } // mostrar

    public function mostrarLogin()
    {
        $this->view->show("loginView.php", NULL);
    } // mostrar

    public function mostrarLoginSA()
    {
        $this->view->show("loginSA.php", NULL);
    } // mostrar

    public function mostrarhistorialActividad()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $this->view->show("indexView.php");
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("historiaView.php", NULL);
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            }
        }
    } // mostrar

    public function mostrarRegistroEspecimen()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $this->view->show("indexView.php");
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'ADMIN' || $_SESSION['usuario_nombre_rol'] == 'SA') {
                $this->view->show("RegistrarEspecimenView.php", NULL);
            } else {
                $this->view->show("homeClienteView.php", NULL);
            }
        }
    } // mostrar

    public function mostrarRegistro()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $this->view->show("indexView.php");
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'ADMIN' || $_SESSION['usuario_nombre_rol'] == 'SA') {

                include 'model/TaxonomiaModel.php';
                $especimenModel = new TaxonomiaModel();

                $lista['lista'] = $especimenModel->listarOrden();
                $this->view->show("RegistrarTaxonomia.php", $lista);
            } else {
                $this->view->show("homeClienteView.php", NULL);
            }
        }
    } // mostrar

    public function mostrarActualizarTaxonomia()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $this->view->show("indexView.php");
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'ADMIN' || $_SESSION['usuario_nombre_rol'] == 'SA') {

                include 'model/TaxonomiaModel.php';
                $especimenModel = new TaxonomiaModel();

                $lista['lista'] = $especimenModel->listarOrden();
                $this->view->show("actualizarTaxonomia.php", $lista);
            } else {
                $this->view->show("homeClienteView.php", NULL);
            }
        }
    } // mostrar

    public function mostrarBusquedaPlanta()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("busquedaplanta.php");
            } else {
                $this->view->show("indexView.php");
            }
        }
    }

    public function mostrarBusquedaGeneral()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("busquedaGeneralView.php", NULL);
            } else {
                $data['mensaje'] = '';
                $this->view->show("indexView.php", $data);
            }
        }
    }

    public function mostrarVistosGenero()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("vistosGenero.php", NULL);
            } else {
                $data['mensaje'] = '';
                $this->view->show("indexView.php", $data);
            }
        }
    }

    public function mostrarVistosEspecie()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("vistosEspecie.php", NULL);
            } else {
                $data['mensaje'] = '';
                $this->view->show("indexView.php", $data);
            }
        }
    }

    public function mostrarBusquedaEspecie()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("BusquedaEspecieView.php", NULL);
            } else {
                $data['mensaje'] = '';
                $this->view->show("indexView.php", $data);
            }
        }
    }

    public function mostrarBusquedaGenero()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("BusquedaGeneroView.php", NULL);
            } else {
                $data['mensaje'] = '';
                $this->view->show("indexView.php", $data);
            }
        }
    }

    public function mostrarCarrito()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("carritoView.php", NULL);
            } else {
                $data['mensaje'] = '';
                $this->view->show("indexView.php", $data);
            }
        }
    }

    public function mostrarhistorial()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("indexView.php", NULL);
            } else {
                require 'model/UsuarioModel.php';
                $provinciaModel = new usuarioModel();
                $lista['lista'] = $provinciaModel->verHistorial($_SESSION['usuario_id'], 1);

                $this->view->show("historialview.php", $lista);
            }
        }
    }

    public function mostrarEspecimenEspecie()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("actualizarEspecimenEspecie.php", NULL);
            } else {
                $data['mensaje'] = '';
                $this->view->show("indexView.php", $data);
            }
        }
    }

    public function mostrarEspecimenGenero()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA' || $_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                $this->view->show("actualizarEspecimenGenero.php", NULL);
            } else {
                $data['mensaje'] = '';
                $this->view->show("indexView.php", $data);
            }
        }
    }

    public function mostrarRegistrarUsuario()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA') {
                return $this->view->show("AgregarUsuarioSA.php", NULL);
            } else if ($_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                return $this->view->show("AgregarUsuarioAdmin.php", NULL);
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            }
        }
    }

    public function mostrarPlantas()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'usuario') {
                $this->view->show("homeClienteView.php", NULL);
            } else {
                $this->view->show("plantasView.php");
            }
        }
    }

    public function mostrarVerUsuario()
    {
        session_start();
        if (!isset($_SESSION['usuario_nombre_rol'])) {
            $data['mensaje'] = '';
            $this->view->show("indexView.php", $data);
        } else {
            if ($_SESSION['usuario_nombre_rol'] == 'SA') {
                return $this->view->show("usuariosView.php", null);
            } else if ($_SESSION['usuario_nombre_rol'] == 'ADMIN') {
                return $this->view->show("homeAdministradorView.php", NULL);
            } else if ($_SESSION['usuario_nombre_rol'] == 'USER') {
                $this->view->show("homeClienteView.php", NULL);
            }
        }
    }
} // fin clase
