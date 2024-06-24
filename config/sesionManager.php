<?php
session_start();

function checkSession() {
    if (!isset($_SESSION['usuario'])) {
        header("Location: ../config/sesion.php");
        exit();
    }
}

function getUserProfile() {
    return isset($_SESSION['perfil']) ? $_SESSION['perfil'] : null;
}

function isUserAdmin() {
    return getUserProfile() === 'administrativo';
}

function isUserOperator() {
    return getUserProfile() === 'operador';
}
?>
