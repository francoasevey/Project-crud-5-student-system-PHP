<?php
$db_host = "localhost"; 
$db_user = "root";
$db_pass = "";
$db_name = "systemalumnos";

$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

        if (!$link) {
            echo "Error: no se puede conectar a MYSQL." . PHP_EOL;
            echo "<br>";
            echo "error de depuración: " . mysqli_connect_errno() . PHP_EOL;
            echo "<br>";
            echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
            exit();
        }
?>
