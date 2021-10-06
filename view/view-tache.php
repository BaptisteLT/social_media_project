<?php
//Si le paramètre id existe
if(isset($_GET['id']))
{
    $idExists = false;
    $taches=[];
    
    foreach(file(dirname(__DIR__). '/view/taches.txt') as $key => $line) {
        $array = explode(',', $line);
        array_push($array,$key);
        array_push($taches,$array);
        //var_dump($key);die;

        //Si l'id demandé vaut la clé, alors l'id existe
        if($_GET['id'] == $key && $idExists === false)
        {
            $idExists=true;
        }
        
    }
    //Si la tâche n'existe pas
    if($idExists===false)
    {
        
        //On redirige l'utilisateur vers error 404
        header('location: /error404.php');
    }
}
else
{
    //On redirige l'utilisateur vers error 404
    header('location: /error404.php');
}

$id = $_GET['id'];
//récupère la tache dans l'array de tâches grâce à l'id.
$tache = $taches[$id];
echo '<h3>'.$tache[0].'</h3>';
echo '<h3>'.$tache[1].'</h3>';



$completeOrNot = trim($tache[3]);

echo '<h3>'.($completeOrNot === "0" ? ' La tâche est encore à faire !' : ' La tâche est complétée !') .'</h3>';//titre



echo '<a href="taches-list.php">Retour à la liste</a>';
echo '<p> ou </p>';
echo '<a href="new-tache.php">Créer une autre tâche</a>';

