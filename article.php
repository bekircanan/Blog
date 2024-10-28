<?php
require_once 'header.php';
$idComment=0;

$stmtInsertCommentaire = $conn->prepare(
    "INSERT INTO commentaire (message, id_user, id_article) VALUES ( ?, ?, ?)"
);
$stmtInsertCommentaire->bindParam(1,$new_comment);
$stmtInsertCommentaire->bindParam(2,$idUserComment);
$stmtInsertCommentaire->bindParam(3,$idArticle);

$stmtInsertFavoris = $conn->prepare("INSERT INTO favoris (id_article, id_user) VALUES (?, ?)");
$stmtInsertFavoris->bindParam(1,$newIdArticle);
$stmtInsertFavoris->bindParam(2,$newIdUser);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if (!empty($_POST['new_comment']) and !isset($_POST['suppr_article']) and !isset($_POST['suppr_comment']) and !isset($_POST['ajouter_fav']) and !isset($_POST['suppr_fav'])){
        /* On se place ici dans le cas où un utilisateur ajoute un commentaire à l'article.*/
        $new_comment = $_POST['new_comment'];
        $idArticle = $_SESSION['idArticleActuel'];
        settype($_SESSION['idUser'], "integer");
        $idUserComment = $_SESSION['idUser'];
        $stmtInsertCommentaire->execute();
        header("Location: article.php?id_article={$_SESSION['idArticleActuel']}");
        exit;
    }
    elseif(empty($_POST['new_comment']) and !isset($_POST['suppr_article']) and !isset($_POST['suppr_comment']) and !isset($_POST['ajouter_fav']) and !isset($_POST['suppr_fav'])){
        /* Le cas où l'utilisateur n'a pas rempli le champ du commentaire mais cliqué sur le bouton. */
        echo "Renseignez d'abord un commentaire.";
    }
    elseif(!isset($_POST['suppr_comment']) and !isset($_POST['ajouter_fav']) and !isset($_POST['suppr_fav'])){
        /* Le cas où le créateur de l'article décide de supprimer son article. */
        $stmtDeleteArticle = $conn->prepare(
            "DELETE FROM article WHERE id_article = {$_SESSION['idArticleActuel']}"
        );
        $stmtDeleteArticle->execute();
        unset($_POST['suppr_article']);
        header("Location: index.php");
        exit;
    }
    elseif(!isset($_POST['ajouter_fav']) and !isset($_POST['suppr_fav'])){
        /* Le cas où le créateur du commentaire décide de supprimer son commentaire. */
        $idComment = $_POST['suppr_comment'];
        $stmtDeleteComment= $conn->prepare(
            "DELETE FROM commentaire WHERE id_com = {$idComment}"
        );
        $stmtDeleteComment->execute();
        header("Location: article.php?id_article={$_SESSION['idArticleActuel']}");
        exit;
    }
    elseif(!isset($_POST['suppr_fav'])){
        /* La dernier cas, lorsque un utilisateur quelconque a décidé d'ajouter l'article à ses favoris. */
        $newIdArticle = $_SESSION['idArticleActuel'];
        $newIdUser = $_SESSION['idUser'];
        $stmtInsertFavoris->execute();
        header("Location: article.php?id_article={$_SESSION['idArticleActuel']}");
        exit;
        
    }
    else{
        $stmtDeleteFromFavoris = $conn->prepare("DELETE FROM favoris WHERE id_article = {$_SESSION['idArticleActuel']}");
        $stmtDeleteFromFavoris->execute();
        header("Location: article.php?id_article={$_SESSION['idArticleActuel']}");
        exit;
    }

}
elseif($_SERVER['REQUEST_METHOD'] == 'GET'){
    /* On ne passera qu'une fois dans cette boucle, lorsque l'on arrivera sur la page via la page d'acceuill ou la page Mes favoris. */
    $_SESSION['idArticleActuel'] = $_GET['id_article'];
    $stmtTestArticleExistant = $conn->prepare("SELECT * FROM article where id_article = {$_SESSION['idArticleActuel']}");
    $stmtTestArticleExistant->execute();
    $testArticleExistant = $stmtTestArticleExistant->fetch();
    if(empty($testArticleExistant)){
        header("Location: index.php");
        exit;
    }
}

