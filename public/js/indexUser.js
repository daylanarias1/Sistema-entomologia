
const addToCart = document.querySelectorAll('[data-btn-action="add-btn-cart"]');

const closeModal = document.querySelector('.jsModalClose');

addToCart.forEach(btn => {

    btn.addEventListener('click', (event) => {

        const nameModal = event.target.getAttribute('data-modal');

        const modal = document.querySelector(nameModal);

        //abrimos el modal
        modal.classList.add('active');

    })

});

//CERRAR EL MODAL
closeModal.addEventListener('click', (event) => {
    event.target.parentNode.parentNode.classList.remove('active');
})

//CERRAMOS MODAL CUANDO HACEMOS CLICK FUERA DEL CONTENDINO DEL MODAL
window.onclick = (event) => {
    const modal = document.querySelector('.modal.active');

    if (event.target == modal) {
        modal.classList.remove('active');
    }
}

function obtenerNumeroCarrito() {
    $.ajax({
        url: '?controlador=Carrito&accion=numeroCarrito',
        type: 'post',
        success: function (respuesta) {
            actualizarCarrito(respuesta);
        }
    });
}

function actualizarCarrito(respuesta) {
    if (respuesta.lista[0].total > 0) {
        var cartcount = document.getElementById('cartcount');
        cartcount.textContent = respuesta.lista[0].total;
        cartcount.style.display = 'inline';
    } else {
        var cartcount = document.getElementById('cartcount');
        cartcount.style.display = 'none';
    }
}


$(document).ready(function () {
    $('#btnVerCarrito').click(function () {
        verCarrito();
    });
});


function verCarrito() {
    $.ajax({
        type: "POST",
        url: "?controlador=Carrito&accion=verCarritoGenero",
        dataType: "json",
        success: function (response) {

            var generoDiv = $('.modal_carrito_body_genero');
            generoDiv.empty();
            var listaGenero = response.lista;

            $.each(listaGenero, function (index, item) {
                var id = item.id_genero;
                var nombre = item.nombre_genero;
                generoDiv.append('<div class="divCarrito"><h2>Nombre: ' + nombre + '</h2>' +
                    '<div><button class="btn-eliminar" onclick="eliminarGenero(' + id + ')">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="white" class="bi bi-trash" viewBox="0 0 15 15">' +
                    '<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>' +
                    '<path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>' +
                    '</svg>' +
                    '</button>' +
                    '<button onclick="listaEspecimenGenero(' + id + '); abrirModalRegistrar(\'myModal1\')" class="btn-primary">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="white" class="bi bi-info-lg" viewBox="0 0 16 14">' +
                    '<path d="m9.708 6.075-3.024.379-.108.502.595.108c.387.093.464.232.38.619l-.975 4.577c-.255 1.183.14 1.74 1.067 1.74.72 0 1.554-.332 1.933-.789l.116-.549c-.263.232-.65.325-.905.325-.363 0-.494-.255-.402-.704l1.323-6.208Zm.091-2.755a1.32 1.32 0 1 1-2.64 0 1.32 1.32 0 0 1 2.64 0Z"/>' +
                    '</svg>' +
                    '</button></div></div>');
            });
        },
    });

    $.ajax({
        type: "POST",
        url: "?controlador=Carrito&accion=verCarritoEspecie",
        dataType: "json",
        success: function (response) {

            var especieDiv = $('.modal_carrito_body_especie');
            especieDiv.empty();

            var listaEspecies = response.lista;

            $.each(listaEspecies, function (index, item) {
                var id = item.id_especie;
                var nombre = item.nombre_especie;
                especieDiv.append('<div class="divCarrito"><h2>Nombre: ' + nombre + '</h2>' +
                    '<div><button class="btn-eliminar" onclick="eliminarEspecie(' + id + ')">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="white" class="bi bi-trash" viewBox="0 0 15 15">' +
                    '<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>' +
                    '<path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>' +
                    '</svg>' +
                    '</button>' +
                    '<button onclick="listaEspecimenEspecie(' + id + '); abrirModalRegistrar(\'myModal1\')" class="btn-primary">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="white" class="bi bi-info-lg" viewBox="0 0 16 14">' +
                    '<path d="m9.708 6.075-3.024.379-.108.502.595.108c.387.093.464.232.38.619l-.975 4.577c-.255 1.183.14 1.74 1.067 1.74.72 0 1.554-.332 1.933-.789l.116-.549c-.263.232-.65.325-.905.325-.363 0-.494-.255-.402-.704l1.323-6.208Zm.091-2.755a1.32 1.32 0 1 1-2.64 0 1.32 1.32 0 0 1 2.64 0Z"/>' +
                    '</svg>' +
                    '</button>' +
                    '</div></div>');
            });
        }
    });
}

