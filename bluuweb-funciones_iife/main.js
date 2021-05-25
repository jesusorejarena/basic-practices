// Funciones IIFE (Immediately Invoked Function Expression)

// Funcion normal

function suscribete1() {
	console.log(`Suscribete a mi canal! Funcion normal`);
}
suscribete1();

// Funcion IIFE

(function suscribete2() {
	console.log(`Suscribete a mi canal! Funcion IIFE`);
})();

// Funcion de flecha con IIFE

(() => {
	console.log(`Suscribete a mi canal! Funcion de Flecha IIFE`);
})();

// Funcion de flecha con IIFE con Parametros

((nombre) => {
	console.log(
		`Suscribete a mi canal! Funcion de Flecha IIFE con Parametros, ${nombre}`
	);
})('Juanito');

// Funcion de flecha con IIFE con Parametros por Defecto

((nombre = 'Juan') => {
	console.log(
		`Suscribete a mi canal! Funcion de Flecha IIFE con Parametros, ${nombre}`
	);
})();
