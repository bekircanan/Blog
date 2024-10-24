<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    try {
        $conn = new PDO("mysql:host=localhost;dbname=bolg", 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $pageActuelle = basename($_SERVER['PHP_SELF']);
    $pages = ['login.php', 'mdp.php', 'reset.php'];

    // Si l'utilisateur n'est pas connecté et qu'il n'est pas sur une page autorisée
    if (!isset($_SESSION['user']) && !in_array($pageActuelle, $pages)) {
        header('Location: login.php');
        exit();
    } elseif ($pageActuelle === 'crud.php' && (!isset($_SESSION['email']) || $_SESSION['email'] !== 'admin@localhost.fr' || $_SESSION['admin'] !== 1)) {
        header('Location:index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolg</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<header>
    <div class="container">
        <?php 
            $testDossier = ($pageActuelle === 'crud.php') ? '..' : '.';
            echo '<a href="'.$testDossier.'/index.php"><h1>Bolg</h1></a>';
            // Si l'utilisateur est connecté
            if (isset($_SESSION['user'])) {
                // Si l'utilisateur est un admin
                if (isset($_SESSION['admin']) && $_SESSION['admin'] === 1) {
                    echo '<a href="'.($pageActuelle === 'crud.php' ? '.' : './admin').'/crud.php">Gestion des catégories</a>';
                }
                echo '<a href="'.$testDossier.'/favoris.php">Mes favoris</a>';
                echo '<a href="'.$testDossier.'/mesarticle.php">Mes articles</a>';
                echo '<a href="'.$testDossier.'/new.php">Créer un article</a>';
                echo '<a href="'.$testDossier.'/logout.php">Déconnexion</a>';
            }
        ?>
    </div>
</header>
<body>
<main>