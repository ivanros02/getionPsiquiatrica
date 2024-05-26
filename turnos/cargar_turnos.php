<?php
require_once "../conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $conn = new mysqli($hostname, $username, $password, $database);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener los datos del formulario
    $nombrePaciente = $_POST['nombre_paciente'];
    $practica = $_POST['practica'];
    $fechaTurno = $_POST['fecha_turno'];
    $horaTurno = $_POST['hora_turno'];
    $id_prof = $_POST['id_prof']; // Obtener el campo id_prof
    $beneficio = $_POST['beneficio']; // Obtener el campo beneficio

    // Combinar fecha y hora en un solo campo
    $startDateTime = $fechaTurno . ' ' . $horaTurno;

    // Verificar si ya existe un turno en la misma fecha, hora y con el mismo profesional
    $sql_verificar = "SELECT * FROM turnos WHERE fecha_turno = ? AND hora = ? AND id_prof = ?";
    if ($stmt_verificar = $conn->prepare($sql_verificar)) {
        $stmt_verificar->bind_param("sss", $fechaTurno, $horaTurno, $id_prof);
        $stmt_verificar->execute();
        $stmt_verificar->store_result();
        if ($stmt_verificar->num_rows > 0) {
            echo "Ya existe un turno en la misma fecha, hora y con el mismo profesional. Por favor, elige otra fecha u hora.";
            exit(); // Salir del script sin insertar el nuevo turno
        }
        $stmt_verificar->close();
    } else {
        echo "Error al preparar la consulta de verificación: " . $conn->error;
        exit(); // Salir del script si hay un error
    }

    // Preparar la consulta SQL para insertar el turno en la base de datos
    $sql_insertar = "INSERT INTO turnos (nombre_paciente, practica, fecha_turno, hora, id_prof, beneficio, title, start, end) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt_insertar = $conn->prepare($sql_insertar)) {
        // Bind de parámetros
        $title = $nombrePaciente;
        $end = $fechaTurno; // Fin igual a la fecha
        $stmt_insertar->bind_param("sssssssss", $nombrePaciente, $practica, $fechaTurno, $horaTurno, $id_prof, $beneficio, $title, $startDateTime, $end);

        // Ejecutar la declaración
        if ($stmt_insertar->execute()) {
            echo "Turno guardado exitosamente.";
        } else {
            echo "Error al guardar el turno: " . $stmt_insertar->error;
        }

        // Cerrar la declaración
        $stmt_insertar->close();
    } else {
        echo "Error al preparar la declaración de inserción: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    echo "No se recibieron datos del formulario.";
}
?>
