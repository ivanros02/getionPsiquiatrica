<?php
require_once "../../../conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    // Decodificar el JSON de 'fechas' y verificar que se decodificó correctamente
    $fechas = json_decode($_POST['fechas'], true);

    if (json_last_error() === JSON_ERROR_NONE && is_array($fechas) && !empty($fechas)) {
        $fecha = $fechas[0]; // Tomar la primera fecha del array decodificado
    } else {
        echo "Error: No se recibió un formato de fechas válido o el array está vacío.";
        exit;
    }

    $hora = $_POST['hora'];
    $profesional = $_POST['profesional'];
    $actividad = $_POST['actividad'];
    $cant = $_POST['cant'];

    $sql = "UPDATE practicas SET fecha = ?, hora = ?, profesional = ?, actividad = ?, cant = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiisi", $fecha, $hora, $profesional, $actividad, $cant, $id);

    if ($stmt->execute()) {
        echo "Práctica actualizada correctamente";
    } else {
        echo "Error al actualizar la práctica: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}



?>
