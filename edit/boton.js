
        // Captura los campos del formulario
        var formName = document.getElementById("name");
        var formApellido = document.getElementById("apellido");
        var formDNI = document.getElementById("dni");
        var formEmail = document.getElementById("email");
        var formTelefono = document.getElementById("telefono");

        // Agrega un event listener para detectar cambios en los campos del formulario
        formName.addEventListener("input", habilitarBoton);
        formApellido.addEventListener("input", habilitarBoton);
        formDNI.addEventListener("input", habilitarBoton);
        formEmail.addEventListener("input", habilitarBoton);
        formTelefono.addEventListener("input", habilitarBoton);

        // Función para habilitar/deshabilitar el botón "Procesar" según si hay cambios en el formulario
        function habilitarBoton() {
            var botonProcesar = document.getElementById("botonProcesar");
            // Verifica si hay cambios en los campos del formulario
            if (formName.value.trim() !== "" || formApellido.value.trim() !== "" || formDNI.value.trim() !== "" || formEmail.value.trim() !== "" || formTelefono.value.trim() !== "") {
                botonProcesar.removeAttribute("disabled"); // Habilita el botón
            } else {
                botonProcesar.setAttribute("disabled", "disabled"); // Deshabilita el botón
            }
        }