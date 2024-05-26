<?php
// Incluir el archivo de conexión
require_once "../conexion.php";

// Verificar si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombreYapellido = $_POST["nombreYapellido"];
    $especialidad = $_POST["especialidad"];

    // Preparar la consulta SQL para insertar un profesional
    $sql = "INSERT INTO profesional (nombreYapellido, especialidad) VALUES (?, ?)";

    // Preparar la sentencia
    $stmt = $conn->prepare($sql);

    // Vincular parámetros
    $stmt->bind_param("ss", $nombreYapellido, $especialidad);

    // Ejecutar la sentencia
    if ($stmt->execute()) {
        // Si el profesional se agregó correctamente, mostrar una alerta y recargar la página
        echo "<script>alert('Profesional agregado correctamente.'); window.location.href = './crearProf.php';</script>";
    } else {
        // Si hubo un error al agregar el profesional, mostrar una alerta con el mensaje de error y recargar la página
        echo "<script>alert('Error al agregar el profesional: " . $stmt->error . "'); window.location.href = './crearProf.php';</script>";
    }

    // Cerrar la sentencia y la conexión
    $stmt->close();
    $conn->close();
}
?>
