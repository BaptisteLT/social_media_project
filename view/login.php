<?php
    // The plain text password to be hashed
    $plaintext_password = "toto";
    $email = "toto@toto.fr";
  
    // The hash of the password that
    // can be stored in the database
    $hash = password_hash($plaintext_password, 
          PASSWORD_DEFAULT);
  

    if(isset($_POST['password']) && isset($_POST['email']))
    {
        if(password_verify($_POST['password'],$hash) && $_POST['email'] == $email)
        {
            $_SESSION['email'] = $_POST['email'];
            var_dump($_SESSION);die;
        }
        else
        {
            die('NOPE');
        }
        
    }
?>

<!DOCTYPE html>
<html>
<body>
<form method="POST">
    <label>Email</label>
    <input type="text" name="email">
    <label>Password</label>
    <input type="text" name="password">

    <input type="submit" value="Se connecter">
</form>

</body>
</html>