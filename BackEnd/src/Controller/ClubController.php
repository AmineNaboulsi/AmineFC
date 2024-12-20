<?php
require_once("../src/Config/DBconnector.php");
class ClubController {
    private $DBconnector ;
    public function __construct()
    {
        $this->DBconnector = new DBconnector();  
    }

    public function GetClubs(){
        $query = 'SELECT * FROM club';
        if(isset($_GET['id'])){
            $query = 'SELECT * FROM club WHERE club_id = ?';
        }
        $this->DBconnector->OpenConnection();
        if (!$this->DBconnector->CheckConnection()) {
            return null; 
        }
        $stmt = $this->DBconnector->conn->prepare($query);
        if(isset($_GET['id'])){
            $stmt->bind_param('i' , 
            $_GET['id']);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $Data = [] ;
        while ($row = $result->fetch_assoc()) {
            $Data[] = $row  ;
        }
        
        $this->DBconnector->CloseConnection();
        return $Data;
    }
    public function InsertClub(){
        if(isset($_POST['name']) && isset($_POST['photo']) ){
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
            $_POST['name'] , $_POST['photo']);
    
            if (!$stmt->execute()) {
                return ['status' => false, 'message' => 'Error : ' . $stmt->error];
            }
    
           $this->DBconnector->CloseConnection();
           return ['status' => true, 'message' => 'Club added successfully'];
        }else{
            return ['status' => false, 'message' => 'Missing parametres'];

        }
       
    }
    public function EditClub(){
        $allpara = [
            'id','name','img'
        ];
        $missingpara = array_filter($allpara , function ($itemPara) {
            return !isset($_GET[$itemPara]);
        });
        if(!empty($missingpara)){
            return [
                "status" => false,
                "message" => "Missing parameters: " 
            ];
        }
        $this->DBconnector->OpenConnection();


        $query = 'Update club 
        SET club_name = ? , club_img = ? 
        WHERE club_id = ?' ;
        $SqlDataReader =  $this->DBconnector->conn->prepare($query);

        $SqlDataReader->bind_param('ssi' ,
        $_GET['name'] , $_GET['img'] , $_GET['id'] );
        if(!$SqlDataReader->execute()){
            return [
                "status" => false ,
                "message" => "Error".$SqlDataReader->error
            ];
        }
        $this->DBconnector->CloseConnection();
        return ['status' => true, 'message' => 'Club Updated successfully'];

    }
    public function DelClub(){
        if(isset($_GET['id']))
        {
            $this->DBconnector->OpenConnection();
            if (!$this->DBconnector->CheckConnection()) {
                return ['status' => false, 'message' => 'Database connection failed'];
            }
            $stmt = $this->DBconnector->conn->prepare("
                DELETE FROM club WHERE club_id = ?
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
            
            return ['status' => true, 'message' => 'Club Deleted successfully'];
            }else{
            return ['status' => false, 'message' => 'Missing parametres'];

        }
    }
}
?>
