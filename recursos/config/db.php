<?php

class Conectar
{

    public $conexion;
    private $host = "localhost";    //------    ESTA LINEA DEINE EL SERVIDOR  -------//
    private $user = "root";         //------    ESTA LINEA DEINE EL USUARIO  -------//
    private $pass = "";             //------    ESTA LINEA DEINE LA CONTRASEÑA  -------//
    private $dbname = "paginaweb";   //------    ESTA LINEA DEINE LA BASE DATOS  -------//

    public function conexionBD()
    {
        $this->comprobarBD();

        $conexion = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        $tablas = $this->obtenerTablas($conexion);
        $this->comprobarTablas($tablas, $conexion);
        $this->comprobarAdmin($conexion);
        // if($conexion->connect_error){
        //     echo "Error en la conexion:" . $conexion->connect_errno . ":" . $conexion->connect_error;
        // } else {
        //     echo "conexion hecha";
        // }

        return $conexion;
    }

    public function cerrarConexion(){
        $this->conexion->close();
    }

    public function comprobarBD()
    {
        $Test = new mysqli($this->host, $this->user, $this->pass, "information_schema");
        $Existe = $Test->query(
            "SELECT SCHEMA_NAME
                FROM INFORMATION_SCHEMA.SCHEMATA
            WHERE SCHEMA_NAME = '" . $this->dbname . "'"
        );

        if ($Existe->num_rows == 0) {
            $Test->query("Create Database If Not Exists " . $this->dbname . ";");
        }
        $Test->query("SET GLOBAL  max_allowed_packet=100*1024*1024;");
        // $Test->query("use " . $this->dbname . ";");
    }

    public function obtenerTablas($conection)
    {
        $result = $conection->query("show tables");
        $this->field = array();
        while($row = $result->fetch_assoc()) {
            $this->field[] = $row;
        }
        return $this->field;
    }

    public function comprobarTablas($tExistentes, $conection)
    {
        $Tablas = $this->Tablas();
        $Alters = $this->Alters();
        
        $exist = array();
        $exist = array_column($tExistentes, "Tables_in_paginaweb");

        for($i = 0; $i < count($Tablas); $i++){
            $tab = strtolower($Tablas[$i][0]);
            // $exs = in_array(strtolower($Tablas[$i][0]),$exist);
            if(!in_array($tab, $exist)){
                $conection->query($Tablas[$i][1]);

                $var = array_key_exists($tab, $Alters);
                if(array_key_exists($tab, $Alters)){
                    for($k = 0; $k < count($Alters); $k++){
                        if(in_array(strtolower($Alters[$k][0]), $exist)){
                            
                        }
                    }
                }
            }
        }

        for($k = 0; $k < count($Alters); $k++){
            $variable = in_array(strtolower($Alters[$k][0]), $exist);

            if(in_array(strtolower($Alters[$k][0]), $exist)){
                try{
                    $conection->query($Alters[$k][1]);
                }
                catch (Exception $e){
                    // echo '<script>alert("Alter ya aplicado");</script>';
                }
            }
        }

        $exist = array();
    }

