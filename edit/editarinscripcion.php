<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Inscripción</title>
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
        <h2 class="card-title text-center mt-4 mb-4"><strong>Modificar Inscripción</strong></h2>
        <div class="d-flex justify-content-center">
            <div class="table-container">
                <?php
                include '../config/db-connection.php';

                $formID = $_POST['id'];
                $consulta = "SELECT i.*, a.nombre AS nombre_alumno, a.apellido AS apellido_alumno, a.dni AS dni_alumno, a.email AS email_alumno, a.telefono AS telefono_alumno, me.fecha AS fecha_mesa, me.materia AS materia_mesa, me.tipo AS tipo_mesa, me.profesor_titular, me.profesor_vocal1, me.profesor_vocal2
                            FROM inscripciones i
                            INNER JOIN alumnos a ON i.id_alumno = a.id_alumno
                            INNER JOIN mesas_examen me ON i.id_mesa = me.id_mesa
                            WHERE i.id_inscripcion='$formID'";

                if (!($resultado = mysqli_query($link, $consulta))) {
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo "Error: La consulta SQL tiene un problema, verificar.<br>";
                    echo "$consulta";
                    echo "</div>";
                    exit();
                }

                $row = mysqli_fetch_assoc($resultado);

                $materias = mysqli_query($link, "SELECT id_mesa, materia FROM mesas_examen");
                $profesortitular = mysqli_query($link, "SELECT id_mesa, profesor_titular FROM mesas_examen");
                $profesorvocal1 = mysqli_query($link, "SELECT id_mesa, profesor_vocal1 FROM mesas_examen");
                $profesorvocal2 = mysqli_query($link, "SELECT id_mesa, profesor_vocal2 FROM mesas_examen");

                ?>

                <form method="post" action="editarinscripcionproceso.php">
                    <input type="hidden" name="id" value="<?php echo $row['id_inscripcion']; ?>">

                    <div class="form-group row">
                        <label for="nombre" class="col-sm-3 col-form-label">Nombre:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['nombre_alumno']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="apellido" class="col-sm-3 col-form-label">Apellido:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $row['apellido_alumno']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dni" class="col-sm-3 col-form-label">DNI:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="dni" name="dni" value="<?php echo $row['dni_alumno']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email:</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email_alumno']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telefono" class="col-sm-3 col-form-label">Teléfono:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $row['telefono_alumno']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fecha_inscripcion" class="col-sm-3 col-form-label">Fecha Inscripción:</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="fecha_inscripcion" name="fecha_inscripcion" value="<?php echo $row['fecha_inscripcion']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="asistencia" class="col-sm-3 col-form-label">Asistencia:</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="asistencia" name="asistencia" required>
                                <option value="Presente" <?php echo ($row['asistencia'] == 'Presente') ? 'selected' : ''; ?>>Presente</option>
                                <option value="Ausente" <?php echo ($row['asistencia'] == 'Ausente') ? 'selected' : ''; ?>>Ausente</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nota" class="col-sm-3 col-form-label">Nota:</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="nota" name="nota" value="<?php echo $row['nota']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fecha_mesa" class="col-sm-3 col-form-label">Fecha Mesa:</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="fecha_mesa" name="fecha_mesa" value="<?php echo $row['fecha_mesa']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="materia" class="col-sm-3 col-form-label">Materia:</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="materia" name="materia" required>
                                <option value="" disabled>Seleccione una Materia</option>
                                <?php while ($materia = mysqli_fetch_assoc($materias)) : ?>
                                    <option value="<?php echo $materia['id_mesa']; ?>" <?php echo ($materia['id_mesa'] == $row['id_mesa']) ? 'selected' : ''; ?>>
                                        <?php echo $materia['materia']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="profesor_titular" class="col-sm-3 col-form-label">Profesor Titular:</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="profesor_titular" name="profesor_titular" required>
                                <option value="" disabled>Seleccione un Profesor Titular</option>
                                <?php while ($profesor = mysqli_fetch_assoc($profesortitular)) : ?>
                                    <option value="<?php echo $profesor['profesor_titular']; ?>" <?php echo ($profesor['profesor_titular'] == $row['profesor_titular']) ? 'selected' : ''; ?>>
                                        <?php echo $profesor['profesor_titular']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="profesor_vocal1" class="col-sm-3 col-form-label">Profesor Vocal 1:</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="profesor_vocal1" name="profesor_vocal1" required>
                                <option value="" disabled>Seleccione un Profesor Vocal 1</option>
                                <?php while ($profesor = mysqli_fetch_assoc($profesorvocal1)) : ?>
                                    <option value="<?php echo $profesor['profesor_vocal1']; ?>" <?php echo ($profesor['profesor_vocal1'] == $row['profesor_vocal1']) ? 'selected' : ''; ?>>
                                        <?php echo $profesor['profesor_vocal1']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="profesor_vocal2" class="col-sm-3 col-form-label">Profesor Vocal 2:</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="profesor_vocal2" name="profesor_vocal2" required>
                                <option value="" disabled>Seleccione un Profesor Vocal 2</option>
                                <?php while ($profesor = mysqli_fetch_assoc($profesorvocal2)) : ?>
                                    <option value="<?php echo $profesor['profesor_vocal2']; ?>" <?php echo ($profesor['profesor_vocal2'] == $row['profesor_vocal2']) ? 'selected' : ''; ?>>
                                        <?php echo $profesor['profesor_vocal2']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary">Procesar</button>
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
