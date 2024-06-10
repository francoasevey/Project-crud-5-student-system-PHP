<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {

    $formID = $_POST["id"];

    include '../config/db-connection.php';

    $consulta = "DELETE FROM alumnos WHERE id_alumno='$formID'";
    if (!mysqli_query($link, $consulta)) {
        echo "<div class='alert alert-danger' role='alert'>";
        echo "Error: La consulta SQL tiene un problema, verificar.<br>";
        echo "$consulta";
        echo "</div>";
        exit();
    }
    echo "<div class='alert alert-success' role='alert'>";
    echo "El alumno ha sido eliminada de la base de datos.";
    echo "</div>";
    mysqli_close($link);
} else {
    echo "<div class='alert alert-warning' role='alert'>";
    echo "No se han recibido datos del formulario.";
    echo "</div>";
    header("Location: ../views/home.php");
    exit();
}
?>

<div class="d-flex justify-content-center mt-4">
    <form action="../views/home.php">
        <input type="submit" value="Volver al Listado" class="btn btn-primary mr-2">
    </form>
    <form action="../views/home.php">
        <input type="submit" value="Seguir Eliminando" class="btn btn-secondary">
    </form>
</div>