function eliminarGenero(id) {
    $.ajax({
        type: "POST",
        url: "?controlador=Carrito&accion=eliminarCarritoGenero",
        data: { genero: id },
        dataType: "json",
        success: function (response) {
            verCarrito();
            obtenerNumeroCarrito();
            buscarGenero();
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function eliminarEspecie(id) {
    $.ajax({
        type: "POST",
        url: "?controlador=Carrito&accion=eliminarCarritoEspecie",
        data: { especie: id },
        dataType: "json",
        success: function (response) {
            verCarrito();
            obtenerNumeroCarrito();
        },
        error: function (error) {
            console.log(error);
        }
    });
}

obtenerNumeroCarrito();

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

function detallesEspecimen(id) {

    var form_data = {
        especimen: id
    };

    $.ajax({
        type: "POST",
        url: "?controlador=Especimen&accion=getEspecimen",
        data: form_data,
        dataType: "json",
        success: function (response) {
            if (response.length === 0 || response[0].username === null) {
                Swal.fire({
                    icon: 'error',
                    title: 'No hay mas registros'
                })
            } else {
                especimen(response[0]);
            }
        }
    });

}

function especimen(response) {

    images = []

    var imagenesComa = response.imagenes_especimen.split(',');
    for (let index = 0; index < imagenesComa.length; index++) {
        var rutaImagen = imagenesComa[index].replace(/\\/g, '').replace(/"/g, '');
        images.push(rutaImagen)
    }

    var tabla = '<div>' +
        '<h1>Ubicacion de Taxonomia</h1>' +
        `<p>Orden: ${response.nombre_orden}</p>` +
        `<p>Familia: ${response.nombre_familia}</p>` +
        `<p>Sub familia: ${response.nombre_subfamilia}</p>` +
        `<p>Genero: ${response.nombre_genero}</p>` +
        `<p>Especie: ${response.nombre_especie}</p>`
    tabla += '</div>';

    tabla += '<div>' +
        '<h1>Ubicacion de recoleccion</h1>' +
        `<p>Pais: ${response.pais}</p>` +
        `<p>Provincia: ${response.provincia}</p>` +
        `<p>Canton: ${response.canton}</p>` +
        `<p>Distrito: ${response.distrito}</p>`
    tabla += '</div>';

    tabla += '<div>' +
        '<h1>Geolocalizacion</h1>' +
        `<p>Latitud: ${response.latitud}</p>` +
        `<p>Longitud: ${response.longitud}</p>`
    tabla += '</div>';

    tabla += '<div>' +
        '<h1>Recolector</h1>' +
        `<p>Recolecto: ${response.recolector_inicial_nombre + ', ' + response.recolector_primer_apellido}</p>`
    tabla += '</div>';

    tabla += '<div>' +
        '<h1>Plantas hosdedadoras</h1>' +
        `<p>${response.plantas_asociadas}</p>`
    tabla += '</div>';

    tabla += '<div>' +
        '<h1>Ubicacion del especimen</h1>' +
        `<p>${response.ubicacion_especimen}</p>`
    tabla += '</div>';

    var divTabla = document.getElementById("detallesEspecimenes");
    divTabla.innerHTML = tabla;

    showSlides();
}

function listaEspecimenEspecie(especie) {

    var parametros = {
        "especie": especie,
    };
    $.ajax({
        type: "POST",
        url: "?controlador=Especimen&accion=especimenEspecie",
        data: parametros,
        dataType: "json",

        success: function (respuesta) {
            if (respuesta.mensaje !== null) {
                generarTablaEspecimenes(respuesta)
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Ocurrio un error'
                });
            }
        }
    });
}

function generarTablaEspecimenes(response) {
    var tabla = '<table>' +
        '<tr>' +
        '<th>Imagen</th>' +
        '<th>Ubicacion</th>' +
        '<th>Geolocalizacion</th>' +
        '<th>Fecha</th>' +
        '<th>Accion</th>' +
        '</tr>';
    
    for (var i = 0; i < response.length; i++) {
        var rutaImagen;
        if (response[i].ruta_imagen !== null) {
            rutaImagen = response[i].ruta_imagen.replace(/\\/g, '').replace(/"/g, '');
        }
        var imagen = '<img width="100px" height="100px" alt="Imagem especimen" src="' + rutaImagen + '">';
        tabla += '<tr>' +
            '<td>' + imagen + '</td>' +
            '<td>' + response[i].pais + ', ' + response[i].provincia + ', ' +
            response[i].canton + ', ' + response[i].distrito + '</td>' +
            '<td> L: ' + response[i].latitud + ',<br>Lon: ' + response[i].longitud + '</td>' +
            '<td>' + response[i].fecha_recoleccion + '</td>' +
            '<td>' +
            '<button onclick="detallesEspecimen(' + response[i].id_especimen + '); abrirModalRegistrar(\'myModal2\')"  class="btn-success">' +
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 21" width="25" height="18" fill="none" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">' +
            '<path d="M13 7h9v2h-9zm0 8h9v2h-9zm3-4h6v2h-6zm-3 1L8 7v4H2v2h6v4z"/>' +
            '</svg>' +
            '</button></td>' +
            '</tr>';
    }

    tabla += '</table>';

    var divTabla = document.getElementById("tablaEspecimenes");
    divTabla.innerHTML = tabla;
}

function listaEspecimenGenero(genero) {

    var parametros = {
        "genero": genero,
    };
    $.ajax({
        type: "POST",
        url: "?controlador=Especimen&accion=especimenGenero",
        data: parametros,
        dataType: "json",

        success: function (respuesta) {
            if (respuesta.mensaje !== null) {
                generarTablaEspecimenes(respuesta)
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Ocurrio un error'
                });
            }
        }
    });
}

function agregarCarritoEspecie(especie) {
    var parametros = {
        "especie": especie,
    };
    $.ajax({
        type: "POST",
        url: "?controlador=Carrito&accion=agregarAlCarritoEspecie",
        data: parametros,
        dataType: "json",

        success: function (respuesta) {
            if (respuesta.mensaje !== null) {
                buscarEspecie();
                Toast.fire({
                    icon: 'success',
                    title: 'Especie agregada al carrito'
                });
                obtenerNumeroCarrito();
                //buscarEspecieVistos();
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Ocurrio un error'
                });
            }
        }
    });
}

