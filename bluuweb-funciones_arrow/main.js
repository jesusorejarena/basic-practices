var saludoId = document.getElementById('saludo');

/* Funcion normal */

/* function saludar (nombre){
	return 'Hola ' + nombre;
} */

/* Funcion Arrow */

var saludar = (nombre) => 'Hola ' + nombre;

saludoId.innerHTML = saludar('Ignacio');

/* ------------------------------------------------------ */

/* Funcion Arrow 2 parametros */

var sumaId = document.getElementById('suma');

var sumar = (num1, num2) => num1 + num2;

sumaId.innerHTML += sumar(10, 15);

/* ------------------------------------------------------ */

/* Funcion Arrow 2 con llaves */

var suma2Id = document.getElementById('suma2');

var sumar = (num1, num2) => {
	var num3 = 10;
	return num1 + num2 + num3;
};

suma2Id.innerHTML += sumar(10, 15);
