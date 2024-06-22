<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pie de Página</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .col {
            flex: 0 0 100%;
            max-width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }

        .img-thumbnail {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
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
</body>
</html>
