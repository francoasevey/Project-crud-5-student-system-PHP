<?php
include '../config/db-connection.php';

$alumnoId = $_GET['id'];
$consulta = "SELECT nombre, apellido, dni, email, telefono FROM alumnos WHERE id_alumno = ?";
$declaracion  = $link->prepare($consulta);
$declaracion ->bind_param('i', $alumnoId);
$declaracion ->execute();
$result = $declaracion ->get_result();
$data = $result->fetch_assoc();

echo json_encode($data);
