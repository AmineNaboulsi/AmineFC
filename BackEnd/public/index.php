<?php 
header('Content-Type: application/json');
require_once("../src/Router/players.php");

$request = $_SERVER['REQUEST_URI'];
// echo '<script>alert("'.$request.'")</<script';
$path = '/src/Controller/';
switch($request)
{
    case '':
    case '/': 
        echo 'home';
        break;
    case '/players': 
       echo "players";
        break;
    case '/nationalitys': 
        echo "nationalitys";
        break;
    case '/clubs':
        echo 'clubs';
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