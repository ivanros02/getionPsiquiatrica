<?php
header('Content-Type: application/json');
require_once "../conexion.php";

error_reporting(E_ALL); // Mostrar todos los errores
ini_set('display_errors', 1);

$id_prof = isset($_GET['id_prof']) ? intval($_GET['id_prof']) : 0;

// Mapeo de nombres de días de la semana a números de día de la semana
$dayOfWeekMap = array(
    'Lunes' => 1,
    'Martes' => 2,
    'Miércoles' => 3,
    'Jueves' => 4,
    'Viernes' => 5,
    'Sábado' => 6,
    'Domingo' => 7
);

if ($id_prof > 0) {
    $query = "SELECT dia_semana, hora_inicio, hora_fin FROM disponibilidad WHERE id_prof = $id_prof";
    $result = mysqli_query($conn, $query);

    $availability = array();
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Obtener los días de la semana disponibles para este registro
            $dias_disponibles = explode(',', $row['dia_semana']);
            
            foreach ($dias_disponibles as $dia) {
                // Verificar si la clave existe en el mapeo
                if (isset($dayOfWeekMap[$dia])) {
                    // Obtener el número de día de la semana
                    $dayOfWeek = $dayOfWeekMap[$dia];
                    
                    $availability[] = array(
                        'daysOfWeek' => [$dayOfWeek],
                        'startTime' => $row['hora_inicio'],
                        'endTime' => $row['hora_fin']
                    );
                } else {
                    // Si la clave no existe, manejar el caso de error
                    echo json_encode(array("error" => "Nombre de día de semana no válido: " . $dia));
                    exit;
                }
            }
        }
    } else {
        echo json_encode(array("error" => "Error en la consulta: " . mysqli_error($conn)));
        exit;
    }

    echo json_encode($availability);
} else {
    echo json_encode(array("error" => "ID de profesional no válido"));
}

mysqli_close($conn);
?>
