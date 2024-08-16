<?php
require_once "../../../conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id']; // Asegúrate de que el formulario incluya el campo 'id'
    $fecha = $_POST['fecha'];
    $diag = $_POST['egreso_diag'];
    $modalidad = $_POST['egreso_modalidad'];
    $motivo = $_POST['egreso_motivo'];


    $sql = "UPDATE egresos SET fecha_egreso = ?, diag = ?, modalidad = ?, motivo = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siiii", $fecha,$diag,$modalidad,$motivo, $id);

    if ($stmt->execute()) {
        echo "Egreso actualizado correctamente";
    } else {
        echo "Error al actualizar egreso: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
