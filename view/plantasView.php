<?php
if ($_SESSION['usuario_nombre_rol'] == 'SA') {
    include 'public/administradorGeneralHeader.php';
} //menu con funcionalidades del administrador general

if ($_SESSION['usuario_nombre_rol'] == 'ADMIN') {
    include 'public/administradorHeader.php';
} //menu con funcionalidades del administrador
?>

<main>
    <h1>Asociar plantas</h1>



    <div id="myModal1" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="registrar-planta-form">
                <div class="divFormulario">
                    <h1>Registra una planta</h1>
                    <label for="">Nombre de la planta</label>
                    <input required type="text" id="registrarPlanta" placeholder="Ingrese nombre de la orden">
                    <button type="submit" class="btn-principal">Registrar planta</button>
                </div>
            </form>
        </div>
    </div>

    <div id="myModal2" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="actualizar-planta-form">
                <div class="divFormulario">
                    <h1>Actualizar planta</h1>
                    <label for="">El nuevo nombre de la planta</label>
                    <input required type="text" id="actualizarPlanta" placeholder="Ingrese nombre de la orden">
                    <button type="submit" class="btn-principal">Actualizar planta</button>
                </div>
            </form>
        </div>
    </div>

    <div>
        <form id="registrar-planta-genero-form" class="divFormulario">
            <h1>Genero</h1>
            <select id="generoIdentificacionPlanta">
                <option value="" selected disabled>
                    Seleccione un genero
                </option>
            </select>

            <h1>Planta</h1>
            <div class="input_form_inter">

                <select id="planta">
                    <option value="" selected disabled>
                        Seleccione una planta
                    </option>
                </select>

                <button type="button" class="btn_add" onclick="abrirModalRegistrar('myModal1')" id="btnplanta"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                    </svg></button>

                <button type="button" class="btn_add" onclick="abrirModalRegistrar('myModal2')" id="btnplanta"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                    </svg></button>

            </div>
            <div>
                <button type="submit" class="btn-principal">Asociar planta</button>
                <button type="button" id="eliminarAsociacionPlanta" class="btn-principal">Eliminar Asociacion</button>
            </div>
        </form>
    </div>

    <button class="back"><a href="?controlador=Index&accion=mostrar">Regresar</a></button>

</main>


<?php
include_once './public/footer.php';
?>

<script src="public/js/plantas.js"></script>

<script>
    listarAllGenerosPlanta();
    listarAllPlantas();
</script>