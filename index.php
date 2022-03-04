<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/style.css">
    <title>S'inscrire</title>
</head>

<body>

    <div id="wrapper">
        <h1>Inscription</h1>

        <a href="login.php">Login</a>

        <form action="traitement.php?action=register" method="post">
            <p>
                Pseudo :
                <input type="text" name="pseudo">
            </p>
            <p>
                Email :
                <input type="email" name="email">
            </p>
            <p>
                Mot de passe :
                <input type="text" name="mdp">
            </p>
            <p>
                Confirmation mot de passe :
                <input type="text" name="mdp-conf">
            </p>
            <input type="submit" value="S'inscrire">

        </form>

        <div class="message">
            <?php
            if (isset($_SESSION['users'])) {
                var_dump($_SESSION['users']);
            }

            if (isset($_SESSION['error'])) {
                echo $_SESSION['error'][0];
            } else {
                echo '';
            }
            ?>
        </div>
    </div>


</body>

</html>