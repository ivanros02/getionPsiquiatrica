<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turnos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../estilos/styleCrearProf.css">
    <style>
        #calendar {
            max-width: 85%;
            margin: 0 auto;
            height: 25rem;
        }

        .selectProf {
            margin-left: 4rem;
        }

        .buttom {
            margin-top: 0 !important;
        }

        .modal-dialog {
            max-width: 80%;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                locale: 'es',
                editable: true,
                selectable: true,
                allDaySlot: false,
                displayEventTime: true,



                selectConstraint: function (selectInfo) {
                    var events = calendar.getEvents();
                    var available = false;
                    events.forEach(event => {
                        if (event.display === 'background' &&
                            selectInfo.start >= event.start &&
                            selectInfo.end <= event.end) {
                            available = true;
                        }
                    });
                    return available;
                },

                dateClick: function (info) {
                    var clickedDate = info.date;
                    var isAvailable = checkAvailability(clickedDate);

                    if (!isAvailable) {
                        alert("Este día no está disponible para citas.");
                        return;
                    }
                    var fecha = info.date;
                    var dia = fecha.getDate();
                    var mes = fecha.getMonth() + 1;
                    var año = fecha.getFullYear();
                    var fechaFormateada = año + '-' + mes.toString().padStart(2, '0') + '-' + dia.toString().padStart(2, '0');
                    var hora = fecha.getHours();
                    var minutos = fecha.getMinutes();
                    var horaFormateada = hora.toString().padStart(2, '0') + ':' + minutos.toString().padStart(2, '0');

                    var numeroDia = fecha.getDay();
                    var dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];

                    if (numeroDia === 0) {
                        alert("No hay atención los días Domingos");
                    } else {
                        $('#modal_turnos').modal("show");
                        $('#dia_semana').html(dias[numeroDia] + " " + fechaFormateada);
                        $('#fecha_turno').val(fechaFormateada); // Setear el valor del campo "Fecha del turno"
                        $('#hora_turno').val(horaFormateada);
                    }
                },

                eventClick: function (info) {
                    // Obtener los datos del evento seleccionado
                    var evento = info.event;
                    var nombrePaciente = evento.title;
                    var fechaTurno = evento.startStr;
                    var beneficio = evento.extendedProps.beneficio;
                    var hora = evento.extendedProps.hora;
                    var practica = evento.extendedProps.practica;
                    var profesional = evento.extendedProps.id_prof;

                    // Rellenar el modal con los datos del evento seleccionado

                    $('#id_prof').val(profesional);
                    $('#nombre_paciente').val(nombrePaciente);
                    $('#beneficio').val(beneficio);
                    $('#fecha_turno').val(fechaTurno);
                    $('#hora_turno').val(hora);
                    $('#practica').val(practica);

                    // Mostrar el modal
                    $('#modal_turnos').modal('show');
                },

                viewDidMount: function (view) {
                    cargarDisponibilidad();
                },

                datesSet: function (view) {
                    cargarDisponibilidad();
                }


            });
            calendar.render();

            var availability = [];

            $(document).ready(function () {
                $('#profesional_select').on('change', function () {
                    var profesionalId = $(this).val();
                    cargarDisponibilidad();
                    cargarEventos(profesionalId);
                });
            });

            function cargarEventos(profesionalId) {
                var url = profesionalId ? `turnosJSON.php?id_prof=${profesionalId}` : 'turnosJSON.php';
                calendar.getEventSources().forEach(eventSource => eventSource.remove()); // Eliminar todas las fuentes de eventos
                calendar.addEventSource({
                    url: url,
                    failure: function () {
                        alert('Error al cargar los eventos');
                    }
                });
                calendar.refetchEvents(); // Refrescar los eventos
            }

            function cargarDisponibilidad() {
                var profesionalId = $('#profesional_select').val();
                if (!profesionalId) return;

                $.ajax({
                    url: `disponibilidadJSON.php?id_prof=${profesionalId}`,
                    method: 'GET',
                    cache: false,
                    success: function (data) {
                        console.log("Disponibilidad recibida:", data);

                        try {
                            availability = (typeof data === "string") ? JSON.parse(data) : data;
                            if (availability.error) {
                                alert(availability.error);
                                return;
                            }
                            console.log("Disponibilidad parseada:", availability);

                            calendar.setOption('businessHours', availability);
                            calendar.refetchEvents();
                        } catch (e) {
                            console.error("Error al parsear JSON:", e);
                            alert("Error al procesar la disponibilidad");
                        }
                    },
                    error: function () {
                        alert('Error al cargar la disponibilidad');
                    }
                });
            }



            function checkAvailability(date) {
                var day = date.getDay();
                var time = date.toTimeString().split(' ')[0];

                for (var i = 0; i < availability.length; i++) {
                    var availableDay = parseInt(availability[i].daysOfWeek[0]);
                    var startTime = availability[i].startTime;
                    var endTime = availability[i].endTime;

                    if (day === availableDay && time >= startTime && time <= endTime) {
                        return true;
                    }
                }
                return false;
            }
        });

        // Función para guardar el turno
        function guardarTurno() {
            // Obtener los valores del formulario
            var nombrePaciente = $('#nombre_paciente').val();
            var practica = $('#practica').val();
            var fechaTurno = $('#fecha_turno').val();
            var horaTurno = $('#hora_turno').val();
            var id_prof = $('#id_prof').val(); // Agregar el campo id_prof
            var beneficio = $('#beneficio').val(); // Agregar el campo beneficio

            // Verificar que el id_prof no sea nulo
            if (!id_prof) {
                alert("Seleccione un profesional.");
                return;
            }

            // Enviar los datos del formulario al servidor
            $.ajax({
                type: "POST",
                url: "cargar_turnos.php",
                data: {
                    nombre_paciente: nombrePaciente,
                    practica: practica,
                    fecha_turno: fechaTurno,
                    hora_turno: horaTurno,
                    id_prof: id_prof, // Pasar el valor del campo id_prof
                    beneficio: beneficio // Pasar el valor del campo beneficio
                },
                success: function (response) {
                    // Manejar la respuesta del servidor si es necesario
                    alert(response);
                    location.reload(); // Recargar la página después de guardar el turno
                },
                error: function (xhr, status, error) {
                    // Manejar el error si ocurre
                    console.error(error);
                }
            });
        }


        // Agregar evento de cambio al select
        $(document).ready(function () {
            $('#profesional_select').change(function () {
                var selectedProfesional = $(this).val(); // Obtener el valor seleccionado del select
                $('#id_prof').val(selectedProfesional); // Establecer el valor del campo de entrada profesional
            });
        });


        $(document).ready(function () {
            // Función para cargar los pacientes desde la base de datos
            function cargarPacientes() {
                $.ajax({
                    url: '../formularioPaciente/obtener_pacientes.php',
                    type: 'GET',
                    success: function (response) {
                        var pacientes = JSON.parse(response);
                        var fila = '';
                        pacientes.forEach(function (paciente) {
                            fila += '<tr>';
                            fila += '<td>' + paciente.id + '</td>';
                            fila += '<td>' + paciente.nombre + '</td>';
                            fila += '<td>' + paciente.obra_social + '</td>';
                            fila += '</tr>';
                        });
                        $('#tablaPacientes').html(fila);
                    }
                });
            }

            // Cargar pacientes al abrir el modal
            $('#elegirPaciente').on('show.bs.modal', function () {
                cargarPacientes();
            });

            // Función para filtrar pacientes por nombre
            $('#buscarPaciente').on('input', function () {
                var filtro = $(this).val().toLowerCase();
                $('#tablaPacientes tr').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(filtro) > -1)
                });
            });

            // Agregar evento de clic a las filas de la tabla
            $(document).on('click', '#tablaPacientes tr', function () {
                var idPaciente = $(this).data('id');
                var nombrePaciente = $(this).find('td:eq(1)').text();
                var obraSocialPaciente = $(this).find('td:eq(2)').text();

                // Llenar los campos con los datos del paciente
                $('#nombre_paciente').val(nombrePaciente);
                $('#beneficio').val(obraSocialPaciente);

                $('#elegirPaciente').modal('hide');
                // Cerrar el modal de elegir paciente
                $('#modal_turnos').modal('show');
            });
        });



        // Función para agregar nuevo paciente
        function agregarPaciente() {
            var nombreNuevo = $('#nombreNuevo').val();
            var obraSocialNuevo = $('#obraSocialNuevo').val();
            $.ajax({
                url: '../formularioPaciente/agregar_paciente.php',
                type: 'POST',
                data: {
                    nombreNuevo: nombreNuevo,
                    obraSocialNuevo: obraSocialNuevo
                },
                success: function (response) {
                    // Recargar la tabla de pacientes después de agregar uno nuevo
                    $('#agregarPaciente').modal('hide'); // Cerrar el modal de agregar paciente
                    $('#modal_turnos').modal('show');
                    // Obtener los datos del paciente recién agregado
                    $.ajax({
                        url: '../formularioPaciente/obtener_pacientes.php',
                        type: 'GET',
                        success: function (response) {
                            var pacientes = JSON.parse(response);
                            var nuevoPaciente = pacientes[pacientes.length - 1]; // Obtener el último paciente agregado
                            // Llenar los campos con los datos del nuevo paciente
                            $('#nombre_paciente').val(nuevoPaciente.nombre);
                            $('#beneficio').val(nuevoPaciente.obra_social);
                        }
                    });
                }
            });
        }


    </script>
