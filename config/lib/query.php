<?php 

public class Query {
    private $command;
    private $update;
    private $columns;
    private $columnValues;
    private $from;
    private $where;
    private $groupBy;
    private $having;
    private $orderBy;
    private $paginate;
    private $limit;
    private $join;
    
    public __construct(){
        $this->command = "Select *";
        $this->update = "";
        $this->columns = "";
        $this->columnValues = "";
        $this->from = "";
        $this->where = "";
        $this->orderBy = "";
        $this->groupBy = "";
        $this->having = "";
        $this->paginate = "";
        $this->limit = "";
        $this->join = "";
    }
  
    public String toString() {
        return $this->command +" "
                + $this->from +" "
                + $this->update +" "
                + $this->columns +" "
                + $this->columnValues +" "
                + $this->join +" "
                + $this->where +" "
                + $this->groupBy +" "
                + $this->having +" "
                + $this->orderBy +" "
                + $this->limit +" "
                + $this->paginate +" ";
    }

    public function getCommand() {
        return $command;
    }

    public function setCommand($command) {
        $this->command = $command;
    }

    public function getUpdate() {
        return $update;
    }

    public function setUpdate($update) {
        $this->update = $update;
    }

    public function getColumns() {
        return $columns;
    }

    public function setColumns($columns) {
        $this->columns = $columns;
    }

    public function getColumnValues() {
        return $columnValues;
    }

    public function setColumnValues($columnValues) {
        $this->columnValues = $columnValues;
    }

    public function getFrom() {
        return $from;
    }

    public function setFrom($from) {
        $this->from = $from;
    }

    public function getWhere() {
        return $where;
    }

    public function setWhere($where) {
        $this->where = $where;
    }

    public function getGroupBy() {
        return $groupBy;
    }

    public function setGroupBy($groupBy) {
        $this->groupBy = $groupBy;
    }

    public function getHaving() {
        return $having;
    }

    public function setHaving($having) {
        $this->having = $having;
    }

    public function getOrderBy() {
        return $orderBy;
    }

    public function setOrderBy($orderBy) {
        $this->orderBy = $orderBy;
    }

    public function getPaginate() {
        return $paginate;
    }

    public function setPaginate($paginate) {
        $this->paginate = $paginate;
    }

    public function getLimit() {
        return $limit;
    }

    public function setLimit($limit) {
        $this->limit = "Limit "+$limit;
    }

    public function getJoin() {
        return $this->join;
    }

    public function setJoin($join) {
        $this->join = $join;
    }

}

?>