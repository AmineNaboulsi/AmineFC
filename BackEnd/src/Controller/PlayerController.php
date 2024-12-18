<?php
require_once("../src/Config/DBconnector.php");

class PlayerController {
    private $DBconnector ;
    public function __construct()
    {
        $this->DBconnector = new DBconnector();  
    }

    public function GetPLayers(){
        $query = 'SELECT p.* , c.club_name as clubname , n.nationality_img flag , n.nationality_name nationality FROM Player p  
                JOIN club c ON c.club_id = p.club_id
                JOIN nationality n  ON n.nationality_id = n.nationality_id';

        $this->DBconnector->OpenConnection();
        $SQLDATAREADER = $this->DBconnector->conn->prepare($query);

        if(!$SQLDATAREADER->execute()){
            return [
                "status" => false ,
                "message" => "Error".$SQLDATAREADER->error
            ];
        }
        $DataPlayers = $SQLDATAREADER->get_result();
        $Data = [] ;
        while($row = $DataPlayers->fetch_assoc()){
            $Data[] = $row ;
        }
        $this->DBconnector->CloseConnection();
        return $Data;
    }
    public function AddPLayers(){
        
        $requiredParams = [
            'name', 'photo', 'cover', 'position', 'pace', 
            'shooting', 'passing', 'dribbling', 'defending', 
            'physical', 'nationality_id', 'club_id'
        ];
        //had array db katakhod list li biti tfiltriha 
        //o second par howa function 
        $missingParams = array_filter($requiredParams, function($par) {
            return !isset($_POST[$par]);
        });
        // print_r($missingParams);
        if (!empty($missingParams)) {
            return [
                "status" => false,
                "message" => "Missing parameters: " 
            ];
        }

                $query = 'insert into Player 
                (name , photo , cover , position, pace , shooting,
                passing , dribbling , defending , physical , nationality_id , club_id)
                VALUES 
                (?,?,?,?,?,?,?,?,?,?,?,?);';
                    $this->DBconnector->OpenConnection();
                $SQLDATAREADER = $this->DBconnector->conn->prepare($query);
                $SQLDATAREADER->bind_param('ssssiiiiiiii' ,
                $_POST['name'] , $_POST['photo'] , $_POST['cover']  , $_POST['position'] ,
                $_POST['pace'] , $_POST['shooting'] ,$_POST['passing'] ,
                $_POST['dribbling'] , $_POST['defending'] , $_POST['physical'] ,
                $_POST['nationality_id'] , $_POST['club_id']
                );
        
                if(!$SQLDATAREADER->execute()){
                    return [
                        "status" => false ,
                        "message" => "Error".$SQLDATAREADER->error
                    ];
                }
                $this->DBconnector->CloseConnection();
                return ['status' => true, 'message' => 'PLayer added successfully'];
      
    }
    public function EditPLayers(){

        $requiredParams = [
            'id', 'name', 'photo', 'cover', 'position', 'pace', 
            'shooting', 'passing', 'dribbling', 'defending', 
            'physical', 'nationality_id', 'club_id'
        ];
        //had array db katakhod list li biti tfiltriha 
        //o second par howa function 
        $missingParams = array_filter($requiredParams, function($par) {
            return !isset($_GET[$par]);
        });
        // print_r($missingParams);
        if (!empty($missingParams)) {
            return [
                "status" => false,
                "message" => "Missing parameters: " 
            ];
        }
        $query = 'UPDATE Player SET
                name = ? , photo = ? , cover = ?  , position = ? , pace = ?  , shooting = ? ,
                passing = ? , dribbling = ?  , defending = ?  , physical = ?  ,
                 nationality_id = ?  , club_id = ? 
                WHERE Player.id = ? ;';
        
                $this->DBconnector->OpenConnection();
                $SQLDATAREADER = $this->DBconnector->conn->prepare($query);
                $SQLDATAREADER->bind_param('ssssiiiiiiiii' ,
                $_GET['name'] , $_GET['photo'] , $_GET['cover'] , $_GET['position'] ,
                $_GET['pace'] , $_GET['shooting'] ,$_GET['passing'] ,
                $_GET['dribbling'] , $_GET['defending'] , $_GET['physical'] ,
                $_GET['nationality_id'] , $_GET['club_id'], $_GET['id']
                );
                if(!$SQLDATAREADER->execute()){
                    return [
                        "status" => false ,
                        "message" => "Error".$SQLDATAREADER->error
                    ];
                }
                $this->DBconnector->CloseConnection();
                return ['status' => true, 'message' => 'PLayer Updated successfully'];
        
       
    }
    public function DeletePLayers(){
        if(isset($_GET['id'])){
            $query = 'DELETE FROM Player
            WHERE id = ?  ;';
    
            $this->DBconnector->OpenConnection();
            $SQLDATAREADER = $this->DBconnector->conn->prepare($query);
            $SQLDATAREADER->bind_param('i' ,$_GET['id']
            );
    
            if(!$SQLDATAREADER->execute()){
                return [
                    "status" => false ,
                    "message" => "Error".$SQLDATAREADER->error
                ];
            }
            $this->DBconnector->CloseConnection();
            return ['status' => true, 'message' => 'PLayer Deleted successfully'];
    
        }else{

        }
       
    }

}
?>
