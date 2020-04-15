<?php
include_once(dirname(__DIR__) . '/config/config.php');
include_once(DAO_PATH . '/xfueldao.php');
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

            if ($this->params) {
                if ($this->params['type'] === 'xfuel') {
                    if ($this->params['xfuel_value'] === "") {
                        die('Para tipo: Xfuel é necessário informar o valor!');
                    }

                    $this->params['xfuel_value'] = intval($this->params['xfuel_value']);
                    $this->params['region'] = $this->params['region'] !== "" ? $this->params['region'] : false;
                    $this->params['local'] = $this->params['local'] !== "" ? $this->params['local'] : false;
                    $this->params['reason'] = $this->params['reason'] !== "" ? $this->params['reason'] : false;
                } else if ($this->params['type'] === 'alert') {
                    $this->params['region'] = $this->params['region'] !== "" ? $this->params['region'] : false;
                    $this->params['local'] = $this->params['local'] !== "" ? $this->params['local'] : 'alert';
                    $this->params['reason'] = $this->params['reason'] !== "" ? $this->params['reason'] : 'info';
                } else {
                    die('Tipo de informação inválida!');
                }

                $this->params['date_start'] = $this->params['date_start'] !== "" ? new DateTime($this->params['date_start']) : false;
                $this->params['date_end'] = $this->params['date_end'] !== "" ? new DateTime($this->params['date_end']) : false;
                $this->params['remark'] = $this->params['remark'] !== "" ? $this->params['remark'] : "nil";
                // $this->params['user_create'] = $this->params['user_create'] !== "" ? $this->params['user_create'] : false;
                // $this->params['user_change'] = $this->params['user_change'] !== "" ? $this->params['user_change'] : false;
                $this->params['user_create'] = $this->params['user_create'] !== "" ? $this->params['user_create'] : "Teste";
                $this->params['user_change'] = $this->params['user_change'] !== "" ? $this->params['user_change'] : "Teste";

                $this->params['date_start'] = $this->params['date_start']->format('Y-m-d h:i');
                $this->params['date_end'] = $this->params['date_end']->format('Y-m-d h:i');


                if ($this->checkFields()) {
                    $xfuel = new XFuelModel($this->params);
                    $result = $this->dao->insert($xfuel);
                    return ["id" => $result];
                } else {
                    die("O campo {$this->checkFields()} é obrigatório!");
                }
            } else {
                die("Dados Inválidos!");
            }
        } catch (Throwable $e) {
            throw new ErrorException('Controller-Create' . $e);
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

    protected function checkFields()
    {
        for ($i = 3; $i < 14; $i++) {
            if ($i !== 10) {
                if (
                    !isset($this->params[$this->dao->getColumns()[$i]]) ||
                    (!$this->params[$this->dao->getColumns()[$i]])
                ) {
                    return $this->dao->getColumns()[$i];
                }
            }
        }
        return true;
    }
}
