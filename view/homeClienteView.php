<?php
include 'public/clienteHeader.php';
?>

<main>

<script>
    var images = [];
</script>

    <h1>Recomendaciones</h1>

    <style>
        /* Slideshow container */
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        /* Hide the images by default */
        .mySlides {
            display: none;
        }

        /* Next & previous buttons */
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            margin-top: -22px;
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }
    </style>

    <div class="slideshow-container" id="dynamic-slideshow"></div>


    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            if (slides.length > 0) {
  // Acceder a los elementos del array
  slides[slideIndex - 1].style.display = "block";
}
        }
    </script>

    <script>
        $.ajax({
            url: '?controlador=Usuario&accion=recomendaciones',
            type: 'post',
            success: function(response) {
                var dynamicSlideshow = document.getElementById('dynamic-slideshow');

                // Limpiar el contenido del contenedor
                dynamicSlideshow.innerHTML = '';

                // Iterar sobre la lista de imágenes en la respuesta
                for (var i = 0; i < response.lista.length; i++) {
                    var imageInfo = response.lista[i];

                    // Crear el elemento <div class="mySlides fade">
                    var slideDiv = document.createElement('div');
                    slideDiv.className = 'mySlides fade';

                    // Crear el elemento <img src="ruta_imagen" style="width:100%">
                    var image = document.createElement('img');
                    image.src = imageInfo.ruta_imagen.replace(/"/g, ''); // Eliminar las comillas dobles alrededor de la ruta de imagen
                    image.style.width = '300px';

                    // Agregar el onclick al div o la imagen
                    slideDiv.onclick = function() {
                        detallesEspecimen(imageInfo.id_especimen);
                        abrirModalRegistrar('myModal2');
                    };

                    // Agregar la imagen al slideDiv
                    slideDiv.appendChild(image);

                    // Agregar el slideDiv al contenedor dynamicSlideshow
                    dynamicSlideshow.appendChild(slideDiv);
                }

                // Agregar los botones de navegación después de agregar todas las imágenes
                var prevButton = document.createElement('a');
                prevButton.className = 'prev';
                prevButton.innerHTML = '&#10094;';
                prevButton.setAttribute('onclick', 'plusSlides(-1)');
                dynamicSlideshow.appendChild(prevButton);

                var nextButton = document.createElement('a');
                nextButton.className = 'next';
                nextButton.innerHTML = '&#10095;';
                nextButton.setAttribute('onclick', 'plusSlides(1)');
                dynamicSlideshow.appendChild(nextButton);

                // Iniciar el slideshow
                showSlides(1);
            }
        });




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
    </script>








    <div id="myModal2" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="divFormulario">
                <h1>Detalles del especimen</h1>
                <div id="detallesEspecimen">
                    <div class="slideshow-container">
                        <div class="mySlidesCarrosel fade">
                            <a class="prevCarrosel" onclick="plusSlidess(-1)">&#10094;</a>
                            <img id="imagen" src="" width="100px" height="100px">
                            <a class="nextCarrosel" onclick="plusSlidess(1)">&#10095;</a>
                        </div>
                    </div>
                    <div class="y" id="detallesEspecimenes">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function detallesEspecimen(id) {

            var form_data = {
                especimen: id
            };

            $.ajax({
                type: "POST",
                url: "?controlador=Especimen&accion=getEspecimen",
                data: form_data,
                dataType: "json",
                success: function(response) {
                    if (response.length === 0 || response[0].username === null) {
                        alert('No se encuentran registros')
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

             showSlidess();
        }
    </script>


    <script>
        const showSlidess = () => document.getElementById("imagen").src = images[slideIndex];
        const plusSlidess = n => {
            slideIndex = (slideIndex + n + images.length) % images.length;
            showSlidess();
        };

        showSlidess();
    </script>


</main>


<?php
include_once './public/footerCliente.php';
?>