<?php
include('../conexion.php');

// Verificar si se proporcionó un ID de profesional en la consulta
if (isset($_GET['id_prof'])) {
    // Obtener y limpiar el ID de profesional para evitar inyección de SQL
    $id_prof = mysqli_real_escape_string($conn, $_GET['id_prof']);
    // Consulta filtrada por ID de profesional
    $sql = "SELECT title, start, end, color, beneficio, practica, hora, id_prof FROM turnos WHERE id_prof = '$id_prof'";
} else {
    // Consulta para todos los turnos si no se proporciona un ID de profesional
    $sql = "SELECT title, start, end, color, beneficio, practica, hora, id_prof FROM turnos";
}

$query = $conn->query($sql);

if ($query) {
    $resultado = $query->fetch_all(MYSQLI_ASSOC);
    echo json_encode($resultado);
} else {
    echo "Error al ejecutar la consulta: " . $conn->error;
}
?>
