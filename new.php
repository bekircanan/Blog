<?php
    require_once 'header.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['titre']) && !empty($_POST['contenu']) && !empty($_POST['categorie'])) {
            foreach ($_POST['categorie'] as $categorie) {
                echo "cat".$categorie;
            }
            $stmt = $conn->prepare("SELECT idUser FROM user WHERE pseudo = :pseudo");
            $stmt->bindParam(':pseudo', $_SESSION['user']);
            $stmt->execute();
            $user = $stmt->fetch();
            $stmt = $conn->prepare("SELECT count(idArticle) total FROM article");
            $stmt->execute();
            $article = $stmt->fetch();
            $article['total']++;
            $stmt = $conn->prepare("INSERT INTO article (idarticle,contenu, titre, idUser) VALUES (:idarticle, :contenu, :titre, :user)");
            $stmt->bindParam(':idarticle', $article['idArticle']);
            $stmt->bindParam(':contenu', $_POST['contenu']);
            $stmt->bindParam(':titre', $_POST['titre']);
            $stmt->bindParam(':user', $user['idUser']);
            $stmt->execute();
            foreach($_POST['categorie'] as $categorie){
                $stmt = $conn->prepare("INSERT INTO article_categorie (idCategorie,idArticle) VALUES (?, ?)");
                $stmt->bindParam(1, $categorie);
                $stmt->bindParam(2, $article['idArticle']);
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
        <p style="color: red;font-weight: bold;"><?php echo $error; ?></p>
    <?php endif; ?>
    <label for="titre">Titre:</label>
    <input type="text" id="titre" name="titre" required><br><br>
    
    <label for="contenu">contenu:</label>
    <textarea id="contenu" name="contenu" rows="10" required></textarea><br><br>
    
    <div>
        <label for="categorie">Catégorie:</label>
    <?php
        $stmt = $conn->prepare("SELECT * FROM categorie");
        $stmt->execute();
        $categories = $stmt->fetchAll();
        foreach ($categories as $categorie) {
            echo '<input type="checkbox" id="'.$categorie['idCategorie'].'" name="categorie[]" value="'.$categorie['idCategorie'].'">'.$categorie['nomCategorie'].'</input>';
        }
    ?>
    </div>
    <input type="submit" value="Submit">
</form>
<?php
    require_once 'footer.php';
?>