    public function comprobarAdmin($conection){
        $Perfil = $conection->query("SELECT * FROM Roles WHERE Rol = 'Admin';");
        $Usuario = $conection->query("SELECT * FROM Usuarios WHERE Nombre = 'AdminWeb' AND Contra = 'AdminWeb2024';");

        if($Perfil->num_rows == 0) $conection->query("INSERT INTO Roles(IdRol,Rol) VALUES(NULL,'Admin');");
        if($Usuario->num_rows == 0) $conection->query("INSERT INTO Usuarios(IdUsuario,Nombre,Correo,Contra,IdRol) VALUES(NULL,'AdminWeb', '','AdminWeb2024', '1');");
    }
    public function Tablas(){
        $tablas = array();
        $tablas[] = [0 => "Archivos",
            1 => "Create Table Archivos (
            IdArchivo    int(10) NOT NULL AUTO_INCREMENT,
            Archivo longblob NOT NULL,
            MimeType varchar(50) NOT NULL,
            PRIMARY KEY (IdArchivo)
        );"];

        $tablas[] = [0 => "Servicios",
            1 => "Create Table Servicios (
            IdServicio     int(10) NOT NULL AUTO_INCREMENT, 
            Nombre      varchar(250) NOT NULL,
            Descripcion varchar(500) NOT NULL,
            IdArchivo int(10),
            PRIMARY KEY (IdServicio),
            CONSTRAINT fk_Servicios_Archivos FOREIGN KEY (IdArchivo) REFERENCES Archivos(IdArchivo)
        );"];

        $tablas[] = [0 => "Sistemas",
            1 => "Create Table Sistemas(
                IdSistema int(10) NOT NULL AUTO_INCREMENT,
                Nombre varchar(150) NOT NULL,
                Descripcion varchar(350) NOT NULL,
                Requisitos  text,
                IdArchivo int(10),
                TipoSistema varchar(30) NULL,
                IdEncabezado int(10),
                PRIMARY KEY (IdSistema),
                CONSTRAINT fk_Sistemas_Archivos FOREIGN KEY (IdArchivo) REFERENCES Archivos(IdArchivo)
                CONSTRAINT fk_Sistemas_Encabezado FOREIGN KEY (IdArchivo) REFERENCES ARCHIVOS(IdArchivo)
            );"];

        $tablas[] = [0 => "Videos",
            1 => "Create Table Videos(
                IdVideos    int(10) NOT NULL AUTO_INCREMENT,
                TituloVideo varchar(50) NOT NULL,
                UrlVideo    varchar(450) NOT NULL,
                IdSistema int(10) NOT NULL,
                PRIMARY KEY (IdVideos),
                CONSTRAINT fk_Videos_Sistemas FOREIGN KEY (IdSistema) REFERENCES Sistemas(IdSistema)
            );"];

        $tablas[] = [0 => "Paquetes",
            1 => "Create Table Paquetes(
                IdPaquete int(10) NOT NULL AUTO_INCREMENT,
                NombrePaquete varchar(50) NOT NULL,
                Caracteristicas varchar(300) NOT NULL,
                IdSistema int(10) NOT NULL,
                PRIMARY KEY (IdPaquete),
                CONSTRAINT fk_Paquetes_Sistemas FOREIGN KEY (IdSistema) REFERENCES Sistemas(IdSistema)
            );"];

        $tablas[] = [0 => "Publicaciones",
        1 => "Create Table Publicaciones (
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
        );"];

        $tablas[] = [0 => "Roles",
        1 => "Create Table Roles(
            IdRol   int(10) NOT NULL AUTO_INCREMENT,
            Rol     varchar(50) NOT NULL,
            PRIMARY KEY (IdRol)
        );"];

        $tablas[] = [0 => "Configuraciones",
        1 => "Create Table Configuraciones(
            CampoKey  varchar(100) NOT NULL,
            Descripcion LONGTEXT NOT NULL
        );"];

        $tablas[] = [0 => "Usuarios",
        1 => "Create Table Usuarios(
            IdUsuario   int(10) NOT NULL AUTO_INCREMENT,
            Nombre      varchar(50) NOT NULL,
            Correo      varchar(150) NOT NULL,
            Contra      varchar(20) NOT NULL,
            IdRol       int(10) NOT NULL,
            PRIMARY KEY (IdUsuario),
            CONSTRAINT fk_Usuarios_Roles FOREIGN KEY (IdRol) REFERENCES Roles(IdRol)
        );"];

        $tablas[] = [0 => "Preguntas",
        1 => "Create Table Preguntas(
            IdPregunta  int(10) NOT NULL AUTO_INCREMENT,
            Pregunta    varchar(150) NOT NULL,
            Respuesta   LONGTEXT NOT NULL,
            IdRelacion  int(10),
            PRIMARY KEY (IdPregunta)
        );"];

        $tablas[] = [0 => "Productos",
        1 => "Create Table Productos(
            IdProducto  int(10) NOT NULL AUTO_INCREMENT,
            NombreProducto  varchar(150) NOT NULL,
            Descripcion     LONGTEXT NOT NULL,
            IdArchivo int(10),
            PRIMARY KEY (IdProducto),
            CONSTRAINT fk_Productos_Archivos FOREIGN KEY (IdArchivo) REFERENCES Archivos(IdArchivo)
        );"];

        $tablas[] = [0 => "Funciones",
        1 => "Create Table Funciones(
            IdFuncion   int(10) NOT NULL AUTO_INCREMENT,
            Funcion     varchar(200) NOT NULL,
            Descripcion text,
            IdSistema   int(10) NOT NULL,
            PRIMARY KEY (IdFuncion),
            CONSTRAINT fk_Funciones_Sistemas FOREIGN KEY (IdSistema) REFERENCES Sistemas(IdSistema)
        );"];

        $tablas[] = [0 => "view_servicios",
        1 => "Create View view_servicios as
            SELECT s.IdServicio, s.Nombre as NombreServicio, s.Descripcion, s.IdArchivo, a.Archivo, a.MimeType as Tipo
            FROM Servicios as s
            LEFT JOIN Archivos as a ON s.IdArchivo = a.IdArchivo;"];

        $tablas[] = [0 => "view_sistemas",
        1 => "Create View view_sistemas as
        SELECT s.IdSistema, s.Nombre, s.Descripcion, s.Requisitos, s.TipoSistema, s.Videos, s.IdArchivo, a.Archivo, a.MimeType as Tipo 
        FROM Sistemas as s
        LEFT JOIN Archivos as a ON s.IdArchivo = a.IdArchivo"];

        $tablas[] = [0 => "view_Publicaciones",
        1 => "Create View view_Publicaciones as
            SELECT p.IdPublicacion, p.CampoKey as Clave, p.Descripcion as DescripcionPublicacion, 
            a.MimeType as TipoArchivoPub, a.Archivo as ArchivoPub, p.IdArchivo, P.Titulo,
            s1.Nombre as NombreServicio, a1.Archivo as ArchivoServicio, a1.MimeType as TipoArchivoServicio,
            s2.Nombre as NombreSistema, a2.Archivo as ArchivoSistema, a2.MimeType as TipoArchivoSistema
            FROM Publicaciones as p
            LEFT JOIN Servicios as s1 ON p.IdServicio = s1.IdServicio
            LEFT JOIN Archivos as a1 ON s1.IdArchivo = a1.IdArchivo
            LEFT JOIN Sistemas as s2 ON p.IdSistema = s2.IdSistema
            LEFT JOIN Archivos as a2 ON s2.IdArchivo = a2.IdArchivo
            LEFT JOIN Archivos as a ON p.IdArchivo = a.IdArchivo;"];

        $tablas[] = [0 => "view_productos",
        1 => "Create View view_productos as
            SELECT  p.IdProducto, p.NombreProducto, p.Descripcion, p.IdArchivo, a1.Archivo, a1.MimeType as Tipo
            FROM Productos as p
            LEFT JOIN
            Archivos as a1
            ON p.IdArchivo = a1.IdArchivo;"
            ];

        $tablas[] = [0 => "view_preguntas",
        1 => "Create View view_preguntas as
            SELECT p.IdPregunta, p.Pregunta, p.Respuesta, p.IdRelacion, s.Nombre as NombreSistema
            FROM Preguntas as p
            LEFT JOIN
            Sistemas as s 
            ON p.IdRelacion = s.IdSistema;"
            ];
            
        $tablas[] = [0 => "view_funciones",
        1 => "Create Or Replace View view_funciones as
            SELECT s.IdSistema, s.Nombre, s.Descripcion, s.Requisitos, s.IdArchivo, a.Archivo, a.MimeType as Tipo,
                f.IdFuncion, f.Funcion, f.Descripcion as DetFuncion
            FROM Funciones as f
            LEFT JOIN Sistemas as s ON f.IdSistema = s.IdSistema
            LEFT JOIN Archivos as a ON s.IdArchivo = a.IdArchivo;"
            ];

        $tablas[] = [0 => "view_videos",
        1 => "Create Or Replace View view_videos as
            SELECT v.IdSistema, v.IdVideos, v.TituloVideo, v.UrlVideo
            FROM Videos as v;"
        ];

        $tablas[] = [0 => "view_paquetes",
        1 => "Create or Replace View view_paquetes as
        SELECT p.IdPaquete, p.NombrePaquete, p.Caracteristicas, p.IdSistema
        FROM Paquetes as p;"
        ];
                
        return $tablas;
    }

    public function Alters(){
        $alters = array();

        $alters[] = [0 => "sistemas",
        1 => "ALTER TABLE sistemas ADD Requisitos text;"];

        $alters[] = [0 => "sistemas",
        1 => "Create OR REPLACE View view_sistemas as
        SELECT s.IdSistema, s.Nombre, s.Descripcion, s.Requisitos, s.TipoSistema, s.IdEncabezado, a.Archivo as Encabezado, a.MimeType as TipoEncabezado, s.IdArchivo, a.Archivo, a.MimeType as Tipo 
        FROM Sistemas as s
        LEFT JOIN Archivos as a ON s.IdArchivo = a.IdArchivo
        LEFT JOIN Archivos as a ON s.IdEncabezado = a.IdArchivo;"];

        $alters[] = [0 => "publicaciones",
        1 => "Create Or Replace View view_Publicaciones as
        SELECT p.IdPublicacion, p.CampoKey as Clave, p.Descripcion as DescripcionPublicacion,
        a.MimeType as TipoArchivoPub, a.Archivo as ArchivoPub, p.IdArchivo, P.Titulo,
        s2.IdSistema, s2.Nombre as NombreSistema, a2.Archivo as ArchivoSistema, a2.MimeType as TipoArchivoSistema
        FROM Publicaciones as p
        LEFT JOIN Sistemas as s2 ON p.IdSistema = s2.IdSistema
        LEFT JOIN Archivos as a2 ON s2.IdArchivo = a2.IdArchivo
        LEFT JOIN Archivos as a ON p.IdArchivo = a.IdArchivo;
        "];

        return $alters;
    }
}

$con = new Conectar();
$connect = $con->conexionBD();
//  print_r($con->conexionBD());

?>