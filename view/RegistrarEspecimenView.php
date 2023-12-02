<?php
if ($_SESSION['usuario_nombre_rol'] == 'SA') {
    include 'public/administradorGeneralHeader.php';
}

if ($_SESSION['usuario_nombre_rol'] == 'ADMIN') {
    include 'public/administradorHeader.php';
}
?>

<main>

    <div id="actualizarCaja" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="actualizar-caja-form">
                <div class="divFormulario">
                    <h1>Actualizar caja</h1>
                    <label for="">Numero de caja;</label>
                    <input required type="number" id="actualizarCajas" placeholder="Ingrese nombre de la distrito">
                    <button type="submit" class="btn-principal">Registrar caja</button>
                </div>
            </form>
        </div>
    </div>

    <div id="actualizarVial" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="actualizar-vial-form">
                <div class="divFormulario">
                    <h1>Actualizar Vial</h1>
                    <label for="">Numero de vial;</label>
                    <input required type="number" id="actualizarViales" placeholder="Ingrese nombre de la distrito">
                    <button type="submit" class="btn-principal">Registrar vial</button>
                </div>
            </form>
        </div>
    </div>



    <div id="actualizarGavinete" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="actualizar-gabinete-form">
                <div class="divFormulario">
                    <h1>Actualizar gabinete</h1>
                    <label for="">Numero del gabinete</label>
                    <input required type="number" id="actualizarGabinete" placeholder="Ingrese nombre de la distrito">
                    <button type="submit" class="btn-principal">Registrar gabinete</button>
                </div>
            </form>
        </div>
    </div>


    <div id="actualizarGaveta" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="actualizar-gaveta-form">
                <div class="divFormulario">
                    <h1>Actualizar gaveta</h1>
                    <label for="">Numero de gaveta</label>
                    <input required type="number" id="actualizarGavetas" placeholder="Ingrese nombre de la distrito">
                    <button type="submit" class="btn-principal">Registrar gaveta</button>
                </div>
            </form>
        </div>
    </div>

    <div id="myModal4" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="registrar-distrito-form">
                <div class="divFormulario">
                    <h1>Registra una distrito</h1>
                    <label for="">Nombre de la distrito</label>
                    <input required type="text" id="registrardistrito" placeholder="Ingrese nombre de la distrito">
                    <button type="submit" class="btn-principal">Registrar distrito</button>
                </div>
            </form>
        </div>
    </div>

    <div id="myModal1" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="registrar-pais-form">
                <div class="divFormulario">
                    <h1>Registra un pais</h1>
                    <label for="">Nombre del pais</label>
                    <input required type="text" id="registrarpais" placeholder="Ingrese nombre de la pais">
                    <button type="submit" class="btn-principal">Registrar pais</button>
                </div>
            </form>
        </div>
    </div>

    <div id="myModal2" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="registrar-provincia-form">
                <div class="divFormulario">
                    <h1>Registra una provincia</h1>
                    <label for="">Nombre de la provincia</label>
                    <input required type="text" id="registrarprovincia" placeholder="Ingrese nombre de la provincia">
                    <button type="submit" class="btn-principal">Registrar provincia</button>
                </div>
            </form>
        </div>
    </div>


    <div id="myModal3" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="registrar-canton-form">
                <div class="divFormulario">
                    <h1>Registra una canton</h1>
                    <label for="">Nombre de la canton</label>
                    <input required type="text" id="registrarcanton" placeholder="Ingrese nombre de la canton">
                    <button type="submit" class="btn-principal">Registrar canton</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalVial" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="registrar-vial-form">
                <div class="divFormulario">
                    <h1>Registra una Vial</h1>
                    <label for="">Numero de Vial</label>
                    <input required type="number" id="registrarNumeroVial" placeholder="Ingrese el numero del gavinete">
                    <button type="submit" class="btn-principal">Registrar Vial</button>
                </div>
            </form>
        </div>
    </div>

    <div id="myModal5" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="registrar-recolecto-form">
                <div class="divFormulario">
                    <h1>Registra una recolecto</h1>
                    <label for="">Inicial del nombre</label>
                    <input placeholder="Inicial del nombre" id="inicialRegistrar" type="text" pattern="[A-Z]" maxlength="1" required>

                    <label for="">Apellidos</label>
                    <input required type="text" id="apellidosRegistrar" placeholder="Ingrese nombre de la recolecto">
                    <button type="submit" class="btn-principal">Registrar recolecto</button>
                </div>
            </form>
        </div>
    </div>


    <div id="modalGabinete" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="registrar-gavinete-form">
                <div class="divFormulario">
                    <h1>Registra un gavinete</h1>
                    <label for="">Numero del gavinete</label>
                    <input required type="number" id="registrarNumeroGavinete" placeholder="Ingrese el numero del gavinete">
                    <button type="submit" class="btn-principal">Registrar gavinete</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalGaveta" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="registrar-gaveta-form">
                <div class="divFormulario">
                    <h1>Registra una gaveta</h1>
                    <label for="">Numero de gaveta</label>
                    <input required type="number" id="registrarNumeroGaveta" placeholder="Ingrese el numero del gavinete">
                    <button type="submit" class="btn-principal">Registrar gaveta</button>
                </div>
            </form>
        </div>
    </div>





    <div id="modalCaja" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="registrar-caja-form">
                <div class="divFormulario">
                    <h1>Registra un caja</h1>

                    <label for="">Numero del caja</label>
                    <input required type="number" id="registrarNumerocaja" placeholder="Ingrese el numero del gavinete">

                    <button type="submit" class="btn-principal">Registrar caja</button>
                </div>
            </form>
        </div>
    </div>

    <h1>Registrar espécimen</h1>

    <div class="sectionts_especimen">

        <div class="section_especimen">

            <h2>Ubicación</h2>

            <div class="input_form">

                <label for="pais">Pais</label>

                <div class="input_form_inter">

                    <select class="select_form" name="pais" id="pais">
                        <option disabled selected>Seleccione un país</option>
                    </select>
                    <button class="btn_add" onclick="abrirModalRegistrar('myModal1')"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                        </svg></button>

                </div>

            </div>


            <div class="input_form">

                <label for="provincia">Provincia</label>
                <div class="input_form_inter">

                    <select class="select_form" name="provincia" id="provincia">
                        <option disabled selected>Seleccione una Provincia</option>
                    </select>
                    <button class="btn_add" onclick="abrirModalRegistrar('myModal2')"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                        </svg></button>

                </div>

            </div>


            <div class="input_form">

                <label for="canton">Canton</label>
                <div class="input_form_inter">

                    <select class="select_form" name="canton" id="canton">
                        <option disabled selected>Seleccione un cantón</option>
                    </select>
                    <button class="btn_add" onclick="abrirModalRegistrar('myModal3')"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                        </svg></button>

                </div>

            </div>


            <div class="input_form">

                <label for="distrito">Distrito</label>
                <div class="input_form_inter">

                    <select class="select_form" name="distrito" id="distrito">
                        <option disabled selected>Seleccione un Distrito</option>
                    </select>
                    <button class="btn_add" onclick="abrirModalRegistrar('myModal4')"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                        </svg></button>

                </div>

            </div>


            <div class="input_form">

                <label for="inputLatitud">Latitud</label>

                <div class="input_form_inter">
                    <input type="text" id="inputLatitud" class="input_form_coordenadas" placeholder="Ingrese la latitud" inputmode="decimal">
                </div>

            </div>


            <div class="input_form">

                <label for="inputLongitud">Longitud</label>

                <div class="input_form_inter">

                    <input type="text" id="inputLongitud" class="input_form_coordenadas" placeholder="Ingrese la longitud" inputmode="decimal">

                </div>

            </div>


            <div class="input_form">

                <label for="fechaRecoleccion">Fecha</label>

                <div class="input_form_inter">

                    <input type="date" id="fechaRecoleccion" class="input_form_coordenadas">

                </div>

            </div>






            <script>
                $(document).ready(function() {
                    $('#inputLongitud').on('keydown', function(e) {
                        var longitud = $(this).val();

                        // Verificar si se presionó la tecla de retroceso y si el signo "-" está presente
                        if (e.keyCode === 8 && longitud === '-') {
                            e.preventDefault(); // Evitar eliminar el signo "-" con la tecla de retroceso
                        }
                    }).on('input', function() {
                        var longitud = $(this).val();

                        // Verificar si el valor no comienza con el signo "-"
                        if (longitud !== '' && longitud.charAt(0) !== '-') {
                            // Agregar el signo "-" al principio del valor
                            $(this).val('-' + longitud);
                        }
                    });

                    $('#inputLatitud, #inputLongitud').on('blur', function() {
                        var inputValue = $(this).val();

                        // Verificar si el valor no contiene un punto decimal
                        if (inputValue !== '' && !inputValue.includes('.')) {
                            $(this).val('');
                        }
                    });
                });
            </script>

        </div>





        <div class="section_especimen">

            <div class="section_especimen identificacion">
                <h2>Identificación</h2>


                <div class="input_form">

                    <label for="genero">Genero</label>

                    <div class="input_form_inter">

                        <select class="select_form" name="genero" id="generoIdentificacion">
                            <option disabled selected>Seleccione un género</option>
                        </select>

                    </div>

                </div>

                <div class="input_form">

                    <label for="especie">especie</label>

                    <div class="input_form_inter">

                        <select class="select_form" name="especie" id="especieIdentificacion">
                            <option disabled selected>Seleccione un especie</option>
                        </select>

                    </div>

                </div>

            </div>


            <h2>Recolector</h2>


            <div class="input_form">

                <label for="recolector">Recolector</label>

                <div class="input_form_inter">

                    <select class="select_form" name="recolector" id="recolector">
                        <option disabled selected>Seleccione un recolector</option>
                    </select>
                    <button class="btn_add" onclick="abrirModalRegistrar('myModal5')"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                        </svg></button>

                </div>

            </div>

            <div class="section_especimen">

                <h2>Ubicar espécimen</h2>


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


                <div id="ubicarEspecimenGaveta" class="ubicarEspecimen">

                    <div class="input_form">

                        <label for="gavetin">Gavetin</label>

                        <div class="input_form_inter">

                            <select class="select_form" id="gavetin" name="gavetin" required>
                                <option value="" selected disabled>Seleccione un gavetine</option>
                            </select>
                            <button class="btn_add" onclick="abrirModalRegistrar('modalGabinete')"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                </svg></button>

                            <button type="button" class="btn_add" onclick="abrirModalRegistrar('actualizarGavinete')" id="btnplanta"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                </svg></button>

                        </div>

                    </div>



                    <script>
                        $(document).ready(function() {
                            $('#actualizar-gabinete-form').submit(function(event) {
                                event.preventDefault();
                                let form_data = {
                                    numeroGabinete: $('#actualizarGabinete').val(),
                                    idGabinete: $('#gavetin').val(),
                                };
                                $.ajax({
                                    type: "POST",
                                    url: "?controlador=Gavinete&accion=actualizarGabinete",
                                    data: form_data,
                                    dataType: "json",
                                    success: function(response) {

                                        if (response[0].gaveta !== null) {
                                            Swal.fire({
                                                title: "Ingreso correcto",
                                                text: "Se actualizo la gaveta " + response[0].gaveta,
                                                icon: "success",
                                                confirmButtonText: "OK"
                                            });
                                            obtenerListaGavinetes()
                                        } else {
                                            Swal.fire({
                                                title: "Error",
                                                text: "No se actualizo la gaveta",
                                                icon: "error",
                                                confirmButtonText: "OK"
                                            });
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        Swal.fire({
                                            title: "Error",
                                            text: "Algo salio mal",
                                            icon: "error",
                                            confirmButtonText: "OK"
                                        });
                                    }
                                });
                            });
                        });
                    </script>



                    <div class="input_form">

                        <label for="gaveta">Gaveta</label>

                        <div class="input_form_inter">

                            <select class="select_form" disabled id="gaveta" name="gaveta" required>
                                <option value="" selected disabled>Seleccione una gaveta</option>
                            </select>
                            <button id="botonModalGaveta" class="btn_add" disabled onclick="abrirModalRegistrar('modalGaveta')"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                </svg></button>

                            <button type="button" class="btn_add" onclick="abrirModalRegistrar('actualizarGaveta')" id="btnplanta"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                </svg></button>

                        </div>

                    </div>

                </div>




                <script>
                    $(document).ready(function() {
                        $('#actualizar-gaveta-form').submit(function(event) {
                            event.preventDefault();
                            let form_data = {
                                numeroGaveta: $('#actualizarGavetas').val(),
                                idGaveta: $('#gaveta').val(),
                            };
                            $.ajax({
                                type: "POST",
                                url: "?controlador=Gavinete&accion=actualizarGaveta",
                                data: form_data,
                                dataType: "json",
                                success: function(response) {

                                    if (response[0].gaveta !== null) {
                                        Swal.fire({
                                            title: "Ingreso correcto",
                                            text: "Se actualizo la gaveta " + response[0].gaveta,
                                            icon: "success",
                                            confirmButtonText: "OK"
                                        });
                                        listarGavetas()
                                    } else {
                                        Swal.fire({
                                            title: "Error",
                                            text: "No se actualizo la gaveta",
                                            icon: "error",
                                            confirmButtonText: "OK"
                                        });
                                    }
                                },
                                error: function(xhr, status, error) {
                                    Swal.fire({
                                        title: "Error",
                                        text: "Algo salio mal",
                                        icon: "error",
                                        confirmButtonText: "OK"
                                    });
                                }
                            });
                        });
                    });
                </script>








                <div id="ubicarEspecimenVial" class="ubicarEspecimen" style="display: none;">

                    <div class="input_form">

                        <label for="caja">Caja</label>

                        <div class="input_form_inter">

                            <select id="caja" name="caja" required>
                                <option value="" selected disabled>Seleccione una caja</option>
                            </select>
                            <button class="btn_add" onclick="abrirModalRegistrar('modalCaja')"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                </svg></button>

                            <button type="button" class="btn_add" onclick="abrirModalRegistrar('actualizarCaja')" id="btnplanta"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                </svg></button>

                        </div>

                    </div>





                    <script>
                        $(document).ready(function() {
                            $('#actualizar-caja-form').submit(function(event) {
                                event.preventDefault();
                                let form_data = {
                                    numeroCaja: $('#actualizarCajas').val(),
                                    idCaja: $('#caja').val(),
                                };
                                $.ajax({
                                    type: "POST",
                                    url: "?controlador=Gavinete&accion=actualizarCaja",
                                    data: form_data,
                                    dataType: "json",
                                    success: function(response) {

                                        if (response[0].gaveta !== null) {
                                            Swal.fire({
                                                title: "Ingreso correcto",
                                                text: "Se actualizo la caja " + response[0].gaveta,
                                                icon: "success",
                                                confirmButtonText: "OK"
                                            });
                                            obtenerListaCajas()
                                        } else {
                                            Swal.fire({
                                                title: "Error",
                                                text: "No se actualizo la caja",
                                                icon: "error",
                                                confirmButtonText: "OK"
                                            });
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        Swal.fire({
                                            title: "Error",
                                            text: "Algo salio mal",
                                            icon: "error",
                                            confirmButtonText: "OK"
                                        });
                                    }
                                });
                            });
                        });
                    </script>







                    <div class="input_form">

                        <label for="vial">Vial</label>

                        <div class="input_form_inter">

                            <select disabled id="vial" name="vial" required>
                                <option value="" selected disabled>Seleccione una vial</option>
                            </select>
                            <button class="btn_add" onclick="abrirModalRegistrar('modalVial')"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                </svg></button>

                            <button type="button" class="btn_add" onclick="abrirModalRegistrar('actualizarVial')" id="btnplanta"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                </svg></button>

                        </div>

                    </div>





                    <script>
                        $(document).ready(function() {
                            $('#actualizar-vial-form').submit(function(event) {
                                event.preventDefault();
                                let form_data = {
                                    numeroVial: $('#actualizarViales').val(),
                                    idVial: $('#vial').val(),
                                };
                                $.ajax({
                                    type: "POST",
                                    url: "?controlador=Gavinete&accion=actualizarVial",
                                    data: form_data,
                                    dataType: "json",
                                    success: function(response) {

                                        if (response[0].vial !== null) {
                                            Swal.fire({
                                                title: "Ingreso correcto",
                                                text: "Se actualizo el vial " + response[0].vial,
                                                icon: "success",
                                                confirmButtonText: "OK"
                                            });
                                            listarViales()
                                        } else {
                                            Swal.fire({
                                                title: "Error",
                                                text: "No se actualizo el vial",
                                                icon: "error",
                                                confirmButtonText: "OK"
                                            });
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        Swal.fire({
                                            title: "Error",
                                            text: "Algo salio mal",
                                            icon: "error",
                                            confirmButtonText: "OK"
                                        });
                                    }
                                });
                            });
                        });
                    </script>





                </div>

            </div>

        </div>

    </div>

    <div>

        <style>

        </style>

        <label for="imagenes" class="custom-file-upload">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z" />
            </svg>
            Seleccione imágenes
        </label>

        <input class="btn-principal" type="file" name="imagenes" id="imagenes" style="display: none;" multiple required accept=".jpg, .jpeg, .png, .gif, .svg" onchange="validarTamanioImagenes()">

        <script>
            function validarTamanioImagenes() {
                var input = document.getElementById('imagenes');
                var files = input.files;

                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    var img = new Image();

                    img.onload = function() {
                        if (img.width < 500 && img.height < 500) {
                            Swal.fire({
                                icon: 'info',
                                title: 'Las imagenes deben de ser mayor de 500px de alto y de ancho'
                            })
                            return;
                        }
                    };

                    img.src = URL.createObjectURL(file);
                }
            }
        </script>

    </div>

    <button class="btn-principal" id="registrarEspecimen" type="submit">Registrar nuevo espécimen</button>

    <button class="back"><a href="?controlador=Index&accion=mostrar">Regresar</a></button>

</main>

<?php
include 'public/footerSAAdmin.php';
?>

<script>
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

    mostrarPais();
    mostrarRecolectores();
    obtenerListaGavinetes();
    obtenerListaCajas();
    listarAllGeneros();
</script>