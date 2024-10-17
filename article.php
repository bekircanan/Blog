<?php
require_once 'header.php';

$stmtSelectArticle = $conn->prepare(
    "SELECT * from article where idArticle = 1"
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
    "SELECT * FROM commentaire WHERE idArticle = 1"
);
$stmtSelectUserComment = $conn->prepare(
    "SELECT * from user where iduser = {$idUser}"
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
            $stmtSelectUserComment->execute();
            foreach($stmtSelectUserComment as $rows2){
                $pseudo2 = $rows2['pseudo'];
            }
            echo $pseudo2."<br>".$rows['date']."<br>";
            echo $rows['message'];
        }
        ?>

    </body>

</html>





