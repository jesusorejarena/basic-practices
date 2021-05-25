var contenido = document.querySelector('#contenido');

function traer() {
	fetch('https://randomuser.me/api/')
		.then((res) => res.json())
		.then((res) => {
			console.log(res.results['0']);
			contenido.innerHTML = `
			<img src="${res.results['0'].picture.large}" alt="" width="100px" class="img-fluid img-thumbnail rounded-circle">
				<p>Nombre: ${res.results['0'].name.last}</p>
			`;
		});
}
