<?php
require_once "../../conexion.php";

// Obtener el id_paciente desde la solicitud GET
$idPaciente = $_GET['id_paciente'];

// Verificar si la conexión se estableció correctamente
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Preparar la consulta para obtener los egresos del paciente específico
$sql = "SELECT t.*
        FROM traslados t
        JOIN paciente p ON t.id_paciente = p.id 
        WHERE t.id_paciente = $idPaciente";
$result = $conn->query($sql);


// Manejo de errores para la consulta
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Procesar los resultados de la consulta
$traslados = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $traslados[] = $row;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();

// Devolver los resultados como JSON
echo json_encode($traslados);
?>
