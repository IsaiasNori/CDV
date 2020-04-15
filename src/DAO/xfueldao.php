<?php

include_once('dao.php');
require_once(MODEL_PATH . '/xfuelmodel.php');

class XfuelDAO extends DAO
{
    function __construct()
    {
        $this->table = "XFUEL";
        $this->columns = [
            "id",
            "record_date",
            "record_time",
            "xfuel_value",
            "type",
            "region",
            "local",
            "reason",
            "date_start",
            "date_end",
            "date_closed",
            "remark",
            "user_create",
            "user_change"
        ];
    }

    function insert($model)
    {
        return $this->insert($model);
    }

    function getList($start, $end, $closed = false){
    {
        try {
            // codar...
            return "get";
        } catch (Throwable $e) {
            throw new ErrorException($e);
        }
    }
    
    function getOne($id)
    {
        try {
            return $id;
        } catch (Throwable $e) {
            throw new ErrorException($e);
        }
    }
    
    function update($model)
    {
        try {
            return $model;
        } catch (Throwable $e) {
            throw new ErrorException($e);
        }
    }
    
    function delete($id)
    {
        try {
            return $id;
        } catch (Throwable $e) {
            throw new ErrorException($e);
        }
    }
    
    function getColumns()
    {
        return $this->getColumns();
    }
}
