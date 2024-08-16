<?php
require_once "../../../conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id']; // Asegúrate de que el formulario incluya el campo 'id'
    $fecha = $_POST['orden_fecha'];
    $op = $_POST['op'];
    $cant = $_POST['op_cant'];

    $sql = "UPDATE paci_op SET fecha = ?, op = ?, cant = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siii", $fecha, $op, $cant, $id);

    if ($stmt->execute()) {
        echo "op actualizada correctamente";
    } else {
        echo "Error al actualizar op: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>