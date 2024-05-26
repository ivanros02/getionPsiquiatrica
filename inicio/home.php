<?php
// Inicia la sesión
session_start();

// Verifica si el usuario ha iniciado sesión
if (isset($_SESSION['usuario'])) {
  // El usuario ha iniciado sesión, puedes mostrar contenido para usuarios autenticados o ejecutar acciones específicas
} else {
  header("Location: ../index.php");
}

// Lógica para cerrar sesión
if (isset($_GET['cerrar_sesion'])) {
  // Destruye todas las variables de sesión
  session_destroy();
  // Redirige al usuario a la página de inicio o a donde desees
  header("Location: ../index.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar Vertical</title>
  <!--icono pestana-->
  <link rel="icon" href="../img/logo.png" type="image/x-icon">
  <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- Font Awesome para los iconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Custom CSS -->
  <style>
    :root {
      --primary-color: #10174a;
      /* Define tu color aquí */
    }

    body,
    html {
      background-color: #f2f2f2;
    }

    a {
      text-decoration: none !important;
    }


    .navbar {
      background-color: var(--primary-color) !important;
    }


    .card {
      width: 10rem !important;
      height: 10rem !important;
      background: #b3d7ff !important;
      /* Tonalidad más clara del color del navbar */
      transition: all 0.4s !important;
      border-radius: 10px;
      font-size: 30px;
      font-weight: 900;
    }


    .first-content img {
      max-width: 50%;
      height: auto;
      display: block;
    }

    .card:hover {
      border-radius: 15px;
      cursor: pointer;
      transform: scale(1.2);
      background: rgb(103, 151, 255);
    }


    .first-content h3 {
      margin-top: 10px;
      /* Espacio entre la imagen y el h3 */
    }

    .first-content {
      height: 100%;
      width: 100%;
      transition: all 0.4s;
      display: flex;
      justify-content: center;
      align-items: center;
      opacity: 1;
      border-radius: 15px;
      position: relative;
      text-align: center;
      /* Alinear el contenido al centro */
    }

    .card:hover .first-content {
      height: 0px;
      opacity: 0;
    }

    .third-content {
      height: 100%;
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      opacity: 1;
      border-radius: 15px;
      position: relative;
      text-align: center;
      /* Alinear el contenido al centro */
    }

    .third-content h3 {
      margin-top: 10px;
      /* Espacio entre la imagen y el h3 */
    }

    .card:hover .third-content {
      opacity: 0;
    }

    .second-content {
      opacity: 0;
      display: flex;
      text-align: center;
      border-radius: 15px;
      transition: all 0.4s;
      font-size: 1rem;
      text-decoration: none !important;

    }



    .card:hover .second-content {
      opacity: 1;
      height: 100%;
      font-size: 1rem;
      transform: rotate(0deg);
      text-decoration: none !important;
      flex-direction: column;
      /* Alinea los elementos en columna */
      justify-content: center;
      /* Centra los elementos verticalmente */
      align-items: center;
      /* Centra los elementos horizontalmente */
      margin-top: -10rem;
    }


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
  <!-- Just an image -->
  <nav class="navbar bg-body-tertiary">
    <div class="container d-flex justify-content-center">
      <a class="navbar-brand" href="#">
        <img src="../img/logo.png" height="120" alt="Medical Logo" loading="lazy" />
      </a>
    </div>
  </nav>

  <!-- Cards Container -->
  <div class="container my-5">
    <div class="row row-cols-1 row-cols-md-3 g-3 justify-content-center">
      <!-- Reducir el valor de g a 2 para reducir la distancia entre las tarjetas -->
      <!--PRIMERA CARD -->
      <div class="col d-flex justify-content-center">
        <div class="card h-100">
          <div class="first-content">
            <img src="../img/pacientes.png" class="img-fluid" alt="">
          </div>
          <div class="third-content">
            <h3 class="mt-3">Pacientes</h3>
          </div>
          <div class="second-content">
            <a href="../turnos/turnos.php">Agendar turno</a>
            <a href="../turnos/turnos.php">Agendar turno</a>
            <a href="../turnos/turnos.php">Agendar turno</a>
          </div>
        </div>
      </div>
      <!--CARD -->

      <!--SEGUNDA CARD -->
      <div class="col d-flex justify-content-center">
        <div class="card h-100">
          <div class="first-content">
            <img src="../img/turnos.png" class="img-fluid" alt="">
          </div>
          <div class="third-content">
            <h3 class="mt-3">Agendas</h3>
          </div>
          <div class="second-content">
            <a href="../turnos/turnos.php">Agendar turno</a>
          </div>
        </div>
      </div>
      <!--CARD -->

      <!-- TERCERA CARD -->
      <div class="col d-flex justify-content-center">
        <div class="card h-100">
          <div class="first-content">
            <img src="../img/estadisticas.png" class="img-fluid" alt="">
          </div>
          <div class="third-content">
            <h3 class="mt-3">Estadisticas</h3>
          </div>
          <div class="second-content">
            <span>Second</span>
          </div>
        </div>
      </div>
      <!--CARD -->

      <!-- CUARTA CARD -->
      <div class="col d-flex justify-content-center">
        <div class="card h-100">
          <div class="first-content">
            <img src="../img/caja.png" class="img-fluid" alt="">
          </div>
          <div class="third-content">
            <h3 class="mt-3">Caja</h3>
          </div>
          <div class="second-content">
            <span>Second</span>
          </div>
        </div>
      </div>
      <!--CARD -->

      <!-- QUINTA CARD -->
      <div class="col d-flex justify-content-center">
        <div class="card h-100">
          <div class="first-content">
            <img src="../img/gastos.png" class="img-fluid" alt="">
          </div>
          <div class="third-content">
            <h3 class="mt-3">Gastos</h3>
          </div>
          <div class="second-content">
            <span>Second</span>
          </div>
        </div>
      </div>
      <!--CARD -->

      <!-- SEXTA CARD -->
      <div class="col d-flex justify-content-center">
        <div class="card h-100">
          <div class="first-content">
            <img src="../img/configuracion.png" class="img-fluid" alt="">
          </div>
          <div class="third-content">
            <h3 class="mt-3">Ajustes</h3>
          </div>
          <div class="second-content">
            <span>Second</span>
          </div>
        </div>
      </div>
      <!--CARD -->
    </div>
  </div>





  <!-- Pie de página -->
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

  <!-- Bootstrap JS (opcional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>