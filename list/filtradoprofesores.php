<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listar Alumnos por Profesores</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #f8f9fa;
    }

    .table-container {
      margin-top: 50px;
    }

    footer {
      background-color: #343a40;
      color: white;
      padding: 20px 0;
    }

    footer img {
      width: 45px;
      height: 45px;
      border-radius: 50%;
    }
  </style>
</head>

<body>

  <div class="container table-container">
    <h2 class="text-center">Listar Alumnos por Profesores</h2>
    <form method="post" action="busqueda.php" class="form-inline justify-content-center mb-4">
      <input class="form-control mr-sm-2 w-25" type="search" placeholder="Buscar por nombre o DNI" aria-label="Buscar" name="buscar">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>

    <div class="d-flex justify-content-center mb-4">
      <form action="listapersona.php" class="mr-2">
        <button type="submit" class="btn btn-info">Personas</button>
      </form>
      <form action="listardeporte.php" class="mr-2">
        <button type="submit" class="btn btn-info">Deportes</button>
      </form>
      <form method="GET" class="mr-2">
        <select name="profesor" class="form-control" onchange="this.form.submit()">
          <?php
          include '../config/db-connection.php';

          $consulta = "SELECT DISTINCT profesor_titular FROM mesas_examen WHERE profesor_titular IS NOT NULL
                       UNION
                       SELECT DISTINCT profesor_vocal1 FROM mesas_examen WHERE profesor_vocal1 IS NOT NULL
                       UNION
                       SELECT DISTINCT profesor_vocal2 FROM mesas_examen WHERE profesor_vocal2 IS NOT NULL";

          if (!($resultado = mysqli_query($link, $consulta))) {
            echo "<p>Error: La consulta SQL tiene un problema, verificar.</p> <br>";
            echo "<p>$consulta</p>";
            exit();
          }
          ?>
          <option value="">Selecciona un Profesor</option>
          <?php foreach ($resultado as $profesor) : ?>
            <option value="<?php echo $profesor['profesor_titular']; ?>" 
              <?php if (isset($_GET['profesor']) && $_GET['profesor'] == $profesor['profesor_titular']) echo 'selected'; ?>>
              <?php echo $profesor['profesor_titular']; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </form>
      <form action="deportemaspracticado.php" class="mr-2">
        <button type="submit" class="btn btn-info">Deporte más Practicado</button>
      </form>
      <form action="listarelaciones.php" class="mr-2">
        <button type="submit" class="btn btn-info">Relaciones</button>
      </form>

      <div class="dropdown">
        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> + </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="agregarpersona.php">Persona</a>
          <a class="dropdown-item" href="agregardeporte.php">Deporte</a>
          <a class="dropdown-item" href="agregarrelacion.php">Relacion</a>
        </div>
      </div>
    </div>

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
        if (isset($_GET['profesor']) && $_GET['profesor'] != '') {
          $profesor_seleccionado = $_GET['profesor'];

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
       INNER JOIN mesas_examen ON inscripciones.id_mesa = mesas_examen.id_mesa
       WHERE mesas_examen.profesor_titular = '$profesor_seleccionado' OR mesas_examen.profesor_vocal1 = '$profesor_seleccionado' OR mesas_examen.profesor_vocal2 = '$profesor_seleccionado'";

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
            echo '<tr><td colspan="8" class="text-center">No hay alumnos inscritos en las mesas de examen de este profesor.</td></tr>';
          }

          mysqli_free_result($resultado);
          mysqli_close($link);
        } else {
          echo '<tr><td colspan="8" class="text-center">Selecciona un profesor para ver los alumnos inscritos en sus mesas de examen.</td></tr>';
        }
        ?>
      </tbody>
    </table>

  </div>

  <footer class="text-center">
    <div class="container">
      <div class="row">
        <div class="col">
          <img src="imagen.jpeg" alt="Imagen de perfil" class="img-thumbnail rounded-circle">
          <p class="mb-0">Desarrollador: Franco Asevey</p>
          <p class="mb-0">Materia: Programacion 3</p>
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
