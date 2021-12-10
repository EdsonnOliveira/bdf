<?php
    class CRUD {
        public $PDO;

        public $SQL;
        public $TABLE;
        public $WHERE;
        public $ORDERBY;

        public $FETCH;
        public $COUNT;

        function __construct() {
            try {

                $host = 'localhost';
                $user = 'root';
                $pass = 'Cupom@System123';
                $db   = 'bdf';

                $host = '162.241.62.251';
                $user = 'batis356_root';
                $pass = 'Batista/1106';
                $db   = 'batis356_bdf';

                $this->PDO = new PDO('mysql:host=' . $host .';dbname=' . $db, $user, $pass);
            } catch (PDOException $e) {
                echo $e;
                die();
            }
        }

        function setTable($table) {
            $this->SQL = null;
            $this->TABLE = $table;
            $this->WHERE = null;
            $this->ORDERBY = null;
            $this->FETCH = null;
        }

        function setSQL($data, $type, $id) {
            unset($data['submit']);
            $columns = ''; $values = '';
            switch ($type) {
                case 'insert':
                    foreach ($data as $column => $value) {
                        $columns .= "$column, ";
                        $values .= "'$value', ";
                    }

                    $columns = trim($columns, ", ");
                    $values = trim($values, ", ");

                    $sql = "INSERT INTO " . $this->TABLE . " ($columns) VALUES ($values)";
                    break;
                case 'select':
                    $sql = 'SELECT * FROM ' . $this->TABLE . ' ';
                    break;
                case 'update':
                    $sql = 'UPDATE ' . $this->TABLE . ' SET ';
                    break;
                case 'delete':
                    $sql = 'DELETE FROM ' . $this->TABLE . ' WHERE ' . $data[$id] . '=' . $id;
                    break;
            }

            $this->SQL = $sql;
        }

        function setSQLGeneric($sql) {
            $this->SQL = $sql;
        }

        function addOrderBy($column, $type) {
            $this->ORDERBY = ' ORDER BY ' . $column . ' ' . $type;
        }

        function execSQL($params = null, $fetchAll = false) {
            $sql = $this->SQL . $this->WHERE . $this->ORDERBY;
            $this->SQL = $this->PDO->prepare($sql);
            $this->SQL->execute($params);

            if ($fetchAll == true)
                $this->FETCH = $this->SQL->fetchAll(\PDO::FETCH_ASSOC);
            else
                $this->FETCH = $this->SQL->fetch(\PDO::FETCH_ASSOC);
            $this->COUNT = $this->SQL->rowCount();
        }
    }
?>