<?php
require_once "../conexion.php";

if (isset($_GET['id_prof'])) {
    $id_prof = $_GET['id_prof'];


    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Preparar la consulta SQL
    $sql = "SELECT * FROM turnos WHERE id_prof = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_prof);
    $stmt->execute();
    $result = $stmt->get_result();

    // Crear un array para almacenar los turnos
    $turnos = array();

    // Recorrer los resultados y almacenarlos en el array
    while ($row = $result->fetch_assoc()) {
        $start = $row['fecha_turno'] . 'T' . $row['hora'];
        
        // Si no tienes un campo end, calcula una hora final (ej. 30 minutos después)
        $duration = new DateTime($row['hora']);
        $duration->modify('+30 minutes');
        $end = $row['fecha_turno'] . 'T' . $duration->format('H:i:s');

        $turnos[] = array(
            'id' => $row['id_reserva'],
            'title' => $row['title'],
            'start' => $start,
            'end' => $end,
            'color' => $row['color'],
            'extendedProps' => array(
                'beneficio' => $row['beneficio'],
                'hora' => $row['hora'],
                'practica' => $row['practica'],
                'id_prof' => $row['id_prof']
            )
        );
    }

    // Devolver los turnos en formato JSON
    echo json_encode($turnos);

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(array("error" => "No se proporcionó el id_prof"));
}
?>
