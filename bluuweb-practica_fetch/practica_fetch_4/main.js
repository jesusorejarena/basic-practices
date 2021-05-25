var contenido = document.querySelector('#contenido');

function traer() {
	fetch('tabla.json')
		.then((res) => res.json())
		.then((datos) => {
			/* console.log(res); */
			tabla(datos);
		});
}

function tabla(datos) {
	for (let valor of datos) { //el mas + sirve para concatenar cuando son ciclos
		contenido.innerHTML += `
		<tr>
			<td>${valor.id}</td>
			<td>${valor.nombre}</td>
			<td>${valor.email}</td>
			<td>${valor.estado ? "Activo" : "Eliminado"}</td>
		</tr>`;
	}
}
