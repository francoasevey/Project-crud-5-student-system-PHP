<?php
session_start();

// Verificar si el usuario está iniciado sesión
if(isset($_SESSION['usuario'])) {
    // Si el usuario está iniciado sesión, mostrar contenido de inicio de sesión
    echo '<div class="contenido-inicio-sesion">
            Bienvenido, ' . $_SESSION['usuario'] . '! 
            <a href="logout.php">Cerrar sesión</a>
          </div>';
} else {
    // Si el usuario no está iniciado sesión, mostrar formularios de inicio de sesión y registro
    echo '<div class="formulario-inicio-sesion">
            <form action="login.php" method="post">
                <input type="text" name="usuario" placeholder="Usuario">
                <input type="password" name="contrasena" placeholder="Contraseña">
                <button type="submit">Iniciar sesión</button>
            </form>
            <p>¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>
          </div>';
}

?>
