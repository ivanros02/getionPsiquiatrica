<?php
// Verifica la ruta y ajusta según sea necesario
require_once "../../../conexion.php";

// Obtener los datos del POST
$idPaciente = $_POST['id_paciente'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$profesional = $_POST['profesional'];
$actividad = $_POST['actividad'];
$cant = $_POST['cant'];

// Verificar si la conexión se estableció correctamente
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Preparar y ejecutar la consulta para insertar la nueva práctica
$sql = "INSERT INTO practicas (id_paciente, fecha, hora, profesional, actividad, cant)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param('issssi', $idPaciente, $fecha, $hora, $profesional, $actividad, $cant);

if ($stmt->execute()) {
    echo "Práctica agregada correctamente.";
} else {
    echo "Error: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
