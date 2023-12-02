<?php
include 'public/clienteHeader.php';
?>

<main>
    <script>
        var images = [];
        var slideIndex = 0;
        var currentPage = 1;
    </script>
    <h1>Generos vistos</h1>

    <div id="resultado">

    </div>



    <div id="paginationContainer">
        <button id="prevButton" disabled onclick="previousPageHistorial()">Anterior</button>
        <button id="nextButton" disabled onclick="nextPageHistorial()">Siguiente</button>
    </div>

    <script>

    </script>

    <script>

    </script>
    <button class="back"><a href="?controlador=Index&accion=mostrar">Regresar</a></button>

</main>



<?php
include_once './public/footerCliente.php';
?>

</html>

<script>
    const showSlides = () => document.getElementById("imagen").src = images[slideIndex];
    const plusSlides = n => {
        slideIndex = (slideIndex + n + images.length) % images.length;
        showSlides();
    };

    showSlides();

    function previousPageHistorial(id) {
        if (currentPage > 1) {
            currentPage = currentPage - 1;
            buscarGeneroVistos();
        }
    }

    function nextPageHistorial(id) {
        currentPage = currentPage + 1;
        buscarGeneroVistos();
    }

    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 1000,
    })

    buscarGeneroVistos();

    function eliminarVistogenero(genero) {
        var parametros = {
            "genero": genero,
        };
        $.ajax({
            type: "POST",
            url: "?controlador=Carrito&accion=eliminarVistoGenero",
            data: parametros,
            dataType: "json",

            success: function(respuesta) {
                if (respuesta.mensaje !== null) {
                    Toast.fire({
                        icon: 'success',
                        title: 'genero eliminada de vistos'
                    });
                    buscarGeneroVistos();
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Ocurrio un error'
                    });
                }
            }
        });
    }

    function agregarCarritogenero(genero) {
        var parametros = {
            "genero": genero,
        };
        $.ajax({
            type: "POST",
            url: "?controlador=Carrito&accion=agregarAlCarritoGenero",
            data: parametros,
            dataType: "json",

            success: function(respuesta) {
                if (respuesta.mensaje !== null) {
                    Toast.fire({
                        icon: 'success',
                        title: 'genero agregada al carrito'
                    });
                    obtenerNumeroCarrito();
                    buscarGeneroVistos();
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Ocurrio un error'
                    });
                }
            }
        });
    }

    function eliminarCarritogenero(genero) {
        var parametros = {
            "genero": genero,
        };
        $.ajax({
            type: "POST",
            url: "?controlador=Carrito&accion=eliminarDelCarritoGenero",
            data: parametros,
            dataType: "json",

            success: function(respuesta) {
                if (respuesta.mensaje !== null) {
                    Toast.fire({
                        icon: 'success',
                        title: 'genero agregada al carrito'
                    });
                    obtenerNumeroCarrito();
                    buscarGeneroVistos();
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Ocurrio un error'
                    });
                }
            }
        });
    }
</script>