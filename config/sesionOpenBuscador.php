<?php
session_start();
if (isset($_SESSION["usuario"])) {
  $userNav = '<li class="nav-item">
                    <span class="nav-link">Bienvenido, ' . $_SESSION["usuario"] . '</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../config/logout.php"><i class="fas fa-sign-out-alt"></i></a>
                </li>';
} else {
  $userNav = '<li class="nav-item">
                    <a class="nav-link" href="../config/sesion.php"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a>
                </li>';
}
