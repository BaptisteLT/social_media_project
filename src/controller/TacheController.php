<?php
namespace App\controller;

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
            
            $tache = $_POST['titre'].','.$_POST['description'].','.$_POST['priorite'].','.$checkbox;

            $content=file_get_contents('./../view/taches.txt');
            file_put_contents('./../view/taches.txt', $content .PHP_EOL.$tache);
            
            header('location: /taches-list.php');
        }
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