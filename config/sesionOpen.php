<?php
session_start();
if (isset($_SESSION["usuario"])) {
    echo '<li class="nav-item">';
    echo '<span class="nav-link">Bienvenido, ' . $_SESSION["usuario"] . '</span>';
    echo '</li>';
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="../config/logout.php"><i class="fas fa-sign-out-alt"></i></a>';
    echo '</li>';
} else {
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="../config/sesion.php"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a>';
    echo '</li>';
}
?>