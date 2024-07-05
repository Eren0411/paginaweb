SET GLOBAL  max_allowed_packet=100*1024*1024;

Create Database If Not Exists PaginaWeb;

use PaginaWeb;

Create Table Archivos (
    IdArchivo    int(10) NOT NULL AUTO_INCREMENT,
    Archivo longblob NOT NULL,
    MimeType varchar(50) NOT NULL,
    PRIMARY KEY (IdArchivo)
);

Create Table Servicios (
    IdServicio     int(10) NOT NULL AUTO_INCREMENT, 
    Nombre      varchar(250) NOT NULL,
    Descripcion varchar(500) NOT NULL,
    IdArchivo int(10),
    PRIMARY KEY (IdServicio),
    CONSTRAINT fk_Servicios_Archivos FOREIGN KEY (IdArchivo) REFERENCES Archivos(IdArchivo)
);

Create Table Sistemas(
    IdSistema int(10) NOT NULL AUTO_INCREMENT,
    Nombre varchar(150) NOT NULL,
    Descripcion varchar(350) NOT NULL,
    Requisitos  text,
    IdArchivo int(10),
    TipoSistema varchar(50) NOT NULL,
    PRIMARY KEY (IdSistema),
    CONSTRAINT fk_Sistemas_Archivos FOREIGN KEY (IdArchivo) REFERENCES Archivos(IdArchivo)
);

Create Table Publicaciones (
    IdPublicacion    int(10) NOT NULL AUTO_INCREMENT,
    CampoKey    varchar(100) NOT NULL,
    Titulo      varchar(300),
    Descripcion LONGTEXT,
    IdServicio int(10),
    IdSistema int(10),
    IdArchivo int(10),
    PRIMARY KEY (IdPublicacion),
    CONSTRAINT fk_Publicaciones_Sistemas FOREIGN KEY (IdSistema) REFERENCES Sistemas(IdSistema),
    CONSTRAINT fk_Publicaciones_Servicios FOREIGN KEY (IdServicio) REFERENCES Servicios(IdServicio),
    CONSTRAINT fk_Publicaciones_Archivos FOREIGN KEY (IdArchivo) REFERENCES Archivos(IdArchivo)
);

Create Table Roles(
    IdRol   int(10) NOT NULL AUTO_INCREMENT,
    Rol     varchar(50) NOT NULL,
    PRIMARY KEY (IdRol)
);

Create Table Configuraciones(
    CampoKey  varchar(150) NOT NULL,
    Descripcion LONGTEXT NOT NULL
);

Create Table Usuarios(
    IdUsuario   int(10) NOT NULL AUTO_INCREMENT,
    Nombre      varchar(50) NOT NULL,
    Correo      varchar(150) NOT NULL,
    Contra      varchar(20) NOT NULL,
    IdRol       int(10) NOT NULL,
    PRIMARY KEY (IdUsuario),
    CONSTRAINT fk_Usuarios_Roles FOREIGN KEY (IdRol) REFERENCES Roles(IdRol)
);

Create Table Preguntas(
    IdPregunta  int(10) NOT NULL AUTO_INCREMENT,
    Pregunta    varchar(150) NOT NULL,
    Respuesta   LONGTEXT NOT NULL,
    IdRelacion  int(10),
    PRIMARY KEY (IdPregunta)
);

Create Table Productos(
    IdProducto  int(10) NOT NULL AUTO_INCREMENT,
    NombreProducto  varchar(150) NOT NULL,
    Descripcion     LONGTEXT NOT NULL,
    IdArchivo int(10),
    PRIMARY KEY (IdProducto),
    CONSTRAINT fk_Productos_Archivos FOREIGN KEY (IdArchivo) REFERENCES Archivos(IdArchivo)
);

Create Table Funciones(
    IdFuncion   int(10) NOT NULL AUTO_INCREMENT,
    Funcion     varchar(200) NOT NULL,
    Descripcion text,
    IdSistema   int(10) NOT NULL,
    PRIMARY KEY (IdFuncion),
    CONSTRAINT fk_Funciones_Sistemas FOREIGN KEY (IdSistema) REFERENCES Sistemas(IdSistema)
);

