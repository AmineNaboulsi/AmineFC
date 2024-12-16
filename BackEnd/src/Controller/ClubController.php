<?php
require_once("../src/Config/DBconnector.php");
class ClubController {
    private $DBconnector ;
    public function __construct()
    {
        $this->DBconnector = new DBconnector();  
    }
    public function InsertClub(){
        if(isset($_GET['name']) && isset($_GET['photo']) ){
            $this->DBconnector->OpenConnection();
            if (!$this->DBconnector->CheckConnection()) {
                return ['status' => false, 'message' => 'Database connection failed'];
            }
            $stmt = $this->DBconnector->conn->prepare("
                INSERT INTO club 
                (club_name , club_img)
                VALUES (?,?);
            ");
            
            if (!$stmt) {
                return ['status' => false, 'message' => 'Error preparing statement: ' . $this->DBconnector->conn->error];
            }
    
            $stmt->bind_param('ss' , 
            $_GET['name'] , $_GET['photo']);
    
            if (!$stmt->execute()) {
                return ['status' => false, 'message' => 'Error : ' . $stmt->error];
            }
    
           $this->DBconnector->CloseConnection();
           return ['status' => true, 'message' => 'Club added successfully'];
        }else{
            return ['status' => false, 'message' => 'Missing parametres'];

        }
       
    }
    public function GetClubs(){
        $this->DBconnector->OpenConnection();
        if (!$this->DBconnector->CheckConnection()) {
            return null; 
        }
        $stmt = $this->DBconnector->conn->prepare("
            SELECT * FROM club
        ");
        $stmt->execute();
        $result = $stmt->get_result();
        $Data = [] ;
        while ($row = $result->fetch_assoc()) {
            $Data[] = $row  ;
        }
        
        $this->DBconnector->CloseConnection();
        return $Data;
    }
    


}
?>
