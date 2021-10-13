<?php
namespace App\Entity;


class Personnage
{

    protected $nom;

    protected $vie;

    protected $attaque;

    public function __construct($vie,$attaque,$nom)
    {
        $this->vie = $vie;
        $this->attaque = $attaque;
        $this->nom = $nom;
    }

    /*Getter setter vie*/
    public function getVie()
    {
        return $this->vie;
    }

    public function setVie($vie)
    {
        $this->vie = $vie;

        return $this;
    }

    /*Getter setter attaque*/
    public function getAttaque()
    {
        return $this->attaque;
    }

    public function setAttaque($attaque)
    {
        $this->attaque = $attaque;

        return $this;
    }

    /*Getter setter nom*/
    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    public function touchePar(Personnage $personnage)
    {
        $this->vie = $this->vie - $personnage->getAttaque();
    }

    public function regenerer()
    {
        $this->vie = 100;
    }

    public function isMort()
    {
        if($this->vie <= 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}