<?php
include 'public/clienteHeader.php';
?>

<main>
    <script>
        var images = [];
        var slideIndex = 0;
        var currentPageEspecimenes = 1;
    </script>
    <h1>Busqueda Genero</h1>
    <div>
        <form id="formulario">
            <input type="text" id="busqueda" placeholder="Buscar" required>
            <button type="submit">Buscar</button>
        </form>
    </div>

    <div id="resultado">

    </div>

    <div id="paginationContainer">
        <button id="prevButton" disabled onclick="previousPageHistorial()">Anterior</button>
        <button id="nextButton" disabled onclick="nextPageHistorial()">Siguiente</button>
    </div>

    <button class="back"><a href="?controlador=Index&accion=mostrar">Regresar</a></button>

</main>



<?php
include_once './public/footerCliente.php';
?>

<script>
    const showSlides = () => document.getElementById("imagen").src = images[slideIndex];
    const plusSlides = n => {
        slideIndex = (slideIndex + n + images.length) % images.length;
        showSlides();
    };

    showSlides();

    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 1000,
    })

    var currentPage = 1;
    $(document).ready(function() {
        $('#formulario').submit(function(event) {
            event.preventDefault();
            currentPage = 1;
            buscarGenero();
        });
    });

    buscarGenero();

    function previousPageHistorial() {
        if (currentPage > 1) {
            currentPage = currentPage - 1;
            buscarGenero();
        }
    }

    function nextPageHistorial() {
        currentPage = currentPage + 1;
        buscarGenero();
    }








    function previousPageHistorialEspecimen() {
        if (currentPageEspecimenes > 1) {
            currentPageEspecimenes = currentPageEspecimenes - 1;
            buscarEspecimen();
        }
    }
    

    function nextPageHistorialEspecimen() {
        currentPageEspecimenes = currentPageEspecimenes + 1;
        buscarEspecimen();
    }



</script>