<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link rel="stylesheet" type="text/css" href="../css/sesion.css">

    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
</head>
<body>
    <!--<header>
        <h2 class="logo">BigCity</h2>
        <nav class="navegacion">
            <a href="#">Inicio</a>
            <a href="#">Informacion</a>
            <a href="#">Servicios</a>
            <a href="#">Contactos</a>
            <button class="btn">Iniciar Sesion</button>
        </nav>
    </header>-->

    <div class="fondo">
        <!--<span class="icono-cerrar"><i class="ri-close-fill"></i></span>-->
        <div class="contenedor-form login">
            <h2>Iniciar Sesion</h2>
            <?php
        // Verificar si hay un error y mostrar el mensaje correspondiente
        if (isset($_GET['error'])) {
            echo '<div class="alert alert-danger" role="alert">Usuario o contraseña incorrectos.</div>';
        }
        ?>
            <form action="../config/procesarSesion.php" method="post">
                <div class="contenedor-input">
                    <span class="icono"><i class="ri-mail-fill"></i></span>
                    <input type="text" name="usuario" id="usuario" required>
                    <label for="#">Usuario</label>
                </div>
                <div class="contenedor-input">
                    <span class="icono"><i class="ri-lock-fill"></i></span>
                    <input type="password" name="password" id="password" required>
                    <label for="#">Contraseña</label>
                </div>
                <div class="recordar">
                    <label for="#"><input type="checkbox" name="checkbox" id="checkbox">Recordar Sesion</label>
                    <a href="#">¿Olvide La Contraseña?</a>
                </div>
                <button type="submit" class="btn">Iniciar Sesion</button>
                <div class="registrar">
                    <p>¿No tienes Cuenta? <a href="#" class="registrar-link">Registrarse</a></p>
                </div>
            </form>
        </div>

        <div class="contenedor-form registrar">
            <h2>Registrarse</h2>
            <form action="#">
                <div class="contenedor-input">
                    <span class="icono"><i class="ri-user-fill"></i></span>
                    <input type="text" name="text" id="text" required>
                    <label for="#">Nombre de Usuario</label>
                </div>

                <div class="contenedor-input">
                    <span class="icono"><i class="ri-mail-fill"></i></span>
                    <input type="email" name="email" id="email" required>
                    <label for="#">Email</label>
                </div>
                <div class="contenedor-input">
                    <span class="icono"><i class="ri-lock-fill"></i></span>
                    <input type="password" name="password" id="password" required>
                    <label for="#">Contraseña</label>
                </div>
                <div class="recordar">
                    <label for="#"><input type="checkbox" name="checkbox" id="checkbox">
                    Acepto los Terminos y Condiciones
                    </label>
                </div>
                <button type="submit" class="btn">Registrarme</button>
                <div class="registrar">
                    <p>¿Tienes una Cuenta? <a href="#" class="login-link">Iniciar Sesion</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src="../app.js"></script>
</body>
</html>