<?php  

use Dotenv\Dotenv;
require __DIR__ . '../../../vendor/autoload.php';

class DBconnector {
    private $host ;
    private $username;
    private $password  ;
    private $bdname ;
    private $port ;

    public $conn;
    public function  __construct(){
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
        $this->host=$_ENV['HOST'];
        $this->username = $_ENV['USERNAME'] ;
        $this->password=$_ENV['PASSWORD'];
        $this->bdname=$_ENV['DBNAME'];
        $this->port=$_ENV['PORT'];

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