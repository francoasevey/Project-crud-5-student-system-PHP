<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Inscripcion</title>
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
        <h2 class="card-title text-center"><strong>Modificar Inscripcion</strong></h2>
        <div class="d-flex justify-content-center">
            <div class="table-container">
                <?php
                $id_inscripcion = $_POST['id'];
                $fechainscripcion = $_POST['fecha_inscripcion'];
                $asistencia = $_POST['asistencia'];
                $nota = $_POST['nota'];
                $mesafecha = $_POST['fecha'];
                $materia = $_POST['materia'];
                $profesor1 = $_POST['profesor_titular'];
                $profesor2 = $_POST['profesor_vocal1'];
                $profesor3 = $_POST['profesor_vocal2'];
                
                // Conexión a la base de datos
                $db_host = "localhost"; 
                $db_user = "root";
                $db_pass = "";
                $db_name = "sistemagestionexamenes";

                $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

                // Verificar conexión
                if (!$link) {
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo "Error: no se puede conectar a MySQL." . PHP_EOL;
                    echo "<br>Error de depuración: " . mysqli_connect_errno() . PHP_EOL;
                    echo "<br>Error de depuración: " . mysqli_connect_error() . PHP_EOL;
                    echo "</div>";
                    exit();
                }

                // Actualizar la inscripción en la base de datos
                $consulta = "UPDATE inscripcion SET fecha_inscripcion='$fechainscripcion', asistencia='$asistencia', nota='$nota', fecha='$mesafecha', materia='$materia', profesor_titular='$profesor1', profesor_vocal1='$profesor2', profesor_vocal2='$profesor3' WHERE id_inscripcion='$id_inscripcion'";
                if (!mysqli_query($link, $consulta)){
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo "Error: La consulta SQL tiene un problema, verificar.<br>";
                    echo "$consulta";
                    echo "</div>";
                    exit();
                }
                echo "<div class='alert alert-success' role='alert'>";
                echo "Los siguientes datos de la inscripción han sido editados en la base de datos.";
                echo "</div>";

                // Mostrar los datos editados
                echo "<table class='table table-striped'>
                        <thead>
                            <tr>
                                <th>Fecha de Inscripción</th>
                                <th>Asistencia</th>
                                <th>Nota</th>
                                <th>Fecha</th>
                                <th>Materia</th>
                                <th>Profesor Titular</th>
                                <th>Profesor Vocal 1</th>
                                <th>Profesor Vocal 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>$fechainscripcion</td>
                                <td>$asistencia</td>
                                <td>$nota</td>
                                <td>$mesafecha</td>
                                <td>$materia</td>
                                <td>$profesor1</td>
                                <td>$profesor2</td>
                                <td>$profesor3</td>
                            </tr>
                        </tbody>
                    </table>";

                mysqli_close($link);
                ?>
                <div class="d-flex justify-content-center">
                    <form action="listardeporte.php" class="mr-2">
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
