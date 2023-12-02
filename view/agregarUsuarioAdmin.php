<?php
if ($_SESSION['usuario_nombre_rol'] == 'ADMIN') {
    include 'public/administradorHeader.php';
} //menu con funcionalidades del administrador
?>


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

<script src="public/js/cryptojs.js"></script>

<script>
    $(document).ready(function() {
        $('#estudiante-docente-form').submit(function(event) {
            event.preventDefault();

            let pass = CryptoJS.SHA256($('#usuario-contrasena').val()).toString();
            var form_data = {
                cod_username: $('#usuario-nombre').val(),
                cod_password: pass,
                tipo: $('#tipo-usuario').val()
            };

            $.ajax({
                type: "POST",
                url: "?controlador=Usuario&accion=registrarUsuario",
                data: form_data,
                dataType: "json",
                success: function(response) {
                    if (response[0].username !== null) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Se registro con exito'
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


<?php
include 'public/footerSAAdmin.php';
?>
