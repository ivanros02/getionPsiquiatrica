<?php
require_once "../../conexion.php";

// Obtener el id_paciente desde la solicitud GET
$idPaciente = $_GET['id_paciente'];

// Verificar si la conexión se estableció correctamente
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Preparar la consulta para obtener los egresos del paciente específico
$sql = "SELECT IFNULL(CONCAT(m.codigo, ' - ', m.descripcion), 'No tiene modalidad') AS modalidad_full
FROM paciente p
LEFT JOIN paci_modalidad pM ON pM.id_paciente = p.id
LEFT JOIN modalidad m ON m.id = pM.modalidad
WHERE p.id = $idPaciente
ORDER BY pM.fecha DESC
LIMIT 2
";

$result = $conn->query($sql);


// Manejo de errores para la consulta
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Procesar los resultados de la consulta
$egresos = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $egresos[] = $row;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();

// Devolver los resultados como JSON
echo json_encode($egresos);
?>
