DROP DATABASE IF EXISTS CoderWise;
CREATE DATABASE IF NOT EXISTS CoderWise;

USE CoderWise;

-- Creación de la tabla Usuarios
CREATE TABLE Usuarios (
    IDUsuario INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL,
    Apellido VARCHAR(50) NOT NULL,
    FechaNacimiento DATE NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Contraseña VARCHAR(100) NOT NULL
);

-- Creación de la tabla Clientes
CREATE TABLE Clientes (
    CI INT PRIMARY KEY,
    IDUsuario INT NOT NULL,
    Tel VARCHAR(20) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Contraseña VARCHAR(100) NOT NULL,
	Nombre VARCHAR(100) NOT NULL,
    Apellido VARCHAR(100) NOT NULL,
    FOREIGN KEY (IDUsuario) REFERENCES Usuarios(IDUsuario)
);

-- Creación de la tabla Empleados
CREATE TABLE Empleados (
    IDUsuario INT,
    CedEmp INT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL,
    Apellido VARCHAR(50) NOT NULL,
    FechaNacimiento DATE NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Contraseña VARCHAR(100) NOT NULL,
    FechaIng DATE NOT NULL,
    FOREIGN KEY (IDUsuario) REFERENCES Usuarios(IDUsuario)
);

-- Creación de la tabla Administradores
CREATE TABLE Administradores (
    CedEmp INT NOT NULL,
    IDUsuario INT NOT NULL,
    Nombre VARCHAR(50) NOT NULL,
    Apellido VARCHAR(50) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Contraseña VARCHAR(100) NOT NULL,
    FechaIng DATE NOT NULL,
    FOREIGN KEY (CedEmp) REFERENCES Empleados(CedEmp),
    FOREIGN KEY (IDUsuario) REFERENCES Usuarios(IDUsuario)
);

-- Creación de la tabla Choferes
CREATE TABLE Choferes (
    IDchofer INT AUTO_INCREMENT PRIMARY KEY,
    IDUsuario INT NOT NULL,
    CedEmp INT NOT NULL,
    Nombre VARCHAR(50) NOT NULL,
    Apellido VARCHAR(50) NOT NULL,
    FechaNacimiento DATE NOT NULL,
    FechaIng DATE NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Contraseña VARCHAR(100) NOT NULL,
    FOREIGN KEY (IDUsuario) REFERENCES Usuarios(IDUsuario),
    FOREIGN KEY (CedEmp) REFERENCES Empleados(CedEmp)
);

-- Creación de la tabla Omnibus
CREATE TABLE Omnibus (
    IdOmnibus INT AUTO_INCREMENT PRIMARY KEY,
    Estado BOOLEAN NOT NULL,
    FechaC DATE NOT NULL
);

-- Creación de la tabla Conducen
CREATE TABLE Conducen (
    IDchof INT NOT NULL,
    IdOmnibus INT NOT NULL,
    Fecha_Hora DATETIME NOT NULL,
    FOREIGN KEY (IDchof) REFERENCES Choferes(IDchofer),
    FOREIGN KEY (IdOmnibus) REFERENCES Omnibus(IdOmnibus)
);

-- Creación de la tabla Servicios
CREATE TABLE Servicios (
    IdServicio INT AUTO_INCREMENT PRIMARY KEY,
    IdOmnibus INT NOT NULL,
    IDChofer INT NOT NULL,
    HoraSalida TIME NOT NULL,
    HoraLlegada TIME NOT NULL,
    Fecha DATE NOT NULL,
    FOREIGN KEY (IdOmnibus) REFERENCES Omnibus(IdOmnibus),
    FOREIGN KEY (IDChofer) REFERENCES Choferes(IDchofer)
);

-- Creación de la tabla Rutas (Nueva)
CREATE TABLE Rutas (
    IDruta INT PRIMARY KEY,
    Origen VARCHAR(100) NOT NULL,
    Destino VARCHAR(100) NOT NULL
);

-- Creación de la tabla Líneas
CREATE TABLE Lineas (
    IDlinea INT AUTO_INCREMENT PRIMARY KEY,
    IdServicio INT NOT NULL,
    IDruta INT NOT NULL,
    DuracionViaje TIME NOT NULL,
    Precio DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (IdServicio) REFERENCES Servicios(IdServicio),
    FOREIGN KEY (IDruta) REFERENCES Rutas(IDruta)
);

-- Creación de la tabla Paradas
CREATE TABLE Paradas (
    IDlinea INT NOT NULL,
    NumParada INT AUTO_INCREMENT PRIMARY KEY,
    Direccion VARCHAR(100) NOT NULL,
    FOREIGN KEY (IDlinea) REFERENCES Lineas(IDlinea)
);

-- Creación de la tabla Asientos
CREATE TABLE Asientos (
    NumAsiento INT AUTO_INCREMENT PRIMARY KEY,
    IdOmnibus INT NOT NULL,
    EstadoAsiento BOOLEAN NOT NULL,
    FOREIGN KEY (IdOmnibus) REFERENCES Omnibus(IdOmnibus)
);

-- Creación de la tabla Reserva
CREATE TABLE Reserva (
    NumReserva INT AUTO_INCREMENT PRIMARY KEY,
    CodAsiento INT NOT NULL,
    IdOmnibus INT NOT NULL,
    IdServicio INT NOT NULL,
    IDUsuario INT NOT NULL,
    Fecha_Reserva DATE NOT NULL,
    FOREIGN KEY (CodAsiento) REFERENCES Asientos(NumAsiento),
    FOREIGN KEY (IdOmnibus) REFERENCES Omnibus(IdOmnibus),
    FOREIGN KEY (IdServicio) REFERENCES Servicios(IdServicio),
    FOREIGN KEY (IDUsuario) REFERENCES Usuarios(IDUsuario)
);

-- Creación de la tabla Detalle_Reserva
CREATE TABLE Detalle_Reserva (
    IDUsuario INT NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    NumReserva INT NOT NULL,
    FOREIGN KEY (IDUsuario) REFERENCES Usuarios(IDUsuario),
    FOREIGN KEY (NumReserva) REFERENCES Reserva(NumReserva)
);

