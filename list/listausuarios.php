<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Instituto TSDS</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <link rel="stylesheet" type="text/css" href="../css/home.css">
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
                  <a class="dropdown-item" href="home.php">Listado de Alumnos</a>
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

    <div class="container content-container">
      <div class="table-container">
        <h2 class="text-center">Listar Usuarios</h2>
        <table class="table table-bordered table-hover">
          <thead class="thead-dark">
            <tr>
              <th>ID</th>
              <th>Usuario</th>
              <th>Clave</th>
              <th>Email</th>
              <th>Perfil</th>
              <?php if (isUserAdmin()): ?>
              <th>Eliminar</th>
              <th>Modificar</th>
              <?php endif; ?>
            </tr>
          </thead>
          <tbody>
            <?php
            include '../config/db-connection.php';

            $registros_por_pagina = 10;
            $pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $inicio = ($pagina_actual - 1) * $registros_por_pagina;

            /*$consulta = "SELECT * FROM usuarios WHERE perfil NOT LIKE '%administrativo%' LIMIT $inicio, $registros_por_pagina";*/

            $consulta = "SELECT * FROM usuarios LIMIT $inicio, $registros_por_pagina";
            if (!($resultado = mysqli_query($link, $consulta))) {
              echo "<p>Error: La consulta SQL tiene un problema, verificar.</p> <br>";
              echo "<p>$consulta</p>";
              exit();
            }

            $consulta_total = "SELECT COUNT(*) as total FROM usuarios";
            $resultado_total = mysqli_query($link, $consulta_total);
            $fila_total = mysqli_fetch_assoc($resultado_total);
            $total_registros = $fila_total['total'];
            mysqli_free_result($resultado_total);

            $total_paginas = ceil($total_registros / $registros_por_pagina);
            if ($total_paginas > 1) {
              echo "<ul class='pagination justify-content-center'>";
              for ($i = 1; $i <= $total_paginas; $i++) {
                echo "<li class='page-item " . ($pagina_actual == $i ? 'active' : '') . "'><a class='page-link' href='?pagina=$i'>$i</a></li>";
              }
              echo "</ul>";
            }

            while ($row = mysqli_fetch_row($resultado)) {
              echo "<tr>";
              echo "<td>$row[0]</td>";
              echo "<td>$row[1]</td>";
              echo "<td>$row[2]</td>";
              echo "<td>$row[3]</td>";
              echo "<td>$row[4]</td>";

              if (isUserAdmin()) {
              echo "<td>
                    <form method='post' action='../delete/eliminarusuario.php'>
                    <input type='hidden' name='id' value='$row[0]'>
                    <button type='submit' class='btn btn-danger'>Eliminar</button>
                    </form>
                    </td>";
              echo "<td>
                    <form method='post' action='../edit/editarusuario.php'>
                    <input type='hidden' name='id' value='$row[0]'>
                    <button type='submit' class='btn btn-warning'>Modificar</button>
                    </form>
                    </td>";
              }
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
          <p class="mb-0">Año: 2024</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>