<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio de entomologia</title>
    <style>
        * {
            padding: 0;
            margin: 0;
        }

        body {
            padding: 0;
            margin: 0;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-direction: column;
            font-family: 'Manrope', sans-serif;
            background-size: cover;
            box-sizing: border-box;
            color: white;
            background-color: black;
        }

        footer {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #000000;
            color: white;
            padding: 1rem;
            box-sizing: border-box;
        }

        .masthead {
            position: relative;
            width: 100%;
            height: 500px;
            background-image: url("public/assets/img/bee-flowers-insect-blur-wallpaper-preview.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100%;
        }

        .btn-inicioSesion {
            border: none;
            outline: none;
            color: white;
            background-color: #0f5474;
            padding: 0.5rem 1rem;
        }

        .btn-inicioSesion a {
            text-decoration: none;
            color: white;
        }

        .btn-inicioSesion:hover {
            background-color: #0f5474;
            transform: scale(1.2);
        }

        .mainContent {
            margin: 3rem 20%;
            text-align: center;
        }

        .mainContent p {
            margin: 2rem;
            text-align: justify;
        }

        .vertical-line {
            width: 1px;
            height: 100px;
            background-color: white;
            transform: translateX(-50%) translateY(-50%);
        }
    </style>
</head>

<body>
    <div class="masthead" style="position: relative;">
        <div style="position: absolute; top: 40%; left: 25%; transform: translate(-50%, -50%); margin-left: 5rem;">
            <h1>Laboratorio de entomología</h1>
            <button class="btn-inicioSesion"><a href="?controlador=Index&accion=mostrarLogin">Iniciar sesion</a></button>
        </div>
    </div>

    <div class="mainContent">
        <div class="about">
            <h2>Nosotros</h2>
            <p>El Laboratorio de Entomología de la UCR sede del atlantico. Nos enfocamos en una amplia gama de preguntas relacionadas con cómo las especies responden al cambio ambiental y las consecuencias que esto tiene para las interacciones de las especies y el funcionamiento del ecosistema. Tenemos debilidad por los invertebrados, pero también se sabe que trabajamos con aves, mamíferos, plantas y microbios. Tenemos un enfoque aplicado y estamos particularmente interesados en los efectos de la fragmentación y conectividad del hábitat en la distribución y el movimiento de las especies. Queremos que nuestra ciencia sea interdisciplinaria y disfrutemos trabajar con partes interesadas fuera de la academia para ayudar a proporcionar una base de evidencia para políticas y mejores prácticas de gestión.</p>
        </div>

        <div class="imagen">
            <img src="public/assets/img/fondo1.jpeg" alt="Descripción de la imagen" style="width: 30%; height: 200px; object-fit: cover; object-position: 50% 20%;">
        </div>


        <div class="contact">
            <h2>Ubicacion</h2>
            <p>El Laboratorio de Entomología de la UCR sede del Atlántico se encuentra en Turrialba, Cartago, Costa Rica. Turrialba es una ciudad ubicada en el valle del río Reventazón, en la región central del país. Cartago, por su parte, es la provincia en la que se encuentra Turrialba y es conocida por su riqueza cultural e histórica.</p>
        </div>

    </div>

    <footer>
        <p>Creado por <strong>Daylan Arias Masis</strong></p>
    </footer>


</body>

</html>