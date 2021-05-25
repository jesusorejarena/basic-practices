var formulario = document.getElementById('formulario');
var respuesta = document.getElementById('respuesta');

formulario.addEventListener('submit', function (e) {
	e.preventDefault();
	console.log('Click');

	var datos = new FormData(formulario);

	console.log(datos.get('pass'));
	console.log(datos.get('usuario'));

	fetch('post.php', {
		method: 'POST',
		body: datos,
	})
		.then((res) => res.json())
		.then((data) => {
			console.log(data);
			if (data == 'error') {
				respuesta.innerHTML = `
					<div class="alert alert-danger">
						<strong>Llena todos los campos</strong>
					</div>
				`;
			} else {
				respuesta.innerHTML = `
					<div class="alert alert-primary">
						<strong>${data}</strong>
					</div>
				`;
			}
		});
});
