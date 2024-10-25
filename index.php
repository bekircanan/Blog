<?php
require_once 'header.php';  
?>
<form method="GET">
    <input name="recherche" type="text"></input>
    <button type='submit'>Recherche</button>
</form>

<?php
    if(isset($_GET['recherche'])){
        //requette sql pour chercher les articles par rapport au pseudo,titre et catégorie
        $stmt = $conn->prepare("SELECT DISTINCT a.id_article, a.titre, a.date_pub, SUBSTR(a.contenu, 1, 150) as contenu, u.pseudo  
                                FROM article a 
                                        LEFT OUTER JOIN user u ON a.id_user = u.id_user 
                                        LEFT OUTER JOIN article_categorie ac ON ac.id_article = a.id_article
                                        LEFT OUTER JOIN categorie c ON ac.id_categorie = c.id_categorie
                                WHERE u.pseudo LIKE :pseudo 
                                        OR a.titre LIKE :titre
                                        OR c.nom_categorie LIKE :categorie
                                ORDER BY a.date_pub ASC;
                                ");
        
        $stmt->execute([':pseudo' => '%' . $_GET['recherche']. '%',
                        ':titre' => '%' . $_GET['recherche']. '%',
                        ':categorie' => '%' . $_GET['recherche']. '%']);
        $article = $stmt->fetchAll();

        if(!empty($article)){
            foreach($article as $art){
                echo '<div class="resultat_recherche"><a href="./article.php?id_article=' . $art['id_article']. '">'; 
                echo '<h2>' . $art['titre'] . '</h2>';
                echo '<p>Publié le ' . $art['date_pub'] . '</p>';
                echo '<p>' . $art['contenu'] . '...</p>';
                echo '<p>by ' . $art['pseudo'] . '</p>';
                echo '</a></div>';  
            }
            
        } else{
            echo '<div class="resultat_recherche"> Aucun Resultat </div>'; 
        }
    }else{
        $stmt = $conn->prepare("SELECT a.id_article, a.titre, a.date_pub, SUBSTR(a.contenu, 1, 150) as contenu, u.pseudo FROM article a JOIN user u ON a.id_user = u.id_user order by a.date_pub asc limit 5");
        $stmt->execute();

        $article = $stmt->fetchAll();
        if(!empty($article)){
            foreach($article as $art){
                echo '<div class="resultat_recherche"><a href="./article.php?id_article=' . $art['id_article']. '">'; 
                echo '<h2>' . $art['titre'] . '</h2>';
                echo '<p>Publié le ' . $art['date_pub'] . '</p>';
                echo '<p>' . $art['contenu'] . '...</p>';
                echo '<p>by ' . $art['pseudo'] . '</p>';
                echo '</a></div>';  
            }
            
        } else{
            echo '<div class="resultat_recherche"> Aucun Resultat </div>'; 
        }
    }
        
       
require_once 'footer.php';
?>