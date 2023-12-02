<?php
if ($_SESSION['usuario_nombre_rol'] == 'SA') {
    include 'public/administradorGeneralHeader.php';
}
?>

<main>

    <div class="radioButtons">
        <div>
            <input type="radio" name="tipo-usuario" value="admin" checked>
            <label>Registrar administrador</label>
        </div>
        <div>
            <input type="radio" name="tipo-usuario" value="estudiante-docente">
            <label>Registrar estudiante o docente</label>
        </div>
    </div>


    <form id="admin-form" class="formulario-login">
        <h1>Registra un administrador</h1>
        <label for="">Nombre de usuario</label>
        <input type="text" id="admin-nombre" name="nombre" placeholder="Ingrese el nombre de usuario">
        <label for="">Contraseña de usuario</label>
        <input name="contrasena" id="admin-contrasena" type="text" placeholder="Ingrese la contraseña del usuario">
        <button id="btn-registrar" type="submit" class="btn-principal sombra-1">Registrar administrador</button>
    </form>



    <form id="estudiante-docente-form" class="formulario-login">
        <h1>Registra un estudiante o docente</h1>
        <label for="">Nombre de usuario</label>
        <input id="usuario-nombre" type="text" name="usuario-nombre" placeholder="Ingrese el nombre de usuario" required>
        <label for="">Contraseña de usuario</label>
        <input id="usuario-contrasena" name="usuario-contrasena" type="text" placeholder="Ingrese la contraseña del usuario" require>
        <label for="">Tipo usuario</label>
        <select id="tipo-usuario" name="tipo-usuario" required>
            <option value="" disabled selected hidden>Seleccione una opción</option>
            <option value=3>Estudiante</option>
            <option value=3>Docente</option>
        </select>
        <button id="btn-registrar" type="submit" class="btn-principal sombra-1">Registrar estudiante o docente</button>
    </form>

    <button class="back"><a href="?controlador=Index&accion=mostrar">Regresar</a></button>
</main>
<script src="public/js/cryptojs.js"></script>

<script>
    $(document).ready(function() {
        $('input[name="tipo-usuario"]').change(function() {
            var tipoUsuario = $(this).val();

            if (tipoUsuario === 'admin') {
                $('#admin-form').show();
                $('#estudiante-docente-form').hide();
            } else if (tipoUsuario === 'estudiante-docente') {
                $('#admin-form').hide();
                $('#estudiante-docente-form').show();
            }
        });
        var defaultValue = $('input[name="tipo-usuario"]:checked').val();
        if (defaultValue === 'admin') {
            $('#admin-form').show();
            $('#estudiante-docente-form').hide();
        } else if (defaultValue === 'estudiante-docente') {
            $('#admin-form').hide();
            $('#estudiante-docente-form').show();
        }
    });
</script>


<script src="public/js/registrarUsuarios.js"></script>


<?php
include_once './public/footer.php';
?>