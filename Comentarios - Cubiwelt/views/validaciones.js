(function () {
	'use strict';
	window.addEventListener(
		'load',
		function () {
			document.getElementById('formulario')?.addEventListener(
				'submit',
				(e) => {
					let titulo = document.getElementById('titulo')?.value;
					let comentario = document.getElementById('comentario')?.value;

					// Validacion de titulo
					if (titulo != undefined) {
						if (titulo.length == 0) {
							mensaje(e, 'tituloDiv', 'titulo', 'Ingrese un titulo');
						} else if (titulo.length > 100) {
							mensaje(e, 'tituloDiv', 'titulo', 'El titulo es muy largo');
						} else {
							resetearError('tituloDiv', 'titulo');
						}
					}

					// Validacion de comentario
					if (comentario != undefined) {
						if (comentario.length == 0) {
							mensaje(e, 'comentarioDiv', 'comentario', 'Ingrese su comentario');
						} else if (comentario.length > 500) {
							mensaje(e, 'comentarioDiv', 'comentario', 'El comentario es muy largo');
						} else {
							resetearError('comentarioDiv', 'comentario');
						}
					}
				},
				false
			);
		},
		false
	);
})();

function pausa(e) {
	e.preventDefault();
	e.stopPropagation();
}

function mensaje(e, elem1, elem2, mensaje) {
	const caja = formulario.querySelector(`#${elem1}`);
	const input = formulario.querySelector(`#${elem2}`);
	caja.style.display = 'block';
	input.className += ' is-invalid';
	pausa(e);
	return (caja.innerHTML = mensaje);
}

function resetearError(elem1, elem2) {
	const resetCaja = formulario.querySelector(`#${elem1}`);
	const resetInput = formulario.querySelector(`#${elem2}`);
	resetCaja.style.display = '';
	resetInput.className = 'form-control is-valid';
}
