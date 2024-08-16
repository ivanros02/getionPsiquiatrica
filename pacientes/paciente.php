<?php
require_once "../conexion.php";

session_start();

// Verifica si el usuario ha iniciado sesión
if (isset($_SESSION['usuario'])) {
    // El usuario ha iniciado sesión, puedes mostrar contenido para usuarios autenticados o ejecutar acciones específicas
} else {
    header("Location: ../index.php");
}

// Verificar si se ha enviado el parámetro "eliminar"
if (isset($_GET['eliminar'])) {
    // Recibir el ID del paciente a eliminar
    $id = $_GET['eliminar'];

    // Preparar la consulta SQL para eliminar el paciente
    $sql = "DELETE FROM paciente WHERE id = ?";

    // Preparar la sentencia
    $stmt = $conn->prepare($sql);

    // Vincular parámetros
    $stmt->bind_param("i", $id);

    try {
        // Ejecutar la sentencia
        if ($stmt->execute()) {
            // Redirigir a la página después de eliminar
            header("Location: ./paciente.php");
            exit();
        } else {
            throw new Exception($stmt->error);
        }
    } catch (mysqli_sql_exception $e) {
        // Verificar si el error es de restricción de clave externa
        if ($e->getCode() == 1451) {
            // Error de restricción de clave externa
            echo "<script>
                    alert('Error al eliminar, el paciente está relacionado con otra tabla');
                    window.location.href = './paciente.php';
                  </script>";
        } else {
            // Otro error
            echo "Error al eliminar el paciente: " . $e->getMessage();
        }
    }

    // Cerrar la sentencia
    $stmt->close();
}

// Obtener todos los pacientes
$sql = "SELECT * FROM paciente ORDER BY nombre ASC";
$result = $conn->query($sql);

