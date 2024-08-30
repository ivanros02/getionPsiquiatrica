function formatDate(dateString) {
    if (!dateString) return '';
    var parts = dateString.split('-');
    var year = parts[0];
    var month = parts[1];
    var day = parts[2];
    return day + "/" + month + "/" + year;
}


document.addEventListener('DOMContentLoaded', function () {
    const openModalLink = document.getElementById('openModalLink');
    const generatePdfBtn = document.getElementById('generatePdfBtn');
    const generateExcelBtn = document.getElementById('generateExcelBtn');

    const openPatientModalLink = document.getElementById('openPatientModalLink');
    const generatePatientPdfBtn = document.getElementById('generatePatientPdfBtn');
    const generatePatientExcelBtn = document.getElementById('generatePatientExcelBtn');

    const openOmesLink = document.getElementById('openOmesModalLink');
    const generateOmesBtn = document.getElementById('generateOmesBtn');
    const generateOmesExcelBtn = document.getElementById('generateOmesExcelBtn');

    const openProfLink = document.getElementById('openProfModalLink');
    const generateProfBtn = document.getElementById('generateProfBtn');
    const generateProfExcelBtn = document.getElementById('generateProfExcelBtn');


    const openPracLink = document.getElementById('openPracModalLink');
    const generatePracBtn = document.getElementById('generatePracBtn');
    const generatePracExcelBtn = document.getElementById('generatePracExcelBtn');

    const openEgresoLink = document.getElementById('openEgresoModalLink');
    const generateEgresoBtn = document.getElementById('generateEgresoBtn');
    const generateEgresoExcelBtn = document.getElementById('generateEgresoExcelBtn');

    const openIngresoLink = document.getElementById('openIngresoModalLink');
    const generateIngresoBtn = document.getElementById('generateIngresoBtn');
    const generateIngresoExcelBtn = document.getElementById('generateIngresoExcelBtn');

    const openDiagModalLink = document.getElementById('openDiagModalLink');
    const generateDiagBtn = document.getElementById('generateDiagBtn');
    const generateDiagExcelBtn = document.getElementById('generateDiagExcelBtn');

    const openPlanModalLink = document.getElementById('openPlanModalLink');
    const generatePlanBtn = document.getElementById('generatePlanBtn');
    const generatePlanExcelBtn = document.getElementById('generatePlanExcelBtn');


    if (openPlanModalLink) {
        openPlanModalLink.addEventListener('click', function (e) {
            e.preventDefault();
            const modal = new bootstrap.Modal(document.getElementById('openPlanModal'));
            modal.show();
        });
    }

    if (openDiagModalLink) {
        openDiagModalLink.addEventListener('click', function (e) {
            e.preventDefault();
            const modal = new bootstrap.Modal(document.getElementById('openDiagModal'));
            modal.show();
        });
    }

    if (openIngresoLink) {
        openIngresoLink.addEventListener('click', function (e) {
            e.preventDefault();
            const modal = new bootstrap.Modal(document.getElementById('openIngresoModal'));
            modal.show();
        });
    }

    if (openModalLink) {
        openModalLink.addEventListener('click', function (e) {
            e.preventDefault();
            const modal = new bootstrap.Modal(document.getElementById('resumenModal'));
            modal.show();
        });
    }

    if (openPatientModalLink) {
        openPatientModalLink.addEventListener('click', function (e) {
            e.preventDefault();
            const modal = new bootstrap.Modal(document.getElementById('patientResumenModal'));
            modal.show();
        });
    }

    if (openOmesLink) {
        openOmesLink.addEventListener('click', function (e) {
            e.preventDefault();
            const modal = new bootstrap.Modal(document.getElementById('openOmesModal'));
            modal.show();
        });
    }

    if (openPracLink) {
        openPracLink.addEventListener('click', function (e) {
            e.preventDefault();
            const modal = new bootstrap.Modal(document.getElementById('openPracModal'));
            modal.show();
        });
    }

    if (openProfLink) {
        openProfLink.addEventListener('click', function (e) {
            e.preventDefault();
            const modal = new bootstrap.Modal(document.getElementById('openProfModal'));
            modal.show();
        });
    }

    if (openEgresoLink) {
        openEgresoLink.addEventListener('click', function (e) {
            e.preventDefault();
            const modal = new bootstrap.Modal(document.getElementById('openEgresoModal'));
            modal.show();
        });
    }

    if (generatePlanBtn) {
        generatePlanBtn.addEventListener('click', function () {
            const fechaDesde = document.getElementById('fechaDesdePlan').value;
            const fechaHasta = document.getElementById('fechaHastaPlan').value;
            const obraSocialId = $('#obra_social_plan').val();
            generatePlanPdf(fechaDesde, fechaHasta, obraSocialId);
        });
    }

    if (generatePlanExcelBtn) {
        generatePlanExcelBtn.addEventListener('click', function () {
            const fechaDesde = document.getElementById('fechaDesdePlan').value;
            const fechaHasta = document.getElementById('fechaHastaPlan').value;
            const obraSocialId = $('#obra_social_plan').val();
            generatePlanExcel(fechaDesde, fechaHasta, obraSocialId);
        });
    }

    if (generateDiagBtn) {
        generateDiagBtn.addEventListener('click', function () {
            const fechaDesde = document.getElementById('fechaDesdeDiag').value;
            const fechaHasta = document.getElementById('fechaHastaDiag').value;
            const obraSocialId = $('#obra_social_diag').val();
            generateDiagPdf(fechaDesde, fechaHasta, obraSocialId);
        });
    }

    if (generateDiagExcelBtn) {
        generateDiagExcelBtn.addEventListener('click', function () {
            const fechaDesde = document.getElementById('fechaDesdeDiag').value;
            const fechaHasta = document.getElementById('fechaHastaDiag').value;
            const obraSocialId = $('#obra_social_diag').val();
            generateDiagExcel(fechaDesde, fechaHasta, obraSocialId);
        });
    }

    if (generateIngresoBtn) {
        generateIngresoBtn.addEventListener('click', function () {
            const fechaDesde = document.getElementById('fechaDesdeIngreso').value;
            const fechaHasta = document.getElementById('fechaHastaIngreso').value;
            const obraSocialId = $('#obra_social_ingreso').val();
            generateIngresoPdf(fechaDesde, fechaHasta, obraSocialId);
        });
    }

    if (generateIngresoExcelBtn) {
        generateIngresoExcelBtn.addEventListener('click', function () {
            const fechaDesde = document.getElementById('fechaDesdeIngreso').value;
            const fechaHasta = document.getElementById('fechaHastaIngreso').value;
            const obraSocialId = $('#obra_social_ingreso').val();
            generateIngresoExcel(fechaDesde, fechaHasta, obraSocialId);
        });
    }

    if (generateEgresoBtn) {
        generateEgresoBtn.addEventListener('click', function () {
            const fechaDesde = document.getElementById('fechaDesdeEgreso').value;
            const fechaHasta = document.getElementById('fechaHastaEgreso').value;
            const obraSocialId = $('#obra_social_egreso').val();
            generateEgresoPdf(fechaDesde, fechaHasta, obraSocialId);
        });
    }

    if (generateEgresoExcelBtn) {
        generateEgresoExcelBtn.addEventListener('click', function () {
            const fechaDesde = document.getElementById('fechaDesdeEgreso').value;
            const fechaHasta = document.getElementById('fechaHastaEgreso').value;
            const obraSocialId = $('#obra_social_egreso').val();
            generateEgresoExcel(fechaDesde, fechaHasta, obraSocialId);
        });
    }

    if (generatePracBtn) {
        generatePracBtn.addEventListener('click', function () {
            const fechaDesde = document.getElementById('fechaDesdePrac').value;
            const fechaHasta = document.getElementById('fechaHastaPrac').value;
            const obraSocialId = $('#obra_social_prac').val();
            generatePracPdf(fechaDesde, fechaHasta, obraSocialId);
        });
    }

    if (generatePracExcelBtn) {
        generatePracExcelBtn.addEventListener('click', function () {
            const fechaDesde = document.getElementById('fechaDesdePrac').value;
            const fechaHasta = document.getElementById('fechaHastaPrac').value;
            const obraSocialId = $('#obra_social_prac').val();
            generatePracExcel(fechaDesde, fechaHasta, obraSocialId);
        });
    }

    if (generateProfBtn) {
        generateProfBtn.addEventListener('click', function () {
            const fechaDesde = document.getElementById('fechaDesdeProf').value;
            const fechaHasta = document.getElementById('fechaHastaProf').value;
            const obraSocialId = $('#obra_social_prof').val();
            const profesional = $('#profesional').val();
            generateProfPdf(fechaDesde, fechaHasta, obraSocialId, profesional);
        });
    }

    if (generateProfExcelBtn) {
        generateProfExcelBtn.addEventListener('click', function () {
            const fechaDesde = document.getElementById('fechaDesdeProf').value;
            const fechaHasta = document.getElementById('fechaHastaProf').value;
            const obraSocialId = $('#obra_social_prof').val();
            const profesional = $('#profesional').val();
            generateProfExcel(fechaDesde, fechaHasta, obraSocialId, profesional);
        });
    }

    //
    if (generateOmesBtn) {
        generateOmesBtn.addEventListener('click', function () {
            const fechaDesde = document.getElementById('fechaDesdeOmes').value;
            const fechaHasta = document.getElementById('fechaHastaOmes').value;
            const obraSocialId = $('#obra_social_ome').val();
            generateOmesPdf(fechaDesde, fechaHasta, obraSocialId);
        });
    }

    if (generateOmesExcelBtn) {
        generateOmesExcelBtn.addEventListener('click', function () {
            const fechaDesde = document.getElementById('fechaDesdeOmes').value;
            const fechaHasta = document.getElementById('fechaHastaOmes').value;
            const obraSocialId = $('#obra_social_ome').val();
            generateOmesExcel(fechaDesde, fechaHasta, obraSocialId);
        });
    }

    if (generatePdfBtn) {
        generatePdfBtn.addEventListener('click', function () {
            const fechaDesde = document.getElementById('fechaDesde').value;
            const fechaHasta = document.getElementById('fechaHasta').value;
            const obraSocialId = $('#obra_social').val();
            console.log(obraSocialId)
            generatePdf(fechaDesde, fechaHasta, obraSocialId);
        });
    }

    if (generateExcelBtn) {
        generateExcelBtn.addEventListener('click', function () {
            const fechaDesde = document.getElementById('fechaDesde').value;
            const fechaHasta = document.getElementById('fechaHasta').value;
            const obraSocialId = $('#obra_social').val();
            console.log(obraSocialId)
            generateExcel(fechaDesde, fechaHasta, obraSocialId);
        });
    }

    if (generatePatientPdfBtn) {
        generatePatientPdfBtn.addEventListener('click', function () {
            const fechaDesde = document.getElementById('fechaDesdePaciente').value;
            const fechaHasta = document.getElementById('fechaHastaPaciente').value;
            const obraSocialId = $('#obra_social_paciente').val();
            generatePatientPdf(fechaDesde, fechaHasta, obraSocialId);
        });
    }

    if (generatePatientExcelBtn) {
        generatePatientExcelBtn.addEventListener('click', function () {
            const fechaDesde = document.getElementById('fechaDesdePaciente').value;
            const fechaHasta = document.getElementById('fechaHastaPaciente').value;
            const obraSocialId = $('#obra_social_paciente').val();
            generatePatientExcel(fechaDesde, fechaHasta, obraSocialId);
        });
    }

    function fetchData(fechaDesde, fechaHasta, obraSocialId) {
        return new Promise((resolve, reject) => {
            fetch(`./gets/get_estadisticas.php?fecha_desde=${fechaDesde}&fecha_hasta=${fechaHasta}&obra_social=${obraSocialId}`)
                .then(response => response.json())
                .then(data => resolve(data))
                .catch(error => reject(error));
        });
    }

    function fetchPatientData(fechaDesde, fechaHasta, obraSocialId) {
        return new Promise((resolve, reject) => {
            fetch(`./gets/get_estadisticas_paciente.php?fecha_desde=${fechaDesde}&fecha_hasta=${fechaHasta}&obra_social=${obraSocialId}`)
                .then(response => response.json())
                .then(data => resolve(data))
                .catch(error => reject(error));
        });
    }

    function fetchOmesData(fechaDesde, fechaHasta, obraSocialId) {
        return new Promise((resolve, reject) => {
            fetch(`./gets/get_turnos_omes.php?fecha_desde=${fechaDesde}&fecha_hasta=${fechaHasta}&obra_social=${obraSocialId}`)
                .then(response => response.json())
                .then(data => resolve(data))
                .catch(error => reject(error));
        });
    }

    function fetchProfData(fechaDesde, fechaHasta, obraSocialId, profesional) {
        return new Promise((resolve, reject) => {
            fetch(`./gets/get_pract_prof.php?fecha_desde=${fechaDesde}&fecha_hasta=${fechaHasta}&obra_social=${obraSocialId}&profesional=${profesional}`)
                .then(response => response.json())
                .then(data => resolve(data))
                .catch(error => reject(error));
        });

    }

    function fetchPracData(fechaDesde, fechaHasta, obraSocialId) {
        return new Promise((resolve, reject) => {
            fetch(`./gets/get_paci_prestacion.php?fecha_desde=${fechaDesde}&fecha_hasta=${fechaHasta}&obra_social=${obraSocialId}`)
                .then(response => response.json())
                .then(data => resolve(data))
                .catch(error => reject(error));
        });
    }

    function fetchEgresoData(fechaDesde, fechaHasta, obraSocialId) {
        return new Promise((resolve, reject) => {
            fetch(`./gets/get_paci_egreso.php?fecha_desde=${fechaDesde}&fecha_hasta=${fechaHasta}&obra_social=${obraSocialId}`)
                .then(response => response.json())
                .then(data => resolve(data))
                .catch(error => reject(error));
        });
    }

    function fetchIngresoData(fechaDesde, fechaHasta, obraSocialId) {
        return new Promise((resolve, reject) => {
            fetch(`./gets/get_paci_ingreso.php?fecha_desde=${fechaDesde}&fecha_hasta=${fechaHasta}&obra_social=${obraSocialId}`)
                .then(response => response.json())
                .then(data => resolve(data))
                .catch(error => reject(error));
        });
    }

    function fetchDiagData(fechaDesde, fechaHasta, obraSocialId) {
        return new Promise((resolve, reject) => {
            fetch(`./gets/get_paci_diag.php?fecha_desde=${fechaDesde}&fecha_hasta=${fechaHasta}&obra_social=${obraSocialId}`)
                .then(response => response.json())
                .then(data => resolve(data))
                .catch(error => reject(error));
        });
    }

    function fetchPlanData(fechaDesde, fechaHasta, obraSocialId) {
        return new Promise((resolve, reject) => {
            fetch(`./gets/get_paci_medi.php?fecha_desde=${fechaDesde}&fecha_hasta=${fechaHasta}&obra_social=${obraSocialId}`)
                .then(response => response.json())
                .then(data => resolve(data))
                .catch(error => reject(error));
        });
    }

    //MEDICACION
    function generatePlanExcel(fechaDesde, fechaHasta, obraSocialId) {
        Promise.all([fetchPlanData(fechaDesde, fechaHasta, obraSocialId)])
            .then(([resumen]) => {

                const data = resumen.map(item => {


                    return [
                        item.nombre,
                        `${item.benef}${item.parentesco}`,
                        formatDate(item.fecha),
                        item.hora,
                        item.dosis,
                        item.medicamento
                    ];
                });

                // Calcular la cantidad total
                const totalQuantity = resumen.reduce((total, item) => {
                    return total + (item.cantidad || 1); // Sumar la cantidad, o 1 si no está definida
                }, 0);
                // Crear un nuevo libro de trabajo
                const wb = XLSX.utils.book_new();

                // Crear una hoja de trabajo con los datos de egresos
                const wsData = [
                    ['AFILIADO', 'BENEFICIO', 'FECHA', 'HORA', 'DOSIS', 'MEDICAMENTO'], // Encabezados
                    ...data,
                    [], // Fila vacía para separación
                    [`Total Cantidad: ${totalQuantity}`] // Fila de total
                ];

                const ws = XLSX.utils.aoa_to_sheet(wsData);
                XLSX.utils.book_append_sheet(wb, ws, 'PACIENTES');

                // Agregar hoja de total general
                const grandTotalSheet = XLSX.utils.aoa_to_sheet([
                    ['Total General', totalQuantity]
                ]);
                XLSX.utils.book_append_sheet(wb, grandTotalSheet, 'Total General');

                // Generar el archivo Excel
                XLSX.writeFile(wb, 'LISTADO_PLAN_MEDICACION.xlsx');
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function generatePlanPdf(fechaDesde, fechaHasta, obraSocialId) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('l', 'mm', 'a4');

        function getMaxRowsPerPage(doc, headers, data) {
            const pageHeight = doc.internal.pageSize.height;
            const margins = { top: 30, bottom: 20 };
            const rowHeight = 10;
            const headerHeight = 10;

            const availableHeight = pageHeight - margins.top - margins.bottom - headerHeight;
            const maxRows = Math.floor(availableHeight / rowHeight);

            return Math.min(maxRows, data.length);
        }

        Promise.all([fetchPlanData(fechaDesde, fechaHasta, obraSocialId)])
            .then(([resumen]) => {
                const formattedFechaDesde = formatDate(fechaDesde);
                const formattedFechaHasta = formatDate(fechaHasta);

                const title = 'PLAN DE MEDICACION';
                const pageWidth = doc.internal.pageSize.getWidth();

                doc.setFontSize(16);
                doc.setFont('Helvetica', 'bold');
                doc.text(title, pageWidth / 2, 10, { align: 'center' });
                doc.setFont('Helvetica', 'normal');

                const dateRange = `DESDE: ${formattedFechaDesde} HASTA: ${formattedFechaHasta}`;
                doc.setFontSize(14);
                doc.text(dateRange, pageWidth / 2, 20, { align: 'center' });

                doc.setFontSize(12);
                let startY = 30;
                const margin = { left: 15 };

                // Agrupar por paciente
                const groupedByPaci = resumen.reduce((acc, item) => {
                    // Crear una clave combinada usando benef y parentesco
                    const key = `${item.benef} ${item.parentesco}`;
                    if (!acc[key]) {
                        acc[key] = [];
                    }
                    acc[key].push(item);
                    return acc;
                }, {});

                // Crear las secciones de paciente y tablas
                for (const [paciente, items] of Object.entries(groupedByPaci)) {
                    // Añadir subtítulo del paciente
                    doc.setFontSize(14);
                    doc.setFont('Helvetica', 'bold');
                    // Obtener el primer elemento del grupo para mostrar la información
                    const firstItem = items[0];
                    const nombreBeneficiario = firstItem.nombre;
                    const beneficios = `${firstItem.benef}${firstItem.parentesco}`;

                    // Crear una cadena con toda la información en la misma línea
                    const pacienteInfo = `PACIENTE:${nombreBeneficiario} | Beneficio: ${beneficios}`;

                    // Añadir la información al PDF
                    doc.text(pacienteInfo, margin.left, startY);

                    doc.setFont('Helvetica', 'normal');

                    // Datos de la tabla
                    const headers = ['FECHA', 'HORA', 'DOSIS', 'MEDICAMENTO'];
                    const data = items.map(item => [
                        formatDate(item.fecha),
                        item.hora,
                        item.dosis,
                        item.medicamento
                    ]);

                    // Crear la tabla en el PDF
                    const tableWidth = pageWidth - margin.left * 2;
                    const maxRowsPerPage = getMaxRowsPerPage(doc, headers, data);

                    let tableStartY = startY + 10;

                    for (let i = 0; i < data.length; i += maxRowsPerPage) {
                        const chunk = data.slice(i, i + maxRowsPerPage);

                        doc.autoTable({
                            head: [headers],
                            body: chunk,
                            startY: tableStartY,
                            margin: margin,
                            theme: 'striped',
                            styles: {
                                fontSize: 10,
                                cellPadding: 2,
                                overflow: 'linebreak'
                            },
                            columnStyles: {
                                0: { cellWidth: 45 },
                                1: { cellWidth: 45 },
                                2: { cellWidth: 45 },
                                3: { cellWidth: 50 }
                            },
                            didDrawPage: function (data) {
                                tableStartY = data.cursor.y;
                            },
                            pageBreak: 'auto'
                        });

                        if (i + maxRowsPerPage < data.length) {
                            doc.addPage();
                            tableStartY = 30;
                        }
                    }

                    startY = tableStartY + 20;
                }

                const totalQuantity = resumen.length;
                doc.setFontSize(12);
                doc.text(`Total Cantidad: ${totalQuantity}`, pageWidth / 2, startY + 10, { align: 'center' });

                const imgUrl = '../img/logo.png';
                var img = new Image();
                img.onload = function () {
                    const imgWidth = 29;
                    const imgHeight = 25;
                    const xImg = (pageWidth - imgWidth) / 2;
                    const yImg = startY + 15;

                    doc.addImage(img, 'PNG', xImg, yImg, imgWidth, imgHeight);

                    window.open(doc.output('bloburl'));
                };
                img.src = imgUrl;

            }).catch(error => {
                console.error('Error:', error);
            });
    }
    //FIN MEDICACION

    //DIAG
    function generateDiagExcel(fechaDesde, fechaHasta, obraSocialId) {
        Promise.all([fetchDiagData(fechaDesde, fechaHasta, obraSocialId)])
            .then(([resumen]) => {

                const data = resumen.map(item => {


                    return [
                        item.nombre,
                        `${item.benef}${item.parentesco}`,
                        formatDate(item.fecha_diag),
                        item.diag_full
                    ];
                });

                // Calcular la cantidad total
                const totalQuantity = resumen.reduce((total, item) => {
                    return total + (item.cantidad || 1); // Sumar la cantidad, o 1 si no está definida
                }, 0);
                // Crear un nuevo libro de trabajo
                const wb = XLSX.utils.book_new();

                // Crear una hoja de trabajo con los datos de egresos
                const wsData = [
                    ['AFILIADO', 'BENEFICIO', 'FECHA', 'DIAG'], // Encabezados
                    ...data,
                    [], // Fila vacía para separación
                    [`Total Cantidad: ${totalQuantity}`] // Fila de total
                ];

                const ws = XLSX.utils.aoa_to_sheet(wsData);
                XLSX.utils.book_append_sheet(wb, ws, 'PACIENTES');

                // Agregar hoja de total general
                const grandTotalSheet = XLSX.utils.aoa_to_sheet([
                    ['Total General', totalQuantity]
                ]);
                XLSX.utils.book_append_sheet(wb, grandTotalSheet, 'Total General');

                // Generar el archivo Excel
                XLSX.writeFile(wb, 'LISTADO_DIAGNÓSTICO.xlsx');
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function generateDiagPdf(fechaDesde, fechaHasta, obraSocialId) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('l', 'mm', 'a4');

        function getMaxRowsPerPage(doc, headers, data) {
            const pageHeight = doc.internal.pageSize.height;
            const margins = { top: 30, bottom: 20 };
            const rowHeight = 10;
            const headerHeight = 10;

            const availableHeight = pageHeight - margins.top - margins.bottom - headerHeight;
            const maxRows = Math.floor(availableHeight / rowHeight);

            return Math.min(maxRows, data.length);
        }

        Promise.all([fetchDiagData(fechaDesde, fechaHasta, obraSocialId)])
            .then(([resumen]) => {
                const formattedFechaDesde = formatDate(fechaDesde);
                const formattedFechaHasta = formatDate(fechaHasta);

                const title = 'LISTADO DIAGNÓSTICO';
                const pageWidth = doc.internal.pageSize.getWidth();

                doc.setFontSize(16);
                doc.setFont('Helvetica', 'bold');
                doc.text(title, pageWidth / 2, 10, { align: 'center' });
                doc.setFont('Helvetica', 'normal');

                const dateRange = `DESDE: ${formattedFechaDesde} HASTA: ${formattedFechaHasta}`;
                doc.setFontSize(14);
                doc.text(dateRange, pageWidth / 2, 20, { align: 'center' });

                doc.setFontSize(12);
                let startY = 30;
                const margin = { left: 15 };

                // Agrupar por diagnóstico
                const groupedByDiag = resumen.reduce((acc, item) => {
                    const diag = item.diag_full;
                    if (!acc[diag]) {
                        acc[diag] = [];
                    }
                    acc[diag].push(item);
                    return acc;
                }, {});

                // Crear las secciones de diagnóstico y tablas
                for (const [diagnostico, items] of Object.entries(groupedByDiag)) {
                    // Añadir subtítulo del diagnóstico
                    doc.setFontSize(14);
                    doc.setFont('Helvetica', 'bold');
                    doc.text(`DIAGNOSTICO: ${diagnostico}`, margin.left, startY);
                    doc.setFont('Helvetica', 'normal');

                    // Datos de la tabla
                    const headers = ['AFILIADO', 'BENEFICIO', 'FECHA'];
                    const data = items.map(item => [
                        item.nombre,
                        `${item.benef}${item.parentesco}`,
                        formatDate(item.fecha_diag)
                    ]);

                    // Crear la tabla en el PDF
                    const tableWidth = pageWidth - margin.left * 2;
                    const maxRowsPerPage = getMaxRowsPerPage(doc, headers, data);

                    let tableStartY = startY + 10;

                    for (let i = 0; i < data.length; i += maxRowsPerPage) {
                        const chunk = data.slice(i, i + maxRowsPerPage);

                        doc.autoTable({
                            head: [headers],
                            body: chunk,
                            startY: tableStartY,
                            margin: margin,
                            theme: 'striped',
                            styles: {
                                fontSize: 10,
                                cellPadding: 2,
                                overflow: 'linebreak'
                            },
                            columnStyles: {
                                0: { cellWidth: 70 },
                                1: { cellWidth: 45 },
                                2: { cellWidth: 30 }
                            },
                            didDrawPage: function (data) {
                                tableStartY = data.cursor.y;
                            },
                            pageBreak: 'auto'
                        });

                        if (i + maxRowsPerPage < data.length) {
                            doc.addPage();
                            tableStartY = 30;
                        }
                    }

                    startY = tableStartY + 20;
                }

                const totalQuantity = resumen.length;
                doc.setFontSize(12);
                doc.text(`Total Cantidad: ${totalQuantity}`, pageWidth / 2, startY + 10, { align: 'center' });

                const imgUrl = '../img/logo.png';
                var img = new Image();
                img.onload = function () {
                    const imgWidth = 29;
                    const imgHeight = 25;
                    const xImg = (pageWidth - imgWidth) / 2;
                    const yImg = startY + 15;

                    doc.addImage(img, 'PNG', xImg, yImg, imgWidth, imgHeight);

                    window.open(doc.output('bloburl'));
                };
                img.src = imgUrl;

            }).catch(error => {
                console.error('Error:', error);
            });
    }

    //FIN DIAG

    //INGRESO
    function generateIngresoPdf(fechaDesde, fechaHasta, obraSocialId) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('l', 'mm', 'a4');

        function getMaxRowsPerPage(doc, headers, data) {
            const pageHeight = doc.internal.pageSize.height;
            const margins = { top: 30, bottom: 20 }; // Ajusta los márgenes si es necesario
            const rowHeight = 10; // Altura de cada fila
            const headerHeight = 10; // Altura de la fila del encabezado

            const availableHeight = pageHeight - margins.top - margins.bottom - headerHeight;
            const maxRows = Math.floor(availableHeight / rowHeight);

            return Math.min(maxRows, data.length);
        }

        Promise.all([fetchIngresoData(fechaDesde, fechaHasta, obraSocialId)])
            .then(([resumen]) => {
                const formattedFechaDesde = formatDate(fechaDesde);
                const formattedFechaHasta = formatDate(fechaHasta);

                const title = 'LISTADO DE INGRESOS REALIZADOS';
                const pageWidth = doc.internal.pageSize.getWidth();

                doc.setFontSize(16);
                doc.setFont('Helvetica', 'bold');
                doc.text(title, pageWidth / 2, 10, { align: 'center' });
                doc.setFont('Helvetica', 'normal');

                const dateRange = `DESDE: ${formattedFechaDesde} HASTA: ${formattedFechaHasta}`;
                doc.setFontSize(14);
                doc.text(dateRange, pageWidth / 2, 20, { align: 'center' });

                doc.setFontSize(12);
                let startY = 30;
                const margin = { left: 15 };

                const headers = ['AFILIADO', 'BENEFICIO', 'FECHA ADMISION', 'MODALIDAD'];
                const data = resumen.map(item => [
                    item.nombre,
                    `${item.benef}${item.parentesco}`,
                    formatDate(item.admision),
                    item.modalidad_full
                ]);

                // Calcular la cantidad total
                const totalQuantity = data.length;

                // Crear la tabla en el PDF
                const tableWidth = pageWidth - margin.left * 2;

                if (data.length) {
                    let tableStartY = startY;
                    const maxRowsPerPage = getMaxRowsPerPage(doc, headers, data);

                    for (let i = 0; i < data.length; i += maxRowsPerPage) {
                        const chunk = data.slice(i, i + maxRowsPerPage);

                        doc.autoTable({
                            head: [headers],
                            body: chunk,
                            startY: tableStartY,
                            margin: margin,
                            theme: 'striped',
                            styles: {
                                fontSize: 10,
                                cellPadding: 2,
                                overflow: 'linebreak'
                            },
                            columnStyles: {
                                0: { cellWidth: 70 },
                                1: { cellWidth: 45 },
                                2: { cellWidth: 30 },
                                3: { cellWidth: 80 }
                            },
                            didDrawPage: function (data) {
                                tableStartY = data.cursor.y;
                            },
                            pageBreak: 'auto'
                        });

                        if (i + maxRowsPerPage < data.length) {
                            doc.addPage();
                            tableStartY = 30;
                        }
                    }

                    doc.setFontSize(12);
                    doc.text(`Total Cantidad: ${totalQuantity}`, pageWidth / 2, tableStartY + 10, { align: 'center' });
                    startY = tableStartY + 20;
                }

                doc.setFontSize(14);
                doc.text(`Total General: ${totalQuantity}`, pageWidth / 2, startY + 10, { align: 'center' });

                const imgUrl = '../img/logo.png';
                var img = new Image();
                img.onload = function () {
                    const imgWidth = 29;
                    const imgHeight = 25;
                    const xImg = (pageWidth - imgWidth) / 2;
                    const yImg = startY + 15;

                    doc.addImage(img, 'PNG', xImg, yImg, imgWidth, imgHeight);

                    window.open(doc.output('bloburl'));
                };
                img.src = imgUrl;

            }).catch(error => {
                console.error('Error:', error);
            });
    }

    function generateIngresoExcel(fechaDesde, fechaHasta, obraSocialId) {
        Promise.all([fetchIngresoData(fechaDesde, fechaHasta, obraSocialId)])
            .then(([resumen]) => {
                // Formatear fechas
                const formattedFechaDesde = formatDate(fechaDesde);
                const formattedFechaHasta = formatDate(fechaHasta);

                const data = resumen.map(item => [
                    item.nombre,
                    `${item.benef}${item.parentesco}`,
                    formatDate(item.admision),
                    item.motivo_egreso
                ]);

                // Calcular la cantidad total
                const totalQuantity = data.length;

                // Crear un nuevo libro de trabajo
                const wb = XLSX.utils.book_new();

                // Crear una hoja de trabajo con los datos de egresos
                const wsData = [
                    ['AFILIADO', 'BENEFICIO', 'FECHA', 'MOTIVO'], // Encabezados
                    ...data,
                    [], // Fila vacía para separación
                    [`Total Cantidad: ${totalQuantity}`] // Fila de total
                ];

                const ws = XLSX.utils.aoa_to_sheet(wsData);
                XLSX.utils.book_append_sheet(wb, ws, 'Ingreso');

                // Agregar hoja de total general
                const grandTotalSheet = XLSX.utils.aoa_to_sheet([
                    ['Total General', totalQuantity]
                ]);
                XLSX.utils.book_append_sheet(wb, grandTotalSheet, 'Total General');

                // Generar el archivo Excel
                XLSX.writeFile(wb, 'Control_de_ingreso.xlsx');
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }



    //FIN INGRESO

    //EGRESO
    function generateEgresoPdf(fechaDesde, fechaHasta, obraSocialId) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('l', 'mm', 'a4');

        function getMaxRowsPerPage(doc, headers, data) {
            const pageHeight = doc.internal.pageSize.height;
            const margins = { top: 30, bottom: 20 }; // Ajusta los márgenes si es necesario
            const rowHeight = 10; // Altura de cada fila
            const headerHeight = 10; // Altura de la fila del encabezado

            const availableHeight = pageHeight - margins.top - margins.bottom - headerHeight;
            const maxRows = Math.floor(availableHeight / rowHeight);

            return Math.min(maxRows, data.length);
        }

        Promise.all([fetchEgresoData(fechaDesde, fechaHasta, obraSocialId)])
            .then(([resumen]) => {
                const formattedFechaDesde = formatDate(fechaDesde);
                const formattedFechaHasta = formatDate(fechaHasta);

                const title = 'LISTADO DE EGRESOS REALIZADOS';
                const pageWidth = doc.internal.pageSize.getWidth();

                doc.setFontSize(16);
                doc.setFont('Helvetica', 'bold');
                doc.text(title, pageWidth / 2, 10, { align: 'center' });
                doc.setFont('Helvetica', 'normal');

                const dateRange = `DESDE: ${formattedFechaDesde} HASTA: ${formattedFechaHasta}`;
                doc.setFontSize(14);
                doc.text(dateRange, pageWidth / 2, 20, { align: 'center' });

                doc.setFontSize(12);
                let startY = 30;
                const margin = { left: 15 };

                const headers = ['AFILIADO', 'BENEFICIO', 'FECHA', 'MOTIVO'];
                const data = resumen.map(item => [
                    item.nombre,
                    `${item.benef}${item.parentesco}`,
                    formatDate(item.fecha_egreso),
                    item.motivo_egreso
                ]);

                // Calcular la cantidad total
                const totalQuantity = data.length;

                // Crear la tabla en el PDF
                const tableWidth = pageWidth - margin.left * 2;

                if (data.length) {
                    let tableStartY = startY;
                    const maxRowsPerPage = getMaxRowsPerPage(doc, headers, data);

                    for (let i = 0; i < data.length; i += maxRowsPerPage) {
                        const chunk = data.slice(i, i + maxRowsPerPage);

                        doc.autoTable({
                            head: [headers],
                            body: chunk,
                            startY: tableStartY,
                            margin: margin,
                            theme: 'striped',
                            styles: {
                                fontSize: 10,
                                cellPadding: 2,
                                overflow: 'linebreak'
                            },
                            columnStyles: {
                                0: { cellWidth: 70 },
                                1: { cellWidth: 45 },
                                2: { cellWidth: 25 },
                                3: { cellWidth: 80 }
                            },
                            didDrawPage: function (data) {
                                tableStartY = data.cursor.y;
                            },
                            pageBreak: 'auto'
                        });

                        if (i + maxRowsPerPage < data.length) {
                            doc.addPage();
                            tableStartY = 30;
                        }
                    }

                    doc.setFontSize(12);
                    doc.text(`Total Cantidad: ${totalQuantity}`, pageWidth / 2, tableStartY + 10, { align: 'center' });
                    startY = tableStartY + 20;
                }

                doc.setFontSize(14);
                doc.text(`Total General: ${totalQuantity}`, pageWidth / 2, startY + 10, { align: 'center' });

                const imgUrl = '../img/logo.png';
                var img = new Image();
                img.onload = function () {
                    const imgWidth = 29;
                    const imgHeight = 25;
                    const xImg = (pageWidth - imgWidth) / 2;
                    const yImg = startY + 15;

                    doc.addImage(img, 'PNG', xImg, yImg, imgWidth, imgHeight);

                    window.open(doc.output('bloburl'));
                };
                img.src = imgUrl;

            }).catch(error => {
                console.error('Error:', error);
            });
    }

    function generateEgresoExcel(fechaDesde, fechaHasta, obraSocialId) {
        Promise.all([fetchEgresoData(fechaDesde, fechaHasta, obraSocialId)])
            .then(([resumen]) => {
                const formattedFechaDesde = formatDate(fechaDesde);
                const formattedFechaHasta = formatDate(fechaHasta);

                const data = resumen.map(item => [
                    item.nombre,
                    `${item.benef}${item.parentesco}`,
                    formatDate(item.fecha_egreso),
                    item.motivo_egreso
                ]);

                // Calcular la cantidad total
                const totalQuantity = data.length;

                // Crear un nuevo libro de trabajo
                const wb = XLSX.utils.book_new();

                // Crear una hoja de trabajo con los datos de egresos
                const wsData = [
                    ['AFILIADO', 'BENEFICIO', 'FECHA', 'MOTIVO'], // Encabezados
                    ...data,
                    [], // Fila vacía para separación
                    [`Total Cantidad: ${totalQuantity}`] // Fila de total
                ];

                const ws = XLSX.utils.aoa_to_sheet(wsData);
                XLSX.utils.book_append_sheet(wb, ws, 'Egresos');

                // Agregar hoja de total general
                const grandTotalSheet = XLSX.utils.aoa_to_sheet([
                    ['Total General', totalQuantity]
                ]);
                XLSX.utils.book_append_sheet(wb, grandTotalSheet, 'Total General');

                // Generar el archivo Excel
                XLSX.writeFile(wb, 'Control_de_Egresos.xlsx');
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
    //FIN EGRESO

    //PRACTICAS
    function generatePracExcel(fechaDesde, fechaHasta, obraSocialId) {
        Promise.all([fetchPracData(fechaDesde, fechaHasta, obraSocialId)])
            .then(([resumen]) => {

                const data = resumen.map(item => {
                    const fechaPract = item.fecha_pract ? formatDate(item.fecha_pract) : '';
                    const fechaTurno = item.fecha_turno ? formatDate(item.fecha_turno) : '';

                    return [
                        item.nombre,
                        (`${item.benef}${item.parentesco}`),
                        fechaTurno || fechaPract,
                        item.turno_pract || item.pract_full,
                        item.cantidad || 1
                    ];
                });

                // Calcular la cantidad total
                const totalQuantity = resumen.reduce((total, item) => {
                    return total + (item.cantidad || 1); // Sumar la cantidad, o 1 si no está definida
                }, 0);
                // Crear un nuevo libro de trabajo
                const wb = XLSX.utils.book_new();

                // Crear una hoja de trabajo con los datos de egresos
                const wsData = [
                    ['AFILIADO', 'BENEFICIO', 'FECHA', 'PRESTACION', 'CANTIDAD'], // Encabezados
                    ...data,
                    [], // Fila vacía para separación
                    [`Total Cantidad: ${totalQuantity}`] // Fila de total
                ];

                const ws = XLSX.utils.aoa_to_sheet(wsData);
                XLSX.utils.book_append_sheet(wb, ws, 'PACIENTES');

                // Agregar hoja de total general
                const grandTotalSheet = XLSX.utils.aoa_to_sheet([
                    ['Total General', totalQuantity]
                ]);
                XLSX.utils.book_append_sheet(wb, grandTotalSheet, 'Total General');

                // Generar el archivo Excel
                XLSX.writeFile(wb, 'LISTADO_DE_PRESTACIONES_REALIZADAS.xlsx');
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function generatePracPdf(fechaDesde, fechaHasta, obraSocialId) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('l', 'mm', 'a4');

        function getMaxRowsPerPage(doc, headers, data) {
            const pageHeight = doc.internal.pageSize.height;
            const margins = { top: 30, bottom: 20 }; // Adjust margins if needed
            const rowHeight = 10; // Height of each row
            const headerHeight = 10; // Height of header row

            const availableHeight = pageHeight - margins.top - margins.bottom - headerHeight;
            const maxRows = Math.floor(availableHeight / rowHeight);

            return Math.min(maxRows, data.length);
        }

        Promise.all([fetchPracData(fechaDesde, fechaHasta, obraSocialId)])
            .then(([resumen]) => {
                // Agrupar solo por prestación
                const groupedByPract = resumen.reduce((acc, item) => {
                    const practKey = item.turno_pract || item.pract_full;
                    if (!practKey) return acc;

                    if (!acc[practKey]) {
                        acc[practKey] = { data: [], totalQuantity: 0 };
                    }

                    acc[practKey].data.push([
                        item.nombre,
                        (`${item.benef}${item.parentesco}`),
                        formatDate(item.fecha_turno || item.fecha_pract),
                        item.cantidad || 1
                    ]);
                    acc[practKey].totalQuantity += item.cantidad || 1;

                    return acc;
                }, {});

                const formattedFechaDesde = formatDate(fechaDesde);
                const formattedFechaHasta = formatDate(fechaHasta);

                const title = 'LISTADO DE PRESTACIONES REALIZADAS';
                const pageWidth = doc.internal.pageSize.getWidth();

                doc.setFontSize(16);
                doc.setFont('Helvetica', 'bold');
                doc.text(title, pageWidth / 2, 10, { align: 'center' });
                doc.setFont('Helvetica', 'normal');

                const dateRange = `DESDE: ${formattedFechaDesde} HASTA: ${formattedFechaHasta}`;
                doc.setFontSize(14);
                doc.text(dateRange, pageWidth / 2, 20, { align: 'center' });

                doc.setFontSize(12);
                let startY = 30;
                const margin = { left: 15 };

                let grandTotal = 0;

                Object.keys(groupedByPract).forEach(practKey => {
                    const { data, totalQuantity } = groupedByPract[practKey];
                    const practSubtitle = `PRESTACION: ${practKey.toUpperCase()}`;

                    // Título de Prestación
                    doc.setFontSize(12);
                    doc.text(practSubtitle, pageWidth / 2, startY, { align: 'center' });

                    startY += 5; // Espacio para la tabla

                    const tableWidth = pageWidth - margin.left * 2;
                    const headers = ['AFILIADO', 'BENEFICIO', 'FECHA', 'CANTIDAD'];

                    if (data.length) {
                        let tableStartY = startY;
                        const maxRowsPerPage = getMaxRowsPerPage(doc, headers, data);

                        for (let i = 0; i < data.length; i += maxRowsPerPage) {
                            const chunk = data.slice(i, i + maxRowsPerPage);

                            doc.autoTable({
                                head: [headers],
                                body: chunk,
                                startY: tableStartY,
                                margin: margin,
                                theme: 'striped',
                                styles: {
                                    fontSize: 10,
                                    cellPadding: 2,
                                    overflow: 'linebreak'
                                },
                                columnStyles: {
                                    0: { cellWidth: 70 },
                                    1: { cellWidth: 45 },
                                    2: { cellWidth: 80 },
                                    3: { cellWidth: 25 }
                                },
                                didDrawPage: function (data) {
                                    tableStartY = data.cursor.y;
                                },
                                pageBreak: 'auto'
                            });

                            if (i + maxRowsPerPage < data.length) {
                                doc.addPage();
                                tableStartY = 30;
                            }
                        }

                        doc.setFontSize(12);
                        doc.text(`Total Cantidad: ${totalQuantity}`, pageWidth / 2, tableStartY + 10, { align: 'center' });

                        grandTotal += totalQuantity;
                        startY = tableStartY + 20;
                    }
                });

                doc.setFontSize(14);
                doc.text(`Total General: ${grandTotal}`, pageWidth / 2, startY + 10, { align: 'center' });

                const imgUrl = '../img/logo.png';
                var img = new Image();
                img.onload = function () {
                    const imgWidth = 29;
                    const imgHeight = 25;
                    const xImg = (pageWidth - imgWidth) / 2;
                    const yImg = startY + 15;

                    doc.addImage(img, 'PNG', xImg, yImg, imgWidth, imgHeight);

                    window.open(doc.output('bloburl'));
                };
                img.src = imgUrl;

            }).catch(error => {
                console.error('Error:', error);
            });
    }
    //FIN PRACTICAS

    //PROFESIONALES
    function generateProfExcel(fechaDesde, fechaHasta, obraSocialId, profesional) {
        Promise.all([fetchProfData(fechaDesde, fechaHasta, obraSocialId, profesional)])
            .then(([resumen]) => {

                const data = resumen.map(item => {
                    const fechaPract = item.fecha_pract ? formatDate(item.fecha_pract) : '';
                    const fechaTurno = item.fecha_turno ? formatDate(item.fecha_turno) : '';

                    return [
                        item.nombre,
                        (`${item.benef}${item.parentesco}`),
                        item.pract_full || item.turno_pract, // Preferir pract_full si existe
                        fechaPract || fechaTurno, // Mostrar fecha_pract si existe, de lo contrario mostrar fecha_turno
                        item.prof,
                        item.cantidad || 1
                    ];
                });

                // Calcular la cantidad total
                const totalQuantity = resumen.reduce((total, item) => {
                    return total + (item.cantidad || 1); // Sumar la cantidad, o 1 si no está definida
                }, 0);
                // Crear un nuevo libro de trabajo
                const wb = XLSX.utils.book_new();

                // Crear una hoja de trabajo con los datos de egresos
                const wsData = [
                    ['AFILIADO', 'BENEFICIO', 'PRACTICA/TURNO', 'FECHA', 'PROFESIONAL', 'CANTIDAD'], // Encabezados
                    ...data,
                    [], // Fila vacía para separación
                    [`Total Cantidad: ${totalQuantity}`] // Fila de total
                ];

                const ws = XLSX.utils.aoa_to_sheet(wsData);
                XLSX.utils.book_append_sheet(wb, ws, 'PACIENTES');

                // Agregar hoja de total general
                const grandTotalSheet = XLSX.utils.aoa_to_sheet([
                    ['Total General', totalQuantity]
                ]);
                XLSX.utils.book_append_sheet(wb, grandTotalSheet, 'Total General');

                // Generar el archivo Excel
                XLSX.writeFile(wb, 'LISTADO DE PRESTACIONES REALIZADAS POR PROFESIONAL.xlsx');
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function generateProfPdf(fechaDesde, fechaHasta, obraSocialId, profesional) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('l', 'mm', 'a4');

        function getMaxRowsPerPage(doc, headers, data) {
            const pageHeight = doc.internal.pageSize.height;
            const margins = { top: 30, bottom: 20 }; // Ajusta los márgenes si es necesario
            const rowHeight = 10; // Altura de cada fila
            const headerHeight = 10; // Altura de la fila del encabezado

            const availableHeight = pageHeight - margins.top - margins.bottom - headerHeight;
            const maxRows = Math.floor(availableHeight / rowHeight);

            return Math.min(maxRows, data.length);
        }

        Promise.all([fetchProfData(fechaDesde, fechaHasta, obraSocialId, profesional)])
            .then(([resumen]) => {
                const groupedByProfessional = resumen.reduce((acc, item) => {
                    if (!acc[item.prof]) {
                        acc[item.prof] = {}; // Crear un nuevo objeto para el profesional
                    }

                    if (!acc[item.prof][item.modalidad_full]) {
                        acc[item.prof][item.modalidad_full] = { data: [], totalQuantity: 0 };
                    }

                    if (item.pract_full) {
                        acc[item.prof][item.modalidad_full].data.push([
                            item.nombre,
                            (`${item.benef}${item.parentesco}`),
                            item.pract_full,
                            formatDate(item.fecha_pract),
                            item.cantidad || 1
                        ]);
                        acc[item.prof][item.modalidad_full].totalQuantity += item.cantidad || 1;
                    }

                    if (item.turno_pract) {
                        acc[item.prof][item.modalidad_full].data.push([
                            item.nombre,
                            (`${item.benef}${item.parentesco}`),
                            item.turno_pract,
                            formatDate(item.fecha_turno),
                            item.cantidad || 1
                        ]);
                        acc[item.prof][item.modalidad_full].totalQuantity += item.cantidad || 1;
                    }

                    return acc;
                }, {});

                const formattedFechaDesde = formatDate(fechaDesde);
                const formattedFechaHasta = formatDate(fechaHasta);

                const title = 'LISTADO DE PRESTACIONES REALIZADAS POR PROFESIONAL';
                const pageWidth = doc.internal.pageSize.getWidth();

                doc.setFontSize(16);
                doc.setFont('Helvetica', 'bold');
                doc.text(title, pageWidth / 2, 10, { align: 'center' });
                doc.setFont('Helvetica', 'normal');

                const dateRange = `DESDE: ${formattedFechaDesde} HASTA: ${formattedFechaHasta}`;
                doc.setFontSize(14);
                doc.text(dateRange, pageWidth / 2, 20, { align: 'center' });

                doc.setFontSize(12);
                let startY = 30;
                const margin = { left: 15 };

                let grandTotal = 0; // Variable para acumular el total para todas las modalidades

                Object.keys(groupedByProfessional).forEach(prof => {
                    const modalities = groupedByProfessional[prof];
                    const profUpperCase = prof.toUpperCase();
                    const profSubtitle = `PROFESIONAL: ${profUpperCase}`;
                    doc.setFontSize(12);
                    doc.text(profSubtitle, pageWidth / 2, startY, { align: 'center' });

                    startY += 10; // Mover hacia abajo para las tablas

                    Object.keys(modalities).forEach(modality => {
                        const { data, totalQuantity } = modalities[modality];
                        const modalityUpperCase = modality.toUpperCase();
                        const subtitle = `MODALIDAD: ${modalityUpperCase}`;

                        doc.text(subtitle, pageWidth / 2, startY, { align: 'center' });

                        startY += 10; // Mover hacia abajo para la tabla

                        const tableWidth = pageWidth - margin.left * 2;
                        const headers = ['AFILIADO', 'BENEFICIO', 'PRACTICA/TURNO', 'FECHA', 'CANTIDAD'];

                        if (data.length) {
                            let tableStartY = startY;
                            const maxRowsPerPage = getMaxRowsPerPage(doc, headers, data);

                            // Dividir los datos en fragmentos dinámicamente
                            for (let i = 0; i < data.length; i += maxRowsPerPage) {
                                const chunk = data.slice(i, i + maxRowsPerPage);

                                doc.autoTable({
                                    head: [headers],
                                    body: chunk,
                                    startY: tableStartY,
                                    margin: margin,
                                    theme: 'striped',
                                    styles: {
                                        fontSize: 10,
                                        cellPadding: 2,
                                        overflow: 'linebreak'
                                    },
                                    columnStyles: {
                                        0: { cellWidth: 70 },
                                        1: { cellWidth: 45 },
                                        2: { cellWidth: 80 },
                                        3: { cellWidth: 25 },
                                        4: { cellWidth: 23 }
                                    },
                                    didDrawPage: function (data) {
                                        tableStartY = data.cursor.y;
                                    },
                                    pageBreak: 'auto'
                                });

                                if (i + maxRowsPerPage < data.length) {
                                    doc.addPage(); // Agregar una nueva página si hay más datos
                                    tableStartY = 30; // Reiniciar la posición de inicio para la nueva página
                                }
                            }

                            // Agregar el total de cantidad para esta modalidad
                            doc.setFontSize(12);
                            doc.text(`Total Cantidad: ${totalQuantity}`, pageWidth / 2, tableStartY + 10, { align: 'center' });

                            grandTotal += totalQuantity; // Acumular al total general

                            startY = tableStartY + 20; // Actualizar startY después del último fragmento
                        }
                    });
                });

                // Agregar el total general al final del documento
                doc.setFontSize(14);
                doc.text(`Total General: ${grandTotal}`, pageWidth / 2, startY + 10, { align: 'center' });

                const imgUrl = '../img/logo.png';
                var img = new Image();
                img.onload = function () {
                    const imgWidth = 29;
                    const imgHeight = 25;
                    const xImg = (pageWidth - imgWidth) / 2;
                    const yImg = startY + 15;

                    doc.addImage(img, 'PNG', xImg, yImg, imgWidth, imgHeight);

                    window.open(doc.output('bloburl'));
                };
                img.src = imgUrl;

            }).catch(error => {
                console.error('Error:', error);
            });
    }
    //FIN PROFESIONALES

    //RESUMEN ESTADISTICAS POR MODALIDAD
    function generateExcel(fechaDesde, fechaHasta, obraSocialId) {
        Promise.all([fetchData(fechaDesde, fechaHasta, obraSocialId)])
            .then(([resumen]) => {

                const data = resumen.map(item => {
                    const fechaPract = item.fecha_pract ? formatDate(item.fecha_pract) : '';
                    const fechaTurno = item.fecha_turno ? formatDate(item.fecha_turno) : '';

                    return [
                        item.nombre,
                        (`${item.benef}${item.parentesco}`),
                        item.pract_full || item.turno_pract, // Preferir pract_full si existe
                        fechaPract || fechaTurno, // Mostrar fecha_pract si existe, de lo contrario mostrar fecha_turno
                        item.cantidad || 1
                    ];
                });

                // Calcular la cantidad total
                const totalQuantity = resumen.reduce((total, item) => {
                    return total + (item.cantidad || 1); // Sumar la cantidad, o 1 si no está definida
                }, 0);
                // Crear un nuevo libro de trabajo
                const wb = XLSX.utils.book_new();

                // Crear una hoja de trabajo con los datos de egresos
                const wsData = [
                    ['AFILIADO', 'BENEFICIO', 'PRACTICA/TURNO', 'FECHA', 'CANTIDAD'], // Encabezados
                    ...data,
                    [], // Fila vacía para separación
                    [`Total Cantidad: ${totalQuantity}`] // Fila de total
                ];

                const ws = XLSX.utils.aoa_to_sheet(wsData);
                XLSX.utils.book_append_sheet(wb, ws, 'PACIENTES');

                // Agregar hoja de total general
                const grandTotalSheet = XLSX.utils.aoa_to_sheet([
                    ['Total General', totalQuantity]
                ]);
                XLSX.utils.book_append_sheet(wb, grandTotalSheet, 'Total General');

                // Generar el archivo Excel
                XLSX.writeFile(wb, 'LISTADO_DE_PRESTACIONES_REALIZADAS_POR_PACIENTE_Y_MODALIDAD.xlsx');
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function generatePdf(fechaDesde, fechaHasta, obraSocialId) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('l', 'mm', 'a4');

        function getMaxRowsPerPage(doc, headers, data) {
            const pageHeight = doc.internal.pageSize.height;
            const margins = { top: 30, bottom: 20 }; // Adjust margins if needed
            const rowHeight = 10; // Height of each row
            const headerHeight = 10; // Height of header row

            const availableHeight = pageHeight - margins.top - margins.bottom - headerHeight;
            const maxRows = Math.floor(availableHeight / rowHeight);

            return Math.min(maxRows, data.length);
        }

        Promise.all([fetchData(fechaDesde, fechaHasta, obraSocialId)])
            .then(([resumen]) => {
                
                const groupedByModality = resumen.reduce((acc, item) => {
                    if (!acc[item.modalidad_full]) {
                        acc[item.modalidad_full] = { data: [], totalQuantity: 0 };
                    }
                    if (item.pract_full) {
                        acc[item.modalidad_full].data.push([
                            item.nombre,
                            (`${item.benef}${item.parentesco}`),
                            item.pract_full,
                            formatDate(item.fecha_pract),
                            item.cantidad || 1  // Usa 0 si item.cantidad es undefined o null                           

                        ]);
                        acc[item.modalidad_full].totalQuantity += item.cantidad || 1;
                    }

                    if (item.turno_pract) {
                        acc[item.modalidad_full].data.push([
                            item.nombre,
                            (`${item.benef}${item.parentesco}`),
                            item.turno_pract,
                            formatDate(item.fecha_turno),
                            item.cantidad || 1
                        ]);
                        acc[item.modalidad_full].totalQuantity += item.cantidad || 1;
                    }

                    return acc;
                    
                }, {});

                const formattedFechaDesde = formatDate(fechaDesde);
                const formattedFechaHasta = formatDate(fechaHasta);

                const title = 'LISTADO DE PRESTACIONES REALIZADAS POR PACIENTE Y MODALIDAD';
                const pageWidth = doc.internal.pageSize.getWidth();

                doc.setFontSize(16);
                // Establecer la fuente en negrita
                doc.setFont('Helvetica', 'bold');
                doc.text(title, pageWidth / 2, 10, { align: 'center' });
                // Restablecer la fuente a la predeterminada (opcional)
                doc.setFont('Helvetica', 'normal');

                const dateRange = `DESDE: ${formattedFechaDesde} HASTA: ${formattedFechaHasta}`;
                doc.setFontSize(14);
                doc.text(dateRange, pageWidth / 2, 20, { align: 'center' });

                doc.setFontSize(12);
                let startY = 30;
                const margin = { left: 15 };

                let grandTotal = 0; // Variable to accumulate total for all modalities

                Object.keys(groupedByModality).forEach(modality => {
                    const { data, totalQuantity } = groupedByModality[modality];
                    const modalityUpperCase = modality.toUpperCase(); // Convierte la variable a mayúsculas
                    const subtitle = `MODALIDAD: ${modalityUpperCase}`;

                    doc.text(subtitle, pageWidth / 2, startY, { align: 'center' });

                    startY += 10; // Move down for tables

                    const tableWidth = pageWidth - margin.left * 2;
                    const headers = ['AFILIADO', 'BENEFICIO', 'PRACTICA/TURNO', 'FECHA', 'CANTIDAD'];

                    if (data.length) {
                        let tableStartY = startY;
                        const maxRowsPerPage = getMaxRowsPerPage(doc, headers, data);

                        // Split data into chunks dynamically
                        for (let i = 0; i < data.length; i += maxRowsPerPage) {
                            const chunk = data.slice(i, i + maxRowsPerPage);

                            doc.autoTable({
                                head: [headers],
                                body: chunk,
                                startY: tableStartY,
                                margin: margin,
                                theme: 'striped',
                                styles: {
                                    fontSize: 10,
                                    cellPadding: 2,
                                    overflow: 'linebreak'
                                },
                                columnStyles: {
                                    0: { cellWidth: 70 },
                                    1: { cellWidth: 45 },
                                    2: { cellWidth: 80 },
                                    3: { cellWidth: 25 },
                                    4: { cellWidth: 23 }
                                },
                                didDrawPage: function (data) {
                                    tableStartY = data.cursor.y;
                                },
                                pageBreak: 'auto'
                            });

                            if (i + maxRowsPerPage < data.length) {
                                doc.addPage(); // Add a new page if there is more data
                                tableStartY = 30; // Reset start position for the new page
                            }
                        }

                        // Add total quantity for this modality
                        doc.setFontSize(12);
                        doc.text(`Total Cantidad: ${totalQuantity}`, pageWidth / 2, tableStartY + 10, { align: 'center' });

                        grandTotal += totalQuantity; // Accumulate to grandTotal

                        startY = tableStartY + 20; // Update startY after the last chunk
                    }
                });

                // Add grand total at the end of the document
                doc.setFontSize(14);
                doc.text(`Total General: ${grandTotal}`, pageWidth / 2, startY + 2, { align: 'center' });

                const imgUrl = '../img/logo.png';
                var img = new Image();
                img.onload = function () {
                    const imgWidth = 25;
                    const imgHeight = 20;
                    const xImg = (pageWidth - imgWidth) / 2;
                    const yImg = startY + 5;

                    doc.addImage(img, 'PNG', xImg, yImg, imgWidth, imgHeight);

                    window.open(doc.output('bloburl'))
                };
                img.src = imgUrl;

            }).catch(error => {
                console.error('Error:', error);
            });
    }
    //FIN RESUMEN ESTADISTICAS POR MODALIDAD

    //PACIENTES
    function generatePatientExcel(fechaDesde, fechaHasta, obraSocialId) {
        Promise.all([fetchPatientData(fechaDesde, fechaHasta, obraSocialId)])
            .then(([resumen]) => {

                const data = resumen.map(item => {
                    const admision = item.admision ? formatDate(item.admision) : '';
                    const egreso = item.egreso ? formatDate(item.egreso) : '';
                    const ult_atencion = item.ult_atencion ? formatDate(item.ult_atencion) : '';
                    return [
                        item.nombre,
                        item.benef,
                        admision,
                        item.diag,
                        egreso,
                        ult_atencion,
                        item.cantidad || 1
                    ];
                });

                // Calcular la cantidad total
                const totalQuantity = resumen.reduce((total, item) => {
                    return total + (item.cantidad || 1); // Sumar la cantidad, o 1 si no está definida
                }, 0);
                // Crear un nuevo libro de trabajo
                const wb = XLSX.utils.book_new();

                // Crear una hoja de trabajo con los datos de egresos
                const wsData = [
                    ['AFILIADO', 'BENEFICIO', 'INGRESO', 'DIAG', 'EGRESO', 'Ult. ATENCION', 'CANTIDAD'], // Encabezados
                    ...data,
                    [], // Fila vacía para separación
                    [`Total Cantidad: ${totalQuantity}`] // Fila de total
                ];

                const ws = XLSX.utils.aoa_to_sheet(wsData);
                XLSX.utils.book_append_sheet(wb, ws, 'PACIENTES');

                // Agregar hoja de total general
                const grandTotalSheet = XLSX.utils.aoa_to_sheet([
                    ['Total General', totalQuantity]
                ]);
                XLSX.utils.book_append_sheet(wb, grandTotalSheet, 'Total General');

                // Generar el archivo Excel
                XLSX.writeFile(wb, 'LISTADO_DE_PACIENTES_ATENDIDOS_POR_MODALIDAD.xlsx');
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }


    function generatePatientPdf(fechaDesde, fechaHasta, obraSocialId) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('l', 'mm', 'a4');
    
        function getMaxRowsPerPage(doc, headers, data) {
            const pageHeight = doc.internal.pageSize.height;
            const margins = { top: 30, bottom: 20 };
            const rowHeight = 10;
            const headerHeight = 10;
    
            const availableHeight = pageHeight - margins.top - margins.bottom - headerHeight;
            const maxRows = Math.floor(availableHeight / rowHeight);
    
            return Math.min(maxRows, data.length);
        }
    
        Promise.all([fetchPatientData(fechaDesde, fechaHasta, obraSocialId)])
            .then(([resumen]) => {
                // Step 1: Aggregate data by modality and sex, ensuring only one row per patient
                const aggregatedData = {};
    
                resumen.forEach(item => {
                    const key = `${item.nombre}-${item.modalidad_full}`;
                    if (!aggregatedData[key] || new Date(item.ult_atencion) > new Date(aggregatedData[key].ult_atencion)) {
                        aggregatedData[key] = item;
                    }
                });
    
                const data = Object.values(aggregatedData);
    
                const formattedFechaDesde = formatDate(fechaDesde);
                const formattedFechaHasta = formatDate(fechaHasta);
    
                const title = 'LISTADO DE PACIENTES ATENDIDOS POR MODALIDAD';
                const pageWidth = doc.internal.pageSize.getWidth();
    
                doc.setFontSize(16);
                doc.setFont('Helvetica', 'bold');
                doc.text(title, pageWidth / 2, 10, { align: 'center' });
                doc.setFont('Helvetica', 'normal');
    
                const dateRange = `DESDE: ${formattedFechaDesde} HASTA: ${formattedFechaHasta}`;
                doc.setFontSize(14);
                doc.text(dateRange, pageWidth / 2, 20, { align: 'center' });
    
                doc.setFontSize(12);
                let startY = 30;
                const margin = { left: 15 };
    
                const modalities = [...new Set(data.map(item => item.modalidad_full))];
    
                modalities.forEach(modality => {
                    const modalityData = data.filter(item => item.modalidad_full === modality);
                    const sexTotals = modalityData.reduce((acc, item) => {
                        const sex = item.sexo || 'Desconocido';
                        if (!acc[sex]) {
                            acc[sex] = 0;
                        }
                        acc[sex]++;
                        return acc;
                    }, {});
    
                    const modalityUpperCase = modality.toUpperCase();
                    const subtitle = `MODALIDAD: ${modalityUpperCase}`;
                    doc.setFontSize(12);
                    doc.text(subtitle, pageWidth / 2, startY, { align: 'center' });
    
                    startY += 5;
    
                    const headers = ['AFILIADO', 'BENEFICIO', 'INGRESO', 'DIAG', 'EGRESO', 'Ult. ATENCION'];
    
                    if (modalityData.length) {
                        let tableStartY = startY;
                        const maxRowsPerPage = getMaxRowsPerPage(doc, headers, modalityData);
    
                        for (let i = 0; i < modalityData.length; i += maxRowsPerPage) {
                            const chunk = modalityData.slice(i, i + maxRowsPerPage);
    
                            doc.autoTable({
                                head: [headers],
                                body: chunk.map(item => [
                                    item.nombre,
                                    item.benef,
                                    formatDate(item.admision),
                                    item.diag || ' ',
                                    item.egreso ? formatDate(item.egreso) : ' ',
                                    formatDate(item.ult_atencion)
                                ]),
                                startY: tableStartY,
                                margin: margin,
                                theme: 'striped',
                                styles: {
                                    fontSize: 10,
                                    cellPadding: 2,
                                    overflow: 'linebreak'
                                },
                                columnStyles: {
                                    0: { cellWidth: 70 },
                                    1: { cellWidth: 45 },
                                    2: { cellWidth: 25 },
                                    3: { cellWidth: 25 },
                                    4: { cellWidth: 23 },
                                    5: { cellWidth: 30 }
                                },
                                didDrawPage: function (data) {
                                    tableStartY = data.cursor.y;
                                },
                                pageBreak: 'auto'
                            });
    
                            if (i + maxRowsPerPage < modalityData.length) {
                                doc.addPage();
                                tableStartY = 30;
                            }
                        }
    
                        // Add totals by sex for the current modality
                        doc.setFontSize(12);
                        startY = tableStartY + 10;
    
                        const sexHeaders = ['SEXO', 'TOTAL'];
                        const sexData = Object.entries(sexTotals).map(([sex, total]) => [sex, total]);
    
                        doc.autoTable({
                            head: [sexHeaders],
                            body: sexData,
                            startY: startY,
                            margin: margin,
                            theme: 'striped',
                            styles: {
                                fontSize: 10,
                                cellPadding: 2,
                                overflow: 'linebreak'
                            },
                            columnStyles: {
                                0: { cellWidth: 60 },
                                1: { cellWidth: 30 }
                            }
                        });
    
                        startY = doc.autoTable.previous.finalY + 10;
                    }
                });
    
                doc.setFontSize(14);
                doc.text(`Total General: ${data.length}`, pageWidth / 2, startY, { align: 'center' });
    
                const imgUrl = '../img/logo.png';
                var img = new Image();
                img.onload = function () {
                    const imgWidth = 29;
                    const imgHeight = 25;
                    const xImg = (pageWidth - imgWidth) / 2;
                    const yImg = startY + 15;
    
                    doc.addImage(img, 'PNG', xImg, yImg, imgWidth, imgHeight);
    
                    window.open(doc.output('bloburl'));
                };
                img.src = imgUrl;
    
            }).catch(error => {
                console.error('Error:', error);
            });
    }
    
    
    
    
    //FIN PACIENTES

    //OME
    function generateOmesPdf(fechaDesde, fechaHasta, obraSocialId) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('l', 'mm', 'a4');

        function getMaxRowsPerPage(doc, headers, data) {
            const pageHeight = doc.internal.pageSize.height;
            const margins = { top: 30, bottom: 20 }; // Adjust margins if needed
            const rowHeight = 10; // Height of each row
            const headerHeight = 10; // Height of header row

            const availableHeight = pageHeight - margins.top - margins.bottom - headerHeight;
            const maxRows = Math.floor(availableHeight / rowHeight);

            return Math.min(maxRows, data.length);
        }

        Promise.all([fetchOmesData(fechaDesde, fechaHasta, obraSocialId)])
            .then(([resumen]) => {
                const groupedByModality = resumen.reduce((acc, item) => {
                    if (!acc[item.modalidad_full]) {
                        acc[item.modalidad_full] = { data: [], totalQuantity: 0 };
                    }

                    acc[item.modalidad_full].data.push([
                        item.nombre,
                        item.benef,
                        item.turno_pract,
                        formatDate(item.fecha_turno),
                        item.prof
                    ]);

                    acc[item.modalidad_full].totalQuantity += 1;

                    return acc;
                }, {});

                const formattedFechaDesde = formatDate(fechaDesde);
                const formattedFechaHasta = formatDate(fechaHasta);

                const title = 'CONTROL DE CARGAS OME';
                const pageWidth = doc.internal.pageSize.getWidth();

                doc.setFontSize(16);
                // Establecer la fuente en negrita
                doc.setFont('Helvetica', 'bold');
                doc.text(title, pageWidth / 2, 10, { align: 'center' });

                // Restablecer la fuente a la predeterminada (opcional)
                doc.setFont('Helvetica', 'normal');

                const dateRange = `Desde: ${formattedFechaDesde} Hasta: ${formattedFechaHasta}`;
                doc.setFontSize(14);
                doc.text(dateRange, pageWidth / 2, 20, { align: 'center' });

                doc.setFontSize(12);
                let startY = 30;
                const margin = { left: 15 };

                let grandTotal = 0; // Variable to accumulate total for all modalities

                Object.keys(groupedByModality).forEach(modality => {
                    const { data, totalQuantity } = groupedByModality[modality];
                    const modalityUpperCase = modality.toUpperCase(); // Convierte la variable a mayúsculas
                    const subtitle = `MODALIDAD: ${modalityUpperCase}`;
                    doc.setFontSize(12);
                    doc.text(subtitle, pageWidth / 2, startY, { align: 'center' });
                    startY += 10; // Move down for tables


                    const tableWidth = pageWidth - margin.left * 2;
                    const headers = ['AFILIADO', 'BENEFICIO', 'PRACT.', 'FECHA', 'PROF'];

                    if (data.length) {
                        let tableStartY = startY;
                        const maxRowsPerPage = getMaxRowsPerPage(doc, headers, data);

                        // Split data into chunks dynamically
                        for (let i = 0; i < data.length; i += maxRowsPerPage) {
                            const chunk = data.slice(i, i + maxRowsPerPage);

                            doc.autoTable({
                                head: [headers],
                                body: chunk,
                                startY: tableStartY,
                                margin: margin,
                                theme: 'striped',
                                styles: {
                                    fontSize: 10,
                                    cellPadding: 2,
                                    overflow: 'linebreak'
                                },
                                columnStyles: {
                                    0: { cellWidth: 70 },
                                    1: { cellWidth: 45 },
                                    2: { cellWidth: 80 },
                                    3: { cellWidth: 25 },
                                    4: { cellWidth: 23 },
                                    5: { cellWidth: 30 } // Adjust cell width as needed
                                },
                                didDrawPage: function (data) {
                                    tableStartY = data.cursor.y;
                                },
                                pageBreak: 'auto'
                            });

                            if (i + maxRowsPerPage < data.length) {
                                doc.addPage(); // Add a new page if there is more data
                                tableStartY = 30; // Reset start position for the new page
                            }
                        }

                        // Add total quantity for this modality
                        doc.setFontSize(12);
                        doc.text(`Total Cantidad: ${totalQuantity}`, pageWidth / 2, tableStartY + 10, { align: 'center' });

                        grandTotal += totalQuantity; // Accumulate to grandTotal

                        startY = tableStartY + 20; // Update startY after the last chunk
                    }
                });

                // Add grand total at the end of the document
                doc.setFontSize(14);
                doc.text(`Total General: ${grandTotal}`, pageWidth / 2, startY + 10, { align: 'center' });

                const imgUrl = '../img/logo.png';
                var img = new Image();
                img.onload = function () {
                    const imgWidth = 29;
                    const imgHeight = 25;
                    const xImg = (pageWidth - imgWidth) / 2;
                    const yImg = startY + 15;

                    doc.addImage(img, 'PNG', xImg, yImg, imgWidth, imgHeight);

                    window.open(doc.output('bloburl'))
                };
                img.src = imgUrl;

            }).catch(error => {
                console.error('Error:', error);
            });
    }

    function generateOmesExcel(fechaDesde, fechaHasta, obraSocialId) {
        Promise.all([fetchOmesData(fechaDesde, fechaHasta, obraSocialId)])
            .then(([resumen]) => {
                const groupedByModality = resumen.reduce((acc, item) => {
                    if (!acc[item.modalidad_full]) {
                        acc[item.modalidad_full] = { data: [], totalQuantity: 0 };
                    }

                    acc[item.modalidad_full].data.push([
                        item.nombre,
                        item.benef,
                        item.turno_pract,
                        formatDate(item.fecha_turno),
                        item.prof,
                        item.modalidad_full
                    ]);

                    acc[item.modalidad_full].totalQuantity += 1;

                    return acc;
                }, {});

                let grandTotal = 0; // Variable to accumulate total for all modalities

                // Create a new workbook
                const wb = XLSX.utils.book_new();

                // Add a sheet for each modality
                Object.keys(groupedByModality).forEach(modality => {
                    const { data, totalQuantity } = groupedByModality[modality];
                    const modalityUpperCase = modality.toUpperCase(); // Convierte la variable a mayúsculas

                    // Create a worksheet with modality data
                    const wsData = [
                        ['AFILIADO', 'BENEFICIO', 'PRACT.', 'FECHA', 'PROF', 'MODALIDAD'], // Headers
                        ...data,
                        [], // Empty row for separation
                        [`Total Cantidad: ${totalQuantity}`] // Total row
                    ];

                    const ws = XLSX.utils.aoa_to_sheet(wsData);
                    XLSX.utils.book_append_sheet(wb, ws, modalityUpperCase);

                    grandTotal += totalQuantity; // Accumulate to grandTotal
                });

                // Add grand total sheet
                const grandTotalSheet = XLSX.utils.aoa_to_sheet([
                    ['Total General', grandTotal]
                ]);
                XLSX.utils.book_append_sheet(wb, grandTotalSheet, 'Total General');

                // Generate Excel file
                XLSX.writeFile(wb, 'Control_de_Cargas_OME.xlsx');
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    //FIN OME





});

//barra busqueda
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const cards = document.querySelectorAll('.card');

    searchInput.addEventListener('input', function () {
        const searchValue = searchInput.value.toLowerCase();

        cards.forEach(card => {
            const title = card.querySelector('h3').textContent.toLowerCase();
            if (title.includes(searchValue)) {
                card.parentElement.style.display = 'block';
            } else {
                card.parentElement.style.display = 'none';
            }
        });
    });
});

//carga de obras sociales
$(document).ready(function () {
    $.ajax({
        url: '../pacientes/dato/get_obras_sociales.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            data.forEach(function (item) {
                var optionText = item.siglas + ' - ' + item.razon_social;
                $('#obra_social').append(new Option(optionText, item.id));
                $('#obra_social_paciente').append(new Option(optionText, item.id));
                $('#obra_social_ome').append(new Option(optionText, item.id));
                $('#obra_social_prof').append(new Option(optionText, item.id));
                $('#obra_social_prac').append(new Option(optionText, item.id));
                $('#obra_social_egreso').append(new Option(optionText, item.id));
                $('#obra_social_ingreso').append(new Option(optionText, item.id));
                $('#obra_social_diag').append(new Option(optionText, item.id));
                $('#obra_social_plan').append(new Option(optionText, item.id));
            });
        },
        error: function (error) {
            console.error("Error fetching data: ", error);
        }
    });

    $.ajax({
        url: '../pacientes/dato/get_profesional.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            // Agregar solo las opciones de profesionales
            data.forEach(function (item) {
                var optionText = item.nombreYapellido;
                $('#profesional').append(new Option(optionText, item.id_prof));
            });
        },
        error: function (error) {
            console.error("Error fetching data: ", error);
        }
    });


});
