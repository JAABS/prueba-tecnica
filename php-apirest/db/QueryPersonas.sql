
-- Crear la base de datos
CREATE DATABASE personas;

-- Crear la tabla personas
CREATE TABLE personas(
	persona_id SERIAL PRIMARY KEY,
	nombre VARCHAR(60),
	edad INT
);



-- Insertar registros para pruebas
INSERT INTO personas (nombre, edad) VALUES('alfredo', 22)
INSERT INTO personas (nombre, edad) VALUES('jorge', 20)
INSERT INTO personas (nombre, edad) VALUES('matias', 34)
INSERT INTO personas (nombre, edad) VALUES('armando', 35)
INSERT INTO personas (nombre, edad) VALUES('shepard', 30)
INSERT INTO personas (nombre, edad) VALUES('jhon', 117)



-- Crear una funcion para insertar registros en la tabla personas
CREATE FUNCTION insertar_persona(nombre varchar, edad int) returns void
as
$$

INSERT INTO personas (nombre, edad) VALUES(nombre, edad);

$$
LANGUAGE SQL


-- LLamar la funcion para insertar los registros
SELECT insertar_persona('ramon', 46)

-- Mostrar los registros
SELECT * FROM personas