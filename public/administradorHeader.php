<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Laboratorio entomologia</title>
    <meta name="description" content="Laboratorio Entomología">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="public/css/estilosSAAdmin.css" rel="stylesheet" type="text/css" />
    <script src="public/js/jquery.js"></script>
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
                <li><a class="nav-menu-link nav-link" href="?controlador=Index&accion=mostrar">Inicio</a></li>
                <li><a class="nav-menu-link nav-link" href="?controlador=Index&accion=mostrarhistorialActividad">Actividades</a></li>
                <li><a class="nav-menu-link nav-link" href="?controlador=Index&accion=mostrarRegistro">Registro de taxonomia</a></li>
                <li><a class="nav-menu-link nav-link" href="?controlador=Index&accion=mostrarActualizarTaxonomia">Actualizar taxonomia</a></li>
                <li><a class="nav-menu-link nav-link" href="?controlador=Index&accion=mostrarRegistroEspecimen">Registro especimen</a></li>
                <li><a class="nav-menu-link nav-link" href="?controlador=Usuario&accion=mostrarPlantas">Plantas</a></li>
                <li><a class="nav-menu-link nav-link" href="?controlador=Usuario&accion=mostrarEspecimenGenero">Buscar especimen genero</a></li>
                <li><a class="nav-menu-link nav-link" href="?controlador=Usuario&accion=mostrarEspecimenEspecie">Buscar especimen especie</a></li>
                <li><a class="nav-menu-link nav-link" href="?controlador=Usuario&accion=mostrarRegistrarUsuario">Agregar Usuario</a></li>
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