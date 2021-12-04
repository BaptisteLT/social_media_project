<?php

    use App\controller\SecurityController;
    $securityController = new SecurityController;
    $securityController = $securityController->login();
?>

<!DOCTYPE html>
<html>
<head>
<?php include 'head.php' ?>
<link rel="stylesheet" href="css/login.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <div id="form-container">
            <div class="row" id="login-form">
                <?= isset($securityController['error_message']) ? '<div class="alert alert-warning" role="alert">'.$securityController['error_message'].'</div>' : '' ?>
                <div class="col-12">
                    <h1>Login</h1>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="text" name="password" class="form-control" required>
                        </div>
                        <input type="submit" class="btn btn-primary mb-3" value="Se connecter">
                    </form>
                </div>
                <div class="col-12">
                    <a href="<?= $urlGenerator->generate('register')?>">Pas de compte? cliquez-ici</a>
                </div>
            </div>
            
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>