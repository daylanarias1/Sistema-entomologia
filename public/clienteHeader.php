<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Laboratorio entomologia</title>
    <meta name="description" content="Laboratorio Entomología">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="public/css/estilosUser.css" rel="stylesheet" type="text/css" />
    <script src="public/js/jquery.js" type="text/javascript"></script>
</head>

<body>
    <div class="container">

        <nav class="nav">
            <button class="nav-toggle" aria-label="Abrir menú">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-list" viewBox="0 0 16 10">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg>
            </button>
            <ul class="nav-menu">
                <li><a class="nav-menu-link nav-link" href="?controlador=Index&accion=mostrar">Modulo Cliente</a></li>
                <li><a class="nav-menu-link nav-link" href="?controlador=Index&accion=mostrarBusquedaGeneral">
                        Busqueda General
                    </a></li>
                <li><a class="nav-menu-link nav-link" href="?controlador=Index&accion=mostrarVistosGenero">
                        Vistos genero
                    </a></li>
                <li><a class="nav-menu-link nav-link" href="?controlador=Index&accion=mostrarVistosEspecie">
                        Vistos especie
                    </a></li>
                <li><a class="nav-menu-link nav-link" href="?controlador=Index&accion=mostrarBusquedaGenero">
                        Busqueda Genero
                    </a></li>
                <li><a class="nav-menu-link nav-link" href="?controlador=Index&accion=mostrarBusquedaEspecie">
                        Busqueda especie
                    </a></li>
                <li><a class="nav-menu-link nav-link" href="?controlador=Index&accion=mostrarhistorial">
                        Historial
                    </a></li>
                <li><a class="nav-menu-link nav-link" href="?controlador=Index&accion=mostrarBusquedaPlanta">
                        Busqueda plata
                    </a></li>
                <li> <a class="nav-menu-link nav-link" href="#" id="btnVerCarrito" class="product-grid__btn btn-default" data-btn-action="add-btn-cart" data-modal="#jsModalCarrito">

                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />
                        </svg>
                        <span id="cartcount"></span>
                    </a></li>
                <li><a class="nav-menu-link nav-link" href="?controlador=Usuario&accion=cerrarSession">Cerrar Session</a></li>
            </ul>
        </nav>


        <script>
            document.querySelector(".nav-toggle").addEventListener("click", () => {
                const navMenu = document.querySelector(".nav-menu");
                navMenu.classList.toggle("nav-menu_visible");
                navMenu.querySelectorAll("a").forEach(link => link.addEventListener("click", () => navMenu.classList.remove("nav-menu_visible")));
            });
        </script>


        <div class="modal_carrito" id="jsModalCarrito">
            <div class="modal_carrito__container">

                <button id="verCarrito" type="button" class="modal_carrito__close fa-solid fa-xmark jsModalClose">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 16 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.146 2.854a.5.5 0 0 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" style="pointer-events: none;" />
                    </svg>
                </button>


                <div class="modal_carrito__info">
                    <div class="modal_carrito__body">
                        <h1 class="sepadardor">Generos</h1>
                        <div class="modal_carrito_body_genero">
                        </div>

                        <h1 class="sepadardor">Especies</h1>
                        <div class="modal_carrito_body_especie">

                        </div>

                    </div>
                    <div class="modal_carrito__footer">
                        <button class="btn-principal" id="listarUbicaciones"><a href="?controlador=Index&accion=mostrarCarrito">Listar ubicaciones</a></button>
                    </div>
                </div>
            </div>
        </div>


        <div id="myModal1" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="divFormulario">
                    <h1>Lista de Especimenes</h1>
                    <div id="tablaEspecimenes">

                    </div>
                </div>
            </div>
        </div>

        <div id="myModal2" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="divFormulario">
                    <h1>Detalles del especimen</h1>
                    <div id="detallesEspecimen">
                        <div class="slideshow-container">
                            <div class="mySlidesCarrosel fade">
                                <a class="prevCarrosel" onclick="plusSlides(-1)">&#10094;</a>
                                <img id="imagen" src="" width="100px" height="100px">
                                <a class="nextCarrosel" onclick="plusSlides(1)">&#10095;</a>
                            </div>
                        </div>
                        <div class="y" id="detallesEspecimenes">

                        </div>
                    </div>
                </div>
            </div>
        </div>