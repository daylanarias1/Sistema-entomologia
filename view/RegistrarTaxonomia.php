<?php
if ($_SESSION['usuario_nombre_rol'] == 'SA') {
    include 'public/administradorGeneralHeader.php';
} //menu con funcionalidades del administrador general

if ($_SESSION['usuario_nombre_rol'] == 'ADMIN') {
    include 'public/administradorHeader.php';
} //menu con funcionalidades del administrador
?>

<div id="myModal1" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="registrar-orden-form">
            <div class="divFormulario">
                <h1>Registra orden</h1>
                <label for="">Nombre de la orden</label>
                <input required type="text" id="registrarOrden" placeholder="Ingrese nombre de la orden">
                <button type="submit" class="btn-principal">Registrar orden</button>
            </div>
        </form>
    </div>
</div>

<div id="myModal2" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="registrar-familia-form">
            <div class="divFormulario">
                <h1>Registra familia</h1>
                <label for="">Nombre de la familia</label>
                <input required type="text" id="registrarFamilia" placeholder="Ingrese el nombre de la familia">
                <button type="submit" class="btn-principal">Registrar familia</button>
            </div>
        </form>
    </div>
</div>

<div id="myModal3" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="registrar-subfamilia-form">
            <div class="divFormulario">
                <h1>Registra subfamilia</h1>
                <label for="">Nombre de la subfamilia</label>
                <input required type="text" id="registrarsubFamilia" placeholder="Ingrese el nombre de la subfamilia">
                <button type="submit" class="btn-principal">Registrar subfamilia</button>
            </div>
        </form>
    </div>
</div>

<div id="myModal4" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="registrar-genero-form">
            <div class="divFormulario">
                <h1>Registra una genero</h1>
                <label for="">Nombre del genero</label>
                <input required type="text" id="registraGenero" placeholder="Ingrese el nombre del genero">
                <button type="submit" class="btn-principal">Registrar genero</button>
            </div>
        </form>
    </div>
</div>

<div id="myModal5" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="registrar-especie-form">
            <div class="divFormulario">
                <h1>Registra una especie</h1>
                <label for="">Nombre de la especie</label>
                <input required type="text" id="registraEspecie" placeholder="Ingrese el nombre de la especie">
                <button type="submit" class="btn-principal">Registrar especie</button>
            </div>
        </form>
    </div>
</div>

<main>

    <h1>Registro</h1>

    <div class="input_form">

        <label for="orden">Orden</label>

        <div class="input_form_inter">

            <select class="select_form" id="orden">
                <option disabled value="" selected>Selecciona una orden</option>
                <?php foreach ($vars['lista'] as $orden) { ?>
                    <option value="<?php echo $orden[0]; ?>"><?php echo $orden[1]; ?></option>
                <?php } ?>
            </select>

            <button class="btn_add" onclick="abrirModalRegistrar('myModal1')"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                </svg></button>

        </div>
    </div>


    <div class="input_form">
        <label>Familia</label>
        <div class="input_form_inter">

            <select class="form-control" id="familia" disabled>
                <option disabled value="" selected>Selecciona una familia</option>
            </select>
            <button class="btn_add" onclick="abrirModalRegistrar('myModal2')" disabled id="btnFamilia"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                </svg></button>

        </div>
    </div>


    <div class="input_form">

        <label>Subfamilia</label>

        <div class="input_form_inter">

            <select class="select_form" id="subfamilia" disabled>
                <option disabled value="" selected>Selecciona una sub familia</option>
            </select>
            <button class="btn_add" onclick="abrirModalRegistrar('myModal3')" disabled id="btnSubFamilia"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                </svg></button>
        </div>
    </div>

    <div class="input_form">
        <label>Género</label>
        <div class="input_form_inter">

            <select class="select_form" id="genero" disabled>
                <option disabled value="" selected>Selecciona un género</option>
            </select>
            <button class="btn_add" onclick="abrirModalRegistrar('myModal4')" disabled id="btnGenero"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
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
            <button class="btn_add" onclick="abrirModalRegistrar('myModal5')" disabled id="btnEspecie"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                </svg></button>
        </div>
    </div>

    <button class="back"><a href="?controlador=Index&accion=mostrar">Regresar</a></button>
</main>

<?php
include_once './public/footer.php';
?>

<script src="public/js/registrarTaxonomia.js"></script>