</head>

<body>
    <button class="button" style="vertical-align:middle"
        onclick="window.location.href = '../inicio/home.php';"><span>VOLVER</span></button>

    <h1 class="text-center mt-3">Turnos</h1>

    <?php
    // Incluir el archivo de conexión
    require_once "../conexion.php";

    // Consultar la base de datos para obtener los nombres y apellidos de los profesionales
    $query = "SELECT id_prof, nombreYapellido FROM profesional";
    $result = mysqli_query($conn, $query);

    // Variable para almacenar el HTML del select
    $selectHTML = '<div class="mb-3 col-md-4 selectProf">
    <label for="profesional_select" class="form-label">Profesional</label>
    <select id="profesional_select" class="form-select" required>
        <option value="">Seleccione un profesional</option>';

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $selectHTML .= '<option value="' . $row['id_prof'] . '">' . $row['nombreYapellido'] . '</option>';
        }
    }

    $selectHTML .= '</select></div>';

    echo $selectHTML;

    mysqli_close($conn);
    ?>


    <div id='calendar'></div>

    <!-- Modal TURNO -->
    <div class="modal fade" id="modal_turnos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Reservar turno</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="cargar_turnos.php" id="form_turno">
                        <!-- Otros campos del formulario -->
                        <input type="hidden" id="id_reserva" name="id_reserva">

                        <div class="mb-3">
                            <label for="id_prof" class="form-label">Profesional</label>
                            <input type="text" class="form-control" id="id_prof" name="id_prof" required readonly>
                        </div>
                        <!-- Información del Paciente -->
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="nombre_paciente" class="form-label">Nombre del paciente</label>
                                <input type="text" class="form-control" id="nombre_paciente" name="nombre_paciente"
                                    required readonly>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="beneficio" class="form-label">Beneficio</label>
                                <input type="text" class="form-control" id="beneficio" name="beneficio" required
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#elegirPaciente">
                                    elegir paciente
                                </button>
                            </div>
                        </div>

                        <!-- Información del Turno -->
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="fecha_turno" class="form-label">Fecha del turno</label>
                                <input type="date" class="form-control" id="fecha_turno" name="fecha_turno" readonly
                                    required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="hora_turno" class="form-label">Hora del turno</label>
                                <input type="time" class="form-control" id="hora_turno" name="hora_turno" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="practica" class="form-label">Práctica</label>
                            <input type="text" class="form-control" id="practica" name="practica" required>
                        </div>


                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="guardarTurno()">Agendar Turno</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal PACIENTE -->
    <div class="modal fade" id="elegirPaciente" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Seleccionar Paciente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="mb-3">
                    <label for="buscarPaciente" class="form-label">Buscar por nombre:</label>
                    <input type="text" class="form-control" id="buscarPaciente"
                        placeholder="Ingrese el nombre del paciente">
                </div>
                <div class="modal-body">
                    <!-- Tabla para mostrar los pacientes -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Obra Social</th>
                            </tr>
                        </thead>
                        <tbody id="tablaPacientes">
                            <!-- Aquí se cargarán los registros de la base de datos -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#agregarPaciente">
                        Agregar Paciente
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para agregar nuevo paciente -->
    <div class="modal fade" id="agregarPaciente" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Agregar Nuevo Paciente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para agregar nuevo paciente -->
                    <form id="formNuevoPaciente">
                        <div class="mb-3">
                            <label for="nombreNuevo" class="form-label">Nombre del Paciente</label>
                            <input type="text" class="form-control" id="nombreNuevo" name="nombreNuevo" required>
                        </div>
                        <div class="mb-3">
                            <label for="obraSocialNuevo" class="form-label">Obra Social</label>
                            <input type="text" class="form-control" id="obraSocialNuevo" name="obraSocialNuevo"
                                required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="agregarPaciente()">Guardar</button>
                </div>
            </div>
        </div>
    </div>



</body>

</html>