<?php
class Player{
    public $id = "";// ajouter les types : int, string... et laisser les proprietes private avec getters et setters
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
        $club_id)// si vous etes en train d'utiliser php 8 c'est mieux de faire direct __construct(private int $id, ... ca serai mieux 
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