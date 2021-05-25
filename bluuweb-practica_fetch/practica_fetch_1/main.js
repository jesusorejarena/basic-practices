/* var objeto = {
	nombre: 'HTML',
	duracion: 15,
	estado: true,
	capitulos: {
		nombre: 'Introduccion',
		videos: 20,
	},
};

console.log(objeto);

console.log(objeto.duracion);

console.log(objeto.capitulos);

console.log(objeto.capitulos.videos); */

var arrayObjetos = [
	{
		nombre: 'HTML',
		estado: true,
	},
	{
		nombre: 'CSS',
		estado: true,
	},
	{
		nombre: 'JS',
		estado: false,
	},
];

/* console.log(arrayObjetos[0].nombre);
console.log(arrayObjetos[1].nombre);
console.log(arrayObjetos[2].nombre); */

for(let indice of arrayObjetos){
	console.log(indice);
}
