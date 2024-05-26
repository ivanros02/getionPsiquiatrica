<?php
require_once "../conexion.php";

// Comprobar si se ha enviado una solicitud de eliminación
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['eliminar'])) {
    // Obtener el ID del profesional a eliminar
    $id_profesional = $_GET['eliminar'];

    // Preparar la consulta SQL para eliminar el profesional
    $sql = "DELETE FROM profesional WHERE id_prof = ?";

    // Preparar la sentencia
    $stmt = $conn->prepare($sql);

    // Vincular parámetros
    $stmt->bind_param("i", $id_profesional);

    // Ejecutar la sentencia
    if ($stmt->execute()) {
        // Redireccionar a la misma página después de la eliminación
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        echo "Error al intentar eliminar el profesional.";
    }
}

// Consulta SQL
$sql = "SELECT id_prof, nombreYapellido, especialidad FROM profesional";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesionales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../estilos/styleCrearProf.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-eWBNsxi4e8wM26VyMG4/V/MZq51NSzU/VS6nH9flrDW5ZP4tMEF6idVrErGXOt+eqm+19ug7Ryv6T9Gxx+8r5A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <button class="button" style="vertical-align:middle"
        onclick="window.location.href = '../inicio/home.php';"><span>VOLVER</span></button>


    <h1>Gestión Psiquiátrica</h1>
    <div class="container">
        <div class="title-container">
            <h2>Tabla de Profesionales</h2>
            <!-- Botón para agregar profesional -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarProfesional">
                <i class="fas fa-user-plus"></i> Agregar Profesional
            </button>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre y Apellido</th>
                    <th>Especialidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Mostrar datos de cada fila
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["nombreYapellido"] . "</td><td>" . $row["especialidad"] . "</td><td><a href=\"{$_SERVER['PHP_SELF']}?eliminar=" . $row['id_prof'] . "\" onclick=\"return confirm('¿Estás seguro de que deseas eliminar este profesional?');\" class=\"eliminar-profesional\">Eliminar</a></td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No se encontraron resultados</td></tr>";
                }

                // Cerrar conexión
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para agregar profesional -->
    <div class="modal fade" id="agregarProfesional" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Profesional</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para agregar profesional -->
                    <form action="./agregarProf.php" method="POST">
                        <div class="mb-3">
                            <label for="nombreYapellido" class="form-label">Nombre y Apellido:</label>
                            <input type="text" class="form-control" id="nombreYapellido" name="nombreYapellido">
                        </div>
                        <div class="mb-3">
                            <label for="especialidad" class="form-label">Especialidad:</label>
                            <input type="text" class="form-control" id="especialidad" name="especialidad">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
                </form>
            </div>
        </div>
    </div>


</body>

</html>