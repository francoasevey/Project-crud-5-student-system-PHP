<?php
session_start();
session_destroy();
header("Location: ../config/sesion.php");
exit();
?>
