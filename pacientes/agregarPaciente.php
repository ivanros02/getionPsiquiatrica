<?php
require_once "../conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    $modalidad = $_POST['modalidad'];
    

    $sql = "INSERT INTO paciente (nombre, obra_social, fecha_nac, sexo, domicilio, localidad, partido, c_postal, telefono, tipo_doc, nro_doc, admision, id_prof, benef, parentesco, hijos, ocupacion, tipo_afiliado, modalidad) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssiisisii", 
        $nombre, $obra_social, $fecha_nac, $sexo, $domicilio, $localidad, $partido, $c_postal, 
        $telefono, $tipo_doc, $nro_doc, $admision, $id_prof, $benef, $parentesco, 
        $hijos, $ocupacion, $tipo_afiliado, $modalidad);

    if ($stmt->execute()) {
        header("Location: ./paciente.php?success=true");
        exit(); // Asegura que el script se detenga después de redirigir
    } else {
        echo "Error al agregar el paciente: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
