<?php  
class DBconnector {
    private $host="localhost";
    private $username = "amineremote" ;
    private $password="amine" ;
    private $bdname="dbaminefc" ;
    private $port=3307;

    public $conn;
    public function  __construct(){
    }
    public function OpenConnection(){
        //mysqli oriented object 
        //mysqli procedurale
        try{
            $this->conn = new mysqli(
                $this->host , $this->username , $this->password ,$this->bdname
                ,$this->port
            );
    
            if ($this->conn->connect_error) {
                echo "Connection failed: " . $this->conn->connect_error;

                return false;
            }else{
                return true;
            }
        }catch(Exception $e){
            return false;
        }
    }
    public function CheckConnection(){
        return (bool) $this->conn;
    }

    public function MessageInfo($msg){
        return $msg;
    }
    public function CloseConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }

}
?>