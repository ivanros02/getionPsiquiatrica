<?php
require_once "../../../conexion.php";

$boca = $_POST['boca'];
$puerta = $_POST['puerta'];
if ($boca) {
    $stmt = $conn->prepare("INSERT INTO bocas_atencion (boca, puerta) VALUES (?, ?)");
    $stmt->bind_param("si", $boca, $puerta); // Verifica los tipos de datos

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Boca agregada exitosamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al agregar la boca."]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "No se proporcionó un nombre válido."]);
}

$conn->close();
?>
