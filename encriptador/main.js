function encryptar() {
	var texto = document.getElementById('cargarTexto').value;
	var texto_Encryptado = btoa(texto);
	document.getElementById('imprimirTexto').innerHTML = texto_Encryptado;
}
function desencryptar() {
	var texto = document.getElementById('cargarTexto').value;
	var texto_Encryptado = atob(texto);
	document.getElementById('imprimirTexto2').innerHTML = texto_Encryptado;
}