function eliminarCarritoEspecie(especie) {
    var parametros = {
        "especie": especie,
    };
    $.ajax({
        type: "POST",
        url: "?controlador=Carrito&accion=eliminarDelCarritoEspecie",
        data: parametros,
        dataType: "json",

        success: function (respuesta) {
            if (respuesta.mensaje !== null) {
                buscarEspecie();
                Toast.fire({
                    icon: 'success',
                    title: 'Especie agregada al carrito'
                });
                obtenerNumeroCarrito();
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Ocurrio un error'
                });
            }
        }
    });
}

function agregarVistoEspecie(especie) {
    var parametros = {
        "especie": especie,
    };
    $.ajax({
        type: "POST",
        url: "?controlador=Carrito&accion=agregarVistoEspecie",
        data: parametros,
        dataType: "json",

        success: function (respuesta) {
            if (respuesta.mensaje !== null) {
                buscarEspecie();
                Toast.fire({
                    icon: 'success',
                    title: 'Especie agregada a vistos'
                });
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Ocurrio un error'
                });
            }
        }
    });
}

function eliminarVistoEspecie(especie) {
    var parametros = {
        "especie": especie,
    };
    $.ajax({
        type: "POST",
        url: "?controlador=Carrito&accion=eliminarVistoEspecie",
        data: parametros,
        dataType: "json",

        success: function (respuesta) {
            if (respuesta.mensaje !== null) {
                buscarEspecie();
                Toast.fire({
                    icon: 'success',
                    title: 'Especie eliminada de vistos'
                });
                // buscarEspecieVistos();
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Ocurrio un error'
                });
            }
        }
    });
}









