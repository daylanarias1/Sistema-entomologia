$(document).ready(function () {
    $('#admin-form').submit(function (event) {
        event.preventDefault();
        let pass = CryptoJS.SHA256($('#admin-contrasena').val()).toString();
        let form_data = {
            cod_username: $('#admin-nombre').val(),
            cod_password: pass
        };

        $.ajax({
            type: "POST",
            url: "?controlador=Usuario&accion=registrarUsuario",
            data: form_data,
            dataType: "json",
            success: function (response) {
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
            error: function (xhr, status, error) {
                alert(error);
            }
        });
    });
});

$(document).ready(function () {
    $('#estudiante-docente-form').submit(function (event) {
        event.preventDefault();

        let pass = CryptoJS.SHA256($('#usuario-contrasena').val()).toString();
        let form_data = {
            cod_username: $('#usuario-nombre').val(),
            cod_password: pass,
            tipo: $('#tipo-usuario').val()
        };

        $.ajax({
            type: "POST",
            url: "?controlador=Usuario&accion=registrarUsuario",
            data: form_data,
            dataType: "json",
            success: function (response) {
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
            error: function (xhr, status, error) {
                alert(error);
            }
        });
    });
});
