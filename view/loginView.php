<?php
include_once './public/header.php';
?>

<main>
    <form class="formulario-login" id="login-form" method="post" action="?controlador=Usuario&accion=iniciarSession">

        <h1>Inicio de sesión</h1>
        <label for="">Nombre de usuario</label>
        <input class="form-control" name="username" placeholder="Ingrese el nombre" required>
        <label for="">Contraseña</label>
        <input class="form-control" type="password" name="password" placeholder="Ingrese la contraseña" required>

        <button id="btn-registrar" type="submit" class="btn-principal sombra-1 form-control">Iniciar sesion</button>
    </form>

    <div class="alerta">
        <?php if (isset($vars['mensaje'])) : ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: "Error",
                        text: "<?php echo $vars['mensaje']; ?>",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                });
            </script>
        <?php endif; ?>
    </div>
</main>

<script src="public/js/cryptojs.js"></script>

<script>
    $(document).ready(function() {
        $('#login-form').submit(function(event) {
            var passwordInput = document.querySelector('input[name="password"]');
            var password = passwordInput.value;
            var hashedPassword = CryptoJS.SHA256(password).toString();

            // Crear un campo oculto adicional para almacenar el hash
            var hashedPasswordInput = document.createElement("input");
            hashedPasswordInput.type = "hidden";
            hashedPasswordInput.name = "hashedPassword";
            hashedPasswordInput.value = hashedPassword;

            // Agregar el campo oculto al formulario
            this.appendChild(hashedPasswordInput);

            // El formulario se enviará de forma síncrona con el campo oculto adicional
            return true;
        });
    });
</script>



<?php
include_once './public/footer.php';
?>