function agregarCarritogeneroPlanta(genero) {
    var parametros = {
        "genero": genero,
    };
    $.ajax({
        type: "POST",
        url: "?controlador=Carrito&accion=agregarAlCarritoGenero",
        data: parametros,
        dataType: "json",

        success: function (respuesta) {
            if (respuesta.mensaje !== null) {
                buscarPlanta();
                Toast.fire({
                    icon: 'success',
                    title: 'genero agregada al carrito'
                });
                obtenerNumeroCarrito();
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Ocurrio un error'
                });
            }
        }
    });
}

function eliminarCarritogeneroPlanta(genero) {
    var parametros = {
        "genero": genero,
    };
    $.ajax({
        type: "POST",
        url: "?controlador=Carrito&accion=eliminarDelCarritoGenero",
        data: parametros,
        dataType: "json",

        success: function (respuesta) {
            if (respuesta.mensaje !== null) {
                buscarPlanta();
                Toast.fire({
                    icon: 'success',
                    title: 'genero agregada al carrito'
                });
                obtenerNumeroCarrito();
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Ocurrio un error'
                });
            }
        }
    });
}

function agregarVistogeneroPlanta(genero) {
    var parametros = {
        "genero": genero,
    };
    $.ajax({
        type: "POST",
        url: "?controlador=Carrito&accion=agregarVistoGenero",
        data: parametros,
        dataType: "json",

        success: function (respuesta) {
            if (respuesta.mensaje !== null) {
                buscarPlanta();
                Toast.fire({
                    icon: 'success',
                    title: 'genero agregada a vistos'
                });
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Ocurrio un error'
                });
            }
        }
    });
}

function eliminarVistogeneroPlanta(genero) {
    var parametros = {
        "genero": genero,
    };
    $.ajax({
        type: "POST",
        url: "?controlador=Carrito&accion=eliminarVistoGenero",
        data: parametros,
        dataType: "json",

        success: function (respuesta) {
            if (respuesta.mensaje !== null) {
                buscarPlanta();
                Toast.fire({
                    icon: 'success',
                    title: 'genero eliminada de vistos'
                });
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Ocurrio un error'
                });
            }
        }
    });
}

















function agregarCarritogenero(genero) {
    var parametros = {
        "genero": genero,
    };
    $.ajax({
        type: "POST",
        url: "?controlador=Carrito&accion=agregarAlCarritoGenero",
        data: parametros,
        dataType: "json",

        success: function (respuesta) {
            if (respuesta.mensaje !== null) {
                buscarGenero();
                Toast.fire({
                    icon: 'success',
                    title: 'genero agregada al carrito'
                });
                obtenerNumeroCarrito();
                //buscarGeneroVistos();
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Ocurrio un error'
                });
            }
        }
    });
}

function eliminarCarritogenero(genero) {
    var parametros = {
        "genero": genero,
    };
    $.ajax({
        type: "POST",
        url: "?controlador=Carrito&accion=eliminarDelCarritoGenero",
        data: parametros,
        dataType: "json",

        success: function (respuesta) {
            if (respuesta.mensaje !== null) {
                buscarGenero();
                Toast.fire({
                    icon: 'success',
                    title: 'genero agregada al carrito'
                });
                obtenerNumeroCarrito();
                //buscarGeneroVistos();
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Ocurrio un error'
                });
            }
        }
    });
}

function agregarVistogenero(genero) {
    var parametros = {
        "genero": genero,
    };
    $.ajax({
        type: "POST",
        url: "?controlador=Carrito&accion=agregarVistoGenero",
        data: parametros,
        dataType: "json",

        success: function (respuesta) {
            if (respuesta.mensaje !== null) {
                buscarGenero();
                Toast.fire({
                    icon: 'success',
                    title: 'genero agregada a vistos'
                });
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Ocurrio un error'
                });
            }
        }
    });
}

function eliminarVistogenero(genero) {
    var parametros = {
        "genero": genero,
    };
    $.ajax({
        type: "POST",
        url: "?controlador=Carrito&accion=eliminarVistoGenero",
        data: parametros,
        dataType: "json",

        success: function (respuesta) {
            if (respuesta.mensaje !== null) {
                buscarGenero();
                Toast.fire({
                    icon: 'success',
                    title: 'genero eliminada de vistos'
                });
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Ocurrio un error'
                });
            }
        }
    });
}


