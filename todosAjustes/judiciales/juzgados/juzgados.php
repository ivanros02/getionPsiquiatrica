<?php
require_once "../../../conexion.php";

session_start();

// Verifica si el usuario ha iniciado sesión
if (isset($_SESSION['usuario'])) {
    // El usuario ha iniciado sesión, puedes mostrar contenido para usuarios autenticados o ejecutar acciones específicas
} else {
    header("Location: ../../../index.php");
}

// Verificar si se ha enviado el parámetro "eliminar"
if (isset($_GET['eliminar'])) {
    // Recibir el ID de la especialidad a eliminar
    $id = $_GET['eliminar'];

    // Preparar la consulta SQL para eliminar la especialidad
    $sql = "DELETE FROM juzgado WHERE id = ?";

    // Preparar la sentencia
    $stmt = $conn->prepare($sql);

    // Vincular parámetros
    $stmt->bind_param("i", $id);

    try {
        // Ejecutar la sentencia
        if ($stmt->execute()) {
            // Redirigir a la página después de eliminar
            header("Location: ./juzgados.php");
            exit();
        } else {
            throw new Exception($stmt->error);
        }
    } catch (mysqli_sql_exception $e) {
        // Verificar si el error es de restricción de clave externa
        if ($e->getCode() == 1451) {
            // Error de restricción de clave externa
            echo "<script>
                    alert('Error al eliminar, juzgado relacionada a un paciente');
                    window.location.href = './juzgados.php';
                  </script>";
        } else {
            // Otro error
            echo "Error al eliminar la especialidad: " . $e->getMessage();
        }
    }

    // Cerrar la sentencia
    $stmt->close();
}

// No cerrar la conexión aquí si planeas usarla después en el mismo script
// $conn->close();




// Verificar si se ha enviado el parámetro "id" para la edición
if (isset($_GET['id'])) {
    // Obtener el ID de la especialidad a editar
    $id = $_GET['id'];
    // Consultar la especialidad con el ID proporcionado
    $sql = "SELECT * FROM juzgado WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Obtener los datos de la especialidad
        $row = $result->fetch_assoc();
        // Pasar los datos de la especialidad al modal de edición
        echo "<script>editarJuzgado(" . json_encode($row) . ");</script>";
    }
    $stmt->close();
}

// Obtener todas las especialidades
$sql = "SELECT * FROM juzgado";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juzgado</title>
    <!--icono pestana-->
    <link rel="icon" href="../../../img/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="../../../img/logo.png" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../../estilos/styleBotones.css">
    <link rel="stylesheet" href="../../../estilos/styleGeneral.css">
</head>

