<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carga Nueva Mesa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/home.css">
  <link rel="stylesheet" href="../css/formulario.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
  <div class="background">
    <div class="nav-container">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="../views/home.php">Instituto TSDS</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="listadosDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Listados
                </a>
                <div class="dropdown-menu" aria-labelledby="listadosDropdown">
                  <a class="dropdown-item" href="../list/listadomesashabilitadas.php">Mesas de Exámenes Habilitadas</a>
                  <a class="dropdown-item" href="../list/listadoalumnosinscriptos.php">Listado de inscripciones</a>
                  <a class="dropdown-item" href="../list/filtradomaterias.php">Filtrado por Materias</a>
                  <a class="dropdown-item" href="../list/filtradoprofesores.php">Filtrado por Profesores</a>
                  <a class="dropdown-item" href="../views/home.php">Listado de Alumnos</a>
                  <a class="dropdown-item" href="../list/listadoalumnosporexamen.php">Listar Mesas de Examen con tribunales</a>
                  <a class="dropdown-item" href="../list/listausuarios.php">Listar Usuarios</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> + </button>
                <div class="dropdown-menu" aria-labelledby="mesasDropdown">
                  <a class="dropdown-item" href="../add/crearmesaexamen.php">Registrar Mesa de Examen</a>
                  <a class="dropdown-item" href="../add/crearinscripcion.php">Registrar Inscripcion</a>
                  <a class="dropdown-item" href="../add/crearalumno.php">Registrar Alumno</a>
                  <a class="dropdown-item" href="../add/addusuario.php">Registrar Usuarios</a>
                </div>
              </li>
              <li class="nav-item">
                <form method="post" action="../views/busqueda.php" class="form-inline my-2 my-lg-0">
                  <input class="form-control mr-sm-2" type="search" placeholder="Buscar" name="buscar" aria-label="Buscar">
                  <!--<select class="form-control mr-sm-2" name="filtro">
                  <option value="nombre_persona">Nombre</option>
                  <option value="dni">DNI</option>
                  <option value="nombre_deporte">Materia</option>
                  <option value="nota">Nota</option>
                </select>-->
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                </form>
              </li>
              <li class="nav-item">
                <?php include '../config/sesionOpen.php'; ?>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
    <div class="container">
      <div class="table-container">
        <div class="container">
          <h2 class="card-title text-center mt-4 mb-4"><strong>Crear Mesa</strong></h2>
          <form method="post" action="crearmesaproceso.php">
            <div class="form-row">
              <div class="form-group col-sm-6">
                <label for="fecha">Fecha:</label>
                <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Fecha" required>
              </div>
              <div class="form-group col-sm-6">
                <label for="materia">Materia:</label>
                <input type="text" class="form-control" id="materia" name="materia" placeholder="Materia" required>
              </div>
            </div>
            <div class="form-row">
              <!--<div class="form-group col-sm-6">
                <label for="tipo">Tipo:</label>
                <select class="form-control" id="tipo" name="tipo" required>
                  <option value="" disabled selected>Tipo</option>
                  <option value="regular">Regular</option>
                  <option value="libre">Libre</option>
                </select>
              </div>-->
              <div class="form-group col-md-6">
                <label for="profesor_titular">Profesor Titular:</label>
                <input type="text" class="form-control" id="profesor_titular" name="profesor_titular" placeholder="Profesor Titular" required>
              </div>
              <div class="form-group col-md-6">
                <label for="profesor_vocal1">Profesor Vocal 1:</label>
                <input type="text" class="form-control" id="profesor_vocal1" name="profesor_vocal1" placeholder="Profesor Vocal 1" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="profesor_vocal2">Profesor Vocal 2:</label>
                <input type="text" class="form-control" id="profesor_vocal2" name="profesor_vocal2" placeholder="Profesor Vocal 2" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6 text-center">
                <button type="submit" id="botonProcesar" class="btn btn-primary" disabled>Procesar</button>
              </div>
              <div class="form-group col-md-6 text-center">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='../views/home.php'">Volver al Listado</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <footer class="text-center">

      <div class="container">
        <div class="row">
          <div class="col">
            <img src="imagen.jpeg" alt="Imagen de perfil" class="img-thumbnail rounded-circle">
            <p class="mb-0">Desarrollador: Franco Asevey</p>
            <p class="mb-0">Materia: Programación 3</p>
            <p class="mb-0">Carrera: Tecnicatura Superior en Desarrollo de Software</p>
            <p class="mb-0">Año: 2024</p>
          </div>
        </div>
      </div>
    </footer>
  </div>

  <script src="../add/botoncreatemesa.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>