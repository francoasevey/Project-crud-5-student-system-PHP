<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Instituto TSDS</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/home.css">
  <link rel="stylesheet" type="text/css" href="../css/alumnosinscriptos.css">
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

    <div class="container content-container">
      <div class="table-container">
        <h2 class="text-center">Listar Alumnos Inscritos en la Materia</h2>
        <table class="table table-bordered table-hover">
          <thead class="thead-dark">
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Fecha de Inscripción</th>
              <th>Condicion Alumno</th>
              <th>Asistencia</th>
              <th>Nota</th>
              <th>Materia</th>
              <th>Tipo</th>
              <th>Fecha Mesa</th>
              <th>profesor titular</th>
              <th>profesor vocal 1</th>
              <th>profesor vocal 2</th>
              <th>Eliminar</th>
              <th>Modificar</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include '../config/db-connection.php';
            
            $registros_por_pagina = 10;
            $pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $inicio = ($pagina_actual - 1) * $registros_por_pagina;
            
            $consulta_count = "SELECT COUNT(*) AS total FROM inscripciones";
            $resultado_count = mysqli_query($link, $consulta_count);
            
            if (!$resultado_count) {
                echo "<p>Error: La consulta SQL para contar registros tiene un problema.</p>";
                echo "<p>Consulta SQL: $consulta_count</p>";
                exit();
            }
            
            $fila_count = mysqli_fetch_assoc($resultado_count);
            $total_registros = $fila_count['total'];
            mysqli_free_result($resultado_count);
            $total_paginas = ceil($total_registros / $registros_por_pagina);
            
            $consulta = "SELECT i.id_inscripcion, a.nombre AS nombre_alumno, a.apellido AS apellido_alumno, a.dni AS dni_alumno, a.email AS email_alumno, a.telefono AS telefono_alumno,
            i.fecha_inscripcion, i.condicion_alumno, i.asistencia, i.nota,
            me.materia, me.tipo, me.fecha, me.profesor_titular, me.profesor_vocal1, me.profesor_vocal2
            FROM inscripciones i
            INNER JOIN alumnos a ON i.id_alumno = a.id_alumno
            INNER JOIN mesas_examen me ON i.id_mesa = me.id_mesa LIMIT $inicio, $registros_por_pagina";
            
            $resultado = mysqli_query($link, $consulta);
            
            if (!$resultado) {
                echo "<p>Error: La consulta SQL para obtener registros paginados tiene un problema.</p>";
                echo "<p>Consulta SQL: $consulta</p>";
                exit();
            }
            
            if ($total_paginas > 1) {
                echo "<ul class='pagination justify-content-center'>";
                for ($i = 1; $i <= $total_paginas; $i++) {
                    echo "<li class='page-item " . ($pagina_actual == $i ? 'active' : '') . "'><a class='page-link' href='?pagina=$i'>$i</a></li>";
                }
                echo "</ul>";
            }
            
            while ($row = mysqli_fetch_row($resultado)) {
              echo "<tr>"; 
              echo "<td>$row[0]</td>"; // ID de la inscripción
              echo "<td>$row[1]</td>"; // Nombre del alumno
              echo "<td>$row[2]</td>"; // Apellido del alumno
              /*echo "<td>$row[3]</td>"; // DNI del alumno
              echo "<td>$row[4]</td>"; // Email del alumno
              echo "<td>$row[5]</td>"; // Telefono del alumno*/
              echo "<td>$row[6]</td>"; // Fecha de inscripción
              echo "<td>$row[7]</td>"; // Condicion Alumno
              echo "<td>$row[8]</td>"; // Asistencia
              echo "<td>$row[9]</td>"; // Nota
              echo "<td>$row[10]</td>"; // Materia
              echo "<td>$row[11]</td>"; // Tipo
              echo "<td>$row[12]</td>"; // Fecha de la mesa de examen
              echo "<td>$row[13]</td>"; // Profesor titular
              echo "<td>$row[14]</td>"; // Profesor vocal 1
              echo "<td>$row[15]</td>"; // Profesor vocal 2

              echo "<td>
              
            <form method='post' action='../delete/eliminarinscripcion.php'>
                <input type='hidden' name='id' value='$row[0]'>
                <button type='submit' class='btn btn-danger'>
                 <i class='fas fa-trash-alt'></i>
                </button>
            </form>
          </td>";
              echo "<td>
            <form method='post' action='../edit/editarinscripcion.php'>
                <input type='hidden' name='id' value='{$row[0]}'>
                <button type='submit' class='btn btn-warning'>
                 <i class='fas fa-edit'></i>
                </button>
            </form>
          </td>";
              echo "</tr>";
            }
            mysqli_free_result($resultado);
            mysqli_close($link);

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