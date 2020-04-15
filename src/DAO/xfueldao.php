<?php

include_once('dao.php');
require_once(MODEL_PATH . '/xfuelmodel.php');

class XfuelDAO extends DAO
{
    function __construct()
    {
        parent::__construct();
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
        try {
            $fields = "xfuel_value,type,region,local,reason,date_start,date_end,remark,user_create,user_change";
            $values = ":xfuel_value,:type,:region,:local,:reason,:date_start,:date_end,:remark,:user_create,:user_change";

            $sql = "INSERT INTO $this->table ($fields) VALUES ($values)";

            $stmt = $this->db->prepare($sql);

            $stmt->bindValue(':xfuel_value', $model->xfuel_value, PDO::PARAM_INT);
            $stmt->bindValue(':type', $model->type, PDO::PARAM_STR);
            $stmt->bindValue(':region', $model->region, PDO::PARAM_STR);
            $stmt->bindValue(':local', $model->local, PDO::PARAM_STR);
            $stmt->bindValue(':reason', $model->reason, PDO::PARAM_STR);
            $stmt->bindValue(':date_start', $model->date_start);
            $stmt->bindValue(':date_end', $model->date_end);
            $stmt->bindValue(':remark', $model->remark, PDO::PARAM_STR);
            $stmt->bindValue(':user_create', $model->user_create, PDO::PARAM_STR);
            $stmt->bindValue(':user_change', $model->user_change, PDO::PARAM_STR);

            $stmt->execute();

            $results = $this->db->lastInsertId();
            return $results;
        } catch (PDOException $e) {
            die("Insert: " . $e);
        }
    }

    function getList($start, $end, $closed = false)
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
        return $this->columns;
    }
}
