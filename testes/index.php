<?php

require_once(realpath(dirname(__DIR__))  . '/src/config/config.php');

echo (MODEL_PATH . "</br>");
echo (VIEW_PATH . "</br>");
echo (CONTROLLER_PATH . "</br>");

include_once(DAO_PATH . '/xfueldao.php');
$d = new XfuelDAO();

var_dump($d->getColumns());
