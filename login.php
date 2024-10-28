<?php
    require 'header.php';
    echo "<div class='login-container'>";
    echo "<h1>Connexion</h1>";
    $form = false;
    // regarde si les champs pseudo et mdp sont remplis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['pseudo']) && isset($_POST['mdp'])&& !isset($_POST['email'])){
            compteCree:
            $stmt = $conn->prepare("SELECT * FROM user WHERE pseudo = ?");
            $stmt->bindParam(1, $_POST['pseudo']);
            $stmt->execute();
            $user = $stmt->fetch();
            // regarde si l'utilisateur existe et si le mot de passe est correct
            if((strlen($_POST['pseudo'])<3 || strlen($_POST['pseudo'])>20)){
                echo "<p>Le pseudo doit contenir entre 3 et 20 caractères.</p>";
            }elseif(strlen($_POST['mdp'])<3 || strlen($_POST['mdp'])>49){
                echo "<p>Le mot de passe doit contenir entre 3 et 48 caractères.</p>";
            }elseif ($user) {
                if(password_verify($_POST['mdp'], $user['mdp'])){
                    $_SESSION['user'] = $user['pseudo'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['admin'] = $user['admin'];
                    $_SESSION['idUser'] = $user['id_user'];
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
            $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
            $stmt->bindParam(1, $_POST['email']);
            $stmt->execute();
            $email = $stmt->fetch();

            if ($email) {
                echo "<p>L'adresse Email est déjà utilisée. Veuillez réessayer avec une autre adresse ou vous connecter.</p>";
            } else {
                $stmt = $conn->prepare("INSERT INTO user (pseudo, mdp, email, admin) VALUES (?, ?, ?, 0)");
                $stmt->bindParam(1, $_POST['pseudo']);
                $mdp= password_hash($_POST['mdp'], PASSWORD_DEFAULT);
                $stmt->bindParam(2, $mdp);
                $stmt->bindParam(3, $_POST['email']);
                $stmt->execute();
                goto compteCree;
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
        <input type="text" name="pseudo" maxlength='20' placeholder="Pseudo" required>
        <br>
        <label for="mdp">Mot de passe: </label>
        <input type="password" name="mdp" maxlength='48' placeholder="Mot de passe" required>
        <a class="erreur" href='mdp.php'>Mot de passe oublié ?</a>
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
        <input type='email' name='email' placeholder="Email" required>
        <br>    
        <button type='submit'>Créer un compte</button>
    </form>
<?php
    }
    echo "</div>";
    require_once 'footer.php';
?>