-- Creación de la tabla Noticias
CREATE TABLE Noticias (
    NumeroNoticia INT AUTO_INCREMENT PRIMARY KEY,
    Titulo VARCHAR(100) NOT NULL,
    Descripcion VARCHAR(200) NOT NULL,
    Imagen VARCHAR(200) NOT NULL,
    Fecha DATETIME NOT NULL
);

-- datos de prueba 
INSERT INTO Usuarios (Nombre, Apellido, FechaNacimiento, Email, Contraseña) 
VALUES 
('Romina', 'Celintano', '2003-9-23', 'romina@example.com', 'romina123'),
('Guillermo', 'Fuentes', '2001-10-3', 'guillermo@example.com', 'guillermo123'),
('Santiago', 'López', '2004-11-18', 'santiago@example.com', 'santiago123'),
('Elias', 'Clavijo', '2006-2-18', 'elias@example.com', 'elias123'),
('Leandro', 'Dominguez', '2005-10-18', 'leandro@example.com', 'leandro123');



INSERT INTO Clientes (CI, IDUsuario, Tel, Email, Contraseña, Nombre, Apellido) 
VALUES 
(1234567, (SELECT IDUsuario FROM Usuarios WHERE Nombre = 'Elias'), '555-1234', 'elias@example.com', 'elias123', 'Elias', 'Clavijo'),
(9876543, (SELECT IDUsuario FROM Usuarios WHERE Nombre = 'Leandro'), '555-5678', 'leandro@example.com', 'leandro123', 'Leandro','Dominguez');


INSERT INTO Empleados (IDUsuario, CedEmp, Nombre, Apellido, FechaNacimiento, Email, Contraseña, FechaIng) 
VALUES 
((SELECT IDUsuario FROM Usuarios WHERE Nombre = 'Santiago'), 1234566, 'Santiago', 'López', '2004-11-18', 'santiago@example.com', 'santiago123', '2023-1-20'),
((SELECT IDUsuario FROM Usuarios WHERE Nombre = 'Romina'), 1234555,'Romina', 'Celintano', '2003-9-23', 'romina@example.com', 'romina123', '2023-5-21'),
((SELECT IDUsuario FROM Usuarios WHERE Nombre = 'Guillermo'), 1234444, 'Guillermo', 'Fuentes', '2001-10-3', 'guillermo@example.com', 'guillermo123', '2023-10-16');



INSERT INTO Administradores (CedEmp, IDUsuario, Nombre, Apellido, Email, Contraseña, FechaIng) 
VALUES 
((SELECT CedEmp FROM Empleados WHERE Nombre = 'Santiago'), (SELECT IDUsuario FROM Usuarios WHERE Nombre = 'Santiago'), 'Santiago', 'López', 'santiago@example.com', 'santiago123', '2023-1-20'),
((SELECT CedEmp FROM Empleados WHERE Nombre = 'Romina'), (SELECT IDUsuario FROM Usuarios WHERE Nombre = 'Romina'), 'Romina', 'Celintano', 'romina@example.com', 'romina123', '2023-5-21');



INSERT INTO Choferes (CedEmp, IDUsuario, Nombre, Apellido, FechaNacimiento, Email, Contraseña, FechaIng) 
VALUES ((SELECT CedEmp FROM Empleados WHERE Nombre = 'Guillermo'), (SELECT IDUsuario FROM Usuarios WHERE Nombre = 'Guillermo'), 'Guillermo', 'Fuentes', '2001-10-3', 'luis@example.com', 'guillermo123', '2023-10-16');



INSERT INTO Omnibus (FechaC, Estado) 
VALUES 
('2023-10-16', 1),
('2023-10-16', 0);



INSERT INTO Conducen (IDchof, IdOmnibus, Fecha_Hora) 
VALUES 
((select IDchofer from Choferes where nombre = 'Guillermo'), 1, '2023-10-16 08:00:00');



INSERT INTO Servicios (IdOmnibus, IDChofer, HoraSalida, HoraLlegada, Fecha) 
VALUES 
(1, (select IDChofer from Choferes where nombre = 'Guillermo'), '08:00:00', '10:30:00', '2023-10-16'),
(1, (select IDChofer from Choferes where nombre = 'Guillermo'), '09:00:00', '11:45:00', '2023-10-16'),
(1, (select IDChofer from Choferes where nombre = 'Guillermo'), '09:00:00', '11:45:00', '2023-10-16');



INSERT INTO Rutas (IDruta, Origen, Destino) 
VALUES 

-- Artigas
(1, 'Artigas', 'Canelones'),
(2, 'Artigas', 'Cerro Largo'),
(3, 'Artigas', 'Colonia'),
(4, 'Artigas', 'Durazno'),
(5, 'Artigas', 'Flores'),
(6, 'Artigas', 'Florida'),
(7, 'Artigas', 'Lavalleja'),
(8, 'Artigas', 'Maldonado'),
(9, 'Artigas', 'Montevideo'),
(10, 'Artigas', 'Paysandú'),
(11, 'Artigas', 'Río Negro'),
(12, 'Artigas', 'Rivera'),
(13, 'Artigas', 'Rocha'),
(14, 'Artigas', 'Salto'),
(15, 'Artigas', 'San José'),
(16, 'Artigas', 'Soriano'),
(17, 'Artigas', 'Tacuarembó'),
(18, 'Artigas', 'Treinta y Tres'),

-- Canelones
(19, 'Canelones', 'Artigas'),
(20, 'Canelones', 'Cerro Largo'),
(21, 'Canelones', 'Colonia'),
(22, 'Canelones', 'Durazno'),
(23, 'Canelones', 'Flores'),
(24, 'Canelones', 'Florida'),
(25, 'Canelones', 'Lavalleja'),
(26, 'Canelones', 'Maldonado'),
(27, 'Canelones', 'Montevideo'),
(28, 'Canelones', 'Paysandú'),
(29, 'Canelones', 'Río Negro'),
(30, 'Canelones', 'Rivera'),
(31, 'Canelones', 'Rocha'),
(32, 'Canelones', 'Salto'),
(33, 'Canelones', 'San José'),
(34, 'Canelones', 'Soriano'),
(35, 'Canelones', 'Tacuarembó'),
(36, 'Canelones', 'Treinta y Tres'),

