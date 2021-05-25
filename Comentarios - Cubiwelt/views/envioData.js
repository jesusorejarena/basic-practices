function like(tipo, cod_com_vid, accion, change) {
	let data = new FormData();

	if (tipo == 'Like') {
		data.append('cod_com_vid', cod_com_vid);
		data.append('accion', accion);
		data.append('change', change);

		let likeBoton = document.getElementById(`like${cod_com_vid}`);
		let dislikeBoton = document.getElementById(`dislike${cod_com_vid}`);

		if (data.get('change') == '' && data.get('accion') == 'agregarLike') {
			likeBoton.style = 'background-color: #480080; border-color: #480080; color: white;';
			data.append('valorAccion', accion);
		} else if (data.get('change') == '' && data.get('accion') == 'quitarLike') {
			likeBoton.style = 'background-color: white; border-color: #480080; color: #480080;';
			data.append('valorAccion', accion);
		} else if (data.get('change') == 'CambiarDislikeLike' && data.get('accion') == 'agregarLike') {
			likeBoton.style = 'background-color: #480080; border-color: #480080; color: white;';
			dislikeBoton.style = 'background-color: white; border-color: #480080; color: #480080;';
			data.append('valorAccion', change);
		}

		/* console.log(data.get('accion'));
		console.log(data.get('change'));
		console.log(data.get('valorAccion')); */
		fetch('like.php', {
			method: 'POST',
			body: data,
		})
			.then((res) => res.json())
			.then((respuesta) => {
				console.log(respuesta);
				if (respuesta == 'error') {
					console.log('Error');
				} else {
					console.log('Paso');
				}
			});
	} else {
		data.append('cod_com_vid', cod_com_vid);
		data.append('accion', accion);
		data.append('change', change);

		let likeBoton = document.getElementById(`like${cod_com_vid}`);
		let dislikeBoton = document.getElementById(`dislike${cod_com_vid}`);

		if (data.get('change') == '' && data.get('accion') == 'agregarDislike') {
			dislikeBoton.style = 'background-color: #480080; border-color: #480080; color: white;';
			data.append('valorAccion', accion);
		} else if (data.get('change') == '' && data.get('accion') == 'quitarDislike') {
			dislikeBoton.style = 'background-color: white; border-color: #480080; color: #480080;';
			data.append('valorAccion', accion);
		} else if (data.get('change') == 'CambiarLikeDislike' && data.get('accion') == 'agregarDislike') {
			dislikeBoton.style = 'background-color: #480080; border-color: #480080; color: white;';
			likeBoton.style = 'background-color: white; border-color: #480080; color: #480080;';
			data.append('valorAccion', change);
		}

		/* console.log(data.get('accion'));
		console.log(data.get('change'));
		console.log(data.get('valorAccion')); */
		fetch('like.php', {
			method: 'POST',
			body: data,
		})
			.then((res) => res.json())
			.then((respuesta) => {
				console.log(respuesta);
				if (respuesta == 'error') {
					console.log('Error');
				} else {
					console.log('Paso');
				}
			});
	}
}

let formulario = document.getElementById('formulario');
let respuestaCaja = document.getElementById('respuestaCaja');

formulario.addEventListener('submit', function (e) {
	e.preventDefault();

	let data = new FormData(formulario);

	fetch('comentarios.php', {
		method: 'POST',
		body: data,
	})
		.then((res) => res.json())
		.then((respuesta) => {
			if (respuesta == 'error') {
				respuestaCaja.innerHTML = `
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Hubo un error.</strong> Recarga la página.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				`;
			} else {
				respuestaCaja.innerHTML = `
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>Enviado correctamente.</strong> Recarga la página para ver el comentario.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				`;
			}
		});
});
