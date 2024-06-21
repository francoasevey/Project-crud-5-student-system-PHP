var formFecha = document.getElementById("fecha");
var formMateria = document.getElementById("materia");
var formTipo = document.getElementById("tipo");
var formProfesorTitular = document.getElementById("profesor_titular");
var formProfesorVocal1 = document.getElementById("profesor_vocal1");
var formProfesorVocal2 = document.getElementById("profesor_vocal2");

formFecha.addEventListener("input", habilitarBoton);
formMateria.addEventListener("input", habilitarBoton);
formTipo.addEventListener("input", habilitarBoton);
formProfesorTitular.addEventListener("input", habilitarBoton);
formProfesorVocal1.addEventListener("input", habilitarBoton);
formProfesorVocal2.addEventListener("input", habilitarBoton);

function habilitarBoton() {
  var botonProcesar = document.getElementById("botonProcesar");
  if (
    formFecha.value.trim() !== "" ||
    formMateria.value.trim() !== "" ||
    formTipo.value.trim() !== "" ||
    formProfesorTitular.value.trim() !== "" ||
    formProfesorVocal1.value.trim() !== "" ||
    formProfesorVocal2.value.trim() !== ""
  ) {
    botonProcesar.removeAttribute("disabled");
  } else {
    botonProcesar.setAttribute("disabled", "disabled");
  }
}
