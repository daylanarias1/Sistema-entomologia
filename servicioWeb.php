<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET['solicitud'] == "Genero") {
        if (isset($_GET['nombre']) && isset($_GET['pagina'])) {
            require 'libs/configuration.php';
            require 'model/TaxonomiaModel.php';
            $especimenModel = new TaxonomiaModel();
            $datos = $especimenModel->buscarGeneros($_GET['nombre'], $_GET['pagina']);
            header("HTTP/1.1 200 OK");
            echo json_encode($datos);
        } else {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode("Falta el parámetro 'nombre' o 'pagina'");
        }
    } else if ($_GET['solicitud'] == "Especie") {
        if (isset($_GET['nombre']) && isset($_GET['pagina'])) {
            require 'libs/configuration.php';
            require 'model/TaxonomiaModel.php';
            $especimenModel = new TaxonomiaModel();
            $datos = $especimenModel->buscarEspecies($_GET['nombre'], $_GET['pagina']);
            header("HTTP/1.1 200 OK");
            echo json_encode($datos);
        } else {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode("Falta el parámetro 'nombre' o 'pagina'");
        }
    } else if ($_GET['solicitud'] == "OrdenesAsc") {
        if (isset($_GET['orden']) && isset($_GET['numero'])) {
            require 'libs/configuration.php';
            require 'model/TaxonomiaModel.php';
            $especimenModel = new TaxonomiaModel();
            $datos = $especimenModel->buscarOrdenesAsc($_GET['orden'], $_GET['numero']);
            header("HTTP/1.1 200 OK");
            echo json_encode($datos);
        } else {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode("Falta el parámetro 'orden' o 'numero'");
        }
    } else if ($_GET['solicitud'] == "FamiliaAsc") {
        if (isset($_GET['familia']) && isset($_GET['numero'])) {
            require 'libs/configuration.php';
            require 'model/TaxonomiaModel.php';
            $especimenModel = new TaxonomiaModel();
            $datos = $especimenModel->buscarFamiliaAsc($_GET['familia'], $_GET['numero']);
            header("HTTP/1.1 200 OK");
            echo json_encode($datos);
        } else {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode("Falta el parámetro 'familia' o 'numero'");
        }
    } else if ($_GET['solicitud'] == "SubFamiliaAsc") {
        if (isset($_GET['subfamilia']) && isset($_GET['numero'])) {
            require 'libs/configuration.php';
            require 'model/TaxonomiaModel.php';
            $especimenModel = new TaxonomiaModel();
            $datos = $especimenModel->buscarSubFamiliaAsc($_GET['subfamilia'], $_GET['numero']);
            header("HTTP/1.1 200 OK");
            echo json_encode($datos);
        } else {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode("Falta el parámetro 'subfamilia' o 'numero'");
        }
    } else if ($_GET['solicitud'] == "OrdenesDesc") {
        if (isset($_GET['orden']) && isset($_GET['numero'])) {
            require 'libs/configuration.php';
            require 'model/TaxonomiaModel.php';
            $especimenModel = new TaxonomiaModel();
            $datos = $especimenModel->buscarOrdenesDesc($_GET['orden'], $_GET['numero']);
            header("HTTP/1.1 200 OK");
            echo json_encode($datos);
        } else {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode("Falta el parámetro 'orden' o 'numero'");
        }
    } else if ($_GET['solicitud'] == "FamiliaDesc") {
        if (isset($_GET['familia']) && isset($_GET['numero'])) {
            require 'libs/configuration.php';
            require 'model/TaxonomiaModel.php';
            $especimenModel = new TaxonomiaModel();
            $datos = $especimenModel->buscarFamiliaDesc($_GET['familia'], $_GET['numero']);
            header("HTTP/1.1 200 OK");
            echo json_encode($datos);
        } else {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode("Falta el parámetro 'familia' o 'numero'");
        }
    } else if ($_GET['solicitud'] == "SubFamiliaDesc") {
        if (isset($_GET['subfamilia']) && isset($_GET['numero'])) {
            require 'libs/configuration.php';
            require 'model/TaxonomiaModel.php';
            $especimenModel = new TaxonomiaModel();
            $datos = $especimenModel->buscarSubFamiliaDesc($_GET['subfamilia'], $_GET['numero']);
            header("HTTP/1.1 200 OK");
            echo json_encode($datos);
        } else {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode("Falta el parámetro 'subfamilia' o 'numero'");
        }
    } else if ($_GET['solicitud'] == "Especimen") {
        if (isset($_GET['especimen'])) {
            require 'libs/configuration.php';
            require 'model/EspecimenModel.php';
            $especimenModel = new EspecimenModel();
            $datos = $especimenModel->getEspecimen($_GET['especimen']);
            header("HTTP/1.1 200 OK");
            echo json_encode($datos);
        } else {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode("Falta el parámetro 'especimen'");
        }
    } else if ($_GET['solicitud'] == "EspecimenEspecie") {
        if (isset($_GET['especieId'])) {
            require 'libs/configuration.php';
            require 'model/EspecimenModel.php';
            $especimenModel = new EspecimenModel();
            $datos = $especimenModel->especimenEspecie($_GET['especieId']);
            header("HTTP/1.1 200 OK");
            echo json_encode($datos);
        } else {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode("Falta el parámetro 'especieId'");
        }
    } else if ($_GET['solicitud'] == "EspecimenGenero") {
        if (isset($_GET['generoId'])) {
            require 'libs/configuration.php';
            require 'model/EspecimenModel.php';
            $especimenModel = new EspecimenModel();
            $datos = $especimenModel->especimenGenero($_GET['generoId']);
            header("HTTP/1.1 200 OK");
            echo json_encode($datos);
        } else {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode("Falta el parámetro 'generoId'");
        }
    } else if ($_GET['solicitud'] == "Planta") {
        if (isset($_GET['nombre']) && isset($_GET['pagina'])) {
            require 'libs/configuration.php';
            require 'model/TaxonomiaModel.php';
            $especimenModel = new TaxonomiaModel();
            $datos = $especimenModel->buscarPlantas($_GET['nombre'], $_GET['pagina']);
            header("HTTP/1.1 200 OK");
            echo json_encode($datos);
        } else {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode("Falta el parámetro 'nombre' o 'pagina'");
        }
    } else {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode("Solicitud inválida");
    }
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    echo json_encode("Método no permitido");
}
