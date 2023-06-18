<?php
$servername = "localhost";
$username = "root";
$password = "Admin";
$dbname = "prueba";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
  die("Fallo la conexion: " . $conn->connect_error);
}

$sql = "DELETE FROM puntos";
if ($conn->query($sql) === TRUE) {
  echo "Registros borrados";
} else {
  echo "Error borrando los registros: " . $conn->error;
}

$conn->close();
?>
