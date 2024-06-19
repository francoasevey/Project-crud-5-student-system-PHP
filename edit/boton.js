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
