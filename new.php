<?php
    require_once 'header.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['titre']) && !empty($_POST['contenu']) && !empty($_POST['categorie'])) {
            echo "cat".$_POST['categorie[1]'];
            echo "cat".$_POST['categorie'];
            /*
            $stmt = $conn->prepare("SELECT idUser FROM user WHERE pseudo = :pseudo");
            $stmt->bindParam(':pseudo', $_SESSION['user']);
            $stmt->execute();
            $result = $stmt->fetch();
            $stmt = $conn->prepare("SELECT idArticle FROM article");
            $stmt->execute();
            $article = $stmt->fetch();
            $article['idArticle']++;
            $stmt = $conn->prepare("INSERT INTO article (idarticle,contenu, categorie, titre, idUser) VALUES (:idarticle, :contenu, :categorie, :titre, :user)");
            $stmt->bindParam(':idarticle', $article['idArticle']);
            $stmt->bindParam(':contenu', $_POST['contenu']);
            $stmt->bindParam(':titre', $_POST['titre']);
            $stmt->bindParam(':user', $result['idUser']);
            $stmt->execute();
            header('Location: index.php');
            exit();
            */
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