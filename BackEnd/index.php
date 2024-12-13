<?php 
require_once("./DBconnector.php");
require_once("./Models/Player.php");
require_once("./Models/Club.php");

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
$ConnectionStatus = $DBconnector->OpenConnection();
!$ConnectionStatus && die("Connection failed: " . $this->conn->connect_error);

//Add Club 
//$DBconnector->InsertClub(new Club('test' , 'test'));
$Resultat = $DBconnector->GetClubs();

$row = $Resultat->fetch_assoc();

header('Content-Type: application/json');
if($row){
    echo json_encode($row) ;
}else{
    echo json_encode(['error' => 'No data found']) ;
}
?>