<?php

class Gos{
    public $nom;
    public $raça;
    public $propietari;
    public $img;

    function __construct($nom,$raça,$propietari,$img)
    {
        $this->$nom = $nom;
        $this->$raça = $raça;
        $this->$propietari = $propietari;
        $this->$img = $img;
    }
}

?>