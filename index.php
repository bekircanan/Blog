<?php
require_once 'header.php';
    
?>
<form method="GET">
    <input name="recherche" type="text"></input>
    <button>Recherche</button>
</form>

<?php
    if(isset($_GET['recherche'])){
        $stmt = $conn->prepare("SELECT a.titre, a.datepub, SUBSTR(a.contenu, 1, 150) as contenu, u.pseudo  
                                FROM article a JOIN user u ON a.iduser = u.iduser 
                                               JOIN article_categorie ac ON ac.idArticle = a.idArticle
                                               JOIN categorie c ON ac.idCategorie = ac.idCategorie
                                WHERE u.pseudo LIKE :pseudo 
                                    OR a.titre LIKE :titre
                                    OR c.nomCategorie LIKE :categorie");
        
        $stmt->execute([':pseudo' => '%' . $_GET['recherche']. '%',
                        ':titre' => '%' . $_GET['recherche']. '%',
                        ':categorie' => '%' . $_GET['recherche']. '%']);
        $article = $stmt->fetchAll();
        if(!empty($article)){
            foreach($article as $art){
                echo '<div class="resultat_recherche">'; 
                echo '<h2>' . $art['titre'] . '</h2>';
                echo '<p>Publié le ' . $art['datepub'] . '</p>';
                echo '<p>' . $art['contenu'] . '...</p>';
                echo '<p>by ' . $art['pseudo'] . '</p>';
                echo '</div>';  
            }
            
        } else{
            echo '<div class="resultat_recherche"> Aucun Resultat </div>'; 
        }
    }
        
       
require_once 'footer.php';
?>