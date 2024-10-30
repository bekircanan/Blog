<?php
    require_once 'header.php';
?>
    <div class="background">
        <h1>Mes articles</h1>
    </div>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['suppr_article'])){
            $stmtDeleteFromArticle = $conn->prepare("DELETE FROM article WHERE id_article = {$_POST['suppr_article']}");
            $stmtDeleteFromArticle->execute();
            header("Location: mesarticle.php");
            exit;
        }
    }

    //requette sql pour chercher les articles de l'utilisateur
    $stmt = $conn->prepare("SELECT id_article,titre,date_pub, SUBSTR(contenu, 1, 150) as contenu FROM article WHERE id_user = ?");
    $stmt->bindParam(1, $_SESSION['idUser']);
    $stmt->execute();
    $articles = $stmt->fetchAll();
    //affichage des articles de l'utilisateur
    if(!empty($articles)){
        foreach($articles as $article){
            echo '<div class="afficher_article background"><a href="./article.php?id_article=' . $article['id_article']. '">'; 
            echo '<h1>' . $article['titre'] . '</h1>';
            echo '<p>Publié le ' . $article['date_pub'] . '</p>';
            echo '<p>' . $article['contenu'] . '...</p></a>';
    ?>
            <form class="suppr_article" method="post">
                <button type="submit" name="suppr_article" value="<?php echo $article['id_article'];?>">Supprimer l'article</button>
            </form>
    <?php
            echo '</div>';  
        }
    }else{
        echo '<div class="background"><h2>Aucun article publié.</h2></div>';
    }
    require_once 'footer.php';
?>