<?php
include_once('register-controller.php');

class XfuelController extends RegisterController
{
    function __construct(array $params)
    {
        parent::__construct($params);
        $this->dao = new XfuelDAO();
    }

    function create()
    {
        try {

            if ($this->checkFieldToInsert()) {

                $xfuel = new XFuelModel($this->params);



                $fields = "XFUEL_VALUE, TYPE, REGION, LOCATION, REASON, DATE_START, PLANNED_END, REMARK, CREATE_USER, CHANGE_USER";

                $left = "$xFuel,'$type','$region','$local','$reason',";

                $right  = "'$start','$end','$rmk','eu','eu'";

                $values = $left . $right;

                $sql = "INSERT INTO XFUEL ($fields) VALUES ($values);";

                $result = $this->dao->exec('insert', $sql);
                return $result;
            }
        } catch (Throwable $e) {
            throw new ErrorException('Create' . $e);
        }
    }

    function ready()
    {
        try {
            $filter = isset($this->params['sort']) ? $this->params['sort'] : 'all';
            $today = new DateTime('now');

            $start = isset($this->params['start']) ? new DateTime($this->params['start']) : $today;
            $start = $start->format('Y-m-d') . " 00:00";
            $dateStart = "DATE_START >= '$start' ";

            if (isset($this->params['end'])) {
                $end = new DateTime($this->params['end']);
                $end = $end->format('Y-m-d') . " 00:00";
                $dateEnd = "AND REAL_END IS NULL OR REAL_END <= '$end';";
            }

            $dateEnd = isset($dateEnd) ? $dateEnd : "AND REAL_END IS NULL;";

            $rightSql = $dateStart . $dateEnd;

            $leftSql = ($filter == "all") ? "SELECT * FROM XFUEL WHERE " : "SELECT * FROM XFUEL WHERE REGION = '$filter' AND ";

            $sql = $leftSql . $rightSql;

            $result = $this->dao->exec('select', $sql);
            return $result;
        } catch (Throwable $e) {
            throw new ErrorException('Ready' . $e);
        }
    }

    function delete()
    {
        return 'delete';
    }

    function update()
    {
        return 'update';
    }

    protected function checkFieldToInsert()
    {

        for ($i = 3; $i < 14; $i++) {
            if (
                !isset($this->params[$this->dao->getColumns()[$i]]) ||
                $this->params[$this->dao->getColumns()[$i]] === ""
            ) {
                return $this->dao->getColumns()[$i];
            }
        }
        return true;
    }
}
