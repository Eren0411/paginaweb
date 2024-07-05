<?php

class Sistemas extends Conectar
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
        //echo $sql;
        $result = $this->db->query($sql);
        $this->field = array();
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
        $this->field = array();
        while ($row = $result->fetch_assoc()) {
            $this->field[] = $row;
        }
        return $this->field;
    }

    public function getView()
    {
        $sql = "SELECT * FROM {$this->view}";

        $result = $this->db->query($sql);
        $this->field = array();
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
        $this->field = array();
        while ($row = $result->fetch_assoc()) {
            $this->field[] = $row;
        }
        return $this->field;
    }

    public function insertSistema()
    {
        try {
            $this->col = implode(",", $this->column);
            $this->val = implode(",", $this->values);

            // echo $this->col;
            // echo $this->val;
            $sql = "INSERT INTO {$this->table} ({$this->pkey},{$this->col}) VALUE (NULL,{$this->val})";
            // echo $sql;
            $this->db->query($sql);
        } catch (Exception $e) {
            echo '<script>alert("Ocurrio un error en el proceso:\n' . '\tFuncion: ' . ($e->getTrace())[0]["function"] . '\n\tTipo: ' . explode(" ", ($e->getTrace())[0]["args"][0])[0] . '");</script>';
        } finally {
            echo '<script>location.replace("index.php?page=SistemasAdmin");</script>';
        }
    }

    public function updateSistema($value)
    {
        try {
            $this->id = $value;     //ATRAPA EL ID QUE SE USARA PARA IDENTIFICAR CUAL SE CAMBIARA
            // $this->col = implode(",",$this->columsn);
            for ($i = 0; $i < count($this->column); $i++) {
                if ($this->values[$i] !== "NULL")
                    $this->values[$i] = $this->column[$i] . "='" . $this->values[$i] . "'";
                else
                    unset($this->values[$i]);
            }

            $this->val = implode(",", $this->values);

            $sql = "UPDATE {$this->table} SET {$this->val} WHERE {$this->pkey}='{$this->id}'";
           // echo $sql;
            $this->db->query($sql);
        } catch (Exception $e) {
            echo '<script>alert("Ocurrio un error en el proceso:\n' . '\tFuncion: ' . ($e->getTrace())[0]["function"] . '\n\tTipo: ' . explode(" ", ($e->getTrace())[0]["args"][0])[0] . '");</script>';
        } finally {
             echo '<script>location.replace("index.php?page=SistemasAdmin");</script>';
        }
    }


    public function deleteSistema($value)
    {
        $this->id = $value;
        $sql = "DELETE FROM {$this->table} WHERE {$this->pkey}={$this->id}";
        echo $sql;
        $this->db->query($sql);
    }

}


class GallerySistems
{

    private $dir_doc = "recursos/Archivos/";
    private $carpeta = "Galeria/";

    public function MoverArchivos($files, $sistema)
    {
        $rutaSave = $this->dir_doc . $this->carpeta . $sistema . "/";

        // $var = $files['name'][0];
        // $correct = isset($files['name'][0]);
        if (isset($files['name'][0]) && !empty($files['name'][0])) {

            if (!file_exists($this->dir_doc))
                mkdir($this->dir_doc);

            if (!file_exists($this->dir_doc . $this->carpeta))
                mkdir($this->dir_doc . $this->carpeta);

            $filesError = array();

            foreach ($files['name'] as $position => $file_name) {

                $file_tmp = $files['tmp_name'][$position];
                $file_size = $files['size'][$position];
                $file_error = $files['error'][$position];

                if ($file_error === 0) {
                    if (!file_exists($rutaSave))
                        mkdir($rutaSave);

                    // Mover el archivo al directorio deseado
                    $destino = $rutaSave . $file_name;
                    move_uploaded_file($file_tmp, $destino);
                    // echo "$file_name subido exitosamente.<br>";
                } else {
                    $filesError[] = $file_name;
                }
            }
            if (count($filesError) > 0) {
                $Error = "Archivos fallidos: \n";
                foreach ($filesError as $row) {
                    $Error = $Error . $row . "\n";
                }
                echo $Error;
            }
        }
    }

    public function ObtenerGaleria($sistema)
    {
        if ($this->ValidateDirectorys($sistema)) {
            $filesToShow = scandir($this->dir_doc . $this->carpeta . $sistema . "/");
            $files = array();
            foreach ($filesToShow as $row) {
                if ($row != "." && $row != "..") {
                    $files[] = $this->dir_doc . $this->carpeta . $sistema . "/" . $row;
                }
            }
            return $files;
        }
    }

    public function DeleteGallery($sistema)
    {
        if ($this->ValidateDirectorys($sistema)) {
            $filesToDelete = scandir($this->dir_doc . $this->carpeta . $sistema . "/");
            foreach ($filesToDelete as $row) {
                unlink($row);
            }
        }
    }

    public function DeleteGalleryWhereSistema($IdSistema){
        $sql = "DELETE FROM {$this->table} WHERE IdSistema = $IdSistema";
        echo $sql;
        $this->db->query($sql);     
    }

    public function ValidateDirectorys($sistema)
    {
        if (file_exists($this->dir_doc)) {
            if (file_exists($this->dir_doc . $this->carpeta)) {
                if (file_exists($this->dir_doc . $this->carpeta . $sistema . "/")) {
                    return true;
                }
            }
        }

        return false;
    }
}
?>