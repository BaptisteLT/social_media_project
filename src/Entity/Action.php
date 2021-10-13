<?php

use Valeur;

abstract class Action extends Valeur
{
    protected $bourse;

    public function __construct($nom, $prix, $bourse="Paris", $fin="0"){
        $this->nom = $nom;
        $this->prix = $prix;
        $this->bourse = $bourse;
        $this->fin = $fin;
    }
    public function getInfo(){
        $info = "Action $this->nom coté à la bourse de $this->bourse <br/>";
        $info .= "Le prix de $this->nom est de $this->prix";
        return $info;
    }
}