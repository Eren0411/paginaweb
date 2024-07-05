<?php

class Servicios extends Conectar
{
    private $table;
    private $view;
    private $id;
    private $lastid;
    private $colview;
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

    public function setColumnsView($cf)
    {
        $this->colview[] = $cf;
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
        $sql = "SELECT * FROM {$this->table} WHERE {$this->pkey}={$this->id}";
        // echo $sql;
        $result = $this->db->query($sql);
        $this->field = array();
        while ($row = $result->fetch_assoc()) {
            $this->field[] = $row;
        }
        return $this->field;
    }

    public function getWhereFilter($value)
    {
        try {
            for ($i = 0; $i < count($this->colview); $i++) {
                $this->val[] = $this->colview[$i] . " LIKE '%" . $value . "%'";
            }

            $where = implode(" OR ", $this->val);

            $this->id = $value;
            $sql = "SELECT * FROM {$this->view} WHERE {$where}";
            // echo $sql;
            $result = $this->db->query($sql);
            $this->field = array();
            while ($row = $result->fetch_assoc()) {
                $this->field[] = $row;
            }
            return $this->field;
        } catch (Exception $e) {
            echo '<script>alert("Ocurrio un error en el proceso:\n' . '\tFuncion: ' . ($e->getTrace())[0]["function"] . '\n\tTipo: ' . explode(" ", ($e->getTrace())[0]["args"][0])[0] . '");</script>';
        }
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

    public function insertServicio()
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
            echo '<script>location.replace("index.php?page=ServiciosAdmin");</script>';
        }

    }

    public function updateServicio($value)
    {
        try {
            $this->id = $value;     //ATRAPA EL ID QUE SE USARA PARA IDENTIFICAR CUAL SE CAMBIARA
            for ($i = 0; $i < count($this->column); $i++) {
                if($this->values[$i] !== "NULL") $this->values[$i] = $this->column[$i] . "='" . $this->values[$i] . "'";
                else unset($this->values[$i]);
            }

            $this->val = implode(",", $this->values);

            $sql = "UPDATE {$this->table} SET {$this->val} WHERE {$this->pkey}='{$this->id}'";
            $this->db->query($sql);
        } catch (Exception $e) {
            echo '<script>alert("Ocurrio un error en el proceso:\n' . '\tFuncion: ' . ($e->getTrace())[0]["function"] . '\n\tTipo: ' . explode(" ", ($e->getTrace())[0]["args"][0])[0] . '");</script>';
        } finally {
            echo '<script>location.replace("index.php?page=ServiciosAdmin");</script>';
        }

    }


    public function deleteServicio($value)
    {
        $this->id = $value;
        $sql = "DELETE FROM {$this->table} WHERE {$this->pkey}={$this->id}";
        $this->db->query($sql);
    }

}

?>