Create Table Videos(
    IdVideos    int(10) NOT NULL AUTO_INCREMENT,
    TituloVideo varchar(50) NOT NULL,
    UrlVideo    varchar(450) NOT NULL,
    IdSistema int(10) NOT NULL,
    PRIMARY KEY (IdVideos),
    CONSTRAINT fk_Videos_Sistemas FOREIGN KEY (IdSistema) REFERENCES Sistemas(IdSistema)
);

Create Table Paquetes(
    IdPaquete int(10) NOT NULL AUTO_INCREMENT,
    NombrePaquete varchar(50) NOT NULL,
    Caracteristicas varchar(300) NOT NULL,
    IdSistema int(10) NOT NULL,
    PRIMARY KEY (IdPaquete),
    CONSTRAINT fk_Paquetes_Sistemas FOREIGN KEY (IdSistema) REFERENCES Sistemas(IdSistema)
);

INSERT INTO Roles(IdRol,Rol) VALUES(NULL,'Admin');
INSERT INTO Usuarios(IdUsuario,Nombre,Correo,Contra,IdRol) VALUES(NULL,'AdminWeb', '','AdminWeb2024', '1');

Create View view_servicios as
SELECT s.IdServicio, s.Nombre as NombreServicio, s.Descripcion, s.IdArchivo, a.Archivo, a.MimeType as Tipo
FROM Servicios as s
LEFT JOIN Archivos as a ON s.IdArchivo = a.IdArchivo;

Create View view_sistemas as
SELECT s.IdSistema, s.Nombre as NombreSistema, s.Descripcion, s.Requisitos, s.TipoSistema, s.IdArchivo, a.Archivo, a.MimeType as Tipo 
FROM Sistemas as s
LEFT JOIN Archivos as a ON s.IdArchivo = a.IdArchivo;

Create OR Replace View view_videos as
SELECT v.IdSistema, v.IdVideos, v.TituloVideo, v.UrlVideo
FROM Videos as v;

Create or Replace View view_paquetes as
SELECT p.IdPaquete, p.NombrePaquete, p.Caracteristicas, p.IdSistema
FROM Paquetes as p;


Create View view_Publicaciones as
SELECT p.IdPublicacion, p.CampoKey as Clave, p.Descripcion as DescripcionPublicacion, 
a.MimeType as TipoArchivoPub, a.Archivo as ArchivoPub, p.IdArchivo, P.Titulo,
s1.Nombre as NombreServicio, a1.Archivo as ArchivoServicio, a1.MimeType as TipoArchivoServicio,
s2.Nombre as NombreSistema, a2.Archivo as ArchivoSistema, a2.MimeType as TipoArchivoSistema
FROM Publicaciones as p
LEFT JOIN Servicios as s1 ON p.IdServicio = s1.IdServicio
LEFT JOIN Archivos as a1 ON s1.IdArchivo = a1.IdArchivo
LEFT JOIN Sistemas as s2 ON p.IdSistema = s2.IdSistema
LEFT JOIN Archivos as a2 ON s2.IdArchivo = a2.IdArchivo
LEFT JOIN Archivos as a ON p.IdArchivo = a.IdArchivo;

Create View view_productos as
SELECT  p.IdProducto, p.NombreProducto, p.Descripcion, p.IdArchivo, a1.Archivo, a1.MimeType as Tipo
FROM Productos as p
LEFT JOIN
Archivos as a1
ON p.IdArchivo = a1.IdArchivo;

Create View view_preguntas as
SELECT p.IdPregunta, p.Pregunta, p.Respuesta, p.IdRelacion, s.Nombre as NombreSistema
FROM Preguntas as p
LEFT JOIN
Sistemas as s 
ON p.IdRelacion = s.IdSistema;

Create Or Replace View view_funciones as
SELECT s.IdSistema, s.Nombre as NombreSistema, s.Descripcion, s.Requisitos, s.IdArchivo, a.Archivo, a.MimeType as Tipo,
    f.IdFuncion, f.Funcion, f.Descripcion as DetFuncion
