<?php 
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
require_once("../src/Router/PlayerRouter.php");
require_once("../src/Router/ClubsRouter.php");

//Get URI path and http method 
$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

switch(true)
{
    case (str_contains(strtok($request , '?') , '/players')):
       echo "players";
        break;
    case (str_contains(strtok($request , '?') , '/nationalitys')):
        echo "nationalitys";
        break;
    case (str_contains(strtok($request , '?') , '/clubs')):
        // ClubsRouter::Dispatcher($request , $method);
        $ClubsRouter = new ClubsRouter($request , $method);
        $ClubsRouter->Dispatcher();
        break;
    default:
    http_response_code(404);
    echo json_encode([
        [
            'status' => false,
            'Error' => '404'
        ]
    ]);
        break;
}

?>