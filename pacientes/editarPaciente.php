<?php
require_once "../conexion.php";

$response = array('success' => false, 'message' => '');

// Verifica que la solicitud sea POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $obra_social = $_POST['obra_social'];
    $fecha_nac = $_POST['fecha_nac'];
    $sexo = $_POST['sexo'];
    $domicilio = $_POST['domicilio'];
    $localidad = $_POST['localidad'];
    $partido = $_POST['partido'];
    $c_postal = $_POST['c_postal'];
    $telefono = $_POST['telefono'];
    $tipo_doc = $_POST['tipo_doc'];
    $nro_doc = $_POST['nro_doc'];
    $admision = $_POST['admision'];
    $id_prof = $_POST['id_prof'];
    $benef = $_POST['benef'];
    $parentesco = $_POST['parentesco'];
    $hijos = $_POST['hijos'];
    $ocupacion = $_POST['ocupacion'];
    $tipo_afiliado = $_POST['tipo_afiliado'];
    $boca_atencion = $_POST['boca_atencion'];
    $modalidad_act = $_POST['modalidad_act'];

    // Verificar si existe otro paciente con el mismo benef y parentesco
    $sql_check = "SELECT id FROM paciente WHERE benef = ? AND parentesco = ? AND id != ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("iii", $benef, $parentesco, $id);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        // Si existe otro paciente con el mismo benef y parentesco, enviar respuesta de error
        $response['success'] = false;
        $response['message'] = 'Ya existe otro paciente con el mismo beneficiario y parentesco.';
    } else {
        // Actualizar paciente
        $sql = "UPDATE paciente SET 
                    nombre = ?, 
                    obra_social = ?, 
                    fecha_nac = ?, 
                    sexo = ?, 
                    domicilio = ?, 
                    localidad = ?, 
                    partido = ?, 
                    c_postal = ?, 
                    telefono = ?, 
                    tipo_doc = ?, 
                    nro_doc = ?, 
                    admision = ?, 
                    id_prof = ?, 
                    benef = ?, 
                    parentesco = ?, 
                    hijos = ?, 
                    ocupacion = ?, 
                    tipo_afiliado = ?,
                    boca_atencion = ?
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssssssssiisisiii",
            $nombre,
            $obra_social,
            $fecha_nac,
            $sexo,
            $domicilio,
            $localidad,
            $partido,
            $c_postal,
            $telefono,
            $tipo_doc,
            $nro_doc,
            $admision,
            $id_prof,
            $benef,
            $parentesco,
            $hijos,
            $ocupacion,
            $tipo_afiliado,
            $id
        );

        if ($stmt->execute()) {
            // Actualizar en la tabla paci_modalidad
            $sql_modalidad = "UPDATE paci_modalidad SET modalidad = ?, fecha = ? WHERE id_paciente = ?";
            $stmt_modalidad = $conn->prepare($sql_modalidad);
            $stmt_modalidad->bind_param("isi", $modalidad_act, $admision, $id);

            if ($stmt_modalidad->execute()) {
                $response['success'] = true;
                $response['message'] = 'Paciente actualizado correctamente.';
            } else {
                $response['message'] = 'Error al actualizar la modalidad del paciente: ' . $stmt_modalidad->error;
            }

            $stmt_modalidad->close();
        } else {
            $response['message'] = 'Error al actualizar el paciente: ' . $stmt->error;
        }

        $stmt->close();
    }

    $stmt_check->close();
}

// Envía la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
