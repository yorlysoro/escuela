CREATE DATABASE escuela;

USE escuela;

CREATE TABLE padres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cedula VARCHAR(20) UNIQUE NOT NULL,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    direccion VARCHAR(255),
    telefono VARCHAR(20),
    parentesco VARCHAR(50)
);

CREATE TABLE maestros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cedula VARCHAR(20) UNIQUE NOT NULL,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    grado VARCHAR(50),
    seccion VARCHAR(50),
    aula VARCHAR(50)
);

CREATE TABLE alumnos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cedula VARCHAR(20) UNIQUE NOT NULL,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    genero VARCHAR(10),
    fecha_nacimiento DATE,
    edad INT,
    grado VARCHAR(50),
    seccion VARCHAR(50),
    aula VARCHAR(50)
);