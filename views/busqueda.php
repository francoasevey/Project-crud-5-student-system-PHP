<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Búsqueda</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/home.css">
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
                  <a class="dropdown-item" href="../list/filtradomaterias.php">Filtrado por Materia</a>
                  <a class="dropdown-item" href="../list/filtradomaterias.php">Filtrado por Profesores</a>
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

    <div class="container content-container">
      <div class="table-container">
        <h2 class="text-center">Lista de Búsqueda</h2>
        <table class="table table-bordered table-hover">
          <thead class="thead-dark">
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>DNI</th>
              <th>Email</th>
              <th>Telefono</th>
              <th>ID</th>
              <th>Fecha mesa</th>
              <th>Materia</th>
              <th>Tipo</th>
              <th>Fecha Inscripcion</th>
              <th>Asistencia</th>
              <th>Nota</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $formBuscar = isset($_GET["buscar"]) ? $_GET["buscar"] : (isset($_POST["buscar"]) ? $_POST["buscar"] : "");

            if (!empty($formBuscar)) {
              $db_host = "localhost";
              $db_user = "root";
              $db_pass = "";
              $db_name = "sistemagestionexamenes";

              $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

              if (!$link) {
                die("Error: no se puede conectar a MYSQL." . PHP_EOL .
                  "Error de depuración: " . mysqli_connect_errno() . PHP_EOL .
                  "Error de depuración: " . mysqli_connect_error() . PHP_EOL);
              }

              $registros_por_pagina = 10;
              $pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
              $offset = ($pagina_actual - 1) * $registros_por_pagina;

              $consulta = "SELECT a.id_alumno, a.nombre, a.apellido, a.dni, a.email, a.telefono,
            m.id_mesa, m.fecha, m.materia, m.tipo,
            i.fecha_inscripcion, i.asistencia, i.nota
            FROM alumnos a
            LEFT JOIN inscripciones i ON a.id_alumno = i.id_alumno
            LEFT JOIN mesas_examen m ON i.id_mesa = m.id_mesa
            WHERE a.nombre LIKE '%$formBuscar%' 
            OR a.apellido LIKE '%$formBuscar%' 
            OR a.dni LIKE '%$formBuscar%' 
            OR m.materia LIKE '%$formBuscar%' 
            OR i.nota LIKE '%$formBuscar%' 
            OR i.asistencia LIKE '%$formBuscar%'
            OR m.tipo LIKE '%$formBuscar%' 
            OR a.telefono LIKE '%$formBuscar%' 
            OR a.email LIKE '%$formBuscar%'
            LIMIT $registros_por_pagina OFFSET $offset";

              $resultado = mysqli_query($link, $consulta);

              if (!$resultado) {
                die("Error en la consulta SQL: " . mysqli_error($link));
              }

              $consulta_total = "SELECT COUNT(*) as total 
            FROM alumnos a
            LEFT JOIN inscripciones i ON a.id_alumno = i.id_alumno
            LEFT JOIN mesas_examen m ON i.id_mesa = m.id_mesa
            WHERE a.nombre LIKE '%$formBuscar%' 
            OR a.apellido LIKE '%$formBuscar%' 
            OR a.dni LIKE '%$formBuscar%' 
            OR m.materia LIKE '%$formBuscar%' 
            OR i.nota LIKE '%$formBuscar%' 
            OR i.asistencia LIKE '%$formBuscar%'
            OR m.tipo LIKE '%$formBuscar%' 
            OR a.telefono LIKE '%$formBuscar%' 
            OR a.email LIKE '%$formBuscar%'";

              $resultado_total = mysqli_query($link, $consulta_total);
              $fila_total = mysqli_fetch_assoc($resultado_total);
              $total_registros = $fila_total['total'];
              mysqli_free_result($resultado_total);

              $total_paginas = ceil($total_registros / $registros_por_pagina);

              if ($total_paginas > 1) {
                echo "<ul class='pagination justify-content-center'>";
                for ($i = 1; $i <= $total_paginas; $i++) {
                  echo "<li class='page-item " . ($pagina_actual == $i ? 'active' : '') . "'><a class='page-link' href='?pagina=$i&buscar=$formBuscar'>$i</a></li>";
                }
                echo "</ul>";
              }

              if (mysqli_num_rows($resultado) > 0) {
                while ($row = mysqli_fetch_assoc($resultado)) {
                  echo "<tr>";
                  echo "<td>{$row['id_alumno']}</td>";
                  echo "<td>{$row['nombre']}</td>";
                  echo "<td>{$row['apellido']}</td>";
                  echo "<td>{$row['dni']}</td>";
                  echo "<td>{$row['email']}</td>";
                  echo "<td>{$row['telefono']}</td>";
                  echo "<td>{$row['id_mesa']}</td>";
                  echo "<td>{$row['fecha']}</td>";
                  echo "<td>{$row['materia']}</td>";
                  echo "<td>{$row['tipo']}</td>";
                  echo "<td>{$row['fecha_inscripcion']}</td>";
                  echo "<td>{$row['asistencia']}</td>";
                  echo "<td>{$row['nota']}</td>";
                  echo "</tr>";
                }
                mysqli_free_result($resultado);
              } else {
                echo '<tr><td colspan="13" class="text-center">No hay resultados para la búsqueda actual.</td></tr>';
              }

              mysqli_close($link);
            } else {
              echo "<tr><td colspan='13' class='text-center'>Por favor, introduzca un término de búsqueda.</td></tr>";
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
          <p class="mb-0">Materia: Programacion 3</p>
          <p class="mb-0">Carrera: Tecnicatura Superior en Desarrollo de Software</p>
          <p class="mb-0">Mes: Año: 2024</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>