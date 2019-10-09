<?php
class setup_DB {

    private $CFG, $DB;
    private $sql;
    private $fillable;
    private $table;

    function __construct($CFG, $DB ) {
        $this->CFG = $CFG;
        $this->DB = $DB;
    }

    public function setTable($classObject) {
        $this->fillable = $classObject->fillable;
        $this->table = $this->CFG->prefix."".$classObject->table;
    }

    public function table($table) {
        $this->table = $this->CFG->prefix."".$table;
        return $this;
    }

    public function getTable() {
        return $this->table;
    }

    public function reset() {
        $this->fillable = [];
        $this->table = "";
    }


    public function insert($array) {
        $sql = "INSERT INTO ".$this->table." (";
        if (sizeof($array) == sizeof($this->fillable)) {
            $sql .= implode(", ", $this->fillable);
            $sql .=")VALUES ('";
            $sql .= implode("','", $array);

       } else {
            $sql .= implode(", ", array_keys($array));
            $sql .=")VALUES ('";
            $sql .= implode("','", array_values($array));
       }
       $sql .= "'); ";
        $this->sql = $sql;

        return $this;
    }

    public function update($id, $array) {
        $sql = "UPDATE ".$this->table." SET ";
        foreach ($array as $key => $value) {
            $sql .= $key." = '".$value ."' ,";
        }
        $sql = rtrim($sql.trim(), ',');
        $sql.=" WHERE id = $id";
        $this->sql = $sql;

        return $this;
    }

    public function select() {
        $this->sql = "SELECT * FROM ".$this->table." ";

        return $this;
    }

    public function selectOption($option) {
        $this->sql = "SELECT ".implode(", ", $option)." FROM ".$this->table." ";

        return $this;
    }

    public function find($id) {
        $sql = "SELECT * FROM ".$this->table." WHERE id = $id";
        $this->sql = $sql;

        return $this;
    }

    public function search($option) {
        $sql = "WHERE ";
        foreach ($option as $key => $value) {
            $sql .= $key." LIKE '%".$value ."%' ";
        }
        $this->sql .= $sql;

        return $this;
    }

    public function where($option) {
        $sql = " WHERE ";
        foreach ($option as $key => $value) {
            $sql .= $key."='".$value ."' ";
        }
        $this->sql .= $sql;

        return $this;
    }

    public function limit($limit) {
        $sql = " LIMIT ".$limit;
        $this->sql .= $sql;

        return $this;
    }

    public function groupBy($column_name) {
        $this->sql .= " GROUP BY ".$column_name." ";

        return $this;
    }

    public function having($condition) {
        $this->sql .= " HAVING".$condition." ";

        return $this;
    }

    public function join( $table,  $col1,  $opt,  $col2) {
        $sql = " INNER  JOIN ".$table." ON ".$col1." ".$opt." ".$col2."\n";
        $this->sql .= $sql;

        return $this;
    }

    public function delete($id) {
        $this->sql =  "DELETE FROM ".$this->table." WHERE id = $id" ;

        return $this;
    }

    public function customSQL($sql) {
        $this->sql = $sql;

        return $this;
    }

    public function excute() {
       // echo $this->sql;
        return $this->DB->query($this->sql);
    }

    public function excuteSelect() {
        // echo $this->sql;
        $results = $this->DB->query($this->sql);
        $result = [];
        if ($results->num_rows > 0) {
            while($row = $results->fetch_assoc()) {
                array_push($result, $row);
            }
        }

        return $result;
    }

    public function excuteGetId() {
        $this->DB->query($this->sql);
        return $this->DB->insert_id;
    }

    public function excuteSelectFirst() {
        // echo $this->sql;
        $results = $this->DB->query($this->sql);
        $result = $row = $results->fetch_assoc();

        return $result;
    }

    public function count($result) {
        return sizeof($result);
    }

    public function getSQL() {
        return $this->sql;
    }
}

?>
