<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $formUsuario = $_POST["usuario"];
    $formContraseña = $_POST["clave"];
    $formEmail = $_POST["email"];
    $formRol = $_POST["perfil"];
    //$formRol = "operador";

    // Conexión a la base de datos (incluir tu archivo de conexión)
    include '../config/db-connection.php';

    // Preparar consulta para insertar nuevo usuario
    $consulta = "INSERT INTO usuarios (usuario, clave, email, perfil) VALUES ('$formUsuario', '$formContraseña', '$formEmail', '$formRol')";

    // Ejecutar consulta
    if ($link->query($consulta) === TRUE) {
        // Si se insertó correctamente, redirigir a alguna página de éxito o a donde necesites
        header("Location: ../config/sesion.php");
        exit();
    } else {
        // Si hubo un error en la consulta, manejarlo según tu lógica de aplicación
        echo "Error: " . $consulta . "<br>" . $link->error;
    }

    $link->close();
} else {
    // Si no es un método POST, redirigir al formulario de registro
    header("Location: ../views/formulario_registro.php");
    exit();
}
?>
