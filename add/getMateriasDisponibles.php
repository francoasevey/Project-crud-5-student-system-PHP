<?php
include '../config/db-connection.php';

if (isset($_GET['id'])) {
    $alumnoId = $_GET['id'];

    $consulta = "SELECT id_mesa, materia FROM mesas_examen WHERE id_mesa NOT IN (SELECT id_mesa FROM inscripciones WHERE id_alumno = $alumnoId)";
    $resultado = mysqli_query($link, $consulta);

    if ($resultado) {
        $materias = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        echo json_encode($materias);
    } else {
        echo json_encode(array('error' => 'No se pudo obtener las materias disponibles.'));
    }
} else {
    echo json_encode(array('error' => 'ID de alumno no proporcionado.'));
}
?>
