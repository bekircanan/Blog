<?php
    require_once 'header.php';
    $token = $_GET['token'];
    $stmt = $conn->prepare("SELECT id_user,expire FROM token WHERE nom_token = :token");
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    $user = $stmt->fetch();
    if($user){
        // Vérification de la validité du token
        if($_SERVER['REQUEST_METHOD'] === 'POST' && strtotime($user['expire']) > time()){
            // Vérification de la validité du mot de passe
            if($_POST['mdp'] !== $_POST['mdp2']){
                $error = 'Les mots de passe ne correspondent pas.';
            }else{
                $stmt = $conn->prepare("UPDATE user SET mdp = :mdp WHERE idUser = :idUser");
                $stmt->bindParam(':mdp', password_hash($_POST['mdp'], PASSWORD_DEFAULT));
                $stmt->bindParam(':idUser', $user['id_user']);
                $stmt->execute();
                $stmt = $conn->prepare("DELETE FROM token WHERE nom_token = :token");
                $stmt->bindParam(':token', $token);
                $stmt->execute();
                header('Location: index.php');
                exit();
            }
        }
    }else{
        die('Token invalide ou expiré.');
    }
 ?>

<form method="post">
    <h1>Réinitialiser le mot de passe</h1>
    <input type="hidden" name="token" value="<?php echo $token; ?>">
    <?php if (isset($error)): ?>
        <p style="color: red;font-weight: bold;"><?php echo $error; ?></p>
    <?php endif; ?>
    <label for="mdp">Nouveau mot de passe:</label>
    <input type="password" id="mdp" name="mdp" required><br><br>
    <label for="mdp2">Confirmer le mot de passe:</label>
    <input type="password" id="mdp2" name="mdp2" required><br><br>
    <input type="submit" value="Submit">

<?php
 require_once 'footer.php';
 ?>