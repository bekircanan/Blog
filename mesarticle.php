<?php
    require_once 'header.php';
    // requette sql pour chercher les articles de l'utilisateur
    $stmt = $conn->prepare("SELECT idArticle,titre,datePub, SUBSTR(contenu, 1, 150) as contenu FROM article WHERE idUser = ?");
    $stmt->bindParam(1, $_SESSION['idUser']);
    $stmt->execute();
    $articles = $stmt->fetchAll();
    //affichage des articles de l'utilisateur
    if(!empty($articles)){
        foreach($articles as $article){
            echo '<div class="resultat_recherche"><a href="./article.php?idArticle=' . $article['idArticle']. '">'; 
            echo '<h2>' . $article['titre'] . '</h2>';
            echo '<p>Publié le ' . $article['datePub'] . '</p>';
            echo '<p>' . $article['contenu'] . '...</p>';
            echo '</a></div>';  
        }
    }else{
        echo '<div class="resultat_recherche"> Aucun Resultat </div>';
    }
    require_once 'footer.php';
?>