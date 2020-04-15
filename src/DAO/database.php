<?php

class DataBase extends PDO{
    public function __construct() {
        try {
            $ev = parse_ini_file(dirname(__DIR__) . "/config/app.ini");
    
            $host       = $ev['host'];
            $username   = $ev['username'];
            $password   = $ev['password'];
            $database   = $ev['database'];
            $pathdb     = $ev['path_db'];
    
            $path       = dirname(__DIR__, 2) . $pathdb . $database;

            parent::__construct("sqlite:$path");
        }
        catch(PDOException $e){
            die ("Error: {$e->getMessage()}");
        }
    }
}
