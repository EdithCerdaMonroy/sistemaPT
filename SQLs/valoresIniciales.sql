INSERT INTO Area (nombre) VALUES
    ('Dirección'),
    ('Recursos Humanos'),
    ('Administración'),
    ('TI');

INSERT INTO Rol (idArea, nombre) VALUES
    (1, 'Director'),
    (2, 'Director RH'),
    (2, 'Analista RH'),
    (3, 'Director Admin'),
    (3, 'Analista Admin'),
    (4, 'Lider TI'),
    (4, 'Analista TI'),
    (4, 'Programador TI');

INSERT INTO Modalidad (nombre) VALUES
    ('Presencial'),
    ('Home Office');

INSERT INTO TipoUsuario (nombre) VALUES
    ('Empresa'),
    ('Solicitante');
