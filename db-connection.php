<?php
$db_host = "localhost"; 
$db_user = "root";
$db_pass = "";
$db_name = "systemalumnos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
