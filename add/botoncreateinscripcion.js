var formFechaInscripcion = document.getElementById("fecha_inscripcion");
var formCondicionAlumno = document.getElementById("condicion_alumno");
var formAsistencia = document.getElementById("asistencia");
var formNota = document.getElementById("nota");
var formNombre = document.getElementById("nombre");
var formMateria = document.getElementById("materia");

formFechaInscripcion.addEventListener("input", habilitarBotonInscripcion);
formCondicionAlumno.addEventListener("change", habilitarBotonInscripcion);
formAsistencia.addEventListener("change", habilitarBotonInscripcion);
formNota.addEventListener("input", habilitarBotonInscripcion);
formNombre.addEventListener("change", habilitarBotonInscripcion);
formMateria.addEventListener("change", habilitarBotonInscripcion);

function habilitarBotonInscripcion() {
  var botonProcesar = document.getElementById("botonProcesarInscripcion");
  if (
    formFechaInscripcion.value.trim() !== "" ||
    formCondicionAlumno.value !== "" ||
    formAsistencia.value !== "" ||
    formNota.value.trim() !== "" ||
    formNombre.value !== "" ||
    formMateria.value !== ""
  ) {
    botonProcesar.removeAttribute("disabled");
  } else {
    botonProcesar.setAttribute("disabled", "disabled");
  }
}