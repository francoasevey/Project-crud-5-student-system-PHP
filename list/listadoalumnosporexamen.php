<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Instituto TSDS</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/home.css">
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
                  <a class="dropdown-item" href="crearmesaexamen.php">Registrar Mesa de Examen</a>
                  <a class="dropdown-item" href="crearincripcion.php">Registrar Inscripcion</a>
                  <a class="dropdown-item" href="crearalumno.php">Registrar Alumno</a>
                  <a class="dropdown-item" href="crearusuario.php">Registrar Usuarios</a>
                </div>
              </li>
              <li class="nav-item">
                <form class="form-inline my-2 my-lg-0">
                  <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar">
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
        <h2 class="text-center">Listado de Mesas con Tribunales</h2>
        <table class="table table-bordered table-hover">
          <thead class="thead-dark">
            <tr>
              <th>ID</th>
              <th>Fecha</th>
              <th>Materia</th>
              <th>Tipo</th>
              <th>Profesor Titular</th>
              <th>Profesor Vocal 1</th>
              <th>Profesor Vocal 2</th>
              <th>Total Alumnos</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include '../config/db-connection.php';

            $consulta = "SELECT m.id_mesa, m.fecha, m.materia, m.tipo, m.profesor_titular, m.profesor_vocal1, m.profesor_vocal2,
             COUNT(i.id_alumno) AS total_alumnos
             FROM mesas_examen m
             LEFT JOIN inscripciones i ON m.id_mesa = i.id_mesa
             GROUP BY m.id_mesa";

            if (!($resultado = mysqli_query($link, $consulta))) {
              echo "<p>Error: La consulta SQL tiene un problema, verificar.</p> <br>";
              echo "<p>$consulta</p>";
              exit();
            }

            while ($row = mysqli_fetch_assoc($resultado)) {
              echo "<tr>";
              echo "<td>{$row['id_mesa']}</td>";
              echo "<td>{$row['fecha']}</td>";
              echo "<td>{$row['materia']}</td>";
              echo "<td>{$row['tipo']}</td>";
              echo "<td>{$row['profesor_titular']}</td>";
              echo "<td>{$row['profesor_vocal1']}</td>";
              echo "<td>{$row['profesor_vocal2']}</td>";
              echo "<td>{$row['total_alumnos']}</td>";
              echo "</tr>";
            }

            mysqli_free_result($resultado);
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