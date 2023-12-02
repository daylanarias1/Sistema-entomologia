function mostrarOrdenes() {
    $.ajax({
        type: "GET",
        url: "?controlador=Taxonomia&accion=listarOrden",
        dataType: "json",
        success: function (response) {
            $("#orden").empty();
            $.each(response, function (index, orden) {
                $('<option>').val(orden.id_orden).text(orden.nombre_orden).appendTo('#orden');
            });
        },
        error: function (xhr, status, error) {
            console.log("Error en la solicitud AJAX:", error);
        }
    });
}

$(document).ready(function () {
    $('#actualizar-orden-form').submit(function (event) {
        event.preventDefault();
        let form_data = {
            orden_nombre: $('#actualizarOrden').val(),
            orden_id: $('#orden').val(),
        };

        $.ajax({
            type: "POST",
            url: "?controlador=Taxonomia&accion=actualizarOrden",
            data: form_data,
            dataType: "json",
            success: function (response) {

                if (response[0].orden !== null) {
                    Swal.fire({
                        title: "Registro correcto",
                        text: "Se actualizo el orden con el nombre " + response[0].orden,
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                    mostrarOrdenes();
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "No se actualizo la orden",
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

$('#actualizar-familia-form').submit(function (event) {
    event.preventDefault();
    let form_data = {
        familia_nombre: $('#actualizarFamilia').val(),
        familia_id: $('#familia').val(),
    };

    $.ajax({
        type: "POST",
        url: "?controlador=Taxonomia&accion=actualizarFamilia",
        data: form_data,
        dataType: "json",
        success: function (response) {
            if (response[0].familia !== null) {
                Swal.fire({
                    title: "Registro correcto",
                    text: "Se actualizó la familia con el nombre " + response[0].familia,
                    icon: "success",
                    confirmButtonText: "OK"
                });
                mostrarFamilia($('#orden').val());
            } else {
                Swal.fire({
                    title: "Error",
                    text: "No se actualizó la familia",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            }
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: "Error",
                text: "Algo salió mal",
                icon: "error",
                confirmButtonText: "OK"
            });
        }
    });
});

$('#actualizar-subfamilia-form').submit(function (event) {
    event.preventDefault();
    let form_data = {
        subfamilia_nombre: $('#actualizarSubfamilia').val(),
        subfamilia_id: $('#subfamilia').val(),
    };

    $.ajax({
        type: "POST",
        url: "?controlador=Taxonomia&accion=actualizarSubfamilia",
        data: form_data,
        dataType: "json",
        success: function (response) {
            if (response[0].subFamilia !== null) {
                Swal.fire({
                    title: "Registro correcto",
                    text: "Se actualizó la subfamilia con el nombre " + response[0].subFamilia,
                    icon: "success",
                    confirmButtonText: "OK"
                });
                mostrarSubFamilia($('#familia').val())
            } else {
                Swal.fire({
                    title: "Error",
                    text: "No se actualizó la subfamilia",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            }
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: "Error",
                text: "Algo salió mal",
                icon: "error",
                confirmButtonText: "OK"
            });
        }
    });
});

$('#actualizar-genero-form').submit(function (event) {
    event.preventDefault();
    let form_data = {
        genero_nombre: $('#actualizarGenero').val(),
        genero_id: $('#genero').val(),
    };

    $.ajax({
        type: "POST",
        url: "?controlador=Taxonomia&accion=actualizarGenero",
        data: form_data,
        dataType: "json",
        success: function (response) {
            if (response[0].genero !== null) {
                Swal.fire({
                    title: "Registro correcto",
                    text: "Se actualizó el género con el nombre " + response[0].genero,
                    icon: "success",
                    confirmButtonText: "OK"
                });

                if ($('#asociarFamilia').is(':checked')) {

                    $.ajax({
                        data: {
                            familia: $('#familia').val()
                        },
                        url: '?controlador=Taxonomia&accion=listarGeneroPorFamilia',
                        type: 'post',
                        success: function (response) {

                            let selectGenero = $('#genero');
                            selectGenero.empty();
                            selectGenero.prop("disabled", false);

                            $.each(response, function (index, genero) {
                                $('<option>').val(genero.id_genero).text(genero.nombre_genero).appendTo(selectGenero);
                            });
                        }
                    })
                } else {
                    mostrarGenerosSubFamilia($('#subfamilia').val())
                }
            } else {
                Swal.fire({
                    title: "Error",
                    text: "No se actualizó el género",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            }
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: "Error",
                text: "Algo salió mal",
                icon: "error",
                confirmButtonText: "OK"
            });
        }
    });
});

$('#actualizar-especie-form').submit(function (event) {
    event.preventDefault();
    let form_data = {
        especie_nombre: $('#actualizarEspecie').val(),
        especie_id: $('#especie').val(),
    };

    $.ajax({
        type: "POST",
        url: "?controlador=Taxonomia&accion=actualizarEspecie",
        data: form_data,
        dataType: "json",
        success: function (response) {
            if (response[0].especie !== null) {
                Swal.fire({
                    title: "Registro correcto",
                    text: "Se actualizó la especie con el nombre " + response[0].especie,
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
        error: function (xhr, status, error) {
            Swal.fire({
                title: "Error",
                text: "Algo salió mal",
                icon: "error",
                confirmButtonText: "OK"
            });
        }
    });
});













$(document).ready(function () {
    $('#orden').on('change', function () {
        mostrarFamilia($(this).val());
    });
});

function mostrarFamilia(orden) {
    let parametros = {
        "orden": orden
    };
    $.ajax({
        data: parametros,
        url: '?controlador=Taxonomia&accion=listarFamiliasPorOrden',
        type: 'post',
        beforeSend: function () {
            $("#resultado").html("Procesando");
        },
        success: function (response) {
            let selectFamilia = $('#familia');
            selectFamilia.empty();
            selectFamilia.prop("disabled", false); // Habilitar select

            $('<option>').val("").text("Selecciona una familia").prop("disabled", true).prop("selected", true).appendTo(selectFamilia);

            let selectSubfamilia = $('#subfamilia');
            selectSubfamilia.empty();
            selectSubfamilia.prop("disabled", true); // Deshabilitar select

            $('<option>').val("").text("Selecciona una sub familia").prop("disabled", true).prop("selected", true).appendTo(selectSubfamilia);


            let selectGenero = $('#genero');
            selectGenero.empty();
            selectGenero.prop("disabled", true); // Deshabilitar select

            $('<option>').val("").text("Selecciona un genero").prop("disabled", true).prop("selected", true).appendTo(selectGenero);

            let selectEspecie = $('#especie');
            selectEspecie.empty();
            selectEspecie.prop("disabled", true); // Deshabilitar select

            $('<option>').val("").text("Selecciona una especie").prop("disabled", true).prop("selected", true).appendTo(selectEspecie);

            $.each(response, function (index, familia) {
                $('<option>').val(familia.id_familia).text(familia.nombre_familia).appendTo(selectFamilia);
            });


            $('#btnFamilia').prop("disabled", false);
            $('#btnSubFamilia').prop("disabled", true);
            $('#btnGenero').prop("disabled", true);
            $('#btnEspecie').prop("disabled", true);
        }
    });
}

$(document).ready(function () {
    $('#familia').on('change', function () {
        mostrarSubFamilia($(this).val());
    });
});

function mostrarSubFamilia(familia) {
    let parametros = {
        "familia": familia
    };
    $.ajax({
        data: parametros,
        url: '?controlador=Taxonomia&accion=listarSubfamiliasPorFamilia',
        type: 'post',
        beforeSend: function () {
            $("#resultado").html("Procesando");
        },
        success: function (response) {

            let selectSubfamilia = $('#subfamilia');
            selectSubfamilia.empty();
            selectSubfamilia.prop("disabled", false); // Deshabilitar select

            $('<option>').val("").text("Selecciona una sub familia").prop("disabled", true).prop("selected", true).appendTo(selectSubfamilia);


            let selectGenero = $('#genero');
            selectGenero.empty();
            selectGenero.prop("disabled", true); // Deshabilitar select

            $('<option>').val("").text("Selecciona un genero").prop("disabled", true).prop("selected", true).appendTo(selectGenero);

            let selectEspecie = $('#especie');
            selectEspecie.empty();
            selectEspecie.prop("disabled", true); // Deshabilitar select

            $('<option>').val("").text("Selecciona una especie").prop("disabled", true).prop("selected", true).appendTo(selectEspecie);

            $('#btnSubFamilia').prop("disabled", false);
            $('#btnGenero').prop("disabled", true);
            $('#btnEspecie').prop("disabled", true);

            $.each(response, function (index, subfamilia) {
                $('<option>').val(subfamilia.id_subfamilia).text(subfamilia.nombre_subfamilia).appendTo('#subfamilia');
            });

            if ($('#asociarFamilia').is(':checked')) {

                let selectGenero = $('#genero');
                selectGenero.empty();
                selectGenero.prop("disabled", false);

                $('<option>').val("").text("Selecciona un genero").prop("disabled", true).prop("selected", true).appendTo(selectGenero);

                $('#btnGenero').prop("disabled", false);

                $.ajax({
                    data: parametros,
                    url: '?controlador=Taxonomia&accion=listarGeneroPorFamilia',
                    type: 'post',
                    success: function (response) {
                        $.each(response, function (index, genero) {
                            $('<option>').val(genero.id_genero).text(genero.nombre_genero).appendTo(selectGenero);
                        });
                    }
                })
            }
        }
    });
}


$(document).ready(function () {
    $('#subfamilia').on('change', function () {
        mostrarGenerosSubFamilia($(this).val());
    });
});

function mostrarGenerosSubFamilia(subfamilia) {
    let parametros = {
        "subfamilia": subfamilia
    };
    $.ajax({
        data: parametros,
        url: '?controlador=Taxonomia&accion=listarGeneroPorSubFamilia',
        type: 'post',
        beforeSend: function () {
            $("#resultado").html("Procesando");
        },
        success: function (response) {

            let selectGenero = $('#genero');
            selectGenero.empty();
            selectGenero.prop("disabled", false); // Deshabilitar select

            $('<option>').val("").text("Selecciona un genero").prop("disabled", true).prop("selected", true).appendTo(selectGenero);

            let selectEspecie = $('#especie');
            selectEspecie.empty();
            selectEspecie.prop("disabled", true); // Deshabilitar select

            $('<option>').val("").text("Selecciona una especie").prop("disabled", true).prop("selected", true).appendTo(selectEspecie);

            $('#btnGenero').prop("disabled", false);
            $('#btnEspecie').prop("disabled", true);

            $.each(response, function (index, genero) {
                $('<option>').val(genero.id_genero).text(genero.nombre_genero).appendTo('#genero');
            });
        }
    });
}



$(document).ready(function () {
    $('#generoIdentificacion').on('change', function () {
        mostrarEspecieGeneroRegistro($(this).val());
    });
});

function mostrarEspecieGeneroRegistro(genero) {
    let parametros = {
        "genero": genero
    };
    $.ajax({
        data: parametros,
        url: '?controlador=Taxonomia&accion=listarEspeciePorGenero',
        type: 'post',
        beforeSend: function () {
            $("#resultado").html("Procesando");
        },
        success: function (response) {
            console.log('dfsdfsdfsdf')
            let gavetin = $('#especieIdentificacion');
            gavetin.empty();

            gavetin.append($('<option>', {
                value: '',
                text: 'Seleccione una especie',
                selected: true,
                disabled: true
            }));

            gavetin.append($('<option>', {
                value: '-2',
                text: 'SP',
                selected: false,
                disabled: false
            }));


            $.each(response, function (index, especie) {
                $('<option>').val(especie.id_especie).text(especie.nombre_especie).appendTo('#especieIdentificacion');
            });
        }
    });
}


$(document).ready(function () {
    $('#genero').on('change', function () {
        mostrarEspecieGenero($(this).val());
    });
});

function mostrarEspecieGenero(genero) {
    let parametros = {
        "genero": genero
    };
    $.ajax({
        data: parametros,
        url: '?controlador=Taxonomia&accion=listarEspeciePorGenero',
        type: 'post',
        beforeSend: function () {
            $("#resultado").html("Procesando");
        },
        success: function (response) {

            let selectEspecie = $('#especie');
            selectEspecie.empty();
            selectEspecie.prop("disabled", false); // Deshabilitar select
            $('#btnEspecie').prop("disabled", false);


            $('<option>').val("").text("Selecciona una especie").prop("disabled", true).prop("selected", true).appendTo(selectEspecie);

            $.each(response, function (index, especie) {
                $('<option>').val(especie.id_especie).text(especie.nombre_especie).appendTo('#especie');
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


function mostrarOrdenesActualizar() {
    $.ajax({
        type: "GET",
        url: "?controlador=Taxonomia&accion=listarOrden",
        dataType: "json",
        success: function (response) {
            $("#ordenActualizar").empty();
            $.each(response, function (index, orden) {
                $('<option>').val(orden.id_orden).text(orden.nombre_orden).appendTo('#ordenActualizar');
            });
        },
        error: function (xhr, status, error) {
            console.log("Error en la solicitud AJAX:", error);
        }
    });
}

$(document).ready(function () {
    $('#ordenActualizar').on('change', function () {
        mostrarFamiliaActualizar($(this).val());
    });
});

function mostrarFamiliaActualizar(orden) {
    let parametros = {
        "orden": orden
    };
    $.ajax({
        data: parametros,
        url: '?controlador=Taxonomia&accion=listarFamiliasPorOrden',
        type: 'post',
        beforeSend: function () {
            $("#resultado").html("Procesando");
        },
        success: function (response) {
            let selectFamilia = $('#familiaActualizar');
            selectFamilia.empty();
            selectFamilia.prop("disabled", false); // Habilitar select

            $('<option>').val("").text("Selecciona una familia").prop("disabled", true).prop("selected", true).appendTo(selectFamilia);

            let selectSubfamilia = $('#subfamiliaActualizar');
            selectSubfamilia.empty();
            selectSubfamilia.prop("disabled", true); // Deshabilitar select

            $('<option>').val("").text("Selecciona una sub familia").prop("disabled", true).prop("selected", true).appendTo(selectSubfamilia);


            let selectGenero = $('#generoActualizar');
            selectGenero.empty();
            selectGenero.prop("disabled", true); // Deshabilitar select

            $('<option>').val("").text("Selecciona un genero").prop("disabled", true).prop("selected", true).appendTo(selectGenero);

            $.each(response, function (index, familia) {
                $('<option>').val(familia.id_familia).text(familia.nombre_familia).appendTo(selectFamilia);
            });
        }
    });
}

$(document).ready(function () {
    $('#familiaActualizar').on('change', function () {
        mostrarSubFamiliaActualizar($(this).val());
    });
});

function mostrarSubFamiliaActualizar(familia) {
    let parametros = {
        "familia": familia
    };
    $.ajax({
        data: parametros,
        url: '?controlador=Taxonomia&accion=listarSubfamiliasPorFamilia',
        type: 'post',
        beforeSend: function () {
            $("#resultado").html("Procesando");
        },
        success: function (response) {

            let selectSubfamilia = $('#subfamiliaActualizar');
            selectSubfamilia.empty();
            selectSubfamilia.prop("disabled", false); // Deshabilitar select

            $('<option>').val("").text("Selecciona una sub familia").prop("disabled", true).prop("selected", true).appendTo(selectSubfamilia);


            let selectGenero = $('#generoActualizar');
            selectGenero.empty();
            selectGenero.prop("disabled", true); // Deshabilitar select

            $('<option>').val("").text("Selecciona un genero").prop("disabled", true).prop("selected", true).appendTo(selectGenero);

            $.each(response, function (index, subfamilia) {
                $('<option>').val(subfamilia.id_subfamilia).text(subfamilia.nombre_subfamilia).appendTo('#subfamiliaActualizar');
            });

            if ($('#asociarFamiliaActualizar').is(':checked')) {

                let selectGenero = $('#genero');
                selectGenero.empty();
                selectGenero.prop("disabled", false);

                $('<option>').val("").text("Selecciona un genero").prop("disabled", true).prop("selected", true).appendTo(selectGenero);

                $.ajax({
                    data: parametros,
                    url: '?controlador=Taxonomia&accion=listarGeneroPorFamilia',
                    type: 'post',
                    success: function (response) {
                        $.each(response, function (index, genero) {
                            $('<option>').val(genero.id_genero).text(genero.nombre_genero).appendTo(selectGenero);
                        });
                    }
                })
            }
        }
    });
}

$(document).ready(function () {
    $('#subfamiliaActualizar').on('change', function () {
        mostrarGenerosSubFamiliaActualizar($(this).val());
    });
});

function mostrarGenerosSubFamiliaActualizar(subfamilia) {
    let parametros = {
        "subfamilia": subfamilia
    };
    $.ajax({
        data: parametros,
        url: '?controlador=Taxonomia&accion=listarGeneroPorSubFamilia',
        type: 'post',
        beforeSend: function () {
            $("#resultado").html("Procesando");
        },
        success: function (response) {

            let selectGenero = $('#generoActualizar');
            selectGenero.empty();
            selectGenero.prop("disabled", false); // Deshabilitar select

            $('<option>').val("").text("Selecciona un genero").prop("disabled", true).prop("selected", true).appendTo(selectGenero);

            $.each(response, function (index, genero) {
                $('<option>').val(genero.id_genero).text(genero.nombre_genero).appendTo('#generoActualizar');
            });
        }
    });
}