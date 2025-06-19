CREATE TABLE IF NOT EXISTS barberos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Primer_nombre VARCHAR(50) NOT NULL,
    Segundo_nombre VARCHAR(50),
    Primer_apellido VARCHAR(50) NOT NULL,
    Segundo_apellido VARCHAR(50),
    Especialidad VARCHAR(100),
    Telefono VARCHAR(15) NOT NULL,
    Correo VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO barberos (Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_apellido, Especialidad, Telefono, Correo) VALUES
('Juan', 'Carlos', 'Pérez', 'Gómez', 'Cortes modernos', '5551234567', 'juan.perez@example.com'),
('Luis', 'Miguel', 'Ramírez', 'Santos', 'Barba y afeitado', '5559876543', 'luis.ramirez@example.com'),
('Andrés', NULL, 'López', 'Martínez', 'Coloración', '5551112233', 'andres.lopez@example.com');

CREATE TABLE IF NOT EXISTS clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Primer_nombre VARCHAR(50) NOT NULL,
    Segundo_nombre VARCHAR(50),
    Primer_apellido VARCHAR(50) NOT NULL,
    Segundo_apellido VARCHAR(50),
    Numero_documento VARCHAR(30) NOT NULL UNIQUE,
    Correo VARCHAR(100) NOT NULL UNIQUE,
    Telefono VARCHAR(15) NOT NULL,
    Sexo VARCHAR(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO clientes (Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_apellido, Numero_documento, Correo, Telefono, Sexo) VALUES
('Carlos', NULL, 'García', 'Ruiz', '111222333', 'carlos.garcia@example.com', '3002223333', 'Masculino'),
('María', 'Elena', 'Torres', 'López', '444555666', 'maria.torres@example.com', '3014445555', 'Femenino');

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Tipo_documento VARCHAR(10) NOT NULL,
    Numero_documento VARCHAR(30) NOT NULL UNIQUE,
    Primer_nombre VARCHAR(50) NOT NULL,
    Segundo_nombre VARCHAR(50),
    Primer_apellido VARCHAR(50) NOT NULL,
    Segundo_apellido VARCHAR(50),
    Correo VARCHAR(100) NOT NULL UNIQUE,
    Telefono VARCHAR(15) NOT NULL,
    Fecha_Nacimiento DATE NOT NULL,
    Sexo VARCHAR(20) NOT NULL,
    Contrasena VARCHAR(255) NOT NULL
);

INSERT INTO users (Tipo_documento, Numero_documento, Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_apellido, Correo, Telefono, Fecha_Nacimiento, Sexo, Contrasena)
VALUES
('CC', '1234567890', 'Juan', 'Carlos', 'Pérez', 'Gómez', 'juan.perez@example.com', '3001234567', '1990-05-10', 'Masculino', '1234'),
('TI', '9876543210', 'Ana', NULL, 'López', NULL, 'ana.lopez@example.com', '3019876543', '2002-08-15', 'Femenino', 'abcd1234');
