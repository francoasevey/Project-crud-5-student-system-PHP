<?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
          include '../config/db-connection.php';
          $formID = $_POST["id"];

          $consulta = "SELECT * FROM mesas_examen WHERE id_mesas='$formID'";
          if (!($resultado = mysqli_query($link, $consulta))) {
            echo "<div class='alert alert-danger' role='alert'>";
            echo "Error: La consulta SQL tiene un problema, verificar.<br>";
            echo "$consulta";
            echo "</div>";
            exit();
          }
          $row = mysqli_fetch_row($resultado);
        } else {
          echo "<div class='alert alert-warning' role='alert'>";
          echo "No se han recibido datos del formulario.";
          echo "</div>";
          header("Location: ../views/home.php");
          exit();
        }
        ?>