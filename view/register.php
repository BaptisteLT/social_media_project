<?php
    use App\controller\TacheController;
use App\DatabaseConnect\PDOSingleton;

$instance = PDOSingleton::getInstance();
$conn = $instance->getConnection();

    
    $tacheController = new TacheController;
    $tacheController = $tacheController->newTache();
?>
