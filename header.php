<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    try {
        $conn = new PDO("mysql:host=localhost;dbname=bolg", 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        die($e->getMessage());
    } catch (Exception $e) {
        die($e->getMessage());
    }
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    if (!isset($_SESSION['user']) && empty($_SESSION['user']) &&  basename($_SERVER['PHP_SELF']) !== 'login.php' && basename($_SERVER['PHP_SELF']) !== 'mdp.php' && basename($_SERVER['PHP_SELF']) !== 'reset.php') {
        header('Location: login.php');
        exit();
    }
    if (basename($_SERVER['PHP_SELF']) === 'crud.php' && !isset($_SESSION['email']) && $_SESSION['email'] !== 'admin@localhost.fr' && $_SESSION['admin'] !== 1) {
        header('Location: index.php');
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
            <a href="<?php echo (basename($_SERVER['PHP_SELF']) === 'crud.php' ? '..' : '.') ?>/index.php"><h1>Bolg</h1></a>
            <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === 1){?>
                <a href="<?php echo (basename($_SERVER['PHP_SELF']) === 'crud.php' ? '.' : './admin') ?>/crud.php">crud</a>
            <?php } ?>
            <?php if (isset($_SESSION['user'])){?>
                <a href="<?php echo (basename($_SERVER['PHP_SELF']) === 'crud.php' ? '..' : '.') ?>/logout.php">Déconnexion</a>
            <?php } ?>
            <a href="<?php echo (basename($_SERVER['PHP_SELF']) === 'crud.php' ? '..' : '.') ?>/new.php">créer un article</a>
        </div>
    </header>
<body>
    <main>
    