function buscarEspecie() {

    var form_data = {
        genero: $('#busqueda').val(),
        numero: currentPage
    };

    $.ajax({
        type: "POST",
        url: "?controlador=Taxonomia&accion=buscargenero",
        data: form_data,
        dataType: "json",
        success: function (response) {
            if (response.length === 0 || response[0].username === null) {
                if (currentPage !== 1) {
                    currentPage = currentPage - 1;
                    Swal.fire({
                        icon: 'info',
                        title: 'No hay mas registros'
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'No hay mas registros'
                    })
                }
            } else {
                
                generoT(response);
                document.getElementById("prevButton").disabled = false;
                document.getElementById("nextButton").disabled = false;
            }
        }
    });
}

function generoT(response) {
    
    var tabla = '<table>' +
        '<tr>' +
        '<th>Orden</th>' +
        '<th>Familia</th>' +
        '<th>Subfamilia</th>' +
        '<th>Género</th>' +
        '<th>Acciones</th>' +
        '</tr>';

    for (var i = 0; i < response.length; i++) {
        tabla += '<tr>' +
            '<td>' + response[i].nombre_orden + '</td>' +
            '<td>' + response[i].nombre_familia + '</td>' +
            '<td>' + response[i].nombre_subfamilia + '</td>' +
            '<td>' + response[i].nombre_genero + '</td>' +
            '<td>';

        if (response[i].visto === "0") {
            tabla += '<button onclick="agregarVistogenero(' + response[i].id_genero + ')" class="btn-success">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="white" class="bi bi-eye" viewBox="0 0 16 14">' +
                '<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>' +
                '<path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>' +
                '</svg>' +
                '</button>';
        } else {
            tabla += '<button onclick="eliminarVistogenero(' + response[i].id_genero + ')" class="btn-delete">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 14">' +
                '<path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>' +
                '<path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>' +
                '<path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>' +
                '</svg>' +
                '</button>';
        }

        if (response[i].en_carrito === "0") {

            tabla += '<button onclick="agregarCarritogenero(' + response[i].id_genero + ')" class="btn-success">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="white" class="bi bi-cart-plus" viewBox="0 0 16 14">' +
                '<path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>' +
                '<path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>' +
                '</svg>' +
                '</button>';

        } else {
            tabla += '<button onclick="eliminarCarritogenero(' + response[i].id_genero + ')" class="btn-delete">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="white" class="bi bi-cart-x" viewBox="0 0 16 14">' +
                '<path d="M7.354 5.646a.5.5 0 1 0-.708.708L7.793 7.5 6.646 8.646a.5.5 0 1 0 .708.708L8.5 8.207l1.146 1.147a.5.5 0 0 0 .708-.708L9.207 7.5l1.147-1.146a.5.5 0 0 0-.708-.708L8.5 6.793 7.354 5.646z"/>' +
                '<path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>' +
                '</svg>' +
                '</button>';
        }

        tabla += '<button onclick="listaEspecimenGenero(' + response[i].id_genero + '); abrirModalRegistrar(\'myModal1\')" class="btn-primary">' +
            '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="white" class="bi bi-info-lg" viewBox="0 0 16 14">' +
            '<path d="m9.708 6.075-3.024.379-.108.502.595.108c.387.093.464.232.38.619l-.975 4.577c-.255 1.183.14 1.74 1.067 1.74.72 0 1.554-.332 1.933-.789l.116-.549c-.263.232-.65.325-.905.325-.363 0-.494-.255-.402-.704l1.323-6.208Zm.091-2.755a1.32 1.32 0 1 1-2.64 0 1.32 1.32 0 0 1 2.64 0Z"/>' +
            '</svg>' +
            '</button>';



        tabla += '</td>';
    }

    tabla += '</table>';

    document.getElementById('resultado').innerHTML = tabla;
}

function buscarGenero() {

    var form_data = {
        genero: $('#busqueda').val(),
        numero: currentPage
    };

    $.ajax({
        type: "POST",
        url: "?controlador=Taxonomia&accion=buscargenero",
        data: form_data,
        dataType: "json",
        success: function (response) {
            if (response.length === 0 || response[0].username === null) {
                if (currentPage !== 1) {
                    currentPage = currentPage - 1;
                    Swal.fire({
                        icon: 'info',
                        title: 'No hay mas registros'
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'No hay mas registros'
                    })
                }
            } else {
                
                generoT(response);
                document.getElementById("prevButton").disabled = false;
                document.getElementById("nextButton").disabled = false;
            }
        }
    });
}

