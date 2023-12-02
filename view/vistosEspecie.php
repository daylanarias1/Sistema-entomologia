<?php
include 'public/clienteHeader.php';
?>



<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 1000,
    })
</script>

<main>
    <script>
        var images = [];
        var slideIndex = 0;
        var currentPage = 1;
    </script>
    <h1>Especies vistos</h1>

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

</html>

<script>
    const showSlides = () => document.getElementById("imagen").src = images[slideIndex];
    const plusSlides = n => {
        slideIndex = (slideIndex + n + images.length) % images.length;
        showSlides();
    };

    showSlides();

    buscarEspecieVistos();

    function previousPageHistorial(id) {
        if (currentPage > 1) {
            currentPage = currentPage - 1;
            buscarEspecieVistos();
        }
    }

    function nextPageHistorial(id) {
        currentPage = currentPage + 1;
        buscarEspecieVistos();
    }

    function eliminarVistoEspecie(especie) {
        var parametros = {
            "especie": especie,
        };
        $.ajax({
            type: "POST",
            url: "?controlador=Carrito&accion=eliminarVistoEspecie",
            data: parametros,
            dataType: "json",

            success: function(respuesta) {
                if (respuesta.mensaje !== null) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Especie eliminada de vistos'
                    });
                    buscarEspecieVistos();
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Ocurrio un error'
                    });
                }
            }
        });
    }


    function agregarCarritoEspecie(especie) {
        var parametros = {
            "especie": especie,
        };
        $.ajax({
            type: "POST",
            url: "?controlador=Carrito&accion=agregarAlCarritoEspecie",
            data: parametros,
            dataType: "json",

            success: function(respuesta) {
                if (respuesta.mensaje !== null) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Especie agregada al carrito'
                    });
                    obtenerNumeroCarrito();
                    buscarEspecieVistos();
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Ocurrio un error'
                    });
                }
            }
        });
    }

    function eliminarCarritoEspecie(especie) {
        var parametros = {
            "especie": especie,
        };
        $.ajax({
            type: "POST",
            url: "?controlador=Carrito&accion=eliminarDelCarritoEspecie",
            data: parametros,
            dataType: "json",

            success: function(respuesta) {
                if (respuesta.mensaje !== null) {
                    buscarEspecieVistos();
                    Toast.fire({
                        icon: 'success',
                        title: 'Especie agregada al carrito'
                    });
                    obtenerNumeroCarrito();
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