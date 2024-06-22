<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Persona</title>
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
    <h2 class="card-title text-center"><strong>Modificar Alumno</strong></h2>
    <div class="d-flex justify-content-center">
      <div class="table-container">
        <?php
        include '../config/db-connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
          $formID = $_POST["id"];
          $formName = $_POST["name"];
          $formLastName = $_POST["apellido"];
          $formDNI = $_POST["dni"];
          $formEmail = $_POST["email"];
          $formPhone = $_POST["telefono"];

          // Escapar los valores para evitar inyección SQL
          $formName = mysqli_real_escape_string($link, $formName);
          $formLastName = mysqli_real_escape_string($link, $formLastName);
          $formDNI = mysqli_real_escape_string($link, $formDNI);
          $formEmail = mysqli_real_escape_string($link, $formEmail);
          $formPhone = mysqli_real_escape_string($link, $formPhone);

          // verifica que los datos no sean repetidos
          $consulta = "SELECT id_alumno FROM alumnos WHERE (email='$formEmail' OR dni='$formDNI' OR telefono='$formPhone') AND id_alumno != '$formID'";
          $resultado = mysqli_query($link, $consulta);


          if (mysqli_num_rows($resultado) > 0) {
            echo "<div class='alert alert-danger' role='alert'>";
            echo "El correo electrónico ya está registrado en la base de datos. Introduzca otro.";
            echo "</div>";
          } else {
            $consulta = "UPDATE alumnos SET nombre='$formName', apellido='$formLastName', dni='$formDNI', email='$formEmail', telefono='$formPhone' WHERE id_alumno='$formID'";
            if (!mysqli_query($link, $consulta)) {
              echo "<div class='alert alert-danger' role='alert'>";
              echo "Error: La consulta SQL tiene un problema, verificar.<br>";
              echo "$consulta";
              echo "</div>";
              exit();
            }
            echo "<div class='alert alert-success' role='alert'>";
            echo "Los datos del alumno han sido actualizados correctamente.";
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
              <th>Nombre</th>
              <th>Apellido</th>
              <th>DNI</th>
              <th>Email</th>
              <th>Telefono</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $formName; ?></td>
              <td><?php echo $formLastName; ?></td>
              <td><?php echo $formDNI; ?></td>
              <td><?php echo $formEmail; ?></td>
              <td><?php echo $formPhone; ?></td>
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