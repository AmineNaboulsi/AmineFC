<?php
class Club{
    public $id ;
    public $name = "";
    public $photo = "";// c'est pas necessaire de donner une valeur par defaut
   
    public function __construct(
        $new_name ,$new_photo ){
        $this->name = $new_name ;
        $this->photo = $new_photo ;
    }
    public function getId(){
        return $this->id ;
    }
    public function setId($id){// vous aurez apres besoin de faire setId ?? c'est pas auto increment
        $this->id = $id ;
    }
}

  
?>