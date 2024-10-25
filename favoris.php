<?php
require_once 'header.php';
    
?>

<h1>Mes favoris</h1>
<?php
        
        //requette sql pour chercher les articles par rapport au pseudo,titre et catégorie
        $stmt = $conn->prepare("SELECT a.id_article, a.titre, a.date_pub, SUBSTR(a.contenu, 1, 150) as contenu
                                FROM user u JOIN favoris f ON u.id_user = f.id_user 
                                               JOIN article a ON f.id_article = a.id_article
                                WHERE u.id_user = {$_SESSION['idUser']} order by a.date_pub asc");
        
        $stmt->execute();
        $article = $stmt->fetchAll();

        if(!empty($article)){
            foreach($article as $art){
                $stmt2 = $conn->prepare("SELECT pseudo from user u JOIN article a ON u.idUser = a.idUser WHERE id_article = {$art['id_article']}");
                $stmt2->execute();
                $pseudoCrea = $stmt2->fetch();
                echo '<div><a href="./article.php?id_article=' . $art['id_article']. '">'; 
                echo '<h2>' . $art['titre'] . '</h2>';
                echo '<p>Publié le ' . $art['date_pub'] . '</p>';
                echo '<p>' . $art['contenu'] . '...</p>';
                echo '<p>by ' . $pseudoCrea['pseudo'] . '</p>';
                echo '</a></div>';  
            }
            
        } else{
            echo '<div> Aucun Favoris pour le moment. </div>'; 
        }
        
       
require_once 'footer.php';
?>