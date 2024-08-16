<?php
require_once "../../conexion.php";

// Verificar si la conexión se estableció correctamente
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener el ID del paciente desde los parámetros GET
$pacienteId = isset($_GET['paciente_id']) ? $_GET['paciente_id'] : '';

if ($pacienteId === '') {
    die("ID del paciente no proporcionado.");
}

// Preparar y ejecutar la consulta para obtener la modalidad del paciente
$sqlModalidad = "SELECT modalidad FROM paciente WHERE id = ?";
$stmtModalidad = $conn->prepare($sqlModalidad);
$stmtModalidad->bind_param("s", $pacienteId);
$stmtModalidad->execute();
$resultModalidad = $stmtModalidad->get_result();

if ($resultModalidad->num_rows === 0) {
    die("Paciente no encontrado.");
}

// Obtener la modalidad del paciente
$modalidadPaciente = $resultModalidad->fetch_assoc()['modalidad'];

// Cerrar la consulta de modalidad
$stmtModalidad->close();

// Preparar y ejecutar la consulta para obtener las actividades filtradas por modalidad
$sqlActividades = "SELECT * FROM actividades WHERE modalidad = ?";
$stmtActividades = $conn->prepare($sqlActividades);
$stmtActividades->bind_param("s", $modalidadPaciente);
$stmtActividades->execute();
$resultActividades = $stmtActividades->get_result();

// Manejo de errores para la consulta
if (!$resultActividades) {
    die("Query failed: " . $conn->error);
}

// Procesar los resultados de la consulta de actividades
$actividades = [];
if ($resultActividades->num_rows > 0) {
    while ($row = $resultActividades->fetch_assoc()) {
        $actividades[] = $row;
    }
}

// Cerrar la conexión a la base de datos
$stmtActividades->close();
$conn->close();

// Devolver los resultados como JSON
echo json_encode($actividades);
?>
