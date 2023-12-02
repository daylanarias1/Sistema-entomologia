


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
    $('#registrar-orden-form').submit(function (event) {
        event.preventDefault();
        let form_data = {
            nombre_orden: $('#registrarOrden').val(),
        };

        $.ajax({
            type: "POST",
            url: "?controlador=Taxonomia&accion=registroOrden",
            data: form_data,
            dataType: "json",
            success: function (response) {

                if (response.lista[0].nombre !== null) {
                    Swal.fire({
                        title: "Registro correcto",
                        text: "Se registro el orden con el nombre " + response.lista[0].nombre,
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                    mostrarOrdenes();
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "No se registro la orden",
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
    $('#registrar-familia-form').submit(function (event) {
        event.preventDefault();
        let form_data = {
            nombre_familia: $('#registrarFamilia').val(),
            id_orden: $('#orden').val()
        };

        $.ajax({
            type: "POST",
            url: "?controlador=Taxonomia&accion=registroFamilia",
            data: form_data,
            dataType: "json",
            success: function (response) {
                if (response.lista[0].nombre !== null) {
                    Swal.fire({
                        title: "Registro correcto",
                        text: "Se registro la familia con el nombre " + response.lista[0].nombre,
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                    mostrarFamilia($('#orden').val());
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "No se registro la familia",
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
    $('#registrar-subfamilia-form').submit(function (event) {
        event.preventDefault();
        let form_data = {
            nombre_subFamilia: $('#registrarsubFamilia').val(),
            id_familia: $('#familia').val()
        };

        $.ajax({
            type: "POST",
            url: "?controlador=Taxonomia&accion=registroSubFamilia",
            data: form_data,
            dataType: "json",
            success: function (response) {
                if (response.lista[0].nombre !== null) {
                    Swal.fire({
                        title: "Registro correcto",
                        text: "Se registro la subfamilia con el nombre " + response.lista[0].nombre,
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                    mostrarSubFamilia($('#familia').val())
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "No se registro la subfamilia",
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
    $('#registrar-genero-form').submit(function (event) {
        event.preventDefault();
        if ($('#asociarFamilia').is(':checked')) {
            let form_data = {
                nombre_genero: $('#registraGenero').val(),
                id_familia: $('#familia').val()
            };
            $.ajax({
                type: "POST",
                url: "?controlador=Taxonomia&accion=registroGeneroFamilia",
                data: form_data,
                dataType: "json",
                success: function (response) {



                    if (response.lista[0].nombre_genero !== null) {
                        Swal.fire({
                            title: "Registro correcto",
                            text: "Se ingresó el genero " + response.lista[0].nombre_genero,
                            icon: "success",
                            confirmButtonText: "OK"
                        });


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
                        Swal.fire({
                            title: "Error",
                            text: "No se ingresó el genero",
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

        } else {

            let form_data = {
                nombre_genero: $('#registraGenero').val(),
                id_subfamilia: $('#subfamilia').val()
            };
            $.ajax({
                type: "POST",
                url: "?controlador=Taxonomia&accion=registroGeneroSubFamilia",
                data: form_data,
                dataType: "json",
                success: function (response) {

                    if (response.lista[0].nombre_genero !== null) {
                        Swal.fire({
                            title: "Registro correcto",
                            text: "Se registro el genero " + response.lista[0].nombre_genero,
                            icon: "success",
                            confirmButtonText: "OK"
                        });
                        mostrarGenerosSubFamilia($('#subfamilia').val())
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: "No se ingresó el genero",
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

        }

    });
});

$(document).ready(function () {
    $('#registrar-especie-form').submit(function (event) {
        event.preventDefault();
        let form_data = {
            nombre_genero: $('#registraEspecie').val(),
            id_genero: $('#genero').val()
        };
        $.ajax({
            type: "POST",
            url: "?controlador=Taxonomia&accion=registroEspecie",
            data: form_data,
            dataType: "json",
            success: function (response) {
                if (response.lista[0].nombre !== null) {
                    Swal.fire({
                        title: "Registro correcto",
                        text: "Se registro la especie " + response.lista[0].nombre,
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                    mostrarEspecieGenero($('#genero').val())
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "No se registro la especie",
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