-- Cerro Largo
(37, 'Cerro Largo', 'Artigas'),
(38, 'Cerro Largo', 'Canelones'),
(39, 'Cerro Largo', 'Colonia'),
(40, 'Cerro Largo', 'Durazno'),
(41, 'Cerro Largo', 'Flores'),
(42, 'Cerro Largo', 'Florida'),
(43, 'Cerro Largo', 'Lavalleja'),
(44, 'Cerro Largo', 'Maldonado'),
(45, 'Cerro Largo', 'Montevideo'),
(46, 'Cerro Largo', 'Paysandú'),
(47, 'Cerro Largo', 'Río Negro'),
(48, 'Cerro Largo', 'Rivera'),
(49, 'Cerro Largo', 'Rocha'),
(50, 'Cerro Largo', 'Salto'),
(51, 'Cerro Largo', 'San José'),
(52, 'Cerro Largo', 'Soriano'),
(53, 'Cerro Largo', 'Tacuarembó'),
(54, 'Cerro Largo', 'Treinta y Tres'),

-- Colonia
(55, 'Colonia', 'Artigas'),
(56, 'Colonia', 'Canelones'),
(57, 'Colonia', 'Cerro Largo'),
(58, 'Colonia', 'Durazno'),
(59, 'Colonia', 'Flores'),
(60, 'Colonia', 'Florida'),
(61, 'Colonia', 'Lavalleja'),
(62, 'Colonia', 'Maldonado'),
(63, 'Colonia', 'Montevideo'),
(64, 'Colonia', 'Paysandú'),
(65, 'Colonia', 'Río Negro'),
(66, 'Colonia', 'Rivera'),
(67, 'Colonia', 'Rocha'),
(68, 'Colonia', 'Salto'),
(69, 'Colonia', 'San José'),
(70, 'Colonia', 'Soriano'),
(71, 'Colonia', 'Tacuarembó'),
(72, 'Colonia', 'Treinta y Tres'),

-- Durazno
(73, 'Durazno', 'Artigas'),
(74, 'Durazno', 'Canelones'),
(75, 'Durazno', 'Cerro Largo'),
(76, 'Durazno', 'Colonia'),
(77, 'Durazno', 'Flores'),
(78, 'Durazno', 'Florida'),
(79, 'Durazno', 'Lavalleja'),
(80, 'Durazno', 'Maldonado'),
(81, 'Durazno', 'Montevideo'),
(82, 'Durazno', 'Paysandú'),
(83, 'Durazno', 'Río Negro'),
(84, 'Durazno', 'Rivera'),
(85, 'Durazno', 'Rocha'),
(86, 'Durazno', 'Salto'),
(87, 'Durazno', 'San José'),
(88, 'Durazno', 'Soriano'),
(89, 'Durazno', 'Tacuarembó'),
(90, 'Durazno', 'Treinta y Tres'),

-- Flores
(91, 'Flores', 'Artigas'),
(92, 'Flores', 'Canelones'),
(93, 'Flores', 'Cerro Largo'),
(94, 'Flores', 'Colonia'),
(95, 'Flores', 'Durazno'),
(96, 'Flores', 'Florida'),
(97, 'Flores', 'Lavalleja'),
(98, 'Flores', 'Maldonado'),
(99, 'Flores', 'Montevideo'),
(100, 'Flores', 'Paysandú'),
(101, 'Flores', 'Río Negro'),
(102, 'Flores', 'Rivera'),
(103, 'Flores', 'Rocha'),
(104, 'Flores', 'Salto'),
(105, 'Flores', 'San José'),
(106, 'Flores', 'Soriano'),
(107, 'Flores', 'Tacuarembó'),
(108, 'Flores', 'Treinta y Tres'),

-- Florida
(109, 'Florida', 'Artigas'),
(110, 'Florida', 'Canelones'),
(111, 'Florida', 'Cerro Largo'),
(112, 'Florida', 'Colonia'),
(113, 'Florida', 'Durazno'),
(114, 'Florida', 'Flores'),
(115, 'Florida', 'Lavalleja'),
(116, 'Florida', 'Maldonado'),
(117, 'Florida', 'Montevideo'),
(118, 'Florida', 'Paysandú'),
(119, 'Florida', 'Río Negro'),
(120, 'Florida', 'Rivera'),
(121, 'Florida', 'Rocha'),
(122, 'Florida', 'Salto'),
(123, 'Florida', 'San José'),
(124, 'Florida', 'Soriano'),
(125, 'Florida', 'Tacuarembó'),
(126, 'Florida', 'Treinta y Tres'),

-- Lavalleja
(127, 'Lavalleja', 'Artigas'),
(128, 'Lavalleja', 'Canelones'),
(129, 'Lavalleja', 'Cerro Largo'),
(130, 'Lavalleja', 'Colonia'),
(131, 'Lavalleja', 'Durazno'),
(132, 'Lavalleja', 'Flores'),
(133, 'Lavalleja', 'Florida'),
(134, 'Lavalleja', 'Maldonado'),
(135, 'Lavalleja', 'Montevideo'),
(136, 'Lavalleja', 'Paysandú'),
(137, 'Lavalleja', 'Río Negro'),
(138, 'Lavalleja', 'Rivera'),
(139, 'Lavalleja', 'Rocha'),
(140, 'Lavalleja', 'Salto'),
(141, 'Lavalleja', 'San José'),
(142, 'Lavalleja', 'Soriano'),
(143, 'Lavalleja', 'Tacuarembó'),
(144, 'Lavalleja', 'Treinta y Tres'),

-- Maldonado
(145, 'Maldonado', 'Artigas'),
(146, 'Maldonado', 'Canelones'),
(147, 'Maldonado', 'Cerro Largo'),
(148, 'Maldonado', 'Colonia'),
(149, 'Maldonado', 'Durazno'),
(150, 'Maldonado', 'Flores'),
(151, 'Maldonado', 'Florida'),
(152, 'Maldonado', 'Lavalleja'),
(153, 'Maldonado', 'Montevideo'),
(154, 'Maldonado', 'Paysandú'),
(155, 'Maldonado', 'Río Negro'),
(156, 'Maldonado', 'Rivera'),
(157, 'Maldonado', 'Rocha'),
(158, 'Maldonado', 'Salto'),
(159, 'Maldonado', 'San José'),
(160, 'Maldonado', 'Soriano'),
(161, 'Maldonado', 'Tacuarembó'),
(162, 'Maldonado', 'Treinta y Tres'),

