<?php
include 'public/clienteHeader.php';
?>

<main>

    <script>
        var currentPage = 1;
    </script>

    <h1>Especimenes en el carrito</h1>

    <button onclick="limpiarCarrito()" class="btn-delete limpiar-carrito">Limpiar carrito <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-cart-fill" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </svg></button>

    <div id="divTabla">



    </div>

    <div id="paginationContainer">
        <button id="prevButton" onclick="previousPageHistorial()">Anterior</button>
        <button id="nextButton" onclick="nextPageHistorial()">Siguiente</button>
    </div>

    <script>
        function previousPageHistorial(id) {
            if (currentPage > 1) {
                currentPage = currentPage - 1;
                buscar();
            }
        }

        function nextPageHistorial(id) {
            currentPage = currentPage + 1;
            buscar();
        }

        function buscar() {

            var form_data = {
                numero: currentPage
            };

            $.ajax({
                type: "POST",
                url: "?controlador=Carrito&accion=listarUbicacionesCarrito",
                data: form_data,
                dataType: "json",
                success: function(respuesta) {
                    if (respuesta[0].username !== null) {
                        console.log(respuesta)
                        generarTablaEspecimenes(respuesta);
                    } else {
                        if (currentPage === 1) {
                            document.getElementById("divTabla").innerHTML = '';
                            document.getElementById("divTabla").appendChild(document.createElement("h1")).textContent = "El carrito está vacío";

                        } else {
                            Swal.fire({
                                icon: 'info',
                                title: 'No hay mas registros'
                            })
                            currentPage = currentPage - 1;
                        }
                    }
                }
            });

        }

        buscar()
    </script>


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
</main>


<script>
    var images = [];
    var slideIndex = 0;

    function limpiarCarrito() {

        $.ajax({
            type: "POST",
            url: "?controlador=Carrito&accion=limpiarCarrito",
            dataType: "json",
            success: function(response) {
                currentPage = 1;
                buscar();
            }
        });

    }
</script>


<?php
include_once './public/footerCliente.php';
?>

<script>
    function generarTablaEspecimenes(response) {
        var tabla = '<table>' +
            '<tr>' +
            '<th>Imagen</th>' +
            '<th>Ubicacion</th>' +
            '<th>Accion</th>' +
            '</tr>';
        for (var i = 0; i < response.length; i++) {
            var especimen = response[i];
            if (especimen.ruta_imagen !== null) {
                var rutaImagen = especimen.ruta_imagen.replace(/\\/g, '').replace(/"/g, '');
            }
            var imagen = '<img width="100px" height="100px" alt="Imagen especimen" src="' + rutaImagen + '">';
            tabla += '<tr>' +
                '<td>' + imagen + '</td>' +
                '<td>' + especimen.ubicacion_especimen + '</td>' +
                '<td><button onclick="detallesEspecimen(' + especimen.id_especimen + '); abrirModalRegistrar(\'myModal2\')" class="btn-success">' +
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 21" width="25" height="18" fill="none" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">' +
                '<path d="M13 7h9v2h-9zm0 8h9v2h-9zm3-4h6v2h-6zm-3 1L8 7v4H2v2h6v4z"/>' +
                '</svg>' +
                '</button></td>' +
                '</tr>';
        }

        tabla += '</table>';

        var tbody = document.getElementById("divTabla");
        tbody.innerHTML = tabla;
    }

    const showSlides = () => document.getElementById("imagen").src = images[slideIndex];
    const plusSlides = n => {
        slideIndex = (slideIndex + n + images.length) % images.length;
        showSlides();
    };

    showSlides();
</script>