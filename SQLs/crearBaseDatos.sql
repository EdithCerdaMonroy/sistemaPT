CREATE TABLE Area (
    id int NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE (nombre)
);

CREATE TABLE Rol (
    id int NOT NULL AUTO_INCREMENT,
    idArea int NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE (nombre),
    FOREIGN KEY (idArea) REFERENCES Area(id)
);

CREATE TABLE Modalidad (
    id int NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE (nombre)
);

CREATE TABLE TipoUsuario (
    id int NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE (nombre)
);

CREATE TABLE Empresa (
    id int NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    giro VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE Usuario (
    id int NOT NULL AUTO_INCREMENT,
    idTipoUsuario int NOT NULL,
    idEmpresa int,
    mail VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    nombre VARCHAR(255),
    telefono VARCHAR(255),
    edad int,
    escolaridad VARCHAR(255),
    PRIMARY KEY (id),
    UNIQUE (mail),
    FOREIGN KEY (idTipoUsuario) REFERENCES TipoUsuario(id),
    FOREIGN KEY (idEmpresa) REFERENCES Empresa(id)
);

CREATE TABLE Vacante (
    id int NOT NULL AUTO_INCREMENT,
    idEmpresa int NOT NULL, 
    idRol int NOT NULL, 
    idModalidad  int NOT NULL, 
    descripcion VARCHAR(255) NOT NULL, 
    sueldo float,
    PRIMARY KEY (id),
    FOREIGN KEY (idEmpresa) REFERENCES Empresa(id),
    FOREIGN KEY (idRol) REFERENCES Rol(id),
    FOREIGN KEY (idModalidad) REFERENCES Modalidad(id)
);

CREATE TABLE UsuarioVacante (
    id int NOT NULL AUTO_INCREMENT,
    idUsuario int NOT NULL,
    idVacante int NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (idUsuario) REFERENCES Usuario(id),
    FOREIGN KEY (idVacante) REFERENCES Vacante(id)
);