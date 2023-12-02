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

$(document).ready(function () {
    $('#registrar-pais-form').submit(function (event) {
        event.preventDefault();
        let form_data = {
            pais: $('#registrarpais').val(),
        };

        $.ajax({
            type: "POST",
            url: "?controlador=Ubicacion&accion=registroPais",
            data: form_data,
            dataType: "json",
            success: function (response) {

                if (response[0].nombre_pais !== null) {
                    Swal.fire({
                        title: "Ingreso correcto",
                        text: "Se ingresó el pais " + response[0].nombre_pais,
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                    mostrarPais()
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "El número de gabinete debe ser único",
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
    $('#registrar-provincia-form').submit(function (event) {
        event.preventDefault();
        let form_data = {
            provincia: $('#registrarprovincia').val(),
            pais: $('#pais').val()
        };

        $.ajax({
            type: "POST",
            url: "?controlador=Ubicacion&accion=registroProvincia",
            data: form_data,
            dataType: "json",
            success: function (response) {

                if (response[0].nombre_provincia !== null) {
                    Swal.fire({
                        title: "Ingreso correcto",
                        text: "Se ingresó la provincia " + response[0].nombre_provincia,
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                    mostrarProvinciaPais($('#pais').val())
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "El número de gabinete debe ser único",
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
    $('#registrar-canton-form').submit(function (event) {
        event.preventDefault();
        let form_data = {
            canton: $('#registrarcanton').val(),
            provincia: $('#provincia').val()
        };

        $.ajax({
            type: "POST",
            url: "?controlador=Ubicacion&accion=registroCanton",
            data: form_data,
            dataType: "json",
            success: function (response) {

                if (response[0].nombre_canton !== null) {
                    Swal.fire({
                        title: "Ingreso correcto",
                        text: "Se ingresó la canton " + response[0].nombre_canton,
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                    mostrarCantonProvincia($('#provincia').val())
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "El número de gabinete debe ser único",
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
    $('#registrar-distrito-form').submit(function (event) {
        event.preventDefault();
        let form_data = {
            distrito: $('#registrardistrito').val(),
            canton: $('#canton').val()
        };

        $.ajax({
            type: "POST",
            url: "?controlador=Ubicacion&accion=registroDistrito",
            data: form_data,
            dataType: "json",
            success: function (response) {

                if (response[0].nombre_distrito !== null) {
                    Swal.fire({
                        title: "Ingreso correcto",
                        text: "Se ingresó el distrito " + response[0].nombre_distrito,
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                    mostrarDistritoCanton($('#canton').val())
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "El número de gabinete debe ser único",
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
    $('#registrar-vial-form').submit(function (event) {
        event.preventDefault();
        let form_data = {
            cod_vial: $('#registrarNumeroVial').val(),
            cod_caja: $('#caja').val()
        };

        $.ajax({
            type: "POST",
            url: "?controlador=Gavinete&accion=registrarVial",
            data: form_data,
            dataType: "json",
            success: function (response) {

                if (response.lista !== null) {
                    Swal.fire({
                        title: "Ingreso correcto",
                        text: "Se ingresó el gabinete con el número " + response.lista,
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                    let form_data = {
                        cod_caja: $('#caja').val()
                    };

                    $.ajax({
                        type: "POST",
                        url: "?controlador=Gavinete&accion=listarViales",
                        data: form_data,
                        dataType: "json",
                        success: function (response) {

                            let cantones = $('#vial');
                            cantones.empty();
                            cantones.append($('<option>', {
                                value: '',
                                text: 'Seleccione una gaveta',
                                selected: true,
                                disabled: true
                            }));
                            $.each(response.lista, function (i, canton) {
                                cantones.append($('<option>', {
                                    value: canton.id,
                                    text: 'Vial ' + canton.numero_vial
                                }));
                            });
                            cantones.prop('disabled', false);


                        },
                    });
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "El número de gabinete debe ser único",
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
    $('#registrar-recolecto-form').submit(function (event) {
        event.preventDefault();
        let form_data = {
            inicial: $('#inicialRegistrar').val(),
            apellidos: $('#apellidosRegistrar').val()
        };

        $.ajax({
            type: "POST",
            url: "?controlador=Usuario&accion=registroRecolector",
            data: form_data,
            dataType: "json",
            success: function (response) {

                if (response[0].p_primer_apellido !== null) {
                    Swal.fire({
                        title: "Ingreso correcto",
                        text: "Se ingresó el recolecto con el apellido" + response[0].p_primer_apellido,
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                    mostrarRecolectores();
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "El número de gabinete debe ser único",
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
    $('#registrar-gaveta-form').submit(function (event) {
        event.preventDefault();
        let form_data = {
            cod_gaveta: $('#registrarNumeroGaveta').val(),
            cod_gavetin: $('#gavetin').val()
        };
        console.log($('#gavetin').val())
        console.log(form_data)
        $.ajax({
            type: "POST",
            url: "?controlador=Gavinete&accion=registrarGaveta",
            data: form_data,
            dataType: "json",
            success: function (response) {
                console.log(response)
                if (response.lista !== null && response.lista[0].numero_gaveta !== null) {
                    Swal.fire({
                        title: "Ingreso correcto",
                        text: "Se ingresó la gaveta " + response.lista[0].numero_gaveta + " en el gavetin " + response.lista[0].numero_gabinete,
                        icon: "success",
                        confirmButtonText: "OK"
                    });

                    let form_data = {
                        cod_gavetin: $('#gavetin').val()
                    };

                    $.ajax({
                        type: "POST",
                        url: "?controlador=Gavinete&accion=listarGavetas",
                        data: form_data,
                        dataType: "json",
                        success: function (response) {
                            actualizarListaGavetas(response);
                        },
                    });
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "El número de gabinete debe ser único",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            },
            error: function (xhr, status, error) {
                alert(error + "c");
            }
        });
    });
});

function listarGavetas() {
    let form_data = {
        cod_gavetin: $('#gavetin').val()
    };

    $.ajax({
        type: "POST",
        url: "?controlador=Gavinete&accion=listarGavetas",
        data: form_data,
        dataType: "json",
        success: function (response) {
            actualizarListaGavetas(response);
        },
    });
}

function actualizarListaGavetas(response) {
    let form_data = {
        cod_gavetin: $('#gavetin').val()
    };

    if (response.lista.length > 0) {
        let cantones = $('#gaveta');

        cantones.empty();
        cantones.append($('<option>', {
            value: '',
            text: 'Seleccione una gaveta',
            selected: true,
            disabled: true
        }));
        $.each(response.lista, function (i, canton) {
            cantones.append($('<option>', {
                value: canton.id,
                text: 'Gaveta ' + canton.numero_gaveta
            }));
        });
        cantones.prop('disabled', false);
    }

    let botonModalGaveta = $('#botonModalGaveta');
    botonModalGaveta.prop('disabled', false);
}



$(document).ready(function () {
    $('#registrar-gavinete-form').submit(function (event) {
        event.preventDefault();
        let form_data = {
            cod_gavinete: $('#registrarNumeroGavinete').val(),
        };

        $.ajax({
            type: "POST",
            url: "?controlador=Gavinete&accion=registrarGavinete",
            data: form_data,
            dataType: "json",
            success: function (response) {

                if (response.lista !== null) {
                    Swal.fire({
                        title: "Ingreso correcto",
                        text: "Se ingresó el gabinete con el número " + response.lista,
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                    $.ajax({
                        type: "GET",
                        url: "?controlador=Gavinete&accion=listarGavetines",
                        dataType: "json",
                        success: function (response) {

                            obtenerListaGavinetes();

                            let gaveta = $('#gaveta');
                            gaveta.empty();
                            gaveta.append($('<option>', {
                                value: '',
                                text: 'Seleccione una gaveta',
                                selected: true,
                                disabled: true
                            }));

                            gaveta.prop('disabled', true);

                            let buttonGaveta = $('#gaveta');
                            buttonGaveta.prop('disabled', true);

                        },
                        error: function (xhr, status, error) {
                            console.log("Error en la solicitud AJAX:", error);
                        }
                    });
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "El número de gabinete debe ser único",
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
    $('#gavetin').change(function () {
        let form_data = {
            cod_gavetin: $('#gavetin').val()
        };
        $.ajax({
            type: "POST",
            url: "?controlador=Gavinete&accion=listarGavetas",
            data: form_data,
            dataType: "json",
            success: function (response) {
                let cantones = $('#gaveta');
                cantones.empty();
                cantones.append($('<option>', {
                    value: '',
                    text: 'Seleccione una gaveta',
                    selected: true,
                    disabled: true
                }));
                cantones.prop('disabled', true);
                if (response.lista.length > 0) {

                    $.each(response.lista, function (i, canton) {
                        cantones.append($('<option>', {
                            value: canton.id,
                            text: 'Gaveta ' + canton.numero_gaveta
                        }));
                    });
                    cantones.prop('disabled', false);
                }
                let botonModalGaveta = $('#botonModalGaveta');
                botonModalGaveta.prop('disabled', false);
            }
        });
    });
});

$(document).ready(function () {
    $('#caja').change(function () {
        let form_data = {
            cod_caja: $('#caja').val()
        };

        $.ajax({
            type: "POST",
            url: "?controlador=Gavinete&accion=listarViales",
            data: form_data,
            dataType: "json",
            success: function (response) {
                actualizarListaViales(response);
            },
        });
    });
});

function listarViales() {
    let form_data = {
        cod_caja: $('#caja').val()
    };

    $.ajax({
        type: "POST",
        url: "?controlador=Gavinete&accion=listarViales",
        data: form_data,
        dataType: "json",
        success: function (response) {
            actualizarListaViales(response);
        },
    });
}

function actualizarListaViales(response) {
    let cantones = $('#vial');
    cantones.empty();
    cantones.append($('<option>', {
        value: '',
        text: 'Seleccione una gaveta',
        selected: true,
        disabled: true
    }));
    $.each(response.lista, function (i, canton) {
        cantones.append($('<option>', {
            value: canton.id,
            text: 'Vial ' + canton.numero_vial
        }));
    });
    cantones.prop('disabled', false);
}


$(document).ready(function () {
    $('#registrar-caja-form').submit(function (event) {
        event.preventDefault();
        let form_data = {
            cod_caja: $('#registrarNumerocaja').val()
        };

        $.ajax({
            type: "POST",
            url: "?controlador=Gavinete&accion=registrarCaja",
            data: form_data,
            dataType: "json",
            success: function (response) {
                if (response.lista !== null) {
                    Swal.fire({
                        title: "Ingreso correcto",
                        text: "Se ingresó la caja con el número " + response.lista,
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                    $.ajax({
                        type: "GET",
                        url: "?controlador=Gavinete&accion=listarCajas",
                        dataType: "json",
                        success: function (response) {
                            let caja = $('#caja');
                            caja.empty();
                            caja.append($('<option>', {
                                value: '',
                                text: 'Seleccione una caja',
                                selected: true,
                                disabled: true
                            }));
                            $.each(response.lista, function (i, gab) {
                                caja.append($('<option>', {
                                    value: gab.id,
                                    text: 'Caja numero ' + gab.numero_caja
                                }));
                            });

                            caja.prop('disabled', false);
                        },
                        error: function (xhr, status, error) {
                            console.log("Error en la solicitud AJAX:", error);
                        }
                    });
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "El número de gabinete debe ser único",
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
    $('#registrarEspecimen').on('click', function () {
        let idEspecie = $('#especieIdentificacion').val();
        let idRecolector = $('#recolector').val();
        let idGenero = $('#generoIdentificacion').val();
        let distrito = $('#distrito').val();
        let latitud = $('#inputLatitud').val();
        let longitud = $('#inputLongitud').val();
        let fechaRecoleccion = $('#fechaRecoleccion').val();
        let archivos = $('#imagenes')[0].files;

        // Validar que los campos no estén vacíos
        if (idEspecie === '' || idRecolector === '' || idGenero === '' || distrito === '' || latitud === '' || longitud === '' || fechaRecoleccion === '' || archivos.length === 0) {
            alert('Por favor, complete todos los campos');
            return;
        }

        let formData = new FormData();
        formData.append('id_especie', idEspecie);
        formData.append('id_recolector', idRecolector);
        formData.append('id_genero', idGenero);
        formData.append('distrito', distrito);
        formData.append('latitud', latitud);
        formData.append('longitud', longitud);
        formData.append('fecha_recoleccion', fechaRecoleccion);

        // Agregar los archivos al objeto FormData
        for (let i = 0; i < archivos.length; i++) {
            formData.append('imagenes[]', archivos[i]);
        }

        if ($('#radioGaveta').prop('checked')) {
            let gaveta = $('#gaveta').val();

            if (gaveta === '') {
                alert('Por favor, complete todos los campos');
                return;
            }

            formData.append('gaveta', gaveta);

            $.ajax({
                type: 'POST',
                url: '?controlador=Especimen&accion=insertarEspecimenGaveta',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    if (response.nombre_genero !== null) {
                        Swal.fire({
                            title: "Ingreso correcto",
                            text: "Se registro el especimen con exito",
                            icon: "success",
                            confirmButtonText: "OK"
                        });
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: "No se registro el especimen",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log('Error en la solicitud AJAX:', error);
                }
            });
        } else {
            let vial = $('#vial').val();
            console.log(vial)

            if (vial === '') {
                alert('Por favor, complete todos los campos');
                return;
            }

            formData.append('vial', vial);

            $.ajax({
                type: 'POST',
                url: '?controlador=Especimen&accion=insertarEspecimenVial',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    if (response.nombre_genero !== null) {
                        Swal.fire({
                            title: "Ingreso correcto",
                            text: "Se registro el especimen con exito",
                            icon: "success",
                            confirmButtonText: "OK"
                        });
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: "No se registro el especimen",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log('Error en la solicitud AJAX:', error);
                }
            });
        }
    });
});





function mostrarPais() {

    $('#provincia, #canton, #distrito').prop('disabled', true);

    $('#pais').empty().append('<option value="" disabled selected>Seleccione un pais</option>');

    $('#provincia').empty().append('<option value="" disabled selected>Seleccione una provincia</option>');

    $('#canton').empty().append('<option value="" disabled selected>Seleccione un canton</option>');

    $('#distrito').empty().append('<option value="" disabled selected>Seleccione un distrito</option>');

    $.ajax({
        type: "GET",
        url: "?controlador=Ubicacion&accion=listarPais",
        dataType: "json",
        success: function (response) {
            $.each(response, function (index, orden) {
                $('<option>').val(orden.id_pais).text(orden.nombre).appendTo('#pais');
            });
        },
        error: function (xhr, status, error) {
            console.log("Error en la solicitud AJAX:", error);
        }
    });
}

$(document).ready(function () {
    $('#pais').on('change', function () {
        $('#provincia').prop('disabled', false);
        $('#provincia').empty().append('<option value="" disabled selected>Seleccione una provincia</option>');

        $('#canton').empty().append('<option value="" disabled selected>Seleccione un canton</option>');

        $('#distrito').empty().append('<option value="" disabled selected>Seleccione un distrito</option>');
        $('#canton, #distrito').prop('disabled', true);
        mostrarProvinciaPais($(this).val());
    });
});

function mostrarProvinciaPais(pais) {
    let parametros = {
        "pais": pais
    };
    $.ajax({
        data: parametros,
        url: '?controlador=Ubicacion&accion=listarProvinciaPorPais',
        type: 'post',
        success: function (response) {
            $.each(response, function (index, especie) {
                $('<option>').val(especie.id_provincia).text(especie.nombre).appendTo('#provincia');
            });
        }
    });
}

$(document).ready(function () {
    $('#provincia').on('change', function () {
        $('#canton').prop('disabled', false);
        $('#canton').empty().append('<option value="" disabled selected>Seleccione un canton</option>');
        $('#distrito').prop('disabled', true);
        mostrarCantonProvincia($(this).val());
    });
});

function mostrarCantonProvincia(provincia) {
    let parametros = {
        "provincia": provincia
    };
    $.ajax({
        data: parametros,
        url: '?controlador=Ubicacion&accion=listarCantonPorProvincia',
        type: 'post',
        success: function (response) {
            $.each(response, function (index, especie) {
                $('<option>').val(especie.id_canton).text(especie.nombre).appendTo('#canton');
            });
        }
    });
}

$(document).ready(function () {
    $('#canton').on('change', function () {
        $('#distrito').prop('disabled', false);
        $('#distrito').empty().append('<option value="" disabled selected>Seleccione un distrito</option>');
        mostrarDistritoCanton($(this).val());
    });
});

function mostrarDistritoCanton(canton) {
    let parametros = {
        "canton": canton
    };
    $.ajax({
        data: parametros,
        url: '?controlador=Ubicacion&accion=listarDistritoPorCanton',
        type: 'post',
        beforeSend: function () {
            $("#resultado").html("Procesando");
        },
        success: function (response) {
            $.each(response, function (index, especie) {
                $('<option>').val(especie.id_distrito).text(especie.nombre).appendTo('#distrito');
            });
        }
    });
}

function mostrarRecolectores() {
    $.ajax({
        type: "GET",
        url: "?controlador=Especimen&accion=listarRecolector",
        dataType: "json",
        success: function (response) {
            $.each(response, function (index, orden) {
                $('<option>').val(orden.id_recolector).text(orden.inicial_nombre + ', ' + orden.primer_apellido).appendTo('#recolector');
            });
        },
        error: function (xhr, status, error) {
            console.log("Error en la solicitud AJAX:", error);
        }
    });
}

function obtenerListaGavinetes() {
    $.ajax({
        type: "GET",
        url: "?controlador=Gavinete&accion=listarGavetines",
        dataType: "json",
        success: function (response) {

            let gavetin = $('#gavetin');
            gavetin.empty();
            gavetin.append($('<option>', {
                value: '',
                text: 'Seleccione un gavetin',
                selected: true,
                disabled: true
            }));
            $.each(response.lista, function (i, gab) {
                gavetin.append($('<option>', {
                    value: gab.id,
                    text: 'Gavetin numero ' + gab.numero_gabinete
                }));
            });
            gavetin.prop('disabled', false);

        },
        error: function (xhr, status, error) {
            console.log("Error en la solicitud AJAX:", error);
        }
    });
}

function obtenerListaCajas() {
    $.ajax({
        type: "GET",
        url: "?controlador=Gavinete&accion=listarCajas",
        dataType: "json",
        success: function (response) {
            let caja = $('#caja');
            caja.empty();
            caja.append($('<option>', {
                value: '',
                text: 'Seleccione una caja',
                selected: true,
                disabled: true
            }));
            $.each(response.lista, function (i, gab) {
                caja.append($('<option>', {
                    value: gab.id,
                    text: 'Caja numero ' + gab.numero_caja
                }));
            });

            caja.prop('disabled', false);
        },
        error: function (xhr, status, error) {
            console.log("Error en la solicitud AJAX:", error);
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
