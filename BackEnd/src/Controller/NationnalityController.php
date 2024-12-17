<?php
require_once('../Config/DBconnector.php');

class NationnalityController{
    private $DBconnector ;

    public function __construct()
    {
        $this->DBconnector = new DBconnector();  
    }
    public function GetNationnalitys(){
        $query=  'CALL GetNationalitys()';
        $this->DBconnector->OpenConnection();
        $SQLDATAREADER = $this->DBconnector->conn->query($query);
        $Data = [] ;
        while ($row = $SQLDATAREADER->fetch_assoc()) {
            $Data = $row ;
        }
        $this->DBconnector->CloseConnection();
        return $Data;
    }
    public function InsertNationnality(){
        if(isset($_GET['name']) && isset($_GET['photo']) ){
            $this->DBconnector->OpenConnection();
            if (!$this->DBconnector->CheckConnection()) {
                return ['status' => false, 'message' => 'Database connection failed'];
            }
            $stmt = $this->DBconnector->conn->query("
                INSERT INTO nationality 
                (nationality_name , nationality_img)
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
           return ['status' => true, 'message' => 'Nationnality added successfully'];
        }else{
            return ['status' => false, 'message' => 'Missing parametres'];

        }
       
    }
  

}
?>