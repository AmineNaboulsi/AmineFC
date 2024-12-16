<?php
require_once("../src/Config/DBconnector.php");

class PlayerController {
    private $DBconnector ;
    public function __construct()
    {
        $this->DBconnector = new DBconnector();  
    }

    public function GetPLayers(){
        $query = 'SELECT * FROM Player';

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
        
        if(isset($_POST['name']) &&
            isset($_POST['photo']) &&
            isset($_POST['cover']) &&
            isset($_POST['position']) &&
            isset($_POST['pace']) &&
            isset($_POST['shooting']) &&
            isset($_POST['passing']) &&
            isset($_POST['dribbling']) &&
            isset($_POST['defending']) &&
            isset($_POST['physical']) &&
            isset($_POST['nationality_id']) &&
            isset($_POST['club_id']) ){
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
        

            }else{
                return ['status' => false, 'message' => 'Missing parametres'];

            }
      
    }
    public function EditPLayers(){

        if(isset($_GET['id']) && isset($_GET['name']) &&
            isset($_GET['photo']) &&
            isset($_POST['cover']) &&
            isset($_GET['position']) &&
            isset($_GET['pace']) &&
            isset($_GET['shooting']) &&
            isset($_GET['passing']) &&
            isset($_GET['dribbling']) &&
            isset($_GET['defending']) &&
            isset($_GET['physical']) &&
            isset($_GET['nationality_id']) &&
            isset($_GET['club_id'])){
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
        
            }else{
                return ['status' => false, 'message' => 'Missing parametres'];

            }
       
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
