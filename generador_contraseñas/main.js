var canvas = document.getElementById('canvaspassword');
var ctx = canvas.getContext('2d');

function generarPassword() {
	miclave();
}

function miclave() {
	var clv1 = document.getElementById('for1').value;
	var clv2 = document.getElementById('for2').value;
	var clv3 = document.getElementById('for3').value;
	var clv4 = document.getElementById('for4').value;

	var vec1 = clv1.match(/[0-9]{1}/g);
	var vec2 = clv2.match(/[aeiouAEIOU]{1}/g);
	var vec3 = clv3.match(/[qwrtypsdfghjklzxcvbnmQWRTYPSDFGHJKLZXCVBNM]{1}/g);
	var vec4 = clv4.match(/[0-9]{1}/g);

	for (var i = 0; i < vec1.length; i++) {
		vec1[i] = parseInt(vec1[i]);
		var dat1 = 0;
		dat1 = dat1 + vec1[i];
		break;
	}

	for (var i = 0; i < vec2.length; i++) {
		var dat2;
		dat2 = vec2[i];
		break;
	}

	for (var i = 0; i < vec3.length; i++) {
		var dat3;
		dat3 = vec3[i];
		break;
	}

	for (var i = 0; i < vec2.length; i++) {
		var dat4 = 0;
		vec4[i] = parseInt(vec4[i]);
		dat4 = dat4 + vec4[i];
		break;
	}

	for (var i = 3; i < vec1.length; i++) {
		vec1[i] = parseInt(vec1[i]);
		var dat5 = 0;
		dat5 = dat5 + vec1[i];
		break;
	}

	for (var i = 3; i < vec2.length; i++) {
		var dat6;
		dat6 = vec2[i];
		break;
	}

	for (var i = 3; i < vec3.length; i++) {
		var dat7;
		dat7 = vec3[i];
		break;
	}

	for (var i = 3; i < vec2.length; i++) {
		var dat8 = 0;
		vec4[i] = parseInt(vec4[i]);
		dat8 = dat8 + vec4[i];
		break;
	}

	if (document.getElementById('seguro').checked) {
		ctx.clearRect(0, 0, canvas.width, canvas.height);

		ctx.font = 'bold 40px arial , sans-serif';
		ctx.textAlign = 'start';
		ctx.fillStyle = '#FFFFFF';
		ctx.fill();
		ctx.fillText(
			'Password : ' +
				dat2 +
				'' +
				dat3 +
				'' +
				dat6 +
				'' +
				dat7 +
				'' +
				dat4 +
				'' +
				dat8 +
				'' +
				dat5 +
				'' +
				dat1,
			50,
			90
		);
	}

	if (document.getElementById('muyseguro').checked) {
		ctx.clearRect(0, 0, canvas.width, canvas.height);

		ctx.font = 'bold 40px arial , sans-serif';
		ctx.textAlign = 'start';
		ctx.fillStyle = '#FFFFFF';
		ctx.fill();
		ctx.fillText(
			'Password : ' +
				dat1 +
				'' +
				dat5 +
				'' +
				dat6 +
				'' +
				dat7 +
				'' +
				dat4 +
				'' +
				dat8 +
				'' +
				dat3 +
				'' +
				dat2,
			50,
			90
		);
	}

	if (document.getElementById('extraseguro').checked) {
		ctx.clearRect(0, 0, canvas.width, canvas.height);

		ctx.font = 'bold 40px arial , sans-serif';
		ctx.textAlign = 'start';
		ctx.fillStyle = '#FFFFFF';
		ctx.fill();
		ctx.fillText(
			'Password : ' +
				dat5 +
				'' +
				dat6 +
				'' +
				dat8 +
				'' +
				dat3 +
				'' +
				dat1 +
				'' +
				dat7 +
				'' +
				dat4 +
				'' +
				dat2,
			50,
			90
		);
	}

	if (document.getElementById('ultraseguro').checked) {
		ctx.clearRect(0, 0, canvas.width, canvas.height);

		ctx.font = 'bold 40px arial , sans-serif';
		ctx.textAlign = 'start';
		ctx.fillStyle = '#FFFFFF';
		ctx.fill();
		ctx.fillText(
			'Password : @' +
				dat5 +
				'' +
				dat6 +
				'_' +
				dat8 +
				'' +
				dat3 +
				'#' +
				dat1 +
				'' +
				dat7 +
				'$' +
				dat4 +
				'' +
				dat2,
			50,
			90
		);
	}
} // Fin de la función

function f1(control) {
	if (control.value.length < 4) {
		control.value = '';
	} else if (control.value.length == 4) {
		var patron = /[0-9]{4}/;
		var valor = document.getElementById('for1').value;

		if (patron.test(valor)) {
		} else {
			control.value = '';
		}
	}
}

function f2(control) {
	if (control.value.length < 4) {
		control.value = '';
	} else if (control.value.length == 4) {
		var patron = /[aeiouAEIOU]{4}/;
		var valor = document.getElementById('for2').value;

		if (patron.test(valor)) {
		} else {
			control.value = '';
		}
	}
}

function f3(control) {
	if (control.value.length < 4) {
		control.value = '';
	} else if (control.value.length == 4) {
		var patron = /[qwrtypsdfghjklzxcvbnmQWRTPSDFGHJKLZXCVBNM]{4}/;
		var valor = document.getElementById('for3').value;

		if (patron.test(valor)) {
		} else {
			control.value = '';
		}
	}
}

function f4(control) {
	if (control.value.length < 4) {
		control.value = '';
	} else if (control.value.length == 4) {
		var patron = /[0-9]{4}/;
		var valor = document.getElementById('for4').value;

		if (patron.test(valor)) {
		} else {
			control.value = '';
		}
	}
}
