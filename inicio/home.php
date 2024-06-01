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
  <title>Inicio</title>
  <!--icono pestana-->
  <link rel="icon" href="../img/logo.png" type="image/x-icon">
  <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- Font Awesome para los iconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="../estilos/styleGeneral.css">
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
        </div>
      </div>
      <!--CARD -->

      <!--SEGUNDA CARD -->
      <div class="col d-flex justify-content-center">
        <a href="../turnos/turnos.php">
          <div class="card h-100">
            <div class="first-content">
              <img src="../img/prueba.png" class="img-fluid" alt="">
            </div>
            <div class="third-content">
              <h3 class="mt-3">Agendas</h3>
            </div>
          </div>
        </a>
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
        </div>
      </div>
      <!--CARD -->

      <!-- SEXTA CARD -->
      <div class="col d-flex justify-content-center">
        <a href="../seccionAjustes/ajustes.php" class="card-link">
          <div class="card h-100">
            <div class="first-content">
              <img src="../img/configuracion.png" class="img-fluid" alt="">
            </div>
            <div class="third-content">
              <h3 class="mt-3">Ajustes</h3>
            </div>
          </div>
        </a>
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