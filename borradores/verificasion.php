<?php
$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    include '../config/db-connection.php';
    $formID = $_POST["id"];

    $consulta = "SELECT * FROM alumnos WHERE id_alumno='$formID'";
    if (!($resultado = mysqli_query($link, $consulta))) {
        $errorMsg = "Error: La consulta SQL tiene un problema, verificar.<br>$consulta";
    } else {
        $row = mysqli_fetch_row($resultado);
    }
} else {
    $errorMsg = "No se han recibido datos del formulario.";
    header("Location: ../views/home.php");
    exit();
}
