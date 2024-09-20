<?php
require_once "../../../conexion.php";

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los valores enviados en la solicitud POST
    $idPaciente = $_POST['id_paciente'];
    $fecha = $_POST['fecha'];
    $modalidad = $_POST['modalidad_paci'];

    // Verificar si la conexión se estableció correctamente
    if ($conn->connect_error) {
        // Enviar la respuesta en formato JSON si la conexión falla
        echo json_encode(['success' => false, 'message' => 'Error de conexión: ' . $conn->connect_error]);
        exit;
    }

    // Preparar la consulta SQL para insertar la nueva modalidad
    $sql = "INSERT INTO paci_modalidad (id_paciente, fecha, modalidad) VALUES (?, ?, ?)";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);
    
    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt === false) {
        echo json_encode(['success' => false, 'message' => 'Error en la preparación de la consulta: ' . $conn->error]);
        exit;
    }

    // Vincular los parámetros a la consulta preparada
    $stmt->bind_param('isi', $idPaciente, $fecha, $modalidad);

    // Ejecutar la consulta y verificar si se ejecutó correctamente
    if ($stmt->execute()) {
        // Respuesta exitosa en formato JSON
        echo json_encode(['success' => true, 'message' => 'Modalidad agregada correctamente.']);
    } else {
        // Respuesta en caso de error al ejecutar la consulta
        echo json_encode(['success' => false, 'message' => 'Error al agregar modalidad: ' . $stmt->error]);
    }

    // Cerrar la consulta y la conexión
    $stmt->close();
    $conn->close();
} else {
    // Respuesta en caso de que no se reciba una solicitud POST
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>
