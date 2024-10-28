<?php
    require_once 'header.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(strlen($_POST['titre'])>150){
            $error = 'Le titre doit contenir moins de 150 caractères.';
        }elseif (!empty($_POST['titre']) && !empty($_POST['contenu']) && !empty($_POST['categorie'])) {
            foreach ($_POST['categorie'] as $categorie) {
                echo "cat".$categorie;
            }
            $stmt = $conn->prepare("SELECT id_user FROM user WHERE pseudo = :pseudo");
            $stmt->bindParam(':pseudo', $_SESSION['user']);
            $stmt->execute();
            $user = $stmt->fetch();
            $stmt = $conn->prepare("INSERT INTO article (contenu, titre, id_user) VALUES ( :contenu, :titre, :user)");
            $stmt->bindParam(':contenu', nl2br($_POST['contenu']));
            $stmt->bindParam(':titre', $_POST['titre']);
            $stmt->bindParam(':user', $user['id_user']);
            $stmt->execute();
            $id = $conn->lastInsertId();
            foreach($_POST['categorie'] as $categorie){
                $stmt = $conn->prepare("INSERT INTO article_categorie (id_categorie,id_article) VALUES (?, ?)");
                $stmt->bindParam(1, $categorie);
                $stmt->bindParam(2, $id);
                $stmt->execute();
            }
            header('Location: index.php');
            exit();
        }else{
            $error = 'Veuillez remplir tous les champs du formulaire.';
        }
    }
?>

<form method="post">
    <h1>Créer un article</h1>
    <?php if (isset($error)): ?>
        <p class="erreur"><?php echo $error; ?></p>
    <?php endif; ?>
    <h3>Titre:</h3>
    <input type="text" name="titre" maxlength="150" placeholder="Titre" value="<?php echo (isset($_POST['titre']) && !empty($_POST['titre'])? $_POST['titre'] : "" ) ?>" required><br><br>
    
    <h3>Contenu:</h3>
    <textarea name="contenu" rows="10"  placeholder="..." required><?php echo (isset($_POST['contenu']) && !empty($_POST['contenu'])? $_POST['contenu'] : "" ) ?></textarea><br><br>
    
    <h3>Catégorie:</h3>
    <br>
    <div class="checkbox">  
        
        <?php
            $stmt = $conn->prepare("SELECT * FROM categorie");
            $stmt->execute();
            $categories = $stmt->fetchAll();
            foreach ($categories as $categorie) {
                echo '<input type="checkbox" id="'.$categorie['id_categorie'].'" name="categorie" value="'.$categorie['id_categorie'].'"></input>';
                
                echo '<label for="'.$categorie['id_categorie'].'">' . $categorie['nom_categorie'] . '</label>';
            }
        ?>
    </div>
    <br>
    <button type="submit">Valider</button>
</form>
<?php
    require_once 'footer.php';
?>