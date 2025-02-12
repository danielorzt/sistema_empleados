-- Crear la base de datos
CREATE DATABASE
IF NOT EXISTS proyecto_mvc;
USE proyecto_mvc;

-- Crear la tabla Admin
CREATE TABLE
IF NOT EXISTS Admin
(
    idAdmin INT AUTO_INCREMENT PRIMARY KEY,
    correo VARCHAR
(50) NOT NULL UNIQUE,
    contrasena VARCHAR
(160) NOT NULL
);

-- Crear la tabla Empleados
CREATE TABLE
IF NOT EXISTS Empleados
(
    idEmpleados INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR
(50) NOT NULL,
    correo VARCHAR
(50) NOT NULL,
    cargo VARCHAR
(50) NOT NULL,
    telefono VARCHAR
(50) NOT NULL,
    cedula VARCHAR
(50) NOT NULL,
    Admin_idAdmin INT,
    FOREIGN KEY
(Admin_idAdmin) REFERENCES Admin
(idAdmin)
);

-- Crear la tabla Control
CREATE TABLE
IF NOT EXISTS Control
(
    idControl INT AUTO_INCREMENT PRIMARY KEY,
    hora_llegada DATETIME,
    hora_salida DATETIME,
    Empleados_idEmpleados INT,
    FOREIGN KEY
(Empleados_idEmpleados) REFERENCES Empleados
(idEmpleados)
);
-- Usar la base de datos proyecto_mvc
USE proyecto_mvc;

-- Insertar datos en la tabla Admin
INSERT INTO Admin
    (correo, contrasena)
VALUES
    ('admin@empresa.com', PASSWORD('adminpassword'));

-- Insertar datos en la tabla Empleados
INSERT INTO Empleados
    (nombre_completo, correo, cargo, telefono, cedula, Admin_idAdmin)
VALUES
    ('Juan Perez', 'juan.perez@empresa.com', 'Desarrollador', '123456789', '11111111', 1),
    ('Maria Gomez', 'maria.gomez@empresa.com', 'Analista', '987654321', '22222222', 1),
    ('Carlos Lopez', 'carlos.lopez@empresa.com', 'Gerente', '555555555', '33333333', 1);

-- Insertar datos en la tabla Control
INSERT INTO Control
    (hora_llegada, hora_salida, Empleados_idEmpleados)
VALUES
    ('2024-05-22 08:00:00', '2024-05-22 17:00:00', 1),
    ('2024-05-22 08:30:00', '2024-05-22 17:30:00', 2),
    ('2024-05-22 09:00:00', '2024-05-22 18:00:00', 3),
    ('2024-05-23 08:00:00', '2024-05-23 17:00:00', 1),
    ('2024-05-23 08:30:00', '2024-05-23 17:30:00', 2),
    ('2024-05-23 09:00:00', '2024-05-23 18:00:00', 3);
