<?php

require_once(realpath(dirname(__DIR__))  . '/src/config/config.php');

// echo (MODEL_PATH . "</br>");
// echo (VIEW_PATH . "</br>");
include_once(CONTROLLER_PATH . '/xfuelcontroller.php');


// $d = new DataBase();
// var_dump($d);
// var_dump(get_class_methods($d));

$pr = [
    "xfuel_value" => 15,
    "type" => "alert",
    "region" => "alert",
    "local" => "info",
    "reason" => "info",
    "date_start" => "2020-04-10 00:10",
    "date_end" => "2020-04-10 00:10",
    "remark" => "n",
    "user_create" => "eu",
    "user_change" => "eu"
];


$ctr = new XfuelController($pr);
$r = $ctr->create();

echo (json_encode($r));
