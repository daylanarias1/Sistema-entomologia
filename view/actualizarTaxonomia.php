<?php
if ($_SESSION['usuario_nombre_rol'] == 'SA') {
    include 'public/administradorGeneralHeader.php';
} //menu con funcionalidades del administrador general

if ($_SESSION['usuario_nombre_rol'] == 'ADMIN') {
    include 'public/administradorHeader.php';
} //menu con funcionalidades del administrador
?>

<style>
    .btn_add{
        border-radius: 50%;
    border: solid 1px #0f5474;
    }
</style>

<div id="myModal1" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="actualizar-orden-form">
            <div class="divFormulario">
                <h1>Actualizar orden</h1>
                <label for="">Nombre de la orden</label>
                <input required type="text" id="actualizarOrden" placeholder="Ingrese nombre de la orden">
                <button type="submit" class="btn-principal">Actualizar orden</button>
            </div>
        </form>
    </div>
</div>


<div id="myModal2" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="actualizar-familia-form">
            <div class="divFormulario">
                <h1>Actualizar una familia</h1>
                <label for="">Nombre de la familia</label>
                <input required type="text" id="actualizarFamilia" placeholder="Ingrese el nombre de la familia">
                <button type="submit" class="btn-principal">Actualizar familia</button>
            </div>
        </form>
    </div>
</div>

<div id="myModal3" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="actualizar-subfamilia-form">
            <div class="divFormulario">
                <h1>Registra una subFamilia</h1>
                <label for="">Nombre de la subfamilia</label>
                <input required type="text" id="actualizarSubfamilia" placeholder="Ingrese el nombre de la subfamilia">
                <button type="submit" class="btn-principal">Actualizar subfamilia</button>
            </div>
        </form>
    </div>
</div>

<div id="myModal4" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="actualizar-genero-form">
            <div class="divFormulario">
                <h1>Actualizar una genero</h1>
                <label for="">Nombre del genero</label>
                <input required type="text" id="actualizarGenero" placeholder="Ingrese el nombre de la subfamilia">
                <button type="submit" class="btn-principal">Actualizar genero</button>
            </div>
        </form>
    </div>
</div>

