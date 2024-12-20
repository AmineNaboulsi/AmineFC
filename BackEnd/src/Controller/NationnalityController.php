<?php
require_once("../src/Config/DBconnector.php");

class NationnalityController{
    private $DBconnector ;

    public function __construct()
    {
        $this->DBconnector = new DBconnector();  
    }
    public function GetNationnalitys(){
        $Pos = -1 ;
        if(isset($_GET['id']) ){
            $Pos = !empty($_GET['id']) ? $_GET['id'] : -1 ;
        }
        $query=  'CALL GetNationalitys(?)';
        $this->DBconnector->OpenConnection();
        $SQLDATAREADER = $this->DBconnector->conn->prepare($query);
        $SQLDATAREADER->bind_param('i' , $Pos);
       
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
    public function InsertNationnality(){
        if(isset($_POST['name']) && isset($_POST['photo']) ){
            $this->DBconnector->OpenConnection();
            if (!$this->DBconnector->CheckConnection()) {
                return ['status' => false, 'message' => 'Database connection failed'];
            }
            $stmt = $this->DBconnector->conn->prepare("
                INSERT INTO nationality 
                (nationality_name , nationality_img)
                VALUES ( ? , ? )
            ");
        
            if (!$stmt) {
                return ['status' => false, 'message' => 'Error preparing statement: ' . $this->DBconnector->conn->error];
            }
    
            $stmt->bind_param('ss' , 
            $_POST['name'] , $_POST['photo']);
    
            if (!$stmt->execute()) {
                return ['status' => false, 'message' => 'Error : ' . $stmt->error];
            }
            
           $this->DBconnector->CloseConnection();
           return ['status' => true, 'message' => 'Nationnality added successfully'];
        }else{
            return ['status' => false, 'message' => 'Missing parametres'];

        }
       
    }
    public function EditNationnality(){
        if(isset($_GET['name']) && isset($_GET['img']) && isset($_GET['id']) ){
            $this->DBconnector->OpenConnection();
            if (!$this->DBconnector->CheckConnection()) {
                return ['status' => false, 'message' => 'Database connection failed'];
            }
            $stmt = $this->DBconnector->conn->prepare("
                UPDATE nationality SET
                nationality_name = ? , nationality_img  = ?
                WHERE nationality_id = ? 
            ");
        
            if (!$stmt) {
                return ['status' => false, 'message' => 'Error preparing statement: ' . $this->DBconnector->conn->error];
            }
    
            $stmt->bind_param('ssi' , 
            $_GET['name'] , $_GET['img'] , $_GET['id']);
    
            if (!$stmt->execute()) {
                return ['status' => false, 'message' => 'Error : ' . $stmt->error];
            }
            
           $this->DBconnector->CloseConnection();
           return ['status' => true, 'message' => 'Nationnality Updated successfully'];
        }else{
            return ['status' => false, 'message' => 'Missing parametres'];

        }
       
    }
    public function DelNationnality(){
        if(isset($_GET['id']) ){
            $this->DBconnector->OpenConnection();
            if (!$this->DBconnector->CheckConnection()) {
                return ['status' => false, 'message' => 'Database connection failed'];
            }
            $stmt = $this->DBconnector->conn->prepare("
                DELETE FROM nationality 
                WHERE nationality_id = ? 
            ");
        
            if (!$stmt) {
                return ['status' => false, 'message' => 'Error preparing statement: ' . $this->DBconnector->conn->error];
            }
    
            $stmt->bind_param('i' , 
            $_GET['id']);
    
            if (!$stmt->execute()) {
                return ['status' => false, 'message' => 'Error : ' . $stmt->error];
            }
            
           $this->DBconnector->CloseConnection();
           return ['status' => true, 'message' => 'Nationnality deleted successfully'];
        }else{
            return ['status' => false, 'message' => 'Missing parametres'];

        }
       
    }
  

}
?>