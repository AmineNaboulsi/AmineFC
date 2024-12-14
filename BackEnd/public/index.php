<?php 
header('Content-Type: application/json');

require_once("../src/DBConnector/DBconnector.php");
require_once("../src/Models/Player.php");
require_once("../src/Models/Club.php");
require_once("../src/Models/Nationality.php");

// $request = $_SERVER['REQUEST_URI'];
// echo '<script>alert("'.$request.'")</<script';
// $path = '/src/Controller/';
// switch($request)
// {
//     case '':
//     case '/': 
//         //require __DIR__ .$path. 'home.php';
//         break;
//     case '/players': 
//         //require __DIR__ .$path. 'players.php';
//         break;
//     case '/nationalitys': 
//         //require __DIR__ .$path. 'nationalitys.php';
//         break;
//     case '/clubs': 
//         //require __DIR__ .$path. 'clubs.php';
//         break;
//     default:
//         http_response_code(404);
//         //require __DIR__ .$path. '404.php';
//         break;
// }

$DBconnector = new DBconnector(
    '127.0.0.1' ,
    'root' ,
    '' ,
    'aminefcdb' ,
);

// $Player = new Player();
// $listplayers = array(
//     new Player(),
//     new Player(),
// );
$ConnectionStatus = (bool)$DBconnector->OpenConnection();
// !$ConnectionStatus && die("Connection failed: " . $this->conn->connect_error);
if(!$ConnectionStatus){
    echo json_encode(['error' => 'Server Failed']) ;
    die();
}

//Add Club 
//$DBconnector->InsertClub(new Club('test' , 'test'));
$Resultat = $DBconnector->GetClubs();
$data;
while($row = $Resultat->fetch_assoc()){
    $data[] = $row ;
}

if($data){
    echo json_encode($data) ;
}else{
    echo json_encode(['error' => 'No data found']) ;
}
$ConnectionStatus = $DBconnector->CloseConnection();

?>