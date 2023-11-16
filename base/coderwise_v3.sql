
DROP DATABASE IF EXISTS CoderWise;
CREATE DATABASE IF NOT EXISTS CoderWise;

USE CoderWise;

-- Creación de la tabla Usuarios
CREATE TABLE Usuarios (
    IDUsuario INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL,
    Apellido VARCHAR(50) NOT NULL,
    Edad INT NOT NULL,
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
    Edad INT NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Contraseña VARCHAR(100) NOT NULL,
    FechaIng DATE NOT NULL,
    FOREIGN KEY (IDUsuario) REFERENCES Usuarios(IDUsuario)
);

-- Creación de la tabla Administradores
CREATE TABLE Administradores (
    IDAdm INT AUTO_INCREMENT PRIMARY KEY,
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
    Edad INT NOT NULL,
    FechaIng DATE NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Contraseña VARCHAR(100) NOT NULL,
    FOREIGN KEY (IDUsuario) REFERENCES Usuarios(IDUsuario),
    FOREIGN KEY (CedEmp) REFERENCES Empleados(CedEmp)
);

-- Creación de la tabla Omnibus
CREATE TABLE Omnibus (
    IdOmnibus INT AUTO_INCREMENT PRIMARY KEY,
    FechaC DATETIME NOT NULL,
    Estado BOOLEAN NOT NULL
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
    Nombre varchar(100), 
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
    Fecha DATETIME NOT NULL,
    ID_Adm INT NOT NULL,
    FOREIGN KEY (ID_Adm) REFERENCES Administradores(IDAdm)
);

-- datos de prueba 
INSERT INTO Usuarios (Nombre, Apellido, Edad, Email, Contraseña) 
VALUES 
('Leandro', 'Dominguez', 57664833, 'kumidom18@gmail.com', 'leandro123'),
('Elias', 'Clavijo', 57448962, 'eliasju09@gmail.com', 'elias123'),
('Romina', 'Celintano', 46558234, 'paradise5425@gmail.com', 'romina123'),
('Guillermo', 'Fuentes', 47558756, 'guille3102010@gmail.com', 'guillermo123'),
('Santiago', 'López', 54772063, 'santilopeez7s@gmail.com', 'santi123');

--

INSERT INTO Clientes (CI, IDUsuario, Tel, Email, Contraseña, Nombre, Apellido) VALUES 
(1234567, (SELECT IDUsuario FROM Usuarios WHERE Nombre = 'Leandro'), '555-1234', 'kumidom18@gmail.com', 'leandro123','Leandro', 'Dominguez'),
(9876543, (SELECT IDUsuario FROM Usuarios WHERE Nombre = 'Elias'), '555-5678', 'eliasju09@gmail.com', 'clave456','Elias', 'Clavijo');

--

INSERT INTO Empleados (IDUsuario, CedEmp, Nombre, Apellido, Edad, Email, Contraseña, FechaIng) VALUES  
((SELECT IDUsuario FROM Usuarios WHERE Nombre = 'Romina'),'12345612', 'Romina', 'Celintano', 46558234, 'paradise5425@gmail.com', 'romina123', '2023-10-16'),
((SELECT IDUsuario FROM Usuarios WHERE Nombre = 'Guillermo'),'11111110', 'Guillermo', 'Fuentes', 47558756, 'guille3102010@gmail.com', 'guillermo123', '2023-10-16'), 
((SELECT IDUsuario FROM Usuarios WHERE Nombre = 'Santiago'),'54772063', 'Santiago', 'López', 54772063, 'santilopeez7s@gmail.com', 'santi123', '2023-10-16');

--

INSERT INTO Administradores (CedEmp, IDUsuario, Nombre, Apellido, Email, Contraseña, FechaIng) VALUES 
((SELECT CedEmp FROM Empleados WHERE Nombre = 'Romina'), (SELECT IDUsuario FROM Usuarios WHERE Nombre = 'Romina'), 'Romina', 'Celintano', 'paradise5425@gmail.com', 'romina123', '2023-10-16'), 
((SELECT CedEmp FROM Empleados WHERE Nombre = 'Santiago'), (SELECT IDUsuario FROM Usuarios WHERE Nombre = 'Santiago'), 'Santiago', 'Celintano', 'santilopeez7s@gmail.com', 'santi123', '2023-10-16');

--

INSERT INTO Choferes (CedEmp, IDUsuario, Nombre, Apellido, Edad, Email, Contraseña, FechaIng) VALUES 
((SELECT CedEmp FROM Empleados WHERE Nombre = 'Guillermo'), (SELECT IDUsuario FROM Usuarios WHERE Nombre = 'Guillermo'), 'Guillermo', 'Fuentes', 47558756, 'guille3102010@gmail.com', 'guillermo123', '2023-10-16');

--

INSERT INTO Omnibus (FechaC, Estado) 
VALUES 
('2023-10-16', 1),
('2023-10-16', 0);

--

INSERT INTO Conducen (IDchof, IdOmnibus, Fecha_Hora) 
VALUES 
((select IDchofer from Choferes where nombre = 'Guillermo'), 1, '2023-10-16 08:00:00');

--

INSERT INTO Servicios (IdOmnibus, IDChofer, HoraSalida, HoraLlegada, Fecha) VALUES 
(1, (select IDChofer from Choferes where nombre = 'Guillermo'), '08:00:00', '10:30:00', '2023-10-16'),
(1, (select IDChofer from Choferes where nombre = 'Guillermo'), '17:00:00', '19:30:00', '2023-10-16'),
(1, (select IDChofer from Choferes where nombre = 'Guillermo'), '20:00:00', '21:30:00', '2023-10-16'),
(1, (select IDChofer from Choferes where nombre = 'Guillermo'), '09:00:00', '12:30:00', '2023-10-16'),
(1, (select IDChofer from Choferes where nombre = 'Guillermo'), '13:00:00', '16:00:00', '2023-10-16'),
(1, (select IDChofer from Choferes where nombre = 'Guillermo'), '09:00:00', '11:45:00', '2023-10-16');

--

INSERT INTO Rutas (IDruta, Origen, Destino) 
VALUES 
(1, 'Montevideo', 'Canelones'),
(2, 'Montevideo', 'San Jose'),
(3, 'Montevideo', 'Maldonado'),
(4, 'Montevideo', 'Colonia'),
(5, 'Montevideo', 'Durazno');

--

INSERT INTO Lineas (IdServicio, Nombre, IDruta, DuracionViaje, Precio) 
VALUES 
(1,'A22', 1, '01:30:00', 171),
(2,'B35', 2, '02:30:00', 200),
(3,'C35', 3, '01:30:00', 300),
(4,'D35', 4, '03:30:00', 99),
(5,'P35', 4, '03:00:00', 110),
(6,'E35', 5, '02:15:00', 77);

--

INSERT INTO Paradas (IDlinea, Direccion) 
VALUES 
(1, 'Montevideo'), (1, 'Canelones'),
(2, 'Montevideo'), (2, 'San Jose'),
(3, 'Montevideo'), (3, 'Maldonado'),
(4, 'Montevideo'), (4, 'Colonia'),
(5, 'Montevideo'), (5, 'Durazno');

--

INSERT INTO Asientos (IdOmnibus, EstadoAsiento) 
VALUES 
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true),
(1, true);


