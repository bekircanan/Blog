<?php
    require_once 'header.php';
    // requette sql pour chercher les articles de l'utilisateur
    $stmt = $conn->prepare("SELECT id_article,titre,date_pub, SUBSTR(contenu, 1, 150) as contenu FROM article WHERE id_user = ?");
    $stmt->bindParam(1, $_SESSION['idUser']);
    $stmt->execute();
    $articles = $stmt->fetchAll();
    //affichage des articles de l'utilisateur
    if(!empty($articles)){
        foreach($articles as $article){
            echo '<div><a href="./article.php?idArticle=' . $article['id_article']. '">'; 
            echo '<h2>' . $article['titre'] . '</h2>';
            echo '<p>Publié le ' . $article['date_pub'] . '</p>';
            echo '<p>' . $article['contenu'] . '...</p>';
            echo '</a></div>';  
        }
    }else{
        echo '<div> Aucun article publié </div>';
    }
    require_once 'footer.php';
?>