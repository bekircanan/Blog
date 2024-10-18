<?php
    require '../header.php';


    if(isset($_POST['ajoutCat'])){
        if(!empty($_POST['ajoutCat'])){
            //requette sql pour ajouter une categorie 
            $stmt = $conn->prepare("INSERT INTO categorie (nomcategorie) VALUES (:categorie)");
            
            $stmt->execute([':categorie' => $_POST['ajoutCat']]);

        }
    }


    if(isset($_POST['suppCat'])){
        if(isset($_POST['radioCat'])){
            //requette sql pour supprimer une categorie 
            
            $stmt = $conn->prepare("DELETE FROM categorie WHERE nomcategorie = :categorie");
            
            $stmt->execute([':categorie' => $_POST['radioCat']]);

        }
    }
    
    if(isset($_POST['modifCat'])){
        if(!empty($_POST['modifCat'])){
            //requette sql pour supprimer une categorie 
            $stmt = $conn->prepare("UPDATE table SET nomcategorie = 'nouvelle valeur' WHERE condition");
            
            $stmt->execute([':categorie' => $_POST['modifCat']]);

            
        }
    }


    $stmt = $conn->query("SELECT idCategorie, nomcategorie FROM Categorie");  
    $stmt->execute();
    $categories = $stmt->fetchAll();
    
?>
    <link rel="stylesheet" href="../css/style.css">

    <form method="POST">
        <?php foreach($categories as $cate){
            echo '<input name="radioCat" value="'. $cate['idCategorie'] .'" type="radio">'. $cate['nomcategorie'] .'</input>';
        }?>
        <button name="suppCat" type='submit'>supprimer</button>
        <button name="modifier" type='submit'>modifier</button>
    </form>

    <form method="POST">
        <input name="ajoutCat" type="text"></input>
        <button type='submit'>ajouter</button>
    </form>



<?php


    require_once '../footer.php';
?>