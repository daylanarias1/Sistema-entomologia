<?php
include 'public/clienteHeader.php';
?>

<main>
    <h1>Busqueda general</h1>
    <div>
        <form id="formulario">
            <input type="text" id="busqueda-general" placeholder="Buscar" required>
            <button type="submit">Buscar</button>
        </form>
        <div class="RBT-GENERAL">
            <input type="radio" name="grupo1" id="radioOrden" checked>
            <label for="radioOrden">Orden</label>

            <input type="radio" name="grupo1" id="radioFamilia">
            <label for="radioFamilia">Familia</label>

            <input type="radio" name="grupo1" id="radioSubFamilia">
            <label for="radioSubFamilia">Sub familia</label>
        </div>
        <div>
            <input type="radio" name="grupo2" id="radioAscendente" checked onclick="buscar()">
            <label for="radioAscendente">Ascendente</label>
            <div id="numeroPaginas">

            </div>
            <input type="radio" name="grupo2" id="radioDescendente" onclick="buscar()">
            <label for="radioDescendente">Descendente</label>
        </div>
    </div>

    <div id="resultado">

    </div>

    <div id="paginationContainer">
        <button id="prevButton" disabled onclick="previousPageHistorial()">Anterior</button>
        <button id="nextButton" disabled onclick="nextPageHistorial()">Siguiente</button>
    </div>

    <button class="back"><a href="?controlador=Index&accion=mostrar">Regresar</a></button>

</main>

