DROP DATABASE IF EXISTS tallerMec;
CREATE DATABASE tallerMec;
use tallerMec;
CREATE TABLE usuarios (
	dni VARCHAR(9) NOT NULL,
	nombre varchar(50) NOT NULL,
	telefono int(9) NOT NULL,
	password varchar(300) NOT NULL,
	tipo varchar(10) NOT NULL,
	estado boolean default 0,
	UNIQUE(dni),
	CONSTRAINT PK_DNI PRIMARY KEY(dni)
);

CREATE TABLE vehiculos(
	dni_c VARCHAR(9) NOT NULL,
	matricula VARCHAR(8) NOT NULL,
    marca VARCHAR(10) NOT NULL,
    modelo VARCHAR(10) NOT NULL,
	tipo varchar(10) NOT NULL,
	gama varchar(10) NOT NULL,
    CONSTRAINT PK_VEH PRIMARY KEY(matricula,tipo),
    CONSTRAINT FK_VECLI FOREIGN KEY(dni_c) REFERENCES usuarios(dni) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE reparar (
	id SMALLINT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
	dni VARCHAR(9) NOT NULL,
	matricula VARCHAR(8) NOT NULL,
	fechaEntrada DATE NOT NULL,
	fechaSalida DATE NULL,
	coste SMALLINT(4) UNSIGNED NOT NULL,
	aceite int(4) NOT NULL,
	motor int(4) NOT NULL,
	ruedas int(4) NOT NULL,
	ventanas int(4) NOT NULL,
	CONSTRAINT PK_HRID PRIMARY KEY(id),
	CONSTRAINT FK_HRDNI FOREIGN KEY(dni) REFERENCES usuarios(dni) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT FK_HRMATVEH FOREIGN KEY(matricula) REFERENCES vehiculos(matricula) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE catalogo (
	id SMALLINT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(15) NOT NULL,
	precio SMALLINT(4) UNSIGNED NOT NULL,
	CONSTRAINT PRIMARY KEY(id)
);
INSERT INTO usuarios (dni, nombre, telefono, password, tipo, estado) values('11111111A','Manolo Diaz',111111111,'1234','Cliente',Null);
INSERT INTO usuarios (dni, nombre, telefono, password, tipo, estado) values('22222222A','Pepe Guzman',222222222,'1234','Empleado',0);
INSERT INTO catalogo (nombre, precio) values('Aceite',20);
INSERT INTO catalogo (nombre, precio) values('Motor',560);
INSERT INTO catalogo (nombre, precio) values('Rueda',200);
INSERT INTO catalogo (nombre, precio) values('Ventana',100);