
<?php
    use App\controller\ErrorController;
    $errorController = new ErrorController;
    $errorController = $errorController->getErrorMessage();
?>

<h1><?php echo $errorController['errorMessage'] ?></h1>

<br/>

<a href="taches-list.php">Revenir à la liste</a>