function generoT(response) {
    var tabla = '<table>' +
        '<tr>' +
        '<th>Orden</th>' +
        '<th>Familia</th>' +
        '<th>Subfamilia</th>' +
        '<th>Género</th>' +
        '<th>Acciones</th>' +
        '</tr>';

    for (var i = 0; i < response.length; i++) {
        tabla += '<tr>' +
            '<td>' + response[i].nombre_orden + '</td>' +
            '<td>' + response[i].nombre_familia + '</td>' +
            '<td>' + response[i].nombre_subfamilia + '</td>' +
            '<td>' + response[i].nombre_genero + '</td>' +
            '<td>';

        if (response[i].visto === "0") {
            tabla += '<button onclick="agregarVistogenero(' + response[i].id_genero + ')" class="btn-success">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="white" class="bi bi-eye" viewBox="0 0 16 14">' +
                '<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>' +
                '<path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>' +
                '</svg>' +
                '</button>';
        } else {
            tabla += '<button onclick="eliminarVistogenero(' + response[i].id_genero + ')" class="btn-delete">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 14">' +
                '<path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>' +
                '<path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>' +
                '<path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>' +
                '</svg>' +
                '</button>';
        }

        if (response[i].en_carrito === "0") {

            tabla += '<button onclick="agregarCarritogenero(' + response[i].id_genero + ')" class="btn-success">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="white" class="bi bi-cart-plus" viewBox="0 0 16 14">' +
                '<path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>' +
                '<path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>' +
                '</svg>' +
                '</button>';

        } else {
            tabla += '<button onclick="eliminarCarritogenero(' + response[i].id_genero + ')" class="btn-delete">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="white" class="bi bi-cart-x" viewBox="0 0 16 14">' +
                '<path d="M7.354 5.646a.5.5 0 1 0-.708.708L7.793 7.5 6.646 8.646a.5.5 0 1 0 .708.708L8.5 8.207l1.146 1.147a.5.5 0 0 0 .708-.708L9.207 7.5l1.147-1.146a.5.5 0 0 0-.708-.708L8.5 6.793 7.354 5.646z"/>' +
                '<path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>' +
                '</svg>' +
                '</button>';
        }

        tabla += '<button onclick="listaEspecimenGenero(' + response[i].id_genero + '); abrirModalRegistrar(\'myModal1\')" class="btn-primary">' +
            '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="white" class="bi bi-info-lg" viewBox="0 0 16 14">' +
            '<path d="m9.708 6.075-3.024.379-.108.502.595.108c.387.093.464.232.38.619l-.975 4.577c-.255 1.183.14 1.74 1.067 1.74.72 0 1.554-.332 1.933-.789l.116-.549c-.263.232-.65.325-.905.325-.363 0-.494-.255-.402-.704l1.323-6.208Zm.091-2.755a1.32 1.32 0 1 1-2.64 0 1.32 1.32 0 0 1 2.64 0Z"/>' +
            '</svg>' +
            '</button>';



        tabla += '</td>';
    }

    tabla += '</table>';

    document.getElementById('resultado').innerHTML = tabla;
}

function buscarEspecie() {

    var form_data = {
        especie: $('#busqueda').val(),
        numero: currentPage
    };

    $.ajax({
        type: "POST",
        url: "?controlador=Taxonomia&accion=buscarEspecie",
        data: form_data,
        dataType: "json",
        success: function (response) {
            if (response.length === 0 || response[0].username === null) {
                if (currentPage !== 1) {
                    currentPage = currentPage - 1;
                    Swal.fire({
                        icon: 'info',
                        title: 'No hay mas registros'
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'No hay mas registros'
                    })
                }
            } else {
                
                especieT(response);
                document.getElementById("prevButton").disabled = false;
                document.getElementById("nextButton").disabled = false;
            }
        }
    });
}

