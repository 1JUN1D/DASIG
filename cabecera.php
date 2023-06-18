<?php
session_start();
if(isset($_SESSION['usuario'])!="taller2"){
    header("location:login.php");
};
?>

<?php
$servername = "localhost";
$username = "root";
$password = "Admin";
$dbname = "prueba";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (is_uploaded_file($_FILES['csv_data']['tmp_name'])) {
        $csv_file = fopen($_FILES['csv_data']['tmp_name'], 'r');
        fgetcsv($csv_file); // Saltar la primera línea si tiene encabezado

        while (($line = fgetcsv($csv_file, 1000, ';')) !== FALSE) {
          $sql = "INSERT INTO puntos (id, nombre, lat, lon, descripcion, tipo) VALUES('$line[0]', '$line[1]', '$line[2]', '$line[3]', '$line[4]', '$line[5]')";

          if ($conn->query($sql) === TRUE) {
            echo "Se ha guardado exitosamente";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }

        fclose($csv_file);
    }
        // Redirigir a la misma página utilizando GET
        header("Location: " . $_SERVER['PHP_SELF'], true, 303);
        exit;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tu Sitio Web</title>
    <!-- Asegúrate de tener Bootstrap incluido en tu proyecto -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="font/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/leaflet.extra-markers.min.css">
    <link rel="stylesheet" href="css/Control.MiniMap.min.css" />
    <link rel="stylesheet" href="css/L.Control.Locate.min.css" />
    <link rel="stylesheet" href="css/leaflet-notifications.css" />
    <link rel="stylesheet" href="css/L.Control.MousePosition.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <style>
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