-- Montevideo
(163, 'Montevideo', 'Artigas'),
(164, 'Montevideo', 'Canelones'),
(165, 'Montevideo', 'Cerro Largo'),
(166, 'Montevideo', 'Colonia'),
(167, 'Montevideo', 'Durazno'),
(168, 'Montevideo', 'Flores'),
(169, 'Montevideo', 'Florida'),
(170, 'Montevideo', 'Lavalleja'),
(171, 'Montevideo', 'Maldonado'),
(172, 'Montevideo', 'Paysandú'),
(173, 'Montevideo', 'Río Negro'),
(174, 'Montevideo', 'Rivera'),
(175, 'Montevideo', 'Rocha'),
(176, 'Montevideo', 'Salto'),
(177, 'Montevideo', 'San José'),
(178, 'Montevideo', 'Soriano'),
(179, 'Montevideo', 'Tacuarembó'),
(180, 'Montevideo', 'Treinta y Tres'),

-- Paysandú
(181, 'Paysandú', 'Artigas'),
(182, 'Paysandú', 'Canelones'),
(183, 'Paysandú', 'Cerro Largo'),
(184, 'Paysandú', 'Colonia'),
(185, 'Paysandú', 'Durazno'),
(186, 'Paysandú', 'Flores'),
(187, 'Paysandú', 'Florida'),
(188, 'Paysandú', 'Lavalleja'),
(189, 'Paysandú', 'Maldonado'),
(190, 'Paysandú', 'Montevideo'),
(191, 'Paysandú', 'Río Negro'),
(192, 'Paysandú', 'Rivera'),
(193, 'Paysandú', 'Rocha'),
(194, 'Paysandú', 'Salto'),
(195, 'Paysandú', 'San José'),
(196, 'Paysandú', 'Soriano'),
(197, 'Paysandú', 'Tacuarembó'),
(198, 'Paysandú', 'Treinta y Tres'),

-- Río Negro
(199, 'Río Negro', 'Artigas'),
(200, 'Río Negro', 'Canelones'),
(201, 'Río Negro', 'Cerro Largo'),
(202, 'Río Negro', 'Colonia'),
(203, 'Río Negro', 'Durazno'),
(204, 'Río Negro', 'Flores'),
(205, 'Río Negro', 'Florida'),
(206, 'Río Negro', 'Lavalleja'),
(207, 'Río Negro', 'Maldonado'),
(208, 'Río Negro', 'Montevideo'),
(209, 'Río Negro', 'Paysandú'),
(210, 'Río Negro', 'Rivera'),
(211, 'Río Negro', 'Rocha'),
(212, 'Río Negro', 'Salto'),
(213, 'Río Negro', 'San José'),
(214, 'Río Negro', 'Soriano'),
(215, 'Río Negro', 'Tacuarembó'),
(216, 'Río Negro', 'Treinta y Tres'),

-- Rivera
(217, 'Rivera', 'Artigas'),
(218, 'Rivera', 'Canelones'),
(219, 'Rivera', 'Cerro Largo'),
(220, 'Rivera', 'Colonia'),
(221, 'Rivera', 'Durazno'),
(222, 'Rivera', 'Flores'),
(223, 'Rivera', 'Florida'),
(224, 'Rivera', 'Lavalleja'),
(225, 'Rivera', 'Maldonado'),
(226, 'Rivera', 'Montevideo'),
(227, 'Rivera', 'Paysandú'),
(228, 'Rivera', 'Río Negro'),
(229, 'Rivera', 'Rocha'),
(230, 'Rivera', 'Salto'),
(231, 'Rivera', 'San José'),
(232, 'Rivera', 'Soriano'),
(233, 'Rivera', 'Tacuarembó'),
(234, 'Rivera', 'Treinta y Tres'),

-- Rocha
(235, 'Rocha', 'Artigas'),
(236, 'Rocha', 'Canelones'),
(237, 'Rocha', 'Cerro Largo'),
(238, 'Rocha', 'Colonia'),
(239, 'Rocha', 'Durazno'),
(240, 'Rocha', 'Flores'),
(241, 'Rocha', 'Florida'),
(242, 'Rocha', 'Lavalleja'),
(243, 'Rocha', 'Maldonado'),
(244, 'Rocha', 'Montevideo'),
(245, 'Rocha', 'Paysandú'),
(246, 'Rocha', 'Río Negro'),
(247, 'Rocha', 'Rivera'),
(248, 'Rocha', 'Salto'),
(249, 'Rocha', 'San José'),
(250, 'Rocha', 'Soriano'),
(251, 'Rocha', 'Tacuarembó'),
(252, 'Rocha', 'Treinta y Tres'),

-- Salto
(253, 'Salto', 'Artigas'),
(254, 'Salto', 'Canelones'),
(255, 'Salto', 'Cerro Largo'),
(256, 'Salto', 'Colonia'),
(257, 'Salto', 'Durazno'),
(258, 'Salto', 'Flores'),
(259, 'Salto', 'Florida'),
(260, 'Salto', 'Lavalleja'),
(261, 'Salto', 'Maldonado'),
(262, 'Salto', 'Montevideo'),
(263, 'Salto', 'Paysandú'),
(264, 'Salto', 'Río Negro'),
(265, 'Salto', 'Rivera'),
(266, 'Salto', 'Rocha'),
(267, 'Salto', 'San José'),
(268, 'Salto', 'Soriano'),
(269, 'Salto', 'Tacuarembó'),
(270, 'Salto', 'Treinta y Tres'),

-- San José
(271, 'San José', 'Artigas'),
(272, 'San José', 'Canelones'),
(273, 'San José', 'Cerro Largo'),
(274, 'San José', 'Colonia'),
(275, 'San José', 'Durazno'),
(276, 'San José', 'Flores'),
(277, 'San José', 'Florida'),
(278, 'San José', 'Lavalleja'),
(279, 'San José', 'Maldonado'),
(280, 'San José', 'Montevideo'),
(281, 'San José', 'Paysandú'),
(282, 'San José', 'Río Negro'),
(283, 'San José', 'Rivera'),
(284, 'San José', 'Rocha'),
(285, 'San José', 'Salto'),
(286, 'San José', 'Soriano'),
(287, 'San José', 'Tacuarembó'),
(288, 'San José', 'Treinta y Tres'),

