var nombre = document.getElementById('nombre');
var password = document.getElementById('password');
var error = document.getElementById('error');
error.style.color = 'red';

var form = document.getElementById('formulario');

form.addEventListener('submit', (e) => {
	e.preventDefault();

	var mensajeError = [];

	if (nombre.value === null || nombre.value === '') {
		mensajeError.push('ingresa tu nombre');
	}
	if (password.value === null || password.value === '') {
		mensajeError.push('ingresa tu password');
	}

	error.innerHTML = mensajeError.join(', ');

});
