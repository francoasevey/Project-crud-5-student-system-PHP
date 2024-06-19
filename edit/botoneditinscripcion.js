var formFechaInscripcion = document.getElementById("fecha_inscripcion");
var formCondicionAlumno = document.getElementById("condicion_alumno");
var formAsistencia = document.getElementById("asistencia");
var formNota = document.getElementById("nota");
var formMateria = document.getElementById("materia");

formFechaInscripcion.addEventListener("input", habilitarBotonInscripcion);
formCondicionAlumno.addEventListener("change", habilitarBotonInscripcion);
formAsistencia.addEventListener("change", habilitarBotonInscripcion);
formNota.addEventListener("input", habilitarBotonInscripcion);
formMateria.addEventListener("change", habilitarBotonInscripcion);

function habilitarBotonInscripcion() {
  var botonProcesar = document.getElementById("botonProcesarInscripcion");
  if (
    formFechaInscripcion.value.trim() !== "" ||
    formCondicionAlumno.value !== "" ||
    formAsistencia.value !== "" ||
    formNota.value.trim() !== "" ||
    formMateria.value !== ""
  ) {
    botonProcesar.removeAttribute("disabled");
  } else {
    botonProcesar.setAttribute("disabled", "disabled");
  }
}