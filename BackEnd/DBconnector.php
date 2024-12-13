<?php  
class DBconnector {
    private $host="";
    private $username = "" ;
    private $password="" ;
    private $bdname="" ;
    public $conn;
    public function  __construct( $host , $username  , $password , $bdname ){
        $this->host = $host ;
        $this->username = $username ;
        $this->password = $password ;
        $this->bdname = $bdname ;

    }
    public function OpenConnection(){
        $this->conn = new mysqli(
            $this->host , $this->username , $this->password ,$this->bdname
        );

        if ($this->conn->connect_error) {
            return false;
        }else{
            return true;
        }
        

    }

    public function InsertClub($NewClub){
        $stmt = $this->conn->prepare("
            INSERT INTO club 
            (club_name , club_img)
            VALUES (?,?);
        ");
        $stmt->bind_param('ss' , 
        $NewClub->name , $NewClub->photo);

        $stmt->execute();

    }
    public function GetClubs(){
        $stmt = $this->conn->prepare("
            SELECT * FROM club
        ");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    
    public function MessageInfo($msg){
        // echo '<script>alert("'.$msg.'")</script>';
        return $msg;
    }
    public function CloseConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }

}
?>