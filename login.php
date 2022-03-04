<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <form action="traitement.php?action=login" method="post">
    <p>
            Email :
            <input type="email" name="email">
        </p>
        <p>
            Mot de passe :
            <input type="text" name="mdp">
        </p>
        <input type="submit" name="submitLogin" value="S'inscrire">
    </form>
    <div>
        
    <?php
    if (isset($_SESSION['log'])) {
        var_dump($_SESSION['log']);
    }

    if (isset($_SESSION['error'])) {
        echo $_SESSION['error'][0];
    } else {
        echo '';
    }
    ?>
    </div>
</body>
</html>