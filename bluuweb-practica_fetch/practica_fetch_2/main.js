var contenido = document.querySelector('#contenido');

function traer() {
	fetch('texto.txt')
		.then(data => data.text())
		.then(data=> {
			console.log(data);
			contenido.innerHTML = `${data}`;
		});
}
