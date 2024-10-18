<?php
    require 'header.php';
    echo "<div class='login-container'>";
    echo "<h2>Page de Connexion</h2>";
    $form = false;
    // regarde si la méthode de requête est POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // regarde si les champs pseudo et mdp sont remplis
        if (isset($_POST['pseudo']) && isset($_POST['mdp'])&& !isset($_POST['email'])) {
            $stmt = $conn->prepare("SELECT * FROM user WHERE pseudo = :pseudo");
            $stmt->bindParam(':pseudo', $_POST['pseudo']);
            $stmt->execute();
            $user = $stmt->fetch();
            // regarde si l'utilisateur existe et si le mot de passe est correct
            if ($user) {
                if($_POST['mdp']===$user['mdp']){
                    $_SESSION['user'] = $user['pseudo'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['admin'] = $user['admin'];
                    $_SESSION['idUser'] = $user['idUser'];
                    header('Location: index.php');
                    exit();
                }else{
                    echo "<p>Nom d'utilisateur ou mot de passe incorrect.</p>";
                }
            } elseif (!$user) {
                echo "<p>Utilisateur non trouvé. Veuillez fournir votre adresse Email pour créer un compte.</p>";
                $form = true;
            }
        // regarde si les champs pseudo, mdp et email sont remplis
        } elseif (isset($_POST['email']) && isset($_POST['pseudo']) && isset($_POST['mdp'])) {
            $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email");
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->execute();
            $email = $stmt->fetch();

            if ($email) {
                echo "<p>L'adresse Email est déjà utilisée. Veuillez réessayer avec une autre adresse ou vous connecter.</p>";
            } else {
                $stmt = $conn->prepare("SELECT count(idUser) total FROM user");
                $stmt->execute();
                $iduser = $stmt->fetch();
                $iduser['total']++;
                $stmt = $conn->prepare("INSERT INTO user (idUser,pseudo, mdp, email, admin) VALUES (:iduser,:pseudo, :mdp, :email, 0)");
                $stmt->bindParam(':iduser', $iduser['total']);
                $stmt->bindParam(':pseudo', $_POST['pseudo']);
                $stmt->bindParam(':mdp', $_POST['mdp']);
                $stmt->bindParam(':email', $_POST['email']);
                $stmt->execute();
                unset($_POST['email']);
                header('Location: login.php');
                exit();
            }
        } else {
            echo "<p>Veuillez remplir tous les champs du formulaire.</p>";
        }
    }
    // affiche le formulaire de connexion ou de création de compte
    if (!$form) {
?>
    <form method="post">
        <label for="pseudo">Pseudo: </label>
        <input type="text" id="pseudo" name="pseudo" required>
        <br>
        <label for="mdp">Mot de passe: </label>
        <input type="password" id="mdp" name="mdp" required>
        <br>
        <button type="submit">Connexion</button>
    </form>
<?php
    } else {
?>
    <form method='post'>
        <input type='hidden' name='pseudo' value='<?php echo $_POST['pseudo'] ?>'>
        <input type='hidden' name='mdp' value='<?php echo $_POST['mdp'] ?>'>
        <label for='email'>Email: </label>
        <input type='email' id='email' name='email' required>
        <button type='submit'>Créer un compte</button>
    </form>
<?php
    }
    echo "</div>";
    require_once 'footer.php';
?>
