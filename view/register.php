<?php

    use App\controller\SecurityController;
    $securityController = new SecurityController;
    $securityController = $securityController->register();
?>

<!DOCTYPE html>
<html>
<head>
<?php include 'head.php' ?>
<link rel="stylesheet" href="css/register.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <div id="form-container">
            <div class="row" id="login-form">
                <h1>Register</h1>
                    <?= isset($securityController['error_message']) ? '<div class="alert alert-warning" role="alert">'.$securityController['error_message'].'</div>' : '' ?>
                    <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm password</label>
                        <input type="password" name="password_confirm" class="form-control" required>
                    </div>
                    <input type="submit" class="btn btn-primary mb-3" value="Se connecter">
                </form>
            </div>
            <a href="<?= $urlGenerator->generate('login')?>">J'ai déjà un compte.</a>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>