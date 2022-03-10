<?php

session_start();

$pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$pass = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$confPass = filter_input(INPUT_POST, 'mdp-conf', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$hash = password_hash($pass, PASSWORD_DEFAULT);

$action = $_GET['action'];

switch ($action) {
    case 'register':
        register($pseudo, $email, $pass, $confPass, $hash);
        break;
    case 'login':
        login($email, $pass);
        break;
    case 'logout':
        unset($_SESSION['log']);
        $_SESSION['error'][0] = '';
        header('Location: index.php');
        die;
        break;
}

function register($pseudo, $email, $pass, $confPass, $hash)
{
    if (isset($_SESSION['users'])) {
        $searchEmail = array_search($email, array_column($_SESSION['users'], 'email'));

        if (count($_SESSION['users']) !== 0 && $searchEmail !== false) {
            $emailConf = false;
        } else {
            $emailConf = true;
        }
    } else {
        $emailConf = true;
    }

    if ($pass !== $confPass) {
        $validPass = false;
    } else {
        $validPass = true;
    }

    if ($pseudo && $emailConf && $validPass) {
        $user = [
            'pseudo' => $pseudo,
            'email' => $email,
            'pass' => $hash,
        ];
        $_SESSION['users'][] = $user;
        $_SESSION['error'][0] = '<p class="success">Utilisateur enregistré</p>';
        header('Location: login.php');
        die;
    //////////////////////Tableau erreur/////////////////////
    } elseif (!$pseudo) {
        $_SESSION['error'][0] = '<p class="error">Pseudo invalide</p>';
    } elseif (!$emailConf) {
        $_SESSION['error'][0] = '<p class="error">E-mail invalide ou déjà utilisé</p>';
    } elseif (!$validPass) {
        $_SESSION['error'][0] = '<p class="error">Mot de passe invalide</p>';
    } else {
        $_SESSION['error'][0] = '<p class="error">Erreur Veuillez réessayer ultérieurement</p>';
    }
    header('Location:index.php');
    die;

    return;
}

function login($email, $pass)
{
    $searchEmail = array_search($email, array_column($_SESSION['users'], 'email'));

    if ($searchEmail !== false) {
        if (password_verify($pass, $_SESSION['users'][$searchEmail]['pass'])) {
            $_SESSION['log'] = $_SESSION['users'][$searchEmail];
            header('Location: user.php');
            die;
        } else {
            $_SESSION['error'][0] = '<p class="error">Mot de passe invalide</p>';
            header('Location:login.php');
            die;
        }
    } else {
        $_SESSION['error'][0] = '<p class="error">E-mail invalide</p>';
        header('Location:login.php');
        die;
    }

    return;
}
