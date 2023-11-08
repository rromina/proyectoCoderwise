
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
INSERT INTO Usuarios (Nombre, Apellido, Edad, Email, Contraseña) VALUES ('Juan', 'Pérez', 30, 'juan@example.com', 'contraseña123'),('María', 'Gómez', 25, 'maria@example.com', 'clave456'),('Romina', 'Celintano', 20, 'paradise5425@gmail.com', 'romina123'),('Luis', 'Martínez', 35, 'luis@example.com', 'clave_emp');
INSERT INTO Clientes (CI, IDUsuario, Tel, Email, Contraseña, Nombre, Apellido) VALUES (1234567, (SELECT IDUsuario FROM Usuarios WHERE Nombre = 'Juan'), '555-1234', 'juan@example.com', 'contraseña123','Juan', 'Pérez'),(9876543, (SELECT IDUsuario FROM Usuarios WHERE Nombre = 'María'), '555-5678', 'maria@example.com', 'clave456','María', 'Gómez');
INSERT INTO Empleados (IDUsuario, CedEmp, Nombre, Apellido, Edad, Email, Contraseña, FechaIng) VALUES  ((SELECT IDUsuario FROM Usuarios WHERE Nombre = 'Ana'),'12345612', 'Romina', 'Celintano', 20, 'paradise5425@gmail.com', 'romina123', '2023-10-16'),((SELECT IDUsuario FROM Usuarios WHERE Nombre = 'Luis'),'11111110', 'Luis', 'Martínez', 35, 'luis@example.com', 'clave_emp', '2023-10-16');
INSERT INTO Administradores (CedEmp, IDUsuario, Nombre, Apellido, Email, Contraseña, FechaIng) VALUES ((SELECT CedEmp FROM Empleados WHERE Nombre = 'Romina'), (SELECT IDUsuario FROM Usuarios WHERE Nombre = 'Romina'), 'Romina', 'Celintano', 'paradise5425@gmail.com', 'romina123', '2023-10-16');
INSERT INTO Choferes (CedEmp, IDUsuario, Nombre, Apellido, Edad, Email, Contraseña, FechaIng) VALUES ((SELECT CedEmp FROM Empleados WHERE Nombre = 'Luis'), (SELECT IDUsuario FROM Usuarios WHERE Nombre = 'Luis'), 'Luis', 'Martínez', 35, 'luis@example.com', 'clave_emp', '2023-10-16');
INSERT INTO Omnibus (FechaC, Estado) VALUES ('2023-10-16', 1),('2023-10-16', 0);
INSERT INTO Conducen (IDchof, IdOmnibus, Fecha_Hora) VALUES ((select IDchofer from Choferes where nombre = 'Luis'), 1, '2023-10-16 08:00:00');
INSERT INTO Servicios (IdOmnibus, IDChofer, HoraSalida, HoraLlegada, Fecha) VALUES (1, (select IDChofer from Choferes where nombre = 'Luis'), '08:00:00', '10:30:00', '2023-10-16'),(1, (select IDChofer from Choferes where nombre = 'Luis'), '09:00:00', '11:45:00', '2023-10-16');
INSERT INTO Rutas (IDruta, Origen, Destino) VALUES (1, 'montevideo', 'canelones'),(2, 'montevideo', 'san jose');
INSERT INTO Lineas (IdServicio,Nombre, IDruta, DuracionViaje, Precio) VALUES (1,'A22', 1, '01:30:00', 171),(2,'135', 2, '02:15:00', 300);
INSERT INTO Paradas (IDlinea, Direccion) VALUES (1, 'montevideo'),(1, 'canelones'),(2, 'montevideo'),(2, 'san jose');
INSERT INTO Asientos (IdOmnibus, EstadoAsiento) VALUES (1, true);