-- Soriano
(289, 'Soriano', 'Artigas'),
(290, 'Soriano', 'Canelones'),
(291, 'Soriano', 'Cerro Largo'),
(292, 'Soriano', 'Colonia'),
(293, 'Soriano', 'Durazno'),
(294, 'Soriano', 'Flores'),
(295, 'Soriano', 'Florida'),
(296, 'Soriano', 'Lavalleja'),
(297, 'Soriano', 'Maldonado'),
(298, 'Soriano', 'Montevideo'),
(299, 'Soriano', 'Paysandú'),
(300, 'Soriano', 'Río Negro'),
(301, 'Soriano', 'Rivera'),
(302, 'Soriano', 'Rocha'),
(303, 'Soriano', 'Salto'),
(304, 'Soriano', 'San José'),
(305, 'Soriano', 'Tacuarembó'),
(306, 'Soriano', 'Treinta y Tres'),

-- Tacuarembó
(307, 'Tacuarembó', 'Artigas'),
(308, 'Tacuarembó', 'Canelones'),
(309, 'Tacuarembó', 'Cerro Largo'),
(310, 'Tacuarembó', 'Colonia'),
(311, 'Tacuarembó', 'Durazno'),
(312, 'Tacuarembó', 'Flores'),
(313, 'Tacuarembó', 'Florida'),
(314, 'Tacuarembó', 'Lavalleja'),
(315, 'Tacuarembó', 'Maldonado'),
(316, 'Tacuarembó', 'Montevideo'),
(317, 'Tacuarembó', 'Paysandú'),
(318, 'Tacuarembó', 'Río Negro'),
(319, 'Tacuarembó', 'Rivera'),
(320, 'Tacuarembó', 'Rocha'),
(321, 'Tacuarembó', 'Salto'),
(322, 'Tacuarembó', 'San José'),
(323, 'Tacuarembó', 'Soriano'),
(324, 'Tacuarembó', 'Treinta y Tres'),

-- Treinta y Tres
(325, 'Treinta y Tres', 'Artigas'),
(326, 'Treinta y Tres', 'Canelones'),
(327, 'Treinta y Tres', 'Cerro Largo'),
(328, 'Treinta y Tres', 'Colonia'),
(329, 'Treinta y Tres', 'Durazno'),
(330, 'Treinta y Tres', 'Flores'),
(331, 'Treinta y Tres', 'Florida'),
(332, 'Treinta y Tres', 'Lavalleja'),
(333, 'Treinta y Tres', 'Maldonado'),
(334, 'Treinta y Tres', 'Montevideo'),
(335, 'Treinta y Tres', 'Paysandú'),
(336, 'Treinta y Tres', 'Río Negro'),
(337, 'Treinta y Tres', 'Rivera'),
(338, 'Treinta y Tres', 'Rocha'),
(339, 'Treinta y Tres', 'Salto'),
(340, 'Treinta y Tres', 'San José'),
(341, 'Treinta y Tres', 'Soriano'),
(342, 'Treinta y Tres', 'Tacuarembó');







-- Insertar datos en la tabla Lineas
INSERT INTO Lineas (IdServicio, IDruta, DuracionViaje, Precio)
VALUES
(1, 1, '02:30:00', 30.00),
(2, 2, '03:00:00', 35.00),
(3, 3, '02:15:00', 25.00);


-- Insertar datos en la tabla Paradas
INSERT INTO Paradas (IDlinea, Direccion)
VALUES
-- Artigas
(1, 'Artigas'),(1, 'Canelones'),
(2, 'Artigas'),(2, 'Cerro Largo'),
(3, 'Artigas'),(3, 'Colonia'),
(4, 'Artigas'),(4, 'Durazno'),
(5, 'Artigas'),(5, 'Flores'),
(6, 'Artigas'),(6, 'Florida'),
(7, 'Artigas'),(7, 'Lavalleja'),
(8, 'Artigas'),(8, 'Maldonado'),
(9, 'Artigas'),(9, 'Montevideo'),
(10, 'Artigas'),(10, 'Paysandú'),
(11, 'Artigas'),(11, 'Río Negro'),
(12, 'Artigas'),(12, 'Rivera'),
(13, 'Artigas'),(13, 'Rocha'),
(14, 'Artigas'),(14, 'Salto'),
(15, 'Artigas'),(15, 'San José'),
(16, 'Artigas'),(16, 'Soriano'),
(17, 'Artigas'),(17, 'Tacuarembó'),
(18, 'Artigas'),(18, 'Treinta y Tres'),

-- Canelones
(19, 'Canelones'),(19, 'Artigas'),
(20, 'Canelones'),(20, 'Cerro Largo'),
(21, 'Canelones'),(21, 'Colonia'),
(22, 'Canelones'),(22, 'Durazno'),
(23, 'Canelones'),(23, 'Flores'),
(24, 'Canelones'),(24, 'Florida'),
(25, 'Canelones'),(25, 'Lavalleja'),
(26, 'Canelones'),(26, 'Maldonado'),
(27, 'Canelones'),(27, 'Montevideo'),
(28, 'Canelones'),(28, 'Paysandú'),
(29, 'Canelones'),(29, 'Río Negro'),
(30, 'Canelones'),(30, 'Rivera'),
(31, 'Canelones'),(31, 'Rocha'),
(32, 'Canelones'),(32, 'Salto'),
(33, 'Canelones'),(33, 'San José'),
(34, 'Canelones'),(34, 'Soriano'),
(35, 'Canelones'),(35, 'Tacuarembó'),
(36, 'Canelones'),(36, 'Treinta y Tres'),

