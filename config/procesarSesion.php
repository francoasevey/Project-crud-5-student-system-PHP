<?php
session_start(); 
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

    $usuario = $_POST["usuario"];
    $clave = $_POST["password"];

    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
    $result = $link->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION["usuario"] = $usuario;

        header("Location: ../views/home.php");
        exit();
    } else {
        header("Location: ../config/sesion.php?error=1"); 
        exit();
    }

    $link->close();
}
?>
