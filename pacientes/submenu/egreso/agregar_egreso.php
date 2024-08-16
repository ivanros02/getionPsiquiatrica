<?php
// Verifica la ruta y ajusta según sea necesario
require_once "../../../conexion.php";

// Obtener los datos del POST
$idPaciente = $_POST['id_paciente'];
$fecha = $_POST['fecha'];
$diag = $_POST['egreso_diag'];
$modalidad = $_POST['egreso_modalidad'];
$motivo = $_POST['egreso_motivo'];

// Verificar si la conexión se estableció correctamente
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Preparar y ejecutar la consulta para insertar la nueva práctica
$sql = "INSERT INTO egresos (id_paciente, fecha_egreso, diag, modalidad, motivo)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param('isiii', $idPaciente, $fecha, $diag, $modalidad, $motivo);

if ($stmt->execute()) {
    echo "Egreso agregado correctamente.";
} else {
    echo "Error: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
