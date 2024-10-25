<?php
    require '../header.php';

    $erreurAjout = false;
    $erreurSupp = false;
    $erreurModif = false;

    if(isset($_POST['ajoutCat']) and !isset($_POST['suppCat']) and !isset($_POST['modifCat'])){
        if(!empty($_POST['nomajoutCat'])){
            //requette sql pour ajouter une categorie 

            $stmt = $conn->prepare("INSERT INTO categorie (nom_categorie) VALUES (:categorie)");
            
            $stmt->execute([':categorie' => $_POST['nomajoutCat']]);

        }else{
            $erreurAjout = true;
        }
    }elseif(isset($_POST['suppCat']) and !isset($_POST['ajoutCat']) and !isset($_POST['modifCat'])){
        if(isset($_POST['radioCat'])){
            //requette sql pour supprimer une categorie 
            $stmt = $conn->prepare("DELETE FROM categorie WHERE id_categorie = :categorie");
            
            $stmt->execute([':categorie' => intval($_POST['radioCat'])]);

        }else{
            $erreurSupp = true;
        }
    }elseif(isset($_POST['modifCat']) and !isset($_POST['ajoutCat']) and !isset($_POST['suppCat'])){
        if(isset($_POST['radioCat']) and !empty($_POST['modifCat'])){
            
            //requette sql pour modifier une categorie 
            $stmt = $conn->prepare("UPDATE categorie SET nom_categorie = :newCategorie WHERE id_categorie = :categorieid");
            
            $stmt->execute([':newCategorie' => $_POST['modifCat'], ':categorieid' => intval($_POST['radioCat']) ]);
        }else{
            $erreurModif = true;
        }
    }

    /*Requette SQL pour récupérer les catégories existantes*/
    $stmt = $conn->query("SELECT id_categorie, no_mcategorie FROM Categorie");  
    $stmt->execute();
    $categories = $stmt->fetchAll();
    
?>



    <link rel="stylesheet" href="../css/style.css">

    <form name=modifCat method="POST">
        <?php 
            /*Message d'erreur*/
            if($erreurModif){
                echo '<p class="erreur">Selectionner une catégorie et entrez un nouveau nom</p>';
            }
            
            /*affichage des catégories*/
            foreach($categories as $cate){
                echo '<input name="radioCat" value="'. $cate['idCategorie'] .'" type="radio">'. $cate['nomcategorie'] .'</input>';   
            }
        ?>
        
        <input type="text" name="modifCat" placeholder="Nouveau nom">
        <button class="boutton_crud" name="modifier" type="submit">Modifier</button>
    </form>

    <form method="POST">
    <?php 
        /*Message d'erreur*/
        if($erreurSupp){
            echo '<p class="erreur">Selectionner une catégorie</p>';
        }

        /*affichage des catégories*/
        foreach($categories as $cate){
            echo '<input name="radioCat" value="'. $cate['idCategorie'] .'" type="radio">'. $cate['nomcategorie'] .'</input>';   
        }
        ?>
        <button class="boutton_crud" name="suppCat" type='submit'>supprimer</button>
    </form>

    <form method="POST">
        <?php 
            /*Message d'erreur*/
            if($erreurAjout){
                echo '<p class="erreur">Entrez un nom de catégorie</p>';
            }
        ?>

        <input name="nomajoutCat" type="text" placeholder="Nom"></input>
        <button class="boutton_crud" name="ajoutCat" type='submit'>ajouter</button>
    </form>



<?php


    require_once '../footer.php';
?>