-- Cerro Largo
(37, 'Cerro Largo'),(37, 'Artigas'),
(38, 'Cerro Largo'),(38, 'Canelones'),
(39, 'Cerro Largo'),(39, 'Colonia'),
(40, 'Cerro Largo'),(40, 'Durazno'),
(41, 'Cerro Largo'),(41, 'Flores'),
(42, 'Cerro Largo'),(42, 'Florida'),
(43, 'Cerro Largo'),(43, 'Lavalleja'),
(44, 'Cerro Largo'),(44, 'Maldonado'),
(45, 'Cerro Largo'),(45, 'Montevideo'),
(46, 'Cerro Largo'),(46, 'Paysandú'),
(47, 'Cerro Largo'),(47, 'Río Negro'),
(48, 'Cerro Largo'),(48, 'Rivera'),
(49, 'Cerro Largo'),(49, 'Rocha'),
(50, 'Cerro Largo'),(50, 'Salto'),
(51, 'Cerro Largo'),(51, 'San José'),
(52, 'Cerro Largo'),(52, 'Soriano'),
(53, 'Cerro Largo'),(53, 'Tacuarembó'),
(54, 'Cerro Largo'),(54, 'Treinta y Tres'),

-- Colonia
(55, 'Colonia'),(55, 'Artigas'),
(56, 'Colonia'),(56, 'Canelones'),
(57, 'Colonia'),(57, 'Cerro Largo'),
(58, 'Colonia'),(58, 'Durazno'),
(59, 'Colonia'),(59, 'Flores'),
(60, 'Colonia'),(60, 'Florida'),
(61, 'Colonia'),(61, 'Lavalleja'),
(62, 'Colonia'),(62, 'Maldonado'),
(63, 'Colonia'),(63, 'Montevideo'),
(64, 'Colonia'),(64, 'Paysandú'),
(65, 'Colonia'),(65, 'Río Negro'),
(66, 'Colonia'),(66, 'Rivera'),
(67, 'Colonia'),(67, 'Rocha'),
(68, 'Colonia'),(68, 'Salto'),
(69, 'Colonia'),(69, 'San José'),
(70, 'Colonia'),(70, 'Soriano'),
(71, 'Colonia'),(71, 'Tacuarembó'),
(72, 'Colonia'),(72, 'Treinta y Tres'),

-- Durazno
(73, 'Durazno'),(73, 'Artigas'),
(74, 'Durazno'),(74, 'Canelones'),
(75, 'Durazno'),(75, 'Cerro Largo'),
(76, 'Durazno'),(76, 'Colonia'),
(77, 'Durazno'),(77, 'Flores'),
(78, 'Durazno'),(78, 'Florida'),
(79, 'Durazno'),(79, 'Lavalleja'),
(80, 'Durazno'),(80, 'Maldonado'),
(81, 'Durazno'),(81, 'Montevideo'),
(82, 'Durazno'),(82, 'Paysandú'),
(83, 'Durazno'),(83, 'Río Negro'),
(84, 'Durazno'),(84, 'Rivera'),
(85, 'Durazno'),(85, 'Rocha'),
(86, 'Durazno'),(86, 'Salto'),
(87, 'Durazno'),(87, 'San José'),
(88, 'Durazno'),(88, 'Soriano'),
(89, 'Durazno'),(89, 'Tacuarembó'),
(90, 'Durazno'),(90, 'Treinta y Tres'),

-- Flores
(91, 'Flores'),(91, 'Artigas'),
(92, 'Flores'),(92, 'Canelones'),
(93, 'Flores'),(93, 'Cerro Largo'),
(94, 'Flores'),(94, 'Colonia'),
(95, 'Flores'),(95, 'Durazno'),
(96, 'Flores'),(96, 'Florida'),
(97, 'Flores'),(97, 'Lavalleja'),
(98, 'Flores'),(98, 'Maldonado'),
(99, 'Flores'),(99, 'Montevideo'),
(100, 'Flores'),(100, 'Paysandú'),
(101, 'Flores'),(101, 'Río Negro'),
(102, 'Flores'),(102, 'Rivera'),
(103, 'Flores'),(103, 'Rocha'),
(104, 'Flores'),(104, 'Salto'),
(105, 'Flores'),(105, 'San José'),
(106, 'Flores'),(106, 'Soriano'),
(107, 'Flores'),(107, 'Tacuarembó'),
(108, 'Flores'),(108, 'Treinta y Tres'),

-- Florida
(109, 'Florida'),(109, 'Artigas'),
(110, 'Florida'),(110, 'Canelones'),
(111, 'Florida'),(111, 'Cerro Largo'),
(112, 'Florida'),(112, 'Colonia'),
(113, 'Florida'),(113, 'Durazno'),
(114, 'Florida'),(114, 'Flores'),
(115, 'Florida'),(115, 'Lavalleja'),
(116, 'Florida'),(116, 'Maldonado'),
(117, 'Florida'),(117, 'Montevideo'),
(118, 'Florida'),(118, 'Paysandú'),
(119, 'Florida'),(119, 'Río Negro'),
(120, 'Florida'),(120, 'Rivera'),
(121, 'Florida'),(121, 'Rocha'),
(122, 'Florida'),(122, 'Salto'),
(123, 'Florida'),(123, 'San José'),
(124, 'Florida'),(124, 'Soriano'),
(125, 'Florida'),(125, 'Tacuarembó'),
(126, 'Florida'),(126, 'Treinta y Tres'),

-- Lavalleja
(127, 'Lavalleja'),(127, 'Artigas'),
(128, 'Lavalleja'),(128, 'Canelones'),
(129, 'Lavalleja'),(129, 'Cerro Largo'),
(130, 'Lavalleja'),(130, 'Colonia'),
(131, 'Lavalleja'),(131, 'Durazno'),
(132, 'Lavalleja'),(132, 'Flores'),
(133, 'Lavalleja'),(133, 'Florida'),
(134, 'Lavalleja'),(134, 'Maldonado'),
(135, 'Lavalleja'),(135, 'Montevideo'),
(136, 'Lavalleja'),(136, 'Paysandú'),
(137, 'Lavalleja'),(137, 'Río Negro'),
(138, 'Lavalleja'),(138, 'Rivera'),
(139, 'Lavalleja'),(139, 'Rocha'),
(140, 'Lavalleja'),(140, 'Salto'),
(141, 'Lavalleja'),(141, 'San José'),
(142, 'Lavalleja'),(142, 'Soriano'),
(143, 'Lavalleja'),(143, 'Tacuarembó'),
(144, 'Lavalleja'),(144, 'Treinta y Tres'),