function especieT(response) {
    var tabla = '<table>' +
        '<tr>' +
        '<th>Orden</th>' +
        '<th>Familia</th>' +
        '<th>Subfamilia</th>' +
        '<th>Género</th>' +
        '<th>Especie</th>' +
        '<th>Acciones</th>' +
        '</tr>';

    for (var i = 0; i < response.length; i++) {
        tabla += '<tr>' +
            '<td>' + response[i].nombre_orden + '</td>' +
            '<td>' + response[i].nombre_familia + '</td>' +
            '<td>' + response[i].nombre_subfamilia + '</td>' +
            '<td>' + response[i].nombre_genero + '</td>' +
            '<td>' + response[i].nombre_especie + '</td>' +
            '<td>';

        if (response[i].visto_especie === "0") {
            tabla += '<button onclick="agregarVistoEspecie(' + response[i].id_especie + ')" class="btn-success">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="white" class="bi bi-eye" viewBox="0 0 16 14">' +
                '<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>' +
                '<path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>' +
                '</svg>' +
                '</button>';
        } else {
            tabla += '<button onclick="eliminarVistoEspecie(' + response[i].id_especie + ')" class="btn-delete">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 14">' +
                '<path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>' +
                '<path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>' +
                '<path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>' +
                '</svg>' +
                '</button>';
        }

        if (response[i].en_carrito_especie === "0") {

            tabla += '<button onclick="agregarCarritoEspecie(' + response[i].id_especie + ')" class="btn-success">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="white" class="bi bi-cart-plus" viewBox="0 0 16 14">' +
                '<path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>' +
                '<path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>' +
                '</svg>' +
                '</button>';

        } else {
            tabla += '<button onclick="eliminarCarritoEspecie(' + response[i].id_especie + ')" class="btn-delete">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="white" class="bi bi-cart-x" viewBox="0 0 16 14">' +
                '<path d="M7.354 5.646a.5.5 0 1 0-.708.708L7.793 7.5 6.646 8.646a.5.5 0 1 0 .708.708L8.5 8.207l1.146 1.147a.5.5 0 0 0 .708-.708L9.207 7.5l1.147-1.146a.5.5 0 0 0-.708-.708L8.5 6.793 7.354 5.646z"/>' +
                '<path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>' +
                '</svg>' +
                '</button>';
        }

        tabla += '<button onclick="listaEspecimenEspecie(' + response[i].id_especie + '); abrirModalRegistrar(\'myModal1\')" class="btn-primary">' +
            '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="white" class="bi bi-info-lg" viewBox="0 0 16 14">' +
            '<path d="m9.708 6.075-3.024.379-.108.502.595.108c.387.093.464.232.38.619l-.975 4.577c-.255 1.183.14 1.74 1.067 1.74.72 0 1.554-.332 1.933-.789l.116-.549c-.263.232-.65.325-.905.325-.363 0-.494-.255-.402-.704l1.323-6.208Zm.091-2.755a1.32 1.32 0 1 1-2.64 0 1.32 1.32 0 0 1 2.64 0Z"/>' +
            '</svg>' +
            '</button>';



        tabla += '</td>';
    }

    tabla += '</table>';

    document.getElementById('resultado').innerHTML = tabla;
}

function buscarPlanta() {

    var form_data = {
        planta: $('#busqueda').val(),
        numero: currentPage
    };

    $.ajax({
        type: "POST",
        url: "?controlador=Planta&accion=buscarPlanta",
        data: form_data,
        dataType: "json",
        success: function (response) {
            if (response.length === 0 || response[0].username === null) {
                if (currentPage !== 1) {
                    currentPage = currentPage - 1;
                    Swal.fire({
                        icon: 'info',
                        title: 'No hay mas registros'
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'No hay mas registros'
                    })
                }
            } else {
                
                generoTPlanta(response);
                document.getElementById("prevButton").disabled = false;
                document.getElementById("nextButton").disabled = false;
            }
        }
    });
}


