<?php
require_once "../../../conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id']; // Asegúrate de que el formulario incluya el campo 'id'
    $desc = $_POST['mediDesc'];
    $fecha = $_POST['medi_fecha'];
    $hora = $_POST['medi_hora'];
    $dosis = $_POST['dosis'];


    $sql = "UPDATE medicacion_paci SET medicamento = ?,fecha = ?, hora = ?, dosis = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issii", $desc,$fecha,$hora,$dosis,$id);

    if ($stmt->execute()) {
        echo "Medicamento actualizado correctamente";
    } else {
        echo "Error al actualizar medicamento: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>