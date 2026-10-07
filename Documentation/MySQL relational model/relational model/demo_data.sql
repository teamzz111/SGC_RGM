-- Demo seed data for SGC_RGM. All records are FICTITIOUS (generated), not real people.
-- Load after the schema in 'facil - copia.sql'.

INSERT INTO `cargo` (`idCargos`, `nombre`, `nivel`) VALUES
(1, 'Administrador', 1),
(2, 'Lider de proceso', 2),
(3, 'Empleado', 3);

INSERT INTO `seccional` (`idSeccional`, `ciudad`, `pais`, `departamento`, `direccion`, `liderProceso`, `Tipo`) VALUES
(1, 'Bogota', 'Colombia', 'Cundinamarca', 'Calle 10 # 5-20', 'Ana Perez', 'Principal'),
(2, 'Medellin', 'Colombia', 'Antioquia', 'Carrera 45 # 30-12', 'Luis Gomez', 'Sucursal');

INSERT INTO `empleado` (`cedula`, `nombre`, `apellido`, `email`, `telefono`, `direccion`, `numero`, `sexo`, `idSeccional`, `cargo_idCargos`) VALUES
(9000000001, 'Mateo', 'Pérez', 'mateo.perez@example.com', '3000000101', 'Carrera 42 # 99-8', '118', 'M', 1, 1),
(9000000002, 'Mariana', 'Torres', 'mariana.torres@example.com', '3000000102', 'Carrera 106 # 5-41', '206', 'F', 1, 2),
(9000000003, 'Daniel', 'López', 'daniel.lopez@example.com', '3000000103', 'Carrera 35 # 9-28', '291', 'M', 1, 2),
(9000000004, 'Mateo', 'Reyes', 'mateo.reyes@example.com', '3000000104', 'Carrera 113 # 92-41', '109', 'M', 1, 2),
(9000000005, 'Camila', 'Herrera', 'camila.herrera@example.com', '3000000105', 'Carrera 84 # 64-51', '235', 'F', 1, 3),
(9000000006, 'Luis', 'Pérez', 'luis.perez@example.com', '3000000106', 'Carrera 19 # 34-18', '127', 'M', 1, 3),
(9000000007, 'Camila', 'Ramírez', 'camila.ramirez@example.com', '3000000107', 'Carrera 96 # 72-69', '135', 'F', 1, 3),
(9000000008, 'Daniel', 'Navarro', 'daniel.navarro@example.com', '3000000108', 'Carrera 96 # 75-55', '299', 'M', 2, 3),
(9000000009, 'Ana', 'Reyes', 'ana.reyes@example.com', '3000000109', 'Carrera 52 # 47-29', '71', 'F', 2, 3),
(9000000010, 'Sofía', 'Reyes', 'sofia.reyes@example.com', '3000000110', 'Carrera 66 # 64-12', '25', 'F', 2, 3),
(9000000011, 'Felipe', 'Torres', 'felipe.torres@example.com', '3000000111', 'Carrera 111 # 15-20', '82', 'M', 2, 3),
(9000000012, 'Paula', 'Díaz', 'paula.diaz@example.com', '3000000112', 'Carrera 102 # 88-55', '33', 'F', 2, 3);

INSERT INTO `cuenta` (`contrasena`, `estado`, `cedula`) VALUES
('demo_password_hash', 'Activo', 9000000001),
('demo_password_hash', 'Activo', 9000000002),
('demo_password_hash', 'Activo', 9000000003),
('demo_password_hash', 'Activo', 9000000004),
('demo_password_hash', 'Activo', 9000000005),
('demo_password_hash', 'Espera', 9000000006),
('demo_password_hash', 'Activo', 9000000007),
('demo_password_hash', 'Activo', 9000000008),
('demo_password_hash', 'Activo', 9000000009),
('demo_password_hash', 'Activo', 9000000010),
('demo_password_hash', 'Activo', 9000000011),
('demo_password_hash', 'Espera', 9000000012);
