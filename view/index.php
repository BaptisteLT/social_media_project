<?php

    use App\controller\IndexController;
    $indexController = new IndexController;
    $indexController = $indexController->index();
?>

<!DOCTYPE html>
<html>
<head>
<?php include 'head.php' ?>
<link rel="stylesheet" href="css/index.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        
        
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>