<div id="myModal5" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="divFormulario">
            <h1>Actualizar una especie</h1>

            <div>
                <input type="radio" name="opciones" onclick="mostrarDiv(1)" checked /> Actualizar nombre
                <input type="radio" name="opciones" onclick="mostrarDiv(2)" /> Actualizar taxonomia
            </div>

            <div class="divFormulario" id="div1" style="display: block;">
                <form id="actualizar-especie-form">

                    <label for="">Nombre de la especie</label>
                    <input required type="text" id="actualizarEspecie" placeholder="Ingrese el nombre del genero">
                    <button type="submit" class="btn-principal">Actualizar especie</button>

                </form>
            </div>

            <div class="divFormulario" id="div2" style="display: none;">

                <form id="actualizar-especie-taxonomia-form" class="divFormulario">

                    <label for="">Orden</label>
                    <select class="select_form" id="ordenActualizar" required>
                        <option disabled value="" selected>Selecciona una orden</option>
                    </select>

                    <label for="">Familia</label>
                    <select class="form-control" id="familiaActualizar" disabled required>
                        <option disabled value="" selected>Selecciona una familia</option>
                    </select>

                    <label for="">Subfamilia</label>
                    <select class="select_form" id="subfamiliaActualizar" disabled required>
                        <option disabled value="" selected>Selecciona una sub familia</option>
                    </select>

                    <div class="input_form_radio">
                        <input type="radio" name="asociacion" id="asociarSubfamiliaActualizar" checked>
                        <label for="asociarSubfamilia">Asociar género a subfamilia</label>
                        <br><br>
                        <input type="radio" name="asociacion" id="asociarFamiliaActualizar">
                        <label for="asociarFamilia">Asociar género a familia</label>
                    </div>

                    <label for="">Genero</label>
                    <select class="select_form" id="generoActualizar" disabled required>
                        <option disabled value="" selected>Selecciona un género</option>
                    </select>

                    <button type="submit" class="btn-principal">Actualizar taxonomia</button>

                </form>
            </div>

            <script>
                $('#actualizar-especie-taxonomia-form').submit(function(event) {
                    event.preventDefault();
                    let form_data = {
                        genero: $('#generoActualizar').val(),
                        especie: $('#especie').val(),
                    };

                    $.ajax({
                        type: "POST",
                        url: "?controlador=Taxonomia&accion=actualizarTaxonomiaEspecie",
                        data: form_data,
                        dataType: "json",
                        success: function(response) {
                            if (response[0].especie !== null) {
                                Swal.fire({
                                    title: "Actualizacion correcta",
                                    text: "Se actualizó la especie",
                                    icon: "success",
                                    confirmButtonText: "OK"
                                });
                                mostrarEspecieGenero($('#genero').val())
                            } else {
                                Swal.fire({
                                    title: "Error",
                                    text: "No se actualizó la especie",
                                    icon: "error",
                                    confirmButtonText: "OK"
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Error",
                                text: "Algo salió mal",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        }
                    });
                });

                function mostrarDiv(divId) {
                    var div1 = document.getElementById('div1');
                    var div2 = document.getElementById('div2');

                    if (divId === 1) {
                        div1.style.display = 'block';
                        div2.style.display = 'none';
                    } else {
                        div1.style.display = 'none';
                        div2.style.display = 'block';
                    }
                }
            </script>



        </div>

    </div>
</div>




<main>

    <h1>Actualizar taxonomia</h1>

    <div class="input_form">

        <label for="orden">Orden</label>

        <div class="input_form_inter">

            <select class="select_form" id="orden">
                <option disabled value="" selected>Selecciona una orden</option>
                <?php foreach ($vars['lista'] as $orden) { ?>
                    <option value="<?php echo $orden[0]; ?>"><?php echo $orden[1]; ?></option>
                <?php } ?>
            </select>

            <button class="btn_add" onclick="abrirModalRegistrar('myModal1')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                </svg></button>

        </div>
    </div>


    <div class="input_form">
        <label>Familia</label>
        <div class="input_form_inter">

            <select class="form-control" id="familia" disabled>
                <option disabled value="" selected>Selecciona una familia</option>
            </select>
            <button class="btn_add" onclick="abrirModalRegistrar('myModal2')" disabled id="btnFamilia"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                </svg></button>

        </div>
    </div>


    <div class="input_form">

        <label>Subfamilia</label>

        <div class="input_form_inter">

            <select class="select_form" id="subfamilia" disabled>
                <option disabled value="" selected>Selecciona una sub familia</option>
            </select>
            <button class="btn_add" onclick="abrirModalRegistrar('myModal3')" disabled id="btnSubFamilia"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                </svg></button>
        </div>
    </div>

    <div class="input_form">
        <label>Género</label>
        <div class="input_form_inter">

            <select class="select_form" id="genero" disabled>
                <option disabled value="" selected>Selecciona un género</option>
            </select>
            <button class="btn_add" onclick="abrirModalRegistrar('myModal4')" disabled id="btnGenero"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                </svg></button>
        </div>

        <div class="input_form_radio">
            <input type="radio" name="asociacion" id="asociarSubfamilia" checked>
            <label for="asociarSubfamilia">Asociar género a subfamilia</label>
            <br><br>
            <input type="radio" name="asociacion" id="asociarFamilia">
            <label for="asociarFamilia">Asociar género a familia</label>
        </div>
    </div>

    <div class="input_form">
        <label>Especie</label>
        <div class="input_form_inter">
            <select class="select_form" id="especie" name="especie" disabled>
                <option disabled value="" selected>Selecciona una especie</option>
            </select>
            <button class="btn_add" disabled onclick="abrirModalRegistrar('myModal5'); mostrarOrdenesActualizar()" id="btnEspecie"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                </svg></button>
        </div>
    </div>
</main>

<?php
include_once './public/footer.php';
?>

<script src="public/js/actualizarTaxonomia.js"></script>