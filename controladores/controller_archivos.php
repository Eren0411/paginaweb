<?php

class Archivos extends Conectar
{
    private $table;
    private $view;
    private $id;
    private $lastid;
    public $values = array();

    public function __construct()
    {
        $con = new Conectar();
        $this->db = $con->conexionBD();
        $this->field = array();
    }

    public function lastId()
    {
        $this->lastid = $this->db->insert_id;
        return $this->lastid;
    }

    public function setView($v)
    {
        $this->view = $v;
    }

    public function setTable($t)
    {
        $this->table = $t;
    }

    public function setColumns($c)
    {
        $this->column[] = $c;
    }

    public function setKey($k)
    {
        $this->pkey = $k;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->table}";

        $result = $this->db->query($sql);
        while ($row = $result->fetch_assoc()) {
            $this->field[] = $row;
        }

        return $this->field;
    }

    public function getWhere($value)
    {
        $this->id = $value;
        $sql = "SELECT * FROM {$this->table} WHERE {$this->pkey}={$this->id}";
        // echo $sql;
        $result = $this->db->query($sql);
        while ($row = $result->fetch_assoc()) {
            $this->field[] = $row;
        }
        return $this->field;
    }

    public function getView()
    {
        $sql = "SELECT * FROM {$this->view}";
        $result = $this->db->query($sql);
        while ($row = $result->fetch_assoc()) {
            $this->field[] = $row;
        }
        return $this->field;
    }

    public function getWhereview($value)
    {
        $this->id = $value;
        $sql = "SELECT * FROM {$this->view} WHERE {$this->pkey}={$this->id}";

        $result = $this->db->query($sql);
        while ($row = $result->fetch_assoc()) {
            $this->field[] = $row;
        }
        return $this->field;
    }

    public function insertArchivo($file, $type)
    {
        $this->col = implode(",", $this->column);

        // echo $this->col;
        // echo $this->val;
        try {
            $sql = "INSERT INTO {$this->table} ({$this->pkey},{$this->col}) VALUE (NULL,'$file','$type')";
            // echo $sql;
            $this->db->query($sql);
        } catch (Exception $e) {
            echo '<script>alert("Ocurrio un error en el proceso:\n' . '\tFuncion: ' . ($e->getTrace())[0]["function"] . '\n\tTipo: ' . explode(" ", ($e->getTrace())[0]["args"][0])[0] . '");</script>';
        } finally {
            echo '<script>location.replace("index.php?page=' . $_GET['page'] . '");</script>';
        }

    }

    public function updateArchivo($value, $arch, $tipoa)
    {
        try {
            $this->id = $value;     //ATRAPA EL ID QUE SE USARA PARA IDENTIFICAR CUAL SE CAMBIARA
            // $this->col = implode(",",$this->columsn);
            $this->values[] = $this->column[0] . "='" . $arch . "'";
            $this->values[] = $this->column[1] . "='" . $tipoa . "'";
            // $this->values[] = $this->column[2] ."='". $descrip ."'";
            $this->val = implode(",", $this->values);

            $sql = "UPDATE {$this->table} SET {$this->val} WHERE {$this->pkey}='{$this->id}'";
            $this->db->query($sql);
        } catch (Exception $e) {
            echo '<script>alert("Ocurrio un error en el proceso:\n' . '\tFuncion: ' . ($e->getTrace())[0]["function"] . '\n\tTipo: ' . explode(" ", ($e->getTrace())[0]["args"][0])[0] . '");</script>';
        } finally {
            echo '<script>location.replace("index.php?page=' . $_GET['page'] . '");</script>';
        }

    }

    public function deleteArchivo($value)
    {
        $this->id = $value;
        $sql = "DELETE FROM {$this->table} WHERE {$this->pkey}={$this->id}";
        $this->db->query($sql);
    }
}


class ArchivosModel extends Archivos
{

    private $conArc;
    public $lastidupd;
    public $fidUpd;

    public function __construct()
    {
        $conArc = new Archivos();
        $this->lstid = $conArc->lastId();
    }

    public function uploadFile($fname, $ftype, $fsize, $file)
    {
        // SUBIR ARCHIVOS
        $dir_doc = "recursos/Archivos/";

        if (!file_exists($dir_doc))
            mkdir($dir_doc);

        $uploadOk = 1;

        $dir_file = $dir_doc . basename($fname);   //  ATRAPA EL ARCHIVO
        $typefile = strtolower(pathinfo($dir_file, PATHINFO_EXTENSION)); //  OBTIENE LA INFORMACION DEL ARCHIVO COMO: RUTA, NOMBRE Y EXTENSION

        //  VERIFICA EL TAMAÑO DEL ARCHIVO
        if ($fsize > 5000000) {
            $uploadOk = 0;
        }

        //  MUEVE EL ARCHIVO AL SERVIDOR SOLO CUANDO TODOS LOS FILTROS ANTERIORES SEAN CORRECTOS
        if ($uploadOk == 0) {
            // $errorfile = 'Error en el tipo de archivo, deben ser "PNG, JPG ó JPEG"';
            $errorfile = 0;
            return $errorfile;
        } else {

            // $fch_r = date('Y-m-d');     //OBTIENE LA FECHA ACTUAL
            $rtfile = $dir_doc . "Archivo_" . $fname . $typefile;
            move_uploaded_file($file, $rtfile);

            $gestor = fopen($rtfile, "r");
            $content = fread($gestor, $fsize);
            $dtarchivo = addslashes($content);
            fclose($gestor);

            return $dtarchivo;
        }
    }

    public function comprobarType($type)
    {
        if ($type == 'image/jpg') {
            $typeresult = ".jpg";
            return $typeresult;
        } else {
            $typeresult = ".jpeg";
            return $typeresult;
        }
    }
}


?>