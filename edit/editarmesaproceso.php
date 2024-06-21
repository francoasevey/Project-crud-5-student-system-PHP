<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Mesa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #f8f9fa;
    }

    .table-container {
      padding: 20px;
      overflow-x: auto;
      background-color: #ffffff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      margin-top: 20px;
    }

    th {
      background-color: #f2f2f2;
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

    .card-title {
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <div class="container">
    <h2 class="card-title text-center"><strong>Modificar Mesa</strong></h2>
    <div class="d-flex justify-content-center">
      <div class="table-container">
        <?php
        include '../config/db-connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
          $formID = $_POST["id"];
          $formFecha = $_POST["fecha"];
          $formMateria = $_POST["materia"];
          $formTipo = $_POST["tipo"];
          $formProfesorTitular= $_POST["profesor_titular"];
          $formProfesorVocal1 = $_POST["profesor_vocal1"];
          $formProfesorVocal2 = $_POST["profesor_vocal2"];

          $consulta = "SELECT id_mesa FROM mesas_examen WHERE materia='$formMateria' AND id_mesa != '$formID'";
          $resultado = mysqli_query($link, $consulta);

          if (mysqli_num_rows($resultado) > 0) {
            echo "<div class='alert alert-danger' role='alert'>";
            echo "El Materia ya está registrado en la base de datos. Introduzca otro.";
            echo "</div>";
          } else {
            $consulta = "UPDATE mesas_examen SET fecha='$formFecha', materia='$formMateria', tipo='$formTipo', 
            profesor_titular='$formProfesorTitular', profesor_vocal1='$formProfesorVocal1', 
            profesor_vocal2='$formProfesorVocal2' WHERE id_mesa='$formID'";
            if (!mysqli_query($link, $consulta)) {
              echo "<div class='alert alert-danger' role='alert'>";
              echo "Error: La consulta SQL tiene un problema, verificar.<br>";
              echo "$consulta";
              echo "</div>";
              exit();
            }
            echo "<div class='alert alert-success' role='alert'>";
            echo "Los datos de la MESA han sido actualizados correctamente.";
            echo "</div>";
          }
          mysqli_close($link);
        } else {
          echo "<div class='alert alert-warning' role='alert'>";
          echo "No se han recibido datos del formulario.";
          echo "</div>";
        }
        ?>

        <table class="table table-striped">
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Materia</th>
              <th>Tipo</th>
              <th>Profesor Titular</th>
              <th>Profesor Vocal 1</th>
              <th>Profesor Vocal 2</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $formFecha; ?></td>
              <td><?php echo $formMateria; ?></td>
              <td><?php echo $formTipo; ?></td>
              <td><?php echo $formProfesorTitular; ?></td>
              <td><?php echo $formProfesorVocal1; ?></td>
              <td><?php echo $formProfesorVocal2; ?></td>
            </tr>
          </tbody>
        </table>
        <div class="d-flex justify-content-center">
          <form action="../views/home.php" class="mr-2">
            <input type="submit" value="Volver al Listado" class="btn btn-primary">
          </form>
        </div>
      </div>
    </div>
  </div>
  <footer class="text-center fixed-bottom">
    <div class="container">
      <div class="row">
        <div class="col">
          <img src="imagen.jpeg" alt="Imagen de perfil" class="img-thumbnail rounded-circle">
          <p class="mb-0">Desarrollador: Franco Asevey</p>
          <p class="mb-0">Materia: Programacion 3</p>
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