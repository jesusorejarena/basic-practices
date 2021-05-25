class Product {
	constructor(name, price, year) {
		this.name = name;
		this.price = price;
		this.year = year;
	}
}

class UI {
	//Interfaz de usuario

	addProduct(product) {
		const productList = document.getElementById('product-list'); //donde se muestra la lista
		const element = document.createElement('div'); // creamos un div para guardar los productos
		element.innerHTML = `
			<div class="card text-center mb-4">
				<div class="card-body">
					<strong>Product Name</strong>: ${product.name} - 
					<strong>Product Price</strong>: ${product.price} -
					<strong>Product Year</strong>: ${product.year}
					<a href="#" class="btn btn-danger" name="delete">Delete</a>
				</div> 
			</div>
			
		`; // $product.name son objetos
		//insertamos el producto bactlist, son las tildes de javascript

		productList.appendChild(element); //para insertar mediante un elemnto hijo
		this.resetForm(); //llamamos al reset form
	}

	resetForm() {
		document.getElementById('product-form').reset(); // resetea el formulario a traves del id del formulario
	}

	deleteProduct(element) {
		if (element.name === 'delete') {
			//verifica cual producto se quiere borrar
			element.parentElement.parentElement.parentElement.remove(); //eliminamos los elementos (divs) padres hasta que lleguemos al product listo
			this.showMessage('Product deleted successfully', 'danger'); //mostramos el mensaje que eliminamos un producto
		}
	}

	showMessage(message, cssClass) {
		const div = document.createElement('div'); //creamos el div
		div.className = `alert alert-${cssClass} mt-2`; //agregamos las clases y le concatenamos las variables que le van a llegar por parametro
		div.appendChild(document.createTextNode(message)); // se le agregar el mensaje
		// showing in DOM
		const container = document.querySelector('.container');
		const app = document.querySelector('#app');
		container.insertBefore(div, app); // se lo agregamos en medio de el div y app
		setTimeout(function () {
			//esta funcion se va a ejecutar despues de tantos segundos
			document.querySelector('.alert').remove(); //seleccionamos el elemento que todas las clases comienzen con .alert
		}, 3000);
	}
}

//DOM events

document
	.getElementById('product-form') // id del formulario
	.addEventListener('submit', function (e) {
		// el addEventListener se trata de capturar distintos eventos
		const name = document.getElementById('name').value; //e que es evento es para capturar las funciones y es un objeto
		const price = document.getElementById('price').value; //esto es para obtener lo que esta dentro del input
		const year = document.getElementById('year').value;

		const product = new Product(name, price, year); //objeto que se le pasan los parametros para que sea global
		const ui = new UI(); // instanciamos la clase para su uso

		if (name === '' || price === '' || year === '') {
			//verificamos si los campos estan llenos
			return ui.showMessage('Complete Fields Please', 'warning'); // el return lo que hace es que no continue con el resto del codigo
		}

		ui.addProduct(product); //le pasamos los parametros del producto
		ui.resetForm(); //tambien podemos acceder desde aqui por que es un objeto
		ui.showMessage('Product Added successfully', 'success'); // agregamos el mensaje de producto agregado

		e.preventDefault(); // se trata de cancelar el comportamiento por defecto que lo que hace es recargar la pagina
	});

document.getElementById('product-list').addEventListener('click', function (e) {
	//capturamos el elemento a eliminar
	const ui = new UI();
	ui.deleteProduct(e.target); //el target lo que hace es comprobar si es el enlace que ha dado el usuario
});
