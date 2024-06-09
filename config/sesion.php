<?php
session_start(); // Iniciar o continuar la sesión

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db_host = "localhost"; 
    $db_user = "root";
    $db_pass = "";
    $db_name = "sistemagestionexamenes";
    
    $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    
    if (!$link) {
        echo "Error: no se puede conectar a MYSQL." . PHP_EOL;
        echo "<br>";
        echo "error de depuración: " . mysqli_connect_errno() . PHP_EOL;
        echo "<br>";
        echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
        exit();
    }

    // Obtener los datos del formulario
    $usuario = $_POST["usuario"];
    $clave = $_POST["password"];

    // Consulta para verificar las credenciales en la base de datos
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
    $result = $link->query($sql);

    if ($result->num_rows > 0) {
        // Iniciar sesión si las credenciales son correctas
        $_SESSION["usuario"] = $usuario;

        // Redireccionar al usuario a la página principal del proyecto
        header("Location: ../views/home.php");
        exit();
    } else {
        // Mensaje de error si las credenciales son incorrectas
        header("Location: ../sesion.php?error=1"); // Redirigir con un parámetro GET indicando el error
        exit();
    }

    // Cerrar la conexión
    $link->close();
}
?>
