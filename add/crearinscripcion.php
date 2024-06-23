<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carga Nueva Inscripcion</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/home.css">
  <link rel="stylesheet" href="../css/form.css">
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
                </div>
              </li>
              <li class="nav-item dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> + </button>
                <div class="dropdown-menu" aria-labelledby="mesasDropdown">
                  <a class="dropdown-item" href="../add/crearmesaexamen.php">Registrar Mesa de Examen</a>
                  <a class="dropdown-item" href="../add/crearinscripcion.php">Registrar Inscripcion</a>
                  <a class="dropdown-item" href="../add/crearalumno.php">Registrar Alumno</a>
                  <a class="dropdown-item" href="../add/crearusuario.php">Registrar Usuarios</a>
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
                <a class="nav-link" href="#">Cerrar Sesión</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
    <div class="container">
      <div class="table-container">
        <div class="container">
          <h2 class="card-title text-center mt-4 mb-4"><strong>Crear Inscripción</strong></h2>
          <?php
          include '../config/db-connection.php';
          $consultaAlumnos = "SELECT id_alumno, nombre, apellido, dni, email, telefono FROM alumnos";
          $consultaMaterias = "SELECT id_mesa, fecha, materia, tipo, profesor_titular, profesor_vocal1, profesor_vocal2 FROM mesas_examen";

          $alumnosNombre = mysqli_query($link, $consultaAlumnos);
          $materiasNombre = mysqli_query($link, $consultaMaterias);

          if (!$alumnosNombre || !$materiasNombre) {
            echo "<div class='alert alert-danger' role='alert'>";
            echo "Error: La consulta SQL tiene un problema, verificar.<br>";
            echo mysqli_error($link);
            echo "</div>";
            exit();
          }
          ?>
          <form method="post" action="editarinscripcionproceso.php">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="nombre">Nombre:</label>
                <select class="form-control" id="nombre" name="nombre" required onchange="cargarDatosAlumno()">
                  <option value="" disabled selected>Seleccione un Alumno</option>
                  <?php while ($alumno = mysqli_fetch_assoc($alumnosNombre)) : ?>
                    <option value="<?php echo $alumno['id_alumno']; ?>">
                      <?php echo $alumno['nombre']; ?>
                    </option>
                  <?php endwhile; ?>
                </select>
              </div>
              <div class="form-group col-sm-6">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" readonly>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="dni">DNI:</label>
                <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" readonly>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="telefono">Teléfono:</label>
                <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Telefono" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="fecha_inscripcion">Fecha Inscripción:</label>
                <input type="date" class="form-control" id="fecha_inscripcion" name="fecha_inscripcion" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="condicion_alumno">Condicion Alumno:</label>
                <select class="form-control" id="condicion_alumno" name="condicion_alumno" required>
                  <option value="" disabled selected>Condicion Alumno</option>
                  <option value="Regular">Regular</option>
                  <option value="Libre">Libre</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="asistencia">Asistencia:</label>
                <select class="form-control" id="asistencia" name="asistencia" required>
                  <option value="" disabled selected>Asistencia</option>
                  <option value="Presente">Presente</option>
                  <option value="Ausente">Ausente</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="nota">Nota:</label>
                <input type="number" class="form-control" id="nota" name="nota" max="10" min="1" placeholder="Nota" required>
              </div>
              <div class="form-group col-md-6">
                <label for="materia">Materia:</label>
                <select class="form-control" id="materia" name="materia" required onchange="cargarDatosMateria()">
                  <option value="" disabled selected>Seleccione una Materia</option>
                  <?php while ($materia = mysqli_fetch_assoc($materiasNombre)) : ?>
                    <option value="<?php echo $materia['id_mesa']; ?>">
                      <?php echo $materia['materia']; ?>
                    </option>
                  <?php endwhile; ?>
                </select>
              </div>

            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="fecha">Fecha Mesa:</label>
                <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Fecha" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="profesor_titular">Profesor Titular:</label>
                <input type="text" class="form-control" id="profesor_titular" name="profesor_titular" placeholder="Profesor Titular" readonly>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="profesor_vocal1">Profesor Vocal 1:</label>
                <input type="text" class="form-control" id="profesor_vocal1" name="profesor_vocal1" placeholder="Profesor Vocal 1" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="profesor_vocal2">Profesor Vocal 2:</label>
                <input type="text" class="form-control" id="profesor_vocal2" name="profesor_vocal2" placeholder="Profesor Vocal 2" readonly>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6 text-center">
                <button type="submit" class="btn btn-primary" id="botonProcesarInscripcion" disabled>Procesar</button>
              </div>
              <div class="form-group col-md-6 text-center">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='../views/home.php'">Volver al Listado</button>
              </div>
            </div>
          </form>
        </div>
        <script>
          // Función para cargar las materias disponibles para el alumno seleccionado
          function cargarMateriasDisponibles(alumnoId) {
            fetch('getMateriasDisponibles.php?id=' + alumnoId)
              .then(response => response.json())
              .then(data => {
                var selectMateria = document.getElementById('materia');
                selectMateria.innerHTML = ''; // Limpiar opciones actuales

                // Agregar la opción predeterminada
                var optionDefault = document.createElement('option');
                optionDefault.value = '';
                optionDefault.textContent = 'Seleccione una Materia';
                optionDefault.disabled = true;
                optionDefault.selected = true;
                selectMateria.appendChild(optionDefault);

                // Agregar las opciones de materias disponibles
                data.forEach(materia => {
                  var option = document.createElement('option');
                  option.value = materia.id_mesa;
                  option.textContent = materia.materia;
                  selectMateria.appendChild(option);
                });
              })
              .catch(error => console.error('Error:', error));
          }

          // Función para cargar los datos de la materia seleccionada
          function cargarDatosMateria() {
            var materiaId = document.getElementById('materia').value;
            fetch('getMateriaData.php?id=' + materiaId)
              .then(response => response.json())
              .then(data => {
                document.getElementById('fecha').value = data.fecha;
                document.getElementById('profesor_titular').value = data.profesor_titular;
                document.getElementById('profesor_vocal1').value = data.profesor_vocal1;
                document.getElementById('profesor_vocal2').value = data.profesor_vocal2;
              })
              .catch(error => console.error('Error:', error));
          }
          // Función para cargar los datos del alumno seleccionado
          function cargarDatosAlumno() {
            var alumnoId = document.getElementById('nombre').value;
            fetch('getAlumnoData.php?id=' + alumnoId)
              .then(response => response.json())
              .then(data => {
                document.getElementById('apellido').value = data.apellido;
                document.getElementById('dni').value = data.dni;
                document.getElementById('email').value = data.email;
                document.getElementById('telefono').value = data.telefono;
              })
              .catch(error => console.error('Error:', error));

            // Llamar a la función para cargar las materias disponibles para el alumno
            cargarMateriasDisponibles(alumnoId);
          }
        </script>
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

  <script src="../add/getAlumnoAdata.js"></script>
  <script src="../add/getAlumnos.js"></script>
  <script src="../add/getMateriasDisponibles.php"></script>
  <!--
    <script src="../add/getMateriasData.php"></script>
    <script src="../add/getMaterias.js"></script>
  -->
  <script src="../add/botoneditinscripcion.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>