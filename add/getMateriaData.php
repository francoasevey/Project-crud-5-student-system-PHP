<?php
include '../config/db-connection.php';

$materiaId = $_GET['id'];
$consulta = "SELECT fecha, materia, tipo, profesor_titular, profesor_vocal1, profesor_vocal2 FROM mesas_examen WHERE id_mesa = ?";
$declaracion  = $link->prepare($consulta);
$declaracion ->bind_param('i', $materiaId);
$declaracion ->execute();
$result = $declaracion ->get_result();
$data = $result->fetch_assoc();

echo json_encode($data);
