<?php
class Player{
    public $id = "";
    public $name = "";
    public $photo = "";
    public $pace = 0;
    public $shooting = 0;
    public $passing = 0;
    public $dribbling = 0;
    public $defending = 0;
    public $physical = 0;
    public $nationality_id = 0;
    public $club_id = 0;

    public function __construct(
        $name,$photo,$pace,$shooting,$passing,
        $dribbling,$defending,$physical,$nationality_id,
        $club_id)
    {
        $this->name = $name;
        $this->photo = $photo;
        $this->pace = $pace;
        $this->shooting = $shooting;
        $this->passing = $passing;
        $this->dribbling = $dribbling;
        $this->defending = $defending;
        $this->physical = $physical;
        $this->nationality_id = $nationality_id;
        $this->club_id = $club_id;
    }
    
}

  
?>