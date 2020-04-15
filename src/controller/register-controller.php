<?php
include_once(dirname(__DIR__, 1) . '..\model\interfaces.php');

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

    protected function checkFieldToInsert();
}
