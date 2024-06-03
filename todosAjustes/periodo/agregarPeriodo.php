<?php
// Incluir el archivo de conexión
require_once "../../conexion.php";

// Verificar si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $codigo = $_POST["codigo"];
    $descripcion = $_POST["descripcion"];

    // Preparar la consulta SQL para insertar una especialidad
    $sql = "INSERT INTO periodo (codigo, descripcion) VALUES (?, ?)";

    // Preparar la sentencia
    $stmt = $conn->prepare($sql);

    // Vincular parámetros
    $stmt->bind_param("ss", $codigo, $descripcion);

    // Ejecutar la sentencia
    if ($stmt->execute()) {
        // Si la especialidad se agregó correctamente, mostrar una alerta y redireccionar a otra página
        echo "<script>alert('Periodo agregado correctamente.'); window.location.href = './periodo.php';</script>";
    } else {
        // Si hubo un error al agregar la especialidad, mostrar una alerta con el mensaje de error
        echo "<script>alert('Error al agregar periodo: " . $stmt->error . "');</script>";
    }

    // Cerrar la sentencia y la conexión
    $stmt->close();
    $conn->close();
}
?>
