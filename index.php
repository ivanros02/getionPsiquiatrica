<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión WW</title>
    <!--icono pestana-->
    <link rel="icon" href="./img/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./estilos/styleIndex.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .footer-logo-text {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
        }

        footer.bg-dark {
            background-color: transparent !important;
            padding-top: 10rem;
        }


        .footer-logo-text img {
            margin-right: 0.5rem;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="text-center my-4">
                    <img src="./img/logo.png" alt="Logo MEDICAL" class="img-fluid" style="max-width: 150px;">
                </div>
                <div class="card">
                    <div class="card-header">Iniciar sesión</div>
                    <div class="card-body">
                        <?php
                        // Verifica si hay un error de credenciales
                        if (isset($_GET['error'])) {
                            if ($_GET['error'] == "credenciales_incorrectas") {
                                echo "<script>alert('Usuario o contraseña incorrectos.');</script>";
                            } elseif ($_GET['error'] == "usuario_no_encontrado") {
                                echo "<script>alert('Usuario o contraseña incorrectos.');</script>";
                            }
                        }
                        ?>
                        <form action="./login/login.php" method="POST">
                            <div class="form-group">
                                <label for="usuario">Usuario:</label>
                                <input type="text" name="usuario" id="usuario" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="clave">Contraseña:</label>
                                <input type="password" name="clave" id="clave" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                            <a href="./login/admin.php">Soy administrador</a>
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
                    <img src="./img/logoWSS.png" alt="Logo" class="img-fluid" style="max-height: 50px;">
                    <p class="mb-0">&copy; 2024 WorldsoftSystems. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>