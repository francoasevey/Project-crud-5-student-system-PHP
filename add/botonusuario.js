var formUsuario = document.getElementById("usuario");
var formClave = document.getElementById("clave");
var formEmail = document.getElementById("email");
var formPerfil = document.getElementById("perfil");

formUsuario.addEventListener("input", habilitarBoton);
formClave.addEventListener("input", habilitarBoton);
formEmail.addEventListener("input", habilitarBoton);
formPerfil.addEventListener("input", habilitarBoton);

function habilitarBoton() {
  var botonProcesar = document.getElementById("botonProcesar");
  if (
    formUsuario.value.trim() !== "" &&
    formClave.value.trim() !== "" &&
    formEmail.value.trim() !== "" &&
    formPerfil.value.trim() !== ""
  ) {
    botonProcesar.removeAttribute("disabled");
  } else {
    botonProcesar.setAttribute("disabled", "disabled");
  }
}
