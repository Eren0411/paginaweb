<?php

class Publicacion extends Conectar
{
    private $table;
    private $view;
    private $id;
    public $lstid;
    public $values = array();

    public function __construct()
    {
        $con = new Conectar();
        $this->db = $con->conexionBD();
        $this->field = array();
    }

    public function lastId()
    {
        $this->lstid = $this->db->insert_id;
        return $this->lstid;
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
        $this->field = array();
        while ($row = $result->fetch_assoc()) {
            $this->field[] = $row;
        }
        return $this->field;
    }

    public function getWhere($value)
    {
        $this->id = $value;
        $sql = "SELECT * FROM {$this->view} WHERE {$this->pkey}='{$this->id}'";

        $result = $this->db->query($sql);
        $this->field = array();
        while ($row = $result->fetch_assoc()) {
            $this->field[] = $row;
        }
        return $this->field;
    }

    public function getWhereClave($value)
    {
        $this->val = $value;

        $sql = "SELECT * FROM {$this->view} WHERE Clave Like '%{$this->val}%' ";
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
        // return $result;
        // return $row;
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

    public function insertPub()
    {
        try {
            $this->col = implode(",", $this->column);
            $this->val = implode(",", $this->values);
            // echo $this->col;
            $sql = "INSERT INTO {$this->table} ({$this->pkey},{$this->col}) VALUE (NULL,{$this->val})";
            // echo $sql;
            $this->db->query($sql);
        } catch (Exception $e) {
            echo '<script>alert("Ocurrio un error en el proceso:\n' . '\tFuncion: ' . ($e->getTrace())[0]["function"] . '\n\tTipo: ' . explode(" ", ($e->getTrace())[0]["args"][0])[0] . '");</script>';
        } finally {
            echo '<script>location.replace("index.php?page=' . $_GET['page'] . '");</script>';
        }
    }

    public function updatePub($value)
    {
        try {
            $this->id = $value;     //ATRAPA EL ID QUE SE USARA PARA IDENTIFICAR CUAL SE CAMBIARA
            $this->val = array();   //SE CREA UN ARRAY DONDE SE COMBINARAN LOS DEMAS
            for ($i = 0; $i <= count($this->values); $i++) {     //SE INICIA EL CICLO DONDE SE LEE LA CANTIDAD DE VALORES
                // $var = $this->values[$i];
                if (key_exists($i, $this->values)) {
                    if ($this->values[$i] !== "NULL") {
                        $this->val[$i] = $this->column[$i] . "=" . $this->values[$i];     //SE CONCATENAN LOS ARRAY PARA ALMACENARLOS EN OTRO ARRAY

                    } else {
                        unset($this->values[$i]);
                    }
                }
            }
            // print_r($this->id);
            // print_r($this->val);     //SE IMPRIME EL ARRAY DONDE SE UNIERON LOS OTROS ARRAY, PARA VER COMO QUEDA
            $this->consult = implode(",", $this->val);       //IMPLODE FUNCIONA PARA CONVERTIR UN ARRAY EN TEXTO Y PODER SEPARARLO CON UN CARACTER O TEXTO DETERMINADO
            // echo $this->consult;       //SE IMPRIME PARA VER COMO QUEDO DESPUES DEL IMPLODE
            $sql = "UPDATE {$this->table} SET {$this->consult} WHERE {$this->pkey}={$this->id}";
            // echo $sql;
            $this->db->query($sql);
        } catch (Exception $e) {
            echo '<script>alert("Ocurrio un error en el proceso:\n' . '\tFuncion: ' . ($e->getTrace())[0]["function"] . '\n\tTipo: ' . explode(" ", ($e->getTrace())[0]["args"][0])[0] . '");</script>';
        } finally {
            echo '<script>location.replace("index.php?page=' . $_GET['page'] . '");</script>';
        }
    }

    public function deletePub($value)
    {
        $this->id = $value;
        $sql = "DELETE FROM {$this->table} WHERE {$this->pkey}={$this->id}";
        $this->db->query($sql);
    }
}