/* Requête permettant de tester si l'utilisateur actuel a déjà ajouter l'article a ses favoris. */
$stmtTestFavoris = $conn->prepare("SELECT * FROM favoris WHERE id_user = {$_SESSION['idUser']} AND id_article = {$_SESSION['idArticleActuel']}");
$stmtSelectArticle = $conn->prepare(
    "SELECT * from article where id_article = {$_SESSION['idArticleActuel']}"
);


$stmtSelectArticle->execute();
foreach($stmtSelectArticle as $rows){
    $titre = $rows['titre'];
    $date = $rows['date_pub'];
    $contenu = $rows['contenu'];
    $idUser = $rows['id_user'];
}


$stmtSelectUserArticle = $conn->prepare(
    "SELECT * from user where id_user = {$idUser}"
);
$stmtSelectUserArticle->execute();
$infoCrea = $stmtSelectUserArticle->fetch();

$stmtSelectAllComment = $conn->prepare(
    "SELECT * FROM commentaire WHERE id_article = {$_SESSION['idArticleActuel']} order by date desc"
);

?>
    <div id="article" class="background">
        <h1><?php echo $titre?></h1>
        
        <p>Auteur : <?php echo $infoCrea['pseudo']?> </p>
        <p>Publié le <?php echo $date?> </p>
        <p><?php echo $contenu?></p>
        
        <?php 
            $stmtTestFavoris->execute();
            $alreadyfav = $stmtTestFavoris->fetch();
            /* On test ici si l'utilisateur à déjà ajouté l'article à ses favoris afin de ne pas afficher le bouton dans le cas positif. */
            if(empty($alreadyfav)){
        ?>

        <form id="ajouter_favoris" method="post">
            <button type="submit" name="ajouter_fav">Ajouter aux favoris</button>
        </form>

        <?php }else{?>
            <form id="ajouter_favoris" method="post">
                <button type="submit" name="suppr_fav">Supprimer des favoris</button>
            </form>
        <?php }?>

        <?php
            if ($_SESSION['user'] === $infoCrea['pseudo']){
        ?>
            <form id="supprimer_article" method="post">
                <button type="submit" name="suppr_article">Supprimer l'article</button>
            </form>
        <?php }?>
    </div>

    <form method="post">
        <h3>Laisser un commentaire :</h3>
        <textarea name="new_comment" rows="5" placeholder="..." required></textarea>
        <br>
        <button type="submit" name="commenter">Commenter</button>
    </form>

    <div class="background">
        <h2> Commentaires : </h2>
    
            <?php
                $stmtSelectAllComment->execute();
                foreach ($stmtSelectAllComment as $rows){
                    $_SESSION['idUserComment'] = $rows['id_user'];
                    $sql = "SELECT * from user where id_user = {$_SESSION['idUserComment']}";
                    $result = $conn->query($sql);
                    $row2 = $result->fetch();
                    $pseudo2 = $row2['pseudo'];
                    echo '<div class="afficher_com background">';
                    echo "<h3>" . $pseudo2 . "</h3>";
                    echo "<p> Publié le " . $rows['date']. "</p>";
                    echo "<p>" . $rows['message']."</p>";
                    if($pseudo2 === $_SESSION['user']){
            ?>
                        <form method = "post">
                            <button name = "suppr_comment" type="submit" value = "<?php echo $rows['id_com'];?>">Supprimer le commentaire.</button>
                        </form> 
            <?php
                    }
                    echo '</div>';
                }
            ?>
        
    </div>

        <?php
            

            require_once 'footer.php';
        ?>