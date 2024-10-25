<?php
require_once 'header.php';
    
?>
    <div class="background">
        <h1>Mes favoris</h1>
    </div>
<?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            if (isset($_POST['suppr_fav'])){
                $stmtDeleteFromFavoris = $conn->prepare("DELETE FROM favoris WHERE id_article = {$_POST['suppr_fav']}");
                $stmtDeleteFromFavoris->execute();
                header("Location: favoris.php");
                exit;

            }
        }


        //requette sql pour chercher les articles par rapport au pseudo,titre et catégorie
        $stmt = $conn->prepare("SELECT a.id_article, a.titre, a.date_pub, SUBSTR(a.contenu, 1, 150) as contenu
                                FROM user u JOIN favoris f ON u.id_user = f.id_user 
                                            JOIN article a ON f.id_article = a.id_article
                                WHERE u.id_user = {$_SESSION['idUser']} order by a.date_pub asc");
        
        $stmt->execute();
        $article = $stmt->fetchAll();

        if(!empty($article)){
            foreach($article as $art){
                $stmt2 = $conn->prepare("SELECT pseudo from user u JOIN article a ON u.id_user = a.id_user WHERE id_article = {$art['id_article']}");
                $stmt2->execute();
                $pseudoCrea = $stmt2->fetch();
                echo '<div class="afficher_article background"><a href="./article.php?id_article=' . $art['id_article']. '">'; 
                echo '<h1>' . $art['titre'] . '</h1>';
                echo '<p>Publié le ' . $art['date_pub'] . '</p>';
                echo '<p>' . $art['contenu'] . '...</p>';
                echo '<p>by ' . $pseudoCrea['pseudo'] . '</p></a>';
                ?>
                    <form class="supprimer_fav" method="post">
                        <button type="submit" name="suppr_fav" value="<?php echo $art['id_article'];?>">Supprimer des favoris</button>
                    </form>
                <?php
                echo '</div>';  
            }
            
        } else{
            echo '<div class="background"><h2>Aucun favoris.</h2></div>'; 
        }
        
       
require_once 'footer.php';
?>