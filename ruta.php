<?php
header('Content-Type: application/json');

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

// Inicializar la consulta SQL
$sql = "SELECT id, nombre, lat, lon, descripcion FROM puntos WHERE 1";

// Verificar si se proporcionó un ID para filtrar
if (isset($_POST['filter_id']) && $_POST['filter_id'] != '') {
    $sql .= " AND id = " . intval($_POST['filter_id']);
}

// Verificar si se proporcionó un tipo para filtrar (Asumiendo que hay una columna 'tipo' en la tabla)
if (isset($_POST['filter_type']) && $_POST['filter_type'] != '') {
    $sql .= " AND tipo = '" . $conn->real_escape_string($_POST['filter_type']) . "'";
}

// Ejecutar la consulta
$result = $conn->query($sql);

$data = array();
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$conn->close();
?>

