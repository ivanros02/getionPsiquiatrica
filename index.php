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
   
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1>Bienvenido a Gestión Psiquiátrica</h1>
                <div class="card">
                    <div class="card-header">Iniciar sesión</div>
                    <div class="card-body">
                        <?php
                        // Verifica si hay un error de credenciales
                        if(isset($_GET['error'])) {
                            if($_GET['error'] == "credenciales_incorrectas") {
                                echo "<script>alert('Usuario o contraseña incorrectos.');</script>";
                            } elseif($_GET['error'] == "usuario_no_encontrado") {
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
</body>
</html>
