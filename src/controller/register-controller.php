<?php
include_once(dirname(__DIR__) . '/config/config.php');

include_once(MODEL_PATH . '/interfaces.php');
include_once(MODEL_PATH . '/model.php');
// include_once(VIEW_PATH . '/view.php');


abstract class RegisterController implements IRegister
{
    protected $dao;
    protected $params;
    function __construct(array $params)
    {
        if (!$this->removeSpecialChar()) die("Erro ao criar controlador");
        $this->params = $params;
    }

    protected function removeSpecialChar()
    {
        try {
            $find = array(",", ";", "*", "\n");
            str_replace($find, "", $this->params);
            return true;
        } catch (Throwable $e) {
            return false;
        }
    }

    protected abstract function checkFields();
}