-- Maldonado
(145, 'Maldonado'),(145, 'Artigas'),
(146, 'Maldonado'),(146, 'Canelones'),
(147, 'Maldonado'),(147, 'Cerro Largo'),
(148, 'Maldonado'),(148, 'Colonia'),
(149, 'Maldonado'),(149, 'Durazno'),
(150, 'Maldonado'),(150, 'Flores'),
(151, 'Maldonado'),(151, 'Florida'),
(152, 'Maldonado'),(152, 'Lavalleja'),
(153, 'Maldonado'),(153, 'Montevideo'),
(154, 'Maldonado'),(154, 'Paysandú'),
(155, 'Maldonado'),(155, 'Río Negro'),
(156, 'Maldonado'),(156, 'Rivera'),
(157, 'Maldonado'),(157, 'Rocha'),
(158, 'Maldonado'),(158, 'Salto'),
(159, 'Maldonado'),(159, 'San José'),
(160, 'Maldonado'),(160, 'Soriano'),
(161, 'Maldonado'),(161, 'Tacuarembó'),
(162, 'Maldonado'),(162, 'Treinta y Tres'),

-- Montevideo
(163, 'Montevideo'),(163, 'Artigas'),
(164, 'Montevideo'),(164, 'Canelones'),
(165, 'Montevideo'),(165, 'Cerro Largo'),
(166, 'Montevideo'),(166, 'Colonia'),
(167, 'Montevideo'),(167, 'Durazno'),
(168, 'Montevideo'),(168, 'Flores'),
(169, 'Montevideo'),(169, 'Florida'),
(170, 'Montevideo'),(170, 'Lavalleja'),
(171, 'Montevideo'),(171, 'Maldonado'),
(172, 'Montevideo'),(172, 'Paysandú'),
(173, 'Montevideo'),(173, 'Río Negro'),
(174, 'Montevideo'),(174, 'Rivera'),
(175, 'Montevideo'),(175, 'Rocha'),
(176, 'Montevideo'),(176, 'Salto'),
(177, 'Montevideo'),(177, 'San José'),
(178, 'Montevideo'),(178, 'Soriano'),
(179, 'Montevideo'),(179, 'Tacuarembó'),
(180, 'Montevideo'),(180, 'Treinta y Tres'),

-- Paysandú
(181, 'Paysandú'),(181, 'Artigas'),
(182, 'Paysandú'),(182, 'Canelones'),
(183, 'Paysandú'),(183, 'Cerro Largo'),
(184, 'Paysandú'),(184, 'Colonia'),
(185, 'Paysandú'),(185, 'Durazno'),
(186, 'Paysandú'),(186, 'Flores'),
(187, 'Paysandú'),(187, 'Florida'),
(188, 'Paysandú'),(188, 'Lavalleja'),
(189, 'Paysandú'),(189, 'Maldonado'),
(190, 'Paysandú'),(190, 'Montevideo'),
(191, 'Paysandú'),(191, 'Río Negro'),
(192, 'Paysandú'),(192, 'Rivera'),
(193, 'Paysandú'),(193, 'Rocha'),
(194, 'Paysandú'),(194, 'Salto'),
(195, 'Paysandú'),(195, 'San José'),
(196, 'Paysandú'),(196, 'Soriano'),
(197, 'Paysandú'),(197, 'Tacuarembó'),
(198, 'Paysandú'),(198, 'Treinta y Tres'),

-- Río Negro
(199, 'Río Negro'),(199, 'Artigas'),
(200, 'Río Negro'),(200, 'Canelones'),
(201, 'Río Negro'),(201, 'Cerro Largo'),
(202, 'Río Negro'),(202, 'Colonia'),
(203, 'Río Negro'),(203, 'Durazno'),
(204, 'Río Negro'),(204, 'Flores'),
(205, 'Río Negro'),(205, 'Florida'),
(206, 'Río Negro'),(206, 'Lavalleja'),
(207, 'Río Negro'),(207, 'Maldonado'),
(208, 'Río Negro'),(208, 'Montevideo'),
(209, 'Río Negro'),(209, 'Paysandú'),
(210, 'Río Negro'),(210, 'Rivera'),
(211, 'Río Negro'),(211, 'Rocha'),
(212, 'Río Negro'),(212, 'Salto'),
(213, 'Río Negro'),(213, 'San José'),
(214, 'Río Negro'),(214, 'Soriano'),
(215, 'Río Negro'),(215, 'Tacuarembó'),
(216, 'Río Negro'),(216, 'Treinta y Tres'),

-- Rivera
(217, 'Rivera'),(217, 'Artigas'),
(218, 'Rivera'),(218, 'Canelones'),
(219, 'Rivera'),(219, 'Cerro Largo'),
(220, 'Rivera'),(220, 'Colonia'),
(221, 'Rivera'),(221, 'Durazno'),
(222, 'Rivera'),(222, 'Flores'),
(223, 'Rivera'),(223, 'Florida'),
(224, 'Rivera'),(224, 'Lavalleja'),
(225, 'Rivera'),(225, 'Maldonado'),
(226, 'Rivera'),(226, 'Montevideo'),
(227, 'Rivera'),(227, 'Paysandú'),
(228, 'Rivera'),(228, 'Río Negro'),
(229, 'Rivera'),(229, 'Rocha'),
(230, 'Rivera'),(230, 'Salto'),
(231, 'Rivera'),(231, 'San José'),
(232, 'Rivera'),(232, 'Soriano'),
(233, 'Rivera'),(233, 'Tacuarembó'),
(234, 'Rivera'),(234, 'Treinta y Tres'),

-- Rocha
(235, 'Rocha'),(235, 'Artigas'),
(236, 'Rocha'),(236, 'Canelones'),
(237, 'Rocha'),(237, 'Cerro Largo'),
(238, 'Rocha'),(238, 'Colonia'),
(239, 'Rocha'),(239, 'Durazno'),
(240, 'Rocha'),(240, 'Flores'),
(241, 'Rocha'),(241, 'Florida'),
(242, 'Rocha'),(242, 'Lavalleja'),
(243, 'Rocha'),(243, 'Maldonado'),
(244, 'Rocha'),(244, 'Montevideo'),
(245, 'Rocha'),(245, 'Paysandú'),
(246, 'Rocha'),(246, 'Río Negro'),
(247, 'Rocha'),(247, 'Rivera'),
(248, 'Rocha'),(248, 'Salto'),
(249, 'Rocha'),(249, 'San José'),
(250, 'Rocha'),(250, 'Soriano'),
(251, 'Rocha'),(251, 'Tacuarembó'),
(252, 'Rocha'),(252, 'Treinta y Tres'),

