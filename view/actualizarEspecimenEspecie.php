<?php
if ($_SESSION['usuario_nombre_rol'] == 'SA') {
    include 'public/administradorGeneralHeader.php';
} //menu con funcionalidades del administrador general

if ($_SESSION['usuario_nombre_rol'] == 'ADMIN') {
    include 'public/administradorHeader.php';
} //menu con funcionalidades del administrador
?>

<script>
    var images = [];
    var slideIndex = 0;
</script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 1000,
    })
    var idEspecimenSeleccionado;
</script>

<main>
    <h1>Busqueda Especimen especie</h1>
    <div>
        <form id="formulario">
            <input type="text" id="busqueda" placeholder="Buscar" required>
            <button type="submit">Buscar</button>
        </form>
    </div>

    <div id="resultados">

    </div>


    <script>
        var currentPage = 1;
        $(document).ready(function() {
            $('#formulario').submit(function(event) {
                event.preventDefault();
                currentPage = 1;
                buscar();
            });
        });
        var form_data = {
            especie: $('#busqueda').val(),
            numero: currentPage
        };

        $.ajax({
            type: "POST",
            url: "?controlador=Especimen&accion=buscarEspecimenesEspecie",
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
                    especieT(response);
                    document.getElementById("prevButton").disabled = false;
                    document.getElementById("nextButton").disabled = false;
                }
            }
        });

        function buscar() {

            var form_data = {
                especie: $('#busqueda').val(),
                numero: currentPage
            };

            $.ajax({
                type: "POST",
                url: "?controlador=Especimen&accion=buscarEspecimenesEspecie",
                data: form_data,
                dataType: "json",
                success: function(response) {
                    if (response.length === 0 || response[0].especimenes === null) {
                        if (currentPage !== 1) {
                            currentPage = currentPage - 1;
                            alert('No mas registros')
                        } else {
                            alert('No se encuentran registros')
                        }
                    } else {
                        especieT(response);
                        document.getElementById("prevButton").disabled = false;
                        document.getElementById("nextButton").disabled = false;
                    }
                }
            });
        }

        function confirmarEliminar(idEspecimen) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción eliminará el especimen permanentemente.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    eliminarEspecimen(idEspecimen);
                }
            });
        }

        // Función para eliminar el especimen
        function eliminarEspecimen(idEspecimen) {

            let parametros = {
                "especimen": idEspecimen
            };
            $.ajax({
                data: parametros,
                url: '?controlador=Especimen&accion=eliminarEspecimen',
                type: 'post',
                success: function(response) {
                    if (response.mensaje !== null) {
                        Swal.fire({
                            title: 'Eliminado',
                            text: 'El especimen ha sido eliminado exitosamente.',
                            icon: 'success'
                        });
                        buscar();
                    }
                }
            });

        }






        function detallesEspecimen(id) {

            var form_data = {
                especimen: id
            };

            $.ajax({
                type: "POST",
                url: "?controlador=Especimen&accion=getEspecimen",
                data: form_data,
                dataType: "json",
                success: function(response) {
                    if (response.length === 0 || response[0].username === null) {
                        Swal.fire({
                            icon: 'error',
                            title: 'No hay mas registros'
                        })
                    } else {
                        especimen(response[0]);
                    }
                }
            });

        }

        function especimen(response) {

            images = []

            var imagenesComa = response.imagenes_especimen.split(',');
            for (let index = 0; index < imagenesComa.length; index++) {
                var rutaImagen = imagenesComa[index].replace(/\\/g, '').replace(/"/g, '');
                images.push(rutaImagen)
            }

            var tabla = '<div>' +
                '<h1>Ubicacion de Taxonomia</h1>' +
                `<p>Orden: ${response.nombre_orden}</p>` +
                `<p>Familia: ${response.nombre_familia}</p>` +
                `<p>Sub familia: ${response.nombre_subfamilia}</p>` +
                `<p>Genero: ${response.nombre_genero}</p>` +
                `<p>Especie: ${response.nombre_especie}</p>`
            tabla += '</div>';

            tabla += '<div>' +
                '<h1>Ubicacion de recoleccion</h1>' +
                `<p>Pais: ${response.pais}</p>` +
                `<p>Provincia: ${response.provincia}</p>` +
                `<p>Canton: ${response.canton}</p>` +
                `<p>Distrito: ${response.distrito}</p>`
            tabla += '</div>';

            tabla += '<div>' +
                '<h1>Geolocalizacion</h1>' +
                `<p>Latitud: ${response.latitud}</p>` +
                `<p>Longitud: ${response.longitud}</p>`
            tabla += '</div>';

            tabla += '<div>' +
                '<h1>Recolector</h1>' +
                `<p>Recolecto: ${response.recolector_inicial_nombre + ', ' + response.recolector_primer_apellido}</p>`
            tabla += '</div>';

            tabla += '<div>' +
                '<h1>Plantas hosdedadoras</h1>' +
                `<p>${response.plantas_asociadas}</p>`
            tabla += '</div>';

            tabla += '<div>' +
                '<h1>Ubicacion del especimen</h1>' +
                `<p>${response.ubicacion_especimen}</p>`
            tabla += '</div>';

            var divTabla = document.getElementById("detallesEspecimenes");
            divTabla.innerHTML = tabla;

            showSlides();
        }

        function especieT(response) {
            var tabla = '<table>' +
                '<tr>' +
                '<th>idEspecimen</th>' +
                '<th>Acciones</th>' +
                '</tr>';

            for (var i = 0; i < response.length; i++) {

                var rutaImagen;
                if (response[i].ruta_imagen !== null) {
                    rutaImagen = response[i].ruta_imagen.replace(/\\/g, '').replace(/"/g, '');
                }
                var imagen = '<img width="100px" height="100px" alt="Imagem especimen" src="' + rutaImagen + '">';

                tabla += '<tr>' +
                    '<td>' + imagen + '</td>' +
                    '<td>';


                tabla += '<button onclick="detallesEspecimen(' + response[i].id_especimen + '); abrirModalRegistrar(\'myModal4\')" class="btn-update">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="white" class="bi bi-info-lg" viewBox="0 0 16 16">' +
                    '<path d="m9.708 6.075-3.024.379-.108.502.595.108c.387.093.464.232.38.619l-.975 4.577c-.255 1.183.14 1.74 1.067 1.74.72 0 1.554-.332 1.933-.789l.116-.549c-.263.232-.65.325-.905.325-.363 0-.494-.255-.402-.704l1.323-6.208Zm.091-2.755a1.32 1.32 0 1 1-2.64 0 1.32 1.32 0 0 1 2.64 0Z"/>' +
                    '</svg>' +
                    '</button>';


                tabla += '<button onclick="guardarIdEspecimen(' + response[i].id_especimen + '); abrirModalRegistrar(\'myModal1\')" class="btn-update">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="white" class="bi bi-box" viewBox="0 0 16 16">' +
                    '<path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>' +
                    '</svg>' +
                    '</button>';

                tabla += '<button onclick="guardarIdEspecimen(' + response[i].id_especimen + '); abrirModalRegistrar(\'myModal2\')" class="btn-update">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="white" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">' +
                    '<path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>' +
                    '</svg>' +
                    '</button>';

                tabla += '<button onclick="guardarIdEspecimen(' + response[i].id_especimen + '); abrirModalRegistrar(\'myModal3\')" class="btn-update">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="white" class="bi bi-diagram-3" viewBox="0 0 16 16">' +
                    '<path fill-rule="evenodd" d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V6A1.5 1.5 0 0 1 6 4.5v-1zM8.5 5a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1zM0 11.5A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm4.5.5A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm4.5.5a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"/>' +
                    '</svg>' +
                    '</button>';

                tabla += '<button onclick="confirmarEliminar(' + response[i].id_especimen + ')" class="btn-delete">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="white" class="bi bi-trash" viewBox="0 0 16 16">' +
                    '<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>' +
                    '<path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>' +
                    '</svg>' +
                    '</button>';


                tabla += '</td>';
            }

            tabla += '</table>';

            document.getElementById('resultados').innerHTML = tabla;
        }


        const showSlides = () => document.getElementById("imagen").src = images[slideIndex];
        const plusSlides = n => {
            slideIndex = (slideIndex + n + images.length) % images.length;
            showSlides();
        };

        showSlides();
    </script>

    <div id="myModal4" class="modal">
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


    <!-- ---------------MODALES------------------ -->


    <div id="myModal1" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>

            <div class="divFormulario">
                <div class="radioButtons">
                    <div>
                        <input type="radio" name="tipo-usuario" value="gaveta" id="radioGaveta" checked>
                        <label for="radioGaveta">Gaveta</label>
                    </div>
                    <br>
                    <div>
                        <input type="radio" name="tipo-usuario" value="caja" id="radioCaja">
                        <label for="radioCaja">Vial</label>
                    </div>
                </div>
            </div>


            <div class="divFormulario">
                <div id="ubicarEspecimenGaveta" class="divFormulario">
                    <form id="actualizar-gaveta-form">
                        <div class="divFormulario">
                            <div class="input_form">
                                <label for="gavetin">Gavetin</label>
                                <div class="input_form_inter">
                                    <select class="select_form" id="gavetin" name="gavetin" required>
                                        <option value="" selected disabled>Seleccione un gavetine</option>
                                    </select>
                                </div>
                            </div>

                            <div class="input_form">
                                <label for="gaveta">Gaveta</label>
                                <div class="input_form_inter">
                                    <select class="select_form" disabled id="gaveta" name="gaveta" required>
                                        <option value="" selected disabled>Seleccione una gaveta</option>
                                    </select>
                                </div>
                            </div>

                            <button>Actualizar ubicacion</button>
                        </div>
                    </form>
                </div>
            </div>



            <script>
                $(document).ready(function() {
                    $('#actualizar-gaveta-form').submit(function(event) {
                        event.preventDefault();

                        var form_data = {
                            especimen: idEspecimenSeleccionado,
                            gaveta: $('#gaveta').val()
                        };

                        $.ajax({
                            type: "POST",
                            url: "?controlador=Especimen&accion=actualizarGavetaEspecimen",
                            data: form_data,
                            dataType: "json",
                            success: function(response) {
                                if (response.vial !== null) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Se actualizo con exito'
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Ocurrio un error'
                                    })
                                }
                            },
                            error: function(xhr, status, error) {
                                alert(error);
                            }
                        });
                    });
                });
            </script>

            <div class="divFormulario">
                <div id="ubicarEspecimenVial" class="divFormulario" style="display: none;">
                    <form id="actualizar-vial-form">
                        <div class="divFormulario">
                            <div class="input_form">
                                <label for="caja">Caja</label>
                                <div class="input_form_inter">
                                    <select id="caja" name="caja" required>
                                        <option value="" selected disabled>Seleccione una caja</option>
                                    </select>
                                </div>
                            </div>

                            <div class="input_form">
                                <label for="vial">Vial</label>
                                <div class="input_form_inter">
                                    <select disabled id="vial" name="vial" required>
                                        <option value="" selected disabled>Seleccione una vial</option>
                                    </select>
                                </div>
                            </div>
                            <button>Actualizar ubicacion</button>
                        </div>
                    </form>
                </div>
            </div>


            <script>
                $(document).ready(function() {
                    $('#actualizar-vial-form').submit(function(event) {
                        event.preventDefault();

                        var form_data = {
                            especimen: idEspecimenSeleccionado,
                            vial: $('#vial').val()
                        };

                        $.ajax({
                            type: "POST",
                            url: "?controlador=Especimen&accion=actualizarVialEspecimen",
                            data: form_data,
                            dataType: "json",
                            success: function(response) {
                                if (response.vial !== null) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Se actualizo con exito'
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Ocurrio un error'
                                    })
                                }
                            },
                            error: function(xhr, status, error) {
                                alert(error);
                            }
                        });
                    });
                });
            </script>



        </div>
    </div>




    <div id="myModal2" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="actualizar-distrito-form">
                <div class="divFormulario">
                    <h1>Actualizar recoleccion</h1>
                    <div class="input_form">
                        <label for="pais">Pais</label>
                        <div class="input_form_inter">
                            <select required class="select_form" name="pais" id="pais">
                                <option disabled selected>Seleccione un país</option>
                            </select>
                        </div>
                    </div>


                    <div class="input_form">
                        <label for="provincia">Provincia</label>
                        <div class="input_form_inter">
                            <select required class="select_form" name="provincia" id="provincia">
                                <option disabled selected>Seleccione una Provincia</option>
                            </select>
                        </div>
                    </div>


                    <div class="input_form">
                        <label for="canton">Canton</label>
                        <div class="input_form_inter">
                            <select required class="select_form" name="canton" id="canton">
                                <option disabled selected>Seleccione un cantón</option>
                            </select>
                        </div>
                    </div>


                    <div class="input_form">
                        <label for="distrito">Distrito</label>
                        <div class="input_form_inter">
                            <select required class="select_form" name="distrito" id="distrito">
                                <option disabled selected>Seleccione un Distrito</option>
                            </select>
                        </div>
                    </div>


                    <button class="btn-principal">Actualizar ubicacion</button>

                </div>

            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#actualizar-distrito-form').submit(function(event) {
                event.preventDefault();

                var form_data = {
                    especimen: idEspecimenSeleccionado,
                    distrito: $('#distrito').val()
                };

                $.ajax({
                    type: "POST",
                    url: "?controlador=Especimen&accion=actualizarRecoleccionEspecimen",
                    data: form_data,
                    dataType: "json",
                    success: function(response) {
                        if (response.distrito !== null) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Se actualizo con exito'
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Ocurrio un error'
                            })
                        }
                    },
                    error: function(xhr, status, error) {
                        alert(error);
                    }
                });
            });
        });
    </script>



    <div id="myModal3" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="actualizar-taxonomia-form">
                <div class="divFormulario">
                    <h1>Actualizar taxonomia</h1>

                    <div class="input_form">

                        <label for="genero">Genero</label>

                        <div class="input_form_inter">

                            <select required class="select_form" name="genero" id="generoIdentificacion">
                                <option disabled selected>Seleccione un género</option>
                            </select>

                        </div>

                    </div>

                    <div class="input_form">

                        <label for="especie">especie</label>

                        <div class="input_form_inter">

                            <select required class="select_form" name="especie" id="especieIdentificacion">
                                <option disabled selected>Seleccione un especie</option>
                            </select>

                        </div>

                    </div>

                    <button class="btn-principal">Actualizar taxonomia</button>

                </div>

            </form>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            $('#actualizar-taxonomia-form').submit(function(event) {
                event.preventDefault();

                var form_data = {
                    especimen: idEspecimenSeleccionado,
                    genero: $('#generoIdentificacion').val(),
                    especie: $('#especieIdentificacion').val()
                };

                $.ajax({
                    type: "POST",
                    url: "?controlador=Especimen&accion=actualizarTaxonomiaEspecimen",
                    data: form_data,
                    dataType: "json",
                    success: function(response) {
                        if (response.especimen !== null) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Se actualizo con exito'
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Ocurrio un error'
                            })
                        }
                    },
                    error: function(xhr, status, error) {
                        alert(error);
                    }
                });
            });
        });
    </script>





    <!-- ---------------MODALES------------------ -->


    <div id="paginationContainer">
        <button id="prevButtons" onclick="previousPageHistorials()">Anterior</button>
        <button id="nextButtons" onclick="nextPageHistorials()">Siguiente</button>
    </div>

    <script>
        function previousPageHistorials() {
            if (currentPage > 1) {
                currentPage = currentPage - 1;
                buscar();
            }
        }

        function nextPageHistorials() {
            currentPage = currentPage + 1;
            buscar();
        }

        function guardarIdEspecimen(id) {
            idEspecimenSeleccionado = id;
        }

        const radioGaveta = document.getElementById('radioGaveta');
        const radioCaja = document.getElementById('radioCaja');
        const ubicarEspecimenGaveta = document.getElementById('ubicarEspecimenGaveta');
        const ubicarEspecimenVial = document.getElementById('ubicarEspecimenVial');

        radioGaveta.addEventListener('change', function() {
            ubicarEspecimenGaveta.style.display = 'block';
            ubicarEspecimenVial.style.display = 'none';
        });

        radioCaja.addEventListener('change', function() {
            ubicarEspecimenGaveta.style.display = 'none';
            ubicarEspecimenVial.style.display = 'block';
        });

        ubicarEspecimenGaveta.style.display = 'block';
    </script>

    <button class="back"><a href="?controlador=Index&accion=mostrar">Regresar</a></button>

</main>

<?php
include 'public/footerSAAdmin.php';
?>

<script>
    obtenerListaGavinetes();
    obtenerListaCajas();
    mostrarPais();
    listarAllGeneros();
</script>

</html>