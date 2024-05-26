<?php

// Conexión a la base de datos
require_once "../conexion.php";

if ($conn->connect_error) {
    die("Error al conectar con la base de datos: " . $conn->connect_error);
}

// Recuperar datos del formulario
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

// Hashear la contraseña antes de almacenarla en la base de datos
$hashed_clave = password_hash($clave, PASSWORD_DEFAULT);

// Consulta SQL para insertar un nuevo usuario
$sql = "INSERT INTO usuarios (usuario, clave) VALUES ('$usuario', '$hashed_clave')";

if ($conn->query($sql) === TRUE) {
    echo "Usuario registrado correctamente.";
} else {
    echo "Error al registrar el usuario: " . $conn->error;
}

$conn->close();
?>
