<?php
require_once "../../conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];

    // Consulta SQL para actualizar la especialidad
    $sql = "UPDATE diag SET codigo = ?, descripcion = ? WHERE id = ?";

    // Preparar la sentencia
    $stmt = $conn->prepare($sql);

    // Vincular parámetros (el orden y tipos deben ser correctos: "s" para string y "i" para integer)
    $stmt->bind_param("ssi", $codigo, $descripcion, $id);

    // Ejecutar la sentencia
    if ($stmt->execute()) {
        // Redirigir a la página de especialidades después de actualizar con un parámetro de éxito
        header("Location: ./diag.php?success=true");
        exit();
    } else {
        // Manejar el error
        echo "Error al actualizar diagnostico: " . $conn->error;
    }

    // Cerrar la sentencia y la conexión
    $stmt->close();
    $conn->close();
} else {
    echo "Método de solicitud no válido";
}
?>