FROM Funciones as f
LEFT JOIN Sistemas as s ON f.IdSistema = s.IdSistema
LEFT JOIN Archivos as a ON s.IdArchivo = a.IdArchivo;


-- Create Table Conocenos (
--     CampoKey    varchar(100) NOT NULL,
--     Descripcion LONGTEXT NOT NULL
-- );

    -- "php.debug.executablePath": "C:\\xampp\\php\\php.exe",
    -- "php.validate.executablePath": "C:\\xampp\\php\\php.exe"

-- ; zend_extension = xdebug

-- [XDebug]
-- ; xdebug.mode = debug
-- ; xdebug.start_with_request = yes


-- Create Table TiposProductos(
--     IdTipoProducto int(10) NOT NULL AUTO_INCREMENT,
--     DescripcionTipoProducto varchar(150) NOT NULL,
--     PRIMARY KEY (IdTipoProducto)
-- );

-- Create Table Productos(
--     IdProducto int(10) NOT NULL AUTO_INCREMENT,
--     NombreProducto varchar(100) NOT NULL,
--     DetallesProducto varchar(500) NOT NULL,
--     IdArchivo int(10),
--     IdMarca int(10),
--     IdTipoProducto int(10),
--     PRIMARY KEY (IdProducto),
--     CONSTRAINT fk_Productos_Archivos FOREIGN KEY (IdArchivo) REFERENCES Archivos(IdArchivo),
--     CONSTRAINT fk_Productos_Marcas FOREIGN KEY (IdMarca) REFERENCES Marcas(IdMarca),
--     CONSTRAINT fk_Productos_TiposProductos FOREIGN KEY (IdTipoProducto) REFERENCES TiposProductos(IdTipoProducto)
-- );

-- Create Table Publicidades (
--     IdPublicidad    int(10) NOT NULL AUTO_INCREMENT,
--     Archivo longblob NOT NULL,
--     MimeType varchar(50) NOT NULL,
-- PRIMARY KEY (IdPublicidad)
-- );

-- Create Table Misiones (
--     IdMision    int(10) NOT NULL AUTO_INCREMENT,
--     DescripcionMision varchar(1000) NOT NULL,
-- PRIMARY KEY (IdMision)
-- );

-- Create Table Visiones (
--     IdVision    int(10) NOT NULL AUTO_INCREMENT,
--     DescripcionVision varchar(1000) NOT NULL,
-- PRIMARY KEY (IdVision)
-- );

-- Create Table Valores (
--     IdValores    int(10) NOT NULL AUTO_INCREMENT,
--     DescripcionValores varchar(1000) NOT NULL,
-- PRIMARY KEY (IdValores)
-- );

-- Create Table QuienesSomos (
--     IdQuienes    int(10) NOT NULL AUTO_INCREMENT,
--     DescripcionQuienes varchar(1000) NOT NULL,
-- PRIMARY KEY (IdQuienes)
-- );

-- Create View view_publicaciones as
-- SELECT p.IdPublic, p.Seccion, p.Principal, p.Secundario, p.IdArchivo, a.Archivo, a.MimeType, a.Descripcion
-- FROM Publicaciones as p
-- LEFT JOIN
-- Archivos as a
-- ON p.IdArchivo = a.IdArchivo
-- ORDER by IdPublic DESC;

-- Create View view_productos as
-- SELECT  p.IdProducto, p.NombreProducto, p.DetallesProducto, p.Archivo as ImgProducto, p.MimeType as TipoArchivo,
--         m.Nombre as NombreMarca, tp.DescripcionTipoProducto as NombreTpProducto
-- FROM Productos as p
-- LEFT JOIN
-- Archivos as a1
-- ON p.IdArchivo = a1.IdArchivo
-- LEFT JOIN
-- Marcas as m
-- ON p.IdMarca = m.IdMarca
-- LEFT JOIN 
-- Archivos as a2
-- ON m.IdArchivo = a2.IdArchivo
-- LEFT JOIN
-- TiposProductos as tp
-- ON p.IdTipoProducto = tp.IdTipoProducto
-- ORDER by IdProducto DESC;