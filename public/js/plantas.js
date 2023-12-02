function listarAllGeneros() {
    $.ajax({
        url: '?controlador=Taxonomia&accion=listarAllGeneros',
        type: 'post',
        beforeSend: function () {
            $("#resultado").html("Procesando");
        },
        success: function (response) {
            let gavetin = $('#generoIdentificacion');
            gavetin.empty();
            gavetin.append($('<option>', {
                value: '',
                text: 'Seleccione un genero',
                selected: true,
                disabled: true
            }));
            $.each(response, function (index, genero) {
                $('<option>').val(genero.id_genero).text(genero.nombre_genero).appendTo('#generoIdentificacion');
            });

        }
    });
}

function listarAllGenerosPlanta() {
    $.ajax({
        url: '?controlador=Taxonomia&accion=listarAllGeneros',
        type: 'post',
        beforeSend: function () {
            $("#resultado").html("Procesando");
        },
        success: function (response) {
            let gavetin = $('#generoIdentificacionPlanta');
            gavetin.empty();
            gavetin.append($('<option>', {
                value: '',
                text: 'Seleccione un genero',
                selected: true,
                disabled: true
            }));
            $.each(response, function (index, genero) {
                $('<option>').val(genero.id_genero).text(genero.nombre_genero).appendTo('#generoIdentificacionPlanta');
            });

        }
    });
}

function listarAllPlantas() {
    $.ajax({
        url: '?controlador=Planta&accion=listarAllPlantas',
        type: 'post',
        beforeSend: function () {
            $("#resultado").html("Procesando");
        },
        success: function (response) {
            let gavetin = $('#planta');
            gavetin.empty();
            gavetin.append($('<option>', {
                value: '',
                text: 'Seleccione una planta',
                selected: true,
                disabled: true
            }));
            $.each(response, function (index, genero) {
                $('<option>').val(genero.id_planta).text(genero.nombre).appendTo('#planta');
            });

        }
    });
}

function abrirModalRegistrar(idModal) {
    const modal = document.getElementById(idModal);

    const cerrar = modal.querySelector('.close');

    modal.style.display = 'block';

    cerrar.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (evento) => {
        if (evento.target == modal) {
            modal.style.display = 'none';
        }
    });
}

$(document).ready(function () {
    $('#eliminarAsociacionPlanta').click(function (event) {
        event.preventDefault();
        let form_data = {
            planta: $('#planta').val(),
            genero: $('#generoIdentificacionPlanta').val(),
        };
        $.ajax({
            type: "POST",
            url: "?controlador=Planta&accion=eliminarPlantaGenero",
            data: form_data,
            dataType: "json",
            success: function (response) {

                if (response[0].planta !== null) {
                    Swal.fire({
                        title: "Ingreso correcto",
                        text: "Se elimino la relacion",
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                    listarAllPlantas()
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "No se elimino la planta relacion",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            },
            error: function (xhr, status, error) {
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

$(document).ready(function () {
    $('#actualizar-planta-form').submit(function (event) {
        event.preventDefault();
        let form_data = {
            planta: $('#planta').val(),
            nuevo_nombre: $('#actualizarPlanta').val(),
        };
        $.ajax({
            type: "POST",
            url: "?controlador=Planta&accion=actualizarPlanta",
            data: form_data,
            dataType: "json",
            success: function (response) {

                if (response[0].planta !== null) {
                    Swal.fire({
                        title: "Ingreso correcto",
                        text: "Se actualizo la planta " + response[0].planta,
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                    listarAllPlantas()
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "No se actualizo la planta",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            },
            error: function (xhr, status, error) {
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


$(document).ready(function () {
    $('#registrar-planta-genero-form').submit(function (event) {
        event.preventDefault();
        let form_data = {
            planta: $('#planta').val(),
            genero: $('#generoIdentificacionPlanta').val(),
        };

        $.ajax({
            type: "POST",
            url: "?controlador=Planta&accion=asociarPlantaGenero",
            data: form_data,
            dataType: "json",
            success: function (response) {

                if (response[0].planta !== null) {
                    Swal.fire({
                        title: "Ingreso correcto",
                        text: "Se asocio la planta correctamente",
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "La planta ya esta asociada",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            },
            error: function (xhr, status, error) {
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


$(document).ready(function () {
    $('#registrar-planta-form').submit(function (event) {
        event.preventDefault();
        let form_data = {
            planta: $('#registrarPlanta').val(),
        };

        $.ajax({
            type: "POST",
            url: "?controlador=Planta&accion=insertarPlantas",
            data: form_data,
            dataType: "json",
            success: function (response) {

                if (response[0].planta !== null) {
                    Swal.fire({
                        title: "Ingreso correcto",
                        text: "Se registro la planta " + response[0].planta,
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                    listarAllPlantas()
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "No se registro la planta",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            },
            error: function (xhr, status, error) {
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