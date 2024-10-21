<?php
    require '../header.php';

    if(isset($_POST['ajoutCat']) and !isset($_POST['suppCat']) and !isset($_POST['modifCat'])){
        if(!empty($_POST['nomajoutCat'])){
            //requette sql pour ajouter une categorie 

            $stmt = $conn->prepare("INSERT INTO categorie (nomcategorie) VALUES (:categorie)");
            
            $stmt->execute([':categorie' => $_POST['nomajoutCat']]);

        }else{
            echo '<label for="ajoutCat">Entrez un nom de catégorie</label>';
        }
    }elseif(isset($_POST['suppCat']) and !isset($_POST['ajoutCat']) and !isset($_POST['modifCat'])){
        if(isset($_POST['radioCat'])){
            //requette sql pour supprimer une categorie 
            $stmt = $conn->prepare("DELETE FROM categorie WHERE idcategorie = :categorie");
            
            $stmt->execute([':categorie' => intval($_POST['radioCat'])]);

        }else{
            echo '<label for="suppCat">Selectionner une catégorie</label>';
        }
    }elseif(isset($_POST['modifCat']) and !isset($_POST['ajoutCat']) and !isset($_POST['suppCat'])){
        if(isset($_POST['radioCat']) and !empty($_POST['modifCat'])){
            
            //requette sql pour modifier une categorie 
            $stmt = $conn->prepare("UPDATE categorie SET nomcategorie = :newCategorie WHERE idCategorie = :categorieid");
            
            $stmt->execute([':newCategorie' => $_POST['modifCat'], ':categorieid' => intval($_POST['radioCat']) ]);
        }else{
            echo '<label for="modifCat">Selectionner une catégorie et entrez un nom<label>';
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
        
        <input type="text" name="modifCat" placeholder="Nouveau nom">
        <button class="boutton_crud" name="modifier" type="submit">Modifier</button>
    </form>

    <form method="POST">
    <?php foreach($categories as $cate){
            echo '<input name="radioCat" value="'. $cate['idCategorie'] .'" type="radio">'. $cate['nomcategorie'] .'</input>';   
        }?>
        <button class="boutton_crud" name="suppCat" type='submit'>supprimer</button>
    </form>

    <form method="POST">
        <input name="nomajoutCat" type="text" placeholder="Nom"></input>
        <button class="boutton_crud" name="ajoutCat" type='submit'>ajouter</button>
    </form>



<?php


    require_once '../footer.php';
?>