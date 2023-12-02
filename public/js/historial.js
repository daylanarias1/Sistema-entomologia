function previousPageHistorial() {
    if (currentPage > 1) {
        currentPage = currentPage - 1;
        if ($('#anioRegistro').val() === '') {
            let fechaInicio = new Date($('#fechaInicio').val());
            let fechaFin = new Date($('#fechaFinal').val());

            let form_data = {
                fechaInicio: fechaInicio.toISOString().split('T')[0],
                fechaFin: fechaFin.toISOString().split('T')[0],
                pagina: currentPage
            };

            $.ajax({
                type: "POST",
                url: "?controlador=Usuario&accion=registroRango",
                data: form_data,
                dataType: "json",
                success: function (response) {
                    if (response.lista[0] && response.lista[0].username !== null) {
                        pegarTabla(response)
                    } else {
                        Swal.fire({
                            icon: 'info',
                            title: 'No hay mas registros o no se encontraron registros'
                        })
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        } else {
            let form_data = {
                anioBusqueda: $('#anioRegistro').val(),
                pagina: currentPage
            };
            $.ajax({
                type: "POST",
                url: "?controlador=Usuario&accion=registroAnio",
                data: form_data,
                dataType: "json",
                success: function (response) {

                    if (response.lista[0] && response.lista[0].username !== null) {
                        pegarTabla(response)
                    } else {
                        Swal.fire({
                            icon: 'info',
                            title: 'No hay mas registros o no se encontraron registros'
                        })
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        }
    }
}

function nextPageHistorial() {
    currentPage = currentPage + 1;
    //fetchUsers(currentPage);
    if ($('#anioRegistro').val() === '') {
        let fechaInicio = new Date($('#fechaInicio').val());
        let fechaFin = new Date($('#fechaFinal').val());

        let form_data = {
            fechaInicio: fechaInicio.toISOString().split('T')[0],
            fechaFin: fechaFin.toISOString().split('T')[0],
            pagina: currentPage
        };

        $.ajax({
            type: "POST",
            url: "?controlador=Usuario&accion=registroRango",
            data: form_data,
            dataType: "json",
            success: function (response) {
                if (response.lista[0] && response.lista[0].username !== null) {
                    pegarTabla(response)
                } else {
                    currentPage = currentPage - 1;
                    Swal.fire({
                        icon: 'info',
                        title: 'No hay mas registros o no se encontraron registros'
                    })
                }
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    } else {
        let form_data = {
            anioBusqueda: $('#anioRegistro').val(),
            pagina: currentPage
        };
        $.ajax({
            type: "POST",
            url: "?controlador=Usuario&accion=registroAnio",
            data: form_data,
            dataType: "json",
            success: function (response) {

                if (response.lista[0] && response.lista[0].username !== null) {
                    pegarTabla(response)
                } else {
                    currentPage = currentPage - 1;
                    Swal.fire({
                        icon: 'info',
                        title: 'No hay mas registros o no se encontraron registros'
                    })
                }

            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    }
}

$(document).ready(function () {
    $('#formRangoFechas').submit(function (event) {
        event.preventDefault();
        currentPage = 1;
        let fechaInicio = new Date($('#fechaInicio').val());
        let fechaFin = new Date($('#fechaFinal').val());

        let form_data = {
            fechaInicio: fechaInicio.toISOString().split('T')[0],
            fechaFin: fechaFin.toISOString().split('T')[0],
            pagina: currentPage
        };

        $.ajax({
            type: "POST",
            url: "?controlador=Usuario&accion=registroRango",
            data: form_data,
            dataType: "json",
            success: function (response) {
                if (response.lista[0] && response.lista[0].username !== null) {
                    pegarTabla(response)
                } else {
                    Swal.fire({
                        icon: 'info',
                        title: 'No hay mas registros o no se encontraron registros'
                    })
                }
                document.getElementById("prevButton").disabled = false;
                document.getElementById("nextButton").disabled = false;
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    });
});

$(document).ready(function () {
    $('#formAnio').submit(function (event) {
        event.preventDefault();
        currentPage = 1;
        let form_data = {
            anioBusqueda: $('#anioRegistro').val(),
            pagina: currentPage
        };
        $.ajax({
            type: "POST",
            url: "?controlador=Usuario&accion=registroAnio",
            data: form_data,
            dataType: "json",
            success: function (response) {
                if (response.lista[0] && response.lista[0].username !== null) {
                    pegarTabla(response)
                } else {
                    Swal.fire({
                        icon: 'info',
                        title: 'No hay mas registros o no se encontraron registros'
                    })
                }
                document.getElementById("prevButton").disabled = false;
                document.getElementById("nextButton").disabled = false;
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    });
});

function pegarTabla(response) {

    let tbody = $('#cuerpo');
    tbody.empty();
    for (let i = 0; i < response.lista.length; i++) {
        let registro = response.lista[i];
        let row = $('<tr></tr>');
        row.append('<td>' + registro.username + '</td>');
        row.append('<td>' + registro.descripcion + '</td>');
        row.append('<td>' + registro.fecha + '</td>');
        tbody.append(row);
    }
}