// filter()

const listaEdades = [24, 16, 28, 12, 14, 60, 40, 26];

// Mayores de edad

// Usando el metodo filter

// Funcion normal

/* const mayoresDeEdad = listaEdades.filter(function (item) {
	return item > 18;
}); */

// Funcion Arrow

const mayoresDeEdad = listaEdades.filter((item) => item > 18);

console.log(listaEdades);
console.log(mayoresDeEdad);

// Sin el metodo filter

/* const mayoresDeEdad = [];

for (let i = 0; i < listaEdades.length; i++) {
	if (listaEdades[i] > 18) {
		// Forma parte de la nueva lista
		mayoresDeEdad.push(listaEdades[i]);
	}
	// No pasa nada
}

console.log(listaEdades);
console.log(mayoresDeEdad); */

// Objetos

let students = [
	{
		name: 'Alvaro',
		score: 10,
	},
	{
		name: 'Daniel',
		score: 16,
	},
	{
		name: 'Alexys',
		score: 12,
	},
	{
		name: 'Rafa',
		score: 17,
	},
	{
		name: 'Alejandro',
		score: 8,
	},
	{
		name: 'Sofia',
		score: 9,
	},
];

const aprobados = students.filter(function (estudiante) {
	return estudiante.score >= 11;
});

console.log(students);
console.log(aprobados);
