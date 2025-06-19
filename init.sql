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
