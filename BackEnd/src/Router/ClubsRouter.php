<?php

require_once("../src/Models/Club.php");
require_once("../src/Controller/ClubController.php");
class ClubsRouter {
    private $URI ;
    private $Method ;
    public function __construct($URI , $Method)
    {
        $this->URI = $URI ;
        $this->Method = $Method ;
    }
    public function Dispatcher(){
        switch($this->Method) {
            case 'GET':
                $this->GET();
                break;
            case 'POST':
                $this->POST();
                break;
            default:
                http_response_code(405);
                echo json_encode([
                    'status' => false,
                    'message' => 'Method Not Allowed'
                ]);
                break;
        }
    }

    private function GET() {
       
        $actionsplited = strtok($this->URI , "?");
        $routeaction =  explode("/clubs"  ,$actionsplited);
        if(isset($routeaction[1]) && $routeaction[1] == "/getclubs"){
            $ClubController = new ClubController();
            $result = $ClubController->GetClubs();
            $data =[];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row ;
            }
            http_response_code(200);
            echo json_encode($data);
        }else{
            http_response_code(422);
            echo json_encode([
                'status' => false,
                "mesage" => 'Error route action'
            ]);
        }
    }
    private function POST() {

        $route = explode("/clubs", $this->URI);

        if (isset($route[1]) && $route[1] != "") {
          
            if (strtok($route[1] ,"?") === "/addclub") {
                $queryString = parse_url($this->URI, PHP_URL_QUERY);
    
                if ($queryString) {
                    parse_str($queryString, $queryParams);
    
                    $name = $queryParams['name'] ?? null;
                    $img = $queryParams['img'] ?? null;
    
                    if ($name && $img) {
                        $ClubController = new ClubController();
                        $status = $ClubController->InsertClub(new Club($name, $img));
                        http_response_code(201);
                        echo json_encode($status);
                        
                    } else {
                        http_response_code(422);
                        echo json_encode([
                            'status' => false,
                            'message' => 'Missing required parameters'
                        ]);
                    }
                } else {
                    http_response_code(422);
                    echo json_encode([
                        'status' => false,
                        'message' => 'Missing required parameters'
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => false,
                    'message' => 'Invalid action route'
                ]);
            }
        }else{
            echo json_encode([
                'status' => false,
                'message' => 'Invalid action route'
            ]);
        }
        
    }
    
    

}
?>
