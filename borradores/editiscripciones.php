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
  <div class="container">
    <h2 class="card-title text-center mt-4 mb-4"><strong>Modificar Inscripcion</strong></h2>
    <div class="d-flex justify-content-center">
      <div class="table-container">
        <?php
        include '../config/db-connection.php';
        include '../config/conexionAlumnos.php';
        /*$db_host = "localhost"; 
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
        }*/


        $materias = mysqli_query($link, "SELECT id_mesa, materia FROM mesas_examen");
        //$fechamesa = mysqli_query($link, "SELECT id_mesa, fecha FROM mesas_examen");
        $profesortitular = mysqli_query($link, "SELECT id_mesa, profesor_titular FROM mesas_examen");
        $profesorvocal1 = mysqli_query($link, "SELECT id_mesa, profesor_vocal1 FROM mesas_examen");
        $profesorvocal2 = mysqli_query($link, "SELECT id_mesa, profesor_vocal2 FROM mesas_examen");

        $id_inscripcion = $_POST['id'];
        $materia = $_POST['materia'];
        $mesafecha = $_POST['fecha'];
        $profesor1 = $_POST['profesor_titular'];
        $profesor2 = $_POST['profesor_vocal1'];
        $profesor3 = $_POST['profesor_vocal2'];
        $nota = $_POST['nota'];
        $asistencia = $_POST['asistencia'];


        ?>
        <form method="post" action="editaralumnoproceso.php">
        <input type="hidden" name="id" value="<?php echo $id_inscripcion; ?>">
          <div class="form-group row">
            <label for="id" class="col-sm-3 col-form-label">ID:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="id" name="id" readonly value="<?php echo $row[0] ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Nombre:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="name" name="name" readonly value="<?php echo $row[1] ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="apellido" class="col-sm-3 col-form-label">Apellido:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="apellido" name="apellido" readonly value="<?php echo $row[2] ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="fecha_inscripcion" class="col-sm-3 col-form-label">Fecha Inscripcion:</label>
            <div class="col-sm-9">
              <input type="date" class="form-control" id="fecha_inscripcion" name="fecha_inscripcion" readonly value="<?php echo $row[6] ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="asistencia" class="col-sm-3 col-form-label">Asistencia:</label>
            <div class="col-sm-9">
              <select class="form-control" id="asistencia" name="asistencia" required>
                <option value="Presente" <?php echo ($row[7] == 'Presente') ? 'selected' : ''; ?>>Presente</option>
                <option value="Ausente" <?php echo ($row[7] == 'Ausente') ? 'selected' : ''; ?>>Ausente</option>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="nota" class="col-sm-3 col-form-label">Nota:</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" id="nota" name="nota" readonly value="<?php echo $row[8] ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="materia" class="col-sm-3 col-form-label">Materia:</label>
            <div class="col-sm-9">
              <select class="form-control" id="materia" name="materia" required>
                <option value="" disabled>Seleccione una Materia</option>
                <?php while ($row = mysqli_fetch_assoc($materias)) : ?>
                  <option value="<?php echo $row['materia']; ?>" <?php echo (isset($materia) && $row['materia'] == $materia) ? 'selected' : ''; ?>>
                    <?php echo $row['materia']; ?>
                  </option>
                <?php endwhile; ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="fecha" class="col-sm-3 col-form-label">Fecha Mesa:</label>
            <div class="col-sm-9">
              <input type="date" class="form-control" id="fecha" name="fecha" readonly value="<?php echo $row[10] ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="profesor_titular" class="col-sm-3 col-form-label">Profesor Titular:</label>
            <div class="col-sm-9">
              <select class="form-control" id="profesor_titular" name="profesor_titular" required>
                <option value="" disabled>Seleccione una Profesor Titular</option>
                <?php while ($row = mysqli_fetch_assoc($profesortitular)) : ?>
                  <option value="<?php echo $row['profesor_titular']; ?>" <?php echo (isset($profesor1) && $row['profesor_titular'] == $profesor1) ? 'selected' : ''; ?>>
                    <?php echo $row['profesor_titular']; ?>
                  </option>
                <?php endwhile; ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="profesor_vocal1" class="col-sm-3 col-form-label">Profesor Vocal 1:</label>
            <div class="col-sm-9">
              <select class="form-control" id="profesor_vocal1" name="profesor_vocal1" required>
                <option value="" disabled>Seleccione una Profesor Vocal 1</option>
                <?php while ($row = mysqli_fetch_assoc($profesorvocal1)) : ?>
                  <option value="<?php echo $row['profesor_vocal1']; ?>" <?php echo (isset($profesor2) && $row['profesor_vocal1'] == $profesor2) ? 'selected' : ''; ?>>
                    <?php echo $row['profesor_vocal1']; ?>
                  </option>
                <?php endwhile; ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="profesor_vocal2" class="col-sm-3 col-form-label">Profesor Vocal 2:</label>
            <div class="col-sm-9">
              <select class="form-control" id="profesor_vocal2" name="profesor_vocal2" required>
                <option value="" disabled>Seleccione una Profesor vocal 2</option>
                <?php while ($row = mysqli_fetch_assoc($profesorvocal2)) : ?>
                  <option value="<?php echo $row['profesor_vocal2']; ?>" <?php echo (isset($profesor3) && $row['profesor_vocal2'] == $profesor3) ? 'selected' : ''; ?>>
                    <?php echo $row['profesor_vocal2']; ?>
                  </option>
                <?php endwhile; ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-12 text-center">
              <button type="submit" id="botonProcesar" class="btn btn-primary" disabled>Procesar</button>
            </div>
          </div>

        </form>

        <div class="d-flex justify-content-center">
          <form action="../views/home.php" class="mr-2">
            <input type="submit" value="Volver al Listado" class="btn btn-secondary">
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
  <script src="boton.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>