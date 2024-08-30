<?php
require_once "../../conexion.php";

session_start();

// Verifica si el usuario ha iniciado sesión
if (isset($_SESSION['usuario'])) {
    // El usuario ha iniciado sesión, puedes mostrar contenido para usuarios autenticados o ejecutar acciones específicas
} else {
    header("Location: ../../index.php");
}

// Verificar si se ha enviado el parámetro "eliminar"
if (isset($_GET['eliminar'])) {
    // Recibir el ID de la especialidad a eliminar
    $id = $_GET['eliminar'];

    // Preparar la consulta SQL para eliminar la especialidad
    $sql = "DELETE FROM parametro_sistema WHERE id = ?";

    // Preparar la sentencia
    $stmt = $conn->prepare($sql);

    // Vincular parámetros
    $stmt->bind_param("i", $id);

    try {
        // Ejecutar la sentencia
        if ($stmt->execute()) {
            // Redirigir a la página después de eliminar
            header("Location: ./parametros.php");
            exit();
        } else {
            throw new Exception($stmt->error);
        }
    } catch (mysqli_sql_exception $e) {
        // Verificar si el error es de restricción de clave externa
        if ($e->getCode() == 1451) {
            // Error de restricción de clave externa
            echo "<script>
                    alert('Error al eliminar, parametro relacionado');
                    window.location.href = './parametros.php';
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
    $sql = "SELECT * FROM parametro_sistema WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Obtener los datos de la especialidad
        $row = $result->fetch_assoc();
        // Pasar los datos de la especialidad al modal de edición
        echo "<script>editarParametro(" . json_encode($row) . ");</script>";
    }
    $stmt->close();
}

// Obtener todas las especialidades
$sql = "SELECT * FROM parametro_sistema";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parametros</title>
    <!--icono pestana-->
    <link rel="icon" href="../../img/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="../../img/logo.png" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../estilos/styleBotones.css">
    <link rel="stylesheet" href="../../estilos/styleGeneral.css">
</head>

<body>
    <button class="button" style="vertical-align:middle; margin-left:7rem"
        onclick="window.location.href = '../../seccionAjustes/ajustes.php';">
        <span>VOLVER</span>
    </button>


    <div class="text-center my-4">
        <img src="../../img/logo.png" alt="Logo MEDICAL" class="img-fluid" style="max-width: 120px;">
    </div>

    <div class="container">
        <div class="title-container">

            <h2>Parametros</h2>
            <!-- Botón para agregar profesional -->
            <button type="button" class="btn btn-custom btn-lg" data-bs-toggle="modal"
                data-bs-target="#agregarParametroModal">
                Agregar Parametro <img src="../../img/medicacion.png" alt="Icono agregar parametro"
                    style="width: 50px; height: 50px; margin-left: 8px;">
            </button>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="table-custom">
                <tr>
                    <th>ID</th>
                    <th>Institucion</th>
                    <th>Razon social</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row["id"] ?></td>
                            <td><?= $row["inst"] ?></td>
                            <td><?= $row["razon_social"] ?></td>
                            <td>
                                <button class="btn btn-custom-editar" onclick='editarParametro(<?= json_encode($row) ?>)'><i
                                        class="fas fa-pencil-alt"></i></button>


                                <a href="?eliminar=<?= $row['id'] ?>" class="btn btn-danger"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar parametro?');"><i
                                        class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No se encontraron resultados</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para agregar/editar especialidad -->
    <div class="modal fade" id="agregarParametroModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Medicacion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formParametro" action="./agregarParametro.php" method="POST">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label for="inst">Institución</label>
                            <input type="text" class="form-control" id="inst" name="inst" required>
                        </div>

                        <div class="form-group">
                            <label for="razon_social">Razón Social</label>
                            <input type="text" class="form-control" id="razon_social" name="razon_social" required>
                        </div>

                        <div class="form-group">
                            <label for="c_interno">Código Interno</label>
                            <input type="number" class="form-control" id="c_interno" name="c_interno" required>
                        </div>

                        <div class="form-group">
                            <label for="c_pami">Código PAMI</label>
                            <input type="number" class="form-control" id="c_pami" name="c_pami" required>
                        </div>

                        <div class="form-group">
                            <label for="cuit">CUIT</label>
                            <input type="number" class="form-control" id="cuit" name="cuit" required>
                        </div>

                        <div class="form-group">
                            <label for="u_efect">Usuario Efectores</label>
                            <input type="text" class="form-control" id="u_efect" name="u_efect" required>
                        </div>

                        <div class="form-group">
                            <label for="clave_efect">Clave Efectores</label>
                            <input type="text" class="form-control" id="clave_efect" name="clave_efect" required>
                        </div>

                        <div class="form-group">
                            <label for="mail">Correo Electrónico</label>
                            <input type="email" class="form-control" id="mail" name="mail" required>
                        </div>

                        <div class="form-group">
                            <label for="boca_ate">Boca de Atención</label>
                            <input type="number" class="form-control" id="boca_ate" name="boca_ate" required>
                        </div>

                        <div class="form-group">
                            <label for="dir">Dirección</label>
                            <input type="text" class="form-control" id="dir" name="dir" required>
                        </div>

                        <div class="form-group">
                            <label for="localidad">Localidad</label>
                            <input type="text" class="form-control" id="localidad" name="localidad" required>
                        </div>

                        <div class="form-group">
                            <label for="cod_sucursal">Código Sucursal</label>
                            <input type="number" class="form-control" id="cod_sucursal" name="cod_sucursal" required>
                        </div>

                        <div class="form-group">
                            <label for="tel">Teléfono</label>
                            <input type="text" class="form-control" id="tel" name="tel" required>
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
                    <img src="../../img/logoWSS.png" alt="Logo" class="img-fluid" style="max-height: 50px;">
                    <p class="mb-0">&copy; 2024 WorldsoftSystems. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>



    <script>

        document.addEventListener("DOMContentLoaded", function () {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('success') && urlParams.get('success') === 'true') {
                alert("Parametros se ha editado correctamente.");
                // Eliminar el parámetro de la URL
                urlParams.delete('success');
                // Actualizar la URL sin recargar la página
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        });

        document.addEventListener("DOMContentLoaded", function () {
            function editarParametro(parametro) {
                document.getElementById('formParametro').action = './editarParametro.php'; // Asegúrate de que el formulario apunta a la URL correcta

                // Rellenar los campos del formulario con los datos de la especialidad
                // Rellenar los campos del formulario con los datos de la especialidad
                document.getElementById('id').value = parametro.id;
                document.getElementById('inst').value = parametro.inst;
                document.getElementById('razon_social').value =  parametro.razon_social;
                document.getElementById('c_interno').value = parametro.c_interno;
                document.getElementById('c_pami').value = parametro.c_pami;
                document.getElementById('cuit').value = parametro.cuit;
                document.getElementById('u_efect').value = parametro.u_efect;
                document.getElementById('clave_efect').value = parametro.clave_efect;
                document.getElementById('mail').value = parametro.mail;
                document.getElementById('boca_ate').value = parametro.boca_ate;
                document.getElementById('dir').value = parametro.dir;
                document.getElementById('localidad').value = parametro.localidad;
                document.getElementById('cod_sucursal').value = parametro.cod_sucursal;
                document.getElementById('tel').value =parametro.tel;

                // Mostrar el modal de edición
                var modal = new bootstrap.Modal(document.getElementById('agregarParametroModal'));
                modal.show();
            }

            // Función para limpiar el formulario
            function limpiarFormulario() {
                document.getElementById('formParametro').action = './agregarParametro.php';
                // Limpiar todos los campos del formulario
                document.getElementById('id').value = '';
                document.getElementById('inst').value = '';
                document.getElementById('razon_social').value = '';
                document.getElementById('c_interno').value = '';
                document.getElementById('c_pami').value = '';
                document.getElementById('cuit').value = '';
                document.getElementById('u_efect').value = '';
                document.getElementById('clave_efect').value = '';
                document.getElementById('mail').value = '';
                document.getElementById('boca_ate').value = '';
                document.getElementById('dir').value = '';
                document.getElementById('localidad').value = '';
                document.getElementById('cod_sucursal').value = '';
                document.getElementById('tel').value = '';
            }

            // Adjuntar la función de edición al alcance global
            window.editarParametro = editarParametro;

            // Limpiar el formulario al abrir el modal para agregar profesional
            var btnAgregarParametroModal = document.querySelector('button[data-bs-target="#agregarParametroModal"]');
            btnAgregarMedicacionModal.addEventListener('click', limpiarFormulario);


        });
    </script>


</body>

</html>