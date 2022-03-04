<?php

session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div id="wrapper">
        <h1>Profil de <?= $_SESSION['log']['pseudo'] ?></h1>
        <a href="traitement.php?action=logout">Deconnexion</a>



    </div>

</body>

</html>