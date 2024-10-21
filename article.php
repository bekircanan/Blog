<?php
require_once 'header.php';
$idComment=0;


$stmtSelectMaxIdComm = $conn->prepare(
    "SELECT max(id_com) as max_id_com from commentaire"
);
$stmtInsertCommentaire = $conn->prepare(
    "INSERT INTO commentaire (message, idUser, idArticle) VALUES ( ?, ?, ?)"
);
$stmtInsertCommentaire->bindParam(1,$new_comment);
$stmtInsertCommentaire->bindParam(2,$idUserComment);
$stmtInsertCommentaire->bindParam(3,$idArticle);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if (!empty($_POST['new_comment']) and !isset($_POST['suppr_article']) and !isset($_POST['suppr_comment'])){
        
        $new_comment = $_POST['new_comment'];
        $idArticle = $_SESSION['idArticleActuel'];
        settype($_SESSION['idUser'], "integer");
        $idUserComment = $_SESSION['idUser'];
        $stmtInsertCommentaire->execute();
        header("Location: article.php?idArticle={$_SESSION['idArticleActuel']}");
        exit;
    }
    elseif(empty($_POST['new_comment']) and !isset($_POST['suppr_article']) and !isset($_POST['suppr_comment'])){
        echo "Renseignez d'abord un commentaire.";
    }
    elseif(!isset($_POST['suppr_comment'])){
        $stmtDeleteArticle = $conn->prepare(
            "DELETE FROM article WHERE idArticle = {$_SESSION['idArticleActuel']}"
        );
        $stmtDeleteArticle->execute();
        unset($_POST['suppr_article']);
        header("Location: index.php");
        exit;
    }
    else{
        $idComment = $_POST['suppr_comment'];
        $stmtDeleteComment= $conn->prepare(
            "DELETE FROM commentaire WHERE id_com = {$idComment}"
        );
        $stmtDeleteComment->execute();
        header("Location: article.php?idArticle={$_SESSION['idArticleActuel']}");
        exit;
    }
}
elseif($_SERVER['REQUEST_METHOD'] == 'GET'){
    $_SESSION['idArticleActuel'] = $_GET['idArticle'];
}


$stmtSelectArticle = $conn->prepare(
    "SELECT * from article where idArticle = {$_SESSION['idArticleActuel']}"
);
$stmtSelectArticle->execute();
foreach($stmtSelectArticle as $rows){
    $titre = $rows['titre'];
    $date = $rows['datePub'];
    $contenu = $rows['contenu'];
    $idUser = $rows['idUser'];
}


$stmtSelectUserArticle = $conn->prepare(
    "SELECT * from user where iduser = {$idUser}"
);
$stmtSelectUserArticle->execute();
foreach($stmtSelectUserArticle as $rows){
    $mail = $rows['email'];
    $pseudo = $rows['pseudo'];
}

$stmtSelectAllComment = $conn->prepare(
    "SELECT * FROM commentaire WHERE idArticle = {$_SESSION['idArticleActuel']} order by date desc"
);

?>
    <section id="article">
            <h1><?php echo $titre?></h1>
            <p>Auteur : <?php echo $pseudo?> </p>
            <p>Mail : <?php echo $mail?> </p>
            <p>Date : <?php echo $date?> </p>
            <p><?php echo $contenu?></p>
        
        <?php if ($_SESSION['user'] === $pseudo){?>
            <form id="supprimer_article" method="post">
                <button type="submit" name="suppr_article">Supprimer l'article</button>
            </form>
        <?php }?>

    </section>

    <form action = "article.php" method="post">
        <h3>Laisser un commentaire :</h3>
        <textarea name="new_comment" rows="5" required></textarea>

        <button type="submit">Commenter</button>
    </form>

    <section class="affichage_commentaire">
        <h3> Commentaires : </h3>
    
            <?php
                $stmtSelectAllComment->execute();
                foreach ($stmtSelectAllComment as $rows){
                    $_SESSION['idUserComment'] = $rows['idUser'];
                    $sql = "SELECT * from user where iduser = {$_SESSION['idUserComment']}";
                    $result = $conn->query($sql);
                    $row2 = $result->fetch();
                    $pseudo2 = $row2['pseudo'];
                    echo '<div class="affichage_commentaire">';
                    echo "<p>" . $pseudo2 . "</p>". "<p>" . $rows['date']. "</p>";
                    echo "<p>" . $rows['message']."</p>";
                    if($pseudo2 === $_SESSION['user']){
                        ?>
                        <form action = "article.php" method = "post">
                            <button name = "suppr_comment" type="submit" value = "<?php echo $rows['id_com'];?>">Supprimer le commentaire.</button>
                        </form> 
                        <?php
                    }
                    echo '</div>';
                }
            ?>
        
    </section>

        <?php
            

            require_once 'footer.php';
        ?>

   


