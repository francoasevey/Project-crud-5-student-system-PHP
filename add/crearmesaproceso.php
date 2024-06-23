<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Procesar Carga Nueva Mesa de Examen</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #f8f9fa;
    }

    .table-container {
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 20px;
    }

    th,
    td {
      border: 1px solid #dee2e6;
      padding: 12px;
      text-align: left;
    }

    th {
      background-color: #e9ecef;
    }

    footer {
      margin-top: 50px;
    }

    .fixed-bottom {
      position: fixed;
      bottom: 0;
      width: 100%;
      background-color: #f8f9fa;
      padding: 10px 0;
    }
  </style>
</head>

<body>
  <div class="container">
    <h2 class="card-title text-center mt-5"><strong>Procesar Carga Nueva Mesa de Examen</strong></h2>
    <div class="d-flex justify-content-center mt-4">
      <div class="table-container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['materia']) && isset($_POST['fecha']) && isset($_POST['profesor_titular']) && isset($_POST['profesor_vocal1']) && isset($_POST['profesor_vocal2'])) {
          $formMateria = $_POST["materia"];
          $formFecha = $_POST["fecha"];
          $formProfesorTitular = $_POST["profesor_titular"];
          $formProfesorVocal1 = $_POST["profesor_vocal1"];
          $formProfesorVocal2 = $_POST["profesor_vocal2"];

          include '../config/db-connection.php';

          echo "<p class='text-success'>¡Conexión exitosa a MYSQL! La base de datos $db_name está lista.</p>";
          echo "<p>Información del host: " . mysqli_get_host_info($link) . " </p>";

          $consulta = "INSERT INTO mesas_examen (materia, fecha, profesor_titular, profesor_vocal1, profesor_vocal2) VALUES ('$formMateria', '$formFecha', '$formProfesorTitular', '$formProfesorVocal1', '$formProfesorVocal2')";

          if (!mysqli_query($link, $consulta)) {
            echo "<p class='text-danger'>Error: La consulta SQL tiene problemas, verificar.</p> <br>";
            echo "<p>$consulta</p>";
            exit();
          }
          echo "<p class='text-success'>Datos insertados correctamente en la base de datos $db_name.</p>";
        ?>

          <strong>Los siguientes datos han sido insertados en la base de datos:</strong>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Materia</th>
                <th>Fecha</th>
                <th>Profesor Titular</th>
                <th>Profesor Vocal 1</th>
                <th>Profesor Vocal 2</th>
              </tr>
            </thead>
            <tbody>
              <?php
              echo "<tr>";
              echo "<td>$formMateria</td>";
              echo "<td>$formFecha</td>";
              echo "<td>$formProfesorTitular</td>";
              echo "<td>$formProfesorVocal1</td>";
              echo "<td>$formProfesorVocal2</td>";
              echo "</tr>";
              mysqli_close($link);
              ?>
            </tbody>
          </table>
        <?php
        } else {
          echo "<p class='text-danger'>No se han recibido datos del formulario.</p>";
          header("Location: ../add/crearmesaexamen.php");
          exit();
        }
        ?>
        <div class="d-flex justify-content-center mt-4">
          <form action="../views/home.php">
            <input type="submit" value="Volver al Listado" class="btn btn-primary">
          </form>
        </div>
      </div>
    </div>
  </div>
  <footer class="card-footer text-muted text-center fixed-bottom">
    <div class="container">
      <div class="row">
        <div class="col">
          <img src="imagen.jpeg" alt="Imagen de perfil" class="img-thumbnail rounded-circle" style="width: 45px; height: 45px;">
          <p class="mb-0">Desarrollador: Franco Asevey</p>
          <p class="mb-0">Materia: Programación 3</p>
          <p class="mb-0">Carrera: Tecnicatura Superior en Desarrollo de Software</p>
          <p class="mb-0">Año: 2024</p>
        </div>
      </div>
    </div>
  </footer>
</body>

</html>