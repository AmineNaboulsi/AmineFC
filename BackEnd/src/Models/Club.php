<?php
class Club{
    public $id ;
    public $name = "";
    public $photo = "";
   
    public function __construct(
        $new_name ,$new_photo ){
        $this->name = $new_name ;
        $this->photo = $new_photo ;
    }
    public function getId(){
        return $this->id ;
    }
    public function setId($id){
        $this->id = $id ;
    }
}

  
?>