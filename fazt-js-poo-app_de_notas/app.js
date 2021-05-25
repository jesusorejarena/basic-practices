document.getElementById('formTask').addEventListener('submit', saveTask); //leemos si se ha ejecutado un evento de tipo click en el formulario

function saveTask(e) {
	let title = document.getElementById('title').value; //guardamos el titulo
	let description = document.getElementById('description').value; //guardamos la descripcion

	const task = {
		// con vertimos en objeto las variables
		title, // forma abreviada de title: title
		description,
	};

	if (localStorage.getItem('tasks') === null) {
		//verifica que no haya guardado nada en el localStorage

		let tasks = []; //crea un arreglo
		tasks.push(task); //almacena el objeto al arreglo
		localStorage.setItem('tasks', JSON.stringify(tasks)); // almacenamos en el localStorage y convertimos el objeto a un string
	} else {
		let tasks = JSON.parse(localStorage.getItem('tasks')); //para obtener datos del localStorage
		tasks.push(task); //almacena el objeto al arreglo viejo
		localStorage.setItem('tasks', JSON.stringify(tasks)); // almacenamos en el localStorage y convertimos el objeto a un string
	}

	getTasks(); // lee las notas apenas se ha guardado una

	document.getElementById('formTask').reset(); //se resetea el formulario apenas se guarda una nota

	e.preventDefault(); // hacemos que el navegador no se recargue
}

function getTasks() {
	let tasks = JSON.parse(localStorage.getItem('tasks')); //lee el localStorage para ver si hay algo almacenado
	let tasksView = document.getElementById('tasks'); //guarda el div

	tasksView.innerHTML = ``;

	for (let i = 0; i < tasks.length; i++) {
		//recorre el arreglo

		let title = tasks[i].title; //guarda el texto en un variable por medio de un arreglo objeto que se ha separado
		let description = tasks[i].description;

		tasksView.innerHTML += `
			<div class="card m-2">
				<div class="card-body">
					<p>${title} - ${description}</p>
					<a href="#" class="btn btn-danger" onclick="deleteTasks('${title}')">Delete</a>
				</div>
			</div>
		`; //el deleteTasks es la funcion de eliminar y le pasa por parametro el titulo
	}
}

function deleteTasks(title) {
	//le llega por parametro el titulo para la nota a eliminar

	let tasks = JSON.parse(localStorage.getItem('tasks')); //guarda las notas en el arreglo

	for (let i = 0; i < tasks.length; i++) {
		//recorre el arreglo
		if (tasks[i].title == title) {
			//verifica si el boton que se presiono es el mismo con la nota que se quiere borrar
			tasks.splice(i, 1); //borra ese objeto del arreglo
		}
	}

	localStorage.setItem('tasks', JSON.stringify(tasks)); //vuelve a guardar y a convertir los objetos del arreglo en string

	getTasks(); //ejecuta la funcion de leer el localStorage
}

getTasks(); //ejecuta la funcion de leer el localStorage apenas entre a la pagina
