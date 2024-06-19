<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listar Alumnos por Materia</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/home.css">
</head>

<body>

  <div class="background">
    <div class="nav-container">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="home.php">Instituto TSDS</a>
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
                  <form method="GET" class="mr-2">
                    <select name="mesas_examen" class="form-control" onchange="this.form.submit()">
                      <?php
                      include '../config/db-connection.php';

                      $consulta = "SELECT * FROM mesas_examen";
                      if (!($resultado = mysqli_query($link, $consulta))) {
                        echo "<p>Error: La consulta SQL tiene un problema, verificar.</p> <br>";
                        echo "<p>$consulta</p>";
                        exit();
                      }
                      ?>
                      <option value="">Selecciona una Materia</option>
                      <?php foreach ($resultado as $examen) : ?>
                        <option value="<?php echo $examen['id_mesa']; ?>" <?php
                                                                          if (isset($_GET['mesas_examen']) && $_GET['mesas_examen'] == $examen['id_mesa']) echo 'selected';
                                                                          ?>>
                          <?php echo $examen['materia']; ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </form>
                  <a class="dropdown-item" href="../list/filtradoprofesores.php">Filtrado por Profesores</a>
                  <a class="dropdown-item" href="home.php">Listado de Alumnos</a>
                  <a class="dropdown-item" href="../list/listadoalumnosporexamen.php">Listar Mesas de Examen con tribunales</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> + </button>
                <div class="dropdown-menu" aria-labelledby="mesasDropdown">
                  <a class="dropdown-item" href="crearmesaexamen.php">Registrar Mesa de Examen</a>
                  <a class="dropdown-item" href="crearincripcion.php">Registrar Inscripcion</a>
                  <a class="dropdown-item" href="crearalumno.php">Registrar Alumno</a>
                  <a class="dropdown-item" href="crearusuario.php">Registrar Usuarios</a>
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

    <div class="container content-container">
      <div class="table-container">
        <h2 class="text-center">Listar Alumnos por Materia</h2>
        <table class="table table-bordered table-hover">
          <thead class="thead-dark">
            <tr>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>DNI</th>
              <th>Email</th>
              <th>Teléfono</th>
              <th>Fecha de Inscripción</th>
              <th>Asistencia</th>
              <th>Nota</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include '../config/db-connection.php';

            if (isset($_GET['mesas_examen']) && $_GET['mesas_examen'] != '') {
              $id_realiza = $_GET['mesas_examen'];

              $db_host = "localhost";
              $db_user = "root";
              $db_pass = "";
              $db_name = "sistemagestionexamenes";

              $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

              if (!$link) {
                echo "Error: no se puede conectar a MYSQL." . PHP_EOL;
                echo "<br>";
                echo "error de depuración: " . mysqli_connect_errno() . PHP_EOL;
                echo "<br>";
                echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
                exit();
              }

              $consulta = "SELECT alumnos.nombre AS nombre_alumno, alumnos.apellido, alumnos.dni, alumnos.email, alumnos.telefono,
       inscripciones.fecha_inscripcion, inscripciones.asistencia, inscripciones.nota
       FROM alumnos
       INNER JOIN inscripciones ON alumnos.id_alumno = inscripciones.id_alumno
       WHERE inscripciones.id_mesa = $id_realiza";

              if (!($resultado = mysqli_query($link, $consulta))) {
                echo "<p>Error: La consulta SQL tiene un problema, verificar.</p> <br>";
                echo "<p>$consulta</p>";
                exit();
              }

              if (mysqli_num_rows($resultado) > 0) {
                while ($row = mysqli_fetch_assoc($resultado)) {
                  echo "<tr>";
                  echo "<td>{$row['nombre_alumno']}</td>";
                  echo "<td>{$row['apellido']}</td>";
                  echo "<td>{$row['dni']}</td>";
                  echo "<td>{$row['email']}</td>";
                  echo "<td>{$row['telefono']}</td>";
                  echo "<td>{$row['fecha_inscripcion']}</td>";
                  echo "<td>{$row['asistencia']}</td>";
                  echo "<td>{$row['nota']}</td>";
                  echo "</tr>";
                }
              } else {
                echo '<tr><td colspan="8" class="text-center">No hay alumnos inscritos en esta materia.</td></tr>';
              }

              mysqli_free_result($resultado);
              mysqli_close($link);
            } else {
              echo '<tr><td colspan="8" class="text-center">Selecciona una materia para ver los alumnos inscritos.</td></tr>';
            }
            ?>

          </tbody>
        </table>
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
          <p class="mb-0">Mes: Mayo - Año: 2024</p>
        </div>
      </div>
    </div>
  </footer>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>