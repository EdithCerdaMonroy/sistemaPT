INSERT INTO Empresa (nombre, giro) VALUES
    ('Microsoft', 'Tecnología'),
    ('Telcel', 'Telefonia');

INSERT INTO Usuario (idTipoUsuario, idEmpresa, mail, password, nombre, telefono, edad, escolaridad) VALUES
    (1,1,'edith.cerda@estudiante.uacm.edu.mx', '123', 'Edith Cerda Monroy', '5512345678', 34, 'Medio superior'),
    (1,2,'hazma@gmail.com', '123', 'Hamza Corral', '5522245672', 40, 'Superior'),
    (2,null,'helena@gmail.com', '123', 'Helena Barrios', '5552755672', 30, 'Superior'),
    (2,null,'leticia@gmail.com', '123', 'Leticia de Los Santos', '5589753472', 35, 'Medio superior');;


INSERT INTO Vacante (idEmpresa, idRol, idModalidad, descripcion, sueldo) VALUES
    (1, 1, 1, 'Solicitamos personal responsable.', 80000),
    (2, 2, 1, 'Solicitamos personal responsable.', 25000);

INSERT INTO UsuarioVacante (idUsuario, idVacante) VALUES
    (3, 1),
    (4, 2);