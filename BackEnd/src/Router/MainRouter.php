<?php 
require_once("../src/Models/Club.php");
require_once("../src/Controller/PlayerController.php");
require_once("../src/Controller/ClubController.php");
require_once("../src/Controller/NationnalityController.php");
class MainRouter{
    private array $routes = [] ;  

    public function __construct()
    {
        $this->routes = [
                'GET' => [
                    '/players' => [PlayerController::class , 'GetPLayers'],
                    '/clubs' => [ClubController::class , 'GetClubs'],
                    '/nationnalitys' => [NationnalityController::class , 'GetNationnalitys']
                ],
                'POST' => [
                    '/addplayers' => [PlayerController::class , 'AddPLayers'],
                    '/addclub' => [ClubController::class , 'InsertClub'],
                    '/addnationnality' => [NationnalityController::class , 'InsertNationnality'],
                ],
                'PUT' => [
                    '/editplayers' => [PlayerController::class , 'EditPLayers'],
                    '/editclub' => [ClubController::class , 'EditClub'],
                    '/editnationnality' => [NationnalityController::class , ''],
                ],
                'DELETE' => [
                    '/delplayers' => [PlayerController::class , 'DeletePLayers'],
                    '/delclub' => [ClubController::class , ''],
                    '/delnationnality' => [NationnalityController::class , ''],
                ]
            ];
        
    }
    public function Dispatcher($method , $uri){
        $route = strtok($uri, '?');

        if(isset($this->routes[$method][$route])){
            $controllerMethod = $this->routes[$method][$route];
         
            $controller = new $controllerMethod[0]();
            $method = $controllerMethod[1];
            
            $result = $controller->$method();
            
            header('Content-Type: application/json');
            echo json_encode($result);
           
        }else{
            echo json_encode([
                'status' => false ,
                'msg' => 'Invalid route action '
            ]);
        }
    }
}

?>