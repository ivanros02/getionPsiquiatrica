<?php
// Incluir el archivo de conexión
include ('../../conexion.php');

// Obtener los parámetros de la URL
$fecha_desde = $_GET['fecha_desde'] ?? '';
$fecha_hasta = $_GET['fecha_hasta'] ?? '';
$obra_social = $_GET['obra_social'] ?? '';

// Verificar si los parámetros están definidos y no están vacíos
if (empty($fecha_desde) || empty($fecha_hasta)) {
    die(json_encode(['error' => 'Parámetros de fecha inválidos']));
}

// Consulta SQL
$sql = "WITH ValidRecords AS (
    SELECT
        p.id AS paciente_id,
        p.nombre,
        o.siglas,
        p.benef,
        p.parentesco,
        p.admision,
        p.sexo,
        m.descripcion AS modalidad_full,
        t.fecha AS fecha_turno,
        pract.fecha AS fecha_pract,
        e.fecha_egreso AS egreso,
        d_id.codigo AS diag,
        COALESCE(pract.cant, 0) AS cantidad,
        CASE
            WHEN t.fecha IS NOT NULL AND act_t.codigo NOT IN ('520101', '521001') THEN t.fecha
            WHEN pract.fecha IS NOT NULL AND act_pract.codigo NOT IN ('520101', '521001') THEN pract.fecha
            ELSE NULL
        END AS valid_date
    FROM paciente p
    
    LEFT JOIN turnos t ON t.paciente = p.id
    LEFT JOIN practicas pract ON pract.id_paciente = p.id
    LEFT JOIN actividades act_t ON t.motivo = act_t.id
    LEFT JOIN actividades act_pract ON pract.actividad = act_pract.id
    LEFT JOIN obra_social o ON o.id = p.obra_social
    LEFT JOIN egresos e ON e.id_paciente = p.id
    LEFT JOIN modalidad m ON m.id = e.modalidad
    LEFT JOIN paci_diag d ON d.id_paciente = p.id
    LEFT JOIN diag d_id ON d_id.id = d.codigo
    WHERE (t.fecha BETWEEN ? AND ? OR pract.fecha BETWEEN ? AND ?)
      AND p.obra_social = ?
)

SELECT
    nombre,
    benef,
    parentesco,
    admision,
    sexo,
    modalidad_full,
    MAX(valid_date) AS ult_atencion,
    MAX(fecha_turno) AS fecha_turno,
    egreso,
    diag,
    SUM(cantidad) AS cantidad
FROM ValidRecords
GROUP BY nombre, benef, parentesco, admision, sexo, modalidad_full, egreso, diag
ORDER BY ult_atencion DESC;

";

// Preparar la consulta
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

// Enlazar los parámetros
$stmt->bind_param("ssssi", $fecha_desde, $fecha_hasta,$fecha_desde, $fecha_hasta,$obra_social);

// Ejecutar la consulta
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

$result = $stmt->get_result();

// Procesar los resultados de la consulta
$resumen = [];
while ($row = $result->fetch_assoc()) {
    $resumen[] = $row; // Almacenar cada fila en el array
}

// Cerrar la conexión a la base de datos
$stmt->close();
$conn->close();

// Devolver los resultados como JSON
echo json_encode($resumen);
?>