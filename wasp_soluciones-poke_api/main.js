let lista = document.getElementById('listaPokemon');

// API

function consultarPokemon(id, num) {
	fetch(`https://pokeapi.co/api/v2/pokemon/${id}`).then(function (response) {
		response.json().then(function (pokemon) {
			crearPokemon(pokemon, num);
		});
	});
}

// Numeros random

function consultarPokemones() {
	let primerId = Math.round(Math.random() * 150);
	let segundoId = Math.round(Math.random() * 150);

	consultarPokemon(primerId, 1);
	consultarPokemon(segundoId, 2);
}

// Imprime los pokemones en pantalla

function crearPokemon(pokemon, num) {
	let item = lista.querySelector(`#pokemon-${num}`);

	let imagen = item.getElementsByTagName('img')[0];
	imagen.setAttribute('src', pokemon.sprites.front_default);

	let nombre = item.getElementsByTagName('p')[0];
	nombre.textContent = pokemon.name;
}

consultarPokemones();
