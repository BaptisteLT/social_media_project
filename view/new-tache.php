
<?php
    use App\controller\TacheController;
use App\DatabaseConnect\PDOSingleton;

$instance = PDOSingleton::getInstance();
$conn = $instance->getConnection();

    
    $tacheController = new TacheController;
    $tacheController = $tacheController->newTache();
?>

<!DOCTYPE html>
<html>
<body>

<p>Liste des tâches</h1>
<a href="new-tache.php">Créer une tâche</a>

<form method="post">

    <input placeholder="Titre de la tache" type="text" id="titre" name="titre" required minlength="1">
    <input placeholder="Description de la tache" type="text" id="description" name="description" required minlength="1">
    <select id="priorite" name="priorite">
        <option value="1">Priorité faible</option>
        <option value="2">Priorité moyen</option>
        <option value="3">Priorité haute</option>
    </select>

    <div>
    <input type="checkbox" id="termine" name="termine">
    <label for="termine">Tâche terminée?</label>
    </div>

    <button type="submit">Enregistrer</button>

</form>



</body>
</html>