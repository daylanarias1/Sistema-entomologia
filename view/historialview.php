<?php
include 'public/clienteHeader.php';
?>

<main>
    <h1>Historial</h1>
    <div class="divTabla">
        <table class="tablahisotir">
            <thead>
                <tr>
                    <th>Generos o especies</th>
                    <th>Fecha</th>
                    <th>Ver</th>
                </tr>
            </thead>
            <tbody id="cuerpo">
                <?php
                foreach ($vars['lista'] as $parque) {
                ?>
                    <tr>
                        <td><?php echo $parque[1]; ?></td>
                        <td><?php echo $parque[0]; ?></td>
                        <td>
                            <input type="hidden" name="fecha" value="<?php echo $parque[0]; ?>">
                            <button onclick="verEspecimenesHistorial('<?php echo $parque[0]; ?>'); abrirModalRegistrar('myModal1')" type="submit" class="btn-principal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                <?php
                } //foreach
                ?>

            </tbody>
        </table>
    </div>


    <div id="paginationContainer">
        <button id="prevButton" onclick="previousPageHistorial()">Anterior</button>
        <button id="nextButton" onclick="nextPageHistorial()">Siguiente</button>
    </div>

</main>

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


<script>
    var currentPage = 1;

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
            url: "?controlador=Usuario&accion=verHistorial",
            data: form_data,
            dataType: "json",
            success: function(respuesta) {
                var tabla = $("table");
                if (respuesta.lista[0].username === null) {
                    if (currentPage === 1) {

                        tabla.empty();
                        tabla.append("No hay registros");
                    } else {
                        Swal.fire({
                            icon: 'info',
                            title: 'No hay mas registros'
                        })
                        currentPage = currentPage - 1;
                        return;
                    }
                }
                tabla.empty();
                tabla.append(`
    <thead>
        <tr>
            <th>Género o especie</th>
            <th>Fecha</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody id="cuerpo">
    </tbody>
`);

                respuesta.lista.forEach(parque => {
                    tabla.find('#cuerpo').append(`
        <tr>
            <td>${parque.nombres}</td>
            <td>${parque.fecha}</td>
            <td>
                <input type="hidden" name="fecha" value="${parque.fecha}">
                <button class="btn-principal" onclick="verEspecimenesHistorial('${parque.fecha}'); abrirModalRegistrar('myModal1')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                    </svg>
                </button>
            </td>
        </tr>
    `);
                });

            }
        });

    }

    function verEspecimenesHistorial(fecha) {

        var form_data = {
            fecha: fecha
        };

        $.ajax({
            type: "POST",
            url: "?controlador=Especimen&accion=especimenesHistorial",
            data: form_data,
            dataType: "json",
            success: function(response) {
                if (response.length === 0 || response[0].username === null) {
                    alert('No se encuentran registros')
                } else {
                    generarTablaEspecimenesHistoril(response);
                }
            }
        });

    }




    function generarTablaEspecimenesHistoril(response) {
        var tabla = '<table>' +
            '<tr>' +
            '<th>Imagen</th>' +
            '<th>Ubicacion</th>' +
            '<th>Accion</th>' +
            '</tr>';
        for (var i = 0; i < response.length; i++) {
            var especimen = response[i];
            var rutaImagen;
            if (especimen.ruta_imagen !== null) {
                rutaImagen = especimen.ruta_imagen.replace(/\\/g, '').replace(/"/g, '');
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
            console.log()
        }

        tabla += '</table>';

        var tbody = document.getElementById("tablaEspecimenes");
        tbody.innerHTML = tabla;
    }

    var images = [];
    var slideIndex = 0;

    const showSlides = () => document.getElementById("imagen").src = images[slideIndex];
    const plusSlides = n => {
        slideIndex = (slideIndex + n + images.length) % images.length;
        showSlides();
    };

    showSlides();
</script>


<?php
include_once './public/footerCliente.php';
?>