$conn->close();


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes</title>
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    
    <link rel="stylesheet" href="../estilos/styleBotones.css">
    <link rel="stylesheet" href="../estilos/styleGeneral.css">
    <script src="./script/scriptPaciente.js" defer></script>
    <script src="./script/submenues.js" defer></script>
    <!--REPORTES -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>
    <style>
        .modal-xl {
            max-width: 89%;

        }

        .custom-icon {
            color: var(--primary-color);
        }

        .icon-text {
            color: var(--primary-color) !important;
        }



        .scrollable-content {
            max-height: 400px;
            /* Ajusta según sea necesario */
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            align-items: center;
            position: relative;
        }

        .modal-header-center {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .modal-title {
            margin: 0;
            flex: 1;
            text-align: start;
        }

        .modal-logo {
            max-height: 4rem;
            margin-top: 1rem;
            /* Ajusta según sea necesario */
        }

        .btn-custom-add {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .custom-modal-paciente{
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <button class="button" style="vertical-align:middle; margin-left:7rem"
        onclick="window.location.href = '../inicio/home.php';">
        <span>VOLVER</span>
    </button>

    <div class="text-center my-4">
        <img src="../img/logo.png" alt="Logo MEDICAL" class="img-fluid" style="max-width: 15rem;">
    </div>

    <div class="container">
        <div class="title-container">
            <h2>Pacientes</h2>
            <input type="text" id="searchInput" class="form-control" placeholder="Buscar por nombre o beneficio"
                style="margin-bottom: 15px; width: 300px; display: inline-block;">
            <button type="button" class="btn btn-custom btn-lg" data-bs-toggle="modal"
                data-bs-target="#agregarPacienteModal">
                Agregar Paciente <img src="../img/home/pacientes.png" alt="Icono agregar paciente"
                    style="width: 50px; height: 50px; margin-left: 8px;">
            </button>
        </div>
        <table class="table table-striped table-bordered " id="pacientesTable">
            <thead class="table-custom">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Beneficio</th>
                    <th>Parentesco</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row["id"] ?></td>
                            <td><?= $row["nombre"] ?></td>
                            <td><?= $row["benef"] ?></td>
                            <td><?= $row["parentesco"] ?></td>
                            <td>
                                <button class="btn btn-custom-editar" onclick='editarPaciente(<?= json_encode($row) ?>)'><i
                                        class="fas fa-pencil-alt"></i></button>
                                <a href="?eliminar=<?= $row['id'] ?>" class="btn btn-danger"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este paciente?');"><i
                                        class="fas fa-trash-alt"></i></a>
                                <button class="btn btn-info" onclick="openReportModal(<?= $row['id'] ?>)">
                                    <i class="fas fa-file-alt"></i>
                                </button>
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

    <!-- Modal para agregar/editar paciente -->
    <div class="modal fade" id="agregarPacienteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl custom-modal-paciente">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Paciente</h5>
                    <!-- Icons for different sections -->
                    <div class="d-flex flex-wrap align-items-center">

                        <a href="#" class="btn btn-link" title="Practicas" data-bs-toggle="modal"
                            data-bs-target="#pracModal" onclick="loadPracticasModal()">
                            <i class="fas fa-comment-medical custom-icon"></i>
                            <span class="icon-text">Practicas</span>
                        </a>

                        <!-- Enlace para abrir el modal de Egresos -->
                        <a href="#" class="btn btn-link" title="Modalidades" data-bs-toggle="modal"
                            data-bs-target="#modaModal" onclick="loadModalidadesModal()">
                            <i class="fas fa-sliders-h custom-icon"></i>
                            <span class="icon-text">Modalidades</span>
                        </a>

                        <!-- Enlace para abrir el modal de Egresos -->
                        <a href="#" class="btn btn-link" title="Egresos" data-bs-toggle="modal"
                            data-bs-target="#egresoModal" onclick="loadEgresoModal()">
                            <i class="fas fa-sign-out-alt custom-icon"></i>
                            <span class="icon-text">Egresos</span>
                        </a>

                        <a href="#" class="btn btn-link" title="evoluciones" data-bs-toggle="modal"
                            data-bs-target="#evoModal" onclick="loadEvolucionModal()">
                            <i class="fas fa-chart-line custom-icon"></i>
                            <span class="icon-text">Evoluciones</span>
                        </a>

                        <a href="#" class="btn btn-link" title="diagnosticos" data-bs-toggle="modal"
                            data-bs-target="#diagModal" onclick="loadDiagnosticoModal()">
                            <i class="fas fa-notes-medical custom-icon"></i>
                            <span class="icon-text">Diagnosticos</span>
                        </a>

                        <a href="#" class="btn btn-link" title="Medicacion" data-bs-toggle="modal"
                            data-bs-target="#mediModal" onclick="loadMedicacionModal()">
                            <i class="fas fa-pills custom-icon"></i>
                            <span class="icon-text">Medicacion</span>
                        </a>

                        <!-- Enlace para abrir el modal de Responsables -->
                        <a href="#" class="btn btn-link" title="responsables" data-bs-toggle="modal"
                            data-bs-target="#responModal" onclick="loadResponsablesModal()">
                            <i class="fas fa-users custom-icon"></i>
                            <span class="icon-text">Responsable</span>
                        </a>

                        <a href="#" class="btn btn-link" title="judiciales" data-bs-toggle="modal"
                            data-bs-target="#judiModal" onclick="loadJudicialesModal()">
                            <i class="fas fa-gavel custom-icon"></i>
                            <span class="icon-text">Judiciales</span>
                        </a>

                        <a href="#" class="btn btn-link" title="salidas" data-bs-toggle="modal"
                            data-bs-target="#saliModal" onclick="loadSalidasModal()">
                            <i class="fas fa-door-open custom-icon"></i>
                            <span class="icon-text">Salidas</span>
                        </a>

                        <a href="#" class="btn btn-link" title="habitaciones" data-bs-toggle="modal"
                            data-bs-target="#habiModal" onclick="loadHabitacionesModal()">
                            <i class="fas fa-bed custom-icon"></i>
                            <span class="icon-text">Habitaciones</span>

                        </a>

                        <a href="#" class="btn btn-link" title="visitas" data-bs-toggle="modal"
                            data-bs-target="#visiModal" onclick="loadVisitasModal()">
                            <i class="fas fa-user-friends custom-icon"></i>
                            <span class="icon-text">Visitas</span>
                        </a>

                        <a href="#" class="btn btn-link" title="visitas" data-bs-toggle="modal"
                            data-bs-target="#trasModal" onclick="loadTrasladosModal()">
                            <i class="fas fa-user-friends custom-icon"></i>
                            <span class="icon-text">Traslados</span>
                        </a>

                        <a href="#" class="btn btn-link" title="visitas" data-bs-toggle="modal"
                            data-bs-target="#ordenModal" onclick="loadOrdenModal()">
                            <i class="fas fa-list-alt custom-icon"></i>
                            <span class="icon-text">Ordenes de prestacion</span>
                        </a>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formPaciente" action="./agregarPaciente.php" method="POST">
                        <input type="hidden" id="id" name="id">

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="obra_social">Obra Social:*</label>
                                <select class="form-control" id="obra_social" name="obra_social" required>
                                    <option value="">Seleccionar...</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="benef">Beneficiario(12):*</label>
                                <input type="number" class="form-control" id="benef" name="benef" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="parentesco">Parentesco(2):*</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="parentesco" name="parentesco" required>
                                    <div class="input-group-append" id="btnBuscar">
                                        <span class="input-group-text">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="nombre">Nombre Y Apellido:*</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" readonly required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="fecha_nac">Fecha de Nacimiento:*</label>
                                <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="sexo">Sexo:*</label>
                                <select class="form-control" id="sexo" name="sexo" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Masculino">Masculino</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="tipo_afiliado">Tipo de Afiliado:*</label>
                                <select class="form-control" id="tipo_afiliado" name="tipo_afiliado" required>
                                    <option value="">Seleccionar...</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="tipo_doc">Tipo de Doc.:*</label>
                                <input type="text" class="form-control" id="tipo_doc" name="tipo_doc" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="nro_doc">Número de Documento:*</label>
                                <input type="number" class="form-control" id="nro_doc" name="nro_doc" required>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="admision">Fecha de Admisión:*</label>
                                <input type="date" class="form-control" id="admision" name="admision" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="modalidad">Modalidad:*</label>
                                <select class="form-control" id="modalidad" name="modalidad" required>
                                    <option value="">Seleccionar...</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="id_prof">Profesional:*</label>
                                <select class="form-control" id="id_prof" name="id_prof" required>
                                    <option value="">Seleccionar...</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-4 form-group">
                                <label for="ocupacion">Ocupación:</label>
                                <input type="text" class="form-control" id="ocupacion" name="ocupacion">
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="hijos">Hijos:</label>
                                <input type="number" class="form-control" id="hijos" name="hijos">
                            </div>
                        </div>



                        <div class="row">



                            <div class="col-md-4 form-group">
                                <label for="partido">Partido:</label>
                                <input type="text" class="form-control" id="partido" name="partido">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="localidad">Localidad:</label>
                                <input type="text" class="form-control" id="localidad" name="localidad">
                            </div>

                        </div>

                        <div class="row">


                            <div class="col-md-4 form-group">
                                <label for="telefono">Teléfono:</label>
                                <input type="text" class="form-control" id="telefono" name="telefono">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="c_postal">Código Postal:</label>
                                <input type="number" class="form-control" id="c_postal" name="c_postal">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="domicilio">Domicilio:</label>
                                <input type="text" class="form-control" id="domicilio" name="domicilio">
                            </div>
                        </div>




                        <div class="modal-footer">
                            <div class="modal-header-center">
                                <img src="../img/logo.png" alt="Logo" class="modal-logo">
                            </div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary btn-custom-save">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal de PRACTICAS -->
    <div class="modal fade" id="pracModal" tabindex="-1" aria-labelledby="pracModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pracModalLabel">Practicas</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="addPracModalBody">
                    <!-- Aquí se cargará el contenido del formulario de agregar práctica -->
                </div>
                <div class="modal-body" id="pracModalBody">
                    <!-- Aquí se cargará el contenido del formulario -->
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <!-- Contenedor de la lista de prácticas -->
                        <div id="listaPrac" class="scrollable-content">
                            <!-- Aquí se cargará dinámicamente la lista de prácticas -->
                        </div>
                        <!-- Contenedor de la paginación -->
                        <div id="pagination" class="mt-3">
                            <!-- Aquí se cargarán los controles de paginación -->
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-volver">Volver</button>
                    <button type="button" class="btn btn-primary btn-custom-save" id="nuevaPrac">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="agregarPracModal" tabindex="-1" aria-labelledby="agregarPracModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarPracModalLabel">Agregar Practica</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarPrac" class="row g-3">
                        <input type="hidden" id="pracIdPaciente" name="id_paciente">
                        <input type="hidden" name="id" id="pracId">
                        <div class="col-md-4">
                            <label for="pracNombreCarga" class="form-label">Nombre y Apellido</label>
                            <input type="text" class="form-control" id="pracNombreCarga" name="nombre" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="pracFecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="pracFecha" name="fecha" required>
                        </div>
                        <div class="col-md-4">
                            <label for="pracHora" class="form-label">Hora</label>
                            <input type="time" class="form-control" id="pracHora" name="hora" required>
                        </div>
                        <div class="col-md-4">
                            <label for="pracProfesional" class="form-label">Profesional</label>
                            <select class="form-control" id="pracProfesional" name="profesional" required>
                                <option value="">Seleccionar...</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="pracActividad" class="form-label">Actividad</label>
                            <select class="form-control" name="actividad" id="pracActividad">
                                <option value="">Seleccionar...</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="pracCantidad" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="pracCantidad" name="cant" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-custom-save"
                        id="btnGuardarPractica">Guardar</button>

                </div>
            </div>
        </div>
    </div>
    <!-- FIN PRACTICAS-->

    <!-- Modal de MODALIDADES -->
    <div class="modal fade" id="modaModal" tabindex="-1" aria-labelledby="modaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaModalLabel">Modalidades</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modaModalBody">
                    <!-- Aquí se cargará el contenido del formulario -->
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div id="listaModa" class="scrollable-content">
                            <!-- Aquí se cargará dinámicamente la lista de prácticas -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-volver">Volver</button>
                    <button type="button" class="btn btn-primary btn-custom-save" id="nuevaModali">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="agregarModaliModal" tabindex="-1" aria-labelledby="agregarModaliModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarModaliModalLabel">Agregar Modalidad</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarModali" class="row g-3">
                        <input type="hidden" id="modaliIdPaciente" name="id_paciente">
                        <input type="hidden" name="id" id="modaliId">

                        <div class="col-md-4">
                            <label for="modaliNombreCarga" class="form-label">Nombre y Apellido</label>
                            <input type="text" class="form-control" id="modaliNombreCarga" name="nombre" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="modaliFecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="modaliFecha" name="fecha" required>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="modalidad_paci">Modalidad:*</label>
                            <select class="form-control" id="modalidad_paci" name="modalidad_paci" required>
                                <option value="">Seleccionar...</option>
                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-custom-save" id="btnGuardarModali">Guardar</button>

                </div>
            </div>
        </div>
    </div>

    <!-- FIN MODALIDADES -->

    <!-- Modal de Egreso -->
    <div class="modal fade" id="egresoModal" tabindex="-1" aria-labelledby="egresoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="egresoModalLabel">Egresos</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="egresoModalBody">
                    <!-- Aquí se cargará el contenido del formulario -->
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div id="listaEgresos" class="scrollable-content">
                            <!-- Aquí se cargará dinámicamente la lista de prácticas -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-volver">Volver</button>
                    <button type="button" class="btn btn-primary btn-custom-save" id="nuevoEgreso">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="agregarEgresoModal" tabindex="-1" aria-labelledby="agregarEgresoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarEgresoModalLabel">Agregar Egreso</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarEgreso" class="row g-3">
                        <input type="hidden" id="egresoIdPaciente" name="id_paciente">
                        <input type="hidden" name="id" id="egresoId">

                        <div class="col-md-4">
                            <label for="egresoNombreCarga" class="form-label">Nombre y Apellido</label>
                            <input type="text" class="form-control" id="egresoNombreCarga" name="nombre" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="egresoFecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="egresoFecha" name="fecha" required>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="egreso_diag">Diagnostico:*</label>
                            <select class="form-control" id="egreso_diag" name="egreso_diag" required>
                                <option value="">Seleccionar...</option>
                            </select>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="egreso_modalidad">Modalidad:*</label>
                            <select class="form-control" id="egreso_modalidad" name="egreso_modalidad" required>
                                <option value="">Seleccionar...</option>
                            </select>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="egreso_motivo">Motivo:*</label>
                            <select class="form-control" id="egreso_motivo" name="egreso_motivo" required>
                                <option value="">Seleccionar...</option>
                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-custom-save" id="btnGuardarEgreso">Guardar</button>

                </div>
            </div>
        </div>
    </div>

    <!-- FIN EGRESO -->

    <!-- Modal de EVOLUCIONES -->
    <div class="modal fade" id="evoModal" tabindex="-1" aria-labelledby="evoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="evoModalLabel">Evoluciones</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="evoModalBody">
                    <!-- Aquí se cargará el contenido del formulario -->
                </div>
                <div class="row">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div id="listaEvo" class="scrollable-content">
                                <!-- Aquí se cargará dinámicamente la lista de prácticas -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-volver">Volver</button>
                        <button type="button" class="btn btn-primary btn-custom-save" id="nuevaEvo">Agregar</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="agregarEvoModal" tabindex="-1" aria-labelledby="agregarEvoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarEvoModalLabel">Agregar Evolucion</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarEvolucion" class="row g-3">
                        <input type="hidden" id="evoIdPaciente" name="id_paciente">
                        <input type="hidden" name="id" id="evoId">

                        <div class="col-md-4">
                            <label for="evoNombreCarga" class="form-label">Nombre y Apellido</label>
                            <input type="text" class="form-control" id="evoNombreCarga" name="nombre" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="antecedentes">Antecedentes:</label>
                            <input type="text" class="form-control" id="antecedentes" name="antecedentes">
                        </div>

                        <div class="col-md-4">
                            <label for="motivo_evo">Motivo de consulta:</label>
                            <input type="text" class="form-control" id="motivo_evo" name="motivo_evo">
                        </div>


                        <div class="col-md-4">
                            <label for="estado_actual">Estado Actual:</label>
                            <input type="text" class="form-control" id="estado_actual" name="estado_actual">
                        </div>

                        <div class="col-md-4">
                            <label for="familia">Familia:</label>
                            <input type="text" class="form-control" id="familia" name="familia">
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="evo_diag">Diagnostico:*</label>
                            <select class="form-control" id="evo_diag" name="evo_diag" required>
                                <option value="">Seleccionar...</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="objetivo">Objetivo del tratamiento:</label>
                            <input type="text" class="form-control" id="objetivo" name="objetivo">
                        </div>

                        <div class="col-md-4">
                            <label for="duracion">Duracion estimada del tratamiento:</label>
                            <input type="text" class="form-control" id="duracion" name="duracion">
                        </div>

                        <div class="col-md-4">
                            <label for="frecuencia">Frecuencia de entrevista:</label>
                            <input type="text" class="form-control" id="frecuencia" name="frecuencia">
                        </div>

                        <div class="col-md-4">
                            <label for="evoFecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="evoFecha" name="evoFecha" required>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-custom-save" id="btnGuardarEvo">Guardar</button>

                </div>
            </div>
        </div>
    </div>
    <!-- FIN EVOLUCIONES-->

    <!-- Modal de DIAGNOSTICOS -->
    <div class="modal fade" id="diagModal" tabindex="-1" aria-labelledby="diagModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="diagModalLabel">Diagnosticos</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="diagModalBody">
                    <!-- Aquí se cargará el contenido del formulario -->
                </div>
                <div class="row">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div id="listaDiag" class="scrollable-content">
                                <!-- Aquí se cargará dinámicamente la lista de prácticas -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-volver">Volver</button>
                        <button type="button" class="btn btn-primary btn-custom-save" id="nuevaDiag">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="agregarDiagModal" tabindex="-1" aria-labelledby="agregarDiagModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarDiagModalLabel">Agregar Diagnostico</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarDiag" class="row g-3">
                        <input type="hidden" id="diagIdPaciente" name="id_paciente">
                        <input type="hidden" name="id" id="diagId">

                        <div class="col-md-4">
                            <label for="diagNombreCarga" class="form-label">Nombre y Apellido</label>
                            <input type="text" class="form-control" id="diagNombreCarga" name="nombre" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="diagFecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="diagFecha" name="fecha" required>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="paci_diag">Diagnostico:*</label>
                            <select class="form-control" id="paci_diag" name="paci_diag" required>
                                <option value="">Seleccionar...</option>
                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-custom-save" id="btnGuardarDiag">Guardar</button>

                </div>
            </div>
        </div>
    </div>

    <!-- FIN DIAGNOSTICOS -->

    <!-- Modal de MEDICACION -->
    <div class="modal fade" id="mediModal" tabindex="-1" aria-labelledby="mediModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediModalLabel">Medicamentos</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="mediModalBody">
                    <!-- Aquí se cargará el contenido del formulario -->
                </div>
                <div class="row">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div id="listaMedi" class="scrollable-content">
                                <!-- Aquí se cargará dinámicamente la lista de prácticas -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-volver">Volver</button>
                        <button type="button" class="btn btn-primary btn-custom-save" id="nuevaMedi">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="agregarMediModal" tabindex="-1" aria-labelledby="agregarMediModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarMediModalLabel">Agregar Medicamento</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarMedi" class="row g-3">
                        <input type="hidden" id="mediIdPaciente" name="id_paciente">
                        <input type="hidden" name="id" id="mediId">

                        <div class="col-md-4">
                            <label for="mediNombreCarga" class="form-label">Nombre y Apellido</label>
                            <input type="text" class="form-control" id="mediNombreCarga" name="nombre" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="medi_fecha" class="form-label">Fecha:</label>
                            <input type="date" class="form-control" id="medi_fecha" name="medi_fecha" required>
                        </div>

                        <div class="col-md-4">
                            <label for="medi_hora" class="form-label">Hora</label>
                            <input type="time" class="form-control" id="medi_hora" name="medi_hora" required>
                        </div>

                        <div class="col-md-4">
                            <label for="dosis">Dosis:</label>
                            <input type="number" class="form-control" id="dosis" name="dosis" required>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="mediDesc">Medicamento:*</label>
                            <select class="form-control" id="mediDesc" name="mediDesc" required>
                                <option value="">Seleccionar...</option>
                            </select>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-custom-save" id="btnGuardarMedi">Guardar</button>

                </div>
            </div>
        </div>
    </div>

    <!-- FIN MEDICACION -->

    <!-- Modal de Responsable -->
    <div class="modal fade" id="responModal" tabindex="-1" aria-labelledby="responModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="responModalLabel">Responsables</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="responModalBody">
                    <!-- Aquí se cargará el contenido del formulario -->
                </div>
                <div class="row">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div id="listaRespon" class="scrollable-content">
                                <!-- Aquí se cargará dinámicamente la lista de prácticas -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-volver">Volver</button>
                        <button type="button" class="btn btn-primary btn-custom-save" id="nuevoRespon">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="agregarResponModal" tabindex="-1" aria-labelledby="agregarResponModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarResponModalLabel">Agregar Responsable</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarRespon" class="row g-3">
                        <input type="hidden" id="responIdPaciente" name="id_paciente">
                        <input type="hidden" name="id" id="responId">

                        <div class="col-md-4">
                            <label for="responNombreCarga" class="form-label">Nombre y Apellido</label>
                            <input type="text" class="form-control" id="responNombreCarga" name="nombre" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="respon_nombre">Nombre:</label>
                            <input type="text" class="form-control" id="respon_nombre" name="respon_nombre">
                        </div>

                        <div class="col-md-4">
                            <label for="respon_tel">tel:</label>
                            <input type="number" class="form-control" id="respon_tel" name="respon_tel">
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="respon_parent">Parentesco:*</label>
                            <select class="form-control" id="respon_parent" name="respon_parent" required>
                                <option value="">Seleccionar...</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="respon_dni">DNI:</label>
                            <input type="number" class="form-control" id="respon_dni" name="respon_dni">
                        </div>

                        <div class="col-md-4">
                            <label for="respon_dom">Domicilio:</label>
                            <input type="number" class="form-control" id="respon_dom" name="respon_dom">
                        </div>

                        <div class="col-md-4">
                            <label for="respon_locali">Localidad:</label>
                            <input type="text" class="form-control" id="respon_locali" name="respon_locali">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-custom-save" id="btnGuardarRespon">Guardar</button>

                </div>
            </div>
        </div>
    </div>
    <!-- FIN RESPONSABLES -->

    <!-- Modal de JUDICIALES -->
    <div class="modal fade" id="judiModal" tabindex="-1" aria-labelledby="judiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judiModalLabel">Judiciales</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="judiModalBody">
                    <!-- Aquí se cargará el contenido del formulario -->
                </div>
                <div class="row">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div id="listaJudi" class="scrollable-content">
                                <!-- Aquí se cargará dinámicamente la lista de prácticas -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-volver">Volver</button>
                        <button type="button" class="btn btn-primary btn-custom-save" id="nuevoJudi">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="agregarJudiModal" tabindex="-1" aria-labelledby="agregarJudiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarJudiModalLabel">Agregar Judiacial</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarJudi" class="row g-3">
                        <input type="hidden" id="judiIdPaciente" name="id_paciente">
                        <input type="hidden" name="id" id="judiId">

                        <div class="col-md-4">
                            <label for="judiNombreCarga" class="form-label">Nombre y Apellido</label>
                            <input type="text" class="form-control" id="judiNombreCarga" name="nombre" readonly>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="juzgado">Juzgado:*</label>
                            <select class="form-control" id="juzgado" name="juzgado" required>
                                <option value="">Seleccionar...</option>
                            </select>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="secretaria">Secretaria:*</label>
                            <select class="form-control" id="secretaria" name="secretaria" required>
                                <option value="">Seleccionar...</option>
                            </select>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="curaduria">Curaduria:*</label>
                            <select class="form-control" id="curaduria" name="curaduria" required>
                                <option value="">Seleccionar...</option>
                            </select>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="t_juicio">Tipo de juicio:*</label>
                            <select class="form-control" id="t_juicio" name="t_juicio" required>
                                <option value="">Seleccionar...</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="judiFecha" class="form-label">Vencimiento:</label>
                            <input type="date" class="form-control" id="judiFecha" name="fecha" required>
                        </div>

                        <div class="col-md-4">
                            <label for="judiObs">Observaciones:</label>
                            <input type="text" class="form-control" id="judiObs" name="judiObs">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-custom-save" id="btnGuardarJudi">Guardar</button>

                </div>
            </div>
        </div>
    </div>
    <!-- FIN JUDICIALES -->

    <!-- Modal de SALIDAS -->
    <div class="modal fade" id="saliModal" tabindex="-1" aria-labelledby="saliModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="saliModalLabel">Salidas</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="saliModalBody">
                    <!-- Aquí se cargará el contenido del formulario -->
                </div>
                <div class="row">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div id="listaSali" class="scrollable-content">
                                <!-- Aquí se cargará dinámicamente la lista de prácticas -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-volver">Volver</button>
                        <button type="button" class="btn btn-primary btn-custom-save" id="nuevoSali">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="agregarSaliModal" tabindex="-1" aria-labelledby="agregarSaliModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarSaliModalLabel">Agregar Salida</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarSali" class="row g-3">
                        <input type="hidden" id="saliIdPaciente" name="id_paciente">
                        <input type="hidden" name="id" id="saliId">

                        <div class="col-md-4">
                            <label for="saliNombreCarga" class="form-label">Nombre y Apellido</label>
                            <input type="text" class="form-control" id="saliNombreCarga" name="nombre" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="salida_fecha" class="form-label">Fecha Salida:</label>
                            <input type="date" class="form-control" id="salida_fecha" name="salida_fecha" required>
                        </div>

                        <div class="col-md-4">
                            <label for="llegada_fecha" class="form-label">Fecha Llegada:</label>
                            <input type="date" class="form-control" id="llegada_fecha" name="llegada_fecha" required>
                        </div>

                        <div class="col-md-4">
                            <label for="saliObs">Observaciones:</label>
                            <input type="text" class="form-control" id="saliObs" name="saliObs">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-custom-save" id="btnGuardarSali">Guardar</button>

                </div>
            </div>
        </div>
    </div>
    <!-- FIN SALIDAS -->

    <!-- Modal de HABITACIONES -->
    <div class="modal fade" id="habiModal" tabindex="-1" aria-labelledby="habiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="habiModalLabel">Habitaciones</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="habiModalBody">
                    <!-- Aquí se cargará el contenido del formulario -->
                </div>
                <div class="row">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div id="listaHabi" class="scrollable-content">
                                <!-- Aquí se cargará dinámicamente la lista de prácticas -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-between w-100">
                            <div class="d-flex align-items-center">
                                <span class="me-2">Habitaciones disponibles:</span>
                                <span id="habitacionesDisponibles" class="fw-bold"></span>
                            </div>
                            <div>
                                <button type="button" class="btn btn-secondary btn-volver me-2">Volver</button>
                                <button type="button" class="btn btn-primary btn-custom-save"
                                    id="nuevaHabi">Agregar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="agregarHabiModal" tabindex="-1" aria-labelledby="agregarHabiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarHabiModalLabel">Agregar Habitacion</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarHabi" class="row g-3">
                        <input type="hidden" id="habiIdPaciente" name="id_paciente">
                        <input type="hidden" name="id" id="habiId">

                        <div class="col-md-4">
                            <label for="habiNombreCarga" class="form-label">Nombre y Apellido</label>
                            <input type="text" class="form-control" id="habiNombreCarga" name="nombre" readonly>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="habitacion_nro">Habitacion:*</label>
                            <select class="form-control" id="habitacion_nro" name="habitacion_nro" required>
                                <option value="">Seleccionar...</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="habi_ingreso_fecha" class="form-label">Fecha ingreso:</label>
                            <input type="date" class="form-control" id="habi_ingreso_fecha" name="habi_ingreso_fecha"
                                required>
                        </div>


                        <div class="col-md-4">
                            <label for="habi_egreso_fecha" class="form-label">Fecha egreso:</label>
                            <input type="date" class="form-control" id="habi_egreso_fecha" name="habi_egreso_fecha"
                                required>
                        </div>



                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-custom-save" id="btnGuardarHabi">Guardar</button>

                </div>
            </div>
        </div>
    </div>
    <!-- FIN HABITACIONES -->

    <!-- Modal de VISITAS -->
    <div class="modal fade" id="visiModal" tabindex="-1" aria-labelledby="visiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="visiModalLabel">Visitas</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="visiModalBody">
                    <!-- Aquí se cargará el contenido del formulario -->
                </div>
                <div class="row">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div id="listaVisi" class="scrollable-content">
                                <!-- Aquí se cargará dinámicamente la lista de prácticas -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-volver">Volver</button>
                        <button type="button" class="btn btn-primary btn-custom-save" id="nuevaVisi">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="agregarVisiModal" tabindex="-1" aria-labelledby="agregarVisiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarVisiModalLabel">Agregar Visita</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarVisi" class="row g-3">
                        <input type="hidden" id="visiIdPaciente" name="id_paciente">
                        <input type="hidden" name="id" id="visiId">

                        <div class="col-md-4">
                            <label for="visiNombreCarga" class="form-label">Nombre y Apellido</label>
                            <input type="text" class="form-control" id="visiNombreCarga" name="nombre" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="visita_fecha" class="form-label">Fecha visita:</label>
                            <input type="date" class="form-control" id="visita_fecha" name="visita_fecha" required>
                        </div>

                        <div class="col-md-4">
                            <label for="visita_nom">Nombre de visita:</label>
                            <input type="text" class="form-control" id="visita_nom" name="visita_nom">
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="visita_parent">Parentesco de visita:*</label>
                            <select class="form-control" id="visita_parent" name="visita_parent" required>
                                <option value="">Seleccionar...</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="visita_obs">Observaciones:</label>
                            <input type="text" class="form-control" id="visita_obs" name="visita_obs">
                        </div>



                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-custom-save" id="btnGuardarVisi">Guardar</button>

                </div>
            </div>
        </div>
    </div>

    <!-- FIN VISITAS -->

    <!-- Modal de TRASLADOS -->
    <div class="modal fade" id="trasModal" tabindex="-1" aria-labelledby="trasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="trasModalLabel">Traslados</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="trasModalBody">
                    <!-- Aquí se cargará el contenido del formulario -->
                </div>
                <div class="row">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div id="listaTras" class="scrollable-content">
                                <!-- Aquí se cargará dinámicamente la lista de prácticas -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-volver">Volver</button>
                        <button type="button" class="btn btn-primary btn-custom-save" id="nuevoTras">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="agregarTrasModal" tabindex="-1" aria-labelledby="agregarTrasModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarTrasModalLabel">Agregar Traslado</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarTras" class="row g-3">
                        <input type="hidden" id="trasIdPaciente" name="id_paciente">
                        <input type="hidden" name="id" id="trasId">

                        <div class="col-md-4">
                            <label for="trasNombreCarga" class="form-label">Nombre y Apellido</label>
                            <input type="text" class="form-control" id="trasNombreCarga" name="nombre" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="tras_fecha" class="form-label">Fecha traslado:</label>
                            <input type="date" class="form-control" id="tras_fecha" name="tras_fecha" required>
                        </div>

                        <div class="col-md-4">
                            <label for="tras_hora" class="form-label">Hora</label>
                            <input type="time" class="form-control" id="tras_hora" name="tras_hora" required>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="tras_importe">Importe:</label>
                            <input type="number" class="form-control" id="tras_importe" name="tras_importe" required>
                        </div>

                        <div class="col-md-4">
                            <label for="tras_obs">Observaciones:</label>
                            <input type="text" class="form-control" id="tras_obs" name="tras_obs">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-custom-save" id="btnGuardarTras">Guardar</button>

                </div>
            </div>
        </div>
    </div>

    <!--FIN TRASLADOS-->

    <!-- ORDENES DE PRESTACION -->
    <div class="modal fade" id="ordenModal" tabindex="-1" aria-labelledby="ordenModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ordenModalLabel">Ordenes de prestacion</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="ordenModalBody">
                    <!-- Aquí se cargará el contenido del formulario -->
                </div>
                <div class="row">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div id="listaOrden" class="scrollable-content">
                                <!-- Aquí se cargará dinámicamente la lista de prácticas -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-volver">Volver</button>
                        <button type="button" class="btn btn-primary btn-custom-save" id="nuevaOrden">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="agregarOrdenModal" tabindex="-1" aria-labelledby="agregarOrdenModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarOrdenModalLabel">Agregar Orden</h5>
                    <div class="modal-header-center">
                        <img src="../img/logo.png" alt="Logo" class="modal-logo">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarOrden" class="row g-3">
                        <input type="hidden" id="ordenIdPaciente" name="id_paciente">
                        <input type="hidden" name="id" id="ordenId">

                        <div class="col-md-4">
                            <label for="ordenNombreCarga" class="form-label">Nombre y Apellido</label>
                            <input type="text" class="form-control" id="ordenNombreCarga" name="nombre" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="orden_fecha" class="form-label">Fecha:</label>
                            <input type="date" class="form-control" id="orden_fecha" name="orden_fecha" required>
                        </div>


                        <div class="col-md-4 form-group">
                            <label for="op">Nro Orden:</label>
                            <input type="number" class="form-control" id="op" name="op" required>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="op_cant">Cant:</label>
                            <input type="number" class="form-control" id="op_cant" name="op_cant" required>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-custom-save" id="btnGuardarOrden">Guardar</button>

                </div>
            </div>
        </div>
    </div>
    <!-- FIN ORDENES DE PRESTACION -->

    <!-- Modal para generar el reporte -->
    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportModalLabel">Generar Reporte De Turnos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="fechaDesde" class="form-label">Fecha Desde</label>
                        <input type="date" class="form-control" id="fechaDesde">
                    </div>
                    <div class="mb-3">
                        <label for="fechaHasta" class="form-label">Fecha Hasta</label>
                        <input type="date" class="form-control" id="fechaHasta">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="generatePdf()">Generar PDF</button>
                </div>
            </div>
        </div>
    </div>

    <!-- FIN TRASLADOS -->

    <footer class="bg-dark text-white text-center py-4 mt-auto">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 footer-logo-text">
                    <img src="../img/logoWSS.png" alt="Logo" class="img-fluid" style="max-height: 50px;">
                    <p class="mb-0">&copy; 2024 WorldsoftSystems. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>


</body>

</html>