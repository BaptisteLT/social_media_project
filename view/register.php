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
    <head>
        <title>Page Title</title>
    </head>
    <body>

        <h1>This is a Heading</h1>
        <p>This is a paragraph.</p>

    </body>
</html>