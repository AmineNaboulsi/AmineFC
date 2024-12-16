<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: POST, GET ,PUT,DELETE ');
header('Content-Type: application/json');

require_once("../src/Router/MainRouter.php");

//Get URI path and http method 
$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$MainRouter = new MainRouter();
$MainRouter->Dispatcher($method , $request);

// switch(true)
// {
//     case (str_contains(strtok($request , '?') , '/players')):
        
//         break;
//     case (str_contains(strtok($request , '?') , '/nationalitys')):
//         $MainRouter = new MainRouter();
//         $MainRouter->Dispatcher($method , $request);
//         break;
//     case (str_contains(strtok($request , '?') , '/clubs')):
//         // ClubsRouter::Dispatcher($request , $method);
//         // $ClubsRouter = new ClubsRouter($request , $method);
//         // $ClubsRouter->Dispatcher();
//         break;
//     default:
//     http_response_code(404);
//     echo json_encode([
//         [
//             'status' => false,
//             'Error' => '404'
//         ]
//     ]);
//         break;
// }

?>