function generoTPlanta(response) {
    var tabla = '<table>' +
        '<tr>' +
        '<th>Orden</th>' +
        '<th>Familia</th>' +
        '<th>Subfamilia</th>' +
        '<th>Género</th>' +
        '<th>Acciones</th>' +
        '</tr>';

    for (var i = 0; i < response.length; i++) {
        tabla += '<tr>' +
            '<td>' + response[i].nombre_orden + '</td>' +
            '<td>' + response[i].nombre_familia + '</td>' +
            '<td>' + response[i].nombre_subfamilia + '</td>' +
            '<td>' + response[i].nombre_genero + '</td>' +
            '<td>';

        if (response[i].visto === "0") {
            tabla += '<button onclick="agregarVistogeneroPlanta(' + response[i].id_genero + ')" class="btn-success">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="white" class="bi bi-eye" viewBox="0 0 16 14">' +
                '<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>' +
                '<path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>' +
                '</svg>' +
                '</button>';
        } else {
            tabla += '<button onclick="eliminarVistogeneroPlanta(' + response[i].id_genero + ')" class="btn-delete">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 14">' +
                '<path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>' +
                '<path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>' +
                '<path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>' +
                '</svg>' +
                '</button>';
        }

        if (response[i].en_carrito === "0") {

            tabla += '<button onclick="agregarCarritogeneroPlanta(' + response[i].id_genero + ')" class="btn-success">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="white" class="bi bi-cart-plus" viewBox="0 0 16 14">' +
                '<path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>' +
                '<path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>' +
                '</svg>' +
                '</button>';

        } else {
            tabla += '<button onclick="eliminarCarritogeneroPlanta(' + response[i].id_genero + ')" class="btn-delete">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="white" class="bi bi-cart-x" viewBox="0 0 16 14">' +
                '<path d="M7.354 5.646a.5.5 0 1 0-.708.708L7.793 7.5 6.646 8.646a.5.5 0 1 0 .708.708L8.5 8.207l1.146 1.147a.5.5 0 0 0 .708-.708L9.207 7.5l1.147-1.146a.5.5 0 0 0-.708-.708L8.5 6.793 7.354 5.646z"/>' +
                '<path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>' +
                '</svg>' +
                '</button>';
        }

        tabla += '<button onclick="listaEspecimenGenero(' + response[i].id_genero + '); abrirModalRegistrar(\'myModal1\')" class="btn-primary">' +
            '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="white" class="bi bi-info-lg" viewBox="0 0 16 14">' +
            '<path d="m9.708 6.075-3.024.379-.108.502.595.108c.387.093.464.232.38.619l-.975 4.577c-.255 1.183.14 1.74 1.067 1.74.72 0 1.554-.332 1.933-.789l.116-.549c-.263.232-.65.325-.905.325-.363 0-.494-.255-.402-.704l1.323-6.208Zm.091-2.755a1.32 1.32 0 1 1-2.64 0 1.32 1.32 0 0 1 2.64 0Z"/>' +
            '</svg>' +
            '</button>';



        tabla += '</td>';
    }

    tabla += '</table>';

    document.getElementById('resultado').innerHTML = tabla;
}

function buscarGeneroVistos() {

    var form_data = {
        numero: currentPage
    };

    $.ajax({
        type: "POST",
        url: "?controlador=Carrito&accion=generoVisto",
        data: form_data,
        dataType: "json",
        success: function (response) {
            if (response.length === 0 || response[0].username === null) {
                if (currentPage !== 1) {
                    Swal.fire({
                        icon: 'info',
                        title: 'No hay mas registros'
                    })
                    currentPage = currentPage - 1;
                } else {
                    document.getElementById("resultado").innerHTML = '';
                    document.getElementById("resultado").appendChild(document.createElement("h1")).textContent = "No hay generos vistas";
                }
        } else {
            
                generoT(response);
                document.getElementById("prevButton").disabled = false;
            document.getElementById("nextButton").disabled = false;
        }
    }
    });
}

function buscarEspecieVistos() {

    var form_data = {
        numero: currentPage
    };

    $.ajax({
        type: "POST",
        url: "?controlador=Carrito&accion=especiesVisto",
        data: form_data,
        dataType: "json",
        success: function (response) {
            if (response.length === 0 || response[0].username === null) {
                if (currentPage !== 1) {
                    Swal.fire({
                        icon: 'info',
                        title: 'No hay mas registros'
                    })
                    currentPage = currentPage - 1;
                } else {
                    document.getElementById("resultado").innerHTML = '';
                    document.getElementById("resultado").appendChild(document.createElement("h1")).textContent = "No hay especies vistas";
                }
            } else {
                especieT(response);
                document.getElementById("prevButton").disabled = false;
                document.getElementById("nextButton").disabled = false;
            }
        }
    });
}