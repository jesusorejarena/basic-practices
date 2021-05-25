DROP DATABASE IF EXISTS aereopuerto;
CREATE DATABASE IF NOT EXISTS aereopuerto;

USE aereopuerto;

CREATE TABLE IF NOT EXISTS usuarios(
	cedula INT(11) PRIMARY KEY,
	nombre VARCHAR(30)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS avion(
	matricula VARCHAR(30) PRIMARY KEY,
	fabricante VARCHAR(30),
	modelo VARCHAR(30),
	capacidad INT(3),
	autonomia INT(4)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS personal(
	cedula INT(11) PRIMARY KEY,
	nombre VARCHAR(30),
	categoria VARCHAR(30)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS vuelo(
	id_vuelo INT(11) PRIMARY KEY,
	fecha DATE,
	destino VARCHAR(30),
	origen VARCHAR(30),
	matricula VARCHAR(30),
	FOREIGN KEY (matricula) REFERENCES avion(matricula) ON CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS tripulacion(
	id_vuelo INT(11),
	puesto INT(11),
	cedula INT(11),
	FOREIGN KEY (id_vuelo) REFERENCES vuelo(id_vuelo) ON CASCADE,
	FOREIGN KEY (cedula) REFERENCES personal(cedula) ON CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS lista_de_pasajeros(
	id_vuelo INT(11),
	cedula INT(11),
	puesto INT(11),
	clase VARCHAR(30),
	FOREIGN KEY (id_vuelo) REFERENCES vuelo(id_vuelo) ON CASCADE,
	FOREIGN KEY (cedula) REFERENCES usuarios(cedula) ON CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;