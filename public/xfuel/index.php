<?php
include_once(dirname(__DIR__) . '/config/config.php');
include_once("MODEL_PATH/xfueldao.php");
include_once("CONTROLLER_PATH/xfuelcontroller.php");

try {
    if (isset($_SERVER['REQUEST_METHOD'])) {
        $method     = $_SERVER['REQUEST_METHOD'];
        $params     = $_REQUEST;
        $controller = new XfuelController($params);

        switch ($method) {
            case 'GET':
                $response = $controller->ready();
                break;
            case 'POST':
                $response = $controller->create();
                break;
            case 'PATCH':
                $response = $controller->update();
                break;
            case 'DELETE':
                $response = $controller->delete();
                break;
            default:
                die("Erro ao mapear ação");
        }
    } else {
        return 'Method Unavailable';
    }

    header('Content-Type: application/json; charset=utf-8');
    echo (json_encode($response, JSON_UNESCAPED_UNICODE));
} catch (Throwable $e) {
    http_response_code(500);
    echo ($e);
}
