
function cargarDatosAlumno() {
  var alumnoId = document.getElementById('nombre').value;
  fetch('getAlumnoData.php?id=' + alumnoId)
    .then(response => response.json())
    .then(data => {
      document.getElementById('apellido').value = data.apellido;
      document.getElementById('dni').value = data.dni;
      document.getElementById('email').value = data.email;
      document.getElementById('telefono').value = data.telefono;
    })
    .catch(error => console.error('Error:', error));

  cargarMateriasDisponibles(alumnoId);
}
function cargarDatosMateria() {
  var materiaId = document.getElementById('materia').value;
  fetch('getMateriaData.php?id=' + materiaId)
    .then(response => response.json())
    .then(data => {
      document.getElementById('fecha').value = data.fecha;
      document.getElementById('profesor_titular').value = data.profesor_titular;
      document.getElementById('profesor_vocal1').value = data.profesor_vocal1;
      document.getElementById('profesor_vocal2').value = data.profesor_vocal2;
    })
    .catch(error => console.error('Error:', error));
}

function cargarMateriasDisponibles(alumnoId) {
  fetch('getMateriasDisponibles.php?id=' + alumnoId)
    .then(response => response.json())
    .then(data => {
      var selectMateria = document.getElementById('materia');
      selectMateria.innerHTML = ''; // Limpiar opciones actuales

      var optionDefault = document.createElement('option');
      optionDefault.value = '';
      optionDefault.textContent = 'Seleccione una Materia';
      optionDefault.disabled = true;
      optionDefault.selected = true;
      selectMateria.appendChild(optionDefault);

      data.forEach(materia => {
        var option = document.createElement('option');
        option.value = materia.id_mesa;
        option.textContent = materia.materia;
        selectMateria.appendChild(option);
      });
    })
    .catch(error => console.error('Error:', error));
}

/*var today = new Date().toISOString().split('T')[0];
      if (materia.fecha < today) {
        document.getElementById("nota").removeAttribute("readonly");
        document.getElementById("botonProcesarInscripcion").removeAttribute("disabled");
      } else {
        document.getElementById("nota").setAttribute("readonly", true);
        document.getElementById("botonProcesarInscripcion").setAttribute("disabled", true);
      }*/