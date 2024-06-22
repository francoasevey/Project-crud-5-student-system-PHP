document.getElementById("nombre").addEventListener("change", function () {
    const alumnoId = this.value;
    fetch("getAlumnoData.php?id=" + alumnoId)
      .then((response) => response.json())
      .then((data) => {
        document.getElementById("apellido").value = data.apellido;
        document.getElementById("dni").value = data.dni;
        document.getElementById("email").value = data.email;
        document.getElementById("telefono").value = data.telefono;
      })
      .catch((error) => console.error("Error:", error));
  });
  