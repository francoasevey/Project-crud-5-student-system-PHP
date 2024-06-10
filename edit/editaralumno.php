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
    <h2 class="card-title text-center mt-4 mb-4"><strong>Modificar Alumno</strong></h2>
    <div class="d-flex justify-content-center">
      <div class="table-container">
        <?php
        include '../config/conexionAlumnos.php';
        ?>
        <form method="post" action="editaralumnoproceso.php">
          <div class="form-group row">
            <label for="id" class="col-sm-3 col-form-label">ID:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="id" name="id" readonly value="<?php echo $row[0] ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Nombre:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="name" name="name" required value="<?php echo $row[1] ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="apellido" class="col-sm-3 col-form-label">Apellido:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="apellido" name="apellido" required value="<?php echo $row[2] ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="dni" class="col-sm-3 col-form-label">DNI:</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" id="dni" name="dni" required value="<?php echo $row[3] ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">Email:</label>
            <div class="col-sm-9">
              <input type="email" class="form-control" id="email" name="email" required value="<?php echo $row[4] ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="telefono" class="col-sm-3 col-form-label">Telefono:</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" id="telefono" name="telefono" required value="<?php echo $row[5] ?>">
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