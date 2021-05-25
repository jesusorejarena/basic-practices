const btnToggle = document.querySelector('.navbar-toggler');

btnToggle.addEventListener('click', function(){
	document.getElementById('sidebar').classList.toggle('active');
	document.getElementById('contenido').classList.toggle('sombra');
});