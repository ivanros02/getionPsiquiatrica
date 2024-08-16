document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('success') && urlParams.get('success') === 'true') {
        alert("El paciente se ha editado correctamente.");
        urlParams.delete('success');
        window.history.replaceState({}, document.title, window.location.pathname);
    }
});

function formatDate(dateString) {
    var parts = dateString.split('-');
    var year = parts[0];
    var month = parts[1];
    var day = parts[2];
    return day + "/" + month + "/" + year;
}

document.addEventListener("DOMContentLoaded", function () {
    function editarPaciente(paciente) {
        document.getElementById('formPaciente').action = './editarPaciente.php';
        document.getElementById('id').value = paciente.id;
        document.getElementById('nombre').value = paciente.nombre;
        document.getElementById('obra_social').value = paciente.obra_social;
        document.getElementById('fecha_nac').value = paciente.fecha_nac;
        document.getElementById('sexo').value = paciente.sexo;
        document.getElementById('domicilio').value = paciente.domicilio;
        document.getElementById('localidad').value = paciente.localidad;
        document.getElementById('partido').value = paciente.partido;
        document.getElementById('c_postal').value = paciente.c_postal;
        document.getElementById('telefono').value = paciente.telefono;
        document.getElementById('tipo_doc').value = paciente.tipo_doc;
        document.getElementById('nro_doc').value = paciente.nro_doc;
        document.getElementById('admision').value = paciente.admision;
        document.getElementById('id_prof').value = paciente.id_prof;
        document.getElementById('benef').value = paciente.benef;
        document.getElementById('parentesco').value = paciente.parentesco;
        document.getElementById('hijos').value = paciente.hijos;
        document.getElementById('ocupacion').value = paciente.ocupacion;
        document.getElementById('tipo_afiliado').value = paciente.tipo_afiliado;
        document.getElementById('modalidad').value = paciente.modalidad;
        var modal = new bootstrap.Modal(document.getElementById('agregarPacienteModal'));
        modal.show();
    }

    function limpiarFormulario() {
        document.getElementById('formPaciente').action = './agregarPaciente.php';
        document.getElementById('id').value = '';
        document.getElementById('nombre').value = '';
        document.getElementById('obra_social').value = '';
        document.getElementById('fecha_nac').value = '';
        document.getElementById('sexo').value = '';
        document.getElementById('domicilio').value = '';
        document.getElementById('localidad').value = '';
        document.getElementById('partido').value = '';
        document.getElementById('c_postal').value = '';
        document.getElementById('telefono').value = '';
        document.getElementById('tipo_doc').value = '';
        document.getElementById('nro_doc').value = '';
        document.getElementById('admision').value = '';
        document.getElementById('id_prof').value = '';
        document.getElementById('benef').value = '';
        document.getElementById('parentesco').value = '';
        document.getElementById('hijos').value = '';
        document.getElementById('ocupacion').value = '';
        document.getElementById('tipo_afiliado').value = '';
        document.getElementById('modalidad').value = '';
        document.getElementById('op').value = '';
        document.getElementById('op').value = '';
    }

    window.editarPaciente = editarPaciente;

    var btnAgregarPacienteModal = document.querySelector('button[data-bs-target="#agregarPacienteModal"]');
    btnAgregarPacienteModal.addEventListener('click', limpiarFormulario);
});