<script>
    var currentPage = 1;
    var totalPage = 1;

    var busqueda = '';

    function previousPageHistorial() {
        if (currentPage > 1) {
            currentPage = currentPage - 1;
            buscar();
        }
    }

    function nextPageHistorial() {
        currentPage = currentPage + 1;
        buscar();
    }

    $(document).ready(function() {
        $('#formulario').submit(function(event) {
            event.preventDefault();
            currentPage = 1;
            if ($('#radioOrden').is(':checked')) {
                busqueda = 'orden';
            } else if ($('#radioFamilia').is(':checked')) {
                busqueda = 'familia';
            } else {
                busqueda = 'subFamilia';
            }
            buscar();
        });
    });

    function buscar() {

        var form_data = {
            busqueda: $('#busqueda-general').val(),
            numero: currentPage
        };

        if (busqueda === 'orden') {

            if ($('#radioAscendente').is(':checked')) {
                $.ajax({
                    type: "POST",
                    url: "?controlador=Taxonomia&accion=buscarOrdenesAsc",
                    data: form_data,
                    dataType: "json",
                    success: function(response) {
                        if (response.length === 0 || response[0].username === null) {
                            if (currentPage !== 1) {
                                currentPage = currentPage - 1;
                                alert('No mas registros')
                            } else {
                                alert('No se encuentran registros')
                            }

                        } else {
                            ordenesT(response);
                            document.getElementById("prevButton").disabled = false;
                            document.getElementById("nextButton").disabled = false;
                        }
                    }
                });
            } else {
                $.ajax({
                    type: "POST",
                    url: "?controlador=Taxonomia&accion=buscarOrdenesDesc",
                    data: form_data,
                    dataType: "json",
                    success: function(response) {
                        if (response.length === 0 || response[0].username === null) {
                            if (currentPage !== 1) {
                                currentPage = currentPage - 1;
                                alert('No mas registros')
                            } else {
                                alert('No se encuentran registros')
                            }

                        } else {
                            ordenesT(response);
                            document.getElementById("prevButton").disabled = false;
                            document.getElementById("nextButton").disabled = false;
                        }
                    }
                });
            }
        } else if (busqueda === 'familia') {


            if ($('#radioAscendente').is(':checked')) {
                $.ajax({
                    type: "POST",
                    url: "?controlador=taxonomia&accion=buscarFamiliaAsc",
                    data: form_data,
                    dataType: "json",
                    success: function(response) {
                        if (response.length === 0 || response[0].username === null) {
                            if (currentPage !== 1) {
                                currentPage = currentPage - 1;
                                alert('No mas registros')
                            } else {
                                alert('No se encuentran registros')
                            }

                        } else {
                            ordenesF(response);
                            document.getElementById("prevButton").disabled = false;
                            document.getElementById("nextButton").disabled = false;
                        }
                    }
                });
            } else {
                $.ajax({
                    type: "POST",
                    url: "?controlador=taxonomia&accion=buscarFamiliaDesc",
                    data: form_data,
                    dataType: "json",
                    success: function(response) {
                        if (response.length === 0 || response[0].username === null) {
                            if (currentPage !== 1) {
                                currentPage = currentPage - 1;
                                alert('No mas registros')
                            } else {
                                alert('No se encuentran registros')
                            }

                        } else {
                            ordenesF(response);
                            document.getElementById("prevButton").disabled = false;
                            document.getElementById("nextButton").disabled = false;
                        }
                    }
                });
            }

        } else {

            if ($('#radioAscendente').is(':checked')) {
                $.ajax({
                    type: "POST",
                    url: "?controlador=taxonomia&accion=buscarSubFamiliaAsc",
                    data: form_data,
                    dataType: "json",
                    success: function(response) {
                        if (response.length === 0 || response[0].username === null) {
                            if (currentPage !== 1) {
                                currentPage = currentPage - 1;
                                alert('No mas registros')
                            } else {
                                alert('No se encuentran registros')
                            }

                        } else {
                            ordenesS(response);
                            document.getElementById("prevButton").disabled = false;
                            document.getElementById("nextButton").disabled = false;
                        }
                    }
                });
            } else {
                $.ajax({
                    type: "POST",
                    url: "?controlador=taxonomia&accion=buscarSubFamiliaDesc",
                    data: form_data,
                    dataType: "json",
                    success: function(response) {
                        if (response.length === 0 || response[0].username === null) {
                            if (currentPage !== 1) {
                                currentPage = currentPage - 1;
                                alert('No mas registros')
                            } else {
                                alert('No se encuentran registros')
                            }

                        } else {
                            ordenesS(response);
                            document.getElementById("prevButton").disabled = false;
                            document.getElementById("nextButton").disabled = false;
                        }
                    }
                });
            }
        }
    }

    function ordenesT(respuesta) {
        var tabla = '<table>' +
            '<tr>' +
            '<th>Orden</th>' +
            '<th>Familias</th>' +
            '<th>Subfamilias</th>' +
            '<th>Géneros</th>' +
            '<th>Especies</th>' +
            '</tr>';

        for (var i = 0; i < respuesta.length; i++) {
            tabla += '<tr>' +
                '<td>' + respuesta[i].orden + '</td>' +
                '<td>' + respuesta[i].numero_familias + '</td>' +
                '<td>' + respuesta[i].numero_subfamilias + '</td>' +
                '<td>' + respuesta[i].numero_generos + '</td>' +
                '<td>' + respuesta[i].numero_especies + '</td>' +
                '</tr>';
        }

        tabla += '</table>';

        document.getElementById('resultado').innerHTML = tabla;
    }

    function ordenesF(respuesta) {
        var tabla = '<table>' +
            '<tr>' +
            '<th>Familia</th>' +
            '<th>Subfamilias</th>' +
            '<th>Géneros</th>' +
            '<th>Especies</th>' +
            '</tr>';

        for (var i = 0; i < respuesta.length; i++) {
            tabla += '<tr>' +
                '<td>' + respuesta[i].familia + '</td>' +
                '<td>' + respuesta[i].numero_subfamilias + '</td>' +
                '<td>' + respuesta[i].numero_generos + '</td>' +
                '<td>' + respuesta[i].numero_especies + '</td>' +
                '</tr>';
        }

        tabla += '</table>';

        document.getElementById('resultado').innerHTML = tabla;
    }


    function ordenesS(respuesta) {
        var tabla = '<table>' +
            '<tr>' +
            '<th>Subfamilia</th>' +
            '<th>Géneros</th>' +
            '<th>Especies</th>' +
            '</tr>';

        for (var i = 0; i < respuesta.length; i++) {
            tabla += '<tr>' +
                '<td>' + respuesta[i].subfamilia + '</td>' +
                '<td>' + respuesta[i].numero_generos + '</td>' +
                '<td>' + respuesta[i].numero_especies + '</td>' +
                '</tr>';
        }

        tabla += '</table>';

        document.getElementById('resultado').innerHTML = tabla;
    }
</script>


<?php
include_once './public/footerCliente.php';
?>