<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formUsuario = $_POST["usuario"];
    $formContraseña = $_POST["clave"];
    $formEmail = $_POST["email"];
    $formRol = $_POST["perfil"];
    //$formRol = "operador";

    include '../config/db-connection.php';

    $consulta = "INSERT INTO usuarios (usuario, clave, email, perfil) VALUES ('$formUsuario', '$formContraseña', '$formEmail', '$formRol')";

    if ($link->query($consulta) === TRUE) {
        header("Location: ../views/home.php");
        exit();
    } else {
        echo "Error: " . $consulta . "<br>" . $link->error;
    }

    $link->close();
} else {
    header("Location: ../views/formulario_registro.php");
    exit();
}
?>
