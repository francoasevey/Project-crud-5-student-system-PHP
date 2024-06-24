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
    <h2 class="card-title text-center"><strong>Modificar Usuario</strong></h2>
    <div class="d-flex justify-content-center">
      <div class="table-container">
        <?php
        include '../config/db-connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
          $formID = $_POST["id"];
          $formEmail = mysqli_real_escape_string($link, $_POST["email"]);
          $formUser = mysqli_real_escape_string($link, $_POST["usuario"]);
          $formPassword = mysqli_real_escape_string($link, $_POST["clave"]);
          $formPerfil = mysqli_real_escape_string($link, $_POST["perfil"]);

          // verifica que los datos no sean repetidos
          $consulta = "SELECT id_usuario FROM usuarios WHERE (email='$formEmail' OR usuario='$formUser') AND id_usuario != '$formID'";
          $resultado = mysqli_query($link, $consulta);

          if (mysqli_num_rows($resultado) > 0) {
            echo "<div class='alert alert-danger' role='alert'>";
            echo "El correo electrónico o usuario ya está registrado en la base de datos. Introduzca otro.";
            echo "</div>";
          } else {
            // Actualizar datos del alumno
            $consulta = "UPDATE usuarios SET email='$formEmail', usuario='$formUser', clave='$formPassword', perfil='$formPerfil' WHERE id_usuario='$formID'";
            if (!mysqli_query($link, $consulta)) {
              echo "<div class='alert alert-danger' role='alert'>";
              echo "Error: La consulta SQL tiene un problema, verificar.<br>";
              echo "$consulta";
              echo "</div>";
              exit();
            }
            echo "<div class='alert alert-success' role='alert'>";
            echo "Los datos del USUARIO han sido actualizados correctamente.";
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
              <th>ID</th>
              <th>Email</th>
              <th>Usuario</th>
              <th>Clave</th>
              <th>Perfil</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $formID; ?></td>
              <td><?php echo $formEmail; ?></td>
              <td><?php echo $formUser; ?></td>
              <td><?php echo $formPassword; ?></td>
              <td><?php echo $formPerfil; ?></td>
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