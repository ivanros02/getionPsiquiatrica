<?php
// Verifica la ruta y ajusta según sea necesario
require_once "../../../conexion.php";

// Obtener los datos del POST
$idPaciente = $_POST['id_paciente'];
$fecha = $_POST['fecha'];
$modalidad = $_POST['modalidad_paci'];

// Verificar si la conexión se estableció correctamente
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Preparar y ejecutar la consulta para insertar la nueva práctica
$sql = "INSERT INTO paci_modalidad (id_paciente, fecha, modalidad)
        VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param('isi', $idPaciente, $fecha, $modalidad);

if ($stmt->execute()) {
    echo "Modalidad agregada correctamente.";
} else {
    echo "Error: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
