<?php
require_once "../../../conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id']; // Asegúrate de que el formulario incluya el campo 'id'
    $fecha = $_POST['fecha'];
    $modalidad = $_POST['modalidad_paci'];

    $sql = "UPDATE paci_modalidad SET fecha = ?, modalidad=? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $fecha, $modalidad, $id);

    if ($stmt->execute()) {
        echo "Modalidad actualizada correctamente";
    } else {
        echo "Error al actualizar la práctica: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
