<?php
require_once("../src/Config/DBconnector.php");
class ClubController {
    private $DBconnector ;
    public function __construct()
    {
        $this->DBconnector = new DBconnector();  
    }
    public function InsertClub($NewClub){
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
        $NewClub->name , $NewClub->photo);


        if (!$stmt->execute()) {
            return ['status' => false, 'message' => 'Error executing statement: ' . $stmt->error];
        }

       $this->DBconnector->CloseConnection();
       return ['status' => true, 'message' => 'Club added successfully'];
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
        
        $this->DBconnector->CloseConnection();
        return $result;
    }
    


}
?>