document.getElementById('btnBuscar').addEventListener('click', function () {
    // Obtener los valores de los campos de "Beneficio" y "Parentesco"
    var beneficio = $('#benef').val();
    var parentesco = $('#parentesco').val();

    // Realizar la solicitud al backend
    fetch(`https://worldsoftsystems.com.ar/buscar?beneficio=${beneficio}&parentesco=${parentesco}`, {
        method: "GET",
        headers: {
            "Content-Type": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            // Verificar si se encontró el nombre y apellido
            if (data.resultado) {
                // Actualizar el campo de nombre y apellido con el resultado
                $('#nombre').val(data.resultado);
            } else {
                // Mostrar una alerta si no se encuentra el resultado
                alert("No se encontró ningún beneficiario con los datos proporcionados.");
            }
        })
        .catch(error => {
            console.error(error);
            // Muestra un mensaje de error si ocurre un error durante la solicitud
            alert("Error al buscar el nombre y apellido.");
        });
});


$(document).ready(function () {
    $.ajax({
        url: './dato/get_obras_sociales.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            data.forEach(function (item) {
                var optionText = item.siglas + ' - ' + item.razon_social;
                $('#obra_social').append(new Option(optionText, item.id));
            });
        },
        error: function (error) {
            console.error("Error fetching data: ", error);
        }
    });

    $.ajax({
        url: './dato/get_parentescos.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            data.forEach(function (item) {
                var optionText = item.codigo + ' - ' + item.descripcion;
                $('#respon_parent').append(new Option(optionText, item.id));
                $('#visita_parent').append(new Option(optionText, item.id));

            });
        },
        error: function (error) {
            console.error("Error fetching data: ", error);
        }
    });

    $('#agregarPracModal').on('shown.bs.modal', function () {
        var pacienteId = $('#id').val();

        // Hacer la llamada AJAX para llenar el select de actividades
        $.ajax({
            url: './dato/get_todas_las_practicas.php',
            type: 'GET',
            dataType: 'json',
            data: { paciente_id: pacienteId },
            success: function (data) {
                $('#pracActividad').empty(); // Limpiar el select antes de añadir nuevas opciones
                $('#pracActividad').append(new Option('Seleccionar...', '')); // Añadir la opción predeterminada
                data.forEach(function (item) {
                    var optionText = item.codigo + ' - ' + item.descripcion;
                    $('#pracActividad').append(new Option(optionText, item.id));
                });

                // Si se está editando una práctica, seleccionar la opción correcta
                var pracActividadId = $('#pracActividad').data('selected-id');
                if (pracActividadId) {
                    $('#pracActividad').val(pracActividadId);
                }
            },
            error: function (error) {
                console.error("Error fetching data: ", error);
            }
        });
    });



    $.ajax({
        url: './dato/get_tipo_afiliado.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            data.forEach(function (item) {
                var optionText = item.codigo + ' - ' + item.descripcion;
                $('#tipo_afiliado').append(new Option(optionText, item.id));
            });
        },
        error: function (error) {
            console.error("Error fetching data: ", error);
        }
    });

    $.ajax({
        url: './dato/get_tipo_egreso.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            data.forEach(function (item) {
                var optionText = item.codigo + ' - ' + item.descripcion;
                $('#egreso_motivo').append(new Option(optionText, item.id));
            });
        },
        error: function (error) {
            console.error("Error fetching data: ", error);
        }
    });

    $.ajax({
        url: './dato/get_diags.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            data.forEach(function (item) {
                var optionText = item.codigo + ' - ' + item.descripcion;
                $('#egreso_diag').append(new Option(optionText, item.id));
                $('#evo_diag').append(new Option(optionText, item.id));
                $('#paci_diag').append(new Option(optionText, item.id));

            });
        },
        error: function (error) {
            console.error("Error fetching data: ", error);
        }
    });


    $.ajax({
        url: './dato/get_modalidad.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            data.forEach(function (item) {
                var optionText = item.codigo + ' - ' + item.descripcion;
                $('#modalidad').append(new Option(optionText, item.id));
                $('#modalidad_paci').append(new Option(optionText, item.id));
                $('#egreso_modalidad').append(new Option(optionText, item.id));
            });
        },
        error: function (error) {
            console.error("Error fetching data: ", error);
        }
    });

    $.ajax({
        url: './dato/get_profesional.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            data.forEach(function (item) {
                $('#id_prof').append(new Option(item.nombreYapellido, item.id_prof));
                $('#pracProfesional').append(new Option(item.nombreYapellido, item.id_prof));
            });
        },
        error: function (error) {
            console.error("Error fetching data: ", error);
        }
    });

    $.ajax({
        url: './dato/get_medicacion.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            data.forEach(function (item) {
                $('#medicam1').append(new Option(item.descripcion, item.id));
                $('#medicam2').append(new Option(item.descripcion, item.id));
                $('#medicam3').append(new Option(item.descripcion, item.id));
            });
        },
        error: function (error) {
            console.error("Error fetching data: ", error);
        }
    });

    $.ajax({
        url: './dato/get_secretaria.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            data.forEach(function (item) {
                $('#secretaria').append(new Option(item.descripcion, item.id));
            });
        },
        error: function (error) {
            console.error("Error fetching data: ", error);
        }
    });

    $.ajax({
        url: './dato/get_curaduria.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            data.forEach(function (item) {
                $('#curaduria').append(new Option(item.descripcion, item.id));
            });
        },
        error: function (error) {
            console.error("Error fetching data: ", error);
        }
    });

    $.ajax({
        url: './dato/get_juzgado.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            data.forEach(function (item) {
                $('#juzgado').append(new Option(item.descripcion, item.id));
            });
        },
        error: function (error) {
            console.error("Error fetching data: ", error);
        }
    });

    $.ajax({
        url: './dato/get_medicacion.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            data.forEach(function (item) {
                $('#mediDesc').append(new Option(item.descripcion, item.id));
            });
        },
        error: function (error) {
            console.error("Error fetching data: ", error);
        }
    });

    $.ajax({
        url: './dato/get_t_juicio.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            data.forEach(function (item) {
                $('#t_juicio').append(new Option(item.descripcion, item.id));
            });
        },
        error: function (error) {
            console.error("Error fetching data: ", error);
        }
    });

    $.ajax({
        url: './dato/get_habitaciones.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            data.forEach(function (item) {
                // Concatenar item.num y item.piso
                $('#habitacion_nro').append(new Option('Nro: ' + item.num + ' - Piso: ' + item.piso, item.id));
            });
        },
        error: function (error) {
            console.error("Error fetching data: ", error);
        }
    });


});

