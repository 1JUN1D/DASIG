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
    <main>
        <div class="container-fluid h-100 d-flex justify-content-center" style="padding-top: 15px; padding-bottom: 15px; box-sizing: border-box;">
            <div class="row h-100 d-flex justify-content-center">
                <div class="col-lg-3 col-md-6 d-flex flex-column" style="height: calc(100vh - 30px); overflow: auto;">
                    <div class="card mb-3" style="height: 45vh; overflow: auto;">
                        <div class="card-header">Subir archivo</div>
                        <div class="card-body" >
                        <table class="table">
                            <h6>Se debe seguir el siguiente formato:</h6>
                            <thead>
                                <tr>
                                <th scope="col">id</th>
                                <th scope="col">nombre</th>
                                <th scope="col">lat</th>
                                <th scope="col">lon</th>
                                <th scope="col">descripcion</th>
                                <th scope="col">tipo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row">1</th>
                                <td>Hogar</td>
                                <td>3.551</td>
                                <td>-74.452</td>
                                <td>Punto de prueba A</td>
                                <td>Semaforo</td>
                                </tr>
                                <tr>
                                <th scope="row">2</th>
                                <td>Hotel</td>
                                <td>4.235</td>
                                <td>-75.214</td>
                                <td>Punto de prueba B</td>
                                <td>Alcantarilla</td>
                                </tr>
                                <tr>
                                <th scope="row">3</th>
                                <td>Parque</td>
                                <td>3.672</td>
                                <td>-73.214</td>
                                <td>Punto de prueba C</td>
                                <td>Basura</td>
                                </tr>
                            </tbody>
                            </table>
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="csv_data">Formato CSV:</label>
                                    <div class="file-upload-wrapper">
                                        <input type="file" id="csv_data" name="csv_data" accept=".csv" class="file-upload" />
                                    </div>
                                    <br>
                                    <button type="button" id="deleteButton" class="btn btn-danger btn-block mb-2">Eliminar</button>
                                    <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card" style="height: 45vh; overflow: auto;">
                        <div class="card-header">Geocodificar</div>
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <p><strong>LATITUD:</strong></p>
                                    <label for="lat_deg">Grados:</label>
                                    <input type="number" id="lat_deg" name="lat_deg" value="3" readonly class="form-control">
                                    <label for="lat_min">Minutos:</label>
                                    <input type="number" id="lat_min" name="lat_min" min="27" max="28" class="form-control">
                                    <label for="lat_sec">Segundos:</label>
                                    <input type="number" id="lat_sec" name="lat_sec" min="0" max="59" class="form-control">
                                    <label for="lat_hem">Hemisferio:</label>
                                    <select id="lat_hem" name="lat_hem" class="form-control">
                                        <option value="N">N</option>
                                    </select>
                                    <br>
                                    <p><strong>LONGITUD:</strong></p>
                                    <label for="lon_deg">Grados:</label>
                                    <input type="number" id="lon_deg" name="lon_deg" value="76" readonly class="form-control">
                                    <label for="lon_min">Minutos:</label>
                                    <input type="number" id="lon_min" name="lon_min" min="29" max="30" class="form-control">
                                    <label for="lon_sec">Segundos:</label>
                                    <input type="number" id="lon_sec" name="lon_sec" min="0" max="59" class="form-control">
                                    <label for="lon_hem">Hemisferio:</label>
                                    <select id="lon_hem" name="lon_hem" class="form-control">
                                        <option value="W">W</option>
                                    </select>
                                </div>
                                <label for="tipo">Tipo:</label>
                                    <select id="tipo" name="tipo" class="form-control">
                                        <option value="semaforo">Semáforo</option>
                                        <option value="alcantarilla">Alcantarilla</option>
                                        <option value="basurero">Basurero</option>
                                    </select>
                                <br>
                                <button type="button" id="geocodeButton" class="btn btn-primary btn-block">Geocodificar</button>
                                <button type="button" id="undoGeocodeButton" class="btn btn-primary btn-block">Deshacer último punto</button>
                                <button type="button" id="downloadButton" class="btn btn-primary btn-block">Descargar CSV</button>
                            </form>
                        </div>
                    </div>   
                </div>
                <div class="col-md-9 h-100">
                    <div id="map" style="height: calc(100vh - 30px); width: 70vw;"></div>
                </div>
            </div>
        </div>

        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script src="js/leaflet.extra-markers.min.js"></script>
        <script src="js/Control.MiniMap.min.js"></script>
        <script src="js/L.Control.Locate.min.js"></script>
        <script src="js/Leaflet.OverIntent.js"></script>
        <script type="text/javascript"
            src="https://cdn.jsdelivr.net/gh/hosuaby/Leaflet.SmoothMarkerBouncing@v3.0.2/dist/bundle.js"
            crossorigin="anonymous"></script>
        <script src="js/leaflet-notifications.js"></script>
        <script src="js/L.Control.MousePosition.js"></script>

        <script>
    var map = L.map('map', {
        maxZoom: 17,
        minZoom: 11
    }).setView([3.45, -76.53], 13).fitBounds([[3.459616034601233,-76.51371035645164],[3.4862226309928928,-76.47486143555066]]);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    L.tileLayer.wms("http://3.209.175.188/geoserver/taller2/wms", {
        layers: 'taller2:Base',
        format: 'image/png',
        version: '1.1.0',
        transparent: true,
        attribution: "Juan Delgado"
    }).addTo(map);


    L.control.locate().addTo(map);

    var osm2 = new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {minZoom: 0, maxZoom: 13});
    var miniMap = new L.Control.MiniMap(osm2, { width: 150, height: 150 }).addTo(map);

    var notification = L.control.notifications({
        position: 'topright',
        timeout: 3000,
        closable: true,
        dismissable: true,
    }).addTo(map);

    function formatDMS(coordinate) {
        var absolute = Math.abs(coordinate);
        var degrees = Math.floor(absolute);
        var minutesNotTruncated = (absolute - degrees) * 60;
        var minutes = Math.floor(minutesNotTruncated);
        var seconds = Math.floor((minutesNotTruncated - minutes) * 60);

        return degrees + "° " + minutes + "' " + seconds + "''";
    }

    L.control.mousePosition({
        lngFormatter: function(lng) {
            return formatDMS(lng) + (lng > 0 ? " E" : " W");
        },
        latFormatter: function(lat) {
            return formatDMS(lat) + (lat > 0 ? " N" : " S");
        }
    }).addTo(map);


    var lastMarker = null;
    var geocodings = [];
    var markers = [];

    fetch('ruta.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(row => {
                var marker = L.marker([row.lat, row.lon]).addTo(map)
                    .bindPopup(`<b>${row.nombre}</b><br>${row.descripcion}`);
                markers.push(marker);
                // Agrega Leaflet.SmoothMarkerBouncing a cada marcador
                marker.on('mouseover', function (e) {
                    this.bounce();
                });

                marker.on('mouseout', function (e) {
                    this.stopBouncing();
                });
            });
        });

    document.getElementById('deleteButton').addEventListener('click', function() {
        fetch('eliminar.php', { method: 'POST' })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                markers.forEach(marker => map.removeLayer(marker));
                markers = [];
                notification.warning('Listo', 'Los marcadores se han eliminado correctamente.');
            });
    });

    document.getElementById('geocodeButton').addEventListener('click', function() {
        var lat_deg = document.getElementById('lat_deg').value;
        var lat_min = document.getElementById('lat_min').value;
        var lat_sec = document.getElementById('lat_sec').value;
        var lon_deg = document.getElementById('lon_deg').value;
        var lon_min = document.getElementById('lon_min').value;
        var lon_sec = document.getElementById('lon_sec').value;

        var lat = Number(lat_deg) + Number(lat_min)/60 + Number(lat_sec)/3600;
        var lon = -1 * (Number(lon_deg) + Number(lon_min)/60 + Number(lon_sec)/3600);

        fetch('https://api.opencagedata.com/geocode/v1/json?q=' + encodeURIComponent(lat + '+' + lon) + '&key=ba2d18d86ba84382ba9c32b4cde9cdce')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.results && data.results.length > 0) {
                    var lat = data.results[0].geometry.lat;
                    var lon = data.results[0].geometry.lng;
                    var address = data.results[0].formatted;
                    lastMarker = L.marker([lat, lon]).addTo(map)
                        .bindPopup(`<b>${address}</b>`);
                    geocodings.push({lat: lat, lon: lon, address: address});
                    notification.success('Listo', 'La geocodificación se ha realizado correctamente.');
                    
                    // Agrega Leaflet.SmoothMarkerBouncing al marcador geocodificado
                    lastMarker.on('mouseover', function (e) {
                        this.bounce();
                    });

                    lastMarker.on('mouseout', function (e) {
                        this.stopBouncing();
                    });
                    
                } else {
                    console.log('No se encontraron resultados');
                }
            })
            .catch(error => {
                console.error('Hay un problema con la operacion:', error);
            });
    });

    document.getElementById('undoGeocodeButton').addEventListener('click', function() {
        if (lastMarker) {
            map.removeLayer(lastMarker);
            geocodings.pop();
            lastMarker = null;
            notification.warning('Pilas', 'Se ha deshecho el último punto de geocodificación.',);
        }
    });

    document.getElementById('downloadButton').addEventListener('click', function() {
        var csv = 'lat,lon,address\n' + geocodings.map(function(geocoding) {
            return geocoding.lat + ',' + geocoding.lon + ',"' + geocoding.address + '"';
        }).join('\n');
        var blob = new Blob([csv], {type: 'text/csv'});
        var url = URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'geocodings.csv';
        a.click();
        notification.success('Bien', 'El archivo CSV se ha descargado correctamente.');
    });


        </script>
    </main>
</body>
</html>
