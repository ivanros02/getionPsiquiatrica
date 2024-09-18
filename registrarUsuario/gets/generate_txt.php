<?php
// Conexión a la base de datos (modifica los datos de conexión según tu configuración)
include('../../conexion.php');

// Verifica la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener los datos de la tabla `parametro_sistema`
$sql = "SELECT cuit, inst, u_efect, c_pami, c_interno, mail, dir, puerta FROM parametro_sistema";
$result = $conn->query($sql);

// Verifica si hay resultados
if ($result->num_rows > 0) {
    // Obtén los datos de la fila
    $row = $result->fetch_assoc();

    // Genera la fecha actual
    $fechaActual = date('d/m/Y');

    // Calcula el mes anterior en formato 08-24, por ejemplo
    $mesActual = date('m');
    $anoActual = date('Y');
    $mesAnterior = $mesActual - 1;
    if ($mesAnterior < 10) {
        $mesAnterior = '0' . $mesAnterior; // Agregar 0 si es menor de 10
    }
    $periodo = $mesAnterior . '-' . $anoActual;

    // Definir el rango de fechas del mes anterior
    $fechaInicio = date('Y-m-d', strtotime("first day of -1 month"));
    $fechaFin = date('Y-m-d', strtotime("last day of -1 month"));

    // Crear la primera línea dinámica del archivo
    $cuit = $row['cuit'];
    $inst = $row['inst'];
    $u_efect = $row['u_efect'];
    $c_pami = $row['c_pami'];
    $c_interno = $row['c_interno'];  // Nombre dinámico del archivo
    $mail = $row['mail'];
    $dir = $row['dir'];
    $puerta = $row['puerta'];

    // Primera línea dinámica
    $linea1 = "CABECERA\n";
    $linea2 = "$cuit;;;$fechaActual;$periodo;$inst;2;$u_efect;$c_pami\n";
    // Tercera línea con el texto 'PROFESIONAL'
    $linea3 = "PROFESIONAL\n";
    // Contenido inicial del archivo
    $contenido = $linea1 . $linea2 . $linea3;

    // Consulta SQL para obtener los profesionales con los nuevos campos
    $sqlProfesionales = "SELECT nombreYapellido, id_especialidad, matricula_n, matricula_p, tipo_doc, nro_doc FROM profesional";
    $resultProfesionales = $conn->query($sqlProfesionales);

    // Verifica si hay resultados en la tabla `profesional`
    if ($resultProfesionales->num_rows > 0) {
        // Itera sobre cada profesional y genera una nueva línea
        while ($profesional = $resultProfesionales->fetch_assoc()) {
            $nombreProfesional = $profesional['nombreYapellido'];
            $idEspecialidad = $profesional['id_especialidad'];
            $matriculaN = $profesional['matricula_n'];
            $matriculaP = $profesional['matricula_p'];
            $tipoDoc = $profesional['tipo_doc'];
            $nroDoc = $profesional['nro_doc'];

            // Guarda los datos en el array
            $profesionalesArray[] = array(
                'matriculaN' => $matriculaN
            );

            // Genera la línea para cada profesional
            $lineaProfesional = ";;;0;"
                . str_pad($nombreProfesional, 50) . ";"
                . $idEspecialidad . ";"
                . str_pad($matriculaN, 7) . ";"
                . str_pad($matriculaP, 7) . ";"
                . $tipoDoc . ";"
                . $nroDoc . ";;SIN SUMINISTRAR;0;;;;\n";

            // Agrega la línea al contenido
            $contenido .= $lineaProfesional;
        }
    } else {
        $contenido .= "No se encontraron profesionales.\n";
    }

    // Agregar la línea "PRESTADOR" después de todos los profesionales
    $contenido .= "PRESTADOR\n";
    $contenido .= ";$cuit;;;0;;;2;;0;$mail;01/01/2007;;;;0;0;0;$inst;$dir;$puerta;;;;;\n";

    $contenido .= "REL_PROFESIONALESXPRESTADOR\n";

    // Iterar sobre los profesionales para agregar las líneas correspondientes
    foreach ($profesionalesArray as $prof) {
        $matriculaN = $prof['matriculaN'];
        $contenido .= ";$cuit;$matriculaN;0;0;\n";
    }

    $contenido .= "BOCA_ATENCION\n";

    // Consulta SQL para obtener los profesionales con los nuevos campos
    $sqlBocas = "SELECT boca,puerta FROM bocas_atencion";
    $resultBocas = $conn->query($sqlBocas);

    // Variable contador para incrementar el valor
    $contador = 1;

    // Verifica si hay resultados en la tabla `bocas_atencion`
    if ($resultBocas->num_rows > 0) {
        // Itera sobre cada boca y genera una nueva línea
        while ($row = $resultBocas->fetch_assoc()) {
            $boca = $row['boca'];
            $puerta = $row['puerta'];

            // Genera la línea para cada boca de atención
            $lineaBoca = ";$cuit;;0;$contador;20;$boca;$puerta;;;;\n";

            // Agrega la línea al contenido
            $contenido .= $lineaBoca;

            // Incrementa el contador
            $contador++;
        }
    } else {
        $contenido .= "No se encontraron bocas de atención.\n";
    }

    $contenido .= "REL_MODULOSXPRESTADOR\n";

    // Definir el valor base de los códigos
    $valores = [500, 503, 506, 508, 509, 522];

    // Recorre cada valor y genera la línea correspondiente
    foreach ($valores as $valor) {
        $contenido .= ";$cuit;;0;$valor;\n";
    }
    ;

    $contenido .= "BENEFICIO\n";

    // Consulta SQL para obtener los profesionales con los nuevos campos
    $sqlBenefs = "SELECT DISTINCT p.*
                 FROM paciente p
                 LEFT JOIN practicas practs ON p.id = practs.id_paciente
                 WHERE  practs.fecha BETWEEN '$fechaInicio' AND '$fechaFin' 
                 ";
    $resultBenef = $conn->query($sqlBenefs);

    // Verifica si hay resultados en la tabla `bocas_atencion`
    if ($resultBenef->num_rows > 0) {
        // Itera sobre cada boca y genera una nueva línea
        while ($row = $resultBenef->fetch_assoc()) {
            $benef = $row['benef'];
            $parentesco = $row['parentesco'];
            $admision = $row['admision'];

            // Combina benef y parentesco sin espacio ni paréntesis
            $benefYParentesco = "$benef$parentesco"; // Combina directamente los valores

            // Formatea la fecha en 'dd/mm/yyyy'
            $fechaFormateada = date('d/m/Y', strtotime($admision));

            // Genera la línea para cada registro con el formato deseado
            $lineaBenef = ";;;$benefYParentesco;;;1;$fechaFormateada\n";

            $contenido .= $lineaBenef;

        }
    } else {
        $contenido .= "No se encontraron benefs de atención.\n";
    }

    $contenido .= "AFILIADO\n";

    // Consulta SQL para obtener los profesionales con los nuevos campos
    $sqlPacis = "SELECT DISTINCT p.*
                 FROM paciente p
                 LEFT JOIN practicas practs ON p.id = practs.id_paciente
                 WHERE  practs.fecha BETWEEN '$fechaInicio' AND '$fechaFin' 
                 ";
    $resultPaci = $conn->query($sqlPacis);

    // Verifica si hay resultados en la tabla `bocas_atencion`
    if ($resultPaci->num_rows > 0) {
        // Itera sobre cada boca y genera una nueva línea
        while ($row = $resultPaci->fetch_assoc()) {
            $nombre = $row['nombre'];
            $tipo_doc = $row['tipo_doc'];
            $nro_doc = $row['nro_doc'];
            $fecha_nac = $row['fecha_nac'];
            $sexo = $row['sexo'];
            $benef = $row['benef'];
            $parentesco = $row['parentesco'];

            // Formatea la fecha en 'dd/mm/yyyy'
            $fechaFormateada = date('d/m/Y', strtotime($fecha_nac));

            // Asigna 'M' o 'F' dependiendo del valor de $sexo
            $sexoFormateado = '';
            if (strtolower($sexo) == 'masculino') {
                $sexoFormateado = 'M';
            } elseif (strtolower($sexo) == 'femenino') {
                $sexoFormateado = 'F';
            } else {
                $sexoFormateado = 'O'; // 'O' para otros géneros
            }

            // Genera la línea para cada registro con el formato deseado
            $lineaPaci = "$nombre;$tipo_doc;$nro_doc;;;;0;0;;;;;$fechaFormateada;$sexoFormateado;;;$benef;$parentesco;;;;;;;;\n";

            $contenido .= $lineaPaci;

        }
    } else {
        $contenido .= "No se encontraron pacientes .\n";
    }

    $contenido .= "PRESTACIONES\n";

    // Consulta SQL para obtener los profesionales con los nuevos campos id_prof
    $sqlAmbulatorioPsi = "SELECT DISTINCT p.*, prof.matricula_n AS matricula_prof, mP.fecha AS fecha_modalidad, tA.codigo AS tipo_afiliado, m.codigo AS modalidad, e.fecha_egreso AS fecha_egreso ,tE.codigo AS tipo_egreso
                 FROM paciente p
                 LEFT JOIN practicas practs ON p.id = practs.id_paciente
                 LEFT JOIN profesional prof ON prof.id_prof = p.id_prof
                 LEFT JOIN paci_modalidad mP ON mP.id_paciente = p.id
                 LEFT JOIN modalidad m ON m.id = mP.modalidad
                 LEFT JOIN egresos e ON e.id_paciente = p.id
                 LEFT JOIN tipo_afiliado tA ON tA.id = p.tipo_afiliado
                 LEFT JOIN tipo_egreso tE ON tE.id = e.motivo
                 WHERE  practs.fecha BETWEEN '$fechaInicio' AND '$fechaFin' 
                 ";
    $resultPaciAmbulatorioPsi = $conn->query($sqlAmbulatorioPsi);

    // Verifica si hay resultados en la tabla `bocas_atencion`
    if ($resultPaciAmbulatorioPsi->num_rows > 0) {
        // Itera sobre cada boca y genera una nueva línea
        while ($row = $resultPaciAmbulatorioPsi->fetch_assoc()) {
            $matricula_prof = $row['matricula_prof'];
            $fecha_modalidad = $row['fecha_modalidad'];
            $tipo_afiliado = $row['tipo_afiliado'];
            $modalidad = $row['modalidad'];
            $fecha_egreso = $row['fecha_egreso'];
            $tipo_egreso = $row['tipo_egreso'];

            // Si fecha_egreso está vacía, asigna fechaFin y tipo_egreso como 8
            if (empty($fecha_egreso)) {
                $fecha_egreso = $fechaFin;  // Asigna fechaFin a fecha_egreso
                $tipo_egreso = 8;  // Establece tipo_egreso como 8
            }

            // Formatea la fecha en 'dd/mm/yyyy'
            $fechaFormateada_modalidad = date('d/m/Y', strtotime($fecha_modalidad));
            $fechaFormateada_egreso_amb = date('d/m/Y', strtotime($fecha_egreso));

            $contenido .= "AMBULATORIOPSI \n";

            // Genera la línea para cada registro con el formato deseado
            $lineaAmbulatorioPsi = "$cuit;;$matricula_prof;0;0;0;1;0;$fechaFormateada_modalidad;;;$tipo_afiliado;;$modalidad;$benef;$parentesco;$fechaFormateada_egreso_amb;$tipo_egreso\n";

            $contenido .= $lineaAmbulatorioPsi;

            $contenido .= "REL_DIAGNOSTICOSXAMBULATORIOPSI\n";
            
            $contenido .= "REL_PRACTICASREALIZADASXAMBULATORIOPSI\n";
            
            

            $contenido .= "FIN AMBULATORIOPSI\n";

        }
    } else {
        $contenido .= "No se encontraron pacientes .\n";
    }


    // Generar la respuesta JSON con el nombre del archivo y el contenido
    $response = array(
        'filename' => $c_interno . ".txt",  // Nombre dinámico del archivo
        'content' => $contenido
    );

    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');
    echo json_encode($response);

} else {
    // Si no hay datos en la tabla
    $response = array('error' => 'No se encontraron datos en la tabla de parámetros.');
    header('Content-Type: application/json');
    echo json_encode($response);
}

$conn->close();
?>