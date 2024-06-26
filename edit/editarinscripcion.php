<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Inscripción</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/home.css">
  <link rel="stylesheet" href="../css/form.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<?php
include_once '../config/sesionManager.php';
checkSession();
$perfil = getUserProfile();
?>
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
                <?php if (isUserAdmin()): ?>
                  <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> + </button>
                  <div class="dropdown-menu" aria-labelledby="mesasDropdown">
                    <a class="dropdown-item" href="../add/crearmesaexamen.php">Registrar Mesa de Examen</a>
                    <a class="dropdown-item" href="../add/crearinscripcion.php">Registrar Inscripcion</a>
                    <a class="dropdown-item" href="../add/crearalumno.php">Registrar Alumno</a>
                    <a class="dropdown-item" href="../add/addusuario.php">Registrar Usuarios</a>
                  </div>
                <?php elseif (isUserOperator()): ?>
                  <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> + </button>
                  <div class="dropdown-menu" aria-labelledby="mesasDropdown">
                    <a class="dropdown-item" href="../add/crearinscripcion.php">Registrar Inscripcion</a>
                  </div>
                <?php endif; ?>
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
          <h2 class="card-title text-center mt-4 mb-4"><strong>Modificar Inscripción</strong></h2>
          <?php
          include '../config/db-connection.php';

          $formID = $_POST['id'];
          $consulta = "SELECT i.*, a.nombre AS nombre_alumno, a.apellido AS apellido_alumno, a.dni AS dni_alumno, a.email AS email_alumno, a.telefono AS telefono_alumno, me.fecha AS fecha_mesa, me.materia AS materia_mesa, me.tipo AS tipo_mesa, me.profesor_titular, me.profesor_vocal1, me.profesor_vocal2
                            FROM inscripciones i
                            INNER JOIN alumnos a ON i.id_alumno = a.id_alumno
                            INNER JOIN mesas_examen me ON i.id_mesa = me.id_mesa
                            WHERE i.id_inscripcion='$formID'";

          if (!($resultado = mysqli_query($link, $consulta))) {
            echo "<div class='alert alert-danger' role='alert'>";
            echo "Error: La consulta SQL tiene un problema, verificar.<br>";
            echo "$consulta";
            echo "</div>";
            exit();
          }

          $row = mysqli_fetch_assoc($resultado);
          $id_alumno = $row['id_alumno'];

          $materias_inscritas_consulta = "SELECT id_mesa FROM inscripciones WHERE id_alumno = '$id_alumno'";
          $materias_inscritas_result = mysqli_query($link, $materias_inscritas_consulta);
          $materias_inscritas = [];
          while ($materia = mysqli_fetch_assoc($materias_inscritas_result)) {
            $materias_inscritas[] = $materia['id_mesa'];
          }


          $materias = mysqli_query($link, "SELECT id_mesa, materia FROM mesas_examen");
          $profesortitular = mysqli_query($link, "SELECT id_mesa, profesor_titular FROM mesas_examen");
          $profesorvocal1 = mysqli_query($link, "SELECT id_mesa, profesor_vocal1 FROM mesas_examen");
          $profesorvocal2 = mysqli_query($link, "SELECT id_mesa, profesor_vocal2 FROM mesas_examen");

          ?>
          <form method="post" action="editarinscripcionproceso.php">
            <input type="hidden" name="id" value="<?php echo $row['id_inscripcion']; ?>">

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['nombre_alumno']; ?>" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $row['apellido_alumno']; ?>" readonly>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="dni">DNI:</label>
                <input type="text" class="form-control" id="dni" name="dni" value="<?php echo $row['dni_alumno']; ?>" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email_alumno']; ?>" readonly>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="telefono">Teléfono:</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $row['telefono_alumno']; ?>" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="fecha_inscripcion">Fecha Inscripción:</label>
                <input type="date" class="form-control" id="fecha_inscripcion" name="fecha_inscripcion" value="<?php echo $row['fecha_inscripcion']; ?>" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="condicion_alumno">Condicion Alumno:</label>
                <select class="form-control" id="condicion_alumno" name="condicion_alumno" required>
                  <option value="Regular" <?php echo ($row['condicion_alumno'] == 'Regular') ? 'selected' : ''; ?>>Regular</option>
                  <option value="Libre" <?php echo ($row['condicion_alumno'] == 'Libre') ? 'selected' : ''; ?>>Libre</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="asistencia">Asistencia:</label>
                <select class="form-control" id="asistencia" name="asistencia" required>
                  <option value="Presente" <?php echo ($row['asistencia'] == 'Presente') ? 'selected' : ''; ?>>Presente</option>
                  <option value="Ausente" <?php echo ($row['asistencia'] == 'Ausente') ? 'selected' : ''; ?>>Ausente</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="nota">Nota:</label>
                <input type="number" class="form-control" id="nota" name="nota" max="10" min="1" value="<?php echo $row['nota']; ?>" required>
              </div>
              <div class="form-group col-md-6">
                <label for="fecha_mesa">Fecha Mesa:</label>
                <input type="date" class="form-control" id="fecha_mesa" name="fecha_mesa" value="<?php echo $row['fecha_mesa']; ?>" readonly>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="materia">Materia:</label>
                <select class="form-control" id="materia" name="materia" required>
                  <option value="" disabled>Seleccione una Materia</option>
                  <?php while ($materia = mysqli_fetch_assoc($materias)) : ?>
                    <?php if (!in_array($materia['id_mesa'], $materias_inscritas) || $materia['id_mesa'] == $row['id_mesa']) : ?>
                      <option value="<?php echo $materia['id_mesa']; ?>" <?php echo ($materia['id_mesa'] == $row['id_mesa']) ? 'selected' : ''; ?>>
                        <?php echo $materia['materia']; ?>
                      </option>
                    <?php endif; ?>
                  <?php endwhile; ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="profesor_titular">Profesor Titular:</label>
                <input type="text" class="form-control" id="profesor_titular" name="profesor_titular" value="<?php echo $row['profesor_titular']; ?>" readonly>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="profesor_vocal1">Profesor Vocal 1:</label>
                <input type="text" class="form-control" id="profesor_vocal1" name="profesor_vocal1" value="<?php echo $row['profesor_vocal1']; ?>" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="profesor_vocal2">Profesor Vocal 2:</label>
                <input type="text" class="form-control" id="profesor_vocal2" name="profesor_vocal2" value="<?php echo $row['profesor_vocal2']; ?>" readonly>
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
  <script src="../edit/getMaterias.js"></script>
  <script src="../edit/botoneditinscripcion.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>