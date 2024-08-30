<?php
require_once "../../../conexion.php";

// Obtener los datos del POST
$idPaciente = $_POST['id_paciente'];
$hora = $_POST['hora'];
$profesional = $_POST['profesional'];
$actividad = $_POST['actividad'];
$cant = $_POST['cant'];
$fechas = json_decode($_POST['fechas'], true); // Decodificar el array JSON de fechas

foreach ($fechas as $fecha) {
    $sql = "INSERT INTO practicas (id_paciente, fecha, hora, profesional, actividad, cant)
            VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('issssi', $idPaciente, $fecha, $hora, $profesional, $actividad, $cant);

    if (!$stmt->execute()) {
        echo "Error: " . $stmt->error;
    }
}

// Cerrar la conexión
$stmt->close();
$conn->close();

echo "Prácticas agregadas correctamente.";

?>
