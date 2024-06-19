document.getElementById("materia").addEventListener("change", function () {
  const materiaId = this.value;
  fetch("getMateriaData.php?id=" + materiaId)
    .then((response) => response.json())
    .then((data) => {
      document.getElementById("fecha_mesa").value = data.fecha;
      document.getElementById("profesor_titular").value = data.profesor_titular;
      document.getElementById("profesor_vocal1").value = data.profesor_vocal1;
      document.getElementById("profesor_vocal2").value = data.profesor_vocal2;
    })
    .catch((error) => console.error("Error:", error));
});
