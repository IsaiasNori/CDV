<?php
// Definitions of system
date_default_timezone_set('UTC');


// Define constants
// Paths
define("MODEL_PATH", realpath(dirname(__DIR__))  . '/model');
define("VIEW_PATH", realpath(dirname(__DIR__))  . '/view');
define("CONTROLLER_PATH", realpath(dirname(__DIR__))  . '/controller');
define("DAO_PATH", realpath(dirname(__DIR__))  . '/DAO');


// Includes
// require_once (realpath(dirname(__DIR__))  . "DAO_PATH/database.php" );
