<?php
namespace App\Entity;

use App\Entity\Personnage;


class Mage extends Personnage
{

    private $pointsDeSoin;

    public function __construct($vie,$attaque,$nom,$ptsSoin)
    {
       parent::__construct($vie,$attaque,$nom); 
       $this->pointsDeSoin = $ptsSoin;
    }

    public function soigner(Personnage $personnage)
    {
        $personnage->setVie($personnage->getVie() + $this->pointsDeSoin);
    }
}