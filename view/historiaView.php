<?php
if ($_SESSION['usuario_nombre_rol'] == 'SA') {
    include 'public/administradorGeneralHeader.php';
} //menu con funcionalidades del administrador general

if ($_SESSION['usuario_nombre_rol'] == 'ADMIN') {
    include 'public/administradorHeader.php';
} //menu con funcionalidades del administrador
?>

<style>
    .search-bar {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .search-bar input[type="text"] {
        padding: 8px;
        border: none;
        border-radius: 5px 0 0 5px;
        outline: none;
    }

    .search-bar button {
        border-radius: 50%;
    }
</style>

<main>
    <h1>Historial de actividades</h1>

    <div id="formAnioDiv">
        <form id="formAnio">
            <label for="anioRegistro">Ingrese el año de búsqueda</label>
            <div class="search-bar">
                <input required id="anioRegistro" name="anioRegistro" type="text" placeholder="Ingrese el año" onblur="validarAno(this)" maxlength="4" />

                <button class="btn-principal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg></button>
            </div>
        </form>
    </div>

    <div id="formRangoFechasDiv" style="display: none;">
        <form id="formRangoFechas">
            <div  class="search-bar">
                <div>
                <label for="">Inicio</label>
                <input required id="fechaInicio" name="fechaInicio" type="date" />
                </div>
                <div>
                <label for="">Final</label>
                <input required id="fechaFinal" name="fechaFinal" type="date" />
                </div>

                <button class="btn-principal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg></button>
            </div>

        </form>
    </div>

    <div class="radioButtons">
        <div><input type="radio" name="opcion" id="opcionAnio" checked>
            <label for="opcionAnio">Año</label>
        </div>
        <div><input type="radio" name="opcion" id="opcionRangoFechas">
            <label for="opcionRangoFechas">Rango de fechas</label>
        </div>
    </div>

    <div class="divTabla">
        <table class="tabla">
            <thead>
                <tr>
                    <th>Nombre de usuario</th>
                    <th>Accion</th>
                    <th>Descripcion</th>
                </tr>
            </thead>
            <tbody id="cuerpo">

            </tbody>
        </table>
    </div>

    <div id="paginationContainer">
        <button class="btn-principal" id="prevButton" disabled onclick="previousPageHistorial()">Anterior</button>
        <button class="btn-principal" id="nextButton" disabled onclick="nextPageHistorial()">Siguiente</button>
    </div>

    <button class="back"><a href="?controlador=Index&accion=mostrar">Regresar</a></button>
</main>

<script>
    const opcionAnio = document.getElementById('opcionAnio');
    const opcionRangoFechas = document.getElementById('opcionRangoFechas');
    const formAnioDiv = document.getElementById('formAnioDiv');
    const formRangoFechasDiv = document.getElementById('formRangoFechasDiv');

    opcionAnio.addEventListener('click', () => {
        formAnioDiv.style.display = 'block';
        formRangoFechasDiv.style.display = 'none';
    });

    opcionRangoFechas.addEventListener('click', () => {
        formAnioDiv.style.display = 'none';
        formRangoFechasDiv.style.display = 'block';
    });

    function validarAno(input) {
        var valor = parseInt(input.value);

        if (isNaN(valor) || valor < 1900 || valor > 2100 || input.value.length !== 4) {
            input.value = '';
        }
    }

    var currentPage = 1;
</script>

<?php
include_once './public/footer.php';
?>

<script src="public/js/historial.js"></script>