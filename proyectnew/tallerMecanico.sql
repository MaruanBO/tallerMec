DROP DATABASE IF EXISTS tallerMec;
CREATE DATABASE tallerMec;
use tallerMec;

CREATE TABLE empleados (
	dni VARCHAR(9) NOT NULL,
    nombre varchar(50) NOT NULL,
	telefono int(9) NOT NULL,
	estado boolean default 0,
    UNIQUE(dni),
    CONSTRAINT PK_DNIEMP PRIMARY KEY(dni) 
);

CREATE TABLE clientes(
	dni VARCHAR(9) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    telefono INT(9) UNSIGNED NOT NULL,
	UNIQUE(dni),
    CONSTRAINT PK_CLI PRIMARY KEY(dni)
);

CREATE TABLE vehiculos(
	dni_c VARCHAR(9) NOT NULL,
	matricula VARCHAR(8) NOT NULL,
    marca VARCHAR(10) NOT NULL,
    modelo VARCHAR(10) NOT NULL,
	tipo varchar(10) NOT NULL,
	gama varchar(10) NOT NULL,
    averia varchar(255) NULL,
    CONSTRAINT PK_VEH PRIMARY KEY(matricula,tipo),
    CONSTRAINT FK_VECLI FOREIGN KEY(dni_c) REFERENCES clientes(dni) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE reparar (
	id SMALLINT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
	dni VARCHAR(9) NOT NULL,
	matricula VARCHAR(8) NOT NULL,
	fechaEntrada DATE NOT NULL,
	fechaSalida DATE NULL,
	coste SMALLINT(4) UNSIGNED NOT NULL,
	informe varchar(255) NULL,
	CONSTRAINT PK_HRID PRIMARY KEY(id),
	CONSTRAINT FK_HRDNIEMP FOREIGN KEY(dni) REFERENCES empleados(dni) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT FK_HRMATVEH FOREIGN KEY(matricula) REFERENCES vehiculos(matricula) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE catalogo (
	id SMALLINT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(15) NOT NULL,
	precio SMALLINT(4) UNSIGNED NOT NULL,
	CONSTRAINT PRIMARY KEY(id)
);

CREATE TABLE usuarios (
	user VARCHAR(50) NOT NULL,
	password VARCHAR(500) NOT NULL,
	tipo VARCHAR(50) NOT NULL
);

INSERT INTO empleados (dni,nombre,telefono) values('11111111N','Manolo','876392042');
INSERT INTO clientes (dni,nombre,telefono) values('22222222N','Pepe','687645321');
INSERT INTO vehiculos (dni_c,matricula,marca,modelo,tipo,gama) values('22222222N','8764GFX','SEAT','IBIZA','coche','media');
INSERT INTO catalogo (nombre, precio) values('Aceite',20);
INSERT INTO catalogo (nombre, precio) values('Motor',560);
INSERT INTO catalogo (nombre, precio) values('Rueda',200);
INSERT INTO catalogo (nombre, precio) values('Ventana',100);