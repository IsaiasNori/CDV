<?php
include_once(dirname(__DIR__) . '/config/config.php');
include_once('database.php');

abstract class DAO
{
    protected $columns = [];
    protected $table = "";
    protected $db;

    function __construct()
    {
        $this->db = new DataBase();
    }

    abstract function insert($model);

    abstract function getList($start, $end, $closed = null);

    abstract function getOne($id);

    abstract function update($params);

    abstract function delete($id);

    abstract function getColumns();
}
