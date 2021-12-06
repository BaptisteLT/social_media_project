<?php

    use App\controller\SecurityController;
    $securityController = new SecurityController;
    $securityController = $securityController->myAccount();
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
            <div class="row" id="account-form">
                <?= isset($securityController['error_message']) ? '<div class="alert alert-warning mt-3" role="alert">'.$securityController['error_message'].'</div>' : '' ?>
                <h1>My account</h1>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Current password</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New password</label>
                        <input type="password" name="new_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm new password</label>
                        <input type="password" name="new_password_confirm" class="form-control" required>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary mb-3" value="Modifier">
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>