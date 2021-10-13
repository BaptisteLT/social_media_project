<?php
namespace App\controller;

use App\Entity\Formulaire;
use dump;
use App\Entity\Personnage;
use App\Entity\Formulaire2;
use App\Entity\Mage;

class TacheController
{
    
    
    
    public function newTache()
    {


        if(isset($_POST['titre']) && isset($_POST['titre']) != '' &&
        isset($_POST['description']) && isset($_POST['description']) != '' &&
        isset($_POST['priorite']) && isset($_POST['priorite']) != '')
        {

            $checkbox = 1;
            if(!isset($_POST['termine']))
            {
                $checkbox = 0;
            }

            $cookieValues[]=$_POST['titre'];
            $cookieValues[]=$_POST['description'];
            $cookieValues[]=$_POST['priorite'];
            $cookieValues[]=$checkbox;
            setcookie("tache", json_encode($cookieValues), time()+3600);  /* expire dans 1 heure */

            
            $tache = $_POST['titre'].','.$_POST['description'].','.$_POST['priorite'].','.$checkbox;

            $content=file_get_contents('./../view/taches.txt');
            file_put_contents('./../view/taches.txt', $content .PHP_EOL.$tache);
            
            header('location: /taches-list.php');
        }


        $mage = new Mage(50,20,'Mage',50);

        //dump($mage);

        $form = new Formulaire2();
        echo $form->formBegin('form');
        echo $form->formInput('textbox',$required=1,$inputId="toto", $labelContent="Nom: ",$value="");
        echo $form->formEnd();

/*
        //                     Vie, attaque, nom
        $merlin = new Personnage(100,50,'Merlin');
        $arthur = new Personnage(100,99,'Arthur');

        $merlin->touchePar($arthur);
        
        dump($merlin);
        dump($arthur);
        dump($merlin->isMort());die;*/
    }


    public function listeTaches()
    {
        if(isset($_POST['titre']) && isset($_POST['titre']) != '' &&
        isset($_POST['description']) && isset($_POST['description']) != '' &&
        isset($_POST['priorite']) && isset($_POST['priorite']) != '')
        {
            $checkbox = 1;
            if(!isset($_POST['termine']))
            {
                $checkbox = 0;
            }
            
            $tache = $_POST['titre'].','.$_POST['description'].','.$_POST['priorite'].','.$checkbox;

            $content=file_get_contents('./../view/taches.txt');
            file_put_contents('./../view/taches.txt', $content .PHP_EOL.$tache);
            
            
            header('location: /taches-list.php');
        }


    }
}