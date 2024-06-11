<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Búsqueda</title>
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
  <h2 class="text-center">Lista de Búsqueda</h2>
  <form method="post" action="busqueda.php" class="form-inline justify-content-center mb-4">
    <input class="form-control mr-sm-2 w-25" type="search" placeholder="Buscar por nombre, apellido, DNI, materia o nota" aria-label="Buscar" name="buscar">

    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
  </form>

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
      $formBuscar = isset($_POST["buscar"]) ? $_POST["buscar"] : "";

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
        OR a.email LIKE '%$formBuscar%'";


        $resultado = mysqli_query($link, $consulta);

        if (!$resultado) {
            die("Error en la consulta SQL: " . mysqli_error($link));
        }
        while ($row = mysqli_fetch_row($resultado)) {
            echo "<tr>";
            echo "<td>$row[0]</td>";
            echo "<td>$row[1]</td>";
            echo "<td>$row[2]</td>";
            echo "<td>$row[3]</td>";
            echo "<td>$row[4]</td>";
            echo "<td>$row[5]</td>";
            echo "<td>$row[6]</td>";
            echo "<td>$row[7]</td>";
            echo "<td>$row[8]</td>";
            echo "<td>$row[9]</td>";
            echo "<td>$row[10]</td>";
            echo "<td>$row[11]</td>";
            echo "<td>$row[12]</td>";
            echo "</tr>";
        }

        mysqli_free_result($resultado);
        mysqli_close($link);
      } else {
        echo "<tr><td colspan='8' class='text-center'>Por favor, introduzca un término de búsqueda.</td></tr>";
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
