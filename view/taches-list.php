<!DOCTYPE html>
<html>
<body>

<p>Liste des tâches</h1>
<a href="new-tache.php">Créer une tâche</a>

<a href="login.php">Se login</a>



<?php

$taches=[/*['titre'=>'Détails de Faire les courses','contenu'=>'Contre l morrerjeorjeijo iejoir jgor','id'=>1,'priorite'=>3],
['titre'=>'Détails de Inscription école maternelle','contenu'=>'Contre l morefzefrezefrjeefzorjeijo iejoir jgor','id'=>2,'priorite'=>1]*/];


foreach(file(dirname(__DIR__). '/view/taches.txt') as $key => $line) {
    $array = explode(',', $line);
    array_push($array,$key);
    array_push($taches,$array);
}
//var_dump($taches);die;


foreach ($taches as $tache)
{
    echo'<div style="border: 1px solid black">';
    $completeOrNot = trim($tache[3]);
    //var_dump($tache[3]);
    echo '<h3>'.$tache[0]. ($completeOrNot === "0" ? ' (Incomplète)' : ' (Complète)') .'</h3>';//titre
    echo '<p>'.$tache[1].'</p>';//description
    echo '<p>Priorité: '.$tache[2].'</p>';

    echo '<a href="view-tache.php?id='.$tache[4].'">En savoir plus</a>';
    echo'</div>';
}

if(isset($_COOKIE["tache"]))
{
    $cookie = json_decode($_COOKIE["tache"]);
    echo'<div style="border: 1px solid black">';
    $completeOrNot = trim($cookie[3]);
    echo '<h3>'.$cookie[0]. ($completeOrNot === "0" ? ' (Incomplète)' : ' (Complète)') .'</h3>';//titre
    echo '<p>'.$cookie[1].'</p>';//description
    echo '<p>Priorité: '.$cookie[2].'</p>';
    echo'</div>';
}



?>

</body>
</html>