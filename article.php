<?php
require_once 'header.php';
$idComment=0;

$stmtSelectArticle = $conn->prepare(
    "SELECT * from article where idArticle = {$_GET['idArticle']}"
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
    "SELECT * FROM commentaire WHERE idArticle = {$_GET['idArticle']}"
);
$stmtSelectUserComment = $conn->prepare(
    "SELECT * from user where iduser = {$idUser}"
);
$stmtSelectMaxIdComm = $conn->prepare(
    "SELECT max(id_com) as max_id_com from commentaire"
);
$stmtInsertCommentaire = $conn->prepare(
    "INSERT INTO commentaire (id_com, message, idUser, idArticle) VALUES (?, ?, ?, ?)"
);
$stmtInsertCommentaire->bindParam(1,$id_com);
$stmtInsertCommentaire->bindParam(2,$new_comment);
$stmtInsertCommentaire->bindParam(3,$_SESSION['idUser']);
$stmtInsertCommentaire->bindParam(4,$idArticle);

$stmtDeleteArticle = $conn->prepare(
    "DELETE FROM article WHERE idArticle = {$_GET['idArticle']}"
);



if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if (!empty($_POST['new_comment']) and !isset($_POST['suppr_article']) and !isset($_POST['suppr_comment'])){
        $stmtSelectMaxIdComm->execute();
        $row = $stmtSelectMaxIdComm->fetch();
        $id_com = $row['max_id_com'] + 1 ;
        $new_comment = $_POST['new_comment'];
        $idArticle = $_SESSION['idArticle'];
        $stmtInsertCommentaire->execute();
        $_POST['new_comment']="";
    }
    elseif(empty($_POST['new_comment']) and !isset($_POST['suppr_article']) and !isset($_POST['suppr_comment'])){
        echo "Renseignez d'abord un commentaire.";
    }
    elseif(!isset($_POST['suppr_comment'])){
        $stmtDeleteArticle->execute();
        unset($_POST['suppr_article']);
        header("Location: index.php");
        exit;
    }
    else{
        $idComment = $_POST['suppr_comment'];
        $stmtDeleteComment->execute();
    }
}
elseif($_SERVER['REQUEST_METHOD'] == 'GET'){

}

$stmtDeleteComment= $conn->prepare(
    "DELETE FROM commentaire WHERE id_com = {$idComment}"
);



?>

<html>
    <body>
        <h1><?php echo $titre?></h1>
        <p><?php echo $contenu?></p>
        
        Auteur : <?php echo $pseudo?> <br>
        Mail : <?php echo $mail?> <br>
        Date : <?php echo $date?> <br>

        Commentaires : <br>
        <?php
        $stmtSelectAllComment->execute();
        foreach ($stmtSelectAllComment as $rows){
            $idUser = $rows['idUser'];
            echo $idUser."<br>";
            $stmtSelectUserComment->execute();
            foreach($stmtSelectUserComment as $rows2){
                $pseudo2 = $rows2['pseudo'];
            }
            

            echo $pseudo2."<br>".$rows['date']."<br>";
            echo $rows['message']."<br>";
            if($pseudo2 === $_SESSION['user']){
                ?>
                <form action = "article.php" method = "post">
                    <button name = "suppr_comment" type="submit" value = "<?php echo $rows['id_com'];?>">Supprimer le commentaire.</button>
                </form> 
                <?php
            }
        }
        ?>

        <form action = "article.php" method="post">
            <textarea name="new_comment" rows="5" required></textarea>

            <button type="submit">Commenter</button>
        </form>
        <?php if ($_SESSION['user'] === $pseudo){
            ?><form action="article.php" method="post">
                <button type="submit" name="suppr_article">Supprimer l'article</button>
            </form>
        <?php
        }
        ?>

    </body>

</html>





