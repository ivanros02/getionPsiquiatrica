<?php
require_once "../../conexion.php";

$sql = "SELECT * FROM paciente"; // Ajusta la consulta según tus necesidades
$result = $conn->query($sql);

$pacientes = array();
while ($row = $result->fetch_assoc()) {
    $pacientes[] = $row;
}

$conn->close();
header('Content-Type: application/json');
echo json_encode($pacientes);
?>
