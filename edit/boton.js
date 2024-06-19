var formName = document.getElementById("name");
var formApellido = document.getElementById("apellido");
var formDNI = document.getElementById("dni");
var formEmail = document.getElementById("email");
var formTelefono = document.getElementById("telefono");

formName.addEventListener("input", habilitarBoton);
formApellido.addEventListener("input", habilitarBoton);
formDNI.addEventListener("input", habilitarBoton);
formEmail.addEventListener("input", habilitarBoton);
formTelefono.addEventListener("input", habilitarBoton);

function habilitarBoton() {
  var botonProcesar = document.getElementById("botonProcesar");
  if (
    formName.value.trim() !== "" ||
    formApellido.value.trim() !== "" ||
    formDNI.value.trim() !== "" ||
    formEmail.value.trim() !== "" ||
    formTelefono.value.trim() !== ""
  ) {
    botonProcesar.removeAttribute("disabled");
  } else {
    botonProcesar.setAttribute("disabled", "disabled");
  }
}

var formFechaInscripcion = document.getElementById("fecha_inscripcion");
var formCondicionAlumno = document.getElementById("condicion_alumno");
var formAsistencia = document.getElementById("asistencia");
var formNota = document.getElementById("nota");
var formMateria = document.getElementById("materia");

formFechaInscripcion.addEventListener("input", habilitarBoton);
formCondicionAlumno.addEventListener("change", habilitarBoton);
formAsistencia.addEventListener("change", habilitarBoton);
formNota.addEventListener("input", habilitarBoton);
formMateria.addEventListener("change", habilitarBoton);

function habilitarBoton() {
  var botonProcesar = document.querySelector("button[type=submit]");
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
