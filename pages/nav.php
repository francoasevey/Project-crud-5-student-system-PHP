<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Alumnos y Mesas de Examen</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Instituto TSDS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Inicio</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="mesasDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Mesas de Examen
        </a>
        <div class="dropdown-menu" aria-labelledby="mesasDropdown">
          <a class="dropdown-item" href="#">Crear Mesa de Examen</a>
          <a class="dropdown-item" href="#">Listar Mesas de Examen</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="inscripcionesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Inscripciones
        </a>
        <div class="dropdown-menu" aria-labelledby="inscripcionesDropdown">
          <a class="dropdown-item" href="#">Inscribir Alumno</a>
          <a class="dropdown-item" href="#">Listar Inscripciones</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="alumnosDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Gestión de Alumnos
        </a>
        <div class="dropdown-menu" aria-labelledby="alumnosDropdown">
          <a class="dropdown-item" href="#">Agregar Alumno</a>
          <a class="dropdown-item" href="#">Listar Alumnos</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="usuariosDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Control de Acceso
        </a>
        <div class="dropdown-menu" aria-labelledby="usuariosDropdown">
          <a class="dropdown-item" href="#">Crear Usuario</a>
          <a class="dropdown-item" href="#">Listar Usuarios</a>
          <a class="dropdown-item" href="#">Modificar Usuario</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="listadosDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Listados
        </a>
        <div class="dropdown-menu" aria-labelledby="listadosDropdown">
          <a class="dropdown-item" href="#">Mesas de Exámenes Habilitadas</a>
          <a class="dropdown-item" href="#">Alumnos por Mesa</a>
          <a class="dropdown-item" href="#">Mesas por DNI</a>
          <a class="dropdown-item" href="#">Listado de Alumnos</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Cerrar Sesión</a>
      </li>
    </ul>
  </div>
</nav>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
