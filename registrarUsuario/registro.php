<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Botones y Modal</title>
    <!--icono pestana-->
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        /* Estilo para centrar los botones */
        .center-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            gap: 20px;
        }
    </style>
</head>

<body>

    <!-- Contenedor de botones -->
    <div class="center-buttons">
        <button class="btn btn-primary" id="generateTxt">Generar TXT</button>
        <button class="btn btn-success" data-toggle="modal" data-target="#registroModal">Registrar Usuarios</button>
    </div>

    <!-- Modal para el registro de usuarios -->
    <div class="modal fade" id="registroModal" tabindex="-1" role="dialog" aria-labelledby="registroModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registroModalLabel">Registro de un nuevo usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario de registro de usuario -->
                    <form action="registrar.php" method="POST">
                        <div class="form-group">
                            <label for="usuario">Usuario:</label>
                            <input type="text" name="usuario" id="usuario" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="clave">Contraseña:</label>
                            <input type="password" name="clave" id="clave" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Crear usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>

        //TXT

        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('generateTxt').addEventListener('click', function () {
                // Hacer la solicitud al servidor para obtener los datos
                fetch('./gets/generate_txt.php')
                    .then(response => response.json())  // Convertir la respuesta en JSON
                    .then(data => {
                        // Crear un enlace temporal para descargar el archivo
                        const element = document.createElement('a');
                        const file = new Blob([data.content], { type: 'text/plain' });
                        element.href = URL.createObjectURL(file);
                        element.download = data.filename;  // Usar el nombre de archivo dinámico
                        document.body.appendChild(element);
                        element.click();
                        document.body.removeChild(element);
                    });
            });
        });

    </script>

</body>

</html>