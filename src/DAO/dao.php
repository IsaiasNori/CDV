<?php
include_once('database.php');

abstract class DAO
{
    protected $columns = [];
    protected $table = "";
    protected $db;

    function __construct($model)
    {
        $this->db = new DataBase();
    }

    function insert($model)
    {
        try {
            foreach ($this->columns as $key) {
                $fields += "{$key},";
                $values += ":{$key},";
            }

            $fields = substr($fields, strlen($fields) - 1, 1);
            $values = substr($values, strlen($values) - 1, 1);

            $sql = "INSERT INTO $this->table ($fields) VALUES ($values);";

            $stmt = $this->db->prepare($sql);

            foreach ($this->columns as $key) {
                $stmt->bindValue($key, $model->$key);
            }

            $stmt->execute();

            $results = $this->db->lastInsertId();
            return $results;
        } catch (PDOException $e) {
            die("Insert: " . $e);
        }
    }

    abstract function getList($start, $end, $closed = null);

    abstract function getOne($id);

    abstract function update($params);

    abstract function delete($id);

    abstract function getColumns()
    {
        return $this->columns;
    }
}
