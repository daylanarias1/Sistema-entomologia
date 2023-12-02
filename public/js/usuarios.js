


function fetchUsers(page) {
    let form_data = {
        cod_page: page
    };

    $.ajax({
        type: "POST",
        url: "?controlador=Usuario&accion=usuariosPage",
        data: form_data,
        dataType: "json",
        success: function (response) {

            if (response.lista[0].username === null) {
                Swal.fire({
                    icon: 'info',
                    title: 'No hay mas registros'
                })
                currentPage = currentPage - 1;
            } else {
                let tbody = document.getElementById("cuerpo");
                tbody.innerHTML = "";
                for (let i = 0; i < response.lista.length; i++) {
                    (function () {
                        let parque = response.lista[i];
                        let row = document.createElement("tr");

                        let usernameCell = document.createElement("td");
                        usernameCell.textContent = parque[0];
                        row.appendChild(usernameCell);

                        let nombreRolCell = document.createElement("td");
                        nombreRolCell.textContent = parque[1];
                        row.appendChild(nombreRolCell);

                        let activoCell = document.createElement("td");
                        let checkbox = document.createElement("input");
                        checkbox.type = "checkbox";
                        checkbox.name = "";
                        checkbox.onclick = function () {
                            cambiarEstadoUsuario(parque[0]);
                        };

                        if (parque[2] == 1) {
                            checkbox.checked = true;
                        }

                        activoCell.appendChild(checkbox);

                        row.appendChild(activoCell);

                        tbody.appendChild(row);
                    })();
                }
            }
        },
    });
}


function cambiarEstadoUsuario(username) {
    let form_data = {
        cod_username: username
    };
    $.ajax({
        type: "POST",
        url: "?controlador=Usuario&accion=cambiarEstadoUsuarios",
        data: form_data,
        dataType: "json",
        success: function (response) {
            if (response.lista[0].username !== null) {
                Swal.fire({
                    icon: 'success',
                    title: 'Se cambio el estado del usuario'
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ocurrio un error'
                })
            }

        },
    });
}