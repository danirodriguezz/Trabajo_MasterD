DROP DATABASE IF EXISTS Bienes_RaicesMVC;

CREATE DATABASE Bienes_RaicesMVC;

USE Bienes_RaicesMVC;


CREATE TABLE users_data (
    id INT  UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    telefono VARCHAR(255) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    direccion VARCHAR(255) NULL,
    sexo VARCHAR(255) NULL
);

CREATE TABLE users_login (
    id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    idUser INT UNSIGNED NOT NULL,
    usuario VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol VARCHAR(255) NOT NULL,
    FOREIGN KEY(idUser) REFERENCES users_data(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE citas (
    id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    idUser INT UNSIGNED NOT NULL,
    fecha_cita DATE NOT NULL,
    motivo_cita VARCHAR(255) NULL,
    FOREIGN KEY (idUser) REFERENCES users_data(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
); 

CREATE TABLE noticias(
    id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    idUser INT UNSIGNED NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    imagen VARCHAR(255) NOT NULL,
    texto VARCHAR(255) NOT NULL,
    fecha DATE NOT NULL,
    FOREIGN KEY (idUser) REFERENCES users_data(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE propiedades (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    idUser INT UNSIGNED NOT NULL,
    titulo VARCHAR(45),
    precio DECIMAL(10,2),
    imagen VARCHAR(255),
    descripcion LONGTEXT,
    habitaciones INT(1),
    wc INT(1),
    estacionamiento INT(1),
    creado DATE,
    FOREIGN KEY(idUser) REFERENCES users_data(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

INSERT INTO users_data(nombre, apellido, email, telefono, fecha_nacimiento, direccion, sexo) VALUES("Admin", "Admin", "correo@correo.com", "123456789",
"2002-06-16", "Calle Aguileña", "masculino");
INSERT INTO users_login(idUser, usuario, pasword, rol) VALUES("2", "admin", "123456", "admin");
INSERT INTO noticias(idUser, titulo, imagen, texto, fecha) VALUES("1", "TITULO", "IMAGEN", "TEXTO", "2002-08-14");