//BARRA DE BUSQUEDA 
document.getElementById('searchInput').addEventListener('input', function () {
    var searchValue = this.value.toLowerCase();
    var rows = document.querySelectorAll('#pacientesTable tbody tr');

    rows.forEach(row => {
        var nombre = row.cells[1].textContent.toLowerCase();
        var benef = row.cells[2].textContent.toLowerCase();
        if (nombre.includes(searchValue) || benef.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

//REPORTE
let selectedPacienteId;

function openReportModal(pacienteId) {
    selectedPacienteId = pacienteId; // Guardar el ID del paciente seleccionado
    // Abrir el modal
    const myModal = new bootstrap.Modal(document.getElementById('reportModal'));
    myModal.show();
}

function generatePdf() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('l', 'mm', 'a4');

    const pacienteId = selectedPacienteId;
    const fechaDesde = document.getElementById('fechaDesde').value;
    const fechaHasta = document.getElementById('fechaHasta').value;

    function fetchDataPaci(pacienteId, fechaDesde, fechaHasta) {
        return new Promise((resolve, reject) => {
            fetch(`./dato/get_turno_de_paciente.php?id_paci=${pacienteId}&fecha_desde=${fechaDesde}&fecha_hasta=${fechaHasta}`)
                .then(response => response.json())
                .then(data => resolve(data))
                .catch(error => reject(error));
        });
    }

    function fetchParametros() {
        return new Promise((resolve, reject) => {
            fetch('../turnos/gets/get_parametros.php')
                .then(response => response.json())
                .then(data => resolve(data))
                .catch(error => reject(error));
        });
    }

    Promise.all([fetchDataPaci(pacienteId, fechaDesde, fechaHasta), fetchParametros()])
        .then(([dataTurnos, dataParametros]) => {
            const rows = dataTurnos.map(turnos => [
                (`${formatDate(turnos.fecha)} ${turnos.hora}`),
                turnos.nom_prof,
                turnos.motivo_full,
                turnos.llego,
                turnos.atendido,
                turnos.observaciones
            ]);

            const nombrePaciente = dataTurnos.length > 0 ? dataTurnos[0].nombre_paciente : 'Desconocido';
            const formattedFechaDesde = formatDate(fechaDesde);
            const formattedFechaHasta = formatDate(fechaHasta);

            const parametros = dataParametros[0] || {};
            const param1 = parametros.inst || 'No disponible';
            const param2 = parametros.localidad || 'No disponible';
            const param3 = parametros.tel || 'No disponible';

            // Título centrado
            const title = 'Historial de Paciente';
            const pageWidth = doc.internal.pageSize.getWidth();
            const titleWidth = doc.getTextWidth(title);
            const xTitle = (pageWidth - titleWidth) / 2;
            doc.setFontSize(16);
            doc.text(title, xTitle, 10);

            // Fechas centradas
            const dateRange = `Desde: ${formattedFechaDesde} Hasta: ${formattedFechaHasta}`;
            const dateRangeWidth = doc.getTextWidth(dateRange);
            const xDateRange = (pageWidth - dateRangeWidth) / 2;
            doc.setFontSize(14);
            doc.text(dateRange, xDateRange, 20);

            // Parámetros centrados
            doc.setFontSize(12);
            const startY = 30;

            const param1Text = `Institución: ${param1}`;
            const param2Text = `Localidad: ${param2}`;
            const param3Text = `Teléfono: ${param3}`;

            const param1Width = doc.getTextWidth(param1Text);
            const param1X = (pageWidth - param1Width) / 2;
            const param2Width = doc.getTextWidth(param2Text);
            const param2X = (pageWidth - param2Width) / 2;
            const param3Width = doc.getTextWidth(param3Text);
            const param3X = (pageWidth - param3Width) / 2;

            doc.text(param1Text, param1X, startY);
            doc.text(param2Text, param2X, startY + 10);
            doc.text(param3Text, param3X, startY + 20);

            // Subtítulo centrado
            const subtitle = `Paciente: ${nombrePaciente}`;
            const subtitleWidth = doc.getTextWidth(subtitle);
            const xSubtitle = (pageWidth - subtitleWidth) / 2;
            doc.setFontSize(12);
            doc.text(subtitle, xSubtitle, startY + 35);

            // Tabla
            const tableWidth = 200;
            let marginLeft = (pageWidth - tableWidth) / 2;
            marginLeft -= 15;

            const headers = ['Fecha y Hora', 'Profesional', 'Motivo', 'Llegó', 'Atendido', 'Observaciones'];

            let tableY;

            doc.autoTable({
                head: [headers],
                body: rows,
                startY: startY + 50,
                margin: { left: marginLeft, top: startY + 50 },
                theme: 'striped',
                styles: {
                    fontSize: 10, // Fuente más pequeña
                    cellPadding: 2,
                    overflow: 'linebreak'
                },
                columnStyles: {
                    0: { cellWidth: 30 },
                    1: { cellWidth: 70 },
                    2: { cellWidth: 40 },
                    3: { cellWidth: 20 },
                    4: { cellWidth: 20 },
                    5: { cellWidth: 50 }
                },
                didDrawPage: function (data) {
                    tableY = data.cursor.y;
                },
                didDrawCell: function (data) {
                    if (data.column.index === 0) {
                        tableY = data.cursor.y;
                    }
                }
            });

            const imgUrl = '../img/logo.png';
            var img = new Image();
            img.onload = function () {
                const imgWidth = 40;
                const imgHeight = 40;
                const xImg = (pageWidth - imgWidth) / 2;
                const yImg = tableY + 10;

                doc.addImage(img, 'PNG', xImg, yImg, imgWidth, imgHeight);
                window.open(doc.output('bloburl'))
            };
            img.src = imgUrl;

        }).catch(error => {
            console.error('Error:', error);
        });
}






