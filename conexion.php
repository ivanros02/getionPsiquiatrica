<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "gestion_db";

// Crear conexión
$conn = new mysqli($hostname, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error al conectar con la base de datos: " . $conn->connect_error);
}
?>
