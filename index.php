<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DASIG</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #000D55;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 1000'%3E%3Cg %3E%3Ccircle fill='%23000D55' cx='50' cy='0' r='50'/%3E%3Cg fill='%2302115d' %3E%3Ccircle cx='0' cy='50' r='50'/%3E%3Ccircle cx='100' cy='50' r='50'/%3E%3C/g%3E%3Ccircle fill='%23051564' cx='50' cy='100' r='50'/%3E%3Cg fill='%2308196c' %3E%3Ccircle cx='0' cy='150' r='50'/%3E%3Ccircle cx='100' cy='150' r='50'/%3E%3C/g%3E%3Ccircle fill='%230b1e74' cx='50' cy='200' r='50'/%3E%3Cg fill='%230d227c' %3E%3Ccircle cx='0' cy='250' r='50'/%3E%3Ccircle cx='100' cy='250' r='50'/%3E%3C/g%3E%3Ccircle fill='%23102784' cx='50' cy='300' r='50'/%3E%3Cg fill='%23122b8c' %3E%3Ccircle cx='0' cy='350' r='50'/%3E%3Ccircle cx='100' cy='350' r='50'/%3E%3C/g%3E%3Ccircle fill='%23143094' cx='50' cy='400' r='50'/%3E%3Cg fill='%2315349d' %3E%3Ccircle cx='0' cy='450' r='50'/%3E%3Ccircle cx='100' cy='450' r='50'/%3E%3C/g%3E%3Ccircle fill='%231739a5' cx='50' cy='500' r='50'/%3E%3Cg fill='%23183eae' %3E%3Ccircle cx='0' cy='550' r='50'/%3E%3Ccircle cx='100' cy='550' r='50'/%3E%3C/g%3E%3Ccircle fill='%231843b6' cx='50' cy='600' r='50'/%3E%3Cg fill='%231848bf' %3E%3Ccircle cx='0' cy='650' r='50'/%3E%3Ccircle cx='100' cy='650' r='50'/%3E%3C/g%3E%3Ccircle fill='%23184dc8' cx='50' cy='700' r='50'/%3E%3Cg fill='%231752d1' %3E%3Ccircle cx='0' cy='750' r='50'/%3E%3Ccircle cx='100' cy='750' r='50'/%3E%3C/g%3E%3Ccircle fill='%231657da' cx='50' cy='800' r='50'/%3E%3Cg fill='%23135ce3' %3E%3Ccircle cx='0' cy='850' r='50'/%3E%3Ccircle cx='100' cy='850' r='50'/%3E%3C/g%3E%3Ccircle fill='%230f61ec' cx='50' cy='900' r='50'/%3E%3Cg fill='%230967f6' %3E%3Ccircle cx='0' cy='950' r='50'/%3E%3Ccircle cx='100' cy='950' r='50'/%3E%3C/g%3E%3Ccircle fill='%23006CFF' cx='50' cy='1000' r='50'/%3E%3C/g%3E%3C/svg%3E");
            background-attachment: fixed;
            background-size: contain;
            color: #fff;
        }
        .neon {
            font-size: 2.5em;
            color: #2ab3ff;
            text-shadow: 0 0 5px #2ab3ff, 0 0 10px #2ab3ff, 0 0 20px #2ab3ff, 0 0 40px #2ab3ff;
        }
        .content {
            height: calc(100vh - 56px); /* Altura completa menos la altura de la barra de navegación */
        }

        .welcome {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }
        .services {
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }
        .service {
            text-align: center;
            margin-bottom: 2em;
        }
        .earth-text {
        background: url('cin.jpg');
        -webkit-background-clip: text;
        color: transparent;
        background-size: cover;
        font-size: 3.25em;
        background-position: center;
        font-weight: bold;
        }

        .navbar {
            background-color: #1B4DB9; /* Un tono de azul de Bootstrap */
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #fff; /* Letras en blanco para contrastar con el fondo azul */
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="index.php">DAVID SISTEMAS DE INFORMACION GEOGRAFICA</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://3.209.175.188/geoserver/web/?1">Geoservicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="visor.php">Geovisor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cerrar.php">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="container-fluid content">
        <div class="row h-100">
            <div class="col-6 welcome">
                <h1>Bienvenido a <span class="neon">DASIG</span></h1>
            </div>
            <div class="col-6 services">
            <div class="service">
                    <h1 class="earth-text">GEOSERVICIOS</h1>
                    <p>Puedes acceder a nuestro catalogo de geoservicios y realizar conexiones WFS, WMS y demas.</p>
                </div>
                <div class="service">
                    <h1 class="earth-text">GEOVISOR</h1>
                    <p>Entra a nuestro geovisor para cargar tus puntos en formato csv o geocodificar coordenadas en direcciones.</p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