-- Salto
(253, 'Salto'),(253, 'Artigas'),
(254, 'Salto'),(254, 'Canelones'),
(255, 'Salto'),(255, 'Cerro Largo'),
(256, 'Salto'),(256, 'Colonia'),
(257, 'Salto'),(257, 'Durazno'),
(258, 'Salto'),(258, 'Flores'),
(259, 'Salto'),(259, 'Florida'),
(260, 'Salto'),(260, 'Lavalleja'),
(261, 'Salto'),(261, 'Maldonado'),
(262, 'Salto'),(262, 'Montevideo'),
(263, 'Salto'),(263, 'Paysandú'),
(264, 'Salto'),(264, 'Río Negro'),
(265, 'Salto'),(265, 'Rivera'),
(266, 'Salto'),(266, 'Rocha'),
(267, 'Salto'),(267, 'San José'),
(268, 'Salto'),(268, 'Soriano'),
(269, 'Salto'),(269, 'Tacuarembó'),
(270, 'Salto'),(270, 'Treinta y Tres'),

-- San José
(271, 'San José'),(271, 'Artigas'),
(272, 'San José'),(272, 'Canelones'),
(273, 'San José'),(273, 'Cerro Largo'),
(274, 'San José'),(274, 'Colonia'),
(275, 'San José'),(275, 'Durazno'),
(276, 'San José'),(276, 'Flores'),
(277, 'San José'),(277, 'Florida'),
(278, 'San José'),(278, 'Lavalleja'),
(279, 'San José'),(279, 'Maldonado'),
(280, 'San José'),(280, 'Montevideo'),
(281, 'San José'),(281, 'Paysandú'),
(282, 'San José'),(282, 'Río Negro'),
(283, 'San José'),(283, 'Rivera'),
(284, 'San José'),(284, 'Rocha'),
(285, 'San José'),(285, 'Salto'),
(286, 'San José'),(286, 'Soriano'),
(287, 'San José'),(287, 'Tacuarembó'),
(288, 'San José'),(288, 'Treinta y Tres'),

-- Soriano
(289, 'Soriano'),(289, 'Artigas'),
(290, 'Soriano'),(290, 'Canelones'),
(291, 'Soriano'),(291, 'Cerro Largo'),
(292, 'Soriano'),(292, 'Colonia'),
(293, 'Soriano'),(293, 'Durazno'),
(294, 'Soriano'),(294, 'Flores'),
(295, 'Soriano'),(295, 'Florida'),
(296, 'Soriano'),(296, 'Lavalleja'),
(297, 'Soriano'),(297, 'Maldonado'),
(298, 'Soriano'),(298, 'Montevideo'),
(299, 'Soriano'),(299, 'Paysandú'),
(300, 'Soriano'),(300, 'Río Negro'),
(301, 'Soriano'),(301, 'Rivera'),
(302, 'Soriano'),(302, 'Rocha'),
(303, 'Soriano'),(303, 'Salto'),
(304, 'Soriano'),(304, 'San José'),
(305, 'Soriano'),(305, 'Tacuarembó'),
(306, 'Soriano'),(306, 'Treinta y Tres'),

-- Tacuarembó
(307, 'Tacuarembó'),(307, 'Artigas'),
(308, 'Tacuarembó'),(308, 'Canelones'),
(309, 'Tacuarembó'),(309, 'Cerro Largo'),
(310, 'Tacuarembó'),(310, 'Colonia'),
(311, 'Tacuarembó'),(311, 'Durazno'),
(312, 'Tacuarembó'),(312, 'Flores'),
(313, 'Tacuarembó'),(313, 'Florida'),
(314, 'Tacuarembó'),(314, 'Lavalleja'),
(315, 'Tacuarembó'),(315, 'Maldonado'),
(316, 'Tacuarembó'),(316, 'Montevideo'),
(317, 'Tacuarembó'),(317, 'Paysandú'),
(318, 'Tacuarembó'),(318, 'Río Negro'),
(319, 'Tacuarembó'),(319, 'Rivera'),
(320, 'Tacuarembó'),(320, 'Rocha'),
(321, 'Tacuarembó'),(321, 'Salto'),
(322, 'Tacuarembó'),(322, 'San José'),
(323, 'Tacuarembó'),(323, 'Soriano'),
(324, 'Tacuarembó'),(324, 'Treinta y Tres'),

-- Treinta y Tres
(325, 'Treinta y Tres'),(325, 'Artigas'),
(326, 'Treinta y Tres'),(326, 'Canelones'),
(327, 'Treinta y Tres'),(327, 'Cerro Largo'),
(328, 'Treinta y Tres'),(328, 'Colonia'),
(329, 'Treinta y Tres'),(329, 'Durazno'),
(330, 'Treinta y Tres'),(330, 'Flores'),
(331, 'Treinta y Tres'),(331, 'Florida'),
(332, 'Treinta y Tres'),(332, 'Lavalleja'),
(333, 'Treinta y Tres'),(333, 'Maldonado'),
(334, 'Treinta y Tres'),(334, 'Montevideo'),
(335, 'Treinta y Tres'),(335, 'Paysandú'),
(336, 'Treinta y Tres'),(336, 'Río Negro'),
(337, 'Treinta y Tres'),(337, 'Rivera'),
(338, 'Treinta y Tres'),(338, 'Rocha'),
(339, 'Treinta y Tres'),(339, 'Salto'),
(340, 'Treinta y Tres'),(340, 'San José'),
(341, 'Treinta y Tres'),(341, 'Soriano'),
(342, 'Treinta y Tres'),(342, 'Tacuarembó');




INSERT INTO Asientos (IdOmnibus, EstadoAsiento) 
VALUES 
(1, true);