<body>
    <button class="button" style="vertical-align:middle; margin-left:7rem"
        onclick="window.location.href = '../../../seccionAjustes/ajustes.php';">
        <span>VOLVER</span>
    </button>


    <div class="text-center my-4">
        <img src="../../../img/logo.png" alt="Logo MEDICAL" class="img-fluid" style="max-width: 120px;">
    </div>

    <div class="container">
        <div class="title-container">

            <h2>Juzgado</h2>
            <!-- Botón para agregar profesional -->
            <button type="button" class="btn btn-custom btn-lg" data-bs-toggle="modal"
                data-bs-target="#agregarJuzgadoModal">
                Agregar Juzgado <img src="../../../img/judiciales.png" alt="Icono agregar Juzgado"
                    style="width: 50px; height: 50px; margin-left: 8px;">
            </button>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nro de juzgado</th>
                    <th>Descripcion</th>
                    <th>Calle</th>
                    <th>Numero</th>
                    <th>Localidad</th>
                    <th>Provincia</th>
                    <th>C. Postal</th>
                    <th>Tribunal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row["id"] ?></td>
                            <td><?= $row["nro_juzgado"] ?></td>
                            <td><?= $row["descripcion"] ?></td>
                            <td><?= $row["calle"] ?></td>
                            <td><?= $row["numero"] ?></td>
                            <td><?= $row["localidad"] ?></td>
                            <td><?= $row["provincia"] ?></td>
                            <td><?= $row["c_postal"] ?></td>
                            <td><?= $row["tribunal"] ?></td>
                            <td>
                                <button class="btn btn-custom-editar" onclick='editarJuzgado(<?= json_encode($row) ?>)'><i
                                        class="fas fa-pencil-alt"></i></button>
                                <a href="?eliminar=<?= $row['id'] ?>" class="btn btn-danger"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este juzgado?');"><i
                                        class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">No se encontraron resultados</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>

    <!-- Modal para agregar/editar especialidad -->
    <div class="modal fade" id="agregarJuzgadoModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Juzgado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formJuzgado" action="./agregarJuzgado.php" method="POST">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label for="nro_juzgado">Nro de juzgado</label>
                            <input type="text" class="form-control" id="nro_juzgado" name="nro_juzgado" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                        </div>
                        <div class="form-group">
                            <label for="calle">Calle</label>
                            <input type="text" class="form-control" id="calle" name="calle" required>
                        </div>
                        <div class="form-group">
                            <label for="numero">Numero</label>
                            <input type="text" class="form-control" id="numero" name="numero" required>
                        </div>
                        <div class="form-group">
                            <label for="localidad">Localidad</label>
                            <input type="text" class="form-control" id="localidad" name="localidad" required>
                        </div>
                        <div class="form-group">
                            <label for="provincia">Provincia</label>
                            <input type="text" class="form-control" id="provincia" name="provincia" required>
                        </div>
                        <div class="form-group">
                            <label for="c_postal">Código Postal</label>
                            <input type="text" class="form-control" id="c_postal" name="c_postal" required>
                        </div>
                        <div class="form-group">
                            <label for="tribunal">Tribunal</label>
                            <input type="text" class="form-control" id="tribunal" name="tribunal" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary btn-custom-save">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    </div>

    <footer class="bg-dark text-white text-center py-4 mt-auto">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 footer-logo-text">
                    <img src="../../../img/logoWSS.png" alt="Logo" class="img-fluid" style="max-height: 50px;">
                    <p class="mb-0">&copy; 2024 WorldsoftSystems. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>



    <script>

        document.addEventListener("DOMContentLoaded", function () {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('success') && urlParams.get('success') === 'true') {
                alert("El juzgado se ha editado correctamente.");
                // Eliminar el parámetro de la URL
                urlParams.delete('success');
                // Actualizar la URL sin recargar la página
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        });

        document.addEventListener("DOMContentLoaded", function () {
            function editarJuzgado(juzgado) {
                document.getElementById('formJuzgado').action = './editarJuzgado.php'; // Asegúrate de que el formulario apunta a la URL correcta

                document.getElementById('id').value = juzgado.id;
                document.getElementById('nro_juzgado').value = juzgado.nro_juzgado;
                document.getElementById('descripcion').value = juzgado.descripcion;
                document.getElementById('calle').value = juzgado.calle;
                document.getElementById('numero').value = juzgado.numero;
                document.getElementById('localidad').value = juzgado.localidad;
                document.getElementById('provincia').value = juzgado.provincia;
                document.getElementById('c_postal').value = juzgado.c_postal;
                document.getElementById('tribunal').value = juzgado.tribunal;

                // Mostrar el modal de edición
                var modal = new bootstrap.Modal(document.getElementById('agregarJuzgadoModal'));
                modal.show();
            }

            // Función para limpiar el formulario
            function limpiarFormulario() {
                document.getElementById('formJuzgado').action = './agregarJuzgado.php';
                document.getElementById('id').value = '';
                document.getElementById('nro_juzgado').value = '';
                document.getElementById('descripcion').value = '';
                document.getElementById('calle').value = '';
                document.getElementById('numero').value = '';
                document.getElementById('localidad').value = '';
                document.getElementById('provincia').value = '';
                document.getElementById('c_postal').value = '';
                document.getElementById('tribunal').value = '';
            }

            // Adjuntar la función de edición al alcance global
            window.editarJuzgado = editarJuzgado;

            // Limpiar el formulario al abrir el modal para agregar juzgado
            var btnAgregarJuzgadoModal = document.querySelector('button[data-bs-target="#agregarJuzgadoModal"]');
            btnAgregarJuzgadoModal.addEventListener('click', limpiarFormulario);
        });

    </script>


</body>

</html>