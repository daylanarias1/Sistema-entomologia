<?php
if ($_SESSION['usuario_nombre_rol'] == 'SA') {
    include 'public/administradorGeneralHeader.php';
} //menu con funcionalidades del administrador general

if ($_SESSION['usuario_nombre_rol'] == 'ADMIN') {
    include 'public/administradorHeader.php';
} //menu con funcionalidades del administrador
?>

<main>
    <h1>Usuarios registrados</h1>
    <div class="divTabla">

        <table class="tabla">
            <thead>
                <tr>
                    <th>Nombre de usuario</th>
                    <th>Rol</th>
                    <th>Activo</th>
                </tr>
            </thead>
            <tbody id="cuerpo">

            </tbody>
        </table>
    </div>

    <div id="paginationContainer">
        <button class="btn-principal" onclick="previousPage()">Anterior</button>
        <button class="btn-principal" onclick="nextPage()">Siguiente</button>
    </div>

    <button class="back"><a href="?controlador=Index&accion=mostrar">Regresar</a></button>

</main>


<footer>
    <p>Creado por <strong>Daylan Arias Masis</strong></p>
</footer>
</div>
</body>
<script src="public/js/usuarios.js"></script>
</html>


<script>
    var currentPage = 1;

    function previousPage() {
        if (currentPage > 1) {
            currentPage = currentPage - 1;
            fetchUsers(currentPage);
        }
    }

    function nextPage() {
        currentPage = currentPage + 1;
        fetchUsers(currentPage);
    }

    fetchUsers(currentPage);
</script>
