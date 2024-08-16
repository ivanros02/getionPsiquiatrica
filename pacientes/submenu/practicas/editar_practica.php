<?php
require_once "../../../conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id']; // Asegúrate de que el formulario incluya el campo 'id'
    $fecha = $_POST['fecha'];
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
