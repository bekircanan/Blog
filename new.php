<?php
    require_once 'header.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($_POST['titre']) && empty($_POST['contenu']) && empty($_POST['categorie'])) {
            $stmt = $conn->prepare("SELECT idUser FROM user WHERE pseudo = :pseudo");
            $stmt->bindParam(':pseudo', $_SESSION['user']);
            $stmt->execute();
            $result = $stmt->fetch();
            $stmt = $conn->prepare("INSERT INTO article (contenu, categorie, titre, idUser) VALUES (:contenu, :categorie, :titre, :user)");
            $stmt->bindParam(':contenu', $_POST['contenu']);
            $stmt->bindParam(':categorie', $_POST['categorie']);
            $stmt->bindParam(':titre', $_POST['titre']);
            $stmt->bindParam(':user', $result['idUser']);
            $stmt->execute();
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
    
    <label for="categories">Categories:</label>
    <input type="text" id="categorie" name="categorie" required><br><br>
    
    <input type="submit" value="Submit">
</form>
<?php
    require_once 'footer.php';
?>