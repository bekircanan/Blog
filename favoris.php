<?php
require_once 'header.php';
    
?>

<h1>Mes favoris</h1>
<?php
        
        //requette sql pour chercher les articles par rapport au pseudo,titre et catégorie
        $stmt = $conn->prepare("SELECT a.idArticle, a.titre, a.datepub, SUBSTR(a.contenu, 1, 150) as contenu
                                FROM user u JOIN favoris f ON u.idUser = f.idUser 
                                               JOIN article a ON f.idArticle = a.idArticle
                                WHERE u.idUser = {$_SESSION['idUser']} order by a.datepub asc");
        
        $stmt->execute();
        $article = $stmt->fetchAll();

        if(!empty($article)){
            foreach($article as $art){
                $stmt2 = $conn->prepare("SELECT pseudo from user u JOIN article a ON u.idUser = a.idUser WHERE idArticle = {$art['idArticle']}");
                $stmt2->execute();
                $pseudoCrea = $stmt2->fetch();
                echo '<div class="resultat_recherche"><a href="./article.php?idArticle=' . $art['idArticle']. '">'; 
                echo '<h2>' . $art['titre'] . '</h2>';
                echo '<p>Publié le ' . $art['datepub'] . '</p>';
                echo '<p>' . $art['contenu'] . '...</p>';
                echo '<p>by ' . $pseudoCrea['pseudo'] . '</p>';
                echo '</a></div>';  
            }
            
        } else{
            echo '<div class="resultat_recherche"> Aucun Favoris pour le moment. </div>'; 
        }
        
       
require_once 'footer.php';
?>