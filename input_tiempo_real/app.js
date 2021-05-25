var text = document.getElementById('text');

text.addEventListener('keyup', (e) => {
	var inputText = e.path[0].value;
	document.querySelector('.toUpper').innerHTML = inputText.toUpperCase();
})